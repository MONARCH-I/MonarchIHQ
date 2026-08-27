<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $featuredProducts = Product::featured()
            ->with('category')
            ->latest()
            ->take(6)
            ->get();

        $categorySlug = $request->get('category');

        $productsQuery = Product::active()->with('category')->latest();

        if ($categorySlug) {
            $productsQuery->forCategory($categorySlug);
        }

        $products = $productsQuery->paginate(9)->withQueryString();

        $activeCategory = $categorySlug;

        return view('store.store', compact(
            'categories',
            'featuredProducts',
            'products',
            'activeCategory'
        ));
    }

    public function show(string $slug)
    {
        $product = Product::active()
            ->with('category')
            ->where('slug', $slug)
            ->firstOrFail();

        $related = Product::active()
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('store.product', compact('product', 'related'));
    }
}
