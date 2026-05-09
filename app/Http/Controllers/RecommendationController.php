<?php

namespace App\Http\Controllers;

use App\Services\ScholarshipRecommendationService;

class RecommendationController extends Controller
{
    public function __construct(
        private ScholarshipRecommendationService $recommender
    ) {}

    public function index()
    {
        $recommendations = $this->recommender->recommend(auth()->user());

        return view('student.recommendations.index', compact('recommendations'));
    }
}
