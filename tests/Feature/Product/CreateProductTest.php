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
    public function authenticated_super_admin_can_create_new_product_if_data_is_valid()
    {
        $this->withExceptionHandling();
        $this->loginWithSuperAdmin();
        $dataCreated = Product::factory()->make()->toArray();
        $response = $this->post($this->getStoreProductRoute(), $dataCreated);
        $response->assertJson(fn(AssertableJson $json) =>
        $json->has('data', fn(AssertableJson $json) =>
        $json->where('name', $dataCreated['name'])
            ->etc())
            ->etc()
        );
    }

    /** @test */
    public function authenticated_super_admin_can_not_create_new_product_if_name_field_is_null()
    {
        $this->loginWithSuperAdmin();
        $dataCreate = Product::factory()->make(['name' => null])->toArray();
        $response = $this->postJson($this->getStoreProductRoute(), $dataCreate);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJson(fn(AssertableJson $json) =>
        $json->has('errors', fn(AssertableJson $json) =>
        $json->has('name'))
            ->etc()
        );
    }

    /** @test */
    public function authenticated_super_admin_can_not_create_new_product_if_price_field_is_null()
    {
        $this->loginWithSuperAdmin();
        $dataCreate = Product::factory()->make(['price' => null])->toArray();
        $response = $this->postJson($this->getStoreProductRoute(), $dataCreate);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJson(fn(AssertableJson $json) =>
        $json->has('errors', fn(AssertableJson $json) =>
        $json->has('price'))
            ->etc()
        );
    }

    /** @test */
    public function authenticated_super_admin_can_not_create_new_product_if_description_field_is_null()
    {
        $this->loginWithSuperAdmin();
        $dataCreate = Product::factory()->make(['description' => null])->toArray();
        $response = $this->postJson($this->getStoreProductRoute(), $dataCreate);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJson(fn(AssertableJson $json) =>
        $json->has('errors', fn(AssertableJson $json) =>
        $json->has('description'))
            ->etc()
        );
    }

    /** @test */
    public function authenticated_user_have_permission_can_create_new_product()
    {
        $this->loginUserWithPermission('store-product');
        $dataCreate = $this->_makeFactoryProduct();
        $response = $this->post($this->getStoreProductRoute(), $dataCreate);

        $response->assertJson(fn(AssertableJson $json) =>
        $json->has('data', fn(AssertableJson $json) =>
        $json->where('name', $dataCreate['name'])
            ->etc())
            ->etc()
        );
    }

    /** @test */
    public function authenticated_user_have_permission_can_not_create_new_product_if_name_null()
    {
        $this->loginUserWithPermission('store-product');
        $dataCreate = Product::factory()->make(['name' => null])->toArray();
        $response = $this->postJson($this->getStoreProductRoute(), $dataCreate);

        $response->assertJson(fn(AssertableJson $json) =>
        $json->has('errors', fn(AssertableJson $json) =>
        $json->has('name'))
            ->etc()
        );
    }

    /** @test */
    public function authenticated_user_have_permission_can_not_create_new_product_if_price_null()
    {
        $this->loginUserWithPermission('store-product');
        $dataCreate = Product::factory()->make(['price' => null])->toArray();
        $response = $this->postJson($this->getStoreProductRoute(), $dataCreate);

        $response->assertJson(fn(AssertableJson $json) =>
        $json->has('errors', fn(AssertableJson $json) =>
        $json->has('price'))
            ->etc()
        );
    }

    /** @test */
    public function authenticated_user_have_permission_can_not_create_new_product_if_description_null()
    {
        $this->loginUserWithPermission('store-product');
        $dataCreate = Product::factory()->make(['description' => null])->toArray();
        $response = $this->postJson($this->getStoreProductRoute(), $dataCreate);

        $response->assertJson(fn(AssertableJson $json) =>
        $json->has('errors', fn(AssertableJson $json) =>
        $json->has('description'))
            ->etc()
        );
    }

    /** @test */
    public function authenticated_not_authorize_user_can_not_create_new_cate()
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

    public function _makeFactoryProduct()
    {
        return Product::factory()->make()->toArray();
    }

}
