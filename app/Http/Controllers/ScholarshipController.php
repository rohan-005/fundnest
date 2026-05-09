<?php

namespace App\Http\Controllers;

use App\Mail\ScholarshipAlert;
use App\Models\Category;
use App\Models\Scholarship;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ScholarshipController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | ADMIN - LIST SCHOLARSHIPS
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $scholarships = Scholarship::with('category')
            ->withCount('applications')
            ->latest()
            ->paginate(10);

        return view(
            'admin.scholarships.index',
            compact('scholarships')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN - CREATE FORM
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.scholarships.create', compact('categories'));
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN - STORE SCHOLARSHIP
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([
            'title'           => 'required|max:255',
            'description'     => 'required',
            'amount'          => 'required|numeric',
            'deadline'        => 'required|date',
            'eligibility'     => 'nullable|string',
            'available_slots' => 'required|integer|min:1',
            'category_id'     => 'nullable|exists:categories,id',
        ]);

        $scholarship = Scholarship::create([
            'title'           => $request->title,
            'description'     => $request->description,
            'amount'          => $request->amount,
            'deadline'        => $request->deadline,
            'eligibility'     => $request->eligibility,
            'available_slots' => $request->available_slots,
            'is_active'       => true,
            'category_id'     => $request->category_id,
        ]);

        /*
        |--------------------------------------------------------------------------
        | SEND SCHOLARSHIP ALERT TO ALL STUDENTS (QUEUED)
        |--------------------------------------------------------------------------
        */

        if ($request->boolean('notify_students')) {
            User::where('role', 'student')->each(function (User $student) use ($scholarship) {
                Mail::to($student->email)->queue(new ScholarshipAlert($scholarship));
            });
        }

        return redirect()
            ->route('admin.scholarships.index')
            ->with('success', 'Scholarship created successfully.');
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN - EDIT FORM
    |--------------------------------------------------------------------------
    */

    public function edit(Scholarship $scholarship)
    {
        $categories = Category::orderBy('name')->get();

        return view(
            'admin.scholarships.edit',
            compact('scholarship', 'categories')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN - UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, Scholarship $scholarship)
    {
        $request->validate([
            'title'           => 'required',
            'description'     => 'required',
            'amount'          => 'required|numeric',
            'deadline'        => 'required|date',
            'eligibility'     => 'nullable|string',
            'available_slots' => 'required|integer|min:1',
            'category_id'     => 'nullable|exists:categories,id',
        ]);

        $scholarship->update([
            'title'           => $request->title,
            'description'     => $request->description,
            'amount'          => $request->amount,
            'deadline'        => $request->deadline,
            'eligibility'     => $request->eligibility,
            'available_slots' => $request->available_slots,
            'is_active'       => $request->has('is_active'),
            'category_id'     => $request->category_id,
        ]);

        return redirect()
            ->route('admin.scholarships.index')
            ->with('success', 'Scholarship updated successfully.');
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN - DELETE
    |--------------------------------------------------------------------------
    */

    public function destroy(Scholarship $scholarship)
    {
        $scholarship->delete();

        return back()->with(
            'success',
            'Scholarship deleted successfully.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | STUDENT - LIST WITH ADVANCED SEARCH & FILTERS
    |--------------------------------------------------------------------------
    */

    public function studentIndex(Request $request)
    {
        $query = Scholarship::with('category')
            ->where('is_active', true);

        /*
        |--------------------------------------------------------------------------
        | KEYWORD SEARCH
        |--------------------------------------------------------------------------
        */

        if ($request->q) {
            $q = $request->q;
            $query->where(function ($query) use ($q) {
                $query->where('title', 'like', "%$q%")
                      ->orWhere('description', 'like', "%$q%")
                      ->orWhere('eligibility', 'like', "%$q%");
            });
        }

        /*
        |--------------------------------------------------------------------------
        | CATEGORY FILTER
        |--------------------------------------------------------------------------
        */

        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        /*
        |--------------------------------------------------------------------------
        | AMOUNT FILTER
        |--------------------------------------------------------------------------
        */

        if ($request->min_amount) {
            $query->where('amount', '>=', $request->min_amount);
        }

        if ($request->max_amount) {
            $query->where('amount', '<=', $request->max_amount);
        }

        /*
        |--------------------------------------------------------------------------
        | DEADLINE FILTER
        |--------------------------------------------------------------------------
        */

        if ($request->deadline_before) {
            $query->where('deadline', '<=', $request->deadline_before);
        }

        // Exclude expired by default unless user opts in
        if (!$request->include_expired) {
            $query->where('deadline', '>=', now());
        }

        $scholarships = $query->latest()->paginate(9)->withQueryString();
        $categories   = Category::orderBy('name')->get();

        return view(
            'student.scholarships.index',
            compact('scholarships', 'categories')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | STUDENT - SHOW
    |--------------------------------------------------------------------------
    */

    public function show(Scholarship $scholarship)
    {
        $scholarship->load('category');
        $isSaved = auth()->check() && auth()->user()->hasSaved($scholarship->id);

        return view(
            'student.scholarships.show',
            compact('scholarship', 'isSaved')
        );
    }
}