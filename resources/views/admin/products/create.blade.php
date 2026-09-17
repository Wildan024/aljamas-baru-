@extends('layouts.admin')

@section('title', 'Tambah Produk')
@section('page-title', 'Tambah Produk')

@section('content')

{{-- Breadcrumb --}}
<nav class="flex items-center gap-2 text-sm text-[#6B7280] mb-6">
    <a href="{{ route('admin.products.index') }}" class="hover:text-[#238B45] transition-colors">Produk</a>
    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
    </svg>
    <span class="text-[#163326] font-medium">Tambah Produk Baru</span>
</nav>

@include('admin.products._form', [
    'product' => new \App\Models\Product(),
    'categories' => $categories,
    'action' => route('admin.products.store'),
    'method' => 'POST',
])

@endsection
