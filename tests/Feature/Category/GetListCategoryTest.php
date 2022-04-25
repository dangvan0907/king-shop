<?php

namespace Tests\Feature\Category;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;


class GetListCategoryTest extends TestCase
{
    /** @test  */
    public function authenticated_super_admin_can_get_all_category()
    {
        $this->loginWithSuperAdmin();
        $category = Category::factory()->create();
        $response = $this->get($this->getListCategoryRoute());

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('admin.categories.index');
        $response->assertSee($category->name);
    }

    /** @test */
    public function authenticated_user_can_get_list_category()
    {
        $this->loginUserWithPermission('index-category');
        $response = $this->get($this->getListCategoryRoute());

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('admin.categories.index');
    }

    /** @test */
    public function unauthenticated_user_can_not_get_list_category()
    {
        $response = $this->get(route('categories.index'));

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(route('login'));
    }

    public function getListCategoryRoute()
    {
        return route('categories.index');
    }

}
