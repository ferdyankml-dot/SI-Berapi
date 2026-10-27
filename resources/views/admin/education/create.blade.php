@extends('layouts.admin')

@section('title', 'Tambah Edukasi - Admin SI-Berapi')
@section('page_title', 'Tambah Konten Edukasi Baru')

@section('content')
<div class="max-w-3xl space-y-4">
    <div>
        <a href="{{ route('admin.education.index') }}" class="text-xs text-slate-500 hover:text-slate-900 flex items-center gap-1">
            <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i> Kembali ke Daftar Edukasi
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

    <form action="{{ route('admin.education.store') }}" method="POST" class="p-6 rounded-2xl bg-white border border-slate-200/80 shadow-sm space-y-4">
        @csrf

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="sm:col-span-2">
                <label class="block text-xs font-semibold text-slate-700 mb-1">Judul Materi Edukasi *</label>
                <input type="text" name="title" value="{{ old('title') }}" required placeholder="Cth: Panduan Menghadapi Hujan Abu" 
                       class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs text-slate-900 focus:outline-none focus:bg-white focus:border-orange-600 focus:ring-1 focus:ring-orange-600">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Kategori *</label>
                <select name="category" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs text-slate-900 focus:outline-none focus:bg-white focus:border-orange-600">
                    <option value="definisi" {{ old('category') === 'definisi' ? 'selected' : '' }}>Definisi & Tipe</option>
                    <option value="penyebab" {{ old('category') === 'penyebab' ? 'selected' : '' }}>Penyebab Terjadinya Erupsi</option>
                    <option value="dampak" {{ old('category') === 'dampak' ? 'selected' : '' }}>Dampak Positif / Negatif</option>
                    <option value="mitigasi" {{ old('category') === 'mitigasi' ? 'selected' : '' }}>Panduan Mitigasi</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">URL Video YouTube (Embed Edukasi)</label>
                <input type="url" name="video_url" value="{{ old('video_url') }}" placeholder="https://www.youtube.com/watch?v=..." 
                       class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs text-slate-900 focus:outline-none focus:bg-white focus:border-orange-600 focus:ring-1 focus:ring-orange-600">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">URL Thumbnail Gambar</label>
                <input type="url" name="thumbnail" value="{{ old('thumbnail') }}" placeholder="https://..." 
                       class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs text-slate-900 focus:outline-none focus:bg-white focus:border-orange-600 focus:ring-1 focus:ring-orange-600">
            </div>
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1">Isi Konten / Penjelasan Lengkap *</label>
            <textarea name="content" rows="6" required placeholder="Tuliskan uraian materi edukasi bencana..." 
                      class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs text-slate-900 focus:outline-none focus:bg-white focus:border-orange-600 focus:ring-1 focus:ring-orange-600">{{ old('content') }}</textarea>
        </div>

        <div class="pt-3 flex items-center justify-end gap-2 border-t border-slate-100">
            <a href="{{ route('admin.education.index') }}" class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-xs font-semibold text-slate-700">Batal</a>
            <button type="submit" class="px-5 py-2 rounded-xl bg-orange-700 hover:bg-orange-800 text-xs font-semibold text-white shadow-sm">Terbitkan Materi</button>
        </div>
    </form>
</div>
@endsection
