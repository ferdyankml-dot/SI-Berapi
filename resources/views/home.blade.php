@extends('layouts.app')

@section('title', 'Beranda - Sistem Informasi Bencana Gunung Berapi')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 sm:pt-14 pb-20 space-y-16">

    <!-- HERO SECTION WITH EDITORIAL MINIMALIST TONE -->
    <section class="max-w-3xl space-y-6">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-orange-50 border border-orange-200 text-orange-800">
            <span class="w-1.5 h-1.5 rounded-full bg-orange-600 animate-pulse"></span>
            <span>Pusat Data Terpadu Aktivitas Vulkanik Indonesia</span>
        </div>

        <h1 class="text-4xl sm:text-5xl font-bold tracking-tight text-slate-900 leading-[1.15]">
            Sistem Pemantauan Status & Mitigasi Bencana Gunung Api
        </h1>

        <p class="text-base sm:text-lg text-slate-600 font-normal leading-relaxed">
            Akses informasi resmi tingkat aktivitas gunung berapi aktif, peta persebaran geospasial, buku saku mitigasi tanggap darurat, dan jejaring pelaporan korban hilang.
        </p>

        <div class="flex flex-wrap items-center gap-3 pt-2">
            <a href="{{ route('volcanoes.index') }}" 
               class="px-5 py-3 rounded-xl bg-orange-700 hover:bg-orange-800 text-white font-semibold text-xs tracking-wide shadow-sm transition flex items-center gap-2">
                <i data-lucide="map" class="w-4 h-4"></i>
                <span>Eksplorasi Peta Status Gunung</span>
            </a>

            <a href="{{ route('missing_persons.index') }}#laporkan" 
               class="px-5 py-3 rounded-xl bg-white hover:bg-slate-50 text-slate-800 border border-slate-200 font-semibold text-xs tracking-wide shadow-sm transition flex items-center gap-2">
                <i data-lucide="user-plus" class="w-4 h-4 text-orange-700"></i>
                <span>Laporkan Orang Hilang</span>
            </a>

            <a href="{{ route('education.index') }}" 
               class="px-4 py-3 text-slate-600 hover:text-slate-900 font-medium text-xs transition">
                Panduan Evakuasi →
            </a>
        </div>
    </section>

    <!-- BENTO GRID: RINGKASAN STATUS & STATISTIK VULKANIK -->
    <section class="space-y-4">
        <div class="flex items-center justify-between">
            <h2 class="text-sm font-semibold uppercase tracking-wider text-slate-500">
                Ringkasan Tingkat Aktivitas Gunung Berapi Nasional
            </h2>
            <span class="text-xs text-slate-400">Klasifikasi PVMBG</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 sm:grid-cols-2 gap-4">
            <!-- LEVEL IV: AWAS -->
            <a href="{{ route('volcanoes.index', ['status' => 'Awas']) }}" 
               class="clean-card p-5 group flex flex-col justify-between hover:border-red-300">
                <div class="flex items-center justify-between mb-4">
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-red-50 text-red-700 border border-red-200">
                        <span class="w-1.5 h-1.5 rounded-full bg-red-600 animate-pulse"></span>
                        Level IV
                    </span>
                    <i data-lucide="arrow-up-right" class="w-4 h-4 text-slate-300 group-hover:text-red-600 transition"></i>
                </div>
                <div>
                    <div class="text-3xl font-bold text-slate-900 group-hover:text-red-700 transition">
                        {{ $statusCounts['Awas'] ?? 0 }}
                    </div>
                    <div class="font-semibold text-slate-800 text-sm mt-1">Status AWAS</div>
                    <p class="text-xs text-slate-500 mt-0.5">Letusan utama berpotensi terjadi segera</p>
                </div>
            </a>

            <!-- LEVEL III: SIAGA -->
            <a href="{{ route('volcanoes.index', ['status' => 'Siaga']) }}" 
               class="clean-card p-5 group flex flex-col justify-between hover:border-orange-300">
                <div class="flex items-center justify-between mb-4">
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-orange-50 text-orange-700 border border-orange-200">
                        <span class="w-1.5 h-1.5 rounded-full bg-orange-600"></span>
                        Level III
                    </span>
                    <i data-lucide="arrow-up-right" class="w-4 h-4 text-slate-300 group-hover:text-orange-600 transition"></i>
                </div>
                <div>
                    <div class="text-3xl font-bold text-slate-900 group-hover:text-orange-700 transition">
                        {{ $statusCounts['Siaga'] ?? 0 }}
                    </div>
                    <div class="font-semibold text-slate-800 text-sm mt-1">Status SIAGA</div>
                    <p class="text-xs text-slate-500 mt-0.5">Peningkatan seismik & visual nyata</p>
                </div>
            </a>

            <!-- LEVEL II: WASPADA -->
            <a href="{{ route('volcanoes.index', ['status' => 'Waspada']) }}" 
               class="clean-card p-5 group flex flex-col justify-between hover:border-amber-300">
                <div class="flex items-center justify-between mb-4">
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-200">
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                        Level II
                    </span>
                    <i data-lucide="arrow-up-right" class="w-4 h-4 text-slate-300 group-hover:text-amber-600 transition"></i>
                </div>
                <div>
                    <div class="text-3xl font-bold text-slate-900 group-hover:text-amber-700 transition">
                        {{ $statusCounts['Waspada'] ?? 0 }}
                    </div>
                    <div class="font-semibold text-slate-800 text-sm mt-1">Status WASPADA</div>
                    <p class="text-xs text-slate-500 mt-0.5">Aktivitas di atas tingkat normal</p>
                </div>
            </a>

            <!-- LEVEL I: NORMAL -->
            <a href="{{ route('volcanoes.index', ['status' => 'Normal']) }}" 
               class="clean-card p-5 group flex flex-col justify-between hover:border-emerald-300">
                <div class="flex items-center justify-between mb-4">
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        Level I
                    </span>
                    <i data-lucide="arrow-up-right" class="w-4 h-4 text-slate-300 group-hover:text-emerald-600 transition"></i>
                </div>
                <div>
                    <div class="text-3xl font-bold text-slate-900 group-hover:text-emerald-700 transition">
                        {{ $statusCounts['Normal'] ?? 0 }}
                    </div>
                    <div class="font-semibold text-slate-800 text-sm mt-1">Status NORMAL</div>
                    <p class="text-xs text-slate-500 mt-0.5">Kondisi dasar tenang tanpa indikasi bahaya</p>
                </div>
            </a>
        </div>
    </section>

    <!-- INTERACTIVE MAP BENTO SECTION -->
    <section class="space-y-4">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-2">
            <div>
                <h2 class="text-2xl font-bold tracking-tight text-slate-900">
                    Peta Sebaran Gunung Api
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 mt-0.5">
                    Klik marker untuk melihat ketinggian, provinsi, dan radius aman rekomendasi PVMBG.
                </p>
            </div>
            <a href="{{ route('volcanoes.index') }}" class="text-xs font-semibold text-orange-700 hover:text-orange-800 flex items-center gap-1 transition">
                <span>Buka Katalog Lengkap</span>
                <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
            </a>
        </div>

        <div class="clean-card overflow-hidden rounded-2xl relative">
            <div id="homeMap" class="w-full h-[420px] z-10"></div>
            
            <!-- Map Legend in Bottom Corner -->
            <div class="absolute bottom-4 right-4 z-20 bg-white/95 backdrop-blur-sm border border-slate-200/80 p-3 rounded-xl text-xs space-y-1.5 shadow-sm hidden sm:block">
                <div class="font-semibold text-slate-800 text-[11px] mb-1">Status Level:</div>
                <div class="flex items-center gap-2 text-slate-600 text-[11px]">
                    <span class="w-2.5 h-2.5 rounded-full bg-red-600"></span> Awas (Level IV)
                </div>
                <div class="flex items-center gap-2 text-slate-600 text-[11px]">
                    <span class="w-2.5 h-2.5 rounded-full bg-orange-600"></span> Siaga (Level III)
                </div>
                <div class="flex items-center gap-2 text-slate-600 text-[11px]">
                    <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span> Waspada (Level II)
                </div>
                <div class="flex items-center gap-2 text-slate-600 text-[11px]">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-600"></span> Normal (Level I)
                </div>
            </div>
        </div>
    </section>

    <!-- PRIORITAS AKTIVITAS & LAPORAN TERBARU GRID -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Col Left (2 Cols): Gunung Pantauan Prioritas -->
        <div class="lg:col-span-2 space-y-4">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-bold text-slate-900">
                    Gunung Api Dalam Pantauan Prioritas
                </h3>
                <span class="text-xs text-slate-500">Status Awas & Siaga</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @foreach($priorityVolcanoes->take(4) as $volcano)
                    <div class="clean-card overflow-hidden group flex flex-col justify-between">
                        <div>
                            <div class="h-40 relative overflow-hidden bg-slate-100">
                                <img src="{{ $volcano->image ?? 'https://images.unsplash.com/photo-1544885935-98dd03b09034?auto=format&fit=crop&w=800&q=80' }}" 
                                     alt="{{ $volcano->name }}" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                
                                <div class="absolute top-3 right-3">
                                    <span class="px-2.5 py-1 rounded-full text-xs font-semibold {{ $volcano->status_badge['badge'] }} shadow-sm">
                                        {{ $volcano->status_badge['label'] }}
                                    </span>
                                </div>
                            </div>

                            <div class="p-4 space-y-2">
                                <h4 class="font-bold text-base text-slate-900 group-hover:text-orange-700 transition">{{ $volcano->name }}</h4>
                                <p class="text-xs text-slate-500 flex items-center gap-1">
                                    <i data-lucide="map-pin" class="w-3.5 h-3.5 text-slate-400"></i>
                                    <span>{{ $volcano->location }}, {{ $volcano->province }}</span>
                                </p>

                                <div class="grid grid-cols-2 gap-2 text-xs pt-1">
                                    <div class="bg-slate-50 p-2 rounded-lg border border-slate-100">
                                        <span class="text-slate-400 block text-[10px]">Tinggi</span>
                                        <span class="font-semibold text-slate-800">{{ number_format($volcano->height) }} mdpl</span>
                                    </div>
                                    <div class="bg-slate-50 p-2 rounded-lg border border-slate-100">
                                        <span class="text-slate-400 block text-[10px]">Radius Aman</span>
                                        <span class="font-semibold text-orange-700">{{ $volcano->safety_radius }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="p-4 pt-0">
                            <a href="{{ route('volcanoes.show', $volcano->id) }}" 
                               class="w-full inline-flex items-center justify-center py-2 rounded-xl bg-slate-50 hover:bg-slate-100 text-slate-700 font-medium text-xs transition border border-slate-200">
                                Detail & Rekomendasi
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Col Right (1 Col): Laporan Orang Hilang Terkini -->
        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-bold text-slate-900">
                    Laporan Orang Hilang
                </h3>
                <a href="{{ route('missing_persons.index') }}" class="text-xs text-orange-700 font-semibold hover:underline">Semua</a>
            </div>

            <div class="space-y-3">
                @forelse($recentMissing as $missing)
                    <div class="clean-card p-3.5 flex items-center gap-3">
                        <img src="{{ $missing->photo ?? 'https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?auto=format&fit=crop&w=150&q=80' }}" 
                             alt="{{ $missing->victim_name }}" 
                             class="w-14 h-14 rounded-xl object-cover shrink-0 border border-slate-100">
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between gap-1 mb-0.5">
                                <h4 class="font-bold text-xs text-slate-900 truncate">{{ $missing->victim_name }}</h4>
                                @if($missing->status === 'Dicari')
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold bg-red-50 text-red-700 border border-red-200 shrink-0">
                                        Dicari
                                    </span>
                                @else
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200 shrink-0">
                                        Ditemukan
                                    </span>
                                @endif
                            </div>
                            <p class="text-[11px] text-slate-500 truncate">{{ $missing->volcano?->name ?? 'Kawasan Terkait' }} • {{ $missing->age }} th</p>
                            <p class="text-[10px] text-slate-400 mt-1">Hilang: {{ $missing->last_seen_date?->format('d M Y') }}</p>
                        </div>
                    </div>
                @empty
                    <div class="clean-card p-6 text-center text-xs text-slate-400">
                        Belum ada laporan orang hilang.
                    </div>
                @endforelse

                <a href="{{ route('missing_persons.index') }}#laporkan" 
                   class="block text-center py-2.5 rounded-xl bg-orange-50 hover:bg-orange-100 text-orange-800 font-semibold text-xs transition border border-orange-200">
                    + Buat Laporan Orang Hilang
                </a>
            </div>
        </div>
    </div>

    <!-- CLEAN 3-STEP MITIGATION SECTION -->
    <section class="space-y-6 pt-4">
        <div>
            <span class="text-xs font-semibold text-orange-700 uppercase tracking-wider block mb-1">Kesiapsiagaan Mandiri</span>
            <h2 class="text-2xl font-bold tracking-tight text-slate-900">3 Pedoman Keselamatan Bencana</h2>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">Tindakan perlindungan diri terarah dari PVMBG dan BNPB.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <!-- Pra -->
            <div class="clean-card p-6 space-y-3">
                <div class="w-9 h-9 rounded-xl bg-orange-50 text-orange-700 flex items-center justify-center font-bold text-xs">
                    01
                </div>
                <h3 class="font-bold text-base text-slate-900">Pra-Bencana (Persiapan)</h3>
                <p class="text-xs text-slate-600 leading-relaxed">
                    Siapkan Tas Siaga Bencana (TSB) berisi dokumen, senter, obat pribadi, dan masker N95. Kenali jalur evakuasi desa dan lokasi shelter pengungsian.
                </p>
            </div>

            <!-- Saat -->
            <div class="clean-card p-6 space-y-3">
                <div class="w-9 h-9 rounded-xl bg-red-50 text-red-700 flex items-center justify-center font-bold text-xs">
                    02
                </div>
                <h3 class="font-bold text-base text-slate-900">Saat Erupsi (Tanggap)</h3>
                <p class="text-xs text-slate-600 leading-relaxed">
                    Segera tinggalkan radius steril tanpa menunda. Lindungi mata dan pernapasan dari silika tajam abu vulkanik. Jauhi lembah aliran sungai lahar.
                </p>
            </div>

            <!-- Pasca -->
            <div class="clean-card p-6 space-y-3">
                <div class="w-9 h-9 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center font-bold text-xs">
                    03
                </div>
                <h3 class="font-bold text-base text-slate-900">Pasca-Bencana (Pemulihan)</h3>
                <p class="text-xs text-slate-600 leading-relaxed">
                    Kembali ke pemukiman hanya setelah diizinkan resmi oleh aparat. Bersihkan abu dari atap dengan hati-hati dan pastikan air bersih tidak tercemar.
                </p>
            </div>
        </div>
    </section>

</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const homeMap = L.map('homeMap', { scrollWheelZoom: false }).setView([-2.5, 118.0], 5);

        // OpenStreetMap Standard Tiles (Gratis & Bebas API Key)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> kontributor',
            maxZoom: 19,
        }).addTo(homeMap);

        // Custom Minimalist Pin Generator
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

        const volcanoData = @json($allVolcanoes);

        volcanoData.forEach(v => {
            let color = '#059669'; // Emerald
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
            }).addTo(homeMap);

            const popupContent = `
                <div style="font-family: 'Plus Jakarta Sans', sans-serif; min-width: 190px; padding: 2px;">
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 6px;">
                        <span style="background: ${badgeBg}; color: ${badgeText}; font-size: 10px; font-weight: 700; padding: 2px 8px; border-radius: 9999px; border: 1px solid rgba(0,0,0,0.06);">
                            ${v.status_level}
                        </span>
                        <span style="font-size: 11px; color: #64748b;">${v.height} mdpl</span>
                    </div>
                    <h4 style="font-weight: 700; font-size: 14px; margin: 0 0 2px 0; color: #0f172a;">${v.name}</h4>
                    <p style="font-size: 11px; color: #64748b; margin: 0 0 8px 0;">${v.province}</p>
                    <div style="font-size: 11px; color: #475569; background: #f8fafc; padding: 4px 8px; border-radius: 6px; margin-bottom: 8px; border: 1px solid #e2e8f0;">
                        Radius Aman: <strong style="color: #c2410c;">${v.safety_radius}</strong>
                    </div>
                    <a href="/gunung/${v.id}" style="display: block; text-align: center; background: #c2410c; color: white; padding: 5px 10px; border-radius: 6px; font-size: 11px; font-weight: 600; text-decoration: none;">
                        Lihat Data Lengkap
                    </a>
                </div>
            `;

            marker.bindPopup(popupContent);
        });
    });
</script>
@endpush
