@extends('layouts.admin')

@section('title', 'Tambah Kategori Baru')
@section('page_title', 'Tambah Kategori Produk')
@section('page_subtitle', 'Buat kategori baru untuk mengelompokkan varian superfood')

@section('content')
    <div class="max-w-2xl">
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8">
            
            <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Nama Kategori *
                    </label>
                    <input type="text" name="name" value="{{ old('name') }}" required placeholder="Contoh: Superfood Powder" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Deskripsi Kategori (Opsional)
                    </label>
                    <textarea name="description" rows="3" placeholder="Penjelasan singkat mengenai kategori ini..." class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-emerald-500 focus:outline-none">{{ old('description') }}</textarea>
                </div>

                <div>
                    <label class="flex items-center gap-3 p-4 rounded-xl border border-slate-200 bg-slate-50 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="w-4 h-4 rounded text-emerald-600 focus:ring-emerald-500 border-slate-300">
                        <div>
                            <span class="text-xs font-bold text-slate-800 block">Status Aktif</span>
                            <span class="text-[11px] text-slate-500 block">Tampilkan dalam filter kategori di katalog publik</span>
                        </div>
                    </label>
                </div>

                <div class="pt-4 border-t border-slate-200 flex items-center justify-end gap-3">
                    <a href="{{ route('admin.categories.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-300 text-xs font-bold text-slate-600 hover:bg-slate-50 transition">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-6 py-2.5 rounded-xl text-xs shadow-md transition">
                        <i data-lucide="save" class="w-4 h-4"></i>
                        <span>Simpan Kategori</span>
                    </button>
                </div>

            </form>

        </div>
    </div>
@endsection
