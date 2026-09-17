@props(['gallery'])

@php
    $imageUrl = !empty($gallery->image) ? Storage::disk('public')->url($gallery->image) : null;
    $title = $gallery->title ?: 'Dokumentasi Aljamas';
    $description = $gallery->description ?: '';
@endphp

<div
    class="gallery-card group relative bg-[#F7FAF8] rounded-2xl border border-[#E5E7EB] overflow-hidden cursor-pointer shadow-sm hover:shadow-md hover:border-[#238B45]/40 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-[#238B45] focus:ring-offset-2"
    tabindex="0"
    role="button"
    aria-label="Buka foto: {{ $title }}"
    data-lightbox-trigger
    data-image="{{ $imageUrl ?? asset('images/gallery/gallery-hero.jpg') }}"
    data-title="{{ $title }}"
    data-description="{{ $description }}"
>
    {{-- Image Container (aspect 4/3 or 1/1 depending on grid) --}}
    <div class="aspect-[4/3] w-full overflow-hidden bg-[#F7FAF8] relative">
        @if ($imageUrl)
            <img
                src="{{ $imageUrl }}"
                alt="{{ $title }}"
                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                loading="lazy"
                onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'w-full h-full flex flex-col items-center justify-center p-6 text-center text-[#6B7280] bg-[#EAF6EE]/50\'><div class=\'w-10 h-10 rounded-xl bg-white border border-[#E5E7EB] flex items-center justify-center text-[#238B45] mb-2 shadow-sm\'><svg class=\'w-5 h-5\' fill=\'none\' viewBox=\'0 0 24 24\' stroke=\'currentColor\' stroke-width=\'1.5\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' d=\'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z\'/></svg></div><span class=\'text-xs font-semibold text-[#163326]\'>Dokumentasi Aljamas</span></div>';"
            >
        @else
            {{-- Branded Clean Fallback --}}
            <div class="w-full h-full flex flex-col items-center justify-center p-6 text-center text-[#6B7280] bg-[#EAF6EE]/50">
                <div class="w-12 h-12 rounded-xl bg-white border border-[#E5E7EB] flex items-center justify-center text-[#238B45] mb-2 shadow-sm group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <span class="text-xs font-semibold text-[#163326]">Dokumentasi Aljamas</span>
                <span class="text-[11px] text-[#6B7280]">Foto Produksi &amp; Kegiatan</span>
            </div>
        @endif

        {{-- Subtle Zoom Badge on Top-Right --}}
        <div class="absolute top-3 right-3 w-8 h-8 rounded-full bg-white/90 text-[#163326] backdrop-blur-sm shadow-sm flex items-center justify-center opacity-0 group-hover:opacity-100 group-focus:opacity-100 transition-opacity duration-200">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7"/>
            </svg>
        </div>

        {{-- Gradient Overlay with Title & Description --}}
        <div class="absolute inset-0 bg-gradient-to-t from-[#163326]/90 via-[#163326]/40 to-transparent opacity-0 group-hover:opacity-100 group-focus:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-4 sm:p-5">
            <h3 class="text-white text-sm sm:text-base font-bold leading-snug drop-shadow-sm line-clamp-1">
                {{ $title }}
            </h3>
            @if ($description)
                <p class="text-white/85 text-xs mt-1 line-clamp-2 leading-relaxed">
                    {{ $description }}
                </p>
            @endif
        </div>
    </div>

    {{-- Bottom Caption Card info (Visible on mobile/desktop without hovering) --}}
    <div class="p-4 sm:p-5 bg-white border-t border-[#E5E7EB]">
        <h3 class="text-sm font-bold text-[#163326] group-hover:text-[#238B45] transition-colors leading-snug line-clamp-1">
            {{ $title }}
        </h3>
        @if ($description)
            <p class="text-xs text-[#6B7280] mt-1 line-clamp-2 leading-relaxed">
                {{ $description }}
            </p>
        @else
            <p class="text-[11px] text-[#238B45] font-medium mt-1">
                Lihat Foto &amp; Dokumentasi →
            </p>
        @endif
    </div>
</div>
