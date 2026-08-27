<x-guest-layout>

    <div style="text-align:center;margin-bottom:14px;" class="auth-field-group">
        <p style="font-size:16px;font-weight:700;color:#fff;margin:0 0 2px;">Reset password</p>
        <p style="font-size:11px;color:rgba(255,255,255,0.4);margin:0;">Choose a strong new password.</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" style="display:flex;flex-direction:column;gap:9px;">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="auth-field-group">
            <label class="auth-label" for="email">Email Address</label>
            <input id="email" class="auth-input" type="email" name="email"
                   value="{{ old('email', $request->email) }}" required autofocus autocomplete="username"
                   placeholder="kwame@example.com">
            @error('email')<p class="auth-error">{{ $message }}</p>@enderror
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px;" class="auth-field-group">
            <div>
                <label class="auth-label" for="password">New Password</label>
                <input id="password" class="auth-input" type="password" name="password"
                       required autocomplete="new-password" placeholder="Min 8 chars">
                @error('password')<p class="auth-error">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="auth-label" for="password_confirmation">Confirm</label>
                <input id="password_confirmation" class="auth-input" type="password"
                       name="password_confirmation" required autocomplete="new-password"
                       placeholder="Repeat">
                @error('password_confirmation')<p class="auth-error">{{ $message }}</p>@enderror
            </div>
        </div>

        <div class="auth-field-group" style="margin-top:2px;">
            <button type="submit" class="auth-btn-primary">Reset Password</button>
        </div>
    </form>

</x-guest-layout>
