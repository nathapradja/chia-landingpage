@extends('layouts.app')

@section('title', 'Tentang Kami - Chia by Amidyas Superfood')
@section('meta_description', 'Kenali dedikasi Chia by Amidyas Superfood dalam menghadirkan ragam nutrisi dan superfood berkualitas murni untuk kesehatan keluarga Anda.')

@section('content')
    <!-- Header Banner -->
    <section class="bg-gradient-to-r from-emerald-800 via-emerald-700 to-teal-800 text-white py-14 sm:py-20 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <span class="inline-block px-3.5 py-1 bg-white/20 backdrop-blur-md rounded-full text-xs font-bold uppercase tracking-wider mb-3">
                Mengenal Lebih Dekat
            </span>
            <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight">Tentang Amidyas Superfood</h1>
            <p class="text-emerald-100 text-sm sm:text-base max-w-2xl mx-auto mt-3">
                {{ $company->tagline ?? 'Kebaikan Alam untuk Hidup Lebih Sehat & Berenergi' }}
            </p>
        </div>
    </section>

    <!-- Company Story & Profile Section -->
    <section class="py-16 sm:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
                
                <!-- Left: Image Showcase -->
                <div class="lg:col-span-5 flex justify-center">
                    <div class="relative w-full max-w-md">
                        <div class="absolute inset-0 bg-emerald-100 rounded-3xl transform -rotate-3 scale-102"></div>
                        <div class="relative bg-white rounded-3xl p-8 border border-slate-200 shadow-xl text-center">
                            @if($company->image)
                                <img src="{{ $company->image_url }}" alt="{{ $company->company_name }}" class="w-full max-h-72 object-contain rounded-2xl mb-6">
                            @else
                                <div class="w-44 h-44 mx-auto mb-6 bg-emerald-50 rounded-full p-4 flex items-center justify-center">
                                    <img src="{{ asset('images/logo.png') }}" alt="{{ $company->company_name }}" class="w-36 h-36 object-contain">
                                </div>
                            @endif
                            <h3 class="text-xl font-extrabold text-slate-900">{{ $company->company_name }}</h3>
                            <p class="text-xs font-bold text-emerald-600 uppercase tracking-widest mt-1">Superfood Specialist</p>
                        </div>
                    </div>
                </div>

                <!-- Right: Profile Narrative -->
                <div class="lg:col-span-7 space-y-6">
                    <span class="text-xs font-bold uppercase tracking-wider text-emerald-700 bg-emerald-100 px-3 py-1 rounded-full">
                        Cerita & Filosofi Kami
                    </span>
                    <h2 class="text-2xl sm:text-4xl font-extrabold text-slate-900 leading-tight">
                        Nutrisi Murni untuk Kehidupan yang Lebih Berkualitas
                    </h2>
                    
                    <div class="text-slate-600 text-sm sm:text-base leading-relaxed space-y-4 whitespace-pre-line">
                        {{ $company->about_us ?? $company->short_description }}
                    </div>

                    <div class="pt-4 flex items-center gap-6 border-t border-slate-200">
                        <div>
                            <span class="text-2xl font-black text-emerald-700">100%</span>
                            <span class="text-xs text-slate-500 block font-medium">Bahan Alami</span>
                        </div>
                        <div class="border-l border-slate-200 pl-6">
                            <span class="text-2xl font-black text-emerald-700">0%</span>
                            <span class="text-xs text-slate-500 block font-medium">Bahan Kimia Pengawet</span>
                        </div>
                        <div class="border-l border-slate-200 pl-6">
                            <span class="text-2xl font-black text-emerald-700">Grade A</span>
                            <span class="text-xs text-slate-500 block font-medium">Kualitas Terjamin</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Vision & Mission Section -->
    <section class="py-16 bg-slate-50 border-y border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <!-- Vision Card -->
                <div class="bg-white rounded-3xl p-8 sm:p-10 border border-slate-200 shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-700 flex items-center justify-center mb-6">
                            <i data-lucide="eye" class="w-6 h-6"></i>
                        </div>
                        <h3 class="text-xl font-extrabold text-slate-900 mb-3">Visi Perusahaan</h3>
                        <p class="text-sm text-slate-600 leading-relaxed whitespace-pre-line">
                            {{ $company->vision ?? 'Menjadi pelopor gaya hidup sehat berbasis superfood alami terdepan di Indonesia.' }}
                        </p>
                    </div>
                </div>

                <!-- Mission Card -->
                <div class="bg-white rounded-3xl p-8 sm:p-10 border border-slate-200 shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-orange-100 text-orange-700 flex items-center justify-center mb-6">
                            <i data-lucide="target" class="w-6 h-6"></i>
                        </div>
                        <h3 class="text-xl font-extrabold text-slate-900 mb-3">Misi Perusahaan</h3>
                        <div class="text-sm text-slate-600 leading-relaxed space-y-2 whitespace-pre-line">
                            {{ $company->mission ?? '1. Menyediakan superfood bermutu tinggi. 2. Mengedukasi gaya hidup sehat alami.' }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Values & Advantages Section -->
    <section class="py-16 sm:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-12">
                <span class="text-xs font-bold uppercase tracking-wider text-emerald-700 bg-emerald-100 px-3 py-1 rounded-full">Prinsip Kami</span>
                <h2 class="text-2xl sm:text-4xl font-extrabold text-slate-900 mt-2">Nilai & Keunggulan Produk</h2>
                <p class="text-sm text-slate-500 mt-2">Standar ketat yang kami pegang teguh dalam setiap produk yang kami hadirkan untuk Anda.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @if(!empty($company->values) && is_array($company->values))
                    @foreach($company->values as $index => $val)
                        <div class="p-6 rounded-2xl bg-slate-50 hover:bg-emerald-50/70 border border-slate-200 hover:border-emerald-300 transition-all duration-300 flex flex-col justify-between">
                            <div>
                                <div class="w-10 h-10 rounded-xl bg-emerald-600 text-white flex items-center justify-center font-bold text-sm mb-4">
                                    0{{ $index + 1 }}
                                </div>
                                <h3 class="font-bold text-slate-900 text-base mb-2">{{ $val['title'] ?? '' }}</h3>
                                <p class="text-xs text-slate-600 leading-relaxed">{{ $val['desc'] ?? '' }}</p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200">
                        <h4 class="font-bold text-slate-900 text-base mb-2">100% Organik</h4>
                        <p class="text-xs text-slate-600">Bahan pilihan tanpa pengawet sintetis.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-emerald-700 text-white text-center">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <h2 class="text-2xl sm:text-4xl font-extrabold">Tertarik Bermitra atau Mencoba Produk Kami?</h2>
            <p class="text-emerald-100 text-sm sm:text-base max-w-xl mx-auto">
                Hubungi tim kami untuk konsultasi kesehatan, pemesanan eceran, maupun pasokan rutin superfood untuk usaha Anda.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-2">
                <a href="{{ route('products.index') }}" class="w-full sm:w-auto px-8 py-3.5 rounded-full bg-white text-emerald-800 font-bold text-sm hover:bg-emerald-50 transition shadow-md">
                    Lihat Katalog Produk
                </a>
                <a href="{{ route('contact') }}" class="w-full sm:w-auto px-8 py-3.5 rounded-full bg-orange-500 hover:bg-orange-600 text-white font-bold text-sm transition shadow-md">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </section>
@endsection
