<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\FileManager; // si lo estás usando
use Illuminate\Support\Facades\URL; // IMPORTANTE

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
        // Forzar HTTPS en producción
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
    }
}
