<x-manager-sidebar>
    <x-slot name="pageTitle">Job Applications</x-slot>
    <x-slot name="breadcrumb">HR → Applications</x-slot>

    <x-slot name="sidebarNav">
        <div class="sidebar-nav-label">HR</div>
        <a href="{{ route('manager.hr.jobs') }}"         class="sidebar-nav-link"><span>💼</span> Job Listings</a>
        <a href="{{ route('manager.hr.applications') }}" class="sidebar-nav-link active">
            <span>📄</span> Applications
            @php $pendingCount = \App\Models\JobApplication::pending()->count(); @endphp
            @if($pendingCount > 0)
            <span class="badge" style="background:#2997ff;color:#fff;border:none;padding:1px 6px;font-size:9px;margin-left:auto">{{ $pendingCount }}</span>
            @endif
        </a>
        <a href="{{ route('manager.hr.messages') }}"     class="sidebar-nav-link"><span>✉️</span> Messages</a>
    </x-slot>

    {{-- Filter Bar --}}
    <div class="card" style="margin-bottom:20px;padding:16px 20px">
        <form method="GET" action="{{ route('manager.hr.applications') }}" style="display:flex;gap:12px;flex-wrap:wrap;align-items:center">
            <div style="flex:1;min-width:200px">
                <input name="search" class="form-input" value="{{ request('search') }}" placeholder="Search candidate name, email, phone...">
            </div>

            <div style="min-width:180px">
                <select name="job_id" class="form-select" onchange="this.form.submit()">
                    <option value="">All Positions ({{ $jobs->count() }})</option>
                    @foreach($jobs as $j)
                    <option value="{{ $j->id }}" {{ request('job_id') == $j->id ? 'selected' : '' }}>{{ $j->title }}</option>
                    @endforeach
                </select>
            </div>

            <div style="min-width:150px">
                <select name="status" class="form-select" onchange="this.form.submit()">
                    <option value="">All Statuses</option>
                    <option value="pending"     {{ request('status')=='pending'?'selected':'' }}>Pending Review</option>
                    <option value="reviewed"    {{ request('status')=='reviewed'?'selected':'' }}>Reviewed</option>
                    <option value="shortlisted" {{ request('status')=='shortlisted'?'selected':'' }}>Shortlisted</option>
                    <option value="rejected"    {{ request('status')=='rejected'?'selected':'' }}>Rejected</option>
                </select>
            </div>

            <button type="submit" class="btn btn-secondary" style="font-size:12px;padding:8px 14px">Filter</button>
            @if(request()->anyFilled(['search','job_id','status']))
            <a href="{{ route('manager.hr.applications') }}" class="btn btn-secondary" style="font-size:12px;padding:8px 14px;color:var(--text-muted)">Clear</a>
            @endif
        </form>
    </div>

    @if(session('success'))
    <div class="alert alert-success" style="margin-bottom:20px">{{ session('success') }}</div>
    @endif

    <div class="card" style="padding:0;overflow:hidden">
        @if($applications->isEmpty())
        <div style="padding:48px 24px;text-align:center;color:var(--text-muted)">
            <div style="font-size:32px;margin-bottom:12px">📭</div>
            <div style="font-size:15px;font-weight:600;color:var(--text-primary);margin-bottom:4px">No applications found</div>
            <div style="font-size:13px">Candidate submissions from the Careers page will appear here.</div>
        </div>
        @else
        <table class="table" style="width:100%">
            <thead>
                <tr>
                    <th>Candidate</th>
                    <th>Target Position</th>
                    <th>Date Applied</th>
                    <th>Status</th>
                    <th style="text-align:right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($applications as $app)
                <tr>
                    <td>
                        <div style="font-weight:600;color:var(--text-primary)">{{ $app->name }}</div>
                        <div style="font-size:12px;color:var(--text-secondary)">{{ $app->email }} &middot; {{ $app->phone }}</div>
                    </td>
                    <td>
                        <div style="font-size:13px;color:var(--text-primary);font-weight:500">{{ $app->jobListing?->title ?? 'General' }}</div>
                        <div style="font-size:11px;color:var(--text-muted)">{{ $app->jobListing?->department }}</div>
                    </td>
                    <td style="font-size:12px;color:var(--text-secondary);white-space:nowrap">
                        {{ $app->created_at->format('d M Y, H:i') }}
                        <div style="font-size:10px;color:var(--text-muted)">{{ $app->created_at->diffForHumans() }}</div>
                    </td>
                    <td>
                        @php
                            $badgeStyle = match($app->status) {
                                'pending'     => 'background:rgba(234,179,8,0.15);color:#facc15;border:1px solid rgba(234,179,8,0.3)',
                                'reviewed'    => 'background:rgba(59,130,246,0.15);color:#60a5fa;border:1px solid rgba(59,130,246,0.3)',
                                'shortlisted' => 'background:rgba(34,197,94,0.15);color:#4ade80;border:1px solid rgba(34,197,94,0.3)',
                                'rejected'    => 'background:rgba(244,63,94,0.15);color:#fb7185;border:1px solid rgba(244,63,94,0.3)',
                                default       => 'background:rgba(255,255,255,0.1);color:#fff',
                            };
                        @endphp
                        <span class="badge" style="{{ $badgeStyle }};padding:3px 8px;border-radius:6px;font-size:11px;font-weight:600">
                            {{ $app->statusLabel() }}
                        </span>
                    </td>
                    <td style="text-align:right;white-space:nowrap">
                        <div style="display:inline-flex;align-items:center;gap:8px">
                            <a href="{{ route('manager.hr.applications.download-cv', $app) }}" class="btn btn-secondary" style="font-size:11px;padding:5px 10px" title="Download CV ({{ $app->resume_filename }})">
                                ⬇ CV
                            </a>
                            <a href="{{ route('manager.hr.applications.show', $app) }}" class="btn btn-primary" style="font-size:11px;padding:5px 10px">
                                Review &rarr;
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div style="padding:16px 20px;border-top:1px solid var(--border)">
            {{ $applications->links() }}
        </div>
        @endif
    </div>
</x-manager-sidebar>
