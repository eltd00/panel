<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsDemoSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'read']);
        Permission::create(['name' => 'delete']);
        Permission::create(['name' => 'update']);
        Permission::create(['name' => 'create']);

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'user']);
        $role1->givePermissionTo('read');

        $role2 = Role::create(['name' => 'admin']);
        $role2->givePermissionTo('read');
        $role2->givePermissionTo('delete');
        $role2->givePermissionTo('update');
        $role2->givePermissionTo('create');

        $role3 = Role::create(['name' => 'manager']);
        $role3->givePermissionTo('read');
        $role3->givePermissionTo('update');
        // gets all permissions via Gate::before rule; see AuthServiceProvider

        // create demo users
        $user = \App\Models\User::factory()->create([
            'name' => 'User',
            'email' => 'user@test.com',
        ]);
        $user->assignRole($role1);

        $user = \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
        ]);
        $user->assignRole($role2);

        $user = \App\Models\User::factory()->create([
            'name' => 'manager',
            'email' => 'manager@test.com',
        ]);
        $user->assignRole($role3);
    }
}
