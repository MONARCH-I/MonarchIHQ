<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class StoreManagerController extends Controller
{
    // ═══════════════════════════════════════════════════════════════
    //  DASHBOARD
    // ═══════════════════════════════════════════════════════════════

    public function index()
    {
        abort_if(! auth()->user()->isStoreManager(), 403);

        $stats = [
            'total_products'  => Product::count(),
            'total_orders'    => Order::count(),
            'pending_orders'  => Order::whereIn('status', ['pending', 'processing'])->count(),
            'total_revenue'   => Order::where('payment_status', 'paid')->sum('total'),
            'total_categories'=> Category::count(),
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
            'name'        => 'required|string|max:255',
            'slug'        => 'nullable|string|max:255|unique:products,slug',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'stock'       => 'nullable|integer|min:0',
            'is_active'   => 'boolean',
        ]);

        if (empty($data['slug'])) {
            $data['slug'] = \Illuminate\Support\Str::slug($data['name']);
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
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'stock'       => 'nullable|integer|min:0',
            'is_active'   => 'boolean',
        ]);

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
            $data['slug'] = \Illuminate\Support\Str::slug($data['name']);
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
