<?php

declare(strict_types=1);

namespace Thtocha\ContactsPackage;

use Illuminate\Support\ServiceProvider;

class ContactsPackageServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Register any services that your package provides here.
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'contacts-package');
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }
}