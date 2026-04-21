<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MainPagesStatusTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_returns_200(): void
    {
        $this->get('/')->assertStatus(200);
    }

    public function test_login_page_returns_200_for_guest(): void
    {
        $this->get('/login')->assertStatus(200);
    }

    public function test_dashboard_returns_200_for_authenticated_candidate(): void
    {
        $user = User::factory()->create([
            'user_type' => 'candidate',
        ]);

        $this->actingAs($user)
            ->followingRedirects()
            ->get('/dashboard')
            ->assertStatus(200);
    }

    public function test_candidate_profile_returns_200_for_authenticated_candidate(): void
    {
        $user = User::factory()->create([
            'user_type' => 'candidate',
        ]);

        $this->actingAs($user)
            ->get('/candidate/profile')
            ->assertStatus(200);
    }

    public function test_candidate_applications_returns_200_for_authenticated_candidate(): void
    {
        $user = User::factory()->create([
            'user_type' => 'candidate',
        ]);

        $this->actingAs($user)
            ->get('/applications')
            ->assertStatus(200);
    }

    public function test_about_page_returns_200(): void
    {
        $this->get('/about')->assertStatus(200);
    }

    public function test_contact_page_returns_200(): void
    {
        $this->get('/contact')->assertStatus(200);
    }
}
