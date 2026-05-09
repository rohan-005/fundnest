@extends('layout')

@section('content')

<!-- HERO SECTION -->
<section class="max-w-7xl mx-auto  ">

    <div class="grid lg:grid-cols-2 gap-16 items-center">

        <!-- LEFT CONTENT -->
        <div>

            <span class="inline-block bg-white border border-borderc px-4 py-2 rounded-sm text-sm font-semibold tracking-wide text-primary shadow-sm mb-6">
                SCHOLARSHIP & FUNDING PLATFORM
            </span>

            <h1 class="text-5xl md:text-6xl font-bold leading-tight text-dark">
                Find opportunities
                <br>
                and shape your
                <span class="text-primary">future.</span>
            </h1>

            <p class="mt-6 text-lg text-gray-600 leading-relaxed max-w-xl">
                FundNest provides a centralized platform for students to discover scholarships,
                manage applications, track approvals, and organize their educational funding journey.
            </p>

            <!-- ACTION BUTTONS -->
            <div class="mt-10 flex flex-wrap gap-4">

                <a href="/register"
                   class="bg-primary hover:bg-dark text-white font-medium px-8 py-3.5 rounded-md shadow-dark transition">
                    Create Account
                </a>

                <a href="/login"
                   class="bg-white border border-borderc hover:bg-gray-50 text-dark font-medium px-8 py-3.5 rounded-md shadow-sm transition">
                    Sign In
                </a>

            </div>

            <!-- STATS -->
            <div class="flex flex-wrap gap-12 mt-16 pt-8 border-t border-borderc">

                <div>
                    <h3 class="text-3xl font-bold text-dark">120+</h3>
                    <p class="text-gray-500 text-sm font-medium mt-1 uppercase tracking-wider">
                        Scholarships
                    </p>
                </div>

                <div>
                    <h3 class="text-3xl font-bold text-dark">5k+</h3>
                    <p class="text-gray-500 text-sm font-medium mt-1 uppercase tracking-wider">
                        Students
                    </p>
                </div>

                <div>
                    <h3 class="text-3xl font-bold text-dark">98%</h3>
                    <p class="text-gray-500 text-sm font-medium mt-1 uppercase tracking-wider">
                        Satisfaction
                    </p>
                </div>

            </div>

        </div>

        <!-- RIGHT DASHBOARD PREVIEW -->
        <div class="relative hidden lg:block">

            <!-- MAIN CARD -->
            <div class="bg-white border border-borderc shadow-dark rounded-md p-8 relative z-10">

                <div class="flex justify-between items-center border-b border-borderc pb-4 mb-6">

                    <div>
                        <p class="text-gray-400 text-xs font-semibold uppercase tracking-wider">
                            Dashboard Overview
                        </p>
                        <h2 class="text-2xl font-bold mt-1 text-dark">
                            Recent Activity
                        </h2>
                    </div>

                    <div class="bg-soft text-primary px-3 py-1 rounded-sm text-xs font-bold border border-primary/20">
                        ACTIVE
                    </div>

                </div>

                <!-- STATS -->
                <div class="grid grid-cols-3 gap-4 mb-8">

                    <div class="bg-gray-50 rounded-sm p-4 border border-borderc">
                        <p class="text-gray-500 text-xs font-bold uppercase tracking-wider">Applied</p>
                        <h3 class="text-2xl font-bold mt-2 text-dark">12</h3>
                    </div>

                    <div class="bg-gray-50 rounded-sm p-4 border border-borderc">
                        <p class="text-gray-500 text-xs font-bold uppercase tracking-wider">Approved</p>
                        <h3 class="text-2xl font-bold mt-2 text-dark">5</h3>
                    </div>

                    <div class="bg-gray-50 rounded-sm p-4 border border-borderc">
                        <p class="text-gray-500 text-xs font-bold uppercase tracking-wider">Pending</p>
                        <h3 class="text-2xl font-bold mt-2 text-dark">7</h3>
                    </div>

                </div>

                <!-- RECENT ACTIVITY LIST -->
                <div>
                    <div class="space-y-3">

                        <div class="flex items-center justify-between bg-white border border-borderc rounded-sm p-4 shadow-sm">
                            <div>
                                <p class="font-bold text-dark text-sm">
                                    STEM Excellence Scholarship
                                </p>
                                <p class="text-xs text-gray-500 mt-1 font-medium">
                                    Application Submitted
                                </p>
                            </div>

                            <span class="text-warning text-xs font-bold bg-warning/10 px-2 py-1 rounded-sm">
                                PENDING
                            </span>
                        </div>

                        <div class="flex items-center justify-between bg-white border border-borderc rounded-sm p-4 shadow-sm">
                            <div>
                                <p class="font-bold text-dark text-sm">
                                    Future Leaders Grant
                                </p>
                                <p class="text-xs text-gray-500 mt-1 font-medium">
                                    Application Approved
                                </p>
                            </div>

                            <span class="text-success text-xs font-bold bg-success/10 px-2 py-1 rounded-sm">
                                APPROVED
                            </span>
                        </div>

                    </div>
                </div>

            </div>

            <!-- DECORATIVE BACKGROUND -->
            <div class="absolute -top-6 -right-6 w-full h-full border-2 border-primary/20 rounded-md -z-10"></div>
            <div class="absolute -bottom-6 -left-6 w-full h-full bg-soft rounded-md -z-20"></div>

        </div>

    </div>

</section>

<!-- CTA -->
<section class="mt-10 bg-sidebar py-10 px-8 text-center rounded-md shadow-dark relative overflow-hidden">
    
    <div class="relative z-10 text-white max-w-2xl mx-auto">
        <h2 class="text-3xl md:text-4xl font-bold leading-tight ">
            Start your funding journey today
        </h2>
        
    </div>

</section>

@endsection