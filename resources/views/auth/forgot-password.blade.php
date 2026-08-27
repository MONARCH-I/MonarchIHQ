<x-guest-layout>

    @if (session('status'))
        <div class="auth-status">{{ session('status') }}</div>
    @endif

    <div style="text-align:center;margin-bottom:16px;" class="auth-field-group">
        <p style="font-size:18px;font-weight:700;color:#fff;margin:0 0 3px;">Forgot password?</p>
        <p style="font-size:12px;color:rgba(255,255,255,0.4);margin:0;line-height:1.5;">Enter your email to receive a password reset link.</p>
    </div>

    <form method="POST" action="{{ route('password.email') }}" style="display:flex;flex-direction:column;gap:12px;">
        @csrf

        <div class="auth-field-group">
            <label class="auth-label" for="email">Email Address</label>
            <input id="email" class="auth-input" type="email" name="email"
                   value="{{ old('email') }}" required autofocus
                   placeholder="kwame@example.com">
            @error('email')
                <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="auth-field-group" style="margin-top:4px;">
            <button type="submit" class="auth-btn-primary">Send Reset Link</button>
        </div>
    </form>

    <p style="text-align:center;margin-top:14px;margin-bottom:0;font-size:11.5px;color:rgba(255,255,255,0.38);">
        Remembered it?
        <a href="{{ route('login') }}" class="auth-link auth-link-blue" style="margin-left:3px;">Sign in →</a>
    </p>

</x-guest-layout>
