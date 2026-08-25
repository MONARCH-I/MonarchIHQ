<x-main-layout>
<div style="background:#f8f8f6; min-height:100vh;" class="pt-20 md:pt-24 pb-24">
    <style>
        .qty-btn { transition: all 0.15s ease; }
        .qty-btn:hover { background: #111; color: #fff; }
        .remove-btn { transition: color 0.15s ease; }
        .remove-btn:hover { color: #e3000f; }
    </style>

    <div class="max-w-[1100px] mx-auto px-4 sm:px-6 lg:px-8 pt-4">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-10">
            <div>
                <p class="text-xs font-semibold tracking-widest uppercase text-gray-400 mb-1">Your Shopping</p>
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 tracking-tight">Bag</h1>
            </div>
            <a href="{{ route('store.index') }}"
               class="text-sm font-medium text-gray-500 hover:text-gray-900 flex items-center gap-1 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
                Continue Shopping
            </a>
        </div>

        {{-- Session flash --}}
        @if(session('success'))
        <div class="mb-6 flex items-center gap-3 bg-green-50 border border-green-200 text-green-800 px-5 py-3 rounded-2xl text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-green-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
            </svg>
            {{ session('success') }}
        </div>
        @endif

        @if(empty($items))
        {{-- Empty cart state --}}
        <div class="flex flex-col items-center justify-center py-32 text-center">
            <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center shadow-md mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
            </div>
            <p class="text-xl font-semibold text-gray-700">Your bag is empty</p>
            <p class="text-gray-400 mt-2 text-sm">Looks like you haven't added anything yet.</p>
            <a href="{{ route('store.index') }}" class="mt-6 px-8 py-3 bg-[#111] text-white rounded-full text-sm font-semibold hover:bg-gray-800 transition">
                Browse the Store
            </a>
        </div>

        @else
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- Cart Items --}}
            <div class="lg:col-span-2 space-y-4">
                @foreach($items as $item)
                @php $p = $item['product']; @endphp
                <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex gap-5 items-start">

                    {{-- Image --}}
                    <div class="w-20 h-20 shrink-0 rounded-xl overflow-hidden bg-gray-50 flex items-center justify-center">
                        @if($p->image_path)
                            <img src="{{ asset('storage/'.$p->image_path) }}" alt="{{ $p->name }}" class="w-full h-full object-cover">
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18"/>
                            </svg>
                        @endif
                    </div>

                    {{-- Info --}}
                    <div class="flex-1 min-w-0">
                        <p class="text-[11px] font-medium text-gray-400 uppercase tracking-widest mb-0.5">{{ $p->category->name }}</p>
                        <h3 class="font-semibold text-gray-900 text-sm leading-snug truncate">{{ $p->name }}</h3>
                        <p class="text-xs text-gray-400 mt-0.5">SKU: {{ $p->sku ?? '—' }}</p>

                        <div class="flex items-center gap-4 mt-3">
                            {{-- Quantity controls --}}
                            <div class="flex items-center gap-2">
                                <form action="{{ route('cart.update') }}" method="POST" class="inline">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="product_id" value="{{ $p->id }}">
                                    <input type="hidden" name="quantity" value="{{ max(0, $item['qty'] - 1) }}">
                                    <button type="submit" class="qty-btn w-7 h-7 rounded-full border border-gray-200 flex items-center justify-center text-gray-600 text-sm font-semibold">−</button>
                                </form>

                                <span class="text-sm font-semibold text-gray-900 w-5 text-center">{{ $item['qty'] }}</span>

                                <form action="{{ route('cart.update') }}" method="POST" class="inline">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="product_id" value="{{ $p->id }}">
                                    <input type="hidden" name="quantity" value="{{ $item['qty'] + 1 }}">
                                    <button type="submit" class="qty-btn w-7 h-7 rounded-full border border-gray-200 flex items-center justify-center text-gray-600 text-sm font-semibold">+</button>
                                </form>
                            </div>

                            {{-- Remove --}}
                            <form action="{{ route('cart.remove', $p->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="remove-btn text-xs text-gray-400 font-medium flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Remove
                                </button>
                            </form>
                        </div>
                    </div>

                    {{-- Line total --}}
                    <div class="shrink-0 text-right">
                        <p class="text-base font-bold text-gray-900">₵{{ number_format($item['lineTotal'], 2) }}</p>
                        @if($p->is_on_sale)
                        <p class="text-xs text-gray-400">₵{{ number_format($item['price'], 2) }} ea.</p>
                        @endif
                    </div>
                </div>
                @endforeach

                {{-- Clear cart --}}
                <div class="pt-2">
                    <form action="{{ route('cart.clear') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-xs text-gray-400 hover:text-red-500 font-medium transition flex items-center gap-1.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Clear entire bag
                        </button>
                    </form>
                </div>
            </div>

            {{-- Order Summary --}}
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm sticky top-24">
                    <h2 class="font-bold text-gray-900 text-lg mb-5">Order Summary</h2>

                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal</span>
                            <span class="font-medium text-gray-900">₵{{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Shipping</span>
                            <span class="text-gray-400 text-xs">Calculated at checkout</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Tax (VAT)</span>
                            <span class="text-gray-400 text-xs">Calculated at checkout</span>
                        </div>
                    </div>

                    <hr class="my-4 border-gray-100">

                    <div class="flex justify-between font-bold text-gray-900 text-base">
                        <span>Estimated Total</span>
                        <span>₵{{ number_format($subtotal, 2) }}</span>
                    </div>

                    <button disabled
                        class="mt-5 w-full py-3.5 bg-[#111] text-white rounded-xl font-semibold text-sm hover:bg-gray-800 transition cursor-not-allowed opacity-70"
                        title="Checkout coming soon">
                        Proceed to Checkout →
                    </button>
                    <p class="text-center text-xs text-gray-400 mt-2">Checkout &amp; payment coming soon</p>

                    <div class="mt-5 flex items-center justify-center gap-2 text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        <span class="text-[11px]">Secure &amp; encrypted checkout</span>
                    </div>

                    {{-- Need help? --}}
                    <div class="mt-5 pt-4 border-t border-gray-100 text-center">
                        <p class="text-xs text-gray-400">Need help or a custom quote?</p>
                        <a href="{{ url('/contact') }}" class="text-xs font-semibold text-gray-900 hover:text-gray-600 transition underline-offset-2 hover:underline">
                            Contact our team →
                        </a>
                    </div>
                </div>
            </div>

        </div>
        @endif
    </div>
</div>
</x-main-layout>