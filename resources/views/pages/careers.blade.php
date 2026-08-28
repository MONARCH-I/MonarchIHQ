<x-main-layout>

    {{-- =============================================
         CAREERS HERO
    ============================================= --}}
    <section class="relative pt-32 pb-20 px-6 min-h-[55vh] flex items-center justify-center overflow-hidden" style="background: var(--bg-primary);">
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0 pointer-events-none">
            <div class="absolute top-[-20%] right-[-10%] w-[60%] h-[80%] rounded-full opacity-20 blur-[120px]" style="background: radial-gradient(circle, #2997ff, transparent 70%);"></div>
            <div class="absolute bottom-[-20%] left-[-10%] w-[50%] h-[60%] rounded-full opacity-10 blur-[100px]" style="background: radial-gradient(circle, #2997ff, transparent 70%);"></div>
        </div>

        <div class="max-w-[1000px] mx-auto text-center relative z-10 reveal">
            <h1 class="text-xs font-bold tracking-[0.25em] text-[#2997ff] uppercase mb-6">Join Our Team</h1>
            <h2 class="text-5xl md:text-7xl font-bold tracking-tight mb-8 leading-tight" style="color: var(--text-primary);">
                Build the Next Frontier of <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#2997ff] to-[#8ebcf2]">Global Technology.</span>
            </h2>
            <p class="text-xl md:text-2xl max-w-2xl mx-auto font-light leading-relaxed" style="color: var(--text-secondary);">
                We are a team of systems architects, AI engineers, and product designers solving high-complexity problems with craft and obsession.
            </p>
        </div>
    </section>

    {{-- =============================================
         CULTURE & VALUES
    ============================================= --}}
    <section class="py-20 px-6 z-10 relative border-t" style="border-color: var(--border-color); background: var(--bg-section);">
        <div class="max-w-[1200px] mx-auto">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <h3 class="text-xs font-bold uppercase tracking-widest text-[#2997ff] mb-2">Our Engineering Ethos</h3>
                <h2 class="text-3xl md:text-4xl font-bold" style="color: var(--text-primary);">Why Engineers Thrive at MonarchI</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="p-8 rounded-3xl border" style="background: var(--bg-card); border-color: var(--border-color);">
                    <div class="w-12 h-12 rounded-2xl bg-blue-500/10 text-[#2997ff] flex items-center justify-center font-bold text-xl mb-6">⚡</div>
                    <h4 class="text-xl font-bold mb-3" style="color: var(--text-primary);">Extreme Craftsmanship</h4>
                    <p class="text-sm leading-relaxed" style="color: var(--text-secondary);">We care deeply about clean code, zero-latency micro-interactions, robust database design, and architectural integrity. No cutting corners.</p>
                </div>

                <div class="p-8 rounded-3xl border" style="background: var(--bg-card); border-color: var(--border-color);">
                    <div class="w-12 h-12 rounded-2xl bg-blue-500/10 text-[#2997ff] flex items-center justify-center font-bold text-xl mb-6">🌐</div>
                    <h4 class="text-xl font-bold mb-3" style="color: var(--text-primary);">African Roots, Global Scale</h4>
                    <p class="text-sm leading-relaxed" style="color: var(--text-secondary);">Headquartered in Accra with global deployment standards. We build software and hardware that solves real infrastructural challenges across markets.</p>
                </div>

                <div class="p-8 rounded-3xl border" style="background: var(--bg-card); border-color: var(--border-color);">
                    <div class="w-12 h-12 rounded-2xl bg-blue-500/10 text-[#2997ff] flex items-center justify-center font-bold text-xl mb-6">🚀</div>
                    <h4 class="text-xl font-bold mb-3" style="color: var(--text-primary);">Autonomous Ownership</h4>
                    <p class="text-sm leading-relaxed" style="color: var(--text-secondary);">Engineers lead projects end-to-end. We value high agency, clear technical writing, rapid prototyping, and shipping production-grade systems.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- =============================================
         OPEN POSITIONS (Dynamic)
    ============================================= --}}
    <section class="py-20 px-6 z-10 relative border-t" style="border-color: var(--border-color); background: var(--bg-primary);">
        <div class="max-w-[1000px] mx-auto">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <h3 class="text-xs font-bold uppercase tracking-widest text-[#2997ff] mb-2">Open Positions</h3>
                <h2 class="text-3xl md:text-4xl font-bold" style="color: var(--text-primary);">Find Your Role at MonarchI</h2>
            </div>

            @if($jobs->isEmpty())
            {{-- No open positions --}}
            <div class="p-10 rounded-3xl border text-center" style="background: var(--bg-card); border-color: var(--border-color);">
                <div class="text-4xl mb-4">🔭</div>
                <h4 class="text-xl font-bold mb-2" style="color: var(--text-primary);">No open positions right now</h4>
                <p class="text-sm max-w-md mx-auto mb-6" style="color: var(--text-secondary);">We're always looking for exceptional engineers, mathematicians, and builders. Send us your GitHub or portfolio for future opportunities.</p>
                <a href="mailto:careers@monarchi.com.gh?subject=General%20Engineering%20Inquiry" class="text-sm font-bold text-[#2997ff] hover:underline">
                    Send General Application &rarr;
                </a>
            </div>

            @else
            <div class="space-y-4">
                @foreach($jobs as $job)
                <div class="p-6 sm:p-8 rounded-2xl border transition duration-300 hover:border-[#2997ff] flex flex-col sm:flex-row sm:items-center justify-between gap-6"
                     style="background: var(--bg-card); border-color: var(--border-color);">
                    <div>
                        <div class="flex items-center gap-3 mb-2">
                            <span class="text-xs font-bold uppercase tracking-wider text-[#2997ff]">{{ $job->department }}</span>
                            <span class="text-xs text-gray-400">&middot; {{ $job->employmentTypeLabel() }}</span>
                            <span class="text-xs text-gray-400">&middot; {{ $job->location }}</span>
                        </div>
                        <h4 class="text-xl font-bold" style="color: var(--text-primary);">{{ $job->title }}</h4>
                        @if($job->skills_required)
                        <p class="text-xs mt-2" style="color: var(--text-muted);">{{ $job->skills_required }}</p>
                        @endif
                    </div>
                    <a href="mailto:{{ $job->apply_email }}?subject=Application:%20{{ rawurlencode($job->title) }}"
                       class="px-6 py-3 bg-[#2997ff] text-white rounded-xl text-xs font-bold hover:bg-[#1a7de3] transition text-center shrink-0">
                        Apply for Role &rarr;
                    </a>
                </div>
                @endforeach
            </div>

            {{-- General Application Note --}}
            <div class="mt-12 p-8 rounded-3xl border text-center" style="background: var(--bg-card); border-color: var(--border-color);">
                <h4 class="text-lg font-bold mb-2" style="color: var(--text-primary);">Don't see your exact role?</h4>
                <p class="text-xs max-w-md mx-auto mb-6" style="color: var(--text-secondary);">
                    We are always looking for exceptional engineers, mathematicians, and builders. Send us your GitHub or portfolio.
                </p>
                <a href="mailto:careers@monarchi.com.gh?subject=General%20Engineering%20Inquiry" class="text-xs font-bold text-[#2997ff] hover:underline">
                    Send General Application &rarr;
                </a>
            </div>
            @endif

        </div>
    </section>

</x-main-layout>