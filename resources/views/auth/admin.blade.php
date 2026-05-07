@extends('layout')

@section('content')

<div class="flex justify-center items-center min-h-[80vh]">
    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md">

        <h2 class="text-2xl font-bold mb-6 text-center">Admin Login</h2>

        <form method="POST" action="/admin/login" class="space-y-4">
            @csrf

            <input type="email" name="email" placeholder="Admin Email"
                   class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary" required>

            <input type="password" name="password" placeholder="Password"
                   class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary" required>

            <button type="submit"
                    class="w-full bg-dark text-white py-3 rounded-lg hover:bg-primary transition">
                Login
            </button>
        </form>

        @if(session('error'))
            <p class="text-red-500 text-sm mt-3 text-center">
                {{ session('error') }}
            </p>
        @endif

    </div>
</div>

@endsection