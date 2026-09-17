{{--
  Partial: _form.blade.php
  Digunakan bersama oleh create.blade.php dan edit.blade.php.
  Variabel yang diharapkan:
    - $blog       : instance Blog (untuk edit) atau new Blog (untuk create)
    - $categories : Collection<Category> — hanya type='blog'
    - $action     : string URL form action
    - $method     : 'POST' | 'PUT'
--}}

<form method="POST"
      action="{{ $action }}"
      enctype="multipart/form-data"
      id="blog-form"
      novalidate>
    @csrf
    @if ($method === 'PUT')
        @method('PUT')
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- ===== Kolom Kiri (2/3): Konten Utama ===== --}}
        <div class="lg:col-span-2 space-y-5">

            {{-- Card: Informasi Artikel --}}
            <div class="bg-white rounded-2xl border border-[#E5E7EB] p-6">
                <h3 class="text-[#163326] font-semibold text-base mb-5">Informasi Artikel</h3>

                {{-- Title --}}
                <div class="mb-5">
                    <label for="title" class="block text-sm font-semibold text-[#1F2937] mb-1.5">
                        Judul Artikel <span class="text-[#E11D48]">*</span>
                    </label>
                    <input
                        id="title"
                        type="text"
                        name="title"
                        value="{{ old('title', $blog->title ?? '') }}"
                        required
                        maxlength="255"
                        placeholder="Contoh: Tips Membuat Dimsum yang Sempurna"
                        class="w-full h-11 px-4 border rounded-[10px] text-[#1F2937] text-sm placeholder-[#6B7280]
                               focus:outline-none focus:ring-2 focus:ring-[#238B45] focus:border-[#238B45] transition-colors
                               {{ $errors->has('title') ? 'border-[#E11D48] ring-1 ring-[#E11D48]' : 'border-[#E5E7EB]' }}"
                    >
                    @error('title')
                        <p class="mt-1.5 text-xs text-[#E11D48]">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Excerpt --}}
                <div class="mb-5">
                    <label for="excerpt" class="block text-sm font-semibold text-[#1F2937] mb-1.5">
                        Ringkasan (Excerpt)
                        <span class="text-[#6B7280] font-normal">(ditampilkan di daftar artikel)</span>
                    </label>
                    <textarea
                        id="excerpt"
                        name="excerpt"
                        rows="2"
                        maxlength="500"
                        placeholder="Ringkasan singkat 1-2 kalimat tentang artikel ini..."
                        class="w-full px-4 py-3 border rounded-[10px] text-[#1F2937] text-sm placeholder-[#6B7280] resize-none
                               focus:outline-none focus:ring-2 focus:ring-[#238B45] focus:border-[#238B45] transition-colors
                               {{ $errors->has('excerpt') ? 'border-[#E11D48] ring-1 ring-[#E11D48]' : 'border-[#E5E7EB]' }}"
                    >{{ old('excerpt', $blog->excerpt ?? '') }}</textarea>
                    <p class="mt-1 text-xs text-[#6B7280]">Maks. 500 karakter</p>
                    @error('excerpt')
                        <p class="mt-1 text-xs text-[#E11D48]">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Content --}}
                <div>
                    <label for="content" class="block text-sm font-semibold text-[#1F2937] mb-1.5">
                        Konten Artikel <span class="text-[#E11D48]">*</span>
                        <span class="text-[#6B7280] font-normal">(isi lengkap artikel)</span>
                    </label>
                    <textarea
                        id="content"
                        name="content"
                        rows="14"
                        required
                        placeholder="Tulis konten lengkap artikel di sini..."
                        class="w-full px-4 py-3 border rounded-[10px] text-[#1F2937] text-sm placeholder-[#6B7280] resize-y
                               focus:outline-none focus:ring-2 focus:ring-[#238B45] focus:border-[#238B45] transition-colors
                               {{ $errors->has('content') ? 'border-[#E11D48] ring-1 ring-[#E11D48]' : 'border-[#E5E7EB]' }}"
                    >{{ old('content', $blog->content ?? '') }}</textarea>
                    @error('content')
                        <p class="mt-1.5 text-xs text-[#E11D48]">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Card: Thumbnail --}}
            <div class="bg-white rounded-2xl border border-[#E5E7EB] p-6">
                <h3 class="text-[#163326] font-semibold text-base mb-5">Thumbnail Artikel</h3>

                {{-- Existing thumbnail preview (edit mode) --}}
                @if (!empty($blog->image))
                    <div class="mb-4">
                        <p class="text-xs font-semibold text-[#6B7280] uppercase tracking-wider mb-2">Thumbnail Saat Ini</p>
                        <div class="relative inline-block">
                            <img src="{{ Storage::disk('public')->url($blog->image) }}"
                                 alt="{{ $blog->title }}"
                                 class="w-40 h-28 object-cover rounded-xl border border-[#E5E7EB]"
                                 loading="lazy">
                        </div>
                        <p class="text-xs text-[#6B7280] mt-2">Upload thumbnail baru untuk menggantikan gambar di atas.</p>
                    </div>
                @endif

                {{-- Upload input --}}
                <div>
                    <label for="image" class="block text-sm font-semibold text-[#1F2937] mb-1.5">
                        {{ !empty($blog->image) ? 'Ganti Thumbnail' : 'Upload Thumbnail' }}
                    </label>

                    {{-- Drop zone --}}
                    <label for="image"
                           id="blog-image-dropzone"
                           class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed rounded-xl cursor-pointer
                                  transition-colors duration-150
                                  {{ $errors->has('image') ? 'border-[#E11D48] bg-red-50' : 'border-[#E5E7EB] bg-[#F7FAF8] hover:border-[#238B45] hover:bg-[#EAF6EE]' }}">

                        <img id="blog-image-preview"
                             src=""
                             alt="Preview"
                             class="hidden w-full h-full object-cover rounded-xl">

                        <div id="blog-image-placeholder" class="flex flex-col items-center justify-center">
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

        {{-- ===== Kolom Kanan (1/3): Pengaturan Publikasi ===== --}}
        <div class="space-y-5">

            {{-- Card: Pengaturan Publikasi --}}
            <div class="bg-white rounded-2xl border border-[#E5E7EB] p-6">
                <h3 class="text-[#163326] font-semibold text-base mb-5">Pengaturan Publikasi</h3>

                {{-- Status --}}
                <div class="mb-5">
                    <label for="status" class="block text-sm font-semibold text-[#1F2937] mb-1.5">
                        Status <span class="text-[#E11D48]">*</span>
                    </label>
                    <select
                        id="status"
                        name="status"
                        class="w-full h-11 px-4 border rounded-[10px] text-[#1F2937] text-sm bg-white
                               focus:outline-none focus:ring-2 focus:ring-[#238B45] focus:border-[#238B45] transition-colors
                               {{ $errors->has('status') ? 'border-[#E11D48] ring-1 ring-[#E11D48]' : 'border-[#E5E7EB]' }}">
                        <option value="draft"
                                {{ old('status', $blog->status ?? 'draft') === 'draft' ? 'selected' : '' }}>
                            Draft
                        </option>
                        <option value="published"
                                {{ old('status', $blog->status ?? '') === 'published' ? 'selected' : '' }}>
                            Published
                        </option>
                    </select>
                    @error('status')
                        <p class="mt-1.5 text-xs text-[#E11D48]">{{ $message }}</p>
                    @enderror
                    <p class="text-xs text-[#6B7280] mt-1.5">Artikel Draft tidak tampil di halaman publik.</p>
                </div>

                {{-- Category --}}
                <div class="mb-5">
                    <label for="category_id" class="block text-sm font-semibold text-[#1F2937] mb-1.5">
                        Kategori Blog <span class="text-[#E11D48]">*</span>
                    </label>
                    <select
                        id="category_id"
                        name="category_id"
                        required
                        class="w-full h-11 px-4 border rounded-[10px] text-[#1F2937] text-sm bg-white
                               focus:outline-none focus:ring-2 focus:ring-[#238B45] focus:border-[#238B45] transition-colors
                               {{ $errors->has('category_id') ? 'border-[#E11D48] ring-1 ring-[#E11D48]' : 'border-[#E5E7EB]' }}">
                        <option value="">— Pilih Kategori —</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                    {{ old('category_id', $blog->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="mt-1.5 text-xs text-[#E11D48]">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Published At --}}
                <div>
                    <label for="published_at" class="block text-sm font-semibold text-[#1F2937] mb-1.5">
                        Tanggal & Waktu Publikasi
                        <span class="text-[#6B7280] font-normal">(opsional)</span>
                    </label>
                    <input
                        id="published_at"
                        type="datetime-local"
                        name="published_at"
                        value="{{ old('published_at', isset($blog->published_at) ? $blog->published_at?->format('Y-m-d\TH:i') : '') }}"
                        class="w-full h-11 px-4 border rounded-[10px] text-[#1F2937] text-sm
                               focus:outline-none focus:ring-2 focus:ring-[#238B45] focus:border-[#238B45] transition-colors
                               {{ $errors->has('published_at') ? 'border-[#E11D48] ring-1 ring-[#E11D48]' : 'border-[#E5E7EB]' }}">
                    @error('published_at')
                        <p class="mt-1.5 text-xs text-[#E11D48]">{{ $message }}</p>
                    @enderror
                    <p class="text-xs text-[#6B7280] mt-1.5">Jika Published dan kosong, diisi waktu saat ini.</p>
                </div>
            </div>

            {{-- Slug info (edit only) --}}
            @if (!empty($blog->slug))
                <div class="bg-[#F7FAF8] rounded-2xl border border-[#E5E7EB] p-4">
                    <p class="text-xs font-semibold text-[#6B7280] uppercase tracking-wider mb-2">URL Slug</p>
                    <p class="text-xs text-[#1F2937] font-mono break-all">/blog/{{ $blog->slug }}</p>
                    <p class="text-xs text-[#6B7280] mt-2">Slug diperbarui otomatis jika judul berubah.</p>
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
                    {{ $method === 'PUT' ? 'Simpan Perubahan' : 'Tambah Artikel' }}
                </button>
                <a href="{{ route('admin.blogs.index') }}"
                   class="w-full h-11 border border-[#E5E7EB] hover:border-[#238B45] text-[#6B7280] hover:text-[#238B45] font-semibold rounded-[10px]
                          transition-all duration-200 flex items-center justify-center gap-2 text-sm">
                    Batal
                </a>
            </div>

        </div>
    </div>

</form>

{{-- Image preview script — identik dengan pola Products --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const input       = document.getElementById('image');
    const preview     = document.getElementById('blog-image-preview');
    const placeholder = document.getElementById('blog-image-placeholder');

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
