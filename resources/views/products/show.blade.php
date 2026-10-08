@extends('layouts.app')

@section('title', $product->name . ' - Chia by Amidyas Superfood')
@section('meta_description', Str::limit($product->summary ?? $product->description, 150))

@section('content')
    <!-- Breadcrumbs -->
    <div class="bg-white border-b border-slate-200 py-3">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center gap-2 text-xs font-medium text-slate-500">
                <a href="{{ route('home') }}" class="hover:text-emerald-600 transition flex items-center gap-1">
                    <i data-lucide="home" class="w-3.5 h-3.5"></i> Home
                </a>
                <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i>
                <a href="{{ route('products.index') }}" class="hover:text-emerald-600 transition">Produk</a>
                @if($product->category)
                    <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i>
                    <a href="{{ route('products.index', ['kategori' => $product->category->slug]) }}" class="hover:text-emerald-600 transition">
                        {{ $product->category->name }}
                    </a>
                @endif
                <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i>
                <span class="text-slate-900 font-bold truncate max-w-xs">{{ $product->name }}</span>
            </nav>
        </div>
    </div>

    <!-- Product Detail Main Section -->
    <section class="py-12 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 sm:p-10 mb-12">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-start">
                    
                    <!-- Left: Product Image Box -->
                    <div class="lg:col-span-5 flex flex-col items-center">
                        <div class="w-full bg-slate-50 rounded-2xl border border-slate-200 p-8 flex items-center justify-center relative overflow-hidden aspect-square">
                            @if($product->image)
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="max-h-full max-w-full object-contain rounded-xl drop-shadow-md">
                            @else
                                <div class="w-48 h-48 rounded-full bg-emerald-50 flex items-center justify-center">
                                    <img src="{{ asset('images/logo.png') }}" alt="{{ $product->name }}" class="w-32 h-32 object-contain">
                                </div>
                            @endif

                            @if($product->is_featured)
                                <span class="absolute top-4 right-4 bg-orange-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-sm flex items-center gap-1">
                                    <i data-lucide="star" class="w-3.5 h-3.5 fill-current"></i> Pilihan Unggulan
                                </span>
                            @endif
                        </div>

                        <!-- Trust Mini Badges -->
                        <div class="grid grid-cols-3 gap-2 w-full mt-4 text-center">
                            <div class="bg-slate-50 p-2.5 rounded-xl border border-slate-100">
                                <i data-lucide="check" class="w-4 h-4 text-emerald-600 mx-auto mb-1"></i>
                                <span class="text-[10px] font-bold text-slate-700 block">100% Organik</span>
                            </div>
                            <div class="bg-slate-50 p-2.5 rounded-xl border border-slate-100">
                                <i data-lucide="shield" class="w-4 h-4 text-emerald-600 mx-auto mb-1"></i>
                                <span class="text-[10px] font-bold text-slate-700 block">Food Grade</span>
                            </div>
                            <div class="bg-slate-50 p-2.5 rounded-xl border border-slate-100">
                                <i data-lucide="truck" class="w-4 h-4 text-emerald-600 mx-auto mb-1"></i>
                                <span class="text-[10px] font-bold text-slate-700 block">Kirim Cepat</span>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Product Info & Order CTA -->
                    <div class="lg:col-span-7 space-y-6">
                        
                        <div>
                            @if($product->category)
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 mb-2">
                                    {{ $product->category->name }}
                                </span>
                            @endif
                            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 tracking-tight leading-tight">
                                {{ $product->name }}
                            </h1>
                        </div>

                        <!-- Price Section -->
                        <div class="bg-emerald-50/70 border border-emerald-200/80 p-4 rounded-2xl flex items-center justify-between">
                            <div>
                                <span class="text-xs text-emerald-800 font-semibold block">Perkiraan Harga Satuan</span>
                                <span class="text-2xl sm:text-3xl font-black text-emerald-700">{{ $product->formatted_price }}</span>
                            </div>
                            <span class="inline-flex items-center gap-1 text-xs font-bold text-emerald-800 bg-white px-3 py-1.5 rounded-xl shadow-xs border border-emerald-200">
                                <i data-lucide="check-circle" class="w-3.5 h-3.5 text-emerald-600"></i> Stok Tersedia
                            </span>
                        </div>

                        <!-- Summary -->
                        @if($product->summary)
                            <div class="text-sm font-medium text-slate-700 leading-relaxed bg-slate-50 p-4 rounded-xl border border-slate-100">
                                {{ $product->summary }}
                            </div>
                        @endif

                        <!-- Description -->
                        <div class="space-y-3">
                            <h3 class="text-sm font-bold uppercase tracking-wider text-slate-900 border-l-4 border-emerald-500 pl-2">
                                Deskripsi Produk
                            </h3>
                            <div class="text-sm text-slate-600 leading-relaxed space-y-2 whitespace-pre-line">
                                {{ $product->description }}
                            </div>
                        </div>

                        <!-- Product Specification / Details List -->
                        @if(!empty($product->details) && is_array($product->details))
                            <div class="space-y-3 pt-2">
                                <h3 class="text-sm font-bold uppercase tracking-wider text-slate-900 border-l-4 border-emerald-500 pl-2">
                                    Informasi & Spesifikasi
                                </h3>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    @foreach($product->details as $key => $val)
                                        @if(!empty($val))
                                            <div class="p-3 bg-slate-50 rounded-xl border border-slate-200/80">
                                                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">{{ $key }}</span>
                                                <span class="text-xs font-semibold text-slate-800 mt-0.5 block">{{ is_array($val) ? implode(', ', $val) : $val }}</span>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- WhatsApp Order Action -->
                        <div class="pt-4 border-t border-slate-200">
                            @php
                                $waNumber = $contact->clean_whatsapp ?: '6285871746229';
                                $orderMessage = "Halo Amidyas Superfood,\n\nSaya tertarik untuk memesan produk berikut:\n*Produk*: {$product->name}\n*Kategori*: " . ($product->category ? $product->category->name : '-') . "\n*Harga*: {$product->formatted_price}\n\nMohon info ketersediaan stok dan cara pemesanannya. Terima kasih!";
                                $waUrl = "https://wa.me/{$waNumber}?text=" . urlencode($orderMessage);
                            @endphp

                            <a href="{{ $waUrl }}" target="_blank" class="w-full flex items-center justify-center gap-3 bg-emerald-600 hover:bg-emerald-700 text-white py-4 px-6 rounded-2xl font-bold text-base shadow-lg hover:shadow-xl hover:shadow-emerald-600/20 transition-all duration-200 transform hover:-translate-y-0.5">
                                <i data-lucide="message-circle" class="w-6 h-6"></i>
                                <span>Pesan / Tanya Produk via WhatsApp</span>
                            </a>

                            @if(!empty($contact->custom_links) && count($contact->custom_links) > 1)
                                <div class="pt-4 mt-4 border-t border-slate-100">
                                    <span class="text-xs font-bold text-slate-700 block mb-2.5">Atau Pesan Melalui Platform Lainnya:</span>
                                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-2.5">
                                        @foreach($contact->custom_links as $cLink)
                                            @if(($cLink['platform'] ?? '') !== 'whatsapp')
                                                @php
                                                    $iconName = match(strtolower($cLink['platform'] ?? '')) {
                                                        'shopee', 'tokopedia' => 'shopping-bag',
                                                        'grabfood', 'gofood' => 'utensils',
                                                        'instagram' => 'instagram',
                                                        'facebook' => 'facebook',
                                                        'tiktok' => 'video',
                                                        default => 'external-link',
                                                    };
                                                @endphp
                                                <a href="{{ $cLink['url'] }}" target="_blank" class="flex items-center gap-2 p-2.5 rounded-xl bg-slate-50 hover:bg-slate-100 border border-slate-200 transition">
                                                    <i data-lucide="{{ $iconName }}" class="w-5 h-5 text-slate-600 shrink-0"></i>
                                                    <span class="text-xs font-bold text-slate-800 truncate">{{ $cLink['title'] }}</span>
                                                </a>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <p class="text-center text-xs text-slate-400 mt-3">
                                *Pemesanan diproses langsung melalui layanan pelanggan atau platform resmi Amidyas Superfood.
                            </p>
                        </div>

                    </div>

                </div>
            </div>

            <!-- Related Products Section -->
            @if($relatedProducts->count() > 0)
                <div class="mt-16">
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <span class="text-xs font-bold uppercase tracking-wider text-emerald-700 bg-emerald-100 px-3 py-1 rounded-full">Rekomendasi Lainnya</span>
                            <h2 class="text-2xl font-extrabold text-slate-900 mt-2">Produk Terkait</h2>
                        </div>
                        <a href="{{ route('products.index') }}" class="text-xs font-bold text-emerald-600 hover:underline flex items-center gap-1">
                            Lihat Semua <i data-lucide="chevron-right" class="w-4 h-4"></i>
                        </a>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($relatedProducts as $rel)
                            <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 flex flex-col group">
                                <div class="bg-slate-100 h-48 flex items-center justify-center p-4">
                                    <img src="{{ $rel->image_url }}" alt="{{ $rel->name }}" class="max-h-full object-contain group-hover:scale-105 transition-transform duration-300">
                                </div>
                                <div class="p-5 flex-1 flex flex-col justify-between">
                                    <div>
                                        <h4 class="font-bold text-slate-900 text-base group-hover:text-emerald-600 transition mb-1">
                                            <a href="{{ route('products.show', $rel->slug) }}">{{ $rel->name }}</a>
                                        </h4>
                                        <p class="text-xs text-slate-500 line-clamp-2">{{ $rel->summary ?? Str::limit($rel->description, 70) }}</p>
                                    </div>
                                    <div class="pt-3 mt-3 border-t border-slate-100 flex items-center justify-between">
                                        <span class="text-sm font-extrabold text-emerald-700">{{ $rel->formatted_price }}</span>
                                        <a href="{{ route('products.show', $rel->slug) }}" class="text-xs font-bold text-emerald-600 hover:underline">
                                            Lihat &rarr;
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </section>
@endsection