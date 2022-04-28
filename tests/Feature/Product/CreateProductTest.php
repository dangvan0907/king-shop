<?php

namespace Tests\Feature\Product;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class CreateProductTest extends TestCase
{
    /** @test */
    public function authenticatedSuperAdminCanCreateNewProductIfDataIsValid()
    {
        $this->withExceptionHandling();
        $this->loginWithSuperAdmin();
        $dataCreated = Product::factory()->make()->toArray();
        $response = $this->post($this->getStoreProductRoute(), $dataCreated);
        $response->assertJson(fn(AssertableJson $json) =>
        $json->has('data', fn(AssertableJson $json) =>
        $json->where('name', $dataCreated['name'])
            ->etc())->etc());
    }

    /** @test */
    public function authenticatedSuperAdminCanNotCreateNewProductIfNameFieldIsNull()
    {
        $this->loginWithSuperAdmin();
        $dataCreate = Product::factory()->make(['name' => null])->toArray();
        $response = $this->postJson($this->getStoreProductRoute(), $dataCreate);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJson(fn(AssertableJson $json) =>
        $json->has('errors', fn(AssertableJson $json) =>
        $json->has('name'))->etc());
    }

    /** @test */
    public function authenticatedSuperAdminCanNotCreateNewProductIfPriceFieldIsNull()
    {
        $this->loginWithSuperAdmin();
        $dataCreate = Product::factory()->make(['price' => null])->toArray();
        $response = $this->postJson($this->getStoreProductRoute(), $dataCreate);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJson(fn(AssertableJson $json) =>
        $json->has('errors', fn(AssertableJson $json) =>
        $json->has('price'))->etc());
    }

    /** @test */
    public function authenticatedSuperAdminCanNotCreateNewProductIfDescriptionFieldIsNull()
    {
        $this->loginWithSuperAdmin();
        $dataCreate = Product::factory()->make(['description' => null])->toArray();
        $response = $this->postJson($this->getStoreProductRoute(), $dataCreate);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJson(fn(AssertableJson $json) =>
        $json->has('errors', fn(AssertableJson $json) =>
        $json->has('description'))->etc());
    }

    /** @test */
    public function authenticatedUserHavePermissionCanCreateNewProduct()
    {
        $this->loginUserWithPermission('store-product');
        $dataCreate = $this->makeFactoryProduct();
        $response = $this->post($this->getStoreProductRoute(), $dataCreate);

        $response->assertJson(fn(AssertableJson $json) =>
        $json->has('data', fn(AssertableJson $json) =>
        $json->where('name', $dataCreate['name'])
            ->etc())->etc());
    }

    /** @test */
    public function authenticatedUserHavePermissionCanNotCreateNewProductIfNameNull()
    {
        $this->loginUserWithPermission('store-product');
        $dataCreate = Product::factory()->make(['name' => null])->toArray();
        $response = $this->postJson($this->getStoreProductRoute(), $dataCreate);

        $response->assertJson(fn(AssertableJson $json) =>
        $json->has('errors', fn(AssertableJson $json) =>
        $json->has('name'))->etc());
    }

    /** @test */
    public function authenticatedUserHavePermissionCanNotCreateNewProductIfPriceNull()
    {
        $this->loginUserWithPermission('store-product');
        $dataCreate = Product::factory()->make(['price' => null])->toArray();
        $response = $this->postJson($this->getStoreProductRoute(), $dataCreate);

        $response->assertJson(fn(AssertableJson $json) =>
        $json->has('errors', fn(AssertableJson $json) =>
        $json->has('price'))->etc());
    }

    /** @test */
    public function authenticatedUserHavePermissionCanNotCreateNewProductIfDescriptionNull()
    {
        $this->loginUserWithPermission('store-product');
        $dataCreate = Product::factory()->make(['description' => null])->toArray();
        $response = $this->postJson($this->getStoreProductRoute(), $dataCreate);

        $response->assertJson(fn(AssertableJson $json) =>
        $json->has('errors', fn(AssertableJson $json) =>
        $json->has('description'))
            ->etc());
    }

    /** @test */
    public function authenticatedNotAuthorizeUserCanNotCreateNewCate()
    {
        $this->loginWithUser();
        $dataCreate = Product::factory()->make()->toArray();
        $response = $this->post($this->getStoreProductRoute(), $dataCreate);

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function getCreateProductRoute()
    {
        return route('products.create');
    }

    public function getStoreProductRoute()
    {
        return route('products.store');
    }

    public function makeFactoryProduct()
    {
        return Product::factory()->make()->toArray();
    }
}
