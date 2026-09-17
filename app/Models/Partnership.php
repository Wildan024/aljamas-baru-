<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partnership extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'company',
        'location',
        'partnership_type',
        'message',
        'status',
        'admin_notes',
    ];

    /**
     * Scope: filter berdasarkan status pengajuan.
     */
    public function scopeByStatus($query, string $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope: urutkan dari yang terbaru masuk.
     */
    public function scopeLatest($query)
    {
        return $query->orderByDesc('created_at');
    }

    /**
     * Helper: generate link WhatsApp follow-up ke nomor calon mitra.
     */
    public function whatsappLink(): string
    {
        $phone = preg_replace('/[^0-9]/', '', $this->phone);
        // Konversi awalan 0 menjadi 62 (kode negara Indonesia)
        if (str_starts_with($phone, '0')) {
            $phone = '62' . substr($phone, 1);
        }
        $message = urlencode("Halo {$this->name}, kami dari Aljamas ingin menindaklanjuti pengajuan kemitraan Anda sebagai {$this->partnership_type}. Apakah masih berminat?");
        return "https://wa.me/{$phone}?text={$message}";
    }
}
