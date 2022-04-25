<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Resources\ProductResource;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        return view('admin.products.index');
    }

    public function list(Request $request)
    {
        $products = $this->productService->search($request);
        return view('admin.products.list', compact('products'))->render();
    }

    public function show($id)
    {
        $productResource = $this->getResourceById($id);
        return $this->sendSuccessResponse($productResource, 'Thanh cong', Response::HTTP_OK);
    }

    public function store(ProductCreateRequest $request)
    {
        $product = $this->productService->create($request);
        $productResource = $this->getResource($product);
        return $this->sendSuccessResponse($productResource, 'Create success', Response::HTTP_CREATED);
    }

    public function edit($id)
    {
        $productResource = $this->getResourceById($id);
        return $this->sendSuccessResponse($productResource, 'Success', Response::HTTP_OK);
    }

    public function update(ProductUpdateRequest $request, $id)
    {
        $product = $this->productService->update($request, $id);
        $productResource = $this->getResource($product);
        return $this->sendSuccessResponse($productResource, 'Update success', Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $product = $this->productService->delete($id);
        $productResource = $this->getResource($product);
        return $this->sendSuccessResponse($productResource, 'Delete success!', Response::HTTP_OK);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->productService->findById($id);
    }

    /**
     * @param $product
     * @return ProductResource
     */
    public function getResource($product): ProductResource
    {
        return new ProductResource($product);
    }

    /**
     * @param $id
     * @return ProductResource
     */
    public function getResourceById($id): ProductResource
    {
        $product = $this->getById($id);
        return $this->getResource($product);
    }
}
