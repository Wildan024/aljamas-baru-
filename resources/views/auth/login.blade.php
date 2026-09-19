<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin | Aljamas</title>
    <meta name="description" content="Halaman login administrator panel Aljamas.">
        {{-- Favicon --}}
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo/AljamasFood ikon hijau.svg') }}"> 
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#F7FAF8] font-sans flex items-center justify-center px-4">

    <div class="w-full max-w-md">

        {{-- Logo & Brand --}}
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-[#163326] shadow-lg mb-4">
                <svg class="w-8 h-8 text-[#238B45]" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17 8C8 10 5.9 16.17 3.82 20.49c-.31.63.43 1.24 1.03.85C6 20.5 8 20 10 20c6 0 8-4 8-4s-2 4-6 4c-2 0-4 .5-5.5 1.5.5-1.5 2-5.5 6-8 1.6-1.02 3.16-1.63 4.5-2z"/>
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-[#163326]">Aljamas Admin</h1>
            <p class="text-[#6B7280] text-sm mt-1">Masuk ke panel manajemen konten</p>
        </div>

        {{-- Login Card --}}
        <div class="bg-white rounded-2xl shadow-sm border border-[#E5E7EB] p-8">

            {{-- Success flash (misal setelah logout) --}}
            @if (session('success'))
                <div class="flex items-center gap-3 bg-[#EAF6EE] border border-[#238B45]/30 text-[#163326] text-sm px-4 py-3 rounded-xl mb-6">
                    <svg class="w-4 h-4 text-[#238B45] flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            {{-- Global error (auth failed) --}}
            @if ($errors->has('email'))
                <div class="flex items-center gap-3 bg-red-50 border border-[#E11D48]/30 text-red-700 text-sm px-4 py-3 rounded-xl mb-6">
                    <svg class="w-4 h-4 text-[#E11D48] flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ $errors->first('email') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.post') }}" novalidate>
                @csrf

                {{-- Email --}}
                <div class="mb-5">
                    <label for="email" class="block text-sm font-semibold text-[#1F2937] mb-1.5">
                        Email
                    </label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autocomplete="email"
                        autofocus
                        placeholder="admin@aljamas.com"
                        class="w-full h-11 px-4 border border-[#E5E7EB] rounded-[10px] text-[#1F2937] text-sm
                               bg-white placeholder-[#6B7280]
                               focus:outline-none focus:ring-2 focus:ring-[#238B45] focus:border-[#238B45]
                               transition-colors duration-150
                               {{ $errors->has('email') ? 'border-[#E11D48] ring-1 ring-[#E11D48]' : '' }}"
                    >
                </div>

                {{-- Password --}}
                <div class="mb-5">
                    <div class="flex items-center justify-between mb-1.5">
                        <label for="password" class="block text-sm font-semibold text-[#1F2937]">
                            Password
                        </label>
                    </div>
                    <div class="relative">
                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            autocomplete="current-password"
                            placeholder="••••••••"
                            class="w-full h-11 px-4 pr-12 border border-[#E5E7EB] rounded-[10px] text-[#1F2937] text-sm
                                   bg-white placeholder-[#6B7280]
                                   focus:outline-none focus:ring-2 focus:ring-[#238B45] focus:border-[#238B45]
                                   transition-colors duration-150"
                        >
                        {{-- Toggle show/hide password --}}
                        <button type="button"
                                id="toggle-password"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-[#6B7280] hover:text-[#238B45] transition-colors"
                                aria-label="Tampilkan/sembunyikan password">
                            <svg id="eye-icon" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Remember Me --}}
                <div class="flex items-center mb-6">
                    <input
                        id="remember"
                        type="checkbox"
                        name="remember"
                        class="w-4 h-4 rounded border-[#E5E7EB] text-[#238B45] focus:ring-[#238B45] focus:ring-2 cursor-pointer"
                    >
                    <label for="remember" class="ml-2 text-sm text-[#6B7280] cursor-pointer select-none">
                        Ingat saya selama 30 hari
                    </label>
                </div>

                {{-- Submit --}}
                <button
                    id="btn-login"
                    type="submit"
                    class="w-full h-12 bg-[#238B45] hover:bg-[#1E7A3B] text-white font-semibold rounded-[10px]
                           shadow-sm hover:shadow transition-all duration-200
                           flex items-center justify-center gap-2 text-sm">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                    </svg>
                    Masuk ke Dashboard
                </button>

            </form>
        </div>

        {{-- Footer note --}}
        <p class="text-center text-xs text-[#6B7280] mt-6">
            &copy; {{ date('Y') }} Aljamas. Akses terbatas untuk administrator.
        </p>

    </div>

    <script>
        // Toggle password visibility
        const toggleBtn = document.getElementById('toggle-password');
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eye-icon');

        const eyeOpen = `<path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>`;
        const eyeClosed = `<path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>`;

        if (toggleBtn) {
            toggleBtn.addEventListener('click', function () {
                const isPassword = passwordInput.type === 'password';
                passwordInput.type = isPassword ? 'text' : 'password';
                eyeIcon.innerHTML = isPassword ? eyeClosed : eyeOpen;
            });
        }
    </script>

</body>
</html>
