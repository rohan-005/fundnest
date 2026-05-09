@extends('layout')

@section('content')

@if(auth()->user()->isAdmin())

    <div>

        <h1 class="page-title">
            Admin Dashboard
        </h1>

        <p class="page-subtitle">
            Manage scholarships and applications.
        </p>

    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-10">

        <div class="card p-8">

            <h3 class="text-muted font-medium">
                Total Scholarships
            </h3>

            <p class="text-5xl font-bold mt-4">
                {{ $totalScholarships }}
            </p>

        </div>

        <div class="card p-8">

            <h3 class="text-muted font-medium">
                Applications
            </h3>

            <p class="text-5xl font-bold mt-4">
                {{ $totalApplications }}
            </p>

        </div>

        <div class="card p-8">

            <h3 class="text-muted font-medium">
                Pending Reviews
            </h3>

            <p class="text-5xl font-bold mt-4">
                {{ $pendingApplications }}
            </p>

        </div>

    </div>

@else

    <div>

        <h1 class="page-title">
            Student Dashboard
        </h1>

        <p class="page-subtitle">
            Browse scholarships and track your applications.
        </p>

    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-10">

        <div class="card p-8">

            <h2 class="text-2xl font-bold mb-6">
                Recent Scholarships
            </h2>

            <div class="space-y-4">

                @forelse($scholarships as $scholarship)

                    <a href="{{ route('scholarships.show', $scholarship) }}"
                       class="block border border-borderc rounded-2xl p-5 hover:border-primary transition">

                        <div class="flex items-center justify-between">

                            <h3 class="font-semibold">
                                {{ $scholarship->title }}
                            </h3>

                            <span class="text-primary font-bold">
                                ₹{{ number_format($scholarship->amount) }}
                            </span>

                        </div>

                    </a>

                @empty

                    <p class="text-muted">
                        No scholarships available.
                    </p>

                @endforelse

            </div>

        </div>

        <div class="card p-8">

            <h2 class="text-2xl font-bold mb-6">
                My Applications
            </h2>

            <div class="space-y-4">

                @forelse($myApplications as $application)

                    <div class="border border-borderc rounded-2xl p-5">

                        <div class="flex items-center justify-between">

                            <h3 class="font-semibold">
                                {{ $application->scholarship->title }}
                            </h3>

                            <span class="
                                px-3 py-1 rounded-full text-sm
                                @if($application->status === 'approved')
                                    bg-green-100 text-green-700
                                @elseif($application->status === 'rejected')
                                    bg-red-100 text-red-700
                                @else
                                    bg-yellow-100 text-yellow-700
                                @endif
                            ">

                                {{ ucfirst($application->status) }}

                            </span>

                        </div>

                    </div>

                @empty

                    <p class="text-muted">
                        No applications yet.
                    </p>

                @endforelse

            </div>

        </div>

    </div>

@endif

@endsection