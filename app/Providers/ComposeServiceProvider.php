<?php

namespace App\Providers;

use App\View\Compose\UserComposer;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
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
        view()->composer(['admin.users.index','admin.users.create','admin.users.edit','admin-new.users.index'], 'App\View\Compose\UserComposer');
        view()->composer(['admin.roles.edit'], 'App\View\Compose\PermissionComposer');
        view()->composer(['admin.roles.create'], 'App\View\Compose\PermissionComposer');
        view()->composer(['admin.roles.edit'], 'App\View\Compose\RoleComposer');
        view()->composer(['admin.categories.edit','admin.categories.index','admin.categories.create','admin.products.index'], 'App\View\Compose\CategoryComposer');
        view()->composer(['admin.products.index','admin.products.create','admin.products.edit'], 'App\View\Compose\ProductComposer');
        view()->composer(['layouts.dashboard'], 'App\View\Compose\DashboardComposer');
    }
}
