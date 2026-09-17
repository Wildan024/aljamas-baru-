<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'title' => 'Fasilitas Dapur Produksi Bersih & Higienis',
                'image' => 'galleries/gallery_production.jpg',
                'description' => 'Aktivitas pengolahan dan pencetakan adonan kulit dimsum dengan standar sanitasi tinggi.',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Proses Uji Elastisitas Lembaran Kulit Dimsum',
                'image' => 'galleries/about_dough_craft.jpg',
                'description' => 'Pemeriksaan ketebalan dan keelastisan adonan agar tidak mudah robek saat proses pembungkusan dan pengukusan.',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Penyusunan Lembaran Kulit Pangsit & Dimsum Segar',
                'image' => 'galleries/workshop_counter.jpg',
                'description' => 'Penyiapan pesanan pasokan rutin untuk mitra restoran, katering, dan produsen frozen food.',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'Bahan Baku Tepung Berkualitas Tinggi',
                'image' => 'galleries/culinary_ingredients.jpg',
                'description' => 'Pemilihan bahan baku tepung premium tanpa bahan pengawet berbahaya untuk rasa gurih alami.',
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'title' => 'Kreasi Olahan Dimsum & Siomay Kukus',
                'image' => 'galleries/dumpling_steamer.jpg',
                'description' => 'Hasil olahan kulit dimsum Aljamas yang lembut, kenyal, dan mempertahankan kelembapan isian dengan sempurna.',
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'title' => 'Pengemasan & Kontrol Mutu Harian',
                'image' => 'galleries/hero_food_production.jpg',
                'description' => 'Proses quality control sebelum pengiriman harian ke seluruh pelanggan dan mitra bisnis.',
                'is_active' => true,
                'sort_order' => 6,
            ],
        ];

        foreach ($items as $item) {
            Gallery::updateOrCreate(
                ['title' => $item['title']],
                $item
            );
        }
    }
}
