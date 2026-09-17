@extends('layouts.public')

@section('title', 'Halaman Tidak Ditemukan (404) — ' . ($settings['company_name'] ?? 'Aljamas'))
@section('meta_description', 'Halaman yang Anda cari tidak ditemukan atau telah dipindahkan.')

@section('content')
<section class="min-h-[60vh] flex items-center justify-center py-16 md:py-24 bg-gradient-to-b from-[#F7FAF8] to-white">
    <div class="max-w-xl mx-auto px-4 sm:px-6 text-center space-y-6">
        {{-- 404 Icon & Badge --}}
        <div class="inline-flex items-center justify-center w-20 h-20 rounded-3xl bg-[#EAF6EE] text-[#238B45] border border-[#238B45]/20 shadow-sm mx-auto">
            <span class="text-3xl font-black">404</span>
        </div>

        {{-- Main Heading --}}
        <h1 class="text-3xl sm:text-4xl font-extrabold text-[#163326] tracking-tight">
            Halaman Tidak Ditemukan
        </h1>

        {{-- Description --}}
        <p class="text-base text-[#6B7280] leading-relaxed max-w-md mx-auto">
            Maaf, halaman yang Anda tuju tidak tersedia, telah dihapus, atau tautan yang Anda ikuti sudah kedaluwarsa.
        </p>

        {{-- Helpful Action Buttons --}}
        <div class="flex flex-col sm:flex-row items-center justify-center gap-3.5 pt-2">
            <a href="{{ route('home') }}"
               class="w-full sm:w-auto inline-flex items-center justify-center gap-2 h-11 px-6 bg-[#238B45] hover:bg-[#1E7A3B] text-white text-sm font-semibold rounded-[10px] shadow-sm hover:shadow transition-colors">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span>Kembali ke Beranda</span>
            </a>

            <a href="{{ route('products.index') }}"
               class="w-full sm:w-auto inline-flex items-center justify-center gap-2 h-11 px-6 border border-[#E5E7EB] hover:border-[#238B45] bg-white text-[#163326] hover:text-[#238B45] text-sm font-semibold rounded-[10px] shadow-sm transition-colors">
                <span>Lihat Katalog Produk</span>
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>
@endsection
