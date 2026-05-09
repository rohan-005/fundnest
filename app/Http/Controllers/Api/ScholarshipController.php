<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ScholarshipResource;
use App\Models\Scholarship;
use Illuminate\Http\Request;

class ScholarshipController extends Controller
{
    public function index(Request $request)
    {
        $query = Scholarship::with('category')->active()->notExpired();

        if ($request->q) {
            $q = $request->q;
            $query->where(function ($query) use ($q) {
                $query->where('title', 'like', "%$q%")
                      ->orWhere('description', 'like', "%$q%");
            });
        }

        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->min_amount) {
            $query->where('amount', '>=', $request->min_amount);
        }

        $scholarships = $query->latest()->paginate(15);

        return ScholarshipResource::collection($scholarships);
    }

    public function show(Scholarship $scholarship)
    {
        $scholarship->load('category');

        return new ScholarshipResource($scholarship);
    }
}
