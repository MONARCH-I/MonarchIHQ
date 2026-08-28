<x-manager-sidebar>
    <x-slot name="pageTitle">Portfolio Projects</x-slot>
    <x-slot name="breadcrumb">Content → Projects</x-slot>

    <x-slot name="sidebarNav">
        <div class="sidebar-nav-label">Content</div>
        <a href="{{ route('manager.content.news') }}"     class="sidebar-nav-link"><span>📰</span> News Articles</a>
        <a href="{{ route('manager.content.projects') }}" class="sidebar-nav-link active"><span>🚀</span> Portfolio Projects</a>
    </x-slot>

    <x-slot name="topbarActions">
        <a href="{{ route('manager.content.projects.create') }}" class="btn btn-primary btn-sm">+ New Project</a>
    </x-slot>

    <div class="card">
        @if($projects->isEmpty())
        <div style="text-align:center;padding:48px;color:var(--text-muted)">
            <div style="font-size:32px;margin-bottom:12px">🚀</div>
            <p>No projects yet. <a href="{{ route('manager.content.projects.create') }}" style="color:var(--accent)">Create your first one</a>.</p>
        </div>
        @else
        <table class="data-table">
            <thead>
                <tr>
                    <th>Project</th>
                    <th>Domain</th>
                    <th>Status</th>
                    <th>Published</th>
                    <th>Sort</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($projects as $project)
            <tr>
                <td style="color:var(--text-primary);font-weight:600;max-width:260px">
                    <div style="overflow:hidden;text-overflow:ellipsis;white-space:nowrap">{{ $project->title }}</div>
                </td>
                <td style="font-size:12px">{{ $project->domain }}{{ $project->sub_domain ? ' · '.$project->sub_domain : '' }}</td>
                <td>
                    <span class="badge {{ $project->statusBadgeClass() }}">{{ $project->status }}</span>
                </td>
                <td>
                    @if($project->is_published)
                    <span class="badge" style="background:rgba(34,197,94,0.1);color:#4ade80;border-color:rgba(34,197,94,0.2)">Live</span>
                    @else
                    <span class="badge" style="background:rgba(255,255,255,0.05);color:var(--text-muted);border-color:var(--border)">Hidden</span>
                    @endif
                </td>
                <td style="font-size:12px;color:var(--text-muted)">{{ $project->sort_order }}</td>
                <td>
                    <div style="display:flex;gap:6px">
                        <a href="{{ route('manager.content.projects.edit', $project) }}" class="btn btn-secondary btn-sm">Edit</a>
                        <form method="POST" action="{{ route('manager.content.projects.destroy', $project) }}" onsubmit="return confirm('Delete this project?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <div style="padding:16px 0 0">{{ $projects->links() }}</div>
        @endif
    </div>
</x-manager-sidebar>
