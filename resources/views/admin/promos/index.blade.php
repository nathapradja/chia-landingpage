@extends('layouts.admin')

@section('title', 'Kelola Promo & Banner')
@section('page_title', 'Kelola Promo & Banner Beranda')
@section('page_subtitle', 'Atur penawaran khusus dan banner promosi yang tampil di halaman depan')

@section('content')
    <div class="space-y-6">
        
        <!-- Header Actions -->
        <div class="bg-white rounded-2xl border border-slate-200 p-4 sm:p-6 shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <!-- Search -->
            <form action="{{ route('admin.promos.index') }}" method="GET" class="flex-1 max-w-md">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                        <i data-lucide="search" class="w-4 h-4"></i>
                    </div>
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari judul promo..." class="w-full pl-9 pr-3 py-2 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                </div>
            </form>

            <a href="{{ route('admin.promos.create') }}" class="inline-flex items-center justify-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-5 py-2.5 rounded-xl text-xs shadow-md transition shrink-0">
                <i data-lucide="plus" class="w-4 h-4"></i>
                <span>Tambah Banner Promo Baru</span>
            </a>
        </div>

        <!-- Promos Table -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-slate-50 text-slate-400 text-[11px] uppercase tracking-wider font-bold border-b border-slate-100">
                        <tr>
                            <th class="py-3.5 px-4">Banner</th>
                            <th class="py-3.5 px-4">Judul Promo</th>
                            <th class="py-3.5 px-4">Badge / Tag</th>
                            <th class="py-3.5 px-4">Periode</th>
                            <th class="py-3.5 px-4">Status</th>
                            <th class="py-3.5 px-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-xs">
                        @forelse($promos as $promo)
                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="py-3 px-4">
                                    <img src="{{ $promo->image_url }}" alt="{{ $promo->title }}" class="w-14 h-10 rounded-lg object-cover bg-slate-100 border border-slate-200">
                                </td>
                                <td class="py-3.5 px-4">
                                    <p class="font-bold text-slate-900 text-sm">{{ $promo->title }}</p>
                                    <p class="text-slate-500 text-[11px] mt-0.5 line-clamp-1 max-w-xs">{{ $promo->description }}</p>
                                </td>
                                <td class="py-3.5 px-4">
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-orange-100 text-orange-800">
                                        {{ $promo->badge_text ?? 'Promo' }}
                                    </span>
                                </td>
                                <td class="py-3.5 px-4 text-slate-600">
                                    @if($promo->start_date || $promo->end_date)
                                        {{ $promo->start_date ? $promo->start_date->format('d/m/Y') : 'Selamanya' }} - {{ $promo->end_date ? $promo->end_date->format('d/m/Y') : 'Selesai' }}
                                    @else
                                        <span class="text-slate-400">Tanpa batas waktu</span>
                                    @endif
                                </td>
                                <td class="py-3.5 px-4">
                                    @if($promo->is_active)
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">Aktif</span>
                                    @else
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-slate-100 text-slate-600">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="py-3.5 px-4 text-right">
                                    <div class="flex items-center justify-end gap-1.5">
                                        <a href="{{ route('admin.promos.edit', $promo->id) }}" title="Edit Promo" class="p-2 rounded-lg bg-blue-50 hover:bg-blue-100 text-blue-600 transition">
                                            <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                                        </a>
                                        <form action="{{ route('admin.promos.destroy', $promo->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus promo ini?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" title="Hapus Promo" class="p-2 rounded-lg bg-red-50 hover:bg-red-100 text-red-600 transition">
                                                <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-12 text-center text-slate-400 text-xs">
                                    Belum ada data promo yang ditambahkan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-4 border-t border-slate-100">
                {{ $promos->links() }}
            </div>
        </div>

    </div>
@endsection
