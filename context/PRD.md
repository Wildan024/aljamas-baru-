```markdown
# Product Requirements Document (PRD)

## 1. Project Overview & Scope
* **Nama Proyek:** Web Company Profile & CMS Dashboard (Produsen Produk Makanan / Kulit Pangsit, Dimsum, Samosa, & Mie)
* **Tipe Aplikasi:** Dynamic Company Profile berbasis Web dengan Content Management System (CMS) Admin terintegrasi
* **Tech Stack:** Laravel (MVC Pattern), Tailwind CSS, Blade Template Engine, MySQL, Vite, Vanilla JavaScript
* **Target & Audiens:**
  * **B2B (Business-to-Business):** Pelaku usaha kuliner, restoran, UMKM, katering, distributor, dan agen yang membutuhkan pasokan bahan baku secara rutin.
  * **B2C (Business-to-Consumer):** Konsumen ritel/rumah tangga yang mencari produk berkualitas, resep, dan info pembelian.
  * **Admin / Internal:** Tim operasional pengelola konten dan penanganan prospek kemitraan.

---

## 2. Pemetaan Ruang Lingkup Sistem (Scope System)

### 2.1. Public Website (Pengunjung / Pelanggan)
* **Home (`/`):** Halaman arahan utama dengan susunan multi-section terstruktur.
* **Tentang Kami (`/tentang-kami`):** Profil lengkap perusahaan, sejarah, kapasitas produksi, legalitas/kehalalan, visi & misi.
* **Katalog Produk (`/produk`):** Daftar seluruh varian produk dengan filter kategori.
* **Detail Produk (`/produk/{slug}`):** Informasi spesifikasi produk dan tombol CTA WhatsApp pemesanan.
* **Kemitraan (`/kemitraan`):** Informasi skema bisnis (Distributor/Agen/Reseller) dan formulir pendaftaran kemitraan.
* **Blog / Berita (`/blog`):** Daftar artikel edukasi, resep, dan berita perusahaan dengan sistem paginasi.
* **Detail Blog (`/blog/{slug}`):** Tampilan lengkap isi artikel berita.
* **Galeri (`/galeri`):** Dokumentasi foto fasilitas produksi, kegiatan, dan produk dengan fitur modal lightbox.
* **Kontak (`/kontak`):** Informasi kontak terpusat, peta Google Maps, dan direct link komunikasi.

### 2.2. Admin CMS Dashboard (Pengelola Konten)
* **Dashboard (`/admin/dashboard`):** Ringkasan statistik cepat (total produk, blog, pesan kemitraan masuk).
* **Manajemen Produk (`/admin/products`):** CRUD produk, upload gambar, varian berat/ukuran, dan status publikasi.
* **Manajemen Kategori Produk (`/admin/product-categories`):** Kelola kategori produk (contoh: Kulit Dimsum, Kulit Pangsit, Mie Segar).
* **Manajemen Blog (`/admin/blogs`):** CRUD artikel, kategori blog, excerpt, SEO meta, dan status publikasi.
* **Manajemen Kategori Blog (`/admin/blog-categories`):** Kelola kategori artikel berita.
* **Manajemen Galeri (`/admin/galleries`):** Upload foto dokumentasi, judul/caption, urutan tampil (*sort order*), dan aksi hapus.
* **Pesan Kemitraan (`/admin/partnerships`):** Monitoring data pengajuan mitra, filter status, dan direct link follow-up WhatsApp.
* **Company Settings (`/admin/settings`):** Kelola identitas perusahaan, logo, kontak WA, email, medsos, dan embed Google Maps secara dinamis.

---

## 3. Struktur & Urutan Seksi Halaman Utama (Homepage Sections)

Halaman utama (`/`) disusun dengan urutan seksi berikut:

```text
Homepage (/)
├── 1. Navbar (Sticky + Nav Links + Tombol WhatsApp Hyperlink)
├── 2. Hero Section (Headline, Sub-headline, Foto Banner, CTA Utama)
├── 3. Tentang Singkat (Profil kilas, legalitas, nilai tambah, CTA ke Tentang Kami)
├── 4. Produk Unggulan (Grid produk featured dinamis dari DB + link ke /produk)
├── 5. Keunggulan Perusahaan (Higienis, Halal, Bahan Berkualitas, Kapasitas Produksi)
├── 6. CTA Kemitraan (Ajakan kerja sama B2B/B2C + tombol ke /kemitraan)
├── 7. Artikel Terbaru (3 Blog terbaru dinamis + link ke /blog)
├── 8. Galeri Cuplikan (Grid foto dokumentasi fasilitas + link ke /galeri)
├── 9. CTA WhatsApp Section (Banner hijau kontras untuk konsultasi/order cepat)
└── 10. Footer (Logo, profil singkat, quick links, kontak dinamis, medsos, copyright)

