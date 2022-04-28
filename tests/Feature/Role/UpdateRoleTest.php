<?php

namespace Tests\Feature\Role;

use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class UpdateRoleTest extends TestCase
{
    /** @test  */
    public function authenticatedSuperAdminCanSeeFormEditRole()
    {
        $this->loginWithSuperAdmin();
        $role = Role::factory()->create();
        $response = $this->get($this->getEditRoleTest($role->id));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('admin.roles.edit');
    }

    /** @test  */
    public function authenticatedSuperAdminCanEditRole()
    {
        $this->loginWithSuperAdmin();
        $role = Role::factory()->create();
        $dataUpdate = $this->makeFactoryRole();
        $response = $this->put($this->getUpdateRoleTest($role->id), $dataUpdate);

        $response->assertStatus(Response::HTTP_FOUND);
        $this->assertDatabaseHas('roles', $dataUpdate);
        $response->assertRedirect(route('roles.index'));
    }

    /** @test  */
    public function authenticatedSuperAdminCanNotUpdateRoleIfNameNull()
    {
        $this->loginWithSuperAdmin();
        $role = Role::factory()->create();
        $dataUpdate = Role::factory()->make([
            'name' => null
        ])->toArray();
        $response = $this->put($this->getUpdateRoleTest($role->id), $dataUpdate);
        $response->assertSessionHasErrors('name');
    }

    /** @test  */
    public function authenticatedSuperAdminCanSeeTextErrorUpdateRoleIfNameNull()
    {
        $this->loginWithSuperAdmin();
        $role = Role::factory()->create();
        $dataUpdate = Role::factory()->make([
            'name' => null
        ])->toArray();
        $response = $this->from($this->getEditRoleTest($role->id))->
        put($this->getUpdateRoleTest($role->id), $dataUpdate);

        $response->assertSessionHasErrors('name');
    }

    /** @test  */
    public function authenticatedSuperAdminCanNotUpdateRoleIfDisplayNameNull()
    {
        $this->loginWithSuperAdmin();
        $role = Role::factory()->create();
        $dataUpdate = Role::factory()->make([
            'display_name' => null
        ])->toArray();
        $response = $this->put($this->getUpdateRoleTest($role->id), $dataUpdate);

        $response->assertSessionHasErrors('display_name');
    }

    /** @test  */
    public function authenticatedSuperAdminCanNotUpdateRoleIfNameAndDisplayNull()
    {
        $this->loginWithSuperAdmin();
        $role = Role::factory()->create();
        $dataUpdate = Role::factory()->make([
            'name' => null,
            'display_name' => null
        ])->toArray();
        $response = $this->put($this->getUpdateRoleTest($role->id), $dataUpdate);

        $response->assertSessionHasErrors('name', 'display_name');
    }

    /** @test  */
    public function authenticatedUserHavePermissionCanSeeFormEditRole()
    {
        $this->loginUserWithPermission('edit-role');
        $role = Role::factory()->create();
        $response = $this->get($this->getEditRoleTest($role->id));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('admin.roles.edit');
    }

    /** @test  */
    public function authenticatedUserHavePermissionCanEditRole()
    {
        $this->loginUserWithPermission('update-role');
        $role = Role::factory()->create();
        $dataUpdate = Role::factory()->make()->toArray();
        $response = $this->put($this->getUpdateRoleTest($role->id), $dataUpdate);

        $response->assertStatus(Response::HTTP_FOUND);
    }

    /** @test  */
    public function authenticatedUserHavePermissionCanNotUpdateRoleIfNameNull()
    {
        $this->loginUserWithPermission('update-role');
        $role = Role::factory()->create();
        $dataUpdate = Role::factory()->make([
            'id' => $role->id,
            'name' => null
        ])->toArray();
        $response = $this->put($this->getUpdateRoleTest($role->id), $dataUpdate);

        $response->assertSessionHasErrors('name');
    }

    /** @test  */
    public function authenticatedUserHavePermissionCanSeeTextErrorUpdateRoleIfNameNull()
    {
        $this->loginUserWithPermission('update-role');
        $role = Role::factory()->create();
        $dataUpdate = Role::factory()->make([
            'name' => null
        ])->toArray();
        $response = $this->from($this->getEditRoleTest($role->id))->
        put($this->getUpdateRoleTest($role->id), $dataUpdate);

        $response->assertSessionHasErrors('name');
    }

    /** @test  */
    public function authenticatedUserHavePermissionCanNotUpdateRoleIfDisplayNameNull()
    {
        $this->loginUserWithPermission('update-role');
        $role = Role::factory()->create();
        $dataUpdate = Role::factory()->make([
            'display_name' => null
        ])->toArray();
        $response = $this->put($this->getUpdateRoleTest($role->id), $dataUpdate);

        $response->assertSessionHasErrors('display_name');
    }

    /** @test  */
    public function authenticatedUserHavePermissionCanNotUpdateRoleIfNameAndDisplayNull()
    {
        $this->loginUserWithPermission('update-role');
        $role = Role::factory()->create();
        $dataUpdate = Role::factory()->make([
            'name' => null,
            'display_name' => null
        ])->toArray();
        $response = $this->put($this->getUpdateRoleTest($role->id), $dataUpdate);

        $response->assertSessionHasErrors('name', 'display_name');
    }

    /** @test  */
    public function unauthenticatedUserCannotEditRole()
    {
        $role = Role::factory()->create();
        $dataUpdate = $this->makeFactoryRole();
        $response = $this->put($this->getUpdateRoleTest($role->id), $dataUpdate);

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(route('login'));
    }

    /** @test  */
    public function unauthenticatedUserCanNotSeeFormEditRole()
    {
        $role = Role::factory()->create();
        $response = $this->get($this->getEditRoleTest($role->id));

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(route('login'));
    }

    /** @test  */
    public function authenticatedUserHavePermissionCanNotSeeFormEditRoleIfRoleIsExist()
    {
        $this->loginUserWithPermission('edit-role');
        $roleId = -1;
        $response = $this->get($this->getEditRoleTest($roleId));

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function getEditRoleTest($id)
    {
        return route('roles.edit', $id);
    }

    public function getUpdateRoleTest($id)
    {
        return route('roles.update', $id);
    }

    public function makeFactoryRole()
    {
        return Role::factory()->make()->toArray();
    }
}
