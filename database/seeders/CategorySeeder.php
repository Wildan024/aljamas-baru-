<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Seeder kategori produk dan blog default.
     */
    public function run(): void
    {
        // Kategori Produk
        $productCategories = [
            'Kulit Dimsum',
            'Kulit Pangsit',
            'Kulit Samosa',
            'Mie Segar',
        ];

        foreach ($productCategories as $name) {
            Category::updateOrCreate(
                ['slug' => Str::slug($name), 'type' => 'product'],
                ['name' => $name]
            );
        }

        // Kategori Blog
        $blogCategories = [
            'Tips & Resep',
            'Berita Perusahaan',
            'Info Produk',
            'Kemitraan',
        ];

        foreach ($blogCategories as $name) {
            Category::updateOrCreate(
                ['slug' => Str::slug($name), 'type' => 'blog'],
                ['name' => $name]
            );
        }
    }
}
