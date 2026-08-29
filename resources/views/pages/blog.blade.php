<x-main-layout
    title="Engineering Insights & Tech News — MonarchI HQ Blog"
    description="Read the latest articles on artificial intelligence, edge computing, African tech ecosystems, and enterprise software engineering from MonarchI HQ."
    keywords="MonarchI Blog, Tech News Africa, AI Insights, Edge Computing Articles, Software Engineering Trends, African Tech Innovation">

    {{-- =============================================
         BLOG / NEWS HERO
    ============================================= --}}
    <section class="relative pt-32 pb-20 px-6 min-h-[50vh] flex items-center justify-center overflow-hidden" style="background: var(--bg-primary);">
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0 pointer-events-none">
            <div class="absolute top-[-20%] left-[-10%] w-[60%] h-[80%] rounded-full opacity-20 blur-[120px]" style="background: radial-gradient(circle, #2997ff, transparent 70%);"></div>
            <div class="absolute bottom-[-20%] right-[-10%] w-[50%] h-[60%] rounded-full opacity-10 blur-[100px]" style="background: radial-gradient(circle, #2997ff, transparent 70%);"></div>
        </div>

        <div class="max-w-[1000px] mx-auto text-center relative z-10 reveal">
            <h1 class="text-xs font-bold tracking-[0.25em] text-[#2997ff] uppercase mb-6">Trending Now</h1>
            <h2 class="text-5xl md:text-7xl font-bold tracking-tight mb-8 leading-tight" style="color: var(--text-primary);">
                Monarchi <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#2997ff] to-[#8ebcf2]">Insights</span>.
            </h2>
            <p class="text-xl md:text-2xl max-w-2xl mx-auto font-light leading-relaxed" style="color: var(--text-secondary);">
                African &amp; Global Tech news, deep dives into edge AI, telemetry architectures, and modern software design.
            </p>
        </div>
    </section>

    @if($articles->isEmpty())
    {{-- ── Empty State ── --}}
    <section class="py-24 px-6 text-center border-t" style="border-color: var(--border-color); background: var(--bg-section);">
        <p class="text-lg mb-6" style="color: var(--text-secondary);">No articles published yet. Check back soon.</p>
    </section>

    @else

    {{-- =============================================
         FEATURED ARTICLE
    ============================================= --}}
    @if($featured)
    <section class="py-12 px-6 z-10 relative border-t" style="border-color: var(--border-color); background: var(--bg-section);">
        <div class="max-w-[1200px] mx-auto">

            <div class="rounded-[2rem] p-8 md:p-12 border transition duration-500 hover:shadow-2xl flex flex-col lg:flex-row items-center gap-8 lg:gap-12 group"
                 style="background: var(--bg-card); border-color: var(--border-color);">
                <div class="w-full lg:w-1/2 rounded-2xl overflow-hidden h-[300px] lg:h-[360px] relative border" style="border-color: var(--border-color); background: var(--bg-primary);">
                    <div class="absolute inset-0 flex items-center justify-center p-8 bg-gradient-to-br from-[#2997ff]/20 to-transparent">
                        <div class="text-center">
                            <span class="text-xs font-mono font-bold uppercase tracking-widest text-[#2997ff] block mb-2">
                                {{ $featured->categoryLabel() }}
                            </span>
                            <h4 class="text-2xl font-bold text-white">{{ $featured->title }}</h4>
                        </div>
                    </div>
                </div>
                <div class="w-full lg:w-1/2">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="text-xs font-bold uppercase tracking-wider text-[#2997ff]">Featured</span>
                        <span class="text-xs text-gray-400">&middot; {{ $featured->read_time_minutes }} min read</span>
                        @if($featured->published_at)
                        <span class="text-xs text-gray-400">&middot; {{ $featured->published_at->format('M Y') }}</span>
                        @endif
                    </div>
                    <h3 class="text-2xl md:text-4xl font-bold mb-4 group-hover:text-[#2997ff] transition leading-tight" style="color: var(--text-primary);">
                        {{ $featured->title }}
                    </h3>
                    @if($featured->excerpt)
                    <p class="text-sm md:text-base leading-relaxed mb-6" style="color: var(--text-secondary);">
                        {{ $featured->excerpt }}
                    </p>
                    @endif
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-[#2997ff]/20 text-[#2997ff] font-bold text-xs flex items-center justify-center">
                            {{ strtoupper(substr($featured->author_name, 0, 3)) }}
                        </div>
                        <span class="text-xs font-semibold" style="color: var(--text-primary);">{{ $featured->author_name }}</span>
                    </div>
                </div>
            </div>

        </div>
    </section>
    @endif

    {{-- =============================================
         ARTICLES GRID
    ============================================= --}}
    @if($rest->count() > 0)
    <section class="py-16 px-6 z-10 relative border-t" style="border-color: var(--border-color); background: var(--bg-primary);">
        <div class="max-w-[1200px] mx-auto">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($rest as $article)
                <div class="p-6 rounded-3xl border transition duration-300 hover:shadow-xl flex flex-col justify-between group"
                     style="background: var(--bg-card); border-color: var(--border-color);">
                    <div>
                        <div class="flex items-center gap-2 mb-3">
                            {{-- Category Tag --}}
                            @php
                                $tagColor = match($article->category) {
                                    'african_tech' => 'text-amber-400',
                                    'global_tech'  => 'text-purple-400',
                                    default        => 'text-[#2997ff]',
                                };
                            @endphp
                            <span class="text-[10px] font-bold uppercase tracking-wider {{ $tagColor }}">
                                {{ $article->categoryLabel() }}
                            </span>
                            <span class="text-[10px] text-gray-400">&middot; {{ $article->read_time_minutes }} min read</span>
                        </div>
                        <h4 class="text-lg font-bold mb-3 group-hover:text-[#2997ff] transition" style="color: var(--text-primary);">
                            {{ $article->title }}
                        </h4>
                        @if($article->excerpt)
                        <p class="text-xs leading-relaxed mb-6" style="color: var(--text-secondary);">
                            {{ Str::limit($article->excerpt, 120) }}
                        </p>
                        @endif
                    </div>
                    <div class="pt-4 border-t flex items-center justify-between text-xs" style="border-color: var(--border-color);">
                        <span style="color: var(--text-muted);">{{ $article->published_at?->format('M Y') ?? '' }}</span>
                        <span class="font-bold text-[#2997ff] group-hover:translate-x-1 transition-transform">&rarr;</span>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </section>
    @endif

    @endif {{-- end articles check --}}

</x-main-layout>