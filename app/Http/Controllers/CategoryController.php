<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Resources\CategoryResource;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        $categories = $this->categoryService->search($request);
        return view('admin.categories.index', compact('categories'));
    }

    public function children()
    {
        $categories = $this->categoryService->getChildren();
        return $this->sendSuccessResponse($categories, 'success', Response::HTTP_OK);
    }

    public function show($id)
    {
        $category = $this->getById($id);
        return view('admin.categories.show', compact('category'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(CategoryCreateRequest $request)
    {
        $this->categoryService->create($request);
        return redirect(route('categories.index'))->with('message', 'Create success!');
    }

    public function edit($id)
    {
        $category = $this->getById($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(CategoryUpdateRequest $request, $id)
    {
        $this->categoryService->update($request, $id);
        return redirect(route('categories.index'))->with('message', 'Update success!');
    }

    public function destroy($id)
    {
        $this->categoryService->destroy($id);
        return redirect(route('categories.index'))->with('message', 'Delete success!');
    }


    /**
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        $category = $this->categoryService->findById($id);
        return $category;
    }
}
