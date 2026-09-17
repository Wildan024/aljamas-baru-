<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class CompanySetting extends Model
{
    protected $fillable = [
        'key',
        'value',
    ];

    /**
     * Cache key untuk company settings array.
     */
    public const CACHE_KEY = 'company_settings_array';

    /**
     * Ambil nilai setting berdasarkan key.
     * Mengembalikan $default jika key tidak ditemukan.
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        $settings = static::getAllAsArray();
        return $settings[$key] ?? $default;
    }

    /**
     * Set atau perbarui nilai setting berdasarkan key.
     */
    public static function set(string $key, mixed $value): void
    {
        static::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );

        Cache::forget(self::CACHE_KEY);
    }

    /**
     * Ambil semua setting dalam bentuk array asosiatif [key => value].
     * Dicache untuk performa tinggi dan mencegah query berulang pada view composer.
     */
    public static function getAllAsArray(): array
    {
        return Cache::remember(self::CACHE_KEY, 86400, function () {
            return static::pluck('value', 'key')->toArray();
        });
    }

    /**
     * Hapus cache setting saat ada perubahan data.
     */
    public static function clearCache(): void
    {
        Cache::forget(self::CACHE_KEY);
    }
}
