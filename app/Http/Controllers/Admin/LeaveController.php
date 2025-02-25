<?php

namespace App\Http\Controllers\Admin;

use App\Models\LeaveType;
use App\Models\LeaveBalance;
use Illuminate\Http\Request;
use App\Models\LeaveApplication;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class LeaveController extends Controller
 {
    // public function updateStatus( Request $request, $id )
    // {
    //     $leaveRequest = LeaveApplication::where( 'secure_id', $id )->first();
    //     $leave_from = Carbon::parse( $leaveRequest->leave_from )->startOfDay();
    //     $leave_to = Carbon::parse( $leaveRequest->leave_to )->startOfDay();
    //     $leaveDays = intval( $leave_from->diffInDays( $leave_to ) + 1 );

    //     if ( !$leaveRequest ) {
    //         return response()->json( [ 'error' => 'Leave application not found.' ], 404 );
    //     }

    //     $request->validate( [
    //         'status' => 'required|in:approved,rejected',
    // ] );

    //     $leaveType = LeaveType::where( 'leave_type', $leaveRequest->leave_type )->first();

    //     if ( !$leaveType ) {
    //         return response()->json( [ 'error' => 'Leave type not found.' ], 404 );
    //     }

    //     $leaveBalance = LeaveBalance::where( 'user_id', $leaveRequest->employee_secure_id )
    //     ->where( 'leave_type', $leaveRequest->leave_type )
    //     ->first();

    //     $maxAllowedLeaves = $leaveType->max_days;

    //     $usedLeaves = $leaveBalance ? $leaveBalance->used_leaves : 0;
    //     $remainingLeaves = $maxAllowedLeaves - $usedLeaves;

    //     if ( $request->status == 'approved' ) {
    //         if ( $remainingLeaves >= $leaveDays ) {
    //             if ( $leaveBalance ) {
    //                 $leaveBalance->used_leaves += $leaveDays;
    //                 $leaveBalance->remaining_leaves -= $leaveDays;
    //                 $leaveBalance->save();
    //             } else {
    //                 LeaveBalance::create( [
    //                     'user_id' => $leaveRequest->employee_secure_id,
    //                     'leave_type' => $leaveRequest->leave_type,
    //                     'total_leaves' => $maxAllowedLeaves,
    //                     'used_leaves' => $leaveDays,
    //                     'remaining_leaves' => $maxAllowedLeaves - $leaveDays,
    //                     'start_date' => $leaveRequest->leave_from,
    //                     'end_date' => $leaveRequest->leave_to,
    // ] );
    //             }

    //             $leaveRequest->update( [ 'status' => 'approved' ] );
    //         } else {
    //             return response()->json( [ 'error' => 'No remaining leave balance.' ], 400 );
    //         }
    //     } else {
    //         $leaveRequest->update( [ 'status' => 'rejected' ] );
    //     }

    //     return redirect()->back()->with( 'msg', 'Status Updated successfully.' );
    // }

    // public function updateStatus( Request $request, $id )
    // {
    //     $leaveRequest = LeaveApplication::where( 'secure_id', $id )->first();

    //     if ( !$leaveRequest ) {
    //         return response()->json( [ 'error' => 'Leave application not found.' ], 404 );
    //     }

    //     $request->validate( [
    //         'status' => 'required|in:approved,rejected',
    // ] );

    //     $leaveType = LeaveType::where( 'leave_type', $leaveRequest->leave_type )->first();

    //     if ( !$leaveType ) {
    //         return response()->json( [ 'error' => 'Leave type not found.' ], 404 );
    //     }

    //     $leaveBalance = LeaveBalance::where( 'user_id', $leaveRequest->employee_secure_id )
    //         ->where( 'leave_type', $leaveRequest->leave_type )
    //         ->first();

    //     $maxAllowedLeaves = $leaveType->max_days;
    //     $usedLeaves = $leaveBalance ? $leaveBalance->used_leaves : 0;
    //     $remainingLeaves = $maxAllowedLeaves - $usedLeaves;

    //     $leave_from = Carbon::parse( $leaveRequest->leave_from )->startOfDay();
    //     $leave_to = Carbon::parse( $leaveRequest->leave_to )->startOfDay();
    //     $leaveDays = intval( $leave_from->diffInDays( $leave_to ) + 1 );

    //     if ( $leaveDays > $remainingLeaves ) {
    //         return response()->json( [
    //             'error' => 'You do not have enough leave balance. You have only ' . $remainingLeaves . ' leave(s) remaining.'
    // ], 400 );
    //     }

    //     if ( $request->status == 'approved' ) {
    //         if ( $remainingLeaves >= $leaveDays ) {
    //             if ( $leaveBalance ) {
    //                 $leaveBalance->used_leaves += $leaveDays;
    //                 $leaveBalance->remaining_leaves -= $leaveDays;
    //                 $leaveBalance->save();
    //             } else {
    //                 LeaveBalance::create( [
    //                     'user_id' => $leaveRequest->employee_secure_id,
    //                     'leave_type' => $leaveRequest->leave_type,
    //                     'total_leaves' => $maxAllowedLeaves,
    //                     'used_leaves' => $leaveDays,
    //                     'remaining_leaves' => $maxAllowedLeaves - $leaveDays,
    //                     'start_date' => $leaveRequest->leave_from,
    //                     'end_date' => $leaveRequest->leave_to,
    // ] );
    //             }

    //             $leaveRequest->update( [ 'status' => 'approved' ] );
    //         } else {
    //             return response()->json( [ 'error' => 'No remaining leave balance.' ], 400 );
    //         }
    //     } else {
    //         $leaveRequest->update( [ 'status' => 'rejected' ] );
    //     }

    //     return redirect()->back()->with( 'msg', 'Status Updated successfully.' );
    // }

    public function updateStatus( Request $request, $id )
    {
        $leaveRequest = LeaveApplication::where( 'secure_id', $id )->first();
        // dd($leaveRequest->leave_type);

        if ( !$leaveRequest ) {
            return response()->json( [ 'error' => 'Leave application not found.' ], 404 );
        }

        $request->validate( [
            'status' => 'required|in:approved,rejected',
        ] );

        $leaveType = LeaveType::where( 'leave_type', $leaveRequest->leave_type )->first();

        if ( !$leaveType ) {
            return response()->json( [ 'error' => 'Leave type not found.' ], 404 );
        }

        $currentYear = Carbon::now()->year;

        $leaveBalance = LeaveBalance::where( 'user_id', $leaveRequest->employee_secure_id )
        ->where( 'leave_type', $leaveRequest->leave_type )
        ->where( 'year', $currentYear )
        ->first();

        $maxAllowedLeaves = $leaveType->max_days;
        $usedLeaves = $leaveBalance ? $leaveBalance->used_leaves : 0;
        $remainingLeaves = $maxAllowedLeaves - $usedLeaves;

        $leave_from = Carbon::parse( $leaveRequest->leave_from )->startOfDay();
        $leave_to = Carbon::parse( $leaveRequest->leave_to )->startOfDay();
        $leaveDays = intval( $leave_from->diffInDays( $leave_to ) + 1 );

         if ($leaveDays > $remainingLeaves) {
            $currentYear = date('Y');
            return redirect()->back()->with(
                'wrong', 
                'This Employee does not have enough leave balance.This Employee have only ' . " " . $remainingLeaves. " " . ucfirst($leaveRequest->leave_type). ' leave( s ) remaining for ' . $currentYear . '.'
            );
        }

        if ( $request->status == 'approved' ) {
            if ( $remainingLeaves >= $leaveDays ) {
                if ( $leaveBalance ) {
                    $leaveBalance->used_leaves += $leaveDays;
                    $leaveBalance->remaining_leaves -= $leaveDays;
                    $leaveBalance->save();
                } else {
                    LeaveBalance::create( [
                        'user_id' => $leaveRequest->employee_secure_id,
                        'leave_type' => $leaveRequest->leave_type,
                        'total_leaves' => $maxAllowedLeaves,
                        'used_leaves' => $leaveDays,
                        'remaining_leaves' => $maxAllowedLeaves - $leaveDays,
                        'year' => $currentYear,
                        'start_date' => $leaveRequest->leave_from,
                        'end_date' => $leaveRequest->leave_to,
                    ] );
                }

                $leaveRequest->update( [ 'status' => 'approved' ] );
            } else {
                return response()->json( [ 'error' => 'No remaining leave balance.' ], 400 );
            }
        } else {
            $leaveRequest->update( [ 'status' => 'rejected' ] );
        }

        return redirect()->back()->with( 'msg', 'Status Updated successfully.' );
    }

}
