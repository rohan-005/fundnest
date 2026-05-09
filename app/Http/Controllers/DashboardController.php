<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Scholarship;
use App\Services\ScholarshipRecommendationService;

class DashboardController extends Controller
{
    public function __construct(
        private ScholarshipRecommendationService $recommender
    ) {}

    public function index()
    {
        $user = auth()->user();

        if ($user->isAdmin()) {

            return view('dashboard', [
                'totalScholarships'   => Scholarship::count(),
                'totalApplications'   => Application::count(),
                'pendingApplications' => Application::where('status', 'pending')->count(),
                'recentApplications'  => Application::with(['user', 'scholarship'])
                    ->latest()
                    ->limit(5)
                    ->get(),
            ]);
        }

        // Student dashboard
        $recommendations = $this->recommender->recommend($user)->take(3);

        return view('dashboard', [
            'scholarships'    => Scholarship::active()->notExpired()->latest()->limit(5)->get(),
            'myApplications'  => $user->applications()->with('scholarship')->latest()->limit(5)->get(),
            'recommendations' => $recommendations,
            'unreadCount'     => $user->notifications()->where('is_read', false)->count(),
        ]);
    }
}
