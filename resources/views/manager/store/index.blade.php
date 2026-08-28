<x-manager-sidebar>
    <x-slot name="pageTitle">Store Manager</x-slot>
    <x-slot name="breadcrumb">Overview</x-slot>

    <x-slot name="sidebarNav">
        <div class="sidebar-nav-label">Store</div>
        <a href="{{ route('manager.store.products') }}"   class="sidebar-nav-link {{ request()->is('manager/store/products*') ? 'active' : '' }}"><span>📦</span> Products</a>
        <a href="{{ route('manager.store.categories') }}" class="sidebar-nav-link {{ request()->is('manager/store/categories*') ? 'active' : '' }}"><span>🏷️</span> Categories</a>
        <a href="{{ route('manager.store.orders') }}"     class="sidebar-nav-link {{ request()->is('manager/store/orders*') ? 'active' : '' }}">
            <span>🛒</span> Orders
            @if($stats['pending_orders'] > 0)
            <span class="badge" style="background:#2997ff;color:#fff;border:none;padding:1px 6px;font-size:9px;margin-left:auto;">{{ $stats['pending_orders'] }}</span>
            @endif
        </a>
    </x-slot>

    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:16px;margin-bottom:28px">
        <div class="stat-card">
            <div class="stat-label">Products</div>
            <div class="stat-value">{{ $stats['total_products'] }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Categories</div>
            <div class="stat-value">{{ $stats['total_categories'] }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Total Orders</div>
            <div class="stat-value">{{ $stats['total_orders'] }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Pending Orders</div>
            <div class="stat-value" style="color:#f59e0b">{{ $stats['pending_orders'] }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Revenue (Paid)</div>
            <div class="stat-value" style="color:#4ade80;font-size:22px">GHS {{ number_format($stats['total_revenue'], 2) }}</div>
        </div>
    </div>

    <div class="card">
        <div style="font-size:13px;font-weight:700;color:var(--text-primary);margin-bottom:16px">Recent Orders</div>
        @if($recent_orders->isEmpty())
        <p style="color:var(--text-muted);font-size:13px">No orders yet.</p>
        @else
        <table class="data-table">
            <thead><tr><th>Order #</th><th>Customer</th><th>Total</th><th>Status</th><th></th></tr></thead>
            <tbody>
            @foreach($recent_orders as $order)
            <tr>
                <td style="color:var(--text-primary);font-weight:600">#{{ $order->id }}</td>
                <td style="font-size:12px">{{ $order->customer_name ?? $order->customer_email }}</td>
                <td>GHS {{ number_format($order->total, 2) }}</td>
                <td><span class="badge" style="background:rgba(41,151,255,0.1);color:#2997ff;border-color:rgba(41,151,255,0.2)">{{ ucfirst($order->status) }}</span></td>
                <td><a href="{{ route('manager.store.orders.show', $order) }}" class="btn btn-secondary btn-sm">View</a></td>
            </tr>
            @endforeach
            </tbody>
        </table>
        @endif
    </div>
</x-manager-sidebar>
