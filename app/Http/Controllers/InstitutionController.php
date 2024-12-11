<?php

namespace App\Http\Controllers;

use App\Models\Institution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class InstitutionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('view an institution');

        $institutions = Institution::latest();
        $institutions = $institutions->paginate(10);

        return view('institutions.index', compact('institutions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create an institution');

        return view('institutions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create an institution');

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'color_code' => 'required|string|max:255',
        ]);

        if ($request->hasFile('logo_file_path')) {
            $data['logo_file_path'] = $request->file('logo_file_path')->store('logos', 'public');
        }
        if ($request->hasFile('header_file_path')) {
            $data['header_file_path'] = $request->file('header_file_path')->store('headers', 'public');
        }

        Institution::create($data);

        return redirect()->back()->banner('Institution created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Institution $institution)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Institution $institution)
    {
        Gate::authorize('edit an institution');

        return view('institutions.edit', compact('institution'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Institution $institution)
    {
        Gate::authorize('edit an institution');

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'color_code' => 'required|string|max:255',
        ]);

        if ($request->hasFile('logo_file_path')) {
            $data['logo_file_path'] = $request->file('logo_file_path')->store('logos', 'public');
        }
        if ($request->hasFile('header_file_path')) {
            $data['header_file_path'] = $request->file('header_file_path')->store('headers', 'public');
        }

        $institution->update($data);

        return redirect()->route('institutions.index')->banner('Institution updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Institution $institution)
    {
        Gate::authorize('delete an institution');

        $institution->delete();

        return redirect()->back()->banner('Institution deleted successfully.');
    }
}
