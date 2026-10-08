@extends('layouts.admin')

@section('title', 'Tambah Promo / Banner Baru')
@section('page_title', 'Tambah Banner Promo')
@section('page_subtitle', 'Buat penawaran diskon atau banner highlight baru')

@section('content')
    <div class="max-w-3xl">
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8">
            
            <form action="{{ route('admin.promos.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                            Judul Promo *
                        </label>
                        <input type="text" name="title" value="{{ old('title') }}" required placeholder="Contoh: Diskon 15% untuk Pembelian Pertama!" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                            Badge / Label Promo
                        </label>
                        <input type="text" name="badge_text" value="{{ old('badge_text', 'PROMO SPESIAL') }}" placeholder="Contoh: PAKET HEMAT" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                            Teks Tombol Aksi
                        </label>
                        <input type="text" name="button_text" value="{{ old('button_text', 'Klaim Promo via WhatsApp') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                            Deskripsi Promo *
                        </label>
                        <textarea name="description" rows="3" required placeholder="Jelaskan detail keuntungan promo ini..." class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-emerald-500 focus:outline-none">{{ old('description') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                            Tanggal Mulai (Opsional)
                        </label>
                        <input type="date" name="start_date" value="{{ old('start_date') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                            Tanggal Selesai (Opsional)
                        </label>
                        <input type="date" name="end_date" value="{{ old('end_date') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                    </div>

                </div>

                <!-- Banner Image Upload -->
                <div class="pt-4 border-t border-slate-200">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Gambar / Banner Promo
                    </label>
                    <input type="file" name="image" accept="image/*" class="w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                    <p class="text-[11px] text-slate-400 mt-1">Format gambar: JPG, PNG, WEBP (Rasio rekomendasi: 16:9 atau Banner horizontal).</p>
                </div>

                <!-- Active Toggle -->
                <div class="pt-4 border-t border-slate-200">
                    <label class="flex items-center gap-3 p-4 rounded-xl border border-slate-200 bg-slate-50 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="w-4 h-4 rounded text-emerald-600 focus:ring-emerald-500 border-slate-300">
                        <div>
                            <span class="text-xs font-bold text-slate-800 block">Status Aktif</span>
                            <span class="text-[11px] text-slate-500 block">Tampilkan di banner beranda website</span>
                        </div>
                    </label>
                </div>

                <!-- Submit Buttons -->
                <div class="pt-6 border-t border-slate-200 flex items-center justify-end gap-3">
                    <a href="{{ route('admin.promos.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-300 text-xs font-bold text-slate-600 hover:bg-slate-50 transition">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-6 py-2.5 rounded-xl text-xs shadow-md transition">
                        <i data-lucide="save" class="w-4 h-4"></i>
                        <span>Simpan Banner Promo</span>
                    </button>
                </div>

            </form>

        </div>
    </div>
@endsection
