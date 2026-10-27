@extends('layouts.admin')

@section('title', 'Edit Riwayat - Admin SI-Berapi')
@section('page_title', 'Perbarui Riwayat Bencana')

@section('content')
<div class="max-w-3xl space-y-4">
    <div>
        <a href="{{ route('admin.histories.index') }}" class="text-xs text-slate-500 hover:text-slate-900 flex items-center gap-1">
            <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i> Kembali ke Daftar Riwayat
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

    <form action="{{ route('admin.histories.update', $history->id) }}" method="POST" class="p-6 rounded-2xl bg-white border border-slate-200/80 shadow-sm space-y-4">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Gunung Api Terkait *</label>
                <select name="volcano_id" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs text-slate-900 focus:outline-none focus:bg-white focus:border-orange-600 focus:ring-1 focus:ring-orange-600">
                    @foreach($volcanoes as $v)
                        <option value="{{ $v->id }}" {{ old('volcano_id', $history->volcano_id) == $v->id ? 'selected' : '' }}>
                            {{ $v->name }} ({{ $v->province }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Tanggal Erupsi *</label>
                <input type="date" name="event_date" value="{{ old('event_date', $history->event_date?->format('Y-m-d')) }}" required 
                       class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs text-slate-900 focus:outline-none focus:bg-white focus:border-orange-600">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Jumlah Korban Jiwa *</label>
                <input type="number" name="casualties_count" value="{{ old('casualties_count', $history->casualties_count) }}" min="0" required 
                       class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs text-slate-900 focus:outline-none focus:bg-white focus:border-orange-600">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">URL Foto Dokumentasi</label>
                <input type="url" name="image" value="{{ old('image', $history->image) }}" 
                       class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs text-slate-900 focus:outline-none focus:bg-white focus:border-orange-600">
            </div>
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1">Deskripsi Peristiwa *</label>
            <textarea name="description" rows="3" required 
                      class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs text-slate-900 focus:outline-none focus:bg-white focus:border-orange-600">{{ old('description', $history->description) }}</textarea>
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1">Ringkasan Dampak *</label>
            <textarea name="impact_summary" rows="3" required 
                      class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs text-slate-900 focus:outline-none focus:bg-white focus:border-orange-600">{{ old('impact_summary', $history->impact_summary) }}</textarea>
        </div>

        <div class="pt-3 flex items-center justify-end gap-2 border-t border-slate-100">
            <a href="{{ route('admin.histories.index') }}" class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-xs font-semibold text-slate-700">Batal</a>
            <button type="submit" class="px-5 py-2 rounded-xl bg-orange-700 hover:bg-orange-800 text-xs font-semibold text-white shadow-sm">Perbarui Data</button>
        </div>
    </form>
</div>
@endsection
