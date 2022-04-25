<?php

namespace Tests\Feature\Product;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;


class DeleteProductTest extends TestCase
{
    /** @test */
    public function authenticated_authorize_user_can_delete_product_if_record_is_exist()
    {
        $this->loginWithSuperAdmin();
        $cateCreated = Product::factory()->create()->toArray();
        $response = $this->delete($this->getDestroyProductRoute($cateCreated['id']));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson(fn(AssertableJson $json) =>
        $json->has('message')
            ->etc()
        );
    }

    /** @test */
    public function unauthenticated_user_can_not_delete_product()
    {
        $cateCreated = Product::factory()->create()->toArray();
        $response = $this->delete($this->getDestroyProductRoute($cateCreated['id']));
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function authenticated_not_authorize_user_can_not_delete_product()
    {
        $this->loginWithUser();
        $cateCreated = Product::factory()->create()->toArray();
        $response = $this->delete($this->getDestroyProductRoute($cateCreated['id']));
        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /** @test */
    public function unauthenticated_super_admin_can_not_delete_product()
    {
        $product = Product::factory()->create();
        $response = $this->delete($this->getDestroyProductRoute($product->id));

        $response->assertRedirect('/login');
        $response->assertStatus(Response::HTTP_FOUND);
    }

    public function getDestroyProductRoute($id)
    {
        return route('products.destroy', $id);
    }

}
