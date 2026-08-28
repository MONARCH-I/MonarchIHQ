<x-manager-sidebar>
    <x-slot name="pageTitle">{{ isset($user) ? 'Edit Employee' : 'Add Employee' }}</x-slot>
    <x-slot name="breadcrumb">Employees → {{ isset($user) ? 'Edit' : 'Create' }}</x-slot>

    <x-slot name="sidebarNav">
        <div class="sidebar-nav-label">Administration</div>
        <a href="{{ route('manager.employees.index') }}" class="sidebar-nav-link {{ !isset($user) ? '' : 'active' }}"><span>🔐</span> All Employees</a>
        <a href="{{ route('manager.employees.create') }}" class="sidebar-nav-link {{ !isset($user) ? 'active' : '' }}"><span>➕</span> Add Employee</a>
    </x-slot>

    <div style="max-width:560px">
        @isset($user)
        <form method="POST" action="{{ route('manager.employees.update', $user) }}">
            @method('PUT')
        @else
        <form method="POST" action="{{ route('manager.employees.store') }}">
        @endisset
            @csrf
            <div class="card">
                <div class="form-group">
                    <label class="form-label">Full Name *</label>
                    <input name="name" class="form-input" value="{{ old('name', $user->name ?? '') }}" required placeholder="Employee full name">
                </div>

                @if(!isset($user))
                <div class="form-group">
                    <label class="form-label">Email Address *</label>
                    <input name="email" type="email" class="form-input" value="{{ old('email') }}" required placeholder="employee@monarchi.com.gh">
                </div>
                @else
                <div class="form-group">
                    <label class="form-label">Email Address</label>
                    <input class="form-input" value="{{ $user->email }}" disabled style="opacity:0.5">
                </div>
                @endif

                <div class="form-group">
                    <label class="form-label">Role *</label>
                    <select name="role" class="form-select" required>
                        @foreach($roles as $val => $label)
                        <option value="{{ $val }}" {{ old('role', $user->role ?? '') === $val ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">{{ isset($user) ? 'New Password (leave blank to keep current)' : 'Password *' }}</label>
                    <input name="password" type="password" class="form-input" {{ isset($user) ? '' : 'required' }} placeholder="Minimum 8 characters">
                </div>
                <div class="form-group">
                    <label class="form-label">Confirm Password</label>
                    <input name="password_confirmation" type="password" class="form-input" placeholder="Repeat password">
                </div>

                @if(!isset($user))
                <div style="padding:12px 14px;background:rgba(41,151,255,0.05);border:1px solid rgba(41,151,255,0.15);border-radius:10px;font-size:12px;color:var(--text-secondary)">
                    ℹ️ The employee account will be created as verified. Ask the employee to change their password on first login via Profile settings.
                </div>
                @endif
            </div>

            <div style="display:flex;gap:10px;margin-top:16px">
                <button type="submit" class="btn btn-primary">{{ isset($user) ? 'Update Employee' : 'Create Employee' }}</button>
                <a href="{{ route('manager.employees.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</x-manager-sidebar>
