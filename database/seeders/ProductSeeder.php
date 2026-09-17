<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Seed initial catalog products with accurate categories and high-quality photography.
     */
    public function run(): void
    {
        $catDimsum = Category::where('slug', 'kulit-dimsum')->where('type', 'product')->first();
        $catPangsit = Category::where('slug', 'kulit-pangsit')->where('type', 'product')->first();
        $catSamosa = Category::where('slug', 'kulit-samosa')->where('type', 'product')->first();
        $catMie = Category::where('slug', 'mie-segar')->where('type', 'product')->first();

        $products = [
            [
                'name' => 'Kulit Dimsum Bulat Premium Special',
                'slug' => 'kulit-dimsum-premium-special',
                'category_id' => $catDimsum?->id,
                'image' => 'products/kulit-dimsum-premium-special.webp',
                'short_description' => 'Kulit dimsum bulat premium bertekstur lembut, lentur elastis, dan tidak mudah sobek saat dikukus.',
                'description' => "Spesifikasi Produk:\n- Bentuk: Bulat presisi diameter 8 cm\n- Isi: 50 lembar per pack\n- Karakteristik: Elastis, tidak mudah kering, higienis tanpa bahan pengawet berbahaya\n- Aplikasi Ideal: Siomay ayam/udang, Hakau, Gyoza, Dimsum kukus\n- Ketahanan: 3 hari suhu ruang sejuk, 1 bulan di freezer beku",
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Kulit Pangsit Goreng Crispy',
                'slug' => 'kulit-pangsit-goreng-crispy',
                'category_id' => $catPangsit?->id,
                'image' => 'products/kulit-pangsit-goreng-crispy.webp',
                'short_description' => 'Kulit pangsit kotak renyah gurih tahan lama, mekar sempurna dan menyerap minyak minimal saat digoreng.',
                'description' => "Spesifikasi Produk:\n- Bentuk: Persegi 10x10 cm\n- Isi: 50 lembar per pack\n- Karakteristik: Sangat renyah, mekar bergelembung khas gorengan premium, tidak cepat melempem\n- Aplikasi Ideal: Pangsit goreng bakso, Batagor, Keripik pangsit bumbu, Topping mie ayam\n- Ketahanan: 4 hari suhu ruang sejuk, 1 bulan di freezer",
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Kulit Samosa & Martabak Segar',
                'slug' => 'kulit-samosa-segar',
                'category_id' => $catSamosa?->id,
                'image' => 'products/kulit-samosa-segar.webp',
                'short_description' => 'Lembaran kulit pastry samosa tipis berlapis, mudah dilipat tanpa retak untuk gorengan renyah keemasan.',
                'description' => "Spesifikasi Produk:\n- Bentuk: Persegi panjang & segitiga presisi\n- Isi: 40 lembar per pack\n- Karakteristik: Tipis merata, tekstur flaky renyah berlapis saat digoreng atau dipanggang\n- Aplikasi Ideal: Samosa daging/sayur, Martabak telur mini, Lumpia keju, Spring roll\n- Ketahanan: 3 hari suhu ruang, 1 bulan di freezer",
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Mie Basah & Mie Telur Segar Spesial',
                'slug' => 'mie-basah-segar-spesial',
                'category_id' => $catMie?->id,
                'image' => 'products/mie-basah-segar-spesial.webp',
                'short_description' => 'Mie basah segar kenyal dari tepung berprotein tinggi dan telur pilihan, bebas formalin dan boraks.',
                'description' => "Spesifikasi Produk:\n- Bentuk: Untaian mie bulat kenyal (porsi roll nest)\n- Isi: 1 kg (10-12 porsi porsi mangkuk)\n- Karakteristik: Kenyal alami, tidak lembek saat direbus, menyerap kuah dan bumbu dengan sempurna\n- Aplikasi Ideal: Mie ayam, Ramen kuah, Bakmi goreng, Mie rebus Jawa\n- Ketahanan: 2 hari suhu chiller, 2 minggu di freezer beku",
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'Kulit Pangsit Rebus / Kuah Lembut',
                'slug' => 'kulit-pangsit-rebus-kuah',
                'category_id' => $catPangsit?->id,
                'image' => 'products/kulit-pangsit-rebus-kuah.webp',
                'short_description' => 'Kulit pangsit sutra khusus rebus dengan ketipisan ekstra halus, kenyal lembut dan tidak pecah dalam kuah.',
                'description' => "Spesifikasi Produk:\n- Bentuk: Persegi 9x9 cm lembut\n- Isi: 50 lembar per pack\n- Karakteristik: Tekstur sutra lembut (silky), transparan saat matang, mengunci sari daging isian\n- Aplikasi Ideal: Pangsit kuah, Wonton soup, Suikiaw, Mandu rebus\n- Ketahanan: 3 hari suhu ruang, 1 bulan di freezer",
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'name' => 'Kulit Dimsum Warna & Sayur Alami',
                'slug' => 'kulit-dimsum-warna-alami',
                'category_id' => $catDimsum?->id,
                'image' => 'products/kulit-dimsum-warna-alami.webp',
                'short_description' => 'Kulit dimsum aneka warna dari ekstrak sari bayam hijau dan wortel alami tanpa pewarna sintetis.',
                'description' => "Spesifikasi Produk:\n- Warna: Hijau (Bayam) & Oranye (Wortel)\n- Bentuk: Bulat diameter 8 cm\n- Isi: 50 lembar per pack (mix warna)\n- Karakteristik: Bernutrisi, warna cerah alami yang stabil saat dikukus, menggugah selera\n- Aplikasi Ideal: Dimsum sayur, Dumpling pesta katering, Siomay warna-warni\n- Ketahanan: 3 hari suhu ruang, 1 bulan di freezer",
                'is_active' => true,
                'sort_order' => 6,
            ],
        ];

        foreach ($products as $data) {
            Product::updateOrCreate(
                ['slug' => $data['slug']],
                $data
            );
        }

        // Also update any legacy products if present
        $legacy = Product::where('slug', 'kulit-dimsum-premium-1')->first();
        if ($legacy) {
            $legacy->update([
                'image' => 'products/kulit-dimsum-premium-special.webp',
                'short_description' => 'Kulit dimsum premium bertekstur elastis, lembut, dan tidak mudah sobek saat dikukus.',
            ]);
        }
    }
}
