@extends('layouts.app')

@section('title', $volcano->name . ' - Status & Mitigasi - SI-Berapi')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6 pb-20 space-y-8">
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-xs text-slate-500">
        <a href="{{ route('home') }}" class="hover:text-slate-900 transition">Beranda</a>
        <i data-lucide="chevron-right" class="w-3 h-3 text-slate-400"></i>
        <a href="{{ route('volcanoes.index') }}" class="hover:text-slate-900 transition">Gunung Rawan</a>
        <i data-lucide="chevron-right" class="w-3 h-3 text-slate-400"></i>
        <span class="text-slate-900 font-semibold">{{ $volcano->name }}</span>
    </nav>

    <!-- Header Card -->
    <div class="clean-card overflow-hidden">
        <div class="relative h-64 sm:h-80 w-full overflow-hidden bg-slate-100">
            <img src="{{ $volcano->image ?? 'https://images.unsplash.com/photo-1544885935-98dd03b09034?auto=format&fit=crop&w=1200&q=80' }}" 
                 alt="{{ $volcano->name }}" 
                 class="w-full h-full object-cover">
            
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-slate-950/20 to-transparent"></div>

            <div class="absolute top-4 sm:top-6 right-4 sm:right-6">
                <span class="px-3.5 py-1.5 rounded-full text-xs font-semibold {{ $volcano->status_badge['badge'] }} shadow-sm bg-white/95 backdrop-blur-sm">
                    {{ $volcano->status_badge['label'] }}
                </span>
            </div>

            <div class="absolute bottom-6 left-6 right-6 flex flex-col sm:flex-row sm:items-end justify-between gap-4 text-white">
                <div>
                    <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-white">{{ $volcano->name }}</h1>
                    <p class="text-xs sm:text-sm text-slate-200 flex items-center gap-1.5 mt-1">
                        <i data-lucide="map-pin" class="w-4 h-4 text-orange-400"></i>
                        <span>{{ $volcano->location }}, {{ $volcano->province }}</span>
                    </p>
                </div>
                <div>
                    <a href="{{ route('missing_persons.index') }}#laporkan" 
                       class="px-4 py-2.5 rounded-xl bg-orange-700 hover:bg-orange-800 text-white font-semibold text-xs tracking-wide shadow-sm flex items-center gap-2 transition">
                        <i data-lucide="user-plus" class="w-4 h-4"></i> Lapor Korban di Sini
                    </a>
                </div>
            </div>
        </div>

        <!-- Metric Bar Minimalis -->
        <div class="grid grid-cols-2 sm:grid-cols-4 divide-y sm:divide-y-0 sm:divide-x divide-slate-100 bg-slate-50/70 p-3 text-center">
            <div class="p-3">
                <span class="text-[11px] text-slate-500 uppercase font-medium">Tinggi Puncak</span>
                <p class="text-lg sm:text-xl font-bold text-slate-900 mt-0.5">{{ number_format($volcano->height) }} mdpl</p>
            </div>
            <div class="p-3">
                <span class="text-[11px] text-slate-500 uppercase font-medium">Radius Steril Bahaya</span>
                <p class="text-lg sm:text-xl font-bold text-orange-700 mt-0.5">{{ $volcano->safety_radius }}</p>
            </div>
            <div class="p-3">
                <span class="text-[11px] text-slate-500 uppercase font-medium">Koordinat GPS</span>
                <p class="text-xs sm:text-sm font-semibold text-slate-700 mt-1">{{ $volcano->latitude }}, {{ $volcano->longitude }}</p>
            </div>
            <div class="p-3">
                <span class="text-[11px] text-slate-500 uppercase font-medium">Tingkat Status</span>
                <p class="text-lg sm:text-xl font-bold text-slate-900 mt-0.5">{{ $volcano->status_level }}</p>
            </div>
        </div>
    </div>

    <!-- Main Content & Evacuation Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Col Left (2 Cols) -->
        <div class="lg:col-span-2 space-y-6">
            <!-- About Volcano -->
            <div class="clean-card p-6 sm:p-7 space-y-4">
                <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                    <i data-lucide="info" class="w-4 h-4 text-orange-700"></i> Karakteristik & Kondisi Terkini
                </h2>
                <div class="text-slate-600 text-xs sm:text-sm leading-relaxed space-y-3">
                    <p>{{ $volcano->description }}</p>
                    <div class="text-xs text-slate-700 bg-orange-50/60 p-4 rounded-xl border border-orange-200/70">
                        <strong>Rekomendasi Resmi PVMBG:</strong> Masyarakat, wisatawan, dan pendaki dilarang mendekati kawah dalam radius <strong>{{ $volcano->safety_radius }}</strong>. Tetap waspada terhadap potensi perluasan awan panas guguran dan bahaya banjir lahar hujan di lembah aliran sungai.
                    </div>
                </div>
            </div>

            <!-- Leaflet Radius Map -->
            <div class="clean-card p-6 space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                            <i data-lucide="disc" class="w-4 h-4 text-orange-700"></i> Peta Radius Bahaya & Posisi Kawah
                        </h2>
                        <p class="text-xs text-slate-500 mt-0.5">Lingkaran merah menandai perimeter zona KRB III / radius steril.</p>
                    </div>
                </div>
                <div id="detailMap" class="w-full h-80 rounded-xl z-10 border border-slate-200"></div>
            </div>

            <!-- Eruption History of this Volcano -->
            <div class="clean-card p-6 space-y-4">
                <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                    <i data-lucide="history" class="w-4 h-4 text-orange-700"></i> Catatan Riwayat Letusan
                </h2>

                <div class="space-y-3">
                    @forelse($volcano->disasterHistories as $history)
                        <div class="p-4 rounded-xl bg-slate-50/70 border border-slate-200/80 space-y-2">
                            <div class="flex items-center justify-between">
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-white text-slate-700 border border-slate-200">
                                    {{ $history->event_date?->format('d F Y') }}
                                </span>
                                <span class="text-xs text-slate-500 font-medium">
                                    Korban: <strong class="text-slate-900">{{ $history->casualties_count }} Jiwa</strong>
                                </span>
                            </div>
                            <h3 class="font-semibold text-xs sm:text-sm text-slate-900">{{ $history->description }}</h3>
                            <p class="text-xs text-slate-500 leading-relaxed">{{ $history->impact_summary }}</p>
                        </div>
                    @empty
                        <p class="text-xs text-slate-400 italic py-2">Belum ada arsip riwayat erupsi besar tercatat untuk gunung ini.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Col Right (1 Col) -->
        <div class="space-y-6">
            <!-- Jalur Evakuasi Minimalis -->
            <div class="clean-card p-6 space-y-4">
                <h3 class="font-bold text-sm text-slate-900 flex items-center gap-2">
                    <i data-lucide="shield" class="w-4 h-4 text-orange-700"></i> Jalur Evakuasi & Titik Kumpul
                </h3>

                <div class="space-y-3 text-xs">
                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-100 space-y-1">
                        <span class="font-semibold text-slate-800 block">Titik Kumpul Utama (Shelter)</span>
                        <p class="text-slate-500">Lapangan Balai Desa terdekat yang berjarak aman di luar radius rekomendasi.</p>
                    </div>

                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-100 space-y-1">
                        <span class="font-semibold text-slate-800 block">Arah Jalur Evakuasi</span>
                        <p class="text-slate-500">Ikuti rambu penunjuk arah evakuasi menuju jalan arteri kabupaten, hindari jalur lembah sungai.</p>
                    </div>

                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-100 space-y-1">
                        <span class="font-semibold text-slate-800 block">Pos Pengamatan Gunung Api (PGA)</span>
                        <p class="text-slate-500">Petugas pengamat bersiaga 24 jam dengan sambungan komunikasi radio darurat.</p>
                    </div>
                </div>

                <a href="{{ route('contact.index') }}" class="block text-center w-full py-2.5 rounded-xl bg-orange-700 hover:bg-orange-800 text-white font-semibold text-xs transition shadow-sm">
                    Hubungi Hotline Posko
                </a>
            </div>

            <!-- Missing Persons in this Volcano -->
            <div class="clean-card p-6 space-y-4">
                <div class="flex items-center justify-between">
                    <h3 class="font-bold text-sm text-slate-900 flex items-center gap-2">
                        <i data-lucide="users" class="w-4 h-4 text-orange-700"></i> Laporan Korban Terkait
                    </h3>
                    <span class="text-xs px-2 py-0.5 rounded-full bg-slate-100 text-slate-600 font-medium">
                        {{ $volcano->missingPersons->count() }}
                    </span>
                </div>

                <div class="space-y-3">
                    @forelse($volcano->missingPersons as $person)
                        <div class="p-3 rounded-xl bg-slate-50 border border-slate-100 flex items-center gap-3">
                            <img src="{{ $person->photo ?? 'https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?auto=format&fit=crop&w=200&q=80' }}" 
                                 alt="{{ $person->victim_name }}" 
                                 class="w-11 h-11 rounded-lg object-cover border border-slate-200">
                            <div class="flex-1 min-w-0">
                                <h4 class="font-semibold text-xs text-slate-900 truncate">{{ $person->victim_name }}</h4>
                                <p class="text-[11px] text-slate-500">{{ $person->age }} th • Hilang: {{ $person->last_seen_date?->format('d M Y') }}</p>
                                <span class="text-[10px] font-semibold {{ $person->status === 'Dicari' ? 'text-red-700' : 'text-emerald-700' }}">
                                    {{ $person->status === 'Dicari' ? '● Masih Dicari' : '✓ Ditemukan' }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <p class="text-xs text-slate-400 italic py-2">Tidak ada laporan korban hilang di gunung ini.</p>
                    @endforelse
                </div>

                <a href="{{ route('missing_persons.index') }}" class="block text-center text-xs text-orange-700 hover:underline pt-1 font-medium">
                    Lihat Papan Orang Hilang →
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const lat = {{ $volcano->latitude }};
        const lng = {{ $volcano->longitude }};
        const status = "{{ $volcano->status_level }}";
        
        let color = '#059669';
        if (status === 'Awas') color = '#dc2626';
        else if (status === 'Siaga') color = '#ea580c';
        else if (status === 'Waspada') color = '#d97706';

        const detailMap = L.map('detailMap', { scrollWheelZoom: false }).setView([lat, lng], 11);

        // OpenStreetMap Standard Tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> kontributor',
            maxZoom: 19,
        }).addTo(detailMap);

        // Marker Peak
        const customPin = L.divIcon({
            className: 'custom-map-pin',
            html: `
                <div style="
                    background-color: ${color};
                    width: 24px;
                    height: 24px;
                    border-radius: 50% 50% 50% 0;
                    transform: rotate(-45deg);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    border: 2px solid #ffffff;
                    box-shadow: 0 2px 8px rgba(0,0,0,0.3);
                ">
                    <div style="width: 7px; height: 7px; background: white; border-radius: 50%;"></div>
                </div>
            `,
            iconSize: [24, 24],
            iconAnchor: [12, 24],
        });

        L.marker([lat, lng], { icon: customPin }).addTo(detailMap)
            .bindPopup("<strong>{{ $volcano->name }}</strong><br>Puncak Kawah Aktif ({{ $volcano->height }} mdpl)")
            .openPopup();

        // Safety Radius Circle
        let radiusKm = 5;
        const radiusMatch = "{{ $volcano->safety_radius }}".match(/([\d.]+)/);
        if (radiusMatch) {
            radiusKm = parseFloat(radiusMatch[1]);
        }
        const radiusMeters = radiusKm * 1000;

        L.circle([lat, lng], {
            color: '#c2410c',
            fillColor: '#c2410c',
            fillOpacity: 0.12,
            radius: radiusMeters,
            weight: 1.5,
            dashArray: '4, 4'
        }).addTo(detailMap).bindPopup(`<strong>Zona KRB III / Radius Bahaya:</strong> ${radiusKm} KM dari puncak.`);
    });
</script>
@endpush
