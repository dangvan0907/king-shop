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
    public function super_admin_can_create_new_user()
    {
        $this->loginWithSuperAdmin();
        $dataCreate = User::factory()->create()->toArray();
        $response = $this->post(route('users.store',$dataCreate));

        $this->assertDatabaseHas('users',$dataCreate);
        $response->assertStatus(Response::HTTP_FOUND);
    }

    /** @test */
    public function super_admin_can_not_create_new_role_if_name_email_and_password_null()
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
    public function super_admin_can_not_create_new_role_if_name_null()
    {
        $this->loginWithSuperAdmin();
        $data = User::factory()->make([
            'name' => null,
        ])->toArray();
        $response = $this->post($this->getStoreUserRoute(), $data);

        $response->assertSessionHasErrors(['name']);
    }

    /** @test */
    public function super_admin_can_not_create_new_role_if_email_null()
    {
        $this->loginWithSuperAdmin();
        $data = User::factory()->make([
            'email' => null,
        ])->toArray();
        $response = $this->post($this->getStoreUserRoute(), $data);

        $response->assertSessionHasErrors(['email']);
    }

    /** @test */
    public function super_admin_can_not_create_new_role_if_password_null()
    {
        $this->loginWithSuperAdmin();
        $data = User::factory()->make([
            'password' => null,
        ])->toArray();
        $response = $this->post($this->getStoreUserRoute(), $data);
        $response->assertSessionHasErrors('password');
    }

    /** @test */
    public function super_admin_can_see_text_error_create_user_if_name_null()
    {
        $this->loginWithSuperAdmin();
        $data = User::factory()->make([
            'name' => null,
        ])->toArray();
        $response = $this->from($this->getCreateUserRoute())->post($this->getStoreUserRoute(), $data);

        $response->assertSessionHasErrors(['name']);
    }

    /** @test */
    public function authenticated_user_have_permission_can_see_create_user_form()
    {
        $this->loginUserWithPermission('create-user');
        $response = $this->get($this->getCreateUserRoute());

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('admin.users.create');
    }

    /** @test */
    public function authenticated_user_have_permission_can_create_user()
    {
        $this->loginUserWithPermission('create-user');
        $dataCreate = User::factory()->hasAttached(Role::factory()->count(1))->make();

        $response = $this->post($this->getStoreUserRoute(), $dataCreate->toArray());
        $response->assertStatus(Response::HTTP_FOUND);
    }

    /** @test */
    public function authenticated_user_have_permission_can_not_create_new_role_if_name_email_and_password_null()
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
    public function authenticated_user_have_permission_can_not_create_new_role_if_name_null()
    {
        $this->loginUserWithPermission('create-user');;
        $data = User::factory()->make([
            'name' => null,
        ])->toArray();
        $response = $this->post($this->getStoreUserRoute(), $data);

        $response->assertSessionHasErrors(['name']);
    }

    /** @test */
    public function authenticated_user_have_permission_can_not_create_new_role_if_email_null()
    {
        $this->loginUserWithPermission('create-user');
        $data = User::factory()->make([
            'email' => null,
        ])->toArray();
        $response = $this->post($this->getStoreUserRoute(), $data);

        $response->assertSessionHasErrors(['email']);
    }

    /** @test */
    public function authenticated_user_have_permission_can_not_create_new_role_if_password_null()
    {
        $this->loginUserWithPermission('create-user');
        $data = User::factory()->make([
            'password' => null,
        ])->toArray();
        $response = $this->post($this->getStoreUserRoute(), $data);

        $response->assertSessionHasErrors(['password']);
    }

    /** @test */
    public function authenticated_user_have_permission_can_see_text_error_create_user_if_name_null()
    {
        $this->loginUserWithPermission('create-user');
        $data = User::factory()->make([
            'name' => null,
        ])->toArray();
        $response = $this->from($this->getCreateUserRoute())->post($this->getStoreUserRoute(), $data);

        $response->assertSessionHasErrors(['name']);
    }

    /** @test */
    public function authenticated_user_not_have_permission_can_not_see_create_user_form()
    {
        $this->loginWithUser();
        $response = $this->get($this->getCreateUserRoute());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /** @test */
    public function unauthenticated_user_can_not_see_create_user_form()
    {
        $user = User::factory()->create();
        $response = $this->get($this->getCreateUserRoute(),$user->toArray());
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function unauthenticated_user_can_not_create_user_can_not_see_create()
    {
        $user = $this->_makeFactoryUser();
        $response = $this->post($this->getStoreUserRoute(),$user);
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

    public function _makeFactoryUser()
    {
        return User::factory()->make()->toArray();
    }
}
