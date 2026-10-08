<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function edit()
    {
        $contact = Contact::firstOrCreate([], [
            'phone' => '+62 858-7174-6229',
            'whatsapp' => '085871746229',
            'email' => 'natabintang24@gmail.com',
        ]);

        return view('admin.contact.edit', compact('contact'));
    }

    public function update(Request $request)
    {
        $contact = Contact::firstOrCreate([]);

        $validated = $request->validate([
            'address' => 'required|string',
            'phone' => 'required|string|max:50',
            'whatsapp' => 'required|string|max:50',
            'email' => 'required|email|max:100',
            'maps_embed' => 'nullable|string',
            'instagram' => 'nullable|string|max:255',
            'tiktok' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'operational_hours' => 'nullable|string|max:255',
            'custom_links' => 'nullable|array',
        ]);

        // Filter out empty rows from custom_links
        $customLinks = [];
        if (!empty($validated['custom_links']) && is_array($validated['custom_links'])) {
            foreach ($validated['custom_links'] as $link) {
                if (!empty($link['title']) && !empty($link['url'])) {
                    $customLinks[] = [
                        'platform' => $link['platform'] ?? 'other',
                        'title' => $link['title'],
                        'url' => $link['url'],
                        'badge' => $link['badge'] ?? '',
                    ];
                }
            }
        }

        $validated['custom_links'] = $customLinks;

        $contact->update($validated);

        return redirect()->route('admin.contact.edit')->with('success', 'Informasi Kontak, Tautan Hubungi Kami, & Lokasi berhasil diperbarui!');
    }
}
