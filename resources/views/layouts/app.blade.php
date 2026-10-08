<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Chia by Amidyas Superfood - Pilihan Sehat Alami Setiap Hari')</title>
    <meta name="description" content="@yield('meta_description', 'Chia by Amidyas Superfood menyediakan biji chia organik premium dan ragam superfood murni berkualitas tinggi untuk gaya hidup sehat Anda.')">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="font-sans antialiased text-slate-800 bg-slate-50 min-h-screen flex flex-col selection:bg-emerald-500 selection:text-white" x-data="{ mobileMenuOpen: false }">

    <!-- Top Announcement Bar -->
    <div class="bg-emerald-800 text-emerald-50 py-2 px-4 text-xs sm:text-sm font-medium">
        <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between gap-2">
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-emerald-600 text-white">100% Organik</span>
                <span class="hidden sm:inline">Pilihan Superfood Murni Terbaik untuk Nutrisi Harian Anda</span>
            </div>
            <div class="flex items-center gap-4 ml-auto text-xs">
                @php
                    $sharedContact = \App\Models\Contact::first();
                @endphp
                <a href="{{ route('admin.login') }}" class="opacity-80 hover:opacity-100 hover:underline flex items-center gap-1">
                    <i data-lucide="lock" class="w-3.5 h-3.5"></i>
                    <span>Admin</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Main Navigation Header -->
    <header class="sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-slate-200 shadow-sm transition-all duration-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Logo & Brand Name -->
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo Chia by Amidyas" class="w-12 h-12 rounded-full object-cover shadow-sm ring-2 ring-emerald-500/20 group-hover:scale-105 transition duration-300">
                    <div>
                        <div class="text-xl sm:text-2xl font-extrabold tracking-tight text-slate-900 flex items-center">
                            <span>Chia</span>
                            <span class="text-xs ml-1.5 px-2 py-0.5 font-bold uppercase rounded-md bg-orange-100 text-orange-700 tracking-wider">Superfood</span>
                        </div>
                        <p class="text-xs font-semibold text-emerald-700 tracking-wide">by Amidyas</p>
                    </div>
                </a>

                <!-- Desktop Menu -->
                <nav class="hidden md:flex items-center space-x-1 lg:space-x-2">
                    <a href="{{ route('home') }}" class="px-4 py-2 rounded-lg text-sm font-semibold transition {{ request()->routeIs('home') ? 'text-emerald-700 bg-emerald-50' : 'text-slate-600 hover:text-emerald-600 hover:bg-slate-50' }}">
                        Home
                    </a>
                    <a href="{{ route('products.index') }}" class="px-4 py-2 rounded-lg text-sm font-semibold transition {{ request()->routeIs('products.*') ? 'text-emerald-700 bg-emerald-50' : 'text-slate-600 hover:text-emerald-600 hover:bg-slate-50' }}">
                        Katalog Produk
                    </a>
                    <a href="{{ route('about') }}" class="px-4 py-2 rounded-lg text-sm font-semibold transition {{ request()->routeIs('about') ? 'text-emerald-700 bg-emerald-50' : 'text-slate-600 hover:text-emerald-600 hover:bg-slate-50' }}">
                        Tentang Kami
                    </a>
                    <a href="{{ route('contact') }}" class="px-4 py-2 rounded-lg text-sm font-semibold transition {{ request()->routeIs('contact') ? 'text-emerald-700 bg-emerald-50' : 'text-slate-600 hover:text-emerald-600 hover:bg-slate-50' }}">
                        Kontak & Lokasi
                    </a>
                </nav>

                

                <!-- Mobile Hamburger Button -->
                <div class="flex md:hidden">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" type="button" class="p-2.5 rounded-lg text-slate-700 hover:bg-slate-100 focus:outline-none" aria-label="Toggle Menu">
                        <i x-show="!mobileMenuOpen" data-lucide="menu" class="w-6 h-6"></i>
                        <i x-show="mobileMenuOpen" data-lucide="x" class="w-6 h-6" style="display: none;"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Drawer Navigation -->
        <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2" class="md:hidden border-b border-slate-200 bg-white px-4 pt-2 pb-6 space-y-2 shadow-xl" style="display: none;">
            <a href="{{ route('home') }}" class="block px-4 py-3 rounded-lg text-base font-semibold {{ request()->routeIs('home') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-700 hover:bg-slate-50' }}">
                Home (Beranda)
            </a>
            <a href="{{ route('products.index') }}" class="block px-4 py-3 rounded-lg text-base font-semibold {{ request()->routeIs('products.*') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-700 hover:bg-slate-50' }}">
                Katalog Produk
            </a>
            <a href="{{ route('about') }}" class="block px-4 py-3 rounded-lg text-base font-semibold {{ request()->routeIs('about') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-700 hover:bg-slate-50' }}">
                Tentang Kami
            </a>
            <a href="{{ route('contact') }}" class="block px-4 py-3 rounded-lg text-base font-semibold {{ request()->routeIs('contact') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-700 hover:bg-slate-50' }}">
                Kontak & Lokasi
            </a>
            
            <div class="pt-4 border-t border-slate-100 flex flex-col gap-2">
                @if($sharedContact && $sharedContact->whatsapp)
                    <a href="https://wa.me/{{ $sharedContact->clean_whatsapp }}?text={{ urlencode('Halo Amidyas Superfood, saya ingin bertanya seputar produk.') }}" target="_blank" class="w-full text-center flex items-center justify-center gap-2 bg-emerald-600 text-white py-3 rounded-xl font-bold shadow-md">
                        <i data-lucide="message-circle" class="w-5 h-5"></i>
                        <span>Konsultasi WhatsApp</span>
                    </a>
                @endif
                <a href="{{ route('admin.login') }}" class="text-center text-xs text-slate-500 py-2 hover:underline">
                    Portal Login Admin
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer Section -->
    <footer class="bg-slate-900 text-slate-300 pt-16 pb-12 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 lg:gap-12">
                
                <!-- Col 1: Brand & Tagline -->
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('images/logo.png') }}" alt="Chia by Amidyas" class="w-12 h-12 rounded-full bg-white p-1">
                        <div>
                            <span class="text-xl font-extrabold text-white tracking-tight">Chia Superfood</span>
                            <p class="text-xs font-semibold text-emerald-400">by Amidyas</p>
                        </div>
                    </div>
                    @php
                        $sharedCompany = \App\Models\CompanyProfile::first();
                    @endphp
                    <p class="text-sm text-slate-400 leading-relaxed">
                        {{ $sharedCompany->tagline ?? 'Kebaikan Alam untuk Hidup Lebih Sehat & Berenergi.' }}
                    </p>
                    
                    <!-- DAFTAR INFO KONTAK & SOSIAL MEDIA -->
                    <div class="flex flex-col gap-3 pt-4">
                        @if(!empty($sharedContact->custom_links))
                            @foreach($sharedContact->custom_links as $sLink)
                                <a href="{{ $sLink['url'] }}" target="_blank" class="flex items-center gap-2 text-sm text-slate-400 hover:text-emerald-400 transition" title="{{ $sLink['title'] }}">
                                    @php
                                        $iconName = match(strtolower($sLink['platform'] ?? '')) {
                                            'whatsapp' => 'message-circle',
                                            'shopee', 'tokopedia' => 'shopping-bag',
                                            'grabfood', 'gofood' => 'utensils',
                                            'instagram' => 'instagram',
                                            'facebook' => 'facebook',
                                            'tiktok' => 'video',
                                            default => 'external-link',
                                        };
                                    @endphp
                                    <i data-lucide="{{ $iconName }}" class="w-4 h-4"></i>
                                    <span>{{ $sLink['title'] }}</span>
                                </a>
                            @endforeach
                        @else
                            @if($sharedContact && $sharedContact->whatsapp)
                                <a href="https://wa.me/{{ $sharedContact->clean_whatsapp }}" target="_blank" class="flex items-center gap-2 text-sm text-slate-400 hover:text-emerald-400 transition" title="WhatsApp">
                                    <i data-lucide="message-circle" class="w-4 h-4"></i>
                                    <span>WhatsApp</span>
                                </a>
                            @endif
                        @endif

                        @if($sharedContact && $sharedContact->instagram)
                            <a href="{{ $sharedContact->instagram }}" target="_blank" class="flex items-center gap-2 text-sm text-slate-400 hover:text-emerald-400 transition" title="Instagram">
                                <i data-lucide="instagram" class="w-4 h-4"></i>
                                <span>Instagram</span>
                            </a>
                        @endif
                        @if($sharedContact && $sharedContact->facebook)
                            <a href="{{ $sharedContact->facebook }}" target="_blank" class="flex items-center gap-2 text-sm text-slate-400 hover:text-emerald-400 transition" title="Facebook">
                                <i data-lucide="facebook" class="w-4 h-4"></i>
                                <span>Facebook</span>
                            </a>
                        @endif
                        @if($sharedContact && $sharedContact->tiktok)
                            <a href="{{ $sharedContact->tiktok }}" target="_blank" class="flex items-center gap-2 text-sm text-slate-400 hover:text-emerald-400 transition" title="TikTok">
                                <i data-lucide="video" class="w-4 h-4"></i>
                                <span>TikTok</span>
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Col 2: Navigasi Cepat -->
                <div>
                    <h3 class="text-white text-sm font-bold uppercase tracking-wider mb-4 border-l-4 border-emerald-500 pl-2">Navigasi</h3>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="{{ route('home') }}" class="hover:text-emerald-400 transition flex items-center gap-1.5"><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-emerald-500"></i> Beranda</a></li>
                        <li><a href="{{ route('products.index') }}" class="hover:text-emerald-400 transition flex items-center gap-1.5"><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-emerald-500"></i> Katalog Produk</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-emerald-400 transition flex items-center gap-1.5"><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-emerald-500"></i> Tentang Perusahaan</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-emerald-400 transition flex items-center gap-1.5"><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-emerald-500"></i> Kontak & Peta Lokasi</a></li>
                        <li><a href="{{ route('admin.login') }}" class="hover:text-emerald-400 transition flex items-center gap-1.5 text-slate-400"><i data-lucide="lock" class="w-3.5 h-3.5 text-slate-500"></i> Login Admin</a></li>
                    </ul>
                </div>

                <!-- Col 3: Kategori Unggulan -->
                <div>
                    <h3 class="text-white text-sm font-bold uppercase tracking-wider mb-4 border-l-4 border-emerald-500 pl-2">Kategori Superfood</h3>
                    @php
                        $sharedCategories = \App\Models\Category::where('is_active', true)->take(5)->get();
                    @endphp
                    <ul class="space-y-2.5 text-sm">
                        @foreach($sharedCategories as $cat)
                            <li>
                                <a href="{{ route('products.index', ['kategori' => $cat->slug]) }}" class="hover:text-emerald-400 transition flex items-center gap-1.5">
                                    <i data-lucide="tag" class="w-3.5 h-3.5 text-emerald-500"></i>
                                    {{ $cat->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Col 4: Hubungi Kami -->
                <div>
                    <h3 class="text-white text-sm font-bold uppercase tracking-wider mb-4 border-l-4 border-emerald-500 pl-2">Alamat & Kontak</h3>
                    <div class="space-y-3 text-sm text-slate-400">
                        @if($sharedContact)
                            <div class="flex items-start gap-2.5">
                                <i data-lucide="map-pin" class="w-4 h-4 text-emerald-400 shrink-0 mt-1"></i>
                                <span>{{ $sharedContact->address ?? 'Jakarta, Indonesia' }}</span>
                            </div>
                            <div class="flex items-center gap-2.5">
                                <i data-lucide="phone" class="w-4 h-4 text-emerald-400 shrink-0"></i>
                                <span>{{ $sharedContact->phone ?? '+62 858-7174-6229' }}</span>
                            </div>
                            <div class="flex items-center gap-2.5">
                                <i data-lucide="mail" class="w-4 h-4 text-emerald-400 shrink-0"></i>
                                <a href="mailto:{{ $sharedContact->email ?? 'natabintang24@gmail.com' }}" class="hover:text-white transition">
                                    {{ $sharedContact->email ?? 'natabintang24@gmail.com' }}
                                </a>
                            </div>
                            <div class="flex items-start gap-2.5">
                                <i data-lucide="clock" class="w-4 h-4 text-emerald-400 shrink-0 mt-0.5"></i>
                                <span class="text-xs">{{ $sharedContact->operational_hours ?? 'Senin - Sabtu: 08.00 - 17.00 WIB' }}</span>
                            </div>
                        @endif
                    </div>
                </div>

            </div>

            <!-- Bottom Copyright -->
            <div class="mt-12 pt-8 border-t border-slate-800 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-400">
                <p>&copy; {{ date('Y') }} <strong>Chia by Amidyas Superfood</strong>. All rights reserved.</p>
                <p class="flex items-center gap-1">
                    <span>Dikembangkan oleh Nathapradja Bintang Ramadhany (SMK SKYE DIGIPRENEUR)</span>
                </p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>