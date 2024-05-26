<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register()
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'Password1!', // Mot de passe qui satisfait les règles
            'password_confirmation' => 'Password1!',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/'); // Modifiez cette ligne en fonction de votre logique de redirection

        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
        ]);
    }
}
