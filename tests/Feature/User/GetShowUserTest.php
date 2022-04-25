<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;


class GetShowUserTest extends TestCase
{
    /** @test */
    public function authenticated_user_can_see_user_detail_if_user_is_exist()
    {
        $this->loginWithSuperAdmin();
        $userCreated = User::factory()->create();
        $response = $this->get($this->getShowUserRoute($userCreated->id));
        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('admin.users.show');
    }

    /** @test */
    public function authenticated_user_can_not_see_user_detail_if_user_is_not_exist()
    {
        $this->loginWithSuperAdmin();
        $userId = -1;
        $response = $this->get($this->getShowUserRoute($userId));
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    /** @test */
    public function unauthenticated_user_can_not_see_user_detail()
    {
        $userCreated = User::factory()->create();
        $response = $this->get($this->getShowUserRoute($userCreated->id));
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(route('login'));
    }

    public function getShowUserRoute($id)
    {
        return route('users.show', $id);
    }

}
