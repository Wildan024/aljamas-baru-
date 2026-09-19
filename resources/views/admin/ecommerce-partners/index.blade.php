@extends('layouts.admin')

@section('title', 'Manajemen Partner E-Commerce')
@section('page-title', 'Manajemen Partner E-Commerce')

@section('content')

{{-- Header --}}
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
    <div>
        <h2 class="text-xl font-bold text-[#163326]">Partner E-Commerce</h2>
        <p class="text-[#6B7280] text-sm mt-0.5">{{ $partners->total() }} partner terdaftar (tampil di pintasan beranda publik)</p>
    </div>
    <a href="{{ route('admin.ecommerce-partners.create') }}"
       class="inline-flex items-center gap-2 h-10 px-5 bg-[#238B45] hover:bg-[#1E7A3B] text-white text-sm font-semibold rounded-[10px] shadow-sm hover:shadow transition-all duration-200">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
        </svg>
        Tambah Partner
    </a>
</div>

{{-- Partner List --}}
<div class="bg-white rounded-2xl border border-[#E5E7EB] overflow-hidden">

    @if ($partners->isEmpty())
        {{-- Empty state --}}
        <div class="flex flex-col items-center justify-center py-20 text-center px-4">
            <div class="w-16 h-16 rounded-2xl bg-[#F7FAF8] flex items-center justify-center mb-4">
                <svg class="w-8 h-8 text-[#6B7280]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
            </div>
            <p class="text-[#163326] font-semibold text-base">Belum ada partner e-commerce</p>
            <p class="text-[#6B7280] text-sm mt-1 mb-5 max-w-md">Tambahkan partner seperti Shopee, Tokopedia, TikTok Shop, atau marketplace lainnya untuk ditampilkan di beranda.</p>
            <a href="{{ route('admin.ecommerce-partners.create') }}"
               class="inline-flex items-center gap-2 h-10 px-5 bg-[#238B45] hover:bg-[#1E7A3B] text-white text-sm font-semibold rounded-[10px] transition-all duration-200">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Partner Pertama
            </a>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-[#E5E7EB] bg-[#F7FAF8]">
                        <th class="text-left text-xs font-semibold text-[#6B7280] uppercase tracking-wider px-5 py-3.5">Logo</th>
                        <th class="text-left text-xs font-semibold text-[#6B7280] uppercase tracking-wider px-5 py-3.5">Nama & Tautan Toko</th>
                        <th class="text-center text-xs font-semibold text-[#6B7280] uppercase tracking-wider px-5 py-3.5">Urutan</th>
                        <th class="text-center text-xs font-semibold text-[#6B7280] uppercase tracking-wider px-5 py-3.5">Status</th>
                        <th class="text-right text-xs font-semibold text-[#6B7280] uppercase tracking-wider px-5 py-3.5">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#E5E7EB]">
                    @foreach ($partners as $partner)
                        <tr class="hover:bg-[#F7FAF8] transition-colors duration-100">

                            {{-- Logo / Ikon --}}
                            <td class="px-5 py-4">
                                <div class="w-12 h-12 rounded-xl bg-[#F7FAF8] border border-[#E5E7EB] flex items-center justify-center p-1.5 flex-shrink-0 overflow-hidden">
                                    @if ($partner->logo)
                                        <img src="{{ Storage::disk('public')->url($partner->logo) }}"
                                             alt="{{ $partner->name }}"
                                             class="max-w-full max-h-full object-contain"
                                             loading="lazy">
                                    @else
                                        {{-- Fallback icon --}}
                                        <div class="w-8 h-8 rounded-lg bg-[#EAF6EE] text-[#238B45] flex items-center justify-center">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                            </td>

                            {{-- Nama & URL --}}
                            <td class="px-5 py-4">
                                <p class="font-bold text-[#163326] text-sm">
                                    {{ $partner->name }}
                                </p>
                                <a href="{{ $partner->url }}"
                                   target="_blank"
                                   rel="noopener noreferrer"
                                   class="inline-flex items-center gap-1 text-xs text-[#238B45] hover:underline truncate max-w-xs mt-0.5">
                                    <span>{{ $partner->url }}</span>
                                    <svg class="w-3 h-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                    </svg>
                                </a>
                            </td>

                            {{-- Sort Order --}}
                            <td class="px-5 py-4 text-center">
                                <span class="inline-flex items-center justify-center px-2.5 py-1 rounded-md bg-[#F7FAF8] border border-[#E5E7EB] font-semibold text-xs text-[#163326]">
                                    {{ $partner->sort_order }}
                                </span>
                            </td>

                            {{-- Status + Quick Toggle --}}
                            <td class="px-5 py-4 text-center">
                                <form method="POST" action="{{ route('admin.ecommerce-partners.toggle', $partner) }}" class="inline-block">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                            title="Klik untuk mengubah status"
                                            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold cursor-pointer transition-all duration-150 {{ $partner->is_active ? 'bg-[#EAF6EE] text-[#238B45] hover:bg-[#d6f0de]' : 'bg-gray-100 text-[#6B7280] hover:bg-gray-200' }}">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $partner->is_active ? 'bg-[#238B45]' : 'bg-gray-400' }}"></span>
                                        {{ $partner->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </button>
                                </form>
                            </td>

                            {{-- Actions --}}
                            <td class="px-5 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    {{-- Edit --}}
                                    <a href="{{ route('admin.ecommerce-partners.edit', $partner) }}"
                                       class="p-2 text-[#6B7280] hover:text-[#238B45] hover:bg-[#EAF6EE] rounded-lg transition-colors"
                                       title="Edit Partner">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>

                                    {{-- Delete --}}
                                    <form method="POST"
                                          action="{{ route('admin.ecommerce-partners.destroy', $partner) }}"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus partner {{ $partner->name }}?')"
                                          class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="p-2 text-[#6B7280] hover:text-[#E11D48] hover:bg-red-50 rounded-lg transition-colors"
                                                title="Hapus Partner">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if ($partners->hasPages())
            <div class="px-5 py-4 border-t border-[#E5E7EB]">
                {{ $partners->links() }}
            </div>
        @endif
    @endif

</div>

@endsection
