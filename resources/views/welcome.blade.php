@extends('layout')

@section('content')

<!-- HERO -->
<div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-10 items-center px-6">

    <!-- LEFT -->
    <div>
        <span class="border px-4 py-1 text-sm">
            FundNest : Scholarship & Funding Platform
        </span>

        <h1 class="text-5xl font-bold mt-6 leading-tight">
            Find your future
            <br>
            <span class="text-primary">in one place.</span>
        </h1>

        <p class="mt-6 text-gray-700 max-w-md">
            Discover scholarships, apply easily, and track everything
            from one clean dashboard built for students.
        </p>

        <div class="mt-6 flex gap-4">
            <a href="/register"
               class="bg-primary text-white px-6 py-3 rounded hover:bg-dark">
                Get Started
            </a>

            <a href="/login"
               class="border px-6 py-3 rounded hover:bg-light">
                Login
            </a>
        </div>
    </div>

    <!-- RIGHT CARD -->
    <div class="bg-light p-6 rounded-lg shadow-lg border w-full max-w-sm mx-auto">

        <p class="text-sm">Your Activity</p>
        <h2 class="text-3xl font-bold mt-2">Dashboard Preview</h2>

        <div class="mt-6 space-y-2 text-sm">
            <div class="flex justify-between">
                <span>Applications</span><span>12</span>
            </div>
            <div class="flex justify-between">
                <span>Approved</span><span>5</span>
            </div>
            <div class="flex justify-between">
                <span>Pending</span><span>7</span>
            </div>
        </div>

        <div class="mt-6 flex gap-2 flex-wrap">
            <span class="border px-3 py-1 text-xs rounded">Track</span>
            <span class="border px-3 py-1 text-xs rounded">Apply</span>
            <span class="border px-3 py-1 text-xs rounded">Manage</span>
        </div>

    </div>

</div>

<!-- FEATURES -->
<div class="max-w-6xl mx-auto px-6 py-16">

    <h2 class="text-3xl font-bold text-center mb-10">
        Why FundNest?
    </h2>

    <div class="grid md:grid-cols-3 gap-8">

        <div class="bg-light p-6 rounded-lg shadow">
            <h3 class="font-semibold text-lg">Centralized Platform</h3>
            <p class="text-sm mt-2 text-gray-700">
                Access all scholarships and funding options in one place.
            </p>
        </div>

        <div class="bg-light p-6 rounded-lg shadow">
            <h3 class="font-semibold text-lg">Easy Applications</h3>
            <p class="text-sm mt-2 text-gray-700">
                Apply to multiple scholarships with a smooth process.
            </p>
        </div>

        <div class="bg-light p-6 rounded-lg shadow">
            <h3 class="font-semibold text-lg">Track Progress</h3>
            <p class="text-sm mt-2 text-gray-700">
                Monitor your applications and stay updated in real-time.
            </p>
        </div>

    </div>

</div>

<!-- CTA -->
<div class="bg-dark text-white py-10 text-center">

    <h2 class="text-3xl font-bold mb-4">
        Start your journey today
    </h2>

    <p class="mb-6 text-gray-300">
        Join FundNest and unlock opportunities tailored for you.
    </p>


</div>

@endsection