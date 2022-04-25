<?php

namespace App\View\Composers;

use App\Services\CategoryService;
use App\Services\ProductService;
use App\Services\RoleService;
use App\Services\UserService;
use Illuminate\View\View;

class DashboardComposer
{
    protected $userService;
    protected $roleService;
    protected $categoryService;
    protected $productService;
    /**
     * Create a new profile composer.
     *
     * @param  \App\Repositories\MyUserRepository  $users
     * @return void
     */
    public function __construct(UserService $userService,RoleService $roleService, CategoryService $categoryService, ProductService $productService)
    {
        $this->productService=$productService;
        $this->userService=$userService;
        $this->roleService=$roleService;
        $this->categoryService=$categoryService;
    }

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('userCount', $this->userService->count());
        $view->with('roleCount', $this->roleService->count());
        $view->with('productCount', $this->productService->count());
        $view->with('categoryCount', $this->categoryService->count());

    }

}
