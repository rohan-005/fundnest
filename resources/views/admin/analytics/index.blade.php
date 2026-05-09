@extends('layout')

@section('content')

<div>
    <h1 class="page-title">Analytics Dashboard</h1>
    <p class="page-subtitle">Platform performance overview and insights.</p>
</div>

{{-- SUMMARY STATS --}}
<div class="grid grid-cols-2 md:grid-cols-4 gap-5 mt-8">

    <div class="card p-6">
        <p class="text-xs text-muted uppercase tracking-widest mb-2">Total Students</p>
        <p class="text-4xl font-bold text-dark">{{ $totalStudents }}</p>
    </div>

    <div class="card p-6">
        <p class="text-xs text-muted uppercase tracking-widest mb-2">Scholarships</p>
        <p class="text-4xl font-bold text-dark">{{ $totalScholarships }}</p>
        <p class="text-xs text-muted mt-1">{{ $activeScholarships }} active</p>
    </div>

    <div class="card p-6">
        <p class="text-xs text-muted uppercase tracking-widest mb-2">Applications</p>
        <p class="text-4xl font-bold text-dark">{{ $totalApplications }}</p>
    </div>

    <div class="card p-6">
        <p class="text-xs text-muted uppercase tracking-widest mb-2">Approval Rate</p>
        <p class="text-4xl font-bold text-primary">{{ $approvalRate }}%</p>
    </div>

</div>

{{-- CHARTS ROW --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-8">

    {{-- APPLICATIONS PER MONTH --}}
    <div class="card p-6 lg:col-span-2">
        <h2 class="text-lg font-bold text-dark mb-4">Applications per Month</h2>
        <div style="height:280px;">
            <canvas id="monthlyChart"></canvas>
        </div>
    </div>

    {{-- STATUS BREAKDOWN PIE --}}
    <div class="card p-6">
        <h2 class="text-lg font-bold text-dark mb-4">Status Breakdown</h2>
        <div style="height:200px; display:flex; align-items:center; justify-content:center;">
            <canvas id="statusChart"></canvas>
        </div>
        <div class="mt-4 space-y-2">
            <div class="flex items-center gap-2 text-sm">
                <span class="w-3 h-3 rounded-full bg-green-500 inline-block"></span>
                <span class="text-muted">Approved</span>
                <span class="ml-auto font-semibold text-dark">{{ $approvedCount }}</span>
            </div>
            <div class="flex items-center gap-2 text-sm">
                <span class="w-3 h-3 rounded-full bg-yellow-400 inline-block"></span>
                <span class="text-muted">Pending</span>
                <span class="ml-auto font-semibold text-dark">{{ $pendingCount }}</span>
            </div>
            <div class="flex items-center gap-2 text-sm">
                <span class="w-3 h-3 rounded-full bg-red-400 inline-block"></span>
                <span class="text-muted">Rejected</span>
                <span class="ml-auto font-semibold text-dark">{{ $rejectedCount }}</span>
            </div>
        </div>
    </div>

</div>

{{-- TOP SCHOLARSHIPS --}}
<div class="card p-6 mt-6">
    <h2 class="text-lg font-bold text-dark mb-6">Top Scholarships by Applications</h2>
    <div style="height:260px;">
        <canvas id="topScholarshipsChart"></canvas>
    </div>
</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<script>
const tealPalette = ['#1F7A67','#39B68D','#0F3D35','#2DA882','#4DC9A0'];

// Monthly Applications Chart
const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
new Chart(monthlyCtx, {
    type: 'line',
    data: {
        labels: {!! json_encode($applicationsPerMonth->keys()) !!},
        datasets: [{
            label: 'Applications',
            data: {!! json_encode($applicationsPerMonth->values()) !!},
            borderColor: '#1F7A67',
            backgroundColor: 'rgba(31,122,103,0.1)',
            borderWidth: 2.5,
            fill: true,
            tension: 0.4,
            pointBackgroundColor: '#1F7A67',
            pointRadius: 4,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
            y: {
                beginAtZero: true,
                ticks: { stepSize: 1 },
                grid: { color: 'rgba(0,0,0,0.05)' }
            },
            x: { grid: { display: false } }
        }
    }
});

// Status Pie Chart
const statusCtx = document.getElementById('statusChart').getContext('2d');
new Chart(statusCtx, {
    type: 'doughnut',
    data: {
        labels: ['Approved', 'Pending', 'Rejected'],
        datasets: [{
            data: [{{ $approvedCount }}, {{ $pendingCount }}, {{ $rejectedCount }}],
            backgroundColor: ['#22c55e','#facc15','#f87171'],
            borderWidth: 0,
            hoverOffset: 8,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        cutout: '65%',
        plugins: { legend: { display: false } }
    }
});

// Top Scholarships Bar Chart
const topCtx = document.getElementById('topScholarshipsChart').getContext('2d');
new Chart(topCtx, {
    type: 'bar',
    data: {
        labels: {!! json_encode($topScholarships->pluck('title')->map(fn($t) => strlen($t) > 30 ? substr($t,0,30).'…' : $t)) !!},
        datasets: [{
            label: 'Applications',
            data: {!! json_encode($topScholarships->pluck('applications_count')) !!},
            backgroundColor: tealPalette,
            borderRadius: 8,
            borderSkipped: false,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
            y: { beginAtZero: true, ticks: { stepSize: 1 }, grid: { color: 'rgba(0,0,0,0.05)' } },
            x: { grid: { display: false } }
        }
    }
});
</script>

@endsection
