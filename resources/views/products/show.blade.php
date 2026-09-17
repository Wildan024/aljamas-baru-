@extends('layouts.public')

@section('title', $product->name . ' — ' . ($settings['company_name'] ?? 'Aljamas'))
@section('meta_description', $product->short_description ?: ($product->name . ' produksi Aljamas. Bahan baku kulit dan adonan berkualitas untuk kebutuhan usaha kuliner Anda.'))
@section('og_title', $product->name . ' — ' . ($settings['company_name'] ?? 'Aljamas'))
@section('og_description', $product->short_description ?: 'Produk olahan adonan segar berstandar usaha kuliner.')
@if (!empty($product->image))
    @section('og_image', Storage::disk('public')->url($product->image))
@endif

@section('content')

@php
    $companyName = $settings['company_name'] ?? 'Aljamas';
    $waNumber = preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '');
    $orderMsg = urlencode("Halo Aljamas, saya ingin memesan / bertanya detail tentang produk: {$product->name}");
    $partnerMsg = urlencode("Halo Aljamas, saya tertarik untuk memesan pasokan rutin produk: {$product->name}");
    $waOrderUrl = !empty($waNumber) ? "https://wa.me/{$waNumber}?text={$orderMsg}" : '#kontak';
    $waPartnerUrl = !empty($waNumber) ? "https://wa.me/{$waNumber}?text={$partnerMsg}" : '#kontak';
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
            <a href="{{ route('products.index') }}" class="hover:text-[#238B45] transition-colors">Produk</a>
            <svg class="w-3.5 h-3.5 text-[#6B7280]/60 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-[#163326] font-semibold truncate max-w-xs sm:max-w-md">{{ $product->name }}</span>
        </nav>
    </div>
</div>

