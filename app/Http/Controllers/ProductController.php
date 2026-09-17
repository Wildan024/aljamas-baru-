<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Tampilkan katalog produk publik.
     * Mendukung filter kategori opsional via query param 'kategori'.
     * Menggunakan eager loading 'category' untuk mencegah N+1 query.
     */
    public function index(Request $request): View
    {
        $selectedCategorySlug = $request->query('kategori');

        // Ambil kategori khusus produk untuk filter tab
        $categories = Category::where('type', 'product')
            ->orderBy('name')
            ->get();

        $query = Product::with('category')->active()->ordered();

        if ($selectedCategorySlug) {
            $query->whereHas('category', function ($q) use ($selectedCategorySlug) {
                $q->where('slug', $selectedCategorySlug);
            });
        }

        $products = $query->get();

        return view('products.index', compact('products', 'categories', 'selectedCategorySlug'));
    }

    /**
     * Tampilkan halaman detail produk publik berdasarkan slug.
     * Memastikan hanya produk aktif yang dapat diakses (produk nonaktif menghasilkan 404).
     */
    public function show(string $slug): View
    {
        $product = Product::with('category')
            ->where('slug', $slug)
            ->firstOrFail();

        // Verifikasi status aktif produk
        if (!$product->is_active) {
            abort(404);
        }

        // Ambil produk aktif lainnya sebagai rekomendasi (maks. 3, kecuali produk ini)
        $relatedProducts = Product::with('category')
            ->active()
            ->where('id', '!=', $product->id)
            ->ordered()
            ->limit(3)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }
}
