@extends('layout')

@section('content')

<div class="flex justify-center items-center min-h-[80vh] px-4">

    <div class="bg-light p-8 rounded-xl shadow-lg w-full max-w-md text-center">

        <h2 class="text-2xl font-bold mb-4">Verify OTP</h2>

        <p class="text-sm text-gray-600 mb-6">
            Enter the 6-digit OTP sent to your email.
        </p>

        @if(session('error'))
            <p class="text-red-500 mb-3 text-sm">{{ session('error') }}</p>
        @endif

        <form method="POST" action="/verify-otp" class="space-y-4">
            @csrf

            <input type="text" name="otp" maxlength="6"
                   placeholder="Enter OTP"
                   class="w-full p-3 border rounded text-center tracking-[8px] text-lg focus:ring-2 focus:ring-primary">

            <button class="w-full bg-primary text-white py-3 rounded hover:bg-dark">
                Verify & Create Account
            </button>
        </form>

        <p class="text-sm mt-4 text-gray-500">
            Didn’t receive OTP? Refresh or try again.
        </p>

    </div>

</div>

@endsection