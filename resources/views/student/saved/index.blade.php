@extends('layout')

@section('content')

<div>
    <h1 class="page-title">Saved Scholarships</h1>
    <p class="page-subtitle">Your bookmarked scholarships.</p>
</div>

<div class="mt-6">

    @if($saved->isEmpty())
        <div class="card p-12 text-center">
            <p class="text-5xl mb-4">🔖</p>
            <h2 class="text-xl font-bold text-dark mb-2">No saved scholarships</h2>
            <p class="text-muted mb-6">Browse scholarships and bookmark ones you're interested in.</p>
            <a href="{{ route('scholarships.index') }}" class="btn-primary">Browse Scholarships</a>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">

            @foreach($saved as $bookmark)
                @php $scholarship = $bookmark->scholarship; @endphp

                <div class="card p-6 flex flex-col">

                    @if($scholarship->category)
                        <span class="inline-block text-xs font-bold px-3 py-1 rounded-full text-white mb-3 self-start"
                              style="background: {{ $scholarship->category->color }}">
                            {{ $scholarship->category->name }}
                        </span>
                    @endif

                    <h2 class="font-bold text-dark text-base mb-1">{{ $scholarship->title }}</h2>
                    <p class="text-muted text-sm flex-1 line-clamp-2">{{ $scholarship->description }}</p>

                    <div class="mt-4 pt-4 border-t border-borderc flex items-center justify-between">
                        <span class="text-xl font-black text-primary">₹{{ number_format($scholarship->amount) }}</span>
                        <span class="text-xs text-muted">{{ $scholarship->deadline?->format('d M Y') }}</span>
                    </div>

                    <div class="mt-4 flex gap-2">
                        <a href="{{ route('scholarships.show', $scholarship) }}"
                           class="btn-primary text-sm flex-1 text-center py-2.5">View</a>
                        <form method="POST" action="{{ route('saved.toggle', $scholarship) }}">
                            @csrf
                            <button type="submit" class="btn-danger text-sm px-4 py-2.5" title="Remove">🗑</button>
                        </form>
                    </div>

                </div>

            @endforeach

        </div>

        <div class="mt-8">{{ $saved->links() }}</div>

    @endif

</div>

@endsection
