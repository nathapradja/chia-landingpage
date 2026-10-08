@extends('layouts.app')

@section('title', 'Chia by Amidyas Superfood - Chia & Superfood Organik')

@section('content')
    <!-- 1. Hero Section -->
    <section class="relative overflow-hidden bg-gradient-to-b from-emerald-50/70 via-white to-slate-50 py-16 sm:py-24 lg:py-28">
        <!-- Decorative Ambient Background Elements -->
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-emerald-200/40 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute top-1/2 -right-24 w-96 h-96 bg-orange-200/40 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center">
                
                <!-- Left: Hero Headline & CTA -->
                <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-emerald-100 text-emerald-800 text-xs sm:text-sm font-bold tracking-wide shadow-sm border border-emerald-200">
                        <i data-lucide="sparkles" class="w-4 h-4 text-emerald-600"></i>
                        <span>Superfood 100% Organik & Nutrisi Tinggi</span>
                    </div>

                    <h1 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold text-slate-900 tracking-tight leading-[1.15]">
                        Kebaikan Alam untuk Hidup <span class="text-emerald-600 underline decoration-orange-400 decoration-wavy decoration-2">Sehat & Berenergi</span>
                    </h1>

                    <p class="text-base sm:text-lg text-slate-600 max-w-2xl mx-auto lg:mx-0 leading-relaxed">
                        {{ $company->short_description ?? 'Amidyas Superfood mempersembahkan kualitas grade A dan aneka superfood pilihan untuk mendukung gaya hidup sehat harian Anda dan keluarga.' }}
                    </p>

                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                        <a href="{{ route('products.index') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2.5 bg-emerald-600 hover:bg-emerald-700 text-white px-7 py-3.5 rounded-full font-bold text-base shadow-lg hover:shadow-xl hover:shadow-emerald-600/20 transition-all duration-200 transform hover:-translate-y-0.5">
                            <i data-lucide="shopping-bag" class="w-5 h-5"></i>
                            <span>Jelajahi Katalog Produk</span>
                        </a>

                        @if($contact->whatsapp)
                            <a href="https://wa.me/{{ $contact->clean_whatsapp }}?text={{ urlencode('Halo Amidyas Superfood, saya ingin berkonsultasi mengenai produk chia seed.') }}" target="_blank" class="w-full sm:w-auto inline-flex items-center justify-center gap-2.5 bg-white hover:bg-slate-50 text-slate-700 border-2 border-slate-200 hover:border-emerald-500 px-7 py-3.5 rounded-full font-bold text-base shadow-sm hover:shadow-md transition-all duration-200">
                                <i data-lucide="message-circle" class="w-5 h-5 text-emerald-600"></i>
                                <span>Konsultasi Pemesanan</span>
                            </a>
                        @endif
                    </div>

                    <!-- Trust Badges -->
                    <div class="grid grid-cols-3 gap-4 pt-6 border-t border-slate-200/80 max-w-lg mx-auto lg:mx-0 text-left">
                        <div class="flex items-center gap-2.5">
                            <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-700 shrink-0">
                                <i data-lucide="leaf" class="w-4 h-4"></i>
                            </div>
                            <div>
                                <h4 class="text-xs font-bold text-slate-900">100% Organik</h4>
                                <p class="text-[11px] text-slate-500">Non-GMO</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2.5">
                            <div class="w-8 h-8 rounded-full bg-orange-100 flex items-center justify-center text-orange-700 shrink-0">
                                <i data-lucide="shield-check" class="w-4 h-4"></i>
                            </div>
                            <div>
                                <h4 class="text-xs font-bold text-slate-900">Food Grade</h4>
                                <p class="text-[11px] text-slate-500">Kemasan Higienis</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2.5">
                            <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-700 shrink-0">
                                <i data-lucide="heart-pulse" class="w-4 h-4"></i>
                            </div>
                            <div>
                                <h4 class="text-xs font-bold text-slate-900">Kaya Serat</h4>
                                <p class="text-[11px] text-slate-500">& Omega-3</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Hero Visual Showcase -->
                <div class="lg:col-span-5 flex justify-center relative">
                    <div class="relative w-full max-w-md">
                        <!-- Background Frame Decoration -->
                        <div class="absolute inset-0 bg-gradient-to-tr from-emerald-500 to-orange-400 rounded-3xl transform rotate-3 scale-102 opacity-20 filter blur-sm"></div>
                        
                        <div class="relative bg-white p-6 sm:p-8 rounded-3xl shadow-2xl border border-slate-100 text-center">
                            <div class="w-48 h-48 sm:w-56 sm:h-56 mx-auto mb-6 relative">
                                <img src="{{ asset('images/logo.png') }}" alt="Chia by Amidyas Superfood" class="w-full h-full object-contain rounded-2xl drop-shadow-md">
                            </div>
                            <h3 class="text-xl font-black text-slate-900 mb-1">Chia by Amidyas</h3>
                            <p class="text-xs font-semibold text-emerald-600 uppercase tracking-wider mb-4">Nutrisi Alami Tanpa Kompromi</p>
                            
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- 2. Kategori Section -->
    <section class="py-12 bg-white border-y border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-8">
                <span class="text-xs font-bold uppercase tracking-wider text-emerald-700 bg-emerald-50 px-3 py-1 rounded-full">Kategori Produk</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-2">Pilihan Superfood Berkualitas</h2>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">
                @foreach($categories as $cat)
                    <a href="{{ route('products.index', ['kategori' => $cat->slug]) }}" class="group p-5 rounded-2xl bg-slate-50 hover:bg-emerald-50/80 border border-slate-200/80 hover:border-emerald-300 transition-all duration-300 flex flex-col items-center text-center shadow-sm hover:shadow-md">
                        <div class="w-12 h-12 rounded-xl bg-white group-hover:bg-emerald-600 text-emerald-600 group-hover:text-white shadow-sm flex items-center justify-center mb-3 transition-colors duration-200">
                            <i data-lucide="sparkle" class="w-6 h-6"></i>
                        </div>
                        <h3 class="font-bold text-slate-800 group-hover:text-emerald-800 text-sm sm:text-base mb-1">{{ $cat->name }}</h3>
                        <span class="text-xs text-slate-500 group-hover:text-emerald-600 font-medium">{{ $cat->products_count }} Varian Produk</span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- 3. Produk Unggulan (Featured Products) -->
    <section class="py-16 sm:py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-10">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-emerald-700 bg-emerald-100 px-3 py-1 rounded-full">Koleksi Favorit</span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-2">Produk Unggulan Pilihan</h2>
                    <p class="text-sm text-slate-600 mt-1">Superfood paling diminati untuk gaya hidup sehat aktif dan dinamis.</p>
                </div>
                <a href="{{ route('products.index') }}" class="inline-flex items-center gap-1.5 text-sm font-bold text-emerald-600 hover:text-emerald-700 hover:underline">
                    <span>Lihat Semua Produk</span>
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>

            <!-- Product Cards Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                @forelse($featuredProducts as $product)
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
                                    {{ $product->summary ?? Str::limit($product->description, 100) }}
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
                @empty
                    <div class="col-span-3 text-center py-12 bg-white rounded-2xl border border-dashed border-slate-300">
                        <p class="text-slate-500 text-sm">Belum ada produk yang ditampilkan.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- 4. Promo / Banner Slider & Highlight -->
    @if($promos->isNotEmpty())
        <section class="py-14 bg-gradient-to-r from-emerald-800 to-teal-900 text-white relative overflow-hidden">
            <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px]"></div>
            
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    @php $mainPromo = $promos->first(); @endphp
                    
                    <div class="lg:col-span-8 space-y-4 text-center lg:text-left">
                        <span class="inline-block px-3.5 py-1 rounded-full text-xs font-extrabold bg-orange-500 text-white tracking-wider shadow-sm uppercase">
                            {{ $mainPromo->badge_text ?? 'PROMO SPESIAL' }}
                        </span>
                        <h2 class="text-2xl sm:text-4xl font-extrabold text-white leading-tight">
                            {{ $mainPromo->title }}
                        </h2>
                        <p class="text-emerald-100 text-sm sm:text-base max-w-2xl leading-relaxed">
                            {{ $mainPromo->description }}
                        </p>
                        <div class="pt-2">
                            @if($contact->whatsapp)
                                <a href="https://wa.me/{{ $contact->clean_whatsapp }}?text={{ urlencode('Halo Amidyas Superfood, saya ingin klaim promo: ' . $mainPromo->title) }}" target="_blank" class="inline-flex items-center gap-2 bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-full font-bold text-sm shadow-lg hover:shadow-orange-500/30 transition transform hover:-translate-y-0.5">
                                    <i data-lucide="gift" class="w-4 h-4"></i>
                                    <span>{{ $mainPromo->button_text ?: 'Klaim Promo Sekarang' }}</span>
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="lg:col-span-4 flex justify-center">
                        @if($mainPromo->image)
                            <img src="{{ $mainPromo->image_url }}" alt="{{ $mainPromo->title }}" class="max-h-64 object-cover rounded-2xl shadow-2xl border-2 border-white/20">
                        @else
                            <div class="w-48 h-48 rounded-2xl bg-emerald-700/50 backdrop-blur-md flex flex-col items-center justify-center p-6 text-center border border-white/20">
                                <i data-lucide="tag" class="w-12 h-12 text-orange-400 mb-2"></i>
                                <span class="text-xs font-bold text-white">Penawaran Terbatas</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- 5. Tentang Kami Singkat -->
    <section class="py-16 sm:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                
                <div class="lg:col-span-6 relative">
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl border border-slate-100 bg-slate-50 p-8 text-center">
                        <img src="{{ asset('images/logo.png') }}" alt="Tentang Amidyas Superfood" class="w-48 h-48 mx-auto object-contain mb-4">
                        <h4 class="text-lg font-bold text-slate-900">Chia by Amidyas Superfood</h4>
                        <p class="text-xs text-slate-500 mt-1">Solusi Nutrisi Murni untuk Keluarga Indonesia</p>
                    </div>
                </div>

                <div class="lg:col-span-6 space-y-6">
                    <span class="text-xs font-bold uppercase tracking-wider text-emerald-700 bg-emerald-100 px-3 py-1 rounded-full">Tentang Kami</span>
                    <h2 class="text-2xl sm:text-4xl font-extrabold text-slate-900 leading-snug">
                        Menghadirkan Nutrisi Murni Dari Sumber Alami Terbaik
                    </h2>
                    <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
                        {{ $company->short_description ?? 'Kami berdedikasi menyediakan produk bermutu tinggi tanpa campuran bahan sintetis berbahaya.' }}
                    </p>

                    <!-- Poin Keunggulan -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                        @if(!empty($company->values) && is_array($company->values))
                            @foreach(array_slice($company->values, 0, 4) as $val)
                                <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200/80">
                                    <div class="flex items-center gap-2 mb-1">
                                        <i data-lucide="check-circle" class="w-4 h-4 text-emerald-600"></i>
                                        <h4 class="text-xs font-bold text-slate-900">{{ $val['title'] ?? '' }}</h4>
                                    </div>
                                    <p class="text-[11px] text-slate-500">{{ $val['desc'] ?? '' }}</p>
                                </div>
                            @endforeach
                        @else
                            <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200/80">
                                <div class="flex items-center gap-2 mb-1">
                                    <i data-lucide="check-circle" class="w-4 h-4 text-emerald-600"></i>
                                    <h4 class="text-xs font-bold text-slate-900">100% Organik</h4>
                                </div>
                                <p class="text-[11px] text-slate-500">Bebas dari bahan pengawet kimia.</p>
                            </div>
                            <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200/80">
                                <div class="flex items-center gap-2 mb-1">
                                    <i data-lucide="check-circle" class="w-4 h-4 text-emerald-600"></i>
                                    <h4 class="text-xs font-bold text-slate-900">Kemasan Food Grade</h4>
                                </div>
                                <p class="text-[11px] text-slate-500">Menjaga kesegaran dan higienitas.</p>
                            </div>
                        @endif
                    </div>

                    <div class="pt-2">
                        <a href="{{ route('about') }}" class="inline-flex items-center gap-2 text-sm font-bold text-emerald-700 hover:text-emerald-800 underline decoration-2">
                            <span>Baca Selengkapnya Tentang Kami</span>
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- 6. Call to Action (CTA) Section -->
    <section class="py-16 bg-emerald-50 border-t border-emerald-100">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-6">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-200 text-emerald-900 text-xs font-bold">
                <i data-lucide="zap" class="w-3.5 h-3.5"></i> Siap Menjalani Hidup Lebih Sehat?
            </span>
            <h2 class="text-2xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                Pesan Chia & Superfood Murni Sekarang
            </h2>
            <p class="text-slate-600 text-sm sm:text-base max-w-2xl mx-auto leading-relaxed">
                Tingkatkan energi, kekebalan tubuh, dan pencernaan Anda secara alami. Tim layanan pelanggan kami siap membantu pertanyaan dan pemesanan Anda.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-2">
                @if($contact->whatsapp)
                    <a href="https://wa.me/{{ $contact->clean_whatsapp }}?text={{ urlencode('Halo Amidyas Superfood, saya ingin memesan produk chia seed.') }}" target="_blank" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-8 py-4 rounded-full font-bold text-base shadow-lg hover:shadow-xl transition transform hover:-translate-y-0.5">
                        <i data-lucide="message-circle" class="w-5 h-5"></i>
                        <span>Pesan via WhatsApp Langsung</span>
                    </a>
                @endif
                <a href="{{ route('contact') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-white hover:bg-slate-50 text-slate-700 border border-slate-300 px-8 py-4 rounded-full font-bold text-base shadow-sm hover:shadow-md transition">
                    <i data-lucide="map-pin" class="w-5 h-5 text-slate-500"></i>
                    <span>Lihat Kontak & Lokasi</span>
                </a>
            </div>
        </div>
    </section>
@endsection
