<x-manager-sidebar>
    <x-slot name="pageTitle">{{ isset($product) ? 'Edit Product' : 'New Product' }}</x-slot>
    <x-slot name="breadcrumb">Store → Products → {{ isset($product) ? 'Edit' : 'Create' }}</x-slot>

    <x-slot name="sidebarNav">
        <div class="sidebar-nav-label">Store</div>
        <a href="{{ route('manager.store.products') }}"   class="sidebar-nav-link active"><span>📦</span> Products</a>
        <a href="{{ route('manager.store.categories') }}" class="sidebar-nav-link"><span>🏷️</span> Categories</a>
        <a href="{{ route('manager.store.orders') }}"     class="sidebar-nav-link"><span>🛒</span> Orders</a>
    </x-slot>

    <div style="max-width:700px">
        @isset($product)
        <form method="POST" action="{{ route('manager.store.products.update', $product) }}">
            @method('PUT')
        @else
        <form method="POST" action="{{ route('manager.store.products.store') }}">
        @endisset
            @csrf
            <div class="card">
                <div class="form-group">
                    <label class="form-label">Product Name *</label>
                    <input name="name" class="form-input" value="{{ old('name', $product->name ?? '') }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Category</label>
                    <select name="category_id" class="form-select">
                        <option value="">— No category —</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id ?? '') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
                    <div class="form-group">
                        <label class="form-label">Price (GHS) *</label>
                        <input name="price" type="number" step="0.01" class="form-input" value="{{ old('price', $product->price ?? '') }}" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Stock Quantity</label>
                        <input name="stock" type="number" class="form-input" value="{{ old('stock', $product->stock ?? '') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-textarea">{{ old('description', $product->description ?? '') }}</textarea>
                </div>
            </div>
            <div style="display:flex;gap:10px;margin-top:16px">
                <button type="submit" class="btn btn-primary">{{ isset($product) ? 'Update' : 'Save' }} Product</button>
                <a href="{{ route('manager.store.products') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</x-manager-sidebar>
