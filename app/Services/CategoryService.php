<?php

namespace App\Services;

use App\Repositories\CategoryRepository;

class CategoryService
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function count()
    {
        return $this->categoryRepository->count();
    }

    public function search($request)
    {
        $dataSearch = $request->all();
        $dataSearch['parent_id'] = $request->parent_id != '' ? $request->parent_id : '';
        $dataSearch['name'] = $request->name ?? '';
        return $this->categoryRepository->search($dataSearch)->appends($request->all());
    }

    public function destroy($id)
    {
        return $this->categoryRepository->delete($id);
    }

    public function create($request)
    {
        $dataCreate = $request->all();
        $dataCreate['parent_id'] = $request->parent_id ?? null;
        $dataCreate['name'] = $request->name ?? '';
        return $this->categoryRepository->create($dataCreate);
    }

    public function update($request, $id)
    {
        $dataUpdate = $request->all();
        $dataUpdate['parent_id'] = $request->parent_id ?? '';
        $dataUpdate['name'] = $request->name ?? '';
        return $this->categoryRepository->update($dataUpdate, $id);
    }

    public function findById($id)
    {
        return $this->categoryRepository->find($id);
    }

    public function getAll()
    {
        return $this->categoryRepository->all();
    }

    public function getParent()
    {
        return $this->categoryRepository->getParent();
    }

    public function getChildren()
    {
        return $this->categoryRepository->getChildren();
    }
}
