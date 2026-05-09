<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Scholarship;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | APPLICATIONS PER MONTH (last 12 months)
        |--------------------------------------------------------------------------
        */

        $applicationsPerMonth = Application::select(
                DB::raw("DATE_FORMAT(created_at, '%b %Y') as month"),
                DB::raw('COUNT(*) as total')
            )
            ->where('created_at', '>=', now()->subMonths(12))
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%b %Y')"), DB::raw("DATE_FORMAT(created_at, '%Y%m')"))
            ->orderBy(DB::raw("DATE_FORMAT(created_at, '%Y%m')"))
            ->pluck('total', 'month');

        /*
        |--------------------------------------------------------------------------
        | APPROVAL RATE
        |--------------------------------------------------------------------------
        */

        $totalApplications   = Application::count();
        $approvedCount       = Application::where('status', 'approved')->count();
        $rejectedCount       = Application::where('status', 'rejected')->count();
        $pendingCount        = Application::where('status', 'pending')->count();

        /*
        |--------------------------------------------------------------------------
        | TOP SCHOLARSHIPS BY APPLICATIONS
        |--------------------------------------------------------------------------
        */

        $topScholarships = Scholarship::withCount('applications')
            ->orderByDesc('applications_count')
            ->limit(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | SUMMARY STATS
        |--------------------------------------------------------------------------
        */

        $totalStudents     = User::where('role', 'student')->count();
        $totalScholarships = Scholarship::count();
        $activeScholarships = Scholarship::where('is_active', true)->count();

        $approvalRate = $totalApplications > 0
            ? round(($approvedCount / $totalApplications) * 100, 1)
            : 0;

        return view('admin.analytics.index', compact(
            'applicationsPerMonth',
            'totalApplications',
            'approvedCount',
            'rejectedCount',
            'pendingCount',
            'topScholarships',
            'totalStudents',
            'totalScholarships',
            'activeScholarships',
            'approvalRate'
        ));
    }
}
