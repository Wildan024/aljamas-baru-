@extends('layouts.admin')

@section('title', 'Detail Pengajuan Kemitraan — ' . $partnership->name)
@section('page-title', 'Detail Pengajuan Kemitraan')

@section('content')

{{-- Back Button & Header --}}
<div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.partnerships.index') }}"
           class="w-9 h-9 rounded-xl bg-white border border-[#E5E7EB] hover:border-[#238B45] text-[#6B7280] hover:text-[#238B45] flex items-center justify-center transition-colors">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
            </svg>
        </a>
        <div>
            <h2 class="text-xl font-bold text-[#163326]">{{ $partnership->name }}</h2>
            <p class="text-[#6B7280] text-xs mt-0.5">Diajukan pada {{ $partnership->created_at->format('d F Y, H:i') }} WIB</p>
        </div>
    </div>

    {{-- Direct WhatsApp CTA --}}
    <a href="{{ $partnership->whatsappLink() }}"
       target="_blank"
       rel="noopener noreferrer"
       class="inline-flex items-center justify-center gap-2 h-10 px-5 bg-[#25D366] hover:bg-[#1EBE5D] text-white text-xs font-semibold rounded-[10px] shadow-sm hover:shadow transition-all">
        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
        </svg>
        <span>Hubungi via WhatsApp</span>
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- LEFT (2 Cols): Detail Information --}}
    <div class="lg:col-span-2 space-y-6">

        {{-- Applicant & Company Info Card --}}
        <div class="bg-white rounded-2xl border border-[#E5E7EB] p-6 space-y-5">
            <h3 class="text-[#163326] font-bold text-base border-b border-[#E5E7EB] pb-3">Informasi Calon Mitra</h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                <div>
                    <span class="text-xs text-[#6B7280] block">Nama Lengkap</span>
                    <span class="font-semibold text-[#163326]">{{ $partnership->name }}</span>
                </div>
                <div>
                    <span class="text-xs text-[#6B7280] block">Nama Usaha / Perusahaan</span>
                    <span class="font-semibold text-[#163326]">{{ $partnership->company ?: '— (Perorangan)' }}</span>
                </div>
                <div>
                    <span class="text-xs text-[#6B7280] block">Email</span>
                    <a href="mailto:{{ $partnership->email }}" class="text-[#238B45] hover:underline font-medium">{{ $partnership->email }}</a>
                </div>
                <div>
                    <span class="text-xs text-[#6B7280] block">Nomor Telepon / WhatsApp</span>
                    <span class="font-medium text-[#163326]">{{ $partnership->phone }}</span>
                </div>
                <div>
                    <span class="text-xs text-[#6B7280] block">Bentuk Kemitraan</span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-[#EAF6EE] text-[#238B45] mt-0.5">
                        {{ $partnership->partnership_type }}
                    </span>
                </div>
                <div>
                    <span class="text-xs text-[#6B7280] block">Kota / Lokasi Usaha</span>
                    <span class="font-medium text-[#163326]">{{ $partnership->location }}</span>
                </div>
            </div>

            {{-- Message / Notes from applicant --}}
            <div class="pt-3 border-t border-[#E5E7EB]">
                <span class="text-xs text-[#6B7280] block mb-1.5">Pesan / Kebutuhan Kemitraan:</span>
                <div class="p-4 rounded-xl bg-[#F7FAF8] border border-[#E5E7EB] text-sm text-[#1F2937] leading-relaxed whitespace-pre-line">
                    {{ $partnership->message ?: 'Tidak ada pesan tambahan.' }}
                </div>
            </div>
        </div>

    </div>

    {{-- RIGHT (1 Col): Admin Action & Status Update Box --}}
    <div class="space-y-6">

        <div class="bg-white rounded-2xl border border-[#E5E7EB] p-6 space-y-5">
            <h3 class="text-[#163326] font-bold text-base border-b border-[#E5E7EB] pb-3">Kelola Status Pengajuan</h3>

            <form method="POST" action="{{ route('admin.partnerships.update', $partnership) }}" class="space-y-4">
                @csrf
                @method('PUT')

                {{-- Status Selection --}}
                <div>
                    <label for="status" class="block text-xs font-semibold text-[#1F2937] mb-1.5">
                        Status Tindak Lanjut
                    </label>
                    <select name="status"
                            id="status"
                            class="w-full h-10 px-3 border border-[#E5E7EB] rounded-xl text-sm text-[#1F2937] focus:outline-none focus:ring-2 focus:ring-[#238B45]">
                        <option value="new" {{ $partnership->status === 'new' ? 'selected' : '' }}>🟡 Baru (Belum Ditindaklanjuti)</option>
                        <option value="contacted" {{ $partnership->status === 'contacted' ? 'selected' : '' }}>🟢 Sudah Dihubungi</option>
                        <option value="approved" {{ $partnership->status === 'approved' ? 'selected' : '' }}>🔵 Disetujui (Mitra Resmi)</option>
                        <option value="rejected" {{ $partnership->status === 'rejected' ? 'selected' : '' }}>⚪ Ditolak / Tidak Sesuai</option>
                    </select>
                </div>

                {{-- Admin Internal Notes --}}
                <div>
                    <label for="admin_notes" class="block text-xs font-semibold text-[#1F2937] mb-1.5">
                        Catatan Internal Admin <span class="text-[#6B7280] font-normal">(opsional)</span>
                    </label>
                    <textarea name="admin_notes"
                              id="admin_notes"
                              rows="4"
                              placeholder="Tulis catatan follow up, jadwal pertemuan, atau negosiasi harga di sini..."
                              class="w-full p-3 border border-[#E5E7EB] rounded-xl text-sm text-[#1F2937] focus:outline-none focus:ring-2 focus:ring-[#238B45]">{{ old('admin_notes', $partnership->admin_notes) }}</textarea>
                </div>

                <button type="submit"
                        class="w-full inline-flex items-center justify-center gap-2 h-10 px-5 bg-[#238B45] hover:bg-[#1E7A3B] text-white text-xs font-semibold rounded-[10px] shadow-sm hover:shadow transition-all">
                    <span>Simpan Perubahan</span>
                </button>
            </form>
        </div>

        {{-- Delete Box --}}
        <div class="bg-white rounded-2xl border border-red-100 p-5">
            <h4 class="text-xs font-semibold text-red-700 mb-1">Hapus Data</h4>
            <p class="text-xs text-[#6B7280] mb-3">Tindakan ini permanen dan tidak dapat dibatalkan.</p>
            <form method="POST"
                  action="{{ route('admin.partnerships.destroy', $partnership) }}"
                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengajuan kemitraan ini?')">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="w-full inline-flex items-center justify-center h-9 px-4 border border-red-200 hover:bg-red-50 text-red-600 text-xs font-semibold rounded-lg transition-colors">
                    Hapus Pengajuan Ini
                </button>
            </form>
        </div>

    </div>

</div>

@endsection
