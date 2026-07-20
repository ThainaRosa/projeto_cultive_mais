<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertOk()
            ->assertSee('Cadastrar');
    }

    public function test_new_users_can_register(): void
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => User::ROLE_ADMIN,
        ]);

        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
            'role' => User::ROLE_RESIDENT,
            'phone' => null,
            'active' => true,
        ]);
        $response->assertRedirect(route('dashboard', absolute: false));
    }

    public function test_user_role_helpers_identify_each_profile(): void
    {
        $admin = User::factory()->create(['role' => User::ROLE_ADMIN]);
        $resident = User::factory()->create(['role' => User::ROLE_RESIDENT]);
        $partner = User::factory()->create(['role' => User::ROLE_PARTNER]);

        $this->assertTrue($admin->isAdmin());
        $this->assertTrue($resident->isResident());
        $this->assertTrue($partner->isPartner());
    }
}
