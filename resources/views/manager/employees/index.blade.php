<x-manager-sidebar>
    <x-slot name="pageTitle">Employees</x-slot>
    <x-slot name="breadcrumb">Employees</x-slot>

    <x-slot name="sidebarNav">
        <div class="sidebar-nav-label">Administration</div>
        <a href="{{ route('manager.employees.index') }}" class="sidebar-nav-link active"><span>🔐</span> All Employees</a>
        <a href="{{ route('manager.employees.create') }}" class="sidebar-nav-link"><span>➕</span> Add Employee</a>
    </x-slot>

    <x-slot name="topbarActions">
        <a href="{{ route('manager.employees.create') }}" class="btn btn-primary btn-sm">+ Add Employee</a>
    </x-slot>

    <div class="card">
        @if($employees->isEmpty())
        <div style="text-align:center;padding:48px;color:var(--text-muted)">No staff accounts found.</div>
        @else
        <table class="data-table">
            <thead><tr><th>Name</th><th>Email</th><th>Role</th><th>Added</th><th>Actions</th></tr></thead>
            <tbody>
            @foreach($employees as $emp)
            <tr>
                <td>
                    <div style="display:flex;align-items:center;gap:10px">
                        <div style="width:32px;height:32px;border-radius:8px;background:var(--accent-dim);color:var(--accent);display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:700;flex-shrink:0">
                            {{ strtoupper(substr($emp->name,0,2)) }}
                        </div>
                        <span style="color:var(--text-primary);font-weight:600">{{ $emp->name }}</span>
                    </div>
                </td>
                <td style="font-size:12px">{{ $emp->email }}</td>
                <td>
                    <span class="badge" style="background:rgba(41,151,255,0.1);color:#2997ff;border-color:rgba(41,151,255,0.2)">{{ $emp->roleLabel() }}</span>
                </td>
                <td style="font-size:12px">{{ $emp->created_at->format('d M Y') }}</td>
                <td>
                    <div style="display:flex;gap:6px">
                        @if($emp->id !== auth()->id())
                        <a href="{{ route('manager.employees.edit', $emp) }}" class="btn btn-secondary btn-sm">Edit</a>
                        <form method="POST" action="{{ route('manager.employees.destroy', $emp) }}" onsubmit="return confirm('Remove {{ $emp->name }}?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">Remove</button>
                        </form>
                        @else
                        <span style="font-size:11px;color:var(--text-muted);padding:6px">You</span>
                        @endif
                    </div>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <div style="padding:16px 0 0">{{ $employees->links() }}</div>
        @endif
    </div>
</x-manager-sidebar>
