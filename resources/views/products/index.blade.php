@extends('layouts.app')

@section('title', 'Katalog Produk - Chia by Amidyas Superfood')
@section('meta_description', 'Jelajahi seluruh varian biji chia organik premium, superfood mix, powder, dan healthy snacks dari Chia by Amidyas Superfood.')

@section('content')
    <!-- Page Header Banner -->
    <section class="bg-gradient-to-r from-emerald-800 via-emerald-700 to-teal-800 text-white py-12 sm:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="inline-block px-3 py-1 bg-white/20 backdrop-blur-md rounded-full text-xs font-bold uppercase tracking-wider mb-3">
                Koleksi Pangan Sehat
            </span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight">Katalog Produk</h1>
            <p class="text-emerald-100 text-sm sm:text-base max-w-2xl mx-auto mt-3">
                Temukan pilihan biji chia murni, kombinasi superfood, dan camilan sehat alami untuk memenuhi kebutuhan nutrisi harian Anda.
            </p>
        </div>
    </section>

    <!-- Filter, Search & Product Grid Section -->
    <section class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Filter Bar & Search Box -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-4 sm:p-6 mb-8">
                <form action="{{ route('products.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
                    
                    <!-- Search Input -->
                    <div class="md:col-span-6 relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <i data-lucide="search" class="w-5 h-5"></i>
                        </div>
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama produk superfood..." class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm">
                    </div>

                    <!-- Category Selector Dropdown (Mobile / Quick) -->
                    <div class="md:col-span-3">
                        <select name="kategori" onchange="this.form.submit()" class="w-full py-2.5 px-3 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm text-slate-700 bg-white">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->slug }}" {{ request('kategori') == $cat->slug ? 'selected' : '' }}>
                                    {{ $cat->name }} ({{ $cat->products_count }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Sort Dropdown -->
                    <div class="md:col-span-3">
                        <select name="sort" onchange="this.form.submit()" class="w-full py-2.5 px-3 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm text-slate-700 bg-white">
                            <option value="">Urutkan Terbaru</option>
                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Harga: Termurah</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Harga: Tertinggi</option>
                        </select>
                    </div>

                </form>

                <!-- Category Quick Pills (Desktop/Tablet) -->
                <div class="flex items-center gap-2 overflow-x-auto pt-4 mt-4 border-t border-slate-100 pb-1">
                    <a href="{{ route('products.index', array_merge(request()->except('kategori', 'page'))) }}" class="px-4 py-1.5 rounded-full text-xs font-bold whitespace-nowrap transition {{ !request('kategori') ? 'bg-emerald-600 text-white shadow-sm' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                        Semua Kategori
                    </a>
                    @foreach($categories as $cat)
                        <a href="{{ route('products.index', array_merge(request()->except('page'), ['kategori' => $cat->slug])) }}" class="px-4 py-1.5 rounded-full text-xs font-bold whitespace-nowrap transition {{ request('kategori') == $cat->slug ? 'bg-emerald-600 text-white shadow-sm' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                            {{ $cat->name }} <span class="opacity-75">({{ $cat->products_count }})</span>
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Active Search Filter Indicators -->
            @if(request('q') || request('kategori'))
                <div class="flex items-center justify-between bg-emerald-50 border border-emerald-200 px-4 py-2.5 rounded-xl text-xs text-emerald-900 mb-6">
                    <div class="flex items-center gap-2">
                        <span>Menampilkan hasil filter:</span>
                        @if(request('q'))
                            <span class="font-bold bg-white px-2 py-0.5 rounded-md border border-emerald-300">"{{ request('q') }}"</span>
                        @endif
                        @if(request('kategori'))
                            <span class="font-bold bg-white px-2 py-0.5 rounded-md border border-emerald-300">Kategori: {{ request('kategori') }}</span>
                        @endif
                    </div>
                    <a href="{{ route('products.index') }}" class="font-bold text-emerald-700 hover:underline flex items-center gap-1">
                        <i data-lucide="rotate-ccw" class="w-3.5 h-3.5"></i> Reset Filter
                    </a>
                </div>
            @endif

            <!-- Product Grid -->
            @if($products->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                    @foreach($products as $product)
                        <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col group">
                            
                            <!-- Image Area -->
                            <div class="relative bg-slate-100 h-64 overflow-hidden flex items-center justify-center p-6">
                                @if($product->image)
                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300">
                                @else
                                    <div class="w-32 h-32 rounded-full bg-emerald-50 flex items-center justify-center">
                                        <img src="{{ asset('images/logo.png') }}" alt="{{ $product->name }}" class="w-20 h-20 object-contain">
                                    </div>
                                @endif

                                @if($product->category)
                                    <span class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm text-emerald-700 text-xs font-bold px-2.5 py-1 rounded-full shadow-sm border border-emerald-100">
                                        {{ $product->category->name }}
                                    </span>
                                @endif

                                @if($product->is_featured)
                                    <span class="absolute top-3 right-3 bg-orange-500 text-white text-[11px] font-bold px-2.5 py-0.5 rounded-full shadow-sm flex items-center gap-1">
                                        <i data-lucide="star" class="w-3 h-3 fill-current"></i> Unggulan
                                    </span>
                                @endif
                            </div>

                            <!-- Content Area -->
                            <div class="p-6 flex-1 flex flex-col justify-between">
                                <div>
                                    <h3 class="font-bold text-slate-900 text-lg group-hover:text-emerald-600 transition mb-2">
                                        <a href="{{ route('products.show', $product->slug) }}">{{ $product->name }}</a>
                                    </h3>
                                    <p class="text-xs text-slate-500 line-clamp-2 leading-relaxed mb-4">
                                        {{ $product->summary ?? Str::limit($product->description, 110) }}
                                    </p>
                                </div>

                                <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                                    <div>
                                        <span class="text-[11px] text-slate-400 block font-medium">Perkiraan Harga</span>
                                        <span class="text-base font-extrabold text-emerald-700">{{ $product->formatted_price }}</span>
                                    </div>
                                    <a href="{{ route('products.show', $product->slug) }}" class="inline-flex items-center gap-1 bg-emerald-50 hover:bg-emerald-600 text-emerald-700 hover:text-white px-4 py-2 rounded-xl text-xs font-bold transition duration-200">
                                        <span>Detail</span>
                                        <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                                    </a>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>

                <!-- Pagination Links -->
                <div class="mt-10">
                    {{ $products->links() }}
                </div>
            @else
                <div class="bg-white rounded-2xl border border-slate-200 p-12 text-center max-w-md mx-auto">
                    <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto text-slate-400 mb-4">
                        <i data-lucide="search-x" class="w-8 h-8"></i>
                    </div>
                    <h3 class="text-base font-bold text-slate-800 mb-1">Produk Tidak Ditemukan</h3>
                    <p class="text-xs text-slate-500 mb-6">Coba gunakan kata kunci lain atau pilih kategori yang berbeda.</p>
                    <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-emerald-600 text-white rounded-xl text-xs font-bold hover:bg-emerald-700 transition">
                        <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali ke Semua Produk
                    </a>
                </div>
            @endif

        </div>
    </section>
@endsection
