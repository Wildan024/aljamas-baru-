{{--
  Partial: _form.blade.php
  Digunakan bersama oleh create.blade.php dan edit.blade.php.
  Variabel yang diharapkan:
    - $gallery : instance Gallery (untuk edit) atau new Gallery (untuk create)
    - $action  : string URL form action
    - $method  : 'POST' | 'PUT'
--}}

<form method="POST"
      action="{{ $action }}"
      enctype="multipart/form-data"
      id="gallery-form"
      novalidate>
    @csrf
    @if ($method === 'PUT')
        @method('PUT')
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- ===== Kolom Kiri (2/3): Upload & Info ===== --}}
        <div class="lg:col-span-2 space-y-5">

            {{-- Card: Upload Foto --}}
            <div class="bg-white rounded-2xl border border-[#E5E7EB] p-6">
                <h3 class="text-[#163326] font-semibold text-base mb-5">Foto Galeri</h3>

                {{-- Existing image preview (edit mode) --}}
                @if (!empty($gallery->image))
                    <div class="mb-5">
                        <p class="text-xs font-semibold text-[#6B7280] uppercase tracking-wider mb-2">Foto Saat Ini</p>
                        <div class="relative inline-block">
                            <img src="{{ Storage::disk('public')->url($gallery->image) }}"
                                 alt="{{ $gallery->title ?? 'Foto galeri' }}"
                                 class="w-48 h-36 object-cover rounded-xl border border-[#E5E7EB]"
                                 loading="lazy">
                        </div>
                        <p class="text-xs text-[#6B7280] mt-2">Upload foto baru untuk menggantikan gambar di atas.</p>
                    </div>
                @endif

                {{-- Upload input --}}
                <div>
                    <label for="image" class="block text-sm font-semibold text-[#1F2937] mb-1.5">
                        {{ !empty($gallery->image) ? 'Ganti Foto' : 'Upload Foto' }}
                        @if (empty($gallery->image))
                            <span class="text-[#E11D48]">*</span>
                        @endif
                    </label>

                    {{-- Drop zone --}}
                    <label for="image"
                           id="gallery-image-dropzone"
                           class="flex flex-col items-center justify-center w-full h-52 border-2 border-dashed rounded-xl cursor-pointer
                                  transition-colors duration-150
                                  {{ $errors->has('image') ? 'border-[#E11D48] bg-red-50' : 'border-[#E5E7EB] bg-[#F7FAF8] hover:border-[#238B45] hover:bg-[#EAF6EE]' }}">

                        <img id="gallery-image-preview"
                             src=""
                             alt="Preview"
                             class="hidden w-full h-full object-cover rounded-xl">

                        <div id="gallery-image-placeholder" class="flex flex-col items-center justify-center">
                            <svg class="w-10 h-10 text-[#6B7280] mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <p class="text-sm text-[#6B7280]"><span class="font-semibold text-[#238B45]">Klik untuk pilih</span> atau drag & drop</p>
                            <p class="text-xs text-[#6B7280] mt-1">JPG, PNG, WebP — Maks. 2 MB</p>
                        </div>
                    </label>

                    <input id="image"
                           type="file"
                           name="image"
                           accept="image/jpeg,image/png,image/webp"
                           class="sr-only">

                    {{-- File info setelah dipilih --}}
                    <p id="gallery-file-info" class="hidden mt-2 text-xs text-[#238B45] font-medium"></p>

                    @error('image')
                        <p class="mt-1.5 text-xs text-[#E11D48]">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Card: Informasi Foto --}}
            <div class="bg-white rounded-2xl border border-[#E5E7EB] p-6">
                <h3 class="text-[#163326] font-semibold text-base mb-5">Informasi Foto</h3>

                {{-- Title --}}
                <div class="mb-5">
                    <label for="title" class="block text-sm font-semibold text-[#1F2937] mb-1.5">
                        Judul
                        <span class="text-[#6B7280] font-normal">(opsional)</span>
                    </label>
                    <input
                        id="title"
                        type="text"
                        name="title"
                        value="{{ old('title', $gallery->title ?? '') }}"
                        maxlength="255"
                        placeholder="Contoh: Proses Produksi Kulit Dimsum"
                        class="w-full h-11 px-4 border rounded-[10px] text-[#1F2937] text-sm placeholder-[#6B7280]
                               focus:outline-none focus:ring-2 focus:ring-[#238B45] focus:border-[#238B45] transition-colors
                               {{ $errors->has('title') ? 'border-[#E11D48] ring-1 ring-[#E11D48]' : 'border-[#E5E7EB]' }}"
                    >
                    @error('title')
                        <p class="mt-1.5 text-xs text-[#E11D48]">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Description --}}
                <div>
                    <label for="description" class="block text-sm font-semibold text-[#1F2937] mb-1.5">
                        Deskripsi
                        <span class="text-[#6B7280] font-normal">(opsional)</span>
                    </label>
                    <textarea
                        id="description"
                        name="description"
                        rows="3"
                        maxlength="1000"
                        placeholder="Keterangan singkat tentang foto ini..."
                        class="w-full px-4 py-3 border rounded-[10px] text-[#1F2937] text-sm placeholder-[#6B7280] resize-none
                               focus:outline-none focus:ring-2 focus:ring-[#238B45] focus:border-[#238B45] transition-colors
                               {{ $errors->has('description') ? 'border-[#E11D48] ring-1 ring-[#E11D48]' : 'border-[#E5E7EB]' }}"
                    >{{ old('description', $gallery->description ?? '') }}</textarea>
                    <p class="mt-1 text-xs text-[#6B7280]">Maks. 1000 karakter</p>
                    @error('description')
                        <p class="mt-1 text-xs text-[#E11D48]">{{ $message }}</p>
                    @enderror
                </div>
            </div>

        </div>

        {{-- ===== Kolom Kanan (1/3): Pengaturan ===== --}}
        <div class="space-y-5">

            {{-- Card: Pengaturan --}}
            <div class="bg-white rounded-2xl border border-[#E5E7EB] p-6">
                <h3 class="text-[#163326] font-semibold text-base mb-5">Pengaturan</h3>

                {{-- Status (toggle switch) --}}
                <div class="mb-6">
                    <p class="text-sm font-semibold text-[#1F2937] mb-3">Status Tampil</p>
                    <label class="flex items-center gap-3 cursor-pointer select-none">
                        <div class="relative">
                            <input type="hidden" name="is_active" value="0">
                            <input
                                type="checkbox"
                                id="is_active"
                                name="is_active"
                                value="1"
                                class="sr-only peer"
                                {{ old('is_active', $gallery->is_active ?? true) ? 'checked' : '' }}
                            >
                            <div class="w-10 h-6 bg-[#E5E7EB] peer-checked:bg-[#238B45] rounded-full transition-colors duration-200"></div>
                            <div class="absolute top-0.5 left-0.5 w-5 h-5 bg-white rounded-full shadow transition-transform duration-200 peer-checked:translate-x-4"></div>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-[#1F2937]" id="is-active-label">
                                {{ old('is_active', $gallery->is_active ?? true) ? 'Aktif' : 'Nonaktif' }}
                            </p>
                            <p class="text-xs text-[#6B7280]">Tampil di halaman publik</p>
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
                        value="{{ old('sort_order', $gallery->sort_order ?? 0) }}"
                        min="0"
                        step="1"
                        class="w-full h-11 px-4 border rounded-[10px] text-[#1F2937] text-sm
                               focus:outline-none focus:ring-2 focus:ring-[#238B45] focus:border-[#238B45] transition-colors
                               {{ $errors->has('sort_order') ? 'border-[#E11D48] ring-1 ring-[#E11D48]' : 'border-[#E5E7EB]' }}">
                    <p class="text-xs text-[#6B7280] mt-1.5">Angka lebih kecil ditampilkan lebih awal.</p>
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
                    {{ $method === 'PUT' ? 'Simpan Perubahan' : 'Tambah Foto' }}
                </button>
                <a href="{{ route('admin.galleries.index') }}"
                   class="w-full h-11 border border-[#E5E7EB] hover:border-[#238B45] text-[#6B7280] hover:text-[#238B45] font-semibold rounded-[10px]
                          transition-all duration-200 flex items-center justify-center gap-2 text-sm">
                    Batal
                </a>
            </div>

        </div>
    </div>

</form>

{{-- Vanilla JS: image preview + toggle label --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    // ---- Image Preview ----
    const input       = document.getElementById('image');
    const preview     = document.getElementById('gallery-image-preview');
    const placeholder = document.getElementById('gallery-image-placeholder');
    const fileInfo    = document.getElementById('gallery-file-info');

    if (input) {
        input.addEventListener('change', function () {
            const file = this.files[0];
            if (!file) return;

            // Preview
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                if (placeholder) placeholder.classList.add('hidden');
            };
            reader.readAsDataURL(file);

            // File info (nama + ukuran)
            const sizeMB = (file.size / 1024 / 1024).toFixed(2);
            if (fileInfo) {
                fileInfo.textContent = file.name + ' (' + sizeMB + ' MB)';
                fileInfo.classList.remove('hidden');
            }
        });
    }

    // ---- Toggle label ----
    const toggle    = document.getElementById('is_active');
    const label     = document.getElementById('is-active-label');

    if (toggle && label) {
        toggle.addEventListener('change', function () {
            label.textContent = this.checked ? 'Aktif' : 'Nonaktif';
        });
    }
});
</script>
