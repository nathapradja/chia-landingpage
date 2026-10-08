<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $query = Product::with('category');

        if ($request->filled('q')) {
            $search = $request->input('q');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('summary', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->input('status') === 'active');
        }

        $products = $query->latest()->paginate(10)->withQueryString();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:200',
            'price' => 'required|numeric|min:0',
            'summary' => 'nullable|string|max:300',
            'description' => 'required|string',
            'details' => 'nullable|array',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:4096',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $slug = Str::slug($validated['name']);
        $uniqueSlug = $slug;
        $counter = 1;
        while (Product::where('slug', $uniqueSlug)->exists()) {
            $uniqueSlug = "{$slug}-{$counter}";
            $counter++;
        }

        Product::create([
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'slug' => $uniqueSlug,
            'price' => $validated['price'],
            'summary' => $validated['summary'] ?? null,
            'description' => $validated['description'],
            'details' => $request->input('details', []),
            'image' => $imagePath,
            'is_featured' => $request->boolean('is_featured'),
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:200',
            'price' => 'required|numeric|min:0',
            'summary' => 'nullable|string|max:300',
            'description' => 'required|string',
            'details' => 'nullable|array',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:4096',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);

        $imagePath = $product->image;
        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $imagePath = $request->file('image')->store('products', 'public');
        }

        if ($validated['name'] !== $product->name) {
            $slug = Str::slug($validated['name']);
            $uniqueSlug = $slug;
            $counter = 1;
            while (Product::where('slug', $uniqueSlug)->where('id', '!=', $product->id)->exists()) {
                $uniqueSlug = "{$slug}-{$counter}";
                $counter++;
            }
            $product->slug = $uniqueSlug;
        }

        $product->update([
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'price' => $validated['price'],
            'summary' => $validated['summary'] ?? null,
            'description' => $validated['description'],
            'details' => $request->input('details', []),
            'image' => $imagePath,
            'is_featured' => $request->boolean('is_featured'),
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy(Product $product)
    {
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus!');
    }

    public function deleteImage(Product $product)
    {
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->update(['image' => null]);

        return back()->with('success', 'Foto produk berhasil dihapus!');
    }
}
