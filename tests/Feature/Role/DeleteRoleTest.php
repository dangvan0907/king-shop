<?php

namespace Tests\Feature\Role;

use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class DeleteRoleTest extends TestCase
{
    /** @test */
    public function authenticated_super_admin_can_delete_role()
    {
        $this->loginWithSuperAdmin();
        $role = Role::factory()->create();
        $response = $this->delete($this->getDeleteRoleRoute($role->id));

        $response->assertStatus(Response::HTTP_FOUND);
        $this->assertDatabaseMissing('roles', $role->toArray());
        $response->assertRedirect(route('roles.index'));
    }

    /** @test */
    public function unauthenticated_user_can_not_delete_role()
    {
        $role = Role::factory()->create();
        $response = $this->delete($this->getDeleteRoleRoute($role->id));

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function authenticated_super_admin_can_not_delete_role_if_role_is_exist()
    {
        $this->loginWithSuperAdmin();
        $roleId = -1;
        $response = $this->delete($this->getDeleteRoleRoute($roleId));
        $response->assertStatus(Response::HTTP_FOUND);
    }

    /** @test */
    public function authenticated_user_have_permission_can_delete_role()
    {
        $this->loginUserWithPermission('delete-role');
        $role = Role::factory()->create();
        $response = $this->delete($this->getDeleteRoleRoute($role->id));

        $response->assertStatus(Response::HTTP_FOUND);
        $this->assertDatabaseMissing('roles', $role->toArray());
        $response->assertRedirect(route('roles.index'));
    }

    /** @test */
    public function authenticated_user_have_permission_can_not_delete_role_if_role_is_exist()
    {
        $this->loginUserWithPermission('delete-role');
        $roleId = -1;
        $response = $this->delete($this->getDeleteRoleRoute($roleId));

        $response->assertStatus(Response::HTTP_FOUND);
    }

    public function getDeleteRoleRoute($id)
    {
        return route('roles.destroy',$id);
    }
}
