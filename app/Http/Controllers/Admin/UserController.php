<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Str;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest  $request)
    {
        // dd("Hello!");
        do {
            $secureId = Str::uuid();
        } while (User::where('secure_id', $secureId)->exists());

        $user = new User();
        $user->secure_id = $secureId;
        $user->first_name = $request->first_name;
        if($request->last_name){
           $user->last_name = $request->last_name;
        }
        $user->profile_photo = $request->profile_photo;
        if($request->email){
             $user->email = $request->email;
        }
        $user->mobile = $request->mobile;
        $user->company_group_id = $request->company_group_id;
        $user->gender = $request->gender;
        $user->date_of_joining = $request->date_of_joining;
        $user->salary = $request->salary;
        $user->save();

        return redirect()->back()->with('success', 'Employee created successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
