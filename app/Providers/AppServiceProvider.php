<?php

namespace App\Providers;

use App\Category;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // added so as to prevent db string error
        Schema::defaultStringlength(191);
        // categories
        view()->composer(['*'], function ($view) {
            $view->with('categories', Category::orderBy('name')->get());
        });

        // Setting timezone
        date_default_timezone_set('Africa/Lagos');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
