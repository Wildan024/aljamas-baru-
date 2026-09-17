Berikut adalah penulisan ulang lengkap file **`context/ARCHITECTURE.md`** dengan nomor versi pada bagian **Technology Stack**:

---

```markdown
# Architecture Documentation (ARCHITECTURE.md)

## 1. Technology Stack
* **Backend Framework:** Laravel 12.x
* **Programming Language:** PHP 8.2+
* **Database:** MySQL 8.x / MariaDB 10.11+
* **Template Engine:** Laravel Blade
* **Styling Framework:** Tailwind CSS 4.x
* **Asset Bundler:** Vite 6.x
* **Database ORM:** Eloquent ORM
* **Client Scripting:** Vanilla JavaScript (ES6+)

---

## 2. Architecture Pattern
Project menggunakan pola arsitektur **Laravel MVC (Model-View-Controller)** standar, bersih, dan mudah dipelihara (*maintainable*).

```text
Browser / Client
       │ (HTTP Request)
       ▼
  routes/web.php
       │
       ▼
   Controller ───► Form Request Validation
       │
       ▼
 Eloquent Model ───► MySQL Database
       │
       ▼
   Blade View ◄─── (Tailwind CSS 4.x + Reusable Components)
       │
       ▼
Browser / Client (HTML Response)

```

Tidak menggunakan Repository Pattern, Service Layer, atau abstraksi tambahan yang tidak dibutuhkan.

---

## 3. Application Directory Structure

```text
app/
├── Http/
│   ├── Controllers/
│   │   ├── HomeController.php
│   │   ├── ProductController.php
│   │   ├── BlogController.php
│   │   ├── GalleryController.php
│   │   ├── PartnershipController.php
│   │   └── Admin/
│   │       ├── DashboardController.php
│   │       ├── ProductController.php
│   │       ├── BlogController.php
│   │       ├── GalleryController.php
│   │       ├── PartnershipController.php
│   │       └── CompanySettingController.php
│   └── Requests/
│       ├── ProductRequest.php
│       ├── BlogRequest.php
│       ├── GalleryRequest.php
│       ├── PartnershipRequest.php
│       └── CompanySettingRequest.php
├── Models/
│   ├── User.php
│   ├── Product.php
│   ├── Category.php
│   ├── Blog.php
│   ├── Gallery.php
│   ├── Partnership.php
│   └── CompanySetting.php
resources/
├── views/
│   ├── layouts/
│   │   ├── app.blade.php
│   │   └── admin.blade.php
│   ├── components/
│   │   ├── navbar.blade.php
│   │   ├── footer.blade.php
│   │   ├── button.blade.php
│   │   ├── section-title.blade.php
│   │   ├── product-card.blade.php
│   │   ├── blog-card.blade.php
│   │   └── gallery-card.blade.php
│   ├── home/
│   │   └── index.blade.php
│   ├── products/
│   │   ├── index.blade.php
│   │   └── show.blade.php
│   ├── blogs/
│   │   ├── index.blade.php
│   │   └── show.blade.php
│   ├── galleries/
│   │   └── index.blade.php
│   ├── partnership/
│   │   └── create.blade.php
│   └── admin/
│       ├── dashboard.blade.php
│       ├── products/
│       ├── blogs/
│       ├── galleries/
│       ├── partnerships/
│       └── settings/
├── css/
│   └── app.css
└── js/
    └── app.js
routes/
├── web.php
└── console.php
database/
├── migrations/
├── seeders/
└── factories/
storage/
└── app/
    └── public/
        ├── products/
        ├── blogs/
        └── galleries/

```

---

## 4. Public Website (Guest Access)

Public website tidak membutuhkan proses autentikasi.

| HTTP Method | URI | Controller Action | Deskripsi & Isi Tampilan |
| --- | --- | --- | --- |
| `GET` | `/` | `HomeController@index` | Hero, Profil singkat, Produk unggulan, Keunggulan, CTA Kemitraan, Kontak |
| `GET` | `/tentang-kami` | `HomeController@about` | Profil lengkap perusahaan, sejarah, visi-misi, legalitas |
| `GET` | `/produk` | `ProductController@index` | Menampilkan seluruh katalog produk aktif |
| `GET` | `/produk/{slug}` | `ProductController@show` | Detail produk, varian ukuran/berat, keunggulan, tombol pesan WA |
| `GET` | `/kemitraan` | `PartnershipController@create` | Skema bisnis & form pengajuan mitra |
| `POST` | `/kemitraan` | `PartnershipController@store` | Validasi input & simpan data pengajuan mitra |
| `GET` | `/blog` | `BlogController@index` | Daftar artikel blog rilis (paginasi 9 item per halaman) |
| `GET` | `/blog/{slug}` | `BlogController@show` | Detail baca artikel blog & related posts |
| `GET` | `/galeri` | `GalleryController@index` | Grid album foto fasilitas & dokumentasi kegiatan |

---

## 5. Admin CMS Specification (Protected via `auth` Middleware)

Semua rute dengan prefix `/admin` wajib menggunakan middleware `auth` dan namespace `App\Http\Controllers\Admin`.

```text
GET    /admin                                ──► DashboardController@index
RESOURCE /admin/products                     ──► ProductController
RESOURCE /admin/blogs                        ──► BlogController
RESOURCE /admin/galleries                    ──► GalleryController
GET    /admin/partnerships                   ──► PartnershipController@index
PATCH  /admin/partnerships/{partnership}     ──► PartnershipController@updateStatus
DELETE /admin/partnerships/{partnership}     ──► PartnershipController@destroy
GET    /admin/settings                       ──► CompanySettingController@index
PUT    /admin/settings                       ──► CompanySettingController@update

