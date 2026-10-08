@extends('layouts.admin')

@section('title', 'Kelola Produk')
@section('page_title', 'Kelola Katalog Produk')
@section('page_subtitle', 'Tambah, perbarui, dan atur ketersediaan produk superfood')

@section('content')
    <div class="space-y-6">
        
        <!-- Action Header Bar -->
        <div class="bg-white rounded-2xl border border-slate-200 p-4 sm:p-6 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">
            
            <!-- Search & Filters -->
            <form action="{{ route('admin.products.index') }}" method="GET" class="flex-1 grid grid-cols-1 sm:grid-cols-3 gap-3">
                <!-- Search Input -->
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                        <i data-lucide="search" class="w-4 h-4"></i>
                    </div>
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama produk..." class="w-full pl-9 pr-3 py-2 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                </div>

                <!-- Category Filter -->
                <select name="category_id" onchange="this.form.submit()" class="py-2 px-3 rounded-xl border border-slate-300 text-xs text-slate-700 bg-white">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>

                <!-- Status Filter -->
                <select name="status" onchange="this.form.submit()" class="py-2 px-3 rounded-xl border border-slate-300 text-xs text-slate-700 bg-white">
                    <option value="">Semua Status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Nonaktif / Draft</option>
                </select>
            </form>

            <!-- Add Product Button -->
            <a href="{{ route('admin.products.create') }}" class="inline-flex items-center justify-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-5 py-2.5 rounded-xl text-xs shadow-md transition shrink-0">
                <i data-lucide="plus" class="w-4 h-4"></i>
                <span>Tambah Produk Baru</span>
            </a>

        </div>

        <!-- Products Table -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-slate-50 text-slate-400 text-[11px] uppercase tracking-wider font-bold border-b border-slate-100">
                        <tr>
                            <th class="py-3.5 px-4">Foto</th>
                            <th class="py-3.5 px-4">Nama Produk</th>
                            <th class="py-3.5 px-4">Kategori</th>
                            <th class="py-3.5 px-4">Harga</th>
                            <th class="py-3.5 px-4">Unggulan</th>
                            <th class="py-3.5 px-4">Status</th>
                            <th class="py-3.5 px-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-xs">
                        @forelse($products as $product)
                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="py-3 px-4">
                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-12 h-12 rounded-xl object-contain bg-slate-50 p-1 border border-slate-200">
                                </td>
                                <td class="py-3 px-4">
                                    <p class="font-bold text-slate-900 text-sm">{{ $product->name }}</p>
                                    <p class="text-slate-400 text-[11px] mt-0.5 line-clamp-1 max-w-xs">{{ $product->summary ?? $product->description }}</p>
                                </td>
                                <td class="py-3 px-4 text-slate-600">
                                    {{ $product->category->name ?? '-' }}
                                </td>
                                <td class="py-3 px-4 font-bold text-emerald-700">
                                    {{ $product->formatted_price }}
                                </td>
                                <td class="py-3 px-4">
                                    @if($product->is_featured)
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-orange-100 text-orange-800">
                                            <i data-lucide="star" class="w-3 h-3 fill-current"></i> Ya
                                        </span>
                                    @else
                                        <span class="text-slate-400 text-[11px]">-</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4">
                                    @if($product->is_active)
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">Aktif</span>
                                    @else
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-slate-100 text-slate-600">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 text-right">
                                    <div class="flex items-center justify-end gap-1.5">
                                        <a href="{{ route('products.show', $product->slug) }}" target="_blank" title="Lihat di Web" class="p-2 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-600 transition">
                                            <i data-lucide="eye" class="w-3.5 h-3.5"></i>
                                        </a>
                                        <a href="{{ route('admin.products.edit', $product->id) }}" title="Edit Produk" class="p-2 rounded-lg bg-blue-50 hover:bg-blue-100 text-blue-600 transition">
                                            <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                                        </a>
                                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" title="Hapus Produk" class="p-2 rounded-lg bg-red-50 hover:bg-red-100 text-red-600 transition">
                                                <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-12 text-center text-slate-400 text-xs">
                                    Tidak ada data produk yang sesuai.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="p-4 border-t border-slate-100">
                {{ $products->links() }}
            </div>
        </div>

    </div>
@endsection
