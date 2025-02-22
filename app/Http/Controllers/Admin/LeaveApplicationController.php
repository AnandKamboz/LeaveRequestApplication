<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\LeaveType;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\LeaveApplication;
use App\Http\Controllers\Controller;
use App\Http\Requests\LeaveApplicationRequest;

class LeaveApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $allLeaveApplications = LeaveApplication::latest()->get();
       return view('admin.leave-applications.index',compact('allLeaveApplications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employeeNames = User::select('id','secure_id','first_name','last_name')->get();
        $leaveTypes = LeaveType::all();
        return view('admin.leave-applications.create',compact('employeeNames','leaveTypes'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LeaveApplicationRequest $request)
    {
        $secure_id = Str::random(32);
        $employee = User::where('secure_id',$request->name)->first();
        $leaveApply = new LeaveApplication();
        $leaveApply->secure_id = $secure_id;
        $leaveApply->employee_secure_id = "12423423";
        $leaveApply->employee_id = '232323';
         $leaveApply->leave_type = "12";
        $leaveApply->leave_type_secure_id = '242424';
        $leaveApply->leave_type_id = '2323232';
        $leaveApply->employee_name = 'dwdwdw';
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
    public function show(LeaveApplication $leaveApplication)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LeaveApplication $leaveApplication)
    {
        // dd('sdsds');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LeaveApplication $leaveApplication)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LeaveApplication $leaveApplication)
    {
        //
    }
}
