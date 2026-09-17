<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GalleryRequest;
use App\Models\Gallery;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class GalleryController extends Controller
{
    /**
     * Tampilkan daftar foto galeri dengan pagination.
     * Gunakan scope ordered() dari model Gallery untuk konsistensi.
     */
    public function index(): View
    {
        $galleries = Gallery::ordered()->paginate(15);

        return view('admin.galleries.index', compact('galleries'));
    }

    /**
     * Tampilkan form tambah foto baru.
     */
    public function create(): View
    {
        return view('admin.galleries.create');
    }

    /**
     * Simpan foto baru ke database dan storage.
     */
    public function store(GalleryRequest $request): RedirectResponse
    {
        $data = $request->validated();

        // Upload image — wajib ada saat CREATE (dijamin oleh GalleryRequest)
        $data['image'] = $request->file('image')->store('galleries', 'public');

        Gallery::create($data);

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Foto galeri berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit foto.
     */
    public function edit(Gallery $gallery): View
    {
        return view('admin.galleries.edit', compact('gallery'));
    }

    /**
     * Update data foto galeri.
     * Image hanya diganti jika file baru diunggah.
     */
    public function update(GalleryRequest $request, Gallery $gallery): RedirectResponse
    {
        $data = $request->validated();

        // Handle upload image baru jika ada
        if ($request->hasFile('image')) {
            // Simpan path lama untuk dihapus setelah upload baru berhasil
            $oldImage = $gallery->image;

            // Upload dulu, baru hapus yang lama — pola identik dengan Products & Blogs
            $data['image'] = $request->file('image')->store('galleries', 'public');

            // Hapus file lama setelah upload baru berhasil
            if ($oldImage && Storage::disk('public')->exists($oldImage)) {
                Storage::disk('public')->delete($oldImage);
            }
        }

        $gallery->update($data);

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Foto galeri berhasil diperbarui.');
    }

    /**
     * Hapus foto galeri beserta file dari storage.
     */
    public function destroy(Gallery $gallery): RedirectResponse
    {
        // Hapus file dari storage sebelum delete record
        if ($gallery->image && Storage::disk('public')->exists($gallery->image)) {
            Storage::disk('public')->delete($gallery->image);
        }

        $gallery->delete();

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Foto galeri berhasil dihapus.');
    }
}
