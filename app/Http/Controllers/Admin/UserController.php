<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\RoleType;
use App\Models\CompanyName;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller {
    public function index() {
        $employees = User::all();
        return view( 'admin.user.index', compact( 'employees' ) );
    }

    public function create() {
         $companyNames = CompanyName::all();
        $employeeName = User::select('secure_id','first_name', 'last_name' )->get();
        return view( 'admin.user.create', compact( 'employeeName','companyNames' ) );
    }

    public function store( StoreUserRequest  $request) {
        do {
            $secureId = Str::uuid();
        }
        while ( User::where( 'secure_id', $secureId )->exists() );

        $user = new User();
        $user->secure_id = $secureId;
        $user->first_name = $request->first_name;
        if ( $request->last_name ) {
            $user->last_name = $request->last_name;
        }

        if ( $request->hasFile( 'profile_photo' ) ) {
            $file = $request->file( 'profile_photo' );
            $firstName = ucfirst( Str::slug( $request->first_name ) );
            $lastName = ucfirst( Str::slug( $request->last_name ?? '' ) );
            $uniqueId = time();
            $folderName = "{$firstName}_{$lastName}_{$uniqueId}";
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $filePath = "employee_profile_photos/{$folderName}";
            $file->storeAs( $filePath, $filename, 'public' );
            $user->profile_photo = "storage/{$filePath}/{$filename}";
        }

        if ( $request->email ) {
            $user->email = $request->email;
        }
        $user->mobile = $request->mobile;
        $user->company_group_id = $request->company_group_id;
        $user->gender = $request->gender;
        $user->date_of_joining = $request->date_of_joining;
        $user->salary = $request->salary;
        if($request->reporting_officer && $request->reporting_officer != null){
            $user->reporting_officer = $request->reporting_officer;
        }
        $user->save();

        $roleType = new RoleType();
        $roleType->user_id = $user->id;
        $roleType->role_id = 1;
        $roleType->save();

        return redirect()->back()->with( 'msg', 'Employee created successfully!' );

    }

    public function show( string $id ) {
        $employee = User::where( 'secure_id', $id )->first();
        $companyNames = CompanyName::all();
        return view( 'admin.user.show', compact( 'employee', 'companyNames' ) );
    }

    public function edit( string $id ) {
        $employee = User::where( 'secure_id', $id )->first();
        $users = User::all();
        // dd($employee);
        return view( 'admin.user.edit', compact( 'employee','users' ) );
    }

    public function update( Request $request, string $id ) {
        $validatedData = $request->validate( [
            'first_name'       => 'required|string|max:255',
            'last_name'        => 'nullable|string|max:255',
            'email'            => 'required|email|max:255|unique:users,email,' . $id . ',secure_id',
            'mobile'           => 'required|digits:10|regex:/^[6-9]\d{9}$/',
            'company_group_id' => 'nullable|integer',
            'gender'           => 'required|in:Male,Female,Other',
            'date_of_joining'  => 'required|date|before_or_equal:today',
            'salary'           => 'nullable|numeric|min:0',
            'profile_photo'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ] );

        $employee = User::where( 'secure_id', $id )->firstOrFail();
        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->email = $request->email;
        $employee->mobile = $request->mobile;
        $employee->company_group_id = $request->company_group_id;
        $employee->gender = $request->gender;
        $employee->date_of_joining = $request->date_of_joining;
        $employee->salary = $request->salary;
        if($employee->reporting_officer){
            $employee->reporting_officer = $request->reporting_officer;
        }

        if ( $request->hasFile( 'profile_photo' ) ) {
            if ($employee->profile_photo) {
                $existingPath = str_replace('storage/', '', $employee->profile_photo);
                $folderPath = dirname($existingPath);
                Storage::disk('public')->deleteDirectory($folderPath);
            }
            $file = $request->file( 'profile_photo' );
            $firstName = ucfirst( Str::slug( $request->first_name ) );
            $lastName = ucfirst( Str::slug( $request->last_name ?? '' ) );
            $uniqueId = time();
            $folderName = "{$firstName}_{$lastName}_{$uniqueId}";
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $filePath = "employee_profile_photos/{$folderName}";
            $file->storeAs( $filePath, $filename, 'public' );
            $employee->profile_photo = "storage/{$filePath}/{$filename}";
        }

        $employee->save();
        return redirect()->back()->with( 'msg', 'Employee updated successfully.' );
    }

    public function destroy( string $id ) {
        $employee = User::where( 'secure_id', $id )->first();
        if ( Auth::id() == $employee->id ) {
            return back()->with( 'error', 'You cannot delete your own account.' );
        }
        $employee->delete();
        return back()->with( 'msg', 'Employee deleted successfully.' );
    }
}
