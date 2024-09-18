<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create Permissions
        Permission::create(['name' => 'view users']);





        // Create Roles and Assign Permissions
        $role1 = Role::create(['name' => 'customer']);
        $role2 = Role::create(['name' => 'agent']);
        $role3 = Role::create(['name' => 'help-admin']);
        $role4 = Role::create(['name' => 'Super-Admin']);

        $user = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
        ]);
        $user->assignRole($role4);

    }
}
