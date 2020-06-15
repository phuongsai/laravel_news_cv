<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class CustomPaginatorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        Paginator::defaultView('layouts.frontend.pagination.custom');
        Paginator::defaultSimpleView('layouts.frontend.pagination.custom_simple');
    }
}
