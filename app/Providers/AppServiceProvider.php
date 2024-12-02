<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\View\Composers\MenuComposer;
use App\Models\Menu;
use App\Observers\MenuObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        // Register the Menu View Composer with the relevant view
        View::composer('elements.menu', MenuComposer::class);

        // Register the Menu Observer
        Menu::observe(MenuObserver::class);
    }
}
