<!DOCTYPE html>
<html>
<head>
    <title>FundNest</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-soft text-dark relative overflow-hidden">

<!-- decorative circles -->
<div class="absolute w-80 h-80 bg-bolb rounded-full top-[-80px] left-[-80px] opacity-60"></div>
<div class="absolute w-80 h-80 bg-bolb rounded-full bottom-[-10px] right-[-80px] opacity-60"></div>

<!-- NAVBAR -->
<nav class="flex justify-between items-center px-10 py-6 relative z-10">

    <!-- LOGO -->
    <a href="/" class=" items-center gap-2">
        <img src="/logo.png" alt="FundNest" class="h-20">
        <span class="text-1xl ml-1 font-bold">FundNest</span>
    </a>

    <!-- NAV LINKS -->
    <div class="space-x-6 flex items-center">
        <a href="/login" class="hover:text-primary">Login</a>

        <a href="/admin/login"
           class="bg-primary text-white px-4 py-2 rounded hover:bg-dark">
            Admin
        </a>
    </div>
</nav>
<div class="relative z-10">
    @yield('content')
</div>

</body>
</html>