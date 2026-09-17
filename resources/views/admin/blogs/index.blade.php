@extends('layouts.admin')

@section('title', 'Manajemen Blog')
@section('page-title', 'Manajemen Blog')

@section('content')

{{-- Header --}}
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
    <div>
        <h2 class="text-xl font-bold text-[#163326]">Daftar Artikel Blog</h2>
        <p class="text-[#6B7280] text-sm mt-0.5">{{ $blogs->total() }} artikel terdaftar</p>
    </div>
    <a href="{{ route('admin.blogs.create') }}"
       class="inline-flex items-center gap-2 h-10 px-5 bg-[#238B45] hover:bg-[#1E7A3B] text-white text-sm font-semibold rounded-[10px] shadow-sm hover:shadow transition-all duration-200">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
        </svg>
        Tambah Artikel
    </a>
</div>

{{-- Table --}}
<div class="bg-white rounded-2xl border border-[#E5E7EB] overflow-hidden">

    @if ($blogs->isEmpty())
        {{-- Empty state --}}
        <div class="flex flex-col items-center justify-center py-20 text-center px-4">
            <div class="w-16 h-16 rounded-2xl bg-[#F7FAF8] flex items-center justify-center mb-4">
                <svg class="w-8 h-8 text-[#6B7280]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <p class="text-[#163326] font-semibold">Belum ada artikel</p>
            <p class="text-[#6B7280] text-sm mt-1 mb-5">Mulai tulis artikel pertama Anda.</p>
            <a href="{{ route('admin.blogs.create') }}"
               class="inline-flex items-center gap-2 h-10 px-5 bg-[#238B45] hover:bg-[#1E7A3B] text-white text-sm font-semibold rounded-[10px] transition-all duration-200">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Artikel
            </a>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-[#E5E7EB] bg-[#F7FAF8]">
                        <th class="text-left text-xs font-semibold text-[#6B7280] uppercase tracking-wider px-5 py-3.5">Artikel</th>
                        <th class="text-left text-xs font-semibold text-[#6B7280] uppercase tracking-wider px-5 py-3.5">Kategori</th>
                        <th class="text-center text-xs font-semibold text-[#6B7280] uppercase tracking-wider px-5 py-3.5">Status</th>
                        <th class="text-center text-xs font-semibold text-[#6B7280] uppercase tracking-wider px-5 py-3.5">Tanggal Rilis</th>
                        <th class="text-right text-xs font-semibold text-[#6B7280] uppercase tracking-wider px-5 py-3.5">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#E5E7EB]">
                    @foreach ($blogs as $blog)
                        <tr class="hover:bg-[#F7FAF8] transition-colors duration-100">

                            {{-- Thumbnail + Title + Slug --}}
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3">
                                    {{-- Thumbnail --}}
                                    <div class="w-12 h-12 rounded-xl bg-[#F7FAF8] border border-[#E5E7EB] flex-shrink-0 overflow-hidden">
                                        @if ($blog->image)
                                            <img src="{{ Storage::disk('public')->url($blog->image) }}"
                                                 alt="{{ $blog->title }}"
                                                 class="w-full h-full object-cover"
                                                 loading="lazy">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center">
                                                <svg class="w-5 h-5 text-[#6B7280]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="min-w-0">
                                        <p class="font-semibold text-[#163326] truncate max-w-[240px]">{{ $blog->title }}</p>
                                        <p class="text-xs text-[#6B7280] truncate max-w-[240px]">/blog/{{ $blog->slug }}</p>
                                    </div>
                                </div>
                            </td>

                            {{-- Category --}}
                            <td class="px-5 py-4">
                                @if ($blog->category)
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-[#EAF6EE] text-[#238B45]">
                                        {{ $blog->category->name }}
                                    </span>
                                @else
                                    <span class="text-[#6B7280] text-xs">—</span>
                                @endif
                            </td>

                            {{-- Status --}}
                            <td class="px-5 py-4 text-center">
                                @if ($blog->status === 'published')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-[#EAF6EE] text-[#238B45]">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[#238B45]"></span>
                                        Published
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-[#F7FAF8] text-[#6B7280]">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[#6B7280]"></span>
                                        Draft
                                    </span>
                                @endif
                            </td>

                            {{-- Published At --}}
                            <td class="px-5 py-4 text-center">
                                @if ($blog->published_at)
                                    <span class="text-[#1F2937] text-xs font-medium">
                                        {{ $blog->published_at->format('d M Y') }}
                                    </span>
                                @else
                                    <span class="text-[#6B7280] text-xs">—</span>
                                @endif
                            </td>

                            {{-- Actions --}}
                            <td class="px-5 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    {{-- Edit --}}
                                    <a href="{{ route('admin.blogs.edit', $blog) }}"
                                       class="inline-flex items-center gap-1.5 h-8 px-3 border border-[#E5E7EB] hover:border-[#238B45] text-[#6B7280] hover:text-[#238B45] text-xs font-medium rounded-lg transition-colors duration-150">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        Edit
                                    </a>
                                    {{-- Delete --}}
                                    <form method="POST"
                                          action="{{ route('admin.blogs.destroy', $blog) }}"
                                          onsubmit="return confirm('Hapus artikel &quot;{{ addslashes($blog->title) }}&quot;? Thumbnail juga akan dihapus permanen.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="inline-flex items-center gap-1.5 h-8 px-3 border border-[#E5E7EB] hover:border-[#E11D48] text-[#6B7280] hover:text-[#E11D48] text-xs font-medium rounded-lg transition-colors duration-150">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if ($blogs->hasPages())
            <div class="px-5 py-4 border-t border-[#E5E7EB]">
                {{ $blogs->links() }}
            </div>
        @endif
    @endif

</div>

@endsection
