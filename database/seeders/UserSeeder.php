<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Seeding users...');
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.admin',
            'password' => bcrypt('admin'),
        ]);

        $admin->assignRole('admin');

        $customer = User::create([
            'name' => 'customer',
            'email' => 'customer@customer.customer',
            'password' => bcrypt('customer'),
        ]);

        $customer->assignRole('customer');
        $this->command->info('Seeding users completed');
    }
}
