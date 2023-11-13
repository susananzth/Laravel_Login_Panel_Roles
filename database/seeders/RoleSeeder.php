<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'title' => 'Super Admin',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Admin',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'User',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        Role::insert($roles);

        $admin_permissions = Permission::all();
        Role::findOrFail(1)->permissions()->sync($admin_permissions->pluck('id'));
        $user_permissions = $admin_permissions->filter(function ($permission) {
            $str = strpos($permission->title, 'index');
            if ($str !== false) {
                return true;
            } else {
                return false;
            }
        });
        Role::findOrFail(2)->permissions()->sync($user_permissions);
        $user_permissions = $admin_permissions->filter(function ($permission) {
            $str = strpos($permission->title, 'profile');
            if ($str !== false) {
                return true;
            } else {
                return false;
            }
        });
        Role::findOrFail(3)->permissions()->sync($user_permissions);
    }
}
