<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // User
            ['id' => 1, 'title' => 'user_index', 'menu' => 'User', 'permission' => 'See', 'created_at' => now(), 'updated_at' => now(),],
            ['id' => 2, 'title' => 'user_add', 'menu' => 'User', 'permission' => 'Add', 'created_at' => now(), 'updated_at' => now(),],
            ['id' => 3, 'title' => 'user_edit', 'menu' => 'User', 'permission' => 'Edit', 'created_at' => now(), 'updated_at' => now(),],
            ['id' => 4, 'title' => 'user_delete', 'menu' => 'User', 'permission' => 'Delete', 'created_at' => now(), 'updated_at' => now(),],
            // Role
            ['id' => 5, 'title' => 'role_index', 'menu' => 'Role', 'permission' => 'See', 'created_at' => now(), 'updated_at' => now(),],
            ['id' => 6, 'title' => 'role_add', 'menu' => 'Role', 'permission' => 'Add', 'created_at' => now(), 'updated_at' => now(),],
            ['id' => 7, 'title' => 'role_edit', 'menu' => 'Role', 'permission' => 'Edit', 'created_at' => now(), 'updated_at' => now(),],
            ['id' => 8, 'title' => 'role_delete', 'menu' => 'Role', 'permission' => 'Delete', 'created_at' => now(), 'updated_at' => now(),],
            // Countries
            ['id' => 13, 'title' => 'country_index', 'menu' => 'Country', 'permission' => 'See', 'created_at' => now(), 'updated_at' => now(),],
            ['id' => 14, 'title' => 'country_add', 'menu' => 'Country', 'permission' => 'Add', 'created_at' => now(), 'updated_at' => now(),],
            ['id' => 15, 'title' => 'country_edit', 'menu' => 'Country', 'permission' => 'Edit', 'created_at' => now(), 'updated_at' => now(),],
            ['id'    => 16, 'title' => 'country_delete', 'menu' => 'Country', 'permission' => 'Delete', 'created_at' => now(), 'updated_at' => now(),],
            // States
            ['id' => 17, 'title' => 'state_index', 'menu' => 'State', 'permission' => 'See', 'created_at' => now(), 'updated_at' => now(),],
            ['id' => 18, 'title' => 'state_add', 'menu' => 'State', 'permission' => 'Add','created_at' => now(),'updated_at' => now(),],
            ['id' => 19, 'title' => 'state_edit', 'menu' => 'State', 'permission' => 'Edit', 'created_at' => now(), 'updated_at' => now(),],
            ['id' => 20, 'title' => 'state_delete', 'menu' => 'State', 'permission' => 'Delete', 'created_at' => now(), 'updated_at' => now(),],
            // City
            ['id' => 21, 'title' => 'city_index', 'menu' => 'City', 'permission' => 'See', 'created_at' => now(), 'updated_at' => now(),],
            ['id' => 22, 'title' => 'city_add', 'menu' => 'City', 'permission' => 'Add', 'created_at' => now(), 'updated_at' => now(),],
            ['id' => 23, 'title' => 'city_edit', 'menu' => 'City', 'permission' => 'Edit', 'created_at' => now(), 'updated_at' => now(),],
            ['id' => 24, 'title' => 'city_delete', 'menu' => 'City', 'permission' => 'Delete', 'created_at' => now(), 'updated_at' => now(),],
        ];

        Permission::insert($permissions);
    }
}
