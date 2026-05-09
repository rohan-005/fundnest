@extends('layout')

@section('content')

<div class="max-w-4xl mx-auto px-6 py-10">

    <div class="bg-white rounded-3xl shadow-xl p-8">

        <h1 class="text-3xl font-bold mb-8">
            Create Scholarship
        </h1>

        <form method="POST"
              action="{{ route('admin.scholarships.store') }}"
              class="space-y-6">

            @csrf

            <div>

                <label class="block mb-2 font-medium">
                    Scholarship Title
                </label>

                <input type="text"
                       name="title"
                       class="w-full border rounded-xl p-4 focus:ring-2 focus:ring-primary outline-none"
                       required>

            </div>

            <div>

                <label class="block mb-2 font-medium">
                    Description
                </label>

                <textarea name="description"
                          rows="5"
                          class="w-full border rounded-xl p-4 focus:ring-2 focus:ring-primary outline-none"
                          required></textarea>

            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>

                    <label class="block mb-2 font-medium">
                        Amount
                    </label>

                    <input type="number"
                           name="amount"
                           class="w-full border rounded-xl p-4 focus:ring-2 focus:ring-primary outline-none"
                           required>

                </div>

                <div>

                    <label class="block mb-2 font-medium">
                        Deadline
                    </label>

                    <input type="date"
                           name="deadline"
                           class="w-full border rounded-xl p-4 focus:ring-2 focus:ring-primary outline-none"
                           required>

                </div>

            </div>

            <div>

                <label class="block mb-2 font-medium">
                    Eligibility
                </label>

                <textarea name="eligibility"
                          rows="4"
                          class="w-full border rounded-xl p-4 focus:ring-2 focus:ring-primary outline-none"></textarea>

            </div>

            <div>

                <label class="block mb-2 font-medium">
                    Available Slots
                </label>

                <input type="number"
                       name="available_slots"
                       class="w-full border rounded-xl p-4 focus:ring-2 focus:ring-primary outline-none"
                       required>

            </div>

            <button
                class="bg-primary hover:bg-dark text-white px-6 py-4 rounded-xl transition">
                Create Scholarship
            </button>

        </form>

    </div>

</div>

@endsection