<x-filament-panels::page>
    @php
        $overview = $this->getOverviewData();
        $saas     = $this->getSaasData();
        $hardware = $this->getHardwareData();
        $servicing= $this->getServicingData();
        $backups  = $this->getBackupsList();
    @endphp

    <div class="space-y-6">

        {{-- ── TAB NAVIGATION HEADER ────────────────────────────────────────── --}}
        <div class="flex flex-wrap items-center justify-between gap-4 pb-2 border-b border-gray-200 dark:border-white/10">
            {{-- Tabs --}}
            <nav class="flex flex-wrap gap-2" aria-label="Dashboard Sections">
                <button
                    wire:click="setTab('overview')"
                    class="px-4 py-2 rounded-xl text-xs font-bold transition flex items-center gap-2 {{ $activeTab === 'overview' ? 'bg-[#2997ff] text-white shadow-md' : 'bg-gray-100 dark:bg-white/5 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-white/10 border border-gray-200/60 dark:border-white/10' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    <span>Overview &amp; Financials</span>
                </button>

                <button
                    wire:click="setTab('saas')"
                    class="px-4 py-2 rounded-xl text-xs font-bold transition flex items-center gap-2 {{ $activeTab === 'saas' ? 'bg-[#2997ff] text-white shadow-md' : 'bg-gray-100 dark:bg-white/5 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-white/10 border border-gray-200/60 dark:border-white/10' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                    <span>SaaS &amp; Software</span>
                    <span class="px-1.5 py-0.2 rounded-full text-[10px] {{ $activeTab === 'saas' ? 'bg-white/20 text-white' : 'bg-gray-200 dark:bg-white/10 text-gray-600 dark:text-gray-400' }}">{{ $saas['saasCount'] }}</span>
                </button>

                <button
                    wire:click="setTab('hardware')"
                    class="px-4 py-2 rounded-xl text-xs font-bold transition flex items-center gap-2 {{ $activeTab === 'hardware' ? 'bg-[#2997ff] text-white shadow-md' : 'bg-gray-100 dark:bg-white/5 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-white/10 border border-gray-200/60 dark:border-white/10' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    <span>Hardware &amp; IoT</span>
                    @if($hardware['lowStockCount'] > 0)
                        <span class="px-1.5 py-0.2 rounded-full text-[10px] bg-amber-500 text-white font-bold">{{ $hardware['lowStockCount'] }} alert</span>
                    @endif
                </button>

                <button
                    wire:click="setTab('servicing')"
                    class="px-4 py-2 rounded-xl text-xs font-bold transition flex items-center gap-2 {{ $activeTab === 'servicing' ? 'bg-[#2997ff] text-white shadow-md' : 'bg-gray-100 dark:bg-white/5 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-white/10 border border-gray-200/60 dark:border-white/10' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    <span>Servicing &amp; Inquiries</span>
                </button>

                <button
                    wire:click="setTab('backups')"
                    class="px-4 py-2 rounded-xl text-xs font-bold transition flex items-center gap-2 {{ $activeTab === 'backups' ? 'bg-[#2997ff] text-white shadow-md' : 'bg-gray-100 dark:bg-white/5 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-white/10 border border-gray-200/60 dark:border-white/10' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
                    <span>Backup &amp; Restore</span>
                    <span class="px-1.5 py-0.2 rounded-full text-[10px] {{ $activeTab === 'backups' ? 'bg-white/20 text-white' : 'bg-gray-200 dark:bg-white/10 text-gray-600 dark:text-gray-400' }}">{{ count($backups) }}</span>
                </button>
            </nav>

            {{-- Quick action links --}}
            <div class="flex items-center gap-2">
                <a href="{{ route('filament.monarch.resources.orders.index') }}"
                   class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-gray-100 dark:bg-white/5 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-white/10 transition border border-gray-200/60 dark:border-white/10">
                    Orders ({{ $overview['totalOrdersCount'] }})
                </a>
                <a href="{{ route('filament.monarch.resources.products.create') }}"
                   class="px-3 py-1.5 rounded-lg text-xs font-bold bg-[#2997ff] text-white hover:bg-[#1a7de3] transition">
                    + Add Product
                </a>
            </div>
        </div>


        {{-- ══════════════════════════════════════════════════════════════════ --}}
        {{-- TAB 1: OVERVIEW & FINANCIALS                                       --}}
        {{-- ══════════════════════════════════════════════════════════════════ --}}
        @if($activeTab === 'overview')
        <div class="space-y-6">

            {{-- Explanation Banner --}}
            <div class="p-4 rounded-2xl border border-blue-500/20 bg-blue-500/5 flex items-start gap-3">
                <div class="p-2 rounded-xl bg-[#2997ff]/10 text-[#2997ff] shrink-0 mt-0.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <h4 class="text-xs font-bold text-gray-900 dark:text-white uppercase tracking-wider mb-0.5">Overview &amp; Revenue Analytics</h4>
                    <p class="text-xs text-gray-600 dark:text-gray-400 leading-relaxed">
                        Live performance metrics computed directly from Paystack transactions, active store catalog, and customer registrations.
                    </p>
                </div>
            </div>

            {{-- KPI Stat Cards Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                {{-- Total Revenue --}}
                <div class="p-5 rounded-2xl border border-gray-200 dark:border-white/10 bg-white dark:bg-gray-900 shadow-sm">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">Total Verified Income</span>
                        <div class="w-8 h-8 rounded-lg bg-green-500/10 text-green-500 flex items-center justify-center font-bold text-sm">₵</div>
                    </div>
                    <div class="text-2xl font-extrabold text-gray-900 dark:text-white">
                        ₵{{ number_format($overview['totalRevenue'], 2) }}
                    </div>
                    <p class="text-[11px] text-green-500 font-semibold mt-1.5 flex items-center gap-1">
                        <span>✓</span> Verified via Paystack
                    </p>
                </div>

                {{-- Total Orders --}}
                <div class="p-5 rounded-2xl border border-gray-200 dark:border-white/10 bg-white dark:bg-gray-900 shadow-sm">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">Orders Received</span>
                        <div class="w-8 h-8 rounded-lg bg-blue-500/10 text-[#2997ff] flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                        </div>
                    </div>
                    <div class="text-2xl font-extrabold text-gray-900 dark:text-white">
                        {{ $overview['totalOrdersCount'] }}
                    </div>
                    <p class="text-[11px] text-gray-500 dark:text-gray-400 mt-1.5">
                        <span class="text-green-500 font-bold">{{ $overview['paidOrdersCount'] }} Paid</span> &middot; {{ $overview['pendingOrdersCount'] }} Pending
                    </p>
                </div>

                {{-- Active Products --}}
                <div class="p-5 rounded-2xl border border-gray-200 dark:border-white/10 bg-white dark:bg-gray-900 shadow-sm">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">Catalog Products</span>
                        <div class="w-8 h-8 rounded-lg bg-indigo-500/10 text-indigo-500 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        </div>
                    </div>
                    <div class="text-2xl font-extrabold text-gray-900 dark:text-white">
                        {{ $overview['activeProductsCount'] }}
                    </div>
                    <p class="text-[11px] text-gray-500 dark:text-gray-400 mt-1.5">
                        Active items across store categories
                    </p>
                </div>

                {{-- Customers --}}
                <div class="p-5 rounded-2xl border border-gray-200 dark:border-white/10 bg-white dark:bg-gray-900 shadow-sm">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">Customer Accounts</span>
                        <div class="w-8 h-8 rounded-lg bg-purple-500/10 text-purple-500 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        </div>
                    </div>
                    <div class="text-2xl font-extrabold text-gray-900 dark:text-white">
                        {{ $overview['totalCustomersCount'] }}
                    </div>
                    <p class="text-[11px] text-gray-500 dark:text-gray-400 mt-1.5">
                        Registered client users
                    </p>
                </div>
            </div>

            {{-- Recent Orders Section --}}
            <div class="rounded-2xl border border-gray-200 dark:border-white/10 bg-white dark:bg-gray-900 overflow-hidden shadow-sm">
                <div class="p-4 border-b border-gray-200 dark:border-white/10 flex items-center justify-between">
                    <div>
                        <h3 class="text-sm font-bold text-gray-900 dark:text-white">Recent Customer Transactions</h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Live feed of orders and Paystack checkout events</p>
                    </div>
                    <a href="{{ route('filament.monarch.resources.orders.index') }}" class="text-xs font-bold text-[#2997ff] hover:underline">
                        View All Orders &rarr;
                    </a>
                </div>

                @if($overview['recentOrders']->isEmpty())
                    <div class="py-12 text-center text-xs text-gray-500">
                        No orders recorded yet. Place a test order in the store to see live data here.
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs">
                            <thead class="bg-gray-50 dark:bg-white/[0.02] text-gray-500 uppercase font-bold text-[10px] border-b border-gray-200 dark:border-white/10">
                                <tr>
                                    <th class="p-3.5">Order</th>
                                    <th class="p-3.5">Customer</th>
                                    <th class="p-3.5">Payment</th>
                                    <th class="p-3.5">Fulfillment</th>
                                    <th class="p-3.5">Total Amount</th>
                                    <th class="p-3.5">Date</th>
                                    <th class="p-3.5 text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-white/5">
                                @foreach($overview['recentOrders'] as $order)
                                <tr class="hover:bg-gray-50/50 dark:hover:bg-white/[0.01] transition">
                                    <td class="p-3.5 font-bold text-gray-900 dark:text-white">
                                        #MHQ-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}
                                    </td>
                                    <td class="p-3.5">
                                        <div class="font-semibold text-gray-800 dark:text-gray-200">{{ $order->customer_name ?? 'Guest' }}</div>
                                        <div class="text-[11px] text-gray-400">{{ $order->customer_email }}</div>
                                    </td>
                                    <td class="p-3.5">
                                        @if($order->isPaid())
                                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-green-500/10 text-green-500 border border-green-500/20">
                                                ✓ Paid ({{ ucfirst(str_replace('_', ' ', $order->payment_channel ?? 'Paystack')) }})
                                            </span>
                                        @elseif($order->payment_status === 'failed')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-red-500/10 text-red-500 border border-red-500/20">
                                                Failed
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-500/10 text-amber-500 border border-amber-500/20">
                                                Pending Paystack
                                            </span>
                                        @endif
                                    </td>
                                    <td class="p-3.5">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold {{ $order->status === 'delivered' ? 'bg-green-500/10 text-green-500' : ($order->status === 'cancelled' ? 'bg-red-500/10 text-red-500' : 'bg-blue-500/10 text-[#2997ff]') }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td class="p-3.5 font-bold text-gray-900 dark:text-white">
                                        ₵{{ number_format($order->total, 2) }}
                                    </td>
                                    <td class="p-3.5 text-gray-500">
                                        {{ $order->created_at->format('M d, Y H:i') }}
                                    </td>
                                    <td class="p-3.5 text-right">
                                        <a href="{{ route('filament.monarch.resources.orders.edit', $order) }}"
                                           class="px-2.5 py-1 rounded-lg bg-gray-100 dark:bg-white/5 hover:bg-[#2997ff] hover:text-white transition font-semibold text-[11px] border border-gray-200/60 dark:border-white/10">
                                            Manage &rarr;
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

        </div>
        @endif


        {{-- ══════════════════════════════════════════════════════════════════ --}}
        {{-- TAB 2: SAAS & SOFTWARE                                             --}}
        {{-- ══════════════════════════════════════════════════════════════════ --}}
        @if($activeTab === 'saas')
        <div class="space-y-6">

            <div class="p-4 rounded-2xl border border-blue-500/20 bg-blue-500/5 flex items-start gap-3">
                <div class="p-2 rounded-xl bg-[#2997ff]/10 text-[#2997ff] shrink-0 mt-0.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                </div>
                <div>
                    <h4 class="text-xs font-bold text-gray-900 dark:text-white uppercase tracking-wider mb-0.5">SaaS &amp; Proprietary Software Hub</h4>
                    <p class="text-xs text-gray-600 dark:text-gray-400 leading-relaxed">
                        Tracks subscriptions, license tiers, digital activations, and SaaS platform products.
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="p-5 rounded-2xl border border-gray-200 dark:border-white/10 bg-white dark:bg-gray-900 shadow-sm">
                    <span class="text-xs font-bold uppercase tracking-wider text-gray-500">SaaS Packages Offered</span>
                    <div class="text-2xl font-extrabold text-gray-900 dark:text-white mt-2">{{ $saas['saasCount'] }}</div>
                    <p class="text-[11px] text-gray-500 mt-1">Live in store catalog</p>
                </div>
                <div class="p-5 rounded-2xl border border-gray-200 dark:border-white/10 bg-white dark:bg-gray-900 shadow-sm">
                    <span class="text-xs font-bold uppercase tracking-wider text-gray-500">Digital Licenses Sold</span>
                    <div class="text-2xl font-extrabold text-gray-900 dark:text-white mt-2">{{ $saas['saasSalesCount'] }}</div>
                    <p class="text-[11px] text-gray-500 mt-1">Customer activations</p>
                </div>
                <div class="p-5 rounded-2xl border border-gray-200 dark:border-white/10 bg-white dark:bg-gray-900 shadow-sm">
                    <span class="text-xs font-bold uppercase tracking-wider text-gray-500">SaaS Revenue</span>
                    <div class="text-2xl font-extrabold text-green-500 mt-2">₵{{ number_format($saas['saasRevenue'], 2) }}</div>
                    <p class="text-[11px] text-gray-500 mt-1">Paid software purchases</p>
                </div>
            </div>

            {{-- Products Table --}}
            <div class="rounded-2xl border border-gray-200 dark:border-white/10 bg-white dark:bg-gray-900 overflow-hidden shadow-sm">
                <div class="p-4 border-b border-gray-200 dark:border-white/10 flex items-center justify-between">
                    <h3 class="text-sm font-bold text-gray-900 dark:text-white">Active Software &amp; SaaS Catalog</h3>
                    <a href="{{ route('filament.monarch.resources.products.create') }}" class="text-xs font-bold text-[#2997ff] hover:underline">
                        + New SaaS Plan
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-gray-50 dark:bg-white/[0.02] text-gray-500 uppercase font-bold text-[10px] border-b border-gray-200 dark:border-white/10">
                            <tr>
                                <th class="p-3.5">Software Product</th>
                                <th class="p-3.5">Category</th>
                                <th class="p-3.5">Price</th>
                                <th class="p-3.5">Status</th>
                                <th class="p-3.5 text-right">Edit</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-white/5">
                            @forelse($saas['saasProducts'] as $prod)
                            <tr class="hover:bg-gray-50/50 dark:hover:bg-white/[0.01]">
                                <td class="p-3.5">
                                    <div class="font-bold text-gray-900 dark:text-white">{{ $prod->name }}</div>
                                    <div class="text-[11px] text-gray-400 font-mono">{{ $prod->sku }}</div>
                                </td>
                                <td class="p-3.5 text-gray-500">{{ $prod->category?->name ?? 'SaaS' }}</td>
                                <td class="p-3.5 font-bold text-gray-900 dark:text-white">₵{{ number_format($prod->price, 2) }}</td>
                                <td class="p-3.5">
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold {{ $prod->is_active ? 'bg-green-500/10 text-green-500' : 'bg-gray-200 text-gray-500' }}">
                                        {{ $prod->is_active ? 'Active' : 'Draft' }}
                                    </span>
                                </td>
                                <td class="p-3.5 text-right">
                                    <a href="{{ route('filament.monarch.resources.products.edit', $prod) }}" class="text-[#2997ff] font-semibold hover:underline">
                                        Edit &rarr;
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="5" class="p-6 text-center text-gray-500">No SaaS products configured.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        @endif


        {{-- ══════════════════════════════════════════════════════════════════ --}}
        {{-- TAB 3: HARDWARE & EDGE IOT                                         --}}
        {{-- ══════════════════════════════════════════════════════════════════ --}}
        @if($activeTab === 'hardware')
        <div class="space-y-6">

            <div class="p-4 rounded-2xl border border-blue-500/20 bg-blue-500/5 flex items-start gap-3">
                <div class="p-2 rounded-xl bg-[#2997ff]/10 text-[#2997ff] shrink-0 mt-0.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
                <div>
                    <h4 class="text-xs font-bold text-gray-900 dark:text-white uppercase tracking-wider mb-0.5">Hardware &amp; Edge Infrastructure Inventory</h4>
                    <p class="text-xs text-gray-600 dark:text-gray-400 leading-relaxed">
                        Manages physical inventory across Servers, Edge IoT Nodes, Workstations, Security Cameras, and Networking hardware.
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="p-5 rounded-2xl border border-gray-200 dark:border-white/10 bg-white dark:bg-gray-900 shadow-sm">
                    <span class="text-xs font-bold uppercase tracking-wider text-gray-500">Total Units In Stock</span>
                    <div class="text-2xl font-extrabold text-gray-900 dark:text-white mt-2">{{ $hardware['totalUnitsInStock'] }}</div>
                    <p class="text-[11px] text-gray-500 mt-1">Across all hardware categories</p>
                </div>
                <div class="p-5 rounded-2xl border border-gray-200 dark:border-white/10 bg-white dark:bg-gray-900 shadow-sm">
                    <span class="text-xs font-bold uppercase tracking-wider text-gray-500">Inventory Asset Value</span>
                    <div class="text-2xl font-extrabold text-[#2997ff] mt-2">₵{{ number_format($hardware['inventoryAssetValue'], 2) }}</div>
                    <p class="text-[11px] text-gray-500 mt-1">Retail value on hand</p>
                </div>
                <div class="p-5 rounded-2xl border border-gray-200 dark:border-white/10 bg-white dark:bg-gray-900 shadow-sm">
                    <span class="text-xs font-bold uppercase tracking-wider text-gray-500">Reorder Alerts</span>
                    <div class="text-2xl font-extrabold {{ $hardware['lowStockCount'] > 0 ? 'text-amber-500' : 'text-green-500' }} mt-2">
                        {{ $hardware['lowStockCount'] }}
                    </div>
                    <p class="text-[11px] text-gray-500 mt-1">Products below safety threshold</p>
                </div>
            </div>

            {{-- Low stock warning table --}}
            @if($hardware['lowStockCount'] > 0)
            <div class="rounded-2xl border border-amber-500/30 bg-amber-500/5 p-4">
                <h3 class="text-xs font-bold uppercase tracking-wider text-amber-500 mb-2 flex items-center gap-1.5">
                    <span>⚠️</span> Low Stock &amp; Restock Alerts
                </h3>
                <div class="space-y-2 mt-3">
                    @foreach($hardware['lowStockProducts'] as $lowProd)
                    <div class="flex items-center justify-between p-3 rounded-xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-white/10 text-xs">
                        <div class="flex items-center gap-3">
                            <span class="font-bold text-gray-900 dark:text-white">{{ $lowProd->name }}</span>
                            <span class="text-gray-400 font-mono text-[11px]">({{ $lowProd->sku }})</span>
                        </div>
                        <div class="flex items-center gap-4">
                            <span class="px-2 py-0.5 rounded-full font-bold text-[10px] bg-red-500/10 text-red-500">
                                {{ $lowProd->stock_quantity }} left (Min: {{ $lowProd->min_stock_threshold }})
                            </span>
                            <a href="{{ route('filament.monarch.resources.products.edit', $lowProd) }}" class="text-xs font-bold text-[#2997ff] hover:underline">
                                Restock &rarr;
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

        </div>
        @endif


        {{-- ══════════════════════════════════════════════════════════════════ --}}
        {{-- TAB 4: SERVICING & INQUIRIES                                       --}}
        {{-- ══════════════════════════════════════════════════════════════════ --}}
        @if($activeTab === 'servicing')
        <div class="space-y-6">

            <div class="p-4 rounded-2xl border border-blue-500/20 bg-blue-500/5 flex items-start gap-3">
                <div class="p-2 rounded-xl bg-[#2997ff]/10 text-[#2997ff] shrink-0 mt-0.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                </div>
                <div>
                    <h4 class="text-xs font-bold text-gray-900 dark:text-white uppercase tracking-wider mb-0.5">Custom Engineering &amp; Client Inquiries</h4>
                    <p class="text-xs text-gray-600 dark:text-gray-400 leading-relaxed">
                        Surfaces client order special instructions, custom consulting requests, and contact desk inquiries.
                    </p>
                </div>
            </div>

            {{-- Custom requests list --}}
            <div class="rounded-2xl border border-gray-200 dark:border-white/10 bg-white dark:bg-gray-900 p-4 shadow-sm">
                <h3 class="text-sm font-bold text-gray-900 dark:text-white mb-3">Client Inquiries &amp; Custom Instructions</h3>
                @if($servicing['customOrders']->isEmpty())
                    <p class="text-xs text-gray-500 py-6 text-center">No custom order notes recorded yet.</p>
                @else
                    <div class="space-y-3">
                        @foreach($servicing['customOrders'] as $cOrder)
                        <div class="p-4 rounded-xl border border-gray-200 dark:border-white/10 bg-gray-50/50 dark:bg-white/[0.02] text-xs">
                            <div class="flex items-center justify-between pb-2 mb-2 border-b border-gray-200 dark:border-white/10">
                                <span class="font-bold text-gray-900 dark:text-white">{{ $cOrder->customer_name }} (#MHQ-{{ str_pad($cOrder->id, 5, '0', STR_PAD_LEFT) }})</span>
                                <span class="text-gray-400">{{ $cOrder->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-gray-700 dark:text-gray-300 italic mb-2">"{{ $cOrder->notes }}"</p>
                            <div class="flex items-center justify-between text-[11px] text-gray-500 pt-1">
                                <span>Phone: {{ $cOrder->customer_phone ?? 'N/A' }}</span>
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $cOrder->customer_phone) }}" target="_blank" class="text-green-500 font-bold hover:underline">
                                    Chat on WhatsApp &rarr;
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
        @endif


        {{-- ══════════════════════════════════════════════════════════════════ --}}
        {{-- TAB 5: DATABASE BACKUP & RESTORE                                   --}}
        {{-- ══════════════════════════════════════════════════════════════════ --}}
        @if($activeTab === 'backups')
        <div class="space-y-6">

            <div class="p-4 rounded-2xl border border-blue-500/20 bg-blue-500/5 flex items-start justify-between gap-4">
                <div class="flex items-start gap-3">
                    <div class="p-2 rounded-xl bg-[#2997ff]/10 text-[#2997ff] shrink-0 mt-0.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-gray-900 dark:text-white uppercase tracking-wider mb-0.5">Database Snapshot &amp; Disaster Recovery</h4>
                        <p class="text-xs text-gray-600 dark:text-gray-400 leading-relaxed">
                            Create point-in-time SQLite database snapshots, download backup archives to local storage, or restore the system state instantly.
                        </p>
                    </div>
                </div>

                {{-- Create Backup CTA Button --}}
                <button
                    type="button"
                    wire:click="handleCreateBackup"
                    wire:loading.attr="disabled"
                    class="px-4 py-2 bg-green-600 text-white rounded-xl text-xs font-bold hover:bg-green-700 transition shrink-0 flex items-center gap-2 shadow-md disabled:opacity-50">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    <span>Create Snapshot Now</span>
                </button>
            </div>

            {{-- Backups List Table --}}
            <div class="rounded-2xl border border-gray-200 dark:border-white/10 bg-white dark:bg-gray-900 overflow-hidden shadow-sm">
                <div class="p-4 border-b border-gray-200 dark:border-white/10 flex items-center justify-between">
                    <div>
                        <h3 class="text-sm font-bold text-gray-900 dark:text-white">Existing Database Snapshots</h3>
                        <p class="text-xs text-gray-500">Stored locally in <code class="font-mono text-[11px] bg-gray-100 dark:bg-white/10 px-1 py-0.5 rounded">storage/app/backups</code></p>
                    </div>
                    <span class="text-xs font-bold text-gray-500">{{ count($backups) }} snapshots</span>
                </div>

                @if(empty($backups))
                    <div class="py-12 text-center text-xs text-gray-500">
                        No backups created yet. Click <strong>"Create Snapshot Now"</strong> above to make your first database snapshot.
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs">
                            <thead class="bg-gray-50 dark:bg-white/[0.02] text-gray-500 uppercase font-bold text-[10px] border-b border-gray-200 dark:border-white/10">
                                <tr>
                                    <th class="p-3.5">Backup Filename</th>
                                    <th class="p-3.5">File Size</th>
                                    <th class="p-3.5">Created At</th>
                                    <th class="p-3.5 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-white/5">
                                @foreach($backups as $b)
                                <tr class="hover:bg-gray-50/50 dark:hover:bg-white/[0.01]">
                                    <td class="p-3.5 font-mono text-xs font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                                        <svg class="w-4 h-4 text-[#2997ff] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2 1 3 3 3h10c2 0 3-1 3-3V7c0-2-1-3-3-3H7C5 4 4 5 4 7z"/></svg>
                                        <span>{{ $b['filename'] }}</span>
                                    </td>
                                    <td class="p-3.5 text-gray-500 font-mono">{{ $b['size'] }}</td>
                                    <td class="p-3.5 text-gray-500">{{ $b['modified']->format('M d, Y H:i:s') }}</td>
                                    <td class="p-3.5 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            {{-- Download --}}
                                            <a href="{{ route('admin.backups.download', $b['filename']) }}"
                                               class="px-2.5 py-1 rounded-lg bg-blue-500/10 text-[#2997ff] hover:bg-blue-500/20 font-bold transition text-[11px]"
                                               title="Download backup file">
                                                📥 Download
                                            </a>

                                            {{-- Restore --}}
                                            <button
                                                type="button"
                                                wire:click="handleRestoreBackup('{{ $b['filename'] }}')"
                                                wire:confirm="CAUTION: Are you sure you want to restore the database from {{ $b['filename'] }}? A pre-restore safety snapshot will be taken first."
                                                class="px-2.5 py-1 rounded-lg bg-amber-500/10 text-amber-600 dark:text-amber-400 hover:bg-amber-500/20 font-bold transition text-[11px]"
                                                title="Restore database state from this backup">
                                                🔄 Restore
                                            </button>

                                            {{-- Delete --}}
                                            <button
                                                type="button"
                                                wire:click="handleDeleteBackup('{{ $b['filename'] }}')"
                                                wire:confirm="Permanently delete {{ $b['filename'] }}?"
                                                class="px-2.5 py-1 rounded-lg bg-red-500/10 text-red-500 hover:bg-red-500/20 font-bold transition text-[11px]"
                                                title="Delete backup file">
                                                🗑️
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

        </div>
        @endif

    </div>
</x-filament-panels::page>
