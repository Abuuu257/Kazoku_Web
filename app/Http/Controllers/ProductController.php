<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = \App\Models\Product::query();

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('category') && $request->category != 'all') {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('name', $request->category);
            });
        }

        $products = $query->with('category')->paginate(12);
        $categories = \App\Models\Category::orderBy('name')->get()->unique('name');

        return view('products.index', compact('products', 'categories'));
    }

    public function show($id)
    {
        $product = \App\Models\Product::with('category')->findOrFail($id);
        $relatedProducts = \App\Models\Product::where('category_id', $product->category_id)
                                              ->where('id', '!=', $id)
                                              ->take(4)
                                              ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }
}
