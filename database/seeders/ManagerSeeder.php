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
                'body' => "## The Fragmented Continent of Legacy Rail Systems\n\nFor decades, transferring capital across borders in Sub-Saharan Africa was slower and more expensive than sending funds between continents. A transaction from Accra to Abidjan frequently routed through corresponding banks in London or Paris, incurring multiple currency conversion fees and taking upwards of three business days to settle.\n\nToday, modern financial infrastructure is bypassing legacy correspondent banking networks entirely through unified mobile money switches and cryptographic routing layers.\n\n### Interoperability and Real-Time Settlement\n\nBy leveraging open API protocols and decentralized settlement rails, regional fintech operators now achieve sub-second finality. Telco mobile wallets—traditionally siloed by country and operator—now interface via regional clearing bridges.\n\n> \"The real breakthrough isn't just digitizing paper money; it's architecting settlement networks where counterparty risk is eliminated algorithmically in milliseconds.\"\n\n### The Engineering Behind Sub-Second Clearing\n\nBuilding payment bridges capable of 10,000+ operations per second requires:\n\n- **Zero-Loss State Machines**: Event-sourcing architectures that guarantee idempotent transaction ledgering even during transient telecom network drops.\n- **Dynamic Liquidity Routing**: Automated treasury algorithms continuously rebalancing liquidity pools across local currency corridors.\n- **Low-Latency Telemetry**: Real-time fraud scoring executing on lightweight neural inference engines in under 15ms.\n\nAs regulatory frameworks align under the Pan-African Payment and Settlement System (PAPSS), we project intra-continental trade settlement costs will drop by an additional 60% over the next two years.",
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
                'body' => "## When the Cloud is an Intermittent Luxury\n\nMost modern AI architectures assume uninterrupted gigabit broadband and cloud hyper-scalers within 20 milliseconds of latency. In real-world enterprise deployments across West Africa—from deep agricultural zones to coastal maritime telemetry—cellular connectivity is intermittent, variable, and precious.\n\nArchitecting production-grade machine intelligence in these conditions requires shifting from **Cloud-Dependent AI** to **Resilient Edge-First Inference**.\n\n### Quantization and Local Inference Engines\n\nBy converting full-precision FP32 neural weights to INT8 and INT4 representations via ONNX Runtime and TensorRT, we run compact vision and anomaly detection models directly on embedded NPU silicon drawing under 5 watts of power.\n\n```python\n# Edge Quantization & Inference Pipeline\nimport onnxruntime as ort\n\nsession_options = ort.SessionOptions()\nsession_options.graph_optimization_level = ort.GraphOptimizationLevel.ORT_ENABLE_ALL\nsession = ort.InferenceSession('edge_telemetry_int8.onnx', session_options)\nprediction = session.run(None, {'sensor_inputs': local_buffer})\n```\n\n### Offline-First Event Synchronization\n\nWhen edge nodes operate in disconnected environments, they log inferences, anomalies, and raw sensor telemetry to append-only local SQLite/RocksDB storage.\n\nOnce a network uplink is detected (via LoRaWAN gateway or satellite burst), the node initiates an authenticated bidirectional sync protocol with MonarchI's central cloud platform, minimizing bandwidth while guaranteeing zero data loss.",
                'category' => 'engineering',
                'author_name' => 'Monarchi Engineering Team',
                'read_time_minutes' => 8,
                'is_published' => true,
                'published_at' => now()->subDays(10),
            ],
            [
                'title' => 'Why Global Tech Giants Are Doubling Down on African Markets',
                'slug' => 'global-tech-african-markets-investment',
                'external_url' => 'https://techcrunch.com/2026/08/15/africa-cloud-infrastructure-boom/',
                'excerpt' => 'Google, Microsoft, and Amazon are all accelerating investments in African cloud infrastructure and subsea data cables. Here is the external report on market implications.',
                'body' => 'This article was published externally by TechCrunch covering hyperscaler infrastructure expansions across Accra, Lagos, Nairobi, and Johannesburg.',
                'category' => 'global_tech',
                'author_name' => 'TechCrunch Global Desk',
                'read_time_minutes' => 5,
                'is_published' => true,
                'published_at' => now()->subDays(7),
            ],
            [
                'title' => 'Building Resilient Payment Webhook Pipelines with Paystack',
                'slug' => 'resilient-payment-webhook-pipelines-paystack',
                'body' => "## The Fallacy of Synchronous Payment Callbacks\n\nOne of the most dangerous anti-patterns in ecommerce and financial engineering is trusting immediate browser redirects to determine payment status. Network timeouts, closed browser tabs, and mobile battery exhaustion guarantee that up to 3% of successful transactions will never trigger an in-browser completion callback.\n\nThe only dependable source of transaction truth is **asynchronous cryptographic webhooks**.\n\n### Cryptographic Signature Verification\n\nEvery incoming webhook from Paystack includes a `x-paystack-signature` header containing an HMAC SHA512 signature computed with your private secret key. Always verify this signature prior to reading the JSON payload:\n\n```php\n\$calculatedSignature = hash_hmac('sha512', \$request->getContent(), config('services.paystack.secret_key'));\nif (!hash_equals(\$calculatedSignature, \$request->header('x-paystack-signature', ''))) {\n    abort(401, 'Invalid webhook signature');\n}\n```\n\n### Idempotent Event Handlers\n\nWebhooks operate under an *at-least-once* delivery guarantee. If your server takes more than 5 seconds to respond, the provider will retry the webhook. Without strict idempotency keys, you risk double-crediting customer balances or fulfilling orders twice.\n\nAt MonarchI, every inbound webhook event is hashed into Redis with a 24-hour TTL before database execution. Duplicate payloads return an immediate HTTP 200 OK without re-running business logic.",
                'category' => 'engineering',
                'author_name' => 'Monarchi Engineering Team',
                'read_time_minutes' => 5,
                'is_published' => true,
                'published_at' => now()->subDays(14),
            ],
        ];

        foreach ($articles as $article) {
            NewsArticle::updateOrCreate(['slug' => $article['slug']], $article);
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
                'description' => "We are looking for a Senior Fullstack Engineer to lead architecture across MonarchI's core telemetry engines, payment pipelines, and high-concurrency enterprise services.\n\nYou will build mission-critical web applications, high-performance database queries on PostgreSQL, and real-time dashboards utilizing Livewire 3 and Alpine.js. You will take complete ownership from database schema design to containerized cloud deployments on Fly.io and Docker.",
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
                'description' => 'MonarchI is pioneering offline-first neural inference across low-connectivity African enterprise networks. As an Edge AI Engineer, you will compress and quantize foundation models, run local ONNX pipelines, and integrate state-of-the-art multimodal LLMs (like Google Gemini and local small language models) into autonomous workflow agents.',
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
                'description' => 'Our hardware team designs custom IoT telemetry nodes for precision agriculture, cold-chain logistics, and industrial microgrids. You will design custom PCBs, write firmware in modern C/C++ for ESP32 and ARM Cortex microcontrollers, optimize battery/solar harvesting circuits, and implement LoRaWAN mesh communication protocols.',
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
                'description' => 'Design stunning, high-contrast, liquid-glass digital products that feel fluid and alive. You will craft complete design systems in Figma, build micro-interactions and interactive prototypes, and partner closely with engineers to ensure pixel-perfect fidelity matching the world-class aesthetics of Apple and Grok.',
                'apply_email' => 'careers@monarchi.com.gh',
                'is_active' => true,
                'sort_order' => 4,
            ],
        ];

        foreach ($jobs as $job) {
            JobListing::updateOrCreate(
                ['title' => $job['title'], 'department' => $job['department']],
                $job
            );
        }

        $this->command->info('✅ ManagerSeeder complete: 3 managers, '.count($articles).' articles, '.count($projects).' projects, '.count($jobs).' jobs created.');
    }
}
