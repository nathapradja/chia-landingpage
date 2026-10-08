@extends('layouts.admin')

@section('title', 'Edit Administrator: ' . $user->name)
@section('page_title', 'Edit Akun Administrator')
@section('page_subtitle', 'Perbarui data akun atau setel ulang kata sandi pengguna')

@section('content')
    <div class="max-w-2xl">
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8">
            
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Nama Lengkap Administrator *
                    </label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Alamat Email Login *
                    </label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                </div>

                <div class="p-4 bg-slate-50 rounded-xl border border-slate-200 space-y-4">
                    <div>
                        <span class="text-xs font-bold text-slate-800 block">Ubah Kata Sandi (Opsional)</span>
                        <p class="text-[11px] text-slate-400">Kosongkan jika tidak ingin mengubah kata sandi akun ini.</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[11px] font-bold text-slate-600 mb-1">Kata Sandi Baru</label>
                            <input type="password" name="password" placeholder="Minimal 6 karakter" class="w-full px-3 py-2 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-emerald-500 focus:outline-none bg-white">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-slate-600 mb-1">Konfirmasi Kata Sandi</label>
                            <input type="password" name="password_confirmation" placeholder="Ulangi kata sandi" class="w-full px-3 py-2 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-emerald-500 focus:outline-none bg-white">
                        </div>
                    </div>
                </div>

                <div>
                    <label class="flex items-center gap-3 p-4 rounded-xl border border-slate-200 bg-slate-50 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $user->is_active) ? 'checked' : '' }} class="w-4 h-4 rounded text-emerald-600 focus:ring-emerald-500 border-slate-300">
                        <div>
                            <span class="text-xs font-bold text-slate-800 block">Status Akun Aktif</span>
                            <span class="text-[11px] text-slate-500 block">Pengguna dapat login ke panel admin jika aktif</span>
                        </div>
                    </label>
                </div>

                <div class="pt-4 border-t border-slate-200 flex items-center justify-end gap-3">
                    <a href="{{ route('admin.users.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-300 text-xs font-bold text-slate-600 hover:bg-slate-50 transition">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-6 py-2.5 rounded-xl text-xs shadow-md transition">
                        <i data-lucide="save" class="w-4 h-4"></i>
                        <span>Simpan Perubahan</span>
                    </button>
                </div>

            </form>

        </div>
    </div>
@endsection
