@extends('layouts.admin')

@section('title', 'Kelola Kontak & Tautan Layanan')
@section('page_title', 'Informasi Kontak & Tautan Layanan')
@section('page_subtitle', 'Kelola nomor WhatsApp, email, media sosial, Google Maps, dan tautan platform pemesanan/kontak (Shopee, GrabFood, GoFood, dll)')

@section('content')
    <div class="max-w-4xl" 
         x-data="{ 
             links: {{ json_encode(old('custom_links', $contact->custom_links ?? [
                 ['platform' => 'whatsapp', 'title' => 'WhatsApp CS Amidyas', 'url' => 'https://wa.me/6285871746229', 'badge' => 'Respon Cepat'],
                 ['platform' => 'shopee', 'title' => 'Shopee Official Store', 'url' => 'https://shopee.co.id', 'badge' => 'Gratis Ongkir'],
                 ['platform' => 'grabfood', 'title' => 'GrabFood Official', 'url' => 'https://food.grab.com', 'badge' => 'Pesan Siap Antar'],
                 ['platform' => 'gofood', 'title' => 'GoFood Delivery', 'url' => 'https://gofood.co.id', 'badge' => 'Pengiriman Cepat']
             ])) }} 
         }">
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8">
            
            <form action="{{ route('admin.contact.update') }}" method="POST" class="space-y-8">
                @csrf
                @method('PUT')

                <!-- 1. Kontak Utama -->
                <div class="space-y-6">
                    <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider border-l-4 border-emerald-500 pl-3">
                        Kontak Utama & Alamat
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                                Alamat Lengkap Perusahaan *
                            </label>
                            <textarea name="address" rows="3" required class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-emerald-500 focus:outline-none">{{ old('address', $contact->address) }}</textarea>
                            @error('address') <span class="text-[11px] text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                                Nomor WhatsApp CS Utama *
                            </label>
                            <input type="text" name="whatsapp" value="{{ old('whatsapp', $contact->whatsapp) }}" required placeholder="Contoh: 085871746229" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                            <p class="text-[11px] text-slate-400 mt-1">Gunakan format angka saja (contoh: 085871746229).</p>
                             @error('whatsapp') <span class="text-[11px] text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                                Nomor Telepon Kantor *
                            </label>
                            <input type="text" name="phone" value="{{ old('phone', $contact->phone) }}" required placeholder="Contoh: +62 858-7174-6229" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                             @error('phone') <span class="text-[11px] text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                                Alamat Email Resmi *
                            </label>
                            <input type="email" name="email" value="{{ old('email', $contact->email) }}" required placeholder="Contoh: natabintang24@gmail.com" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                             @error('email') <span class="text-[11px] text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                                Jam Operasional
                            </label>
                            <input type="text" name="operational_hours" value="{{ old('operational_hours', $contact->operational_hours) }}" placeholder="Senin - Sabtu: 08.00 - 17.00 WIB" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                             @error('operational_hours') <span class="text-[11px] text-red-500">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <!-- 2. Dynamic Custom Links / Platform Pemesanan & Kontak (Unlimited) -->
                <div class="pt-6 border-t border-slate-200 space-y-4">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                        <div>
                            <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider border-l-4 border-orange-500 pl-3">
                                Tautan Platform Kontak & Pemesanan (Tanpa Batas)
                            </h3>
                            <p class="text-xs text-slate-500 mt-1 pl-4">
                                Tambahkan link WhatsApp tambahan, Shopee, GrabFood, GoFood, Tokopedia, dll. Logo platform akan otomatis tampil sesuai pilihan.
                            </p>
                        </div>
                        <button type="button" @click="links.push({platform: 'whatsapp', title: '', url: '', badge: ''})" class="inline-flex items-center gap-1.5 bg-emerald-50 hover:bg-emerald-100 text-emerald-700 border border-emerald-300 px-3.5 py-2 rounded-xl text-xs font-bold transition shrink-0">
                            <i data-lucide="plus-circle" class="w-4 h-4"></i>
                            <span>Tambah Tautan Baru</span>
                        </button>
                    </div>

                    <div class="space-y-3 pt-2">
                        <!-- Iterasi Alpine.js -->
                        <template x-for="(item, index) in links" :key="index">
                            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/90 shadow-xs relative space-y-3">
                                <div class="grid grid-cols-1 sm:grid-cols-12 gap-3 items-center">
                                    
                                    <!-- Platform Type Dropdown -->
                                    <div class="sm:col-span-3">
                                        <label class="block text-[10px] font-bold uppercase text-slate-400 mb-1">Platform / Logo</label>
                                        <select :name="`custom_links[${index}][platform]`" x-model="item.platform" class="w-full px-3 py-2 rounded-xl border border-slate-300 text-xs font-bold text-slate-700 bg-white focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                                            <option value="whatsapp">WhatsApp</option>
                                            <option value="shopee">Shopee</option>
                                            <option value="grabfood">GrabFood</option>
                                            <option value="gofood">GoFood</option>
                                            <option value="tokopedia">Tokopedia</option>
                                            <option value="instagram">Instagram</option>
                                            <option value="tiktok">TikTok</option>
                                            <option value="facebook">Facebook</option>
                                            <option value="other">Lainnya / Website</option>
                                        </select>
                                    </div>

                                    <!-- Title -->
                                    <div class="sm:col-span-4">
                                        <label class="block text-[10px] font-bold uppercase text-slate-400 mb-1">Nama Tautan / Label *</label>
                                        <input type="text" :name="`custom_links[${index}][title]`" x-model="item.title" placeholder="Contoh: Shopee Official Store" required class="w-full px-3 py-2 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-emerald-500 focus:outline-none bg-white">
                                    </div>

                                    <!-- URL -->
                                    <div class="sm:col-span-5">
                                        <label class="block text-[10px] font-bold uppercase text-slate-400 mb-1">Link URL Lengkap *</label>
                                        <div class="flex items-center gap-2">
                                            <input type="url" :name="`custom_links[${index}][url]`" x-model="item.url" placeholder="https://shopee.co.id/..." required class="w-full px-3 py-2 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-emerald-500 focus:outline-none bg-white font-mono">
                                            <button type="button" @click="links.splice(index, 1)" title="Hapus Baris Tautan" class="p-2 text-red-500 hover:bg-red-50 rounded-xl transition shrink-0">
                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                            </button>
                                        </div>
                                    </div>

                                </div>

                                <!-- Optional Badge Note -->
                                <div class="grid grid-cols-1 sm:grid-cols-12 gap-3 items-center pt-1 border-t border-slate-200/50">
                                    <div class="sm:col-span-12 flex items-center gap-2">
                                        <span class="text-[11px] text-slate-400 font-medium whitespace-nowrap">Badge / Catatan (Opsional):</span>
                                        <input type="text" :name="`custom_links[${index}][badge]`" x-model="item.badge" placeholder="Contoh: Gratis Ongkir / Respon 24 Jam" class="flex-1 px-3 py-1.5 rounded-lg border border-slate-200 text-xs bg-white text-slate-700 focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                                    </div>
                                </div>
                            </div>
                        </template>

                        <!-- Fallback jika array kosong -->
                        <div x-show="links.length === 0" class="p-6 text-center border-2 border-dashed border-slate-200 rounded-2xl">
                            <p class="text-xs text-slate-400 mb-3">Belum ada tautan tambahan yang didaftarkan.</p>
                            <button type="button" @click="links.push({platform: 'whatsapp', title: '', url: '', badge: ''})" class="inline-flex items-center gap-1.5 bg-emerald-600 text-white px-4 py-2 rounded-xl text-xs font-bold shadow-sm">
                                <i data-lucide="plus" class="w-3.5 h-3.5"></i> Tambah Tautan Sekarang
                            </button>
                        </div>
                    </div>
                </div>

                <!-- 3. Social Media Standar -->
                <div class="pt-6 border-t border-slate-200 space-y-4">
                    <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider border-l-4 border-emerald-500 pl-3">
                        Tautan Akun Media Sosial Utama
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-[11px] font-bold text-slate-600 mb-1">Instagram URL</label>
                            <input type="url" name="instagram" value="{{ old('instagram', $contact->instagram) }}" placeholder="https://instagram.com/chia.amidyas" class="w-full px-3 py-2 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                             @error('instagram') <span class="text-[11px] text-red-500">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-slate-600 mb-1">TikTok URL</label>
                            <input type="url" name="tiktok" value="{{ old('tiktok', $contact->tiktok) }}" placeholder="https://tiktok.com/@chia.amidyas" class="w-full px-3 py-2 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                             @error('tiktok') <span class="text-[11px] text-red-500">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-slate-600 mb-1">Facebook URL</label>
                            <input type="url" name="facebook" value="{{ old('facebook', $contact->facebook) }}" placeholder="https://facebook.com/chia.amidyas" class="w-full px-3 py-2 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                             @error('facebook') <span class="text-[11px] text-red-500">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <!-- 4. Google Maps Embed -->
                <div class="pt-6 border-t border-slate-200 space-y-2">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Kode Embed Google Maps (iframe)
                    </label>
                    <textarea name="maps_embed" rows="4" placeholder='<iframe src="https://www.google.com/maps/embed?..." ...></iframe>' class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-xs font-mono focus:ring-2 focus:ring-emerald-500 focus:outline-none">{{ old('maps_embed', $contact->maps_embed) }}</textarea>
                    <p class="text-[11px] text-slate-400 mt-1">Salin kode embed HTML dari Google Maps untuk menampilkan peta lokasi di halaman kontak.</p>
                     @error('maps_embed') <span class="text-[11px] text-red-500">{{ $message }}</span> @enderror
                </div>

                <!-- Submit Button -->
                <div class="pt-6 border-t border-slate-200 flex items-center justify-end">
                    <button type="submit" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-7 py-3 rounded-xl text-xs shadow-md transition">
                        <i data-lucide="save" class="w-4 h-4"></i>
                        <span>Simpan Perubahan Kontak & Tautan</span>
                    </button>
                </div>

            </form>

        </div>
    </div>
@endsection