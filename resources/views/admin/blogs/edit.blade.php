@extends('layouts.admin')

@section('title', 'Edit Artikel — ' . $blog->title)
@section('page-title', 'Edit Artikel')

@section('content')

{{-- Breadcrumb --}}
<nav class="flex items-center gap-2 text-sm text-[#6B7280] mb-6">
    <a href="{{ route('admin.blogs.index') }}" class="hover:text-[#238B45] transition-colors">Blog</a>
    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
    </svg>
    <span class="text-[#163326] font-medium truncate max-w-xs">{{ $blog->title }}</span>
</nav>

@include('admin.blogs._form', [
    'blog'       => $blog,
    'categories' => $categories,
    'action'     => route('admin.blogs.update', $blog),
    'method'     => 'PUT',
])

@endsection
