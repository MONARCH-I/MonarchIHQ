<x-manager-sidebar>
    <x-slot name="pageTitle">Categories</x-slot>
    <x-slot name="breadcrumb">Store → Categories</x-slot>

    <x-slot name="sidebarNav">
        <div class="sidebar-nav-label">Store</div>
        <a href="{{ route('manager.store.products') }}"   class="sidebar-nav-link"><span>📦</span> Products</a>
        <a href="{{ route('manager.store.categories') }}" class="sidebar-nav-link active"><span>🏷️</span> Categories</a>
        <a href="{{ route('manager.store.orders') }}"     class="sidebar-nav-link"><span>🛒</span> Orders</a>
    </x-slot>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;align-items:start">
        {{-- Add Category --}}
        <div class="card">
            <div style="font-size:14px;font-weight:700;color:var(--text-primary);margin-bottom:16px">Add Category</div>
            <form method="POST" action="{{ route('manager.store.categories.store') }}">
                @csrf
                <div class="form-group">
                    <label class="form-label">Category Name</label>
                    <input name="name" class="form-input" placeholder="e.g. Embedded Systems" required>
                </div>
                <button class="btn btn-primary" style="width:100%">Add Category</button>
            </form>
        </div>

        {{-- List --}}
        <div class="card">
            <div style="font-size:14px;font-weight:700;color:var(--text-primary);margin-bottom:16px">All Categories</div>
            @if($categories->isEmpty())
            <p style="color:var(--text-muted);font-size:13px">No categories yet.</p>
            @else
            <div style="display:flex;flex-direction:column;gap:8px">
            @foreach($categories as $cat)
            <div style="display:flex;align-items:center;justify-content:space-between;padding:10px 12px;background:var(--bg-hover);border-radius:8px;border:1px solid var(--border)">
                <div>
                    <span style="font-size:13px;font-weight:600;color:var(--text-primary)">{{ $cat->name }}</span>
                    <span style="font-size:11px;color:var(--text-muted);margin-left:8px">{{ $cat->products_count }} products</span>
                </div>
                <form method="POST" action="{{ route('manager.store.categories.destroy', $cat) }}" onsubmit="return confirm('Delete this category?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm">Delete</button>
                </form>
            </div>
            @endforeach
            </div>
            @endif
        </div>
    </div>
</x-manager-sidebar>
