<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\JobListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HrManagerController extends Controller
{
    // ═══════════════════════════════════════════════════════════════
    //  DASHBOARD
    // ═══════════════════════════════════════════════════════════════

    public function index()
    {
        abort_if(! auth()->user()->isHrManager(), 403);

        $stats = [
            'active_jobs' => JobListing::active()->count(),
            'total_jobs' => JobListing::count(),
            'new_messages' => ContactMessage::where('status', 'new')->count(),
            'open_messages' => ContactMessage::open()->count(),
            'replied_messages' => ContactMessage::where('status', 'replied')->count(),
        ];

        $recent_messages = ContactMessage::open()->latest()->limit(5)->get();

        return view('manager.hr.index', compact('stats', 'recent_messages'));
    }

    // ═══════════════════════════════════════════════════════════════
    //  JOB LISTINGS
    // ═══════════════════════════════════════════════════════════════

    public function jobsList()
    {
        $this->authorize('viewAny', JobListing::class);
        $jobs = JobListing::latest()->paginate(15);

        return view('manager.hr.jobs.index', compact('jobs'));
    }

    public function jobsCreate()
    {
        $this->authorize('create', JobListing::class);

        return view('manager.hr.jobs.create');
    }

    public function jobsStore(Request $request)
    {
        $this->authorize('create', JobListing::class);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'department' => 'required|string|max:100',
            'employment_type' => 'required|in:full_time,part_time,contract,internship',
            'location' => 'required|string|max:150',
            'skills_required' => 'nullable|string',
            'description' => 'nullable|string',
            'apply_email' => 'required|email',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $data['created_by'] = auth()->id();
        JobListing::create($data);

        return redirect()->route('manager.hr.jobs')
            ->with('success', 'Job listing created successfully.');
    }

    public function jobsEdit(JobListing $job)
    {
        $this->authorize('update', $job);

        return view('manager.hr.jobs.edit', compact('job'));
    }

    public function jobsUpdate(Request $request, JobListing $job)
    {
        $this->authorize('update', $job);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'department' => 'required|string|max:100',
            'employment_type' => 'required|in:full_time,part_time,contract,internship',
            'location' => 'required|string|max:150',
            'skills_required' => 'nullable|string',
            'description' => 'nullable|string',
            'apply_email' => 'required|email',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $job->update($data);

        return redirect()->route('manager.hr.jobs')
            ->with('success', 'Job listing updated successfully.');
    }

    public function jobsToggleActive(JobListing $job)
    {
        $this->authorize('update', $job);
        $job->update(['is_active' => ! $job->is_active]);
        $status = $job->is_active ? 'activated' : 'deactivated';

        return back()->with('success', "Job listing {$status}.");
    }

    public function jobsDestroy(JobListing $job)
    {
        $this->authorize('delete', $job);
        $job->delete();

        return redirect()->route('manager.hr.jobs')
            ->with('success', 'Job listing deleted.');
    }

    // ═══════════════════════════════════════════════════════════════
    //  CONTACT MESSAGES
    // ═══════════════════════════════════════════════════════════════

    public function messagesList()
    {
        $this->authorize('viewAny', ContactMessage::class);
        $messages = ContactMessage::latest()->paginate(20);

        return view('manager.hr.messages.index', compact('messages'));
    }

    public function messagesShow(ContactMessage $message)
    {
        $this->authorize('view', $message);

        // Auto-move from "new" to "in_progress" when first opened
        if ($message->status === ContactMessage::STATUS_NEW) {
            $message->update(['status' => ContactMessage::STATUS_IN_PROGRESS]);
        }

        return view('manager.hr.messages.show', compact('message'));
    }

    public function messagesUpdateStatus(Request $request, ContactMessage $message)
    {
        $this->authorize('update', $message);
        $data = $request->validate([
            'status' => 'required|in:new,in_progress,replied,closed',
            'hr_notes' => 'nullable|string|max:2000',
        ]);
        $message->update($data);

        return back()->with('success', 'Message status updated.');
    }

    /**
     * Send an email reply to the customer directly from the portal.
     * Uses Laravel's built-in Mail facade with the default mailer config.
     */
    public function messagesSendReply(Request $request, ContactMessage $message)
    {
        $this->authorize('reply', $message);

        $data = $request->validate([
            'reply_subject' => 'required|string|max:255',
            'reply_body' => 'required|string',
        ]);

        Mail::send([], [], function ($mail) use ($message, $data) {
            $mail->to($message->email, $message->name)
                ->subject($data['reply_subject'])
                ->html(
                    nl2br(e($data['reply_body'])).
                    '<br><br><hr><small style="color:#888">MonarchI HQ · Accra, Ghana</small>'
                );
        });

        $message->update([
            'status' => ContactMessage::STATUS_REPLIED,
            'hr_notes' => ($message->hr_notes ? $message->hr_notes."\n\n" : '').
                            '[Reply sent '.now()->format('d M Y H:i').']',
            'replied_at' => now(),
        ]);

        return back()->with('success', 'Reply sent to '.$message->email.'.');
    }

    public function messagesDestroy(ContactMessage $message)
    {
        $this->authorize('delete', $message);
        $message->delete();

        return redirect()->route('manager.hr.messages')
            ->with('success', 'Message deleted.');
    }
}
