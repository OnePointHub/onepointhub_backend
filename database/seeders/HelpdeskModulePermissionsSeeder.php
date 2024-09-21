<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class HelpdeskModulePermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Helpdesk Module Permissions

        // KB Articles Permissions
        Permission::create(['name' => 'read articles']);
        Permission::create(['name' => 'edit articles']);
        Permission::create(['name' => 'create articles']);
        Permission::create(['name' => 'delete articles']);
        Permission::create(['name' => 'publish articles']);
        Permission::create(['name' => 'unpublish articles']);

        // Categories Permissions
        PErmission::create(['name' => 'read categories']);
        Permission::create(['name' => 'edit categories']);
        Permission::create(['name' => 'create categories']);
        Permission::create(['name' => 'delete categories']);

        // FAQs Permissions
        Permission::create(['name' => 'read faqs']);
        Permission::create(['name' => 'edit faqs']);
        Permission::create(['name' => 'create faqs']);
        Permission::create(['name' => 'delete faqs']);
        Permission::create(['name' => 'publish faqs']);
        Permission::create(['name' => 'unpublish faqs']);

        // Helpdesk Module Roles

        // Customer
        Role::create(['name' => 'customer'])
            ->givePermissionTo('read faqs')
            ->givePermissionTo('read articles');

        // Agent
        Role::create(['name' => 'agent'])
            ->givePermissionTo('read categories')
            ->givePermissionTo('read faqs')
            ->givePermissionTo('read articles')
            ->givePermissionTo('create faqs')
            ->givePermissionTo('create articles')
            ->givePermissionTo('edit faqs')
            ->givePermissionTo('edit articles');

        // Helpdesk Admin
        Role::create(['name' => 'helpdesk admin'])
            ->givePermissionTo('read faqs')
            ->givePermissionTo('read articles')
            ->givePermissionTo('create faqs')
            ->givePermissionTo('create articles')
            ->givePermissionTo('edit faqs')
            ->givePermissionTo('edit articles')
            ->givePermissionTo('publish faqs')
            ->givePermissionTo('unpublish faqs')
            ->givePermissionTo('delete faqs')
            ->givePermissionTo('read categories')
            ->givePermissionTo('create categories')
            ->givePermissionTo('edit categories')
            ->givePermissionTo('publish articles')
            ->givePermissionTo('unpublish articles');
    }
}
