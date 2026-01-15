<?php

namespace App\Providers;

use A17\Twill\Facades\TwillNavigation;
use A17\Twill\View\Components\Navigation\NavigationLink;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        TwillNavigation::addLink(
            NavigationLink::make()->forModule('rooms')
        );

        // Livewire::setUpdateRoute(function ($handle) {
        //     return Route::post('/livewire/update', $handle)
        //         ->prefix(LaravelLocalization::setLocale())
        //         ->middleware('web');
        // });
    }
}
