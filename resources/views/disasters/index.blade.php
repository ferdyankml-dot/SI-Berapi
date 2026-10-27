@extends('layouts.app')

@section('title', 'Riwayat Erupsi Bersejarah - SI-Berapi')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 sm:pt-12 pb-20 space-y-10">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div class="max-w-2xl space-y-2">
            <span class="text-xs font-semibold uppercase tracking-wider text-orange-700 block">
                Arsip Kebencanaan Nasional
            </span>
            <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-slate-900">
                Riwayat Bencana Erupsi Gunung Api
            </h1>
            <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                Dokumentasi peristiwa letusan signifikan di kepulauan Indonesia, catatan dampak kerusakan fisik, jumlah korban, dan upaya evakuasi.
            </p>
        </div>

        <div class="flex items-center gap-3 text-xs">
            <div class="clean-card px-3.5 py-2">
                <span class="text-slate-400">Total Kejadian:</span>
                <strong class="text-slate-900 ml-1">{{ $totalEvents }} Data</strong>
            </div>
            <div class="clean-card px-3.5 py-2">
                <span class="text-slate-400">Total Korban:</span>
                <strong class="text-orange-700 ml-1">{{ number_format($totalCasualties) }} Jiwa</strong>
            </div>
        </div>
    </div>

    <!-- Filter & Search -->
    <div class="clean-card p-5">
        <form action="{{ route('disasters.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-4 gap-4">
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Kata Kunci / Dampak</label>
                <div class="relative">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari deskripsi, kronologi..." 
                           class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 pl-9 text-xs text-slate-800 placeholder-slate-400 focus:outline-none focus:bg-white focus:border-orange-600 focus:ring-1 focus:ring-orange-600">
                    <i data-lucide="search" class="w-4 h-4 text-slate-400 absolute left-3 top-2.5"></i>
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Gunung Api</label>
                <select name="volcano_id" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs text-slate-800 focus:outline-none focus:bg-white focus:border-orange-600">
                    <option value="">Semua Gunung</option>
                    @foreach($volcanoes as $v)
                        <option value="{{ $v->id }}" {{ request('volcano_id') == $v->id ? 'selected' : '' }}>
                            {{ $v->name }} ({{ $v->province }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Tahun Peristiwa</label>
                <select name="year" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs text-slate-800 focus:outline-none focus:bg-white focus:border-orange-600">
                    <option value="">Semua Tahun</option>
                    @foreach($years as $yr)
                        <option value="{{ $yr }}" {{ request('year') == $yr ? 'selected' : '' }}>
                            Tahun {{ $yr }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-end gap-2">
                <button type="submit" class="flex-1 py-2.5 rounded-xl bg-orange-700 hover:bg-orange-800 text-white font-semibold text-xs transition flex items-center justify-center gap-1.5 shadow-sm">
                    <i data-lucide="filter" class="w-3.5 h-3.5"></i> Filter
                </button>
                <a href="{{ route('disasters.index') }}" class="p-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 transition" title="Reset">
                    <i data-lucide="rotate-ccw" class="w-4 h-4"></i>
                </a>
            </div>
        </form>
    </div>

    <!-- Timeline / Feed Cards -->
    <div class="space-y-4">
        @forelse($histories as $history)
            <div class="clean-card p-6 flex flex-col md:flex-row gap-6">
                <!-- Thumbnail -->
                <div class="w-full md:w-64 h-44 rounded-xl overflow-hidden bg-slate-100 shrink-0 relative">
                    <img src="{{ $history->image ?? 'https://images.unsplash.com/photo-1509316975850-ff9c5deb0cd9?auto=format&fit=crop&w=600&q=80' }}" 
                         alt="{{ $history->volcano?->name }}" 
                         class="w-full h-full object-cover">
                    <div class="absolute top-2.5 left-2.5">
                        <span class="px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-white/95 text-slate-800 shadow-sm border border-slate-200/80">
                            {{ $history->event_date?->format('d M Y') }}
                        </span>
                    </div>
                </div>

                <!-- Info -->
                <div class="flex-1 space-y-3 flex flex-col justify-between">
                    <div>
                        <div class="flex flex-wrap items-center justify-between gap-2 mb-1.5">
                            <a href="{{ route('volcanoes.show', $history->volcano_id) }}" class="text-lg font-bold text-slate-900 hover:text-orange-700 transition flex items-center gap-1.5">
                                <i data-lucide="mountain" class="w-4 h-4 text-orange-700"></i>
                                <span>{{ $history->volcano?->name ?? 'Gunung Api' }}</span>
                            </a>

                            <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-red-50 text-red-700 border border-red-200">
                                Korban: {{ $history->casualties_count }} Jiwa
                            </span>
                        </div>

                        <p class="text-xs text-slate-400 flex items-center gap-1 mb-2">
                            <i data-lucide="map-pin" class="w-3 h-3 text-slate-400"></i>
                            <span>{{ $history->volcano?->location }}, {{ $history->volcano?->province }}</span>
                        </p>

                        <h3 class="font-semibold text-xs sm:text-sm text-slate-800 leading-snug mb-2">
                            {{ $history->description }}
                        </h3>

                        <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-100 text-xs text-slate-600 leading-relaxed">
                            <strong class="text-slate-900 font-semibold block mb-0.5">Ringkasan Dampak:</strong>
                            {{ $history->impact_summary }}
                        </div>
                    </div>

                    <div class="flex items-center justify-between text-xs text-slate-400 pt-1">
                        <span>Sumber: PVMBG & Pusat Data Informasi BNPB</span>
                        <a href="{{ route('volcanoes.show', $history->volcano_id) }}" class="text-orange-700 hover:underline font-semibold flex items-center gap-1">
                            Status Gunung Ini →
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-16 text-slate-400 clean-card">
                <i data-lucide="calendar-x" class="w-10 h-10 mx-auto text-slate-300 mb-2"></i>
                <h3 class="text-base font-semibold text-slate-700">Tidak ada data riwayat yang cocok</h3>
                <p class="text-xs text-slate-400 mt-1">Coba sesuaikan filter tahun atau gunung terkait.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div>
        {{ $histories->links() }}
    </div>
</div>
@endsection
