<x-manager-sidebar>
    <x-slot name="pageTitle">Contact Messages</x-slot>
    <x-slot name="breadcrumb">HR → Messages</x-slot>

    <x-slot name="sidebarNav">
        <div class="sidebar-nav-label">HR</div>
        <a href="{{ route('manager.hr.jobs') }}"     class="sidebar-nav-link"><span>💼</span> Job Listings</a>
        <a href="{{ route('manager.hr.messages') }}" class="sidebar-nav-link active"><span>✉️</span> Messages</a>
    </x-slot>

    <div class="card">
        @if($messages->isEmpty())
        <div style="text-align:center;padding:48px;color:var(--text-muted)">
            <div style="font-size:32px;margin-bottom:12px">✉️</div>
            No contact messages yet.
        </div>
        @else
        <table class="data-table">
            <thead><tr><th>From</th><th>Subject</th><th>Status</th><th>Received</th><th></th></tr></thead>
            <tbody>
            @foreach($messages as $msg)
            <tr>
                <td>
                    <div style="font-weight:600;color:var(--text-primary)">{{ $msg->name }}</div>
                    <div style="font-size:11px;color:var(--text-muted)">{{ $msg->email }}</div>
                </td>
                <td style="font-size:13px;max-width:260px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">
                    {{ $msg->subject ?? Str::limit($msg->message, 55) }}
                </td>
                <td><span class="badge {{ $msg->statusBadgeClass() }}">{{ $msg->statusLabel() }}</span></td>
                <td style="font-size:12px">{{ $msg->created_at->format('d M Y') }}</td>
                <td><a href="{{ route('manager.hr.messages.show', $msg) }}" class="btn btn-secondary btn-sm">Open</a></td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <div style="padding:16px 0 0">{{ $messages->links() }}</div>
        @endif
    </div>
</x-manager-sidebar>
