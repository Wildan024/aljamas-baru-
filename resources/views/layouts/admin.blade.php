<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') | Aljamas Admin</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F7FAF8] font-sans text-[#1F2937] min-h-screen">

    <div class="min-h-screen flex bg-[#F7FAF8]">

        {{-- ===== SIDEBAR ===== --}}
        <aside id="sidebar"
               class="fixed inset-y-0 left-0 z-50 w-64 bg-[#163326] text-white flex flex-col shadow-xl
                      -translate-x-full transition-transform duration-300
                      lg:sticky lg:top-0 lg:h-screen lg:flex-shrink-0 lg:translate-x-0">

            {{-- Logo --}}
            <div class="flex items-center gap-3 px-6 py-5 border-b border-white/10 flex-shrink-0">
                <div class="w-9 h-9 rounded-xl bg-[#238B45] flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14H9V8h2v8zm4 0h-2V8h2v8z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-white font-bold text-base leading-tight">Aljamas</p>
                    <p class="text-white/50 text-xs">Admin Panel</p>
                </div>
            </div>

            {{-- Navigation --}}
            <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">

                {{-- Dashboard --}}
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors duration-150
                          {{ request()->routeIs('admin.dashboard*') ? 'bg-[#238B45] text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Dashboard
                </a>

                {{-- Divider --}}
                <div class="pt-3 pb-1 px-3">
                    <p class="text-white/30 text-xs font-semibold uppercase tracking-wider">Konten</p>
                </div>

                {{-- Products --}}
                <a href="{{ route('admin.products.index') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors duration-150
                          {{ request()->routeIs('admin.products*') ? 'bg-[#238B45] text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                    Produk
                </a>

                {{-- Blogs --}}
                <a href="{{ route('admin.blogs.index') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors duration-150
                          {{ request()->routeIs('admin.blogs*') ? 'bg-[#238B45] text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Blog
                </a>

                {{-- Gallery --}}
                <a href="{{ route('admin.galleries.index') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors duration-150
                          {{ request()->routeIs('admin.galleries*') ? 'bg-[#238B45] text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Galeri
                </a>

                {{-- Divider --}}
                <div class="pt-3 pb-1 px-3">
                    <p class="text-white/30 text-xs font-semibold uppercase tracking-wider">Bisnis</p>
                </div>

                {{-- Partnerships --}}
                <a href="{{ route('admin.partnerships.index') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors duration-150
                          {{ request()->routeIs('admin.partnerships*') ? 'bg-[#238B45] text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span>Kemitraan</span>
                    @php
                        $pendingPartnershipsCount = \App\Models\Partnership::where('status', 'new')->count();
                    @endphp
                    @if ($pendingPartnershipsCount > 0)
                        <span class="ml-auto text-[11px] font-bold bg-amber-500 text-white px-2 py-0.5 rounded-full">
                            {{ $pendingPartnershipsCount > 9 ? '9+' : $pendingPartnershipsCount }}
                        </span>
                    @endif
                </a>

                {{-- Settings --}}
                <a href="{{ route('admin.settings.index') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors duration-150
                          {{ request()->routeIs('admin.settings*') ? 'bg-[#238B45] text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Pengaturan
                </a>

            </nav>

            {{-- User Info + Logout --}}
            <div class="px-3 py-4 border-t border-white/10 flex-shrink-0">
                <div class="flex items-center gap-3 px-3 py-2 rounded-xl">
                    <div class="w-8 h-8 rounded-full bg-[#238B45] flex items-center justify-center flex-shrink-0 text-white text-sm font-bold">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-white text-sm font-medium truncate">{{ auth()->user()->name }}</p>
                        <p class="text-white/40 text-xs truncate">{{ auth()->user()->email }}</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="mt-2">
                    @csrf
                    <button type="submit"
                            class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-white/70 hover:bg-white/10 hover:text-white transition-colors duration-150">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Keluar
                    </button>
                </form>
            </div>

        </aside>

        {{-- ===== MAIN CONTENT ===== --}}
        <div class="flex-1 flex flex-col min-w-0 min-h-screen">

            {{-- Top Bar --}}
            <header class="sticky top-0 z-40 bg-white border-b border-[#E5E7EB] shadow-sm flex-shrink-0">
                <div class="flex items-center justify-between h-16 px-6">

                    {{-- Hamburger (mobile) --}}
                    <button id="sidebar-toggle"
                            class="lg:hidden p-2 rounded-xl text-[#6B7280] hover:bg-[#F7FAF8] transition-colors"
                            aria-label="Toggle sidebar">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>

                    {{-- Page Title --}}
                    <h1 class="text-[#163326] font-semibold text-lg hidden lg:block">
                        @yield('page-title', 'Dashboard')
                    </h1>

                    {{-- Right: View Website --}}
                    <a href="{{ route('home') }}"
                       target="_blank"
                       class="flex items-center gap-2 text-sm text-[#6B7280] hover:text-[#238B45] transition-colors font-medium">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                        Lihat Website
                    </a>

                </div>
            </header>

            {{-- Flash Messages --}}
            @if (session('success'))
                <div class="mx-6 mt-4 flex items-center gap-3 bg-[#EAF6EE] border border-[#238B45]/30 text-[#163326] text-sm font-medium px-4 py-3 rounded-xl" role="alert">
                    <svg class="w-5 h-5 text-[#238B45] flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mx-6 mt-4 flex items-center gap-3 bg-red-50 border border-[#E11D48]/30 text-red-800 text-sm font-medium px-4 py-3 rounded-xl" role="alert">
                    <svg class="w-5 h-5 text-[#E11D48] flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ session('error') }}
                </div>
            @endif

            {{-- Page Content --}}
            <main class="flex-1 p-6">
                @yield('content')
            </main>

        </div>

    </div>

    {{-- Sidebar overlay (mobile) --}}
    <div id="sidebar-overlay"
         class="fixed inset-0 z-40 bg-black/40 hidden lg:hidden"
         aria-hidden="true"></div>

    <script>
        // Mobile sidebar toggle
        const toggle = document.getElementById('sidebar-toggle');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');

        function openSidebar() {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
        }

        function closeSidebar() {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        }

        if (toggle) {
            toggle.addEventListener('click', openSidebar);
        }
        if (overlay) {
            overlay.addEventListener('click', closeSidebar);
        }
    </script>

    @stack('scripts')

</body>
</html>
