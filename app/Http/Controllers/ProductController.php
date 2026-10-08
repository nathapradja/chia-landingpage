<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $contact = Contact::first() ?? new Contact();
        $categories = Category::where('is_active', true)->withCount(['products' => function ($q) {
            $q->where('is_active', true);
        }])->get();

        $query = Product::with('category')->where('is_active', true);

        // Search filter
        if ($request->filled('q')) {
            $search = $request->input('q');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('summary', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Category filter
        if ($request->filled('kategori')) {
            $categorySlug = $request->input('kategori');
            $query->whereHas('category', function ($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }

        // Sorting
        if ($request->input('sort') === 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif ($request->input('sort') === 'price_desc') {
            $query->orderBy('price', 'desc');
        } else {
            $query->latest();
        }

        $products = $query->paginate(9)->withQueryString();

        return view('products.index', compact('products', 'categories', 'contact'));
    }

    public function show(string $slug)
    {
        $product = Product::with('category')
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $contact = Contact::first() ?? new Contact();

        $relatedProducts = Product::with('category')
            ->where('is_active', true)
            ->where('id', '!=', $product->id)
            ->where('category_id', $product->category_id)
            ->take(3)
            ->get();

        if ($relatedProducts->count() < 3) {
            $moreProducts = Product::with('category')
                ->where('is_active', true)
                ->where('id', '!=', $product->id)
                ->whereNotIn('id', $relatedProducts->pluck('id'))
                ->take(3 - $relatedProducts->count())
                ->get();
            $relatedProducts = $relatedProducts->merge($moreProducts);
        }

        return view('products.show', compact('product', 'contact', 'relatedProducts'));
    }
}
