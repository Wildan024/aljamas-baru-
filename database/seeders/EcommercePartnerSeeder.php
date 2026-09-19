<?php

namespace Database\Seeders;

use App\Models\EcommercePartner;
use Illuminate\Database\Seeder;

class EcommercePartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $partners = [
            [
                'name'       => 'Shopee',
                'slug'       => 'shopee',
                'url'        => 'https://shopee.co.id',
                'logo'       => 'ecommerce_partners/shopee.svg',
                'sort_order' => 1,
                'is_active'  => true,
            ],
            [
                'name'       => 'Tokopedia',
                'slug'       => 'tokopedia',
                'url'        => 'https://tokopedia.com',
                'logo'       => 'ecommerce_partners/tokopedia.svg',
                'sort_order' => 2,
                'is_active'  => true,
            ],
            [
                'name'       => 'TikTok Shop',
                'slug'       => 'tiktok-shop',
                'url'        => 'https://www.tiktok.com',
                'logo'       => 'ecommerce_partners/tiktok.svg',
                'sort_order' => 3,
                'is_active'  => true,
            ],
            [
                'name'       => 'Lazada Store',
                'slug'       => 'lazada-store',
                'url'        => 'https://www.lazada.co.id',
                'logo'       => 'ecommerce_partners/lazada.svg',
                'sort_order' => 4,
                'is_active'  => true,
            ],
            [
                'name'       => 'Blibli Official',
                'slug'       => 'blibli-official',
                'url'        => 'https://www.blibli.com',
                'logo'       => 'ecommerce_partners/blibli.svg',
                'sort_order' => 5,
                'is_active'  => true,
            ],
        ];

        foreach ($partners as $partner) {
            EcommercePartner::updateOrCreate(
                ['slug' => $partner['slug']],
                $partner
            );
        }
    }
}
