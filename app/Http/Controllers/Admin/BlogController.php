<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BlogController extends Controller
{
    /**
     * Tampilkan daftar artikel blog dengan eager loading category (cegah N+1).
     * Diurutkan dari yang terbaru berdasarkan created_at.
     */
    public function index(): View
    {
        $blogs = Blog::with('category')
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('admin.blogs.index', compact('blogs'));
    }

    /**
     * Tampilkan form buat artikel baru.
     * Hanya ambil kategori dengan type='blog'.
     */
    public function create(): View
    {
        $categories = Category::where('type', 'blog')
            ->orderBy('name')
            ->get();

        return view('admin.blogs.create', compact('categories'));
    }

    /**
     * Simpan artikel baru ke database.
     */
    public function store(BlogRequest $request): RedirectResponse
    {
        $data = $request->validated();

        // Generate slug unik dari title
        $data['slug'] = $this->generateUniqueSlug($request->input('title'));

        // Upload thumbnail jika ada
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('blogs', 'public');
        }

        Blog::create($data);

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Artikel "' . $request->input('title') . '" berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit artikel.
     */
    public function edit(Blog $blog): View
    {
        $categories = Category::where('type', 'blog')
            ->orderBy('name')
            ->get();

        return view('admin.blogs.edit', compact('blog', 'categories'));
    }

    /**
     * Update artikel yang sudah ada.
     * Slug hanya diperbarui jika title berubah, demi stabilitas SEO.
     */
    public function update(BlogRequest $request, Blog $blog): RedirectResponse
    {
        $data = $request->validated();

        // Update slug hanya jika title berubah
        if ($blog->title !== $request->input('title')) {
            $data['slug'] = $this->generateUniqueSlug($request->input('title'), $blog->id);
        }

        // Handle upload thumbnail baru
        if ($request->hasFile('image')) {
            // Simpan path thumbnail lama untuk dihapus setelah upload berhasil
            $oldImage = $blog->image;

            // Upload thumbnail baru terlebih dahulu
            $data['image'] = $request->file('image')->store('blogs', 'public');

            // Hapus thumbnail lama setelah upload baru berhasil
            if ($oldImage && Storage::disk('public')->exists($oldImage)) {
                Storage::disk('public')->delete($oldImage);
            }
        }

        $blog->update($data);

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Artikel "' . $blog->title . '" berhasil diperbarui.');
    }

    /**
     * Hapus artikel dan file thumbnail terkait dari storage.
     */
    public function destroy(Blog $blog): RedirectResponse
    {
        $title = $blog->title;

        // Hapus thumbnail dari storage sebelum delete record
        if ($blog->image && Storage::disk('public')->exists($blog->image)) {
            Storage::disk('public')->delete($blog->image);
        }

        $blog->delete();

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Artikel "' . $title . '" berhasil dihapus.');
    }

    /**
     * Generate slug unik dari title.
     * Jika slug sudah ada, tambahkan suffix angka (-1, -2, dst).
     * Mengecualikan ID blog saat ini (untuk update agar tidak konflik dengan diri sendiri).
     */
    private function generateUniqueSlug(string $title, ?int $excludeId = null): string
    {
        $base    = Str::slug($title);
        $slug    = $base;
        $counter = 1;

        while (true) {
            $query = Blog::where('slug', $slug);
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
