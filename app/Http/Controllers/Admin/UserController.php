<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\CompanyName;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreUserRequest;


class UserController extends Controller
{
    public function index()
    {
        $employees = User::all();
        
        return view('admin.user.index',compact('employees'));
    }

    public function create()
    {
        $employeeName = User::select('first_name','last_name')->get();
        return view('admin.user.create',compact('employeeName'));
    }

    public function store(StoreUserRequest  $request)
    {
        do {
            $secureId = Str::uuid();
        } while (User::where('secure_id', $secureId)->exists());

        $user = new User();
        $user->secure_id = $secureId;
        $user->first_name = $request->first_name;
        if($request->last_name){
           $user->last_name = $request->last_name;
        }

        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            $firstName = ucfirst(Str::slug($request->first_name));
            $lastName = ucfirst(Str::slug($request->last_name ?? ''));
            $uniqueId = time();
            $folderName = "{$firstName}_{$lastName}_{$uniqueId}";
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $filePath = "employee_profile_photos/{$folderName}";
            $file->storeAs($filePath, $filename, 'public');
            $user->profile_photo = "storage/{$filePath}/{$filename}"; 
        }
        
        if($request->email){
             $user->email = $request->email;
        }
        $user->mobile = $request->mobile;
        $user->company_group_id = $request->company_group_id;
        $user->gender = $request->gender;
        $user->date_of_joining = $request->date_of_joining;
        $user->salary = $request->salary;
        $user->save();

        return redirect()->back()->with('msg', 'Employee created successfully!');

    }

    public function show(string $id)
    {
        $employee = User::where('secure_id',$id)->first();
        $companyNames = CompanyName::all();
        return view('admin.user.show',compact('employee','companyNames'));
    }

    public function edit(string $id)
    {
        
    }

    public function update(Request $request, string $id)
    {
        
    }

    public function destroy(string $id)
    {
        $employee = User::where('secure_id',$id)->first();
        if (Auth::id() == $employee->id) {
           return back()->with('error', 'You cannot delete your own account.');
        }
         $employee->delete();
        return back()->with('msg', 'Employee deleted successfully.');

    }
}
