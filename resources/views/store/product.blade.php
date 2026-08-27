<x-main-layout>
<div class="product-detail-root pt-20 md:pt-24 pb-24 min-h-screen" style="background: var(--bg-primary); color: var(--text-primary);">
    <style>
        .modern-qty-stepper {
            background: var(--card-bg-alt);
            border: 1px solid var(--border-color);
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.08);
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }
        .modern-qty-stepper:focus-within,
        .modern-qty-stepper:hover {
            border-color: rgba(41, 151, 255, 0.4);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.12);
        }
        .qty-stepper-btn {
            background: transparent;
            transition: all 0.2s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        .qty-stepper-btn:hover:not(:disabled) {
            background: rgba(41, 151, 255, 0.15);
            color: #2997ff !important;
            transform: scale(1.08);
        }
        .qty-stepper-btn:active:not(:disabled) {
            transform: scale(0.86);
        }
        .qty-pop {
            animation: qtyPopAnim 0.22s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        @keyframes qtyPopAnim {
            0% { transform: scale(0.8); opacity: 0.6; }
            50% { transform: scale(1.22); }
            100% { transform: scale(1); opacity: 1; }
        }
    </style>

    <div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 pt-4">

        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-xs mb-8" style="color: var(--text-muted);">
            <a href="{{ route('store.index') }}" class="hover:text-[#2997ff] transition">Store</a>
            <span>/</span>
            <a href="{{ route('store.index', ['category' => $product->category->slug]) }}" class="hover:text-[#2997ff] transition">{{ $product->category->name }}</a>
            <span>/</span>
            <span class="font-medium" style="color: var(--text-secondary);">{{ $product->name }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">

            {{-- Product Image --}}
            <div class="rounded-3xl overflow-hidden shadow-sm aspect-square relative" style="background: var(--card-bg-alt); border: 1px solid var(--border-color);">
                <img src="{{ $product->image_url }}"
                     alt="{{ $product->name }}"
                     class="w-full h-full object-cover">

                @php $badge = $product->badge; @endphp
                @if($badge)
                <span class="absolute top-5 left-5 text-[11px] font-bold uppercase tracking-wider px-3 py-1.5 rounded-full shadow-md
                    @if($badge['color'] === 'orange') bg-orange-500 text-white
                    @elseif($badge['color'] === 'red') bg-red-600 text-white
                    @elseif($badge['color'] === 'green') bg-green-600 text-white
                    @elseif($badge['color'] === 'blue') bg-blue-600 text-white
                    @else bg-gray-600 text-white @endif">
                    {{ $badge['text'] }}
                </span>
                @endif
            </div>

            {{-- Product Info --}}
            <div class="flex flex-col">
                <p class="text-xs font-bold uppercase tracking-widest mb-2" style="color: var(--text-muted);">{{ $product->category->name }}</p>
                <h1 class="text-3xl md:text-4xl font-bold leading-tight mb-3" style="color: var(--text-primary);">{{ $product->name }}</h1>
                <p class="text-sm leading-relaxed mb-6" style="color: var(--text-secondary);">{{ $product->short_description }}</p>

                {{-- Price --}}
                <div class="flex items-baseline gap-3 mb-3">
                    <span class="text-3xl font-bold" style="color: var(--text-primary);">{{ $product->display_price }}</span>
                    @if($product->is_on_sale)
                        <span class="text-lg line-through" style="color: var(--text-muted);">{{ $product->original_price }}</span>
                    @endif
                </div>

                {{-- Stock --}}
                <div class="flex items-center gap-2 mb-6">
                    @php
                        $status = $product->stock_status;
                        $dotColors = ['in_stock'=>'bg-green-500','low_stock'=>'bg-amber-400','out_of_stock'=>'bg-red-500'];
                        $statusLabels = ['in_stock'=>'In Stock','low_stock'=>'Low Stock — Order Soon','out_of_stock'=>'Out of Stock'];
                    @endphp
                    <span class="w-2.5 h-2.5 rounded-full {{ $dotColors[$status] }} inline-block"></span>
                    <span class="text-sm font-medium" style="color: var(--text-secondary);">{{ $statusLabels[$status] }}</span>
                </div>

                {{-- Add to Bag with Ultra-Modern Quantity Stepper --}}
                @if($product->stock_status !== 'out_of_stock')
                <form id="product-detail-atb-form" action="{{ route('bag.add') }}" method="POST" class="mb-5">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" id="detail-qty-input" value="1">

                    <div class="flex items-center gap-3.5">
                        {{-- Ultra-Modern Capsule Stepper --}}
                        <div class="modern-qty-stepper flex items-center justify-between p-1 rounded-2xl h-[52px] w-[140px] shrink-0 select-none">
                            {{-- Decrement Button --}}
                            <button type="button" id="qty-dec-btn" aria-label="Decrease quantity"
                                    class="qty-stepper-btn w-10 h-10 rounded-xl flex items-center justify-center disabled:opacity-30 disabled:cursor-not-allowed disabled:hover:bg-transparent"
                                    style="color: var(--text-primary);">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 pointer-events-none" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                            </button>

                            {{-- Quantity Number --}}
                            <div class="flex-1 flex items-center justify-center overflow-hidden">
                                <span id="qty-val-display" class="font-extrabold text-base font-mono tracking-tight inline-block"
                                      style="color: var(--text-primary);">1</span>
                            </div>

                            {{-- Increment Button --}}
                            <button type="button" id="qty-inc-btn" aria-label="Increase quantity"
                                    class="qty-stepper-btn w-10 h-10 rounded-xl flex items-center justify-center disabled:opacity-30 disabled:cursor-not-allowed disabled:hover:bg-transparent"
                                    style="color: var(--text-primary);">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 pointer-events-none" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                            </button>
                        </div>

                        {{-- Add to Bag Button --}}
                        <button type="submit" id="detail-atb-btn"
                                class="flex-1 h-[52px] bg-[#2997ff] text-white rounded-2xl font-bold text-sm hover:bg-[#1a7de3] transition-all hover:shadow-lg active:scale-98 flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                            <span>Add to Bag</span>
                        </button>
                    </div>
                </form>
                @else
                <button disabled class="w-full h-[52px] bg-gray-500/10 text-gray-400 rounded-2xl font-semibold text-sm cursor-not-allowed mb-5">
                    Currently Out of Stock — Restock Soon
                </button>
                @endif

                {{-- SKU --}}
                <p class="text-xs mb-6" style="color: var(--text-muted);">SKU: {{ $product->sku ?? '—' }}</p>

                {{-- Description --}}
                @if($product->description)
                <div class="border-t pt-6" style="border-color: var(--border-color);">
                    <h2 class="font-bold mb-3 text-xs uppercase tracking-wider" style="color: var(--text-primary);">Product Details</h2>
                    <p class="text-sm leading-relaxed" style="color: var(--text-secondary);">{{ $product->description }}</p>
                </div>
                @endif
            </div>
        </div>

        {{-- Related Products --}}
        @if($related->isNotEmpty())
        <section class="mt-20 border-t pt-14" style="border-color: var(--border-color);">
            <h2 class="text-2xl font-bold mb-6" style="color: var(--text-primary);">More in {{ $product->category->name }}</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-5">
                @foreach($related as $rel)
                <a href="{{ route('store.show', $rel->slug) }}"
                   class="group rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-all flex flex-col justify-between"
                   style="background: var(--card-bg-alt); border: 1px solid var(--border-color);">
                    <div class="aspect-square overflow-hidden bg-black/5 dark:bg-white/5">
                        <img src="{{ $rel->image_url }}" alt="{{ $rel->name }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-400">
                    </div>
                    <div class="p-4">
                        <p class="text-sm font-bold line-clamp-1 group-hover:text-[#2997ff] transition" style="color: var(--text-primary);">{{ $rel->name }}</p>
                        <p class="text-sm font-semibold mt-1" style="color: var(--text-secondary);">{{ $rel->display_price }}</p>
                    </div>
                </a>
                @endforeach
            </div>
        </section>
        @endif
    </div>
</div>

{{-- ── QUANTITY STEPPER & AJAX ADD TO BAG SCRIPTS ─────────────────────────── --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Ultra-Modern Quantity Stepper Logic
        const qtyInput = document.getElementById('detail-qty-input');
        const qtyDisplay = document.getElementById('qty-val-display');
        const decBtn = document.getElementById('qty-dec-btn');
        const incBtn = document.getElementById('qty-inc-btn');
        const maxStock = parseInt("{{ $product->stock_quantity }}", 10) || 99;

        function updateQty(newQty) {
            if (newQty < 1) newQty = 1;
            if (newQty > maxStock) newQty = maxStock;

            if (qtyInput) qtyInput.value = newQty;
            if (qtyDisplay) {
                qtyDisplay.textContent = newQty;
                qtyDisplay.classList.remove('qty-pop');
                void qtyDisplay.offsetWidth; // trigger reflow
                qtyDisplay.classList.add('qty-pop');
            }

            if (decBtn) decBtn.disabled = (newQty <= 1);
            if (incBtn) incBtn.disabled = (newQty >= maxStock);
        }

        if (decBtn && incBtn && qtyDisplay && qtyInput) {
            updateQty(1);

            decBtn.addEventListener('click', () => {
                const current = parseInt(qtyInput.value, 10) || 1;
                updateQty(current - 1);
            });

            incBtn.addEventListener('click', () => {
                const current = parseInt(qtyInput.value, 10) || 1;
                updateQty(current + 1);
            });
        }

        // AJAX Add to Bag
        const form = document.getElementById('product-detail-atb-form');
        if (!form) return;

        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            const btn = document.getElementById('detail-atb-btn');
            const span = btn ? btn.querySelector('span') : null;
            const originalText = span ? span.textContent : 'Add to Bag';

            if (btn) {
                btn.disabled = true;
                if (span) span.textContent = 'Adding...';
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

                    if (span) span.textContent = 'Added to Bag ✓';
                    if (btn) {
                        btn.classList.add('bg-green-600');
                        btn.classList.remove('bg-[#2997ff]');
                    }

                    if (window.showStoreToast) {
                        window.showStoreToast('Added to your bag!');
                    }

                    setTimeout(() => {
                        if (span) span.textContent = originalText;
                        if (btn) {
                            btn.classList.remove('bg-green-600');
                            btn.classList.add('bg-[#2997ff]');
                            btn.disabled = false;
                        }
                    }, 1600);
                } else {
                    if (btn) btn.disabled = false;
                    if (span) span.textContent = originalText;
                    if (window.showStoreToast) window.showStoreToast('Could not add item to bag', false);
                }
            } catch (err) {
                console.error('Error adding to cart:', err);
                if (btn) btn.disabled = false;
                if (span) span.textContent = originalText;
            }
        });
    });
</script>
</x-main-layout>
