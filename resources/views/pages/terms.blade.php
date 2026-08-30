<x-main-layout
    title="Terms of Service — MonarchI HQ"
    description="Review the MonarchI HQ Terms of Service governing the use of our enterprise software, cloud infrastructure, AI models, and digital services."
    keywords="Terms of Service, MonarchI HQ, Enterprise Agreement, SLA, Software Terms">

    <section class="relative pt-32 pb-16 px-6 overflow-hidden" style="background: var(--bg-primary);">
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0 pointer-events-none">
            <div class="absolute top-[-10%] right-[-10%] w-[50%] h-[70%] rounded-full opacity-15 blur-[120px]" style="background: radial-gradient(circle, #2997ff, transparent 70%);"></div>
        </div>
        <div class="max-w-[860px] mx-auto text-center relative z-10 reveal">
            <span class="text-xs font-bold tracking-[0.25em] text-[#2997ff] uppercase mb-4 inline-block">Terms & Agreement</span>
            <h1 class="text-4xl md:text-6xl font-bold tracking-tight mb-6" style="color: var(--text-primary);">Terms of Service</h1>
            <p class="text-base md:text-lg max-w-xl mx-auto font-light leading-relaxed" style="color: var(--text-secondary);">
                Effective Date: {{ date('F Y') }}. Please read these terms carefully before accessing or using MonarchI systems and products.
            </p>
        </div>
    </section>

    <section class="py-16 px-6 z-10 relative border-t" style="border-color: var(--border-color); background: var(--bg-section);">
        <div class="max-w-[860px] mx-auto space-y-12 reveal">
            
            <div class="p-8 md:p-10 rounded-3xl" style="background: var(--bg-card); border: 1px solid var(--border-color);">
                <h2 class="text-2xl font-semibold mb-4" style="color: var(--text-primary);">1. Acceptance of Terms</h2>
                <p class="text-sm md:text-base leading-relaxed" style="color: var(--text-secondary);">
                    By accessing or using any website, API, software suite, or service operated by MonarchI HQ ("MonarchI"), you agree to be legally bound by these Terms of Service. If you are entering into this agreement on behalf of a company, you represent that you have the authority to bind such entity.
                </p>
            </div>

            <div class="p-8 md:p-10 rounded-3xl" style="background: var(--bg-card); border: 1px solid var(--border-color);">
                <h2 class="text-2xl font-semibold mb-4" style="color: var(--text-primary);">2. Acceptable Use Policy</h2>
                <p class="text-sm md:text-base leading-relaxed mb-3" style="color: var(--text-secondary);">
                    You agree not to use MonarchI infrastructure, AI models, or services to:
                </p>
                <ul class="list-disc pl-6 space-y-2 text-sm md:text-base" style="color: var(--text-secondary);">
                    <li>Violate applicable local, national, or international regulations.</li>
                    <li>Conduct unauthorized vulnerability scanning, penetration testing, or reverse engineering of proprietary algorithms.</li>
                    <li>Deploy malicious payloads, launch distributed denial-of-service (DDoS) attacks, or disrupt platform integrity.</li>
                    <li>Circumvent account tier limits or authentication boundaries.</li>
                </ul>
            </div>

            <div class="p-8 md:p-10 rounded-3xl" style="background: var(--bg-card); border: 1px solid var(--border-color);">
                <h2 class="text-2xl font-semibold mb-4" style="color: var(--text-primary);">3. Intellectual Property Rights</h2>
                <p class="text-sm md:text-base leading-relaxed" style="color: var(--text-secondary);">
                    All proprietary algorithms, software frameworks, MAI model weights, user interfaces, branding, and visual assets are the exclusive intellectual property of MonarchI HQ. Customers retain 100% ownership of their uploaded business data and custom outputs produced by licensed services.
                </p>
            </div>

            <div class="p-8 md:p-10 rounded-3xl" style="background: var(--bg-card); border: 1px solid var(--border-color);">
                <h2 class="text-2xl font-semibold mb-4" style="color: var(--text-primary);">4. Service Availability & SLA</h2>
                <p class="text-sm md:text-base leading-relaxed" style="color: var(--text-secondary);">
                    MonarchI strives to maintain 99.9% uptime across production cloud endpoints. Enterprise agreements may specify customized Service Level Agreements (SLAs) with dedicated failover and 24/7 engineering response protocols.
                </p>
            </div>

            <div class="p-8 md:p-10 rounded-3xl" style="background: var(--bg-card); border: 1px solid var(--border-color);">
                <h2 class="text-2xl font-semibold mb-4" style="color: var(--text-primary);">5. Contact & Legal Notices</h2>
                <p class="text-sm md:text-base leading-relaxed mb-4" style="color: var(--text-secondary);">
                    For contractual inquiries or formal legal notices, please write to our legal team:
                </p>
                <div class="p-4 rounded-xl inline-block" style="background: rgba(41,151,255,0.08); border: 1px solid rgba(41,151,255,0.2);">
                    <p class="text-sm font-mono text-[#2997ff]">legal@monarchihq.com</p>
                    <p class="text-xs mt-1" style="color: var(--text-muted);">MonarchI HQ Legal Department, Accra, Ghana</p>
                </div>
            </div>

        </div>
    </section>

</x-main-layout>
