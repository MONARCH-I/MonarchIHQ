<x-guest-layout>

    {{-- Validation errors --}}
    @if ($errors->any())
        <div class="auth-validation-errors">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div style="text-align:center;margin-bottom:16px;">
        <p style="font-size:18px;font-weight:700;color:#fff;margin:0 0 3px;">Create account</p>
        <p style="font-size:12px;color:rgba(255,255,255,0.4);margin:0;">Join Monarchi HQ today</p>
    </div>

    <form method="POST" action="{{ route('register') }}" style="display:flex;flex-direction:column;gap:11px;">
        @csrf

        {{-- Name --}}
        <div class="auth-field-group">
            <label class="auth-label" for="name">Full Name</label>
            <input id="name" class="auth-input" type="text" name="name"
                   value="{{ old('name') }}" required autofocus autocomplete="name"
                   placeholder="Kwame Mensah">
        </div>

        {{-- Email --}}
        <div class="auth-field-group">
            <label class="auth-label" for="email">Email Address</label>
            <input id="email" class="auth-input" type="email" name="email"
                   value="{{ old('email') }}" required autocomplete="username"
                   placeholder="kwame@example.com">
        </div>

        {{-- Passwords in 2-col row for compact height --}}
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;" class="auth-field-group">
            <div>
                <label class="auth-label" for="password">Password</label>
                <input id="password" class="auth-input" type="password" name="password"
                       required autocomplete="new-password"
                       placeholder="Min 8 chars">
            </div>
            <div>
                <label class="auth-label" for="password_confirmation">Confirm</label>
                <input id="password_confirmation" class="auth-input" type="password"
                       name="password_confirmation" required autocomplete="new-password"
                       placeholder="Repeat password">
            </div>
        </div>

        <div class="auth-field-group" style="margin-top:4px;">
            <button type="submit" class="auth-btn-primary">Create Account</button>
        </div>

    </form>

    <p style="text-align:center;margin-top:14px;margin-bottom:0;font-size:11.5px;color:rgba(255,255,255,0.38);">
        Already have an account?
        <a href="{{ route('login') }}" class="auth-link auth-link-blue" style="margin-left:3px;">Sign in →</a>
    </p>

</x-guest-layout>
