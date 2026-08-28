<x-manager-sidebar>
    <x-slot name="pageTitle">Edit Project</x-slot>
    <x-slot name="breadcrumb">Content → Projects → Edit</x-slot>

    <x-slot name="sidebarNav">
        <div class="sidebar-nav-label">Content</div>
        <a href="{{ route('manager.content.news') }}"     class="sidebar-nav-link"><span>📰</span> News Articles</a>
        <a href="{{ route('manager.content.projects') }}" class="sidebar-nav-link active"><span>🚀</span> Portfolio Projects</a>
    </x-slot>

    <div style="max-width:800px">
        <form method="POST" action="{{ route('manager.content.projects.update', $project) }}">
            @csrf @method('PUT')
            <div class="card">
                <div style="font-size:15px;font-weight:700;color:var(--text-primary);margin-bottom:20px">Edit Project</div>

                <div class="form-group">
                    <label class="form-label">Project Title *</label>
                    <input name="title" class="form-input" value="{{ old('title', $project->title) }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Description *</label>
                    <textarea name="description" class="form-textarea" required>{{ old('description', $project->description) }}</textarea>
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
                    <div class="form-group">
                        <label class="form-label">Domain *</label>
                        <input name="domain" class="form-input" value="{{ old('domain', $project->domain) }}" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Sub-Domain</label>
                        <input name="sub_domain" class="form-input" value="{{ old('sub_domain', $project->sub_domain) }}">
                    </div>
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
                    <div class="form-group">
                        <label class="form-label">Status *</label>
                        <input name="status" class="form-input" value="{{ old('status', $project->status) }}" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Status Badge Colour *</label>
                        <select name="status_color" class="form-select" required>
                            @foreach(['blue','green','amber','purple'] as $color)
                            <option value="{{ $color }}" {{ old('status_color',$project->status_color)===$color?'selected':'' }}>{{ ucfirst($color) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Tech Stack (comma-separated)</label>
                    <input name="tech_stack" class="form-input"
                           value="{{ old('tech_stack', is_array($project->tech_stack) ? implode(', ', $project->tech_stack) : $project->tech_stack) }}">
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr 80px;gap:16px">
                    <div class="form-group">
                        <label class="form-label">Metric Label</label>
                        <input name="metric_label" class="form-input" value="{{ old('metric_label', $project->metric_label) }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Metric Value</label>
                        <input name="metric_value" class="form-input" value="{{ old('metric_value', $project->metric_value) }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Sort</label>
                        <input name="sort_order" type="number" class="form-input" value="{{ old('sort_order', $project->sort_order) }}">
                    </div>
                </div>

                <div style="display:flex;align-items:center;gap:12px;margin-top:8px">
                    <label class="toggle">
                        <input type="hidden" name="is_published" value="0">
                        <input type="checkbox" name="is_published" value="1" {{ old('is_published', $project->is_published) ? 'checked' : '' }}>
                        <span class="toggle-slider"></span>
                    </label>
                    <span style="font-size:13px;color:var(--text-secondary)">Published on public projects page</span>
                </div>
            </div>

            <div style="display:flex;gap:10px;margin-top:16px">
                <button type="submit" class="btn btn-primary">Update Project</button>
                <a href="{{ route('manager.content.projects') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</x-manager-sidebar>
