<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\JobListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CareersController extends Controller
{
    public function index()
    {
        $jobs = JobListing::active()->get();

        return view('pages.careers', compact('jobs'));
    }

    public function apply(Request $request, JobListing $job)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'portfolio_url' => 'nullable|url|max:500',
            'linkedin_url' => 'nullable|url|max:500',
            'cover_letter' => 'nullable|string|max:5000',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:10240',
        ]);

        // Store resume securely in local storage
        $uploadedFile = $request->file('resume');
        $originalName = $uploadedFile->getClientOriginalName();
        $resumePath = $uploadedFile->store('resumes', 'local');

        $application = JobApplication::create([
            'job_listing_id' => $job->id,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'portfolio_url' => $validated['portfolio_url'] ?? null,
            'linkedin_url' => $validated['linkedin_url'] ?? null,
            'cover_letter' => $validated['cover_letter'] ?? null,
            'resume_path' => $resumePath,
            'resume_filename' => $originalName,
            'status' => JobApplication::STATUS_PENDING,
        ]);

        // Attempt notification email, gracefully caught if mailer is unconfigured
        try {
            if (! empty($job->apply_email)) {
                Mail::send([], [], function ($mail) use ($job, $application) {
                    $mail->to($job->apply_email)
                        ->subject("New Application: {$application->name} — {$job->title}")
                        ->html(
                            '<h3>New Job Application Received</h3>'.
                            "<p><strong>Position:</strong> {$job->title} ({$job->department})</p>".
                            "<p><strong>Candidate:</strong> {$application->name}</p>".
                            "<p><strong>Email:</strong> {$application->email}</p>".
                            "<p><strong>Phone:</strong> {$application->phone}</p>".
                            ($application->portfolio_url ? "<p><strong>Portfolio / URL:</strong> <a href=\"{$application->portfolio_url}\">{$application->portfolio_url}</a></p>" : '').
                            ($application->cover_letter ? "<p><strong>Cover Letter:</strong><br>".nl2br(e($application->cover_letter)).'</p>' : '').
                            '<br><hr><p><small style="color:#888">Log in to the MonarchI HR Portal to review full candidate details and download their CV.</small></p>'
                        );
                });
            }
        } catch (\Throwable $e) {
            report($e);
        }

        $successMsg = "Your application for {$job->title} has been received! Our talent team will review your profile.";

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => $successMsg,
                'application_id' => $application->id,
            ]);
        }

        return back()->with('success', $successMsg);
    }
}
