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
    public function authenticated_super_admin_can_get_all_product()
    {
        $this->loginWithSuperAdmin();
        $response = $this->get($this->getListProductRoute());

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('admin.products.index');
    }


    /** @test */
    public function authenticated_user_have_permission_can_get_all_product()
    {
        $this->loginUserWithPermission('index-product');;
        $response = $this->get($this->getListProductRoute());

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('admin.products.index');
    }

    /** @test */
    public function unauthenticated_user_can_not_get_all_products()
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
