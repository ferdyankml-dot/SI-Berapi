@extends('layouts.app')

@section('title', 'Papan Informasi Orang Hilang - SI-Berapi')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 sm:pt-12 pb-20 space-y-10" x-data="{ selectedVictim: null }">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div class="max-w-2xl space-y-2">
            <span class="text-xs font-semibold uppercase tracking-wider text-orange-700 block">
                Crowdsourcing Bantuan Publik
            </span>
            <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-slate-900">
                Papan Laporan Orang Hilang
            </h1>
            <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                Informasi pendaki dan warga yang dilaporkan hilang di kawasan lereng gunung berapi. Publik dan relawan dapat berkontribusi memberikan informasi atau melaporkan korban baru.
            </p>
        </div>

        <div>
            <a href="#laporkan" 
               class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-orange-700 hover:bg-orange-800 text-white font-semibold text-xs tracking-wide shadow-sm transition">
                <i data-lucide="plus" class="w-4 h-4"></i>
                <span>+ Buat Laporan Baru</span>
            </a>
        </div>
    </div>

    <!-- Metric Counter Bar -->
    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
        <div class="clean-card p-5">
            <span class="text-[11px] text-slate-500 uppercase font-medium">Masih Dalam Pencarian</span>
            <div class="text-2xl sm:text-3xl font-bold text-slate-900 mt-1 flex items-baseline gap-1.5">
                <span class="text-red-700">{{ $totalSearching }}</span>
                <span class="text-xs font-normal text-slate-400">Jiwa</span>
            </div>
        </div>
        <div class="clean-card p-5">
            <span class="text-[11px] text-slate-500 uppercase font-medium">Telah Ditemukan</span>
            <div class="text-2xl sm:text-3xl font-bold text-slate-900 mt-1 flex items-baseline gap-1.5">
                <span class="text-emerald-700">{{ $totalFound }}</span>
                <span class="text-xs font-normal text-slate-400">Jiwa</span>
            </div>
        </div>
        <div class="col-span-2 sm:col-span-1 clean-card p-5">
            <span class="text-[11px] text-slate-500 uppercase font-medium">Bantuan Operasi SAR</span>
            <div class="text-sm font-semibold text-slate-800 mt-2 flex items-center gap-2">
                <i data-lucide="phone-call" class="w-4 h-4 text-orange-700"></i>
                <span>Hotline 115 (Basarnas)</span>
            </div>
        </div>
    </div>

    <!-- Search & Filter Bar -->
    <div class="clean-card p-5">
        <form action="{{ route('missing_persons.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-4 gap-4">
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nama Korban / Ciri</label>
                <div class="relative">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama atau ciri..." 
                           class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 pl-9 text-xs text-slate-800 placeholder-slate-400 focus:outline-none focus:bg-white focus:border-orange-600 focus:ring-1 focus:ring-orange-600">
                    <i data-lucide="search" class="w-4 h-4 text-slate-400 absolute left-3 top-2.5"></i>
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Kawasan Gunung</label>
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
                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Status Pencarian</label>
                <select name="status" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs text-slate-800 focus:outline-none focus:bg-white focus:border-orange-600">
                    <option value="Semua">Semua Status</option>
                    <option value="Dicari" {{ request('status') === 'Dicari' ? 'selected' : '' }}>Masih Dicari</option>
                    <option value="Ditemukan" {{ request('status') === 'Ditemukan' ? 'selected' : '' }}>Sudah Ditemukan</option>
                </select>
            </div>

            <div class="flex items-end gap-2">
                <button type="submit" class="flex-1 py-2.5 rounded-xl bg-orange-700 hover:bg-orange-800 text-white font-semibold text-xs transition flex items-center justify-center gap-1.5 shadow-sm">
                    <i data-lucide="filter" class="w-3.5 h-3.5"></i> Terapkan
                </button>
                <a href="{{ route('missing_persons.index') }}" class="p-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 transition" title="Reset">
                    <i data-lucide="rotate-ccw" class="w-4 h-4"></i>
                </a>
            </div>
        </form>
    </div>

    <!-- Missing Persons Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @forelse($missingPersons as $person)
            <div class="clean-card overflow-hidden group flex flex-col justify-between">
                <div>
                    <!-- Photo & Badges -->
                    <div class="h-52 relative overflow-hidden bg-slate-100">
                        <img src="{{ $person->photo ?? 'https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?auto=format&fit=crop&w=600&q=80' }}" 
                             alt="{{ $person->victim_name }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">

                        <div class="absolute top-3 left-3">
                            @if($person->status === 'Dicari')
                                <span class="px-2.5 py-1 rounded-full text-[11px] font-semibold bg-red-50 text-red-700 border border-red-200 shadow-sm">
                                    Masih Dicari
                                </span>
                            @else
                                <span class="px-2.5 py-1 rounded-full text-[11px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200 shadow-sm">
                                    Sudah Ditemukan
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Details -->
                    <div class="p-4 space-y-2.5">
                        <div>
                            <h3 class="font-bold text-base text-slate-900 truncate">{{ $person->victim_name }}</h3>
                            <p class="text-xs text-slate-500">{{ $person->gender }}, {{ $person->age }} Tahun</p>
                        </div>

                        <div class="text-xs text-slate-500 space-y-1">
                            <div class="flex items-center gap-1.5 truncate">
                                <i data-lucide="mountain" class="w-3.5 h-3.5 text-slate-400 shrink-0"></i>
                                <span class="text-slate-700 truncate font-medium">{{ $person->volcano?->name ?? 'Kawasan Terkait' }}</span>
                            </div>
                            <div class="flex items-center gap-1.5 truncate">
                                <i data-lucide="map-pin" class="w-3.5 h-3.5 text-slate-400 shrink-0"></i>
                                <span class="truncate">{{ $person->last_seen_location }}</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <i data-lucide="calendar" class="w-3.5 h-3.5 text-slate-400 shrink-0"></i>
                                <span>Hilang: {{ $person->last_seen_date?->format('d M Y') }}</span>
                            </div>
                        </div>

                        <div class="bg-slate-50 p-2.5 rounded-xl border border-slate-100 text-xs text-slate-600">
                            <span class="text-[10px] uppercase font-semibold text-slate-400 block mb-0.5">Ciri Terakhir:</span>
                            <p class="line-clamp-2 leading-relaxed">{{ $person->characteristics }}</p>
                        </div>
                    </div>
                </div>

                <!-- Footer Action Buttons -->
                <div class="p-4 pt-0 space-y-2">
                    <button type="button" 
                            @click="selectedVictim = {{ json_encode($person) }}"
                            class="w-full py-2 rounded-xl bg-slate-50 hover:bg-slate-100 text-slate-700 font-semibold text-xs transition border border-slate-200">
                        Detail Lengkap
                    </button>
                    <a href="https://wa.me/{{ $person->formatted_phone }}?text=Halo%20{{ urlencode($person->reporter_name) }},%20saya%20melihat%20laporan%20orang%20hilang%20atas%20nama%20{{ urlencode($person->victim_name) }}%20di%20portal%20SI-Berapi." 
                       target="_blank"
                       class="w-full inline-flex items-center justify-center gap-1.5 py-2 rounded-xl bg-emerald-50 hover:bg-emerald-100 text-emerald-800 border border-emerald-200 font-semibold text-xs transition">
                        <i data-lucide="message-circle" class="w-3.5 h-3.5 text-emerald-700"></i> Kontak Pelapor (WA)
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-4 text-center py-16 text-slate-400 clean-card">
                <i data-lucide="user-x" class="w-10 h-10 mx-auto text-slate-300 mb-2"></i>
                <h3 class="text-base font-semibold text-slate-700">Tidak ada laporan yang sesuai</h3>
                <p class="text-xs text-slate-400 mt-1">Coba sesuaikan kata kunci pencarian atau reset filter.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div>
        {{ $missingPersons->links() }}
    </div>

    <!-- FORM INPUT LAPORAN ORANG HILANG (PUBLIC USER CROWDSOURCING) -->
    <div id="laporkan" class="clean-card p-6 sm:p-10 max-w-3xl mx-auto space-y-6">
        <div class="space-y-1">
            <span class="text-xs font-semibold uppercase tracking-wider text-orange-700 block">Formulir Publik</span>
            <h2 class="text-2xl font-bold tracking-tight text-slate-900">Laporkan Korban Hilang</h2>
            <p class="text-xs sm:text-sm text-slate-500">
                Silakan lengkapi formulir di bawah ini dengan informasi akurat untuk membantu tim evakuasi SAR dan relawan.
            </p>
        </div>

        @if($errors->any())
            <div class="p-4 rounded-xl bg-red-50 border border-red-200 text-red-700 text-xs space-y-1">
                <p class="font-semibold">Mohon perbaiki isian formulir:</p>
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('missing_persons.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- 1. Identitas Pelapor -->
            <div class="space-y-3 pt-2">
                <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider border-b border-slate-100 pb-2">
                    1. Identitas Pelapor (Anda)
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-slate-700 mb-1">Nama Lengkap Pelapor *</label>
                        <input type="text" name="reporter_name" value="{{ old('reporter_name') }}" required 
                               placeholder="Nama Anda"
                               class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs text-slate-800 focus:outline-none focus:bg-white focus:border-orange-600 focus:ring-1 focus:ring-orange-600">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-700 mb-1">Nomor WhatsApp / HP *</label>
                        <input type="text" name="reporter_phone" value="{{ old('reporter_phone') }}" required 
                               placeholder="Cth: 081234567890"
                               class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs text-slate-800 focus:outline-none focus:bg-white focus:border-orange-600 focus:ring-1 focus:ring-orange-600">
                    </div>
                </div>
            </div>

            <!-- 2. Identitas Korban Hilang -->
            <div class="space-y-3 pt-2">
                <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider border-b border-slate-100 pb-2">
                    2. Data Korban Hilang
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-medium text-slate-700 mb-1">Nama Korban Hilang *</label>
                        <input type="text" name="victim_name" value="{{ old('victim_name') }}" required 
                               placeholder="Nama lengkap korban"
                               class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs text-slate-800 focus:outline-none focus:bg-white focus:border-orange-600 focus:ring-1 focus:ring-orange-600">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-700 mb-1">Usia (Tahun) *</label>
                        <input type="number" name="age" value="{{ old('age') }}" min="1" max="120" required 
                               placeholder="Cth: 24"
                               class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs text-slate-800 focus:outline-none focus:bg-white focus:border-orange-600 focus:ring-1 focus:ring-orange-600">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-slate-700 mb-1">Jenis Kelamin *</label>
                        <select name="gender" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs text-slate-800 focus:outline-none focus:bg-white focus:border-orange-600">
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Laki-laki" {{ old('gender') === 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('gender') === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-700 mb-1">Foto Korban Terakhir (Opsional)</label>
                        <input type="file" name="photo" accept="image/*" 
                               class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-xs text-slate-600 file:mr-3 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-slate-200 file:text-slate-700 hover:file:bg-slate-300">
                    </div>
                </div>
            </div>

            <!-- 3. Lokasi & Ciri Fisik -->
            <div class="space-y-3 pt-2">
                <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider border-b border-slate-100 pb-2">
                    3. Lokasi & Ciri-Ciri Terakhir
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-slate-700 mb-1">Gunung / Kawasan Terkait</label>
                        <select name="volcano_id" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs text-slate-800 focus:outline-none focus:bg-white focus:border-orange-600">
                            <option value="">-- Pilih Gunung Terkait --</option>
                            @foreach($volcanoes as $v)
                                <option value="{{ $v->id }}" {{ old('volcano_id') == $v->id ? 'selected' : '' }}>
                                    {{ $v->name }} ({{ $v->province }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-700 mb-1">Tanggal Terakhir Dilihat *</label>
                        <input type="date" name="last_seen_date" value="{{ old('last_seen_date', date('Y-m-d')) }}" required 
                               class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs text-slate-800 focus:outline-none focus:bg-white focus:border-orange-600">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-medium text-slate-700 mb-1">Lokasi Terakhir Dilihat *</label>
                    <input type="text" name="last_seen_location" value="{{ old('last_seen_location') }}" required 
                           placeholder="Cth: Jalur Selo Pos 3 dekat percabangan sumber air"
                           class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs text-slate-800 focus:outline-none focus:bg-white focus:border-orange-600 focus:ring-1 focus:ring-orange-600">
                </div>

                <div>
                    <label class="block text-xs font-medium text-slate-700 mb-1">Ciri-Ciri Fisik & Pakaian Terakhir *</label>
                    <textarea name="characteristics" rows="3" required 
                              placeholder="Tinggi badan, warna kulit, pakaian terakhir (jaket/celana), tas, sepatu, tanda khusus..."
                              class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs text-slate-800 focus:outline-none focus:bg-white focus:border-orange-600 focus:ring-1 focus:ring-orange-600">{{ old('characteristics') }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-medium text-slate-700 mb-1">Keterangan Tambahan / Kronologi (Opsional)</label>
                    <textarea name="notes" rows="2" 
                              placeholder="Kronologi saat terpisah dari rombongan, dsb."
                              class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs text-slate-800 focus:outline-none focus:bg-white focus:border-orange-600 focus:ring-1 focus:ring-orange-600">{{ old('notes') }}</textarea>
                </div>
            </div>

            <div class="pt-2">
                <button type="submit" 
                        class="w-full py-3.5 rounded-xl bg-orange-700 hover:bg-orange-800 text-white font-semibold text-xs uppercase tracking-wider shadow-sm transition flex items-center justify-center gap-2">
                    <i data-lucide="send" class="w-4 h-4"></i> Publikasikan Laporan Orang Hilang
                </button>
            </div>
        </form>
    </div>

    <!-- DETAIL MODAL (Alpine.js) -->
    <div x-show="selectedVictim" 
         x-transition:enter="transition ease-out duration-150"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-100"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/40 backdrop-blur-sm"
         style="display: none;">
        
        <div @click.away="selectedVictim = null" 
             class="bg-white border border-slate-200 max-w-lg w-full rounded-2xl overflow-hidden shadow-xl max-h-[90vh] flex flex-col">
            
            <div class="p-4 border-b border-slate-100 flex items-center justify-between">
                <span class="text-xs font-bold text-slate-800 uppercase tracking-wider">Detail Informasi Korban</span>
                <button @click="selectedVictim = null" class="p-1 rounded-lg text-slate-400 hover:text-slate-600">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>

            <div class="p-6 overflow-y-auto space-y-4">
                <template x-if="selectedVictim">
                    <div class="space-y-4">
                        <div class="h-60 rounded-xl overflow-hidden bg-slate-100 relative">
                            <img :src="selectedVictim.photo || 'https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?auto=format&fit=crop&w=600&q=80'" 
                                 :alt="selectedVictim.victim_name" 
                                 class="w-full h-full object-cover">
                        </div>

                        <div>
                            <h2 class="text-xl font-bold text-slate-900" x-text="selectedVictim.victim_name"></h2>
                            <p class="text-xs text-slate-500" x-text="selectedVictim.gender + ', ' + selectedVictim.age + ' Tahun'"></p>
                        </div>

                        <div class="grid grid-cols-2 gap-2 text-xs">
                            <div class="bg-slate-50 p-2.5 rounded-lg border border-slate-100">
                                <span class="text-slate-400 block text-[10px]">Lokasi Terakhir</span>
                                <span class="font-semibold text-slate-800" x-text="selectedVictim.last_seen_location"></span>
                            </div>
                            <div class="bg-slate-50 p-2.5 rounded-lg border border-slate-100">
                                <span class="text-slate-400 block text-[10px]">Tanggal Hilang</span>
                                <span class="font-semibold text-slate-800" x-text="selectedVictim.last_seen_date"></span>
                            </div>
                        </div>

                        <div class="bg-slate-50 p-3.5 rounded-xl border border-slate-100 space-y-1">
                            <span class="text-[10px] font-semibold text-slate-400 uppercase">Ciri Fisik & Pakaian</span>
                            <p class="text-xs text-slate-700 leading-relaxed" x-text="selectedVictim.characteristics"></p>
                        </div>

                        <template x-if="selectedVictim.notes">
                            <div class="bg-slate-50 p-3.5 rounded-xl border border-slate-100 space-y-1">
                                <span class="text-[10px] font-semibold text-slate-400 uppercase">Kronologi</span>
                                <p class="text-xs text-slate-700 leading-relaxed" x-text="selectedVictim.notes"></p>
                            </div>
                        </template>

                        <div class="p-3.5 rounded-xl bg-orange-50/70 border border-orange-200/70 flex items-center justify-between">
                            <div>
                                <span class="text-[10px] text-orange-700 uppercase font-semibold block">Pelapor</span>
                                <span class="text-xs font-bold text-slate-800" x-text="selectedVictim.reporter_name + ' (' + selectedVictim.reporter_phone + ')'"></span>
                            </div>
                            <a :href="'https://wa.me/' + selectedVictim.formatted_phone + '?text=Halo%20' + encodeURIComponent(selectedVictim.reporter_name) + ',%20saya%20melihat%20laporan%20orang%20hilang%20atas%20nama%20' + encodeURIComponent(selectedVictim.victim_name) + '%20di%20portal%20SI-Berapi.'"
                               target="_blank"
                               class="px-3.5 py-2 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-semibold text-xs transition flex items-center gap-1.5 shadow-sm">
                                <i data-lucide="message-circle" class="w-3.5 h-3.5"></i> Hubungi WA
                            </a>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>
</div>
@endsection
