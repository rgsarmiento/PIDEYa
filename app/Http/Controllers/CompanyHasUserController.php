<?php

namespace App\Http\Controllers;

use App\Models\Company_has_user;
use App\Http\Requests\StoreCompany_has_userRequest;
use App\Http\Requests\UpdateCompany_has_userRequest;

class CompanyHasUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCompany_has_userRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompany_has_userRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company_has_user  $company_has_user
     * @return \Illuminate\Http\Response
     */
    public function show(Company_has_user $company_has_user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company_has_user  $company_has_user
     * @return \Illuminate\Http\Response
     */
    public function edit(Company_has_user $company_has_user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCompany_has_userRequest  $request
     * @param  \App\Models\Company_has_user  $company_has_user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompany_has_userRequest $request, Company_has_user $company_has_user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company_has_user  $company_has_user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company_has_user $company_has_user)
    {
        //
    }
}
