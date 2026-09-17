<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PublicPartnershipRequest extends FormRequest
{
    /**
     * Tentukan apakah user diizinkan membuat request ini.
     * Halaman publik dapat diakses oleh semua calon mitra (guest).
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Aturan validasi formulir pengajuan kemitraan publik.
     */
    public function rules(): array
    {
        return [
            'name'             => ['required', 'string', 'max:150'],
            'email'            => ['required', 'email', 'max:150'],
            'phone'            => ['required', 'string', 'max:50'],
            'company'          => ['nullable', 'string', 'max:150'],
            'location'         => ['required', 'string', 'max:255'],
            'partnership_type' => ['required', 'string', 'max:100'],
            'message'          => ['nullable', 'string', 'max:2000'],
        ];
    }

    /**
     * Kustomisasi pesan error validasi dalam Bahasa Indonesia.
     */
    public function messages(): array
    {
        return [
            'name.required'             => 'Nama lengkap wajib diisi.',
            'name.max'                  => 'Nama lengkap maksimal 150 karakter.',
            'email.required'            => 'Alamat email aktif wajib diisi.',
            'email.email'               => 'Format alamat email tidak valid.',
            'email.max'                 => 'Alamat email maksimal 150 karakter.',
            'phone.required'            => 'Nomor telepon / WhatsApp wajib diisi.',
            'phone.max'                 => 'Nomor telepon maksimal 50 karakter.',
            'company.max'               => 'Nama usaha/perusahaan maksimal 150 karakter.',
            'location.required'         => 'Kota / domisili usaha wajib diisi.',
            'location.max'              => 'Lokasi usaha maksimal 255 karakter.',
            'partnership_type.required' => 'Pilihan bentuk kemitraan wajib dipilih.',
            'partnership_type.max'      => 'Pilihan kemitraan maksimal 100 karakter.',
            'message.max'               => 'Pesan maksimal 2000 karakter.',
        ];
    }
}
