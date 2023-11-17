<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Seeding roles...');

        $viewPostList = Permission::create(['name' => 'view-post-list']);
        $viewPost = Permission::create(['name' => 'view-post']);
        $createPost = Permission::create(['name' => 'create-post']);
        $editPost = Permission::create(['name' => 'edit-post']);
        $deletePost = Permission::create(['name' => 'delete-post']);

        $editUser = Permission::create(['name' => 'edit-user']);
        $deleteUser = Permission::create(['name' => 'delete-user']);

        $adminRole = Role::create(['name' => 'admin']);
        //Admin can view, create, edit and delete posts
        $adminRole->givePermissionTo($viewPostList);
        $adminRole->givePermissionTo($viewPost);
        $adminRole->givePermissionTo($createPost);
        $adminRole->givePermissionTo($editPost);
        $adminRole->givePermissionTo($deletePost);

        $customerRole = Role::create(['name' => 'customer']);
        //Customer can view posts
        $adminRole->givePermissionTo($viewPostList);
        //Customer can edit and delete users
        $customerRole->givePermissionTo($editUser);
        $customerRole->givePermissionTo($deleteUser);

        $this->command->info('Seeding roles completed');
    }
}
