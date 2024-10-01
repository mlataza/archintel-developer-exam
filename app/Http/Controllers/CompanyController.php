<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Requests\CompanyStoreRequest;
use App\Http\Requests\CompanyUpdateRequest;
use Illuminate\Support\Facades\Redirect;
use App\Enums\CompanyStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Only allow editor to open this page
        if (!Auth::user()->is_editor) {
            return Redirect::route('dashboard')->with('status', 'Not allowed!');
        }

        return view('company.index', [
            'companies' => Company::latest()->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyStoreRequest $request)
    {
        // Only allow editor to open this page
        if (!Auth::user()->is_editor) {
            return Redirect::route('dashboard')->with('status', 'not-allowed');
        }

        // Create the company and upload the logo to the server
        $company = Company::create(array_merge(
            $request->validated(),
            [
                'logo' => $request->file('logo_path')->store('logos', 'public'),
                'status' => CompanyStatus::ACTIVE
            ]
        ));

        return Redirect::route('company.index')
            ->with('status', "Company $company->id created!")
            ->with('status-type', 'green');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        // Only allow editor to open this page
        if (!Auth::user()->is_editor) {
            return Redirect::route('dashboard')->with('status', 'Not allowed!');
        }

        return view('company.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyUpdateRequest $request, Company $company)
    {
        // Only allow editor to open this page
        if (!Auth::user()->is_editor) {
            return Redirect::route('dashboard')->with('status', 'Not allowed!');
        }

        // Update company detail
        $company->fill($request->validated());

        // If logo is specified, then delete the previous and upload the new one 
        if ($request->file('logo_path')) {
            $logoPath = $request->file('logo_path')->store('logos', 'public');
            Storage::disk('public')->delete($company->logo);
            $company->logo = $logoPath;
        }

        $company->save();

        return Redirect::route('company.index')
            ->with('status', "Company $company->id updated!")
            ->with('status-type', 'green');
    }
}
