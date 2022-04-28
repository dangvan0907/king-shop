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
    public function authenticatedSuperAdminCanDeleteRole()
    {
        $this->loginWithSuperAdmin();
        $role = Role::factory()->create();
        $response = $this->delete($this->getDeleteRoleRoute($role->id));

        $response->assertStatus(Response::HTTP_FOUND);
        $this->assertDatabaseMissing('roles', $role->toArray());
        $response->assertRedirect(route('roles.index'));
    }

    /** @test */
    public function unauthenticatedUserCanNotDeleteRole()
    {
        $role = Role::factory()->create();
        $response = $this->delete($this->getDeleteRoleRoute($role->id));

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function authenticatedSuperAdminCanNotDeleteRoleIfRoleIsExist()
    {
        $this->loginWithSuperAdmin();
        $roleId = -1;
        $response = $this->delete($this->getDeleteRoleRoute($roleId));
        $response->assertStatus(Response::HTTP_FOUND);
    }

    /** @test */
    public function authenticatedUserHavePermissionCanDeleteRole()
    {
        $this->loginUserWithPermission('delete-role');
        $role = Role::factory()->create();
        $response = $this->delete($this->getDeleteRoleRoute($role->id));

        $response->assertStatus(Response::HTTP_FOUND);
        $this->assertDatabaseMissing('roles', $role->toArray());
        $response->assertRedirect(route('roles.index'));
    }

    /** @test */
    public function authenticatedUserHavePermissionCanNotDeleteRoleIfRoleIsExist()
    {
        $this->loginUserWithPermission('delete-role');
        $roleId = -1;
        $response = $this->delete($this->getDeleteRoleRoute($roleId));

        $response->assertStatus(Response::HTTP_FOUND);
    }

    public function getDeleteRoleRoute($id)
    {
        return route('roles.destroy', $id);
    }
}
