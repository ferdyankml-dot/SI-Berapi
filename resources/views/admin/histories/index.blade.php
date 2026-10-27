@extends('layouts.admin')

@section('title', 'Riwayat Erupsi - Admin SI-Berapi')
@section('page_title', 'Manajemen Riwayat Letusan')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-lg font-bold text-slate-900">Arsip Peristiwa Erupsi</h2>
            <p class="text-xs text-slate-500">Kelola catatan kronologi letusan, dampak kerusakan, dan data korban jiwa.</p>
        </div>

        <a href="{{ route('admin.histories.create') }}" 
           class="px-4 py-2.5 rounded-xl bg-orange-700 hover:bg-orange-800 text-white font-semibold text-xs flex items-center gap-1.5 transition shadow-sm">
            <i data-lucide="plus" class="w-4 h-4"></i> Tambah Riwayat
        </a>
    </div>

    <!-- Table -->
    <div class="rounded-2xl bg-white border border-slate-200/80 overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 text-slate-500 font-semibold uppercase tracking-wider border-b border-slate-200/80">
                    <tr>
                        <th class="py-4 px-6">Tanggal Erupsi</th>
                        <th class="py-4 px-6">Gunung Api</th>
                        <th class="py-4 px-6">Deskripsi Peristiwa</th>
                        <th class="py-4 px-6">Korban Jiwa</th>
                        <th class="py-4 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    @forelse($histories as $h)
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="py-4 px-6 font-semibold text-slate-900">
                                {{ $h->event_date?->format('d/m/Y') }}
                            </td>
                            <td class="py-4 px-6">
                                <span class="font-bold text-slate-900">{{ $h->volcano?->name ?? '-' }}</span>
                                <span class="block text-[11px] text-slate-400">{{ $h->volcano?->province }}</span>
                            </td>
                            <td class="py-4 px-6 max-w-md">
                                <p class="line-clamp-2 leading-relaxed text-slate-600">{{ $h->description }}</p>
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-red-50 text-red-700 border border-red-200">
                                    {{ $h->casualties_count }} Jiwa
                                </span>
                            </td>
                            <td class="py-4 px-6 text-right">
                                <div class="flex items-center justify-end gap-1.5">
                                    <a href="{{ route('admin.histories.edit', $h->id) }}" 
                                       class="p-1.5 rounded-lg text-slate-500 hover:text-slate-900 hover:bg-slate-100 transition" title="Edit">
                                        <i data-lucide="edit-3" class="w-4 h-4"></i>
                                    </a>
                                    <form action="{{ route('admin.histories.destroy', $h->id) }}" method="POST" onsubmit="return confirm('Hapus arsip riwayat ini?')">
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
                            <td colspan="5" class="text-center py-8 text-slate-400">Tidak ada riwayat bencana tercatat.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-slate-100">
            {{ $histories->links() }}
        </div>
    </div>
</div>
@endsection
