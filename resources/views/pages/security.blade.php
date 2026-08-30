<x-main-layout
    title="Security Overview — MonarchI HQ"
    description="Discover how MonarchI HQ safeguards corporate infrastructure with bank-grade encryption, zero-trust architecture, and robust access controls."
    keywords="Security Architecture, MonarchI HQ, SOC2, Zero Trust, Enterprise Encryption, ABAC Security">

    <section class="relative pt-32 pb-16 px-6 overflow-hidden" style="background: var(--bg-primary);">
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0 pointer-events-none">
            <div class="absolute top-[-10%] left-[-10%] w-[50%] h-[70%] rounded-full opacity-15 blur-[120px]" style="background: radial-gradient(circle, #2997ff, transparent 70%);"></div>
        </div>
        <div class="max-w-[860px] mx-auto text-center relative z-10 reveal">
            <span class="text-xs font-bold tracking-[0.25em] text-[#2997ff] uppercase mb-4 inline-block">Enterprise Trust</span>
            <h1 class="text-4xl md:text-6xl font-bold tracking-tight mb-6" style="color: var(--text-primary);">Security Architecture</h1>
            <p class="text-base md:text-lg max-w-xl mx-auto font-light leading-relaxed" style="color: var(--text-secondary);">
                Engineered from the silicon up with zero-trust principles, fortified cryptography, and continuous compliance monitoring.
            </p>
        </div>
    </section>

    <section class="py-16 px-6 z-10 relative border-t" style="border-color: var(--border-color); background: var(--bg-section);">
        <div class="max-w-[860px] mx-auto space-y-12 reveal">
            
            <div class="p-8 md:p-10 rounded-3xl" style="background: var(--bg-card); border: 1px solid var(--border-color);">
                <h2 class="text-2xl font-semibold mb-6" style="color: var(--text-primary);">Security Pillars</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="p-6 rounded-2xl" style="background: var(--bg-secondary); border: 1px solid var(--border-color);">
                        <div class="w-10 h-10 rounded-xl bg-[#2997ff]/10 text-[#2997ff] flex items-center justify-center mb-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        </div>
                        <h3 class="text-base font-semibold mb-2" style="color: var(--text-primary);">End-to-End Encryption</h3>
                        <p class="text-xs md:text-sm leading-relaxed" style="color: var(--text-secondary);">TLS 1.3 in transit with strict HSTS, and AES-256 with rotating customer-managed encryption keys for data at rest.</p>
                    </div>

                    <div class="p-6 rounded-2xl" style="background: var(--bg-secondary); border: 1px solid var(--border-color);">
                        <div class="w-10 h-10 rounded-xl bg-[#2997ff]/10 text-[#2997ff] flex items-center justify-center mb-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        </div>
                        <h3 class="text-base font-semibold mb-2" style="color: var(--text-primary);">Attribute-Based Access (ABAC)</h3>
                        <p class="text-xs md:text-sm leading-relaxed" style="color: var(--text-secondary);">Granular role gates, multi-factor authentication (MFA), and tokenized API authorizations across manager systems.</p>
                    </div>

                    <div class="p-6 rounded-2xl" style="background: var(--bg-secondary); border: 1px solid var(--border-color);">
                        <div class="w-10 h-10 rounded-xl bg-[#2997ff]/10 text-[#2997ff] flex items-center justify-center mb-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                        </div>
                        <h3 class="text-base font-semibold mb-2" style="color: var(--text-primary);">Isolated Cloud Containers</h3>
                        <p class="text-xs md:text-sm leading-relaxed" style="color: var(--text-secondary);">Stateless Fly.io micro-VMs with dedicated memory partitions and isolated networking protocols.</p>
                    </div>

                    <div class="p-6 rounded-2xl" style="background: var(--bg-secondary); border: 1px solid var(--border-color);">
                        <div class="w-10 h-10 rounded-xl bg-[#2997ff]/10 text-[#2997ff] flex items-center justify-center mb-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </div>
                        <h3 class="text-base font-semibold mb-2" style="color: var(--text-primary);">Edge Threat Mitigation</h3>
                        <p class="text-xs md:text-sm leading-relaxed" style="color: var(--text-secondary);">Real-time rate limiting, WAF filtering against OWASP Top 10 vulnerabilities, and automated DDoS mitigation.</p>
                    </div>
                </div>
            </div>

            <div class="p-8 md:p-10 rounded-3xl" style="background: var(--bg-card); border: 1px solid var(--border-color);">
                <h2 class="text-2xl font-semibold mb-4" style="color: var(--text-primary);">Responsible Vulnerability Disclosure</h2>
                <p class="text-sm md:text-base leading-relaxed mb-4" style="color: var(--text-secondary);">
                    We welcome ethical security researchers to report potential vulnerabilities. We review and remediate reports under strict response timelines.
                </p>
                <div class="p-4 rounded-xl inline-block" style="background: rgba(41,151,255,0.08); border: 1px solid rgba(41,151,255,0.2);">
                    <p class="text-sm font-mono text-[#2997ff]">security-disclosure@monarchihq.com</p>
                    <p class="text-xs mt-1" style="color: var(--text-muted);">PGP Key available upon request.</p>
                </div>
            </div>

        </div>
    </section>

</x-main-layout>
