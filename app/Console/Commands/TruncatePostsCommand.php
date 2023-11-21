<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;

class TruncatePostsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:truncate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete all posts';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('Truncate posts...');

        $posts = Post::all();

        foreach ($posts as $post) {
            $post->delete();
        }

        //truncate posts table
        Post::truncate();

        $this->info('Posts truncated!');
    }
}
