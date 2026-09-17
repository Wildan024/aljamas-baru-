<?php

namespace App\Providers;

use App\Models\CompanySetting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Gunakan Tailwind CSS untuk tampilan pagination
        Paginator::defaultView('vendor.pagination.tailwind');
        Paginator::defaultSimpleView('vendor.pagination.simple-tailwind');

        // Share company settings ke seluruh view agar tidak query berulang per request.
        // Sesuai ARCHITECTURE.md Section 8: gunakan View Sharing via AppServiceProvider.
        View::composer('*', function ($view) {
            try {
                $view->with('settings', CompanySetting::getAllAsArray());
            } catch (\Exception $e) {
                // Gracefully skip jika tabel belum tersedia (misal saat migrate awal)
                $view->with('settings', []);
            }
        });
    }
}
