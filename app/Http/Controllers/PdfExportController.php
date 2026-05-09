<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Scholarship;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PdfExportController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | EXPORT ALL APPLICATIONS
    |--------------------------------------------------------------------------
    */

    public function exportApplications(Request $request)
    {
        $query = Application::with(['user', 'scholarship']);

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->scholarship_id) {
            $query->where('scholarship_id', $request->scholarship_id);
        }

        $applications = $query->latest()->get();
        $scholarships = Scholarship::all();

        $pdf = Pdf::loadView('pdf.applications', compact('applications', 'scholarships'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('fundnest-applications-' . now()->format('Y-m-d') . '.pdf');
    }

    /*
    |--------------------------------------------------------------------------
    | EXPORT SINGLE SCHOLARSHIP REPORT
    |--------------------------------------------------------------------------
    */

    public function exportScholarship(Scholarship $scholarship)
    {
        $scholarship->load(['applications.user', 'applications.documents', 'category']);

        $pdf = Pdf::loadView('pdf.scholarship_report', compact('scholarship'))
            ->setPaper('a4', 'portrait');

        return $pdf->download(
            'scholarship-' . \Str::slug($scholarship->title) . '-' . now()->format('Y-m-d') . '.pdf'
        );
    }
}
