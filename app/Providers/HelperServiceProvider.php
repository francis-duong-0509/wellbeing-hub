<?php

namespace App\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $helperPath = app_path('Helpers');

        if (File::isDirectory($helperPath)) {
            $files = File::allFiles($helperPath);

            foreach ($files as $file) {
                require_once $file->getPathname();
            }
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
