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
    public function unauthenticatedUserCanNotSeeCreateForm()
    {
        $response = $this->get($this->getCreateRoleRoute());

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function authenticatedUserHavePermissionCanSeeCreateForm()
    {
        $this->loginUserWithPermission('create-role');
        $response = $this->get($this->getCreateRoleRoute());

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('admin.roles.create');
    }

    /** @test */
    public function authenticatedUserCanNewCreateForm()
    {
        $this->loginUserWithPermission('store-role');
        $role = $this->_makeFactoryRole();
        $response = $this->post($this->getStoreRoleRoute(), $role);

        $response->assertStatus(Response::HTTP_FOUND);
        $this->assertDatabaseHas('roles', $role);
        $response->assertRedirect(route('roles.index'));
    }

    /** @test */
    public function authenticatedUserHavePermissionCanNotNewCreateRoleIfNameNull()
    {
        $this->loginUserWithPermission('store-role');
        $role = Role::factory()->make([
            'name' => null
        ])->toArray();
        $response = $this->post($this->getStoreRoleRoute(), $role);

        $response->assertSessionHasErrors(['name']);
    }

    /** @test */
    public function authenticatedUserHavePermissionCanNotNewCreateRoleIfDisplayNameNull()
    {
        $this->loginUserWithPermission('store-role');
        $role = Role::factory()->make([
            'display_name' => null
        ])->toArray();
        $response = $this->post($this->getStoreRoleRoute(), $role);
        $response->assertSessionHasErrors(['display_name']);
    }

    /** @test */
    public function authenticatedUserHavePermissionCanNotNewCreateRoleIfDisplayNameAndDisplayNameNull()
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
    public function authenticateduserHavePermissionCanSeeTextErrorCreateRoleIfNameNull()
    {
        $this->loginUserWithPermission('store-role');
        $role = Role::factory()->make([
            'name' => null
        ])->toArray();
        $response = $this->post($this->getStoreRoleRoute(), $role);

        $response->assertSessionHasErrors(['name']);
    }

    /** @test */
    public function authenticatedSuperAdminCanSeeCreateForm()
    {
        $this->loginWithSuperAdmin();
        $response = $this->get($this->getCreateRoleRoute());

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('admin.roles.create');
    }

    /** @test */
    public function authenticatedSuperAdminCanNewCreateRole()
    {
        $this->loginWithSuperAdmin();
        $role = $this->_makeFactoryRole();
        $response = $this->post($this->getStoreRoleRoute(), $role);

        $response->assertStatus(Response::HTTP_FOUND);
        $this->assertDatabaseHas('roles', $role);
        $response->assertRedirect(route('roles.index'));
    }

    /** @test */
    public function authenticatedSuperAdminCanNotNewCreateRoleIfNameNull()
    {
        $this->loginWithSuperAdmin();
        $role = Role::factory()->make([
            'name' => null
        ])->toArray();
        $response = $this->post($this->getStoreRoleRoute(), $role);

        $response->assertSessionHasErrors(['name']);
    }

    /** @test */
    public function authenticatedSuperAdminCanNotNewCreateRoleIfDisplayNameNull()
    {
        $this->loginWithSuperAdmin();
        $role = Role::factory()->make([
            'display_name' => null
        ])->toArray();
        $response = $this->post($this->getStoreRoleRoute(), $role);

        $response->assertSessionHasErrors(['display_name']);
    }

    /** @test */
    public function authenticatedSuperAdminCanNotNewCreateRoleIfDisplayNameAndDisplayNameNull()
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
    public function authenticatedSuperAdminCanSeeTextErrorCreateRoleIfNameNull()
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

    public function makeFactoryRole()
    {
        return Role::factory()->make()->toArray();
    }
}
