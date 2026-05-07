@extends('layout')

@section('content')

<div class="min-h-screen grid md:grid-cols-2">

    <!-- LEFT PANEL -->
    <div class="hidden md:flex flex-col justify-center px-16">
        <h1 class="text-4xl font-bold leading-tight">
            Welcome back to
            <span class="text-primary">FundNest</span>
        </h1>

        <p class="mt-4 text-gray-700 max-w-md">
            Continue your journey. Track applications, explore scholarships,
            and manage everything in one place.
        </p>
    </div>

    <!-- RIGHT PANEL -->
    <div class="flex justify-center items-center px-6">

        <div class="bg-light p-8 rounded-xl shadow-lg w-full max-w-md">

            <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>

            <form method="POST" action="/login" class="space-y-4">
                @csrf

                <input type="email" name="email" placeholder="Email"
                       class="w-full p-3 border rounded focus:ring-2 focus:ring-primary focus:outline-none transition">

                <input type="password" name="password" placeholder="Password"
                       class="w-full p-3 border rounded focus:ring-2 focus:ring-primary focus:outline-none transition">

                <button type="submit"
                        class="w-full bg-primary text-white py-3 rounded hover:bg-dark transition">
                    Login
                </button>
            </form>

            <!-- FORGOT PASSWORD -->
            <div class="text-right mt-3">
                <a href="/forgot-password" class="text-sm text-primary hover:underline">
                    Forgot Password?
                </a>
            </div>

            @if(session('error'))
                <p class="text-red-500 text-center mt-3 text-sm">
                    {{ session('error') }}
                </p>
            @endif

            <p class="text-center mt-6 text-sm">
                Don’t have an account?
                <a href="/register" class="text-primary font-semibold">Register</a>
            </p>

        </div>

    </div>
</div>

@endsection