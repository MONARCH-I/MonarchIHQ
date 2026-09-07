<x-manager-sidebar>
    <x-slot name="pageTitle">{{ isset($product) ? 'Edit Product' : 'New Product' }}</x-slot>
    <x-slot name="breadcrumb">Store → Products → {{ isset($product) ? 'Edit' : 'Create' }}</x-slot>

    <x-slot name="sidebarNav">
        <div class="sidebar-nav-label">Store</div>
        <a href="{{ route('manager.store.products') }}"   class="sidebar-nav-link active"><span>📦</span> Products</a>
        <a href="{{ route('manager.store.categories') }}" class="sidebar-nav-link"><span>🏷️</span> Categories</a>
        <a href="{{ route('manager.store.orders') }}"     class="sidebar-nav-link"><span>🛒</span> Orders</a>
    </x-slot>

    <div style="max-width:860px">
        @if ($errors->any())
        <div style="background:rgba(239, 68, 68, 0.1);border:1px solid rgba(239, 68, 68, 0.3);padding:14px 18px;border-radius:12px;margin-bottom:20px;color:#ef4444;font-size:13px">
            <div style="font-weight:700;margin-bottom:6px">Please correct the following errors:</div>
            <ul style="margin:0;padding-left:18px;line-height:1.6">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @isset($product)
        <form method="POST" action="{{ route('manager.store.products.update', $product) }}" enctype="multipart/form-data">
            @method('PUT')
        @else
        <form method="POST" action="{{ route('manager.store.products.store') }}" enctype="multipart/form-data">
        @endisset
            @csrf

            {{-- 1. PRODUCT IDENTITY --}}
            <div class="card" style="margin-bottom:20px">
                <div style="font-size:15px;font-weight:700;color:var(--text-primary);margin-bottom:16px;display:flex;align-items:center;gap:8px">
                    <span>🏷️</span> Product Identity
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
                    <div class="form-group">
                        <label class="form-label">Product Name *</label>
                        <input name="name" id="product-name-input" class="form-input" value="{{ old('name', $product->name ?? '') }}" required placeholder="e.g. invenStore Cloud">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Slug *</label>
                        <input name="slug" id="product-slug-input" class="form-input" value="{{ old('slug', $product->slug ?? '') }}" required placeholder="e.g. invenstore-cloud">
                        <span style="font-size:11px;color:var(--text-muted);display:block;margin-top:4px">Unique URL identifier for the store.</span>
                    </div>
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
                    <div class="form-group">
                        <label class="form-label">SKU (Stock Keeping Unit)</label>
                        <div style="position:relative;display:flex;align-items:center">
                            <input name="sku" id="product-sku-input" class="form-input" style="padding-right:95px;font-family:monospace;letter-spacing:0.05em" value="{{ old('sku', $product->sku ?? '') }}" placeholder="MHQ-XXXXXX" maxlength="100">
                            <button type="button" id="btn-generate-sku" class="btn btn-secondary btn-sm" style="position:absolute;right:5px;height:30px;padding:0 9px;font-size:11px;font-weight:700;display:flex;align-items:center;gap:4px;border-radius:6px">
                                <span>✨</span> Generate
                            </button>
                        </div>
                        <span style="font-size:11px;color:var(--text-muted);display:block;margin-top:4px">Unique item identifier or click Generate.</span>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Category *</label>
                        <select name="category_id" id="product-category-select" class="form-select" required>
                            <option value="">— Select Category —</option>
                            @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" data-name="{{ $cat->name }}" {{ old('category_id', $product->category_id ?? '') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Digital Product Toggle --}}
                <div style="margin-top:10px;padding:14px 16px;background:rgba(41, 151, 255, 0.08);border:1px solid rgba(41, 151, 255, 0.25);border-radius:12px">
                    <label style="display:flex;align-items:flex-start;gap:12px;cursor:pointer;margin:0">
                        <input type="checkbox" name="is_digital" id="is-digital-checkbox" value="1" {{ old('is_digital', $product->is_digital ?? false) ? 'checked' : '' }} style="margin-top:3px;width:18px;height:18px;accent-color:#2997ff">
                        <div>
                            <span style="font-weight:700;font-size:13px;color:var(--text-primary);display:block">
                                Digital Product (Software, SaaS, License, or Digital Download)
                            </span>
                            <span style="font-size:11px;color:var(--text-secondary);display:block;margin-top:2px">
                                When enabled, this item does not require physical inventory/stock tracking and delivers instantly online.
                            </span>
                        </div>
                    </label>
                </div>
            </div>

            {{-- 2. DESCRIPTION --}}
            <div class="card" style="margin-bottom:20px">
                <div style="font-size:15px;font-weight:700;color:var(--text-primary);margin-bottom:16px;display:flex;align-items:center;gap:8px">
                    <span>📝</span> Description
                </div>

                <div class="form-group">
                    <label class="form-label">Short Description (max 255 characters)</label>
                    <input name="short_description" class="form-input" value="{{ old('short_description', $product->short_description ?? '') }}" maxlength="255" placeholder="Brief summary displayed on cards & previews">
                </div>

                <div class="form-group">
                    <label class="form-label">Full Product Description</label>
                    <textarea name="description" class="form-textarea" style="min-height:160px" placeholder="Detailed product specifications, feature list, instructions…">{{ old('description', $product->description ?? '') }}</textarea>
                </div>
            </div>

            {{-- 3. PRICING --}}
            <div class="card" style="margin-bottom:20px">
                <div style="font-size:15px;font-weight:700;color:var(--text-primary);margin-bottom:16px;display:flex;align-items:center;gap:8px">
                    <span>💳</span> Pricing (GHS ₵)
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
                    <div class="form-group">
                        <label class="form-label">Regular Price (GHS) *</label>
                        <input name="price" type="number" step="0.01" min="0" class="form-input" value="{{ old('price', $product->price ?? '') }}" required placeholder="0.00">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Sale Price (GHS)</label>
                        <input name="sale_price" type="number" step="0.01" min="0" class="form-input" value="{{ old('sale_price', $product->sale_price ?? '') }}" placeholder="Leave empty if not on sale">
                        <span style="font-size:11px;color:var(--text-muted);display:block;margin-top:4px">Optional. Overrides regular price and displays sale badge.</span>
                    </div>
                </div>
            </div>

            {{-- 4. INVENTORY (Hidden when is_digital is checked) --}}
            <div class="card" id="inventory-section" style="margin-bottom:20px;{{ old('is_digital', $product->is_digital ?? false) ? 'display:none;' : '' }}">
                <div style="font-size:15px;font-weight:700;color:var(--text-primary);margin-bottom:4px;display:flex;align-items:center;gap:8px">
                    <span>📦</span> Inventory &amp; Warehouse Stock
                </div>
                <div style="font-size:12px;color:var(--text-muted);margin-bottom:16px">Physical stock counts and automatic low-stock alert thresholds.</div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
                    <div class="form-group">
                        <label class="form-label">Stock Quantity</label>
                        <input name="stock_quantity" id="input-stock-quantity" type="number" min="0" max="2147483647" class="form-input" value="{{ old('stock_quantity', $product->stock_quantity ?? 0) }}">
                        <span style="font-size:11px;color:var(--text-muted);display:block;margin-top:4px">Units physically available in warehouse.</span>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Low Stock Alert Threshold</label>
                        <input name="min_stock_threshold" id="input-stock-threshold" type="number" min="0" max="2147483647" class="form-input" value="{{ old('min_stock_threshold', $product->min_stock_threshold ?? 5) }}">
                        <span style="font-size:11px;color:var(--text-muted);display:block;margin-top:4px">Triggers warning alert when stock drops below this count.</span>
                    </div>
                </div>
            </div>

            {{-- 5. STORE APPEARANCE --}}
            <div class="card" style="margin-bottom:20px">
                <div style="font-size:15px;font-weight:700;color:var(--text-primary);margin-bottom:16px;display:flex;align-items:center;gap:8px">
                    <span>🎨</span> Store Appearance
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
                    <div class="form-group">
                        <label class="form-label">Featured Card Style *</label>
                        <select name="card_style" class="form-select" required>
                            <option value="light" {{ old('card_style', $product->card_style ?? 'light') == 'light' ? 'selected' : '' }}>Light (white card)</option>
                            <option value="dark"  {{ old('card_style', $product->card_style ?? 'light') == 'dark'  ? 'selected' : '' }}>Dark (black card)</option>
                            <option value="promo" {{ old('card_style', $product->card_style ?? 'light') == 'promo' ? 'selected' : '' }}>Promo (gradient card)</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Custom Badge Label</label>
                        <input name="badge_text" class="form-input" list="badge-presets" value="{{ old('badge_text', $product->badge_text ?? '') }}" placeholder="e.g. Pre-Order, Limited Offer">
                        <datalist id="badge-presets">
                            <option value="Pre-Order">
                            <option value="Limited Offer">
                            <option value="New">
                            <option value="Special Edition">
                            <option value="Instant Access">
                        </datalist>
                        <span style="font-size:11px;color:var(--text-muted);display:block;margin-top:4px">Leave empty for automatic system badges.</span>
                    </div>
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
                    <div class="form-group">
                        <label class="form-label">Badge Color</label>
                        <select name="badge_color" class="form-select">
                            <option value="orange" {{ old('badge_color', $product->badge_color ?? 'orange') == 'orange' ? 'selected' : '' }}>Orange (Warm / Pre-Order)</option>
                            <option value="red"    {{ old('badge_color', $product->badge_color ?? 'orange') == 'red'    ? 'selected' : '' }}>Red (Sale / Limited)</option>
                            <option value="green"  {{ old('badge_color', $product->badge_color ?? 'orange') == 'green'  ? 'selected' : '' }}>Green (New)</option>
                            <option value="blue"   {{ old('badge_color', $product->badge_color ?? 'orange') == 'blue'   ? 'selected' : '' }}>Blue (Featured / Popular)</option>
                            <option value="gray"   {{ old('badge_color', $product->badge_color ?? 'orange') == 'gray'   ? 'selected' : '' }}>Gray (Muted)</option>
                        </select>
                    </div>

                    <div style="display:flex;flex-direction:column;gap:10px;justify-content:center">
                        <label style="display:flex;align-items:center;gap:10px;cursor:pointer;font-size:13px;font-weight:600;color:var(--text-primary)">
                            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $product->is_featured ?? false) ? 'checked' : '' }} style="width:16px;height:16px;accent-color:#2997ff">
                            Show in "New Products" Carousel
                        </label>
                        <label style="display:flex;align-items:center;gap:10px;cursor:pointer;font-size:13px;font-weight:600;color:var(--text-primary)">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active ?? true) ? 'checked' : '' }} style="width:16px;height:16px;accent-color:#2997ff">
                            Visible in Store (Active)
                        </label>
                    </div>
                </div>
            </div>

            {{-- 6. IMAGES --}}
            <div class="card" style="margin-bottom:20px">
                <div style="font-size:15px;font-weight:700;color:var(--text-primary);margin-bottom:16px;display:flex;align-items:center;gap:8px">
                    <span>🖼️</span> Product Images
                </div>

                {{-- Main Image --}}
                <div class="form-group">
                    <label class="form-label">Main Product Image (Cover)</label>
                    @if(isset($product) && $product->image_path)
                    <div style="display:flex;align-items:center;gap:14px;margin-bottom:12px;padding:10px;border-radius:10px;background:rgba(255,255,255,0.03);border:1px solid var(--border-color)">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" style="width:60px;height:60px;object-fit:cover;border-radius:8px">
                        <div>
                            <span style="font-size:12px;font-weight:600;color:var(--text-primary);display:block">Current Cover Image</span>
                            <span style="font-size:11px;color:var(--text-muted)">Upload a new file below to replace this image.</span>
                        </div>
                    </div>
                    @endif
                    <input name="image_path" id="input-main-image" type="file" accept="image/*" class="form-input" style="padding:8px">
                    <div id="main-image-preview" style="margin-top:10px;display:none">
                        <img id="main-image-preview-img" src="" alt="Preview" style="max-width:140px;height:auto;border-radius:8px;border:1px solid var(--border-color)">
                    </div>
                </div>

                {{-- Gallery Images --}}
                <div class="form-group" style="margin-top:16px">
                    <label class="form-label">Gallery Images (Multiple)</label>
                    @if(isset($product) && is_array($product->gallery) && count($product->gallery) > 0)
                    <div style="display:flex;flex-wrap:wrap;gap:8px;margin-bottom:12px">
                        @foreach($product->gallery as $galleryImg)
                        <img src="{{ asset('storage/' . $galleryImg) }}" alt="Gallery" style="width:50px;height:50px;object-fit:cover;border-radius:6px;border:1px solid var(--border-color)">
                        @endforeach
                    </div>
                    @endif
                    <input name="gallery[]" type="file" accept="image/*" multiple class="form-input" style="padding:8px">
                    <span style="font-size:11px;color:var(--text-muted);display:block;margin-top:4px">You can select multiple photos at once.</span>
                </div>
            </div>

            {{-- ACTIONS --}}
            <div style="display:flex;gap:10px;margin-top:24px">
                <button type="submit" class="btn btn-primary" style="padding:12px 24px;font-weight:700">
                    {{ isset($product) ? 'Update' : 'Save' }} Product
                </button>
                <a href="{{ route('manager.store.products') }}" class="btn btn-secondary" style="padding:12px 20px">Cancel</a>
            </div>
        </form>
    </div>

    {{-- Interactive Client Scripts --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const isDigitalCheckbox = document.getElementById('is-digital-checkbox');
            const inventorySection = document.getElementById('inventory-section');
            const stockInput = document.getElementById('input-stock-quantity');
            const thresholdInput = document.getElementById('input-stock-threshold');
            const nameInput = document.getElementById('product-name-input');
            const slugInput = document.getElementById('product-slug-input');
            const skuInput = document.getElementById('product-sku-input');
            const categorySelect = document.getElementById('product-category-select');
            const btnGenerateSku = document.getElementById('btn-generate-sku');
            const mainImageInput = document.getElementById('input-main-image');
            const mainPreviewDiv = document.getElementById('main-image-preview');
            const mainPreviewImg = document.getElementById('main-image-preview-img');

            // 1. Digital Product Toggle handler
            function updateDigitalState() {
                if (isDigitalCheckbox.checked) {
                    inventorySection.style.display = 'none';
                    if (stockInput) stockInput.value = '';
                    if (thresholdInput) thresholdInput.value = '';
                } else {
                    inventorySection.style.display = 'block';
                    if (stockInput && !stockInput.value) stockInput.value = '0';
                    if (thresholdInput && !thresholdInput.value) thresholdInput.value = '5';
                }
            }

            if (isDigitalCheckbox && inventorySection) {
                isDigitalCheckbox.addEventListener('change', updateDigitalState);
            }

            // 2. Auto-slug generation from name (only if slug was unmodified or empty)
            let userEditedSlug = {{ isset($product) ? 'true' : 'false' }};
            if (slugInput) {
                slugInput.addEventListener('input', function() {
                    userEditedSlug = true;
                });
            }
            if (nameInput && slugInput) {
                nameInput.addEventListener('input', function() {
                    if (!userEditedSlug) {
                        slugInput.value = this.value
                            .toLowerCase()
                            .trim()
                            .replace(/[^a-z0-9]+/g, '-')
                            .replace(/(^-|-$)+/g, '');
                    }
                });
            }

            // 3. Auto-generate SKU button handler
            if (btnGenerateSku && skuInput) {
                btnGenerateSku.addEventListener('click', function() {
                    let prefix = 'MHQ';
                    if (categorySelect && categorySelect.selectedIndex > 0) {
                        const selectedOption = categorySelect.options[categorySelect.selectedIndex];
                        const catName = selectedOption.getAttribute('data-name') || selectedOption.text;
                        const clean = catName.toUpperCase().replace(/[^A-Z0-9]/g, '').substring(0, 4);
                        if (clean.length > 0) {
                            prefix = clean;
                        }
                    }
                    // Generate 6 random alphanumeric characters
                    const chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
                    let code = '';
                    for (let i = 0; i < 6; i++) {
                        code += chars.charAt(Math.floor(Math.random() * chars.length));
                    }
                    skuInput.value = prefix + '-' + code;
                });
            }

            // 4. Main image live preview
            if (mainImageInput && mainPreviewDiv && mainPreviewImg) {
                mainImageInput.addEventListener('change', function() {
                    const file = this.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            mainPreviewImg.src = e.target.result;
                            mainPreviewDiv.style.display = 'block';
                        };
                        reader.readAsDataURL(file);
                    } else {
                        mainPreviewDiv.style.display = 'none';
                    }
                });
            }
        });
    </script>
</x-manager-sidebar>
