<x-main-layout>
<div style="background:#f8f8f6; min-height:100vh;" class="pt-20 md:pt-24 pb-24">
    <div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 pt-4">

        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-xs text-gray-400 mb-8">
            <a href="{{ route('store.index') }}" class="hover:text-gray-700 transition">Store</a>
            <span>/</span>
            <a href="{{ route('store.index', ['category' => $product->category->slug]) }}" class="hover:text-gray-700 transition">{{ $product->category->name }}</a>
            <span>/</span>
            <span class="text-gray-600 font-medium">{{ $product->name }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

            {{-- Product Image --}}
            <div class="rounded-3xl overflow-hidden bg-white border border-gray-100 shadow-sm aspect-square">
                <img src="{{ $product->image_url }}"
                     alt="{{ $product->name }}"
                     class="w-full h-full object-cover">
            </div>

            {{-- Product Info --}}
            <div class="flex flex-col">
                @if($product->badge_text)
                <span class="inline-block text-[11px] font-bold uppercase tracking-widest px-3 py-1 rounded-full mb-4 w-fit
                    @if($product->badge_color === 'orange') bg-orange-500 text-white
                    @elseif($product->badge_color === 'red') bg-red-600 text-white
                    @elseif($product->badge_color === 'green') bg-green-600 text-white
                    @elseif($product->badge_color === 'blue') bg-blue-600 text-white
                    @else bg-gray-500 text-white @endif">
                    {{ $product->badge_text }}
                </span>
                @endif

                <p class="text-xs font-semibold uppercase tracking-widest text-gray-400 mb-2">{{ $product->category->name }}</p>
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 leading-tight mb-3">{{ $product->name }}</h1>
                <p class="text-gray-500 text-sm leading-relaxed mb-6">{{ $product->short_description }}</p>

                {{-- Price --}}
                <div class="flex items-baseline gap-3 mb-2">
                    <span class="text-3xl font-bold text-gray-900">{{ $product->display_price }}</span>
                    @if($product->is_on_sale)
                        <span class="text-lg text-gray-400 line-through">{{ $product->original_price }}</span>
                        <span class="text-sm font-semibold text-red-500">Sale</span>
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
                    <span class="text-sm font-medium text-gray-500">{{ $statusLabels[$status] }}</span>
                </div>

                {{-- Add to Bag --}}
                @if($product->stock_status !== 'out_of_stock')
                <form action="{{ route('cart.add') }}" method="POST" class="flex gap-3 mb-4">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock_quantity }}"
                           class="w-16 px-3 py-3.5 border border-gray-200 rounded-xl text-center text-sm font-semibold bg-white focus:outline-none focus:border-gray-400">
                    <button type="submit"
                            class="flex-1 py-3.5 bg-[#111] text-white rounded-xl font-semibold text-sm hover:bg-gray-800 transition-all hover:shadow-lg active:scale-95">
                        Add to Bag →
                    </button>
                </form>
                @else
                <button disabled class="w-full py-3.5 bg-gray-100 text-gray-400 rounded-xl font-semibold text-sm cursor-not-allowed mb-4">
                    Currently Out of Stock
                </button>
                @endif

                {{-- SKU --}}
                <p class="text-xs text-gray-300 mb-6">SKU: {{ $product->sku ?? '—' }}</p>

                {{-- Description --}}
                @if($product->description)
                <div class="border-t border-gray-100 pt-6">
                    <h2 class="font-semibold text-gray-900 mb-3 text-sm uppercase tracking-wider">Product Details</h2>
                    <p class="text-sm text-gray-600 leading-relaxed">{{ $product->description }}</p>
                </div>
                @endif
            </div>
        </div>

        {{-- Related Products --}}
        @if($related->isNotEmpty())
        <section class="mt-20">
            <h2 class="text-2xl font-semibold text-gray-900 mb-6">More in {{ $product->category->name }}</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-5">
                @foreach($related as $rel)
                <a href="{{ route('store.show', $rel->slug) }}"
                   class="group bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
                    <div class="aspect-square overflow-hidden">
                        <img src="{{ $rel->image_url }}" alt="{{ $rel->name }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-400">
                    </div>
                    <div class="p-3">
                        <p class="text-sm font-semibold text-gray-900 line-clamp-1">{{ $rel->name }}</p>
                        <p class="text-sm font-bold text-gray-700 mt-1">{{ $rel->display_price }}</p>
                    </div>
                </a>
                @endforeach
            </div>
        </section>
        @endif
    </div>
</div>
</x-main-layout>
