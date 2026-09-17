@extends('layouts.public')

@section('title', 'Galeri Dokumentasi & Aktivitas — ' . ($settings['company_name'] ?? 'Aljamas'))
@section('meta_description', 'Jelajahi dokumentasi produk, proses produksi, kegiatan, dan perjalanan ' . ($settings['company_name'] ?? 'Aljamas') . ' dalam menghadirkan solusi bahan baku kuliner berkualitas.')
@section('og_title', 'Galeri Dokumentasi & Aktivitas — ' . ($settings['company_name'] ?? 'Aljamas'))
@section('og_description', 'Kumpulan foto dokumentasi dapur produksi, higienitas, dan olahan bahan baku kulit dimsum, pangsit, dan samosa Aljamas.')
@section('og_image', asset('images/gallery/gallery-hero.jpg'))

@section('content')

@php
    $companyName = $settings['company_name'] ?? 'Aljamas';
    $waNumber = preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '');
    $waDefaultMsg = urlencode($settings['whatsapp_default_message'] ?? 'Halo Aljamas, saya ingin bertanya seputar produk dan kemitraan.');
    $waOrderBase = !empty($waNumber) ? "https://wa.me/{$waNumber}" : '#kontak';
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
            <span class="text-[#163326] font-semibold">Galeri</span>
        </nav>

        {{-- Split Hero: Content Left | Image Right --}}
        <div class="flex flex-col lg:flex-row lg:items-center lg:gap-12 xl:gap-16">

            {{-- LEFT: Text Content (52%) --}}
            <div class="flex-shrink-0 lg:w-[52%] space-y-5">
                {{-- Eyebrow Badge --}}
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-[#EAF6EE] text-[#238B45] text-xs font-semibold">
                    <span class="w-2 h-2 rounded-full bg-[#238B45]"></span>
                    <span>Dokumentasi Aljamas</span>
                </div>

                {{-- Heading --}}
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-[#163326] tracking-tight leading-tight">
                    Melihat Lebih Dekat Aktivitas Aljamas
                </h1>

                {{-- Description --}}
                <p class="text-base sm:text-lg text-[#6B7280] leading-relaxed max-w-xl">
                    Jelajahi dokumentasi produk, proses, aktivitas, dan perjalanan Aljamas dalam menghadirkan solusi bahan baku kuliner berkualitas.
                </p>

                {{-- Action Area --}}
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3.5 pt-2">
                    <a href="#koleksi-galeri"
                       class="inline-flex items-center justify-center gap-2 h-12 px-7 bg-[#238B45] hover:bg-[#1E7A3B] text-white font-semibold text-sm rounded-[10px] shadow-sm hover:shadow-md transition-all duration-150 focus:outline-none focus:ring-2 focus:ring-[#238B45] focus:ring-offset-2">
                        <span>Jelajahi Dokumentasi</span>
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </a>

                    @if (!empty($waNumber))
                        <a href="{{ $waOrderBase }}?text={{ $waDefaultMsg }}"
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

                {{-- Micro Feature Strip --}}
                <div class="pt-4 border-t border-[#E5E7EB] flex flex-wrap items-center gap-6 text-xs text-[#6B7280]">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#238B45]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span class="font-medium text-[#163326]">Fasilitas Produksi Higienis</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#238B45]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span class="font-medium text-[#163326]">Standar Mutu Terjaga</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#238B45]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span class="font-medium text-[#163326]">Kemitraan Terpercaya</span>
                    </div>
                </div>
            </div>

            {{-- RIGHT: Visual Showcase (48%) --}}
            <div class="mt-8 lg:mt-0 lg:flex-1 relative">
                {{-- Decorative subtle soft green blob --}}
                <div class="absolute -top-6 -right-6 w-64 h-64 rounded-full bg-[#EAF6EE] opacity-60 blur-3xl pointer-events-none" aria-hidden="true"></div>

                <div class="relative">
                    <img
                        src="{{ asset('images/gallery/gallery-hero.jpg') }}"
                        alt="Dokumentasi aktivitas produksi dan workshop kuliner Aljamas"
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
{{-- 2. MAIN GALLERY SECTION (Editorial Grid) --}}
{{-- ================================================================= --}}
<section id="koleksi-galeri" class="py-14 md:py-20 bg-white scroll-mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Empty State --}}
        @if ($galleries->isEmpty())
            <div class="bg-[#F7FAF8] rounded-3xl border border-[#E5E7EB] p-12 text-center max-w-lg mx-auto my-8">
                <div class="w-16 h-16 rounded-2xl bg-white text-[#238B45] border border-[#E5E7EB] flex items-center justify-center mx-auto mb-4 shadow-sm">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="text-[#163326] font-bold text-lg mb-1">
                    Dokumentasi Segera Hadir
                </h3>
                <p class="text-[#6B7280] text-sm leading-relaxed mb-6">
                    Dokumentasi aktivitas dan perjalanan Aljamas akan ditampilkan di halaman ini. Kunjungi kembali untuk melihat dokumentasi terbaru kami.
                </p>
                <div class="flex items-center justify-center gap-3">
                    <a href="{{ route('home') }}"
                       class="inline-flex items-center justify-center h-10 px-5 bg-white border border-[#E5E7EB] hover:border-[#238B45] text-[#163326] hover:text-[#238B45] text-xs font-semibold rounded-[10px] transition-colors">
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        @else

            {{-- Gallery Header & Meta Info --}}
            <div class="flex flex-col sm:flex-row sm:items-end justify-between border-b border-[#E5E7EB] pb-5 mb-8 sm:mb-10 gap-3">
                <div>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-[#163326] tracking-tight">
                        Koleksi Dokumentasi
                    </h2>
                    <p class="text-xs sm:text-sm text-[#6B7280] mt-1">
                        Klik pada foto untuk melihat tampilan penuh dokumentasi
                    </p>
                </div>
                <span class="text-xs text-[#6B7280] font-medium flex-shrink-0">
                    Menampilkan {{ $galleries->firstItem() }} – {{ $galleries->lastItem() }} dari {{ $galleries->total() }} dokumentasi
                </span>
            </div>

            {{-- Main Gallery Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                @foreach ($galleries as $gallery)
                    <x-public-gallery-item :gallery="$gallery" />
                @endforeach
            </div>

            {{-- Pagination Links --}}
            @if ($galleries->hasPages())
                <div class="pt-12 flex justify-center">
                    {{ $galleries->links() }}
                </div>
            @endif

        @endif

    </div>
</section>

{{-- ================================================================= --}}
{{-- 3. BOTTOM CONVERSION CTA BANNER --}}
{{-- ================================================================= --}}
<section class="py-12 bg-[#F7FAF8] border-t border-[#E5E7EB]/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-[#163326] text-white rounded-3xl p-8 sm:p-10 flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="space-y-2 max-w-xl text-center md:text-left">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 text-[#238B45] text-xs font-semibold">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#238B45]"></span>
                    <span class="text-white">Siap Bekerja Sama?</span>
                </div>
                <h3 class="text-xl sm:text-2xl font-bold tracking-tight text-white">
                    Bangun Kemitraan Bersama Aljamas
                </h3>
                <p class="text-sm text-white/75 leading-relaxed">
                    Hubungi tim Aljamas untuk mengetahui lebih lanjut tentang produk dan peluang kemitraan.
                </p>
            </div>
            @if (!empty($waNumber))
                <a href="{{ $waOrderBase }}?text={{ $waDefaultMsg }}"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="inline-flex items-center justify-center gap-2 h-12 px-6 bg-[#238B45] hover:bg-[#1E7A3B] text-white text-sm font-semibold rounded-[10px] transition-colors flex-shrink-0 shadow-md">
                    <span>Hubungi Kami via WhatsApp</span>
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>
            @endif
        </div>
    </div>
</section>

{{-- ================================================================= --}}
{{-- 4. LIGHTBOX MODAL (Vanilla JS, Accessible, Keyboard-Friendly) --}}
{{-- ================================================================= --}}
<div id="gallery-lightbox"
     class="fixed inset-0 z-50 bg-[#163326]/90 backdrop-blur-sm hidden items-center justify-center p-4 sm:p-6 opacity-0 transition-opacity duration-200"
     role="dialog"
     aria-modal="true"
     aria-label="Pratinjau Foto Galeri">

    {{-- Modal Content Card --}}
    <div class="relative bg-white rounded-3xl overflow-hidden max-w-4xl w-full shadow-2xl flex flex-col max-h-[90vh] scale-95 transition-transform duration-200" id="lightbox-container">

        {{-- Close Button Top-Right --}}
        <button type="button"
                id="lightbox-close-btn"
                aria-label="Tutup tampilan foto"
                class="absolute top-4 right-4 z-10 w-10 h-10 rounded-full bg-white/90 hover:bg-white text-[#163326] shadow-md flex items-center justify-center transition-colors focus:outline-none focus:ring-2 focus:ring-[#238B45]">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        {{-- Lightbox Image Box --}}
        <div class="bg-[#163326] flex items-center justify-center overflow-hidden min-h-[260px] max-h-[65vh]">
            <img id="lightbox-image"
                 src=""
                 alt=""
                 class="max-w-full max-h-[65vh] object-contain mx-auto">
        </div>

        {{-- Lightbox Caption / Metadata Box --}}
        <div class="p-6 bg-white border-t border-[#E5E7EB] space-y-1">
            <h3 id="lightbox-title" class="text-base sm:text-lg font-bold text-[#163326] leading-snug"></h3>
            <p id="lightbox-desc" class="text-xs sm:text-sm text-[#6B7280] leading-relaxed"></p>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const lightbox = document.getElementById('gallery-lightbox');
    const container = document.getElementById('lightbox-container');
    const lightboxImg = document.getElementById('lightbox-image');
    const lightboxTitle = document.getElementById('lightbox-title');
    const lightboxDesc = document.getElementById('lightbox-desc');
    const closeBtn = document.getElementById('lightbox-close-btn');
    const triggers = document.querySelectorAll('[data-lightbox-trigger]');
    let lastActiveElement = null;

    function openLightbox(trigger) {
        lastActiveElement = trigger;
        const imgSrc = trigger.getAttribute('data-image');
        const title = trigger.getAttribute('data-title') || '';
        const desc = trigger.getAttribute('data-description') || '';

        if (!imgSrc) return;

        lightboxImg.src = imgSrc;
        lightboxImg.alt = title;
        lightboxTitle.textContent = title;
        lightboxDesc.textContent = desc;

        lightbox.classList.remove('hidden');
        lightbox.classList.add('flex');

        // Trigger transition
        setTimeout(() => {
            lightbox.classList.remove('opacity-0');
            lightbox.classList.add('opacity-100');
            container.classList.remove('scale-95');
            container.classList.add('scale-100');
            closeBtn.focus();
        }, 10);

        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        lightbox.classList.remove('opacity-100');
        lightbox.classList.add('opacity-0');
        container.classList.remove('scale-100');
        container.classList.add('scale-95');

        setTimeout(() => {
            lightbox.classList.remove('flex');
            lightbox.classList.add('hidden');
            lightboxImg.src = '';
            document.body.style.overflow = '';
            if (lastActiveElement) {
                lastActiveElement.focus();
            }
        }, 200);
    }

    // Attach click and Enter/Space handlers to cards
    triggers.forEach(function (trigger) {
        trigger.addEventListener('click', function () {
            openLightbox(trigger);
        });

        trigger.addEventListener('keydown', function (e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                openLightbox(trigger);
            }
        });
    });

    // Close button
    if (closeBtn) {
        closeBtn.addEventListener('click', function (e) {
            e.stopPropagation();
            closeLightbox();
        });
    }

    // Backdrop click
    if (lightbox) {
        lightbox.addEventListener('click', function (e) {
            if (e.target === lightbox) {
                closeLightbox();
            }
        });
    }

    // Escape key
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && !lightbox.classList.contains('hidden')) {
            closeLightbox();
        }
    });
});
</script>
@endpush
