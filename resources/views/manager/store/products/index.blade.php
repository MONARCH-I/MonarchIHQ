<x-manager-sidebar>
    <x-slot name="pageTitle">Products</x-slot>
    <x-slot name="breadcrumb">Store → Products</x-slot>

    <x-slot name="sidebarNav">
        <div class="sidebar-nav-label">Store</div>
        <a href="{{ route('manager.store.products') }}"   class="sidebar-nav-link active"><span>📦</span> Products</a>
        <a href="{{ route('manager.store.categories') }}" class="sidebar-nav-link"><span>🏷️</span> Categories</a>
        <a href="{{ route('manager.store.orders') }}"     class="sidebar-nav-link"><span>🛒</span> Orders</a>
    </x-slot>

    <x-slot name="topbarActions">
        <a href="{{ route('manager.store.products.create') }}" class="btn btn-primary btn-sm">+ New Product</a>
    </x-slot>

    <div class="card">
        @if($products->isEmpty())
        <div style="text-align:center;padding:48px;color:var(--text-muted)">No products found.</div>
        @else
        <table class="data-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Type / Stock</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
            <tr>
                <td>
                    <div style="display:flex;align-items:center;gap:12px">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" style="width:40px;height:40px;object-fit:cover;border-radius:8px;background:rgba(255,255,255,0.05);border:1px solid var(--border-color);flex-shrink:0">
                        <div>
                            <div style="color:var(--text-primary);font-weight:700">{{ $product->name }}</div>
                            @if($product->sku)
                            <div style="font-size:11px;color:var(--text-muted);font-family:monospace">{{ $product->sku }}</div>
                            @endif
                        </div>
                    </div>
                </td>
                <td>
                    <span style="display:inline-block;padding:3px 8px;border-radius:6px;font-size:11px;font-weight:600;background:rgba(255,255,255,0.06);color:var(--text-secondary)">
                        {{ $product->category->name ?? '—' }}
                    </span>
                </td>
                <td>
                    <div style="font-weight:700;color:var(--text-primary)">{{ $product->display_price }}</div>
                    @if($product->is_on_sale)
                    <div style="font-size:11px;color:var(--text-muted);text-decoration:line-through">{{ $product->original_price }}</div>
                    @endif
                </td>
                <td>
                    @if($product->is_digital)
                        <span style="display:inline-flex;align-items:center;gap:4px;padding:3px 9px;border-radius:6px;font-size:11px;font-weight:700;background:rgba(41, 151, 255, 0.12);color:#2997ff;border:1px solid rgba(41, 151, 255, 0.25)">
                            <span>⚡</span> Digital (Unlimited)
                        </span>
                    @else
                        @php
                            $status = $product->stock_status;
                            $color = $status === 'in_stock' ? '#22c55e' : ($status === 'low_stock' ? '#f59e0b' : '#ef4444');
                            $bg = $status === 'in_stock' ? 'rgba(34, 197, 94, 0.12)' : ($status === 'low_stock' ? 'rgba(245, 158, 11, 0.12)' : 'rgba(239, 68, 68, 0.12)');
                        @endphp
                        <span style="display:inline-flex;align-items:center;gap:5px;padding:3px 9px;border-radius:6px;font-size:11px;font-weight:700;background:{{ $bg }};color:{{ $color }}">
                            <span style="width:6px;height:6px;border-radius:50%;background:{{ $color }}"></span>
                            {{ $product->stock_quantity ?? 0 }} in stock
                        </span>
                    @endif
                </td>
                <td>
                    @if($product->is_active)
                        <span style="font-size:11px;font-weight:600;color:#22c55e">Active</span>
                    @else
                        <span style="font-size:11px;font-weight:600;color:var(--text-muted)">Hidden</span>
                    @endif
                    @if($product->is_featured)
                        <span style="font-size:10px;font-weight:700;color:#2997ff;display:block">★ Featured</span>
                    @endif
                </td>
                <td>
                    <div style="display:flex;gap:6px">
                        <a href="{{ route('manager.store.products.edit', $product) }}" class="btn btn-secondary btn-sm">Edit</a>
                        <form method="POST" action="{{ route('manager.store.products.destroy', $product) }}" onsubmit="return confirm('Delete this product?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <div style="padding:16px 0 0">{{ $products->links() }}</div>
        @endif
    </div>
</x-manager-sidebar>
