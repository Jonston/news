<?php

namespace App\Providers;

use App\Services\ImageService;
use Illuminate\Support\ServiceProvider;
use App\Services\PostService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(ImageService::class);
        $this->app->singleton(PostService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
