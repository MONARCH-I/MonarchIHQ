<x-main-layout>

{{-- ═══════════════════════════════════════════════════════════════════════════
     STORE PAGE — Off-white background, independent of the main theme system
═══════════════════════════════════════════════════════════════════════════════ --}}
<div style="background:#f8f8f6; min-height:100vh;" class="pt-20 md:pt-24 pb-24">

    {{-- ── CATEGORIES CAROUSEL ────────────────────────────────────────────── --}}
    <section class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 pt-4 pb-2">
        <style>
            .cat-scroll::-webkit-scrollbar { display: none; }
            .cat-scroll { -ms-overflow-style: none; scrollbar-width: none; }

            /* Smooth no-scrollbar for product rows */
            .prod-scroll::-webkit-scrollbar { display: none; }
            .prod-scroll { -ms-overflow-style: none; scrollbar-width: none; }

            /* Add-to-bag button animation */
            .atb-btn {
                transition: all 0.2s cubic-bezier(0.34,1.56,0.64,1);
            }
            .atb-btn:hover { transform: scale(1.04); }
            .atb-btn:active { transform: scale(0.97); }

            /* Product card hover */
            .prod-card {
                transition: box-shadow 0.25s ease, transform 0.25s ease;
            }
            .prod-card:hover {
                box-shadow: 0 12px 40px rgba(0,0,0,0.10);
                transform: translateY(-3px);
            }

            /* Featured card image zoom */
            .feat-card .feat-img {
                transition: transform 0.5s cubic-bezier(0.25,0.46,0.45,0.94);
            }
            .feat-card:hover .feat-img { transform: scale(1.06); }

            /* Badge pill */
            .badge-orange { background:#ff6a00; color:#fff; }
            .badge-red    { background:#e3000f; color:#fff; }
            .badge-green  { background:#00a651; color:#fff; }
            .badge-blue   { background:#0071e3; color:#fff; }
            .badge-gray   { background:#6b7280; color:#fff; }

            /* Stock dot */
            .dot-in    { background:#00a651; }
            .dot-low   { background:#f59e0b; }
            .dot-out   { background:#e3000f; }

            /* Pagination active */
            .page-active { background:#111; color:#fff; }
        </style>

        {{-- Categories strip --}}
        <div class="relative">
            <div class="flex space-x-6 sm:space-x-8 overflow-x-auto cat-scroll py-2 px-1 snap-x">

                {{-- "All" item --}}
                <a href="{{ route('store.index') }}"
                   class="snap-start shrink-0 flex flex-col items-center gap-2.5 cursor-pointer group select-none">
                    <div class="w-16 h-16 sm:w-[72px] sm:h-[72px] rounded-2xl overflow-hidden bg-white shadow-[0_2px_10px_rgba(0,0,0,0.04)] ring-1 {{ !$activeCategory ? 'ring-2 ring-gray-900 shadow-md' : 'ring-black/[0.06] group-hover:ring-black/20 group-hover:shadow-md group-hover:-translate-y-1' }} transition-all duration-300 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 {{ !$activeCategory ? 'text-gray-900' : 'text-gray-500 group-hover:text-gray-900' }} transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                        </svg>
                    </div>
                    <span class="text-[11px] sm:text-xs font-medium {{ !$activeCategory ? 'font-bold text-gray-900' : 'text-gray-600 group-hover:text-gray-900' }} tracking-tight transition-colors whitespace-nowrap">All</span>
                </a>

                @foreach($categories as $cat)
                    <a href="{{ route('store.index', ['category' => $cat->slug]) }}"
                       class="snap-start shrink-0 flex flex-col items-center gap-2.5 cursor-pointer group select-none">
                        <div class="w-16 h-16 sm:w-[72px] sm:h-[72px] rounded-2xl overflow-hidden bg-white shadow-[0_2px_10px_rgba(0,0,0,0.04)] ring-1 {{ $activeCategory === $cat->slug ? 'ring-2 ring-gray-900 shadow-md' : 'ring-black/[0.06] group-hover:ring-black/20 group-hover:shadow-md group-hover:-translate-y-1' }} transition-all duration-300 flex items-center justify-center">
                            @if($cat->image_path)
                                <img src="{{ asset('storage/'.$cat->image_path) }}"
                                     alt="{{ $cat->name }}"
                                     class="w-full h-full object-cover group-hover:scale-108 transition-transform duration-300">
                            @else
                                <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                                    <span class="text-xl">📦</span>
                                </div>
                            @endif
                        </div>
                        <span class="text-[11px] sm:text-xs font-medium {{ $activeCategory === $cat->slug ? 'font-bold text-gray-900' : 'text-gray-600 group-hover:text-gray-900' }} tracking-tight transition-colors whitespace-nowrap">{{ $cat->name }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ── "THE LATEST" — FEATURED PRODUCTS CAROUSEL ─────────────────────── --}}
    @if($featuredProducts->isNotEmpty() && !$activeCategory)
    <section class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 mt-14">
        <h2 class="text-2xl md:text-3xl font-semibold tracking-tight text-gray-900 mb-8">
            The latest. <span class="text-gray-400 font-medium">Take a look at what's new, right now.</span>
        </h2>

        <div class="flex space-x-5 overflow-x-auto prod-scroll pb-8 snap-x">
            @foreach($featuredProducts as $fp)
            <a href="{{ route('store.show', $fp->slug) }}"
               class="feat-card snap-start shrink-0 w-[320px] md:w-[380px] h-[480px] rounded-[2rem] relative overflow-hidden group shadow-md transition-shadow hover:shadow-2xl flex flex-col
                @if($fp->card_style === 'dark') bg-[#111111] text-white
                @elseif($fp->card_style === 'promo') bg-gradient-to-br from-[#1a1a1a] to-[#2d2d2d] text-white
                @else bg-white text-gray-900 border border-gray-100 @endif">

                {{-- Card top content --}}
                <div class="relative z-10 p-7 flex flex-col h-full">
                    @if($fp->badge_text)
                    <span class="inline-block text-[10px] font-bold uppercase tracking-widest px-2 py-1 rounded-full mb-3 w-fit badge-{{ $fp->badge_color }}">
                        {{ $fp->badge_text }}
                    </span>
                    @endif

                    <h3 class="text-xl font-bold leading-tight">{{ $fp->name }}</h3>
                    <p class="mt-1 text-sm font-medium {{ $fp->card_style !== 'light' ? 'text-gray-300' : 'text-gray-500' }}">
                        {{ $fp->short_description }}
                    </p>
                    <p class="mt-3 text-sm font-semibold {{ $fp->card_style !== 'light' ? 'text-gray-300' : 'text-gray-600' }}">
                        From {{ $fp->display_price }}
                        @if($fp->is_on_sale)
                            <span class="line-through text-gray-400 ml-1 font-normal">{{ $fp->original_price }}</span>
                        @endif
                    </p>

                    {{-- Spacer pushes the image to the bottom --}}
                    <div class="flex-1"></div>
                </div>

                {{-- Background product image (uses image_url accessor for placehold.co fallback) --}}
                <img src="{{ $fp->image_url }}"
                     alt="{{ $fp->name }}"
                     class="feat-img absolute bottom-0 left-0 w-full h-[55%] object-cover pointer-events-none">
            </a>
            @endforeach
        </div>
    </section>
    @endif

    {{-- ── DIVIDER ───────────────────────────────────────────────────────── --}}
    @if(!$activeCategory)
    <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 mt-4 mb-2">
        <hr class="border-gray-200">
    </div>
    @endif

    {{-- ── ALL PRODUCTS GRID ─────────────────────────────────────────────── --}}
    <section class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 mt-10">
        <div class="flex items-baseline justify-between mb-8">
            <h2 class="text-2xl md:text-3xl font-semibold tracking-tight text-gray-900">
                @if($activeCategory)
                    {{ $products->total() }} {{ Str::plural('result', $products->total()) }}
                    <span class="text-gray-400 font-medium text-xl">in {{ $categories->firstWhere('slug', $activeCategory)?->name }}</span>
                @else
                    Our full collection.
                @endif
            </h2>
            <span class="text-sm text-gray-400">{{ $products->total() }} products</span>
        </div>

        @if($products->isEmpty())
        <div class="flex flex-col items-center justify-center py-24 text-center">
            <span class="text-6xl mb-4">📦</span>
            <p class="text-xl font-semibold text-gray-700">No products found</p>
            <p class="text-gray-400 mt-2">Try browsing a different category.</p>
            <a href="{{ route('store.index') }}" class="mt-6 px-6 py-3 bg-black text-white rounded-full text-sm font-semibold hover:bg-gray-800 transition">
                View all products
            </a>
        </div>
        @else

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($products as $product)
            <div class="prod-card bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm flex flex-col">

                {{-- Product Image — uses image_url accessor (placehold.co fallback until real image uploaded) --}}
                <a href="{{ route('store.show', $product->slug) }}" class="block relative overflow-hidden bg-gray-50 aspect-square">
                    <img src="{{ $product->image_url }}"
                         alt="{{ $product->name }}"
                         class="w-full h-full object-cover hover:scale-105 transition-transform duration-500"
                         loading="lazy">

                    {{-- Badge overlay --}}
                    @if($product->badge_text)
                    <span class="absolute top-3 left-3 text-[10px] font-bold uppercase tracking-widest px-2 py-1 rounded-full badge-{{ $product->badge_color }}">
                        {{ $product->badge_text }}
                    </span>
                    @endif

                    {{-- Sale overlay --}}
                    @if($product->is_on_sale)
                    <span class="absolute top-3 right-3 text-[10px] font-bold uppercase tracking-widest px-2 py-1 rounded-full badge-red">
                        Sale
                    </span>
                    @endif
                </a>

                {{-- Product Info --}}
                <div class="p-4 flex flex-col flex-1">
                    <p class="text-[11px] font-medium text-gray-400 uppercase tracking-widest mb-1">{{ $product->category->name }}</p>
                    <a href="{{ route('store.show', $product->slug) }}" class="font-semibold text-gray-900 text-sm leading-snug hover:text-gray-600 transition line-clamp-2">
                        {{ $product->name }}
                    </a>
                    <p class="text-xs text-gray-400 mt-1 line-clamp-2 flex-1">{{ $product->short_description }}</p>

                    {{-- Price row --}}
                    <div class="flex items-center gap-2 mt-3">
                        <span class="text-base font-bold text-gray-900">{{ $product->display_price }}</span>
                        @if($product->is_on_sale)
                            <span class="text-xs text-gray-400 line-through">{{ $product->original_price }}</span>
                        @endif
                    </div>

                    {{-- Stock status --}}
                    <div class="flex items-center gap-1.5 mt-1 mb-3">
                        @php
                            $status = $product->stock_status;
                            $dotClass = $status === 'in_stock' ? 'dot-in' : ($status === 'low_stock' ? 'dot-low' : 'dot-out');
                            $statusLabel = $status === 'in_stock' ? 'In Stock' : ($status === 'low_stock' ? 'Low Stock' : 'Out of Stock');
                        @endphp
                        <span class="inline-block w-2 h-2 rounded-full {{ $dotClass }}"></span>
                        <span class="text-[11px] text-gray-400 font-medium">{{ $statusLabel }}</span>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex gap-2 mt-auto">
                        {{-- Add to Bag --}}
                        @if($product->stock_status !== 'out_of_stock')
                        <form action="{{ route('cart.add') }}" method="POST" class="flex-1">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" id="atb-{{ $product->id }}"
                                class="atb-btn w-full py-2.5 bg-[#111] text-white rounded-xl text-xs font-semibold hover:bg-gray-800 active:scale-95">
                                Add to Bag
                            </button>
                        </form>
                        @else
                        <button disabled class="flex-1 py-2.5 bg-gray-100 text-gray-400 rounded-xl text-xs font-semibold cursor-not-allowed">
                            Sold Out
                        </button>
                        @endif

                        {{-- Wishlist --}}
                        <button title="Save to Wishlist"
                            class="w-9 h-9 flex items-center justify-center rounded-xl border border-gray-200 hover:border-gray-400 hover:bg-gray-50 transition text-gray-500 hover:text-red-500 wishlist-btn"
                            data-product-id="{{ $product->id }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </button>

                        {{-- Quick View --}}
                        <a href="{{ route('store.show', $product->slug) }}" title="View details"
                            class="w-9 h-9 flex items-center justify-center rounded-xl border border-gray-200 hover:border-gray-400 hover:bg-gray-50 transition text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if($products->hasPages())
        <div class="mt-12 flex justify-center">
            <nav class="flex items-center gap-1">
                {{-- Previous --}}
                @if($products->onFirstPage())
                    <span class="px-4 py-2 text-sm text-gray-300 bg-white border border-gray-200 rounded-xl cursor-not-allowed">← Prev</span>
                @else
                    <a href="{{ $products->previousPageUrl() }}" class="px-4 py-2 text-sm text-gray-700 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 transition">← Prev</a>
                @endif

                {{-- Page numbers --}}
                @foreach($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                    @if($page == $products->currentPage())
                        <span class="px-4 py-2 text-sm font-semibold bg-[#111] text-white rounded-xl">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="px-4 py-2 text-sm text-gray-700 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 transition">{{ $page }}</a>
                    @endif
                @endforeach

                {{-- Next --}}
                @if($products->hasMorePages())
                    <a href="{{ $products->nextPageUrl() }}" class="px-4 py-2 text-sm text-gray-700 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 transition">Next →</a>
                @else
                    <span class="px-4 py-2 text-sm text-gray-300 bg-white border border-gray-200 rounded-xl cursor-not-allowed">Next →</span>
                @endif
            </nav>
        </div>
        @endif
        @endif
    </section>

    {{-- ── CUSTOM SOFTWARE CTA BANNER ────────────────────────────────────── --}}
    <section class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 mt-20">
        <div class="bg-[#111] rounded-[2rem] px-8 py-14 md:px-16 flex flex-col md:flex-row items-center justify-between gap-8 relative overflow-hidden">

            {{-- Decorative glow --}}
            <div class="absolute -top-20 -left-20 w-72 h-72 bg-orange-500 opacity-10 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-20 -right-20 w-72 h-72 bg-blue-500 opacity-10 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative z-10 max-w-xl">
                <span class="inline-block text-[11px] font-bold uppercase tracking-widest text-orange-400 mb-3">Custom Software Solutions</span>
                <h2 class="text-3xl md:text-4xl font-bold text-white leading-tight">
                    Don't see what you need?<br>
                    <span class="text-gray-400">We build it from scratch.</span>
                </h2>
                <p class="mt-4 text-gray-400 text-sm leading-relaxed max-w-md">
                    From enterprise CRMs to custom AI integrations and SaaS platforms —
                    our engineering team delivers bespoke software solutions tailored to your exact requirements.
                    Get in touch and let's build something exceptional together.
                </p>
            </div>

            <div class="relative z-10 flex flex-col items-center gap-4 shrink-0">
                <a href="{{ url('/contact') }}"
                   class="inline-flex items-center gap-2 px-8 py-4 bg-white text-[#111] rounded-full text-sm font-bold hover:bg-gray-100 transition shadow-lg hover:shadow-xl hover:-translate-y-0.5 transform">
                    Get a Custom Quote
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
                <p class="text-gray-500 text-xs">Free consultation · No commitment required</p>
            </div>
        </div>
    </section>

</div>

{{-- ── SESSION SUCCESS TOAST ─────────────────────────────────────────────── --}}
@if(session('success'))
<div id="toast"
     class="fixed bottom-6 right-6 z-50 bg-[#111] text-white px-6 py-3 rounded-2xl shadow-2xl text-sm font-medium flex items-center gap-3 transition-all">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-green-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
    </svg>
    {{ session('success') }}
</div>
<script>
    setTimeout(() => {
        const t = document.getElementById('toast');
        if (t) { t.style.opacity = '0'; t.style.transform = 'translateY(10px)'; setTimeout(() => t.remove(), 400); }
    }, 3500);
</script>
@endif

{{-- ── WISHLIST TOGGLE SCRIPT ────────────────────────────────────────────── --}}
<script>
    document.querySelectorAll('.wishlist-btn').forEach(btn => {
        const productId = btn.dataset.productId;
        const key = `wishlist_${productId}`;
        const svg = btn.querySelector('svg');

        // Restore state
        if (localStorage.getItem(key)) {
            svg.setAttribute('fill', '#e3000f');
            svg.setAttribute('stroke', '#e3000f');
            btn.classList.add('text-red-500');
        }

        btn.addEventListener('click', () => {
            const active = !!localStorage.getItem(key);
            if (active) {
                localStorage.removeItem(key);
                svg.setAttribute('fill', 'none');
                svg.setAttribute('stroke', 'currentColor');
                btn.classList.remove('text-red-500');
            } else {
                localStorage.setItem(key, '1');
                svg.setAttribute('fill', '#e3000f');
                svg.setAttribute('stroke', '#e3000f');
                btn.classList.add('text-red-500');
                // Bounce animation
                btn.animate([
                    {transform:'scale(1)'},
                    {transform:'scale(1.4)'},
                    {transform:'scale(1)'}
                ], {duration:300, easing:'cubic-bezier(0.34,1.56,0.64,1)'});
            }
        });
    });
</script>

</x-main-layout>