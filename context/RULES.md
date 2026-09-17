# AI Coding Agent Guidelines & Rules (RULES.md)

Dokumen ini adalah aturan mutlak dan instruksi wajib bagi AI Coding Agent dalam membaca instruksi, membuat file, dan menulis kode untuk proyek Web Company Profile ini.

---

## 1. Context Priority & Conflict Resolution

Jika terjadi perbedaan atau konflik informasi antar dokumen konteks, patuhi hierarki prioritas berikut:

1. RULES.md (Aturan implementasi & batasan ketat - Paling Utama)
2. ARCHITECTURE.md (Cara sistem dibangun, stack, dan struktur direktori)
3. SCHEMA.md (Struktur database, kolom, tipe data, dan relasi)
4. DESIGN.md (Sistem tampilan, token warna, tipografi, dan UI/UX)
5. PRD.md (Kebutuhan fitur & ruang lingkup bisnis)

* Peran Dokumen: PRD.md menentukan apa yang dibangun; ARCHITECTURE.md, SCHEMA.md, dan DESIGN.md menentukan bagaimana sistem dibangun dan ditampilkan; RULES.md menentukan aturan dan batasan teknis dalam mengeksekusinya.
* Jika terjadi konflik teknis, kombinasi RULES.md + ARCHITECTURE.md menjadi acuan utama.

---

## 2. General Development Rules
* Larangan Perubahan Sembarangan: Jangan pernah mengubah struktur database, rute, arsitektur, dependensi, atau design system yang telah ditentukan tanpa alasan teknis yang kuat dan persetujuan eksplisit.
* No Unnecessary Patterns: Dilarang mengimplementasikan Repository Pattern, Service Layer berlebihan, Inertia.js, React, Vue, Livewire, atau REST API endpoint terpisah jika kebutuhan MVC sederhana sudah mencukupi.
* Clean & Readable Code: Tulis kode yang rapi, modular, mudah dirawat, dan memiliki komentar singkat yang esensial.

---

## 3. Architecture Rules
* Sistem wajib menggunakan pola Laravel MVC (Model-View-Controller) standar.
* Alur data: Route -> Controller -> Form Request -> Model/Eloquent -> Blade View -> Browser.
* Controller publik ditempatkan langsung di app/Http/Controllers/, sedangkan controller CMS admin ditempatkan di app/Http/Controllers/Admin/.

---

## 4. Database & Migration Rules
* Dilarang memanipulasi database secara manual tanpa file migration.
* Setiap perubahan skema tabel wajib dilakukan melalui migration baru (php artisan make:migration ...).
* Dilarang menghapus atau mengedit file migration yang sudah dijalankan jika dapat diselesaikan dengan migration baru.
* Semua foreign key, tipe data, indeks (UNIQUE, INDEX), dan klausa (ON DELETE SET NULL / ON DELETE CASCADE) wajib didefinisikan secara eksplisit di migration sesuai SCHEMA.md.
* Akses database wajib menggunakan Eloquent ORM atau Query Builder. Dilarang menulis raw SQL query tanpa binding parameter.

---

## 5. Eloquent & Model Rules
* Setiap Model wajib mendefinisikan properti $fillable secara eksplisit untuk mencegah kerentanan mass assignment.
* Definisikan relasi antar-tabel secara eksplisit pada Model (hasMany, belongsTo).
* Cegah N+1 Query: Wajib menggunakan Eager Loading (with(...)) saat memuat data yang memiliki relasi (contoh: Product::with('category')->get()).
* Gunakan Route Model Binding (berdasarkan id untuk admin atau slug untuk publik) untuk query data yang lebih bersih.

---

## 6. Controller Rules
* Controller hanya bertanggung jawab untuk: menerima request, memicu validasi, memanggil Eloquent Model, dan mengembalikan response/redirect.
* Hindari menulis fat controller dengan ratusan baris kode.
* Jangan memaksakan pembuatan Service class terpisah hanya untuk operasi CRUD sederhana.

---

## 7. Blade & View Rules
* Manfaatkan inheritance layout: layouts/app.blade.php untuk publik dan layouts/admin.blade.php untuk admin CMS.
* Elemen antarmuka yang digunakan berulang (navbar, footer, tombol, card produk, card blog, pagination) wajib dibuat sebagai Blade Component di resources/views/components/.
* Dilarang keras menulis query database langsung (@php DB::table(...) @endphp atau Product::all()) di dalam file Blade.
* Hindari meletakkan logika bisnis yang kompleks di dalam View.

---

## 8. Route Rules
* Seluruh route wajib didaftarkan di routes/web.php dengan penamaan eksplisit (name('...')).
* Format penamaan URL publik menggunakan kebab-case (contoh: /tentang-kami, /produk/{slug}).
* Seluruh endpoint CMS wajib menggunakan prefix /admin dan dilindungi middleware auth (kecuali halaman login admin).
* Gunakan standar Laravel Resource Controller untuk CRUD admin jika memungkinkan.
* Dilarang membuat route duplikat untuk aksi yang sama.

---

## 9. Authentication & Authorization
* Gunakan modul autentikasi sesi standar bawaan Laravel untuk role tunggal (admin).
* Jangan membuat middleware auth kustom jika fitur bawaan Laravel sudah mencukupi.
* Proteksi rute admin dari akses publik yang tidak terotentikasi.

---

