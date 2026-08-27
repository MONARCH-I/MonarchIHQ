<x-guest-layout>

    @if (session('status') === 'verification-link-sent')
        <div class="auth-status">A new verification link has been sent to your email.</div>
    @endif

    <div style="text-align:center;margin-bottom:14px;" class="auth-field-group">
        <div style="width:40px;height:40px;background:rgba(41,151,255,0.1);border:1px solid rgba(41,151,255,0.2);border-radius:11px;display:flex;align-items:center;justify-content:center;margin:0 auto 10px;">
            <svg xmlns="http://www.w3.org/2000/svg" style="width:18px;height:18px;color:#2997ff;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
        </div>
        <p style="font-size:16px;font-weight:700;color:#fff;margin:0 0 2px;">Verify your email</p>
        <p style="font-size:11px;color:rgba(255,255,255,0.4);margin:0;line-height:1.4;">Check your inbox for the verification link.</p>
    </div>

    <form method="POST" action="{{ route('verification.send') }}" style="margin-bottom:8px;" class="auth-field-group">
        @csrf
        <button type="submit" class="auth-btn-primary">Resend Link</button>
    </form>

    <form method="POST" action="{{ route('logout') }}" class="auth-field-group">
        @csrf
        <button type="submit" style="width:100%;padding:8px;background:transparent;border:1px solid rgba(255,255,255,0.08);border-radius:11px;color:rgba(255,255,255,0.35);font-size:11px;font-family:'Inter',sans-serif;cursor:pointer;transition:all 0.15s;">
            Sign Out
        </button>
    </form>

</x-guest-layout>
