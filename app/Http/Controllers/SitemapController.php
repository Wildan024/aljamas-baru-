<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Product;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * Generate dynamic sitemap.xml for search engines.
     * Only contains publicly accessible and valid URLs.
     */
    public function index(): Response
    {
        $products = Product::active()->orderByDesc('updated_at')->get();
        $blogs = Blog::published()->latestPublished()->get();

        $urls = [
            [
                'loc'        => route('home'),
                'lastmod'    => now()->toAtomString(),
                'changefreq' => 'daily',
                'priority'   => '1.0',
            ],
            [
                'loc'        => route('products.index'),
                'lastmod'    => $products->first()?->updated_at?->toAtomString() ?? now()->toAtomString(),
                'changefreq' => 'weekly',
                'priority'   => '0.9',
            ],
            [
                'loc'        => route('blog.index'),
                'lastmod'    => $blogs->first()?->updated_at?->toAtomString() ?? now()->toAtomString(),
                'changefreq' => 'daily',
                'priority'   => '0.9',
            ],
            [
                'loc'        => route('gallery.index'),
                'lastmod'    => now()->toAtomString(),
                'changefreq' => 'weekly',
                'priority'   => '0.8',
            ],
            [
                'loc'        => route('partnership.index'),
                'lastmod'    => now()->toAtomString(),
                'changefreq' => 'monthly',
                'priority'   => '0.8',
            ],
        ];

        // Add Active Products
        foreach ($products as $product) {
            $urls[] = [
                'loc'        => route('products.show', $product->slug),
                'lastmod'    => $product->updated_at->toAtomString(),
                'changefreq' => 'weekly',
                'priority'   => '0.8',
            ];
        }

        // Add Published Blogs
        foreach ($blogs as $blog) {
            $urls[] = [
                'loc'        => route('blog.show', $blog->slug),
                'lastmod'    => ($blog->published_at ?? $blog->updated_at)->toAtomString(),
                'changefreq' => 'monthly',
                'priority'   => '0.7',
            ];
        }

        $xml = view('sitemap', compact('urls'))->render();

        return response($xml, 200, [
            'Content-Type' => 'text/xml; charset=utf-8',
        ]);
    }
}
