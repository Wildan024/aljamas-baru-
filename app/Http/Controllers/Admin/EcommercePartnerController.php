<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EcommercePartnerRequest;
use App\Models\EcommercePartner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class EcommercePartnerController extends Controller
{
    /**
     * Tampilkan daftar seluruh partner e-commerce.
     */
    public function index(): View
    {
        $partners = EcommercePartner::ordered()->paginate(15);

        return view('admin.ecommerce-partners.index', compact('partners'));
    }

    /**
     * Tampilkan form tambah partner e-commerce.
     */
    public function create(): View
    {
        return view('admin.ecommerce-partners.create');
    }

    /**
     * Simpan partner e-commerce baru.
     */
    public function store(EcommercePartnerRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('ecommerce_partners', 'public');
        }

        EcommercePartner::create($data);

        return redirect()->route('admin.ecommerce-partners.index')
            ->with('success', 'Partner e-commerce berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit partner e-commerce.
     */
    public function edit(EcommercePartner $ecommercePartner): View
    {
        return view('admin.ecommerce-partners.edit', compact('ecommercePartner'));
    }

    /**
     * Update data partner e-commerce.
     */
    public function update(EcommercePartnerRequest $request, EcommercePartner $ecommercePartner): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('logo')) {
            $oldLogo = $ecommercePartner->logo;

            $data['logo'] = $request->file('logo')->store('ecommerce_partners', 'public');

            if ($oldLogo && Storage::disk('public')->exists($oldLogo)) {
                Storage::disk('public')->delete($oldLogo);
            }
        }

        $ecommercePartner->update($data);

        return redirect()->route('admin.ecommerce-partners.index')
            ->with('success', 'Partner e-commerce berhasil diperbarui.');
    }

    /**
     * Hapus partner e-commerce beserta logonya.
     */
    public function destroy(EcommercePartner $ecommercePartner): RedirectResponse
    {
        if ($ecommercePartner->logo && Storage::disk('public')->exists($ecommercePartner->logo)) {
            Storage::disk('public')->delete($ecommercePartner->logo);
        }

        $ecommercePartner->delete();

        return redirect()->route('admin.ecommerce-partners.index')
            ->with('success', 'Partner e-commerce berhasil dihapus.');
    }

    /**
     * Toggle status aktif / nonaktif partner e-commerce.
     */
    public function toggleStatus(EcommercePartner $ecommercePartner): RedirectResponse
    {
        $ecommercePartner->update([
            'is_active' => !$ecommercePartner->is_active,
        ]);

        $statusText = $ecommercePartner->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return redirect()->back()
            ->with('success', "Partner e-commerce '{$ecommercePartner->name}' berhasil {$statusText}.");
    }
}
