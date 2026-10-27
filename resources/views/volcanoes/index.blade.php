@extends('layouts.app')

@section('title', 'Katalog Gunung Rawan Bencana - SI-Berapi')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 sm:pt-12 pb-20 space-y-10">
    <!-- Header -->
    <div class="max-w-3xl space-y-2">
        <span class="text-xs font-semibold uppercase tracking-wider text-orange-700 block">
            Pemantauan Vulkanologi
        </span>
        <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-slate-900">
            Daftar Gunung Api Rawan Bencana
        </h1>
        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
            Peta geospasial dan inventarisasi status aktivitas gunung api aktif di Indonesia yang dipantau oleh PVMBG Badan Geologi.
        </p>
    </div>

    <!-- Peta Interaktif Tanpa Bingkai Tebal -->
    <div class="clean-card overflow-hidden rounded-2xl relative">
        <div class="p-4 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3 bg-white">
            <div class="text-xs font-semibold text-slate-800 flex items-center gap-2">
                <i data-lucide="map" class="w-4 h-4 text-orange-700"></i>
                <span>Peta Interaktif Sebaran Gunung Api (Klik pin untuk detail)</span>
            </div>
            <div class="flex items-center gap-3 text-xs">
                <span class="flex items-center gap-1.5 text-slate-600"><span class="w-2 h-2 rounded-full bg-red-600"></span> Awas</span>
                <span class="flex items-center gap-1.5 text-slate-600"><span class="w-2 h-2 rounded-full bg-orange-600"></span> Siaga</span>
                <span class="flex items-center gap-1.5 text-slate-600"><span class="w-2 h-2 rounded-full bg-amber-500"></span> Waspada</span>
                <span class="flex items-center gap-1.5 text-slate-600"><span class="w-2 h-2 rounded-full bg-emerald-600"></span> Normal</span>
            </div>
        </div>
        <div id="volcanoMap" class="w-full h-[420px] z-10"></div>
    </div>

    <!-- Filter & Search Bar Minimalis -->
    <div class="clean-card p-5">
        <form action="{{ route('volcanoes.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Keyword -->
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nama / Lokasi</label>
                <div class="relative">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cth: Merapi, Flores, Jawa..." 
                           class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 pl-9 text-xs text-slate-800 placeholder-slate-400 focus:outline-none focus:bg-white focus:border-orange-600 focus:ring-1 focus:ring-orange-600">
                    <i data-lucide="search" class="w-4 h-4 text-slate-400 absolute left-3 top-2.5"></i>
                </div>
            </div>

            <!-- Province -->
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Wilayah / Provinsi</label>
                <select name="province" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs text-slate-800 focus:outline-none focus:bg-white focus:border-orange-600">
                    <option value="">Semua Provinsi</option>
                    @foreach($provinces as $prov)
                        <option value="{{ $prov }}" {{ request('province') === $prov ? 'selected' : '' }}>
                            {{ $prov }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Status Level -->
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Tingkat Status</label>
                <select name="status" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs text-slate-800 focus:outline-none focus:bg-white focus:border-orange-600">
                    <option value="Semua">Semua Status</option>
                    <option value="Awas" {{ request('status') === 'Awas' ? 'selected' : '' }}>Level IV (AWAS)</option>
                    <option value="Siaga" {{ request('status') === 'Siaga' ? 'selected' : '' }}>Level III (SIAGA)</option>
                    <option value="Waspada" {{ request('status') === 'Waspada' ? 'selected' : '' }}>Level II (WASPADA)</option>
                    <option value="Normal" {{ request('status') === 'Normal' ? 'selected' : '' }}>Level I (NORMAL)</option>
                </select>
            </div>

            <!-- Actions -->
            <div class="flex items-end gap-2">
                <button type="submit" class="flex-1 py-2.5 rounded-xl bg-orange-700 hover:bg-orange-800 text-white font-semibold text-xs transition flex items-center justify-center gap-1.5 shadow-sm">
                    <i data-lucide="filter" class="w-3.5 h-3.5"></i> Terapkan
                </button>
                <a href="{{ route('volcanoes.index') }}" class="p-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 transition" title="Reset">
                    <i data-lucide="rotate-ccw" class="w-4 h-4"></i>
                </a>
            </div>
        </form>
    </div>

    <!-- Volcano Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($volcanoes as $volcano)
            <div class="clean-card overflow-hidden group flex flex-col justify-between">
                <div>
                    <!-- Photo Header -->
                    <div class="h-48 relative overflow-hidden bg-slate-100">
                        <img src="{{ $volcano->image ?? 'https://images.unsplash.com/photo-1544885935-98dd03b09034?auto=format&fit=crop&w=800&q=80' }}" 
                             alt="{{ $volcano->name }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        
                        <div class="absolute top-3 right-3">
                            <span class="px-2.5 py-1 rounded-full text-xs font-semibold {{ $volcano->status_badge['badge'] }} shadow-sm">
                                {{ $volcano->status_badge['label'] }}
                            </span>
                        </div>
                    </div>

                    <!-- Specs -->
                    <div class="p-5 space-y-3">
                        <div>
                            <h3 class="text-lg font-bold text-slate-900 group-hover:text-orange-700 transition">{{ $volcano->name }}</h3>
                            <p class="text-xs text-slate-500 flex items-center gap-1 mt-0.5">
                                <i data-lucide="map-pin" class="w-3 h-3 text-slate-400"></i>
                                <span>{{ $volcano->location }}, {{ $volcano->province }}</span>
                            </p>
                        </div>

                        <div class="grid grid-cols-2 gap-2 text-xs pt-1">
                            <div class="bg-slate-50 p-2.5 rounded-xl border border-slate-100">
                                <span class="text-slate-400 block text-[10px] uppercase font-medium">Tinggi Puncak</span>
                                <span class="font-bold text-slate-800 text-xs">{{ number_format($volcano->height) }} mdpl</span>
                            </div>
                            <div class="bg-slate-50 p-2.5 rounded-xl border border-slate-100">
                                <span class="text-slate-400 block text-[10px] uppercase font-medium">Radius Bahaya</span>
                                <span class="font-bold text-orange-700 text-xs">{{ $volcano->safety_radius }}</span>
                            </div>
                        </div>

                        <p class="text-xs text-slate-500 line-clamp-2 leading-relaxed">
                            {{ $volcano->description }}
                        </p>
                    </div>
                </div>

                <div class="p-5 pt-0">
                    <a href="{{ route('volcanoes.show', $volcano->id) }}" 
                       class="w-full inline-flex items-center justify-center gap-1.5 py-2.5 rounded-xl bg-slate-50 hover:bg-slate-100 text-slate-700 font-semibold text-xs transition border border-slate-200">
                        <span>Detail & Jalur Evakuasi</span>
                        <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i>
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-3 text-center py-16 text-slate-400 clean-card">
                <i data-lucide="search-x" class="w-10 h-10 mx-auto text-slate-300 mb-2"></i>
                <h3 class="text-base font-semibold text-slate-700">Tidak ada gunung yang cocok</h3>
                <p class="text-xs text-slate-400 mt-1">Coba sesuaikan kata kunci pencarian atau reset filter.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div>
        {{ $volcanoes->links() }}
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const volcanoMap = L.map('volcanoMap', { scrollWheelZoom: false }).setView([-2.5, 118.0], 5);

        // OpenStreetMap Standard Tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> kontributor',
            maxZoom: 19,
        }).addTo(volcanoMap);

        function createCustomPin(color) {
            return L.divIcon({
                className: 'custom-map-pin',
                html: `
                    <div style="
                        background-color: ${color};
                        width: 22px;
                        height: 22px;
                        border-radius: 50% 50% 50% 0;
                        transform: rotate(-45deg);
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        border: 2px solid #ffffff;
                        box-shadow: 0 2px 6px rgba(0,0,0,0.25);
                    ">
                        <div style="width: 6px; height: 6px; background: white; border-radius: 50%;"></div>
                    </div>
                `,
                iconSize: [22, 22],
                iconAnchor: [11, 22],
                popupAnchor: [0, -22]
            });
        }

        const allVolcanoes = @json($allVolcanoes);

        allVolcanoes.forEach(v => {
            let color = '#059669';
            let badgeBg = '#ecfdf5';
            let badgeText = '#047857';

            if (v.status_level === 'Awas') {
                color = '#dc2626';
                badgeBg = '#fef2f2';
                badgeText = '#b91c1c';
            } else if (v.status_level === 'Siaga') {
                color = '#ea580c';
                badgeBg = '#fff7ed';
                badgeText = '#c2410c';
            } else if (v.status_level === 'Waspada') {
                color = '#d97706';
                badgeBg = '#fffbeb';
                badgeText = '#b45309';
            }

            const marker = L.marker([v.latitude, v.longitude], {
                icon: createCustomPin(color)
            }).addTo(volcanoMap);

            const popupHtml = `
                <div style="font-family: 'Plus Jakarta Sans', sans-serif; min-width: 190px; padding: 2px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                        <span style="background: ${badgeBg}; color: ${badgeText}; font-size: 10px; font-weight: 700; padding: 2px 8px; border-radius: 9999px; border: 1px solid rgba(0,0,0,0.06);">
                            ${v.status_level}
                        </span>
                        <span style="font-size: 11px; color: #64748b;">${v.height} mdpl</span>
                    </div>
                    <h4 style="font-weight: 700; font-size: 14px; margin: 0 0 2px 0; color: #0f172a;">${v.name}</h4>
                    <p style="font-size: 11px; color: #64748b; margin: 0 0 8px 0;">${v.location}, ${v.province}</p>
                    <div style="font-size: 11px; color: #475569; background: #f8fafc; padding: 4px 8px; border-radius: 6px; margin-bottom: 8px; border: 1px solid #e2e8f0;">
                        Radius Rekomendasi: <strong style="color: #c2410c;">${v.safety_radius}</strong>
                    </div>
                    <a href="/gunung/${v.id}" style="display: block; text-align: center; background: #c2410c; color: white; padding: 5px 10px; border-radius: 6px; font-size: 11px; font-weight: 600; text-decoration: none;">
                        Detail & Evakuasi
                    </a>
                </div>
            `;

            marker.bindPopup(popupHtml);
        });
    });
</script>
@endpush
