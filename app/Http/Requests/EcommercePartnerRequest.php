<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EcommercePartnerRequest extends FormRequest
{
    /**
     * Semua admin yang login diizinkan.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Rules validasi data E-Commerce Partner.
     */
    public function rules(): array
    {
        return [
            'name'       => ['required', 'string', 'max:255'],
            'url'        => ['required', 'url', 'max:500'],
            'logo'       => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active'  => ['nullable', 'boolean'],
        ];
    }

    /**
     * Pesan error dalam Bahasa Indonesia.
     */
    public function messages(): array
    {
        return [
            'name.required'      => 'Nama partner e-commerce wajib diisi.',
            'name.max'           => 'Nama partner e-commerce maksimal 255 karakter.',
            'url.required'       => 'URL tujuan e-commerce wajib diisi.',
            'url.url'            => 'Format URL tujuan tidak valid (harus diawali http:// atau https://).',
            'url.max'            => 'URL tujuan maksimal 500 karakter.',
            'logo.image'         => 'File logo harus berupa gambar.',
            'logo.mimes'         => 'Format logo harus JPG, JPEG, PNG, WebP, atau SVG.',
            'logo.max'           => 'Ukuran logo maksimal 2 MB.',
            'sort_order.integer' => 'Urutan tampil harus berupa angka.',
            'sort_order.min'     => 'Urutan tampil tidak boleh negatif.',
        ];
    }

    /**
     * Normalisasi is_active dan sort_order sebelum validasi.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_active'  => $this->boolean('is_active'),
            'sort_order' => (int) $this->input('sort_order', 0),
        ]);
    }
}
