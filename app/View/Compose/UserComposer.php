<?php

namespace App\View\Composers;

use App\Services\PermissionService;
use App\Services\RoleService;
use App\Services\UserService;
use Illuminate\View\View;

class UserComposer
{
    protected $permissionService;
    protected $roleService;

    /**
     * Create a new profile composer.
     *
     * @param  \App\Repositories\MyUserRepository  $users
     * @return void
     */
    public function __construct(PermissionService $permissionService, RoleService $roleService)
    {
        $this->permissionService = $permissionService;
        $this->roleService = $roleService;
    }

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
//        $view->with('users', $this->userService->getAllUser());
        $view->with('roles', $this->roleService->getAllRole());
    }
}
