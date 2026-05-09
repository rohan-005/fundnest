<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApplicationResource;
use App\Models\Application;
use App\Models\Scholarship;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | MY APPLICATIONS
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $applications = Application::with(['scholarship', 'documents'])
            ->where('user_id', $request->user()->id)
            ->latest()
            ->paginate(15);

        return ApplicationResource::collection($applications);
    }

    /*
    |--------------------------------------------------------------------------
    | APPLY
    |--------------------------------------------------------------------------
    */

    public function store(Request $request, Scholarship $scholarship)
    {
        $request->validate([
            'message' => 'nullable|string|max:1000',
        ]);

        $already = Application::where('user_id', $request->user()->id)
            ->where('scholarship_id', $scholarship->id)
            ->exists();

        if ($already) {
            return response()->json(['message' => 'Already applied for this scholarship.'], 422);
        }

        $application = Application::create([
            'user_id'        => $request->user()->id,
            'scholarship_id' => $scholarship->id,
            'message'        => $request->message,
            'status'         => 'pending',
        ]);

        return new ApplicationResource($application->load('scholarship'));
    }
}
