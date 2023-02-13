<?php

namespace Database\Seeders;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'view devides']);
        Permission::create(['name' => 'create devides']);
        Permission::create(['name' => 'edit devides']);
        Permission::create(['name' => 'delete devides']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'delete users']);
        Permission::create(['name' => 'ban users']);
        Permission::create(['name' => 'view reports']);

        // create roles and assign created permissions

        // user
        $role = Role::create(['name' => 'user']);
        $role->givePermissionTo(['view devides']);

        // moderator
        $role = Role::create(['name' => 'moderator']);
        $role->givePermissionTo(['view devides', 'view users', 'edit users', 'ban users']);

        // super-admin
        $role = Role::create(['name' => 'super-admin']);
        $role->givePermissionTo(Permission::all());

        // banned
        $role = Role::create(['name' => 'banned']);
    }
}
