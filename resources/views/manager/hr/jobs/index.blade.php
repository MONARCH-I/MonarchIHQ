<x-manager-sidebar>
    <x-slot name="pageTitle">Job Listings</x-slot>
    <x-slot name="breadcrumb">HR → Jobs</x-slot>

    <x-slot name="sidebarNav">
        <div class="sidebar-nav-label">HR</div>
        <a href="{{ route('manager.hr.jobs') }}"     class="sidebar-nav-link active"><span>💼</span> Job Listings</a>
        <a href="{{ route('manager.hr.messages') }}" class="sidebar-nav-link"><span>✉️</span> Messages</a>
    </x-slot>

    <x-slot name="topbarActions">
        <a href="{{ route('manager.hr.jobs.create') }}" class="btn btn-primary btn-sm">+ New Job</a>
    </x-slot>

    <div class="card">
        @if($jobs->isEmpty())
        <div style="text-align:center;padding:48px;color:var(--text-muted)">
            <div style="font-size:32px;margin-bottom:12px">💼</div>
            No job listings yet. <a href="{{ route('manager.hr.jobs.create') }}" style="color:var(--accent)">Create one</a>.
        </div>
        @else
        <table class="data-table">
            <thead><tr><th>Title</th><th>Department</th><th>Type</th><th>Location</th><th>Status</th><th>Actions</th></tr></thead>
            <tbody>
            @foreach($jobs as $job)
            <tr>
                <td style="color:var(--text-primary);font-weight:600">{{ $job->title }}</td>
                <td style="font-size:12px">{{ $job->department }}</td>
                <td style="font-size:12px">{{ $job->employmentTypeLabel() }}</td>
                <td style="font-size:12px">{{ $job->location }}</td>
                <td>
                    @if($job->is_active)
                    <span class="badge" style="background:rgba(34,197,94,0.1);color:#4ade80;border-color:rgba(34,197,94,0.2)">Active</span>
                    @else
                    <span class="badge" style="background:rgba(255,255,255,0.05);color:var(--text-muted);border-color:var(--border)">Inactive</span>
                    @endif
                </td>
                <td>
                    <div style="display:flex;gap:6px;flex-wrap:wrap">
                        <a href="{{ route('manager.hr.jobs.edit', $job) }}" class="btn btn-secondary btn-sm">Edit</a>
                        <form method="POST" action="{{ route('manager.hr.jobs.toggle-active', $job) }}">
                            @csrf
                            <button class="btn btn-sm" style="background:rgba(41,151,255,0.1);color:#2997ff;border:1px solid rgba(41,151,255,0.2)">
                                {{ $job->is_active ? 'Deactivate' : 'Activate' }}
                            </button>
                        </form>
                        <form method="POST" action="{{ route('manager.hr.jobs.destroy', $job) }}" onsubmit="return confirm('Delete this job listing?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <div style="padding:16px 0 0">{{ $jobs->links() }}</div>
        @endif
    </div>
</x-manager-sidebar>
