@extends('layout')

@section('content')

<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="page-title">Categories</h1>
        <p class="page-subtitle">Manage scholarship categories.</p>
    </div>
    <a href="{{ route('admin.categories.create') }}" class="btn-primary">+ New Category</a>
</div>

<div class="card overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-soft border-b border-borderc">
            <tr>
                <th class="text-left p-4 font-semibold text-dark">Category</th>
                <th class="text-left p-4 font-semibold text-dark">Description</th>
                <th class="text-left p-4 font-semibold text-dark">Scholarships</th>
                <th class="text-right p-4 font-semibold text-dark">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $cat)
            <tr class="border-b border-borderc hover:bg-soft/50 transition">
                <td class="p-4">
                    <div class="flex items-center gap-3">
                        <span class="w-3 h-3 rounded-full inline-block" style="background:{{ $cat->color }}"></span>
                        <span class="font-semibold text-dark">{{ $cat->name }}</span>
                    </div>
                </td>
                <td class="p-4 text-muted">{{ $cat->description ?: '—' }}</td>
                <td class="p-4">
                    <span class="bg-primary/10 text-primary text-xs font-bold px-3 py-1 rounded-full">
                        {{ $cat->scholarships_count }}
                    </span>
                </td>
                <td class="p-4 text-right">
                    <a href="{{ route('admin.categories.edit', $cat) }}"
                       class="inline-block text-primary hover:underline text-sm mr-3">Edit</a>
                    <form method="POST" action="{{ route('admin.categories.destroy', $cat) }}"
                          class="inline" onsubmit="return confirm('Delete this category?')">
                        @csrf @method('DELETE')
                        <button class="text-danger hover:underline text-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" class="p-8 text-center text-muted">No categories yet. Create one to organize scholarships.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
