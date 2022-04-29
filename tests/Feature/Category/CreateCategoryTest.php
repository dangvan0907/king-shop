<?php

namespace Tests\Feature\Category;

use App\Models\Category;
use Illuminate\Http\Response;
use Tests\TestCase;

class CreateCategoryTest extends TestCase
{
    /** @test */
    public function authenticated_super_admin_can_create_category()
    {
        $this->loginWithSuperAdmin();
        $dataCreate = $this->_makeFactoryCategory();
        $response = $this->post($this->getStoreCategoryRoute(), $dataCreate);
        $response->assertStatus(Response::HTTP_FOUND);
        $this->assertDatabaseHas('categories', ['name' => $dataCreate]);
    }

    /** @test */
    public function unauthenticated_user_can_not_see_create_category_form()
    {
        $response = $this->get($this->getCreateCategoryRoute());
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function authenticated_user_have_permission_can_see_create_category_form()
    {
        $this->loginUserWithPermission('create-category');
        $response = $this->get($this->getCreateCategoryRoute());

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('admin.categories.create');
    }

    /** @test */
    public function authenticated_user_can_new_create_category()
    {
        $this->loginUserWithPermission('store-category');
        $dataCreate = $this->_makeFactoryCategory();
        $response = $this->post($this->getStoreCategoryRoute(), $dataCreate);
        $response->assertStatus(Response::HTTP_FOUND);
        $this->assertDatabaseHas('categories', ['name' => $dataCreate['name'], 'parent_id' => $dataCreate['parent_id']]);
        $response->assertRedirect(route('categories.index'));
    }

    /** @test */
    public function authenticated_user_have_permission_can_not_new_create_category_if_name_null()
    {
        $this->loginUserWithPermission('store-category');
        $role = Category::factory()->make([
            'name' => null
        ])->toArray();
        $response = $this->post($this->getStoreCategoryRoute(), $role);

        $response->assertSessionHasErrors(['name']);
    }

    /** @test */
    public function authenticated_user_have_permission_can_see_text_error_create_category_if_name_null()
    {
        $this->loginUserWithPermission('store-category');
        $role = Category::factory()->make([
            'name' => null
        ])->toArray();
        $response = $this->from($this->getCreateCategoryRoute())->post($this->getStoreCategoryRoute(), $role);

        $response->assertSessionHasErrors(['name']);
    }

    /** @test */
    public function authenticated_supper_admin_can_not_new_create_category_if_name_null()
    {
        $this->loginWithSuperAdmin();
        $role = Category::factory()->make([
            'name' => null
        ])->toArray();
        $response = $this->post($this->getStoreCategoryRoute(), $role);

        $response->assertSessionHasErrors(['name']);
    }

    /** @test */
    public function authenticated_super_admin_can_see_text_error_create_category_if_name_null()
    {
        $this->loginWithSuperAdmin();
        $role = Category::factory()->make([
            'name' => null
        ])->toArray();
        $response = $this->from($this->getCreateCategoryRoute())->post($this->getStoreCategoryRoute(), $role);

        $response->assertSessionHasErrors(['name']);
    }

    public function getStoreCategoryRoute()
    {
        return route('categories.store');
    }

    public function getCreateCategoryRoute()
    {
        return route('categories.create');
    }

    public function _makeFactoryCategory()
    {
        return Category::factory()->make()->toArray();
    }
}
