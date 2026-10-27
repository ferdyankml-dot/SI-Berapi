@extends('layouts.admin')

@section('title', 'Tambah Gunung - Admin SI-Berapi')
@section('page_title', 'Tambah Data Gunung Api')

@section('content')
<div class="max-w-3xl space-y-4">
    <div>
        <a href="{{ route('admin.volcanoes.index') }}" class="text-xs text-slate-500 hover:text-slate-900 flex items-center gap-1">
            <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i> Kembali ke Daftar Gunung
        </a>
    </div>

    @if($errors->any())
        <div class="p-3.5 rounded-xl bg-red-50 border border-red-200 text-red-700 text-xs space-y-1">
            <p class="font-semibold">Periksa isian formulir:</p>
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.volcanoes.store') }}" method="POST" class="p-6 rounded-2xl bg-white border border-slate-200/80 shadow-sm space-y-4">
        @csrf

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Nama Gunung *</label>
                <input type="text" name="name" value="{{ old('name') }}" required placeholder="Cth: Gunung Lewotobi Laki-laki" 
                       class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs text-slate-900 focus:outline-none focus:bg-white focus:border-orange-600 focus:ring-1 focus:ring-orange-600">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Provinsi *</label>
                <input type="text" name="province" value="{{ old('province') }}" required placeholder="Cth: Nusa Tenggara Timur" 
                       class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs text-slate-900 focus:outline-none focus:bg-white focus:border-orange-600 focus:ring-1 focus:ring-orange-600">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="sm:col-span-2">
                <label class="block text-xs font-semibold text-slate-700 mb-1">Lokasi Detail *</label>
                <input type="text" name="location" value="{{ old('location') }}" required placeholder="Cth: Flores Timur" 
                       class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs text-slate-900 focus:outline-none focus:bg-white focus:border-orange-600 focus:ring-1 focus:ring-orange-600">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Tinggi (mdpl) *</label>
                <input type="number" name="height" value="{{ old('height') }}" required placeholder="Cth: 1584" 
                       class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs text-slate-900 focus:outline-none focus:bg-white focus:border-orange-600 focus:ring-1 focus:ring-orange-600">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Status Aktivitas *</label>
                <select name="status_level" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs text-slate-900 focus:outline-none focus:bg-white focus:border-orange-600">
                    <option value="Normal" {{ old('status_level') === 'Normal' ? 'selected' : '' }}>Level I (Normal - Hijau)</option>
                    <option value="Waspada" {{ old('status_level') === 'Waspada' ? 'selected' : '' }}>Level II (Waspada - Kuning)</option>
                    <option value="Siaga" {{ old('status_level') === 'Siaga' ? 'selected' : '' }}>Level III (Siaga - Oranye)</option>
                    <option value="Awas" {{ old('status_level') === 'Awas' ? 'selected' : '' }}>Level IV (Awas - Merah)</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Latitude *</label>
                <input type="text" name="latitude" value="{{ old('latitude') }}" required placeholder="Cth: -8.5390" 
                       class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs text-slate-900 focus:outline-none focus:bg-white focus:border-orange-600 focus:ring-1 focus:ring-orange-600">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Longitude *</label>
                <input type="text" name="longitude" value="{{ old('longitude') }}" required placeholder="Cth: 122.7750" 
                       class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs text-slate-900 focus:outline-none focus:bg-white focus:border-orange-600 focus:ring-1 focus:ring-orange-600">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Radius Aman *</label>
                <input type="text" name="safety_radius" value="{{ old('safety_radius', '5 km') }}" required 
                       class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs text-slate-900 focus:outline-none focus:bg-white focus:border-orange-600 focus:ring-1 focus:ring-orange-600">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">URL Foto (Opsional)</label>
                <input type="url" name="image" value="{{ old('image') }}" placeholder="https://..." 
                       class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs text-slate-900 focus:outline-none focus:bg-white focus:border-orange-600 focus:ring-1 focus:ring-orange-600">
            </div>
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1">Deskripsi Kondisi *</label>
            <textarea name="description" rows="3" required 
                      class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs text-slate-900 focus:outline-none focus:bg-white focus:border-orange-600 focus:ring-1 focus:ring-orange-600">{{ old('description') }}</textarea>
        </div>

        <div class="pt-3 flex items-center justify-end gap-2 border-t border-slate-100">
            <a href="{{ route('admin.volcanoes.index') }}" class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-xs font-semibold text-slate-700">Batal</a>
            <button type="submit" class="px-5 py-2 rounded-xl bg-orange-700 hover:bg-orange-800 text-xs font-semibold text-white shadow-sm">Simpan Data</button>
        </div>
    </form>
</div>
@endsection
