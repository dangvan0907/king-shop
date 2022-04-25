<?php

namespace Tests\Feature\Role;

use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class GetShowRoleTest extends TestCase
{
    /** @test */
    public function unauthenticated_user_can_not_get_single_role()
    {
        $role = Role::factory()->create();
        $response = $this->get($this->getShowRoleRoute($role->id));

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function authenticated_super_admin_can_get_single_role()
    {
        $this->loginWithSuperAdmin();
        $role = Role::factory()->create();
        $response = $this->get($this->getShowRoleRoute( $role->id));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('admin.roles.show');
        $response->assertSee($role->display_name);
    }

    /** @test */
    public function authenticated_super_admin_can_not_get_single_role_if_role_is_not_exist()
    {
        $this->loginWithSuperAdmin();
        $roleId = -1;
        $response = $this->get($this->getShowRoleRoute( $roleId));

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    /** @test */
    public function authenticated_user_have_permission_can_get_single_role()
    {
        $this->loginUserWithPermission('index-role');
        $role = Role::factory()->create();
        $response = $this->get($this->getShowRoleRoute( $role->id));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('admin.roles.show');
        $response->assertSee($role->display_name);
    }

    /** @test */
    public function authenticated_user_have_permission_can_not_get_single_role_if_role_is_not_exist()
    {
        $this->loginUserWithPermission('index-role');
        $roleId = -1;
        $response = $this->get($this->getShowRoleRoute( $roleId));

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function getShowRoleRoute($id)
    {
        return route('roles.show', $id);
    }

}
