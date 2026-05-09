@extends('layout')

@section('content')

<div>
    <h1 class="page-title">Browse Scholarships</h1>
    <p class="page-subtitle">Find and apply for scholarships that match your profile.</p>
</div>

{{-- SEARCH & FILTER BAR --}}
<form method="GET" action="{{ route('scholarships.index') }}"
      class="card p-5 mt-6 flex flex-wrap gap-3 items-end">

    <div class="flex-1 min-w-48">
        <label class="block text-xs font-semibold text-muted mb-1 uppercase tracking-wide">Search</label>
        <input type="text" name="q" value="{{ request('q') }}"
               placeholder="Keyword, title, eligibility…"
               class="input text-sm py-2.5">
    </div>

    <div class="w-40">
        <label class="block text-xs font-semibold text-muted mb-1 uppercase tracking-wide">Category</label>
        <select name="category_id" class="input text-sm py-2.5">
            <option value="">All Categories</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="w-32">
        <label class="block text-xs font-semibold text-muted mb-1 uppercase tracking-wide">Min Amount</label>
        <input type="number" name="min_amount" value="{{ request('min_amount') }}"
               placeholder="₹0" class="input text-sm py-2.5">
    </div>

    <div class="w-32">
        <label class="block text-xs font-semibold text-muted mb-1 uppercase tracking-wide">Max Amount</label>
        <input type="number" name="max_amount" value="{{ request('max_amount') }}"
               placeholder="Any" class="input text-sm py-2.5">
    </div>

    <div class="w-36">
        <label class="block text-xs font-semibold text-muted mb-1 uppercase tracking-wide">Deadline Before</label>
        <input type="date" name="deadline_before" value="{{ request('deadline_before') }}"
               class="input text-sm py-2.5">
    </div>

    <div class="flex gap-2">
        <button type="submit" class="btn-primary py-2.5 px-5 text-sm">Search</button>
        @if(request()->hasAny(['q','category_id','min_amount','max_amount','deadline_before']))
            <a href="{{ route('scholarships.index') }}"
               class="py-2.5 px-4 border border-borderc rounded-2xl text-sm text-muted hover:text-dark transition">Clear</a>
        @endif
    </div>

</form>

{{-- RESULTS --}}
<div class="mt-6">

    @if($scholarships->isEmpty())
        <div class="card p-12 text-center">
            <p class="text-4xl mb-4">🔍</p>
            <h2 class="text-xl font-bold text-dark mb-2">No scholarships found</h2>
            <p class="text-muted">Try adjusting your search filters.</p>
        </div>
    @else
        <p class="text-muted text-sm mb-4">Showing {{ $scholarships->total() }} scholarship(s)</p>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">

            @foreach($scholarships as $scholarship)

                <a href="{{ route('scholarships.show', $scholarship) }}"
                   class="card p-6 hover:shadow-lg hover:-translate-y-1 transition-all duration-200 flex flex-col">

                    {{-- CATEGORY BADGE --}}
                    @if($scholarship->category)
                        <span class="inline-block text-xs font-bold px-3 py-1 rounded-full text-white mb-3 self-start"
                              style="background: {{ $scholarship->category->color }}">
                            {{ $scholarship->category->name }}
                        </span>
                    @endif

                    <h2 class="font-bold text-dark text-base mb-1 line-clamp-2">{{ $scholarship->title }}</h2>
                    <p class="text-muted text-sm line-clamp-2 flex-1">{{ $scholarship->description }}</p>

                    <div class="mt-4 pt-4 border-t border-borderc flex items-center justify-between">
                        <span class="text-2xl font-black text-primary">₹{{ number_format($scholarship->amount) }}</span>
                        <span class="text-xs text-muted">
                            @php $days = $scholarship->daysUntilDeadline(); @endphp
                            @if($days <= 7)
                                <span class="text-danger font-semibold">⚡ {{ $days }}d left</span>
                            @elseif($days <= 30)
                                <span class="text-warning font-semibold">⏳ {{ $days }}d left</span>
                            @else
                                📅 {{ $scholarship->deadline->format('d M Y') }}
                            @endif
                        </span>
                    </div>

                </a>

            @endforeach

        </div>

        <div class="mt-8">{{ $scholarships->withQueryString()->links() }}</div>

    @endif

</div>

@endsection