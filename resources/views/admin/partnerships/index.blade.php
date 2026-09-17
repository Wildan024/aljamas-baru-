@extends('layouts.admin')

@section('title', 'Manajemen Pengajuan Kemitraan')
@section('page-title', 'Pengajuan Kemitraan')

@section('content')

{{-- Header --}}
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
    <div>
        <h2 class="text-xl font-bold text-[#163326]">Daftar Pengajuan Kemitraan</h2>
        <p class="text-[#6B7280] text-sm mt-0.5">{{ $partnerships->total() }} total pengajuan kemitraan tercatat</p>
    </div>
</div>

{{-- Filter Status Tabs --}}
<div class="flex items-center gap-2 overflow-x-auto pb-2 mb-6">
    <a href="{{ route('admin.partnerships.index') }}"
       class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-semibold transition-colors duration-150 {{ empty($status) ? 'bg-[#238B45] text-white shadow-sm' : 'bg-white border border-[#E5E7EB] text-[#6B7280] hover:text-[#163326] hover:bg-[#F7FAF8]' }}">
        <span>Semua</span>
        <span class="px-1.5 py-0.5 rounded-full text-[10px] {{ empty($status) ? 'bg-white/20 text-white' : 'bg-[#F7FAF8] text-[#6B7280]' }}">{{ $counts['all'] }}</span>
    </a>
    <a href="{{ route('admin.partnerships.index', ['status' => 'new']) }}"
       class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-semibold transition-colors duration-150 {{ $status === 'new' ? 'bg-[#238B45] text-white shadow-sm' : 'bg-white border border-[#E5E7EB] text-[#6B7280] hover:text-[#163326] hover:bg-[#F7FAF8]' }}">
        <span>Baru</span>
        <span class="px-1.5 py-0.5 rounded-full text-[10px] {{ $status === 'new' ? 'bg-white/20 text-white' : 'bg-amber-100 text-amber-800' }}">{{ $counts['new'] }}</span>
    </a>
    <a href="{{ route('admin.partnerships.index', ['status' => 'contacted']) }}"
       class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-semibold transition-colors duration-150 {{ $status === 'contacted' ? 'bg-[#238B45] text-white shadow-sm' : 'bg-white border border-[#E5E7EB] text-[#6B7280] hover:text-[#163326] hover:bg-[#F7FAF8]' }}">
        <span>Sudah Dihubungi</span>
        <span class="px-1.5 py-0.5 rounded-full text-[10px] {{ $status === 'contacted' ? 'bg-white/20 text-white' : 'bg-[#EAF6EE] text-[#238B45]' }}">{{ $counts['contacted'] }}</span>
    </a>
    <a href="{{ route('admin.partnerships.index', ['status' => 'approved']) }}"
       class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-semibold transition-colors duration-150 {{ $status === 'approved' ? 'bg-[#238B45] text-white shadow-sm' : 'bg-white border border-[#E5E7EB] text-[#6B7280] hover:text-[#163326] hover:bg-[#F7FAF8]' }}">
        <span>Disetujui</span>
        <span class="px-1.5 py-0.5 rounded-full text-[10px] {{ $status === 'approved' ? 'bg-white/20 text-white' : 'bg-blue-100 text-blue-800' }}">{{ $counts['approved'] }}</span>
    </a>
    <a href="{{ route('admin.partnerships.index', ['status' => 'rejected']) }}"
       class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-semibold transition-colors duration-150 {{ $status === 'rejected' ? 'bg-[#238B45] text-white shadow-sm' : 'bg-white border border-[#E5E7EB] text-[#6B7280] hover:text-[#163326] hover:bg-[#F7FAF8]' }}">
        <span>Ditolak</span>
        <span class="px-1.5 py-0.5 rounded-full text-[10px] {{ $status === 'rejected' ? 'bg-white/20 text-white' : 'bg-gray-100 text-gray-700' }}">{{ $counts['rejected'] }}</span>
    </a>
</div>

