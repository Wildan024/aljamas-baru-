<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'type',
    ];

    /**
     * Relasi ke produk (hanya kategori bertipe 'product').
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Relasi ke artikel blog (hanya kategori bertipe 'blog').
     */
    public function blogs(): HasMany
    {
        return $this->hasMany(Blog::class);
    }
}
