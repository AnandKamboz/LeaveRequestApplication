<?php

namespace App\Http\Controllers\Admin;

use App\Models\LeaveType;
use App\Models\LeaveBalance;
use Illuminate\Http\Request;
use App\Models\LeaveApplication;
use App\Http\Controllers\Controller;

class LeaveController extends Controller
 {
    // public function updateStatus( Request $request, $id )
    // {
    //     $leaveRequest = LeaveApplication::where( 'secure_id', $id )->first();

    //     if ( !$leaveRequest ) {
    //         return response()->json( [ 'error' => 'Leave application not found.' ], 404 );
    //     }

    //     $request->validate( [
    //         'status' => 'required|in:approved,rejected',
    //     ] );

    //     $leaveType = LeaveType::where( 'leave_type', $leaveRequest->leave_type )->first();

    //     if ( !$leaveType ) {
    //         return response()->json( [ 'error' => 'Leave type not found.' ], 404 );
    //     }

    //     $leaveCount = LeaveBalance::where( 'user_id', $leaveRequest->employee_secure_id )
    //     ->where( 'leave_type', $leaveRequest->leave_type )
    //     ->count();

    //     $maxAllowedLeaves = LeaveType::where( 'leave_type', $leaveRequest->leave_type )->value( 'max_days' );

    //     $remainingLeaves = $maxAllowedLeaves - $leaveCount;

    //     if ( $maxAllowedLeaves > $leaveCount ) {
    //         $leave = new LeaveBalance();
    //         $leave->user_id = $leaveRequest->employee_secure_id;
    //         $leave->leave_type = $leaveRequest->leave_type;
    //         $leave->total_leaves = $maxAllowedLeaves;
    //         $leave->used_leaves = $leaveCount;
    //         $leave->remaining_leaves = $remainingLeaves;
    //         $leave->save();

    //         LeaveApplication::where( 'secure_id', $id )->update([
    //            'status'=>$request->status,
    //         ]);
    //     } else {
    //         dd( 'Bye' );
    //     }

    //     return redirect()->back()->with('msg', 'Status Updated successfully.');

    // }

    public function updateStatus(Request $request, $id)
{
    $leaveRequest = LeaveApplication::where('secure_id', $id)->first();

    if (!$leaveRequest) {
        return response()->json(['error' => 'Leave application not found.'], 404);
    }

    $request->validate([
        'status' => 'required|in:approved,rejected',
    ]);

    $leaveType = LeaveType::where('leave_type', $leaveRequest->leave_type)->first();

    if (!$leaveType) {
        return response()->json(['error' => 'Leave type not found.'], 404);
    }

    $leaveBalance = LeaveBalance::where('user_id', $leaveRequest->employee_secure_id)
        ->where('leave_type', $leaveRequest->leave_type)
        ->first();

    $maxAllowedLeaves = $leaveType->max_days; 
    $usedLeaves = $leaveBalance ? $leaveBalance->used_leaves : 0;
    $remainingLeaves = $maxAllowedLeaves - $usedLeaves;

    if ($request->status == 'approved') {
        if ($remainingLeaves > 0) {
            if ($leaveBalance) {
                $leaveBalance->used_leaves += 1;
                $leaveBalance->remaining_leaves -= 1;
                $leaveBalance->save();
            } else {
                LeaveBalance::create([
                    'user_id' => $leaveRequest->employee_secure_id,
                    'leave_type' => $leaveRequest->leave_type,
                    'total_leaves' => $maxAllowedLeaves,
                    'used_leaves' => 1,
                    'remaining_leaves' => $maxAllowedLeaves - 1,
                ]);
            }

            $leaveRequest->update(['status' => 'approved']);
        } else {
            return response()->json(['error' => 'No remaining leave balance.'], 400);
        }
    } else {
        $leaveRequest->update(['status' => 'rejected']);
    }

    return redirect()->back()->with('msg', 'Status Updated successfully.');
}


}
