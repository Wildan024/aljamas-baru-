{{--
  Partial: _form.blade.php
  Digunakan bersama oleh create.blade.php dan edit.blade.php.
  Variabel yang diharapkan:
    - $product  : instance Product (untuk edit) atau new Product (untuk create)
    - $categories : Collection<Category>
    - $action   : string URL form action
    - $method   : 'POST' | 'PUT'
--}}

<form method="POST"
      action="{{ $action }}"
      enctype="multipart/form-data"
      id="product-form"
      novalidate>
    @csrf
    @if ($method === 'PUT')
        @method('PUT')
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- ===== Kolom Kiri (2/3): Info Utama ===== --}}
        <div class="lg:col-span-2 space-y-5">

            {{-- Card: Informasi Produk --}}
            <div class="bg-white rounded-2xl border border-[#E5E7EB] p-6">
                <h3 class="text-[#163326] font-semibold text-base mb-5">Informasi Produk</h3>

                {{-- Name --}}
                <div class="mb-5">
                    <label for="name" class="block text-sm font-semibold text-[#1F2937] mb-1.5">
                        Nama Produk <span class="text-[#E11D48]">*</span>
                    </label>
                    <input
                        id="name"
                        type="text"
                        name="name"
                        value="{{ old('name', $product->name ?? '') }}"
                        required
                        maxlength="255"
                        placeholder="Contoh: Kulit Dimsum Premium 50 Lembar"
                        class="w-full h-11 px-4 border rounded-[10px] text-[#1F2937] text-sm placeholder-[#6B7280]
                               focus:outline-none focus:ring-2 focus:ring-[#238B45] focus:border-[#238B45] transition-colors
                               {{ $errors->has('name') ? 'border-[#E11D48] ring-1 ring-[#E11D48]' : 'border-[#E5E7EB]' }}"
                    >
                    @error('name')
                        <p class="mt-1.5 text-xs text-[#E11D48]">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Short Description --}}
                <div class="mb-5">
                    <label for="short_description" class="block text-sm font-semibold text-[#1F2937] mb-1.5">
                        Ringkasan Singkat
                        <span class="text-[#6B7280] font-normal">(untuk card preview katalog)</span>
                    </label>
                    <textarea
                        id="short_description"
                        name="short_description"
                        rows="2"
                        maxlength="500"
                        placeholder="Ringkasan 1-2 kalimat yang ditampilkan di halaman katalog produk..."
                        class="w-full px-4 py-3 border rounded-[10px] text-[#1F2937] text-sm placeholder-[#6B7280] resize-none
                               focus:outline-none focus:ring-2 focus:ring-[#238B45] focus:border-[#238B45] transition-colors
                               {{ $errors->has('short_description') ? 'border-[#E11D48] ring-1 ring-[#E11D48]' : 'border-[#E5E7EB]' }}"
                    >{{ old('short_description', $product->short_description ?? '') }}</textarea>
                    <p class="mt-1 text-xs text-[#6B7280]">Maks. 500 karakter</p>
                    @error('short_description')
                        <p class="mt-1 text-xs text-[#E11D48]">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Description --}}
                <div>
                    <label for="description" class="block text-sm font-semibold text-[#1F2937] mb-1.5">
                        Deskripsi Lengkap
                        <span class="text-[#6B7280] font-normal">(spesifikasi, komposisi, keunggulan)</span>
                    </label>
                    <textarea
                        id="description"
                        name="description"
                        rows="8"
                        placeholder="Tulis deskripsi lengkap produk di sini..."
                        class="w-full px-4 py-3 border rounded-[10px] text-[#1F2937] text-sm placeholder-[#6B7280] resize-y
                               focus:outline-none focus:ring-2 focus:ring-[#238B45] focus:border-[#238B45] transition-colors
                               {{ $errors->has('description') ? 'border-[#E11D48] ring-1 ring-[#E11D48]' : 'border-[#E5E7EB]' }}"
                    >{{ old('description', $product->description ?? '') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-xs text-[#E11D48]">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Card: Gambar Produk --}}
            <div class="bg-white rounded-2xl border border-[#E5E7EB] p-6">
                <h3 class="text-[#163326] font-semibold text-base mb-5">Gambar Produk</h3>

                {{-- Existing image preview --}}
                @if (!empty($product->image))
                    <div class="mb-4" id="current-image-container">
                        <p class="text-xs font-semibold text-[#6B7280] uppercase tracking-wider mb-2">Gambar Saat Ini</p>
                        <div class="relative inline-block">
                            <img src="{{ Storage::disk('public')->url($product->image) }}"
                                 alt="{{ $product->name }}"
                                 id="current-image"
                                 class="w-40 h-40 object-cover rounded-xl border border-[#E5E7EB]"
                                 loading="lazy">
                        </div>
                        <p class="text-xs text-[#6B7280] mt-2">Upload gambar baru untuk menggantikan gambar di atas.</p>
                    </div>
                @endif

                {{-- Upload input --}}
                <div>
                    <label for="image" class="block text-sm font-semibold text-[#1F2937] mb-1.5">
                        {{ !empty($product->image) ? 'Ganti Gambar' : 'Upload Gambar' }}
                    </label>

                    {{-- Drop zone --}}
                    <label for="image"
                           id="image-dropzone"
                           class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed rounded-xl cursor-pointer
                                  transition-colors duration-150
                                  {{ $errors->has('image') ? 'border-[#E11D48] bg-red-50' : 'border-[#E5E7EB] bg-[#F7FAF8] hover:border-[#238B45] hover:bg-[#EAF6EE]' }}">

                        {{-- Preview setelah pilih file --}}
                        <img id="image-preview"
                             src=""
                             alt="Preview"
                             class="hidden w-full h-full object-cover rounded-xl">

                        <div id="image-placeholder" class="flex flex-col items-center justify-center">
                            <svg class="w-8 h-8 text-[#6B7280] mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
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

                    @error('image')
                        <p class="mt-1.5 text-xs text-[#E11D48]">{{ $message }}</p>
                    @enderror
                </div>
            </div>

        </div>

        {{-- ===== Kolom Kanan (1/3): Pengaturan ===== --}}
        <div class="space-y-5">

            {{-- Card: Pengaturan Publish --}}
            <div class="bg-white rounded-2xl border border-[#E5E7EB] p-6">
                <h3 class="text-[#163326] font-semibold text-base mb-5">Pengaturan</h3>

                {{-- Category --}}
                <div class="mb-5">
                    <label for="category_id" class="block text-sm font-semibold text-[#1F2937] mb-1.5">
                        Kategori Produk
                    </label>
                    <select
                        id="category_id"
                        name="category_id"
                        class="w-full h-11 px-4 border rounded-[10px] text-[#1F2937] text-sm bg-white
                               focus:outline-none focus:ring-2 focus:ring-[#238B45] focus:border-[#238B45] transition-colors
                               {{ $errors->has('category_id') ? 'border-[#E11D48] ring-1 ring-[#E11D48]' : 'border-[#E5E7EB]' }}">
                        <option value="">— Tanpa Kategori —</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                    {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="mt-1.5 text-xs text-[#E11D48]">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Sort Order --}}
                <div class="mb-5">
                    <label for="sort_order" class="block text-sm font-semibold text-[#1F2937] mb-1.5">
                        Urutan Tampil
                        <span class="text-[#6B7280] font-normal">(angka lebih kecil = lebih atas)</span>
                    </label>
                    <input
                        id="sort_order"
                        type="number"
                        name="sort_order"
                        value="{{ old('sort_order', $product->sort_order ?? 0) }}"
                        min="0"
                        class="w-full h-11 px-4 border rounded-[10px] text-[#1F2937] text-sm
                               focus:outline-none focus:ring-2 focus:ring-[#238B45] focus:border-[#238B45] transition-colors
                               {{ $errors->has('sort_order') ? 'border-[#E11D48] ring-1 ring-[#E11D48]' : 'border-[#E5E7EB]' }}">
                    @error('sort_order')
                        <p class="mt-1.5 text-xs text-[#E11D48]">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Status --}}
                <div>
                    <p class="text-sm font-semibold text-[#1F2937] mb-3">Status Publikasi</p>
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <div class="relative">
                            <input type="hidden" name="is_active" value="0">
                            <input
                                id="is_active"
                                type="checkbox"
                                name="is_active"
                                value="1"
                                {{ old('is_active', $product->is_active ?? true) ? 'checked' : '' }}
                                class="sr-only peer">
                            <div class="w-11 h-6 bg-[#E5E7EB] rounded-full transition-colors duration-200 peer-checked:bg-[#238B45]"></div>
                            <div class="absolute top-0.5 left-0.5 w-5 h-5 bg-white rounded-full shadow transition-transform duration-200 peer-checked:translate-x-5"></div>
                        </div>
                        <span class="text-sm text-[#1F2937] font-medium group-hover:text-[#238B45] transition-colors">
                            Tampilkan di halaman publik
                        </span>
                    </label>
                    <p class="text-xs text-[#6B7280] mt-2">Produk nonaktif tidak akan tampil di katalog publik.</p>
                </div>

            </div>

            {{-- Slug info (edit only) --}}
            @if (!empty($product->slug))
                <div class="bg-[#F7FAF8] rounded-2xl border border-[#E5E7EB] p-4">
                    <p class="text-xs font-semibold text-[#6B7280] uppercase tracking-wider mb-2">URL Slug</p>
                    <p class="text-xs text-[#1F2937] font-mono break-all">/produk/{{ $product->slug }}</p>
                    <p class="text-xs text-[#6B7280] mt-2">Slug permanen untuk menjaga stabilitas SEO.</p>
                </div>
            @endif

            {{-- Action Buttons --}}
            <div class="flex flex-col gap-3">
                <button type="submit"
                        class="w-full h-11 bg-[#238B45] hover:bg-[#1E7A3B] text-white font-semibold rounded-[10px]
                               shadow-sm hover:shadow transition-all duration-200 flex items-center justify-center gap-2 text-sm">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                    {{ $method === 'PUT' ? 'Simpan Perubahan' : 'Tambah Produk' }}
                </button>
                <a href="{{ route('admin.products.index') }}"
                   class="w-full h-11 border border-[#E5E7EB] hover:border-[#238B45] text-[#6B7280] hover:text-[#238B45] font-semibold rounded-[10px]
                          transition-all duration-200 flex items-center justify-center gap-2 text-sm">
                    Batal
                </a>
            </div>

        </div>
    </div>

</form>

{{-- Image preview script --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('image');
    const preview = document.getElementById('image-preview');
    const placeholder = document.getElementById('image-placeholder');

    if (input) {
        input.addEventListener('change', function () {
            const file = this.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                if (placeholder) placeholder.classList.add('hidden');
            };
            reader.readAsDataURL(file);
        });
    }
});
</script>
