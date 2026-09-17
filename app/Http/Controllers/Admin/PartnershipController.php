<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partnership;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PartnershipController extends Controller
{
    /**
     * Tampilkan daftar pengajuan kemitraan dengan filter status dan paginasi.
     */
    public function index(Request $request): View
    {
        $status = $request->query('status');

        $counts = [
            'all'       => Partnership::count(),
            'new'       => Partnership::where('status', 'new')->count(),
            'contacted' => Partnership::where('status', 'contacted')->count(),
            'approved'  => Partnership::where('status', 'approved')->count(),
            'rejected'  => Partnership::where('status', 'rejected')->count(),
        ];

        $query = Partnership::latest();

        if ($status && in_array($status, ['new', 'contacted', 'approved', 'rejected'])) {
            $query->byStatus($status);
        }

        $partnerships = $query->paginate(15)->withQueryString();

        return view('admin.partnerships.index', compact('partnerships', 'counts', 'status'));
    }

    /**
     * Tampilkan detail pengajuan kemitraan.
     */
    public function show(Partnership $partnership): View
    {
        return view('admin.partnerships.show', compact('partnership'));
    }

    /**
     * Update status dan catatan admin untuk pengajuan kemitraan.
     */
    public function update(Request $request, Partnership $partnership): RedirectResponse
    {
        $validated = $request->validate([
            'status'      => ['required', 'in:new,contacted,approved,rejected'],
            'admin_notes' => ['nullable', 'string', 'max:2000'],
        ]);

        $partnership->update($validated);

        return redirect()->back()
            ->with('success', 'Status pengajuan kemitraan dari "' . $partnership->name . '" berhasil diperbarui.');
    }

    /**
     * Hapus data pengajuan kemitraan.
     */
    public function destroy(Partnership $partnership): RedirectResponse
    {
        $name = $partnership->name;
        $partnership->delete();

        return redirect()->route('admin.partnerships.index')
            ->with('success', 'Pengajuan kemitraan dari "' . $name . '" berhasil dihapus.');
    }
}
