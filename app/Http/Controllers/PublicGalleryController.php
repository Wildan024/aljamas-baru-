<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\View\View;

class PublicGalleryController extends Controller
{
    /**
     * Tampilkan halaman Galeri Dokumentasi publik.
     * Hanya mengambil foto yang berstatus aktif (is_active = true) dengan urutan sort_order.
     */
    public function index(): View
    {
        $galleries = Gallery::active()
            ->ordered()
            ->paginate(15);

        return view('gallery.index', compact('galleries'));
    }
}
