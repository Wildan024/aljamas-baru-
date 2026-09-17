<?php

namespace Tests\Feature;

use App\Models\CompanySetting;
use App\Models\Gallery;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicGalleryTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        CompanySetting::create([
            'key' => 'company_name',
            'value' => 'Aljamas',
        ]);
        CompanySetting::create([
            'key' => 'whatsapp_number',
            'value' => '6281234567890',
        ]);
    }

    public function test_gallery_page_renders_successfully_with_empty_state(): void
    {
        $response = $this->get('/galeri');

        $response->assertStatus(200);
        $response->assertSee('Melihat Lebih Dekat Aktivitas Aljamas');
        $response->assertSee('Dokumentasi Segera Hadir');
        $response->assertSee('Dokumentasi Aljamas');
    }

    public function test_gallery_page_renders_active_records_and_hides_inactive_records(): void
    {
        $activeGallery = Gallery::create([
            'title' => 'Produksi Kulit Dimsum Higienis',
            'description' => 'Proses pengadonan dan pencetakan higienis.',
            'image' => 'galleries/test-active.jpg',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $inactiveGallery = Gallery::create([
            'title' => 'Dokumentasi Rahasia Internal',
            'description' => 'Hanya untuk internal perusahaan.',
            'image' => 'galleries/test-inactive.jpg',
            'is_active' => false,
            'sort_order' => 2,
        ]);

        $response = $this->get('/galeri');

        $response->assertStatus(200);
        $response->assertSee('Produksi Kulit Dimsum Higienis');
        $response->assertSee('Proses pengadonan dan pencetakan higienis.');
        $response->assertDontSee('Dokumentasi Rahasia Internal');
        $response->assertDontSee('Dokumentasi Segera Hadir');
    }

    public function test_gallery_page_orders_by_sort_order_ascending(): void
    {
        $galleryB = Gallery::create([
            'title' => 'Foto Urutan Kedua',
            'image' => 'galleries/b.jpg',
            'is_active' => true,
            'sort_order' => 2,
        ]);

        $galleryA = Gallery::create([
            'title' => 'Foto Urutan Pertama',
            'image' => 'galleries/a.jpg',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $response = $this->get('/galeri');

        $response->assertStatus(200);
        $response->assertSeeInOrder(['Foto Urutan Pertama', 'Foto Urutan Kedua']);
    }

    public function test_gallery_pagination_when_exceeding_15_items(): void
    {
        for ($i = 1; $i <= 18; $i++) {
            $padded = sprintf('%02d', $i);
            Gallery::create([
                'title' => "Galeri Item {$padded}",
                'image' => "galleries/photo-{$i}.jpg",
                'is_active' => true,
                'sort_order' => $i,
            ]);
        }

        $response = $this->get('/galeri');
        $response->assertStatus(200);
        $response->assertSee('Galeri Item 01');
        $response->assertSee('Galeri Item 15');
        $response->assertDontSee('Galeri Item 16');

        $responsePage2 = $this->get('/galeri?page=2');
        $responsePage2->assertStatus(200);
        $responsePage2->assertSee('Galeri Item 16');
        $responsePage2->assertSee('Galeri Item 18');
        $responsePage2->assertDontSee('Galeri Item 01');
    }
}
