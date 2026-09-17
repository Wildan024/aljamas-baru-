<?php

namespace Database\Seeders;

use App\Models\CompanySetting;
use Illuminate\Database\Seeder;

class CompanySettingSeeder extends Seeder
{
    /**
     * Seeder data default company settings.
     * Semua key wajib sesuai dengan daftar di SCHEMA.md.
     */
    public function run(): void
    {
        $defaults = [
            'company_name'              => 'Aljamas',
            'company_tagline'           => 'Solusi Kulit & Produk Adonan Berkualitas untuk Bisnis Kuliner',
            'company_logo'              => null,
            'company_email'             => 'info@aljamas.com',
            'company_phone'             => '021-00000000',
            'whatsapp_number'           => '6281234567890',
            'whatsapp_default_message'  => 'Halo, saya ingin bertanya tentang produk Aljamas.',
            'company_address'           => 'Jl. Contoh No. 1, Jakarta, Indonesia',
            'google_maps'               => '',
            'instagram_url'             => '',
            'facebook_url'              => '',
            'tiktok_url'                => '',
            'youtube_url'               => '',
            'footer_text'               => 'Produsen kulit dimsum, kulit pangsit, kulit samosa, dan mie segar berkualitas untuk kebutuhan usaha kuliner Anda.',
        ];

        foreach ($defaults as $key => $value) {
            CompanySetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }
    }
}
