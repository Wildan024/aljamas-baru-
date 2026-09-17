<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanySettingRequest;
use App\Models\CompanySetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CompanySettingController extends Controller
{
    /**
     * Tampilkan halaman pengaturan perusahaan dengan seluruh key-value yang tersimpan.
     */
    public function index(): View
    {
        $settings = CompanySetting::getAllAsArray();

        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Update seluruh pengaturan perusahaan.
     */
    public function update(CompanySettingRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        foreach ($validated as $key => $value) {
            CompanySetting::set($key, $value);
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Pengaturan perusahaan berhasil diperbarui.');
    }
}
