<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BlogRequest extends FormRequest
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
            'title'        => ['required', 'string', 'max:255'],
            'category_id'  => [
                'required',
                'integer',
                // Pastikan kategori benar-benar bertipe 'blog', bukan hanya ada di tabel
                Rule::exists('categories', 'id')->where('type', 'blog'),
            ],
            'excerpt'      => ['nullable', 'string', 'max:500'],
            'content'      => ['required', 'string'],
            'image'        => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'status'       => ['required', Rule::in(['draft', 'published'])],
            'published_at' => ['nullable', 'date'],
        ];
    }

    /**
     * Pesan error dalam Bahasa Indonesia.
     */
    public function messages(): array
    {
        return [
            'title.required'       => 'Judul artikel wajib diisi.',
            'title.max'            => 'Judul artikel maksimal 255 karakter.',
            'category_id.required' => 'Kategori blog wajib dipilih.',
            'category_id.exists'   => 'Kategori yang dipilih tidak valid atau bukan kategori blog.',
            'content.required'     => 'Konten artikel wajib diisi.',
            'image.image'          => 'File harus berupa gambar.',
            'image.mimes'          => 'Format gambar harus JPG, JPEG, PNG, atau WebP.',
            'image.max'            => 'Ukuran gambar maksimal 2 MB.',
            'status.required'      => 'Status publikasi wajib dipilih.',
            'status.in'            => 'Status harus berupa draft atau published.',
            'published_at.date'    => 'Tanggal publikasi tidak valid.',
        ];
    }

    /**
     * Prepare data sebelum validasi.
     * Jika status = published dan published_at kosong, isi dengan waktu sekarang.
     */
    protected function prepareForValidation(): void
    {
        if ($this->input('status') === 'published' && empty($this->input('published_at'))) {
            $this->merge([
                'published_at' => now()->format('Y-m-d\TH:i'),
            ]);
        }
    }
}
