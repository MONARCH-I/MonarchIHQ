<?php

namespace Tests\Feature;

use App\Models\JobApplication;
use App\Models\JobListing;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class JobApplicationTest extends TestCase
{
    use RefreshDatabase;

    public function test_careers_page_renders_with_jobs()
    {
        $job = JobListing::create([
            'title' => 'Senior Backend Engineer',
            'department' => 'Engineering',
            'employment_type' => 'full_time',
            'location' => 'Accra / Hybrid',
            'skills_required' => 'PHP, Laravel, PostgreSQL',
            'description' => 'Build high-performance systems and backend APIs.',
            'apply_email' => 'careers@monarchi.com.gh',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $response = $this->get('/careers');
        $response->assertStatus(200);
        $response->assertSee('Senior Backend Engineer');
        $response->assertSee('Engineering');
    }

    public function test_candidate_can_apply_for_job_with_cv_upload()
    {
        Storage::fake('local');

        $job = JobListing::create([
            'title' => 'AI Systems Architect',
            'department' => 'AI Research',
            'employment_type' => 'full_time',
            'location' => 'Accra',
            'apply_email' => 'careers@monarchi.com.gh',
            'is_active' => true,
        ]);

        $file = UploadedFile::fake()->create('candidate_cv.pdf', 800, 'application/pdf');

        $response = $this->postJson(route('careers.apply', $job), [
            'name' => 'Kofi Mensah',
            'email' => 'kofi@example.com',
            'phone' => '+233 24 111 2222',
            'portfolio_url' => 'https://github.com/kofimensah',
            'cover_letter' => 'Excited to architect high-throughput neural inference systems.',
            'resume' => $file,
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $this->assertDatabaseHas('job_applications', [
            'job_listing_id' => $job->id,
            'name' => 'Kofi Mensah',
            'email' => 'kofi@example.com',
            'phone' => '+233 24 111 2222',
            'resume_filename' => 'candidate_cv.pdf',
            'status' => 'pending',
        ]);

        $app = JobApplication::first();
        Storage::disk('local')->assertExists($app->resume_path);
    }

    public function test_application_validation_requires_cv_and_contact_info()
    {
        $job = JobListing::create([
            'title' => 'UI Designer',
            'department' => 'Design',
            'employment_type' => 'full_time',
            'location' => 'Remote',
            'apply_email' => 'careers@monarchi.com.gh',
            'is_active' => true,
        ]);

        // Submit without CV and without name
        $response = $this->postJson(route('careers.apply', $job), [
            'email' => 'invalid-email',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['name', 'email', 'phone', 'resume']);
    }

    public function test_hr_manager_can_view_applications_and_download_cv()
    {
        Storage::fake('local');

        $hr = User::factory()->create(['role' => 'hr_manager']);

        $job = JobListing::create([
            'title' => 'DevOps Specialist',
            'department' => 'Infrastructure',
            'employment_type' => 'full_time',
            'location' => 'Accra',
            'apply_email' => 'careers@monarchi.com.gh',
            'is_active' => true,
        ]);

        $file = UploadedFile::fake()->create('devops_resume.pdf', 500, 'application/pdf');
        $path = $file->store('resumes', 'local');

        $app = JobApplication::create([
            'job_listing_id' => $job->id,
            'name' => 'Ama Serwaa',
            'email' => 'ama@example.com',
            'phone' => '+233 20 999 8888',
            'cover_letter' => 'Kubernetes and Terraform expert.',
            'resume_path' => $path,
            'resume_filename' => 'devops_resume.pdf',
            'status' => 'pending',
        ]);

        // HR can view index
        $indexResponse = $this->actingAs($hr)->get(route('manager.hr.applications'));
        $indexResponse->assertStatus(200);
        $indexResponse->assertSee('Ama Serwaa');

        // HR can view show
        $showResponse = $this->actingAs($hr)->get(route('manager.hr.applications.show', $app));
        $showResponse->assertStatus(200);
        $showResponse->assertSee('Kubernetes and Terraform expert');

        // HR can download CV
        $downloadResponse = $this->actingAs($hr)->get(route('manager.hr.applications.download-cv', $app));
        $downloadResponse->assertStatus(200);
        $downloadResponse->assertHeader('content-disposition');

        // HR can update status
        $statusResponse = $this->actingAs($hr)->patch(route('manager.hr.applications.status', $app), [
            'status' => 'shortlisted',
            'hr_notes' => 'Passed initial screening, scheduling technical interview.',
        ]);
        $statusResponse->assertRedirect();
        $this->assertDatabaseHas('job_applications', [
            'id' => $app->id,
            'status' => 'shortlisted',
        ]);
    }
}
