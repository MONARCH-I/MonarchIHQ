<x-guest-layout>

    {{-- Session Status --}}
    @if (session('status'))
        <div class="auth-status">{{ session('status') }}</div>
    @endif

    <div style="text-align:center;margin-bottom:16px;">
        <p style="font-size:18px;font-weight:700;color:#fff;margin:0 0 3px;">Welcome back</p>
        <p style="font-size:12px;color:rgba(255,255,255,0.4);margin:0;">Sign in to your account</p>
    </div>

    {{-- SSO OAuth buttons --}}
    <div style="display:flex;flex-direction:column;gap:10px;align-items:center;width:100%;" class="auth-field-group">

        <a href="{{ route('social.redirect', 'google') }}" class="auth-oauth-btn" style="width:100%;max-width:250px;height:38px;">
            <svg width="15" height="15" style="width:15px;height:15px;min-width:15px;min-height:15px;max-width:15px;max-height:15px;flex-shrink:0;" viewBox="0 0 24 24">
                <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
            </svg>
            <span>Continue with Google</span>
        </a>

        <a href="{{ route('social.redirect', 'microsoft') }}" class="auth-oauth-btn" style="width:100%;max-width:250px;height:38px;">
            <svg width="15" height="15" style="width:15px;height:15px;min-width:15px;min-height:15px;max-width:15px;max-height:15px;flex-shrink:0;" viewBox="0 0 21 21">
                <path fill="#f25022" d="M1 1h9v9H1z"/>
                <path fill="#00a4ef" d="M1 11h9v9H1z"/>
                <path fill="#7fba00" d="M11 1h9v9h-9z"/>
                <path fill="#ffb900" d="M11 11h9v9h-9z"/>
            </svg>
            <span>Continue with Microsoft</span>
        </a>

    </div>

    <p style="text-align:center;margin-top:14px;margin-bottom:0;font-size:10.5px;color:rgba(255,255,255,0.24);line-height:1.5;">
        By continuing you agree to our
        <a href="#" class="auth-link" style="color:rgba(255,255,255,0.4);text-decoration:underline;">Terms</a>
        &amp;
        <a href="#" class="auth-link" style="color:rgba(255,255,255,0.4);text-decoration:underline;">Privacy</a>.
    </p>

</x-guest-layout>