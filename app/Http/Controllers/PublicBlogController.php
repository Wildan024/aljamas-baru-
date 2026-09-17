<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PublicBlogController extends Controller
{
    /**
     * Tampilkan halaman daftar artikel blog publik.
     * Menggunakan eager loading category untuk mencegah N+1.
     * Pada halaman 1: artikel published terbaru menjadi $featuredBlog, dan 9 artikel berikutnya dipaginasi dalam grid.
     * Pada halaman >= 2: $featuredBlog tidak ditampilkan dan tetap dieksklusi dari grid agar tidak terjadi duplikasi.
     */
    public function index(Request $request): View
    {
        $currentPage = (int) $request->query('page', 1);

        // Ambil ID artikel published terbaru sebagai kandidat featured
        $firstBlog = Blog::with('category')->latestPublished()->first();

        // Jika ada artikel published, artikel pertama dijadikan featured di halaman 1
        $featuredBlog = ($currentPage === 1) ? $firstBlog : null;

        // Query artikel untuk grid: selalu kecualikan $firstBlog (jika ada) agar tidak duplikat di halaman mana pun
        $query = Blog::with('category')->latestPublished();

        if ($firstBlog) {
            $query->where('id', '!=', $firstBlog->id);
        }

        $blogs = $query->paginate(9)->withQueryString();

        return view('blog.index', compact('featuredBlog', 'blogs'));
    }

    /**
     * Tampilkan halaman detail artikel blog publik berdasarkan slug.
     * Hanya artikel berstatus published dan published_at <= now() yang dapat diakses (draft menghasilkan 404).
     */
    public function show(string $slug): View
    {
        $blog = Blog::with('category')
            ->published()
            ->where('slug', $slug)
            ->firstOrFail();

        // Ambil hingga 3 artikel terkait yang sudah published (prioritas kategori yang sama, bukan artikel ini)
        $relatedQuery = Blog::with('category')
            ->published()
            ->where('id', '!=', $blog->id);

        if ($blog->category_id) {
            $relatedQuery->where('category_id', $blog->category_id);
        }

        $relatedBlogs = $relatedQuery->latestPublished()->limit(3)->get();

        // Jika artikel dalam kategori yang sama kurang dari 3, lengkapi dengan artikel published lainnya
        if ($relatedBlogs->count() < 3) {
            $excludeIds = $relatedBlogs->pluck('id')->push($blog->id)->all();
            $additionalCount = 3 - $relatedBlogs->count();

            $additionalBlogs = Blog::with('category')
                ->published()
                ->whereNotIn('id', $excludeIds)
                ->latestPublished()
                ->limit($additionalCount)
                ->get();

            $relatedBlogs = $relatedBlogs->concat($additionalBlogs);
        }

        return view('blog.show', compact('blog', 'relatedBlogs'));
    }
}
