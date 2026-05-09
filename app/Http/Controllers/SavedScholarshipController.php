<?php

namespace App\Http\Controllers;

use App\Models\SavedScholarship;
use App\Models\Scholarship;
use Illuminate\Http\Request;

class SavedScholarshipController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LIST SAVED SCHOLARSHIPS
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $saved = auth()->user()
            ->savedScholarships()
            ->with('scholarship.category')
            ->latest()
            ->paginate(9);

        return view('student.saved.index', compact('saved'));
    }

    /*
    |--------------------------------------------------------------------------
    | TOGGLE SAVE / UNSAVE
    |--------------------------------------------------------------------------
    */

    public function toggle(Scholarship $scholarship)
    {
        $user    = auth()->user();
        $existing = SavedScholarship::where('user_id', $user->id)
            ->where('scholarship_id', $scholarship->id)
            ->first();

        if ($existing) {
            $existing->delete();
            $message = 'Scholarship removed from saved.';
            $saved   = false;
        } else {
            SavedScholarship::create([
                'user_id'        => $user->id,
                'scholarship_id' => $scholarship->id,
            ]);
            $message = 'Scholarship saved!';
            $saved   = true;
        }

        if (request()->expectsJson()) {
            return response()->json(['saved' => $saved, 'message' => $message]);
        }

        return back()->with('success', $message);
    }
}
