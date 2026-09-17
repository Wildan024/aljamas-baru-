# Design System & UI/UX Guidelines (DESIGN.md)

## 1. Design Tokens (Pasti & Konsisten)

Dilarang mencampur atau menggunakan kelas `green-*` maupun `emerald-*` Tailwind secara acak. Seluruh styling warna wajib menggunakan nilai hex dan variabel token berikut:

| Token Desain | Kode HEX | Peran & Penggunaan |
| :--- | :--- | :--- |
| **Primary** | `#238B45` | Tombol primer, link aktif, border fokus, aksen utama brand |
| **Primary Hover** | `#1E7A3B` | State hover untuk tombol dan elemen interaktif primer |
| **Primary Light** | `#EAF6EE` | Background badge kategori, latar elemen highlight |
| **Dark** | `#163326` | Hero background, sidebar admin, footer, heading utama |
| **Text** | `#1F2937` | Teks paragraf utama (body text) |
| **Muted** | `#6B7280` | Teks sekunder, tanggal rilis blog, label kecil, placeholder |
| **Background** | `#FFFFFF` | Latar utama website dan card putih |
| **Background Soft**| `#F7FAF8` | Latar section bergantian, container foto produk |
| **Border** | `#E5E7EB` | Garis pemisah, border card, border input |
| **WhatsApp** | `#25D366` | Tombol CTA direct chat WhatsApp |
| **Danger / Alert** | `#E11D48` | Pesan validasi error dan tombol hapus data CMS |

---

## 2. Typography System

* **Font Utama:** `Poppins`, sans-serif (Google Fonts)
* **Font Alternatif:** `Inter`, sans-serif (untuk body text panjang)

### Skala & Hierarki Teks:
* **H1 (Hero Title):**
  * Desktop: `40px` – `56px` (`font-extrabold`, `leading-tight`)
  * Mobile: `32px` – `40px` (`font-bold`)
* **H2 (Section Heading):**
  * Desktop: `32px` – `40px` (`font-bold`, `leading-snug`)
  * Mobile: `26px` – `32px` (`font-bold`)
* **H3 (Card Heading):**
  * Desktop & Mobile: `20px` – `24px` (`font-semibold`)
* **Body Text (P):**
  * Desktop: `16px` (`font-normal`, `leading-relaxed`, color: `#1F2937`)
  * Mobile: `15px` – `16px`
* **Small / Meta / Eyebrow:**
  * Desktop & Mobile: `14px` (`font-medium`, tracking uppercase untuk label seksi)

---

## 3. Spacing, Layout & Container Rules

* **Container Max-Width:** `1200px` (terpusat via `mx-auto`)
* **Container Padding:**
  * Desktop: `px-6` (`24px`)
  * Mobile: `px-4` (`16px`)
* **Section Vertical Spacing (Padding Y):**
  * Desktop: `py-20` – `py-24` (`80px` – `100px`)
  * Mobile: `py-14` – `py-18` (`56px` – `72px`)

---

## 4. Standard Border Radius System

Gunakan nilai radius seragam di seluruh aplikasi:
* **Cards (Product, Blog, Gallery):** `rounded-2xl` (`16px`)
* **Buttons:** `rounded-[10px]` (`10px`)
* **Form Inputs / Textareas / Selects:** `rounded-[10px]` (`10px`)
* **Images (Container & Thumbnails):** `rounded-2xl` (`16px`)
* **Badges / Status Pills / Floating WA:** `rounded-full` (`9999px`)

---

## 5. Standard Button Specifications

* **Primary Button:**
  * Background: `#238B45` (Hover: `#1E7A3B`)
  * Text: `#FFFFFF` (`font-semibold`)
  * Height: `44px` – `48px`
  * Radius: `10px`
  * Class Tailwind: `h-12 px-6 bg-[#238B45] hover:bg-[#1E7A3B] text-white font-semibold rounded-[10px] shadow-sm hover:shadow transition-all duration-200 inline-flex items-center justify-center gap-2`

* **Secondary Button:**
  * Background: `transparent` (Hover: `#EAF6EE`)
  * Border: `2px solid #238B45`
  * Text: `#238B45` (`font-semibold`)
  * Class Tailwind: `h-12 px-6 border-2 border-[#238B45] text-[#238B45] hover:bg-[#EAF6EE] font-semibold rounded-[10px] transition-all duration-200 inline-flex items-center justify-center gap-2`

* **WhatsApp CTA Button:**
  * Background: `#25D366` (Hover: `#20BA5A`)
  * Text: `#FFFFFF` (`font-semibold`)
  * Class Tailwind: `h-11 px-5 bg-[#25D366] hover:bg-[#20ba5a] text-white font-semibold rounded-full shadow-sm hover:shadow transition-all duration-200 inline-flex items-center justify-center gap-2`

