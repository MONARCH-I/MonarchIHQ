<x-guest-layout>

    <div style="text-align:center;margin-bottom:14px;" class="auth-field-group">
        <div style="width:40px;height:40px;background:rgba(41,151,255,0.1);border:1px solid rgba(41,151,255,0.2);border-radius:11px;display:flex;align-items:center;justify-content:center;margin:0 auto 10px;">
            <svg xmlns="http://www.w3.org/2000/svg" style="width:18px;height:18px;color:#2997ff;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
            </svg>
        </div>
        <p style="font-size:16px;font-weight:700;color:#fff;margin:0 0 2px;">Confirm password</p>
        <p style="font-size:11px;color:rgba(255,255,255,0.4);margin:0;">Please confirm your password to proceed.</p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" style="display:flex;flex-direction:column;gap:10px;">
        @csrf

        <div class="auth-field-group">
            <label class="auth-label" for="password">Password</label>
            <input id="password" class="auth-input" type="password" name="password"
                   required autocomplete="current-password" placeholder="Your password">
            @error('password')<p class="auth-error">{{ $message }}</p>@enderror
        </div>

        <div class="auth-field-group" style="margin-top:2px;">
            <button type="submit" class="auth-btn-primary">Confirm &amp; Continue</button>
        </div>
    </form>

</x-guest-layout>
