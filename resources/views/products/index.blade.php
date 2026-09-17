@extends('layouts.public')

@section('title', 'Katalog Produk — ' . ($settings['company_name'] ?? 'Aljamas'))
@section('meta_description', 'Katalog lengkap kulit dimsum, kulit pangsit, kulit samosa, dan mie segar higienis berkualitas langsung dari produsen ' . ($settings['company_name'] ?? 'Aljamas') . '.')

@section('content')

@php
    $companyName = $settings['company_name'] ?? 'Aljamas';
    $waNumber = preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '');
    $waDefaultMsg = urlencode($settings['whatsapp_default_message'] ?? 'Halo Aljamas, saya ingin bertanya tentang produk Anda.');
    $waOrderBase = !empty($waNumber) ? "https://wa.me/{$waNumber}" : '#kontak';
@endphp

{{-- ================================================================= --}}
{{-- 1. HEADER & INTRO SECTION --}}
{{-- ================================================================= --}}
<section class="bg-gradient-to-b from-[#F7FAF8] to-white pt-10 pb-12 md:pt-14 md:pb-16 border-b border-[#E5E7EB]/60 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-xs text-[#6B7280] mb-6" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-[#238B45] transition-colors">Beranda</a>
            <svg class="w-3.5 h-3.5 text-[#6B7280]/60" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-[#163326] font-semibold">Produk</span>
        </nav>

        {{-- Split Hero: Content Left | Image Right --}}
        <div class="flex flex-col lg:flex-row lg:items-center lg:gap-12 xl:gap-16">

            {{-- LEFT: Text Content (55%) --}}
            <div class="flex-shrink-0 lg:w-[55%] space-y-4">
                {{-- Eyebrow --}}
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#EAF6EE] text-[#238B45] text-xs font-semibold">
                    <span class="w-2 h-2 rounded-full bg-[#238B45]"></span>
                    <span>Katalog Resmi Aljamas</span>
                </div>

                {{-- Heading --}}
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-[#163326] tracking-tight leading-tight">
                    Pilihan Bahan Baku Kulit &amp; Adonan Berkualitas
                </h1>

                {{-- Description --}}
                <p class="text-base sm:text-lg text-[#6B7280] leading-relaxed max-w-xl">
                    Produk olahan adonan segar berstandar usaha kuliner. Tekstur elastis, tidak mudah sobek, dan siap memasok kebutuhan harian bisnis Anda.
                </p>
            </div>

            {{-- RIGHT: Food Photography (45%) --}}
            <div class="mt-8 lg:mt-0 lg:flex-1 relative">
                {{-- Decorative soft green blob behind image --}}
                <div class="absolute -top-6 -right-6 w-64 h-64 rounded-full bg-[#EAF6EE] opacity-60 blur-3xl pointer-events-none" aria-hidden="true"></div>

                <div class="relative">
                    <img
                        src="{{ asset('images/products/hero-food.jpg') }}"
                        alt="Kulit dimsum, kulit pangsit, dan kulit samosa segar berkualitas dari Aljamas"
                        class="w-full aspect-[4/3] object-cover rounded-3xl shadow-md"
                        width="720"
                        height="540"
                        loading="eager"
                    >
                </div>
            </div>

        </div>

    </div>
</section>

{{-- ================================================================= --}}
{{-- 2. CATEGORY FILTER & PRODUCT GRID --}}
{{-- ================================================================= --}}
<section class="py-12 md:py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Category Tabs --}}
        @if ($categories->isNotEmpty())
            <div class="flex flex-wrap items-center gap-2.5 mb-10 pb-2 overflow-x-auto" aria-label="Filter Kategori Produk">
                {{-- All categories pill --}}
                <a href="{{ route('products.index') }}"
                   class="px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold transition-all duration-150 whitespace-nowrap {{ empty($selectedCategorySlug) ? 'bg-[#238B45] text-white shadow-sm' : 'bg-[#F7FAF8] text-[#163326] hover:bg-[#EAF6EE] hover:text-[#238B45] border border-[#E5E7EB]' }}">
                    Semua Produk
                </a>

                {{-- Category pills --}}
                @foreach ($categories as $category)
                    <a href="{{ route('products.index', ['kategori' => $category->slug]) }}"
                       class="px-4 py-2 rounded-xl text-xs sm:text-sm transition-all duration-150 whitespace-nowrap {{ $selectedCategorySlug === $category->slug ? 'bg-[#238B45] text-white font-semibold shadow-sm' : 'bg-[#F7FAF8] text-[#163326] hover:bg-[#EAF6EE] hover:text-[#238B45] font-medium border border-[#E5E7EB]' }}">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        @endif

        {{-- Product Grid --}}
        @if ($products->isEmpty())
            {{-- Empty State --}}
            <div class="bg-[#F7FAF8] rounded-3xl border border-[#E5E7EB] p-12 text-center max-w-lg mx-auto my-8">
                <div class="w-16 h-16 rounded-2xl bg-white text-[#238B45] border border-[#E5E7EB] flex items-center justify-center mx-auto mb-4 shadow-sm">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
                <h3 class="text-[#163326] font-bold text-lg mb-1">
                    {{ !empty($selectedCategorySlug) ? 'Tidak Ada Produk di Kategori Ini' : 'Katalog Sedang Diperbarui' }}
                </h3>
                <p class="text-[#6B7280] text-sm leading-relaxed mb-6">
                    {{ !empty($selectedCategorySlug) ? 'Silakan pilih kategori lain atau hubungi kami langsung untuk ketersediaan stok.' : 'Informasi varian produk Aljamas akan segera diperbarui. Hubungi kami untuk katalog lengkap.' }}
                </p>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
                    @if (!empty($selectedCategorySlug))
                        <a href="{{ route('products.index') }}"
                           class="inline-flex items-center justify-center h-10 px-5 bg-white border border-[#E5E7EB] hover:border-[#238B45] text-[#163326] hover:text-[#238B45] text-xs font-semibold rounded-[10px] transition-colors">
                            Lihat Semua Produk
                        </a>
                    @endif
                    @if (!empty($waNumber))
                        <a href="{{ $waOrderBase }}?text={{ $waDefaultMsg }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="inline-flex items-center justify-center gap-2 h-10 px-5 bg-[#238B45] hover:bg-[#1E7A3B] text-white text-xs font-semibold rounded-[10px] transition-colors shadow-sm">
                            Hubungi via WhatsApp
                        </a>
                    @endif
                </div>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                @foreach ($products as $product)
                    @php
                        $orderProductMsg = urlencode("Halo Aljamas, saya ingin memesan / bertanya detail tentang produk: {$product->name}");
                        $productWaUrl = !empty($waNumber) ? "https://wa.me/{$waNumber}?text={$orderProductMsg}" : '#kontak';
                    @endphp
                    <article class="bg-white rounded-2xl border border-[#E5E7EB] overflow-hidden flex flex-col hover:-translate-y-1 hover:shadow-lg hover:border-[#238B45]/40 transition-all duration-200 group">

                        {{-- Product Image --}}
                        <a href="{{ route('products.show', $product->slug) }}" class="block aspect-[4/3] bg-[#F7FAF8] border-b border-[#E5E7EB] relative overflow-hidden focus:outline-none">
                            @if ($product->image)
                                <img src="{{ Storage::disk('public')->url($product->image) }}"
                                     alt="{{ $product->name }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                     loading="lazy">
                            @else
                                <div class="w-full h-full flex flex-col items-center justify-center text-[#6B7280] bg-[#F7FAF8]">
                                    <svg class="w-12 h-12 text-[#238B45]/30 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                    </svg>
                                    <span class="text-xs font-medium text-[#6B7280]">Foto Produk Aljamas</span>
                                </div>
                            @endif

                            {{-- Category Badge --}}
                            @if ($product->category)
                                <div class="absolute top-3.5 left-3.5">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-white/95 text-[#238B45] shadow-sm backdrop-blur-sm">
                                        {{ $product->category->name }}
                                    </span>
                                </div>
                            @endif
                        </a>

                        {{-- Product Info & Action --}}
                        <div class="p-6 flex-1 flex flex-col justify-between">
                            <div>
                                <h2 class="font-bold text-lg text-[#163326] group-hover:text-[#238B45] transition-colors leading-snug">
                                    <a href="{{ route('products.show', $product->slug) }}" class="focus:outline-none">
                                        {{ $product->name }}
                                    </a>
                                </h2>
                                @if ($product->short_description)
                                    <p class="text-sm text-[#6B7280] leading-relaxed mt-2 line-clamp-2">
                                        {{ $product->short_description }}
                                    </p>
                                @endif
                            </div>

                            {{-- Card Footer --}}
                            <div class="pt-5 mt-5 border-t border-[#E5E7EB] flex items-center justify-between gap-3">
                                <a href="{{ route('products.show', $product->slug) }}"
                                   class="text-xs font-semibold text-[#163326] hover:text-[#238B45] transition-colors flex items-center gap-1">
                                    <span>Lihat Detail</span>
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>

                                <a href="{{ $productWaUrl }}"
                                   target="{{ !empty($waNumber) ? '_blank' : '_self' }}"
                                   rel="noopener noreferrer"
                                   class="inline-flex items-center gap-1.5 h-9 px-3.5 bg-[#238B45] hover:bg-[#1E7A3B] text-white text-xs font-semibold rounded-[8px] transition-colors shadow-sm">
                                    <span>Pesan via WA</span>
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                    </svg>
                                </a>
                            </div>
                        </div>

                    </article>
                @endforeach
            </div>
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
                    Membutuhkan Pasokan Rutin atau Skala Grosir?
                </h3>
                <p class="text-sm text-white/75 leading-relaxed">
                    Dapatkan penawaran harga khusus pabrik, jadwal pengiriman teratur, dan sampel produk gratis untuk usaha kuliner Anda.
                </p>
            </div>
            @if (!empty($waNumber))
                <a href="{{ $waOrderBase }}?text={{ urlencode('Halo Aljamas, saya tertarik untuk memesan pasokan rutin bahan baku produk.') }}"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="inline-flex items-center justify-center gap-2 h-12 px-6 bg-[#238B45] hover:bg-[#1E7A3B] text-white text-sm font-semibold rounded-[10px] transition-colors flex-shrink-0 shadow-md">
                    <span>Konsultasi Pasokan via WA</span>
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>
            @endif
        </div>
    </div>
</section>

@endsection
