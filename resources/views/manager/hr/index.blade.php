<x-manager-sidebar>
    <x-slot name="pageTitle">HR Manager</x-slot>
    <x-slot name="breadcrumb">Overview</x-slot>

    <x-slot name="sidebarNav">
        <div class="sidebar-nav-label">HR</div>
        <a href="{{ route('manager.hr.jobs') }}"     class="sidebar-nav-link {{ request()->is('manager/hr/jobs*') ? 'active' : '' }}"><span>💼</span> Job Listings</a>
        <a href="{{ route('manager.hr.messages') }}" class="sidebar-nav-link {{ request()->is('manager/hr/messages*') ? 'active' : '' }}">
            <span>✉️</span> Messages
            @if($stats['new_messages'] > 0)
            <span class="badge" style="background:#2997ff;color:#fff;border:none;padding:1px 6px;font-size:9px;margin-left:auto">{{ $stats['new_messages'] }}</span>
            @endif
        </a>
    </x-slot>

    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:16px;margin-bottom:28px">
        <div class="stat-card">
            <div class="stat-label">Active Jobs</div>
            <div class="stat-value" style="color:#4ade80">{{ $stats['active_jobs'] }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Total Jobs</div>
            <div class="stat-value">{{ $stats['total_jobs'] }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">New Messages</div>
            <div class="stat-value" style="color:#2997ff">{{ $stats['new_messages'] }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Open Messages</div>
            <div class="stat-value" style="color:#f59e0b">{{ $stats['open_messages'] }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Replied</div>
            <div class="stat-value">{{ $stats['replied_messages'] }}</div>
        </div>
    </div>

    <div class="card">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px">
            <div style="font-size:13px;font-weight:700;color:var(--text-primary)">Recent Unread Messages</div>
            <a href="{{ route('manager.hr.messages') }}" style="font-size:12px;color:var(--accent)">View All →</a>
        </div>
        @if($recent_messages->isEmpty())
        <p style="color:var(--text-muted);font-size:13px">No open messages.</p>
        @else
        <div style="display:flex;flex-direction:column;gap:8px">
        @foreach($recent_messages as $msg)
        <a href="{{ route('manager.hr.messages.show', $msg) }}" style="display:block;padding:12px 14px;background:var(--bg-hover);border-radius:10px;border:1px solid var(--border);text-decoration:none;transition:border-color 0.15s" onmouseover="this.style.borderColor='rgba(41,151,255,0.3)'" onmouseout="this.style.borderColor='var(--border)'">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:4px">
                <span style="font-size:13px;font-weight:600;color:var(--text-primary)">{{ $msg->name }}</span>
                <span class="badge {{ $msg->statusBadgeClass() }}">{{ $msg->statusLabel() }}</span>
            </div>
            <div style="font-size:12px;color:var(--text-secondary)">{{ $msg->subject ?? Str::limit($msg->message, 60) }}</div>
            <div style="font-size:11px;color:var(--text-muted);margin-top:4px">{{ $msg->created_at->diffForHumans() }}</div>
        </a>
        @endforeach
        </div>
        @endif
    </div>
</x-manager-sidebar>
