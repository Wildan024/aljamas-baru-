<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'name'              => ['required', 'string', 'max:255'],
            'category_id'       => ['nullable', 'integer', 'exists:categories,id'],
            'short_description' => ['nullable', 'string', 'max:500'],
            'description'       => ['nullable', 'string'],
            'image'             => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'is_active'         => ['nullable', 'boolean'],
            'sort_order'        => ['nullable', 'integer', 'min:0'],
        ];
    }

    /**
     * Pesan error dalam Bahasa Indonesia.
     */
    public function messages(): array
    {
        return [
            'name.required'         => 'Nama produk wajib diisi.',
            'name.max'              => 'Nama produk maksimal 255 karakter.',
            'category_id.exists'    => 'Kategori yang dipilih tidak valid.',
            'short_description.max' => 'Ringkasan singkat maksimal 500 karakter.',
            'image.image'           => 'File harus berupa gambar.',
            'image.mimes'           => 'Format gambar harus JPG, JPEG, PNG, atau WebP.',
            'image.max'             => 'Ukuran gambar maksimal 2 MB.',
            'sort_order.min'        => 'Urutan tampil tidak boleh negatif.',
        ];
    }

    /**
     * Prepare data sebelum validasi: normalisasi is_active dan sort_order.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_active'  => $this->boolean('is_active'),
            'sort_order' => $this->input('sort_order', 0),
        ]);
    }
}