```

---

## 4. Fungsionalitas Detail Fitur

### 4.1. Modul Produk & Detail Produk

* **Listing Publik (`/produk`):** Menampilkan katalog produk dengan filter kategori.
* **Detail Publik (`/produk/{slug}`):**
* Nama produk, galeri/foto produk.
* Deskripsi lengkap dan komposisi.
* Berat / ukuran / varian kemasan (misal: Pack 50 lembar, 500 gram, 1 kg).
* Poin keunggulan produk (misal: Tidak mudah sobek, kenyal, tanpa pengawet berbahaya).
* **CTA WhatsApp:** Tombol interaktif "Pesan / Tanya Produk Ini via WhatsApp" yang otomatis mengisi template teks: *"Halo, saya ingin bertanya tentang produk [Nama Produk]"*.


* **Fungsi CMS Admin:**
* Tambah, ubah, dan hapus produk.
* Upload gambar utama produk ke storage disk publik.
* Generate otomatis atau kustomisasi URL slug.
* Mengatur kategori produk.
* Pengaturan status publikasi: `draft` (disembunyikan) atau `published` (tampil publik).
* Menandai produk sebagai `is_featured` untuk tampil di seksi unggulan Homepage.



---

### 4.2. Modul Blog & Berita

* **Listing Publik (`/blog`):** Menampilkan kartu artikel dengan sistem paginasi dan filter kategori.
* **Detail Publik (`/blog/{slug}`):** Menampilkan judul, tanggal publikasi, nama penulis, thumbnail, konten teks lengkap, kategori badge, dan artikel terkait.
* **Fungsi CMS Admin:**
* Tambah, edit, dan hapus artikel blog.
* Upload gambar thumbnail.
* Penulisan ringkasan (*excerpt*) untuk cuplikan card.
* Manajemen kategori blog terpisah.
* Pengaturan status publikasi: `draft` atau `published`.
* Menentukan tanggal rilis artikel (`published_at`).



---

### 4.3. Modul Kemitraan (Partnership)

* **Formulir Pengajuan Kemitraan (`/kemitraan`):**
* `Nama Lengkap` (Wajib)
* `Nomor WhatsApp / HP` (Wajib, format angka)
* `Email` (Wajib, format valid email)
* `Nama Usaha / Bisnis` (Opsional, untuk B2B / UMKM)
* `Kota / Kabupaten Domisili` (Wajib)
* `Jenis Kemitraan` (Pilihan dropdown: Distributor, Agen, Reseller, Pasokan Rutin Resto/Katering)
* `Pesan / Keterangan Tambahan` (Opsional)


* **Alur Pemrosesan Data:**
```text
[ Calon Mitra Isi Form ] 
           │
           ▼
[ Validasi Input (FormRequest) ] 
           │
           ▼
[ Tersimpan ke Tabel `partnership_inquiries` ] 
           │
           ▼
[ Muncul di Dashboard Admin ] 
           │
           ▼
[ Admin Klik Tombol "Follow Up via WA" ] ➔ [ Terhubung ke WhatsApp Calon Mitra ]

