@extends('layout')

@section('content')

<div class="max-w-xl">

    <div class="mb-8">
        <a href="{{ route('admin.categories.index') }}" class="text-muted text-sm hover:text-primary">← Back to Categories</a>
        <h1 class="page-title mt-2">New Category</h1>
    </div>

    <div class="card p-8">
        <form method="POST" action="{{ route('admin.categories.store') }}" class="space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-semibold mb-2">Name <span class="text-danger">*</span></label>
                <input type="text" name="name" class="input" value="{{ old('name') }}" placeholder="e.g. Merit-Based" required>
                @error('name')<p class="text-danger text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-semibold mb-2">Description</label>
                <input type="text" name="description" class="input" value="{{ old('description') }}"
                       placeholder="Short description of this category">
            </div>

            <div>
                <label class="block text-sm font-semibold mb-2">Badge Color</label>
                <div class="flex items-center gap-4">
                    <input type="color" name="color" value="{{ old('color', '#1F7A67') }}"
                           class="w-12 h-12 rounded-xl border border-borderc cursor-pointer">
                    <span class="text-muted text-sm">Choose a color for the category badge</span>
                </div>
            </div>

            <button type="submit" class="btn-primary w-full">Create Category</button>
        </form>
    </div>

</div>

@endsection
