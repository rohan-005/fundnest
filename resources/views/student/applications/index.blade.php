@extends('layout')

@section('content')

<div>

    <h1 class="page-title">
        My Applications
    </h1>

    <p class="page-subtitle">
        Track all your scholarship applications.
    </p>

    <div class="space-y-6 mt-10">

        @foreach($applications as $application)

            <div class="card p-6">

                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                    <div>

                        <h2 class="text-2xl font-bold">
                            {{ $application->scholarship->title }}
                        </h2>

                        <p class="text-muted mt-2">
                            Applied on {{ $application->created_at->format('d M Y') }}
                        </p>

                    </div>

                    <span class="
                        px-4 py-2 rounded-full text-sm

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

                @if($application->admin_remark)

                    <div class="mt-6 bg-red-50 border border-red-200 p-4 rounded-2xl">

                        <h3 class="font-semibold mb-2">
                            Admin Remark
                        </h3>

                        <p>
                            {{ $application->admin_remark }}
                        </p>

                    </div>

                @endif

            </div>

        @endforeach

    </div>

    <div class="mt-8">

        {{ $applications->links() }}

    </div>

</div>

@endsection