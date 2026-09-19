{{--
  Partial: _form.blade.php
  Digunakan bersama oleh create.blade.php dan edit.blade.php
--}}

<form method="POST"
      action="{{ $action }}"
      enctype="multipart/form-data"
      id="partner-form"
      novalidate>
    @csrf
    @if ($method === 'PUT')
        @method('PUT')
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- ===== Kolom Kiri (2/3): Info Utama & Logo ===== --}}
        <div class="lg:col-span-2 space-y-5">

            {{-- Card: Informasi Partner --}}
            <div class="bg-white rounded-2xl border border-[#E5E7EB] p-6">
                <h3 class="text-[#163326] font-semibold text-base mb-5">Informasi Partner</h3>

                {{-- Name --}}
                <div class="mb-5">
                    <label for="name" class="block text-sm font-semibold text-[#1F2937] mb-1.5">
                        Nama Partner E-Commerce <span class="text-[#E11D48]">*</span>
                    </label>
                    <input
                        id="name"
                        type="text"
                        name="name"
                        value="{{ old('name', $ecommercePartner->name ?? '') }}"
                        required
                        maxlength="255"
                        placeholder="Contoh: Shopee, Tokopedia, TikTok Shop, Lazada"
                        class="w-full h-11 px-4 border rounded-[10px] text-[#1F2937] text-sm placeholder-[#6B7280]
                               focus:outline-none focus:ring-2 focus:ring-[#238B45] focus:border-[#238B45] transition-colors
                               {{ $errors->has('name') ? 'border-[#E11D48] ring-1 ring-[#E11D48]' : 'border-[#E5E7EB]' }}"
                    >
                    @error('name')
                        <p class="mt-1.5 text-xs text-[#E11D48]">{{ $message }}</p>
                    @enderror
                </div>

                {{-- URL --}}
                <div>
                    <label for="url" class="block text-sm font-semibold text-[#1F2937] mb-1.5">
                        Tautan / URL Toko <span class="text-[#E11D48]">*</span>
                    </label>
                    <input
                        id="url"
                        type="url"
                        name="url"
                        value="{{ old('url', $ecommercePartner->url ?? '') }}"
                        required
                        maxlength="500"
                        placeholder="https://shopee.co.id/toko-aljamas"
                        class="w-full h-11 px-4 border rounded-[10px] text-[#1F2937] text-sm placeholder-[#6B7280]
                               focus:outline-none focus:ring-2 focus:ring-[#238B45] focus:border-[#238B45] transition-colors
                               {{ $errors->has('url') ? 'border-[#E11D48] ring-1 ring-[#E11D48]' : 'border-[#E5E7EB]' }}"
                    >
                    <p class="text-xs text-[#6B7280] mt-1.5">Harus diawali dengan http:// atau https://</p>
                    @error('url')
                        <p class="mt-1.5 text-xs text-[#E11D48]">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Card: Upload Logo/Icon --}}
            <div class="bg-white rounded-2xl border border-[#E5E7EB] p-6">
                <h3 class="text-[#163326] font-semibold text-base mb-2">Logo / Ikon Partner</h3>
                <p class="text-xs text-[#6B7280] mb-5">Opsional. Jika tidak diunggah, tombol partner akan menampilkan ikon toko bawaan yang konsisten.</p>

                {{-- Existing Logo preview (edit mode) --}}
                @if (!empty($ecommercePartner->logo))
                    <div class="mb-5 flex items-center gap-4 p-4 rounded-xl bg-[#F7FAF8] border border-[#E5E7EB]">
                        <div class="w-14 h-14 rounded-xl bg-white border border-[#E5E7EB] p-2 flex items-center justify-center flex-shrink-0">
                            <img src="{{ Storage::disk('public')->url($ecommercePartner->logo) }}"
                                 alt="{{ $ecommercePartner->name }}"
                                 class="max-w-full max-h-full object-contain">
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-[#163326]">Logo Saat Ini</p>
                            <p class="text-xs text-[#6B7280] mt-0.5">Unggah gambar baru di bawah untuk mengganti logo ini.</p>
                        </div>
                    </div>
                @endif

                {{-- Upload input --}}
                <div>
                    <label for="logo"
                           id="partner-logo-dropzone"
                           class="flex flex-col items-center justify-center w-full h-44 border-2 border-dashed rounded-xl cursor-pointer
                                  transition-colors duration-150
                                  {{ $errors->has('logo') ? 'border-[#E11D48] bg-red-50' : 'border-[#E5E7EB] bg-[#F7FAF8] hover:border-[#238B45] hover:bg-[#EAF6EE]' }}">

                        <div id="partner-logo-preview-container" class="hidden w-24 h-24 p-2 bg-white rounded-xl border border-[#E5E7EB] flex items-center justify-center mb-2">
                            <img id="partner-logo-preview" src="" alt="Preview" class="max-w-full max-h-full object-contain">
                        </div>

                        <div id="partner-logo-placeholder" class="flex flex-col items-center justify-center">
                            <svg class="w-9 h-9 text-[#6B7280] mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <p class="text-sm text-[#6B7280]"><span class="font-semibold text-[#238B45]">Pilih logo</span> atau seret file ke sini</p>
                            <p class="text-xs text-[#6B7280] mt-1">PNG, JPG, WebP, SVG — Maks. 2 MB</p>
                        </div>
                    </label>

                    <input id="logo"
                           type="file"
                           name="logo"
                           accept="image/png,image/jpeg,image/webp,image/svg+xml"
                           class="sr-only">

                    <p id="partner-logo-info" class="hidden mt-2 text-xs text-[#238B45] font-medium"></p>

                    @error('logo')
                        <p class="mt-1.5 text-xs text-[#E11D48]">{{ $message }}</p>
                    @enderror
                </div>
            </div>

        </div>

        {{-- ===== Kolom Kanan (1/3): Pengaturan Status & Urutan ===== --}}
        <div class="space-y-5">

            {{-- Card: Pengaturan --}}
            <div class="bg-white rounded-2xl border border-[#E5E7EB] p-6">
                <h3 class="text-[#163326] font-semibold text-base mb-5">Pengaturan Tampil</h3>

                {{-- Status Aktif (toggle switch) --}}
                <div class="mb-6">
                    <p class="text-sm font-semibold text-[#1F2937] mb-3">Status Partner</p>
                    <label class="flex items-center gap-3 cursor-pointer select-none">
                        <div class="relative">
                            <input type="hidden" name="is_active" value="0">
                            <input
                                type="checkbox"
                                id="is_active"
                                name="is_active"
                                value="1"
                                class="sr-only peer"
                                {{ old('is_active', $ecommercePartner->is_active ?? true) ? 'checked' : '' }}
                            >
                            <div class="w-10 h-6 bg-[#E5E7EB] peer-checked:bg-[#238B45] rounded-full transition-colors duration-200"></div>
                            <div class="absolute top-0.5 left-0.5 w-5 h-5 bg-white rounded-full shadow transition-transform duration-200 peer-checked:translate-x-4"></div>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-[#1F2937]" id="is-active-label">
                                {{ old('is_active', $ecommercePartner->is_active ?? true) ? 'Aktif' : 'Nonaktif' }}
                            </p>
                            <p class="text-xs text-[#6B7280]">Tampil di beranda publik</p>
                        </div>
                    </label>
                </div>

                {{-- Sort Order --}}
                <div>
                    <label for="sort_order" class="block text-sm font-semibold text-[#1F2937] mb-1.5">
                        Urutan Tampil
                    </label>
                    <input
                        id="sort_order"
                        type="number"
                        name="sort_order"
                        value="{{ old('sort_order', $ecommercePartner->sort_order ?? 0) }}"
                        min="0"
                        step="1"
                        class="w-full h-11 px-4 border rounded-[10px] text-[#1F2937] text-sm
                               focus:outline-none focus:ring-2 focus:ring-[#238B45] focus:border-[#238B45] transition-colors
                               {{ $errors->has('sort_order') ? 'border-[#E11D48] ring-1 ring-[#E11D48]' : 'border-[#E5E7EB]' }}">
                    <p class="text-xs text-[#6B7280] mt-1.5">Urutan terkecil (1, 2, 3) akan muncul paling kiri.</p>
                    @error('sort_order')
                        <p class="mt-1 text-xs text-[#E11D48]">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="flex flex-col gap-3">
                <button type="submit"
                        class="w-full h-11 bg-[#238B45] hover:bg-[#1E7A3B] text-white font-semibold rounded-[10px]
                               shadow-sm hover:shadow transition-all duration-200 flex items-center justify-center gap-2 text-sm">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                    {{ $method === 'PUT' ? 'Perbarui Partner' : 'Simpan Partner' }}
                </button>

                <a href="{{ route('admin.ecommerce-partners.index') }}"
                   class="w-full h-11 bg-white hover:bg-[#F7FAF8] border border-[#E5E7EB] text-[#1F2937] font-semibold rounded-[10px]
                          transition-all duration-200 flex items-center justify-center text-sm">
                    Batal
                </a>
            </div>

        </div>

    </div>
</form>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const fileInput = document.getElementById('logo');
    const previewContainer = document.getElementById('partner-logo-preview-container');
    const previewImg = document.getElementById('partner-logo-preview');
    const placeholder = document.getElementById('partner-logo-placeholder');
    const fileInfo = document.getElementById('partner-logo-info');
    const toggleCheckbox = document.getElementById('is_active');
    const toggleLabel = document.getElementById('is-active-label');

    if (toggleCheckbox && toggleLabel) {
        toggleCheckbox.addEventListener('change', function () {
            toggleLabel.textContent = this.checked ? 'Aktif' : 'Nonaktif';
        });
    }

    if (fileInput) {
        fileInput.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewImg.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                };
                reader.readAsDataURL(file);
                fileInfo.textContent = `File terpilih: ${file.name} (${(file.size / 1024).toFixed(1)} KB)`;
                fileInfo.classList.remove('hidden');
            }
        });
    }
});
</script>
