@extends('layouts.admin')

@section('title', 'Materi Edukasi - Admin SI-Berapi')
@section('page_title', 'Manajemen Materi Edukasi & Video')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-lg font-bold text-slate-900">Daftar Konten Edukasi & Video</h2>
            <p class="text-xs text-slate-500">Kelola artikel panduan mitigasi, penjelasan sains vulkanologi, dan link video YouTube.</p>
        </div>

        <a href="{{ route('admin.education.create') }}" 
           class="px-4 py-2.5 rounded-xl bg-orange-700 hover:bg-orange-800 text-white font-semibold text-xs flex items-center gap-1.5 transition shadow-sm">
            <i data-lucide="plus" class="w-4 h-4"></i> Tambah Materi
        </a>
    </div>

    <!-- Table -->
    <div class="rounded-2xl bg-white border border-slate-200/80 overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 text-slate-500 font-semibold uppercase tracking-wider border-b border-slate-200/80">
                    <tr>
                        <th class="py-4 px-6">Judul Materi</th>
                        <th class="py-4 px-6">Kategori</th>
                        <th class="py-4 px-6">Video YouTube</th>
                        <th class="py-4 px-6">Pembaruan</th>
                        <th class="py-4 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    @forelse($educations as $edu)
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="py-4 px-6">
                                <div class="font-bold text-slate-900 text-sm">{{ $edu->title }}</div>
                                <span class="text-[11px] text-slate-400 line-clamp-1">{{ Str::limit(strip_tags($edu->content), 80) }}</span>
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-orange-50 text-orange-800 border border-orange-200">
                                    {{ $edu->category_label }}
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                @if($edu->video_url)
                                    <a href="{{ $edu->video_url }}" target="_blank" class="text-orange-700 hover:underline flex items-center gap-1 font-medium">
                                        <i data-lucide="youtube" class="w-3.5 h-3.5 text-red-600"></i> Buka Link
                                    </a>
                                @else
                                    <span class="text-slate-400">-</span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-slate-400">
                                {{ $edu->updated_at?->format('d/m/Y') }}
                            </td>
                            <td class="py-4 px-6 text-right">
                                <div class="flex items-center justify-end gap-1.5">
                                    <a href="{{ route('admin.education.edit', $edu->id) }}" 
                                       class="p-1.5 rounded-lg text-slate-500 hover:text-slate-900 hover:bg-slate-100 transition" title="Edit">
                                        <i data-lucide="edit-3" class="w-4 h-4"></i>
                                    </a>
                                    <form action="{{ route('admin.education.destroy', $edu->id) }}" method="POST" onsubmit="return confirm('Hapus materi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 rounded-lg text-red-500 hover:text-red-700 hover:bg-red-50 transition" title="Hapus">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-8 text-slate-400">Tidak ada konten edukasi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-slate-100">
            {{ $educations->links() }}
        </div>
    </div>
</div>
@endsection
