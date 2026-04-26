<?php

namespace Tests\Feature;

use App\Models\Application;
use App\Models\Blog;
use App\Models\CandidateProfile;
use App\Models\Company;
use App\Models\Job;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;

class SecurityTest extends TestCase
{
    use RefreshDatabase;

    public function test_recruiter_cannot_update_application_status_for_job_they_do_not_own(): void
    {
        $ownerRecruiter = User::create([
            'name' => 'Owner Recruiter',
            'email' => 'owner.recruiter@example.test',
            'password' => Hash::make('password'),
            'user_type' => 'recruiter',
        ]);

        $otherRecruiter = User::create([
            'name' => 'Other Recruiter',
            'email' => 'other.recruiter@example.test',
            'password' => Hash::make('password'),
            'user_type' => 'recruiter',
        ]);

        $candidate = User::create([
            'name' => 'Candidate User',
            'email' => 'candidate@example.test',
            'password' => Hash::make('password'),
            'user_type' => 'candidate',
        ]);

        $company = Company::create([
            'name' => 'Acme Corp',
            'slug' => 'acme-corp',
            'description' => 'Test company',
            'location' => 'Paris',
            'is_active' => true,
        ]);

        $job = Job::create([
            'company_id' => $company->id,
            'recruiter_id' => $ownerRecruiter->id,
            'title' => 'Backend Developer',
            'slug' => 'backend-developer',
            'description' => 'Job description',
            'location' => 'Paris',
            'type' => 'CDI',
            'status' => 'published',
        ]);

        $application = Application::create([
            'job_id' => $job->id,
            'candidate_id' => $candidate->id,
            'status' => 'pending',
        ]);

        $response = $this
            ->actingAs($otherRecruiter)
            ->put('/applications/' . $application->id . '/status', [
                'status' => 'accepted',
            ]);

        $response->assertForbidden();

        $this->assertDatabaseHas('applications', [
            'id' => $application->id,
            'status' => 'pending',
        ]);
    }

    public function test_candidate_cannot_access_another_candidates_profile_route(): void
    {
        $candidateA = User::create([
            'name' => 'Candidate A',
            'email' => 'candidate.a@example.test',
            'password' => Hash::make('password'),
            'user_type' => 'candidate',
        ]);

        $candidateB = User::create([
            'name' => 'Candidate B',
            'email' => 'candidate.b@example.test',
            'password' => Hash::make('password'),
            'user_type' => 'candidate',
        ]);

        CandidateProfile::create([
            'user_id' => $candidateB->id,
            'city' => 'Casablanca',
            'bio' => 'Profile owner',
            'skills' => ['php'],
            'experience' => ['2 years'],
            'education' => ['CS'],
        ]);

        $response = $this
            ->actingAs($candidateA)
            ->get('/candidate/profile/' . $candidateB->id);

        $response->assertForbidden();
    }

