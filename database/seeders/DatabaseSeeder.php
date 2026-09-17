<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * Urutan eksekusi: admin user → company settings → categories
     */
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            CompanySettingSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            GallerySeeder::class,
        ]);
    }
}
