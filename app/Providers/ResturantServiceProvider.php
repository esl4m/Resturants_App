<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ResturantServiceProvider extends ServiceProvider
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
        if (file_exists(storage_path('resturants.json'))) {
            $resturants = json_decode(file_get_contents(storage_path('resturants.json')), true);
            config(['resturants_obj' => $resturants]);
        }
    }
}