{{-- ================================================================= --}}
{{-- 2. MAIN PRODUCT DETAIL SECTION --}}
{{-- ================================================================= --}}
<section class="py-12 md:py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-start">

            {{-- Left Column (5 cols): Product Image Showcase --}}
            <div class="lg:col-span-5 space-y-4">
                <div class="relative bg-[#F7FAF8] rounded-3xl border border-[#E5E7EB] overflow-hidden shadow-lg shadow-[#163326]/5 aspect-[4/3] sm:aspect-square flex items-center justify-center group">
                    @if ($product->image)
                        <img src="{{ Storage::disk('public')->url($product->image) }}"
                             alt="{{ $product->name }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                             loading="eager">
                    @else
                        <div class="w-full h-full flex flex-col items-center justify-center text-[#6B7280] p-8 text-center">
                            <svg class="w-16 h-16 text-[#238B45]/30 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                            <span class="text-sm font-semibold text-[#163326]">{{ $product->name }}</span>
                            <span class="text-xs text-[#6B7280] mt-1">Produk Resmi Aljamas</span>
                        </div>
                    @endif

                    {{-- Category Badge --}}
                    @if ($product->category)
                        <div class="absolute top-4 left-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-white/95 text-[#238B45] shadow-sm backdrop-blur-sm border border-[#E5E7EB]/80">
                                {{ $product->category->name }}
                            </span>
                        </div>
                    @endif
                </div>

                {{-- Product Value Badges --}}
                <div class="grid grid-cols-2 gap-3 pt-1">
                    <div class="p-3.5 rounded-xl bg-[#F7FAF8] border border-[#E5E7EB] flex items-center gap-2.5">
                        <div class="w-7 h-7 rounded-lg bg-[#EAF6EE] text-[#238B45] flex items-center justify-center font-bold text-xs flex-shrink-0">
                            ✓
                        </div>
                        <span class="text-xs font-semibold text-[#163326]">Produksi Segar Harian</span>
                    </div>
                    <div class="p-3.5 rounded-xl bg-[#F7FAF8] border border-[#E5E7EB] flex items-center gap-2.5">
                        <div class="w-7 h-7 rounded-lg bg-[#EAF6EE] text-[#238B45] flex items-center justify-center font-bold text-xs flex-shrink-0">
                            ✓
                        </div>
                        <span class="text-xs font-semibold text-[#163326]">Standar Higienis Pangan</span>
                    </div>
                </div>
            </div>

            {{-- Right Column (7 cols): Product Information & CTAs --}}
            <div class="lg:col-span-7 space-y-6">

                {{-- Category & Name --}}
                <div class="space-y-2">
                    @if ($product->category)
                        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-[#EAF6EE] text-[#238B45] text-xs font-semibold">
                            <span>{{ $product->category->name }}</span>
                        </div>
                    @endif
                    <h1 class="text-3xl sm:text-4xl font-extrabold text-[#163326] tracking-tight leading-tight">
                        {{ $product->name }}
                    </h1>
                </div>

                {{-- Short Description --}}
                @if ($product->short_description)
                    <p class="text-base sm:text-lg text-[#6B7280] leading-relaxed">
                        {{ $product->short_description }}
                    </p>
                @endif

                {{-- Full Description --}}
                @if ($product->description)
                    <div class="p-6 rounded-2xl bg-[#F7FAF8] border border-[#E5E7EB] space-y-3">
                        <h2 class="text-sm font-bold text-[#163326] uppercase tracking-wider">
                            Deskripsi Produk Lengkap
                        </h2>
                        <div class="text-sm text-[#4B5563] leading-relaxed whitespace-pre-line">
                            {{ $product->description }}
                        </div>
                    </div>
                @endif

                {{-- Value Props List --}}
                <div class="space-y-2.5 pt-2">
                    <div class="flex items-center gap-3 text-sm text-[#163326] font-medium">
                        <svg class="w-5 h-5 text-[#238B45] flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span>Tekstur elastis, kenyal pas, dan tidak mudah sobek saat dimasak.</span>
                    </div>
                    <div class="flex items-center gap-3 text-sm text-[#163326] font-medium">
                        <svg class="w-5 h-5 text-[#238B45] flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span>Tanpa bahan pengawet berbahaya, aman dan higienis.</span>
                    </div>
                    <div class="flex items-center gap-3 text-sm text-[#163326] font-medium">
                        <svg class="w-5 h-5 text-[#238B45] flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span>Melayani pesanan eceran, paket usaha, hingga pasokan rutin katering dan restoran.</span>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="pt-4 border-t border-[#E5E7EB] flex flex-col sm:flex-row items-stretch sm:items-center gap-3.5">
                    <a href="{{ $waOrderUrl }}"
                       target="{{ !empty($waNumber) ? '_blank' : '_self' }}"
                       rel="noopener noreferrer"
                       class="inline-flex items-center justify-center gap-2.5 h-12 px-7 bg-[#238B45] hover:bg-[#1E7A3B] text-white font-semibold text-sm rounded-[10px] shadow-sm hover:shadow-md transition-all duration-150 focus:outline-none focus:ring-2 focus:ring-[#238B45] focus:ring-offset-2">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                        </svg>
                        <span>Pesan via WhatsApp</span>
                    </a>

                    <a href="{{ $waPartnerUrl }}"
                       target="{{ !empty($waNumber) ? '_blank' : '_self' }}"
                       rel="noopener noreferrer"
                       class="inline-flex items-center justify-center gap-2 h-12 px-6 border border-[#E5E7EB] hover:border-[#238B45] bg-white text-[#163326] hover:text-[#238B45] font-semibold text-sm rounded-[10px] shadow-sm hover:shadow transition-all duration-150">
                        <span>Ajukan Kemitraan Rutin</span>
                        <svg class="w-4 h-4 text-[#238B45]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>

            </div>

        </div>
    </div>
</section>

{{-- ================================================================= --}}
{{-- 3. RELATED PRODUCTS SECTION --}}
{{-- ================================================================= --}}
@if ($relatedProducts->isNotEmpty())
    <section class="py-16 bg-[#F7FAF8] border-t border-[#E5E7EB]/60">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Section Title --}}
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-10">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#EAF6EE] text-[#238B45] text-xs font-semibold mb-2">
                        <span>Rekomendasi Lainnya</span>
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-[#163326] tracking-tight">
                        Produk Pilihan Lainnya
                    </h2>
                </div>
                <a href="{{ route('products.index') }}"
                   class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-semibold text-[#238B45] hover:text-[#1E7A3B] transition-colors flex-shrink-0">
                    <span>Lihat Semua Produk</span>
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>

            {{-- Related Grid (up to 3) --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                @foreach ($relatedProducts as $related)
                    @php
                        $relatedOrderMsg = urlencode("Halo Aljamas, saya ingin memesan / bertanya detail tentang produk: {$related->name}");
                        $relatedWaUrl = !empty($waNumber) ? "https://wa.me/{$waNumber}?text={$relatedOrderMsg}" : '#kontak';
                    @endphp
                    <article class="bg-white rounded-2xl border border-[#E5E7EB] overflow-hidden flex flex-col hover:-translate-y-1 hover:shadow-lg hover:border-[#238B45]/40 transition-all duration-200 group">

                        {{-- Image --}}
                        <a href="{{ route('products.show', $related->slug) }}" class="block aspect-[4/3] bg-[#F7FAF8] border-b border-[#E5E7EB] relative overflow-hidden focus:outline-none">
                            @if ($related->image)
                                <img src="{{ Storage::disk('public')->url($related->image) }}"
                                     alt="{{ $related->name }}"
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

                            @if ($related->category)
                                <div class="absolute top-3.5 left-3.5">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-white/95 text-[#238B45] shadow-sm backdrop-blur-sm">
                                        {{ $related->category->name }}
                                    </span>
                                </div>
                            @endif
                        </a>

                        {{-- Content --}}
                        <div class="p-6 flex-1 flex flex-col justify-between">
                            <div>
                                <h3 class="font-bold text-lg text-[#163326] group-hover:text-[#238B45] transition-colors leading-snug">
                                    <a href="{{ route('products.show', $related->slug) }}" class="focus:outline-none">
                                        {{ $related->name }}
                                    </a>
                                </h3>
                                @if ($related->short_description)
                                    <p class="text-sm text-[#6B7280] leading-relaxed mt-2 line-clamp-2">
                                        {{ $related->short_description }}
                                    </p>
                                @endif
                            </div>

                            <div class="pt-5 mt-5 border-t border-[#E5E7EB] flex items-center justify-between gap-3">
                                <a href="{{ route('products.show', $related->slug) }}"
                                   class="text-xs font-semibold text-[#163326] hover:text-[#238B45] transition-colors flex items-center gap-1">
                                    <span>Lihat Detail</span>
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>

                                <a href="{{ $relatedWaUrl }}"
                                   target="{{ !empty($waNumber) ? '_blank' : '_self' }}"
                                   rel="noopener noreferrer"
                                   class="inline-flex items-center gap-1.5 h-9 px-3.5 bg-[#238B45] hover:bg-[#1E7A3B] text-white text-xs font-semibold rounded-[8px] transition-colors shadow-sm">
                                    <span>Pesan via WA</span>
                                </a>
                            </div>
                        </div>

                    </article>
                @endforeach
            </div>

        </div>
    </section>
@endif

@endsection
