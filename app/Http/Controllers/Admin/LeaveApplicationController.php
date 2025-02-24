<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\LeaveType;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\LeaveApplication;
use App\Http\Controllers\Controller;
use App\Http\Requests\LeaveApplicationRequest;

class LeaveApplicationController extends Controller {
    /**
    * Display a listing of the resource.
    */

    public function index() {
        $allLeaveApplications = LeaveApplication::latest()->get();
        $leaveType = LeaveType::all();
        return view( 'admin.leave-applications.index', compact( 'allLeaveApplications', 'leaveType' ) );
    }

    /**
    * Show the form for creating a new resource.
    */

    public function create() {
        $employeeNames = User::select( 'id', 'secure_id', 'first_name', 'last_name' )->get();
        $leaveTypes = LeaveType::all();
        return view( 'admin.leave-applications.create', compact( 'employeeNames', 'leaveTypes' ) );

    }

    /**
    * Store a newly created resource in storage.
    */

    public function store( LeaveApplicationRequest $request ) {
        $user = User::where( 'secure_id', $request->name )->first();
        do {
            $secure_id = Str::random( 32 );
        }
        while ( User::where( 'secure_id', $secure_id )->exists() );
        $leaveApply = new LeaveApplication();
        $leaveApply->secure_id = $secure_id;
        $leaveApply->employee_secure_id = $request->name;
        $leaveApply->leave_type = $request->leave_type;
        $leaveApply->employee_name = $user->first_name.' '.$user->last_name;
        $leaveApply->designation = $request->designation;
        $leaveApply->place_of_posting = $request->place_of_posting;
        $leaveApply->leave_from = $request->leave_from;
        $leaveApply->leave_to = $request->leave_to;
        $leaveApply->leave_address = $request->leave_address;
        $leaveApply->leave_reason = $request->leave_reason;
        $leaveApply->save();
        return redirect()->back()->with( 'msg', 'Leave Applied successfully!' );
    }

    /**
    * Display the specified resource.
    */

    public function show( $id ) {
        $application = LeaveApplication::where( 'secure_id', $id )->first();
        return view( 'admin.leave-applications.show', compact( 'application' ) );
    }

    /**
    * Show the form for editing the specified resource.
    */

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
