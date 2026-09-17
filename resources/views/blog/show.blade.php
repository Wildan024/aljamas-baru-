@extends('layouts.public')

@section('title', $blog->title . ' — ' . ($settings['company_name'] ?? 'Aljamas'))
@section('meta_description', $blog->excerpt ?: Str::limit(strip_tags($blog->content), 160))
@section('og_title', $blog->title . ' — ' . ($settings['company_name'] ?? 'Aljamas'))
@section('og_description', $blog->excerpt ?: Str::limit(strip_tags($blog->content), 160))
@if (!empty($blog->image))
    @section('og_image', Storage::disk('public')->url($blog->image))
@endif

@section('content')

@php
    $companyName = $settings['company_name'] ?? 'Aljamas';
    $waNumber = preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '');
    $articleShareMsg = urlencode("Halo Aljamas, saya membaca artikel '{$blog->title}' dan ingin bertanya lebih lanjut seputar produk.");
    $waContactUrl = !empty($waNumber) ? "https://wa.me/{$waNumber}?text={$articleShareMsg}" : '#kontak';
@endphp

{{-- ================================================================= --}}
{{-- 1. BREADCRUMB NAVIGATION --}}
{{-- ================================================================= --}}
<div class="bg-[#F7FAF8] border-b border-[#E5E7EB]/60 py-4">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-xs sm:text-sm text-[#6B7280] overflow-x-auto whitespace-nowrap" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-[#238B45] transition-colors">Beranda</a>
            <svg class="w-3.5 h-3.5 text-[#6B7280]/60 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
            </svg>
            <a href="{{ route('blog.index') }}" class="hover:text-[#238B45] transition-colors">Blog</a>
            <svg class="w-3.5 h-3.5 text-[#6B7280]/60 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-[#163326] font-semibold truncate max-w-xs sm:max-w-md">{{ $blog->title }}</span>
        </nav>
    </div>
</div>

{{-- ================================================================= --}}
{{-- 2. ARTICLE HEADER & HERO --}}
{{-- ================================================================= --}}
<article class="bg-white">

    <header class="pt-10 pb-8 md:pt-14 md:pb-10">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4">

            {{-- Category Pill --}}
            @if ($blog->category)
                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-[#EAF6EE] text-[#238B45] text-xs font-semibold border border-[#238B45]/20">
                    <span>{{ $blog->category->name }}</span>
                </div>
            @endif

            {{-- Main Title --}}
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-[#163326] tracking-tight leading-tight">
                {{ $blog->title }}
            </h1>

            {{-- Meta Row: Date & Editorial --}}
            <div class="flex items-center justify-center gap-3 text-xs sm:text-sm text-[#6B7280] pt-2">
                <div class="flex items-center gap-1.5 font-medium">
                    <svg class="w-4 h-4 text-[#238B45]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span>{{ $blog->published_at ? $blog->published_at->format('d F Y') : $blog->created_at->format('d F Y') }}</span>
                </div>
                <span>•</span>
                <span class="font-medium text-[#163326]">Tim Editorial {{ $companyName }}</span>
            </div>

            {{-- Excerpt Subhead (if available) --}}
            @if ($blog->excerpt)
                <p class="text-base sm:text-lg text-[#6B7280] leading-relaxed max-w-2xl mx-auto pt-2 font-normal">
                    {{ $blog->excerpt }}
                </p>
            @endif

        </div>
    </header>

    {{-- 3. MAIN THUMBNAIL IMAGE --}}
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 mb-10 md:mb-14">
        <div class="relative bg-[#F7FAF8] rounded-3xl border border-[#E5E7EB] overflow-hidden shadow-md aspect-[16/10] sm:aspect-[16/9] lg:aspect-[21/10]">
            @if (!empty($blog->image))
                <img src="{{ Storage::disk('public')->url($blog->image) }}"
                     alt="{{ $blog->title }}"
                     class="w-full h-full object-cover"
                     loading="eager">
            @else
                <div class="w-full h-full flex flex-col items-center justify-center text-[#6B7280] bg-gradient-to-br from-[#F7FAF8] to-[#EAF6EE]/60 p-8 text-center">
                    <div class="w-16 h-16 rounded-2xl bg-white text-[#238B45] border border-[#E5E7EB] flex items-center justify-center mb-3 shadow-sm">
                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                    </div>
                    <span class="text-base font-bold text-[#163326]">{{ $companyName }} Insight</span>
                    <span class="text-xs text-[#6B7280] mt-1">Artikel Edukasi &amp; Bahan Baku Kuliner</span>
                </div>
            @endif
        </div>
    </div>

    {{-- 4. ARTICLE BODY CONTENT --}}
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 pb-14 md:pb-20">
        <div class="prose prose-green max-w-none text-[#374151] text-base sm:text-lg leading-relaxed space-y-6">
            {{-- Safe render with linebreaks preserving plain-text formatting from textarea --}}
            <div class="whitespace-pre-line text-[#374151] leading-relaxed">
                {{ $blog->content }}
            </div>
        </div>

        {{-- Author & Share Card --}}
        <div class="mt-12 pt-8 border-t border-[#E5E7EB] flex flex-col sm:flex-row items-center justify-between gap-4 bg-[#F7FAF8] p-6 rounded-2xl border">
            <div class="flex items-center gap-3.5">
                <div class="w-11 h-11 rounded-xl bg-[#238B45] text-white flex items-center justify-center font-bold text-base shadow-sm">
                    A
                </div>
                <div>
                    <h4 class="text-sm font-bold text-[#163326]">{{ $companyName }}</h4>
                    <p class="text-xs text-[#6B7280]">Produsen Kulit Dimsum &amp; Bahan Baku Kuliner</p>
                </div>
            </div>

            @if (!empty($waNumber))
                <a href="{{ $waContactUrl }}"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="inline-flex items-center gap-2 h-10 px-4 bg-[#238B45] hover:bg-[#1E7A3B] text-white text-xs font-semibold rounded-[10px] shadow-sm transition-colors flex-shrink-0">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                    </svg>
                    <span>Konsultasi Produk</span>
                </a>
            @endif
        </div>
    </div>

</article>

{{-- ================================================================= --}}
{{-- 5. RELATED ARTICLES SECTION --}}
{{-- ================================================================= --}}
@if ($relatedBlogs->isNotEmpty())
    <section class="py-16 bg-[#F7FAF8] border-t border-[#E5E7EB]/60">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Section Header --}}
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-10">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#EAF6EE] text-[#238B45] text-xs font-semibold mb-2">
                        <span>Rekomendasi Bacaan</span>
                    </div>
                    <h3 class="text-2xl sm:text-3xl font-extrabold text-[#163326] tracking-tight">
                        Artikel Lainnya
                    </h3>
                </div>
                <a href="{{ route('blog.index') }}"
                   class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-semibold text-[#238B45] hover:text-[#1E7A3B] transition-colors flex-shrink-0">
                    <span>Lihat Semua Artikel</span>
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>

            {{-- Grid of up to 3 cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                @foreach ($relatedBlogs as $related)
                    <x-public-blog-card :blog="$related" />
                @endforeach
            </div>

        </div>
    </section>
@endif

{{-- ================================================================= --}}
{{-- 6. BOTTOM CONVERSION CTA BANNER --}}
{{-- ================================================================= --}}
<section class="py-12 bg-white border-t border-[#E5E7EB]/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-[#163326] text-white rounded-3xl p-8 sm:p-10 flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="space-y-2 max-w-xl text-center md:text-left">
                <h3 class="text-xl sm:text-2xl font-bold tracking-tight text-white">
                    Siap Memenuhi Kebutuhan Kuliner Anda?
                </h3>
                <p class="text-sm text-white/75 leading-relaxed">
                    Hubungi tim Aljamas untuk informasi produk, penawaran harga grosir, dan sampel kulit adonan berkualitas untuk usaha Anda.
                </p>
            </div>
            @if (!empty($waNumber))
                <a href="{{ $waContactUrl }}"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="inline-flex items-center justify-center gap-2 h-12 px-6 bg-[#238B45] hover:bg-[#1E7A3B] text-white text-sm font-semibold rounded-[10px] transition-colors flex-shrink-0 shadow-md">
                    <span>Hubungi Kami</span>
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>
            @endif
        </div>
    </div>
</section>

@endsection
