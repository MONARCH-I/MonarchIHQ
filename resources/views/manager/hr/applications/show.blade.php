<x-manager-sidebar>
    <x-slot name="pageTitle">Application: {{ $application->name }}</x-slot>
    <x-slot name="breadcrumb">HR → Applications → #{{ $application->id }}</x-slot>

    <x-slot name="sidebarNav">
        <div class="sidebar-nav-label">HR</div>
        <a href="{{ route('manager.hr.jobs') }}"         class="sidebar-nav-link"><span>💼</span> Job Listings</a>
        <a href="{{ route('manager.hr.applications') }}" class="sidebar-nav-link active"><span>📄</span> Applications</a>
        <a href="{{ route('manager.hr.messages') }}"     class="sidebar-nav-link"><span>✉️</span> Messages</a>
    </x-slot>

    <div style="margin-bottom:16px">
        <a href="{{ route('manager.hr.applications') }}" style="font-size:13px;color:var(--text-secondary);text-decoration:none">
            &larr; Back to all applications
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success" style="margin-bottom:20px">{{ session('success') }}</div>
    @endif

    <div style="display:grid;grid-template-columns:1fr 340px;gap:24px;align-items:start">

        {{-- Left Column: Candidate & Application Details --}}
        <div style="display:flex;flex-direction:column;gap:20px">

            {{-- Candidate Header Card --}}
            <div class="card">
                <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:16px;margin-bottom:16px">
                    <div>
                        <h2 style="font-size:22px;font-weight:700;color:var(--text-primary);margin-bottom:4px">{{ $application->name }}</h2>
                        <div style="font-size:13px;color:var(--accent);font-weight:500">
                            Applied for: {{ $application->jobListing?->title ?? 'General Position' }}
                        </div>
                    </div>
                    @php
                        $badgeStyle = match($application->status) {
                            'pending'     => 'background:rgba(234,179,8,0.15);color:#facc15;border:1px solid rgba(234,179,8,0.3)',
                            'reviewed'    => 'background:rgba(59,130,246,0.15);color:#c4203a;border:1px solid rgba(59,130,246,0.3)',
                            'shortlisted' => 'background:rgba(34,197,94,0.15);color:#4ade80;border:1px solid rgba(34,197,94,0.3)',
                            'rejected'    => 'background:rgba(244,63,94,0.15);color:#fb7185;border:1px solid rgba(244,63,94,0.3)',
                            default       => 'background:rgba(255,255,255,0.1);color:#fff',
                        };
                    @endphp
                    <span class="badge" style="{{ $badgeStyle }};padding:4px 10px;border-radius:8px;font-size:12px;font-weight:600">
                        {{ $application->statusLabel() }}
                    </span>
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;padding-top:16px;border-top:1px solid var(--border);font-size:13px">
                    <div>
                        <span style="color:var(--text-muted);display:block;font-size:11px;text-transform:uppercase;letter-spacing:0.05em">Email</span>
                        <a href="mailto:{{ $application->email }}" style="color:var(--text-primary);text-decoration:none;font-weight:500">
                            {{ $application->email }}
                        </a>
                    </div>
                    <div>
                        <span style="color:var(--text-muted);display:block;font-size:11px;text-transform:uppercase;letter-spacing:0.05em">Phone</span>
                        <a href="tel:{{ $application->phone }}" style="color:var(--text-primary);text-decoration:none;font-weight:500">
                            {{ $application->phone }}
                        </a>
                    </div>
                    <div>
                        <span style="color:var(--text-muted);display:block;font-size:11px;text-transform:uppercase;letter-spacing:0.05em">Applied Date</span>
                        <span style="color:var(--text-primary)">{{ $application->created_at->format('d M Y, H:i') }}</span>
                    </div>
                    <div>
                        <span style="color:var(--text-muted);display:block;font-size:11px;text-transform:uppercase;letter-spacing:0.05em">Portfolio / GitHub</span>
                        @if($application->portfolio_url)
                        <a href="{{ $application->portfolio_url }}" target="_blank" rel="noopener noreferrer" style="color:var(--accent);word-break:break-all">
                            {{ $application->portfolio_url }} ↗
                        </a>
                        @else
                        <span style="color:var(--text-muted)">Not provided</span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Resume / CV Attachment Card --}}
            <div class="card">
                <div style="font-size:14px;font-weight:700;color:var(--text-primary);margin-bottom:12px">Candidate Resume / CV</div>
                <div style="display:flex;align-items:center;justify-content:space-between;padding:16px;background:var(--bg-hover);border-radius:12px;border:1px solid var(--border)">
                    <div style="display:flex;align-items:center;gap:12px">
                        <div style="width:40px;height:40px;border-radius:10px;background:rgba(156,5,29,0.15);color:var(--accent);display:flex;align-items:center;justify-content:center;font-weight:800;font-size:13px">
                            CV
                        </div>
                        <div>
                            <div style="font-weight:600;color:var(--text-primary);font-size:13px">{{ $application->resume_filename }}</div>
                            <div style="font-size:11px;color:var(--text-muted)">Stored securely in local storage</div>
                        </div>
                    </div>
                    <a href="{{ route('manager.hr.applications.download-cv', $application) }}" class="btn btn-primary" style="font-size:12px;padding:8px 16px;display:flex;align-items:center;gap:6px">
                        <span>Download CV</span>
                        <span>⬇</span>
                    </a>
                </div>
            </div>

            {{-- Cover Letter Card --}}
            <div class="card">
                <div style="font-size:14px;font-weight:700;color:var(--text-primary);margin-bottom:12px">Cover Letter / Note</div>
                @if($application->cover_letter)
                <div style="padding:16px;background:var(--bg-hover);border-radius:12px;border:1px solid var(--border);font-size:13px;line-height:1.7;color:var(--text-primary);white-space:pre-wrap">
{{ $application->cover_letter }}
                </div>
                @else
                <p style="color:var(--text-muted);font-size:13px;font-style:italic">No cover letter was submitted by this candidate.</p>
                @endif
            </div>

        </div>

        {{-- Right Column: HR Status & Decision Workflow --}}
        <div style="display:flex;flex-direction:column;gap:20px">

            {{-- Status Update Form --}}
            <div class="card">
                <div style="font-size:14px;font-weight:700;color:var(--text-primary);margin-bottom:16px">Application Status &amp; Notes</div>

                <form method="POST" action="{{ route('manager.hr.applications.status', $application) }}">
                    @csrf
                    @method('PATCH')

                    <div class="form-group">
                        <label class="form-label">Review Status</label>
                        <select name="status" class="form-select">
                            <option value="pending"     {{ $application->status == 'pending' ? 'selected' : '' }}>Pending Review</option>
                            <option value="reviewed"    {{ $application->status == 'reviewed' ? 'selected' : '' }}>Reviewed</option>
                            <option value="shortlisted" {{ $application->status == 'shortlisted' ? 'selected' : '' }}>Shortlisted (Move to Interview)</option>
                            <option value="rejected"    {{ $application->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Internal HR Notes</label>
                        <textarea name="hr_notes" class="form-textarea" style="min-height:120px" placeholder="Private notes on candidate experience, interview feedback, rating...">{{ old('hr_notes', $application->hr_notes) }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary" style="width:100%;margin-top:8px">
                        Save Status &amp; Notes
                    </button>
                </form>
            </div>

            {{-- Quick Contact Actions --}}
            <div class="card">
                <div style="font-size:14px;font-weight:700;color:var(--text-primary);margin-bottom:12px">Candidate Actions</div>
                <div style="display:flex;flex-direction:column;gap:8px">
                    <a href="mailto:{{ $application->email }}?subject=Your%20Application%20at%20MonarchI%20HQ%20-%20{{ rawurlencode($application->jobListing?->title ?? 'Position') }}"
                       class="btn btn-secondary" style="font-size:12px;text-align:center">
                        ✉️ Send Email to Candidate
                    </a>

                    <form method="POST" action="{{ route('manager.hr.applications.destroy', $application) }}" onsubmit="return confirm('Are you sure you want to permanently delete this application and its resume?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-secondary" style="width:100%;color:#fb7185;border-color:rgba(244,63,94,0.3);font-size:12px;margin-top:8px">
                            🗑️ Delete Application
                        </button>
                    </form>
                </div>
            </div>

        </div>

    </div>
</x-manager-sidebar>
