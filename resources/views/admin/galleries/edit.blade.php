@extends('layouts.admin')

@section('title', 'Edit Foto Galeri' . ($gallery->title ? ' — ' . $gallery->title : ''))
@section('page-title', 'Edit Foto Galeri')

@section('content')

{{-- Breadcrumb --}}
<nav class="flex items-center gap-2 text-sm text-[#6B7280] mb-6">
    <a href="{{ route('admin.galleries.index') }}" class="hover:text-[#238B45] transition-colors">Galeri</a>
    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
    </svg>
    <span class="text-[#163326] font-medium truncate max-w-xs">{{ $gallery->title ?: 'Edit Foto #' . $gallery->id }}</span>
</nav>

@include('admin.galleries._form', [
    'gallery' => $gallery,
    'action'  => route('admin.galleries.update', $gallery),
    'method'  => 'PUT',
])

@endsection
