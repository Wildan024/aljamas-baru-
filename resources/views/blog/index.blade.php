@extends('layouts.public')

@section('title', 'Blog & Informasi Kuliner — ' . ($settings['company_name'] ?? 'Aljamas'))
@section('meta_description', 'Temukan informasi, tips, resep olahan, dan cerita seputar bahan baku kuliner berkualitas serta perkembangan ' . ($settings['company_name'] ?? 'Aljamas') . '.')
@section('og_title', 'Blog & Informasi Kuliner — ' . ($settings['company_name'] ?? 'Aljamas'))
@section('og_description', 'Kumpulan artikel dan panduan seputar kulit dimsum, kulit pangsit, kulit samosa, dan adonan kuliner.')

@section('content')

@php
    $companyName = $settings['company_name'] ?? 'Aljamas';
    $waNumber = preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '');
    $waDefaultMsg = urlencode($settings['whatsapp_default_message'] ?? 'Halo Aljamas, saya ingin bertanya tentang produk dan artikel kuliner Anda.');
    $waOrderBase = !empty($waNumber) ? "https://wa.me/{$waNumber}" : '#kontak';
@endphp

{{-- ================================================================= --}}
{{-- 1. HEADER & INTRO SECTION (Split 2-Column Hero) --}}
{{-- ================================================================= --}}
<section class="bg-gradient-to-b from-[#F7FAF8] to-white pt-10 pb-12 md:pt-14 md:pb-16 border-b border-[#E5E7EB]/60 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-xs text-[#6B7280] mb-6" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-[#238B45] transition-colors">Beranda</a>
            <svg class="w-3.5 h-3.5 text-[#6B7280]/60" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-[#163326] font-semibold">Blog</span>
        </nav>

        {{-- Split Hero: Content Left | Image Right --}}
        <div class="flex flex-col lg:flex-row lg:items-center lg:gap-12 xl:gap-16">

            {{-- LEFT: Text Content (52%) --}}
            <div class="flex-shrink-0 lg:w-[52%] space-y-4">
                {{-- Eyebrow Badge --}}
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#EAF6EE] text-[#238B45] text-xs font-semibold">
                    <span class="w-2 h-2 rounded-full bg-[#238B45]"></span>
                    <span>Insight Aljamas</span>
                </div>

                {{-- Heading --}}
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-[#163326] tracking-tight leading-tight">
                    Informasi &amp; Inspirasi Seputar Kuliner
                </h1>

                {{-- Description --}}
                <p class="text-base sm:text-lg text-[#6B7280] leading-relaxed max-w-xl">
                    Temukan informasi, tips, dan cerita seputar bahan baku kuliner serta perkembangan Aljamas.
                </p>
            </div>

            {{-- RIGHT: Culinary Photography (48%) --}}
            <div class="mt-8 lg:mt-0 lg:flex-1 relative">
                {{-- Decorative subtle soft green blob --}}
                <div class="absolute -top-6 -right-6 w-64 h-64 rounded-full bg-[#EAF6EE] opacity-60 blur-3xl pointer-events-none" aria-hidden="true"></div>

                <div class="relative">
                    <img
                        src="{{ asset('images/blog/blog-hero.jpg') }}"
                        alt="Bahan baku kuliner dan olahan adonan berkualitas dari Aljamas"
                        class="w-full aspect-[16/10] object-cover rounded-3xl shadow-md"
                        width="720"
                        height="450"
                        loading="eager"
                        fetchpriority="high"
                    >
                </div>
            </div>

        </div>

    </div>
</section>

{{-- ================================================================= --}}
{{-- 2. MAIN BLOG SECTION (Featured + Grid) --}}
{{-- ================================================================= --}}
<section class="py-12 md:py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Empty State jika tidak ada artikel sama sekali --}}
        @if (!$featuredBlog && $blogs->isEmpty())
            <div class="bg-[#F7FAF8] rounded-3xl border border-[#E5E7EB] p-12 text-center max-w-lg mx-auto my-8">
                <div class="w-16 h-16 rounded-2xl bg-white text-[#238B45] border border-[#E5E7EB] flex items-center justify-center mx-auto mb-4 shadow-sm">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                    </svg>
                </div>
                <h3 class="text-[#163326] font-bold text-lg mb-1">
                    Belum Ada Artikel
                </h3>
                <p class="text-[#6B7280] text-sm leading-relaxed mb-6">
                    Informasi dan cerita terbaru dari Aljamas akan segera hadir. Kunjungi kembali untuk mendapatkan tips dan panduan kuliner menarik.
                </p>
                <div class="flex items-center justify-center gap-3">
                    <a href="{{ route('home') }}"
                       class="inline-flex items-center justify-center h-10 px-5 bg-white border border-[#E5E7EB] hover:border-[#238B45] text-[#163326] hover:text-[#238B45] text-xs font-semibold rounded-[10px] transition-colors">
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        @else

            {{-- 2.A FEATURED ARTICLE (Hanya Tampil di Halaman 1) --}}
            @if ($featuredBlog)
                <div class="mb-14">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#EAF6EE] text-[#238B45] text-xs font-semibold mb-4">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#238B45]"></span>
                        <span>Artikel Utama</span>
                    </div>

                    <article class="bg-[#F7FAF8] rounded-3xl border border-[#E5E7EB] overflow-hidden shadow-sm hover:shadow-md transition-shadow group">
                        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-10 items-center">

                            {{-- Featured Thumbnail --}}
                            <div class="lg:col-span-6 overflow-hidden">
                                <a href="{{ route('blog.show', $featuredBlog->slug) }}" class="block aspect-[16/10] bg-white relative overflow-hidden focus:outline-none" aria-label="{{ $featuredBlog->title }}">
                                    @if (!empty($featuredBlog->image))
                                        <img src="{{ Storage::disk('public')->url($featuredBlog->image) }}"
                                             alt="{{ $featuredBlog->title }}"
                                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                             loading="eager">
                                    @else
                                        <div class="w-full h-full flex flex-col items-center justify-center text-[#6B7280] bg-gradient-to-br from-white to-[#EAF6EE]/50 p-8 text-center">
                                            <div class="w-16 h-16 rounded-2xl bg-white text-[#238B45] border border-[#E5E7EB] flex items-center justify-center mb-3 shadow-sm group-hover:scale-110 transition-transform">
                                                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                                </svg>
                                            </div>
                                            <span class="text-sm font-semibold text-[#163326]">Insight Utama Aljamas</span>
                                            <span class="text-xs text-[#6B7280]">Edukasi &amp; Kabar Terkini</span>
                                        </div>
                                    @endif
                                </a>
                            </div>

                            {{-- Featured Content Info --}}
                            <div class="lg:col-span-6 p-6 sm:p-8 lg:p-10 lg:pl-0 space-y-4">
                                {{-- Category & Date Row --}}
                                <div class="flex flex-wrap items-center gap-3">
                                    @if ($featuredBlog->category)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-[#EAF6EE] text-[#238B45] border border-[#238B45]/20">
                                            {{ $featuredBlog->category->name }}
                                        </span>
                                    @endif
                                    <span class="text-xs text-[#6B7280] font-medium">
                                        {{ $featuredBlog->published_at ? $featuredBlog->published_at->format('d M Y') : $featuredBlog->created_at->format('d M Y') }}
                                    </span>
                                </div>

                                {{-- Title --}}
                                <h2 class="text-2xl sm:text-3xl font-extrabold text-[#163326] group-hover:text-[#238B45] transition-colors leading-tight">
                                    <a href="{{ route('blog.show', $featuredBlog->slug) }}" class="focus:outline-none">
                                        {{ $featuredBlog->title }}
                                    </a>
                                </h2>

                                {{-- Excerpt --}}
                                @if ($featuredBlog->excerpt)
                                    <p class="text-base text-[#6B7280] leading-relaxed line-clamp-3">
                                        {{ $featuredBlog->excerpt }}
                                    </p>
                                @endif

                                {{-- Action CTA Button --}}
                                <div class="pt-3">
                                    <a href="{{ route('blog.show', $featuredBlog->slug) }}"
                                       class="inline-flex items-center gap-2 h-11 px-6 bg-[#238B45] hover:bg-[#1E7A3B] text-white text-xs font-semibold rounded-[10px] shadow-sm hover:shadow transition-all duration-150">
                                        <span>Baca Artikel Lengkap</span>
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </article>
                </div>
            @endif

            {{-- 2.B ARTICLE GRID --}}
            @if ($blogs->isNotEmpty())
                <div class="space-y-8">
                    <div class="flex items-center justify-between border-b border-[#E5E7EB] pb-4">
                        <h2 class="text-2xl font-extrabold text-[#163326] tracking-tight">
                            {{ $featuredBlog ? 'Artikel Terbaru Lainnya' : 'Daftar Artikel' }}
                        </h2>
                        <span class="text-xs text-[#6B7280] font-medium">
                            Menampilkan {{ $blogs->firstItem() }} - {{ $blogs->lastItem() }} dari {{ $blogs->total() }} artikel
                        </span>
                    </div>

                    {{-- 3 Columns Grid --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                        @foreach ($blogs as $blog)
                            <x-public-blog-card :blog="$blog" />
                        @endforeach
                    </div>

                    {{-- Pagination Links --}}
                    <div class="pt-8 flex justify-center">
                        {{ $blogs->links() }}
                    </div>
                </div>
            @elseif (!$featuredBlog)
                <p class="text-sm text-[#6B7280] text-center py-8">
                    Tidak ada artikel di halaman ini.
                </p>
            @endif

        @endif

    </div>
</section>

{{-- ================================================================= --}}
{{-- 3. BOTTOM CALLOUT / PARTNERSHIP BANNER --}}
{{-- ================================================================= --}}
<section class="py-12 bg-[#F7FAF8] border-t border-[#E5E7EB]/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-[#163326] text-white rounded-3xl p-8 sm:p-10 flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="space-y-2 max-w-xl text-center md:text-left">
                <h3 class="text-xl sm:text-2xl font-bold tracking-tight text-white">
                    Punya Pertanyaan Seputar Bahan Baku Kuliner?
                </h3>
                <p class="text-sm text-white/75 leading-relaxed">
                    Konsultasikan kebutuhan kulit dimsum, kulit pangsit, kulit samosa, atau mie segar untuk bisnis kuliner Anda langsung bersama tim Aljamas.
                </p>
            </div>
            @if (!empty($waNumber))
                <a href="{{ $waOrderBase }}?text={{ $waDefaultMsg }}"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="inline-flex items-center justify-center gap-2 h-12 px-6 bg-[#238B45] hover:bg-[#1E7A3B] text-white text-sm font-semibold rounded-[10px] transition-colors flex-shrink-0 shadow-md">
                    <span>Hubungi via WhatsApp</span>
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>
            @endif
        </div>
    </div>
</section>

@endsection
