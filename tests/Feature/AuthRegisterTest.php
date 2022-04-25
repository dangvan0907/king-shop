<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class AuthRegisterTest extends TestCase
{
    /** @test */
    public function user_can_view_form_register()
    {
        $response = $this->get('/register');

        $response->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function user_can_register_if_data_is_valid()
    {
        $user = User::factory()->make();
        $dataRegister = [
            'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password,
            'password_confirmation' => $user->password
        ];

        $response = $this->post('register', $dataRegister);
        $response->assertStatus(Response::HTTP_FOUND);
        $this->assertAuthenticated();
    }

    /** @test */
    public function user_can_not_register_if_password_and_confirm_password_dont_match()
    {
        $user = User::factory()->make();
        $response = $this->post('register', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password,
            'password_confirmation' => '1234521'
        ]);
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertSessionHasErrors();
        $this->assertGuest();
    }

    /** @test */
    public function user_can_not_register_if_password_is_null()
    {
        $dataRegister = User::factory()->make([
            'password' => null
        ])->toArray();
        $response = $this->post('register', $dataRegister);

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertSessionHasErrors(['password']);
    }

    /** @test */
    public function user_can_not_register_if_email_is_null()
    {
        $dataRegister = User::factory()->make([
            'email' => null
        ])->toArray();
        $response = $this->post('register', $dataRegister);

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertSessionHasErrors(['email']);
    }

    /** @test */
    public function user_can_not_register_if_name_is_null()
    {
        $dataRegister = User::factory()->make([
            'name' => null
        ])->toArray();
        $response = $this->post('register', $dataRegister);

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertSessionHasErrors(['name']);
    }
}
