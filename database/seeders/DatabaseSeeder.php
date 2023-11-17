<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * @throws \Throwable
     */
    public function run(): void
    {
        //Transaction
        $this->command->info('Seeding database...');
        DB::beginTransaction();

        try {
            $this->call(RolesSeeder::class);
            $this->call(UserSeeder::class);
            $this->call(PostsSeeder::class);
        } catch (\Throwable $error) {
            DB::rollBack();

            throw $error;
        }

        DB::commit();
        $this->command->info('Seeding database completed');
    }
}
