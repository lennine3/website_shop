<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Cache;
use Modules\Setting\Entities\Setting;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //

        view()->composer(
            '*',
            function ($view) {
                $generals = Cache::rememberForever('generals_cache', function () {
                    $settings = (new Setting())->get_settings();
                    $generals = [];
                    if (count(@$settings) > 0) {
                        foreach ($settings as $setting) {
                            $generals[$setting->type] = unserialize($setting->data);
                        }
                    }
                    return $generals;
                });
                $logo = Cache::rememberForever('logo_path_cache', function () {
                    return show_logo();
                });
                $current_link = url()->current();
                $view->with([
                    'logo' => $logo,
                    'generals' => $generals,
                    'current_link'=>$current_link.'/',
                ]);
            }
        );
        Schema::defaultStringLength(191);
    }
}
