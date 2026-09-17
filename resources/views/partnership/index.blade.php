@extends('layouts.public')

@section('title', 'Kemitraan — ' . ($settings['company_name'] ?? 'Aljamas') . ' — Tumbuh Bersama dalam Bisnis Kuliner')
@section('meta_description', 'Temukan peluang kemitraan pasokan bahan baku kulit dimsum, kulit pangsit, kulit samosa, dan mie segar bersama ' . ($settings['company_name'] ?? 'Aljamas') . ' untuk mengembangkan usaha kuliner Anda.')
@section('og_title', 'Kemitraan — ' . ($settings['company_name'] ?? 'Aljamas') . ' — Tumbuh Bersama dalam Bisnis Kuliner')
@section('og_description', 'Jadilah bagian dari jaringan kemitraan Aljamas dan kembangkan peluang bisnis kuliner bersama produk serta dukungan terpercaya.')

@section('content')

@php
    $companyName = $settings['company_name'] ?? 'Aljamas';
    $companyEmail = $settings['company_email'] ?? 'info@aljamas.com';
    $companyPhone = $settings['company_phone'] ?? '';
    $companyAddress = $settings['company_address'] ?? '';
    $waNumber = preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '');
    $waPartnerMsg = urlencode('Halo Aljamas, saya tertarik untuk mengajukan kemitraan / pasokan rutin bahan baku.');
    $waPartnerUrl = !empty($waNumber) ? "https://wa.me/{$waNumber}?text={$waPartnerMsg}" : '#kontak';
@endphp

