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
    public function authenticatedAndHasPermissionUserCanDeleteCategory()
    {
        $category = Category::factory()->create();
        $this->loginUserWithPermission('delete-category');
        $response = $this->deleteJson($this->getDeleteCategoryRoute($category->id));

        $response->assertStatus(Response::HTTP_FOUND);
    }

    /** @test */
    public function authenticatedSuperAdminCanDeleteCategory()
    {
        $category = Category::factory()->create();
        $this->loginWithSuperAdmin();
        $response = $this->deleteJson($this->getDeleteCategoryRoute($category->id));

        $response->assertStatus(Response::HTTP_FOUND);
    }

    /** @test */
    public function unauthenticatedUserCanNotDeleteCategory()
    {
        $category = Category::factory()->create();
        $response = $this->deleteJson($this->getDeleteCategoryRoute($category->id));
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    /** @test */
    public function unauthenticatedSuperAdminCanNotDeleteCategory()
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
