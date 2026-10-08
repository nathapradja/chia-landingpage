<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyProfileController extends Controller
{
    public function edit()
    {
        $company = CompanyProfile::firstOrCreate([], [
            'company_name' => 'Chia by Amidyas Superfood',
            'tagline' => 'Kebaikan Alam untuk Hidup Lebih Sehat & Berenergi',
        ]);

        return view('admin.company.edit', compact('company'));
    }

    public function update(Request $request)
    {
        $company = CompanyProfile::firstOrCreate([]);

        $validated = $request->validate([
            'company_name' => 'required|string|max:150',
            'tagline' => 'required|string|max:255',
            'short_description' => 'required|string',
            'about_us' => 'required|string',
            'vision' => 'required|string',
            'mission' => 'required|string',
            'values' => 'nullable|array',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:4096',
        ]);

        $imagePath = $company->image;
        if ($request->hasFile('image')) {
            if ($company->image && Storage::disk('public')->exists($company->image)) {
                Storage::disk('public')->delete($company->image);
            }
            $imagePath = $request->file('image')->store('company', 'public');
        }

        $company->update([
            'company_name' => $validated['company_name'],
            'tagline' => $validated['tagline'],
            'short_description' => $validated['short_description'],
            'about_us' => $validated['about_us'],
            'vision' => $validated['vision'],
            'mission' => $validated['mission'],
            'values' => $request->input('values', []),
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.company.edit')->with('success', 'Informasi Perusahaan berhasil diperbarui!');
    }

    public function deleteImage()
    {
        $company = CompanyProfile::first();
        if ($company && $company->image && Storage::disk('public')->exists($company->image)) {
            Storage::disk('public')->delete($company->image);
            $company->update(['image' => null]);
        }

        return back()->with('success', 'Foto perusahaan berhasil dihapus!');
    }
}