{{-- ================================================================= --}}
{{-- 1. HERO SECTION (Split 2-Column Editorial Layout) --}}
{{-- ================================================================= --}}
<section class="bg-gradient-to-b from-[#F7FAF8] to-white pt-10 pb-12 md:pt-14 md:pb-16 border-b border-[#E5E7EB]/60 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-xs text-[#6B7280] mb-6" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-[#238B45] transition-colors">Beranda</a>
            <svg class="w-3.5 h-3.5 text-[#6B7280]/60" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-[#163326] font-semibold">Kemitraan</span>
        </nav>

        {{-- Split Hero: Content Left | Image Right --}}
        <div class="flex flex-col lg:flex-row lg:items-center lg:gap-12 xl:gap-16">

            {{-- LEFT: Text Content (52%) --}}
            <div class="flex-shrink-0 lg:w-[52%] space-y-5">
                {{-- Eyebrow Badge --}}
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-[#EAF6EE] text-[#238B45] text-xs font-semibold">
                    <span class="w-2 h-2 rounded-full bg-[#238B45]"></span>
                    <span>Partnership Aljamas</span>
                </div>

                {{-- Heading --}}
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-[#163326] tracking-tight leading-tight">
                    Bangun Peluang Bisnis Bersama Aljamas
                </h1>

                {{-- Description --}}
                <p class="text-base sm:text-lg text-[#6B7280] leading-relaxed max-w-xl">
                    Jadilah bagian dari jaringan kemitraan Aljamas dan kembangkan peluang bisnis kuliner bersama produk serta dukungan yang terpercaya.
                </p>

                {{-- Hero Action Buttons --}}
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3.5 pt-2">
                    <a href="#form-kemitraan"
                       class="inline-flex items-center justify-center gap-2 h-12 px-7 bg-[#238B45] hover:bg-[#1E7A3B] text-white font-semibold text-sm rounded-[10px] shadow-sm hover:shadow-md transition-all duration-150 focus:outline-none focus:ring-2 focus:ring-[#238B45] focus:ring-offset-2">
                        <span>Mulai Kemitraan</span>
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </a>

                    @if (!empty($waNumber))
                        <a href="{{ $waPartnerUrl }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="inline-flex items-center justify-center gap-2 h-12 px-6 border border-[#E5E7EB] hover:border-[#238B45] bg-white text-[#163326] hover:text-[#238B45] font-semibold text-sm rounded-[10px] shadow-sm hover:shadow transition-all duration-150">
                            <span>Hubungi Kami</span>
                            <svg class="w-4 h-4 text-[#238B45]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </a>
                    @endif
                </div>

                {{-- Micro Trust Indicators --}}
                <div class="pt-4 border-t border-[#E5E7EB] flex flex-wrap items-center gap-6 text-xs text-[#6B7280]">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#238B45]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span class="font-medium text-[#163326]">Harga Pabrik Kompetitif</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#238B45]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span class="font-medium text-[#163326]">Pasokan Segar Rutin</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#238B45]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span class="font-medium text-[#163326]">Dukungan Uji Sampel</span>
                    </div>
                </div>
            </div>

            {{-- RIGHT: Culinary B2B Hero Photo (48%) --}}
            <div class="mt-8 lg:mt-0 lg:flex-1 relative">
                {{-- Decorative soft green blob --}}
                <div class="absolute -top-6 -right-6 w-64 h-64 rounded-full bg-[#EAF6EE] opacity-60 blur-3xl pointer-events-none" aria-hidden="true"></div>

                <div class="relative">
                    <img
                        src="{{ asset('images/kemitraan/kemitraan-hero.jpg') }}"
                        alt="Fasilitas dan produk bahan baku kemitraan kuliner Aljamas"
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
{{-- 2. WHY PARTNER SECTION --}}
{{-- ================================================================= --}}
<section class="py-16 md:py-24 bg-white border-b border-[#E5E7EB]/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Section Header --}}
        <div class="text-center max-w-3xl mx-auto mb-14">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#EAF6EE] text-[#238B45] text-xs font-semibold mb-3">
                <span>Nilai Kemitraan</span>
            </div>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-[#163326] tracking-tight">
                Kenapa Bermitra dengan Aljamas?
            </h2>
            <p class="text-[#6B7280] text-base sm:text-lg mt-3 leading-relaxed">
                Kami berkomitmen menyediakan fondasi bahan baku terbaik agar bisnis kuliner Anda dapat fokus berkreasi dan melayani pelanggan dengan percaya diri.
            </p>
        </div>

        {{-- 4 Benefit Cards Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">

            {{-- Benefit 1 --}}
            <div class="bg-[#F7FAF8] rounded-2xl border border-[#E5E7EB] p-7 flex flex-col justify-between hover:-translate-y-1 hover:shadow-lg hover:border-[#238B45]/40 transition-all duration-200">
                <div class="space-y-4">
                    <div class="w-12 h-12 rounded-xl bg-white text-[#238B45] border border-[#E5E7EB] flex items-center justify-center shadow-sm">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-[#163326]">Produk Berkualitas</h3>
                    <p class="text-sm text-[#6B7280] leading-relaxed">
                        Produk bahan kuliner yang dipilih dan diproses secara higienis untuk mendukung konsistensi cita rasa usaha Anda.
                    </p>
                </div>
            </div>

            {{-- Benefit 2 --}}
            <div class="bg-[#F7FAF8] rounded-2xl border border-[#E5E7EB] p-7 flex flex-col justify-between hover:-translate-y-1 hover:shadow-lg hover:border-[#238B45]/40 transition-all duration-200">
                <div class="space-y-4">
                    <div class="w-12 h-12 rounded-xl bg-white text-[#238B45] border border-[#E5E7EB] flex items-center justify-center shadow-sm">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-[#163326]">Dukungan Kemitraan</h3>
                    <p class="text-sm text-[#6B7280] leading-relaxed">
                        Dukungan komunikasi cepat, jadwal pasokan teratur, dan informasi produk untuk membantu mitra berkembang.
                    </p>
                </div>
            </div>

            {{-- Benefit 3 --}}
            <div class="bg-[#F7FAF8] rounded-2xl border border-[#E5E7EB] p-7 flex flex-col justify-between hover:-translate-y-1 hover:shadow-lg hover:border-[#238B45]/40 transition-all duration-200">
                <div class="space-y-4">
                    <div class="w-12 h-12 rounded-xl bg-white text-[#238B45] border border-[#E5E7EB] flex items-center justify-center shadow-sm">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-[#163326]">Peluang Pasar Luas</h3>
                    <p class="text-sm text-[#6B7280] leading-relaxed">
                        Peluang mengembangkan bisnis kuliner dengan produk adonan segar siap pakai yang diminati pasar kuliner modern.
                    </p>
                </div>
            </div>

            {{-- Benefit 4 --}}
            <div class="bg-[#F7FAF8] rounded-2xl border border-[#E5E7EB] p-7 flex flex-col justify-between hover:-translate-y-1 hover:shadow-lg hover:border-[#238B45]/40 transition-all duration-200">
                <div class="space-y-4">
                    <div class="w-12 h-12 rounded-xl bg-white text-[#238B45] border border-[#E5E7EB] flex items-center justify-center shadow-sm">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-[#163326]">Mitra yang Terpercaya</h3>
                    <p class="text-sm text-[#6B7280] leading-relaxed">
                        Membangun hubungan bisnis jangka panjang dengan pendekatan profesional, transparan, dan harga tangan pertama.
                    </p>
                </div>
            </div>

        </div>

    </div>
</section>

{{-- ================================================================= --}}
{{-- 3. TARGET PARTNER SECTION --}}
{{-- ================================================================= --}}
<section class="py-16 md:py-24 bg-[#F7FAF8] border-b border-[#E5E7EB]/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Section Header --}}
        <div class="text-center max-w-3xl mx-auto mb-14">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#EAF6EE] text-[#238B45] text-xs font-semibold mb-3">
                <span>Profil Kemitraan</span>
            </div>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-[#163326] tracking-tight">
                Siapa yang Cocok Menjadi Mitra?
            </h2>
            <p class="text-[#6B7280] text-base sm:text-lg mt-3 leading-relaxed">
                Skema kemitraan Aljamas dirancang fleksibel untuk berbagai skala usaha kuliner di seluruh wilayah.
            </p>
        </div>

        {{-- 6 Target Cards Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">

            {{-- 1 --}}
            <div class="bg-white rounded-2xl border border-[#E5E7EB] p-6 space-y-3 shadow-sm hover:border-[#238B45]/40 transition-colors">
                <div class="w-10 h-10 rounded-xl bg-[#EAF6EE] text-[#238B45] flex items-center justify-center font-bold text-sm">
                    01
                </div>
                <h3 class="text-lg font-bold text-[#163326]">Distributor &amp; Agen Pangan</h3>
                <p class="text-sm text-[#6B7280] leading-relaxed">
                    Pelaku distribusi bahan makanan yang ingin memperluas lini produk kulit olahan dengan pasokan stabil dan harga grosir.
                </p>
            </div>

            {{-- 2 --}}
            <div class="bg-white rounded-2xl border border-[#E5E7EB] p-6 space-y-3 shadow-sm hover:border-[#238B45]/40 transition-colors">
                <div class="w-10 h-10 rounded-xl bg-[#EAF6EE] text-[#238B45] flex items-center justify-center font-bold text-sm">
                    02
                </div>
                <h3 class="text-lg font-bold text-[#163326]">Restoran &amp; Jasa Katering</h3>
                <p class="text-sm text-[#6B7280] leading-relaxed">
                    Pengelola dapur profesional yang memerlukan bahan baku kulit dimsum dan pangsit segar dengan jadwal pengiriman teratur.
                </p>
            </div>

            {{-- 3 --}}
            <div class="bg-white rounded-2xl border border-[#E5E7EB] p-6 space-y-3 shadow-sm hover:border-[#238B45]/40 transition-colors">
                <div class="w-10 h-10 rounded-xl bg-[#EAF6EE] text-[#238B45] flex items-center justify-center font-bold text-sm">
                    03
                </div>
                <h3 class="text-lg font-bold text-[#163326]">Produsen Frozen Food</h3>
                <p class="text-sm text-[#6B7280] leading-relaxed">
                    Produsen dimsum beku, siomay, samosa, atau pastel yang membutuhkan lembaran kulit kuat dan tidak mudah robek saat proses packing beku.
                </p>
            </div>

            {{-- 4 --}}
            <div class="bg-white rounded-2xl border border-[#E5E7EB] p-6 space-y-3 shadow-sm hover:border-[#238B45]/40 transition-colors">
                <div class="w-10 h-10 rounded-xl bg-[#EAF6EE] text-[#238B45] flex items-center justify-center font-bold text-sm">
                    04
                </div>
                <h3 class="text-lg font-bold text-[#163326]">Toko Bahan Kue &amp; Frozen Mart</h3>
                <p class="text-sm text-[#6B7280] leading-relaxed">
                    Toko ritel bahan pangan yang ingin melengkapi etalase dengan produk kulit adonan bermutu tinggi yang disukai pelanggan rumahan.
                </p>
            </div>

            {{-- 5 --}}
            <div class="bg-white rounded-2xl border border-[#E5E7EB] p-6 space-y-3 shadow-sm hover:border-[#238B45]/40 transition-colors">
                <div class="w-10 h-10 rounded-xl bg-[#EAF6EE] text-[#238B45] flex items-center justify-center font-bold text-sm">
                    05
                </div>
                <h3 class="text-lg font-bold text-[#163326]">Pelaku UMKM Kuliner</h3>
                <p class="text-sm text-[#6B7280] leading-relaxed">
                    Wirausahawan kuliner yang baru merintis atau sedang scale-up usaha gorengan, batagor, samosa, dan dimsum dengan modal terjangkau.
                </p>
            </div>

            {{-- 6 --}}
            <div class="bg-white rounded-2xl border border-[#E5E7EB] p-6 space-y-3 shadow-sm hover:border-[#238B45]/40 transition-colors">
                <div class="w-10 h-10 rounded-xl bg-[#EAF6EE] text-[#238B45] flex items-center justify-center font-bold text-sm">
                    06
                </div>
                <h3 class="text-lg font-bold text-[#163326]">Pengelola Waralaba / Franchise</h3>
                <p class="text-sm text-[#6B7280] leading-relaxed">
                    Pemilik brand kuliner yang membutuhkan standardisasi bahan baku adonan kulit untuk seluruh cabang gerai mereka.
                </p>
            </div>

        </div>

    </div>
</section>

{{-- ================================================================= --}}
{{-- 4. PARTNERSHIP PROCESS SECTION --}}
{{-- ================================================================= --}}
<section class="py-16 md:py-24 bg-white border-b border-[#E5E7EB]/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Section Header --}}
        <div class="text-center max-w-3xl mx-auto mb-14">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#EAF6EE] text-[#238B45] text-xs font-semibold mb-3">
                <span>Alur Kerja Sama</span>
            </div>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-[#163326] tracking-tight">
                Langkah Mudah Menjadi Mitra
            </h2>
            <p class="text-[#6B7280] text-base sm:text-lg mt-3 leading-relaxed">
                Empat langkah sederhana dari pengajuan awal hingga pasokan rutin berjalan lancar.
            </p>
        </div>

        {{-- 4 Steps Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 relative">

            {{-- Step 1 --}}
            <div class="bg-[#F7FAF8] rounded-2xl border border-[#E5E7EB] p-6 space-y-4 relative">
                <div class="flex items-center justify-between">
                    <span class="text-3xl font-extrabold text-[#238B45]">01</span>
                    <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-white text-[#6B7280] border border-[#E5E7EB]">Langkah 1</span>
                </div>
                <h3 class="text-base font-bold text-[#163326]">Kirim Ketertarikan</h3>
                <p class="text-xs sm:text-sm text-[#6B7280] leading-relaxed">
                    Isi formulir pengajuan kemitraan di bawah ini atau hubungi tim kami langsung melalui WhatsApp.
                </p>
            </div>

            {{-- Step 2 --}}
            <div class="bg-[#F7FAF8] rounded-2xl border border-[#E5E7EB] p-6 space-y-4 relative">
                <div class="flex items-center justify-between">
                    <span class="text-3xl font-extrabold text-[#238B45]">02</span>
                    <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-white text-[#6B7280] border border-[#E5E7EB]">Langkah 2</span>
                </div>
                <h3 class="text-base font-bold text-[#163326]">Diskusikan Kebutuhan</h3>
                <p class="text-xs sm:text-sm text-[#6B7280] leading-relaxed">
                    Tim Aljamas akan menghubungi Anda untuk mendiskusikan perkiraan volume, jadwal, dan varian produk yang dibutuhkan.
                </p>
            </div>

            {{-- Step 3 --}}
            <div class="bg-[#F7FAF8] rounded-2xl border border-[#E5E7EB] p-6 space-y-4 relative">
                <div class="flex items-center justify-between">
                    <span class="text-3xl font-extrabold text-[#238B45]">03</span>
                    <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-white text-[#6B7280] border border-[#E5E7EB]">Langkah 3</span>
                </div>
                <h3 class="text-base font-bold text-[#163326]">Uji Sampel &amp; Penawaran</h3>
                <p class="text-xs sm:text-sm text-[#6B7280] leading-relaxed">
                    Dapatkan sampel produk untuk diuji di dapur usaha Anda beserta proposal penawaran harga khusus kemitraan.
                </p>
            </div>

            {{-- Step 4 --}}
            <div class="bg-[#F7FAF8] rounded-2xl border border-[#E5E7EB] p-6 space-y-4 relative">
                <div class="flex items-center justify-between">
                    <span class="text-3xl font-extrabold text-[#238B45]">04</span>
                    <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-white text-[#6B7280] border border-[#E5E7EB]">Langkah 4</span>
                </div>
                <h3 class="text-base font-bold text-[#163326]">Mulai Berkembang Bersama</h3>
                <p class="text-xs sm:text-sm text-[#6B7280] leading-relaxed">
                    Pasokan rutin berjalan sesuai jadwal dengan jaminan mutu dan dukungan berkesinambungan.
                </p>
            </div>

        </div>

    </div>
</section>

{{-- ================================================================= --}}
{{-- 5. PARTNERSHIP FORM SECTION --}}
{{-- ================================================================= --}}
<section id="form-kemitraan" class="py-16 md:py-24 bg-[#F7FAF8] scroll-mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-14 items-start">

            {{-- Left Column (5 cols): Partnership Information & Direct Contact --}}
            <div class="lg:col-span-5 space-y-6">
                <div class="space-y-3">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#EAF6EE] text-[#238B45] text-xs font-semibold">
                        <span>Formulir Resmi</span>
                    </div>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-[#163326] tracking-tight">
                        Ajukan Kemitraan Sekarang
                    </h2>
                    <p class="text-sm sm:text-base text-[#6B7280] leading-relaxed">
                        Lengkapi formulir di samping untuk mendapatkan informasi kemitraan, penawaran harga khusus pabrik, serta sampel produk untuk usaha Anda.
                    </p>
                </div>

                {{-- Direct WhatsApp Contact Box --}}
                <div class="bg-white rounded-2xl border border-[#E5E7EB] p-6 space-y-4 shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-[#25D366]/15 text-[#25D366] flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-[#163326]">Lebih Suka Diskusi Langsung?</h4>
                            <p class="text-xs text-[#6B7280]">Konsultasi cepat via WhatsApp dengan tim kami</p>
                        </div>
                    </div>

                    @if (!empty($waNumber))
                        <a href="{{ $waPartnerUrl }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="w-full inline-flex items-center justify-center gap-2 h-11 px-5 bg-[#25D366] hover:bg-[#1EBE5D] text-white text-xs font-semibold rounded-[10px] shadow-sm transition-colors">
                            <span>Chat via WhatsApp</span>
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                <path d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </a>
                    @endif
                </div>

                {{-- Company Contact Details --}}
                <div class="space-y-3 pt-2 text-xs text-[#6B7280]">
                    @if (!empty($companyEmail))
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-white border border-[#E5E7EB] flex items-center justify-center text-[#238B45] flex-shrink-0">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <span>Email: <strong class="text-[#163326] font-semibold">{{ $companyEmail }}</strong></span>
                        </div>
                    @endif

                    @if (!empty($companyPhone))
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-white border border-[#E5E7EB] flex items-center justify-center text-[#238B45] flex-shrink-0">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <span>Telepon: <strong class="text-[#163326] font-semibold">{{ $companyPhone }}</strong></span>
                        </div>
                    @endif

                    @if (!empty($companyAddress))
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-white border border-[#E5E7EB] flex items-center justify-center text-[#238B45] flex-shrink-0">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <span>Alamat: <span class="text-[#163326]">{{ $companyAddress }}</span></span>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Right Column (7 cols): The Partnership Form --}}
            <div class="lg:col-span-7">
                <div class="bg-white rounded-3xl border border-[#E5E7EB] p-8 sm:p-10 shadow-sm">

                    {{-- Success Flash Alert --}}
                    @if (session('success'))
                        <div class="mb-6 p-4 rounded-2xl bg-[#EAF6EE] border border-[#238B45]/30 flex items-start gap-3 text-[#163326]">
                            <svg class="w-5 h-5 text-[#238B45] flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <div>
                                <h4 class="text-sm font-bold text-[#163326]">Pengajuan Terkirim!</h4>
                                <p class="text-xs sm:text-sm text-[#163326]/90 mt-0.5 leading-relaxed">
                                    {{ session('success') }}
                                </p>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('partnership.store') }}" method="POST" class="space-y-5" novalidate>
                        @csrf

                        {{-- Name & Email Row --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            {{-- Name --}}
                            <div>
                                <label for="name" class="block text-xs sm:text-sm font-semibold text-[#1F2937] mb-1.5">
                                    Nama Lengkap <span class="text-[#E11D48]">*</span>
                                </label>
                                <input
                                    type="text"
                                    name="name"
                                    id="name"
                                    value="{{ old('name') }}"
                                    required
                                    maxlength="150"
                                    placeholder="Contoh: Budi Santoso"
                                    class="w-full h-11 px-4 border rounded-[10px] text-[#1F2937] text-sm placeholder-[#9CA3AF]
                                           focus:outline-none focus:ring-2 focus:ring-[#238B45] focus:border-[#238B45] transition-colors
                                           {{ $errors->has('name') ? 'border-[#E11D48] ring-1 ring-[#E11D48]' : 'border-[#E5E7EB]' }}"
                                >
                                @error('name')
                                    <p class="mt-1.5 text-xs text-[#E11D48]">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div>
                                <label for="email" class="block text-xs sm:text-sm font-semibold text-[#1F2937] mb-1.5">
                                    Alamat Email <span class="text-[#E11D48]">*</span>
                                </label>
                                <input
                                    type="email"
                                    name="email"
                                    id="email"
                                    value="{{ old('email') }}"
                                    required
                                    maxlength="150"
                                    placeholder="nama@email.com"
                                    class="w-full h-11 px-4 border rounded-[10px] text-[#1F2937] text-sm placeholder-[#9CA3AF]
                                           focus:outline-none focus:ring-2 focus:ring-[#238B45] focus:border-[#238B45] transition-colors
                                           {{ $errors->has('email') ? 'border-[#E11D48] ring-1 ring-[#E11D48]' : 'border-[#E5E7EB]' }}"
                                >
                                @error('email')
                                    <p class="mt-1.5 text-xs text-[#E11D48]">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Phone & Company Row --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            {{-- Phone --}}
                            <div>
                                <label for="phone" class="block text-xs sm:text-sm font-semibold text-[#1F2937] mb-1.5">
                                    Nomor Telepon / WA <span class="text-[#E11D48]">*</span>
                                </label>
                                <input
                                    type="tel"
                                    name="phone"
                                    id="phone"
                                    value="{{ old('phone') }}"
                                    required
                                    maxlength="50"
                                    placeholder="Contoh: 081234567890"
                                    class="w-full h-11 px-4 border rounded-[10px] text-[#1F2937] text-sm placeholder-[#9CA3AF]
                                           focus:outline-none focus:ring-2 focus:ring-[#238B45] focus:border-[#238B45] transition-colors
                                           {{ $errors->has('phone') ? 'border-[#E11D48] ring-1 ring-[#E11D48]' : 'border-[#E5E7EB]' }}"
                                >
                                @error('phone')
                                    <p class="mt-1.5 text-xs text-[#E11D48]">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Company --}}
                            <div>
                                <label for="company" class="block text-xs sm:text-sm font-semibold text-[#1F2937] mb-1.5">
                                    Nama Usaha / Perusahaan <span class="text-[#6B7280] font-normal">(opsional)</span>
                                </label>
                                <input
                                    type="text"
                                    name="company"
                                    id="company"
                                    value="{{ old('company') }}"
                                    maxlength="150"
                                    placeholder="Contoh: Dimsum Berkah Abadi"
                                    class="w-full h-11 px-4 border rounded-[10px] text-[#1F2937] text-sm placeholder-[#9CA3AF]
                                           focus:outline-none focus:ring-2 focus:ring-[#238B45] focus:border-[#238B45] transition-colors
                                           {{ $errors->has('company') ? 'border-[#E11D48] ring-1 ring-[#E11D48]' : 'border-[#E5E7EB]' }}"
                                >
                                @error('company')
                                    <p class="mt-1.5 text-xs text-[#E11D48]">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Location & Partnership Type Row --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            {{-- Location --}}
                            <div>
                                <label for="location" class="block text-xs sm:text-sm font-semibold text-[#1F2937] mb-1.5">
                                    Kota / Lokasi Usaha <span class="text-[#E11D48]">*</span>
                                </label>
                                <input
                                    type="text"
                                    name="location"
                                    id="location"
                                    value="{{ old('location') }}"
                                    required
                                    maxlength="255"
                                    placeholder="Contoh: Surabaya, Jawa Timur"
                                    class="w-full h-11 px-4 border rounded-[10px] text-[#1F2937] text-sm placeholder-[#9CA3AF]
                                           focus:outline-none focus:ring-2 focus:ring-[#238B45] focus:border-[#238B45] transition-colors
                                           {{ $errors->has('location') ? 'border-[#E11D48] ring-1 ring-[#E11D48]' : 'border-[#E5E7EB]' }}"
                                >
                                @error('location')
                                    <p class="mt-1.5 text-xs text-[#E11D48]">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Partnership Type --}}
                            <div>
                                <label for="partnership_type" class="block text-xs sm:text-sm font-semibold text-[#1F2937] mb-1.5">
                                    Bentuk Kemitraan <span class="text-[#E11D48]">*</span>
                                </label>
                                <select
                                    name="partnership_type"
                                    id="partnership_type"
                                    required
                                    class="w-full h-11 px-4 border rounded-[10px] text-[#1F2937] text-sm bg-white
                                           focus:outline-none focus:ring-2 focus:ring-[#238B45] focus:border-[#238B45] transition-colors
                                           {{ $errors->has('partnership_type') ? 'border-[#E11D48] ring-1 ring-[#E11D48]' : 'border-[#E5E7EB]' }}">
                                    <option value="">— Pilih Bentuk Kemitraan —</option>
                                    <option value="Distributor / Agen Pangan" {{ old('partnership_type') === 'Distributor / Agen Pangan' ? 'selected' : '' }}>
                                        Distributor / Agen Pangan
                                    </option>
                                    <option value="Restoran & Jasa Katering" {{ old('partnership_type') === 'Restoran & Jasa Katering' ? 'selected' : '' }}>
                                        Restoran &amp; Jasa Katering
                                    </option>
                                    <option value="Produsen Frozen Food" {{ old('partnership_type') === 'Produsen Frozen Food' ? 'selected' : '' }}>
                                        Produsen Frozen Food
                                    </option>
                                    <option value="Toko Bahan Kue & Ritel" {{ old('partnership_type') === 'Toko Bahan Kue & Ritel' ? 'selected' : '' }}>
                                        Toko Bahan Kue &amp; Ritel
                                    </option>
                                    <option value="UMKM Kuliner Mandiri" {{ old('partnership_type') === 'UMKM Kuliner Mandiri' ? 'selected' : '' }}>
                                        UMKM Kuliner Mandiri
                                    </option>
                                    <option value="Franchise / Waralaba" {{ old('partnership_type') === 'Franchise / Waralaba' ? 'selected' : '' }}>
                                        Franchise / Waralaba
                                    </option>
                                    <option value="Lainnya" {{ old('partnership_type') === 'Lainnya' ? 'selected' : '' }}>
                                        Lainnya
                                    </option>
                                </select>
                                @error('partnership_type')
                                    <p class="mt-1.5 text-xs text-[#E11D48]">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Message --}}
                        <div>
                            <label for="message" class="block text-xs sm:text-sm font-semibold text-[#1F2937] mb-1.5">
                                Pesan / Kebutuhan Kemitraan <span class="text-[#6B7280] font-normal">(opsional)</span>
                            </label>
                            <textarea
                                name="message"
                                id="message"
                                rows="4"
                                maxlength="2000"
                                placeholder="Jelaskan kebutuhan pasokan, perkiraan volume, atau pertanyaan yang ingin Anda sampaikan..."
                                class="w-full px-4 py-3 border rounded-[10px] text-[#1F2937] text-sm placeholder-[#9CA3AF] resize-y
                                       focus:outline-none focus:ring-2 focus:ring-[#238B45] focus:border-[#238B45] transition-colors
                                       {{ $errors->has('message') ? 'border-[#E11D48] ring-1 ring-[#E11D48]' : 'border-[#E5E7EB]' }}"
                            >{{ old('message') }}</textarea>
                            @error('message')
                                <p class="mt-1.5 text-xs text-[#E11D48]">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Submit Button --}}
                        <div class="pt-2">
                            <button
                                type="submit"
                                class="w-full h-12 bg-[#238B45] hover:bg-[#1E7A3B] text-white font-semibold text-sm rounded-[10px]
                                       shadow-sm hover:shadow-md transition-all duration-150 flex items-center justify-center gap-2 focus:outline-none focus:ring-2 focus:ring-[#238B45] focus:ring-offset-2">
                                <span>Kirim Pengajuan Kemitraan</span>
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                </svg>
                            </button>
                            <p class="text-[11px] text-[#6B7280] text-center mt-3">
                                Data Anda aman dan hanya digunakan oleh tim {{ $companyName }} untuk tindak lanjut kemitraan.
                            </p>
                        </div>

                    </form>

                </div>
            </div>

        </div>

    </div>
</section>

{{-- ================================================================= --}}
{{-- 6. BOTTOM CONVERSION CTA BANNER --}}
{{-- ================================================================= --}}
<section class="py-12 bg-white border-t border-[#E5E7EB]/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-[#163326] text-white rounded-3xl p-8 sm:p-10 flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="space-y-2 max-w-xl text-center md:text-left">
                <h3 class="text-xl sm:text-2xl font-bold tracking-tight text-white">
                    Siap Mengembangkan Bisnis Bersama Aljamas?
                </h3>
                <p class="text-sm text-white/75 leading-relaxed">
                    Hubungi tim kami untuk mendiskusikan peluang kemitraan yang sesuai dengan kebutuhan bisnis Anda.
                </p>
            </div>
            @if (!empty($waNumber))
                <a href="{{ $waPartnerUrl }}"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="inline-flex items-center justify-center gap-2 h-12 px-6 bg-[#238B45] hover:bg-[#1E7A3B] text-white text-sm font-semibold rounded-[10px] transition-colors flex-shrink-0 shadow-md">
                    <span>Mulai Percakapan via WhatsApp</span>
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>
            @endif
        </div>
    </div>
</section>

@endsection
