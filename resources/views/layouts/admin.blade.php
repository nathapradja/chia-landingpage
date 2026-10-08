<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Dashboard') - Chia by Amidyas Superfood</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="h-full font-sans antialiased text-slate-800" x-data="{ sidebarOpen: false }">

    <div class="min-h-full flex">
        
        <!-- Mobile Sidebar Backdrop -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 z-40 bg-slate-900/60 backdrop-blur-sm lg:hidden" style="display: none;"></div>

        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'" class="fixed inset-y-0 left-0 z-50 w-64 bg-slate-900 text-slate-300 flex flex-col transition-transform duration-300 ease-in-out lg:static lg:translate-x-0">
            <!-- Sidebar Header -->
            <div class="h-20 flex items-center justify-between px-6 bg-slate-950 border-b border-slate-800">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-10 h-10 rounded-full bg-white p-0.5">
                    <div>
                        <span class="font-black text-white text-base tracking-tight block">Panel Admin</span>
                        <span class="text-xs text-emerald-400 font-semibold block">Chia Amidyas</span>
                    </div>
                </a>
                <button @click="sidebarOpen = false" class="lg:hidden text-slate-400 hover:text-white p-1">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <!-- Navigation Links -->
            <div class="flex-1 overflow-y-auto py-6 px-4 space-y-1.5">
                <div class="px-3 pb-2 text-[11px] font-bold uppercase tracking-wider text-slate-300">Menu Utama</div>

                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-sm transition {{ request()->routeIs('admin.dashboard') ? 'bg-emerald-600 text-white shadow-md' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
                    <span>Dashboard</span>
                </a>

                <div class="pt-4 px-3 pb-2 text-[11px] font-bold uppercase tracking-wider text-slate-300">Katalog & Promo</div>

                <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-sm transition {{ request()->routeIs('admin.products.*') ? 'bg-emerald-600 text-white shadow-md' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <i data-lucide="package" class="w-4 h-4"></i>
                    <span>Kelola Produk</span>
                </a>

                <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-sm transition {{ request()->routeIs('admin.categories.*') ? 'bg-emerald-600 text-white shadow-md' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <i data-lucide="folder-tree" class="w-4 h-4"></i>
                    <span>Kelola Kategori</span>
                </a>

                <a href="{{ route('admin.promos.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-sm transition {{ request()->routeIs('admin.promos.*') ? 'bg-emerald-600 text-white shadow-md' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <i data-lucide="megaphone" class="w-4 h-4"></i>
                    <span>Promo & Banner</span>
                </a>

                <div class="pt-4 px-3 pb-2 text-[11px] font-bold uppercase tracking-wider text-slate-300">Pengaturan Web</div>

                <a href="{{ route('admin.company.edit') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-sm transition {{ request()->routeIs('admin.company.*') ? 'bg-emerald-600 text-white shadow-md' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <i data-lucide="building-2" class="w-4 h-4"></i>
                    <span>Profil Perusahaan</span>
                </a>

                <a href="{{ route('admin.contact.edit') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-sm transition {{ request()->routeIs('admin.contact.*') ? 'bg-emerald-600 text-white shadow-md' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <i data-lucide="phone-call" class="w-4 h-4"></i>
                    <span>Kontak & Lokasi</span>
                </a>

                <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-sm transition {{ request()->routeIs('admin.users.*') ? 'bg-emerald-600 text-white shadow-md' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <i data-lucide="users" class="w-4 h-4"></i>
                    <span>Kelola Akun Admin</span>
                </a>
            </div>

            <!-- Sidebar Footer & Logout -->
            <div class="p-4 bg-slate-950 border-t border-slate-800 flex items-center justify-between">
                <div class="flex items-center gap-3 truncate">
                    <div class="w-9 h-9 rounded-full bg-emerald-700 text-white flex items-center justify-center font-bold text-sm shrink-0">
                        {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <div class="truncate text-xs">
                        <p class="font-bold text-white truncate">{{ Auth::user()->name ?? 'Admin' }}</p>
                        <p class="text-slate-300 truncate">{{ Auth::user()->email ?? '' }}</p>
                    </div>
                </div>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" title="Logout" class="p-2 text-slate-400 hover:text-red-400 transition hover:bg-slate-900 rounded-lg">
                        <i data-lucide="log-out" class="w-4 h-4"></i>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content Wrapper -->
        <div class="flex-1 flex flex-col min-w-0">
            
            <!-- Topbar -->
            <header class="h-20 bg-white border-b border-slate-200 px-4 sm:px-8 flex items-center justify-between sticky top-0 z-30 shadow-sm">
                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = true" class="lg:hidden p-2 text-slate-600 hover:text-slate-900 rounded-lg hover:bg-slate-100">
                        <i data-lucide="menu" class="w-6 h-6"></i>
                    </button>
                    <div>
                        <h1 class="text-lg sm:text-xl font-bold text-slate-900">@yield('page_title', 'Dashboard')</h1>
                        <p class="text-xs text-slate-500 hidden sm:block">@yield('page_subtitle', 'Kelola informasi dan konten website Chia by Amidyas')</p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <a href="{{ route('home') }}" target="_blank" class="inline-flex items-center gap-2 text-xs font-semibold px-4 py-2 rounded-lg bg-emerald-50 text-emerald-700 hover:bg-emerald-100 border border-emerald-200 transition">
                        <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
                        <span>Lihat Website</span>
                    </a>
                </div>
            </header>

            <!-- Alerts / Flash Messages -->
            <main class="flex-1 p-4 sm:p-6 lg:p-8 overflow-y-auto">
                @if(session('success'))
                    <div x-data="{ show: true }" x-show="show" class="mb-6 flex items-center justify-between p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 shadow-sm">
                        <div class="flex items-center gap-3">
                            <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-600 shrink-0"></i>
                            <span class="text-sm font-medium">{{ session('success') }}</span>
                        </div>
                        <button @click="show = false" class="text-emerald-500 hover:text-emerald-800">
                            <i data-lucide="x" class="w-4 h-4"></i>
                        </button>
                    </div>
                @endif

                @if(session('error'))
                    <div x-data="{ show: true }" x-show="show" class="mb-6 flex items-center justify-between p-4 rounded-xl bg-red-50 border border-red-200 text-red-800 shadow-sm">
                        <div class="flex items-center gap-3">
                            <i data-lucide="alert-triangle" class="w-5 h-5 text-red-600 shrink-0"></i>
                            <span class="text-sm font-medium">{{ session('error') }}</span>
                        </div>
                        <button @click="show = false" class="text-red-500 hover:text-red-800">
                            <i data-lucide="x" class="w-4 h-4"></i>
                        </button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-800 shadow-sm">
                        <div class="flex items-center gap-2 font-bold text-sm mb-1 text-red-900">
                            <i data-lucide="alert-circle" class="w-4 h-4 text-red-600"></i>
                            <span>Terdapat beberapa kesalahan input:</span>
                        </div>
                        <ul class="list-disc list-inside text-xs space-y-1 text-red-700">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
