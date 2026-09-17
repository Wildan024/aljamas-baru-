# Database Schema Documentation (SCHEMA.md)

## 1. Overview Database
* **RDBMS Engine:** MySQL 8.x / MariaDB (InnoDB)
* **Default Charset / Collation:** `utf8mb4` / `utf8mb4_unicode_ci`
* **Konvensi Penamaan:**
  * Nama tabel: Jamak, huruf kecil, snake_case (`categories`, `products`, `blogs`, `galleries`, `partnerships`, `company_settings`).
  * Primary Key: `id` (BigIncrements / Unsigned BigInt).
  * Foreign Key: `nama_tabel_tunggal_id` (contoh: `category_id`).
  * Timestamp: `created_at` dan `updated_at` (TIMESTAMP NULL).

---

## 2. Definisi Struktur Tabel & Kolom

### 2.1. Tabel `users` (Admin Authentication)
Menyimpan kredensial autentikasi admin panel CMS.

| Nama Kolom | Tipe Data | Nullable | Default | Keterangan / Constraint |
| :--- | :--- | :--- | :--- | :--- |
| `id` | BIGINT UNSIGNED | No | Auto Increment | Primary Key |
| `name` | VARCHAR(255) | No | - | Nama lengkap admin |
| `email` | VARCHAR(255) | No | - | Email unik login (`UNIQUE INDEX`) |
| `email_verified_at` | TIMESTAMP | Yes | NULL | Verifikasi email |
| `password` | VARCHAR(255) | No | - | Hash password (Bcrypt) |
| `remember_token` | VARCHAR(100) | Yes | NULL | Token sesi persistent |
| `created_at` | TIMESTAMP | Yes | NULL | Waktu dibuat |
| `updated_at` | TIMESTAMP | Yes | NULL | Waktu diubah |

---

### 2.2. Tabel `categories`
Menampung pengelompokan konten untuk produk dan artikel blog.

| Nama Kolom | Tipe Data | Nullable | Default | Keterangan / Constraint |
| :--- | :--- | :--- | :--- | :--- |
| `id` | BIGINT UNSIGNED | No | Auto Increment | Primary Key |
| `name` | VARCHAR(100) | No | - | Nama kategori |
| `slug` | VARCHAR(120) | No | - | `UNIQUE INDEX`, URL-friendly |
| `type` | ENUM('product', 'blog') | No | - | `INDEX`, Memisahkan peruntukan kategori |
| `created_at` | TIMESTAMP | Yes | NULL | Waktu dibuat |
| `updated_at` | TIMESTAMP | Yes | NULL | Waktu diubah |

> **Indeks:** `UNIQUE(slug)`, `INDEX(type)`

---

### 2.3. Tabel `products`
Menampung data katalog produk (Kulit Dimsum, Kulit Pangsit, Kulit Samosa, Mie Segar, dll).

| Nama Kolom | Tipe Data | Nullable | Default | Keterangan / Constraint |
| :--- | :--- | :--- | :--- | :--- |
| `id` | BIGINT UNSIGNED | No | Auto Increment | Primary Key |
| `category_id` | BIGINT UNSIGNED | Yes | NULL | `INDEX`, Foreign key ke `categories.id` (`ON DELETE SET NULL`) |
| `name` | VARCHAR(255) | No | - | Nama varian produk |
| `slug` | VARCHAR(255) | No | - | `UNIQUE INDEX`, URL-friendly |
| `short_description` | VARCHAR(500) | Yes | NULL | Ringkasan singkat untuk card preview |
| `description` | TEXT | Yes | NULL | Deskripsi lengkap, spesifikasi, dan keunggulan |
| `image` | VARCHAR(255) | Yes | NULL | Path file gambar di storage |
| `is_active` | BOOLEAN | No | `TRUE` | `INDEX`, Status aktif tampil di publik |
| `sort_order` | INT | No | `0` | Urutan penataan produk di landing page / katalog |
| `created_at` | TIMESTAMP | Yes | NULL | Waktu dibuat |
| `updated_at` | TIMESTAMP | Yes | NULL | Waktu diubah |

> **Indeks:** `UNIQUE(slug)`, `INDEX(category_id)`, `INDEX(is_active)`, `INDEX(sort_order)`

---

### 2.4. Tabel `blogs`
Menampung artikel informasi, edukasi, resep, dan berita perusahaan.

| Nama Kolom | Tipe Data | Nullable | Default | Keterangan / Constraint |
| :--- | :--- | :--- | :--- | :--- |
| `id` | BIGINT UNSIGNED | No | Auto Increment | Primary Key |
| `category_id` | BIGINT UNSIGNED | Yes | NULL | `INDEX`, Foreign key ke `categories.id` (`ON DELETE SET NULL`) |
| `title` | VARCHAR(255) | No | - | Judul artikel |
| `slug` | VARCHAR(255) | No | - | `UNIQUE INDEX`, URL-friendly |
| `excerpt` | VARCHAR(500) | Yes | NULL | Ringkasan isi untuk card blog preview |
| `content` | LONGTEXT | No | - | Konten artikel lengkap |
| `image` | VARCHAR(255) | Yes | NULL | Path file thumbnail di storage |
| `status` | ENUM('draft', 'published') | No | `'draft'` | `INDEX`, Status publikasi artikel |
| `published_at` | DATETIME | Yes | NULL | `INDEX`, Tanggal rilis (wajib diisi saat status published) |
| `created_at` | TIMESTAMP | Yes | NULL | Waktu dibuat |
| `updated_at` | TIMESTAMP | Yes | NULL | Waktu diubah |

