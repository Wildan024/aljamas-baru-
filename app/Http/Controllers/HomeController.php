<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Gallery;
use App\Models\Product;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Tampilkan halaman utama (Homepage) publik Aljamas.
     * Eager loading kategori untuk mencegah N+1 query.
     */
    public function index(): View
    {
        // 1. Ambil produk aktif & terurut (maks. 6 untuk showcase homepage)
        $featuredProducts = Product::with('category')
            ->active()
            ->ordered()
            ->take(6)
            ->get();

        // 2. Ambil artikel blog yang sudah terbit & terbaru (maks. 3 untuk cuplikan)
        $latestBlogs = Blog::with('category')
            ->published()
            ->latestPublished()
            ->take(3)
            ->get();

        // 3. Ambil galeri foto aktif (maks. 6 untuk preview grid)
        $galleries = Gallery::active()
            ->ordered()
            ->take(6)
            ->get();

        return view('home.index', compact(
            'featuredProducts',
            'latestBlogs',
            'galleries'
        ));
    }
}
