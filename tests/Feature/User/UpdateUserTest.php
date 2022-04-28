<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UpdateUserTest extends TestCase
{
    /** @test */
    public function authenticatedSuperAdminCanSeeEditUserForm()
    {
        $this->loginWithSuperAdmin();
        $user = User::factory()->create();
        $response = $this->get($this->getEditUserRoute($user->id));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('admin.users.edit');
        $response->assertSee(['name'])->assertSee(['email']);
    }

    /** @test */
    public function authenticatedSuperAdminCanNotUpdateUserNameAndEmailAreNull()
    {
        $this->loginWithSuperAdmin();
        $user = User::factory()->create();
        $dataUpdate = [
            'name' => null,
            'email' => null,
        ];
        $response = $this->put($this->getUpdateUserRoute($user->id), $dataUpdate);

        $response->assertSessionHasErrors(['name', 'email']);
    }

    /** @test */
    public function authenticatedSuperAdminCanNotUpdateUserNameIsNull()
    {
        $this->loginWithSuperAdmin();
        $user = User::factory()->create();
        $dataUpdate = [
            'name' => null,
        ];
        $response = $this->put($this->getUpdateUserRoute($user->id), $dataUpdate);

        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function authenticatedSuperAdminCanNotUpdateUserEmailIsNull()
    {
        $this->loginWithSuperAdmin();
        $user = User::factory()->create();
        $dataUpdate = [
            'email' => null,
        ];
        $response = $this->put($this->getUpdateUserRoute($user->id), $dataUpdate);

        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function authenticatedSuperAdminCanSeeTextErrorUpdateUserIfNameNull()
    {
        $this->loginWithSuperAdmin();
        $user = User::factory()->create();
        $dataUpdate = [
            'name' => null,
        ];
        $response = $this->from($this->getEditUserRoute($user->id))->
        put($this->getUpdateUserRoute($user->id), $dataUpdate);

        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function authenticatedUserHavePermissionCanNotSeeEditUserForm()
    {
        $this->loginUserWithPermission('edit-user');
        $user = User::factory()->create();
        $response = $this->get($this->getEditUserRoute($user->id));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('admin.users.edit');
        $response->assertSee(['name'])->assertSee(['email']);
    }

    /** @test */
    public function authenticatedUserHavePermissionCanNotUpdateUserNameAndEmailAreNull()
    {
        $this->loginUserWithPermission('update-user');
        $user = User::factory()->create();
        $dataUpdate = [
            'name' => null,
            'email' => null,
        ];
        $response = $this->put($this->getUpdateUserRoute($user->id), $dataUpdate);

        $response->assertSessionHasErrors(['name', 'email']);
    }

    /** @test */
    public function authenticatedUserHavePermissionCanNotUpdateUserNameIsNull()
    {
        $this->loginUserWithPermission('update-user');
        $user = User::factory()->create();
        $dataUpdate = [
            'name' => null,
        ];
        $response = $this->put($this->getUpdateUserRoute($user->id), $dataUpdate);

        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function authenticatedUserHavePermissionCanNotUpdateUserEmailIsNull()
    {
        $this->loginUserWithPermission('update-user');
        $user = User::factory()->create();
        $dataUpdate = [
            'email' => null,
        ];
        $response = $this->put($this->getUpdateUserRoute($user->id), $dataUpdate);

        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function authenticatedUserHavePermissionCanSeeTextErrorUpdateUserIfNameNull()
    {
        $this->loginWithSuperAdmin();
        $user = User::factory()->create();
        $dataUpdate = [
            'name' => null,
        ];
        $response = $this->from($this->getEditUserRoute($user->id))->
        put($this->getUpdateUserRoute($user->id), $dataUpdate);

        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function unauthenticatedUserHavePermissionCanNotSeeEditUserForm()
    {
        $user = User::factory()->create();
        $response = $this->get($this->getEditUserRoute($user->id));

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(route('login'));
    }

    public function getEditUserRoute($id)
    {
        return route('users.edit', $id);
    }

    public function getUpdateUserRoute($id)
    {
        return route('users.update', $id);
    }

    public function makeFactoryUser()
    {
        return User::factory()->make()->toArray();
    }
}
