<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arrayOfPermissionNames = [
            'view an institution', 'create an institution', 'update an institution', 'delete an institution',
            'view any role', 'create a role', 'edit a role', 'delete a role',
            'view any user', 'create a user', 'edit a user', 'delete a user',
        ];
        $permissions = collect($arrayOfPermissionNames)->map(function ($permission) {
            return ['name' => $permission, 'guard_name' => 'sanctum'];
        });

        Permission::insert($permissions->toArray());
    }
}
