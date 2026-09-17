<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GalleryRequest extends FormRequest
{
    /**
     * Semua admin yang sudah login diizinkan mengakses.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation rules sesuai SCHEMA.md dan RULES.md.
     * Image wajib saat CREATE, optional saat UPDATE.
     */
    public function rules(): array
    {
        // Deteksi apakah ini request UPDATE (route memiliki parameter gallery)
        $isUpdate = $this->route('gallery') !== null;

        return [
            'title'       => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'image'       => [
                $isUpdate ? 'nullable' : 'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
            'is_active'   => ['nullable', 'boolean'],
            'sort_order'  => ['nullable', 'integer', 'min:0'],
        ];
    }

    /**
     * Pesan error dalam Bahasa Indonesia.
     */
    public function messages(): array
    {
        return [
            'title.max'        => 'Judul maksimal 255 karakter.',
            'description.max'  => 'Deskripsi maksimal 1000 karakter.',
            'image.required'   => 'File gambar wajib diunggah.',
            'image.image'      => 'File harus berupa gambar.',
            'image.mimes'      => 'Format gambar harus JPG, JPEG, PNG, atau WebP.',
            'image.max'        => 'Ukuran gambar maksimal 2 MB.',
            'sort_order.min'   => 'Urutan tampil tidak boleh negatif.',
            'sort_order.integer' => 'Urutan tampil harus berupa angka.',
        ];
    }

    /**
     * Normalisasi is_active dan sort_order sebelum validasi.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_active'  => $this->boolean('is_active'),
            'sort_order' => $this->input('sort_order', 0),
        ]);
    }
}
