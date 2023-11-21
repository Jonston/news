<?php

namespace App\Providers;

use App\Helpers\LayoutHelper;
use Illuminate\Support\ServiceProvider;

class UserHelperServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(LayoutHelper::class, function ($app) {
            return new LayoutHelper();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
