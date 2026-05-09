<?php

namespace App\Services;

use App\Models\Scholarship;
use App\Models\User;
use Illuminate\Support\Collection;

class ScholarshipRecommendationService
{
    /*
    |--------------------------------------------------------------------------
    | RECOMMEND SCHOLARSHIPS FOR A USER
    |
    | Scoring:
    |   +30  Category matches previously applied/saved categories
    |   +25  CGPA >= 8.0 (merit-based bonus)
    |   +20  Deadline > 14 days (still plenty of time)
    |   +15  Amount >= 50,000
    |   +10  User has not already applied
    |   -50  Already applied (penalize so it shows lower)
    |--------------------------------------------------------------------------
    */

    public function recommend(User $user): Collection
    {
        $activeScholarships = Scholarship::with('category')
            ->active()
            ->notExpired()
            ->get();

        // Categories the user is engaged with
        $appliedCategoryIds = $user->applications()
            ->with('scholarship')
            ->get()
            ->pluck('scholarship.category_id')
            ->filter()
            ->unique()
            ->values();

        $savedCategoryIds = $user->savedScholarships()
            ->with('scholarship')
            ->get()
            ->pluck('scholarship.category_id')
            ->filter()
            ->unique()
            ->values();

        $interestCategoryIds = $appliedCategoryIds->merge($savedCategoryIds)->unique();

        $appliedScholarshipIds = $user->applications->pluck('scholarship_id');

        return $activeScholarships
            ->map(function (Scholarship $s) use ($user, $interestCategoryIds, $appliedScholarshipIds) {
                $score = 0;

                // Category interest match
                if ($s->category_id && $interestCategoryIds->contains($s->category_id)) {
                    $score += 30;
                }

                // CGPA-based merit bonus
                if ($user->cgpa && $user->cgpa >= 8.0) {
                    $score += 25;
                }

                // Deadline comfort zone
                $daysLeft = $s->daysUntilDeadline();
                if ($daysLeft >= 14) {
                    $score += 20;
                } elseif ($daysLeft >= 7) {
                    $score += 8;
                }

                // High-value scholarship
                if ($s->amount >= 50000) {
                    $score += 15;
                } elseif ($s->amount >= 20000) {
                    $score += 7;
                }

                // Not yet applied
                if (!$appliedScholarshipIds->contains($s->id)) {
                    $score += 10;
                } else {
                    $score -= 50; // heavily penalize already applied
                }

                $s->recommendation_score = $score;

                return $s;
            })
            ->filter(fn($s) => $s->recommendation_score > 0)
            ->sortByDesc('recommendation_score')
            ->take(6)
            ->values();
    }
}
