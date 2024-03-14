<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $owner = User::create([
            'name' => 'Owner',
            'email' => 'owner@gmail.com',
            'password' => Hash::make('owner'),
        ]);

        $role_admin = Role::updateOrCreate(
            [
                'name' => 'admin'
            ]
        );

        $role_owner = Role::updateOrCreate(
            [
                'name' => 'owner'
            ]
        );

        $owner->assignRole('owner');

        $permission_for_admin = Permission::updateOrCreate(['name' => 'view_for_admin']);

        $permission_for_owner = Permission::updateOrCreate(['name' => 'view_for_owner']);
        $role_owner->givePermissionTo($permission_for_owner);

    }
}
