<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Gallery;
use App\Models\Partnership;
use App\Models\Product;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Tampilkan halaman dashboard admin dengan statistik ringkasan.
     */
    public function index(): View
    {
        $stats = [
            'products'     => Product::count(),
            'blogs'        => Blog::count(),
            'galleries'    => Gallery::count(),
            'partnerships' => Partnership::count(),
            'new_partnerships' => Partnership::where('status', 'new')->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
