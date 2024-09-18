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
        Permission::create(['name' => 'attach category to articles']);
        Permission::create(['name' => 'detach category from articles']);
        Permission::create(['name' => 'publish articles']);
        Permission::create(['name' => 'unpublish articles']);

        // Categories Permissions
        Permission::create(['name' => 'read categories']);
        Permission::create(['name' => 'edit categories']);
        Permission::create(['name' => 'create categories']);
        Permission::create(['name' => 'delete categories']);
        Permission::create(['name' => 'attach article to categories']);
        Permission::create(['name' => 'detach article from categories']);

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
            ->givePermissionTo('read categories')
            ->givePermissionTo('read articles');

        // Agent
        Role::create(['name' => 'agent'])
            ->givePermissionTo('read faqs')
            ->givePermissionTo('read categories')
            ->givePermissionTo('read articles')
            ->givePermissionTo('create faqs')
            ->givePermissionTo('create articles')
            ->givePermissionTo('edit faqs')
            ->givePermissionTo('edit articles')
            ->givePermissionTo('attach category to articles')
            ->givePermissionTo('detach category from articles');

        // Helpdesk Admin
        Role::create(['name' => 'helpdesk admin'])
            ->givePermissionTo('read faqs')
            ->givePermissionTo('read categories')
            ->givePermissionTo('read articles')
            ->givePermissionTo('create faqs')
            ->givePermissionTo('create articles')
            ->givePermissionTo('edit faqs')
            ->givePermissionTo('edit articles')
            ->givePermissionTo('attach category to articles')
            ->givePermissionTo('detach category from articles')
            ->givePermissionTo('publish faqs')
            ->givePermissionTo('unpublish faqs')
            ->givePermissionTo('create categories')
            ->givePermissionTo('edit categories')
            ->givePermissionTo('publish articles')
            ->givePermissionTo('unpublish articles');
    }
}
