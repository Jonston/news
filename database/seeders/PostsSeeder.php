<?php

namespace Database\Seeders;

use App\Models\User;
use App\Services\PostService;
use Illuminate\Database\Seeder;

class PostsSeeder extends Seeder
{
    protected PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $amount = 1;

        $this->command->info('Seeding posts...');
        $this->command->newLine();
        $this->command->getOutput()->progressStart($amount);

        $admin = User::where('email', 'admin@admin.admin')->first();

        if ( ! $admin) {
            throw new Exception('user with email admin@admin.admin not found');
        }

        for ($i = 0; $i < $amount; $i++) {
            $this->command->getOutput()->progressAdvance();

            $this->postService->generate($admin);

            sleep(1);
        }

        $this->command->getOutput()->progressFinish();
        $this->command->info('Posts seeded!');
    }
}
