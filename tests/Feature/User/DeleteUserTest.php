<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class DeleteUserTest extends TestCase
{
    /** @test */
    public function authenticatedSuperAdminCanDeleteUser()
    {
        $this->loginWithSuperAdmin();
        $user = User::factory()->create();
        $response = $this->delete($this->getDeleteUserRoute($user->id));
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(route('users.index'));
        $this->assertDatabaseMissing('users', $user->toArray());
    }

    /** @test */
    public function authenticatedSuperAdminCanNotDeleteUserIfUserIsExist()
    {
        $this->loginWithSuperAdmin();
        $userId = -1;
        $response = $this->delete($this->getDeleteUserRoute($userId));
        $response->assertStatus(Response::HTTP_FOUND);
    }

    /** @test */
    public function unauthenticatedSuperAdminCanNotDeleteUser()
    {
        $user = User::factory()->create();
        $response = $this->delete($this->getDeleteUserRoute($user->id));
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function authenticatedUserHavePermissionCanDeleteUser()
    {
        $this->loginUserWithPermission('delete-user');
        $user = User::factory()->create();
        $response = $this->delete($this->getDeleteUserRoute($user->id));
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(route('users.index'));
        $this->assertDatabaseMissing('users', $user->toArray());
    }

    /** @test */
    public function authenticatedUserHavePermissionCanNotDeleteUserIfUserIsExist()
    {
        $this->loginUserWithPermission('delete-user');
        $userId = -1;
        $response = $this->delete($this->getDeleteUserRoute($userId));
        $response->assertStatus(Response::HTTP_FOUND);
    }

    /** @test */
    public function authenticatedUserCanNotDeleteUser()
    {
        $this->loginWithUser();
        $user = User::factory()->create();
        $response = $this->delete($this->getDeleteUserRoute($user->id));
        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /** @test */
    public function unauthenticatedUserHavePermissionCanNotDeleteUser()
    {
        $user = User::factory()->create();
        $response = $this->delete($this->getDeleteUserRoute($user->id));
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(route('login'));
    }

    public function getDeleteUserRoute($id)
    {
        return route('users.destroy', $id);
    }
}
