@extends('layouts.admin')

@section('title', 'Pengaturan Perusahaan')
@section('page-title', 'Pengaturan Perusahaan')

@section('content')

{{-- Header --}}
<div class="mb-6">
    <h2 class="text-xl font-bold text-[#163326]">Pengaturan Perusahaan</h2>
    <p class="text-[#6B7280] text-sm mt-0.5">Kelola identitas, kontak, alamat, dan media sosial yang digunakan pada website publik.</p>
</div>

<form method="POST" action="{{ route('admin.settings.update') }}" novalidate>
    @csrf
    @method('PUT')

    <div class="space-y-6">

        {{-- ===== Card 1: Identitas Perusahaan ===== --}}
        <div class="bg-white rounded-2xl border border-[#E5E7EB] p-6">
            <div class="flex items-center gap-3 mb-5 pb-3 border-b border-[#E5E7EB]">
                <div class="w-9 h-9 rounded-xl bg-[#EAF6EE] text-[#238B45] flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-[#163326] font-semibold text-base">Identitas Perusahaan</h3>
                    <p class="text-xs text-[#6B7280]">Nama brand, slogan, dan informasi umum profil bisnis.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                {{-- Company Name --}}
                <div>
                    <label for="company_name" class="block text-sm font-semibold text-[#1F2937] mb-1.5">
                        Nama Perusahaan <span class="text-[#E11D48]">*</span>
                    </label>
                    <input
                        id="company_name"
                        type="text"
                        name="company_name"
                        value="{{ old('company_name', $settings['company_name'] ?? '') }}"
                        required
                        maxlength="255"
                        placeholder="Contoh: Aljamas"
                        class="w-full h-11 px-4 border rounded-[10px] text-[#1F2937] text-sm placeholder-[#6B7280]
                               focus:outline-none focus:ring-2 focus:ring-[#238B45] focus:border-[#238B45] transition-colors
                               {{ $errors->has('company_name') ? 'border-[#E11D48] ring-1 ring-[#E11D48]' : 'border-[#E5E7EB]' }}"
                    >
                    @error('company_name')
                        <p class="mt-1.5 text-xs text-[#E11D48]">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Company Tagline --}}
                <div>
                    <label for="company_tagline" class="block text-sm font-semibold text-[#1F2937] mb-1.5">
                        Tagline / Slogan
                    </label>
                    <input
                        id="company_tagline"
                        type="text"
                        name="company_tagline"
                        value="{{ old('company_tagline', $settings['company_tagline'] ?? '') }}"
                        maxlength="255"
                        placeholder="Contoh: Solusi Kulit & Produk Adonan Berkualitas"
                        class="w-full h-11 px-4 border rounded-[10px] text-[#1F2937] text-sm placeholder-[#6B7280]
                               focus:outline-none focus:ring-2 focus:ring-[#238B45] focus:border-[#238B45] transition-colors
                               {{ $errors->has('company_tagline') ? 'border-[#E11D48] ring-1 ring-[#E11D48]' : 'border-[#E5E7EB]' }}"
                    >
                    @error('company_tagline')
                        <p class="mt-1.5 text-xs text-[#E11D48]">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Footer Text --}}
                <div class="md:col-span-2">
                    <label for="footer_text" class="block text-sm font-semibold text-[#1F2937] mb-1.5">
                        Deskripsi Singkat Footer
                        <span class="text-[#6B7280] font-normal">(ditampilkan di bagian bawah website publik)</span>
                    </label>
                    <textarea
                        id="footer_text"
                        name="footer_text"
                        rows="2"
                        maxlength="1000"
                        placeholder="Deskripsi singkat mengenai bidang usaha perusahaan..."
                        class="w-full px-4 py-3 border rounded-[10px] text-[#1F2937] text-sm placeholder-[#6B7280] resize-none
                               focus:outline-none focus:ring-2 focus:ring-[#238B45] focus:border-[#238B45] transition-colors
                               {{ $errors->has('footer_text') ? 'border-[#E11D48] ring-1 ring-[#E11D48]' : 'border-[#E5E7EB]' }}"
                    >{{ old('footer_text', $settings['footer_text'] ?? '') }}</textarea>
                    @error('footer_text')
                        <p class="mt-1.5 text-xs text-[#E11D48]">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- ===== Card 2: Kontak & WhatsApp ===== --}}
        <div class="bg-white rounded-2xl border border-[#E5E7EB] p-6">
            <div class="flex items-center gap-3 mb-5 pb-3 border-b border-[#E5E7EB]">
                <div class="w-9 h-9 rounded-xl bg-[#EAF6EE] text-[#238B45] flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-[#163326] font-semibold text-base">Informasi Kontak & WhatsApp</h3>
                    <p class="text-xs text-[#6B7280]">Saluran komunikasi resmi untuk layanan pelanggan dan kemitraan.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                {{-- Email --}}
                <div>
                    <label for="company_email" class="block text-sm font-semibold text-[#1F2937] mb-1.5">
                        Email Resmi
                    </label>
                    <input
                        id="company_email"
                        type="email"
                        name="company_email"
                        value="{{ old('company_email', $settings['company_email'] ?? '') }}"
                        maxlength="255"
                        placeholder="info@aljamas.com"
                        class="w-full h-11 px-4 border rounded-[10px] text-[#1F2937] text-sm placeholder-[#6B7280]
                               focus:outline-none focus:ring-2 focus:ring-[#238B45] focus:border-[#238B45] transition-colors
                               {{ $errors->has('company_email') ? 'border-[#E11D48] ring-1 ring-[#E11D48]' : 'border-[#E5E7EB]' }}"
                    >
                    @error('company_email')
                        <p class="mt-1.5 text-xs text-[#E11D48]">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Phone --}}
                <div>
                    <label for="company_phone" class="block text-sm font-semibold text-[#1F2937] mb-1.5">
                        Nomor Telepon Kantor
                    </label>
                    <input
                        id="company_phone"
                        type="text"
                        name="company_phone"
                        value="{{ old('company_phone', $settings['company_phone'] ?? '') }}"
                        maxlength="50"
                        placeholder="021-00000000"
                        class="w-full h-11 px-4 border rounded-[10px] text-[#1F2937] text-sm placeholder-[#6B7280]
                               focus:outline-none focus:ring-2 focus:ring-[#238B45] focus:border-[#238B45] transition-colors
                               {{ $errors->has('company_phone') ? 'border-[#E11D48] ring-1 ring-[#E11D48]' : 'border-[#E5E7EB]' }}"
                    >
                    @error('company_phone')
                        <p class="mt-1.5 text-xs text-[#E11D48]">{{ $message }}</p>
                    @enderror
                </div>

                {{-- WhatsApp Number --}}
                <div>
                    <label for="whatsapp_number" class="block text-sm font-semibold text-[#1F2937] mb-1.5">
                        Nomor WhatsApp
                        <span class="text-[#6B7280] font-normal">(format: 628...)</span>
                    </label>
                    <input
                        id="whatsapp_number"
                        type="text"
                        name="whatsapp_number"
                        value="{{ old('whatsapp_number', $settings['whatsapp_number'] ?? '') }}"
                        maxlength="50"
                        placeholder="6281234567890"
                        class="w-full h-11 px-4 border rounded-[10px] text-[#1F2937] text-sm placeholder-[#6B7280]
                               focus:outline-none focus:ring-2 focus:ring-[#238B45] focus:border-[#238B45] transition-colors
                               {{ $errors->has('whatsapp_number') ? 'border-[#E11D48] ring-1 ring-[#E11D48]' : 'border-[#E5E7EB]' }}"
                    >
                    @error('whatsapp_number')
                        <p class="mt-1.5 text-xs text-[#E11D48]">{{ $message }}</p>
                    @enderror
                </div>

                {{-- WhatsApp Default Message --}}
                <div class="md:col-span-3">
                    <label for="whatsapp_default_message" class="block text-sm font-semibold text-[#1F2937] mb-1.5">
                        Pesan Otomatis WhatsApp (CTA Click-to-Chat)
                    </label>
                    <textarea
                        id="whatsapp_default_message"
                        name="whatsapp_default_message"
                        rows="2"
                        maxlength="500"
                        placeholder="Halo, saya ingin bertanya tentang produk Aljamas..."
                        class="w-full px-4 py-3 border rounded-[10px] text-[#1F2937] text-sm placeholder-[#6B7280] resize-none
                               focus:outline-none focus:ring-2 focus:ring-[#238B45] focus:border-[#238B45] transition-colors
                               {{ $errors->has('whatsapp_default_message') ? 'border-[#E11D48] ring-1 ring-[#E11D48]' : 'border-[#E5E7EB]' }}"
                    >{{ old('whatsapp_default_message', $settings['whatsapp_default_message'] ?? '') }}</textarea>
                    @error('whatsapp_default_message')
                        <p class="mt-1.5 text-xs text-[#E11D48]">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- ===== Card 3: Alamat & Lokasi ===== --}}
        <div class="bg-white rounded-2xl border border-[#E5E7EB] p-6">
            <div class="flex items-center gap-3 mb-5 pb-3 border-b border-[#E5E7EB]">
                <div class="w-9 h-9 rounded-xl bg-[#EAF6EE] text-[#238B45] flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-[#163326] font-semibold text-base">Alamat & Lokasi Pabrik / Kantor</h3>
                    <p class="text-xs text-[#6B7280]">Alamat fisik dan tautan Google Maps untuk navigasi pelanggan.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                {{-- Address --}}
                <div>
                    <label for="company_address" class="block text-sm font-semibold text-[#1F2937] mb-1.5">
                        Alamat Lengkap
                    </label>
                    <textarea
                        id="company_address"
                        name="company_address"
                        rows="3"
                        maxlength="1000"
                        placeholder="Jl. Contoh No. 1, Jakarta, Indonesia"
                        class="w-full px-4 py-3 border rounded-[10px] text-[#1F2937] text-sm placeholder-[#6B7280] resize-none
                               focus:outline-none focus:ring-2 focus:ring-[#238B45] focus:border-[#238B45] transition-colors
                               {{ $errors->has('company_address') ? 'border-[#E11D48] ring-1 ring-[#E11D48]' : 'border-[#E5E7EB]' }}"
                    >{{ old('company_address', $settings['company_address'] ?? '') }}</textarea>
                    @error('company_address')
                        <p class="mt-1.5 text-xs text-[#E11D48]">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Google Maps URL --}}
                <div>
                    <label for="google_maps" class="block text-sm font-semibold text-[#1F2937] mb-1.5">
                        Tautan Google Maps / Embed URL
                    </label>
                    <textarea
                        id="google_maps"
                        name="google_maps"
                        rows="3"
                        maxlength="1000"
                        placeholder="https://maps.google.com/..."
                        class="w-full px-4 py-3 border rounded-[10px] text-[#1F2937] text-sm placeholder-[#6B7280] resize-none
                               focus:outline-none focus:ring-2 focus:ring-[#238B45] focus:border-[#238B45] transition-colors
                               {{ $errors->has('google_maps') ? 'border-[#E11D48] ring-1 ring-[#E11D48]' : 'border-[#E5E7EB]' }}"
                    >{{ old('google_maps', $settings['google_maps'] ?? '') }}</textarea>
                    @error('google_maps')
                        <p class="mt-1.5 text-xs text-[#E11D48]">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- ===== Card 4: Media Sosial ===== --}}
        <div class="bg-white rounded-2xl border border-[#E5E7EB] p-6">
            <div class="flex items-center gap-3 mb-5 pb-3 border-b border-[#E5E7EB]">
                <div class="w-9 h-9 rounded-xl bg-[#EAF6EE] text-[#238B45] flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-[#163326] font-semibold text-base">Media Sosial</h3>
                    <p class="text-xs text-[#6B7280]">Tautan profil media sosial resmi Aljamas (gunakan URL lengkap dengan https://).</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                {{-- Instagram --}}
                <div>
                    <label for="instagram_url" class="block text-sm font-semibold text-[#1F2937] mb-1.5">
                        Instagram URL
                    </label>
                    <input
                        id="instagram_url"
                        type="url"
                        name="instagram_url"
                        value="{{ old('instagram_url', $settings['instagram_url'] ?? '') }}"
                        maxlength="500"
                        placeholder="https://instagram.com/aljamas"
                        class="w-full h-11 px-4 border rounded-[10px] text-[#1F2937] text-sm placeholder-[#6B7280]
                               focus:outline-none focus:ring-2 focus:ring-[#238B45] focus:border-[#238B45] transition-colors
                               {{ $errors->has('instagram_url') ? 'border-[#E11D48] ring-1 ring-[#E11D48]' : 'border-[#E5E7EB]' }}"
                    >
                    @error('instagram_url')
                        <p class="mt-1.5 text-xs text-[#E11D48]">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Facebook --}}
                <div>
                    <label for="facebook_url" class="block text-sm font-semibold text-[#1F2937] mb-1.5">
                        Facebook URL
                    </label>
                    <input
                        id="facebook_url"
                        type="url"
                        name="facebook_url"
                        value="{{ old('facebook_url', $settings['facebook_url'] ?? '') }}"
                        maxlength="500"
                        placeholder="https://facebook.com/aljamas"
                        class="w-full h-11 px-4 border rounded-[10px] text-[#1F2937] text-sm placeholder-[#6B7280]
                               focus:outline-none focus:ring-2 focus:ring-[#238B45] focus:border-[#238B45] transition-colors
                               {{ $errors->has('facebook_url') ? 'border-[#E11D48] ring-1 ring-[#E11D48]' : 'border-[#E5E7EB]' }}"
                    >
                    @error('facebook_url')
                        <p class="mt-1.5 text-xs text-[#E11D48]">{{ $message }}</p>
                    @enderror
                </div>

                {{-- TikTok --}}
                <div>
                    <label for="tiktok_url" class="block text-sm font-semibold text-[#1F2937] mb-1.5">
                        TikTok URL
                    </label>
                    <input
                        id="tiktok_url"
                        type="url"
                        name="tiktok_url"
                        value="{{ old('tiktok_url', $settings['tiktok_url'] ?? '') }}"
                        maxlength="500"
                        placeholder="https://tiktok.com/@aljamas"
                        class="w-full h-11 px-4 border rounded-[10px] text-[#1F2937] text-sm placeholder-[#6B7280]
                               focus:outline-none focus:ring-2 focus:ring-[#238B45] focus:border-[#238B45] transition-colors
                               {{ $errors->has('tiktok_url') ? 'border-[#E11D48] ring-1 ring-[#E11D48]' : 'border-[#E5E7EB]' }}"
                    >
                    @error('tiktok_url')
                        <p class="mt-1.5 text-xs text-[#E11D48]">{{ $message }}</p>
                    @enderror
                </div>

                {{-- YouTube --}}
                <div>
                    <label for="youtube_url" class="block text-sm font-semibold text-[#1F2937] mb-1.5">
                        YouTube URL
                    </label>
                    <input
                        id="youtube_url"
                        type="url"
                        name="youtube_url"
                        value="{{ old('youtube_url', $settings['youtube_url'] ?? '') }}"
                        maxlength="500"
                        placeholder="https://youtube.com/@aljamas"
                        class="w-full h-11 px-4 border rounded-[10px] text-[#1F2937] text-sm placeholder-[#6B7280]
                               focus:outline-none focus:ring-2 focus:ring-[#238B45] focus:border-[#238B45] transition-colors
                               {{ $errors->has('youtube_url') ? 'border-[#E11D48] ring-1 ring-[#E11D48]' : 'border-[#E5E7EB]' }}"
                    >
                    @error('youtube_url')
                        <p class="mt-1.5 text-xs text-[#E11D48]">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- ===== Submit Button ===== --}}
        <div class="flex items-center justify-end pt-2">
            <button type="submit"
                    class="h-11 px-8 bg-[#238B45] hover:bg-[#1E7A3B] text-white text-sm font-semibold rounded-[10px]
                           shadow-sm hover:shadow transition-all duration-200 flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>
                Simpan Pengaturan
            </button>
        </div>

    </div>
</form>

@endsection
