<x-main-layout
    title="Engineering Insights & Tech News — MonarchI HQ Blog"
    description="Read the latest articles on artificial intelligence, edge computing, African tech ecosystems, and enterprise software engineering from MonarchI HQ."
    keywords="MonarchI Blog, Tech News Africa, AI Insights, Edge Computing Articles, Software Engineering Trends, African Tech Innovation">

    <div x-data="monarchiArticleReader()" x-init="init()" class="relative min-h-screen" style="background: var(--bg-primary);">

        {{-- =============================================
             BLOG / NEWS HERO
        ============================================= --}}
        <section class="relative pt-32 pb-20 px-6 min-h-[50vh] flex items-center justify-center overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0 pointer-events-none">
                <div class="absolute top-[-20%] left-[-10%] w-[60%] h-[80%] rounded-full opacity-20 blur-[120px]" style="background: radial-gradient(circle, #2997ff, transparent 70%);"></div>
                <div class="absolute bottom-[-20%] right-[-10%] w-[50%] h-[60%] rounded-full opacity-10 blur-[100px]" style="background: radial-gradient(circle, #2997ff, transparent 70%);"></div>
            </div>

            <div class="max-w-[1000px] mx-auto text-center relative z-10 reveal">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full border border-[#2997ff]/30 bg-[#2997ff]/10 text-[#2997ff] text-xs font-semibold tracking-wider uppercase mb-6 backdrop-blur-md">
                    <span class="w-2 h-2 rounded-full bg-[#2997ff] animate-pulse"></span>
                    Trending &amp; Insights
                </div>
                <h2 class="text-5xl md:text-7xl font-bold tracking-tight mb-8 leading-tight" style="color: var(--text-primary);">
                    Monarchi <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#2997ff] via-[#60a5fa] to-[#93c5fd]">Insights</span>.
                </h2>
                <p class="text-xl md:text-2xl max-w-2xl mx-auto font-light leading-relaxed" style="color: var(--text-secondary);">
                    African &amp; Global Tech news, deep dives into edge AI, telemetry architectures, and modern software design.
                </p>
            </div>
        </section>

        @if($articles->isEmpty())
        {{-- ── Empty State ── --}}
        <section class="py-24 px-6 text-center border-t" style="border-color: var(--border-color); background: var(--bg-section);">
            <div class="max-w-md mx-auto p-12 rounded-3xl border border-white/10" style="background: var(--bg-card);">
                <div class="w-14 h-14 rounded-2xl bg-blue-500/10 text-[#2997ff] flex items-center justify-center text-2xl mx-auto mb-4">📰</div>
                <h3 class="text-lg font-bold text-white mb-2">No articles published yet</h3>
                <p class="text-sm" style="color: var(--text-secondary);">Our engineering team is crafting new dispatches. Check back soon.</p>
            </div>
        </section>

        @else

        {{-- =============================================
             FEATURED ARTICLE
        ============================================= --}}
        @if($featured)
        <section class="py-12 px-6 z-10 relative border-t" style="border-color: var(--border-color); background: var(--bg-section);">
            <div class="max-w-[1200px] mx-auto">

                @if($featured->isExternal())
                {{-- External Featured Article --}}
                <a href="{{ $featured->external_url }}" target="_blank" rel="noopener noreferrer"
                   class="rounded-[2rem] p-8 md:p-12 border transition-all duration-500 hover:shadow-2xl hover:border-[#2997ff]/60 flex flex-col lg:flex-row items-center gap-8 lg:gap-12 group cursor-pointer"
                   style="background: var(--bg-card); border-color: var(--border-color);">
                @else
                {{-- Native Featured Article (Opens Modal) --}}
                <div role="button" tabindex="0" @click="openModal({{ $featured->id }})" @keydown.enter="openModal({{ $featured->id }})"
                     class="rounded-[2rem] p-8 md:p-12 border transition-all duration-500 hover:shadow-2xl hover:border-[#2997ff]/60 flex flex-col lg:flex-row items-center gap-8 lg:gap-12 group cursor-pointer select-none"
                     style="background: var(--bg-card); border-color: var(--border-color);">
                @endif
                    <div class="w-full lg:w-1/2 rounded-2xl overflow-hidden h-[300px] lg:h-[360px] relative border" style="border-color: var(--border-color); background: var(--bg-primary);">
                        <div class="absolute inset-0 flex items-center justify-center p-8 bg-gradient-to-br from-[#2997ff]/20 via-[#1e293b]/50 to-transparent">
                            <div class="text-center">
                                <span class="text-xs font-mono font-bold uppercase tracking-widest text-[#2997ff] block mb-2">
                                    {{ $featured->categoryLabel() }}
                                </span>
                                <h4 class="text-2xl font-bold text-white group-hover:text-[#2997ff] transition-colors leading-snug">{{ $featured->title }}</h4>
                            </div>
                        </div>
                        @if($featured->isExternal())
                        <div class="absolute top-4 right-4 px-3 py-1 rounded-full bg-black/60 border border-white/10 text-xs text-sky-300 font-semibold backdrop-blur-md flex items-center gap-1.5">
                            <span>{{ $featured->externalDomain() }}</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                        </div>
                        @else
                        <div class="absolute top-4 right-4 px-3 py-1 rounded-full bg-blue-500/20 border border-blue-400/30 text-xs text-blue-300 font-medium backdrop-blur-md flex items-center gap-1.5">
                            <span>Read Full Article</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                        </div>
                        @endif
                    </div>
                    <div class="w-full lg:w-1/2">
                        <div class="flex items-center gap-3 mb-4 flex-wrap">
                            <span class="text-xs font-bold uppercase tracking-wider text-[#2997ff] px-2.5 py-0.5 rounded-full bg-[#2997ff]/10">Featured</span>
                            <span class="text-xs text-gray-400">&middot; {{ $featured->read_time_minutes }} min read</span>
                            @if($featured->published_at)
                            <span class="text-xs text-gray-400">&middot; {{ $featured->published_at->format('M Y') }}</span>
                            @endif
                            @if($featured->isExternal())
                            <span class="text-xs text-amber-400 bg-amber-400/10 px-2 py-0.5 rounded-full font-medium flex items-center gap-1">
                                External Source ↗
                            </span>
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
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-gradient-to-tr from-[#2997ff] to-sky-300 text-white font-bold text-xs flex items-center justify-center shadow-lg shadow-blue-500/20">
                                    {{ strtoupper(substr($featured->author_name, 0, 2)) }}
                                </div>
                                <div>
                                    <span class="text-xs font-semibold block" style="color: var(--text-primary);">{{ $featured->author_name }}</span>
                                    <span class="text-[10px] text-gray-400">MonarchI Contributor</span>
                                </div>
                            </div>
                            @if($featured->isExternal())
                            <span class="text-xs font-semibold text-[#2997ff] flex items-center gap-1 group-hover:translate-x-1 transition-transform">
                                Open Source ↗
                            </span>
                            @else
                            <span class="text-xs font-semibold text-[#2997ff] flex items-center gap-1 group-hover:translate-x-1 transition-transform">
                                Read Article &rarr;
                            </span>
                            @endif
                        </div>
                    </div>
                @if($featured->isExternal())
                </a>
                @else
                </div>
                @endif

            </div>
        </section>
        @endif

        {{-- =============================================
             ARTICLES GRID
        ============================================= --}}
        @if($rest->count() > 0)
        <section class="py-16 px-6 z-10 relative border-t" style="border-color: var(--border-color); background: var(--bg-primary);">
            <div class="max-w-[1200px] mx-auto">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h3 class="text-xl md:text-2xl font-bold text-white">Latest Dispatches</h3>
                        <p class="text-xs text-gray-400 mt-1">Explore engineering, cloud architecture, and African tech ecosystem insights.</p>
                    </div>
                    <span class="text-xs text-gray-500 font-mono">{{ $articles->count() }} total articles</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($rest as $article)
                    @php
                        $tagColor = match($article->category) {
                            'african_tech' => 'text-amber-400 bg-amber-400/10 border-amber-400/20',
                            'global_tech'  => 'text-purple-400 bg-purple-400/10 border-purple-400/20',
                            default        => 'text-[#2997ff] bg-[#2997ff]/10 border-[#2997ff]/20',
                        };
                    @endphp

                    @if($article->isExternal())
                    {{-- External Card --}}
                    <a href="{{ $article->external_url }}" target="_blank" rel="noopener noreferrer"
                       class="p-6 rounded-3xl border transition-all duration-300 hover:shadow-2xl hover:border-[#2997ff]/60 hover:-translate-y-1 flex flex-col justify-between group cursor-pointer"
                       style="background: var(--bg-card); border-color: var(--border-color);">
                    @else
                    {{-- Internal Card (Opens Modal) --}}
                    <div role="button" tabindex="0" @click="openModal({{ $article->id }})" @keydown.enter="openModal({{ $article->id }})"
                         class="p-6 rounded-3xl border transition-all duration-300 hover:shadow-2xl hover:border-[#2997ff]/60 hover:-translate-y-1 flex flex-col justify-between group cursor-pointer select-none"
                         style="background: var(--bg-card); border-color: var(--border-color);">
                    @endif
                        <div>
                            <div class="flex items-center justify-between gap-2 mb-3">
                                <span class="text-[10px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-full border {{ $tagColor }}">
                                    {{ $article->categoryLabel() }}
                                </span>
                                @if($article->isExternal())
                                <span class="text-[10px] font-medium text-amber-300 flex items-center gap-1 bg-amber-400/10 px-2 py-0.5 rounded-full" title="External link to {{ $article->externalDomain() }}">
                                    <span>{{ $article->externalDomain() }}</span>
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                                </span>
                                @else
                                <span class="text-[10px] text-gray-400">&middot; {{ $article->read_time_minutes }} min read</span>
                                @endif
                            </div>

                            <h4 class="text-lg font-bold mb-3 group-hover:text-[#2997ff] transition leading-snug" style="color: var(--text-primary);">
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
                            @if($article->isExternal())
                            <span class="font-bold text-[#2997ff] flex items-center gap-1 group-hover:translate-x-1 transition-transform">
                                External Source ↗
                            </span>
                            @else
                            <span class="font-bold text-[#2997ff] flex items-center gap-1 group-hover:translate-x-1 transition-transform">
                                Read Full Article &rarr;
                            </span>
                            @endif
                        </div>
                    @if($article->isExternal())
                    </a>
                    @else
                    </div>
                    @endif
                    @endforeach
                </div>

            </div>
        </section>
        @endif

        @endif {{-- end articles check --}}


        {{-- =========================================================================
             ARTICLE READER MODAL (Glassmorphic, Full Content, Accessible)
        ========================================================================= --}}
        <div x-show="isOpen"
             x-cloak
             @keydown.escape.window="closeModal()"
             class="fixed inset-0 z-[100] flex items-center justify-center p-3 sm:p-5 md:p-8"
             style="display: none;">

            {{-- Frosted Glass Backdrop --}}
            <div x-show="isOpen"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 @click="closeModal()"
                 class="fixed inset-0 bg-[#05060a]/80 backdrop-blur-xl transition-opacity"></div>

            {{-- Modal Dialog Container --}}
            <div x-show="isOpen"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                 x-transition:leave-end="opacity-0 scale-95 translate-y-4"
                 class="relative w-full max-w-4xl max-h-[92vh] flex flex-col rounded-3xl shadow-2xl overflow-hidden border border-white/10 z-10"
                 style="background: #0b0d14; box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.7), 0 0 40px rgba(41, 151, 255, 0.15);">

                {{-- Ambient Modal Header Glow --}}
                <div class="absolute top-0 left-1/2 -translate-x-1/2 w-3/4 h-24 bg-gradient-to-b from-[#2997ff]/20 to-transparent blur-2xl pointer-events-none"></div>

                {{-- Sticky Glass Top Bar --}}
                <header class="relative px-6 py-4 border-b border-white/10 flex items-center justify-between gap-4 shrink-0 bg-[#0b0d14]/90 backdrop-blur-md z-20">
                    <div class="flex items-center gap-3 overflow-hidden">
                        <span class="text-[11px] font-bold uppercase tracking-wider px-3 py-1 rounded-full border text-[#2997ff] bg-[#2997ff]/10 border-[#2997ff]/30 shrink-0"
                              x-text="currentArticle?.category_label || 'Engineering'"></span>
                        <span class="text-xs text-gray-400 hidden sm:inline" x-text="currentArticle?.read_time_minutes ? currentArticle.read_time_minutes + ' min read' : ''"></span>
                        <span class="text-xs text-gray-500 hidden sm:inline">&middot;</span>
                        <span class="text-xs text-gray-400 truncate hidden sm:inline" x-text="currentArticle?.published_at"></span>
                    </div>

                    <div class="flex items-center gap-2">
                        {{-- Copy Link Button --}}
                        <button type="button"
                                @click="copyArticleLink()"
                                class="px-3 py-1.5 rounded-xl border border-white/10 bg-white/5 hover:bg-white/10 text-xs text-gray-300 hover:text-white transition flex items-center gap-1.5 font-medium">
                            <svg class="w-3.5 h-3.5 text-[#2997ff]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg>
                            <span x-text="copied ? 'Copied Link!' : 'Share'">Share</span>
                        </button>

                        {{-- Close Button --}}
                        <button type="button"
                                @click="closeModal()"
                                class="w-8 h-8 rounded-full border border-white/10 bg-white/5 hover:bg-white/15 text-gray-300 hover:text-white transition flex items-center justify-center text-sm font-bold"
                                title="Close reader (Esc)">
                            ✕
                        </button>
                    </div>
                </header>

                {{-- Scrollable Article Body --}}
                <div class="relative overflow-y-auto px-6 sm:px-10 py-8 md:py-12 space-y-8 custom-scrollbar">

                    {{-- Article Meta & Title --}}
                    <div class="space-y-4">
                        <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold tracking-tight text-white leading-tight"
                            x-text="currentArticle?.title"></h1>

                        <div class="flex items-center gap-3 pt-2">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-[#2997ff] to-cyan-400 text-white font-bold text-xs flex items-center justify-center shadow-lg shadow-blue-500/20 shrink-0"
                                 x-text="currentArticle?.author_initial || 'M'"></div>
                            <div>
                                <div class="text-sm font-bold text-white" x-text="currentArticle?.author_name || 'Monarchi Engineering'"></div>
                                <div class="text-xs text-gray-400">Published on MonarchI Insights &middot; <span x-text="currentArticle?.published_at"></span></div>
                            </div>
                        </div>
                    </div>

                    {{-- Excerpt Callout --}}
                    <template x-if="currentArticle?.excerpt">
                        <div class="p-5 rounded-2xl border border-[#2997ff]/20 bg-gradient-to-r from-[#2997ff]/10 to-transparent">
                            <p class="text-sm md:text-base italic text-blue-100/90 leading-relaxed"
                               x-text="currentArticle.excerpt"></p>
                        </div>
                    </template>

                    {{-- Full Body Content --}}
                    <div class="prose prose-invert max-w-none text-base sm:text-lg text-gray-200 leading-relaxed space-y-6 pt-2"
                         x-html="formattedBody">
                    </div>

                    {{-- Article Footer --}}
                    <div class="pt-8 mt-12 border-t border-white/10 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-gray-400">
                        <div>
                            <span>Author: <strong class="text-white" x-text="currentArticle?.author_name"></strong></span>
                            <span class="mx-2">&middot;</span>
                            <span>Category: <strong class="text-sky-400" x-text="currentArticle?.category_label"></strong></span>
                        </div>
                        <button type="button"
                                @click="closeModal()"
                                class="px-5 py-2 rounded-xl bg-white/10 hover:bg-white/20 text-white font-semibold transition">
                            Done Reading &rarr;
                        </button>
                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- Articles Payload for Alpine --}}
    @php
        $articlesMap = [];
        foreach($articles as $a) {
            $articlesMap[$a->id] = [
                'id' => $a->id,
                'title' => $a->title,
                'slug' => $a->slug,
                'category' => $a->category,
                'category_label' => $a->categoryLabel(),
                'read_time_minutes' => $a->read_time_minutes,
                'published_at' => $a->published_at ? $a->published_at->format('F d, Y') : 'Recent',
                'author_name' => $a->author_name,
                'author_initial' => strtoupper(substr($a->author_name, 0, 2)),
                'excerpt' => $a->excerpt,
                'body' => $a->body,
                'is_external' => $a->isExternal(),
                'external_url' => $a->external_url,
                'external_domain' => $a->externalDomain(),
            ];
        }
    @endphp

    <script>
        window.__monarchiArticles = @json($articlesMap);

        function monarchiArticleReader() {
            return {
                isOpen: false,
                currentArticle: null,
                copied: false,

                init() {
                    // Check URL hash for direct deep link: #article-slug
                    const hash = window.location.hash;
                    if (hash && hash.startsWith('#article-')) {
                        const slug = hash.replace('#article-', '');
                        const found = Object.values(window.__monarchiArticles).find(a => a.slug === slug);
                        if (found && !found.is_external) {
                            this.openModal(found.id);
                        }
                    }
                },

                openModal(articleId) {
                    const article = window.__monarchiArticles[articleId];
                    if (!article) return;

                    // If external, redirect directly
                    if (article.is_external && article.external_url) {
                        window.open(article.external_url, '_blank', 'noopener,noreferrer');
                        return;
                    }

                    this.currentArticle = article;
                    this.isOpen = true;
                    this.copied = false;
                    document.body.style.overflow = 'hidden';

                    // Update URL hash smoothly
                    if (history.replaceState) {
                        history.replaceState(null, '', '#article-' + article.slug);
                    }
                },

                closeModal() {
                    this.isOpen = false;
                    this.currentArticle = null;
                    document.body.style.overflow = '';

                    // Clear URL hash
                    if (history.replaceState) {
                        history.replaceState(null, '', window.location.pathname + window.location.search);
                    }
                },

                get formattedBody() {
                    if (!this.currentArticle || !this.currentArticle.body) {
                        return '<p class="text-gray-400 italic">No article body available for this entry.</p>';
                    }

                    const raw = this.currentArticle.body;

                    // Split into paragraphs by double newlines
                    const paragraphs = raw.split(/\n\s*\n/);
                    return paragraphs.map(p => {
                        let text = p.trim();
                        if (!text) return '';

                        // Header detection (e.g. ### Heading or ## Heading)
                        if (text.startsWith('### ')) {
                            return '<h3 class="text-xl sm:text-2xl font-bold text-white mt-6 mb-3">' + this.escapeHtml(text.replace('### ', '')) + '</h3>';
                        }
                        if (text.startsWith('## ')) {
                            return '<h2 class="text-2xl sm:text-3xl font-bold text-white mt-8 mb-4 border-b border-white/10 pb-2">' + this.escapeHtml(text.replace('## ', '')) + '</h2>';
                        }
                        if (text.startsWith('# ')) {
                            return '<h1 class="text-3xl font-bold text-white mt-8 mb-4">' + this.escapeHtml(text.replace('# ', '')) + '</h1>';
                        }

                        // Blockquote detection
                        if (text.startsWith('> ')) {
                            return '<blockquote class="border-l-4 border-[#2997ff] pl-4 py-1 italic text-blue-200/90 my-4 bg-white/5 rounded-r-xl pr-4">' + this.escapeHtml(text.replace(/^>\s*/, '')) + '</blockquote>';
                        }

                        // Code block detection
                        if (text.startsWith('```') && text.endsWith('```')) {
                            const codeContent = text.replace(/^```[a-z]*\n?/, '').replace(/```$/, '');
                            return '<pre class="bg-black/60 border border-white/10 rounded-2xl p-4 overflow-x-auto text-sm font-mono text-cyan-300 my-4"><code>' + this.escapeHtml(codeContent) + '<' + '/code></pre>';
                        }

                        // Normal paragraph with basic bold/inline code formatting
                        let formatted = this.escapeHtml(text);
                        formatted = formatted.replace(/\*\*(.*?)\*\*/g, '<strong class="text-white font-semibold">$1</strong>');
                        formatted = formatted.replace(/`([^`]+)`/g, '<code class="px-1.5 py-0.5 rounded bg-white/10 text-cyan-300 font-mono text-sm">$1<' + '/code>');

                        return '<p class="text-gray-200 leading-relaxed text-base sm:text-lg mb-5">' + formatted + '</p>';
                    }).join('');
                },

                escapeHtml(str) {
                    if (!str) return '';
                    return str.replace(/[&<>"']/g, function(m) {
                        return {
                            '&': '&amp;',
                            '<': '&lt;',
                            '>': '&gt;',
                            '"': '&quot;',
                            "'": '&#039;'
                        }[m];
                    });
                },

                copyArticleLink() {
                    const url = window.location.origin + window.location.pathname + '#article-' + this.currentArticle.slug;
                    if (navigator.clipboard && navigator.clipboard.writeText) {
                        navigator.clipboard.writeText(url).then(() => {
                            this.copied = true;
                            setTimeout(() => { this.copied = false; }, 2500);
                        });
                    }
                }
            };
        }
    </script>

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 8px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.02);
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 9999px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: rgba(41, 151, 255, 0.4);
        }
    </style>

</x-main-layout>