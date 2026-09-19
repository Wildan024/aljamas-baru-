<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EcommercePartner extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'url',
        'logo',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active'  => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Auto-generate unique slug jika belum diisi.
     */
    protected static function booted(): void
    {
        static::saving(function (self $partner) {
            if (empty($partner->slug) && !empty($partner->name)) {
                $baseSlug = Str::slug($partner->name);
                $slug = $baseSlug;
                $counter = 1;

                while (static::where('slug', $slug)->where('id', '!=', $partner->id ?? 0)->exists()) {
                    $slug = $baseSlug . '-' . $counter++;
                }

                $partner->slug = $slug;
            }
        });
    }

    /**
     * Scope: Hanya partner yang aktif.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope: Urutkan berdasarkan sort_order asc, lalu id asc.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc')->orderBy('id', 'asc');
    }

    /**
     * Accessor untuk URL logo.
     */
    public function getLogoUrlAttribute(): ?string
    {
        if ($this->logo) {
            if (Storage::disk('public')->exists($this->logo)) {
                return Storage::disk('public')->url($this->logo);
            }
            if (file_exists(public_path($this->logo))) {
                return asset($this->logo);
            }
        }

        return null;
    }
}
