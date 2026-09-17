@props(['blog'])

<article class="bg-white rounded-2xl border border-[#E5E7EB] overflow-hidden flex flex-col hover:-translate-y-1 hover:shadow-lg hover:border-[#238B45]/40 transition-all duration-200 group">

    {{-- Blog Thumbnail Link --}}
    <a href="{{ route('blog.show', $blog->slug) }}" class="block aspect-[16/10] bg-[#F7FAF8] border-b border-[#E5E7EB] relative overflow-hidden focus:outline-none" aria-label="{{ $blog->title }}">
        @if (!empty($blog->image))
            <img src="{{ Storage::disk('public')->url($blog->image) }}"
                 alt="{{ $blog->title }}"
                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                 loading="lazy">
        @else
            {{-- Elegant Fallback Visual --}}
            <div class="w-full h-full flex flex-col items-center justify-center text-[#6B7280] bg-gradient-to-br from-[#F7FAF8] to-[#EAF6EE]/50 p-6 text-center">
                <div class="w-12 h-12 rounded-xl bg-white text-[#238B45] border border-[#E5E7EB] flex items-center justify-center mb-2 shadow-sm group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                    </svg>
                </div>
                <span class="text-xs font-semibold text-[#163326]">Insight Aljamas</span>
                <span class="text-[11px] text-[#6B7280]">Artikel &amp; Edukasi Kuliner</span>
            </div>
        @endif

        {{-- Category Badge --}}
        @if ($blog->category)
            <div class="absolute top-3.5 left-3.5">
                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-white/95 text-[#238B45] shadow-sm backdrop-blur-sm border border-[#E5E7EB]/80">
                    {{ $blog->category->name }}
                </span>
            </div>
        @endif
    </a>

    {{-- Blog Information & Action --}}
    <div class="p-6 flex-1 flex flex-col justify-between">
        <div>
            {{-- Publication Date --}}
            <div class="flex items-center gap-1.5 text-xs text-[#6B7280] font-medium mb-2.5">
                <svg class="w-3.5 h-3.5 text-[#238B45]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span>{{ $blog->published_at ? $blog->published_at->format('d M Y') : $blog->created_at->format('d M Y') }}</span>
            </div>

            {{-- Title --}}
            <h2 class="font-bold text-lg text-[#163326] group-hover:text-[#238B45] transition-colors leading-snug line-clamp-2">
                <a href="{{ route('blog.show', $blog->slug) }}" class="focus:outline-none">
                    {{ $blog->title }}
                </a>
            </h2>

            {{-- Excerpt --}}
            @if ($blog->excerpt)
                <p class="text-sm text-[#6B7280] leading-relaxed mt-2.5 line-clamp-2">
                    {{ $blog->excerpt }}
                </p>
            @endif
        </div>

        {{-- Card Footer Link --}}
        <div class="pt-5 mt-5 border-t border-[#E5E7EB] flex items-center justify-between">
            <a href="{{ route('blog.show', $blog->slug) }}"
               class="text-xs font-semibold text-[#238B45] hover:text-[#1E7A3B] group-hover:translate-x-0.5 transition-all inline-flex items-center gap-1.5">
                <span>Baca Artikel</span>
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </a>
        </div>
    </div>

</article>
