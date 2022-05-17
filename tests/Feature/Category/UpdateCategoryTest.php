<?php

namespace Tests\Feature\Category;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class UpdateCategoryTest extends TestCase
{
    /** @test  */
    public function authenticated_super_admin_can_see_form_edit_category()
    {
        $this->loginWithSuperAdmin();
        $category = Category::factory()->create();
        $response = $this->get($this->getEditCategoryRoute($category->id));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('admin.categories.edit');
    }

    /** @test  */
    public function authenticated_super_admin_can_edit_category()
    {
        $this->loginWithSuperAdmin();
        $category = Category::factory()->create();
        $dataUpdate = $this->_makeFactoryCategory();
        $response = $this->put($this->getUpdateCategoryRoute($category->id), $dataUpdate);

        $response->assertStatus(Response::HTTP_FOUND);
        $this->assertDatabaseHas('categories', ['name'=>$dataUpdate['name'],'parent_id'=>$dataUpdate['parent_id']]);
        $response->assertRedirect(route('categories.index'));
    }

    /** @test  */
    public function authenticated_user_have_permission_can_edit_category()
    {
        $this->loginUserWithPermission('update-category');
        $category = Category::factory()->create();
        $dataUpdate = $this->_makeFactoryCategory();
        $response = $this->put($this->getUpdateCategoryRoute($category->id), $dataUpdate);

        $response->assertStatus(Response::HTTP_FOUND);
        $this->assertDatabaseHas('categories', ['name'=>$dataUpdate['name'],'parent_id'=>$dataUpdate['parent_id']]);
        $response->assertRedirect(route('categories.index'));
    }

    /** @test  */
    public function authenticated_super_admin_can_not_update_category_if_name_null()
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

    /** @test  */
    public function authenticated_user_have_permission_can_not_update_category_if_name_null()
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

    /** @test  */
    public function authenticated_super_admin_can_see_text_error_update_category_if_name_null()
    {
        $this->loginWithSuperAdmin();
        $category = Category::factory()->create();
        $dataUpdate = Category::factory()->make([
            'id' => $category->id,
            'name' => null
        ])->toArray();
        $response = $this->from($this->getEditCategoryRoute($category->id))->put($this->getUpdateCategoryRoute($category->id), $dataUpdate);

        $response->assertSessionHasErrors('name');
    }

    /** @test  */
    public function authenticated_user_have_permission_can_see_text_error_update_category_if_name_null()
    {
        $this->loginUserWithPermission('update-category');
        $category = Category::factory()->create();
        $dataUpdate = Category::factory()->make([
            'id' => $category->id,
            'name' => null
        ])->toArray();
        $response = $this->from($this->getEditCategoryRoute($category->id))->put($this->getUpdateCategoryRoute($category->id), $dataUpdate);

        $response->assertSessionHasErrors('name');
    }

    /** @test  */
    public function unauthenticated_user_cannot_edit_category()
    {
        $category = Category::factory()->create();
        $dataUpdate = $this->_makeFactoryCategory();
        $response = $this->put($this->getUpdateCategoryRoute($category->id), $dataUpdate);

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(route('login'));
    }

    /** @test  */
    public function unauthenticated_user_can_not_see_form_edit_category()
    {
        $category = Category::factory()->create();
        $response = $this->get($this->getEditCategoryRoute($category->id));

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(route('login'));
    }

    public function getEditCategoryRoute($id)
    {
        return route('categories.edit' , $id);
    }

    public function getUpdateCategoryRoute($id)
    {
        return route('categories.update' , $id);
    }

    public function _makeFactoryCategory()
    {
        return Category::factory()->make()->toArray();
    }
}
