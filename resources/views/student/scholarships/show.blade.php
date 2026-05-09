@extends('layout')

@section('content')

<div class="max-w-5xl mx-auto px-6 py-10">

    <div class="bg-white rounded-3xl shadow-xl p-8">

        <h1 class="text-4xl font-bold">
            {{ $scholarship->title }}
        </h1>

        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">

            <div>

                <h3 class="font-semibold text-lg mb-2">
                    Description
                </h3>

                <p class="text-gray-600 leading-relaxed">
                    {{ $scholarship->description }}
                </p>

            </div>

            <div>

                <h3 class="font-semibold text-lg mb-2">
                    Eligibility
                </h3>

                <p class="text-gray-600 leading-relaxed">
                    {{ $scholarship->eligibility }}
                </p>

            </div>

        </div>

        <div class="mt-8 flex flex-wrap gap-6">

            <div class="bg-soft px-5 py-3 rounded-xl">
                <span class="font-semibold">Amount:</span>
                ₹{{ number_format($scholarship->amount) }}
            </div>

            <div class="bg-soft px-5 py-3 rounded-xl">
                <span class="font-semibold">Deadline:</span>
                {{ $scholarship->deadline }}
            </div>

        </div>

    </div>

    <div class="bg-white rounded-3xl shadow-xl p-8 mt-10">

        <h2 class="text-3xl font-bold mb-6">
            Apply Now
        </h2>

        <form method="POST"
              enctype="multipart/form-data"
              action="{{ route('applications.store', $scholarship) }}"
              class="space-y-6">

            @csrf

            <div>

                <label class="block mb-2 font-medium">
                    Message
                </label>

                <textarea name="message"
                          rows="5"
                          class="w-full border rounded-xl p-4 focus:ring-2 focus:ring-primary outline-none"></textarea>

            </div>

            <div>

                <label class="block mb-2 font-medium">
                    Upload Documents
                </label>

                <input type="file"
                       name="documents[]"
                       multiple
                       class="w-full border rounded-xl p-4">

            </div>

            <button
                class="bg-primary hover:bg-dark text-white px-6 py-4 rounded-xl transition">
                Submit Application
            </button>

        </form>

    </div>

</div>

@endsection