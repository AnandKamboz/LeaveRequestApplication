<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\LeaveType;
use Illuminate\Support\Str;
use App\Models\LeaveBalance;
use Illuminate\Http\Request;
use App\Models\LeaveApplication;
use App\Http\Controllers\Controller;
use App\Http\Requests\LeaveApplicationRequest;

class LeaveApplicationController extends Controller {
    
    public function index() {
        $allLeaveApplications = LeaveApplication::latest()->get();
        $leaveType = LeaveType::all();
        return view( 'admin.leave-applications.index', compact( 'allLeaveApplications', 'leaveType' ) );
    }

    public function create() {
        $employeeNames = User::select( 'id', 'secure_id', 'first_name', 'last_name' )->get();
        $leaveTypes = LeaveType::all();
        return view( 'admin.leave-applications.create', compact( 'employeeNames', 'leaveTypes' ) );

    }

    // public function store( LeaveApplicationRequest $request ) {
    //     $user = User::where( 'secure_id', $request->name )->first();
    //     do {
    //         $secure_id = Str::random( 32 );
    //     }
    //     while ( User::where( 'secure_id', $secure_id )->exists() );
    //     $leaveApply = new LeaveApplication();
    //     $leaveApply->secure_id = $secure_id;
    //     $leaveApply->employee_secure_id = $request->name;
    //     $leaveApply->leave_type = $request->leave_type;
    //     $leaveApply->employee_name = $user->first_name.' '.$user->last_name;
    //     $leaveApply->designation = $request->designation;
    //     $leaveApply->place_of_posting = $request->place_of_posting;
    //     $leaveApply->leave_from = $request->leave_from;
    //     $leaveApply->leave_to = $request->leave_to;
    //     $leaveApply->leave_address = $request->leave_address;
    //     $leaveApply->leave_reason = $request->leave_reason;
    //     $leaveApply->save();
    //     return redirect()->back()->with( 'msg', 'Leave Applied successfully!' );
    // }

    // public function store(LeaveApplicationRequest $request)
    // {
    //     $user = User::where('secure_id', $request->name)->first();

    //     do {
    //         $secure_id = Str::random(32);
    //     } while (User::where('secure_id', $secure_id)->exists());

    //     $leaveFrom = Carbon::parse($request->leave_from)->startOfDay();
    //     $leaveTo = Carbon::parse($request->leave_to)->startOfDay();
    //     $year = $leaveFrom->year;


    //     $overlappingLeave = LeaveApplication::where('employee_secure_id', $request->name)
    //         ->whereYear('leave_from', $year) // ✅ Same Year
    //         ->where(function ($query) use ($leaveFrom, $leaveTo) {
    //             $query->whereBetween('leave_from', [$leaveFrom, $leaveTo])
    //                 ->orWhereBetween('leave_to', [$leaveFrom, $leaveTo])
    //                 ->orWhere(function ($query) use ($leaveFrom, $leaveTo) {
    //                     $query->where('leave_from', '<=', $leaveFrom)
    //                             ->where('leave_to', '>=', $leaveTo);
    //                 });
    //         })
    //         ->exists();

    //     if ($overlappingLeave) {
    //         return redirect()->back()->with('wrong', 'You have already applied for leave during this period.');
    //     }

    //     $leaveApply = new LeaveApplication();
    //     $leaveApply->secure_id = $secure_id;
    //     $leaveApply->employee_secure_id = $request->name;
    //     $leaveApply->leave_type = $request->leave_type;
    //     $leaveApply->employee_name = $user->first_name . ' ' . $user->last_name;
    //     $leaveApply->designation = $request->designation;
    //     $leaveApply->place_of_posting = $request->place_of_posting;
    //     $leaveApply->leave_from = $leaveFrom;
    //     $leaveApply->leave_to = $leaveTo;
    //     $leaveApply->leave_address = $request->leave_address;
    //     $leaveApply->leave_reason = $request->leave_reason;
    //     $leaveApply->save();

    //     return redirect()->back()->with('msg', 'Leave Applied successfully!');
    // }

