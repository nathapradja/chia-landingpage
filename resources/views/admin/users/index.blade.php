@extends('layouts.admin')

@section('title', 'Kelola Akun Admin')
@section('page_title', 'Kelola Akun Administrator')
@section('page_subtitle', 'Kelola daftar pengguna yang memiliki hak akses untuk mengelola website')

@section('content')
    <div class="space-y-6">
        
        <!-- Header Actions -->
        <div class="bg-white rounded-2xl border border-slate-200 p-4 sm:p-6 shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <!-- Search -->
            <form action="{{ route('admin.users.index') }}" method="GET" class="flex-1 max-w-md">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                        <i data-lucide="search" class="w-4 h-4"></i>
                    </div>
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama atau email..." class="w-full pl-9 pr-3 py-2 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                </div>
            </form>

            <a href="{{ route('admin.users.create') }}" class="inline-flex items-center justify-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-5 py-2.5 rounded-xl text-xs shadow-md transition shrink-0">
                <i data-lucide="user-plus" class="w-4 h-4"></i>
                <span>Tambah Admin Baru</span>
            </a>
        </div>

        <!-- Users Table -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-slate-50 text-slate-400 text-[11px] uppercase tracking-wider font-bold border-b border-slate-100">
                        <tr>
                            <th class="py-3.5 px-4">Nama Pengguna</th>
                            <th class="py-3.5 px-4">Email</th>
                            <th class="py-3.5 px-4">Role</th>
                            <th class="py-3.5 px-4">Status</th>
                            <th class="py-3.5 px-4">Terdaftar Sejak</th>
                            <th class="py-3.5 px-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-xs">
                        @forelse($users as $user)
                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="py-3.5 px-4 font-bold text-slate-900 flex items-center gap-2.5">
                                    <div class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-800 flex items-center justify-center font-bold text-xs">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <span>{{ $user->name }}</span>
                                    @if(Auth::id() === $user->id)
                                        <span class="px-2 py-0.5 rounded-full text-[9px] font-extrabold bg-blue-100 text-blue-800">Anda</span>
                                    @endif
                                </td>
                                <td class="py-3.5 px-4 text-slate-600">
                                    {{ $user->email }}
                                </td>
                                <td class="py-3.5 px-4">
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-purple-50 text-purple-700 uppercase">
                                        {{ $user->role ?? 'Admin' }}
                                    </span>
                                </td>
                                <td class="py-3.5 px-4">
                                    @if($user->is_active)
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">Aktif</span>
                                    @else
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-slate-100 text-slate-600">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="py-3.5 px-4 text-slate-500">
                                    {{ $user->created_at->format('d M Y') }}
                                </td>
                                <td class="py-3.5 px-4 text-right">
                                    <div class="flex items-center justify-end gap-1.5">
                                        <a href="{{ route('admin.users.edit', $user->id) }}" title="Edit Admin" class="p-2 rounded-lg bg-blue-50 hover:bg-blue-100 text-blue-600 transition">
                                            <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                                        </a>

                                        @if(Auth::id() !== $user->id)
                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun admin ini?');" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" title="Hapus Admin" class="p-2 rounded-lg bg-red-50 hover:bg-red-100 text-red-600 transition">
                                                    <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-12 text-center text-slate-400 text-xs">
                                    Belum ada pengguna admin lainnya.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-4 border-t border-slate-100">
                {{ $users->links() }}
            </div>
        </div>

    </div>
@endsection