## 10. Validation & Security Rules
* CSRF Protection: Setiap form dengan method POST, PUT, PATCH, dan DELETE wajib menyertakan direktif @csrf.
* Form Requests: Validasi input formulir publik dan admin wajib menggunakan kelas Laravel Form Request (app/Http/Requests/).
* Output Escaping: Selalu render data menggunakan kurung kurawal ganda {{ $data }}. Dilarang menggunakan {!! $data !!} kecuali konten teks artikel/blog yang telah disanitasi.
* Credential Protection: Dilarang menyimpan password plain text, API key, atau token rahasia di source code. Gunakan file .env dan helper config().
* Environment Security: Dilarang melakukan commit untuk file .env, kredensial database, atau private key. Pastikan APP_DEBUG=false pada production agar detail exception tidak bocor ke publik.

---

## 11. File & Image Storage Rules
* Semua upload media wajib menggunakan Laravel Storage dengan disk public (Storage::disk('public')).
* Simpan media pada subfolder yang sesuai: products/, blogs/, galleries/. Dilarang mengunggah langsung ke root folder public/.
* Pastikan symbolic link storage aktif (php artisan storage:link).
* Validasi Upload: Wajib memvalidasi MIME/tipe file (image, mimes:jpg,jpeg,png,webp) dan batas ukuran (max:2048 KB).
* File Cleanup: Saat record produk, blog, atau galeri dihapus, file gambar fisiknya di storage wajib dihapus jika sudah tidak digunakan (Storage::disk('public')->delete($path)).

---

## 12. Naming Conventions
* Database Table: snake_case jamak (contoh: products, blogs, partnerships)
* Database Column: snake_case (contoh: category_id, is_active, published_at)
* Eloquent Model: PascalCase tunggal (contoh: Product, Blog, Partnership)
* Controller: PascalCase + Controller (contoh: ProductController, HomeController)
* Method / Function: camelCase (contoh: index(), store(), updateStatus())
* Variable: camelCase (contoh: $productList, $isFeatured)
* Blade View File: kebab-case / snake_case (contoh: product-card.blade.php, index.blade.php)
* Route URI: kebab-case (contoh: /tentang-kami, /admin/partnerships)
* Route Name: snake_case / dot notation (contoh: admin.products.index, home)

---

## 13. UI, Design System & Responsive Rules
* Semua implementasi tampilan wajib patuh pada DESIGN.md.
* Color Tokens: Dilarang menggunakan warna hijau/merah/slate acak di luar token yang telah ditentukan (Primary: #238B45, Dark: #163326, Soft: #F7FAF8, WhatsApp: #25D366).
* Typography: Wajib menggunakan font utama Poppins dengan skala hierarki yang telah ditetapkan.
* Radius & Spacing: Gunakan radius standar (Card: 16px, Button/Input: 10px, Badge: 9999px) dan padding kontainer yang seragam.
* Mobile-First & Accessibility: Setiap view wajib dibangun dengan pendekatan mobile-first, memiliki area sentuh tombol minimal 44px, serta setiap tag <img> wajib memiliki atribut alt.

---

## 14. Standard CRUD Flow
* Setiap resource admin wajib mengimplementasikan struktur CRUD standar sesuai kebutuhan (index, create, store, edit, update, destroy).
* Flash Message: Operasi create/update/delete yang berhasil wajib melakukan redirect dengan flash message sukses (session()->flash('success', '...')).
* Error Handling: Form yang gagal validasi wajib menampilkan pesan error di bawah input terkait (@error) dan mempertahankan nilai input sebelumnya (old('fieldName')).

---

## 15. Search Engine Optimization (SEO) Rules
* Semua URL publik untuk konten dinamis wajib menggunakan slug unik, bukan ID numerik.
* Slug dibuat otomatis saat data pertama kali dibuat dan tidak boleh berubah sembarangan saat data diedit.
* Setiap halaman publik wajib memiliki slot dinamis untuk tag <title>, <meta name="description">, <link rel="canonical">, dan Open Graph tags (og:title, og:description, og:image).

---

## 16. Dependency Management Rules
* Dilarang menginstal package atau pustaka npm/composer baru jika kebutuhan dapat diselesaikan oleh fitur bawaan Laravel, Blade, Tailwind CSS, Vite, dan Vanilla JavaScript.
* Jika penambahan dependensi benar-benar tidak terhindarkan, jelaskan urgensi teknisnya secara spesifik sebelum melakukan instalasi.

---

## 17. Verification & Testing Scope
Pastikan fungsionalitas inti berikut teruji dan berjalan tanpa kendala:
1. Autentikasi Admin (Login, Session, Logout, Route Protection).
2. CRUD Produk (Upload gambar, filter kategori, status aktif, delete image file).
3. CRUD Blog (Draft/Publish status, slug generation, paginasi 9 artikel).
4. Formulir Kemitraan (Validasi input, penyimpanan database, update status di admin).
5. Company Settings (Pembaruan nomor WA/kontak dan keterhubungannya di navbar/footer).
6. Tampilan Detail Produk & Detail Blog publik.

---

## 18. Definition of Done (DoD)
Sebelum menyatakan sebuah tugas atau fitur selesai, pastikan poin-poin berikut telah terpenuhi:
* Tidak ada error sintaks PHP, Blade, CSS, atau JavaScript.
* Seluruh rute terdaftar dengan benar di routes/web.php dan memiliki route name.
* Skema database dan migration berjalan sukses tanpa error (php artisan migrate).
* Validasi form bekerja dengan baik dan menampilkan pesan error jika data tidak valid.
* Hak akses route /admin terlindungi dan tidak bisa ditembus tanpa login.
* Antarmuka responsif di resolusi Mobile (<640px), Tablet (640-1024px), dan Desktop (>1024px).
* Tidak ada error/warning pada console browser.
* Tidak ada file sampah, kredensial terbuka, atau package yang tidak terpakai.
* Implementasi 100% konsisten dengan PRD.md, ARCHITECTURE.md, SCHEMA.md, dan DESIGN.md.