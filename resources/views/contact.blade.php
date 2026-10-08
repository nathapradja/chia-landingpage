@extends('layouts.app')

@section('title', 'Kontak & Pemesanan - Chia by Amidyas Superfood')
@section('meta_description', 'Hubungi kami via WhatsApp, Shopee, GrabFood, GoFood, atau kunjungi kantor kami untuk pemesanan chia seeds dan ragam superfood berkualitas.')

@section('content')
    <!-- Header Banner -->
    <section class="bg-gradient-to-r from-emerald-800 via-emerald-700 to-teal-800 text-white py-14 sm:py-20 text-center">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <span class="inline-block px-3.5 py-1 bg-white/20 backdrop-blur-md rounded-full text-xs font-bold uppercase tracking-wider mb-3">
                Terhubung Bersama Kami
            </span>
            <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight">Kontak & Pemesanan</h1>
            <p class="text-emerald-100 text-sm sm:text-base max-w-2xl mx-auto mt-3">
                Pilih saluran komunikasi atau platform pemesanan favorit Anda untuk mendapatkan produk superfood segar dan murni.
            </p>
        </div>
    </section>

    <!-- Platform Pemesanan & Chat Online (Text-only pill links) -->
    <section class="py-12 bg-white border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-10">
                <span class="text-xs font-bold uppercase tracking-wider text-emerald-700 bg-emerald-100 px-3 py-1 rounded-full">Kanal Pemesanan & Chat</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-2">Hubungi / Pesan Melalui Platform</h2>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">Klik salah satu platform di bawah ini untuk terhubung langsung dengan kami.</p>
            </div>

            @php
                $customLinks = $contact->custom_links ?? [];
            @endphp

            @if(!empty($customLinks) && count($customLinks) > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($customLinks as $item)
                        @php
                            $platform = strtolower($item['platform'] ?? 'other');
                            $borderColor = match($platform) {
                                'whatsapp' => 'hover:border-emerald-500 hover:ring-2 hover:ring-emerald-500/20',
                                'grabfood' => 'hover:border-green-600 hover:ring-2 hover:ring-green-500/20',
                                'gofood'   => 'hover:border-red-500 hover:ring-2 hover:ring-red-500/20',
                                'shopee'   => 'hover:border-orange-500 hover:ring-2 hover:ring-orange-500/20',
                                default    => 'hover:border-emerald-500',
                            };
                            $accentText = match($platform) {
                                'whatsapp' => 'text-emerald-700 group-hover:text-emerald-800',
                                'grabfood' => 'text-green-700 group-hover:text-green-800',
                                'gofood'   => 'text-red-600 group-hover:text-red-700',
                                'shopee'   => 'text-orange-600 group-hover:text-orange-700',
                                default    => 'text-emerald-700 group-hover:text-emerald-800',
                            };
                            $accentBg = match($platform) {
                                'whatsapp' => 'bg-emerald-50 group-hover:bg-emerald-100/70',
                                'grabfood' => 'bg-green-50 group-hover:bg-green-100/70',
                                'gofood'   => 'bg-red-50 group-hover:bg-red-100/70',
                                'shopee'   => 'bg-orange-50 group-hover:bg-orange-100/70',
                                default    => 'bg-slate-100 group-hover:bg-emerald-50/70',
                            };
                        @endphp
                        <a href="{{ $item['url'] }}" target="_blank"
                           class="group p-6 rounded-3xl bg-slate-50 border border-slate-200/90 {{ $borderColor }} transition-all duration-300 shadow-sm hover:shadow-xl hover:-translate-y-1 flex flex-col justify-between">
                            <div>
                                <div class="flex items-center justify-between mb-4">
                                    <span class="inline-block px-4 py-2 rounded-2xl font-extrabold text-base tracking-wide {{ $accentBg }} {{ $accentText }} transition">
                                        {{ $item['title'] }}
                                    </span>
                                    @if(!empty($item['badge']))
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-wide bg-emerald-100 text-emerald-800">
                                            {{ $item['badge'] }}
                                        </span>
                                    @endif
                                </div>
                                <p class="text-xs text-slate-400">Klik untuk membuka tautan resmi</p>
                            </div>
                            <div class="pt-4 mt-4 border-t border-slate-200/60 flex items-center justify-between text-xs font-bold {{ $accentText }}">
                                <span>Buka Layanan</span>
                                <i data-lucide="external-link" class="w-4 h-4 transform group-hover:translate-x-0.5 transition"></i>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <!-- Default 4 Platform fallback cards if not set -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- WhatsApp -->
                    <a href="https://wa.me/{{ $contact->clean_whatsapp ?: '6285871746229' }}?text=Halo%20Amidyas%20Superfood" target="_blank" class="group p-6 rounded-3xl bg-slate-50 border border-slate-200 hover:border-emerald-500 hover:ring-2 hover:ring-emerald-500/20 transition-all duration-300 shadow-sm hover:shadow-xl hover:-translate-y-1 flex flex-col justify-between">
                        <div>
                            <div class="w-14 h-14 rounded-2xl bg-white p-2.5 shadow-sm border border-slate-100 flex items-center justify-center mb-4">
                                <i data-lucide="message-circle" class="w-8 h-8 text-emerald-500"></i>
                            </div>
                            <h3 class="font-extrabold text-slate-900 text-base">WhatsApp CS</h3>
                            <p class="text-xs text-slate-500 mt-1">Konsultasi & Tanya Produk</p>
                        </div>
                        <div class="pt-4 mt-4 border-t border-slate-200/60 flex items-center justify-between text-xs font-bold text-emerald-700">
                            <span>Chat Sekarang</span>
                            <i data-lucide="arrow-up-right" class="w-4 h-4"></i>
                        </div>
                    </a>

                    <!-- Shopee -->
                    <a href="{{ $contact->custom_links[1]['url'] ?? 'https://shopee.co.id' }}" target="_blank" class="group p-6 rounded-3xl bg-slate-50 border border-slate-200 hover:border-orange-500 hover:ring-2 hover:ring-orange-500/20 transition-all duration-300 shadow-sm hover:shadow-xl hover:-translate-y-1 flex flex-col justify-between">
                        <div>
                            <div class="w-14 h-14 rounded-2xl bg-white p-2.5 shadow-sm border border-slate-100 flex items-center justify-center mb-4">
                                <i data-lucide="shopping-bag" class="w-8 h-8 text-orange-500"></i>
                            </div>
                            <h3 class="font-extrabold text-slate-900 text-base">Shopee Official</h3>
                            <p class="text-xs text-slate-500 mt-1">Toko Resmi & Gratis Ongkir</p>
                        </div>
                        <div class="pt-4 mt-4 border-t border-slate-200/60 flex items-center justify-between text-xs font-bold text-orange-600">
                            <span>Belanja di Shopee</span>
                            <i data-lucide="arrow-up-right" class="w-4 h-4"></i>
                        </div>
                    </a>

                    <!-- GrabFood -->
                    <a href="{{ $contact->custom_links[2]['url'] ?? 'https://food.grab.com' }}" target="_blank" class="group p-6 rounded-3xl bg-slate-50 border border-slate-200 hover:border-green-600 hover:ring-2 hover:ring-green-500/20 transition-all duration-300 shadow-sm hover:shadow-xl hover:-translate-y-1 flex flex-col justify-between">
                        <div>
                            <div class="w-14 h-14 rounded-2xl bg-white p-2.5 shadow-sm border border-slate-100 flex items-center justify-center mb-4">
                                <i data-lucide="utensils" class="w-8 h-8 text-green-600"></i>
                            </div>
                            <h3 class="font-extrabold text-slate-900 text-base">GrabFood Delivery</h3>
                            <p class="text-xs text-slate-500 mt-1">Pesan Instan Siap Antar</p>
                        </div>
                        <div class="pt-4 mt-4 border-t border-slate-200/60 flex items-center justify-between text-xs font-bold text-green-700">
                            <span>Pesan via Grab</span>
                            <i data-lucide="arrow-up-right" class="w-4 h-4"></i>
                        </div>
                    </a>

                    <!-- GoFood -->
                    <a href="{{ $contact->custom_links[3]['url'] ?? 'https://gofood.co.id' }}" target="_blank" class="group p-6 rounded-3xl bg-slate-50 border border-slate-200 hover:border-red-500 hover:ring-2 hover:ring-red-500/20 transition-all duration-300 shadow-sm hover:shadow-xl hover:-translate-y-1 flex flex-col justify-between">
                        <div>
                            <div class="w-14 h-14 rounded-2xl bg-white p-2.5 shadow-sm border border-slate-100 flex items-center justify-center mb-4">
                                <i data-lucide="utensils" class="w-8 h-8 text-red-500"></i>
                            </div>
                            <h3 class="font-extrabold text-slate-900 text-base">GoFood Delivery</h3>
                            <p class="text-xs text-slate-500 mt-1">Superfood Cepat Sampai</p>
                        </div>
                        <div class="pt-4 mt-4 border-t border-slate-200/60 flex items-center justify-between text-xs font-bold text-red-600">
                            <span>Pesan via Gojek</span>
                            <i data-lucide="arrow-up-right" class="w-4 h-4"></i>
                        </div>
                    </a>
                </div>
            @endif
        </div>
    </section>

    <!-- Main Contact Info & Form Section -->
    <section class="py-16 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                <!-- Left: Contact Details Cards -->
                <div class="lg:col-span-5 space-y-6">
                    
                    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm space-y-6">
                        <h2 class="text-xl font-extrabold text-slate-900 border-b border-slate-100 pb-4">
                            Informasi Kontak Resmi
                        </h2>

                        <!-- WhatsApp Direct Box -->
                        @if($contact->whatsapp)
                            <a href="https://wa.me/{{ $contact->clean_whatsapp }}?text={{ urlencode('Halo Amidyas Superfood, saya ingin menanyakan produk.') }}" target="_blank" class="flex items-center gap-4 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-950 hover:bg-emerald-100 transition group">
                                <div class="w-12 h-12 rounded-xl bg-emerald-600 text-white flex items-center justify-center shrink-0 shadow-sm group-hover:scale-105 transition">
                                    <i data-lucide="message-circle" class="w-7 h-7"></i>
                                </div>
                                <div>
                                    <span class="text-xs font-bold uppercase tracking-wider text-emerald-700 block">WhatsApp CS Utama</span>
                                    <span class="text-base font-extrabold">{{ $contact->whatsapp }}</span>
                                    <p class="text-[11px] text-emerald-600">Respon Cepat Jam Kerja</p>
                                </div>
                            </a>
                        @endif

                        <!-- Telepon -->
                        @if($contact->phone)
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-xl bg-slate-100 text-slate-700 flex items-center justify-center shrink-0 mt-0.5">
                                    <i data-lucide="phone" class="w-5 h-5"></i>
                                </div>
                                <div>
                                    <span class="text-xs font-bold uppercase text-slate-400 block">Telepon Kantor</span>
                                    <span class="text-sm font-bold text-slate-800">{{ $contact->phone }}</span>
                                </div>
                            </div>
                        @endif

                        <!-- Email -->
                        @if($contact->email)
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-xl bg-slate-100 text-slate-700 flex items-center justify-center shrink-0 mt-0.5">
                                    <i data-lucide="mail" class="w-5 h-5"></i>
                                </div>
                                <div>
                                    <span class="text-xs font-bold uppercase text-slate-400 block">Email Resmi</span>
                                    <a href="mailto:{{ $contact->email }}" class="text-sm font-bold text-emerald-600 hover:underline">
                                        {{ $contact->email }}
                                    </a>
                                </div>
                            </div>
                        @endif

                        <!-- Alamat -->
                        @if($contact->address)
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-xl bg-slate-100 text-slate-700 flex items-center justify-center shrink-0 mt-0.5">
                                    <i data-lucide="map-pin" class="w-5 h-5"></i>
                                </div>
                                <div>
                                    <span class="text-xs font-bold uppercase text-slate-400 block">Alamat Kantor & Gudang</span>
                                    <p class="text-sm text-slate-700 leading-relaxed font-medium">{{ $contact->address }}</p>
                                </div>
                            </div>
                        @endif

                        <!-- Jam Operasional -->
                        @if($contact->operational_hours)
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-xl bg-slate-100 text-slate-700 flex items-center justify-center shrink-0 mt-0.5">
                                    <i data-lucide="clock" class="w-5 h-5"></i>
                                </div>
                                <div>
                                    <span class="text-xs font-bold uppercase text-slate-400 block">Jam Operasional</span>
                                    <p class="text-xs text-slate-600 font-medium">{{ $contact->operational_hours }}</p>
                                </div>
                            </div>
                        @endif

                        <!-- Media Sosial -->
                        <div class="pt-4 border-t border-slate-100">
                            <span class="text-xs font-bold uppercase tracking-wider text-slate-400 block mb-3">Media Sosial Kami</span>
                            <div class="flex items-center gap-3">
                                @if($contact->instagram)
                                    <a href="{{ $contact->instagram }}" target="_blank" class="flex items-center gap-2 px-3 py-1.5 rounded-xl bg-slate-100 hover:bg-pink-50 hover:text-pink-600 text-slate-700 text-xs font-bold transition">
                                        <i data-lucide="instagram" class="w-4 h-4"></i> Instagram
                                    </a>
                                @endif
                                @if($contact->tiktok)
                                    <a href="{{ $contact->tiktok }}" target="_blank" class="flex items-center gap-2 px-3 py-1.5 rounded-xl bg-slate-100 hover:bg-slate-900 hover:text-white text-slate-700 text-xs font-bold transition">
                                        <i data-lucide="video" class="w-4 h-4"></i> TikTok
                                    </a>
                                @endif
                                @if($contact->facebook)
                                    <a href="{{ $contact->facebook }}" target="_blank" class="flex items-center gap-2 px-3 py-1.5 rounded-xl bg-slate-100 hover:bg-blue-50 hover:text-blue-600 text-slate-700 text-xs font-bold transition">
                                        <i data-lucide="facebook" class="w-4 h-4"></i> Facebook
                                    </a>
                                @endif
                            </div>
                        </div>

                    </div>

                </div>

                <!-- Right: Direct Message / Inquiry Form -->
                <div class="lg:col-span-7">
                    <div class="bg-white rounded-3xl p-6 sm:p-10 border border-slate-200 shadow-sm">
                        <div class="mb-6">
                            <span class="text-xs font-bold uppercase tracking-wider text-emerald-700 bg-emerald-100 px-3 py-1 rounded-full">Kirim Pesan</span>
                            <h2 class="text-2xl font-extrabold text-slate-900 mt-2">Form Pertanyaan & Inquiry</h2>
                            <p class="text-xs text-slate-500 mt-1">Isi formulir berikut, pesan Anda akan langsung diteruskan ke WhatsApp CS kami.</p>
                        </div>

                        <form action="{{ route('contact.send') }}" method="POST" class="space-y-4">
                            @csrf
                            
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nama Lengkap *</label>
                                    <input type="text" name="name" required placeholder="Contoh: Budi Santoso" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">No. Telepon / WhatsApp *</label>
                                    <input type="text" name="phone" required placeholder="Contoh: 08123456789" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm">
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Alamat Email (Opsional)</label>
                                <input type="email" name="email" placeholder="Contoh: budi@gmail.com" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Topik / Perihal *</label>
                                <select name="subject" required class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm bg-white">
                                    <option value="Pemesanan Produk Chia Seeds">Pemesanan Produk Chia Seeds</option>
                                    <option value="Tanya Ketersediaan Stok">Tanya Ketersediaan Stok</option>
                                    <option value="Konsultasi Manfaat & Cara Konsumsi">Konsultasi Manfaat & Cara Konsumsi</option>
                                    <option value="Pemesanan via GrabFood / GoFood">Pemesanan via GrabFood / GoFood</option>
                                    <option value="Penawaran Kerja Sama / Reseller">Penawaran Kerja Sama / Reseller</option>
                                    <option value="Pertanyaan Lainnya">Pertanyaan Lainnya</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Isi Pesan Anda *</label>
                                <textarea name="message" rows="4" required placeholder="Tuliskan pertanyaan atau detail pesanan yang ingin Anda tanyakan..." class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm"></textarea>
                            </div>

                            <button type="submit" class="w-full flex items-center justify-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3.5 px-6 rounded-2xl shadow-md hover:shadow-lg transition">
                                <i data-lucide="send" class="w-4 h-4"></i>
                                <span>Kirimkan Pesan ke WhatsApp CS</span>
                            </button>
                        </form>
                    </div>
                </div>

            </div>

            <!-- Google Maps Embed Section -->
            @if($contact->maps_embed)
                <div class="mt-12 bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm overflow-hidden">
                    <div class="flex items-center gap-2 mb-4">
                        <i data-lucide="map" class="w-5 h-5 text-emerald-600"></i>
                        <h3 class="text-lg font-extrabold text-slate-900">Peta Lokasi Kantor</h3>
                    </div>
                    <div class="w-full h-80 sm:h-96 rounded-2xl overflow-hidden border border-slate-200 shadow-inner">
                        {!! $contact->maps_embed !!}
                    </div>
                </div>
            @endif

        </div>
    </section>
@endsection