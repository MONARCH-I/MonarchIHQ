<x-manager-sidebar>
    <x-slot name="pageTitle">Content Manager</x-slot>
    <x-slot name="breadcrumb">Overview</x-slot>

    <x-slot name="sidebarNav">
        <div class="sidebar-nav-label">Content</div>
        <a href="{{ route('manager.content.news') }}"   class="sidebar-nav-link {{ request()->is('manager/content/news*') ? 'active' : '' }}">
            <span>📰</span> News Articles
        </a>
        <a href="{{ route('manager.content.projects') }}" class="sidebar-nav-link {{ request()->is('manager/content/projects*') ? 'active' : '' }}">
            <span>🚀</span> Portfolio Projects
        </a>
    </x-slot>

    {{-- Stats Grid --}}
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:16px;margin-bottom:28px">
        <div class="stat-card">
            <div class="stat-label">Total Articles</div>
            <div class="stat-value">{{ $stats['total_articles'] }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Published</div>
            <div class="stat-value" style="color:#2997ff">{{ $stats['published_articles'] }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Total Projects</div>
            <div class="stat-value">{{ $stats['total_projects'] }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Live Projects</div>
            <div class="stat-value" style="color:#4ade80">{{ $stats['published_projects'] }}</div>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="card" style="margin-bottom:20px">
        <div style="font-size:13px;font-weight:700;color:var(--text-primary);margin-bottom:14px">Quick Actions</div>
        <div style="display:flex;gap:10px;flex-wrap:wrap">
            <a href="{{ route('manager.content.news.create') }}" class="btn btn-primary">+ New Article</a>
            <a href="{{ route('manager.content.projects.create') }}" class="btn btn-secondary">+ New Project</a>
            <a href="{{ route('manager.content.news') }}" class="btn btn-secondary">View All News</a>
            <a href="{{ route('manager.content.projects') }}" class="btn btn-secondary">View All Projects</a>
        </div>
    </div>
</x-manager-sidebar>
