<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'create post']);
        Permission::create(['name' => 'edit own post']);
        Permission::create(['name' => 'delete own post']);
        Permission::create(['name' => 'view post']);

        Permission::create(['name' => 'create like']);
        Permission::create(['name' => 'delete own like']);

        Permission::create(['name' => 'create comment']);
        Permission::create(['name' => 'edit own comment']);
        Permission::create(['name' => 'delete own comment']);
        Permission::create(['name' => 'view comment']);

        Permission::create(['name' => 'delete any post']);
        Permission::create(['name' => 'delete any comment']);

        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo([
            'create post',
            'edit own post',
            'delete own post',
            'view post',
            'create like',
            'delete own like',
            'create comment',
            'edit own comment',
            'delete own comment',
            'view comment',
        ]);

        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo(Permission::all());
    }
}
