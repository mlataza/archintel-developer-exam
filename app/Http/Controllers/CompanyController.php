<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Requests\CompanyStoreRequest;
use App\Http\Requests\CompanyUpdateRequest;
use Illuminate\Support\Facades\Redirect;
use App\Enums\CompanyStatus;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('company.index', [
            'companies' => Company::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyStoreRequest $request)
    {
        // Upload the logo file to the server
        $logoPath = $request->file('logo')->store('logos', 'public');

        // Create the company
        Company::create([
            'name' => $request->validated()['name'],
            'logo' => $logoPath,
            'status' => CompanyStatus::ACTIVE
        ]);

        return Redirect::route('company.index')->with('status', 'company-created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        return view('company.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyUpdateRequest $request, Company $company)
    {
        $company->fill($request->validated());

        // If logo is specified, then delete the previous and upload the new one 
        if ($request->file('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
            Storage::delete($company->logo);
            $company->logo = $logoPath;
        }

        $company->save();

        return Redirect::route('company.index')->with('status', 'company-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        //
    }
}
