@extends('layouts.admin')

@section('title', 'Edit Partner E-Commerce: ' . $ecommercePartner->name)
@section('page-title', 'Edit Partner E-Commerce')

@section('content')

{{-- Breadcrumb --}}
<nav class="flex items-center gap-2 text-sm text-[#6B7280] mb-6">
    <a href="{{ route('admin.ecommerce-partners.index') }}" class="hover:text-[#238B45] transition-colors">Partner E-Commerce</a>
    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
    </svg>
    <span class="text-[#163326] font-medium">Edit: {{ $ecommercePartner->name }}</span>
</nav>

@include('admin.ecommerce-partners._form', [
    'ecommercePartner' => $ecommercePartner,
    'action'           => route('admin.ecommerce-partners.update', $ecommercePartner),
    'method'           => 'PUT',
])

@endsection
