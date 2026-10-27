@extends('layouts.app')

@section('title', 'Kontak & Posko Darurat - SI-Berapi')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 sm:pt-12 pb-20 space-y-10">
    <!-- Header -->
    <div class="max-w-3xl space-y-2">
        <span class="text-xs font-semibold uppercase tracking-wider text-orange-700 block">
            Jalur Cepat Komunikasi Darurat
        </span>
        <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-slate-900">
            Kontak Posko & Layanan Darurat 24 Jam
        </h1>
        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
            Hubungi instansi resmi berwenang terkait pemantauan aktivitas vulkanik, operasi pencarian & pertolongan korban, serta rujukan medis darurat.
        </p>
    </div>

    <!-- National Hotline Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($emergencyContacts as $contact)
            <div class="clean-card p-6 flex flex-col justify-between space-y-4">
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-semibold uppercase tracking-wider bg-orange-50 text-orange-800 border border-orange-200">
                            {{ $contact['badge'] }}
                        </span>
                        <div class="w-8 h-8 rounded-lg bg-slate-50 text-orange-700 flex items-center justify-center border border-slate-200/80">
                            <i data-lucide="phone" class="w-4 h-4"></i>
                        </div>
                    </div>

                    <div>
                        <h3 class="font-bold text-base text-slate-900 leading-snug">{{ $contact['agency'] }}</h3>
                        <p class="text-xs text-slate-500 mt-1 leading-relaxed">{{ $contact['desc'] }}</p>
                    </div>

                    <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-100 space-y-1.5 text-xs">
                        <div class="flex items-center justify-between">
                            <span class="text-slate-500">Nomor Telepon:</span>
                            <a href="tel:{{ preg_replace('/[^0-9]/', '', $contact['phone']) }}" class="font-bold text-orange-700 hover:underline">
                                {{ $contact['phone'] }}
                            </a>
                        </div>
                        @if($contact['wa'])
                            <div class="flex items-center justify-between border-t border-slate-200/60 pt-1.5">
                                <span class="text-slate-500">WhatsApp Resmi:</span>
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contact['wa']) }}" target="_blank" class="font-semibold text-emerald-700 hover:underline">
                                    {{ $contact['wa'] }}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="pt-2 flex items-center gap-2">
                    <a href="tel:{{ preg_replace('/[^0-9]/', '', $contact['phone']) }}" 
                       class="flex-1 py-2.5 rounded-xl bg-orange-700 hover:bg-orange-800 text-white font-semibold text-xs transition text-center shadow-sm flex items-center justify-center gap-1.5">
                        <i data-lucide="phone-call" class="w-3.5 h-3.5"></i> Hubungi Langsung
                    </a>
                    @if($contact['wa'])
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contact['wa']) }}" 
                           target="_blank"
                           class="p-2.5 rounded-xl bg-emerald-50 hover:bg-emerald-100 text-emerald-800 border border-emerald-200 transition" 
                           title="Kirim Pesan WhatsApp">
                            <i data-lucide="message-circle" class="w-4 h-4"></i>
                        </a>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <!-- Emergency Protocol Banner -->
    <div class="clean-card p-6 sm:p-7 max-w-4xl mx-auto space-y-3">
        <h3 class="font-bold text-base text-slate-900 flex items-center gap-2">
            <i data-lucide="alert-circle" class="w-4 h-4 text-orange-700"></i>
            Protokol Panggilan Saat Kondisi Darurat:
        </h3>
        <ol class="list-decimal list-inside text-xs text-slate-600 space-y-2 leading-relaxed">
            <li>Sebutkan <strong>Nama Lengkap Anda</strong> dan <strong>Lokasi/Titik Koordinat Terkini</strong> secara presisi.</li>
            <li>Jelaskan jenis ancaman bencana: luncuran awan panas, hujan abu pekat, banjir lahar dingin, atau adanya korban tertimbun.</li>
            <li>Informasikan perkiraan <strong>jumlah korban atau warga</strong> yang membutuhkan bantuan evakuasi segera.</li>
            <li>Tetap tenang dan jangan memutuskan sambungan sebelum petugas darurat mengkonfirmasi seluruh informasi selesai dicatat.</li>
        </ol>
    </div>
</div>
@endsection
