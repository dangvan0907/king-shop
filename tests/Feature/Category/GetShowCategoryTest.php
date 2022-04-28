<?php

namespace Tests\Feature\Role;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class GetShowCategoryTest extends TestCase
{
    /** @test */
    public function authenticatedSuperAdminCanSeeFormEditCategory()
    {
        $this->loginWithSuperAdmin();
        $category = Category::factory()->create();
        $response = $this->get($this->getEditCategoryRoute($category->id));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('admin.categories.edit');
    }

    /** @test */
    public function authenticatedSuperAdminCanEditCategory()
    {
        $this->loginWithSuperAdmin();
        $category = Category::factory()->create();
        $dataUpdate = $this->makeFactoryCategory();
        $response = $this->put($this->getUpdateCategoryRoute($category->id), $dataUpdate);

        $response->assertStatus(Response::HTTP_FOUND);
        $this->assertDatabaseHas('categories', [
            'name' => $dataUpdate['name'],
            'parent_id' => $dataUpdate['parent_id']]);
        $response->assertRedirect(route('categories.index'));
    }

    /** @test */
    public function authenticatedUserHavePermissionCanEditCategory()
    {
        $this->loginUserWithPermission('update-category');
        $category = Category::factory()->create();
        $dataUpdate = $this->makeFactoryCategory();
        $response = $this->put($this->getUpdateCategoryRoute($category->id), $dataUpdate);

        $response->assertStatus(Response::HTTP_FOUND);
        $this->assertDatabaseHas('categories', [
            'name' => $dataUpdate['name'],
            'parent_id' => $dataUpdate['parent_id']]);
        $response->assertRedirect(route('categories.index'));
    }

    /** @test */
    public function authenticatedSuperAdminCanNotUpdateCategoryIfNameNull()
    {
        $this->loginWithSuperAdmin();
        $category = Category::factory()->create();
        $dataUpdate = Category::factory()->make([
            'id' => $category->id,
            'name' => null
        ])->toArray();
        $response = $this->put($this->getUpdateCategoryRoute($category->id), $dataUpdate);

        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function authenticatedUserHavePermissionCanNotUpdateCategoryIfNameNull()
    {
        $this->loginUserWithPermission('update-category');
        $category = Category::factory()->create();
        $dataUpdate = Category::factory()->make([
            'id' => $category->id,
            'name' => null
        ])->toArray();
        $response = $this->put($this->getUpdateCategoryRoute($category->id), $dataUpdate);

        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function authenticatedSuperAdminCanSeeTextErrorUpdateCategoryIfNameNull()
    {
        $this->loginWithSuperAdmin();
        $category = Category::factory()->create();
        $dataUpdate = Category::factory()->make([
            'id' => $category->id,
            'name' => null
        ])->toArray();
        $response = $this->from($this->getEditCategoryRoute($category->id))->
        put($this->getUpdateCategoryRoute($category->id), $dataUpdate);

        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function authenticatedUserHavePermissionCanSeeTextErrorUpdateCategoryIfNameNull()
    {
        $this->loginUserWithPermission('update-category');
        $category = Category::factory()->create();
        $dataUpdate = Category::factory()->make([
            'id' => $category->id,
            'name' => null
        ])->toArray();
        $response = $this->from($this->getEditCategoryRoute($category->id))->
        put($this->getUpdateCategoryRoute($category->id), $dataUpdate);

        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function unauthenticatedUserCannotEditCategory()
    {
        $category = Category::factory()->create();
        $dataUpdate = $this->makeFactoryCategory();
        $response = $this->put($this->getUpdateCategoryRoute($category->id), $dataUpdate);

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function unauthenticatedUserCanNotSeeFormEditCategory()
    {
        $category = Category::factory()->create();
        $response = $this->get($this->getEditCategoryRoute($category->id));

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(route('login'));
    }

    public function getEditCategoryRoute($id)
    {
        return route('categories.edit', $id);
    }

    public function getUpdateCategoryRoute($id)
    {
        return route('categories.update', $id);
    }

    public function makeFactoryCategory()
    {
        return Category::factory()->make()->toArray();
    }
}
