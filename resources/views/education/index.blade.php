@extends('layouts.app')

@section('title', 'Edukasi Mitigasi Gunung Berapi - SI-Berapi')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 sm:pt-12 pb-20 space-y-10" x-data="{ currentTab: '{{ $activeTab }}' }">
    <!-- Header -->
    <div class="max-w-3xl space-y-2">
        <span class="text-xs font-semibold uppercase tracking-wider text-orange-700 block">
            Pusat Pengetahuan Kebencanaan
        </span>
        <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-slate-900">
            Edukasi Vulkanologi & Panduan Mitigasi
        </h1>
        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
            Materi pemahaman ilmiah proses vulkanik di Indonesia, analisis dampak erupsi, serta pedoman keselamatan pra, saat, dan pasca letusan.
        </p>
    </div>

    <!-- Minimalist Tabs Navigation -->
    <div class="flex flex-wrap items-center gap-1.5 p-1.5 bg-slate-100/80 rounded-2xl max-w-xl border border-slate-200/80">
        <button type="button" 
                @click="currentTab = 'definisi'"
                :class="currentTab === 'definisi' ? 'bg-white text-orange-700 shadow-sm font-semibold' : 'text-slate-600 hover:text-slate-900'"
                class="px-4 py-2 rounded-xl text-xs sm:text-sm font-medium transition flex items-center gap-1.5">
            <i data-lucide="mountain" class="w-3.5 h-3.5"></i>
            <span>Definisi & Tipe</span>
        </button>

        <button type="button" 
                @click="currentTab = 'penyebab'"
                :class="currentTab === 'penyebab' ? 'bg-white text-orange-700 shadow-sm font-semibold' : 'text-slate-600 hover:text-slate-900'"
                class="px-4 py-2 rounded-xl text-xs sm:text-sm font-medium transition flex items-center gap-1.5">
            <i data-lucide="flame" class="w-3.5 h-3.5"></i>
            <span>Penyebab Erupsi</span>
        </button>

        <button type="button" 
                @click="currentTab = 'dampak'"
                :class="currentTab === 'dampak' ? 'bg-white text-orange-700 shadow-sm font-semibold' : 'text-slate-600 hover:text-slate-900'"
                class="px-4 py-2 rounded-xl text-xs sm:text-sm font-medium transition flex items-center gap-1.5">
            <i data-lucide="scale" class="w-3.5 h-3.5"></i>
            <span>Dampak Positif / Negatif</span>
        </button>

        <button type="button" 
                @click="currentTab = 'mitigasi'"
                :class="currentTab === 'mitigasi' ? 'bg-white text-orange-700 shadow-sm font-semibold' : 'text-slate-600 hover:text-slate-900'"
                class="px-4 py-2 rounded-xl text-xs sm:text-sm font-medium transition flex items-center gap-1.5">
            <i data-lucide="shield-check" class="w-3.5 h-3.5"></i>
            <span>Panduan Mitigasi</span>
        </button>
    </div>

    <!-- TAB 1: DEFINISI & TIPE -->
    <div x-show="currentTab === 'definisi'" x-transition:enter="transition duration-150" class="space-y-6">
        <div class="clean-card p-6 sm:p-8 space-y-6">
            <div class="space-y-2">
                <h2 class="text-xl font-bold text-slate-900">Morfologi & Karakteristik Gunung Berapi</h2>
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                    Gunung berapi merupakan bukaan pada kerak bumi tempat magma, gas, dan material piroklastika naik ke permukaan. Terletak di zona Cincin Api Pasifik (<em>Ring of Fire</em>), Indonesia memiliki lebih dari 127 gunung api aktif.
                </p>
            </div>

            <!-- Tipe Gunung Berapi -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 pt-2">
                <div class="p-5 rounded-xl bg-slate-50 border border-slate-200/80 space-y-2">
                    <span class="text-xs font-bold text-orange-700">01</span>
                    <h3 class="font-bold text-sm text-slate-900">Stratovolcano (Kerucut)</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Tipe paling dominan di Indonesia (Merapi, Semeru, Sinabung). Terdiri dari lapisan lava dan material piroklastik yang mengeras bergantian dengan lereng curam.
                    </p>
                </div>

                <div class="p-5 rounded-xl bg-slate-50 border border-slate-200/80 space-y-2">
                    <span class="text-xs font-bold text-orange-700">02</span>
                    <h3 class="font-bold text-sm text-slate-900">Kaldera Raksasa</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Cekungan runtuhan masif pasca erupsi dahsyat yang mengosongkan dapur magma (contoh: Danau Toba, Maninjau, Kaldera Krakatau).
                    </p>
                </div>

                <div class="p-5 rounded-xl bg-slate-50 border border-slate-200/80 space-y-2">
                    <span class="text-xs font-bold text-orange-700">03</span>
                    <h3 class="font-bold text-sm text-slate-900">Kubah Lava</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Gundukan lava kental asam yang membeku di lubang kepundan kawah, berisiko runtuh akibat gravitasi menjadi awan panas guguran.
                    </p>
                </div>
            </div>

            <!-- Tipe Erupsi -->
            <div class="pt-4 border-t border-slate-100">
                <h3 class="font-bold text-sm text-slate-900 mb-3">Tipe Erupsi yang Sering Terjadi:</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
                    <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-100">
                        <strong class="text-slate-900 block mb-1">Erupsi Eksplosif (Plinian)</strong>
                        <span class="text-slate-500 leading-relaxed">Letusan dahsyat bertekanan gas tinggi yang menyemburkan kolom abu hingga belasan kilometer ke atmosfer.</span>
                    </div>
                    <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-100">
                        <strong class="text-slate-900 block mb-1">Erupsi Efusif (Lelehan)</strong>
                        <span class="text-slate-500 leading-relaxed">Magma encer mengalir perlahan membentuk lidah lava tanpa ledakan besar yang merusak secara mendadak.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- TAB 2: PENYEBAB ERUPSI -->
    <div x-show="currentTab === 'penyebab'" x-transition:enter="transition duration-150" class="space-y-6" style="display: none;">
        <div class="clean-card p-6 sm:p-8 space-y-6">
            <div class="space-y-2">
                <h2 class="text-xl font-bold text-slate-900">Mekanisme Terjadinya Erupsi Magmatik</h2>
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                    Erupsi terjadi akibat akumulasi tekanan internal gas dan magma di dalam litosfer yang melampaui kekuatan batuan penutup bumi.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/80 space-y-1.5">
                    <span class="text-xs font-bold text-orange-700">Langkah 1</span>
                    <h3 class="font-semibold text-xs text-slate-900">Subduksi Lempeng</h3>
                    <p class="text-[11px] text-slate-500 leading-relaxed">Penunjaman lempeng tektonik menghasilkan pelelehan batuan menjadi magma baru.</p>
                </div>
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/80 space-y-1.5">
                    <span class="text-xs font-bold text-orange-700">Langkah 2</span>
                    <h3 class="font-semibold text-xs text-slate-900">Magma Bergerak Naik</h3>
                    <p class="text-[11px] text-slate-500 leading-relaxed">Kerapatan yang lebih rendah dibanding batuan padat mendorong magma cair naik ke atas.</p>
                </div>
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/80 space-y-1.5">
                    <span class="text-xs font-bold text-orange-700">Langkah 3</span>
                    <h3 class="font-semibold text-xs text-slate-900">Ekspansi Gas</h3>
                    <p class="text-[11px] text-slate-500 leading-relaxed">Penurunan tekanan menyebabkan gelembung uap air & gas terlarut berekspansi kuat.</p>
                </div>
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/80 space-y-1.5">
                    <span class="text-xs font-bold text-orange-700">Langkah 4</span>
                    <h3 class="font-semibold text-xs text-slate-900">Pelepasan Energi</h3>
                    <p class="text-[11px] text-slate-500 leading-relaxed">Tersumbatnya pipa kepundan memicu ledakan material abu dan lava pijar keluar kawah.</p>
                </div>
            </div>

            <div class="p-4 rounded-xl bg-orange-50/70 border border-orange-200/80 space-y-2 text-xs">
                <span class="font-bold text-orange-950 block">Tanda-Tanda Awal Peningkatan Aktivitas Menuju Erupsi:</span>
                <ul class="list-disc list-inside text-slate-700 space-y-1">
                    <li>Peningkatan frekuensi gempa vulkanik dangkal dan gempa tremor terus-menerus.</li>
                    <li>Penggembungan (inflasi) bentuk lereng gunung yang terdeteksi sensor tiltmeter/GPS.</li>
                    <li>Kenaikan suhu kawah dan mata air panas di sekitar lereng.</li>
                    <li>Satwa liar hutan turun gunung secara serentak karena mencium gas vulkanik.</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- TAB 3: DAMPAK POSITIF VS NEGATIF -->
    <div x-show="currentTab === 'dampak'" x-transition:enter="transition duration-150" class="space-y-6" style="display: none;">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Negatif -->
            <div class="clean-card p-6 space-y-4">
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-red-600"></span>
                    <h2 class="text-lg font-bold text-slate-900">Dampak Bahaya (Negatif)</h2>
                </div>
                <div class="space-y-3 text-xs text-slate-600">
                    <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-100 space-y-1">
                        <strong class="text-slate-900 text-xs">1. Awan Panas Guguran (Pyroclastic Density Current)</strong>
                        <p class="text-slate-500">Campuran gas bersuhu 300°–800°C yang meluncur dengan kecepatan hingga 200 km/jam menyusuri lembah.</p>
                    </div>
                    <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-100 space-y-1">
                        <strong class="text-slate-900 text-xs">2. Banjir Lahar Dingin Hujan</strong>
                        <p class="text-slate-500">Endapan jutaan meter kubik material pasir dan batu di lereng atas yang terangkut aliran hujan lebat ke hilir sungai.</p>
                    </div>
                    <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-100 space-y-1">
                        <strong class="text-slate-900 text-xs">3. Hujan Abu & Gas Beracun</strong>
                        <p class="text-slate-500">Silika tajam yang mengganggu pernapasan (ISPA), korosi atap rumah, serta gas CO2/SO2 konsentrasi tinggi.</p>
                    </div>
                </div>
            </div>

            <!-- Positif -->
            <div class="clean-card p-6 space-y-4">
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-600"></span>
                    <h2 class="text-lg font-bold text-slate-900">Berkah Alam (Positif)</h2>
                </div>
                <div class="space-y-3 text-xs text-slate-600">
                    <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-100 space-y-1">
                        <strong class="text-slate-900 text-xs">1. Kesuburan Tanah Vulkanik</strong>
                        <p class="text-slate-500">Lapisan abu lapuk kaya mineral fosfor dan kalium yang menopang ketahanan pangan dan perkebunan produktif.</p>
                    </div>
                    <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-100 space-y-1">
                        <strong class="text-slate-900 text-xs">2. Potensi Panas Bumi (Geothermal)</strong>
                        <p class="text-slate-500">Sumber energi listrik terbarukan ramah lingkungan tanpa emisi karbon fosil (contoh: PLTP Kamojang, Dieng).</p>
                    </div>
                    <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-100 space-y-1">
                        <strong class="text-slate-900 text-xs">3. Material Konstruksi & Ekowisata</strong>
                        <p class="text-slate-500">Pasir dan batu andesit berkualitas tinggi untuk pembangunan, serta keindahan geowisata Kaldera Bromo, Ijen, dan Rinjani.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- TAB 4: PANDUAN MITIGASI -->
    <div x-show="currentTab === 'mitigasi'" x-transition:enter="transition duration-150" class="space-y-6" style="display: none;">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <div class="clean-card p-6 space-y-3">
                <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-orange-50 text-orange-700 border border-orange-200">
                    Fase 1: Kesiapsiagaan
                </span>
                <h3 class="font-bold text-base text-slate-900">Pra-Bencana</h3>
                <ul class="text-xs text-slate-600 space-y-2">
                    <li class="flex items-start gap-2">
                        <i data-lucide="check" class="w-3.5 h-3.5 text-orange-700 shrink-0 mt-0.5"></i>
                        <span>Siapkan Tas Siaga Bencana (TSB) berisi dokumen & perbekalan 72 jam.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i data-lucide="check" class="w-3.5 h-3.5 text-orange-700 shrink-0 mt-0.5"></i>
                        <span>Pahami batas zona Kawasan Rawan Bencana (KRB III, II, I).</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i data-lucide="check" class="w-3.5 h-3.5 text-orange-700 shrink-0 mt-0.5"></i>
                        <span>Sepakati lokasi titik kumpul bersama seluruh anggota keluarga.</span>
                    </li>
                </ul>
            </div>

            <div class="clean-card p-6 space-y-3">
                <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-red-50 text-red-700 border border-red-200">
                    Fase 2: Tanggap Darurat
                </span>
                <h3 class="font-bold text-base text-slate-900">Saat Terjadi Erupsi</h3>
                <ul class="text-xs text-slate-600 space-y-2">
                    <li class="flex items-start gap-2">
                        <i data-lucide="check" class="w-3.5 h-3.5 text-red-700 shrink-0 mt-0.5"></i>
                        <span>Segera evakuasi diri menjauhi radius steril tanpa menunggu perintah ulang.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i data-lucide="check" class="w-3.5 h-3.5 text-red-700 shrink-0 mt-0.5"></i>
                        <span>Kenakan masker N95/kain basah dan kacamata goggle rapat.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i data-lucide="check" class="w-3.5 h-3.5 text-red-700 shrink-0 mt-0.5"></i>
                        <span>Hindari berteduh di dekat bantaran sungai lahar hujan.</span>
                    </li>
                </ul>
            </div>

            <div class="clean-card p-6 space-y-3">
                <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                    Fase 3: Pemulihan
                </span>
                <h3 class="font-bold text-base text-slate-900">Pasca-Bencana</h3>
                <ul class="text-xs text-slate-600 space-y-2">
                    <li class="flex items-start gap-2">
                        <i data-lucide="check" class="w-3.5 h-3.5 text-emerald-700 shrink-0 mt-0.5"></i>
                        <span>Kembali ke rumah hanya setelah status resmi diturunkan oleh PVMBG.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i data-lucide="check" class="w-3.5 h-3.5 text-emerald-700 shrink-0 mt-0.5"></i>
                        <span>Bersihkan atap dari endapan abu tebal dengan membasahinya sedikit demi sedikit.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i data-lucide="check" class="w-3.5 h-3.5 text-emerald-700 shrink-0 mt-0.5"></i>
                        <span>Uji kelayakan sumber air sumur sebelum dikonsumsi.</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- VIDEO GALLERY SECTION -->
    <div class="pt-8 border-t border-slate-200 space-y-4">
        <div>
            <h2 class="text-xl font-bold tracking-tight text-slate-900">Galeri Video Edukasi BNPB & PVMBG</h2>
            <p class="text-xs sm:text-sm text-slate-500">Video tutorial mitigasi dan dokumentasi visual kebencanaan.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($videos as $video)
                <div class="clean-card overflow-hidden">
                    <div class="aspect-video w-full bg-slate-100">
                        <iframe class="w-full h-full" 
                                src="{{ $video->youtube_embed }}" 
                                title="{{ $video->title }}" 
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                allowfullscreen></iframe>
                    </div>
                    <div class="p-5 space-y-1">
                        <span class="text-[10px] font-semibold uppercase text-orange-700 tracking-wider">
                            {{ $video->category_label }}
                        </span>
                        <h3 class="font-bold text-sm text-slate-900">{{ $video->title }}</h3>
                        <p class="text-xs text-slate-500 line-clamp-2 leading-relaxed">
                            {{ Str::limit(strip_tags($video->content), 120) }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
