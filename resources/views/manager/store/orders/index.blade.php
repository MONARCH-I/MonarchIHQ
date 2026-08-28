<x-manager-sidebar>
    <x-slot name="pageTitle">Orders</x-slot>
    <x-slot name="breadcrumb">Store → Orders</x-slot>

    <x-slot name="sidebarNav">
        <div class="sidebar-nav-label">Store</div>
        <a href="{{ route('manager.store.products') }}"   class="sidebar-nav-link"><span>📦</span> Products</a>
        <a href="{{ route('manager.store.categories') }}" class="sidebar-nav-link"><span>🏷️</span> Categories</a>
        <a href="{{ route('manager.store.orders') }}"     class="sidebar-nav-link active"><span>🛒</span> Orders</a>
    </x-slot>

    <div class="card">
        @if($orders->isEmpty())
        <div style="text-align:center;padding:48px;color:var(--text-muted)">No orders yet.</div>
        @else
        <table class="data-table">
            <thead><tr><th>#</th><th>Customer</th><th>Total</th><th>Payment</th><th>Status</th><th>Date</th><th></th></tr></thead>
            <tbody>
            @foreach($orders as $order)
            <tr>
                <td style="color:var(--text-primary);font-weight:700">#{{ $order->id }}</td>
                <td style="font-size:12px">{{ $order->customer_name ?? '—' }}<br><span style="color:var(--text-muted)">{{ $order->customer_email }}</span></td>
                <td style="font-weight:600">GHS {{ number_format($order->total, 2) }}</td>
                <td>
                    @if($order->payment_status === 'paid')
                    <span class="badge" style="background:rgba(34,197,94,0.1);color:#4ade80;border-color:rgba(34,197,94,0.2)">Paid</span>
                    @else
                    <span class="badge" style="background:rgba(239,68,68,0.1);color:#f87171;border-color:rgba(239,68,68,0.2)">{{ ucfirst($order->payment_status) }}</span>
                    @endif
                </td>
                <td><span class="badge" style="background:rgba(41,151,255,0.1);color:#2997ff;border-color:rgba(41,151,255,0.2)">{{ ucfirst($order->status) }}</span></td>
                <td style="font-size:12px">{{ $order->created_at->format('d M Y') }}</td>
                <td><a href="{{ route('manager.store.orders.show', $order) }}" class="btn btn-secondary btn-sm">View</a></td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <div style="padding:16px 0 0">{{ $orders->links() }}</div>
        @endif
    </div>
</x-manager-sidebar>
