<x-main-layout
    title="MonarchI Store — Enterprise Hardware, IoT & Digital Products"
    description="Explore and purchase official MonarchI hardware, smart devices, software licenses, and digital developer products."
    keywords="MonarchI Store, Buy Enterprise Hardware, IoT Devices, AI Hardware Africa, Tech Store Ghana, Developer Licenses">

{{-- ═══════════════════════════════════════════════════════════════════════════
     STORE PAGE — Bounded Sections with Drop Shadows & Optimized Card Sizes
═══════════════════════════════════════════════════════════════════════════ --}}
<div class="store-page-root pt-10 md:pt-11 pb-24 min-h-screen px-4 sm:px-6 lg:px-8 space-y-10 md:space-y-12" style="background: var(--bg-primary); color: var(--text-primary);">

    {{-- ── STYLES ───────────────────────────────────────────────────────────── --}}
    <style>
        .cat-scroll::-webkit-scrollbar { display: none; }
        .cat-scroll { -ms-overflow-style: none; scrollbar-width: none; }

        .prod-scroll::-webkit-scrollbar { display: none; }
        .prod-scroll { -ms-overflow-style: none; scrollbar-width: none; }

        /* Section Boundary Box with Drop Shadows */
        .store-section-boundary {
            background: var(--card-bg-alt);
            border: 1px solid var(--border-color);
            border-radius: 2rem;
            box-shadow: 0 16px 45px rgba(0, 0, 0, 0.25);
            transition: box-shadow 0.3s ease, border-color 0.3s ease;
        }
        html.light-theme .store-section-boundary {
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.05);
            border-color: rgba(0, 0, 0, 0.08);
        }

        /* Bento Product Card - Compact, Balanced Length */
        .store-bento-card {
            background: var(--bg-primary);
            border: 1px solid var(--border-color);
            border-radius: 1.25rem;
            box-shadow: 0 8px 24px rgba(0,0,0,0.12);
            transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.3s ease, border-color 0.3s ease;
        }
        .store-bento-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 16px 36px rgba(0,0,0,0.22);
            border-color: rgba(41, 151, 255, 0.4);
        }
        html.light-theme .store-bento-card {
            background: #ffffff;
            box-shadow: 0 4px 16px rgba(0,0,0,0.04);
            border-color: rgba(0, 0, 0, 0.07);
        }
        html.light-theme .store-bento-card:hover {
            box-shadow: 0 12px 28px rgba(0,0,0,0.08);
            border-color: rgba(0, 113, 227, 0.35);
        }

        .store-bento-card.is-out-of-stock {
            opacity: 0.78;
        }

        /* Product image hover */
        .store-bento-card .bento-img {
            transition: transform 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        .store-bento-card:hover .bento-img {
            transform: scale(1.05);
        }

        /* Add-to-bag button animation */
        .atb-btn {
            transition: all 0.2s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        .atb-btn:hover { transform: scale(1.02); }
        .atb-btn:active { transform: scale(0.97); }

        /* Featured card - Optimized Length to prevent title underlapping */
        .feat-card {
            border: 1px solid var(--border-color);
            box-shadow: 0 10px 28px rgba(0,0,0,0.18);
            transition: transform 0.35s ease, box-shadow 0.35s ease, border-color 0.35s ease;
        }
        .feat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 18px 42px rgba(0,0,0,0.28);
            border-color: rgba(41, 151, 255, 0.4);
        }
        .feat-card .feat-img {
            transition: transform 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        .feat-card:hover .feat-img { transform: scale(1.06); }

        /* Unified Badges */
        .badge-orange { background: #ff6a00; color: #ffffff; }
        .badge-red    { background: #e3000f; color: #ffffff; }
        .badge-green  { background: #00a651; color: #ffffff; }
        .badge-blue   { background: #0071e3; color: #ffffff; }
        .badge-gray   { background: #4b5563; color: #ffffff; }

        /* Stock Status Dots */
        .dot-in    { background: #00a651; }
        .dot-low   { background: #f59e0b; }
        .dot-out   { background: #e3000f; }

        /* Category pills */
        .cat-chip {
            background: var(--bg-primary);
            border: 1px solid var(--border-color);
            transition: all 0.25s ease;
        }
        .cat-chip:hover {
            transform: translateY(-2px);
            border-color: rgba(41, 151, 255, 0.5);
            box-shadow: 0 6px 18px rgba(0,0,0,0.12);
        }
        .cat-chip.cat-active {
            border-color: #2997ff;
            box-shadow: 0 0 0 2px rgba(41, 151, 255, 0.3);
        }
        html.light-theme .cat-chip {
            background: #ffffff;
        }

        /* Action buttons */
        .store-action-btn {
            background: var(--card-bg-alt);
            border: 1px solid var(--border-color);
            color: var(--text-secondary);
            transition: all 0.2s ease;
        }
        .store-action-btn:hover {
            color: var(--text-primary);
            border-color: var(--text-muted);
            transform: scale(1.05);
        }
    </style>

    {{-- ── SECTION 1: CATEGORIES BOUNDARY ────────────────────────────────── --}}
    <section class="store-section-boundary max-w-[1400px] mx-auto px-5 sm:px-8 py-5">
        <div class="relative">
            <div class="flex space-x-5 sm:space-x-7 overflow-x-auto cat-scroll py-2 px-1 snap-x">

                {{-- "All" item --}}
                <a href="{{ route('store.index') }}"
                   class="snap-start shrink-0 flex flex-col items-center gap-2 cursor-pointer group select-none">
                    <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-2xl overflow-hidden cat-chip {{ !$activeCategory ? 'cat-active' : '' }} flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 {{ !$activeCategory ? 'text-[#2997ff]' : 'text-gray-400 group-hover:text-[#2997ff]' }} transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                        </svg>
                    </div>
                    <span class="text-[11px] sm:text-xs font-medium {{ !$activeCategory ? 'font-bold text-[#2997ff]' : 'text-gray-400 group-hover:text-current' }} tracking-tight transition-colors whitespace-nowrap">All</span>
                </a>

                @foreach($categories as $cat)
                    <a href="{{ route('store.index', ['category' => $cat->slug]) }}"
                       class="snap-start shrink-0 flex flex-col items-center gap-2 cursor-pointer group select-none">
                        <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-2xl overflow-hidden cat-chip {{ $activeCategory === $cat->slug ? 'cat-active' : '' }} flex items-center justify-center">
                            @if($cat->image_path)
                                <img src="{{ asset('storage/'.$cat->image_path) }}"
                                     alt="{{ $cat->name }}"
                                     class="w-full h-full object-cover group-hover:scale-108 transition-transform duration-300">
                            @else
                                <div class="w-full h-full flex items-center justify-center opacity-80">
                                    <span class="text-lg">📦</span>
                                </div>
                            @endif
                        </div>
                        <span class="text-[11px] sm:text-xs font-medium {{ $activeCategory === $cat->slug ? 'font-bold text-[#2997ff]' : 'text-gray-400 group-hover:text-current' }} tracking-tight transition-colors whitespace-nowrap">{{ $cat->name }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ── SECTION 2: "THE LATEST" FEATURED PRODUCTS BOUNDARY ─────────────── --}}
    @if($featuredProducts->isNotEmpty() && !$activeCategory)
    <section class="store-section-boundary max-w-[1400px] mx-auto px-6 sm:px-10 py-8 sm:py-10">
        {{-- Section Title with clear margin to prevent any card underlap --}}
        <div class="mb-8 md:mb-10 relative z-20">
            <h2 class="text-2xl md:text-3xl font-bold tracking-tight" style="color: var(--text-primary);">
                The latest. <span class="font-normal text-base md:text-lg block sm:inline mt-1 sm:mt-0" style="color: var(--text-muted);">Take a look at what's new, right now.</span>
            </h2>
        </div>

        {{-- Carousel with well-proportioned card height (h-[390px]) --}}
        <div class="flex space-x-5 overflow-x-auto prod-scroll pb-2 pt-2 snap-x relative z-10">
            @foreach($featuredProducts as $fp)
            <a href="{{ route('store.show', $fp->slug) }}"
               class="feat-card snap-start shrink-0 w-[290px] sm:w-[330px] md:w-[350px] h-[390px] md:h-[410px] rounded-[1.75rem] relative overflow-hidden group flex flex-col
                @if($fp->card_style === 'dark') bg-[#111111] text-white
                @elseif($fp->card_style === 'promo') bg-gradient-to-br from-[#181818] to-[#282828] text-white
                @else bg-[var(--bg-primary)] text-[var(--text-primary)] @endif">

                {{-- Card top content --}}
                <div class="relative z-10 p-6 flex flex-col h-full">
                    @php $fpBadge = $fp->badge; @endphp
                    @if($fpBadge)
                    <span class="inline-block text-[10px] font-bold uppercase tracking-widest px-2.5 py-1 rounded-full mb-2.5 w-fit badge-{{ $fpBadge['color'] }}">
                        {{ $fpBadge['text'] }}
                    </span>
                    @endif

                    <h3 class="text-lg font-bold leading-snug">{{ $fp->name }}</h3>
                    <p class="mt-1 text-xs font-medium opacity-80 line-clamp-2">
                        {{ $fp->short_description }}
                    </p>
                    <p class="mt-2 text-xs font-bold opacity-90">
                        From {{ $fp->display_price }}
                        @if($fp->is_on_sale)
                            <span class="line-through text-gray-400 ml-1 font-normal text-[11px]">{{ $fp->original_price }}</span>
                        @endif
                    </p>

                    {{-- Spacer pushes the image to the bottom --}}
                    <div class="flex-1"></div>
                </div>

                {{-- Background product image --}}
                <img src="{{ $fp->image_url }}"
                     alt="{{ $fp->name }}"
                     class="feat-img absolute bottom-0 left-0 w-full h-[52%] object-cover pointer-events-none">
            </a>
            @endforeach
        </div>
    </section>
    @endif

    {{-- ── SECTION 3: ALL PRODUCTS 3x3 BENTO GRID BOUNDARY ───────────────── --}}
    <section class="store-section-boundary max-w-[1400px] mx-auto px-6 sm:px-10 py-8 sm:py-10">
        {{-- Section Header --}}
        <div class="flex flex-col sm:flex-row sm:items-baseline justify-between gap-2 mb-8 md:mb-10 pb-4 border-b" style="border-color: var(--border-color);">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold tracking-tight" style="color: var(--text-primary);">
                    @if($activeCategory)
                        {{ $products->total() }} {{ Str::plural('result', $products->total()) }}
                        <span class="font-normal text-base md:text-lg" style="color: var(--text-muted);">in {{ $categories->firstWhere('slug', $activeCategory)?->name }}</span>
                    @else
                        Our full collection.
                    @endif
                </h2>
            </div>
            <span class="text-xs font-medium tracking-wider uppercase" style="color: var(--text-muted);">{{ $products->total() }} products</span>
        </div>

        @if($products->isEmpty())
        <div class="flex flex-col items-center justify-center py-20 text-center">
            <span class="text-5xl mb-3">📦</span>
            <p class="text-lg font-bold" style="color: var(--text-primary);">No products found</p>
            <p class="mt-1 text-xs" style="color: var(--text-muted);">Try browsing a different category.</p>
            <a href="{{ route('store.index') }}" class="mt-5 px-6 py-2.5 bg-[#2997ff] text-white rounded-full text-xs font-bold hover:bg-[#1a7de3] transition shadow-md">
                View all products
            </a>
        </div>
        @else

        {{-- Bento Grid: 3x3 on large screens (lg:grid-cols-3), 2x2 on tablets/small screens (sm:grid-cols-2), 1-col on mobile --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-7">
            @foreach($products as $product)
            @php
                $badge = $product->badge;
                $isOutOfStock = $product->stock_status === 'out_of_stock';
            @endphp
            <div class="store-bento-card {{ $isOutOfStock ? 'is-out-of-stock' : '' }} overflow-hidden flex flex-col justify-between group">

                <div>
                    {{-- Product Image box with compact aspect ratio --}}
                    <a href="{{ route('store.show', $product->slug) }}" class="block relative overflow-hidden aspect-[16/10] rounded-t-[1.2rem] bg-black/5 dark:bg-white/5">
                        <img src="{{ $product->image_url }}"
                             alt="{{ $product->name }}"
                             class="bento-img w-full h-full object-cover {{ $badge && $badge['is_grayed'] ? 'grayscale-[40%] opacity-80' : '' }}"
                             loading="lazy">

                        {{-- Unified Badge Overlay (Exactly One Badge, Never Duplicated) --}}
                        @if($badge)
                        <span class="absolute top-3 left-3 text-[10px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-full shadow-sm badge-{{ $badge['color'] }}">
                            {{ $badge['text'] }}
                        </span>
                        @endif
                    </a>

                    {{-- Product Details --}}
                    <div class="p-4 sm:p-5">
                        <p class="text-[10px] font-bold tracking-widest uppercase mb-1" style="color: var(--text-muted);">
                            {{ $product->category->name }}
                        </p>
                        <a href="{{ route('store.show', $product->slug) }}" class="font-bold text-sm leading-snug line-clamp-1 transition hover:text-[#2997ff]" style="color: var(--text-primary);">
                            {{ $product->name }}
                        </a>
                        <p class="text-xs mt-1 line-clamp-2 leading-relaxed" style="color: var(--text-secondary);">
                            {{ $product->short_description }}
                        </p>

                        {{-- Price Row --}}
                        <div class="flex items-center gap-2 mt-3">
                            <span class="text-base font-bold" style="color: var(--text-primary);">{{ $product->display_price }}</span>
                            @if($product->is_on_sale)
                                <span class="text-xs text-gray-400 line-through">{{ $product->original_price }}</span>
                            @endif
                        </div>

                        {{-- Stock status --}}
                        <div class="flex items-center gap-1.5 mt-1.5">
                            @php
                                $status = $product->stock_status;
                                $dotClass = $status === 'in_stock' ? 'dot-in' : ($status === 'low_stock' ? 'dot-low' : 'dot-out');
                                $statusLabel = $status === 'in_stock' ? 'In Stock' : ($status === 'low_stock' ? 'Low Stock' : 'Out of Stock');
                            @endphp
                            <span class="inline-block w-2 h-2 rounded-full {{ $dotClass }}"></span>
                            <span class="text-[10px] font-medium" style="color: var(--text-muted);">{{ $statusLabel }}</span>
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="p-4 sm:p-5 pt-0">
                    <div class="flex gap-2 pt-3 border-t" style="border-color: var(--border-color);">
                        {{-- Add to Bag (AJAX, no reload) --}}
                        @if(!$isOutOfStock)
                        <form action="{{ route('bag.add') }}" method="POST" class="flex-1 ajax-add-to-cart-form">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" id="atb-{{ $product->id }}"
                                class="atb-btn w-full py-2.5 px-3 bg-[#2997ff] text-white rounded-xl text-xs font-bold hover:bg-[#1a7de3] active:scale-95 transition shadow-sm flex items-center justify-center gap-1.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                </svg>
                                <span>Add to Bag</span>
                            </button>
                        </form>
                        @else
                        <button disabled class="flex-1 py-2.5 px-3 bg-gray-500/10 text-gray-400 rounded-xl text-xs font-semibold cursor-not-allowed">
                            Restock Soon
                        </button>
                        @endif

                        {{-- Wishlist --}}
                        <button title="Save to Wishlist"
                            class="w-9 h-9 flex items-center justify-center rounded-xl store-action-btn wishlist-btn"
                            data-product-id="{{ $product->id }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </button>

                        {{-- Quick View --}}
                        <a href="{{ route('store.show', $product->slug) }}" title="View details"
                            class="w-9 h-9 flex items-center justify-center rounded-xl store-action-btn">
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
        <div class="mt-14 pt-8 border-t flex flex-col sm:flex-row items-center justify-between gap-4" style="border-color: var(--border-color);">
            <div class="text-xs" style="color: var(--text-muted);">
                Showing <span class="font-semibold" style="color: var(--text-primary);">{{ $products->firstItem() ?? 0 }}</span> &ndash; <span class="font-semibold" style="color: var(--text-primary);">{{ $products->lastItem() ?? 0 }}</span> of <span class="font-semibold" style="color: var(--text-primary);">{{ $products->total() }}</span> items
            </div>

            <nav class="inline-flex items-center gap-1 p-1.5 rounded-2xl border backdrop-blur-md"
                 style="background: var(--bg-primary); border-color: var(--border-color); box-shadow: 0 4px 20px rgba(0,0,0,0.15);"
                 aria-label="Store Pagination Navigation">

                {{-- Previous Page Link --}}
                @if($products->onFirstPage())
                    <span class="inline-flex items-center justify-center gap-1.5 px-3.5 py-2 text-xs font-semibold rounded-xl opacity-35 cursor-not-allowed select-none"
                          style="color: var(--text-muted);">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                        <span class="hidden sm:inline">Previous</span>
                    </span>
                @else
                    <a href="{{ $products->previousPageUrl() }}"
                       class="inline-flex items-center justify-center gap-1.5 px-3.5 py-2 text-xs font-semibold rounded-xl transition duration-200 group"
                       style="color: var(--text-secondary); background: transparent;"
                       onmouseover="this.style.background='rgba(41,151,255,0.12)'; this.style.color='#2997ff';"
                       onmouseout="this.style.background='transparent'; this.style.color='var(--text-secondary)';"
                       aria-label="Previous Page">
                        <svg class="w-4 h-4 transition-transform group-hover:-translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                        <span class="hidden sm:inline">Previous</span>
                    </a>
                @endif

                {{-- Page Numbers --}}
                <div class="flex items-center gap-1 mx-1">
                    @foreach($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                        @if($page == $products->currentPage())
                            <span class="inline-flex items-center justify-center min-w-[34px] h-[34px] px-3 text-xs font-bold rounded-xl text-white shadow-md select-none"
                                  style="background: #2997ff; box-shadow: 0 4px 14px rgba(41, 151, 255, 0.45);"
                                  aria-current="page">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}"
                               class="inline-flex items-center justify-center min-w-[34px] h-[34px] px-3 text-xs font-semibold rounded-xl transition duration-200"
                               style="color: var(--text-secondary); background: transparent;"
                               onmouseover="this.style.background='rgba(41,151,255,0.12)'; this.style.color='#2997ff';"
                               onmouseout="this.style.background='transparent'; this.style.color='var(--text-secondary)';">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                </div>

                {{-- Next Page Link --}}
                @if($products->hasMorePages())
                    <a href="{{ $products->nextPageUrl() }}"
                       class="inline-flex items-center justify-center gap-1.5 px-3.5 py-2 text-xs font-semibold rounded-xl transition duration-200 group"
                       style="color: var(--text-secondary); background: transparent;"
                       onmouseover="this.style.background='rgba(41,151,255,0.12)'; this.style.color='#2997ff';"
                       onmouseout="this.style.background='transparent'; this.style.color='var(--text-secondary)';"
                       aria-label="Next Page">
                        <span class="hidden sm:inline">Next</span>
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                    </a>
                @else
                    <span class="inline-flex items-center justify-center gap-1.5 px-3.5 py-2 text-xs font-semibold rounded-xl opacity-35 cursor-not-allowed select-none"
                          style="color: var(--text-muted);">
                        <span class="hidden sm:inline">Next</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                    </span>
                @endif

            </nav>
        </div>
        @endif
        @endif
    </section>

    {{-- ── SECTION 4: CUSTOM SOFTWARE CTA BANNER BOUNDARY ───────────────── --}}
    <section class="max-w-[1400px] mx-auto">
        <div class="bg-[#111] rounded-[2rem] px-8 py-14 md:px-16 flex flex-col md:flex-row items-center justify-between gap-8 relative overflow-hidden border border-white/10 shadow-[0_24px_60px_rgba(0,0,0,0.35)]">

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

{{-- ── AJAX ADD TO BAG & WISHLIST SCRIPTS ────────────────────────────────── --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // AJAX Add to Bag
        document.querySelectorAll('.ajax-add-to-cart-form').forEach(form => {
            form.addEventListener('submit', async function(e) {
                e.preventDefault();
                const btn = this.querySelector('button[type="submit"]');
                const btnTextSpan = btn ? btn.querySelector('span') : null;
                const originalText = btnTextSpan ? btnTextSpan.textContent : (btn ? btn.textContent : '');

                if (btn) {
                    btn.disabled = true;
                    if (btnTextSpan) btnTextSpan.textContent = 'Adding...';
                }

                try {
                    const formData = new FormData(this);
                    const response = await fetch(this.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    });

                    if (response.ok) {
                        const data = await response.json();
                        if (data.cartCount !== undefined && window.updateCartBadge) {
                            window.updateCartBadge(data.cartCount);
                        }

                        if (btnTextSpan) {
                            btnTextSpan.textContent = 'Added ✓';
                        }
                        if (btn) {
                            btn.classList.add('bg-green-600');
                            btn.classList.remove('bg-[#2997ff]');
                        }

                        if (window.showStoreToast) {
                            window.showStoreToast('Item added to your bag!');
                        }

                        setTimeout(() => {
                            if (btnTextSpan) btnTextSpan.textContent = originalText;
                            if (btn) {
                                btn.classList.remove('bg-green-600');
                                btn.classList.add('bg-[#2997ff]');
                                btn.disabled = false;
                            }
                        }, 1600);
                    } else {
                        if (btn) btn.disabled = false;
                        if (btnTextSpan) btnTextSpan.textContent = originalText;
                        if (window.showStoreToast) window.showStoreToast('Could not add item to bag', false);
                    }
                } catch (err) {
                    console.error('Add to cart error:', err);
                    if (btn) btn.disabled = false;
                    if (btnTextSpan) btnTextSpan.textContent = originalText;
                }
            });
        });

        // Wishlist Toggle
        document.querySelectorAll('.wishlist-btn').forEach(btn => {
            const productId = btn.dataset.productId;
            const key = `wishlist_${productId}`;
            const svg = btn.querySelector('svg');

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
                    btn.animate([
                        {transform:'scale(1)'},
                        {transform:'scale(1.35)'},
                        {transform:'scale(1)'}
                    ], {duration:280, easing:'cubic-bezier(0.34,1.56,0.64,1)'});
                }
            });
        });
    });
</script>

</x-main-layout>