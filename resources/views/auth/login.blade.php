<x-guest-layout>

    {{-- Validation / SSO Errors --}}
    @if ($errors->any())
        <div class="auth-validation-errors" style="background:rgba(239,68,68,0.12);border:1px solid rgba(239,68,68,0.3);color:#fca5a5;padding:10px 14px;border-radius:10px;font-size:12px;margin-bottom:14px;">
            <ul style="margin:0;padding-left:16px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Session Status --}}
    @if (session('status'))
        <div class="auth-status">{{ session('status') }}</div>
    @endif

    <div style="text-align:center;margin-bottom:16px;">
        <p style="font-size:18px;font-weight:700;color:#fff;margin:0 0 3px;">Welcome back</p>
        <p style="font-size:12px;color:rgba(255,255,255,0.4);margin:0;">Sign in to your account</p>
    </div>

    {{-- Email & Password Login Form --}}
    <form method="POST" action="{{ route('login') }}" style="display:flex;flex-direction:column;gap:11px;">
        @csrf

        {{-- Email --}}
        <div class="auth-field-group">
            <label class="auth-label" for="email">Email Address</label>
            <input id="email" class="auth-input" type="email" name="email"
                   value="{{ old('email') }}" required autofocus autocomplete="username"
                   placeholder="kwame@example.com">
        </div>

        {{-- Password --}}
        <div class="auth-field-group">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:3px;">
                <label class="auth-label" for="password" style="margin-bottom:0;">Password</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="auth-link" style="font-size:10px;color:rgba(255,255,255,0.4);">Forgot?</a>
                @endif
            </div>
            <input id="password" class="auth-input" type="password" name="password"
                   required autocomplete="current-password"
                   placeholder="••••••••••••">
        </div>

        {{-- Remember Me --}}
        <div style="display:flex;align-items:center;justify-content:space-between;font-size:11px;color:rgba(255,255,255,0.4);margin-top:2px;" class="auth-field-group">
            <label style="display:flex;align-items:center;gap:6px;cursor:pointer;">
                <input type="checkbox" name="remember" style="accent-color:#2997ff;width:13px;height:13px;border-radius:3px;">
                <span>Remember me</span>
            </label>
        </div>

        <div class="auth-field-group" style="margin-top:4px;">
            <button type="submit" class="auth-btn-primary">Sign In</button>
        </div>
    </form>

    {{-- Divider --}}
    <div style="display:flex;align-items:center;gap:10px;margin:14px 0 12px;" class="auth-field-group">
        <div style="flex:1;height:1px;background:rgba(255,255,255,0.08);"></div>
        <span style="font-size:10px;color:rgba(255,255,255,0.3);text-transform:uppercase;letter-spacing:0.05em;">or continue with</span>
        <div style="flex:1;height:1px;background:rgba(255,255,255,0.08);"></div>
    </div>

    {{-- SSO OAuth buttons in grid --}}
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px;width:100%;" class="auth-field-group">
        <a href="{{ route('social.redirect', 'google') }}" class="auth-oauth-btn" style="height:36px;font-size:11.5px;padding:0 8px;">
            <svg width="14" height="14" style="width:14px;height:14px;min-width:14px;min-height:14px;max-width:14px;max-height:14px;flex-shrink:0;" viewBox="0 0 24 24">
                <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
            </svg>
            <span>Google</span>
        </a>

        <a href="{{ route('social.redirect', 'microsoft') }}" class="auth-oauth-btn" style="height:36px;font-size:11.5px;padding:0 8px;">
            <svg width="14" height="14" style="width:14px;height:14px;min-width:14px;min-height:14px;max-width:14px;max-height:14px;flex-shrink:0;" viewBox="0 0 21 21">
                <path fill="#f25022" d="M1 1h9v9H1z"/>
                <path fill="#00a4ef" d="M1 11h9v9H1z"/>
                <path fill="#7fba00" d="M11 1h9v9h-9z"/>
                <path fill="#ffb900" d="M11 11h9v9h-9z"/>
            </svg>
            <span>Microsoft</span>
        </a>
    </div>

    <p style="text-align:center;margin-top:14px;margin-bottom:0;font-size:11.5px;color:rgba(255,255,255,0.38);">
        Don't have an account?
        <a href="{{ route('register') }}" class="auth-link auth-link-blue" style="margin-left:3px;">Create one →</a>
    </p>

</x-guest-layout>