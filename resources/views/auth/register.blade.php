@extends('layout')

@section('content')

<div class="min-h-[85vh] grid lg:grid-cols-2">

    <!-- LEFT SECTION -->
    <div class="hidden lg:flex flex-col justify-center px-20">

        <span class="text-primary font-semibold uppercase tracking-widest text-sm">
            FundNest Platform
        </span>

        <h1 class="text-6xl font-bold leading-tight mt-5">
            Build your
            <span class="text-primary">future</span>
            with confidence.
        </h1>

        <p class="mt-6 text-gray-700 text-lg max-w-lg leading-relaxed">
            Apply for scholarships, manage applications,
            and track opportunities from a single platform
            designed for students.
        </p>

        <div class="flex gap-4 mt-8">

            <div class="bg-white/60 backdrop-blur-md px-6 py-4 rounded-2xl shadow">
                <h3 class="text-2xl font-bold">120+</h3>
                <p class="text-sm text-gray-600">Scholarships</p>
            </div>

            <div class="bg-white/60 backdrop-blur-md px-6 py-4 rounded-2xl shadow">
                <h3 class="text-2xl font-bold">5k+</h3>
                <p class="text-sm text-gray-600">Students</p>
            </div>

        </div>

    </div>

    <!-- RIGHT SECTION -->
    <div class="flex justify-center items-center px-6 py-10">

        <div class="w-full max-w-md bg-white/70 backdrop-blur-xl border border-white/40 shadow-2xl rounded-3xl p-8">

            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold">Create Account</h2>

                <p class="text-gray-500 mt-2 text-sm">
                    Verify your email with OTP to continue
                </p>
            </div>

            @if(session('success'))
                <div class="bg-green-100 text-green-700 px-4 py-3 rounded-lg mb-4 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-100 text-red-600 px-4 py-3 rounded-lg mb-4 text-sm">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="/register" class="space-y-5">
                @csrf

                <input type="text"
                       name="name"
                       placeholder="Full Name"
                       value="{{ old('name') }}"
                       class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white/70 focus:ring-2 focus:ring-primary outline-none">

                <input type="email"
                       name="email"
                       placeholder="Email Address"
                       value="{{ old('email') }}"
                       class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white/70 focus:ring-2 focus:ring-primary outline-none">

                <input type="password"
                       name="password"
                       placeholder="Password"
                       class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white/70 focus:ring-2 focus:ring-primary outline-none">

                <input type="password"
                       name="password_confirmation"
                       placeholder="Confirm Password"
                       class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white/70 focus:ring-2 focus:ring-primary outline-none">

                <button type="submit"
                        class="w-full bg-primary hover:bg-dark text-white py-3 rounded-xl transition shadow-lg">
                    Send OTP
                </button>
            </form>

            <p class="text-center mt-6 text-sm text-gray-600">
                Already have an account?
                <a href="/login" class="text-primary font-semibold hover:underline">
                    Login
                </a>
            </p>

        </div>

    </div>

</div>

@endsection