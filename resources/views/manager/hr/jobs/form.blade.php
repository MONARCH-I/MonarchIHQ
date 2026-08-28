<x-manager-sidebar>
    <x-slot name="pageTitle">{{ isset($job) ? 'Edit Job Listing' : 'New Job Listing' }}</x-slot>
    <x-slot name="breadcrumb">HR → Jobs → {{ isset($job) ? 'Edit' : 'Create' }}</x-slot>

    <x-slot name="sidebarNav">
        <div class="sidebar-nav-label">HR</div>
        <a href="{{ route('manager.hr.jobs') }}"     class="sidebar-nav-link active"><span>💼</span> Job Listings</a>
        <a href="{{ route('manager.hr.messages') }}" class="sidebar-nav-link"><span>✉️</span> Messages</a>
    </x-slot>

    <div style="max-width:700px">
        @isset($job)
        <form method="POST" action="{{ route('manager.hr.jobs.update', $job) }}">
            @method('PUT')
        @else
        <form method="POST" action="{{ route('manager.hr.jobs.store') }}">
        @endisset
            @csrf
            <div class="card">
                <div class="form-group">
                    <label class="form-label">Job Title *</label>
                    <input name="title" class="form-input" value="{{ old('title', $job->title ?? '') }}" required placeholder="e.g. Senior Fullstack Engineer">
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
                    <div class="form-group">
                        <label class="form-label">Department *</label>
                        <input name="department" class="form-input" value="{{ old('department', $job->department ?? '') }}" required placeholder="e.g. Engineering">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Employment Type *</label>
                        <select name="employment_type" class="form-select" required>
                            @foreach(['full_time'=>'Full-Time','part_time'=>'Part-Time','contract'=>'Contract','internship'=>'Internship'] as $val=>$label)
                            <option value="{{ $val }}" {{ old('employment_type', $job->employment_type ?? 'full_time') === $val ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
                    <div class="form-group">
                        <label class="form-label">Location *</label>
                        <input name="location" class="form-input" value="{{ old('location', $job->location ?? '') }}" required placeholder="e.g. Accra / Hybrid">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Apply Email *</label>
                        <input name="apply_email" type="email" class="form-input" value="{{ old('apply_email', $job->apply_email ?? 'careers@monarchi.com.gh') }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Skills Required</label>
                    <input name="skills_required" class="form-input" value="{{ old('skills_required', $job->skills_required ?? '') }}" placeholder="PHP 8.3+, Laravel 12, PostgreSQL…">
                </div>

                <div class="form-group">
                    <label class="form-label">Full Description</label>
                    <textarea name="description" class="form-textarea">{{ old('description', $job->description ?? '') }}</textarea>
                </div>

                <div style="display:flex;align-items:center;gap:16px">
                    <div style="display:flex;align-items:center;gap:10px">
                        <label class="toggle">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $job->is_active ?? true) ? 'checked' : '' }}>
                            <span class="toggle-slider"></span>
                        </label>
                        <span style="font-size:13px;color:var(--text-secondary)">Active (visible on Careers page)</span>
                    </div>
                    <div class="form-group" style="margin:0;flex-shrink:0">
                        <input name="sort_order" type="number" class="form-input" style="width:80px" value="{{ old('sort_order', $job->sort_order ?? 0) }}" placeholder="Sort">
                    </div>
                </div>
            </div>

            <div style="display:flex;gap:10px;margin-top:16px">
                <button type="submit" class="btn btn-primary">{{ isset($job) ? 'Update' : 'Create' }} Job Listing</button>
                <a href="{{ route('manager.hr.jobs') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</x-manager-sidebar>
