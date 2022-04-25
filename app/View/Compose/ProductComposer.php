<?php

namespace App\View\Composers;

use App\Repositories\CategoryRepository;
use App\Services\CategoryService;
use App\Services\ProductService;
use Illuminate\View\View;

class ProductComposer
{
    protected $productService;
    protected $categoryService;
    /**
     * Create a new profile composer.
     *
     * @param  \App\Repositories\MyUserRepository  $users
     * @return void
     */
    public function __construct(ProductService $productService, CategoryService $categoryService)
    {
        $this->productService = $productService;
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
        $view->with('categories', $this->categoryService->getAll());
    }

}
