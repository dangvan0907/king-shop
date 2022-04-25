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
    public function search($request)
    {
        $dataSearch = $request->all();
        $dataSearch['parent_id'] = $request->parent_id ?? '';
        $dataSearch['name'] = $request->name ?? '';
        return $this->categoryRepository->getParentCategories()->search($dataSearch)->appends($request->all());
    }
    public function destroy($id){
        return $this->categoryRepository->delete($id);
    }
    public function create($request){
        $dataCreate=$request->all();
        $dataCreate['parent_id']=$request->parent_id??null;
        $dataCreate['name']=$request->name??null;
//        dd($dataCreate);
        return $this->categoryRepository->create($dataCreate);
    }
    public function update($request, $id){
        $dataUpdate=$request->all();
        $dataUpdate['parent_id']=$request->parent_id??null;
        $dataUpdate['name']=$request->name??'';
        return $this->categoryRepository->update($dataUpdate,$id);
    }
    public function findById($id){
        return $this->categoryRepository->find($id);
    }
    public function getParentCategories(){
        return $this->categoryRepository->getParentCategories();
    }
    public function getChildrenCategories(){
        return $this->categoryRepository->getChildrenCategories();
    }
}

