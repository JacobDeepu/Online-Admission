<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        Gate::authorize('view any role');

        $roles = Role::latest();
        $roles = $roles->paginate(10);

        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        Gate::authorize('create a role');

        $permissions = Permission::all();

        return view('roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        Gate::authorize('create a role');

        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $role = Role::create($validated);

        if (! empty($request->permissions)) {
            $role->givePermissionTo($request->permissions);
        }

        return redirect()->back()->banner('Role created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role): View
    {
        Gate::authorize('edit a role');

        $permissions = Permission::all();
        $roleHasPermissions = array_column(json_decode($role->permissions, true), 'id');

        return view('roles.edit', compact('role', 'permissions', 'roleHasPermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role): RedirectResponse
    {
        Gate::authorize('edit a role');

        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $role->update($validated);
        $permissions = $request->permissions ?? [];
        $role->syncPermissions($permissions);

        return redirect()->route('roles.index')->banner('Role updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role): RedirectResponse
    {
        Gate::authorize('delete a role');

        $role->delete();

        return redirect()->back()->banner('Role deleted successfully.');
    }
}
