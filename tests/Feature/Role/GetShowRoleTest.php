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
    public function unauthenticatedUserCanNotGetSingleRole()
    {
        $role = Role::factory()->create();
        $response = $this->get($this->getShowRoleRoute($role->id));

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function authenticatedSuperAdminCanGetSingleRole()
    {
        $this->loginWithSuperAdmin();
        $role = Role::factory()->create();
        $response = $this->get($this->getShowRoleRoute($role->id));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('admin.roles.show');
        $response->assertSee($role->display_name);
    }

    /** @test */
    public function authenticatedSuperAdminCanNotGetSingleRoleIfRoleIsNotExist()
    {
        $this->loginWithSuperAdmin();
        $roleId = -1;
        $response = $this->get($this->getShowRoleRoute($roleId));

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    /** @test */
    public function authenticatedUserHavePermissionCanGetSingleRole()
    {
        $this->loginUserWithPermission('index-role');
        $role = Role::factory()->create();
        $response = $this->get($this->getShowRoleRoute($role->id));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('admin.roles.show');
        $response->assertSee($role->display_name);
    }

    /** @test */
    public function authenticatedUserHavePermissionCanNotGetSingleRoleIfRoleIsNotExist()
    {
        $this->loginUserWithPermission('index-role');
        $roleId = -1;
        $response = $this->get($this->getShowRoleRoute($roleId));

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function getShowRoleRoute($id)
    {
        return route('roles.show', $id);
    }
}
