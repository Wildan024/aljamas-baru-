<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanySettingRequest extends FormRequest
{
    /**
     * Semua admin yang sudah login diizinkan mengakses.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation rules untuk seluruh field company settings.
     */
    public function rules(): array
    {
        return [
            'company_name'             => ['required', 'string', 'max:255'],
            'company_tagline'          => ['nullable', 'string', 'max:255'],
            'company_logo'             => ['nullable', 'string', 'max:255'],
            'company_email'            => ['nullable', 'email', 'max:255'],
            'company_phone'            => ['nullable', 'string', 'max:50'],
            'whatsapp_number'          => ['nullable', 'string', 'max:50'],
            'whatsapp_default_message' => ['nullable', 'string', 'max:500'],
            'company_address'          => ['nullable', 'string', 'max:1000'],
            'google_maps'              => ['nullable', 'string', 'max:1000'],
            'instagram_url'            => ['nullable', 'url', 'max:500'],
            'facebook_url'             => ['nullable', 'url', 'max:500'],
            'tiktok_url'               => ['nullable', 'url', 'max:500'],
            'youtube_url'              => ['nullable', 'url', 'max:500'],
            'footer_text'              => ['nullable', 'string', 'max:1000'],
        ];
    }

    /**
     * Pesan error dalam Bahasa Indonesia.
     */
    public function messages(): array
    {
        return [
            'company_name.required' => 'Nama perusahaan wajib diisi.',
            'company_name.max'      => 'Nama perusahaan maksimal 255 karakter.',
            'company_tagline.max'   => 'Tagline perusahaan maksimal 255 karakter.',
            'company_email.email'   => 'Format email perusahaan tidak valid.',
            'company_email.max'     => 'Email maksimal 255 karakter.',
            'company_phone.max'     => 'Nomor telepon maksimal 50 karakter.',
            'whatsapp_number.max'   => 'Nomor WhatsApp maksimal 50 karakter.',
            'whatsapp_default_message.max' => 'Pesan default WhatsApp maksimal 500 karakter.',
            'company_address.max'   => 'Alamat perusahaan maksimal 1000 karakter.',
            'google_maps.max'       => 'Link Google Maps maksimal 1000 karakter.',
            'instagram_url.url'     => 'Format URL Instagram tidak valid (harus diawali http:// atau https://).',
            'instagram_url.max'     => 'URL Instagram maksimal 500 karakter.',
            'facebook_url.url'      => 'Format URL Facebook tidak valid (harus diawali http:// atau https://).',
            'facebook_url.max'      => 'URL Facebook maksimal 500 karakter.',
            'tiktok_url.url'        => 'Format URL TikTok tidak valid (harus diawali http:// atau https://).',
            'tiktok_url.max'        => 'URL TikTok maksimal 500 karakter.',
            'youtube_url.url'       => 'Format URL YouTube tidak valid (harus diawali http:// atau https://).',
            'youtube_url.max'       => 'URL YouTube maksimal 500 karakter.',
            'footer_text.max'       => 'Teks footer maksimal 1000 karakter.',
        ];
    }
}
