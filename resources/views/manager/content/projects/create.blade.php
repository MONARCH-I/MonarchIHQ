<x-manager-sidebar>
    <x-slot name="pageTitle">New Project</x-slot>
    <x-slot name="breadcrumb">Content → Projects → Create</x-slot>

    <x-slot name="sidebarNav">
        <div class="sidebar-nav-label">Content</div>
        <a href="{{ route('manager.content.news') }}"     class="sidebar-nav-link"><span>📰</span> News Articles</a>
        <a href="{{ route('manager.content.projects') }}" class="sidebar-nav-link active"><span>🚀</span> Portfolio Projects</a>
    </x-slot>

    <div style="max-width:800px">
        <form method="POST" action="{{ route('manager.content.projects.store') }}">
            @csrf
            <div class="card">
                <div style="font-size:15px;font-weight:700;color:var(--text-primary);margin-bottom:20px">Project Details</div>

                <div class="form-group">
                    <label class="form-label">Project Title *</label>
                    <input name="title" class="form-input" value="{{ old('title') }}" required placeholder="e.g. MAI Health Intelligence Engine">
                </div>

                <div class="form-group">
                    <label class="form-label">Description *</label>
                    <textarea name="description" class="form-textarea" required placeholder="Brief description of the project…">{{ old('description') }}</textarea>
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
                    <div class="form-group">
                        <label class="form-label">Domain *</label>
                        <input name="domain" class="form-input" value="{{ old('domain') }}" required placeholder="e.g. Enterprise AI">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Sub-Domain</label>
                        <input name="sub_domain" class="form-input" value="{{ old('sub_domain') }}" placeholder="e.g. Healthcare">
                    </div>
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
                    <div class="form-group">
                        <label class="form-label">Status *</label>
                        <input name="status" class="form-input" value="{{ old('status') }}" required placeholder="e.g. Deployed / Active IoT">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Status Badge Colour *</label>
                        <select name="status_color" class="form-select" required>
                            <option value="blue"   {{ old('status_color','blue')=='blue'  ?'selected':'' }}>Blue</option>
                            <option value="green"  {{ old('status_color')=='green' ?'selected':'' }}>Green</option>
                            <option value="amber"  {{ old('status_color')=='amber' ?'selected':'' }}>Amber</option>
                            <option value="purple" {{ old('status_color')=='purple'?'selected':'' }}>Purple</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Tech Stack (comma-separated)</label>
                    <input name="tech_stack" class="form-input" value="{{ old('tech_stack') }}" placeholder="Laravel 12, WebSockets, HL7/FHIR">
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr 80px;gap:16px">
                    <div class="form-group">
                        <label class="form-label">Metric Label</label>
                        <input name="metric_label" class="form-input" value="{{ old('metric_label') }}" placeholder="e.g. Scale">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Metric Value</label>
                        <input name="metric_value" class="form-input" value="{{ old('metric_value') }}" placeholder="e.g. 10M+ daily events">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Sort Order</label>
                        <input name="sort_order" type="number" class="form-input" value="{{ old('sort_order', 0) }}">
                    </div>
                </div>

                <div style="display:flex;align-items:center;gap:12px;margin-top:8px">
                    <label class="toggle">
                        <input type="hidden" name="is_published" value="0">
                        <input type="checkbox" name="is_published" value="1" {{ old('is_published') ? 'checked' : '' }}>
                        <span class="toggle-slider"></span>
                    </label>
                    <span style="font-size:13px;color:var(--text-secondary)">Publish to public projects page</span>
                </div>
            </div>

            <div style="display:flex;gap:10px;margin-top:16px">
                <button type="submit" class="btn btn-primary">Save Project</button>
                <a href="{{ route('manager.content.projects') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</x-manager-sidebar>
