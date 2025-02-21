<?php

namespace App\Http\Controllers\Admin;

use App\Models\CompanyName;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanyNameController extends Controller
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
        return view('admin.company_names.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyNameRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CompanyName $companyName)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CompanyName $companyName)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CompanyName $companyName)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CompanyName $companyName)
    {
        //
    }
}
