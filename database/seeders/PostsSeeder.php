<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Services\ImageService;

class PostsSeeder extends Seeder
{
    public function __construct()
    {
        $this->imageService = new ImageService();
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $amount = 30;

        $this->command->info('Seeding posts...');
        $this->command->getOutput()->progressStart($amount);

        //Создай 10 постов с помощью фабрики и faker.Для превью используй unsplash.com
        $admin = User::where('email', 'admin@admin.admin')->first();

        if ( ! $admin) {
            throw new Exception('user with email admin@admin.admin not found');
        }

        $faker = Faker::create();

        for ($i = 0; $i < $amount; $i++) {
            $this->command->getOutput()->progressAdvance();

            $width = 800;
            $height = 600;

            if (rand(0, 1)) {
                [$width, $height] = [$height, $width];
            }

            //delay 1 second for api unsplash
            sleep(1);

            $image = $this->imageService->random($width, $height);
            $preview = $this->imageService->save($image, 'posts/' . uniqid() . '.jpg');

            Post::create([
                'preview' => $preview,
                'title' => $faker->sentence(rand(5, 7)),
                'content' => $faker->paragraph(rand(10, 20)),
                'author_id' => $admin->id,
            ]);
        }

        $this->command->info('Posts seeded!');
        $this->command->getOutput()->progressFinish();
    }
}
