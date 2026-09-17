<?php

namespace Tests\Feature;

use App\Models\Blog;
use App\Models\Category;
use App\Models\CompanySetting;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class SeoAndSecurityAuditTest extends TestCase
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
            'key' => 'company_tagline',
            'value' => 'Produsen Kulit Dimsum Berkualitas',
        ]);
        CompanySetting::create([
            'key' => 'whatsapp_number',
            'value' => '6281234567890',
        ]);
    }

    public function test_sitemap_xml_returns_valid_xml_with_public_urls(): void
    {
        $cat = Category::create(['name' => 'Kulit Dimsum', 'slug' => 'kulit-dimsum', 'type' => 'product']);
        $product = Product::create([
            'category_id' => $cat->id,
            'name' => 'Kulit Dimsum Standar',
            'slug' => 'kulit-dimsum-standar',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $blogCat = Category::create(['name' => 'Tips & Resep', 'slug' => 'tips-resep', 'type' => 'blog']);
        $blog = Blog::create([
            'category_id' => $blogCat->id,
            'title' => 'Cara Menyimpan Kulit Dimsum',
            'slug' => 'cara-menyimpan-kulit-dimsum',
            'content' => 'Isi artikel...',
            'status' => 'published',
            'published_at' => now()->subDay(),
        ]);

        $response = $this->get('/sitemap.xml');

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'text/xml; charset=utf-8');
        $response->assertSee(route('home'));
        $response->assertSee(route('products.index'));
        $response->assertSee(route('products.show', $product->slug));
        $response->assertSee(route('blog.index'));
        $response->assertSee(route('blog.show', $blog->slug));
        $response->assertSee(route('gallery.index'));
        $response->assertSee(route('partnership.index'));
        $response->assertDontSee('/admin');
        $response->assertDontSee('/login');
    }

    public function test_robots_txt_disallows_admin_routes(): void
    {
        $robotsContent = file_get_contents(public_path('robots.txt'));

        $this->assertStringContainsString('Disallow: /admin', $robotsContent);
        $this->assertStringContainsString('Disallow: /login', $robotsContent);
        $this->assertStringContainsString('Sitemap: /sitemap.xml', $robotsContent);
    }

    public function test_non_existent_product_slug_returns_404(): void
    {
        $response = $this->get('/produk/produk-yang-tidak-ada');
        $response->assertStatus(404);
        $response->assertSee('Halaman Tidak Ditemukan');
    }

    public function test_inactive_product_slug_returns_404(): void
    {
        $cat = Category::create(['name' => 'Kulit Pangsit', 'slug' => 'kulit-pangsit', 'type' => 'product']);
        $inactiveProduct = Product::create([
            'category_id' => $cat->id,
            'name' => 'Produk Nonaktif',
            'slug' => 'produk-nonaktif',
            'is_active' => false,
            'sort_order' => 1,
        ]);

        $response = $this->get('/produk/' . $inactiveProduct->slug);
        $response->assertStatus(404);
    }

    public function test_draft_and_future_blog_slugs_return_404(): void
    {
        $blogCat = Category::create(['name' => 'Artikel', 'slug' => 'artikel', 'type' => 'blog']);

        $draftBlog = Blog::create([
            'category_id' => $blogCat->id,
            'title' => 'Artikel Masih Draft',
            'slug' => 'artikel-masih-draft',
            'content' => 'Konten draft...',
            'status' => 'draft',
        ]);

        $futureBlog = Blog::create([
            'category_id' => $blogCat->id,
            'title' => 'Artikel Masa Depan',
            'slug' => 'artikel-masa-depan',
            'content' => 'Konten...',
            'status' => 'published',
            'published_at' => now()->addDays(5),
        ]);

        $responseDraft = $this->get('/blog/' . $draftBlog->slug);
        $responseDraft->assertStatus(404);

        $responseFuture = $this->get('/blog/' . $futureBlog->slug);
        $responseFuture->assertStatus(404);
    }

    public function test_company_settings_cache_and_invalidation(): void
    {
        Cache::flush();

        // 1. Get settings and verify cached
        $settings1 = CompanySetting::getAllAsArray();
        $this->assertEquals('Aljamas', $settings1['company_name']);
        $this->assertTrue(Cache::has(CompanySetting::CACHE_KEY));

        // 2. Update via set() and verify cache is invalidated and updated
        CompanySetting::set('company_name', 'Aljamas Prima Food');
        $this->assertFalse(Cache::has(CompanySetting::CACHE_KEY));

        $settings2 = CompanySetting::getAllAsArray();
        $this->assertEquals('Aljamas Prima Food', $settings2['company_name']);
    }
}
