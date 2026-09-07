<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class StoreManagerController extends Controller
{
    // ═══════════════════════════════════════════════════════════════
    //  DASHBOARD
    // ═══════════════════════════════════════════════════════════════

    public function index()
    {
        abort_if(! auth()->user()->isStoreManager(), 403);

        $stats = [
            'total_products' => Product::count(),
            'total_orders' => Order::count(),
            'pending_orders' => Order::whereIn('status', ['pending', 'processing'])->count(),
            'total_revenue' => Order::where('payment_status', 'paid')->sum('total'),
            'total_categories' => Category::count(),
        ];

        $recent_orders = Order::with('items.product')
            ->latest()
            ->limit(5)
            ->get();

        return view('manager.store.index', compact('stats', 'recent_orders'));
    }

    // ═══════════════════════════════════════════════════════════════
    //  PRODUCTS
    // ═══════════════════════════════════════════════════════════════

    public function productsList()
    {
        abort_if(! auth()->user()->isStoreManager(), 403);
        $products = Product::with('category')->latest()->paginate(15);

        return view('manager.store.products.index', compact('products'));
    }

    public function productsCreate()
    {
        abort_if(! auth()->user()->isStoreManager(), 403);
        $categories = Category::orderBy('name')->get();

        return view('manager.store.products.create', compact('categories'));
    }

    public function productsStore(Request $request)
    {
        abort_if(! auth()->user()->isStoreManager(), 403);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:products,slug',
            'sku' => 'nullable|string|max:100|unique:products,sku',
            'category_id' => 'required|exists:categories,id',
            'is_digital' => 'sometimes|boolean',
            'short_description' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'stock_quantity' => 'nullable|integer|min:0|max:2147483647',
            'min_stock_threshold' => 'nullable|integer|min:0|max:2147483647',
            'card_style' => 'required|in:light,dark,promo',
            'badge_text' => 'nullable|string|max:30',
            'badge_color' => 'nullable|in:orange,red,green,blue,gray',
            'is_featured' => 'sometimes|boolean',
            'is_active' => 'sometimes|boolean',
            'image_path' => 'nullable|image|max:10240',
            'gallery' => 'nullable|array',
            'gallery.*' => 'image|max:10240',
        ]);

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        $data['is_digital'] = $request->boolean('is_digital');
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active'] = $request->has('is_active') ? $request->boolean('is_active') : true;
        $data['badge_color'] = $data['badge_color'] ?? 'orange';
        $data['card_style'] = $data['card_style'] ?? 'light';

        if ($data['is_digital']) {
            $data['stock_quantity'] = null;
            $data['min_stock_threshold'] = null;
        } else {
            $data['stock_quantity'] = isset($data['stock_quantity']) ? (int) $data['stock_quantity'] : 0;
            $data['min_stock_threshold'] = isset($data['min_stock_threshold']) ? (int) $data['min_stock_threshold'] : 5;
        }

        if ($request->hasFile('image_path')) {
            $data['image_path'] = $request->file('image_path')->store('products', 'public');
        }

        if ($request->hasFile('gallery')) {
            $galleryPaths = [];
            foreach ($request->file('gallery') as $file) {
                $galleryPaths[] = $file->store('products/gallery', 'public');
            }
            $data['gallery'] = $galleryPaths;
        }

        Product::create($data);

        return redirect()->route('manager.store.products')
            ->with('success', 'Product created successfully.');
    }

    public function productsEdit(Product $product)
    {
        abort_if(! auth()->user()->isStoreManager(), 403);
        $categories = Category::orderBy('name')->get();

        return view('manager.store.products.edit', compact('product', 'categories'));
    }

    public function productsUpdate(Request $request, Product $product)
    {
        abort_if(! auth()->user()->isStoreManager(), 403);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => ['required', 'string', 'max:255', Rule::unique('products', 'slug')->ignore($product->id)],
            'sku' => ['nullable', 'string', 'max:100', Rule::unique('products', 'sku')->ignore($product->id)],
            'category_id' => 'required|exists:categories,id',
            'is_digital' => 'sometimes|boolean',
            'short_description' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'stock_quantity' => 'nullable|integer|min:0|max:2147483647',
            'min_stock_threshold' => 'nullable|integer|min:0|max:2147483647',
            'card_style' => 'required|in:light,dark,promo',
            'badge_text' => 'nullable|string|max:30',
            'badge_color' => 'nullable|in:orange,red,green,blue,gray',
            'is_featured' => 'sometimes|boolean',
            'is_active' => 'sometimes|boolean',
            'image_path' => 'nullable|image|max:10240',
            'gallery' => 'nullable|array',
            'gallery.*' => 'image|max:10240',
        ]);

        $data['is_digital'] = $request->boolean('is_digital');
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active'] = $request->boolean('is_active');
        $data['badge_color'] = $data['badge_color'] ?? 'orange';
        $data['card_style'] = $data['card_style'] ?? 'light';

        if ($data['is_digital']) {
            $data['stock_quantity'] = null;
            $data['min_stock_threshold'] = null;
        } else {
            $data['stock_quantity'] = isset($data['stock_quantity']) ? (int) $data['stock_quantity'] : 0;
            $data['min_stock_threshold'] = isset($data['min_stock_threshold']) ? (int) $data['min_stock_threshold'] : 5;
        }

        if ($request->hasFile('image_path')) {
            if ($product->image_path && Storage::disk('public')->exists($product->image_path)) {
                Storage::disk('public')->delete($product->image_path);
            }
            $data['image_path'] = $request->file('image_path')->store('products', 'public');
        }

        if ($request->hasFile('gallery')) {
            $existingGallery = is_array($product->gallery) ? $product->gallery : [];
            foreach ($request->file('gallery') as $file) {
                $existingGallery[] = $file->store('products/gallery', 'public');
            }
            $data['gallery'] = $existingGallery;
        }

        $product->update($data);

        return redirect()->route('manager.store.products')
            ->with('success', 'Product updated successfully.');
    }

    public function productsDestroy(Product $product)
    {
        abort_if(! auth()->user()->isStoreManager(), 403);
        $product->delete();

        return redirect()->route('manager.store.products')
            ->with('success', 'Product deleted.');
    }

    // ═══════════════════════════════════════════════════════════════
    //  CATEGORIES
    // ═══════════════════════════════════════════════════════════════

    public function categoriesList()
    {
        abort_if(! auth()->user()->isStoreManager(), 403);
        $categories = Category::withCount('products')->orderBy('name')->paginate(20);

        return view('manager.store.categories.index', compact('categories'));
    }

    public function categoriesStore(Request $request)
    {
        abort_if(! auth()->user()->isStoreManager(), 403);
        $data = $request->validate([
            'name' => 'required|string|max:100|unique:categories,name',
            'slug' => 'nullable|string|max:100|unique:categories,slug',
        ]);
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }
        Category::create($data);

        return back()->with('success', 'Category created.');
    }

    public function categoriesDestroy(Category $category)
    {
        abort_if(! auth()->user()->isStoreManager(), 403);
        $category->delete();

        return back()->with('success', 'Category deleted.');
    }

    // ═══════════════════════════════════════════════════════════════
    //  ORDERS
    // ═══════════════════════════════════════════════════════════════

    public function ordersList()
    {
        abort_if(! auth()->user()->isStoreManager(), 403);
        $orders = Order::with('items.product')->latest()->paginate(20);

        return view('manager.store.orders.index', compact('orders'));
    }

    public function ordersShow(Order $order)
    {
        abort_if(! auth()->user()->isStoreManager(), 403);
        $order->load('items.product');

        return view('manager.store.orders.show', compact('order'));
    }

    public function ordersUpdateStatus(Request $request, Order $order)
    {
        abort_if(! auth()->user()->isStoreManager(), 403);
        $data = $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,completed,cancelled',
        ]);
        $order->update($data);

        return back()->with('success', 'Order status updated.');
    }
}
