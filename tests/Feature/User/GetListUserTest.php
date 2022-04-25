<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class GetListUserTest extends TestCase
{
    /** @test  */
    public function authenticated_super_admin_can_get_all_user()
    {
        $this->loginWithSuperAdmin();
        $user = User::factory()->create();
        $response = $this->get($this->getListUserRoute());

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('admin.users.index');
        $response->assertSee($user->name);
    }

    /** @test  */
    public function authenticated_user_have_permission_can_get_all_user()
    {
        $this->loginUserWithPermission('index-user');;
        $user = User::factory()->create();
        $response = $this->get($this->getListUserRoute());

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('admin.users.index');
        $response->assertSee($user->name);
    }

    /** @test  */
    public function unauthenticated_user_can_get_all_user()
    {
        $response = $this->get($this->getListUserRoute());
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(route('login'));
    }

    public function getListUserRoute()
    {
        return route('users.index');
    }

}
