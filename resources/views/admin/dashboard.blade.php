@extends('layouts.admin')

@section('title', 'Dashboard - Admin SI-Berapi')
@section('page_title', 'Ringkasan Sistem & Status Kebencanaan')

@section('content')
<div class="space-y-6">
    <!-- Stat Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Total Gunung -->
        <div class="p-5 rounded-2xl bg-white border border-slate-200/80 shadow-sm space-y-1">
            <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider block">Gunung Terdata</span>
            <div class="text-2xl font-bold text-slate-900">{{ $stats['total_volcanoes'] }}</div>
            <div class="text-xs text-slate-500 pt-1">
                <span class="text-red-700 font-semibold">{{ $stats['awas_count'] }} Awas</span> • 
                <span class="text-orange-700 font-semibold">{{ $stats['siaga_count'] }} Siaga</span>
            </div>
        </div>

        <!-- Level IV Awas -->
        <div class="p-5 rounded-2xl bg-white border border-slate-200/80 shadow-sm space-y-1">
            <span class="text-[11px] font-semibold text-red-700 uppercase tracking-wider block">Level IV (AWAS)</span>
            <div class="text-2xl font-bold text-red-700">{{ $stats['awas_count'] }} Gunung</div>
            <div class="text-xs text-slate-500 pt-1">Status bahaya tertinggi</div>
        </div>

        <!-- Orang Hilang -->
        <div class="p-5 rounded-2xl bg-white border border-slate-200/80 shadow-sm space-y-1">
            <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider block">Korban Dicari</span>
            <div class="text-2xl font-bold text-slate-900">{{ $stats['missing_searching'] }} Jiwa</div>
            <div class="text-xs text-emerald-700 font-semibold pt-1">{{ $stats['missing_found'] }} telah ditemukan</div>
        </div>

        <!-- Arsip Riwayat -->
        <div class="p-5 rounded-2xl bg-white border border-slate-200/80 shadow-sm space-y-1">
            <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider block">Arsip Bencana</span>
            <div class="text-2xl font-bold text-slate-900">{{ $stats['total_histories'] }} Catatan</div>
            <div class="text-xs text-slate-500 pt-1">{{ $stats['total_education'] }} Modul Edukasi</div>
        </div>
    </div>

    <!-- Quick Actions Minimalis -->
    <div class="p-4 rounded-2xl bg-white border border-slate-200/80 shadow-sm flex flex-wrap items-center gap-2 text-xs">
        <span class="text-slate-400 font-medium px-2">Aksi Cepat:</span>
        <a href="{{ route('admin.volcanoes.create') }}" class="px-3.5 py-2 rounded-xl bg-orange-700 hover:bg-orange-800 text-white font-medium flex items-center gap-1.5 transition">
            <i data-lucide="plus" class="w-3.5 h-3.5"></i> Tambah Gunung
        </a>
        <a href="{{ route('admin.missing.index') }}" class="px-3.5 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium flex items-center gap-1.5 transition">
            <i data-lucide="user-check" class="w-3.5 h-3.5"></i> Moderasi Orang Hilang
        </a>
        <a href="{{ route('admin.histories.create') }}" class="px-3.5 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium flex items-center gap-1.5 transition">
            <i data-lucide="history" class="w-3.5 h-3.5"></i> Tambah Riwayat
        </a>
        <a href="{{ route('admin.education.create') }}" class="px-3.5 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium flex items-center gap-1.5 transition">
            <i data-lucide="book-plus" class="w-3.5 h-3.5"></i> Tambah Edukasi
        </a>
    </div>

    <!-- Two Columns: Critical Status & Moderation Queue -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Critical Volcanoes Monitor -->
        <div class="p-5 rounded-2xl bg-white border border-slate-200/80 shadow-sm space-y-3">
            <div class="flex items-center justify-between pb-1">
                <h3 class="font-bold text-sm text-slate-900 flex items-center gap-2">
                    <i data-lucide="flame" class="w-4 h-4 text-orange-700"></i> Pantauan Status Kritis
                </h3>
                <a href="{{ route('admin.volcanoes.index') }}" class="text-xs text-orange-700 font-medium hover:underline">Semua</a>
            </div>

            <div class="space-y-2">
                @foreach($criticalVolcanoes as $cv)
                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-between gap-3 text-xs">
                        <div>
                            <div class="font-bold text-slate-900">{{ $cv->name }}</div>
                            <span class="text-slate-500 text-[11px]">{{ $cv->province }} • {{ $cv->height }} mdpl</span>
                        </div>
                        <div class="text-right shrink-0">
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold {{ $cv->status_badge['badge'] }}">
                                {{ $cv->status_level }}
                            </span>
                            <span class="block text-[10px] text-slate-400 mt-0.5">Radius: {{ $cv->safety_radius }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Recent Missing Reports Queue -->
        <div class="p-5 rounded-2xl bg-white border border-slate-200/80 shadow-sm space-y-3">
            <div class="flex items-center justify-between pb-1">
                <h3 class="font-bold text-sm text-slate-900 flex items-center gap-2">
                    <i data-lucide="users" class="w-4 h-4 text-orange-700"></i> Laporan Orang Hilang Terkini
                </h3>
                <a href="{{ route('admin.missing.index') }}" class="text-xs text-orange-700 font-medium hover:underline">Panel Moderasi</a>
            </div>

            <div class="space-y-2">
                @forelse($recentMissing as $m)
                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-between gap-3 text-xs">
                        <div class="flex items-center gap-2.5 min-w-0">
                            <img src="{{ $m->photo ?? 'https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?auto=format&fit=crop&w=150&q=80' }}" 
                                 alt="{{ $m->victim_name }}" 
                                 class="w-8 h-8 rounded-lg object-cover border border-slate-200">
                            <div class="min-w-0">
                                <h4 class="font-semibold text-slate-900 truncate">{{ $m->victim_name }}</h4>
                                <span class="text-[11px] text-slate-500 truncate block">{{ $m->volcano?->name ?? 'Kawasan' }}</span>
                            </div>
                        </div>

                        <div class="text-right shrink-0">
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold {{ $m->status === 'Dicari' ? 'bg-red-50 text-red-700 border border-red-200' : 'bg-emerald-50 text-emerald-700 border border-emerald-200' }}">
                                {{ $m->status }}
                            </span>
                        </div>
                    </div>
                @empty
                    <p class="text-xs text-slate-400 italic py-4 text-center">Belum ada laporan orang hilang.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
