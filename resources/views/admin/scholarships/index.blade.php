@extends('layout')

@section('content')

<div class="max-w-7xl mx-auto px-6 py-10">

    <div class="flex items-center justify-between mb-8">

        <div>
            <h1 class="text-3xl font-bold">
                Scholarships
            </h1>

            <p class="text-gray-500 mt-1">
                Manage scholarship listings
            </p>
        </div>

        <a href="{{ route('admin.scholarships.create') }}"
           class="bg-primary text-white px-5 py-3 rounded-xl shadow hover:bg-dark transition">
            Add Scholarship
        </a>

    </div>

    <div class="bg-white rounded-2xl shadow overflow-hidden">

        <table class="w-full">

            <thead class="bg-gray-100">

                <tr>

                    <th class="text-left p-4">Title</th>
                    <th class="text-left p-4">Amount</th>
                    <th class="text-left p-4">Deadline</th>
                    <th class="text-left p-4">Slots</th>

                </tr>

            </thead>

            <tbody>

                @forelse($scholarships as $scholarship)

                    <tr class="border-t">

                        <td class="p-4">
                            {{ $scholarship->title }}
                        </td>

                        <td class="p-4">
                            ₹{{ number_format($scholarship->amount) }}
                        </td>

                        <td class="p-4">
                            {{ $scholarship->deadline }}
                        </td>

                        <td class="p-4">
                            {{ $scholarship->available_slots }}
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="4" class="p-6 text-center text-gray-500">
                            No scholarships found
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection