<x-filament-panels::page>
    @php
        $overview = $this->getOverviewData();
        $saas     = $this->getSaasData();
        $hardware = $this->getHardwareData();
        $servicing= $this->getServicingData();
        $backups  = $this->getBackupsList();
    @endphp

    {{-- ── GSAP ─────────────────────────────────────────────────────────────── --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>

    <style>
        /* ── Bento Tab Grid ───────────────────────────────────────────────── */
        .monarch-bento-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
        }
        @media (max-width: 900px) { .monarch-bento-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 500px)  { .monarch-bento-grid { grid-template-columns: 1fr 1fr; } }

        /* ── Bento Tab Card ───────────────────────────────────────────────── */
        .bento-tab {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
            padding: 16px;
            border-radius: 18px;
            border: 1.5px solid rgba(255,255,255,0.07);
            cursor: pointer;
            transition: transform 0.22s cubic-bezier(.4,0,.2,1),
                        box-shadow 0.22s cubic-bezier(.4,0,.2,1),
                        border-color 0.22s ease;
            overflow: hidden;
            user-select: none;
            text-align: left;
            width: 100%;
        }
        .bento-tab:hover { transform: translateY(-3px) scale(1.015); box-shadow: 0 12px 36px -8px rgba(41,151,255,0.22); }
        .bento-tab.active { border-color: transparent; box-shadow: 0 8px 32px -6px rgba(41,151,255,0.35); }
        .bento-tab .bento-icon {
            width: 36px; height: 36px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .bento-tab .bento-label { font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.06em; line-height: 1.2; }
        .bento-tab .bento-sub   { font-size: 10px; opacity: 0.65; font-weight: 500; }
        .bento-tab .bento-badge { position: absolute; top: 10px; right: 10px; padding: 2px 7px; border-radius: 99px; font-size: 9px; font-weight: 800; }
        .bento-tab.inactive { background: rgba(255,255,255,0.03); }
        html:not(.dark) .bento-tab.inactive { background: #f4f6fa; border-color: #e2e8f0; }

        /* ── Active gradients per tab ─────────────────────────────────────── */
        .bento-tab.active[data-tab="overview"]  { background: linear-gradient(135deg, #0f2027 0%, #1a3a5c 60%, #2997ff22 100%); }
        .bento-tab.active[data-tab="saas"]      { background: linear-gradient(135deg, #1a1040 0%, #2d1b69 60%, #7c3aed22 100%); }
        .bento-tab.active[data-tab="hardware"]  { background: linear-gradient(135deg, #0a1f12 0%, #14532d 60%, #22c55e22 100%); }
        .bento-tab.active[data-tab="servicing"] { background: linear-gradient(135deg, #1f1205 0%, #431407 60%, #f9731622 100%); }
        .bento-tab.active[data-tab="backups"]   { background: linear-gradient(135deg, #0c1229 0%, #1e3a5f 60%, #06b6d422 100%); }
        html:not(.dark) .bento-tab.active[data-tab="overview"]  { background: linear-gradient(135deg, #e8f4ff 0%, #c3e0ff 100%); }
        html:not(.dark) .bento-tab.active[data-tab="saas"]      { background: linear-gradient(135deg, #f5f0ff 0%, #ddd6fe 100%); }
        html:not(.dark) .bento-tab.active[data-tab="hardware"]  { background: linear-gradient(135deg, #f0fdf4 0%, #bbf7d0 100%); }
        html:not(.dark) .bento-tab.active[data-tab="servicing"] { background: linear-gradient(135deg, #fff7ed 0%, #fed7aa 100%); }
        html:not(.dark) .bento-tab.active[data-tab="backups"]   { background: linear-gradient(135deg, #ecfeff 0%, #a5f3fc 100%); }

        /* ── KPI Cards ───────────────────────────────────────────────────── */
        .monarch-kpi {
            position: relative; padding: 22px; border-radius: 20px;
            overflow: hidden; border: 1.5px solid rgba(255,255,255,0.07);
            transition: transform 0.22s ease, box-shadow 0.22s ease;
        }
        .monarch-kpi:hover { transform: translateY(-4px); box-shadow: 0 16px 40px -10px rgba(0,0,0,0.25); }
        html:not(.dark) .monarch-kpi { background: #fff; border-color: #e2e8f0; box-shadow: 0 2px 12px -4px rgba(0,0,0,0.08); }

        /* ── Section header accent line ──────────────────────────────────── */
        .monarch-section-header { position: relative; padding-left: 14px; }
        .monarch-section-header::before {
            content: ''; position: absolute; left: 0; top: 50%; transform: translateY(-50%);
            width: 4px; height: 70%; border-radius: 99px;
            background: linear-gradient(to bottom, #2997ff, #7c3aed);
        }

        /* ── Tables ──────────────────────────────────────────────────────────── */
        .monarch-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
            text-align: left;
        }
        .monarch-table thead tr {
            background: rgba(0,0,0,0.02);
        }
        .dark .monarch-table thead tr {
            background: rgba(255,255,255,0.02);
        }
        .monarch-table th {
            padding: 10px 14px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: #6b7280;
            border-bottom: 1px solid #e5e7eb;
            white-space: nowrap;
        }
        .dark .monarch-table th {
            color: #9ca3af;
            border-bottom-color: rgba(255,255,255,0.08);
        }
        .monarch-table td {
            padding: 10px 14px;
            vertical-align: middle;
            border-bottom: 1px solid #f3f4f6;
            color: #374151;
        }
        .dark .monarch-table td {
            border-bottom-color: rgba(255,255,255,0.04);
            color: #d1d5db;
        }
        .monarch-table tbody tr:last-child td { border-bottom: none; }
        .monarch-table tbody tr {
            transition: background 0.12s ease;
        }
        .monarch-table tbody tr:hover {
            background: rgba(41,151,255,0.04);
        }
        .dark .monarch-table tbody tr:hover {
            background: rgba(255,255,255,0.02);
        }
    </style>

    <div class="space-y-6" id="monarch-dash-root">

        {{-- ── BENTO TAB GRID ──────────────────────────────────────────────── --}}
        <div class="monarch-bento-grid" id="monarch-tabs">

            {{-- Overview & Financials --}}
            <button wire:click="setTab('overview')" data-tab="overview"
                class="bento-tab {{ $activeTab === 'overview' ? 'active' : 'inactive' }}">
                <div class="bento-icon {{ $activeTab === 'overview' ? 'bg-blue-400/20 text-[#60a5fa]' : 'bg-blue-500/10 text-blue-400' }}">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <div class="bento-label {{ $activeTab === 'overview' ? 'text-white' : 'text-gray-700 dark:text-gray-300' }}">Overview &amp; Financials</div>
                <div class="bento-sub {{ $activeTab === 'overview' ? 'text-blue-200' : 'text-gray-500' }}">Revenue · Orders · KPIs</div>
            </button>

            {{-- SaaS & Software --}}
            <button wire:click="setTab('saas')" data-tab="saas"
                class="bento-tab {{ $activeTab === 'saas' ? 'active' : 'inactive' }}">
                <div class="bento-icon {{ $activeTab === 'saas' ? 'bg-purple-400/20 text-purple-300' : 'bg-purple-500/10 text-purple-400' }}">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                    </svg>
                </div>
                <div class="bento-label {{ $activeTab === 'saas' ? 'text-white' : 'text-gray-700 dark:text-gray-300' }}">SaaS &amp; Software</div>
                <div class="bento-sub {{ $activeTab === 'saas' ? 'text-purple-200' : 'text-gray-500' }}">Licenses · Subscriptions</div>
                @if($saas['saasCount'] > 0)
                <span class="bento-badge {{ $activeTab === 'saas' ? 'bg-white/15 text-white' : 'bg-purple-500/10 text-purple-400' }}">
                    {{ $saas['saasCount'] }} plans
                </span>
                @endif
            </button>

            {{-- Hardware & IoT --}}
            <button wire:click="setTab('hardware')" data-tab="hardware"
                class="bento-tab {{ $activeTab === 'hardware' ? 'active' : 'inactive' }}">
                <div class="bento-icon {{ $activeTab === 'hardware' ? 'bg-emerald-400/20 text-emerald-300' : 'bg-emerald-500/10 text-emerald-400' }}">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div class="bento-label {{ $activeTab === 'hardware' ? 'text-white' : 'text-gray-700 dark:text-gray-300' }}">Hardware &amp; IoT</div>
                <div class="bento-sub {{ $activeTab === 'hardware' ? 'text-emerald-200' : 'text-gray-500' }}">Inventory · Alerts</div>
                @if($hardware['lowStockCount'] > 0)
                <span class="bento-badge bg-amber-500 text-white">⚠ {{ $hardware['lowStockCount'] }}</span>
                @endif
            </button>

            {{-- Servicing --}}
            <button wire:click="setTab('servicing')" data-tab="servicing"
                class="bento-tab {{ $activeTab === 'servicing' ? 'active' : 'inactive' }}">
                <div class="bento-icon {{ $activeTab === 'servicing' ? 'bg-orange-400/20 text-orange-300' : 'bg-orange-500/10 text-orange-400' }}">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <div class="bento-label {{ $activeTab === 'servicing' ? 'text-white' : 'text-gray-700 dark:text-gray-300' }}">Servicing &amp; Inquiries</div>
                <div class="bento-sub {{ $activeTab === 'servicing' ? 'text-orange-200' : 'text-gray-500' }}">Custom · Consulting</div>
            </button>

            {{-- Backup & Restore — spans full 4 cols (wide accent row) --}}
            <button wire:click="setTab('backups')" data-tab="backups"
                class="bento-tab col-span-2 sm:col-span-4 {{ $activeTab === 'backups' ? 'active' : 'inactive' }}"
                style="flex-direction:row; align-items:center; gap:14px;">
                <div class="bento-icon {{ $activeTab === 'backups' ? 'bg-cyan-400/20 text-cyan-300' : 'bg-cyan-500/10 text-cyan-400' }}" style="width:44px;height:44px;border-radius:14px;">
                    <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                    </svg>
                </div>
                <div style="flex:1; text-align:left;">
                    <div class="bento-label {{ $activeTab === 'backups' ? 'text-white' : 'text-gray-700 dark:text-gray-300' }}">Backup &amp; Restore</div>
                    <div class="bento-sub {{ $activeTab === 'backups' ? 'text-cyan-200' : 'text-gray-500' }}">Database Snapshots</div>
                </div>
                <span class="{{ $activeTab === 'backups' ? 'bg-white/15 text-white' : 'bg-cyan-500/10 text-cyan-500' }} px-3 py-1 rounded-full text-xs font-bold ml-auto shrink-0">
                    {{ count($backups) }}
                </span>
            </button>

        </div>

        {{-- ── Section Header + Quick Action ──────────────────────────────── --}}
        <div class="flex items-center justify-between pt-1">
            <div class="monarch-section-header">
                <h2 class="text-sm font-bold text-gray-900 dark:text-white pl-1">
                    @if($activeTab === 'overview') Overview &amp; Revenue Analytics
                    @elseif($activeTab === 'saas') SaaS &amp; Software Hub
                    @elseif($activeTab === 'hardware') Hardware &amp; Edge IoT Inventory
                    @elseif($activeTab === 'servicing') Custom Engineering &amp; Client Inquiries
                    @elseif($activeTab === 'backups') Database Snapshot &amp; Disaster Recovery
                    @endif
                </h2>
            </div>
            <a href="{{ route('filament.monarch.resources.products.create') }}" id="monarch-add-btn"
               class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-bold bg-[#2997ff] text-white hover:bg-[#1a7de3] transition shadow-md shadow-blue-500/25">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                </svg>
                Add Product
            </a>
        </div>


        {{-- ══════════════════════════════════════════════════════════════════ --}}
        {{-- TAB 1: OVERVIEW & FINANCIALS                                       --}}
        {{-- ══════════════════════════════════════════════════════════════════ --}}
        @if($activeTab === 'overview')
        <div class="space-y-6" id="tab-overview">

            {{-- KPI Stat Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4" id="monarch-kpis">

                {{-- Total Revenue --}}
                <div class="monarch-kpi" style="background:linear-gradient(135deg,#052e16 0%,#14532d 100%);">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-[10px] font-bold uppercase tracking-widest text-emerald-300">Total Verified Income</span>
                        <div class="w-9 h-9 rounded-xl bg-emerald-400/20 text-emerald-300 flex items-center justify-center font-black text-base">₵</div>
                    </div>
                    <div class="text-2xl font-extrabold text-white">₵{{ number_format($overview['totalRevenue'], 2) }}</div>
                    <p class="text-[11px] text-emerald-400 font-semibold mt-2 flex items-center gap-1.5">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        All verified payments
                    </p>
                </div>

                {{-- Total Orders --}}
                <div class="monarch-kpi" style="background:linear-gradient(135deg,#0c1a3a 0%,#1e3a8a 100%);">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-[10px] font-bold uppercase tracking-widest text-blue-300">Orders Received</span>
                        <div class="w-9 h-9 rounded-xl bg-blue-400/20 text-[#60a5fa] flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                        </div>
                    </div>
                    <div class="text-2xl font-extrabold text-white">{{ $overview['totalOrdersCount'] }}</div>
                    <p class="text-[11px] text-blue-300 mt-2">
                        <span class="font-bold text-emerald-400">{{ $overview['paidOrdersCount'] }} Paid</span>
                        <span class="text-blue-400/60"> · </span>
                        {{ $overview['pendingOrdersCount'] }} Pending
                    </p>
                </div>

                {{-- Active Products --}}
                <div class="monarch-kpi" style="background:linear-gradient(135deg,#1e1b4b 0%,#312e81 100%);">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-[10px] font-bold uppercase tracking-widest text-indigo-300">Catalog Products</span>
                        <div class="w-9 h-9 rounded-xl bg-indigo-400/20 text-indigo-300 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        </div>
                    </div>
                    <div class="text-2xl font-extrabold text-white">{{ $overview['activeProductsCount'] }}</div>
                    <p class="text-[11px] text-indigo-300 mt-2">Active items across store categories</p>
                </div>

                {{-- Customers --}}
                <div class="monarch-kpi" style="background:linear-gradient(135deg,#2e1065 0%,#4c1d95 100%);">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-[10px] font-bold uppercase tracking-widest text-purple-300">Customer Accounts</span>
                        <div class="w-9 h-9 rounded-xl bg-purple-400/20 text-purple-300 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        </div>
                    </div>
                    <div class="text-2xl font-extrabold text-white">{{ $overview['totalCustomersCount'] }}</div>
                    <p class="text-[11px] text-purple-300 mt-2">Registered client users</p>
                </div>
            </div>

            {{-- Recent Orders Table --}}
            <div class="rounded-2xl border border-gray-200 dark:border-white/10 bg-white dark:bg-gray-900 overflow-hidden shadow-sm">
                <div class="p-4 border-b border-gray-200 dark:border-white/10 flex items-center justify-between bg-gray-50/50 dark:bg-white/[0.02]">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-[#2997ff]/10 text-[#2997ff] flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-gray-900 dark:text-white">Recent Customer Transactions</h3>
                            <p class="text-[11px] text-gray-500 dark:text-gray-400">Live feed of orders and checkout events</p>
                        </div>
                    </div>
                    <a href="{{ route('filament.monarch.resources.orders.index') }}" class="text-xs font-bold text-[#2997ff] hover:underline flex items-center gap-1">
                        View All
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>

                @if($overview['recentOrders']->isEmpty())
                    <div class="py-14 text-center">
                        <div class="w-12 h-12 rounded-2xl bg-gray-100 dark:bg-white/5 flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                        </div>
                        <p class="text-xs text-gray-500">No orders recorded yet.</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="monarch-table">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer</th>
                                    <th>Payment</th>
                                    <th>Fulfillment</th>
                                    <th>Total</th>
                                    <th>Date</th>
                                    <th style="text-align:right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($overview['recentOrders'] as $order)
                                <tr>
                                    <td>
                                        <span class="font-mono font-bold text-gray-900 dark:text-white text-[11px]">#MHQ-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
                                    </td>
                                    <td>
                                        <div class="flex items-center gap-2.5">
                                            <div class="w-7 h-7 rounded-full bg-[#2997ff]/10 text-[#2997ff] flex items-center justify-center text-[10px] font-black shrink-0">
                                                {{ strtoupper(substr($order->customer_name ?? 'G', 0, 1)) }}
                                            </div>
                                            <div>
                                                <div class="font-semibold text-gray-900 dark:text-white">{{ $order->customer_name ?? 'Guest' }}</div>
                                                <div class="text-[10px] text-gray-400">{{ $order->customer_email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if($order->isPaid())
                                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/20">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 inline-block"></span>
                                                Paid
                                            </span>
                                        @elseif($order->payment_status === 'failed')
                                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-red-500/10 text-red-500 border border-red-500/20">
                                                <span class="w-1.5 h-1.5 rounded-full bg-red-500 inline-block"></span>
                                                Failed
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-500/10 text-amber-600 dark:text-amber-400 border border-amber-500/20">
                                                <span class="w-1.5 h-1.5 rounded-full bg-amber-400 inline-block"></span>
                                                Pending
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold
                                            {{ $order->status === 'delivered' ? 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/20'
                                            : ($order->status === 'cancelled'  ? 'bg-red-500/10 text-red-500 border border-red-500/20'
                                            : 'bg-[#2997ff]/10 text-[#2997ff] border border-[#2997ff]/20') }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td class="font-bold text-gray-900 dark:text-white">₵{{ number_format($order->total, 2) }}</td>
                                    <td class="text-gray-500">{{ $order->created_at->format('M d, Y') }}<br><span class="text-[10px]">{{ $order->created_at->format('H:i') }}</span></td>
                                    <td style="text-align:right">
                                        <a href="{{ route('filament.monarch.resources.orders.edit', $order) }}"
                                           class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-[11px] font-bold
                                                  bg-[#2997ff]/8 text-[#2997ff] border border-[#2997ff]/20
                                                  hover:bg-[#2997ff] hover:text-white hover:border-[#2997ff] transition-all duration-150">
                                            Manage
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
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
        <div class="space-y-6" id="tab-saas">

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="monarch-kpi" style="background:linear-gradient(135deg,#1e1b4b 0%,#312e81 100%);">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-8 h-8 rounded-lg bg-purple-400/20 text-purple-300 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                        </div>
                        <span class="text-[10px] font-bold uppercase tracking-widest text-purple-300">SaaS Packages</span>
                    </div>
                    <div class="text-3xl font-extrabold text-white">{{ $saas['saasCount'] }}</div>
                    <p class="text-[11px] text-purple-300 mt-2">Live in store catalog</p>
                </div>
                <div class="monarch-kpi" style="background:linear-gradient(135deg,#0f172a 0%,#1e3a8a 100%);">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-8 h-8 rounded-lg bg-blue-400/20 text-blue-300 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                        </div>
                        <span class="text-[10px] font-bold uppercase tracking-widest text-blue-300">Licenses Sold</span>
                    </div>
                    <div class="text-3xl font-extrabold text-white">{{ $saas['saasSalesCount'] }}</div>
                    <p class="text-[11px] text-blue-300 mt-2">Customer activations</p>
                </div>
                <div class="monarch-kpi" style="background:linear-gradient(135deg,#052e16 0%,#14532d 100%);">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-8 h-8 rounded-lg bg-emerald-400/20 text-emerald-300 flex items-center justify-center font-black">₵</div>
                        <span class="text-[10px] font-bold uppercase tracking-widest text-emerald-300">SaaS Revenue</span>
                    </div>
                    <div class="text-3xl font-extrabold text-emerald-300">₵{{ number_format($saas['saasRevenue'], 2) }}</div>
                    <p class="text-[11px] text-emerald-400 mt-2">Paid software purchases</p>
                </div>
            </div>

            <div class="rounded-2xl border border-gray-200 dark:border-white/10 bg-white dark:bg-gray-900 overflow-hidden shadow-sm">
                <div class="p-4 border-b border-gray-200 dark:border-white/10 flex items-center justify-between bg-gray-50/50 dark:bg-white/[0.02]">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-purple-500/10 text-purple-400 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                        </div>
                        <h3 class="text-sm font-bold text-gray-900 dark:text-white">Active Software &amp; SaaS Catalog</h3>
                    </div>
                    <a href="{{ route('filament.monarch.resources.products.create') }}" class="inline-flex items-center gap-1 text-xs font-bold text-purple-500 hover:underline">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                        New SaaS Plan
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="monarch-table">
                        <thead>
                            <tr>
                                <th>Software Product</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th style="text-align:right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($saas['saasProducts'] as $prod)
                            <tr>
                                <td>
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-7 h-7 rounded-lg bg-purple-500/10 text-purple-400 flex items-center justify-center shrink-0">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                                        </div>
                                        <div>
                                            <div class="font-bold text-gray-900 dark:text-white">{{ $prod->name }}</div>
                                            <div class="text-[10px] text-gray-400 font-mono">{{ $prod->sku }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="px-2 py-0.5 rounded-md text-[10px] font-semibold bg-purple-500/8 text-purple-500 border border-purple-500/15">
                                        {{ $prod->category?->name ?? 'SaaS' }}
                                    </span>
                                </td>
                                <td class="font-bold text-gray-900 dark:text-white">₵{{ number_format($prod->price, 2) }}</td>
                                <td>
                                    @if($prod->is_active)
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/20">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 inline-block"></span>
                                            Active
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-gray-500/10 text-gray-500 border border-gray-400/20">
                                            <span class="w-1.5 h-1.5 rounded-full bg-gray-400 inline-block"></span>
                                            Draft
                                        </span>
                                    @endif
                                </td>
                                <td style="text-align:right">
                                    <a href="{{ route('filament.monarch.resources.products.edit', $prod) }}"
                                       class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-[11px] font-bold
                                              bg-purple-500/8 text-purple-500 border border-purple-500/20
                                              hover:bg-purple-500 hover:text-white hover:border-purple-500 transition-all duration-150">
                                        Edit
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="5" style="text-align:center; padding: 40px; color:#6b7280; font-size:12px;">No SaaS products configured.</td></tr>
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
        <div class="space-y-6" id="tab-hardware">

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="monarch-kpi" style="background:linear-gradient(135deg,#052e16 0%,#14532d 100%);">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-8 h-8 rounded-lg bg-emerald-400/20 text-emerald-300 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                        </div>
                        <span class="text-[10px] font-bold uppercase tracking-widest text-emerald-300">Units In Stock</span>
                    </div>
                    <div class="text-3xl font-extrabold text-white">{{ $hardware['totalUnitsInStock'] }}</div>
                    <p class="text-[11px] text-emerald-300 mt-2">Across all hardware categories</p>
                </div>
                <div class="monarch-kpi" style="background:linear-gradient(135deg,#0c1a3a 0%,#1e3a8a 100%);">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-8 h-8 rounded-lg bg-blue-400/20 text-blue-300 flex items-center justify-center font-black">₵</div>
                        <span class="text-[10px] font-bold uppercase tracking-widest text-blue-300">Asset Value</span>
                    </div>
                    <div class="text-3xl font-extrabold text-[#60a5fa]">₵{{ number_format($hardware['inventoryAssetValue'], 2) }}</div>
                    <p class="text-[11px] text-blue-300 mt-2">Retail value on hand</p>
                </div>
                <div class="monarch-kpi" style="background:linear-gradient(135deg,{{ $hardware['lowStockCount'] > 0 ? '#431407 0%,#7c2d12' : '#052e16 0%,#14532d' }} 100%);">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-8 h-8 rounded-lg {{ $hardware['lowStockCount'] > 0 ? 'bg-amber-400/20 text-amber-300' : 'bg-emerald-400/20 text-emerald-300' }} flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        </div>
                        <span class="text-[10px] font-bold uppercase tracking-widest {{ $hardware['lowStockCount'] > 0 ? 'text-amber-300' : 'text-emerald-300' }}">Reorder Alerts</span>
                    </div>
                    <div class="text-3xl font-extrabold {{ $hardware['lowStockCount'] > 0 ? 'text-amber-300' : 'text-emerald-300' }}">{{ $hardware['lowStockCount'] }}</div>
                    <p class="text-[11px] {{ $hardware['lowStockCount'] > 0 ? 'text-amber-400' : 'text-emerald-400' }} mt-2">Products below safety threshold</p>
                </div>
            </div>

            @if($hardware['lowStockCount'] > 0)
            <div class="rounded-2xl border border-amber-500/30 bg-amber-500/5 p-5">
                <h3 class="text-xs font-bold uppercase tracking-wider text-amber-500 mb-4 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    Low Stock &amp; Restock Alerts
                </h3>
                <div class="space-y-2">
                    @foreach($hardware['lowStockProducts'] as $lowProd)
                    <div class="flex items-center justify-between p-3.5 rounded-xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-white/10 text-xs hover:border-amber-400/40 transition">
                        <div class="flex items-center gap-3">
                            <div class="w-7 h-7 rounded-lg bg-amber-500/10 text-amber-500 flex items-center justify-center shrink-0">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <span class="font-bold text-gray-900 dark:text-white">{{ $lowProd->name }}</span>
                            <span class="text-gray-400 font-mono text-[11px]">({{ $lowProd->sku }})</span>
                        </div>
                        <div class="flex items-center gap-4">
                            <span class="px-2 py-0.5 rounded-full font-bold text-[10px] bg-red-500/10 text-red-500 border border-red-500/20">
                                {{ $lowProd->stock_quantity }} left / Min: {{ $lowProd->min_stock_threshold }}
                            </span>
                            <a href="{{ route('filament.monarch.resources.products.edit', $lowProd) }}"
                               class="inline-flex items-center gap-1 text-xs font-bold text-amber-500 hover:underline">
                                Restock
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
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
        <div class="space-y-6" id="tab-servicing">

            <div class="rounded-2xl border border-gray-200 dark:border-white/10 bg-white dark:bg-gray-900 p-5 shadow-sm">
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-9 h-9 rounded-xl bg-orange-500/10 text-orange-400 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-gray-900 dark:text-white">Client Inquiries &amp; Custom Instructions</h3>
                        <p class="text-[11px] text-gray-500">Orders with special notes or custom requests</p>
                    </div>
                </div>
                @if($servicing['customOrders']->isEmpty())
                    <div class="py-10 text-center">
                        <div class="w-12 h-12 rounded-2xl bg-gray-100 dark:bg-white/5 flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                        </div>
                        <p class="text-xs text-gray-500">No custom order notes recorded yet.</p>
                    </div>
                @else
                    <div class="space-y-3">
                        @foreach($servicing['customOrders'] as $cOrder)
                        <div class="p-4 rounded-xl border border-gray-200 dark:border-white/10 bg-gray-50/50 dark:bg-white/[0.02] text-xs hover:border-orange-400/30 transition">
                            <div class="flex items-center justify-between pb-2.5 mb-2.5 border-b border-gray-200 dark:border-white/10">
                                <div class="flex items-center gap-2">
                                    <div class="w-7 h-7 rounded-full bg-orange-500/10 text-orange-400 flex items-center justify-center font-bold text-xs">
                                        {{ strtoupper(substr($cOrder->customer_name, 0, 1)) }}
                                    </div>
                                    <span class="font-bold text-gray-900 dark:text-white">{{ $cOrder->customer_name }}
                                        <span class="text-gray-400 font-mono font-normal">(#MHQ-{{ str_pad($cOrder->id, 5, '0', STR_PAD_LEFT) }})</span>
                                    </span>
                                </div>
                                <span class="text-gray-400 text-[11px]">{{ $cOrder->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-gray-700 dark:text-gray-300 italic mb-3 leading-relaxed">"{{ $cOrder->notes }}"</p>
                            <div class="flex items-center justify-between text-[11px] text-gray-500">
                                <span class="flex items-center gap-1.5">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                    {{ $cOrder->customer_phone ?? 'N/A' }}
                                </span>
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $cOrder->customer_phone) }}" target="_blank"
                                   class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-500/10 text-emerald-500 border border-emerald-500/20 font-bold hover:bg-emerald-500 hover:text-white transition text-[10px]">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                    WhatsApp
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
        <div class="space-y-6" id="tab-backups">

            <div class="p-5 rounded-2xl border border-cyan-500/20 bg-cyan-500/5 flex items-center justify-between gap-4">
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-xl bg-cyan-500/10 text-cyan-400 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-gray-900 dark:text-white mb-1">Database Snapshot &amp; Disaster Recovery</h4>
                        <p class="text-xs text-gray-600 dark:text-gray-400 leading-relaxed">
                            Create point-in-time SQLite snapshots, download archives, or restore the system state instantly.
                        </p>
                    </div>
                </div>
                <button type="button" wire:click="handleCreateBackup" wire:loading.attr="disabled"
                    class="px-5 py-2.5 bg-emerald-600 text-white rounded-xl text-xs font-bold hover:bg-emerald-700 transition shrink-0 flex items-center gap-2 shadow-lg shadow-emerald-900/30 disabled:opacity-50">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                    Create Snapshot Now
                </button>
            </div>

            <div class="rounded-2xl border border-gray-200 dark:border-white/10 bg-white dark:bg-gray-900 overflow-hidden shadow-sm">
                <div class="p-4 border-b border-gray-200 dark:border-white/10 flex items-center justify-between bg-gray-50/50 dark:bg-white/[0.02]">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-cyan-500/10 text-cyan-400 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-gray-900 dark:text-white">Existing Database Snapshots</h3>
                            <p class="text-[11px] text-gray-500">Stored in <code class="font-mono text-[11px] bg-gray-100 dark:bg-white/10 px-1 py-0.5 rounded">storage/app/backups</code></p>
                        </div>
                    </div>
                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-cyan-500/10 text-cyan-500 border border-cyan-500/20">
                        {{ count($backups) }} snapshots
                    </span>
                </div>

                @if(empty($backups))
                    <div class="py-14 text-center">
                        <div class="w-12 h-12 rounded-2xl bg-gray-100 dark:bg-white/5 flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
                        </div>
                        <p class="text-xs text-gray-500">No backups yet. Click <strong>"Create Snapshot Now"</strong> above.</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="monarch-table">
                            <thead>
                                <tr>
                                    <th>Snapshot File</th>
                                    <th>Size</th>
                                    <th>Created At</th>
                                    <th style="text-align:right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($backups as $b)
                                <tr>
                                    <td>
                                        <div class="flex items-center gap-2.5">
                                            <div class="w-7 h-7 rounded-lg bg-cyan-500/10 text-cyan-400 flex items-center justify-center shrink-0">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                            </div>
                                            <span class="font-mono font-semibold text-gray-900 dark:text-white">{{ $b['filename'] }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="px-2 py-0.5 rounded-md text-[10px] font-bold font-mono bg-gray-100 dark:bg-white/5 text-gray-600 dark:text-gray-400 border border-gray-200 dark:border-white/10">
                                            {{ $b['size'] }}
                                        </span>
                                    </td>
                                    <td class="text-gray-500">
                                        {{ $b['modified']->format('M d, Y') }}<br>
                                        <span class="text-[10px]">{{ $b['modified']->format('H:i:s') }}</span>
                                    </td>
                                    <td style="text-align:right">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('admin.backups.download', $b['filename']) }}"
                                               class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-[11px] font-bold
                                                      bg-[#2997ff]/8 text-[#2997ff] border border-[#2997ff]/20
                                                      hover:bg-[#2997ff] hover:text-white hover:border-[#2997ff] transition-all duration-150">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                                Download
                                            </a>
                                            <button type="button"
                                                wire:click="handleDeleteBackup('{{ $b['filename'] }}')"
                                                wire:confirm="Permanently delete {{ $b['filename'] }}?"
                                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-[11px] font-bold
                                                       bg-red-500/8 text-red-500 border border-red-500/20
                                                       hover:bg-red-500 hover:text-white hover:border-red-500 transition-all duration-150"
                                                title="Delete snapshot">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                Delete
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
