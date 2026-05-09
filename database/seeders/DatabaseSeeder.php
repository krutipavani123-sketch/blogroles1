<?php

namespace Database\Seeders;

use  App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\login;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create Permissions
        Permission::create(['name' => 'create task', 'guard_name' => 'web']);
        Permission::create(['name' => 'view task', 'guard_name' => 'web']);
        Permission::create(['name' => 'update task', 'guard_name' => 'web']);
        Permission::create(['name' => 'delete task', 'guard_name' => 'web']);

        $admin = Role::create(['name' => 'admin', 'guard_name' => 'web']);
        $user = Role::create(['name' => 'user', 'guard_name' => 'web']);
        // Assign Permissions to Roles
        $admin->givePermissionTo(Permission::all());

        $user->givePermissionTo([
            'view task'
        ]);

        $admin = User::create([
            'name' => 'kruti',
            'email' => 'krutipavani123@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        $admin->assignRole('admin');

        //  User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
