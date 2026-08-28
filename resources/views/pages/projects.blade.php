<x-main-layout>

    {{-- =============================================
         PROJECTS HERO
    ============================================= --}}
    <section class="relative pt-32 pb-20 px-6 min-h-[55vh] flex items-center justify-center overflow-hidden" style="background: var(--bg-primary);">
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0 pointer-events-none">
            <div class="absolute top-[-20%] left-[-10%] w-[60%] h-[80%] rounded-full opacity-20 blur-[120px]" style="background: radial-gradient(circle, #2997ff, transparent 70%);"></div>
            <div class="absolute bottom-[-20%] right-[-10%] w-[50%] h-[60%] rounded-full opacity-10 blur-[100px]" style="background: radial-gradient(circle, #2997ff, transparent 70%);"></div>
        </div>

        <div class="max-w-[1000px] mx-auto text-center relative z-10 reveal">
            <h1 class="text-xs font-bold tracking-[0.25em] text-[#2997ff] uppercase mb-6">Our Portfolio</h1>
            <h2 class="text-5xl md:text-7xl font-bold tracking-tight mb-8 leading-tight" style="color: var(--text-primary);">
                Selected <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#2997ff] to-[#8ebcf2]">Engineering</span> <br>
                &amp; Innovation Works.
            </h2>
            <p class="text-xl md:text-2xl max-w-2xl mx-auto font-light leading-relaxed" style="color: var(--text-secondary);">
                Explore our custom enterprise deployments, edge AI models, telemetry networks, and mission-critical cloud infrastructure.
            </p>
        </div>
    </section>

    {{-- =============================================
         PROJECTS SHOWCASE GRID
    ============================================= --}}
    <section class="py-20 px-6 z-10 relative border-t" style="border-color: var(--border-color); background: var(--bg-section);">
        <div class="max-w-[1200px] mx-auto">

            @if($projects->isEmpty())
            {{-- Empty state --}}
            <div class="text-center py-24">
                <p class="text-lg mb-4" style="color: var(--text-secondary);">No projects published yet. Check back soon.</p>
                <a href="{{ url('/contact') }}" class="inline-flex items-center px-6 py-3 bg-[#2997ff] text-white rounded-full text-sm font-bold hover:bg-[#1a7de3] transition">
                    Get in Touch &rarr;
                </a>
            </div>
            @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-10">
                @foreach($projects as $project)
                <div class="rounded-3xl p-8 border transition duration-300 hover:shadow-2xl flex flex-col justify-between group"
                     style="background: var(--bg-card); border-color: var(--border-color);">
                    <div>
                        <div class="flex items-center justify-between mb-6">
                            <span class="text-xs font-bold uppercase tracking-widest text-[#2997ff]">
                                {{ $project->domain }}{{ $project->sub_domain ? ' &middot; ' . $project->sub_domain : '' }}
                            </span>
                            <span class="px-3 py-1 text-[11px] font-semibold rounded-full border {{ $project->statusBadgeClass() }}">
                                {{ $project->status }}
                            </span>
                        </div>
                        <h3 class="text-2xl md:text-3xl font-bold mb-4 group-hover:text-[#2997ff] transition" style="color: var(--text-primary);">
                            {{ $project->title }}
                        </h3>
                        <p class="text-sm leading-relaxed mb-6" style="color: var(--text-secondary);">
                            {{ $project->description }}
                        </p>
                        @if($project->tech_stack)
                        <div class="flex flex-wrap gap-2 mb-8">
                            @foreach($project->tech_stack as $tech)
                            <span class="text-xs font-mono px-2.5 py-1 rounded-lg border" style="background: var(--bg-primary); border-color: var(--border-color); color: var(--text-muted);">{{ $tech }}</span>
                            @endforeach
                        </div>
                        @endif
                    </div>
                    <div class="pt-4 border-t flex items-center justify-between" style="border-color: var(--border-color);">
                        @if($project->metric_label && $project->metric_value)
                        <span class="text-xs font-medium" style="color: var(--text-muted);">{{ $project->metric_label }}: {{ $project->metric_value }}</span>
                        @else
                        <span></span>
                        @endif
                        <a href="{{ url('/contact') }}" class="text-xs font-bold text-[#2997ff] hover:underline flex items-center gap-1">
                            Request Case Study &rarr;
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            @endif

        </div>
    </section>

    {{-- =============================================
         CTA
    ============================================= --}}
    <section class="py-24 px-6 text-center border-t relative overflow-hidden" style="background: var(--bg-primary); border-color: var(--border-color);">
        <div class="max-w-[700px] mx-auto relative z-10">
            <h2 class="text-3xl md:text-5xl font-bold mb-6" style="color: var(--text-primary);">
                Have a Mission-Critical Project?
            </h2>
            <p class="text-base md:text-lg mb-8 leading-relaxed" style="color: var(--text-secondary);">
                Partner with our engineering team to design, build, and deploy high-performance software and connected hardware.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ url('/contact') }}" class="w-full sm:w-auto px-8 py-4 bg-[#2997ff] text-white rounded-full text-sm font-bold hover:bg-[#1a7de3] transition shadow-lg hover:shadow-xl hover:-translate-y-0.5 transform">
                    Schedule Engineering Consult &rarr;
                </a>
                <a href="{{ route('store.index') }}" class="w-full sm:w-auto px-8 py-4 rounded-full text-sm font-bold border hover:bg-black/5 dark:hover:bg-white/5 transition" style="border-color: var(--border-color); color: var(--text-primary);">
                    Explore Our Store
                </a>
            </div>
        </div>
    </section>

</x-main-layout>