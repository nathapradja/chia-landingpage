@extends('layouts.admin')

@section('title', 'Dashboard Ringkasan')
@section('page_title', 'Dashboard Administrator')
@section('page_subtitle', 'Ringkasan performa konten dan katalog produk Chia by Amidyas Superfood')

@section('content')
    <!-- 1. Stats Counter Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
        
        <!-- Total Produk -->
        <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Total Produk</span>
                <span class="text-3xl font-black text-slate-900 mt-1 block">{{ $stats['total_products'] }}</span>
                <span class="text-[11px] text-emerald-600 font-semibold mt-1 block">{{ $stats['active_products'] }} Aktif tayang</span>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                <i data-lucide="package" class="w-7 h-7"></i>
            </div>
        </div>

        <!-- Total Kategori -->
        <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Kategori</span>
                <span class="text-3xl font-black text-slate-900 mt-1 block">{{ $stats['total_categories'] }}</span>
                <span class="text-[11px] text-slate-500 font-medium mt-1 block">Pengelompokan produk</span>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                <i data-lucide="folder-tree" class="w-7 h-7"></i>
            </div>
        </div>

        <!-- Banner Promo -->
        <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Promo / Banner</span>
                <span class="text-3xl font-black text-slate-900 mt-1 block">{{ $stats['active_promos'] }}</span>
                <span class="text-[11px] text-orange-600 font-semibold mt-1 block">Banner beranda</span>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-orange-50 text-orange-600 flex items-center justify-center shrink-0">
                <i data-lucide="megaphone" class="w-7 h-7"></i>
            </div>
        </div>

        <!-- Total Admin -->
        <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Administrator</span>
                <span class="text-3xl font-black text-slate-900 mt-1 block">{{ $stats['total_admins'] }}</span>
                <span class="text-[11px] text-slate-500 font-medium mt-1 block">Pengelola aktif</span>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-purple-50 text-purple-600 flex items-center justify-center shrink-0">
                <i data-lucide="users" class="w-7 h-7"></i>
            </div>
        </div>

    </div>

    <!-- 2. Quick Action Buttons -->
    <div class="bg-gradient-to-r from-emerald-800 to-teal-900 rounded-3xl p-6 sm:p-8 text-white mb-8 shadow-sm">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h3 class="text-xl font-extrabold text-white">Aksi Cepat Pengelolaan</h3>
                <p class="text-xs text-emerald-100 mt-1">Perbarui data produk, kategori, atau profil perusahaan dengan satu klik.</p>
            </div>
            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('admin.products.create') }}" class="inline-flex items-center gap-2 bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-bold px-4 py-2.5 rounded-xl text-xs shadow-md transition">
                    <i data-lucide="plus-circle" class="w-4 h-4"></i> Tambah Produk Baru
                </a>
                <a href="{{ route('admin.categories.create') }}" class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 text-white font-bold px-4 py-2.5 rounded-xl text-xs transition border border-white/20">
                    <i data-lucide="folder-plus" class="w-4 h-4"></i> Tambah Kategori
                </a>
                <a href="{{ route('admin.company.edit') }}" class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 text-white font-bold px-4 py-2.5 rounded-xl text-xs transition border border-white/20">
                    <i data-lucide="edit" class="w-4 h-4"></i> Edit Profil
                </a>
            </div>
        </div>
    </div>

    <!-- 3. Recent Products & Content Overview -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- Left: Recent Products Table -->
        <div class="lg:col-span-8 bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                <div>
                    <h3 class="font-bold text-slate-900 text-base">Produk Terbaru</h3>
                    <p class="text-xs text-slate-500">Daftar produk yang baru saja dimasukkan ke sistem</p>
                </div>
                <a href="{{ route('admin.products.index') }}" class="text-xs font-bold text-emerald-600 hover:underline">
                    Lihat Semua
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-slate-50 text-slate-400 text-[11px] uppercase tracking-wider font-bold">
                        <tr>
                            <th class="py-3 px-4">Produk</th>
                            <th class="py-3 px-4">Kategori</th>
                            <th class="py-3 px-4">Harga</th>
                            <th class="py-3 px-4">Status</th>
                            <th class="py-3 px-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-xs">
                        @forelse($recentProducts as $p)
                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="py-3.5 px-4 font-semibold text-slate-800 flex items-center gap-3">
                                    <img src="{{ $p->image_url }}" alt="{{ $p->name }}" class="w-9 h-9 rounded-lg object-contain bg-slate-100 p-0.5 border border-slate-200 shrink-0">
                                    <span class="truncate max-w-[180px] sm:max-w-xs">{{ $p->name }}</span>
                                </td>
                                <td class="py-3.5 px-4 text-slate-600">
                                    {{ $p->category->name ?? '-' }}
                                </td>
                                <td class="py-3.5 px-4 font-bold text-emerald-700">
                                    {{ $p->formatted_price }}
                                </td>
                                <td class="py-3.5 px-4">
                                    @if($p->is_active)
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">Aktif</span>
                                    @else
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-600">Draft</span>
                                    @endif
                                </td>
                                <td class="py-3.5 px-4 text-right">
                                    <a href="{{ route('admin.products.edit', $p->id) }}" class="p-1.5 rounded-lg bg-slate-100 hover:bg-emerald-50 text-slate-600 hover:text-emerald-700 transition inline-block">
                                        <i data-lucide="edit-2" class="w-3.5 h-3.5"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-8 text-center text-slate-400 text-xs">Belum ada produk.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Right: Information Overview Box -->
        <div class="lg:col-span-4 space-y-6">
            
            <!-- Company Info Summary -->
            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
                <div class="flex items-center justify-between border-b border-slate-100 pb-3 mb-4">
                    <h4 class="font-bold text-slate-900 text-sm">Profil Website</h4>
                    <a href="{{ route('admin.company.edit') }}" class="text-xs text-emerald-600 font-bold hover:underline">Edit</a>
                </div>
                <div class="space-y-3 text-xs">
                    <div>
                        <span class="text-slate-400 block">Nama Perusahaan:</span>
                        <span class="font-bold text-slate-800">{{ $company->company_name ?? 'Chia by Amidyas Superfood' }}</span>
                    </div>
                    <div>
                        <span class="text-slate-400 block">Tagline:</span>
                        <span class="text-slate-700">{{ $company->tagline ?? '-' }}</span>
                    </div>
                </div>
            </div>

            <!-- Contact Summary -->
            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
                <div class="flex items-center justify-between border-b border-slate-100 pb-3 mb-4">
                    <h4 class="font-bold text-slate-900 text-sm">Kontak Pelanggan</h4>
                    <a href="{{ route('admin.contact.edit') }}" class="text-xs text-emerald-600 font-bold hover:underline">Edit</a>
                </div>
                <div class="space-y-3 text-xs">
                    <div class="flex items-center justify-between">
                        <span class="text-slate-400">WhatsApp:</span>
                        <span class="font-bold text-emerald-700">{{ $contact->whatsapp ?? '-' }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-slate-400">Email:</span>
                        <span class="font-medium text-slate-700">{{ $contact->email ?? '-' }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-slate-400">Telepon:</span>
                        <span class="font-medium text-slate-700">{{ $contact->phone ?? '-' }}</span>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
