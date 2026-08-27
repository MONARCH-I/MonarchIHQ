<x-main-layout>
<div class="pt-20 md:pt-24 pb-24 min-h-screen" style="background: var(--bg-primary); color: var(--text-primary);">
    <div class="max-w-[760px] mx-auto px-4 sm:px-6 lg:px-8 pt-8">

        {{-- Success Card --}}
        <div class="rounded-[2rem] p-8 sm:p-12 text-center border shadow-xl"
             style="background: var(--card-bg-alt); border-color: var(--border-color);">

            {{-- Status Icon --}}
            @if($order->isPaid())
            <div class="w-20 h-20 bg-green-500/10 text-green-500 rounded-full flex items-center justify-center mx-auto mb-6 shadow-inner border border-green-500/20">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            @else
            <div class="w-20 h-20 bg-blue-500/10 text-[#2997ff] rounded-full flex items-center justify-center mx-auto mb-6 shadow-inner border border-blue-500/20">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            @endif

            <p class="text-xs font-bold uppercase tracking-widest text-[#2997ff] mb-2">
                {{ $order->isPaid() ? 'Payment Confirmed' : 'Order Received' }}
            </p>
            <h1 class="text-3xl sm:text-4xl font-bold tracking-tight mb-3" style="color: var(--text-primary);">
                {{ $order->isPaid() ? 'Thank you for your payment!' : 'Thank you for your order!' }}
            </h1>
            <p class="text-sm max-w-md mx-auto leading-relaxed mb-6" style="color: var(--text-secondary);">
                We have received your order <span class="font-bold text-[#2997ff]">#MHQ-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>.
                @if($order->isPaid())
                    Your payment via Paystack was successful and your digital items/shipment are now being prepared.
                @else
                    Our team will contact you shortly to confirm your delivery details.
                @endif
            </p>

            {{-- Order & Payment Summary Box --}}
            <div class="rounded-2xl p-6 text-left border my-8"
                 style="background: var(--bg-primary); border-color: var(--border-color);">
                
                {{-- Metadata Header --}}
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 pb-4 border-b mb-4" style="border-color: var(--border-color);">
                    <div>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-gray-400 block mb-0.5">Order ID</span>
                        <p class="font-bold text-sm" style="color: var(--text-primary);">#MHQ-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</p>
                    </div>
                    <div>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-gray-400 block mb-0.5">Date</span>
                        <p class="font-bold text-sm" style="color: var(--text-primary);">{{ $order->created_at->format('M d, Y') }}</p>
                    </div>
                    <div>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-gray-400 block mb-0.5">Payment</span>
                        <div>
                            @if($order->isPaid())
                                <span class="inline-flex items-center gap-1 text-xs font-bold text-green-500 bg-green-500/10 px-2 py-0.5 rounded-md border border-green-500/20">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                    Paid ({{ ucfirst(str_replace('_', ' ', $order->payment_channel ?? 'Paystack')) }})
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 text-xs font-bold text-amber-500 bg-amber-500/10 px-2 py-0.5 rounded-md border border-amber-500/20">
                                    Pending Paystack
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="text-left sm:text-right">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-gray-400 block mb-0.5">Reference</span>
                        <p class="font-mono text-xs font-semibold truncate" style="color: var(--text-secondary);" title="{{ $order->payment_reference }}">
                            {{ $order->payment_reference ?? '—' }}
                        </p>
                    </div>
                </div>

                {{-- Items --}}
                <div class="space-y-3 mb-4">
                    @foreach($order->items as $item)
                    <div class="flex items-center justify-between text-sm">
                        <div class="flex items-center gap-2 min-w-0">
                            <span class="font-bold text-[#2997ff]">{{ $item->quantity }}x</span>
                            <span class="truncate" style="color: var(--text-secondary);">{{ $item->product?->name ?? 'Product' }}</span>
                        </div>
                        <span class="font-bold shrink-0 ml-4" style="color: var(--text-primary);">₵{{ number_format($item->subtotal, 2) }}</span>
                    </div>
                    @endforeach
                </div>

                <div class="pt-3 border-t flex justify-between font-bold text-base" style="border-color: var(--border-color);">
                    <span style="color: var(--text-primary);">Total Amount</span>
                    <span class="text-xl text-[#2997ff]">₵{{ number_format($order->total, 2) }}</span>
                </div>
            </div>

            {{-- Customer & Delivery Details --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-left text-xs mb-8">
                <div class="p-4 rounded-xl border" style="background: var(--bg-primary); border-color: var(--border-color);">
                    <p class="font-bold uppercase tracking-wider text-gray-400 mb-1">Customer</p>
                    <p class="font-semibold" style="color: var(--text-primary);">{{ $order->customer_name }}</p>
                    <p style="color: var(--text-secondary);">{{ $order->customer_phone }}</p>
                    <p style="color: var(--text-secondary);">{{ $order->customer_email }}</p>
                </div>
                <div class="p-4 rounded-xl border" style="background: var(--bg-primary); border-color: var(--border-color);">
                    <p class="font-bold uppercase tracking-wider text-gray-400 mb-1">Delivery Address</p>
                    <p class="font-semibold" style="color: var(--text-primary);">{{ $order->shipping_address }}</p>
                    @if($order->notes)
                    <p class="mt-1" style="color: var(--text-muted);">{{ $order->notes }}</p>
                    @endif
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                @if(!$order->isPaid())
                <a href="{{ route('paystack.retry', $order->id) }}"
                   class="w-full sm:w-auto px-8 py-3.5 bg-green-600 text-white rounded-full text-sm font-bold hover:bg-green-700 transition shadow-md flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    <span>Complete Payment on Paystack</span>
                </a>
                @endif

                <a href="{{ route('store.index') }}"
                   class="w-full sm:w-auto px-8 py-3.5 bg-[#2997ff] text-white rounded-full text-sm font-bold hover:bg-[#1a7de3] transition shadow-md">
                    Continue Shopping
                </a>

                <a href="https://wa.me/233505504793?text={{ urlencode('Hello Monarchi HQ! I just placed order #MHQ-' . str_pad($order->id, 5, '0', STR_PAD_LEFT) . ' for ₵' . number_format($order->total, 2) . ' (' . ($order->isPaid() ? 'Paid' : 'Pending') . '). Please confirm my order.') }}"
                   target="_blank"
                   class="w-full sm:w-auto px-8 py-3.5 rounded-full text-sm font-bold transition border border-green-500/30 text-green-500 hover:bg-green-500/10 flex items-center justify-center gap-2">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                        <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.771-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.274.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.045.072.045.419-.099.824zm-3.423-14.416c-6.627 0-12 5.373-12 12 0 2.175.58 4.212 1.587 5.972l-1.687 6.168 6.347-1.664c1.704.938 3.659 1.524 5.753 1.524 6.627 0 12-5.373 12-12s-5.373-12-12-12z"/>
                    </svg>
                    Confirm on WhatsApp
                </a>
            </div>

        </div>

    </div>
</div>
</x-main-layout>
