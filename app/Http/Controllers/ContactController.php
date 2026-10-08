<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contact = Contact::first() ?? new Contact();
        return view('contact', compact('contact'));
    }

    public function sendMessage(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'phone' => 'required|string|max:30',
            'email' => 'nullable|email|max:100',
            'subject' => 'required|string|max:150',
            'message' => 'required|string|max:1000',
        ]);

        $contact = Contact::first() ?? new Contact();
        $whatsappNumber = $contact->clean_whatsapp ?: '6285871746229';

        $text = "Halo Amidyas Superfood,\n\nSaya ingin mengirim pesan/inquiry:\n- *Nama*: " . $validated['name'] . "\n- *Kontak*: " . $validated['phone'] . ($validated['email'] ? " (" . $validated['email'] . ")" : "") . "\n- *Perihal*: " . $validated['subject'] . "\n- *Pesan*: " . $validated['message'];

        $waUrl = "https://wa.me/{$whatsappNumber}?text=" . urlencode($text);

        return redirect()->away($waUrl);
    }
}
