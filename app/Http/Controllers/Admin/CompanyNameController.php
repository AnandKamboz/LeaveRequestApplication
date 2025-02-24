<?php

namespace App\Http\Controllers\Admin;

use App\Models\CompanyName;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyNameRequest;


class CompanyNameController extends Controller
{
    public function index()
    {
        // dd('Hello!');
        $companyNames = CompanyName::orderBy('company_name', 'asc')->get();
        return view('admin.company_names.index',compact('companyNames'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.company_names.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyNameRequest $request)
    {
        do {
            $secureId = Str::random(32);
        } while (CompanyName::where('secure_id', $secureId)->exists());
        
        $companyName = new CompanyName();
        $companyName->secure_id = $secureId;
        $companyName->company_name = $request->company_name;
        if($request->description){
           $companyName->description = $request->description;
        }
        $companyName->save();
        return redirect()->back()->with('msg', 'Company Name created successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request,$id)
    {
        $companyName = CompanyName::where('secure_id',$id)->first();
        return view('admin.company_names.edit',compact('companyName'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $companyName = CompanyName::where('secure_id',$id)->first();
        $companyName->company_name = $request->company_name;
        if($companyName->description){
            $companyName->description = $request->description;
        }
        $companyName->save();
        return redirect()->route('admin.company-names.index')->with('msg', 'Company name updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,$id)
    {
        $companyName = CompanyName::where('secure_id',$id)->first();
        $companyName->delete();
        return redirect()->back()->with('msg', 'Company deleted successfully.');

    }
}
