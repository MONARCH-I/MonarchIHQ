<?php

namespace Tests\Feature;

use App\Models\JobListing;
use App\Models\NewsArticle;
use App\Models\PortfolioProject;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AbacManagerPortalsTest extends TestCase
{
    use RefreshDatabase;

    // ─── 1. Public Dynamic Pages ─────────────────────────────────────────────

    public function test_projects_page_loads_and_displays_dynamic_projects(): void
    {
        PortfolioProject::create([
            'title' => 'Dynamic AI Telemetry',
            'slug' => 'dynamic-ai-telemetry',
            'description' => 'Test description of project',
            'domain' => 'Enterprise AI',
            'status' => 'Deployed',
            'status_color' => 'blue',
            'is_published' => true,
        ]);

        $response = $this->get('/projects');
        $response->assertStatus(200);
        $response->assertSee('Dynamic AI Telemetry');
    }

    public function test_blog_page_loads_and_displays_dynamic_news(): void
    {
        NewsArticle::create([
            'title' => 'African Tech Revolution 2026',
            'slug' => 'african-tech-revolution-2026',
            'excerpt' => 'Summary of revolution',
            'category' => 'african_tech',
            'author_name' => 'Monarchi Team',
            'read_time_minutes' => 4,
            'is_published' => true,
            'published_at' => now(),
        ]);

        $response = $this->get('/blog');
        $response->assertStatus(200);
        $response->assertSee('African Tech Revolution 2026');
        $response->assertSee('African Tech');
    }

    public function test_careers_page_loads_and_displays_dynamic_jobs(): void
    {
        JobListing::create([
            'title' => 'Principal Cloud Architect',
            'department' => 'Engineering',
            'employment_type' => 'full_time',
            'location' => 'Accra',
            'apply_email' => 'careers@monarchi.com.gh',
            'is_active' => true,
        ]);

        $response = $this->get('/careers');
        $response->assertStatus(200);
        $response->assertSee('Principal Cloud Architect');
    }

    public function test_contact_form_submits_and_stores_in_database(): void
    {
        $response = $this->post('/contact', [
            'name' => 'Kofi Mensah',
            'email' => 'kofi@example.com',
            'subject' => 'Enterprise Systems & SaaS',
            'message' => 'We want to inquire about custom telemetry infrastructure deployment.',
        ]);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('contact_messages', [
            'name' => 'Kofi Mensah',
            'email' => 'kofi@example.com',
        ]);
    }

    // ─── 2. Dedicated Manager Authentication & Redirects ─────────────────────

    public function test_guest_is_redirected_to_manager_login_from_manager_portals(): void
    {
        $this->get('/manager/content')->assertRedirect(route('manager.login'));
        $this->get('/manager/store')->assertRedirect(route('manager.login'));
        $this->get('/manager/hr')->assertRedirect(route('manager.login'));
        $this->get('/manager/employees')->assertRedirect(route('manager.login'));
    }

    public function test_manager_login_screen_can_be_rendered(): void
    {
        $response = $this->get(route('manager.login'));
        $response->assertStatus(200);
        $response->assertSee('Management &amp; Staff Access', false);
        $response->assertSee('Staff Email Address');
    }

    public function test_manager_can_authenticate_via_manager_login(): void
    {
        $manager = User::factory()->create([
            'email' => 'content-lead@monarchi.com.gh',
            'password' => bcrypt('StrongSecret123!'),
            'role' => 'content_manager',
        ]);

        $response = $this->post(route('manager.login.store'), [
            'email' => 'content-lead@monarchi.com.gh',
            'password' => 'StrongSecret123!',
        ]);

        $this->assertAuthenticatedAs($manager);
        $response->assertRedirect(route('manager'));
    }

    public function test_regular_customer_is_rejected_at_manager_login(): void
    {
        $customer = User::factory()->create([
            'email' => 'customer@example.com',
            'password' => bcrypt('CustomerSecret123!'),
            'role' => 'user',
            'is_super_admin' => false,
        ]);

        $response = $this->post(route('manager.login.store'), [
            'email' => 'customer@example.com',
            'password' => 'CustomerSecret123!',
        ]);

        $this->assertGuest();
        $response->assertSessionHasErrors('email');
    }

    public function test_manager_can_logout_via_manager_logout(): void
    {
        $manager = User::factory()->create([
            'role' => 'hr_manager',
        ]);

        $response = $this->actingAs($manager)->post(route('manager.logout'));

        $this->assertGuest();
        $response->assertRedirect(route('manager.login'));
    }

    // ─── 3. Standard User Role (ABAC Restriction) ────────────────────────────

    public function test_regular_user_is_forbidden_from_all_manager_portals(): void
    {
        $user = User::factory()->create([
            'role' => 'user',
            'is_super_admin' => false,
        ]);

        $this->actingAs($user)->get('/manager/content')->assertStatus(403);
        $this->actingAs($user)->get('/manager/store')->assertStatus(403);
        $this->actingAs($user)->get('/manager/hr')->assertStatus(403);
        $this->actingAs($user)->get('/manager/employees')->assertStatus(403);
    }

    // ─── 4. Content Manager Role ─────────────────────────────────────────────

    public function test_content_manager_can_access_content_portal_only(): void
    {
        $contentMgr = User::factory()->create([
            'role' => 'content_manager',
            'is_super_admin' => false,
        ]);

        // Allowed
        $this->actingAs($contentMgr)->get('/manager/content')->assertStatus(200);
        $this->actingAs($contentMgr)->get('/manager/content/news')->assertStatus(200);
        $this->actingAs($contentMgr)->get('/manager/content/projects')->assertStatus(200);

        // Forbidden
        $this->actingAs($contentMgr)->get('/manager/store')->assertStatus(403);
        $this->actingAs($contentMgr)->get('/manager/hr')->assertStatus(403);
        $this->actingAs($contentMgr)->get('/manager/employees')->assertStatus(403);
    }

    // ─── 5. Store Manager Role ───────────────────────────────────────────────

    public function test_store_manager_can_access_store_portal_only(): void
    {
        $storeMgr = User::factory()->create([
            'role' => 'store_manager',
            'is_super_admin' => false,
        ]);

        // Allowed
        $this->actingAs($storeMgr)->get('/manager/store')->assertStatus(200);
        $this->actingAs($storeMgr)->get('/manager/store/products')->assertStatus(200);
        $this->actingAs($storeMgr)->get('/manager/store/categories')->assertStatus(200);
        $this->actingAs($storeMgr)->get('/manager/store/orders')->assertStatus(200);

        // Forbidden
        $this->actingAs($storeMgr)->get('/manager/content')->assertStatus(403);
        $this->actingAs($storeMgr)->get('/manager/hr')->assertStatus(403);
        $this->actingAs($storeMgr)->get('/manager/employees')->assertStatus(403);
    }

    // ─── 6. HR Manager Role ──────────────────────────────────────────────────

    public function test_hr_manager_can_access_hr_and_employees_portals(): void
    {
        $hrMgr = User::factory()->create([
            'role' => 'hr_manager',
            'is_super_admin' => false,
        ]);

        // Allowed
        $this->actingAs($hrMgr)->get('/manager/hr')->assertStatus(200);
        $this->actingAs($hrMgr)->get('/manager/hr/jobs')->assertStatus(200);
        $this->actingAs($hrMgr)->get('/manager/hr/messages')->assertStatus(200);
        $this->actingAs($hrMgr)->get('/manager/employees')->assertStatus(200);

        // Forbidden
        $this->actingAs($hrMgr)->get('/manager/content')->assertStatus(403);
        $this->actingAs($hrMgr)->get('/manager/store')->assertStatus(403);
    }

    // ─── 7. Super Admin ──────────────────────────────────────────────────────

    public function test_super_admin_can_access_all_portals(): void
    {
        $superAdmin = User::factory()->create([
            'role' => 'super_admin',
            'is_super_admin' => true,
        ]);

        $this->actingAs($superAdmin)->get('/manager/content')->assertStatus(200);
        $this->actingAs($superAdmin)->get('/manager/store')->assertStatus(200);
        $this->actingAs($superAdmin)->get('/manager/hr')->assertStatus(200);
        $this->actingAs($superAdmin)->get('/manager/employees')->assertStatus(200);
    }

    public function test_super_admin_is_excluded_from_employee_manager_list(): void
    {
        $superAdmin = User::factory()->create([
            'name' => 'Monarch Super Admin',
            'email' => 'super@monarchi.com.gh',
            'role' => 'super_admin',
            'is_super_admin' => true,
        ]);

        $hrMgr = User::factory()->create([
            'name' => 'Jane HR Lead',
            'email' => 'hrlead@monarchi.com.gh',
            'role' => 'hr_manager',
            'is_super_admin' => false,
        ]);

        $response = $this->actingAs($hrMgr)->get('/manager/employees');
        $response->assertStatus(200);
        $response->assertSee('Jane HR Lead');
        $response->assertDontSee('Monarch Super Admin');
    }

    public function test_super_admin_cannot_be_created_or_deleted_via_employee_portal(): void
    {
        $hrMgr = User::factory()->create([
            'role' => 'hr_manager',
            'is_super_admin' => false,
        ]);

        $superAdmin = User::factory()->create([
            'role' => 'super_admin',
            'is_super_admin' => true,
        ]);

        // Attempt to create super_admin role through manager employee portal -> fails validation
        $response = $this->actingAs($hrMgr)->post('/manager/employees', [
            'name' => 'Hacker Admin',
            'email' => 'hack@monarchi.com.gh',
            'role' => 'super_admin',
            'password' => 'Password123!',
            'password_confirmation' => 'Password123!',
        ]);
        $response->assertSessionHasErrors('role');

        // Attempt to delete super_admin account through employee portal -> 403 Forbidden
        $this->actingAs($hrMgr)->delete('/manager/employees/'.$superAdmin->id)->assertStatus(403);
    }
}
