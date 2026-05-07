@extends('layout')

@section('content')

<!-- HERO SECTION -->
<section class="max-w-7xl mx-auto px-6 md:px-10 lg:px-16 pt-7 pb-20">

    <div class="grid lg:grid-cols-2 gap-16 items-center">

        <!-- LEFT CONTENT -->
        <div>

            <span class="inline-block bg-white/60 backdrop-blur-md border border-white/50 px-4 py-2 rounded-full text-sm shadow-sm">
                Scholarship & Funding Platform
            </span>

            <h1 class="text-5xl md:text-6xl font-bold leading-tight mt-8">
                Find opportunities
                <br>
                and shape your
                <span class="text-primary">future.</span>
            </h1>

            <p class="mt-6 text-lg text-gray-700 leading-relaxed max-w-xl">
                FundNest helps students discover scholarships,
                manage applications, track approvals, and stay
                organized through one modern platform.
            </p>

            <!-- ACTION BUTTONS -->
            <div class="mt-10 flex flex-wrap gap-4">

                <a href="/register"
                   class="bg-primary hover:bg-dark text-white px-7 py-3 rounded-2xl shadow-lg transition">
                    Get Started
                </a>

                <a href="/login"
                   class="bg-white/60 backdrop-blur-md border border-white/40 hover:bg-white px-7 py-3 rounded-2xl transition">
                    Login
                </a>

            </div>

            <!-- STATS -->
            <div class="flex flex-wrap gap-10 mt-14">

                <div>
                    <h3 class="text-3xl font-bold">120+</h3>
                    <p class="text-gray-600 text-sm mt-1">
                        Scholarships
                    </p>
                </div>

                <div>
                    <h3 class="text-3xl font-bold">5k+</h3>
                    <p class="text-gray-600 text-sm mt-1">
                        Students
                    </p>
                </div>

                <div>
                    <h3 class="text-3xl font-bold">98%</h3>
                    <p class="text-gray-600 text-sm mt-1">
                        Satisfaction
                    </p>
                </div>

            </div>

        </div>

        <!-- RIGHT DASHBOARD PREVIEW -->
        <div class="relative">

            <!-- MAIN CARD -->
            <div class="bg-white/70 backdrop-blur-xl border border-white/50 shadow-2xl rounded-3xl p-8">

                <div class="flex justify-between items-center">

                    <div>
                        <p class="text-gray-500 text-sm">
                            Dashboard Overview
                        </p>

                        <h2 class="text-3xl font-bold mt-1">
                            Your Activity
                        </h2>
                    </div>

                    <div class="bg-primary text-white px-4 py-2 rounded-xl text-sm">
                        Active
                    </div>

                </div>

                <!-- STATS -->
                <div class="grid grid-cols-3 gap-4 mt-8">

                    <div class="bg-white rounded-2xl p-4 shadow-sm">
                        <p class="text-gray-500 text-sm">Applied</p>
                        <h3 class="text-2xl font-bold mt-2">12</h3>
                    </div>

                    <div class="bg-white rounded-2xl p-4 shadow-sm">
                        <p class="text-gray-500 text-sm">Approved</p>
                        <h3 class="text-2xl font-bold mt-2">5</h3>
                    </div>

                    <div class="bg-white rounded-2xl p-4 shadow-sm">
                        <p class="text-gray-500 text-sm">Pending</p>
                        <h3 class="text-2xl font-bold mt-2">7</h3>
                    </div>

                </div>

                <!-- RECENT ACTIVITY -->
                <div class="mt-8">

                    <h4 class="font-semibold mb-4">
                        Recent Activity
                    </h4>

                    <div class="space-y-4">

                        <div class="flex items-center justify-between bg-white rounded-2xl p-4 shadow-sm">
                            <div>
                                <p class="font-medium">
                                    STEM Excellence Scholarship
                                </p>
                                <p class="text-sm text-gray-500">
                                    Application Submitted
                                </p>
                            </div>

                            <span class="text-primary text-sm font-semibold">
                                Pending
                            </span>
                        </div>

                        <div class="flex items-center justify-between bg-white rounded-2xl p-4 shadow-sm">
                            <div>
                                <p class="font-medium">
                                    Future Leaders Grant
                                </p>
                                <p class="text-sm text-gray-500">
                                    Application Approved
                                </p>
                            </div>

                            <span class="text-green-600 text-sm font-semibold">
                                Approved
                            </span>
                        </div>

                    </div>

                </div>

            </div>

            <!-- FLOATING SMALL CARD -->
            <div class="absolute -bottom-8 -left-8 bg-white rounded-2xl shadow-xl p-5 hidden lg:block">

                <p class="text-sm text-gray-500">
                    Success Rate
                </p>

                <h3 class="text-3xl font-bold mt-1">
                    87%
                </h3>

                <p class="text-primary text-sm mt-1">
                    +12% this month
                </p>

            </div>

        </div>

    </div>

</section>

<!-- FEATURES -->


<!-- CTA -->
<section >

    <div class="w-full mx-auto bg-dark  overflow-hidden relative">

        <!-- BACKGROUND EFFECT -->
        <div class="absolute inset-0 opacity-20">
            <div class="absolute w-50 h-80 bg-primary rounded-full blur-3xl top-[-100px] right-[-100px]"></div>
        </div>

        <div class="relative z-10 py-10 px-8 text-center text-white">

            <h2 class="text-3xl md:text-4xl font-bold leading-tight">
                Start your scholarship journey today
            </h2>

            

        </div>

    </div>

</section>

@endsection