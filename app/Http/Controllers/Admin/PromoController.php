<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PromoController extends Controller
{
    public function index(Request $request)
    {
        $query = Promo::query();

        if ($request->filled('q')) {
            $search = $request->input('q');
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        }

        $promos = $query->latest()->paginate(10)->withQueryString();

        return view('admin.promos.index', compact('promos'));
    }

    public function create()
    {
        return view('admin.promos.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'badge_text' => 'nullable|string|max:100',
            'description' => 'required|string',
            'button_text' => 'nullable|string|max:100',
            'button_link' => 'nullable|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:4096',
            'is_active' => 'nullable|boolean',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('promos', 'public');
        }

        Promo::create([
            'title' => $validated['title'],
            'badge_text' => $validated['badge_text'] ?? 'Promo Spesial',
            'description' => $validated['description'],
            'button_text' => $validated['button_text'] ?? 'Lihat Promo',
            'button_link' => $validated['button_link'] ?? '#',
            'start_date' => $validated['start_date'] ?? null,
            'end_date' => $validated['end_date'] ?? null,
            'image' => $imagePath,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.promos.index')->with('success', 'Promo / Banner berhasil ditambahkan!');
    }

    public function edit(Promo $promo)
    {
        return view('admin.promos.edit', compact('promo'));
    }

    public function update(Request $request, Promo $promo)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'badge_text' => 'nullable|string|max:100',
            'description' => 'required|string',
            'button_text' => 'nullable|string|max:100',
            'button_link' => 'nullable|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:4096',
            'is_active' => 'nullable|boolean',
        ]);

        $imagePath = $promo->image;
        if ($request->hasFile('image')) {
            if ($promo->image && Storage::disk('public')->exists($promo->image)) {
                Storage::disk('public')->delete($promo->image);
            }
            $imagePath = $request->file('image')->store('promos', 'public');
        }

        $promo->update([
            'title' => $validated['title'],
            'badge_text' => $validated['badge_text'] ?? 'Promo Spesial',
            'description' => $validated['description'],
            'button_text' => $validated['button_text'] ?? 'Lihat Promo',
            'button_link' => $validated['button_link'] ?? '#',
            'start_date' => $validated['start_date'] ?? null,
            'end_date' => $validated['end_date'] ?? null,
            'image' => $imagePath,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.promos.index')->with('success', 'Promo / Banner berhasil diperbarui!');
    }

    public function destroy(Promo $promo)
    {
        if ($promo->image && Storage::disk('public')->exists($promo->image)) {
            Storage::disk('public')->delete($promo->image);
        }

        $promo->delete();

        return redirect()->route('admin.promos.index')->with('success', 'Promo / Banner berhasil dihapus!');
    }

    public function deleteImage(Promo $promo)
    {
        if ($promo->image && Storage::disk('public')->exists($promo->image)) {
            Storage::disk('public')->delete($promo->image);
        }

        $promo->update(['image' => null]);

        return back()->with('success', 'Gambar promo berhasil dihapus!');
    }
}
