@extends('layouts.public')

@section('title', ($settings['company_name'] ?? 'Aljamas') . ' — ' . ($settings['company_tagline'] ?? 'Produsen Kulit Dimsum & Olahan Adonan Berkualitas'))

@section('content')

@php
    $companyName = $settings['company_name'] ?? 'Aljamas';
    $tagline = $settings['company_tagline'] ?? 'Solusi Kulit & Produk Adonan Berkualitas untuk Bisnis Kuliner';
    $waNumber = preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '');
    $waDefaultMsg = urlencode($settings['whatsapp_default_message'] ?? 'Halo Aljamas, saya ingin bertanya tentang produk Anda.');
    $waPartnerMsg = urlencode('Halo Aljamas, saya tertarik untuk mengajukan kemitraan / pasokan rutin bahan baku.');
    $waOrderBase = !empty($waNumber) ? "https://wa.me/{$waNumber}" : '#kontak';
@endphp

{{-- ================================================================= --}}
{{-- 1. HERO SECTION (Asymmetric Split Screen, Taste-First Composition) --}}
{{-- ================================================================= --}}
<section class="relative bg-gradient-to-b from-[#F7FAF8] to-white pt-10 pb-16 md:pt-16 md:pb-24 overflow-hidden border-b border-[#E5E7EB]/60">
    {{-- Background subtle decorative accents --}}
    <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 rounded-full bg-[#EAF6EE]/70 blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 rounded-full bg-[#EAF6EE]/50 blur-2xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center">

            {{-- Left Column (7 cols): Strong Brand Messaging & Direct CTAs --}}
            <div class="lg:col-span-7 space-y-6 text-left">

                {{-- Eyebrow Badge --}}
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-[#EAF6EE] text-[#238B45] text-xs font-semibold tracking-wide">
                    <span class="w-2 h-2 rounded-full bg-[#238B45] animate-pulse"></span>
                    <span>Produsen Kulit Dimsum & Adonan Olahan</span>
                </div>

                {{-- Main Headline (Max 2 lines desktop) --}}
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-[#163326] tracking-tight leading-[1.15]">
                    Bahan Baku Kulit & Adonan Berkualitas untuk Bisnis Kuliner Anda
                </h1>

                {{-- Concise Subtext (Restrained, honest value prop) --}}
                <p class="text-base sm:text-lg text-[#6B7280] leading-relaxed max-w-2xl">
                    {{ $tagline }}. Tekstur elastis, tidak mudah sobek, dan higienis untuk kebutuhan restoran, katering, serta UMKM kuliner.
                </p>

                {{-- Dual CTAs --}}
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3.5 pt-2">
                    <a href="#produk"
                       class="inline-flex items-center justify-center gap-2 h-12 px-6 bg-[#238B45] hover:bg-[#1E7A3B] text-white font-semibold text-sm rounded-[10px] shadow-sm hover:shadow-md transition-all duration-150 focus:outline-none focus:ring-2 focus:ring-[#238B45] focus:ring-offset-2">
                        <span>Lihat Katalog Produk</span>
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </a>

                    <a href="#kemitraan"
                       class="inline-flex items-center justify-center gap-2 h-12 px-6 border border-[#E5E7EB] hover:border-[#238B45] bg-white text-[#163326] hover:text-[#238B45] font-semibold text-sm rounded-[10px] shadow-sm hover:shadow transition-all duration-150 focus:outline-none focus:ring-2 focus:ring-[#238B45]">
                        <span>Ajukan Kemitraan</span>
                        <svg class="w-4 h-4 text-[#238B45]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>

                {{-- Trust Highlights Micro-strip --}}
                <div class="pt-4 border-t border-[#E5E7EB] grid grid-cols-3 gap-4 text-left">
                    <div>
                        <p class="text-xl sm:text-2xl font-extrabold text-[#163326]">100%</p>
                        <p class="text-xs text-[#6B7280] font-medium mt-0.5">Bahan Pilihan</p>
                    </div>
                    <div>
                        <p class="text-xl sm:text-2xl font-extrabold text-[#238B45]">Higienis</p>
                        <p class="text-xs text-[#6B7280] font-medium mt-0.5">Standar Produksi</p>
                    </div>
                    <div>
                        <p class="text-xl sm:text-2xl font-extrabold text-[#163326]">B2B & B2C</p>
                        <p class="text-xs text-[#6B7280] font-medium mt-0.5">Pasokan Rutin</p>
                    </div>
                </div>

            </div>

            {{-- Right Column (5 cols): Authentic Manufacturing Showcase with Floating Info Card --}}
            <div class="lg:col-span-5">
                <div class="relative pb-6 sm:pb-8">
                    {{-- Decorative Underlay Card --}}
                    <div class="absolute inset-0 bg-[#238B45]/10 rounded-3xl transform rotate-2 scale-[1.02] pointer-events-none"></div>

                    {{-- Main Hero Image Container --}}
                    <div class="relative bg-white rounded-3xl border border-[#E5E7EB] overflow-hidden shadow-xl shadow-[#163326]/5 aspect-[4/3] sm:aspect-[16/11] group">
                        <img src="{{ asset('images/home/hero_food_production.jpg') }}"
                             alt="Fasilitas produksi higienis kulit dimsum dan olahan adonan Aljamas"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                             loading="eager"
                             fetchpriority="high">

                        {{-- Floating Status Badge --}}
                        <div class="absolute top-3.5 left-3.5 inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/95 text-[#238B45] text-xs font-bold shadow-md backdrop-blur-sm border border-[#E5E7EB]/80">
                            <span class="w-2 h-2 rounded-full bg-[#238B45] animate-pulse"></span>
                            <span>Produksi Harian Segar</span>
                        </div>
                    </div>

                    {{-- Overlapping Floating Card --}}
                    <div class="absolute bottom-0 left-3 right-3 sm:left-5 sm:right-5 bg-white/95 backdrop-blur-md rounded-2xl border border-[#E5E7EB] p-4 shadow-xl shadow-[#163326]/10 flex items-center justify-between gap-3">
                        <div>
                            <p class="text-[11px] text-[#6B7280] font-medium uppercase tracking-wider">Standar Mutu Pangan</p>
                            <p class="text-sm font-bold text-[#163326]">Kulit Dimsum, Pangsit & Mie Segar</p>
                        </div>
                        @if (!empty($waNumber))
                            <a href="{{ $waOrderBase }}?text={{ $waDefaultMsg }}"
                               target="_blank"
                               rel="noopener noreferrer"
                               class="px-3.5 py-2 rounded-xl bg-[#238B45] hover:bg-[#1E7A3B] text-white text-xs font-semibold transition-colors flex-shrink-0 shadow-sm">
                                Minta Sampel
                            </a>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ================================================================= --}}
{{-- 2. TENTANG KAMI / COMPANY INTRODUCTION SECTION --}}
{{-- ================================================================= --}}
<section id="tentang-kami" class="py-16 md:py-24 bg-white border-b border-[#E5E7EB]/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">

            {{-- Left Side: Authentic Craft Image + Capability Card (5 cols) --}}
            <div class="lg:col-span-5 space-y-4">
                {{-- Dough Inspection & Craft Image --}}
                <div class="relative rounded-3xl overflow-hidden border border-[#E5E7EB] shadow-md aspect-[4/3] group bg-[#F7FAF8]">
                    <img src="{{ asset('images/home/about_dough_craft.jpg') }}"
                         alt="Pemeriksaan kualitas ketebalan dan elastisitas kulit dimsum Aljamas"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                         loading="lazy">

                    {{-- Image Quality Overlay Tag --}}
                    <div class="absolute bottom-3 left-3 right-3 bg-white/95 backdrop-blur-sm rounded-xl p-3 border border-[#E5E7EB] flex items-center gap-2.5 shadow-sm">
                        <div class="w-7 h-7 rounded-lg bg-[#EAF6EE] text-[#238B45] flex items-center justify-center font-bold text-xs flex-shrink-0">
                            ✓
                        </div>
                        <p class="text-xs text-[#163326] font-semibold leading-tight">
                            Tekstur Halus, Elastis & Tidak Mudah Sobek
                        </p>
                    </div>
                </div>

                {{-- Capacity & Supply Pillar Card --}}
                <div class="p-5 rounded-2xl bg-[#F7FAF8] border border-[#E5E7EB]">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-8 h-8 rounded-lg bg-[#238B45] text-white flex items-center justify-center font-bold text-sm">
                            ✓
                        </div>
                        <h3 class="font-bold text-[#163326] text-base">Kapasitas Pasokan Rutin B2B</h3>
                    </div>
                    <p class="text-xs text-[#6B7280] leading-relaxed">
                        Didukung alur produksi yang siap memenuhi kebutuhan pesanan volume besar secara berkelanjutan bagi restoran, katering, dan distributor.
                    </p>
                </div>
            </div>

            {{-- Right Side: Editorial Narrative & Description (7 cols) --}}
            <div class="lg:col-span-7 space-y-6">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#EAF6EE] text-[#238B45] text-xs font-semibold">
                    <span>Tentang Perusahaan</span>
                </div>

                <h2 class="text-3xl sm:text-4xl font-extrabold text-[#163326] tracking-tight leading-tight">
                    Mitra Terpercaya Bahan Baku Kuliner Nusantara
                </h2>

                <p class="text-base text-[#6B7280] leading-relaxed">
                    {{ $settings['footer_text'] ?? 'Aljamas adalah produsen kulit dimsum, kulit pangsit, kulit samosa, dan olahan mie berkualitas tinggi. Kami berfokus menghadirkan bahan baku berkualitas prima yang memudahkan pelaku usaha kuliner menyajikan hidangan lezat dan konsisten.' }}
                </p>

                <p class="text-sm text-[#6B7280] leading-relaxed">
                    Dengan komitmen terhadap kebersihan proses produksi, pemilihan bahan baku berkualitas, dan pelayanan tepat waktu, kami dipercaya oleh berbagai pengusaha kuliner mulai dari kedai lokal, restoran, katering, hingga distributor regional.
                </p>

                {{-- Pillar Tags --}}
                <div class="flex flex-wrap gap-2.5 pt-2">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-[#F7FAF8] border border-[#E5E7EB] text-xs font-semibold text-[#163326]">
                        <svg class="w-4 h-4 text-[#238B45]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                        Tanpa Bahan Pengawet Berbahaya
                    </span>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-[#F7FAF8] border border-[#E5E7EB] text-xs font-semibold text-[#163326]">
                        <svg class="w-4 h-4 text-[#238B45]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                        Proses Produksi Higienis
                    </span>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-[#F7FAF8] border border-[#E5E7EB] text-xs font-semibold text-[#163326]">
                        <svg class="w-4 h-4 text-[#238B45]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                        Pengiriman Tepat Waktu
                    </span>
                </div>

                {{-- Action --}}
                <div class="pt-2">
                    @if (!empty($waNumber))
                        <a href="{{ $waOrderBase }}?text={{ $waDefaultMsg }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="inline-flex items-center gap-2 text-sm font-bold text-[#238B45] hover:text-[#1E7A3B] transition-colors">
                            <span>Konsultasikan Kebutuhan Bahan Baku Anda</span>
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    @endif
                </div>

            </div>

        </div>
    </div>
</section>

{{-- ================================================================= --}}
{{-- 3. PRODUK UNGGULAN / FEATURED PRODUCTS SECTION --}}
{{-- ================================================================= --}}
<section id="produk" class="py-16 md:py-24 bg-[#F7FAF8] border-b border-[#E5E7EB]/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Section Title --}}
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-12">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#EAF6EE] text-[#238B45] text-xs font-semibold mb-3">
                    <span>Katalog Pilihan</span>
                </div>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-[#163326] tracking-tight">
                    Produk Unggulan Aljamas
                </h2>
                <p class="text-[#6B7280] text-sm sm:text-base mt-2 max-w-xl">
                    Varian produk pilihan yang dirancang untuk performa masakan terbaik: renyah saat digoreng dan lembut kenyal saat dikukus.
                </p>
            </div>
            <div>
                <a href="{{ route('products.index') }}"
                   class="inline-flex items-center gap-2 text-sm font-semibold text-[#238B45] hover:text-[#1E7A3B] transition-colors flex-shrink-0">
                    <span>Lihat Semua Produk</span>
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>

        {{-- Product Cards Grid --}}
        @if ($featuredProducts->isEmpty())
            {{-- Graceful Empty State --}}
            <div class="bg-white rounded-2xl border border-[#E5E7EB] p-12 text-center max-w-md mx-auto">
                <div class="w-16 h-16 rounded-2xl bg-[#EAF6EE] text-[#238B45] flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
                <h3 class="text-[#163326] font-bold text-lg mb-1">Katalog Sedang Diperbarui</h3>
                <p class="text-[#6B7280] text-sm mb-5">Hubungi kami langsung untuk informasi lengkap varian produk dan harga pasokan.</p>
                @if (!empty($waNumber))
                    <a href="{{ $waOrderBase }}?text={{ $waDefaultMsg }}"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="inline-flex items-center gap-2 h-10 px-5 bg-[#238B45] hover:bg-[#1E7A3B] text-white text-sm font-semibold rounded-[10px]">
                        Hubungi via WhatsApp
                    </a>
                @endif
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                @foreach ($featuredProducts as $product)
                    @php
                        $orderProductMsg = urlencode("Halo Aljamas, saya ingin memesan / bertanya detail tentang produk: {$product->name}");
                        $productWaUrl = !empty($waNumber) ? "https://wa.me/{$waNumber}?text={$orderProductMsg}" : '#kontak';
                    @endphp
                    <div class="bg-white rounded-2xl border border-[#E5E7EB] overflow-hidden flex flex-col hover:-translate-y-1 hover:shadow-lg hover:border-[#238B45]/30 transition-all duration-200 group">

                        {{-- Product Image --}}
                        <a href="{{ route('products.show', $product->slug) }}" class="block aspect-[4/3] bg-[#F7FAF8] border-b border-[#E5E7EB] relative overflow-hidden focus:outline-none">
                            @if ($product->image)
                                <img src="{{ Storage::disk('public')->url($product->image) }}"
                                     alt="{{ $product->name }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                     loading="lazy">
                            @else
                                <div class="w-full h-full flex flex-col items-center justify-center text-[#6B7280]">
                                    <svg class="w-12 h-12 text-[#238B45]/40 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                    </svg>
                                    <span class="text-xs font-medium text-[#6B7280]">Foto Produk Aljamas</span>
                                </div>
                            @endif

                            {{-- Category Badge Overlay --}}
                            @if ($product->category)
                                <div class="absolute top-3.5 left-3.5">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-white/95 text-[#238B45] shadow-sm backdrop-blur-sm">
                                        {{ $product->category->name }}
                                    </span>
                                </div>
                            @endif
                        </a>

                        {{-- Product Content --}}
                        <div class="p-6 flex-1 flex flex-col justify-between">
                            <div>
                                <h3 class="font-bold text-lg text-[#163326] group-hover:text-[#238B45] transition-colors leading-snug">
                                    <a href="{{ route('products.show', $product->slug) }}" class="focus:outline-none">
                                        {{ $product->name }}
                                    </a>
                                </h3>
                                @if ($product->short_description)
                                    <p class="text-sm text-[#6B7280] leading-relaxed mt-2 line-clamp-2">
                                        {{ $product->short_description }}
                                    </p>
                                @endif
                            </div>

                            {{-- Card Footer Action --}}
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
                                   class="inline-flex items-center gap-1.5 h-9 px-3.5 bg-[#238B45] hover:bg-[#1E7A3B] text-white text-xs font-semibold rounded-[8px] transition-colors">
                                    <span>Pesan via WA</span>
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                    </svg>
                                </a>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        @endif

    </div>
</section>

{{-- ================================================================= --}}
{{-- 4. KEUNGGULAN / VALUE PROPOSITION SECTION --}}
{{-- ================================================================= --}}
<section class="py-16 md:py-24 bg-white border-b border-[#E5E7EB]/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Section Title --}}
        <div class="text-center max-w-2xl mx-auto mb-14">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#EAF6EE] text-[#238B45] text-xs font-semibold mb-3">
                <span>Mengapa Memilih Kami</span>
            </div>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-[#163326] tracking-tight">
                Keunggulan Produk & Layanan Aljamas
            </h2>
            <p class="text-[#6B7280] text-sm sm:text-base mt-2">
                Dirancang khusus untuk mendukung kelancaran operasional dan standar rasa bisnis kuliner Anda.
            </p>
        </div>

        {{-- 4-Pillar Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

            <div class="p-6 rounded-2xl bg-[#F7FAF8] border border-[#E5E7EB] hover:border-[#238B45]/40 transition-colors">
                <div class="w-12 h-12 rounded-xl bg-[#EAF6EE] text-[#238B45] flex items-center justify-center mb-5">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="font-bold text-lg text-[#163326] mb-2">Bahan Baku Pilihan</h3>
                <p class="text-sm text-[#6B7280] leading-relaxed">
                    Menggunakan tepung terigu berkualitas tinggi untuk menghasilkan tekstur adonan yang kenyal, halus, dan gurih alami.
                </p>
            </div>

            <div class="p-6 rounded-2xl bg-[#F7FAF8] border border-[#E5E7EB] hover:border-[#238B45]/40 transition-colors">
                <div class="w-12 h-12 rounded-xl bg-[#EAF6EE] text-[#238B45] flex items-center justify-center mb-5">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                </div>
                <h3 class="font-bold text-lg text-[#163326] mb-2">Elastis & Tidak Mudah Sobek</h3>
                <p class="text-sm text-[#6B7280] leading-relaxed">
                    Sangat mudah dilipat dan dibentuk saat pembungkusan, menjaga isian tetap utuh sempurna selama proses memasak.
                </p>
            </div>

            <div class="p-6 rounded-2xl bg-[#F7FAF8] border border-[#E5E7EB] hover:border-[#238B45]/40 transition-colors">
                <div class="w-12 h-12 rounded-xl bg-[#EAF6EE] text-[#238B45] flex items-center justify-center mb-5">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <h3 class="font-bold text-lg text-[#163326] mb-2">Produksi Segar Setiap Hari</h3>
                <p class="text-sm text-[#6B7280] leading-relaxed">
                    Diproduksi secara harian dalam lingkungan higienis, menjamin kesegaran maksimal saat tiba di dapur usaha Anda.
                </p>
            </div>

            <div class="p-6 rounded-2xl bg-[#F7FAF8] border border-[#E5E7EB] hover:border-[#238B45]/40 transition-colors">
                <div class="w-12 h-12 rounded-xl bg-[#EAF6EE] text-[#238B45] flex items-center justify-center mb-5">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <h3 class="font-bold text-lg text-[#163326] mb-2">Skalabilitas Pasokan B2B</h3>
                <p class="text-sm text-[#6B7280] leading-relaxed">
                    Sistem pemesanan dan jadwal distribusi teratur yang siap mendampingi pertumbuhan skala bisnis katering dan restoran.
                </p>
            </div>

        </div>

    </div>
</section>

{{-- ================================================================= --}}
{{-- 5. KEMITRAAN & B2B CTA SECTION --}}
{{-- ================================================================= --}}
<section id="kemitraan" class="py-16 md:py-24 bg-[#163326] text-white relative overflow-hidden">
    {{-- Subtle backdrop glow --}}
    <div class="absolute top-0 right-0 w-96 h-96 bg-[#238B45]/20 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="max-w-3xl mx-auto text-center space-y-6">

            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 text-[#238B45] text-xs font-semibold backdrop-blur-sm">
                <span class="w-2 h-2 rounded-full bg-[#238B45]"></span>
                <span class="text-white">Peluang Kemitraan Bisnis</span>
            </div>

            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight leading-tight">
                Jadilah Mitra Distributor, Agen, atau Pasokan Rutin Restoran
            </h2>

            <p class="text-base sm:text-lg text-white/75 leading-relaxed">
                Dapatkan harga khusus pabrik (*factory direct price*), prioritas pasokan, dan dukungan berkelanjutan untuk memajukan usaha kuliner Anda.
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-4">
                @if (!empty($waNumber))
                    <a href="{{ $waOrderBase }}?text={{ $waPartnerMsg }}"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="w-full sm:w-auto inline-flex items-center justify-center gap-2 h-12 px-7 bg-[#238B45] hover:bg-[#1E7A3B] text-white text-sm font-semibold rounded-[10px] shadow-lg hover:shadow-xl transition-all duration-150">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                        </svg>
                        <span>Ajukan Kemitraan via WhatsApp</span>
                    </a>
                @endif

                <a href="#kontak"
                   class="w-full sm:w-auto inline-flex items-center justify-center gap-2 h-12 px-7 bg-white/10 hover:bg-white/20 text-white text-sm font-semibold rounded-[10px] transition-colors border border-white/20">
                    <span>Informasi Kontak Lengkap</span>
                </a>
            </div>

        </div>
    </div>
</section>

{{-- ================================================================= --}}
{{-- 6. BLOG & ARTIKEL TERBARU SECTION --}}
{{-- ================================================================= --}}
<section id="blog" class="py-16 md:py-24 bg-white border-b border-[#E5E7EB]/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Section Title --}}
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-12">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#EAF6EE] text-[#238B45] text-xs font-semibold mb-3">
                    <span>Edukasi & Kabar Terkini</span>
                </div>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-[#163326] tracking-tight">
                    Artikel & Resep Kuliner
                </h2>
                <p class="text-[#6B7280] text-sm sm:text-base mt-2 max-w-xl">
                    Kumpulan panduan memasak, tips mengolah kulit dimsum, serta kabar terbaru seputar industri kuliner.
                </p>
            </div>
            @if (!empty($waNumber))
                <a href="#kontak" class="text-sm font-semibold text-[#238B45] hover:text-[#1E7A3B] transition-colors flex items-center gap-1.5 flex-shrink-0">
                    <span>Punya Pertanyaan Resep?</span>
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            @endif
        </div>

        {{-- Blog Grid --}}
        @if ($latestBlogs->isEmpty())
            {{-- Graceful Empty State --}}
            <div class="bg-[#F7FAF8] rounded-2xl border border-[#E5E7EB] p-10 text-center max-w-md mx-auto">
                <div class="w-14 h-14 rounded-2xl bg-white text-[#238B45] flex items-center justify-center mx-auto mb-3 border border-[#E5E7EB]">
                    <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                    </svg>
                </div>
                <h3 class="text-[#163326] font-bold text-base mb-1">Artikel Segera Hadir</h3>
                <p class="text-[#6B7280] text-xs leading-relaxed">
                    Kami sedang menyiapkan artikel edukasi dan tips resep terbaik untuk Anda.
                </p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ($latestBlogs as $blog)
                    <x-public-blog-card :blog="$blog" />
                @endforeach
            </div>
            <div class="mt-10 text-center">
                <a href="{{ route('blog.index') }}"
                   class="inline-flex items-center gap-2 h-11 px-6 bg-[#F7FAF8] hover:bg-[#EAF6EE] text-[#238B45] hover:text-[#1E7A3B] border border-[#E5E7EB] hover:border-[#238B45] text-xs font-semibold rounded-[10px] transition-colors">
                    <span>Lihat Semua Artikel Blog</span>
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>
            </div>
        @endif

    </div>
</section>

{{-- ================================================================= --}}
{{-- 7. GALERI DOKUMENTASI / GALLERY PREVIEW SECTION --}}
{{-- ================================================================= --}}
<section id="galeri" class="py-16 md:py-24 bg-[#F7FAF8] border-b border-[#E5E7EB]/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Section Title --}}
        <div class="text-center max-w-2xl mx-auto mb-12">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#EAF6EE] text-[#238B45] text-xs font-semibold mb-3">
                <span>Dokumentasi Visual</span>
            </div>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-[#163326] tracking-tight">
                Galeri Produksi & Olahan Produk
            </h2>
            <p class="text-[#6B7280] text-sm sm:text-base mt-2">
                Cuplikan proses produksi higienis dan ragam kreasi olahan kulit dimsum, pangsit, dan samosa Aljamas.
            </p>
        </div>

        {{-- Gallery Grid --}}
        @if ($galleries->isEmpty())
            {{-- Graceful Empty State --}}
            <div class="bg-white rounded-2xl border border-[#E5E7EB] p-10 text-center max-w-md mx-auto">
                <div class="w-14 h-14 rounded-2xl bg-[#EAF6EE] text-[#238B45] flex items-center justify-center mx-auto mb-3">
                    <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="text-[#163326] font-bold text-base mb-1">Dokumentasi Foto Sedang Diproses</h3>
                <p class="text-[#6B7280] text-xs leading-relaxed">
                    Dokumentasi fasilitas dan kegiatan produksi terbaru akan segera diunggah.
                </p>
            </div>
        @else
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                @foreach ($galleries as $gallery)
                    <div class="group relative aspect-square rounded-2xl overflow-hidden bg-white border border-[#E5E7EB] shadow-sm hover:shadow-md transition-all duration-200">
                        @if ($gallery->image)
                            <img src="{{ Storage::disk('public')->url($gallery->image) }}"
                                 alt="{{ $gallery->title ?? 'Foto Galeri Aljamas' }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"
                                 loading="lazy">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-[#F7FAF8] text-[#6B7280]">
                                <svg class="w-8 h-8 text-[#238B45]/40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        @endif

                        @if ($gallery->title)
                            <div class="absolute inset-0 bg-gradient-to-t from-[#163326]/90 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-200 flex items-end p-3">
                                <p class="text-white text-xs font-semibold truncate">{{ $gallery->title }}</p>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif

    </div>
</section>

@endsection