```

---

## 6. Authentication & Security Policy

* **Standard Auth:** Menggunakan autentikasi bawaan Laravel dengan satu role tunggal (`admin`).
* **CSRF Protection:** Wajib menyertakan `@csrf` pada setiap request formulir state-changing (`POST`, `PUT`, `PATCH`, `DELETE`).
* **Blade Output Escaping:** Gunakan sintaks default `{{ $data }}`. Hindari `{!! $content !!}` tanpa proses sanitasi eksplisit.
* **Mass Assignment Protection:** Seluruh Model Eloquent wajib mendefinisikan properti `$fillable`.

---

## 7. Database & Relationship Design

* **Database Engine:** MySQL 8.x (InnoDB, `utf8mb4`).
* **Primary Key:** `id` (Unsigned Big Integer Auto-Increment).
* **Unique Slugs:** Kolom `slug` pada tabel `products` dan `blogs` wajib unik dan diindeks.
* **Relasi Antar Entitas:**
* `Category` hasMany `Product`
* `Category` hasMany `Blog`
* `Product` belongsTo `Category`
* `Blog` belongsTo `Category`


* **Seeder:** Wajib menyertakan seeder data akun administrator awal dan data default `company_settings`.

---

## 8. Company Settings Management

Informasi global disimpan dalam format Key-Value pada model `CompanySetting`:

* `company_name`, `company_email`, `company_phone`, `whatsapp_number`, `company_address`, `google_maps`, `instagram_url`, `facebook_url`, `tiktok_url`, `youtube_url`.
* Gunakan caching atau *View Sharing* via `AppServiceProvider` agar query setting tidak dieksekusi berulang di setiap request halaman.

---

## 9. Views & Components Architecture

* Hindari duplikasi elemen markup HTML; manfaatkan Blade Components di `resources/views/components/` (`navbar`, `footer`, `button`, `section-title`, `product-card`, `blog-card`, `gallery-card`).
* Pemisahan struktur layout publik (`layouts/app.blade.php`) dan layout CMS (`layouts/admin.blade.php`).

---

## 10. Styling & Asset Management

* Maksimalkan utilitas **Tailwind CSS 4.x** yang dimuat via `resources/css/app.css` (`@import "tailwindcss";`).
* Interaktivitas ringan (hamburger toggle, modal lightbox galeri, konfirmasi hapus data) menggunakan **Vanilla JavaScript** pada `resources/js/app.js`.
* Manajemen kompilasi aset sepenuhnya ditangani oleh **Vite 6.x**.

---

## 11. Image & File Storage

* Semua file media yang diunggah disimpan di `storage/app/public/` menggunakan `Storage::disk('public')`.
* Struktur subfolder: `products/`, `blogs/`, `galleries/`.
* Symbolic link diaktifkan via `php artisan storage:link`.
* Saat data produk, blog, atau galeri dihapus, file fisik gambar terkait dihapus dari disk storage menggunakan `Storage::disk('public')->delete($path)`.

---

## 12. Validation & Error Handling

* Validasi input formulir menggunakan **Laravel Form Request**.
* Validasi upload file gambar minimal: `image`, `mimes:jpg,jpeg,png,webp`, `max:2048`.
* Tampilkan *flash message* untuk feedback status CRUD (`success`, `error`, `warning`).
* Kustomisasi halaman error standar (`404.blade.php` dan `500.blade.php`).

---

## 13. Pagination & SEO

* **Pagination:** Publik blog dibatasi 9 artikel per halaman (`paginate(9)`), tabel admin menggunakan pagination dinamis (10–20 baris per halaman).
* **SEO Metadata:** Layout publik menyediakan slot meta tag dinamis mencakup `<title>`, `meta description`, `canonical URL`, serta Open Graph tags (`og:title`, `og:description`, `og:image`, `og:url`).

---

## 14. Coding Principles

1. **Fungsional & Konsisten:** Fitur baru wajib mengikuti konvensi arsitektur dan penamaan yang sudah ditentukan.
2. **Minimal Dependency:** Tidak menambahkan package atau pustaka eksternal bila dapat diselesaikan dengan modul bawaan Laravel dan Tailwind.
3. **Integritas Konfigurasi:** Struktur database, nama tabel, dan rute harus sinkron dengan dokumen `PRD.md` dan `SCHEMA.md`.

```

```