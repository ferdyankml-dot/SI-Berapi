@extends('layouts.admin')

@section('title', 'Moderasi Orang Hilang - Admin SI-Berapi')
@section('page_title', 'Moderasi Laporan Korban Hilang')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-lg font-bold text-slate-900">Laporan Masuk dari Publik</h2>
            <p class="text-xs text-slate-500">Tinjau laporan warga, ubah status penemuan, atau sembunyikan laporan yang tidak valid.</p>
        </div>
    </div>

    <!-- Filter Bar -->
    <div class="p-4 rounded-2xl bg-white border border-slate-200/80 shadow-sm">
        <form action="{{ route('admin.missing.index') }}" method="GET" class="flex flex-wrap items-center gap-2">
            <div class="relative flex-1 min-w-[200px]">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama korban atau pelapor..." 
                       class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 pl-9 text-xs text-slate-900 focus:outline-none focus:bg-white focus:border-orange-600 focus:ring-1 focus:ring-orange-600">
                <i data-lucide="search" class="w-4 h-4 text-slate-400 absolute left-3 top-2"></i>
            </div>

            <select name="status" class="bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs text-slate-900 focus:outline-none focus:bg-white focus:border-orange-600">
                <option value="Semua">Semua Status</option>
                <option value="Dicari" {{ request('status') === 'Dicari' ? 'selected' : '' }}>Masih Dicari</option>
                <option value="Ditemukan" {{ request('status') === 'Ditemukan' ? 'selected' : '' }}>Sudah Ditemukan</option>
            </select>

            <button type="submit" class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-xs transition">
                Filter
            </button>
        </form>
    </div>

    <!-- Table -->
    <div class="rounded-2xl bg-white border border-slate-200/80 overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 text-slate-500 font-semibold uppercase tracking-wider border-b border-slate-200/80">
                    <tr>
                        <th class="py-4 px-6">Korban Hilang</th>
                        <th class="py-4 px-6">Lokasi / Gunung</th>
                        <th class="py-4 px-6">Pelapor</th>
                        <th class="py-4 px-6">Status</th>
                        <th class="py-4 px-6">Visibilitas</th>
                        <th class="py-4 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    @forelse($reports as $r)
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $r->photo ?? 'https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?auto=format&fit=crop&w=150&q=80' }}" 
                                         alt="{{ $r->victim_name }}" 
                                         class="w-10 h-10 rounded-lg object-cover border border-slate-200">
                                    <div>
                                        <div class="font-bold text-slate-900 text-sm">{{ $r->victim_name }}</div>
                                        <span class="text-[11px] text-slate-400">{{ $r->gender }}, {{ $r->age }} Th • Hilang: {{ $r->last_seen_date?->format('d/m/Y') }}</span>
                                    </div>
                                </div>
                            </td>

                            <td class="py-4 px-6">
                                <span class="font-medium text-slate-800">{{ $r->volcano?->name ?? 'Kawasan Gunung' }}</span>
                                <span class="block text-[11px] text-slate-400 truncate max-w-xs">{{ $r->last_seen_location }}</span>
                            </td>

                            <td class="py-4 px-6">
                                <span class="font-medium text-slate-900 block">{{ $r->reporter_name }}</span>
                                <a href="https://wa.me/{{ $r->formatted_phone }}" target="_blank" class="text-[11px] text-emerald-700 hover:underline flex items-center gap-1 font-medium">
                                    <i data-lucide="message-circle" class="w-3 h-3"></i> {{ $r->reporter_phone }}
                                </a>
                            </td>

                            <td class="py-4 px-6">
                                <form action="{{ route('admin.missing.toggle_status', $r->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" 
                                            class="px-2.5 py-1 rounded-full text-[11px] font-semibold transition {{ $r->status === 'Dicari' ? 'bg-red-50 text-red-700 border border-red-200 hover:bg-red-100' : 'bg-emerald-50 text-emerald-700 border border-emerald-200 hover:bg-emerald-100' }}"
                                            title="Klik untuk ubah status">
                                        {{ $r->status === 'Dicari' ? '● Masih Dicari' : '✓ Ditemukan' }}
                                    </button>
                                </form>
                            </td>

                            <td class="py-4 px-6">
                                <form action="{{ route('admin.missing.toggle_approval', $r->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" 
                                            class="px-2.5 py-1 rounded-full text-[11px] font-semibold transition {{ $r->is_approved ? 'bg-slate-100 text-slate-700 hover:bg-slate-200' : 'bg-amber-50 text-amber-700 border border-amber-200 hover:bg-amber-100' }}"
                                            title="Klik untuk tampilkan / sembunyikan">
                                        {{ $r->is_approved ? 'Ditayangkan' : 'Disembunyikan' }}
                                    </button>
                                </form>
                            </td>

                            <td class="py-4 px-6 text-right">
                                <form action="{{ route('admin.missing.destroy', $r->id) }}" method="POST" onsubmit="return confirm('Hapus laporan {{ $r->victim_name }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 rounded-lg text-red-500 hover:text-red-700 hover:bg-red-50 transition" title="Hapus Laporan">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-8 text-slate-400">Tidak ada laporan korban hilang.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-slate-100">
            {{ $reports->links() }}
        </div>
    </div>
</div>
@endsection
