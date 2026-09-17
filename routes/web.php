<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController as PublicProductController;
use App\Http\Controllers\PublicBlogController;
use App\Http\Controllers\PublicGalleryController;
use App\Http\Controllers\PublicPartnershipController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CompanySettingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\PartnershipController as AdminPartnershipController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

// -------------------------------------------------------
// Public Website Routes (Guest Access)
// -------------------------------------------------------
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/produk', [PublicProductController::class, 'index'])->name('products.index');
Route::get('/produk/{slug}', [PublicProductController::class, 'show'])->name('products.show');
Route::get('/blog', [PublicBlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [PublicBlogController::class, 'show'])->name('blog.show');
Route::get('/kemitraan', [PublicPartnershipController::class, 'index'])->name('partnership.index');
Route::post('/kemitraan', [PublicPartnershipController::class, 'store'])
    ->name('partnership.store')
    ->middleware('throttle:10,1');
Route::get('/galeri', [PublicGalleryController::class, 'index'])->name('gallery.index');
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

// -------------------------------------------------------
// Authentication Routes
// -------------------------------------------------------
Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.post')
    ->middleware(['guest', 'throttle:5,1']);

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// -------------------------------------------------------
// Admin CMS Routes (Protected: auth middleware)
// -------------------------------------------------------
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.alt');

    // Products CRUD
    Route::resource('products', ProductController::class)
        ->except(['show']);

    // Blogs CRUD
    Route::resource('blogs', BlogController::class)
        ->except(['show']);

    // Galleries CRUD
    Route::resource('galleries', GalleryController::class)
        ->except(['show']);

    // Partnerships Management
    Route::resource('partnerships', AdminPartnershipController::class)
        ->only(['index', 'show', 'update', 'destroy']);

    // Company Settings
    Route::get('settings', [CompanySettingController::class, 'index'])->name('settings.index');
    Route::put('settings', [CompanySettingController::class, 'update'])->name('settings.update');
});
