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
    public function authenticated_super_admin_can_see_form_edit_role()
    {
        $this->loginWithSuperAdmin();
        $role = Role::factory()->create();
        $response = $this->get($this->getEditRoleTest($role->id));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('admin.roles.edit');
    }

    /** @test  */
    public function authenticated_super_admin_can_edit_role()
    {
        $this->loginWithSuperAdmin();
        $role = Role::factory()->create();
        $dataUpdate = $this->_makeFactoryRole();
        $response = $this->put($this->getUpdateRoleTest($role->id), $dataUpdate);

        $response->assertStatus(Response::HTTP_FOUND);
        $this->assertDatabaseHas('roles', $dataUpdate);
        $response->assertRedirect(route('roles.index'));
    }

    /** @test  */
    public function authenticated_super_admin_can_not_update_role_if_name_null()
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
    public function authenticated_super_admin_can_see_text_error_update_role_if_name_null()
    {
        $this->loginWithSuperAdmin();
        $role = Role::factory()->create();
        $dataUpdate = Role::factory()->make([
            'name' => null
        ])->toArray();
        $response = $this->from($this->getEditRoleTest($role->id))->put($this->getUpdateRoleTest($role->id), $dataUpdate);

        $response->assertSessionHasErrors('name');
    }

    /** @test  */
    public function authenticated_super_admin_can_not_update_role_if_display_name_null()
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
    public function authenticated_super_admin_can_not_update_role_if_name_and_display_null()
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
    public function authenticated_user_have_permission_can_see_form_edit_role()
    {
        $this->loginUserWithPermission('edit-role');
        $role = Role::factory()->create();
        $response = $this->get($this->getEditRoleTest($role->id));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('admin.roles.edit');
    }

    /** @test  */
    public function authenticated_user_have_permission_can_edit_role()
    {
        $this->loginUserWithPermission('update-role');
        $role = Role::factory()->create();
        $dataUpdate = Role::factory()->make()->toArray();
        $response = $this->put($this->getUpdateRoleTest($role->id), $dataUpdate);

        $response->assertStatus(Response::HTTP_FOUND);
//        $this->assertDatabaseHas('roles', $dataUpdate);
//        $response->assertRedirect(route('roles.index'));

    }

    /** @test  */
    public function authenticated_user_have_permission_can_not_update_role_if_name_null()
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
    public function authenticated_user_have_permission_can_see_text_error_update_role_if_name_null()
    {
        $this->loginUserWithPermission('update-role');
        $role = Role::factory()->create();
        $dataUpdate = Role::factory()->make([
            'name' => null
        ])->toArray();
        $response = $this->from($this->getEditRoleTest($role->id))->put($this->getUpdateRoleTest($role->id), $dataUpdate);

        $response->assertSessionHasErrors('name');
    }

    /** @test  */
    public function authenticated_user_have_permission_can_not_update_role_if_display_name_null()
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
    public function authenticated_user_have_permission_can_not_update_role_if_name_and_display_null()
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
    public function unauthenticated_user_cannot_edit_role()
    {
        $role = Role::factory()->create();
        $dataUpdate = $this->_makeFactoryRole();
        $response = $this->put($this->getUpdateRoleTest($role->id), $dataUpdate);

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(route('login'));
    }

    /** @test  */
    public function unauthenticated_user_can_not_see_form_edit_role()
    {
        $role = Role::factory()->create();
        $response = $this->get($this->getEditRoleTest($role->id));

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(route('login'));
    }

    /** @test  */
    public function authenticated_user_have_permission_can_not_see_form_edit_role_if_role_is_exist()
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

    public function _makeFactoryRole()
    {
        return Role::factory()->make()->toArray();
    }

}
