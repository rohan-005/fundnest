<?php

namespace App\Http\Controllers;

use App\Mail\ApplicationApproved;
use App\Mail\ApplicationRejected;
use App\Models\Application;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminApplicationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $query = Application::with([
            'user',
            'scholarship',
            'documents'
        ]);

        /*
        |--------------------------------------------------------------------------
        | SEARCH
        |--------------------------------------------------------------------------
        */

        if ($request->search) {

            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%");
            });
        }

        /*
        |--------------------------------------------------------------------------
        | FILTER BY STATUS
        |--------------------------------------------------------------------------
        */

        if ($request->status) {

            $query->where('status', $request->status);
        }

        /*
        |--------------------------------------------------------------------------
        | FILTER BY SCHOLARSHIP
        |--------------------------------------------------------------------------
        */

        if ($request->scholarship_id) {

            $query->where('scholarship_id', $request->scholarship_id);
        }

        $applications = $query
            ->latest()
            ->paginate(10);

        return view(
            'admin.applications.index',
            compact('applications')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    */

    public function show(Application $application)
    {
        $application->load(['user', 'scholarship', 'documents']);

        return view('admin.applications.show', compact('application'));
    }

    /*
    |--------------------------------------------------------------------------
    | APPROVE
    |--------------------------------------------------------------------------
    */

    public function approve(Application $application)
    {
        $application->update([
            'status' => 'approved',
        ]);

        /*
        |--------------------------------------------------------------------------
        | DB NOTIFICATION
        |--------------------------------------------------------------------------
        */

        Notification::create([
            'user_id' => $application->user_id,
            'title'   => 'Scholarship Approved',
            'message' => 'Your application for '
                . $application->scholarship->title
                . ' has been approved! 🎉',
        ]);

        /*
        |--------------------------------------------------------------------------
        | EMAIL NOTIFICATION (QUEUED)
        |--------------------------------------------------------------------------
        */

        Mail::to($application->user->email)
            ->queue(new ApplicationApproved($application));

        return back()->with('success', 'Application approved and student notified.');
    }

    /*
    |--------------------------------------------------------------------------
    | REJECT
    |--------------------------------------------------------------------------
    */

    public function reject(Request $request, Application $application)
    {
        $application->update([
            'status'       => 'rejected',
            'admin_remark' => $request->remark,
        ]);

        Notification::create([
            'user_id' => $application->user_id,
            'title'   => 'Scholarship Application Update',
            'message' => 'Your application for '
                . $application->scholarship->title
                . ' has been reviewed. Please check your dashboard for details.',
        ]);

        /*
        |--------------------------------------------------------------------------
        | EMAIL NOTIFICATION (QUEUED)
        |--------------------------------------------------------------------------
        */

        Mail::to($application->user->email)
            ->queue(new ApplicationRejected($application));

        return back()->with('success', 'Application rejected and student notified.');
    }
}