    public function test_companies_search_requires_authentication(): void
    {
        $response = $this->get('/companies/search?q=dev');

        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function test_companies_search_response_does_not_expose_emails(): void
    {
        $recruiter = User::create([
            'name' => 'Recruiter User',
            'email' => 'recruiter@example.test',
            'password' => Hash::make('password'),
            'user_type' => 'recruiter',
        ]);

        $candidate = User::create([
            'name' => 'Ali Candidate',
            'email' => 'ali.candidate@example.test',
            'password' => Hash::make('password'),
            'user_type' => 'candidate',
        ]);

        CandidateProfile::create([
            'user_id' => $candidate->id,
            'title' => 'PHP Developer',
            'bio' => 'Laravel developer',
            'skills' => ['php', 'laravel'],
        ]);

        $response = $this
            ->actingAs($recruiter)
            ->get('/companies/search?q=Ali');

        $response->assertOk();

        $payload = $response->json();
        $this->assertIsArray($payload);
        $this->assertNotEmpty($payload);

        foreach ($payload as $item) {
            $this->assertArrayHasKey('id', $item);
            $this->assertArrayHasKey('name', $item);
            $this->assertArrayNotHasKey('email', $item);
        }
    }

    public function test_api_job_update_succeeds_for_owner_recruiter(): void
    {
        $ownerRecruiter = User::create([
            'name'      => 'Owner Recruiter',
            'email'     => 'api.owner.recruiter@example.test',
            'password'  => Hash::make('password'),
            'user_type' => 'recruiter',
        ]);

        $company = Company::create([
            'name'        => 'Owner Company',
            'slug'        => 'owner-company',
            'description' => 'Company for owner update test',
            'location'    => 'Casablanca',
            'is_active'   => true,
        ]);

        $job = Job::create([
            'company_id'   => $company->id,
            'recruiter_id' => $ownerRecruiter->id,
            'title'        => 'Original Title',
            'slug'         => 'original-title-' . Str::random(6),
            'description'  => 'Original description long enough',
            'location'     => 'Casablanca',
            'type'         => 'CDI',
            'status'       => 'draft',
        ]);

        $response = $this
            ->actingAs($ownerRecruiter)
            ->putJson('/api/v1/jobs/' . $job->slug, [
                'title'       => 'Updated Title',
                'description' => 'Updated description long enough',
                'location'    => 'Rabat',
                'type'        => 'CDI',
                'status'      => 'published',
            ]);

        $response->assertOk();

        $this->assertDatabaseHas('job_postings', [
            'id'     => $job->id,
            'title'  => 'Updated Title',
            'location' => 'Rabat',
            'status' => 'published',
        ]);
    }

    public function test_api_job_update_fails_for_non_owner_recruiter(): void
    {
        $ownerRecruiter = User::create([
            'name' => 'Owner Recruiter',
            'email' => 'api.owner2.recruiter@example.test',
            'password' => Hash::make('password'),
            'user_type' => 'recruiter',
        ]);

        $nonOwnerRecruiter = User::create([
            'name' => 'Non Owner Recruiter',
            'email' => 'api.nonowner.recruiter@example.test',
            'password' => Hash::make('password'),
            'user_type' => 'recruiter',
        ]);

        $company = Company::create([
            'name' => 'API Company 2',
            'slug' => 'api-company-2',
            'description' => 'Company for API tests 2',
            'location' => 'Tangier',
            'is_active' => true,
        ]);

        $job = Job::create([
            'company_id' => $company->id,
            'recruiter_id' => $ownerRecruiter->id,
            'title' => 'Protected Title',
            'slug' => 'protected-title-' . Str::random(6),
            'description' => 'Protected description long enough',
            'location' => 'Tangier',
            'type' => 'CDI',
            'status' => 'draft',
        ]);

        $response = $this
            ->actingAs($nonOwnerRecruiter)
            ->putJson('/api/v1/jobs/' . $job->slug, [
                'title' => 'Hacked Title',
                'description' => 'Attempted description long enough',
                'location' => 'Marrakesh',
                'type' => 'CDI',
                'status' => 'published',
            ]);

        $response->assertForbidden();

        $this->assertDatabaseHas('job_postings', [
            'id' => $job->id,
            'title' => 'Protected Title',
            'location' => 'Tangier',
            'status' => 'draft',
        ]);
    }

    public function test_blog_show_renders_safely_and_strips_malicious_content(): void
    {
        $blog = Blog::create([
            'title' => 'Security Blog',
            'slug' => 'security-blog-' . Str::random(6),
            'excerpt' => 'Security excerpt',
            'content' => '<h2>Safe headline</h2><script>alert("xss")</script><img src=x onerror=alert(1)><a href="javascript:alert(2)">click</a>',
            'author_name' => 'Security Team',
            'category' => 'Security',
            'status' => 'published',
        ]);

        $response = $this->get('/blog/' . $blog->slug);

        $response->assertOk();
        $response->assertSeeText('Safe headline');
        // The layout contains legitimate <script> tags (JS utilities), so we check
        // for the specific dangerous payloads that must be stripped from blog content.
        $response->assertDontSee('alert("xss")', false);
        $response->assertDontSee('onerror=alert(1)', false);
        $response->assertDontSee('javascript:alert(2)', false);
    }

    public function test_guest_cannot_access_job_create_route(): void
    {
        $response = $this->get('/jobs/create');

        // Should be redirected to login
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function test_candidate_cannot_create_company(): void
    {
        $candidate = User::create([
            'name' => 'Candidate User',
            'email' => 'candidate.company.test@example.test',
            'password' => Hash::make('password'),
            'user_type' => 'candidate',
        ]);

        $response = $this
            ->actingAs($candidate)
            ->post('/companies', [
                'name' => 'Hacked Company',
                'description' => 'Should not be created',
                'location' => 'Paris',
            ]);

        // Should be forbidden because check.user.type:recruiter,admin prevents it
        $response->assertForbidden();

        $this->assertDatabaseMissing('companies', [
            'name' => 'Hacked Company',
        ]);
    }
}
