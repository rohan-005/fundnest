@extends('layout')

@section('content')

<div class="py-10">

    <h1 class="text-3xl font-bold mb-6">Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="bg-white p-6 rounded-xl shadow">
            <h3 class="text-lg font-semibold">Applications</h3>
            <p class="text-gray-500 mt-2">View your applications</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow">
            <h3 class="text-lg font-semibold">Scholarships</h3>
            <p class="text-gray-500 mt-2">Browse available scholarships</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow">
            <h3 class="text-lg font-semibold">Profile</h3>
            <p class="text-gray-500 mt-2">Manage your details</p>
        </div>

    </div>

    <form method="POST" action="/logout" class="mt-8">
        @csrf
        <button class="bg-red-500 text-white px-5 py-2 rounded-lg">
            Logout
        </button>
    </form>

</div>

@endsection