---

## 6. Navigation Bar (Public)

* **Behavior:** Sticky navigation bar (`sticky top-0 z-50 bg-white/95 backdrop-blur-sm border-b border-[#E5E7EB] shadow-sm`). Tidak menggunakan navbar transparan demi keterbacaan teks.
* **Layout Desktop (> 1024px):**
  * Kiri: Logo Brand
  * Tengah/Kanan: Menu Navigasi (`Home`, `Tentang Kami`, `Produk`, `Kemitraan`, `Blog`, `Galeri`, `Kontak`)
  * Kanan: Tombol CTA WhatsApp
* **Layout Mobile (< 1024px):**
  * Kiri: Logo Brand
  * Kanan: Tombol Hamburger Menu
  * Drawer: Menu drop-down solid putih dengan padding touch target minimal `44px`.

---

## 7. Standard Section Header Pattern

Setiap seksi di halaman publik wajib mengikuti struktur hierarki berikut:

```text
Section Header
├── 1. Eyebrow Label : Text 14px, uppercase, bold, color: #238B45, tracking-wider
├── 2. Heading (H2)  : Text 32-40px, bold, color: #163326, mb-3
└── 3. Description   : Text 16px, color: #6B7280, max-w-2xl mx-auto mb-10
8. Hero Section Specification
Plaintext
Hero Section
├── Eyebrow / Badge     : "PRODUSEN KULIT & ADONAN MAKANAN TERPERCAYA"
├── Heading Utama (H1)  : "Solusi Kulit & Produk Adonan Berkualitas untuk Bisnis Kuliner"
├── Short Description   : "Kulit dimsum, pangsit, samosa, dan mie dengan kualitas konsisten untuk kebutuhan usaha dan produksi Anda."
├── Action Area         : [ Lihat Produk (Primary) ] [ Hubungi Kami (Secondary) ]
└── Visual Media        : Foto produk / fasilitas dapur produksi berkualitas tinggi
Latar belakang: #163326 (Dark) atau putih bersih dengan aksen container produk #F7FAF8.

9. Product Card & Image Treatment
Khusus produk makanan (Kulit Dimsum, Kulit Pangsit, Kulit Samosa, Mie):

Image Container:

Aspect ratio: 1:1 (Square)

Background: #F7FAF8 (mencegah gambar berlatar putih terlihat melayang tanpa batas)

Border radius: 16px

Image rendering: object-cover / object-contain

Card Structure:

Plaintext
Product Card (bg-white border border-[#E5E7EB] rounded-2xl p-5 hover:-translate-y-1 transition)
├── 1. Image Container (Aspect 1:1, bg-[#F7FAF8], rounded-xl)
├── 2. Category Badge  (bg-[#EAF6EE] text-[#238B45] text-xs font-semibold rounded-full px-3 py-1 mt-4)
├── 3. Product Name    (H3 text-lg font-bold text-[#163326] mt-2)
├── 4. Short Excerpt   (Text 14px text-[#6B7280] line-clamp-2 mt-1 mb-4)
└── 5. Action Link     ("Lihat Detail →" text-[#238B45] font-semibold hover:underline)
10. Responsive Breakpoints & Grid System
Breakpoints:

Mobile: < 640px

Tablet: 640px – 1024px

Desktop: > 1024px

Grid Rules:

Mobile: grid-cols-1 (CTA full-width jika diperlukan)

Tablet: grid-cols-2

Desktop:

Product Catalog: grid-cols-3 atau grid-cols-4

Blog Articles: grid-cols-3

Galleries: grid-cols-3 atau grid-cols-4

11. Animation & Interaction Standard
Subtle & Snappy: Transisi lembut durasi 200ms – 300ms (transition-all duration-200 ease-in-out).

Card Hover Effect: hover:-translate-y-1 hover:shadow-md

Dilarang: Parallax berlebihan, animasi berputar tanpa henti, teks memantul (bouncing), atau fade-in yang memperlambat pembacaan konten.

12. Accessibility & Mobile-First Policy
Mobile-First Construction: Seluruh view Blade dibangun dari tampilan layar kecil (w-full), lalu diperluas secara bertahap menggunakan prefix Tailwind (sm:, md:, lg:).

Touch Target: Semua tombol dan link di mobile memiliki ukuran area sentuh minimal 44px x 44px.

Image Alt Text: Setiap tag <img> wajib memiliki atribut alt yang deskriptif.

Text Contrast: Rasio kontras teks #1F2937 terhadap #FFFFFF dan teks #FFFFFF terhadap #238B45 / #163326 memenuhi standar keterbacaan WCAG AA.

Focus States: Input dan tombol memiliki outline fokus jelas (focus:ring-2 focus:ring-[#238B45] focus:outline-none).