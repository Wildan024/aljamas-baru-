<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Tampilkan daftar produk dengan eager loading category (cegah N+1).
     * Diurutkan berdasarkan sort_order ASC, kemudian created_at DESC.
     */
    public function index(): View
    {
        $products = Product::with('category')
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('admin.products.index', compact('products'));
    }

    /**
     * Tampilkan form buat produk baru.
     * Hanya ambil kategori dengan type='product'.
     */
    public function create(): View
    {
        $categories = Category::where('type', 'product')
            ->orderBy('name')
            ->get();

        return view('admin.products.create', compact('categories'));
    }

    /**
     * Simpan produk baru ke database.
     */
    public function store(ProductRequest $request): RedirectResponse
    {
        $data = $request->validated();

        // Generate slug unik dari name
        $data['slug'] = $this->generateUniqueSlug($request->input('name'));

        // Upload image jika ada
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk "' . $request->input('name') . '" berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit produk.
     */
    public function edit(Product $product): View
    {
        $categories = Category::where('type', 'product')
            ->orderBy('name')
            ->get();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update produk yang sudah ada.
     * Slug TIDAK diubah otomatis jika nama berubah (demi SEO stability).
     */
    public function update(ProductRequest $request, Product $product): RedirectResponse
    {
        $data = $request->validated();

        // Hanya update slug jika slug belum pernah diset ATAU admin secara eksplisit memintanya
        // Sesuai SCHEMA.md: slug tidak boleh berubah otomatis saat edit
        if (empty($product->slug)) {
            $data['slug'] = $this->generateUniqueSlug($request->input('name'), $product->id);
        }

        // Handle upload image baru
        if ($request->hasFile('image')) {
            // Hapus image lama secara aman jika ada
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk "' . $product->name . '" berhasil diperbarui.');
    }

    /**
     * Hapus produk dan file image terkait dari storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        $name = $product->name;

        // Hapus image dari storage sebelum delete record
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk "' . $name . '" berhasil dihapus.');
    }

    /**
     * Generate slug unik. Jika slug sudah ada, tambahkan suffix angka.
     * Mengecualikan ID produk saat ini (untuk update).
     */
    private function generateUniqueSlug(string $name, ?int $excludeId = null): string
    {
        $base = Str::slug($name);
        $slug = $base;
        $counter = 1;

        while (true) {
            $query = Product::where('slug', $slug);
            if ($excludeId) {
                $query->where('id', '!=', $excludeId);
            }
            if (!$query->exists()) {
                break;
            }
            $slug = $base . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
