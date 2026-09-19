@props([
    'partners' => null,
])

@php
    $partners = $partners ?? \App\Models\EcommercePartner::active()->ordered()->get();
@endphp

{{-- Compact Multi-Partner E-Commerce Shortcut Component --}}
<section aria-label="E-Commerce Partner" class="py-4 sm:py-5 bg-[#F7FAF8] border-b border-[#E5E7EB]/70">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="w-full bg-white rounded-2xl border border-[#E5E7EB] p-4 sm:p-5 lg:p-6 shadow-xs">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5 lg:gap-8">

                {{-- Left: Intro Area (Icon, Heading, Description) --}}
                <div class="flex items-center gap-3.5 sm:gap-4 flex-shrink-0 lg:max-w-xs xl:max-w-sm">
                    <div class="w-11 h-11 sm:w-12 sm:h-12 rounded-xl bg-[#EAF6EE] text-[#238B45] flex items-center justify-center flex-shrink-0 shadow-xs">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                    <div>
                        <div class="flex flex-wrap items-center gap-2">
                            <h2 class="font-sans font-bold text-sm sm:text-base text-[#163326] leading-tight">
                                E-Commerce Partner
                            </h2>
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-semibold bg-[#EAF6EE] text-[#238B45] border border-[#238B45]/20">
                                Official Store
                            </span>
                        </div>
                        <p class="font-body text-xs sm:text-sm text-[#6B7280] leading-snug mt-0.5">
                            Belanja produk Aljamas melalui partner e-commerce kami
                        </p>
                    </div>
                </div>

                {{-- Right: Balanced Dynamic Partner Grid --}}
                @if ($partners->isNotEmpty())
                    <div class="flex-1 min-w-0">
                        <div class="grid grid-cols-1 min-[420px]:grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 gap-2.5 sm:gap-3">
                            @foreach ($partners as $partner)
                                @php
                                    $isExternal = is_string($partner->url) && (str_starts_with($partner->url, 'http://') || str_starts_with($partner->url, 'https://'));
                                @endphp
                                <a href="{{ $partner->url }}"
                                   @if ($isExternal) target="_blank" rel="noopener noreferrer" @endif
                                   aria-label="Kunjungi toko resmi Aljamas di {{ $partner->name }}"
                                   class="group flex items-center gap-2.5 h-11 px-3.5 rounded-xl border border-[#E5E7EB] bg-[#F7FAF8] hover:bg-white hover:border-[#238B45] text-[#163326] hover:text-[#238B45] shadow-2xs hover:shadow-sm focus:outline-none focus:ring-2 focus:ring-[#238B45] focus:ring-offset-2 transition-all duration-200">

                                    {{-- Brand Logo or Fallback Icon --}}
                                    <div class="w-5 h-5 rounded flex items-center justify-center flex-shrink-0 overflow-hidden">
                                        @if ($partner->logo_url)
                                            <img src="{{ $partner->logo_url }}"
                                                 alt="Logo {{ $partner->name }}"
                                                 class="w-full h-full object-contain"
                                                 loading="lazy">
                                        @else
                                            <svg class="w-4 h-4 text-[#238B45] group-hover:scale-110 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                            </svg>
                                        @endif
                                    </div>

                                    {{-- Partner Name --}}
                                    <span class="font-sans font-semibold text-xs sm:text-sm tracking-tight truncate">
                                        {{ $partner->name }}
                                    </span>

                                    {{-- External Link Arrow --}}
                                    <svg class="w-3.5 h-3.5 text-[#6B7280] group-hover:text-[#238B45] group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-all duration-200 ml-auto flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                    </svg>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-[#F7FAF8] border border-[#E5E7EB] text-xs text-[#6B7280]">
                        <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                        <span>Kanal e-commerce sedang dipersiapkan</span>
                    </div>
                @endif

            </div>
        </div>
    </div>
</section>
