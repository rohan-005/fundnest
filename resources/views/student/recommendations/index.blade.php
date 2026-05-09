@extends('layout')

@section('content')

<div>
    <h1 class="page-title">✨ Recommended for You</h1>
    <p class="page-subtitle">Personalised scholarships based on your profile, interests, and activity.</p>
</div>

<div class="mt-6">

    @if($recommendations->isEmpty())
        <div class="card p-12 text-center">
            <p class="text-5xl mb-4">🎯</p>
            <h2 class="text-xl font-bold text-dark mb-2">No recommendations yet</h2>
            <p class="text-muted mb-6">
                Complete your profile (CGPA, institution) and save or apply for scholarships
                to unlock personalised recommendations.
            </p>
            <div class="flex gap-3 justify-center">
                <a href="{{ route('profile.edit') }}" class="btn-primary">Complete Profile</a>
                <a href="{{ route('scholarships.index') }}" class="btn-primary" style="background:#39B68D">Browse Scholarships</a>
            </div>
        </div>
    @else

        <div class="card p-5 bg-primary/5 border-primary/20 mb-6 flex items-start gap-4">
            <span class="text-2xl">💡</span>
            <div>
                <h3 class="font-bold text-dark">How recommendations work</h3>
                <p class="text-muted text-sm mt-1">We score scholarships based on your CGPA, saved categories, application history, deadline, and scholarship value.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">

            @foreach($recommendations as $index => $scholarship)

                <a href="{{ route('scholarships.show', $scholarship) }}"
                   class="card p-6 hover:shadow-lg hover:-translate-y-1 transition-all duration-200 flex flex-col relative overflow-hidden">

                    {{-- RANK BADGE --}}
                    @if($index < 3)
                        <span class="absolute top-4 right-4 text-xl">
                            @if($index === 0) 🥇 @elseif($index === 1) 🥈 @else 🥉 @endif
                        </span>
                    @endif

                    @if($scholarship->category)
                        <span class="inline-block text-xs font-bold px-3 py-1 rounded-full text-white mb-3 self-start"
                              style="background: {{ $scholarship->category->color }}">
                            {{ $scholarship->category->name }}
                        </span>
                    @endif

                    <h2 class="font-bold text-dark text-base mb-1 line-clamp-2 pr-8">{{ $scholarship->title }}</h2>
                    <p class="text-muted text-sm line-clamp-2 flex-1">{{ $scholarship->description }}</p>

                    <div class="mt-4 pt-4 border-t border-borderc flex items-center justify-between">
                        <span class="text-2xl font-black text-primary">₹{{ number_format($scholarship->amount) }}</span>
                        <span class="text-xs bg-primary/10 text-primary px-2 py-1 rounded-lg font-semibold">
                            Score: {{ $scholarship->recommendation_score }}
                        </span>
                    </div>

                    <div class="mt-2 text-xs text-muted">
                        📅 {{ $scholarship->deadline?->format('d M Y') }} · {{ $scholarship->daysUntilDeadline() }}d left
                    </div>

                </a>

            @endforeach

        </div>

    @endif

</div>

@endsection