{{-- Table --}}
<div class="bg-white rounded-2xl border border-[#E5E7EB] overflow-hidden">

    @if ($partnerships->isEmpty())
        {{-- Empty state --}}
        <div class="flex flex-col items-center justify-center py-20 text-center px-4">
            <div class="w-16 h-16 rounded-2xl bg-[#F7FAF8] flex items-center justify-center mb-4">
                <svg class="w-8 h-8 text-[#6B7280]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <p class="text-[#163326] font-semibold">Tidak ada pengajuan kemitraan</p>
            <p class="text-[#6B7280] text-sm mt-1">
                {{ $status ? 'Tidak ada pengajuan dengan filter status ini.' : 'Pengajuan dari formulir publik akan tampil di sini.' }}
            </p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-[#E5E7EB] bg-[#F7FAF8]">
                        <th class="text-left text-xs font-semibold text-[#6B7280] uppercase tracking-wider px-5 py-3.5">Calon Mitra</th>
                        <th class="text-left text-xs font-semibold text-[#6B7280] uppercase tracking-wider px-5 py-3.5">Kontak</th>
                        <th class="text-left text-xs font-semibold text-[#6B7280] uppercase tracking-wider px-5 py-3.5">Bentuk Kemitraan &amp; Kota</th>
                        <th class="text-center text-xs font-semibold text-[#6B7280] uppercase tracking-wider px-5 py-3.5">Status</th>
                        <th class="text-left text-xs font-semibold text-[#6B7280] uppercase tracking-wider px-5 py-3.5">Tanggal</th>
                        <th class="text-right text-xs font-semibold text-[#6B7280] uppercase tracking-wider px-5 py-3.5">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#E5E7EB]">
                    @foreach ($partnerships as $item)
                        <tr class="hover:bg-[#F7FAF8] transition-colors duration-100">

                            {{-- Nama & Usaha --}}
                            <td class="px-5 py-4">
                                <p class="font-semibold text-[#163326]">{{ $item->name }}</p>
                                @if ($item->company)
                                    <p class="text-xs text-[#6B7280]">{{ $item->company }}</p>
                                @else
                                    <p class="text-xs text-[#9CA3AF] italic">Perorangan</p>
                                @endif
                            </td>

                            {{-- Kontak (WhatsApp Link + Email) --}}
                            <td class="px-5 py-4">
                                <div class="space-y-1">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ $item->whatsappLink() }}"
                                           target="_blank"
                                           rel="noopener noreferrer"
                                           class="inline-flex items-center gap-1 text-xs font-medium text-[#238B45] hover:text-[#1E7A3B] hover:underline"
                                           title="Chat via WhatsApp">
                                            <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24">
                                                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                                            </svg>
                                            {{ $item->phone }}
                                        </a>
                                    </div>
                                    <p class="text-xs text-[#6B7280]">{{ $item->email }}</p>
                                </div>
                            </td>

                            {{-- Bentuk Kemitraan & Domisili --}}
                            <td class="px-5 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-[#EAF6EE] text-[#238B45]">
                                    {{ $item->partnership_type }}
                                </span>
                                <p class="text-xs text-[#6B7280] mt-1">{{ $item->location }}</p>
                            </td>

                            {{-- Status --}}
                            <td class="px-5 py-4 text-center">
                                @if ($item->status === 'new')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                        Baru
                                    </span>
                                @elseif ($item->status === 'contacted')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-[#EAF6EE] text-[#238B45] border border-[#238B45]/30">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[#238B45]"></span>
                                        Dihubungi
                                    </span>
                                @elseif ($item->status === 'approved')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                                        Disetujui
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-700 border border-gray-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>
                                        Ditolak
                                    </span>
                                @endif
                            </td>

                            {{-- Tanggal --}}
                            <td class="px-5 py-4 text-xs text-[#6B7280]">
                                {{ $item->created_at->format('d M Y, H:i') }}
                            </td>

                            {{-- Aksi --}}
                            <td class="px-5 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    {{-- Detail --}}
                                    <a href="{{ route('admin.partnerships.show', $item) }}"
                                       class="inline-flex items-center gap-1.5 h-8 px-3 border border-[#E5E7EB] hover:border-[#238B45] text-[#6B7280] hover:text-[#238B45] text-xs font-medium rounded-lg transition-colors duration-150">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        Detail
                                    </a>

                                    {{-- Delete --}}
                                    <form method="POST"
                                          action="{{ route('admin.partnerships.destroy', $item) }}"
                                          onsubmit="return confirm('Hapus pengajuan kemitraan dari &quot;{{ addslashes($item->name) }}&quot;?')">
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
        @if ($partnerships->hasPages())
            <div class="px-5 py-4 border-t border-[#E5E7EB]">
                {{ $partnerships->links() }}
            </div>
        @endif
    @endif

</div>

@endsection
