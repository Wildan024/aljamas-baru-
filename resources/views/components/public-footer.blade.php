@php
    $companyName = $settings['company_name'] ?? 'Aljamas';
    $waNumber = preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '');
    $waMsg = urlencode($settings['whatsapp_default_message'] ?? 'Halo Aljamas, saya ingin bertanya.');
    $waUrl = !empty($waNumber) ? "https://wa.me/{$waNumber}?text={$waMsg}" : null;
@endphp

<footer class="bg-[#163326] text-white pt-16 pb-12 border-t border-white/10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 lg:gap-12 pb-12 border-b border-white/10">

            {{-- Column 1: Company Profile & Description --}}
            <div class="space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-[#238B45] flex items-center justify-center text-white font-extrabold text-lg shadow-sm">
                        A
                    </div>
                    <span class="font-extrabold text-2xl tracking-tight text-white">
                        {{ $companyName }}
                    </span>
                </div>
                <p class="text-white/75 text-sm leading-relaxed">
                    {{ $settings['footer_text'] ?? ($settings['company_tagline'] ?? 'Produsen kulit dimsum, kulit pangsit, kulit samosa, dan mie segar berkualitas untuk kebutuhan usaha kuliner Anda.') }}
                </p>
                @if (!empty($settings['company_tagline']))
                    <p class="text-[#238B45] text-xs font-semibold uppercase tracking-wider">
                        {{ $settings['company_tagline'] }}
                    </p>
                @endif
            </div>

            {{-- Column 2: Quick Links --}}
            <div>
                <h4 class="text-white font-bold text-base mb-4 tracking-tight">Navigasi Cepat</h4>
                <ul class="space-y-2.5 text-sm">
                    <li>
                        <a href="{{ route('home') }}" class="text-white/70 hover:text-[#238B45] transition-colors duration-150 flex items-center gap-2">
                            <span class="text-[#238B45] text-xs">›</span> Beranda
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('home') }}#tentang-kami" class="text-white/70 hover:text-[#238B45] transition-colors duration-150 flex items-center gap-2">
                            <span class="text-[#238B45] text-xs">›</span> Tentang Kami
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('products.index') }}" class="text-white/70 hover:text-[#238B45] transition-colors duration-150 flex items-center gap-2">
                            <span class="text-[#238B45] text-xs">›</span> Produk Unggulan
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('partnership.index') }}" class="text-white/70 hover:text-[#238B45] transition-colors duration-150 flex items-center gap-2">
                            <span class="text-[#238B45] text-xs">›</span> Kemitraan Usaha
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('blog.index') }}" class="text-white/70 hover:text-[#238B45] transition-colors duration-150 flex items-center gap-2">
                            <span class="text-[#238B45] text-xs">›</span> Blog & Berita
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('gallery.index') }}" class="text-white/70 hover:text-[#238B45] transition-colors duration-150 flex items-center gap-2">
                            <span class="text-[#238B45] text-xs">›</span> Galeri Dokumentasi
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Column 3: Contact & Address --}}
            <div class="space-y-4" id="kontak">
                <h4 class="text-white font-bold text-base mb-4 tracking-tight">Kontak & Lokasi</h4>
                <ul class="space-y-3 text-sm text-white/75">
                    @if (!empty($settings['company_address']))
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-[#238B45] flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <div>
                                <span>{{ $settings['company_address'] }}</span>
                                @if (!empty($settings['google_maps']))
                                    <div class="mt-1">
                                        <a href="{{ $settings['google_maps'] }}"
                                           target="_blank"
                                           rel="noopener noreferrer"
                                           class="text-[#238B45] hover:underline text-xs inline-flex items-center gap-1 font-medium">
                                            Buka di Google Maps
                                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                            </svg>
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </li>
                    @endif

                    @if (!empty($settings['company_email']))
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-[#238B45] flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <a href="mailto:{{ $settings['company_email'] }}" class="hover:text-white transition-colors">
                                {{ $settings['company_email'] }}
                            </a>
                        </li>
                    @endif

                    @if (!empty($settings['company_phone']))
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-[#238B45] flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <a href="tel:{{ $settings['company_phone'] }}" class="hover:text-white transition-colors">
                                {{ $settings['company_phone'] }}
                            </a>
                        </li>
                    @endif
                </ul>
            </div>

            {{-- Column 4: Social Media & WhatsApp CTA --}}
            <div class="space-y-4">
                <h4 class="text-white font-bold text-base mb-4 tracking-tight">Hubungi & Ikuti Kami</h4>
                <p class="text-white/70 text-sm">
                    Dapatkan penawaran harga khusus kemitraan bisnis dan pasokan rutin langsung dari pabrik.
                </p>

                @if ($waUrl)
                    <div>
                        <a href="{{ $waUrl }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="inline-flex items-center gap-2 h-10 px-4 bg-[#238B45] hover:bg-[#1E7A3B] text-white text-xs font-semibold rounded-[10px] transition-colors shadow-sm">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                            </svg>
                            <span>Chat WhatsApp Langsung</span>
                        </a>
                    </div>
                @endif

                {{-- Social Media Icons --}}
                @php
                    $hasSocial = !empty($settings['instagram_url']) || !empty($settings['facebook_url']) || !empty($settings['tiktok_url']) || !empty($settings['youtube_url']);
                @endphp
                @if ($hasSocial)
                    <div class="pt-2">
                        <p class="text-xs text-white/50 uppercase tracking-wider mb-2 font-semibold">Media Sosial</p>
                        <div class="flex items-center gap-2.5">
                            @if (!empty($settings['instagram_url']))
                                <a href="{{ $settings['instagram_url'] }}" target="_blank" rel="noopener noreferrer" aria-label="Instagram Aljamas"
                                   class="w-9 h-9 rounded-xl bg-white/10 hover:bg-[#238B45] text-white flex items-center justify-center transition-colors">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                    </svg>
                                </a>
                            @endif

                            @if (!empty($settings['facebook_url']))
                                <a href="{{ $settings['facebook_url'] }}" target="_blank" rel="noopener noreferrer" aria-label="Facebook Aljamas"
                                   class="w-9 h-9 rounded-xl bg-white/10 hover:bg-[#238B45] text-white flex items-center justify-center transition-colors">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                    </svg>
                                </a>
                            @endif

                            @if (!empty($settings['tiktok_url']))
                                <a href="{{ $settings['tiktok_url'] }}" target="_blank" rel="noopener noreferrer" aria-label="TikTok Aljamas"
                                   class="w-9 h-9 rounded-xl bg-white/10 hover:bg-[#238B45] text-white flex items-center justify-center transition-colors">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64c.298-.002.595.042.88.13V9.4a6.33 6.33 0 0 0-1-.08A6.34 6.34 0 0 0 3 15.66a6.34 6.34 0 0 0 10.82 4.47 6.27 6.27 0 0 0 1.91-4.46V8.67a8.21 8.21 0 0 0 4.86 1.57v-3.5a4.77 4.77 0 0 1-1-.05z"/>
                                    </svg>
                                </a>
                            @endif

                            @if (!empty($settings['youtube_url']))
                                <a href="{{ $settings['youtube_url'] }}" target="_blank" rel="noopener noreferrer" aria-label="YouTube Aljamas"
                                   class="w-9 h-9 rounded-xl bg-white/10 hover:bg-[#238B45] text-white flex items-center justify-center transition-colors">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </div>
                @endif
            </div>

        </div>

        {{-- Bottom Copyright & Admin Gateway --}}
        <div class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-white/50">
            <p>© {{ date('Y') }} {{ $companyName }}. Seluruh hak cipta dilindungi undang-undang.</p>
            <div class="flex items-center gap-4">
                <span class="text-white/30">Produsen Bahan Baku Kuliner Berkualitas</span>
                <span class="text-white/20">•</span>
                <a href="{{ route('admin.dashboard') }}" class="hover:text-white/80 transition-colors">
                    Admin Portal
                </a>
            </div>
        </div>
    </div>
</footer>
