@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

{{-- Greeting --}}
<div class="mb-8">
    <h2 class="text-2xl font-bold text-[#163326]">
        Selamat datang, {{ auth()->user()->name }}! 👋
    </h2>
    <p class="text-[#6B7280] text-sm mt-1">
        Berikut ringkasan data website Aljamas hari ini, {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}.
    </p>
</div>

{{-- Stat Cards --}}
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-8">

    {{-- Products --}}
    <div class="bg-white rounded-2xl border border-[#E5E7EB] p-6 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-[#6B7280] text-xs font-semibold uppercase tracking-wider mb-2">Produk</p>
                <p class="text-4xl font-bold text-[#163326]">{{ number_format($stats['products']) }}</p>
                <p class="text-[#6B7280] text-xs mt-1">total produk terdaftar</p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-[#EAF6EE] flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6 text-[#238B45]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
            </div>
        </div>
    </div>

    {{-- Blogs --}}
    <div class="bg-white rounded-2xl border border-[#E5E7EB] p-6 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-[#6B7280] text-xs font-semibold uppercase tracking-wider mb-2">Artikel Blog</p>
                <p class="text-4xl font-bold text-[#163326]">{{ number_format($stats['blogs']) }}</p>
                <p class="text-[#6B7280] text-xs mt-1">total artikel</p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-[#EAF6EE] flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6 text-[#238B45]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
        </div>
    </div>

    {{-- Galleries --}}
    <div class="bg-white rounded-2xl border border-[#E5E7EB] p-6 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-[#6B7280] text-xs font-semibold uppercase tracking-wider mb-2">Galeri</p>
                <p class="text-4xl font-bold text-[#163326]">{{ number_format($stats['galleries']) }}</p>
                <p class="text-[#6B7280] text-xs mt-1">foto dokumentasi</p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-[#EAF6EE] flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6 text-[#238B45]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
        </div>
    </div>

    {{-- Partnerships --}}
    <div class="bg-white rounded-2xl border border-[#E5E7EB] p-6 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-[#6B7280] text-xs font-semibold uppercase tracking-wider mb-2">Pengajuan Mitra</p>
                <p class="text-4xl font-bold text-[#163326]">{{ number_format($stats['partnerships']) }}</p>
                <p class="text-[#6B7280] text-xs mt-1">
                    @if ($stats['new_partnerships'] > 0)
                        <span class="text-[#238B45] font-semibold">{{ $stats['new_partnerships'] }} baru</span> menunggu tindak lanjut
                    @else
                        semua sudah ditindaklanjuti
                    @endif
                </p>
            </div>
            <div class="w-12 h-12 rounded-xl {{ $stats['new_partnerships'] > 0 ? 'bg-amber-50' : 'bg-[#EAF6EE]' }} flex items-center justify-center flex-shrink-0 relative">
                <svg class="w-6 h-6 {{ $stats['new_partnerships'] > 0 ? 'text-amber-500' : 'text-[#238B45]' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                @if ($stats['new_partnerships'] > 0)
                    <span class="absolute -top-1 -right-1 w-5 h-5 bg-amber-500 text-white text-xs font-bold rounded-full flex items-center justify-center">
                        {{ $stats['new_partnerships'] > 9 ? '9+' : $stats['new_partnerships'] }}
                    </span>
                @endif
            </div>
        </div>
    </div>

</div>

{{-- Quick Actions --}}
<div class="bg-white rounded-2xl border border-[#E5E7EB] p-6">
    <h3 class="text-[#163326] font-semibold text-base mb-4">Akses Cepat</h3>
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3">

        {{-- Tambah Produk --}}
        <a href="{{ route('admin.products.create') }}"
           class="group flex flex-col items-center gap-2 p-4 rounded-xl border border-[#E5E7EB] hover:border-[#238B45]/40 hover:bg-[#EAF6EE]/30 transition-all duration-200 shadow-sm hover:shadow">
            <div class="w-10 h-10 rounded-xl bg-[#EAF6EE] text-[#238B45] group-hover:scale-110 transition-transform flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
            </div>
            <p class="text-xs font-semibold text-[#163326] group-hover:text-[#238B45] transition-colors text-center leading-tight">Tambah Produk</p>
            <span class="text-[10px] text-[#6B7280]">Katalog</span>
        </a>

        {{-- Tulis Artikel --}}
        <a href="{{ route('admin.blogs.create') }}"
           class="group flex flex-col items-center gap-2 p-4 rounded-xl border border-[#E5E7EB] hover:border-[#238B45]/40 hover:bg-[#EAF6EE]/30 transition-all duration-200 shadow-sm hover:shadow">
            <div class="w-10 h-10 rounded-xl bg-[#EAF6EE] text-[#238B45] group-hover:scale-110 transition-transform flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
            </div>
            <p class="text-xs font-semibold text-[#163326] group-hover:text-[#238B45] transition-colors text-center leading-tight">Tulis Artikel</p>
            <span class="text-[10px] text-[#6B7280]">Blog</span>
        </a>

        {{-- Upload Foto --}}
        <a href="{{ route('admin.galleries.create') }}"
           class="group flex flex-col items-center gap-2 p-4 rounded-xl border border-[#E5E7EB] hover:border-[#238B45]/40 hover:bg-[#EAF6EE]/30 transition-all duration-200 shadow-sm hover:shadow">
            <div class="w-10 h-10 rounded-xl bg-[#EAF6EE] text-[#238B45] group-hover:scale-110 transition-transform flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                </svg>
            </div>
            <p class="text-xs font-semibold text-[#163326] group-hover:text-[#238B45] transition-colors text-center leading-tight">Upload Foto</p>
            <span class="text-[10px] text-[#6B7280]">Dokumentasi</span>
        </a>

        {{-- Pengajuan Mitra --}}
        <a href="{{ route('admin.partnerships.index') }}"
           class="group flex flex-col items-center gap-2 p-4 rounded-xl border {{ $stats['new_partnerships'] > 0 ? 'border-amber-200 bg-amber-50/40 hover:bg-amber-50' : 'border-[#E5E7EB] hover:border-[#238B45]/40 hover:bg-[#EAF6EE]/30' }} transition-all duration-200 shadow-sm hover:shadow relative">
            <div class="w-10 h-10 rounded-xl {{ $stats['new_partnerships'] > 0 ? 'bg-amber-100 text-amber-700' : 'bg-[#EAF6EE] text-[#238B45]' }} group-hover:scale-110 transition-transform flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>
            <p class="text-xs font-semibold text-[#163326] group-hover:text-[#238B45] transition-colors text-center leading-tight">Pengajuan Mitra</p>
            <span class="text-[10px] {{ $stats['new_partnerships'] > 0 ? 'text-amber-700 font-bold' : 'text-[#6B7280]' }}">
                {{ $stats['new_partnerships'] > 0 ? $stats['new_partnerships'] . ' baru' : 'Lihat Semua' }}
            </span>
        </a>

        {{-- Pengaturan --}}
        <a href="{{ route('admin.settings.index') }}"
           class="group flex flex-col items-center gap-2 p-4 rounded-xl border border-[#E5E7EB] hover:border-[#238B45]/40 hover:bg-[#EAF6EE]/30 transition-all duration-200 shadow-sm hover:shadow">
            <div class="w-10 h-10 rounded-xl bg-[#EAF6EE] text-[#238B45] group-hover:scale-110 transition-transform flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <p class="text-xs font-semibold text-[#163326] group-hover:text-[#238B45] transition-colors text-center leading-tight">Pengaturan</p>
            <span class="text-[10px] text-[#6B7280]">Perusahaan</span>
        </a>

    </div>
</div>

@endsection
