<?php

namespace Tests\Feature\Category;

use App\Models\Category;
use Illuminate\Http\Response;
use Tests\TestCase;

class CreateCategoryTest extends TestCase
{
    /** @test */
    public function authenticatedSuperAdminCanCreateCategory()
    {
        $this->loginWithSuperAdmin();
        $dataCreate = $this->makeFactoryCategory();
        $response = $this->post($this->getStoreCategoryRoute(), $dataCreate);
        $response->assertStatus(Response::HTTP_FOUND);
        $this->assertDatabaseHas('categories', ['name' => $dataCreate]);
    }

    /** @test */
    public function unauthenticatedUserCanNotSeeCreateCategoryForm()
    {
        $response = $this->get($this->getCreateCategoryRoute());
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function authenticatedUserHavePermissionCanSeeCreateCategoryForm()
    {
        $this->loginUserWithPermission('create-category');
        $response = $this->get($this->getCreateCategoryRoute());

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('admin.categories.create');
    }

    /** @test */
    public function authenticatedUserCanNewCreateCategory()
    {
        $this->loginUserWithPermission('store-category');
        $dataCreate = $this->makeFactoryCategory();
        $response = $this->post($this->getStoreCategoryRoute(), $dataCreate);
        $response->assertStatus(Response::HTTP_FOUND);
        $this->assertDatabaseHas('categories', [
            'name' => $dataCreate['name'],
            'parent_id' => $dataCreate['parent_id']]);
        $response->assertRedirect(route('categories.index'));
    }

    /** @test */
    public function authenticatedUserHavePermissionCanNotNewCreateCategoryIfNameNull()
    {
        $this->loginUserWithPermission('store-category');
        $role = Category::factory()->make([
            'name' => null
        ])->toArray();
        $response = $this->post($this->getStoreCategoryRoute(), $role);

        $response->assertSessionHasErrors(['name']);
    }

    /** @test */
    public function authenticatedUserHavePermissionCanSeeTextErrorCreateCategoryIfNameNull()
    {
        $this->loginUserWithPermission('store-category');
        $role = Category::factory()->make([
            'name' => null
        ])->toArray();
        $response = $this->from($this->getCreateCategoryRoute())->post($this->getStoreCategoryRoute(), $role);

        $response->assertSessionHasErrors(['name']);
    }

    /** @test */
    public function authenticatedSupperAdminCanNotNewCreateCategoryIfNameNull()
    {
        $this->loginWithSuperAdmin();
        $role = Category::factory()->make([
            'name' => null
        ])->toArray();
        $response = $this->post($this->getStoreCategoryRoute(), $role);

        $response->assertSessionHasErrors(['name']);
    }

    /** @test */
    public function authenticatedSuperAdminCanSeeTextErrorCreateCategoryIfNameNull()
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

    public function makeFactoryCategory()
    {
        return Category::factory()->make()->toArray();
    }
}
