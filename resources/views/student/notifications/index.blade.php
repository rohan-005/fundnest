@extends('layout')

@section('content')

<div>
    <h1 class="page-title">Notifications</h1>
    <p class="page-subtitle">Your recent alerts and updates.</p>
</div>

@if($notifications->isNotEmpty())
    <div class="flex justify-end mb-4">
        <form method="POST" action="{{ route('notifications.readAll') }}">
            @csrf
            <button type="submit" class="text-sm text-primary hover:underline">Mark all as read</button>
        </form>
    </div>
@endif

<div class="space-y-3 mt-6">

    @forelse($notifications as $notification)

        <div class="card p-5 flex items-start gap-4 {{ $notification->is_read ? 'opacity-60' : '' }}">

            <div class="w-10 h-10 rounded-full flex-shrink-0 flex items-center justify-center text-xl
                {{ str_contains(strtolower($notification->title), 'approved') ? 'bg-green-100' : (str_contains(strtolower($notification->title), 'rejected') ? 'bg-red-100' : 'bg-primary/10') }}">
                {{ str_contains(strtolower($notification->title), 'approved') ? '🎉' : (str_contains(strtolower($notification->title), 'rejected') ? '📋' : '🔔') }}
            </div>

            <div class="flex-1">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <h3 class="font-bold text-dark text-sm">{{ $notification->title }}</h3>
                        <p class="text-muted text-sm mt-1">{{ $notification->message }}</p>
                    </div>
                    @if(!$notification->is_read)
                        <span class="w-2.5 h-2.5 rounded-full bg-primary flex-shrink-0 mt-1"></span>
                    @endif
                </div>
                <p class="text-xs text-muted mt-2">{{ $notification->created_at->diffForHumans() }}</p>
            </div>

        </div>

    @empty

        <div class="card p-12 text-center">
            <p class="text-5xl mb-4">🔔</p>
            <h2 class="text-xl font-bold text-dark mb-2">No notifications</h2>
            <p class="text-muted">You're all caught up!</p>
        </div>

    @endforelse

</div>

<div class="mt-8">{{ $notifications->links() }}</div>

@endsection
