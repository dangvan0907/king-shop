<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use App\Traits\HandleImage;

class ProductService
{
    use HandleImage;
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function count()
    {
        return $this->productRepository->count();
    }

    public function search($request)
    {
        $dataSearch = $this->getDataSearch($request);
        return $this->productRepository->search($dataSearch)->appends($request->all());
    }

    public function destroy($id)
    {
        return $this->productRepository->delete($id);
    }

    public function create($request)
    {
        $dataCreate = $this->getDataCreate($request);
        $product = $this->productRepository->create($dataCreate);
        $product->assignCategories($dataCreate['category_ids']);
        $imageName = $this->saveImage($request);
        $product->update(['image' => $imageName]);
        return $product;
    }

    public function update($request, $id)
    {
        $product = $this->findById($id);
        $dataUpdate = $request->all();
        $product->update($dataUpdate);
        $dataUpdate['category_ids'] = $request->category_ids ?? [];
        $product->syncCategories($dataUpdate['category_ids']);
        $imageName = $this->updateImage($request, $product->image);
        $product->update(['image' => $imageName]);
        return $product;
    }

    public function delete($id)
    {
        $product = $this->findById($id);
        $product->delete();
        $this->deleteImage($product->image);
        return $product;
    }

    public function findById($id)
    {
        return $this->productRepository->find($id);
    }

    /**
     * @param $request
     * @return mixed
     */
    public function getDataSearch($request)
    {
        $dataSearch = $request->all();
        $dataSearch['category_id'] = $request->category_id != "0" ? $request->category_id : '';
        $dataSearch['name'] = $request->name ?? '';
        $dataSearch['min_price'] = $request->min_price ?? '';
        $dataSearch['max_price'] = $request->max_price ?? '';
        return $dataSearch;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function getDataCreate($request)
    {
        $dataCreate = $request->all();
        $dataCreate['category_ids'] = $request->category_ids ?? [];
        return $dataCreate;
    }
}
