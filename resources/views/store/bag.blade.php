<x-main-layout>
<div class="bag-page-root pt-20 md:pt-24 pb-24 min-h-screen" style="background: var(--bg-primary); color: var(--text-primary);">
    <style>
        .bag-card {
            background: var(--card-bg-alt);
            border: 1px solid var(--border-color);
            box-shadow: 0 16px 45px rgba(0, 0, 0, 0.22);
            transition: box-shadow 0.3s ease, border-color 0.3s ease;
        }
        html.light-theme .bag-card {
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.05);
            border-color: rgba(0, 0, 0, 0.08);
        }

        /* Bag item container */
        .bag-item-card {
            background: var(--bg-primary);
            border: 1px solid var(--border-color);
            border-radius: 1.25rem;
            transition: all 0.3s ease;
        }
        .bag-item-card:hover {
            border-color: rgba(41, 151, 255, 0.35);
            box-shadow: 0 10px 28px rgba(0,0,0,0.14);
        }
        html.light-theme .bag-item-card {
            background: #ffffff;
            box-shadow: 0 4px 16px rgba(0,0,0,0.03);
            border-color: rgba(0, 0, 0, 0.07);
        }
        html.light-theme .bag-item-card:hover {
            box-shadow: 0 10px 24px rgba(0,0,0,0.06);
            border-color: rgba(0, 113, 227, 0.3);
        }

        /* Modern Capsule Stepper */
        .modern-qty-stepper {
            background: var(--card-bg-alt);
            border: 1px solid var(--border-color);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            transition: border-color 0.2s ease;
        }
        .qty-stepper-btn {
            background: transparent;
            transition: all 0.18s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        .qty-stepper-btn:hover:not(:disabled) {
            background: rgba(41, 151, 255, 0.15);
            color: #2997ff !important;
            transform: scale(1.08);
        }
        .qty-stepper-btn:active:not(:disabled) {
            transform: scale(0.86);
        }

        .remove-btn {
            transition: color 0.15s ease, transform 0.15s ease;
        }
        .remove-btn:hover {
            color: #e3000f !important;
            transform: scale(1.04);
        }

        .qty-pop {
            animation: qtyPopAnim 0.22s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        @keyframes qtyPopAnim {
            0% { transform: scale(0.8); opacity: 0.6; }
            50% { transform: scale(1.22); }
            100% { transform: scale(1); opacity: 1; }
        }

        /* Modal backdrop & drawer */
        .checkout-modal-backdrop {
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }
    </style>

    <div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 pt-4">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-8 pb-4 border-b" style="border-color: var(--border-color);">
            <div>
                <p class="text-xs font-bold tracking-widest uppercase mb-1" style="color: var(--text-muted);">Review &amp; Checkout</p>
                <h1 class="text-3xl md:text-4xl font-bold tracking-tight" style="color: var(--text-primary);">
                    Shopping Bag
                    <span id="bag-header-count" class="text-lg md:text-xl font-normal ml-2" style="color: var(--text-muted);">
                        ({{ count($items) }} {{ Str::plural('item', count($items)) }})
                    </span>
                </h1>
            </div>
            <a href="{{ route('store.index') }}"
               class="text-sm font-semibold hover:text-[#2997ff] flex items-center gap-1.5 transition py-2 px-4 rounded-xl border"
               style="color: var(--text-secondary); border-color: var(--border-color); background: var(--card-bg-alt);">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
                Continue Shopping
            </a>
        </div>

        {{-- Session Flash Messages --}}
        @if(session('success'))
        <div class="mb-6 flex items-center gap-3 bg-green-500/10 border border-green-500/20 text-green-400 px-5 py-3.5 rounded-2xl text-sm font-medium">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
            </svg>
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="mb-6 flex items-center gap-3 bg-red-500/10 border border-red-500/20 text-red-400 px-5 py-3.5 rounded-2xl text-sm font-medium">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
            {{ session('error') }}
        </div>
        @endif

        {{-- ── EMPTY BAG CONTAINER ────────────────────────────────────────── --}}
        <div id="empty-bag-container" class="{{ empty($items) ? '' : 'hidden' }} flex flex-col items-center justify-center py-24 text-center">
            <div class="w-24 h-24 rounded-3xl flex items-center justify-center shadow-lg mb-6" style="background: var(--card-bg-alt); border: 1px solid var(--border-color);">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-[#2997ff]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
            </div>
            <h2 class="text-2xl font-bold" style="color: var(--text-primary);">Your shopping bag is empty</h2>
            <p class="mt-2 text-sm max-w-sm" style="color: var(--text-muted);">Looks like you haven't added anything to your bag yet. Explore our digital software and hardware products.</p>
            <a href="{{ route('store.index') }}" class="mt-7 px-8 py-3.5 bg-[#2997ff] text-white rounded-full text-sm font-bold hover:bg-[#1a7de3] transition shadow-md hover:shadow-lg hover:-translate-y-0.5 transform">
                Browse the Store →
            </a>
        </div>

        {{-- ── ACTIVE BAG ITEMS & SUMMARY ─────────────────────────────────── --}}
        <div id="active-bag-container" class="{{ empty($items) ? 'hidden' : '' }} grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

            {{-- Left column: Items list --}}
            <div class="lg:col-span-2 space-y-4">
                <div id="bag-items-list" class="space-y-4">
                    @foreach($items as $item)
                    @php $p = $item['product']; @endphp
                    <div id="bag-item-{{ $p->id }}" class="bag-item-card p-5 flex flex-col sm:flex-row gap-5 items-start sm:items-center justify-between">

                        {{-- Left side: Image & info --}}
                        <div class="flex gap-4 items-center min-w-0 flex-1">
                            <a href="{{ route('store.show', $p->slug) }}" class="w-20 h-20 shrink-0 rounded-xl overflow-hidden bg-black/5 dark:bg-white/5 flex items-center justify-center border" style="border-color: var(--border-color);">
                                @if($p->image_path)
                                    <img src="{{ asset('storage/'.$p->image_path) }}" alt="{{ $p->name }}" class="w-full h-full object-cover">
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18"/>
                                    </svg>
                                @endif
                            </a>

                            <div class="min-w-0 flex-1">
                                <p class="text-[10px] font-bold uppercase tracking-widest mb-0.5" style="color: var(--text-muted);">{{ $p->category->name }}</p>
                                <a href="{{ route('store.show', $p->slug) }}" class="font-bold text-sm leading-snug truncate block hover:text-[#2997ff] transition" style="color: var(--text-primary);">
                                    {{ $p->name }}
                                </a>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="text-xs font-semibold" style="color: var(--text-secondary);">₵{{ number_format($item['price'], 2) }}</span>
                                    @if($p->is_on_sale)
                                        <span class="text-[11px] text-gray-400 line-through">{{ $p->original_price }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Right side: Stepper, Line total & Remove --}}
                        <div class="flex items-center justify-between sm:justify-end gap-6 w-full sm:w-auto shrink-0 pt-2 sm:pt-0 border-t sm:border-t-0" style="border-color: var(--border-color);">
                            {{-- Ultra-Modern Stepper --}}
                            <div class="modern-qty-stepper flex items-center justify-between p-0.5 rounded-xl h-[38px] w-[110px] select-none">
                                <button type="button"
                                        class="qty-stepper-btn w-8 h-8 rounded-lg flex items-center justify-center disabled:opacity-30 disabled:cursor-not-allowed"
                                        onclick="changeBagItemQty({{ $p->id }}, -1)"
                                        style="color: var(--text-primary);"
                                        title="Decrease quantity">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 pointer-events-none" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>
                                </button>

                                <span id="bag-item-qty-{{ $p->id }}" class="font-extrabold text-xs font-mono w-6 text-center" style="color: var(--text-primary);">
                                    {{ $item['qty'] }}
                                </span>

                                <button type="button"
                                        class="qty-stepper-btn w-8 h-8 rounded-lg flex items-center justify-center disabled:opacity-30 disabled:cursor-not-allowed"
                                        onclick="changeBagItemQty({{ $p->id }}, 1)"
                                        style="color: var(--text-primary);"
                                        title="Increase quantity">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 pointer-events-none" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>
                                </button>
                            </div>

                            {{-- Line Total --}}
                            <div class="w-24 text-right">
                                <p id="bag-item-total-{{ $p->id }}" class="text-sm font-extrabold" style="color: var(--text-primary);">
                                    ₵{{ number_format($item['lineTotal'], 2) }}
                                </p>
                            </div>

                            {{-- Remove Button --}}
                            <button type="button"
                                    onclick="removeBagItem({{ $p->id }})"
                                    class="remove-btn p-1.5 text-gray-400 hover:text-red-500 rounded-lg transition"
                                    title="Remove item">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </div>

                    </div>
                    @endforeach
                </div>

                {{-- Bag Footer Actions --}}
                <div class="flex items-center justify-between pt-2">
                    <button type="button" onclick="clearEntireBag()"
                            class="text-xs hover:text-red-500 font-medium transition flex items-center gap-1.5 py-2 px-3 rounded-lg"
                            style="color: var(--text-muted);">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Clear entire bag
                    </button>

                    <p class="text-xs" style="color: var(--text-muted);">
                        🔒 Guaranteed safe &amp; secure checkout
                    </p>
                </div>
            </div>

            {{-- Right column: Order Summary Card --}}
            <div class="lg:col-span-1">
                <div class="bag-card rounded-[1.75rem] p-6 sm:p-7 sticky top-24">
                    <h2 class="font-bold text-lg mb-5" style="color: var(--text-primary);">Order Summary</h2>

                    <div class="space-y-3.5 text-sm">
                        <div class="flex justify-between" style="color: var(--text-secondary);">
                            <span>Subtotal</span>
                            <span id="bag-summary-subtotal" class="font-bold" style="color: var(--text-primary);">
                                ₵{{ number_format($subtotal, 2) }}
                            </span>
                        </div>
                        <div class="flex justify-between" style="color: var(--text-secondary);">
                            <span>Shipping</span>
                            <span class="text-xs font-semibold text-green-500">Free digital delivery</span>
                        </div>
                        <div class="flex justify-between" style="color: var(--text-secondary);">
                            <span>Tax / VAT</span>
                            <span class="text-xs" style="color: var(--text-muted);">Included in price</span>
                        </div>
                    </div>

                    {{-- Promo code --}}
                    <div class="mt-5 pt-4 border-t" style="border-color: var(--border-color);">
                        <div class="flex gap-2">
                            <input type="text" id="promo-input" placeholder="Promo code"
                                   class="flex-1 px-3.5 py-2.5 rounded-xl text-xs font-medium focus:outline-none focus:ring-1 focus:ring-[#2997ff] uppercase"
                                   style="background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary);">
                            <button type="button" onclick="applyPromoCode()"
                                    class="px-4 py-2.5 rounded-xl text-xs font-bold transition hover:bg-[#2997ff] hover:text-white"
                                    style="background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary);">
                                Apply
                            </button>
                        </div>
                        <p id="promo-feedback" class="text-[11px] mt-1.5 hidden"></p>
                    </div>

                    <hr class="my-5" style="border-color: var(--border-color);">

                    <div class="flex justify-between font-bold text-base mb-6">
                        <span style="color: var(--text-primary);">Estimated Total</span>
                        <span id="bag-summary-total" class="text-xl text-[#2997ff]">₵{{ number_format($subtotal, 2) }}</span>
                    </div>

                    {{-- Proceed to Checkout Trigger --}}
                    <button type="button" onclick="openCheckoutModal()"
                            class="w-full py-4 bg-[#2997ff] text-white rounded-2xl font-bold text-sm hover:bg-[#1a7de3] transition-all hover:shadow-lg active:scale-98 flex items-center justify-center gap-2">
                        <span>Proceed to Checkout</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </button>

                    {{-- Contact for queries --}}
                    <a href="https://wa.me/233505504793" target="_blank"
                       class="mt-3 w-full py-3.5 rounded-2xl font-bold text-xs transition border flex items-center justify-center gap-2 text-green-500 hover:bg-green-500/10"
                       style="border-color: rgba(34, 197, 94, 0.3);">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                            <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.771-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.274.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.045.072.045.419-.099.824zm-3.423-14.416c-6.627 0-12 5.373-12 12 0 2.175.58 4.212 1.587 5.972l-1.687 6.168 6.347-1.664c1.704.938 3.659 1.524 5.753 1.524 6.627 0 12-5.373 12-12s-5.373-12-12-12z"/>
                        </svg>
                        <span>Have a question? Chat on WhatsApp</span>
                    </a>

                    {{-- Need help? --}}
                    <div class="mt-6 pt-4 border-t text-center" style="border-color: var(--border-color);">
                        <p class="text-xs" style="color: var(--text-muted);">Questions about your order?</p>
                        <a href="{{ url('/contact') }}" class="text-xs font-semibold text-[#2997ff] hover:underline underline-offset-2 transition">
                            Talk to our customer desk →
                        </a>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

{{-- ── CHECKOUT MODAL ─────────────────────────────────────────────────────── --}}
<div id="checkout-modal" class="fixed inset-0 z-50 hidden items-end sm:items-center justify-center p-0 sm:p-6">
    {{-- Backdrop --}}
    <div class="checkout-modal-backdrop fixed inset-0 transition-opacity" onclick="closeCheckoutModal()"></div>

    {{-- Modal Card --}}
    <div class="relative w-full sm:max-w-lg rounded-t-[2rem] sm:rounded-[2rem] shadow-2xl z-10 flex flex-col"
         style="background: var(--card-bg-alt); border: 1px solid var(--border-color); color: var(--text-primary); max-height: 92dvh;">

        {{-- Header (sticky) --}}
        <div class="flex items-center justify-between px-6 pt-6 pb-4 border-b shrink-0" style="border-color: var(--border-color);">
            <div>
                <p class="text-[10px] font-bold uppercase tracking-widest text-[#2997ff]">Instant Checkout</p>
                <h3 class="text-xl font-bold" style="color: var(--text-primary);">Complete Your Order</h3>
            </div>
            <button type="button" onclick="closeCheckoutModal()"
                    class="w-9 h-9 rounded-full flex items-center justify-center text-gray-400 hover:text-white hover:bg-white/10 transition">
                ✕
            </button>
        </div>

        {{-- Checkout Form (scrollable body) --}}
        <form id="checkout-form" action="{{ route('bag.checkout') }}" method="POST" class="flex flex-col min-h-0 flex-1">
            @csrf
            <div class="overflow-y-auto flex-1 px-6 py-4 space-y-3">
            @auth
            {{-- Logged-in: show pre-filled read-only identity info --}}
            <div class="p-3.5 rounded-xl flex items-center gap-3 border"
                 style="background: rgba(41,151,255,0.07); border-color: rgba(41,151,255,0.25);">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 shrink-0 text-[#2997ff]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div class="min-w-0">
                    <p class="text-xs font-bold" style="color: var(--text-primary);">Ordering as {{ auth()->user()->name }}</p>
                    <p class="text-[11px] truncate" style="color: var(--text-muted);">{{ auth()->user()->email }}</p>
                </div>
            </div>

            {{-- Hidden identity fields (auto-filled from auth) --}}
            <input type="hidden" name="customer_name"  value="{{ auth()->user()->name }}">
            <input type="hidden" name="customer_email" value="{{ auth()->user()->email }}">

            {{-- Phone (still editable — not always in user profile) --}}
            <div>
                <label class="block text-xs font-bold mb-1.5" style="color: var(--text-secondary);">Phone / WhatsApp *</label>
                <input type="tel" name="customer_phone" required placeholder="+233 XX XXX XXXX"
                       class="w-full px-4 py-3 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2997ff]"
                       style="background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary);">
            </div>
            @else
            {{-- Guest: full identity form --}}
            <div>
                <label class="block text-xs font-bold mb-1.5" style="color: var(--text-secondary);">Full Name *</label>
                <input type="text" name="customer_name" required placeholder="e.g. Kwame Mensah"
                       class="w-full px-4 py-3 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2997ff]"
                       style="background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary);">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold mb-1.5" style="color: var(--text-secondary);">Email Address *</label>
                    <input type="email" name="customer_email" required placeholder="kwame@example.com"
                           class="w-full px-4 py-3 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2997ff]"
                           style="background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary);">
                </div>
                <div>
                    <label class="block text-xs font-bold mb-1.5" style="color: var(--text-secondary);">Phone / WhatsApp *</label>
                    <input type="tel" name="customer_phone" required placeholder="+233 XX XXX XXXX"
                           class="w-full px-4 py-3 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2997ff]"
                           style="background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary);">
                </div>
            </div>

            {{-- Sign-in nudge --}}
            <p class="text-[11px]" style="color: var(--text-muted);"
            >Have an account? <a href="{{ route('login') }}" class="text-[#2997ff] font-semibold hover:underline">Sign in</a> to check out faster.</p>
            @endauth

            {{-- Delivery / Shipping Address --}}
            <div>
                <label class="block text-xs font-bold mb-1.5" style="color: var(--text-secondary);">Delivery Address / City *</label>
                <input type="text" name="shipping_address" required placeholder="e.g. Airport Residential Area, Accra"
                       class="w-full px-4 py-3 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2997ff]"
                       style="background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary);">
            </div>

            {{-- Payment Method — Paystack (African & International options) --}}
            <div>
                <label class="block text-xs font-bold mb-2" style="color: var(--text-secondary);">Payment Method</label>
                <div class="p-4 rounded-2xl border"
                     style="background: var(--bg-primary); border-color: rgba(41, 151, 255, 0.4); box-shadow: 0 4px 18px rgba(41, 151, 255, 0.08);">
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg flex items-center justify-center font-black text-sm bg-[#00C3F7]/15 text-[#00C3F7]">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2zm0 4v10h16V8H4zm2 2h4v2H6v-2zm0 4h2v2H6v-2z"/>
                                </svg>
                            </div>
                            <div>
                                <span class="text-sm font-bold tracking-tight block" style="color: var(--text-primary);">Paystack Checkout</span>
                                <span class="text-[11px]" style="color: var(--text-muted);">Instant, safe &amp; direct payments</span>
                            </div>
                        </div>
                        <span class="text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-full bg-blue-500/10 text-[#2997ff] border border-blue-500/20">
                            Secure Gateway
                        </span>
                    </div>

                    {{-- Supported Channels Pill List --}}
                    <div class="flex flex-wrap gap-1.5 pt-2 border-t" style="border-color: var(--border-color);">
                        <span class="text-[10px] font-semibold px-2.5 py-1 rounded-lg border flex items-center gap-1"
                              style="background: var(--card-bg-alt); border-color: var(--border-color); color: var(--text-secondary);">
                            <span class="w-1.5 h-1.5 rounded-full bg-yellow-400"></span> MTN MoMo
                        </span>
                        <span class="text-[10px] font-semibold px-2.5 py-1 rounded-lg border flex items-center gap-1"
                              style="background: var(--card-bg-alt); border-color: var(--border-color); color: var(--text-secondary);">
                            <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Telecel Cash
                        </span>
                        <span class="text-[10px] font-semibold px-2.5 py-1 rounded-lg border flex items-center gap-1"
                              style="background: var(--card-bg-alt); border-color: var(--border-color); color: var(--text-secondary);">
                            <span class="w-1.5 h-1.5 rounded-full bg-blue-400"></span> AT Money
                        </span>
                        <span class="text-[10px] font-semibold px-2.5 py-1 rounded-lg border flex items-center gap-1"
                              style="background: var(--card-bg-alt); border-color: var(--border-color); color: var(--text-secondary);">
                            <span class="w-1.5 h-1.5 rounded-full bg-indigo-400"></span> Visa / Mastercard
                        </span>
                        <span class="text-[10px] font-semibold px-2.5 py-1 rounded-lg border flex items-center gap-1"
                              style="background: var(--card-bg-alt); border-color: var(--border-color); color: var(--text-secondary);">
                            <span class="w-1.5 h-1.5 rounded-full bg-neutral-400"></span> Apple Pay
                        </span>
                    </div>
                </div>

                <input type="hidden" name="payment_method" id="payment_method_hidden" value="paystack">
            </div>

            {{-- Order Notes --}}
            <div>
                <label class="block text-xs font-bold mb-1.5" style="color: var(--text-secondary);">Special Instructions (Optional)</label>
                <textarea name="notes" rows="2" placeholder="Any specific requirements or instructions..."
                          class="w-full px-4 py-2.5 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2997ff] resize-none"
                          style="background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary);"></textarea>
            </div>

            </div>{{-- /scrollable body --}}

            {{-- Sticky Footer: Amount + Submit --}}
            <div class="px-6 py-4 border-t shrink-0" style="border-color: var(--border-color);">
                {{-- Summary amount note --}}
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs font-medium" style="color: var(--text-secondary);">Amount to Pay:</span>
                    <span id="modal-checkout-total" class="font-extrabold text-base text-[#2997ff]">₵{{ number_format($subtotal, 2) }}</span>
                </div>

                {{-- Submit CTA --}}
                <button type="submit" id="modal-submit-btn"
                        class="w-full py-4 bg-[#2997ff] text-white rounded-2xl font-bold text-sm hover:bg-[#1a7de3] transition-all hover:shadow-lg active:scale-98 flex items-center justify-center gap-2">
                    <span>Pay with Paystack</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ── JAVASCRIPT CONTROLLERS ────────────────────────────────────────────── --}}
<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';

    // 1. Change Bag Item Quantity via AJAX
    async function changeBagItemQty(productId, delta) {
        const qtySpan = document.getElementById(`bag-item-qty-${productId}`);
        if (!qtySpan) return;

        let currentQty = parseInt(qtySpan.textContent.trim(), 10) || 1;
        let newQty = currentQty + delta;

        if (newQty < 1) {
            if (confirm('Do you want to remove this item from your bag?')) {
                removeBagItem(productId);
            }
            return;
        }

        try {
            const res = await fetch('{{ route("bag.update") }}', {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: newQty
                })
            });

            if (res.ok) {
                const data = await res.json();
                qtySpan.textContent = data.quantity;
                qtySpan.classList.remove('qty-pop');
                void qtySpan.offsetWidth;
                qtySpan.classList.add('qty-pop');

                const totalSpan = document.getElementById(`bag-item-total-${productId}`);
                if (totalSpan && data.lineTotal) {
                    totalSpan.textContent = data.lineTotal;
                }

                updateSummaryTotals(data.subtotal, data.cartCount);
            }
        } catch (err) {
            console.error('Error updating bag:', err);
        }
    }

    // 2. Remove Bag Item via AJAX
    async function removeBagItem(productId) {
        const itemEl = document.getElementById(`bag-item-${productId}`);
        if (itemEl) {
            itemEl.style.opacity = '0.4';
        }

        try {
            const res = await fetch(`/bag/remove/${productId}`, {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            if (res.ok) {
                const data = await res.json();
                if (itemEl) {
                    itemEl.style.transition = 'all 0.3s ease';
                    itemEl.style.transform = 'scale(0.95)';
                    itemEl.style.opacity = '0';
                    setTimeout(() => {
                        itemEl.remove();
                        if (data.isEmpty) {
                            showEmptyBag();
                        }
                    }, 300);
                }

                updateSummaryTotals(data.subtotal, data.cartCount);
                if (window.showStoreToast) {
                    window.showStoreToast('Item removed from bag');
                }
            }
        } catch (err) {
            console.error('Error removing item:', err);
        }
    }

    // 3. Clear Entire Bag via AJAX
    async function clearEntireBag() {
        if (!confirm('Are you sure you want to clear your entire bag?')) return;

        try {
            const res = await fetch('{{ route("bag.clear") }}', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            if (res.ok) {
                showEmptyBag();
                if (window.updateCartBadge) window.updateCartBadge(0);
                if (window.showStoreToast) window.showStoreToast('Shopping bag cleared');
            }
        } catch (err) {
            console.error('Error clearing bag:', err);
        }
    }

    // 4. Update Summary Totals
    function updateSummaryTotals(subtotalFormatted, cartCount) {
        const subtotalEl = document.getElementById('bag-summary-subtotal');
        const totalEl = document.getElementById('bag-summary-total');
        const modalTotalEl = document.getElementById('modal-checkout-total');
        const headerCountEl = document.getElementById('bag-header-count');

        if (subtotalEl && subtotalFormatted) subtotalEl.textContent = subtotalFormatted;
        if (totalEl && subtotalFormatted) totalEl.textContent = subtotalFormatted;
        if (modalTotalEl && subtotalFormatted) modalTotalEl.textContent = subtotalFormatted;

        if (headerCountEl && cartCount !== undefined) {
            headerCountEl.textContent = `(${cartCount} ${cartCount === 1 ? 'item' : 'items'})`;
        }

        if (window.updateCartBadge && cartCount !== undefined) {
            window.updateCartBadge(cartCount);
        }
    }

    // 5. Switch to Empty Bag View
    function showEmptyBag() {
        const activeContainer = document.getElementById('active-bag-container');
        const emptyContainer = document.getElementById('empty-bag-container');
        const headerCountEl = document.getElementById('bag-header-count');

        if (activeContainer) activeContainer.classList.add('hidden');
        if (emptyContainer) emptyContainer.classList.remove('hidden');
        if (headerCountEl) headerCountEl.textContent = '(0 items)';
        if (window.updateCartBadge) window.updateCartBadge(0);
    }

    // 6. Promo Code Mock
    function applyPromoCode() {
        const input = document.getElementById('promo-input');
        const feedback = document.getElementById('promo-feedback');
        if (!input || !feedback) return;

        const val = input.value.trim().toUpperCase();
        if (!val) return;

        if (val === 'MONARCHI10' || val === 'SPECIAL') {
            feedback.className = 'text-[11px] mt-1.5 text-green-500 block';
            feedback.textContent = '✓ Promo code applied successfully!';
        } else {
            feedback.className = 'text-[11px] mt-1.5 text-red-400 block';
            feedback.textContent = 'Invalid promo code. Try MONARCHI10';
        }
    }

    // 7. Modal Open & Close
    function openCheckoutModal() {
        const modal = document.getElementById('checkout-modal');
        if (modal) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }
    }

    function closeCheckoutModal() {
        const modal = document.getElementById('checkout-modal');
        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = '';
        }
    }

    // 8. Sync payment method radio to hidden input
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('input[name="payment_method"][type="radio"]').forEach(radio => {
            radio.addEventListener('change', () => {
                const hidden = document.getElementById('payment_method_hidden');
                if (hidden) hidden.value = radio.value;
            });
        });
    });

    // 9. Checkout Form Submission
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('checkout-form');
        if (!form) return;

        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            const btn = document.getElementById('modal-submit-btn');
            const originalHtml = btn ? btn.innerHTML : 'Place Order';

            if (btn) {
                btn.disabled = true;
                btn.innerHTML = `
                    <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Connecting to Paystack...
                `;
            }

            try {
                const formData = new FormData(this);
                const res = await fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });

                if (res.ok) {
                    const data = await res.json();
                    if (window.updateCartBadge) window.updateCartBadge(0);
                    if (data.redirect) {
                        window.location.href = data.redirect;
                    } else {
                        window.location.reload();
                    }
                } else {
                    const errData = await res.json();
                    alert(errData.message || 'Error processing order. Please verify your details.');
                    if (btn) {
                        btn.disabled = false;
                        btn.innerHTML = originalHtml;
                    }
                }
            } catch (err) {
                console.error('Checkout error:', err);
                alert('Network error while placing order. Please try again.');
                if (btn) {
                    btn.disabled = false;
                    btn.innerHTML = originalHtml;
                }
            }
        });
    });
</script>
</x-main-layout>
