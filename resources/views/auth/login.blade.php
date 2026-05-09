@extends('layout')

@section('content')

<div class="min-h-[85vh] grid lg:grid-cols-2">

    <!-- LEFT -->
    <div class="hidden lg:flex flex-col justify-center px-20">

        <span class="text-primary font-semibold uppercase tracking-widest text-sm">
            Welcome Back
        </span>

        <h1 class="text-6xl font-bold leading-tight mt-5">
            Continue your
            <span class="text-primary">journey.</span>
        </h1>

        <p class="mt-6 text-gray-700 text-lg max-w-lg leading-relaxed">
            Access your dashboard, track scholarship applications,
            and manage your academic opportunities seamlessly.
        </p>

    </div>

    <!-- RIGHT -->
    <div class="flex justify-center items-center px-6 py-10">

        <div class="w-full max-w-md bg-white border border-borderc shadow-dark rounded-md p-8 relative z-10">

            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-dark">Student Login</h2>

                <p class="text-gray-500 mt-2 text-sm font-medium">
                    Welcome back to FundNest
                </p>
            </div>

            @if(session('success'))
                <div class="bg-white border-l-4 border-success shadow-dark text-dark px-4 py-3 rounded-md mb-4 text-sm font-medium">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-white border-l-4 border-danger shadow-dark text-dark px-4 py-3 rounded-md mb-4 text-sm font-medium">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="/login" class="space-y-5">
                @csrf

                <input type="email"
                       name="email"
                       placeholder="Email Address"
                       class="w-full px-4 py-3 rounded-md border border-borderc bg-gray-50 focus:bg-white focus:ring-2 focus:ring-primary outline-none transition">

                <input type="password"
                       name="password"
                       placeholder="Password"
                       class="w-full px-4 py-3 rounded-md border border-borderc bg-gray-50 focus:bg-white focus:ring-2 focus:ring-primary outline-none transition">

                <button type="submit"
                        class="w-full bg-primary hover:bg-dark text-white font-medium py-3 rounded-md transition shadow-dark">
                    Login
                </button>
            </form>

            <div class="flex justify-between items-center mt-5 text-sm">

                <a href="/forgot-password"
                   class="text-primary hover:underline">
                    Forgot Password?
                </a>

                <a href="/register"
                   class="text-primary hover:underline">
                    Create Account
                </a>

            </div>

        </div>

    </div>

</div>

@endsection