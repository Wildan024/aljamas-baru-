<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- SEO & Metadata --}}
    <title>@yield('title', ($settings['company_name'] ?? 'Aljamas') . ' — ' . ($settings['company_tagline'] ?? 'Produsen Kulit Dimsum & Olahan Adonan Berkualitas'))</title>
    <meta name="description" content="@yield('meta_description', $settings['footer_text'] ?? ($settings['company_tagline'] ?? 'Produsen kulit dimsum, kulit pangsit, kulit samosa, dan mie segar berkualitas untuk kebutuhan usaha kuliner Anda.'))">
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Open Graph / Social Media --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('og_title', ($settings['company_name'] ?? 'Aljamas') . ' — ' . ($settings['company_tagline'] ?? 'Solusi Bahan Baku Kuliner'))">
    <meta property="og:description" content="@yield('og_description', $settings['footer_text'] ?? 'Produsen terpercaya kulit dimsum, kulit pangsit, kulit samosa, dan mie segar higienis.')">
    <meta property="og:site_name" content="{{ $settings['company_name'] ?? 'Aljamas' }}">
    <meta property="og:image" content="@yield('og_image', !empty($settings['company_logo']) ? asset($settings['company_logo']) : asset('images/home/hero_food_production.jpg'))">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('og_title', ($settings['company_name'] ?? 'Aljamas') . ' — ' . ($settings['company_tagline'] ?? 'Solusi Bahan Baku Kuliner'))">
    <meta name="twitter:description" content="@yield('og_description', $settings['footer_text'] ?? 'Produsen terpercaya kulit dimsum, kulit pangsit, kulit samosa, dan mie segar higienis.')">
    <meta name="twitter:image" content="@yield('og_image', !empty($settings['company_logo']) ? asset($settings['company_logo']) : asset('images/home/hero_food_production.jpg'))">

    {{-- Favicon --}}
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo/AljamasFood ikon hijau.svg') }}"> 
    {{-- Google Fonts: Poppins & Inter --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@500;600;700;800&display=swap" rel="stylesheet">

    {{-- Vite Assets --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>
<body class="font-sans antialiased text-[#1F2937] bg-[#FFFFFF] min-h-screen flex flex-col selection:bg-[#238B45] selection:text-white">

    {{-- Public Navbar --}}
    @include('components.public-navbar')

    {{-- Main Content --}}
    <main class="flex-grow">
        @yield('content')
    </main>

    {{-- Public Footer --}}
    @include('components.public-footer')

    {{-- Floating WhatsApp Quick Contact Button --}}
    @if (!empty($settings['whatsapp_number']))
        @php
            $waNumber = preg_replace('/[^0-9]/', '', $settings['whatsapp_number']);
            $waMsg = urlencode($settings['whatsapp_default_message'] ?? 'Halo Aljamas, saya ingin bertanya tentang produk dan kemitraan.');
            $waUrl = "https://wa.me/{$waNumber}?text={$waMsg}";
        @endphp
        <a href="{{ $waUrl }}"
           target="_blank"
           rel="noopener noreferrer"
           aria-label="Hubungi kami via WhatsApp"
           class="fixed bottom-6 right-6 z-40 inline-flex items-center gap-2.5 px-4 py-3 bg-[#25D366] hover:bg-[#1EBE5D] text-white font-semibold text-sm rounded-full shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-[#25D366] focus:ring-offset-2">
            <svg class="w-5 h-5 flex-shrink-0 fill-current" viewBox="0 0 24 24">
                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
            </svg>
            <span>WhatsApp Kami</span>
        </a>
    @endif

    @stack('scripts')
</body>
</html>
