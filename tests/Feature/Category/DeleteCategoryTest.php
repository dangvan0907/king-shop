<?php

namespace Tests\Feature\Category;

use App\Models\Category;
use Illuminate\Http\Response;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class DeleteCategoryTest extends TestCase
{
    /** @test */
    public function authenticated_and_has_permission_user_can_delete_category()
    {
        $category = Category::factory()->create();
        $this->loginUserWithPermission('delete-category');
        $response = $this->deleteJson($this->getDeleteCategoryRoute($category->id));

        $response->assertStatus(Response::HTTP_FOUND);
    }

    /** @test */
    public function authenticated_super_admin_can_delete_category()
    {
        $category = Category::factory()->create();
        $this->loginWithSuperAdmin();
        $response = $this->deleteJson($this->getDeleteCategoryRoute($category->id));

        $response->assertStatus(Response::HTTP_FOUND);
    }

    /** @test */
    public function unauthenticated_user_can_not_delete_category()
    {
        $category = Category::factory()->create();
        $response = $this->deleteJson($this->getDeleteCategoryRoute($category->id));
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    /** @test */
    public function unauthenticated_super_admin_can_not_delete_category()
    {
        $category = Category::factory()->create();
        $response = $this->deleteJson($this->getDeleteCategoryRoute($category->id));

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    public function getDeleteCategoryRoute($id)
    {
        return route('categories.destroy', $id);
    }
}
