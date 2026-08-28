<x-manager-sidebar>
    <x-slot name="pageTitle">New Article</x-slot>
    <x-slot name="breadcrumb">Content → News → Create</x-slot>

    <x-slot name="sidebarNav">
        <div class="sidebar-nav-label">Content</div>
        <a href="{{ route('manager.content.news') }}"     class="sidebar-nav-link active"><span>📰</span> News Articles</a>
        <a href="{{ route('manager.content.projects') }}" class="sidebar-nav-link"><span>🚀</span> Portfolio Projects</a>
    </x-slot>

    <div style="max-width:800px">
        <form method="POST" action="{{ route('manager.content.news.store') }}">
            @csrf
            <div class="card">
                <div style="font-size:15px;font-weight:700;color:var(--text-primary);margin-bottom:20px">Article Details</div>

                <div class="form-group">
                    <label class="form-label">Title *</label>
                    <input name="title" class="form-input" value="{{ old('title') }}" required placeholder="e.g. How African Fintechs are redefining payments">
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
                    <div class="form-group">
                        <label class="form-label">Category *</label>
                        <select name="category" class="form-select" required>
                            <option value="african_tech" {{ old('category')=='african_tech'?'selected':'' }}>African Tech</option>
                            <option value="global_tech"  {{ old('category')=='global_tech'?'selected':'' }}>Global Tech</option>
                            <option value="engineering"  {{ old('category','engineering')=='engineering'?'selected':'' }}>Engineering</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Read Time (minutes)</label>
                        <input name="read_time_minutes" type="number" class="form-input" value="{{ old('read_time_minutes', 5) }}" min="1" max="120">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Author Name</label>
                    <input name="author_name" class="form-input" value="{{ old('author_name', 'Monarchi Engineering Team') }}" placeholder="Author name">
                </div>

                <div class="form-group">
                    <label class="form-label">Excerpt (short summary, max 500 chars)</label>
                    <textarea name="excerpt" class="form-textarea" style="min-height:80px" placeholder="A brief summary of the article…">{{ old('excerpt') }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Body (full article content)</label>
                    <textarea name="body" class="form-textarea" style="min-height:260px" placeholder="Write the full article here…">{{ old('body') }}</textarea>
                </div>

                <div style="display:flex;align-items:center;gap:12px;margin-top:8px">
                    <label class="toggle">
                        <input type="hidden" name="is_published" value="0">
                        <input type="checkbox" name="is_published" value="1" {{ old('is_published') ? 'checked' : '' }}>
                        <span class="toggle-slider"></span>
                    </label>
                    <span style="font-size:13px;color:var(--text-secondary)">Publish immediately</span>
                </div>
            </div>

            <div style="display:flex;gap:10px;margin-top:16px">
                <button type="submit" class="btn btn-primary">Save Article</button>
                <a href="{{ route('manager.content.news') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</x-manager-sidebar>
