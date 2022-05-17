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
    public function user_can_view_form_login()
    {
        $response = $this->get('/login');
        $response->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function user_can_login_if_data_is_valid()
    {
        $response = $this->post(route('login'), [
            'email' => 'a@gmail.com',
            'password' => '123456789'
        ]);
        $response->assertStatus(Response::HTTP_FOUND);
        $this->assertAuthenticated();
    }

    /** @test */
    public function user_can_not_login_if_data_is_incorrect()
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
    public function user_logout()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post('/logout');

        $response->assertStatus(Response::HTTP_FOUND);
        $this->assertGuest();
    }

    /** @test */
    public function user_can_not_login_if_email_is_null()
    {
        $response = $this->post(route('login'), [
            'email' => null,
            'password' => '123456789'
        ]);

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertSessionHasErrors(['email']);
    }

    /** @test */
    public function user_can_not_login_if_password_is_null()
    {
        $response = $this->post(route('login'), [
            'email' => 'admin@gmail.com',
            'password' => null
        ]);

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertSessionHasErrors(['password']);
    }

    /** @test */
    public function user_can_not_login_if_email_and_password_is_null()
    {
        $response = $this->post(route('login'), [
            'email' => null,
            'password' => null
        ]);

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertSessionHasErrors(['email','password']);
    }
}