    public function store(LeaveApplicationRequest $request)
    {
        $user = User::where('secure_id', $request->name)->first();

        do {
            $secure_id = Str::random(32);
        } while (User::where('secure_id', $secure_id)->exists());

        $leaveFrom = Carbon::parse($request->leave_from)->startOfDay();
        $leaveTo = Carbon::parse($request->leave_to)->startOfDay();
        $year = $leaveFrom->year;
        
        $leaveType = LeaveType::where('leave_type', $request->leave_type)->first();
        $leaveBalance = LeaveBalance::where('user_id', $request->name)
            ->where('leave_type', $request->leave_type)
            ->where('year', $year)
            ->first();

        $maxAllowedLeaves = $leaveType->max_days ?? 0;
        $usedLeaves = $leaveBalance->used_leaves ?? 0;
        $remainingLeaves = $maxAllowedLeaves - $usedLeaves;
        $leaveDays = intval($leaveFrom->diffInDays($leaveTo) + 1);

        if ($leaveDays > $remainingLeaves) {
            return redirect()->back()->with(
                'wrong', 
                'This Employee does not have enough leave balance. This Employee has only ' . 
                $remainingLeaves . ' ' . ucfirst($request->leave_type) . ' leave(s) remaining for ' . $year . '.'
            );
        }

        $overlappingLeave = LeaveApplication::where('employee_secure_id', $request->name)
            ->whereYear('leave_from', $year)
            ->where(function ($query) use ($leaveFrom, $leaveTo) {
                $query->whereBetween('leave_from', [$leaveFrom, $leaveTo])
                    ->orWhereBetween('leave_to', [$leaveFrom, $leaveTo])
                    ->orWhere(function ($query) use ($leaveFrom, $leaveTo) {
                        $query->where('leave_from', '<=', $leaveFrom)
                            ->where('leave_to', '>=', $leaveTo);
                    });
            })
            ->exists();

        if ($overlappingLeave) {
            return redirect()->back()->with('wrong', 'You have already applied for leave during this period.');
        }

        $leaveApply = new LeaveApplication();
        $leaveApply->secure_id = $secure_id;
        $leaveApply->employee_secure_id = $request->name;
        $leaveApply->leave_type = $request->leave_type;
        $leaveApply->employee_name = $user->first_name . ' ' . $user->last_name;
        $leaveApply->designation = $request->designation;
        $leaveApply->place_of_posting = $request->place_of_posting;
        $leaveApply->leave_from = $leaveFrom;
        $leaveApply->leave_to = $leaveTo;
        $leaveApply->leave_address = $request->leave_address;
        $leaveApply->leave_reason = $request->leave_reason;
        $leaveApply->save();

        return redirect()->back()->with('msg', 'Leave Applied successfully!');
    }



  
    public function show( $id ) {
        $application = LeaveApplication::where( 'secure_id', $id )->first();
        return view( 'admin.leave-applications.show', compact( 'application' ) );
    }

   

    public function edit( $id ) {
        $leaveApplication = LeaveApplication::where( 'secure_id', $id )->first();
        $employeeNames = User::select( 'id', 'secure_id', 'first_name', 'last_name' )->get();
        $leaveTypes = LeaveType::all();
        return view( 'admin.leave-applications.edit', compact( 'employeeNames', 'leaveTypes', 'leaveApplication' ) );
    }

    /**
    * Update the specified resource in storage.
    */

    public function update( Request $request, $secure_id ) {
        $request->validate( [
            'name' => 'required',
            'designation' => 'required',
            'place_of_posting'=>'required',
            'leave_type' => 'required|string|max:255',
            // 'leave_from' => 'required|date|after_or_equal:today',
            'leave_to' => 'required|date|after_or_equal:leave_from',
            'leave_reason' => 'required|string',
            'leave_address' => 'nullable|string',
        ] );

        $leaveApplication = LeaveApplication::where('secure_id', $secure_id)->firstOrFail();

        $leaveApplication->update( [
            'employee_secure_id' => $request->name,
            'designation' => $request->designation,
            'place_of_posting' => $request->place_of_posting,
            'leave_type' => $request->leave_type,
            'leave_from' => $request->leave_from,
            'leave_to' => $request->leave_to,
            'leave_reason' => $request->leave_reason,
            'leave_address' => $request->leave_address,
        ] );

         return redirect()->route('admin.leave-applications.index')
                     ->with('msg', 'Leave application updated successfully.');
    }

    /**
    * Remove the specified resource from storage.
    */

    public function destroy( $id ) {
        $leaveType = LeaveType::where( 'secure_id', $id )->first();
        $leaveType->delete();
        return redirect()->back()->with( 'msg', 'LeaveApplication Deleted successfully!' );
    }
}
