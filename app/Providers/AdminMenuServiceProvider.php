<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class AdminMenuServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        // view()->composer('*', function ($view) {
        //     $routeName = request()->route()->getName();
        //     if ($routeName && Str::startsWith($routeName, 'prefix.')) {
        //         $view->with('routeName', $routeName);
        //     }
        // });
        view()->composer('*', function ($view) {
            $view->with([
                'routeName' => Route::currentRouteName(),
            ]);
        });
    }
}
