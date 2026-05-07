@extends('layout')

@section('content')

<div class="flex justify-center items-center min-h-[80vh]">
    <div class="bg-light p-8 rounded-xl shadow-lg w-full max-w-md">

        <h2 class="text-xl font-bold mb-4">Reset Password</h2>

        <form method="POST" action="/reset-password">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <input type="email" name="email" placeholder="Email"
                   class="w-full p-3 border rounded mb-3">

            <input type="password" name="password" placeholder="New Password"
                   class="w-full p-3 border rounded mb-3">

            <input type="password" name="password_confirmation" placeholder="Confirm Password"
                   class="w-full p-3 border rounded mb-4">

            <button class="w-full bg-primary text-white py-3 rounded">
                Reset Password
            </button>
        </form>

    </div>
</div>

@endsection