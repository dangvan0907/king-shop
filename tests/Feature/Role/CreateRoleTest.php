<?php

namespace Tests\Feature\Role;

use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class CreateRoleTest extends TestCase
{
    /** @test */
    public function unauthenticated_user_can_not_see_create_form()
    {
        $response = $this->get($this->getCreateRoleRoute());

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function authenticated_user_have_permission_can_see_create_form()
    {
        $this->loginUserWithPermission('create-role');
        $response = $this->get($this->getCreateRoleRoute());

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('admin.roles.create');
    }

    /** @test */
    public function authenticated_user_can_new_create_form()
    {
        $this->loginUserWithPermission('store-role');
        $role = $this->_makeFactoryRole();
        $response = $this->post($this->getStoreRoleRoute(), $role);

        $response->assertStatus(Response::HTTP_FOUND);
        $this->assertDatabaseHas('roles', $role);
        $response->assertRedirect(route('roles.index'));
    }

    /** @test */
    public function authenticated_user_have_permission_can_not_new_create_role_if_name_null()
    {
        $this->loginUserWithPermission('store-role');
        $role = Role::factory()->make([
            'name' => null
        ])->toArray();
        $response = $this->post($this->getStoreRoleRoute(), $role);

        $response->assertSessionHasErrors(['name']);
    }

    /** @test */
    public function authenticated_user_have_permission_can_not_new_create_role_if_display_name_null()
    {
        $this->loginUserWithPermission('store-role');
        $role = Role::factory()->make([
            'display_name' => null
        ])->toArray();
        $response = $this->post($this->getStoreRoleRoute(), $role);
        $response->assertSessionHasErrors(['display_name']);
    }

    /** @test */
    public function authenticated_user_have_permission_can_not_new_create_role_if_display_name_and_display_name_null()
    {
        $this->loginUserWithPermission('store-role');
        $role = Role::factory()->make([
            'name' => null,
            'display_name' => null
        ])->toArray();
        $response = $this->post($this->getStoreRoleRoute(), $role);

        $response->assertSessionHasErrors(['display_name']);
    }

    /** @test */
    public function authenticated_user_have_permission_can_see_text_error_create_role_if_name_null()
    {
        $this->loginUserWithPermission('store-role');
        $role = Role::factory()->make([
            'name' => null
        ])->toArray();
        $response = $this->post($this->getStoreRoleRoute(), $role);

        $response->assertSessionHasErrors(['name']);
    }

    /** @test */
    public function authenticated_super_admin_can_see_create_form()
    {
        $this->loginWithSuperAdmin();
        $response = $this->get($this->getCreateRoleRoute());

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('admin.roles.create');
    }

    /** @test */
    public function authenticated_super_admin_can_new_create_role()
    {
        $this->loginWithSuperAdmin();
        $role = $this->_makeFactoryRole();
        $response = $this->post($this->getStoreRoleRoute(), $role);

        $response->assertStatus(Response::HTTP_FOUND);
        $this->assertDatabaseHas('roles', $role);
        $response->assertRedirect(route('roles.index'));
    }

    /** @test */
    public function authenticated_super_admin_can_not_new_create_role_if_name_null()
    {
        $this->loginWithSuperAdmin();
        $role = Role::factory()->make([
            'name' => null
        ])->toArray();
        $response = $this->post($this->getStoreRoleRoute(), $role);

        $response->assertSessionHasErrors(['name']);
    }

    /** @test */
    public function authenticated_super_admin_can_not_new_create_role_if_display_name_null()
    {
        $this->loginWithSuperAdmin();
        $role = Role::factory()->make([
            'display_name' => null
        ])->toArray();
        $response = $this->post($this->getStoreRoleRoute(), $role);

        $response->assertSessionHasErrors(['display_name']);
    }

    /** @test */
    public function authenticated_super_admin_can_not_new_create_role_if_display_name_and_display_name_null()
    {
        $this->loginWithSuperAdmin();
        $role = Role::factory()->make([
            'name' => null,
            'display_name' => null
        ])->toArray();
        $response = $this->post($this->getStoreRoleRoute(), $role);

        $response->assertSessionHasErrors(['display_name']);
    }

    /** @test */
    public function authenticated_super_admin_can_see_text_error_create_role_if_name_null()
    {
        $this->loginWithSuperAdmin();
        $role = Role::factory()->make([
            'name' => null
        ])->toArray();
        $response = $this->from($this->getCreateRoleRoute())->post($this->getStoreRoleRoute(), $role);

        $response->assertSessionHasErrors(['name']);
    }

    public function getCreateRoleRoute()
    {
        return route('roles.create');
    }

    public function getStoreRoleRoute()
    {
        return route('roles.store');
    }

    public function _makeFactoryRole()
    {
        return Role::factory()->make()->toArray();
    }
}
