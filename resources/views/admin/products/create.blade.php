@extends('layouts.admin')

@section('title', 'Tambah Produk Baru')
@section('page_title', 'Tambah Produk Baru')
@section('page_subtitle', 'Masukkan data dan informasi produk superfood baru')

@section('content')
    <div class="max-w-4xl">
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8">
            
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6" x-data="{ details: [{key: 'Kemasan', val: ''}, {key: 'Komposisi', val: ''}, {key: 'Saran Penyajian', val: ''}, {key: 'Manfaat', val: ''}] }">
                @csrf

                <!-- Basic Details -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                            Nama Produk *
                        </label>
                        <input type="text" name="name" value="{{ old('name') }}" required placeholder="Contoh: Chia Seeds Premium Organic 250g" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                            Kategori *
                        </label>
                        <select name="category_id" required class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-emerald-500 focus:outline-none bg-white">
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                            Harga Satuan (Rp) *
                        </label>
                        <input type="number" name="price" value="{{ old('price', 0) }}" min="0" required placeholder="35000" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                            Ringkasan Singkat (Summary)
                        </label>
                        <input type="text" name="summary" value="{{ old('summary') }}" placeholder="Ringkasan 1-2 kalimat untuk kartu produk" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                            Deskripsi Lengkap *
                        </label>
                        <textarea name="description" rows="5" required placeholder="Jelaskan keunggulan, asal panen, dan spesifikasi produk..." class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-emerald-500 focus:outline-none">{{ old('description') }}</textarea>
                    </div>

                </div>

                <!-- Product Specifications / Dynamic Details -->
                <div class="pt-4 border-t border-slate-200">
                    <div class="flex items-center justify-between mb-3">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">
                            Informasi Tambahan & Spesifikasi
                        </label>
                        <button type="button" @click="details.push({key: '', val: ''})" class="text-xs font-bold text-emerald-600 hover:text-emerald-700 flex items-center gap-1">
                            <i data-lucide="plus" class="w-3.5 h-3.5"></i> Tambah Baris
                        </button>
                    </div>

                    <div class="space-y-3">
                        <template x-for="(item, index) in details" :key="index">
                            <div class="flex items-center gap-3">
                                <input type="text" :name="`details[${item.key}]`" x-model="item.key" placeholder="Nama Spesifikasi (misal: Kemasan)" class="w-1/3 px-3 py-2 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                                <input type="text" :name="`details[${item.key}]`" x-model="item.val" placeholder="Nilai / Isi Spesifikasi" class="flex-1 px-3 py-2 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                                <button type="button" @click="details.splice(index, 1)" class="p-2 text-red-500 hover:bg-red-50 rounded-lg">
                                    <i data-lucide="trash" class="w-4 h-4"></i>
                                </button>
                            </div>
                        </template>
                    </div>
                </div>

                <!-- Image Upload -->
                <div class="pt-4 border-t border-slate-200">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Foto Produk
                    </label>
                    <input type="file" name="image" accept="image/*" class="w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                    <p class="text-[11px] text-slate-400 mt-1">Format: JPG, PNG, WEBP (Maks. 4MB). Jika dikosongkan, logo default akan digunakan.</p>
                </div>

                <!-- Status & Featured Toggles -->
                <div class="pt-4 border-t border-slate-200 grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <label class="flex items-center gap-3 p-4 rounded-xl border border-slate-200 bg-slate-50 cursor-pointer">
                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} class="w-4 h-4 rounded text-orange-500 focus:ring-orange-400 border-slate-300">
                        <div>
                            <span class="text-xs font-bold text-slate-800 block">Jadikan Produk Unggulan</span>
                            <span class="text-[11px] text-slate-500 block">Tampilkan di halaman depan (Home)</span>
                        </div>
                    </label>

                    <label class="flex items-center gap-3 p-4 rounded-xl border border-slate-200 bg-slate-50 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="w-4 h-4 rounded text-emerald-600 focus:ring-emerald-500 border-slate-300">
                        <div>
                            <span class="text-xs font-bold text-slate-800 block">Status Aktif</span>
                            <span class="text-[11px] text-slate-500 block">Tampilkan di katalog publik</span>
                        </div>
                    </label>
                </div>

                <!-- Submit Buttons -->
                <div class="pt-6 border-t border-slate-200 flex items-center justify-end gap-3">
                    <a href="{{ route('admin.products.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-300 text-xs font-bold text-slate-600 hover:bg-slate-50 transition">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-6 py-2.5 rounded-xl text-xs shadow-md transition">
                        <i data-lucide="save" class="w-4 h-4"></i>
                        <span>Simpan Produk</span>
                    </button>
                </div>

            </form>

        </div>
    </div>
@endsection