> **Aturan Tampil Publik:** `WHERE status = 'published' AND published_at <= NOW()`  
> **Indeks:** `UNIQUE(slug)`, `INDEX(category_id)`, `INDEX(status)`, `INDEX(published_at)`

---

### 2.5. Tabel `galleries`
Menampung foto dokumentasi fasilitas pabrik, dapur produksi, tim, dan kegiatan.

| Nama Kolom | Tipe Data | Nullable | Default | Keterangan / Constraint |
| :--- | :--- | :--- | :--- | :--- |
| `id` | BIGINT UNSIGNED | No | Auto Increment | Primary Key |
| `title` | VARCHAR(255) | No | - | Judul foto / nama kegiatan |
| `image` | VARCHAR(255) | No | - | Path file gambar di storage |
| `description` | VARCHAR(500) | Yes | NULL | Keterangan/caption singkat |
| `is_active` | BOOLEAN | No | `TRUE` | `INDEX`, Status tampil di galeri publik |
| `sort_order` | INT | No | `0` | `INDEX`, Urutan prioritas penataan foto |
| `created_at` | TIMESTAMP | Yes | NULL | Waktu dibuat |
| `updated_at` | TIMESTAMP | Yes | NULL | Waktu diubah |

> **Indeks:** `INDEX(is_active)`, `INDEX(sort_order)`

---

### 2.6. Tabel `partnerships`
Menampung data formulir pendaftaran kemitraan masuk dari halaman publik.

| Nama Kolom | Tipe Data | Nullable | Default | Keterangan / Constraint |
| :--- | :--- | :--- | :--- | :--- |
| `id` | BIGINT UNSIGNED | No | Auto Increment | Primary Key |
| `name` | VARCHAR(150) | No | - | Nama lengkap pemohon |
| `email` | VARCHAR(150) | No | - | Email pemohon |
| `phone` | VARCHAR(50) | No | - | Nomor WhatsApp / Telepon pemohon |
| `company` | VARCHAR(150) | Yes | NULL | Nama usaha / bisnis (jika ada) |
| `location` | VARCHAR(255) | No | - | Kota / Kabupaten domisili |
| `partnership_type`| VARCHAR(100) | No | - | Jenis kemitraan (Distributor, Agen, Reseller, Pasokan Rutin) |
| `message` | TEXT | Yes | NULL | Pesan / keterangan pengajuan mitra |
| `status` | ENUM('new', 'contacted', 'processed', 'rejected') | No | `'new'` | `INDEX`, Status tindak lanjut admin |
| `admin_notes` | TEXT | Yes | NULL | Catatan internal penanganan prospek |
| `created_at` | TIMESTAMP | Yes | NULL | Waktu pengajuan masuk |
| `updated_at` | TIMESTAMP | Yes | NULL | Waktu update status |

> **Indeks:** `INDEX(status)`, `INDEX(created_at)`

---

### 2.7. Tabel `company_settings`
Menyimpan konfigurasi identitas dan kontak global perusahaan dalam format Key-Value.

| Nama Kolom | Tipe Data | Nullable | Default | Keterangan / Constraint |
| :--- | :--- | :--- | :--- | :--- |
| `id` | BIGINT UNSIGNED | No | Auto Increment | Primary Key |
| `key` | VARCHAR(100) | No | - | `UNIQUE INDEX`, Kunci konfigurasi |
| `value` | TEXT | Yes | NULL | Nilai konfigurasi |
| `created_at` | TIMESTAMP | Yes | NULL | Waktu dibuat |
| `updated_at` | TIMESTAMP | Yes | NULL | Waktu diubah |

> **Daftar Kunci Wajib (`key`):**  
> `company_name`, `company_tagline`, `company_logo`, `company_email`, `company_phone`, `whatsapp_number`, `whatsapp_default_message`, `company_address`, `google_maps`, `instagram_url`, `facebook_url`, `tiktok_url`, `youtube_url`, `footer_text`.

---

## 3. Relasi Antar Tabel & Foreign Key Constraints

```text
               ┌────────────────────────┐
               │       categories       │
               └───────────┬────────────┘
                           │
             ┌─────────────┴─────────────┐
 (1:N, type='product')         (1:N, type='blog')
             ▼                           ▼
    ┌─────────────────┐         ┌─────────────────┐
    │    products     │         │      blogs      │
    │ category_id (FK)│         │ category_id (FK)│
    └─────────────────┘         └─────────────────┘
categories ➔ products:

Foreign Key: products.category_id mereferensikan categories.id.

Aksi: ON DELETE SET NULL (menghapus kategori tidak menghapus produk, category_id menjadi NULL).

Relasi Model Eloquent:

Category::hasMany(Product::class)

Product::belongsTo(Category::class)

categories ➔ blogs:

Foreign Key: blogs.category_id mereferensikan categories.id.

Aksi: ON DELETE SET NULL (menghapus kategori tidak menghapus artikel, category_id menjadi NULL).

Relasi Model Eloquent:

Category::hasMany(Blog::class)

Blog::belongsTo(Category::class)

4. Aturan Integritas & Slug Generation
Slug Unik & Permanen:

Kolom slug pada categories, products, dan blogs wajib unik di seluruh baris tabel.

Slug dibuat otomatis dari atribut nama/judul saat data pertama kali dibuat (Str::slug($name)).

Slug tidak boleh berubah otomatis saat admin mengedit judul produk/blog demi menjaga stabilitas indexing SEO dan mencegah broken links (404).

Kategori Berdasarkan Tipe (type):

Produk hanya boleh berelasi dengan baris categories yang memiliki nilai type = 'product'.

Artikel blog hanya boleh berelasi dengan baris categories yang memiliki nilai type = 'blog'.