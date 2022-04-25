<?php

namespace App\View\Compose;

use App\Services\PermissionService;
use App\Services\RoleService;
use App\Services\UserService;
use Illuminate\View\View;

class RoleComposer
{
    protected $roleService;
    protected $permissionService;
    /**
     * Create a new profile composer.
     *
     * @param  \App\Repositories\MyUserRepository  $users
     * @return void
     */
    public function __construct(RoleService $roleSersvice, PermissionService $permissionService)
    {
        $this->roleService = $roleSersvice;
        $this->permissionService = $permissionService;
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
