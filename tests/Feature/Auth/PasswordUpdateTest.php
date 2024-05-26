<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class PasswordUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_password_can_be_updated()
    {
        $user = User::factory()->create([
            'password' => Hash::make('OldPassword1!')
        ]);

        $response = $this->actingAs($user)->put('/profile/password', [
            'current_password' => 'OldPassword1!',
            'password' => 'NewPassword1!', // Mot de passe qui satisfait les règles
            'password_confirmation' => 'NewPassword1!',
        ]);

        $response->assertStatus(302);
        $this->assertTrue(Hash::check('NewPassword1!', $user->fresh()->password));
    }

    public function test_correct_password_must_be_provided_to_update_password()
    {
        $user = User::factory()->create([
            'password' => Hash::make('OldPassword1!')
        ]);

        $response = $this->actingAs($user)->put('/profile/password', [
            'current_password' => 'WrongPassword',
            'password' => 'NewPassword1!', // Mot de passe qui satisfait les règles
            'password_confirmation' => 'NewPassword1!',
        ]);

        $response->assertStatus(403);
    }
}
