@extends('layout')

@section('content')

<div class="max-w-2xl">

    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="page-title">My Profile</h1>
            <p class="page-subtitle">Your academic and personal information.</p>
        </div>
        <a href="{{ route('profile.edit') }}" class="btn-primary">Edit Profile</a>
    </div>

    <div class="card p-8">

        <div class="flex items-center gap-6 mb-8 pb-8 border-b border-borderc">
            <img src="{{ $user->photoUrl() }}" alt="{{ $user->name }}"
                 class="w-20 h-20 rounded-2xl object-cover shadow-soft">
            <div>
                <h2 class="text-2xl font-bold text-dark">{{ $user->name }}</h2>
                <p class="text-muted capitalize">{{ $user->role }}</p>
                @if($user->institution)
                    <p class="text-sm text-primary mt-1">🏫 {{ $user->institution }}</p>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-2 gap-6 mb-6">

            <div>
                <p class="text-xs text-muted uppercase tracking-widest font-semibold mb-1">Email</p>
                <p class="font-medium text-dark">{{ $user->email }}</p>
            </div>

            <div>
                <p class="text-xs text-muted uppercase tracking-widest font-semibold mb-1">Phone</p>
                <p class="font-medium text-dark">{{ $user->phone ?: '—' }}</p>
            </div>

            @if($user->cgpa)
            <div>
                <p class="text-xs text-muted uppercase tracking-widest font-semibold mb-1">CGPA</p>
                <p class="font-bold text-2xl text-primary">{{ number_format($user->cgpa, 2) }}</p>
            </div>
            @endif

            <div>
                <p class="text-xs text-muted uppercase tracking-widest font-semibold mb-1">Member Since</p>
                <p class="font-medium text-dark">{{ $user->created_at->format('d M Y') }}</p>
            </div>

        </div>

        @if($user->bio)
        <div class="mb-6">
            <p class="text-xs text-muted uppercase tracking-widest font-semibold mb-2">Bio</p>
            <p class="text-dark leading-relaxed">{{ $user->bio }}</p>
        </div>
        @endif

        @if($user->achievements)
        <div>
            <p class="text-xs text-muted uppercase tracking-widest font-semibold mb-2">Achievements</p>
            <p class="text-dark leading-relaxed">{{ $user->achievements }}</p>
        </div>
        @endif

    </div>

    {{-- STATS --}}
    <div class="grid grid-cols-3 gap-4 mt-6">
        <div class="card p-5 text-center">
            <p class="text-3xl font-bold text-dark">{{ $user->applications()->count() }}</p>
            <p class="text-xs text-muted mt-1">Applications</p>
        </div>
        <div class="card p-5 text-center">
            <p class="text-3xl font-bold text-primary">{{ $user->applications()->where('status','approved')->count() }}</p>
            <p class="text-xs text-muted mt-1">Approved</p>
        </div>
        <div class="card p-5 text-center">
            <p class="text-3xl font-bold text-dark">{{ $user->savedScholarships()->count() }}</p>
            <p class="text-xs text-muted mt-1">Saved</p>
        </div>
    </div>

</div>

@endsection
