<?php

namespace App\View\Composers;

use App\Services\PermissionService;
use App\Services\RoleService;
use Illuminate\View\View;

class PermissionComposer
{
    protected $permissionService;

    /**
     * Create a new profile composer.
     *
     * @param  \App\Repositories\MyUserRepository  $users
     * @return void
     */
    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService=$permissionService;
    }

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('permissionsRole', $this->permissionService->permissionWithName('role'));
        $view->with('permissionsUser', $this->permissionService->permissionWithName('user'));
        $view->with('permissionsProduct', $this->permissionService->permissionWithName('product'));
        $view->with('permissionsCategory', $this->permissionService->permissionWithName('category'));

    }
}
