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
    public function authenticated_super_admin_can_delete_user()
    {
        $this->loginWithSuperAdmin();
        $user =  User::factory()->create();
        $response = $this->delete($this->getDeleteUserRoute($user->id));
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(route('users.index'));
        $this->assertDatabaseMissing('users', $user->toArray());
    }

    /** @test */
    public function authenticated_super_admin_can_not_delete_user_if_user_is_exist()
    {
        $this->loginWithSuperAdmin();
        $userId = -1;
        $response = $this->delete($this->getDeleteUserRoute($userId));
        $response->assertStatus(Response::HTTP_FOUND);
    }

    /** @test */
    public function unauthenticated_super_admin_can_not_delete_user()
    {
        $user =  User::factory()->create();
        $response = $this->delete($this->getDeleteUserRoute($user->id));
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function authenticated_user_have_permission_can_delete_user()
    {
        $this->loginUserWithPermission('delete-user');
        $user =  User::factory()->create();
        $response = $this->delete($this->getDeleteUserRoute($user->id));
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(route('users.index'));
        $this->assertDatabaseMissing('users', $user->toArray());
    }

    /** @test */
    public function authenticated_user_have_permission_can_not_delete_user_if_user_is_exist()
    {
        $this->loginUserWithPermission('delete-user');
        $userId = -1;
        $response = $this->delete($this->getDeleteUserRoute($userId));
        $response->assertStatus(Response::HTTP_FOUND);
    }

    /** @test */
    public function authenticated_user_can_not_delete_user()
    {
        $this->loginWithUser();
        $user =  User::factory()->create();
        $response = $this->delete($this->getDeleteUserRoute($user->id));
        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /** @test */
    public function unauthenticated_user_have_permission_can_not_delete_user()
    {
        $user =  User::factory()->create();
        $response = $this->delete($this->getDeleteUserRoute($user->id));
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(route('login'));
    }

    public function getDeleteUserRoute($id)
    {
        return route('users.destroy', $id);
    }

}
