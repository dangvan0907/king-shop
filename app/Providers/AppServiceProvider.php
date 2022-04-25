<?php

namespace App\Providers;


use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        Blade::if('hasRole',function ($value){
            return auth()->check() && (auth()->user()->hasRoles($value) || auth()->user()->isSupperAdmin());
        });
        Blade::if('hasPermission',function ($value){
            return auth()->check() && (auth()->user()->hasPermission($value)|| auth()->user()->isSupperAdmin());
        });
    }
}
