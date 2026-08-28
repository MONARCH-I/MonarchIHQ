<x-manager-sidebar>
    <x-slot name="pageTitle">News Articles</x-slot>
    <x-slot name="breadcrumb">Content → News</x-slot>

    <x-slot name="sidebarNav">
        <div class="sidebar-nav-label">Content</div>
        <a href="{{ route('manager.content.news') }}"     class="sidebar-nav-link active"><span>📰</span> News Articles</a>
        <a href="{{ route('manager.content.projects') }}" class="sidebar-nav-link"><span>🚀</span> Portfolio Projects</a>
    </x-slot>

    <x-slot name="topbarActions">
        <a href="{{ route('manager.content.news.create') }}" class="btn btn-primary btn-sm">+ New Article</a>
    </x-slot>

    <div class="card">
        @if($articles->isEmpty())
        <div style="text-align:center;padding:48px;color:var(--text-muted)">
            <div style="font-size:32px;margin-bottom:12px">📰</div>
            <p>No articles yet. <a href="{{ route('manager.content.news.create') }}" style="color:var(--accent)">Create your first one</a>.</p>
        </div>
        @else
        <table class="data-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Published</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($articles as $article)
            <tr>
                <td style="color:var(--text-primary);font-weight:600;max-width:300px">
                    <div style="overflow:hidden;text-overflow:ellipsis;white-space:nowrap">{{ $article->title }}</div>
                    <div style="font-size:11px;color:var(--text-muted);margin-top:2px">{{ $article->author_name }} · {{ $article->read_time_minutes }}m read</div>
                </td>
                <td>
                    <span class="badge" style="background:rgba(41,151,255,0.1);color:#2997ff;border-color:rgba(41,151,255,0.2)">
                        {{ $article->categoryLabel() }}
                    </span>
                </td>
                <td>
                    @if($article->is_published)
                    <span class="badge" style="background:rgba(34,197,94,0.1);color:#4ade80;border-color:rgba(34,197,94,0.2)">Published</span>
                    @else
                    <span class="badge" style="background:rgba(255,255,255,0.05);color:var(--text-muted);border-color:var(--border)">Draft</span>
                    @endif
                </td>
                <td style="font-size:12px">{{ $article->published_at?->format('d M Y') ?? '—' }}</td>
                <td>
                    <div style="display:flex;gap:6px;flex-wrap:wrap">
                        <a href="{{ route('manager.content.news.edit', $article) }}" class="btn btn-secondary btn-sm">Edit</a>
                        <form method="POST" action="{{ route('manager.content.news.toggle-publish', $article) }}">
                            @csrf
                            <button class="btn btn-sm" style="background:rgba(41,151,255,0.1);color:#2997ff;border:1px solid rgba(41,151,255,0.2)">
                                {{ $article->is_published ? 'Unpublish' : 'Publish' }}
                            </button>
                        </form>
                        <form method="POST" action="{{ route('manager.content.news.destroy', $article) }}" onsubmit="return confirm('Delete this article?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <div style="padding:16px 0 0">{{ $articles->links() }}</div>
        @endif
    </div>
</x-manager-sidebar>
