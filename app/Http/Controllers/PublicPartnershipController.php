<?php

namespace App\Http\Controllers;

use App\Http\Requests\PublicPartnershipRequest;
use App\Models\Partnership;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PublicPartnershipController extends Controller
{
    /**
     * Tampilkan halaman Kemitraan publik.
     */
    public function index(): View
    {
        return view('partnership.index');
    }

    /**
     * Simpan pengajuan formulir kemitraan baru dari publik ke database.
     */
    public function store(PublicPartnershipRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['status'] = 'new';

        Partnership::create($data);

        return redirect()->to(route('partnership.index') . '#form-kemitraan')
            ->with('success', 'Terima kasih atas ketertarikan Anda. Pengajuan kemitraan berhasil dikirim! Tim Aljamas akan segera menghubungi Anda.');
    }
}
