@extends('layout')

@section('content')

<div class="flex justify-center items-center min-h-[80vh]">
    <div class="bg-white p-8 rounded-md shadow-dark border border-borderc w-full max-w-md relative z-10">

        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-dark">Admin Login</h2>
            <p class="text-gray-500 mt-2 text-sm font-medium">
                Authorized personnel only
            </p>
        </div>

        @if(session('error'))
            <div class="bg-white border-l-4 border-danger shadow-dark text-dark px-4 py-3 rounded-md mb-6 text-sm font-medium">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="/admin/login" class="space-y-5">
            @csrf

            <input type="email" name="email" placeholder="Admin Email"
                   class="w-full px-4 py-3 rounded-md border border-borderc bg-gray-50 focus:bg-white focus:ring-2 focus:ring-primary outline-none transition" required>

            <input type="password" name="password" placeholder="Password"
                   class="w-full px-4 py-3 rounded-md border border-borderc bg-gray-50 focus:bg-white focus:ring-2 focus:ring-primary outline-none transition" required>

            <button type="submit"
                    class="w-full bg-dark text-white font-medium py-3 rounded-md hover:bg-primary transition shadow-dark">
                Login
            </button>
        </form>

    </div>
</div>

@endsection