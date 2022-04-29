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
    public function authenticated_super_admin_can_see_edit_user_form()
    {
        $this->loginWithSuperAdmin();
        $user = User::factory()->create();
        $response = $this->get($this->getEditUserRoute($user->id));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('admin.users.edit');
        $response->assertSee(['name'])->assertSee(['email']);
    }

    /** @test */
    public function authenticated_super_admin_can_update_user()
    {
        $this->loginWithSuperAdmin();
        $user = User::factory()->create();
        $dataUpdate = $this->_makeFactoryUser();
        $response = $this->put($this->getUpdateUserRoute($user->id), $dataUpdate);

        $response->assertStatus(Response::HTTP_FOUND);
        $this->assertDatabaseHas('users', $dataUpdate);
        $response->assertRedirect(route('users.index'));
    }

    /** @test */
    public function authenticated_super_admin_can_not_update_user_name_and_email_are_null()
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
    public function authenticated_super_admin_can_not_update_user_name_is_null()
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
    public function authenticated_super_admin_can_not_update_user_email_is_null()
    {
        $this->loginWithSuperAdmin();
        $user = User::factory()->create();
        $dataUpdate = [
            'email' => null,
        ];
        $response = $this->put($this->getUpdateUserRoute($user->id), $dataUpdate);

        $response->assertSessionHasErrors( 'email');
    }

    /** @test  */
    public function authenticated_super_admin_can_see_text_error_update_user_if_name_null()
    {
        $this->loginWithSuperAdmin();
        $user = User::factory()->create();
        $dataUpdate = [
            'name' => null,
        ];
        $response = $this->from($this->getEditUserRoute($user->id))->put($this->getUpdateUserRoute($user->id), $dataUpdate);

        $response->assertSessionHasErrors( 'name');
    }

    /** @test */
    public function authenticated_user_have_permission_can_not_see_edit_user_form()
    {
        $this->loginUserWithPermission('edit-user');
        $user = User::factory()->create();
        $response = $this->get($this->getEditUserRoute($user->id));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('admin.users.edit');
        $response->assertSee(['name'])->assertSee(['email']);
    }

    /** @test */
    public function authenticated_user_have_permission_can_update_user()
    {
        $this->loginUserWithPermission('update-user');
        $user = User::factory()->create();
        $dataUpdate = $this->_makeFactoryUser();
        $response = $this->put($this->getUpdateUserRoute($user->id), $dataUpdate);

        $response->assertStatus(Response::HTTP_FOUND);
        $this->assertDatabaseHas('users', $dataUpdate);
        $response->assertRedirect(route('users.index'));
    }

    /** @test */
    public function authenticated_user_have_permission_can_not_update_user_name_and_email_are_null()
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
    public function authenticated_user_have_permission_can_not_update_user_name_is_null()
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
    public function authenticated_user_have_permission_can_not_update_user_email_is_null()
    {
        $this->loginUserWithPermission('update-user');
        $user = User::factory()->create();
        $dataUpdate = [
            'email' => null,
        ];
        $response = $this->put($this->getUpdateUserRoute($user->id), $dataUpdate);

        $response->assertSessionHasErrors('email');
    }

    /** @test  */
    public function authenticated_user_have_permission_can_see_text_error_update_user_if_name_null()
    {
        $this->loginWithSuperAdmin();
        $user = User::factory()->create();
        $dataUpdate = [
            'name' => null,
        ];
        $response = $this->from($this->getEditUserRoute($user->id))->put($this->getUpdateUserRoute($user->id), $dataUpdate);

        $response->assertSessionHasErrors( 'name');
    }

    /** @test */
    public function unauthenticated_user_have_permission_can_not_see_edit_user_form()
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
        return route('users.update',$id);
    }

    public function _makeFactoryUser()
    {
        return User::factory()->make()->toArray();
    }
}
