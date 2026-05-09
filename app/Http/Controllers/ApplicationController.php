<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Document;
use App\Models\Scholarship;

use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | STUDENT APPLICATION HISTORY
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $applications = Application::with([
                'scholarship',
                'documents'
            ])
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view(
            'student.applications.index',
            compact('applications')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | APPLY FOR SCHOLARSHIP
    |--------------------------------------------------------------------------
    */

    public function store(Request $request, Scholarship $scholarship)
    {
        $request->validate([

            'message' => 'nullable|string|max:1000',

            'documents.*' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        /*
        |--------------------------------------------------------------------------
        | PREVENT DUPLICATE APPLICATION
        |--------------------------------------------------------------------------
        */

        $alreadyApplied = Application::where('user_id', auth()->id())
            ->where('scholarship_id', $scholarship->id)
            ->exists();

        if ($alreadyApplied) {

            return back()->with(
                'error',
                'You already applied for this scholarship.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | CREATE APPLICATION
        |--------------------------------------------------------------------------
        */

        $application = Application::create([

            'user_id' => auth()->id(),

            'scholarship_id' => $scholarship->id,

            'message' => $request->message,

            'status' => 'pending',
        ]);

        /*
        |--------------------------------------------------------------------------
        | STORE DOCUMENTS
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('documents')) {

            foreach ($request->file('documents') as $file) {

                $path = $file->store(
                    'documents',
                    'public'
                );

                Document::create([

                    'application_id' => $application->id,

                    'document_name' => $file->getClientOriginalName(),

                    'file_path' => $path,
                ]);
            }
        }

        return back()->with(
            'success',
            'Application submitted successfully.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | DOWNLOAD DOCUMENT
    |--------------------------------------------------------------------------
    */

    public function download(Document $document)
    {
        /*
        |--------------------------------------------------------------------------
        | SECURITY CHECK
        |--------------------------------------------------------------------------
        */

        $user = auth()->user();

        $isOwner =
            $document->application->user_id === $user->id;

        $isAdmin =
            $user->role === 'admin';

        if (!$isOwner && !$isAdmin) {

            abort(403, 'Unauthorized access.');
        }

        return response()->download(
            storage_path(
                'app/public/' . $document->file_path
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | PREVIEW DOCUMENT
    |--------------------------------------------------------------------------
    */

    public function preview(Document $document)
    {
        $user = auth()->user();

        $isOwner =
            $document->application->user_id === $user->id;

        $isAdmin =
            $user->role === 'admin';

        if (!$isOwner && !$isAdmin) {

            abort(403, 'Unauthorized access.');
        }

        return response()->file(
            storage_path(
                'app/public/' . $document->file_path
            )
        );
    }
}