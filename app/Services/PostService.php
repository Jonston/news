<?php

namespace App\Services;

use App\Models\Image;
use App\Models\Post;
use App\Models\User;
use Faker\Factory as Faker;

class PostService
{
    protected ImageService $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function generate(User $author): Post
    {
        $faker = Faker::create();

        $width = 800;
        $height = 600;

        if (rand(0, 1)) {
            [$width, $height] = [$height, $width];
        }

        $image = $this->imageService->random($width, $height);
        $imageModel = $this->imageService->create($image, 'posts');

        $post = Post::create([
            'title' => $faker->sentence(rand(5, 7)),
            'content' => $faker->paragraph(rand(10, 20)),
            'author_id' => $author->id,
        ]);

        $post->previews()->attach($imageModel);

        return $post;
    }

    public function create(User $author, array $data): void
    {
        $post = Post::create([
            'title' => $data['title'],
            'content' => $data['content'],
            'author_id' => $author->id,
        ]);

        if ($data['preview']) {
            $image = Image::find($data['preview']);
            $image->move('posts/' . $image->name);

            $post->previews()->attach($image);
        }

        $post->save();
    }

    public function update(Post $post, array $data): void
    {
        $post->update([
            'title' => $data['title'],
            'content' => $data['content'],
        ]);

        if ($data['preview']) {
            $post->preview?->delete();

            $image = Image::find($data['preview']);
            $image->move('posts/' . $image->name);

            $post->previews()->attach($image);
        }

        $post->save();
    }

    /**
     * @param Post $post
     * @return bool
     */
    public function delete(Post $post): bool
    {
        return $post->delete();
    }
}
