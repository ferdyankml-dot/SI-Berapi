@extends('layouts.admin')

@section('title', 'Data Gunung Berapi - Admin SI-Berapi')
@section('page_title', 'Manajemen Data & Status Gunung Berapi')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-lg font-bold text-slate-900">Daftar Gunung Api Pantauan</h2>
            <p class="text-xs text-slate-500">Kelola informasi koordinat, ketinggian, dan perbarui level status bahaya.</p>
        </div>

        <a href="{{ route('admin.volcanoes.create') }}" 
           class="px-4 py-2.5 rounded-xl bg-orange-700 hover:bg-orange-800 text-white font-semibold text-xs flex items-center gap-1.5 transition shadow-sm">
            <i data-lucide="plus" class="w-4 h-4"></i> Tambah Gunung
        </a>
    </div>

    <!-- Search Bar -->
    <div class="p-4 rounded-2xl bg-white border border-slate-200/80 shadow-sm">
        <form action="{{ route('admin.volcanoes.index') }}" method="GET" class="flex items-center gap-2">
            <div class="relative flex-1">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama atau provinsi..." 
                       class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 pl-9 text-xs text-slate-900 focus:outline-none focus:bg-white focus:border-orange-600 focus:ring-1 focus:ring-orange-600">
                <i data-lucide="search" class="w-4 h-4 text-slate-400 absolute left-3 top-2"></i>
            </div>
            <button type="submit" class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-xs transition">
                Cari
            </button>
        </form>
    </div>

    <!-- Table -->
    <div class="rounded-2xl bg-white border border-slate-200/80 overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 text-slate-500 font-semibold uppercase tracking-wider border-b border-slate-200/80">
                    <tr>
                        <th class="py-4 px-6">Nama Gunung</th>
                        <th class="py-4 px-6">Provinsi</th>
                        <th class="py-4 px-6">Tinggi</th>
                        <th class="py-4 px-6">Status Bahaya</th>
                        <th class="py-4 px-6">Radius Aman</th>
                        <th class="py-4 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    @forelse($volcanoes as $v)
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="py-4 px-6">
                                <div class="font-bold text-slate-900 text-sm">{{ $v->name }}</div>
                                <span class="text-[11px] text-slate-400">{{ $v->latitude }}, {{ $v->longitude }}</span>
                            </td>
                            <td class="py-4 px-6">
                                <span class="font-medium text-slate-800">{{ $v->province }}</span>
                                <span class="block text-[11px] text-slate-400">{{ $v->location }}</span>
                            </td>
                            <td class="py-4 px-6 font-semibold text-slate-800">
                                {{ number_format($v->height) }} mdpl
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-2.5 py-1 rounded-full text-[11px] font-semibold {{ $v->status_badge['badge'] }}">
                                    {{ $v->status_badge['label'] }}
                                </span>
                            </td>
                            <td class="py-4 px-6 font-semibold text-orange-700">
                                {{ $v->safety_radius }}
                            </td>
                            <td class="py-4 px-6 text-right">
                                <div class="flex items-center justify-end gap-1.5">
                                    <a href="{{ route('admin.volcanoes.edit', $v->id) }}" 
                                       class="p-1.5 rounded-lg text-slate-500 hover:text-slate-900 hover:bg-slate-100 transition" title="Edit">
                                        <i data-lucide="edit-3" class="w-4 h-4"></i>
                                    </a>
                                    <form action="{{ route('admin.volcanoes.destroy', $v->id) }}" method="POST" onsubmit="return confirm('Hapus data gunung {{ $v->name }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 rounded-lg text-red-500 hover:text-red-700 hover:bg-red-50 transition" title="Hapus">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-8 text-slate-400">Tidak ada data gunung.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-slate-100">
            {{ $volcanoes->links() }}
        </div>
    </div>
</div>
@endsection
