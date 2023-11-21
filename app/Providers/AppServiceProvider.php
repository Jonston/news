<?php

namespace App\Providers;

use App\Services\ImageService;
use App\Services\ProfileService;
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
        $this->app->singleton(ProfileService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
