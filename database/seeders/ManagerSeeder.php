<?php

namespace Database\Seeders;

use App\Models\JobListing;
use App\Models\NewsArticle;
use App\Models\PortfolioProject;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ManagerSeeder extends Seeder
{
    public function run(): void
    {
        // ── Manager Accounts ──────────────────────────────────────────────────
        $managers = [
            [
                'name' => 'Content Manager',
                'email' => 'content@monarchi.com.gh',
                'role' => 'content_manager',
                'password' => Hash::make('ContentMgr@2026!'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Store Manager',
                'email' => 'store@monarchi.com.gh',
                'role' => 'store_manager',
                'password' => Hash::make('StoreMgr@2026!'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'HR Manager',
                'email' => 'hr@monarchi.com.gh',
                'role' => 'hr_manager',
                'password' => Hash::make('HrMgr@2026!'),
                'email_verified_at' => now(),
            ],
        ];

        foreach ($managers as $manager) {
            User::firstOrCreate(['email' => $manager['email']], $manager);
        }

        // ── Sample News Articles ──────────────────────────────────────────────
        $articles = [
            [
                'title' => 'How African Fintechs are Redefining Cross-Border Payments',
                'slug' => 'african-fintechs-redefining-cross-border-payments',
                'excerpt' => 'Mobile money interoperability across West Africa is breaking down legacy banking barriers and enabling millions to transact across borders seamlessly.',
                'body' => 'Full article body here…',
                'category' => 'african_tech',
                'author_name' => 'Monarchi Engineering Team',
                'read_time_minutes' => 6,
                'is_published' => true,
                'published_at' => now()->subDays(3),
            ],
            [
                'title' => 'The Rise of Edge AI in Low-Connectivity Infrastructure',
                'slug' => 'edge-ai-low-connectivity-infrastructure',
                'excerpt' => 'How we architect offline-first neural inference pipelines on embedded edge devices that synchronize telemetry state whenever network handshakes become available.',
                'body' => 'Full article body here…',
                'category' => 'engineering',
                'author_name' => 'Monarchi Engineering Team',
                'read_time_minutes' => 8,
                'is_published' => true,
                'published_at' => now()->subDays(10),
            ],
            [
                'title' => 'Why Global Tech Giants Are Doubling Down on African Markets',
                'slug' => 'global-tech-african-markets-investment',
                'excerpt' => 'Google, Microsoft, and Amazon are all accelerating investments in African cloud infrastructure. Here\'s what that means for local developers.',
                'body' => 'Full article body here…',
                'category' => 'global_tech',
                'author_name' => 'Monarchi Editorial',
                'read_time_minutes' => 5,
                'is_published' => true,
                'published_at' => now()->subDays(7),
            ],
            [
                'title' => 'Building Resilient Payment Webhook Pipelines with Paystack',
                'slug' => 'resilient-payment-webhook-pipelines-paystack',
                'excerpt' => 'A practical architectural pattern for zero-loss payment state synchronization handling signature verification, asynchronous events, and retry policies.',
                'body' => 'Full article body here…',
                'category' => 'engineering',
                'author_name' => 'Monarchi Engineering Team',
                'read_time_minutes' => 5,
                'is_published' => true,
                'published_at' => now()->subDays(14),
            ],
        ];

        foreach ($articles as $article) {
            NewsArticle::firstOrCreate(['slug' => $article['slug']], $article);
        }

        // ── Sample Portfolio Projects ─────────────────────────────────────────
        $projects = [
            [
                'title' => 'MAI Health Intelligence Engine',
                'slug' => 'mai-health-intelligence-engine',
                'description' => 'AI-powered clinical telemetry and workflow automation designed for healthcare providers, surfacing patient trends, reducing paperwork latency by 78%, and flagging anomalies in real-time.',
                'tech_stack' => ['Neural Edge Models', 'Laravel 12', 'WebSockets', 'HL7/FHIR'],
                'domain' => 'Enterprise AI',
                'sub_domain' => 'Healthcare',
                'status' => 'Deployed',
                'status_color' => 'blue',
                'metric_label' => 'Deployment',
                'metric_value' => 'Multi-facility',
                'is_published' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'National Payment Gateway Telemetry',
                'slug' => 'national-payment-gateway-telemetry',
                'description' => 'High-throughput transaction auditing and latency observability platform processing millions in daily volume across mobile money networks and commercial banks with 99.999% uptime.',
                'tech_stack' => ['Paystack / Mobile Money', 'ISO 8583', 'Event-Driven Redis'],
                'domain' => 'Fintech',
                'sub_domain' => 'Infrastructure',
                'status' => 'High Availability',
                'status_color' => 'green',
                'metric_label' => 'Scale',
                'metric_value' => '10M+ daily events',
                'is_published' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'AgriSense Microclimate Telemetry',
                'slug' => 'agrisense-microclimate-telemetry',
                'description' => 'Custom-engineered solar-powered sensor nodes deployed in remote agricultural zones to monitor soil nitrogen, canopy humidity, and evapotranspiration with offline mesh connectivity.',
                'tech_stack' => ['LoRaWAN Mesh', 'C++ Firmware', 'Solar Harvest'],
                'domain' => 'Hardware',
                'sub_domain' => 'Edge IoT',
                'status' => 'Active IoT',
                'status_color' => 'amber',
                'metric_label' => 'Coverage',
                'metric_value' => '400+ km²',
                'is_published' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'SwiftLog Autonomous Dispatch Engine',
                'slug' => 'swiftlog-autonomous-dispatch-engine',
                'description' => 'Enterprise logistics dispatch system with algorithmic route clustering, driver mobile telemetry, and dynamic multi-depot parcel distribution across West Africa.',
                'tech_stack' => ['Graph Routing Alg', 'Live Geo-fencing', 'API Gateway'],
                'domain' => 'SaaS',
                'sub_domain' => 'Logistics',
                'status' => 'Production',
                'status_color' => 'blue',
                'metric_label' => 'Efficiency',
                'metric_value' => '+34% throughput',
                'is_published' => true,
                'sort_order' => 4,
            ],
        ];

        foreach ($projects as $project) {
            PortfolioProject::firstOrCreate(['slug' => $project['slug']], $project);
        }

        // ── Sample Job Listings ───────────────────────────────────────────────
        $jobs = [
            [
                'title' => 'Senior Fullstack / Laravel Systems Engineer',
                'department' => 'Engineering',
                'employment_type' => 'full_time',
                'location' => 'Accra / Hybrid',
                'skills_required' => 'PHP 8.3+, Laravel 12, PostgreSQL/MySQL, TailwindCSS, Livewire/Alpine, High-throughput APIs.',
                'apply_email' => 'careers@monarchi.com.gh',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Edge AI & Applied ML Engineer',
                'department' => 'AI Research & ML',
                'employment_type' => 'full_time',
                'location' => 'Accra / Remote',
                'skills_required' => 'Python, PyTorch/TensorFlow Lite, ONNX Runtime, Edge Inference Optimization, LLM Tool Calling.',
                'apply_email' => 'careers@monarchi.com.gh',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Embedded Systems & IoT Hardware Engineer',
                'department' => 'Hardware',
                'employment_type' => 'full_time',
                'location' => 'Accra On-site',
                'skills_required' => 'C/C++, ESP32/ARM Cortex, LoRaWAN, PCB Layout & Schematic Design, Sensor Integration.',
                'apply_email' => 'careers@monarchi.com.gh',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'Product & UI/UX Designer',
                'department' => 'Design',
                'employment_type' => 'full_time',
                'location' => 'Remote',
                'skills_required' => 'Figma design systems, Micro-animations, Complex Data Dashboards, Dark/Light Mode Systems.',
                'apply_email' => 'careers@monarchi.com.gh',
                'is_active' => true,
                'sort_order' => 4,
            ],
        ];

        foreach ($jobs as $job) {
            JobListing::firstOrCreate(
                ['title' => $job['title'], 'department' => $job['department']],
                $job
            );
        }

        $this->command->info('✅ ManagerSeeder complete: 3 managers, '.count($articles).' articles, '.count($projects).' projects, '.count($jobs).' jobs created.');
    }
}
