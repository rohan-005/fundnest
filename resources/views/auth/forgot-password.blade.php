@extends('layout')

@section('content')

<div class="flex justify-center items-center min-h-[80vh]">
    <div class="bg-light p-8 rounded-xl shadow-lg w-full max-w-md">

        <h2 class="text-xl font-bold mb-4">Forgot Password</h2>

        <form method="POST" action="/forgot-password">
            @csrf

            <input type="email" name="email" placeholder="Enter your email"
                   class="w-full p-3 border rounded mb-4">

            <button class="w-full bg-primary text-white py-3 rounded">
                Send Reset Link
            </button>
        </form>

        @if(session('success'))
            <p class="text-green-600 mt-3">{{ session('success') }}</p>
        @endif

    </div>
</div>

@endsection