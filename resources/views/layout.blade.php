<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>FundNest</title>

    @vite('resources/css/app.css')
</head>

<body class="bg-soft text-dark min-h-screen w-50 relative overflow-x-hidden antialiased">

    <!-- BACKGROUND BLOBS -->
    <div
        class="absolute top-[-100px] left-[-120px] w-[320px] h-[320px] bg-bolb rounded-full opacity-50 blur-1xl">
    </div>

    <div
        class="absolute bottom-0 right-[-120px] w-[300px] h-[300px] bg-bolb rounded-full opacity-50 blur-2xl">
    </div>

    <!-- MAIN WRAPPER -->
    <div class="relative z-10">

        <!-- NAVBAR -->
        <nav class="w-full py-5 px-20">

            <div class="max-w-8xl mx-auto flex items-center justify-between">

                <!-- LOGO -->
                <a href="{{ auth()->check() ? '/dashboard' : '/' }}"
                   class="flex items-center gap-3 group shrink-0">

                    <img src="/logo.png"
                         alt="FundNest"
                         class="h-14 w-auto transition duration-300 group-hover:scale-105">

                    <span class="text-2xl font-bold tracking-tight">
                        FundNest
                    </span>
                </a>

                <!-- NAVIGATION -->
                <div class="flex items-center gap-3 md:gap-5">

                    @auth

                        <a href="/dashboard"
                           class="text-sm md:text-base hover:text-primary transition">
                            Dashboard
                        </a>

                        <div class="hidden md:flex items-center gap-2">

                            <div class="w-9 h-9 rounded-full bg-primary text-white flex items-center justify-center font-semibold">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>

                            <span class="text-sm text-gray-700">
                                {{ Auth::user()->name }}
                            </span>

                        </div>

                        <form action="/logout" method="POST">
                            @csrf

                            <button
                                class="bg-primary hover:bg-dark text-white px-5 py-2 rounded-xl transition shadow-md">
                                Logout
                            </button>
                        </form>

                    @else

                        <a href="/login"
                           class="hover:text-primary transition text-sm md:text-base">
                            Login
                        </a>

                        <a href="/register"
                           class="hover:text-primary transition text-sm md:text-base">
                            Register
                        </a>

                        <a href="/admin/login"
                           class="bg-primary hover:bg-dark text-white px-5 py-2 rounded-xl transition shadow-md">
                            Admin
                        </a>

                    @endauth

                </div>

            </div>

        </nav>

        <!-- PAGE CONTENT -->
        <main class="w-full">
            @yield('content')
        </main>

    </div>

</body>

</html>