<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Management Portal Sign In — MonarchI</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --bg-dark: #070709;
            --bg-card: #101014;
            --border: rgba(255,255,255,0.08);
            --border-hover: rgba(41,151,255,0.3);
            --accent: #2997ff;
            --accent-glow: rgba(41,151,255,0.15);
            --text-primary: #f5f5f7;
            --text-secondary: rgba(245,245,247,0.65);
            --text-muted: rgba(245,245,247,0.4);
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-dark);
            color: var(--text-primary);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px 16px;
            position: relative;
            overflow-x: hidden;
        }

        /* Ambient Glow */
        .glow-top {
            position: absolute;
            top: -20%;
            left: 50%;
            transform: translateX(-50%);
            width: 700px;
            height: 400px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(41,151,255,0.18), transparent 70%);
            pointer-events: none;
            filter: blur(80px);
        }

        .auth-container {
            width: 100%;
            max-width: 440px;
            position: relative;
            z-index: 10;
        }

        .auth-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 40px 36px;
            box-shadow: 0 30px 80px rgba(0,0,0,0.6), 0 0 0 1px rgba(255,255,255,0.04);
            backdrop-filter: blur(20px);
        }

        .brand-header {
            text-align: center;
            margin-bottom: 28px;
        }

        .brand-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 12px;
            border-radius: 99px;
            background: var(--accent-glow);
            border: 1px solid rgba(41,151,255,0.3);
            color: var(--accent);
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-bottom: 14px;
        }

        .brand-title {
            font-size: 22px;
            font-weight: 800;
            color: var(--text-primary);
            letter-spacing: -0.02em;
            margin-bottom: 6px;
        }

        .brand-sub {
            font-size: 13px;
            color: var(--text-secondary);
            line-height: 1.5;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 12px;
            font-weight: 600;
            color: var(--text-secondary);
            margin-bottom: 8px;
        }

        .form-input-wrap {
            position: relative;
        }

        .form-input {
            width: 100%;
            background: rgba(0,0,0,0.4);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 12px 14px;
            font-size: 14px;
            color: var(--text-primary);
            outline: none;
            transition: all 0.2s;
        }

        .form-input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(41,151,255,0.2);
            background: rgba(0,0,0,0.6);
        }

        .toggle-pw {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            font-size: 12px;
            padding: 4px;
            transition: color 0.2s;
        }
        .toggle-pw:hover { color: var(--text-primary); }

        .btn-submit {
            width: 100%;
            background: var(--accent);
            color: #ffffff;
            border: none;
            border-radius: 12px;
            padding: 14px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 10px;
            box-shadow: 0 4px 18px rgba(41,151,255,0.3);
        }

        .btn-submit:hover {
            background: #1a7de3;
            transform: translateY(-1px);
            box-shadow: 0 6px 24px rgba(41,151,255,0.45);
        }

        .alert-error {
            background: rgba(239,68,68,0.12);
            border: 1px solid rgba(239,68,68,0.3);
            border-radius: 12px;
            padding: 12px 16px;
            color: #f87171;
            font-size: 13px;
            margin-bottom: 22px;
            line-height: 1.5;
        }

        .alert-status {
            background: rgba(34,197,94,0.12);
            border: 1px solid rgba(34,197,94,0.3);
            border-radius: 12px;
            padding: 12px 16px;
            color: #4ade80;
            font-size: 13px;
            margin-bottom: 22px;
        }

        .auth-footer {
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid var(--border);
            text-align: center;
            font-size: 12px;
            color: var(--text-muted);
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .auth-footer a {
            color: var(--text-secondary);
            text-decoration: none;
            transition: color 0.2s;
        }
        .auth-footer a:hover { color: var(--accent); }

        .security-badge {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            font-size: 11px;
            color: var(--text-muted);
        }
    </style>
</head>
<body>

<div class="glow-top"></div>

<div class="auth-container">
    <div class="auth-card">

        {{-- Header --}}
        <div class="brand-header">
            <a href="{{ url('/') }}" style="display:inline-block;margin-bottom:16px;text-decoration:none;">
                <img src="{{ asset('images/logo-white.png') }}" alt="MonarchI Logo" style="height:46px;width:auto;object-fit:contain;margin:0 auto;display:block;" />
            </a>
            <div class="brand-badge">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                Management &amp; Staff Access
            </div>
            <h1 class="brand-title">MonarchI Portal</h1>
            <p class="brand-sub">Authenticate with your enterprise credentials to access your manager dashboard.</p>
        </div>

        {{-- Status Flash --}}
        @if (session('status'))
            <div class="alert-status">
                ✓ {{ session('status') }}
            </div>
        @endif

        {{-- Errors --}}
        @if ($errors->any())
            <div class="alert-error">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        {{-- Form --}}
        <form method="POST" action="{{ route('manager.login.store') }}">
            @csrf

            <div class="form-group">
                <label class="form-label" for="email">Staff Email Address</label>
                <div class="form-input-wrap">
                    <input id="email"
                           type="email"
                           name="email"
                           class="form-input"
                           value="{{ old('email') }}"
                           required
                           autofocus
                           autocomplete="username"
                           placeholder="staff@monarchi.com.gh">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <div class="form-input-wrap">
                    <input id="password"
                           type="password"
                           name="password"
                           class="form-input"
                           required
                           autocomplete="current-password"
                           placeholder="••••••••••••">
                    <button type="button" class="toggle-pw" onclick="togglePasswordVisibility()">Show</button>
                </div>
            </div>

            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;font-size:12px;">
                <label style="display:flex;align-items:center;gap:8px;cursor:pointer;color:var(--text-secondary);">
                    <input type="checkbox" name="remember" style="accent-color:var(--accent);width:14px;height:14px;border-radius:4px;">
                    <span>Remember this session</span>
                </label>
                <span style="color:var(--text-muted);font-size:11px;">256-Bit Encrypted</span>
            </div>

            <button type="submit" class="btn-submit">
                <span>Sign In to Manager Portal</span>
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </button>
        </form>

        {{-- Footer --}}
        <div class="auth-footer">
            <div class="security-badge">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                Restricted System · Authorized Personnel Only
            </div>
            <div>
                Looking for customer account?
                <a href="{{ route('login') }}" style="color:var(--accent);font-weight:600;margin-left:4px;">Customer Sign In ↗</a>
            </div>
        </div>

    </div>
</div>

<script>
    function togglePasswordVisibility() {
        const input = document.getElementById('password');
        const btn = event.currentTarget;
        if (input.type === 'password') {
            input.type = 'text';
            btn.textContent = 'Hide';
        } else {
            input.type = 'password';
            btn.textContent = 'Show';
        }
    }
</script>

</body>
</html>
