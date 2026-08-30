<x-main-layout
    title="License & Authorization — MonarchI HQ"
    description="Review software licensing terms, commercial authorizations, and open source acknowledgments for MonarchI HQ software and systems."
    keywords="Licenses, Open Source Attribution, MonarchI Authorization, Intellectual Property">

    <section class="relative pt-32 pb-16 px-6 overflow-hidden" style="background: var(--bg-primary);">
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0 pointer-events-none">
            <div class="absolute top-[-10%] right-[-10%] w-[50%] h-[70%] rounded-full opacity-15 blur-[120px]" style="background: radial-gradient(circle, #2997ff, transparent 70%);"></div>
        </div>
        <div class="max-w-[860px] mx-auto text-center relative z-10 reveal">
            <span class="text-xs font-bold tracking-[0.25em] text-[#2997ff] uppercase mb-4 inline-block">Compliance & Attribution</span>
            <h1 class="text-4xl md:text-6xl font-bold tracking-tight mb-6" style="color: var(--text-primary);">License & Authorization</h1>
            <p class="text-base md:text-lg max-w-xl mx-auto font-light leading-relaxed" style="color: var(--text-secondary);">
                Commercial licensing frameworks, intellectual property boundaries, and open-source acknowledgments.
            </p>
        </div>
    </section>

    <section class="py-16 px-6 z-10 relative border-t" style="border-color: var(--border-color); background: var(--bg-section);">
        <div class="max-w-[860px] mx-auto space-y-12 reveal">
            
            <div class="p-8 md:p-10 rounded-3xl" style="background: var(--bg-card); border: 1px solid var(--border-color);">
                <h2 class="text-2xl font-semibold mb-4" style="color: var(--text-primary);">1. Proprietary Commercial Licenses</h2>
                <p class="text-sm md:text-base leading-relaxed mb-4" style="color: var(--text-secondary);">
                    MonarchI HQ enterprise software suites, including the MAI Engine, invenStore, iLyft fleet automation, and bespoke client architectures, are distributed under proprietary commercial license agreements. Unauthorized redistribution, decompilation, or modification is strictly prohibited.
                </p>
            </div>

            <div class="p-8 md:p-10 rounded-3xl" style="background: var(--bg-card); border: 1px solid var(--border-color);">
                <h2 class="text-2xl font-semibold mb-4" style="color: var(--text-primary);">2. Open Source Contributions & Attribution</h2>
                <p class="text-sm md:text-base leading-relaxed mb-4" style="color: var(--text-secondary);">
                    MonarchI proudly contributes to and leverages world-class open source technologies. We acknowledge and adhere to the licenses of upstream libraries, including Laravel (MIT), Vue/React, TailwindCSS, GSAP, and PostgreSQL under their respective open source frameworks.
                </p>
                <div class="p-5 rounded-2xl" style="background: var(--bg-secondary); border: 1px solid var(--border-color);">
                    <p class="text-sm font-mono text-[#2997ff]">Copyright &copy; {{ date('Y') }} MonarchI HQ & Contributing Authors.</p>
                    <p class="text-xs mt-2" style="color: var(--text-secondary);">All registered trademarks and brand identifiers are the property of their respective owners.</p>
                </div>
            </div>

            <div class="p-8 md:p-10 rounded-3xl" style="background: var(--bg-card); border: 1px solid var(--border-color);">
                <h2 class="text-2xl font-semibold mb-4" style="color: var(--text-primary);">3. Licensing Inquiries</h2>
                <p class="text-sm md:text-base leading-relaxed mb-4" style="color: var(--text-secondary);">
                    For OEM licensing, white-label agreements, or custom enterprise software deployments, contact our enterprise licensing desk:
                </p>
                <div class="p-4 rounded-xl inline-block" style="background: rgba(41,151,255,0.08); border: 1px solid rgba(41,151,255,0.2);">
                    <p class="text-sm font-mono text-[#2997ff]">licensing@monarchihq.com</p>
                    <p class="text-xs mt-1" style="color: var(--text-muted);">MonarchI HQ Licensing Office</p>
                </div>
            </div>

        </div>
    </section>

</x-main-layout>
