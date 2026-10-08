@extends('layouts.admin')

@section('title', 'Kelola Profil Perusahaan')
@section('page_title', 'Informasi Profil Perusahaan')
@section('page_subtitle', 'Kelola teks tentang kami, visi, misi, dan nilai keunggulan produk')

@section('content')
    <div class="max-w-4xl">
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8">
            
            <form action="{{ route('admin.company.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6"
                  x-data="{ values: {{ json_encode($company->values ?? [
                      ['title' => '100% Alami & Organik', 'desc' => 'Bebas dari bahan pengawet dan pestisida sintetis.'],
                      ['title' => 'Nutrisi Padat Berkualitas', 'desc' => 'Menjaga kandungan vitamin dan omega-3 tetap utuh.'],
                      ['title' => 'Kemasan Higienis & Aman', 'desc' => 'Material kemasan food-grade kedap udara.'],
                      ['title' => 'Pelayanan Ramah & Amanah', 'desc' => 'Selalu siap melayani kebutuhan kesehatan Anda.']
                  ]) }} }">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                            Nama Perusahaan / Brand *
                        </label>
                        <input type="text" name="company_name" value="{{ old('company_name', $company->company_name) }}" required class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                            Tagline Utama *
                        </label>
                        <input type="text" name="tagline" value="{{ old('tagline', $company->tagline) }}" required class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                            Ringkasan Profil Singkat (Hero / Home) *
                        </label>
                        <textarea name="short_description" rows="3" required class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-emerald-500 focus:outline-none">{{ old('short_description', $company->short_description) }}</textarea>
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                            Tentang Kami Lengkap (Halaman Tentang Kami) *
                        </label>
                        <textarea name="about_us" rows="6" required class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-emerald-500 focus:outline-none">{{ old('about_us', $company->about_us) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                            Visi Perusahaan *
                        </label>
                        <textarea name="vision" rows="4" required class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-emerald-500 focus:outline-none">{{ old('vision', $company->vision) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                            Misi Perusahaan *
                        </label>
                        <textarea name="mission" rows="4" required class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-emerald-500 focus:outline-none">{{ old('mission', $company->mission) }}</textarea>
                    </div>

                </div>

                <!-- Values / Poin Keunggulan Dynamic Rows -->
                <div class="pt-4 border-t border-slate-200">
                    <div class="flex items-center justify-between mb-3">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">
                            Poin Nilai & Keunggulan Produk
                        </label>
                        <button type="button" @click="values.push({title: '', desc: ''})" class="text-xs font-bold text-emerald-600 hover:text-emerald-700 flex items-center gap-1">
                            <i data-lucide="plus" class="w-3.5 h-3.5"></i> Tambah Poin
                        </button>
                    </div>

                    <div class="space-y-3">
                        <template x-for="(item, index) in values" :key="index">
                            <div class="flex items-center gap-3 p-3 bg-slate-50 rounded-xl border border-slate-200">
                                <input type="text" :name="`values[${index}][title]`" x-model="item.title" placeholder="Judul Nilai (misal: 100% Organik)" class="w-1/3 px-3 py-2 rounded-lg border border-slate-300 text-xs focus:ring-2 focus:ring-emerald-500 focus:outline-none bg-white">
                                <input type="text" :name="`values[${index}][desc]`" x-model="item.desc" placeholder="Penjelasan singkat keunggulan..." class="flex-1 px-3 py-2 rounded-lg border border-slate-300 text-xs focus:ring-2 focus:ring-emerald-500 focus:outline-none bg-white">
                                <button type="button" @click="values.splice(index, 1)" class="p-2 text-red-500 hover:bg-red-100 rounded-lg">
                                    <i data-lucide="trash" class="w-4 h-4"></i>
                                </button>
                            </div>
                        </template>
                    </div>
                </div>

                <!-- Image Upload & Preview -->
                <div class="pt-4 border-t border-slate-200 space-y-4">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">
                        Foto Profil / Visual Perusahaan
                    </label>

                    @if($company->image)
                        <div class="flex items-center gap-4 p-4 bg-slate-50 rounded-xl border border-slate-200">
                            <img src="{{ $company->image_url }}" alt="{{ $company->company_name }}" class="w-24 h-24 rounded-lg object-contain bg-white border border-slate-200 p-2">
                            <div>
                                <span class="text-xs font-bold text-slate-700 block">Foto Saat Ini</span>
                                <span class="text-[11px] text-slate-400 block mb-2">{{ $company->image }}</span>
                            </div>
                        </div>
                    @endif

                    <div>
                        <input type="file" name="image" accept="image/*" class="w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                        <p class="text-[11px] text-slate-400 mt-1">Format: JPG, PNG, WEBP. Jika dikosongkan, logo default akan digunakan pada halaman profil.</p>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="pt-6 border-t border-slate-200 flex items-center justify-between">
                    @if($company->image)
                        <form action="{{ route('admin.company.delete-image') }}" method="POST" onsubmit="return confirm('Hapus foto ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-xs font-bold text-red-600 hover:text-red-700 flex items-center gap-1">
                                <i data-lucide="trash-2" class="w-3.5 h-3.5"></i> Hapus Foto
                            </button>
                        </form>
                    @else
                        <div></div>
                    @endif

                    <button type="submit" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-7 py-3 rounded-xl text-xs shadow-md transition">
                        <i data-lucide="save" class="w-4 h-4"></i>
                        <span>Simpan Perubahan Informasi Perusahaan</span>
                    </button>
                </div>

            </form>

        </div>
    </div>
@endsection
