@extends('layout')

@section('content')

<div class="min-h-screen grid md:grid-cols-2">

    <!-- LEFT PANEL -->
    <div class="hidden md:flex flex-col justify-center px-16">
        <h1 class="text-4xl font-bold leading-tight">
            Start your journey with
            <span class="text-primary">FundNest</span>
        </h1>

        <p class="mt-4 text-gray-700 max-w-md">
            Discover scholarships, apply faster, and track everything in one place.
        </p>

        <p class="mt-6 text-sm text-gray-500">
            We’ll send a verification OTP to your email to secure your account.
        </p>
    </div>

    <!-- RIGHT PANEL -->
    <div class="flex justify-center items-center px-6">

        <div class="bg-light p-8 rounded-xl shadow-lg w-full max-w-md">

            <h2 class="text-2xl font-bold mb-6 text-center">
                Create Account
            </h2>

            <!-- SUCCESS MESSAGE -->
            @if(session('success'))
                <p class="text-green-600 text-center mb-4 text-sm">
                    {{ session('success') }}
                </p>
            @endif

            <!-- ERROR MESSAGE -->
            @if($errors->any())
                <div class="text-red-500 text-sm mb-4">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="/register" class="space-y-4">
                @csrf

                <input type="text" name="name" placeholder="Full Name"
                       value="{{ old('name') }}"
                       class="w-full p-3 border rounded focus:ring-2 focus:ring-primary focus:outline-none">

                <input type="email" name="email" placeholder="Email"
                       value="{{ old('email') }}"
                       class="w-full p-3 border rounded focus:ring-2 focus:ring-primary focus:outline-none">

                <input type="password" name="password" placeholder="Password"
                       class="w-full p-3 border rounded focus:ring-2 focus:ring-primary focus:outline-none">

                <input type="password" name="password_confirmation" placeholder="Confirm Password"
                       class="w-full p-3 border rounded focus:ring-2 focus:ring-primary focus:outline-none">

                <!-- BUTTON CHANGED -->
                <button type="submit"
                        class="w-full bg-primary text-white py-3 rounded hover:bg-dark transition">
                    Send OTP
                </button>
            </form>

            <p class="text-center mt-6 text-sm">
                Already have an account?
                <a href="/login" class="text-primary font-semibold hover:underline">
                    Login
                </a>
            </p>

        </div>

    </div>
</div>

@endsection