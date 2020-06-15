<?php

namespace App\Providers;

use App\ViewComposers\SideBarComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
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
        // share will request database every single view
        // View::share('user', Auth::user());

        // on specific view with wildcards
        View::composer('layouts.frontend.partials.sidebar', SideBarComposer::class);
        // view()->composer(['guest.*', 'layouts.frontend.partial.sidebar'], SideBarComposer::class);
    }
}
