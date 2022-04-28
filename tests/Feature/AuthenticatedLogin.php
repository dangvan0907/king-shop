<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class AuthenticatedLogin extends TestCase
{
    /** @test */
    public function userCanViewFormLogin()
    {
        $response = $this->get('/login');
        $response->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function userCanLoginIfDataIsValid()
    {
        $response = $this->post(route('login'), [
            'email' => 'a@gmail.com',
            'password' => '123456789'
        ]);
        $response->assertStatus(Response::HTTP_FOUND);
        $this->assertAuthenticated();
    }

    /** @test */
    public function userCanNotLoginIfDataIsIncorrect()
    {
        $response = $this->post(route('login'), [
            'email' => 'adminadadad@gmail.com',
            'password' => 'abc123wq43'
        ]);
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertSessionHasErrors();
        $this->assertGuest();
    }

    /** @test */
    public function userLogout()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post('/logout');

        $response->assertStatus(Response::HTTP_FOUND);
        $this->assertGuest();
    }

    /** @test */
    public function userCanNotLoginIfEmailIsNull()
    {
        $response = $this->post(route('login'), [
            'email' => null,
            'password' => '123456789'
        ]);

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertSessionHasErrors(['email']);
    }

    /** @test */
    public function userCanNotLoginIfPasswordIsNull()
    {
        $response = $this->post(route('login'), [
            'email' => 'admin@gmail.com',
            'password' => null
        ]);

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertSessionHasErrors(['password']);
    }

    /** @test */
    public function userCanNotLoginIfEmailAndPasswordIsNull()
    {
        $response = $this->post(route('login'), [
            'email' => null,
            'password' => null
        ]);

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertSessionHasErrors(['email', 'password']);
    }
}
