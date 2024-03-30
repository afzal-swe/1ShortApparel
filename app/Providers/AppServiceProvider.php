<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

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

        // Pagination Problem
        Paginator::useBootstrap();

        // Website Settings Information //

        $settings = DB::table('website_settings')->first();
        view()->share('settings', $settings); // this share file using any view file sections;

    }
}
