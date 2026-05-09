<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>FundNest</title>

    @vite('resources/css/app.css')

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

</head>

<body class="bg-soft text-dark min-h-screen">

    <div class="flex min-h-screen">

        <!-- SIDEBAR -->

        @auth

            <aside class="sticky top-0 h-screen overflow-y-auto w-72 bg-sidebar text-white p-8 hidden lg:flex flex-col flex-shrink-0">

                <!-- LOGO -->

                <a href="/dashboard" class="text-3xl font-bold mb-12 flex items-center gap-3">
                    <img src="/logo.png" alt="FundNest" class="w-9 h-9 object-contain">
                    FundNest
                </a>

                <!-- NAVIGATION -->

                <nav class="space-y-1 flex-1">

                    <a href="/dashboard"
                       class="flex items-center gap-3 px-4 py-3 rounded-md hover:bg-white/10 transition text-sm font-medium {{ request()->is('dashboard') ? 'bg-white/15' : '' }}">
                        Dashboard
                    </a>

                    @if(auth()->user()->isAdmin())

                        <div class="pt-4 pb-2 px-4 text-xs text-white/40 uppercase tracking-widest font-semibold">Admin</div>

                        <a href="{{ route('admin.scholarships.index') }}"
                           class="flex items-center gap-3 px-4 py-3 rounded-md hover:bg-white/10 transition text-sm font-medium {{ request()->is('admin/scholarships*') ? 'bg-white/15' : '' }}">
                            Scholarships
                        </a>

                        <a href="{{ route('admin.categories.index') }}"
                           class="flex items-center gap-3 px-4 py-3 rounded-md hover:bg-white/10 transition text-sm font-medium {{ request()->is('admin/categories*') ? 'bg-white/15' : '' }}">
                            Categories
                        </a>

                        <a href="{{ route('admin.applications.index') }}"
                           class="flex items-center gap-3 px-4 py-3 rounded-md hover:bg-white/10 transition text-sm font-medium {{ request()->is('admin/applications*') ? 'bg-white/15' : '' }}">
                            Applications
                        </a>

                        <a href="{{ route('admin.analytics.index') }}"
                           class="flex items-center gap-3 px-4 py-3 rounded-md hover:bg-white/10 transition text-sm font-medium {{ request()->is('admin/analytics*') ? 'bg-white/15' : '' }}">
                            Analytics
                        </a>

                        @if(auth()->user()->isSuperAdmin())

                            <div class="pt-4 pb-2 px-4 text-xs text-white/40 uppercase tracking-widest font-semibold">Super Admin</div>

                            <a href="{{ route('super_admin.users.index') }}"
                               class="flex items-center gap-3 px-4 py-3 rounded-md hover:bg-white/10 transition text-sm font-medium {{ request()->is('super-admin/*') ? 'bg-white/15' : '' }}">
                                Manage Users
                            </a>

                        @endif

                    @else

                        <div class="pt-4 pb-2 px-4 text-xs text-white/40 uppercase tracking-widest font-semibold">Scholarships</div>

                        <a href="{{ route('scholarships.index') }}"
                           class="flex items-center gap-3 px-4 py-3 rounded-md hover:bg-white/10 transition text-sm font-medium {{ request()->is('scholarships') ? 'bg-white/15' : '' }}">
                            Browse
                        </a>

                        <a href="{{ route('saved.index') }}"
                           class="flex items-center gap-3 px-4 py-3 rounded-md hover:bg-white/10 transition text-sm font-medium {{ request()->is('saved') ? 'bg-white/15' : '' }}">
                            Saved
                        </a>

                        <a href="{{ route('recommendations.index') }}"
                           class="flex items-center gap-3 px-4 py-3 rounded-md hover:bg-white/10 transition text-sm font-medium {{ request()->is('recommendations') ? 'bg-white/15' : '' }}">
                            For You
                        </a>

                        <div class="pt-4 pb-2 px-4 text-xs text-white/40 uppercase tracking-widest font-semibold">My Account</div>

                        <a href="{{ route('applications.index') }}"
                           class="flex items-center gap-3 px-4 py-3 rounded-md hover:bg-white/10 transition text-sm font-medium {{ request()->is('my-applications') ? 'bg-white/15' : '' }}">
                            My Applications
                        </a>

                        <a href="{{ route('profile.show') }}"
                           class="flex items-center gap-3 px-4 py-3 rounded-md hover:bg-white/10 transition text-sm font-medium {{ request()->is('profile*') ? 'bg-white/15' : '' }}">
                            Profile
                        </a>

                    @endif

                </nav>

                <!-- USER CARD -->

                <div class="mt-6">

                    <!-- NOTIFICATION BELL -->

                    <a href="{{ route('notifications.index') }}"
                       class="flex items-center justify-between px-4 py-3 rounded-md hover:bg-white/10 transition text-sm font-medium mb-2 relative"
                       id="notif-bell-link">
                        Notifications
                        <span id="notif-badge"
                              class="bg-danger text-white text-xs font-bold rounded-md px-2 py-0.5 hidden">
                        </span>
                    </a>

                    <div class="bg-white/10 rounded-md p-4">

                        <div class="flex items-center gap-3">

                            <img src="{{ auth()->user()->photoUrl() }}"
                                 alt="{{ auth()->user()->name }}"
                                 class="w-10 h-10 rounded-sm object-cover">

                            <div class="flex-1 min-w-0">
                                <h3 class="font-semibold text-sm truncate">{{ auth()->user()->name }}</h3>
                                <p class="text-xs text-white/50 capitalize">{{ auth()->user()->role }}</p>
                            </div>

                        </div>

                        <form action="/logout" method="POST" class="mt-4">
                            @csrf
                            <button class="w-full bg-white/10 hover:bg-danger py-2 rounded-md text-sm transition">
                                Logout
                            </button>
                        </form>

                    </div>

                </div>

            </aside>

        @endauth

        <!-- MAIN CONTENT -->

        <main class="flex-1 flex flex-col min-w-0 min-h-screen">

            @guest
                <!-- GUEST NAVBAR -->
                <nav class="w-full px-6 md:px-10 lg:px-16 py-6 flex justify-between items-center bg-white border-b border-borderc shadow-sm">
                    <a href="/" class="text-2xl font-bold flex items-center gap-2">
                        <img src="/logo.png" alt="FundNest" class="w-8 h-8 object-contain">
                        FundNest
                    </a>

                    <div class="flex items-center gap-6 text-sm font-medium">
                        <a href="/admin/login" class="text-muted hover:text-dark transition">Admin Login</a>
                        <a href="/login" class="text-dark hover:text-primary transition">Student Login</a>
                        <a href="/register" class="bg-primary hover:bg-dark text-white px-5 py-2 rounded-md transition shadow-dark">Register</a>
                    </div>
                </nav>
            @endguest

            <div class="p-6 lg:p-10 flex-1">
                @if(session('success'))
                    <div class="mb-8 bg-white border-l-4 border-success shadow-dark px-6 py-4 rounded-md flex items-center gap-3 text-dark font-medium">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-8 bg-white border-l-4 border-danger shadow-dark px-6 py-4 rounded-md flex items-center gap-3 text-dark font-medium">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </div>

        </main>

    </div>

    <!-- NOTIFICATION BADGE POLLING -->
    @auth
    <script>
        function refreshNotifBadge() {
            fetch('/notifications/unread-count', {
                headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
            })
            .then(r => r.json())
            .then(data => {
                const badge = document.getElementById('notif-badge');
                if (badge) {
                    if (data.count > 0) {
                        badge.textContent = data.count > 99 ? '99+' : data.count;
                        badge.classList.remove('hidden');
                    } else {
                        badge.classList.add('hidden');
                    }
                }
            })
            .catch(() => {});
        }

        // Poll every 30 seconds
        refreshNotifBadge();
        setInterval(refreshNotifBadge, 30000);
    </script>
    @endauth

</body>

</html>