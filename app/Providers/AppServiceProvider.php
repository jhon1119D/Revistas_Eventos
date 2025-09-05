<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\FileManager; // si lo estás usando

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(FileManager::class, function () {
            return new FileManager();
        });
    }

    public function boot(): void
    {
        //
    }
}

