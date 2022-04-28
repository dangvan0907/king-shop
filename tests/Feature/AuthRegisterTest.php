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
    public function userCanViewFormRegister()
    {
        $response = $this->get('/register');

        $response->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function userCanRegisterIfDataIsValid()
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
    public function userCanNotRegisterIfPasswordAndConfirmPasswordDontMatch()
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
    public function userCanNotRegisterIfPasswordIsNull()
    {
        $dataRegister = User::factory()->make([
            'password' => null
        ])->toArray();
        $response = $this->post('register', $dataRegister);

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertSessionHasErrors(['password']);
    }

    /** @test */
    public function userCanNotRegisterIfEmailIsNull()
    {
        $dataRegister = User::factory()->make([
            'email' => null
        ])->toArray();
        $response = $this->post('register', $dataRegister);

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertSessionHasErrors(['email']);
    }

    /** @test */
    public function userCanNotRegisterIfNameIsNull()
    {
        $dataRegister = User::factory()->make([
            'name' => null
        ])->toArray();
        $response = $this->post('register', $dataRegister);

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertSessionHasErrors(['name']);
    }
}
