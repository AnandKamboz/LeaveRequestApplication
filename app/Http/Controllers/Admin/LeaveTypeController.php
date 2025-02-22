<?php

namespace App\Http\Controllers\Admin;

use App\Models\LeaveType;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLeaveTypeRequest;
use Illuminate\Support\Facades\DB;


class LeaveTypeController extends Controller
 {
    public function index()
    {
        $leaveTypes = LeaveType::all();
        return view( 'admin.leave_type.index', compact( 'leaveTypes' ) );
    }

    public function create()
    {
        return view( 'admin.leave_type.create' );
    }

    public function store( StoreLeaveTypeRequest $request )
    {
        do {
            $secure_id = Str::random( 32 );
        }
        while ( LeaveType::where( 'secure_id', $secure_id )->exists() );

        $leaveType = new LeaveType();
        $leaveType->secure_id = $secure_id;
        $leaveType->leave_type = $request->leave_type;
        $leaveType->max_days = $request->max_days;

        if ( $request->filled( 'description' ) ) {
            $leaveType->description = $request->description;
        }

        $leaveType->save();
        return redirect()->back()->with( 'msg', 'Leave Type added successfully!' );
    }

    public function show( string $id )
    {
        
    }

    public function edit( string $id )
    {
        
    }

    public function update( Request $request, string $id )
    {
        
    }

    public function destroy( string $id )
    {
       $leaveType = LeaveType::where('secure_id',$id)->first();
       $leaveType->delete();
       return redirect()->back()->with( 'msg', 'Leave Type deleted successfully!' );
    }
}
