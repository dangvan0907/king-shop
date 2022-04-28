<?php

namespace Tests\Feature\User;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class CreateUserTest extends TestCase
{
    /** @test */
    public function superAdminCanCreateNewUser()
    {
        $this->loginWithSuperAdmin();
        $dataCreate = User::factory()->create()->toArray();
        $response = $this->post(route('users.store', $dataCreate));

        $this->assertDatabaseHas('users', $dataCreate);
        $response->assertStatus(Response::HTTP_FOUND);
    }

    /** @test */
    public function superAdminCanNotCreateNewRoleIfNameEmailAndPasswordNull()
    {
        $this->loginWithSuperAdmin();
        $data = User::factory()->make([
            'name' => null,
            'email' => null,
            'password' => null,
        ])->toArray();
        $response = $this->post($this->getStoreUserRoute(), $data);

        $response->assertSessionHasErrors(['name'])->assertSessionHasErrors(['email'])
            ->assertSessionHasErrors(['password']);
    }

    /** @test */
    public function superAdminCanNotCreateNewRoleIfNameNull()
    {
        $this->loginWithSuperAdmin();
        $data = User::factory()->make([
            'name' => null,
        ])->toArray();
        $response = $this->post($this->getStoreUserRoute(), $data);

        $response->assertSessionHasErrors(['name']);
    }

    /** @test */
    public function superAdminCanNotCreateNewRoleIfEmailNull()
    {
        $this->loginWithSuperAdmin();
        $data = User::factory()->make([
            'email' => null,
        ])->toArray();
        $response = $this->post($this->getStoreUserRoute(), $data);

        $response->assertSessionHasErrors(['email']);
    }

    /** @test */
    public function superAdminCanNotCreateNewRoleIfPasswordNull()
    {
        $this->loginWithSuperAdmin();
        $data = User::factory()->make([
            'password' => null,
        ])->toArray();
        $response = $this->post($this->getStoreUserRoute(), $data);
        $response->assertSessionHasErrors('password');
    }

    /** @test */
    public function superAdminCanSeeTextErrorCreateUserIfNameNull()
    {
        $this->loginWithSuperAdmin();
        $data = User::factory()->make([
            'name' => null,
        ])->toArray();
        $response = $this->from($this->getCreateUserRoute())->post($this->getStoreUserRoute(), $data);

        $response->assertSessionHasErrors(['name']);
    }

    /** @test */
    public function authenticatedUserHavePermissionCanSeeCreateUserForm()
    {
        $this->loginUserWithPermission('create-user');
        $response = $this->get($this->getCreateUserRoute());

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('admin.users.create');
    }

    /** @test */
    public function authenticatedUserHavePermissionCanCreateUser()
    {
        $this->loginUserWithPermission('create-user');
        $dataCreate = User::factory()->hasAttached(Role::factory()->count(1))->make();

        $response = $this->post($this->getStoreUserRoute(), $dataCreate->toArray());
        $response->assertStatus(Response::HTTP_FOUND);
    }

    /** @test */
    public function authenticatedUserHavePermissionCanNotCreateNewRoleIfNameEmailAndPasswordNull()
    {
        $this->loginUserWithPermission('create-user');
        $data = User::factory()->make([
            'name' => null,
            'email' => null,
            'password' => null,
        ])->toArray();
        $response = $this->post($this->getStoreUserRoute(), $data);

        $response->assertSessionHasErrors(['name'])->assertSessionHasErrors(['email'])
            ->assertSessionHasErrors(['password']);
    }

    /** @test */
    public function authenticatedUserHavePermissionCanNotCreateNewRoleIfNameNull()
    {
        $this->loginUserWithPermission('create-user');
        $data = User::factory()->make(['name' => null,])->toArray();
        $response = $this->post($this->getStoreUserRoute(), $data);

        $response->assertSessionHasErrors(['name']);
    }

    /** @test */
    public function authenticatedUserHavePermissionCanNotCreateNewRoleIdEmailNull()
    {
        $this->loginUserWithPermission('create-user');
        $data = User::factory()->make([
            'email' => null,
        ])->toArray();
        $response = $this->post($this->getStoreUserRoute(), $data);

        $response->assertSessionHasErrors(['email']);
    }

    /** @test */
    public function authenticatedUserHavePermissionCanNotCreateNewRoleIfPasswordNull()
    {
        $this->loginUserWithPermission('create-user');
        $data = User::factory()->make([
            'password' => null,
        ])->toArray();
        $response = $this->post($this->getStoreUserRoute(), $data);

        $response->assertSessionHasErrors(['password']);
    }

    /** @test */
    public function authenticatedUserHavePermissionCanSeeTextErrorCreateUserIfNameNull()
    {
        $this->loginUserWithPermission('create-user');
        $data = User::factory()->make([
            'name' => null,
        ])->toArray();
        $response = $this->from($this->getCreateUserRoute())->post($this->getStoreUserRoute(), $data);

        $response->assertSessionHasErrors(['name']);
    }

    /** @test */
    public function authenticatedUserNotHavePermissionCanNotSeeCreateUserForm()
    {
        $this->loginWithUser();
        $response = $this->get($this->getCreateUserRoute());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /** @test */
    public function unauthenticatedUserCanNotSeeCreateUserForm()
    {
        $user = User::factory()->create();
        $response = $this->get($this->getCreateUserRoute(), $user->toArray());
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function unauthenticatedUserCanNotCreateUserCanNotSeeCreate()
    {
        $user = $this->makeFactoryUser();
        $response = $this->post($this->getStoreUserRoute(), $user);
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(route('login'));
    }

    public function getCreateUserRoute()
    {
        return route('users.create');
    }

    public function getStoreUserRoute()
    {
        return route('users.store');
    }

    public function makeFactoryUser()
    {
        return User::factory()->make()->toArray();
    }
}
