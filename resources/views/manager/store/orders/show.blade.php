<x-manager-sidebar>
    <x-slot name="pageTitle">Order #{{ $order->id }}</x-slot>
    <x-slot name="breadcrumb">Store → Orders → #{{ $order->id }}</x-slot>

    <x-slot name="sidebarNav">
        <div class="sidebar-nav-label">Store</div>
        <a href="{{ route('manager.store.products') }}"   class="sidebar-nav-link"><span>📦</span> Products</a>
        <a href="{{ route('manager.store.categories') }}" class="sidebar-nav-link"><span>🏷️</span> Categories</a>
        <a href="{{ route('manager.store.orders') }}"     class="sidebar-nav-link active"><span>🛒</span> Orders</a>
    </x-slot>

    <div style="display:grid;grid-template-columns:1fr 340px;gap:20px;align-items:start">
        {{-- Order Items --}}
        <div class="card">
            <div style="font-size:14px;font-weight:700;color:var(--text-primary);margin-bottom:16px">Order Items</div>
            <table class="data-table">
                <thead><tr><th>Product</th><th>Qty</th><th>Unit Price</th><th>Subtotal</th></tr></thead>
                <tbody>
                @foreach($order->items as $item)
                <tr>
                    <td style="color:var(--text-primary)">{{ $item->product->name ?? 'Deleted Product' }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>GHS {{ number_format($item->price, 2) }}</td>
                    <td style="font-weight:600">GHS {{ number_format($item->quantity * $item->price, 2) }}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
            <div style="text-align:right;padding:16px 16px 0;font-size:16px;font-weight:700;color:var(--text-primary)">
                Total: GHS {{ number_format($order->total, 2) }}
            </div>
        </div>

        {{-- Order Info + Status Update --}}
        <div style="display:flex;flex-direction:column;gap:16px">
            <div class="card">
                <div style="font-size:14px;font-weight:700;color:var(--text-primary);margin-bottom:14px">Customer</div>
                <div style="font-size:13px;color:var(--text-secondary)">
                    <div style="margin-bottom:6px"><strong style="color:var(--text-primary)">{{ $order->customer_name ?? '—' }}</strong></div>
                    <div>{{ $order->customer_email }}</div>
                    @if($order->customer_phone)<div>{{ $order->customer_phone }}</div>@endif
                    @if($order->customer_address)<div style="margin-top:6px;color:var(--text-muted)">{{ $order->customer_address }}</div>@endif
                </div>
            </div>

            <div class="card">
                <div style="font-size:14px;font-weight:700;color:var(--text-primary);margin-bottom:14px">Update Status</div>
                <form method="POST" action="{{ route('manager.store.orders.status', $order) }}">
                    @csrf @method('PATCH')
                    <select name="status" class="form-select" style="margin-bottom:12px">
                        @foreach(['pending','processing','shipped','delivered','completed','cancelled'] as $s)
                        <option value="{{ $s }}" {{ $order->status === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-primary" style="width:100%">Update Status</button>
                </form>
            </div>

            <a href="{{ route('manager.store.orders') }}" class="btn btn-secondary" style="justify-content:center">← Back to Orders</a>
        </div>
    </div>
</x-manager-sidebar>
