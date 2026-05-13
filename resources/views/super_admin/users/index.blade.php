@extends('layout')

@section('content')

<div>
    <h1 class="page-title">User Management</h1>
    <p class="page-subtitle">Manage roles and accounts across the platform.</p>
</div>

{{-- SEARCH/FILTER --}}
<form method="GET" class="card p-4 mt-6 flex gap-3">
    <input type="text" name="search" class="w-[300%]" value="{{ request('search') }}"
           placeholder="Search by name or email…" class="input text-sm py-2.5 flex-1">
    <select name="role" class="input text-sm py-2.5">
        <option value="">All Roles</option>
        @foreach(['student','admin','reviewer','editor','super_admin'] as $r)
            <option value="{{ $r }}" {{ request('role') === $r ? 'selected' : '' }}>{{ ucfirst(str_replace('_',' ',$r)) }}</option>
        @endforeach
    </select>
    <button type="submit" class="btn-primary text-sm">Filter</button>
</form>

<div class="card overflow-hidden mt-6">
    <table class="w-full text-sm">
        <thead class="bg-soft border-b border-borderc">
            <tr>
                <th class="text-left p-4 font-semibold text-dark">User</th>
                <th class="text-left p-4 font-semibold text-dark">Role</th>
                <th class="text-left p-4 font-semibold text-dark">Joined</th>
                <th class="text-right p-4 font-semibold text-dark">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
            <tr class="border-b border-borderc hover:bg-soft/50 transition">
                <td class="p-4">
                    <div class="flex items-center gap-3">
                        <img src="{{ $user->photoUrl() }}" class="w-9 h-9 rounded-xl object-cover" alt="">
                        <div>
                            <p class="font-semibold text-dark">{{ $user->name }}</p>
                            <p class="text-xs text-muted">{{ $user->email }}</p>
                        </div>
                    </div>
                </td>
                <td class="p-4">
                    <form method="POST" action="{{ route('super_admin.users.role', $user) }}"
                          class="flex items-center gap-2">
                        @csrf
                        <select name="role" class="border border-borderc rounded-xl px-3 py-1.5 text-xs">
                            @foreach(['student','admin','reviewer','editor','super_admin'] as $r)
                                <option value="{{ $r }}" {{ $user->role === $r ? 'selected' : '' }}>
                                    {{ ucfirst(str_replace('_',' ',$r)) }}
                                </option>
                            @endforeach
                        </select>
                        <button type="submit" class="text-xs text-primary hover:underline">Save</button>
                    </form>
                </td>
                <td class="p-4 text-muted">{{ $user->created_at->format('d M Y') }}</td>
                <td class="p-4 text-right">
                    @if($user->id !== auth()->id())
                    <form method="POST" action="{{ route('super_admin.users.destroy', $user) }}"
                          class="inline" onsubmit="return confirm('Delete this user? This cannot be undone.')">
                        @csrf @method('DELETE')
                        <button class="text-danger hover:underline text-xs">Delete</button>
                    </form>
                    @else
                        <span class="text-xs text-muted">You</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr><td colspan="4" class="p-8 text-center text-muted">No users found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">{{ $users->withQueryString()->links() }}</div>

@endsection
