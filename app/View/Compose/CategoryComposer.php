<?php

namespace App\View\Compose;

use App\Repositories\CategoryRepository;
use App\Services\CategoryService;
use Illuminate\View\View;

class CategoryComposer
{
    protected $categoryService;

    /**
     * Create a new profile composer.
     *
     * @param  \App\Repositories\MyUserRepository  $users
     * @return void
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('categoryParents', $this->categoryService->getParent());
        $view->with('categoryChildren', $this->categoryService->getChildren());
    }

}
