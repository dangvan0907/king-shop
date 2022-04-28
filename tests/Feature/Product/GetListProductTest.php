<?php

namespace Tests\Feature\Product;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class GetListProductTest extends TestCase
{
    /** @test */
    public function authenticatedSuperAdminCanGetAllProduct()
    {
        $this->loginWithSuperAdmin();
        $response = $this->get($this->getListProductRoute());

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('admin.products.index');
    }


    /** @test */
    public function authenticatedUserHavePermissionCanGetAllProduct()
    {
        $this->loginUserWithPermission('index-product');
        $response = $this->get($this->getListProductRoute());

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('admin.products.index');
    }

    /** @test */
    public function unauthenticatedUserCanNotGetAllProducts()
    {
        $response = $this->get($this->getListProductRoute());

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(route('login'));
    }

    public function getListProductRoute()
    {
        return route('products.index');
    }
}
