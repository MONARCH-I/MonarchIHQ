<x-main-layout
    title="Privacy Policy — MonarchI HQ"
    description="Read the MonarchI HQ Privacy Policy to understand how we collect, protect, process, and respect enterprise and user data across our AI and cloud services."
    keywords="Privacy Policy, MonarchI HQ, Data Protection, GDPR, Enterprise Security, AI Privacy">

    {{-- Hero --}}
    <section class="relative pt-32 pb-16 px-6 overflow-hidden" style="background: var(--bg-primary);">
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0 pointer-events-none">
            <div class="absolute top-[-10%] left-[-10%] w-[50%] h-[70%] rounded-full opacity-15 blur-[120px]" style="background: radial-gradient(circle, #2997ff, transparent 70%);"></div>
        </div>
        <div class="max-w-[860px] mx-auto text-center relative z-10 reveal">
            <span class="text-xs font-bold tracking-[0.25em] text-[#2997ff] uppercase mb-4 inline-block">Legal & Compliance</span>
            <h1 class="text-4xl md:text-6xl font-bold tracking-tight mb-6" style="color: var(--text-primary);">Privacy Policy</h1>
            <p class="text-base md:text-lg max-w-xl mx-auto font-light leading-relaxed" style="color: var(--text-secondary);">
                Last updated: {{ date('F Y') }}. Our commitments to enterprise privacy, zero-data-leakage artificial intelligence, and global compliance.
            </p>
        </div>
    </section>

    {{-- Content Body --}}
    <section class="py-16 px-6 z-10 relative border-t" style="border-color: var(--border-color); background: var(--bg-section);">
        <div class="max-w-[860px] mx-auto space-y-12 reveal">
            
            <div class="p-8 md:p-10 rounded-3xl" style="background: var(--bg-card); border: 1px solid var(--border-color);">
                <h2 class="text-2xl font-semibold mb-4" style="color: var(--text-primary);">1. Overview & Commitment</h2>
                <p class="text-sm md:text-base leading-relaxed mb-4" style="color: var(--text-secondary);">
                    MonarchI HQ ("MonarchI", "we", "us", or "our") is dedicated to protecting your privacy and ensuring the security of your corporate and personal data. This Privacy Policy details the types of information we collect, how it is processed and stored, and your rights regarding your data across our platforms, including the MonarchI ecosystem, MAI AI models, APIs, and client portals.
                </p>
            </div>

            <div class="p-8 md:p-10 rounded-3xl" style="background: var(--bg-card); border: 1px solid var(--border-color);">
                <h2 class="text-2xl font-semibold mb-4" style="color: var(--text-primary);">2. Information We Collect</h2>
                <ul class="space-y-3 text-sm md:text-base leading-relaxed" style="color: var(--text-secondary);">
                    <li><strong>Account & Profile Data:</strong> Name, work email address, organization name, authentication credentials, and billing contact details when you register or order services.</li>
                    <li><strong>Service Usage & Diagnostics:</strong> Telemetry, API request logs, browser metadata, operating system, and performance metrics to ensure uptime and platform security.</li>
                    <li><strong>Payment Information:</strong> Transaction identifiers and payment status handled via PCI-DSS compliant gateways (Paystack). MonarchI does not store raw credit card numbers.</li>
                </ul>
            </div>

            <div class="p-8 md:p-10 rounded-3xl" style="background: var(--bg-card); border: 1px solid var(--border-color);">
                <h2 class="text-2xl font-semibold mb-4" style="color: var(--text-primary);">3. AI Data Processing (MAI Model)</h2>
                <p class="text-sm md:text-base leading-relaxed mb-4" style="color: var(--text-secondary);">
                    MonarchI’s proprietary AI engine (MAI) adheres to strict zero-retention principles for enterprise tenants. Customer proprietary data and queries transmitted to MAI models are <strong>never used to train public foundation models</strong> without explicit written authorization.
                </p>
            </div>

            <div class="p-8 md:p-10 rounded-3xl" style="background: var(--bg-card); border: 1px solid var(--border-color);">
                <h2 class="text-2xl font-semibold mb-4" style="color: var(--text-primary);">4. Data Retention & Security</h2>
                <p class="text-sm md:text-base leading-relaxed mb-4" style="color: var(--text-secondary);">
                    All data in transit is encrypted using TLS 1.3, and data at rest is protected with AES-256 encryption. We enforce least-privilege attribute-based access control (ABAC) across all employee systems. Data is retained only as long as necessary to fulfill active contracts and regulatory requirements.
                </p>
            </div>

            <div class="p-8 md:p-10 rounded-3xl" style="background: var(--bg-card); border: 1px solid var(--border-color);">
                <h2 class="text-2xl font-semibold mb-4" style="color: var(--text-primary);">5. Your Rights & Inquiries</h2>
                <p class="text-sm md:text-base leading-relaxed mb-4" style="color: var(--text-secondary);">
                    You have the right to access, rectify, export, or request the erasure of your personal data at any time. For privacy inquiries or data compliance requests, contact our Data Protection Officer at:
                </p>
                <div class="p-4 rounded-xl inline-block" style="background: rgba(41,151,255,0.08); border: 1px solid rgba(41,151,255,0.2);">
                    <p class="text-sm font-mono text-[#2997ff]">privacy@monarchihq.com</p>
                    <p class="text-xs mt-1" style="color: var(--text-muted);">MonarchI HQ, Accra / Tema, Greater Accra, Ghana</p>
                </div>
            </div>

        </div>
    </section>

</x-main-layout>