```


* **Fungsi CMS Admin:**
* Membaca seluruh data prospek kemitraan yang masuk.
* Mengubah status verifikasi prospek (`pending`, `contacted`, `approved`, `rejected`).
* Menyimpan catatan internal admin (*admin_notes*) per prospek.



---

### 4.4. Modul Galeri

* **Tampilan Publik (`/galeri`):** Grid foto fasilitas pabrik/dapur produksi, tim, kegiatan pameran, dan pengiriman barang dengan fitur modal lightbox ketika diklik.
* **Spesifikasi Data Galeri:**
* `Image` (File foto di storage)
* `Title / Caption` (Keterangan foto)
* `Sort Order` (Urutan prioritas penampilan foto)


* **Fungsi CMS Admin:** Upload media foto baru, mengedit caption, mengatur urutan tampil, dan menghapus media.

---

### 4.5. Modul Company Settings (Konfigurasi Dinamis)

Semua informasi perusahaan tidak ditulis secara *hardcode* pada template Blade, melainkan diambil dari tabel `company_settings`:

* `company_name`: Nama resmi brand / perusahaan.
* `company_tagline`: Slogan perusahaan.
* `company_logo`: File path logo di storage.
* `company_address`: Alamat lengkap kantor/pabrik.
* `company_phone`: Nomor telepon kantor.
* `whatsapp_number`: Nomor WA utama (contoh: `6281234567890`).
* `whatsapp_default_message`: Pesan pembuka otomatis saat tombol WA di navbar/floating diklik.
* `company_email`: Alamat email resmi.
* `social_instagram`, `social_facebook`, `social_tiktok`: Tautan akun media sosial resmi.
* `google_maps_embed`: Kode iframe lokasi Google Maps untuk halaman Kontak.
* `footer_text`: Teks deskripsi singkat profil pada footer.

---

### 4.6. Call-to-Action (CTA) WhatsApp Terintegrasi

Tombol CTA WhatsApp disebar pada elemen:

1. **Navbar CTA:** Tombol "Hubungi Kami" / Icon WA mengarah ke chat umum.
2. **Product Detail CTA:** Tombol "Pesan Produk Ini" dengan template nama produk otomatis.
3. **Partnership CTA:** Tombol "Konsultasi Kemitraan via WA".
4. **Floating WhatsApp Button:** Tombol melayang di pojok kanan bawah seluruh halaman publik.

---

## 5. Kebutuhan Search Engine Optimization (SEO)

Setiap halaman publik mengimplementasikan struktur meta tag dinamis untuk visibilitas mesin pencari dan pratinjau media sosial (Open Graph):

* **Halaman Statis & Katalog:**
* `<title>`: `[Judul Halaman] | [Nama Perusahaan]`
* `<meta name="description">`: Deskripsi relevan halaman (maks. 160 karakter).
* `<link rel="canonical">`: URL kanonikal halaman aktif.
* `og:title`, `og:description`, `og:image`, `og:url`, `og:type`.


* **Halaman Dinamis Produk & Blog:**
* Menggunakan `name`/`title` sebagai basis tag `<title>` dan `og:title`.
* Menggunakan `short_description`/`excerpt` sebagai `meta description` dan `og:description`.
* Menggunakan gambar produk / thumbnail blog sebagai `og:image`.
* Menggunakan URL slug absolut sebagai `canonical` dan `og:url`.



---

## 6. Non-Functional Requirements (NFR)

1. **Responsiveness:** Antarmuka responsif pada viewport Mobile (360px+), Tablet (768px+), dan Desktop (1024px+).
2. **Performance:** Semua tag `<img>` menerapkan atribut `loading="lazy"` dan asset dikompilasi via Vite.
3. **Security:** Proteksi rute admin dengan middleware `auth`, sanitasi input via Laravel Form Request, dan CSRF protection pada seluruh form POST/PUT/DELETE.
4. **Data Integrity:** Operasi hapus data pada CMS menghapus relasi file gambar fisik terkait di storage disk.

```

```