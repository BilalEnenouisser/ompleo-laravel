<?php

namespace Tests\Feature;

use App\Models\CandidateProfile;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthorizationAndPresentationTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_access_public_pages(): void
    {
        $this->get(route('home'))->assertOk();
        $this->get(route('about'))->assertOk();
        $this->get(route('jobs.index'))->assertOk();
        $this->get(route('blog.index'))->assertOk();
        $this->get(route('login'))->assertOk();
    }

    public function test_recruiter_candidates_page_renders_prepared_data(): void
    {
        $recruiter = User::factory()->create([
            'user_type' => 'recruiter',
        ]);

        $candidate = User::factory()->create([
            'user_type' => 'candidate',
            'name' => 'Sara Benali',
        ]);

        CandidateProfile::create([
            'user_id' => $candidate->id,
            'city' => 'Alger',
            'bio' => 'Frontend engineer',
            'skills' => ['Laravel', 'Vue.js', 'Tailwind CSS'],
            'experience' => [['title' => '2 years'] ],
            'education' => [['degree' => 'Licence Informatique']],
            'experience_years' => '2 ans d\'expérience',
            'availability' => 'Immédiate',
        ]);

        $this->actingAs($recruiter)
            ->get(route('recruiter.candidates'))
            ->assertOk()
            ->assertSee('Sara Benali')
            ->assertSee('Laravel');
    }

    public function test_notifications_api_returns_recent_notifications(): void
    {
        $user = User::factory()->create([
            'user_type' => 'candidate',
        ]);

        $notification = Notification::create([
            'title' => 'Interview scheduled',
            'message' => 'Your interview is scheduled for tomorrow.',
            'type' => 'info',
            'target_type' => 'candidates',
            'target_users' => [$user->id],
            'is_sent' => true,
            'sent_at' => now(),
        ]);

        UserNotification::create([
            'user_id' => $user->id,
            'notification_id' => $notification->id,
            'is_read' => false,
        ]);

        $this->actingAs($user)
            ->getJson(route('notifications.api'))
            ->assertOk()
            ->assertJsonPath('data.unread_count', 1)
            ->assertJsonPath('data.notifications.0.title', 'Interview scheduled');
    }
}