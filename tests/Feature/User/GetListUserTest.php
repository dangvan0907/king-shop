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
    public function authenticatedSuperAdminCanGetAllUser()
    {
        $this->loginWithSuperAdmin();
        $user = User::factory()->create();
        $response = $this->get($this->getListUserRoute());

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('admin.users.index');
        $response->assertSee($user->name);
    }

    /** @test  */
    public function authenticatedUserHavePermissionCanGetAllUser()
    {
        $this->loginUserWithPermission('index-user');
        $user = User::factory()->create();
        $response = $this->get($this->getListUserRoute());

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('admin.users.index');
        $response->assertSee($user->name);
    }

    /** @test  */
    public function unauthenticatedUserCanGetAllUser()
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
