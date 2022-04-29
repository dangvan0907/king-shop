<?php

namespace Tests\Feature\Role;

use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class GetListRoleTest extends TestCase
{
    /** @test */
    public function authenticated_super_admin_can_get_all_roles()
    {
        $this->loginWithSuperAdmin();
        $role = Role::factory()->create();
        $response = $this->get($this->getListRoleRoute());

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('admin.roles.index');
        $response->assertSee($role->display_name);
    }

    /** @test */
    public function authenticated_user_have_permission_can_get_all_roles()
    {
        $this->loginUserWithPermission('index-role');
        $role = Role::factory()->create();
        $response = $this->get($this->getListRoleRoute());

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('admin.roles.index');
        $response->assertSee($role->display_name);
    }

    /** @test  */
    public function unauthenticated_user_can_not_get_all_roles()
    {
        $response =  $this->get($this->getListRoleRoute());
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(route('login'));
    }

    public function getListRoleRoute()
    {
        return route('roles.index');
    }
}
