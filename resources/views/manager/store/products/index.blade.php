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
            <thead><tr><th>Product</th><th>Category</th><th>Price</th><th>Stock</th><th>Actions</th></tr></thead>
            <tbody>
            @foreach($products as $product)
            <tr>
                <td style="color:var(--text-primary);font-weight:600">{{ $product->name }}</td>
                <td style="font-size:12px">{{ $product->category->name ?? '—' }}</td>
                <td>GHS {{ number_format($product->price, 2) }}</td>
                <td>{{ $product->stock ?? '—' }}</td>
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
