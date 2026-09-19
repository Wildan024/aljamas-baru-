@php
    $companyName = $settings['company_name'] ?? 'Aljamas';
    $waNumber = preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '6281234567890');
    $waMsg = urlencode($settings['whatsapp_default_message'] ?? 'Halo Aljamas, saya ingin bertanya tentang produk Anda.');
    $waContactUrl = !empty($waNumber) ? "https://wa.me/{$waNumber}?text={$waMsg}" : '#kontak';
@endphp

<header class="sticky top-0 z-50 bg-[#238B45] text-white shadow-md border-b border-[#1E7A3B] transition-all duration-200" id="main-header">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-18 sm:h-20">

            {{-- Brand Logo & Name --}}
                <a href="{{ url('/') }}" class="flex items-center gap-3">
                    <img
                        src="{{ asset('images/logo/AljamasFood ikon putih.svg') }}"
                        alt="Aljamas Food"
                        class="w-10 h-12 object-contain"
                    >
                    <div class="flex flex-col">
                        <span class="font-extrabold text-xl tracking-tight text-white leading-none">
                            {{ $companyName }}
                        </span>
                        @if (!empty($settings['company_tagline']))
                            <span class="text-[11px] font-medium text-white/80 tracking-normal mt-0.5 hidden sm:inline-block">
                                Produsen Berkualitas
                            </span>
                        @endif
                    </div>
                </a>

            {{-- Desktop Navigation Links (Single-line, clear rhythm) --}}
            <nav class="hidden md:flex items-center gap-1.5 lg:gap-2" aria-label="Menu Utama">
                <a href="{{ route('home') }}"
                   class="text-sm px-3.5 py-1.5 rounded-lg transition-colors duration-150 {{ request()->routeIs('home') ? 'font-semibold text-white bg-white/15' : 'font-medium text-white/85 hover:text-white hover:bg-white/10' }}">
                    Beranda
                </a>
                <a href="{{ request()->routeIs('home') ? '#tentang-kami' : route('home') . '#tentang-kami' }}"
                   class="text-sm font-medium text-white/85 hover:text-white hover:bg-white/10 px-3.5 py-1.5 rounded-lg transition-colors duration-150">
                    Tentang Kami
                </a>
                <a href="{{ route('products.index') }}"
                   class="text-sm px-3.5 py-1.5 rounded-lg transition-colors duration-150 {{ request()->routeIs('products.*') ? 'font-semibold text-white bg-white/15' : 'font-medium text-white/85 hover:text-white hover:bg-white/10' }}">
                    Produk
                </a>
                <a href="{{ route('partnership.index') }}"
                   class="text-sm px-3.5 py-1.5 rounded-lg transition-colors duration-150 {{ request()->routeIs('partnership.*') ? 'font-semibold text-white bg-white/15' : 'font-medium text-white/85 hover:text-white hover:bg-white/10' }}">
                    Kemitraan
                </a>
                <a href="{{ route('blog.index') }}"
                   class="text-sm px-3.5 py-1.5 rounded-lg transition-colors duration-150 {{ request()->routeIs('blog.*') ? 'font-semibold text-white bg-white/15' : 'font-medium text-white/85 hover:text-white hover:bg-white/10' }}">
                    Blog
                </a>
                <a href="{{ route('gallery.index') }}"
                   class="text-sm px-3.5 py-1.5 rounded-lg transition-colors duration-150 {{ request()->routeIs('gallery.*') ? 'font-semibold text-white bg-white/15' : 'font-medium text-white/85 hover:text-white hover:bg-white/10' }}">
                    Galeri
                </a>
            </nav>

            {{-- Right Actions (CTA + Mobile Hamburger) --}}
            <div class="flex items-center gap-3">
                {{-- Desktop Primary CTA (White button on green header) --}}
                <a href="{{ $waContactUrl }}"
                   target="{{ !empty($waNumber) ? '_blank' : '_self' }}"
                   rel="noopener noreferrer"
                   class="hidden sm:inline-flex items-center gap-2 h-10 px-5 bg-white hover:bg-[#EAF6EE] text-[#238B45] hover:text-[#1E7A3B] text-sm font-semibold rounded-[10px] shadow-sm hover:shadow transition-all duration-150 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-[#238B45]">
                    <span>Hubungi Kami</span>
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>

                {{-- Mobile Hamburger Button --}}
                <button type="button"
                        id="mobile-menu-btn"
                        aria-expanded="false"
                        aria-controls="mobile-menu"
                        aria-label="Buka Menu Navigasi"
                        class="md:hidden inline-flex items-center justify-center p-2.5 rounded-xl text-white hover:bg-white/10 border border-white/20 focus:outline-none focus:ring-2 focus:ring-white">
                    <svg id="hamburger-icon" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg id="close-icon" class="w-6 h-6 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

        </div>
    </div>

    {{-- Mobile Navigation Dropdown --}}
    <div id="mobile-menu" class="hidden md:hidden border-t border-white/15 bg-[#238B45] px-4 pt-3 pb-6 space-y-1.5 shadow-xl transition-all duration-200">
        <a href="{{ route('home') }}"
           class="mobile-nav-link block px-3 py-2.5 rounded-xl text-base {{ request()->routeIs('home') ? 'font-semibold text-white bg-white/15' : 'font-medium text-white/85 hover:bg-white/10 hover:text-white' }}">
            Beranda
        </a>
        <a href="{{ request()->routeIs('home') ? '#tentang-kami' : route('home') . '#tentang-kami' }}"
           class="mobile-nav-link block px-3 py-2.5 rounded-xl text-base font-medium text-white/85 hover:bg-white/10 hover:text-white">
            Tentang Kami
        </a>
        <a href="{{ route('products.index') }}"
           class="mobile-nav-link block px-3 py-2.5 rounded-xl text-base {{ request()->routeIs('products.*') ? 'font-semibold text-white bg-white/15' : 'font-medium text-white/85 hover:bg-white/10 hover:text-white' }}">
            Produk
        </a>
        <a href="{{ route('partnership.index') }}"
           class="mobile-nav-link block px-3 py-2.5 rounded-xl text-base {{ request()->routeIs('partnership.*') ? 'font-semibold text-white bg-white/15' : 'font-medium text-white/85 hover:bg-white/10 hover:text-white' }}">
            Kemitraan
        </a>
        <a href="{{ route('blog.index') }}"
           class="mobile-nav-link block px-3 py-2.5 rounded-xl text-base {{ request()->routeIs('blog.*') ? 'font-semibold text-white bg-white/15' : 'font-medium text-white/85 hover:bg-white/10 hover:text-white' }}">
            Blog
        </a>
        <a href="{{ route('gallery.index') }}"
           class="mobile-nav-link block px-3 py-2.5 rounded-xl text-base {{ request()->routeIs('gallery.*') ? 'font-semibold text-white bg-white/15' : 'font-medium text-white/85 hover:bg-white/10 hover:text-white' }}">
            Galeri
        </a>
        <div class="pt-3 border-t border-white/15">
            <a href="{{ $waContactUrl }}"
               target="{{ !empty($waNumber) ? '_blank' : '_self' }}"
               rel="noopener noreferrer"
               class="w-full inline-flex items-center justify-center gap-2 h-11 px-5 bg-white hover:bg-[#EAF6EE] text-[#238B45] text-base font-semibold rounded-[10px] shadow-sm transition-colors">
                <span>Hubungi via WhatsApp</span>
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </a>
        </div>
    </div>
</header>

{{-- Vanilla JS Toggle for Mobile Menu --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const menuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const hamburgerIcon = document.getElementById('hamburger-icon');
    const closeIcon = document.getElementById('close-icon');

    if (menuBtn && mobileMenu) {
        menuBtn.addEventListener('click', function () {
            const isExpanded = menuBtn.getAttribute('aria-expanded') === 'true';
            menuBtn.setAttribute('aria-expanded', !isExpanded);
            mobileMenu.classList.toggle('hidden');
            hamburgerIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');
        });

        // Close on clicking any link inside mobile menu
        const mobileLinks = mobileMenu.querySelectorAll('.mobile-nav-link');
        mobileLinks.forEach(function (link) {
            link.addEventListener('click', function () {
                mobileMenu.classList.add('hidden');
                menuBtn.setAttribute('aria-expanded', 'false');
                hamburgerIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
            });
        });
    }
});
</script>
