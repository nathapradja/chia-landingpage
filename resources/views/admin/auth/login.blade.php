<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-900">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Administrator - Chia by Amidyas Superfood</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full flex items-center justify-center p-4 sm:p-6 bg-slate-950 font-sans relative overflow-hidden">
    
    <!-- Ambient glowing backgrounds -->
    <div class="absolute -top-40 -left-40 w-96 h-96 bg-emerald-600/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-orange-600/20 rounded-full blur-3xl pointer-events-none"></div>

    <div class="w-full max-w-md relative z-10">
        
        <!-- Login Card -->
        <div class="bg-slate-900 border border-slate-800 rounded-3xl p-8 sm:p-10 shadow-2xl">
            
            <!-- Brand Logo & Header -->
            <div class="text-center mb-8">
                <a href="{{ route('home') }}" class="inline-block group mb-3">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo Chia" class="w-16 h-16 mx-auto rounded-full bg-white p-1 shadow-lg ring-4 ring-emerald-500/20 group-hover:scale-105 transition duration-200">
                </a>
                <h1 class="text-2xl font-extrabold text-white tracking-tight">Login Administrator</h1>
                <p class="text-xs text-slate-400 mt-1 font-medium">Chia by Amidyas Superfood Backoffice</p>
            </div>

            <!-- Alerts -->
            @if(session('success'))
                <div class="mb-6 p-3 rounded-xl bg-emerald-950/80 border border-emerald-800 text-emerald-300 text-xs flex items-center gap-2">
                    <i data-lucide="check-circle" class="w-4 h-4 shrink-0 text-emerald-400"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 p-3 rounded-xl bg-red-950/80 border border-red-800 text-red-300 text-xs space-y-1">
                    @foreach ($errors->all() as $error)
                        <div class="flex items-center gap-2">
                            <i data-lucide="alert-circle" class="w-4 h-4 shrink-0 text-red-400"></i>
                            <span>{{ $error }}</span>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Form -->
            <form action="{{ route('admin.login.post') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">
                        Alamat Email
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                            <i data-lucide="mail" class="w-4 h-4"></i>
                        </div>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="admin@chia.com" class="w-full pl-10 pr-4 py-3 rounded-xl bg-slate-800/80 border border-slate-700 text-white placeholder-slate-500 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">
                        Kata Sandi
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                            <i data-lucide="lock" class="w-4 h-4"></i>
                        </div>
                        <input id="password" type="password" name="password" required placeholder="••••••••" class="w-full pl-10 pr-4 py-3 rounded-xl bg-slate-800/80 border border-slate-700 text-white placeholder-slate-500 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition">
                    </div>
                </div>

                <div class="flex items-center justify-between text-xs text-slate-400">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded bg-slate-800 border-slate-700 text-emerald-600 focus:ring-emerald-500">
                        <span>Ingat saya</span>
                    </label>
                    <span class="text-[11px] text-slate-500">Akses terbatas</span>
                </div>

                <button type="submit" class="w-full flex items-center justify-center gap-2 bg-emerald-600 hover:bg-emerald-500 text-white font-bold py-3.5 px-4 rounded-xl shadow-lg hover:shadow-emerald-600/30 transition text-sm">
                    <i data-lucide="log-in" class="w-4 h-4"></i>
                    <span>Masuk ke Dashboard</span>
                </button>
            </form>

            <div class="mt-8 pt-6 border-t border-slate-800 text-center">
                <a href="{{ route('home') }}" class="text-xs text-slate-400 hover:text-emerald-400 transition flex items-center justify-center gap-1.5">
                    <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
                    <span>Kembali ke Halaman Utama</span>
                </a>
            </div>

        </div>

    </div>

</body>
</html>
