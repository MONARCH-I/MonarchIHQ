<x-filament-panels::page.simple>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

        html, body {
            height: 100% !important;
            overflow: hidden !important;
        }

        body, .fi-simple-layout, .fi-simple-main {
            font-family: 'Inter', sans-serif !important;
        }

        .fi-simple-main {
            background: #000000 !important;
            height: 100dvh !important;
            min-height: 100dvh !important;
            position: relative !important;
            overflow: hidden !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            padding: 12px !important;
        }

        /* Subtle grid background */
        .fi-simple-main::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,0.02) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.02) 1px, transparent 1px);
            background-size: 48px 48px;
            pointer-events: none;
            z-index: 0;
        }

        /* ── Pure CSS Floating Glow Orbs (Zero-JS, zero breakage) ── */
        .fi-simple-main::after {
            content: '';
            position: fixed;
            top: -80px;
            left: -80px;
            width: 420px;
            height: 420px;
            background: radial-gradient(circle, rgba(41,151,255,0.14) 0%, transparent 70%);
            border-radius: 50%;
            filter: blur(80px);
            pointer-events: none;
            z-index: 0;
            animation: orbFloatOne 10s ease-in-out infinite alternate;
        }

        @keyframes orbFloatOne {
            0%   { transform: translate(0, 0) scale(1); }
            100% { transform: translate(45px, 35px) scale(1.08); }
        }

        /* ── Ultra-compact Liquid Glass Card ── */
        .fi-simple-page {
            background: rgba(255,255,255,0.035) !important;
            backdrop-filter: blur(28px) saturate(180%) !important;
            -webkit-backdrop-filter: blur(28px) saturate(180%) !important;
            border: 1px solid rgba(255,255,255,0.09) !important;
            border-radius: 20px !important;
            box-shadow:
                0 0 0 1px rgba(255,255,255,0.03) inset,
                0 20px 40px rgba(0,0,0,0.7),
                0 2px 10px rgba(41,151,255,0.05) !important;
            max-width: 320px !important;
            width: 100% !important;
            padding: 0 !important;
            overflow: hidden !important;
            position: relative !important;
            z-index: 10 !important;
            animation: cardEntrance 0.45s cubic-bezier(0.16, 1, 0.3, 1) both;
        }

        @keyframes cardEntrance {
            from { opacity: 0; transform: translateY(14px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ── Brand header ── */
        .monarchi-admin-header {
            padding: 14px 18px 10px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.06);
            position: relative;
        }

        .monarchi-admin-wordmark {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.3em;
            color: #ffffff;
            text-transform: uppercase;
            margin-bottom: 3px;
        }

        .monarchi-admin-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 8.5px;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.4);
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.07);
            border-radius: 999px;
            padding: 2px 7px;
        }

        .monarchi-admin-badge::before {
            content: '';
            width: 4px;
            height: 4px;
            border-radius: 50%;
            background: #2997ff;
            animation: pulseDot 2s infinite;
        }

        @keyframes pulseDot {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.4; transform: scale(0.75); }
        }

        /* ── Form body ── */
        .monarchi-admin-body {
            padding: 12px 18px 14px;
        }

        .monarchi-admin-body .admin-sign-in-label {
            font-size: 14px;
            font-weight: 700;
            color: #ffffff;
            margin: 0 0 1px;
        }

        .monarchi-admin-body .admin-sign-in-sub {
            font-size: 10.5px;
            color: rgba(255,255,255,0.35);
            margin: 0 0 10px;
        }

        /* ── Compact Input overrides ── */
        .fi-fo-field-wrp {
            margin-bottom: 8px !important;
        }

        .fi-fo-field-wrp label,
        .fi-label-text {
            color: rgba(255,255,255,0.45) !important;
            font-size: 10px !important;
            font-weight: 600 !important;
            letter-spacing: 0.05em !important;
            text-transform: uppercase !important;
            margin-bottom: 2px !important;
        }

        .fi-input-wrapper, .fi-input {
            background: rgba(255,255,255,0.04) !important;
            border: 1px solid rgba(255,255,255,0.09) !important;
            border-radius: 9px !important;
            color: #ffffff !important;
            transition: all 0.2s ease !important;
            font-family: 'Inter', sans-serif !important;
            font-size: 13px !important;
        }

        .fi-input {
            padding: 6px 10px !important;
            height: 34px !important;
        }

        .fi-input::placeholder { color: rgba(255,255,255,0.22) !important; font-size: 12px !important; }

        .fi-input-wrapper:focus-within {
            background: rgba(41,151,255,0.05) !important;
            border-color: rgba(41,151,255,0.45) !important;
            box-shadow: 0 0 0 2.5px rgba(41,151,255,0.12) !important;
        }

        /* ── Compact Sign-in button ── */
        .fi-btn[wire\:click="authenticate"],
        .fi-btn-primary {
            background: #ffffff !important;
            border: none !important;
            border-radius: 11px !important;
            color: #000000 !important;
            font-weight: 700 !important;
            font-size: 13px !important;
            font-family: 'Inter', sans-serif !important;
            letter-spacing: 0.01em !important;
            padding: 9px 16px !important;
            height: 36px !important;
            width: 100% !important;
            box-shadow: 0 3px 12px rgba(0,0,0,0.35) !important;
            transition: transform 0.16s cubic-bezier(0.34,1.56,0.64,1), background 0.18s, box-shadow 0.2s !important;
            margin-top: 4px !important;
        }
        .fi-btn-primary:hover {
            background: #e8e8e8 !important;
            transform: translateY(-1px) !important;
            box-shadow: 0 6px 18px rgba(0,0,0,0.45) !important;
        }
        .fi-btn-primary:active { transform: scale(0.97) !important; }

        /* ── Links & checkbox ── */
        .fi-link {
            color: rgba(255,255,255,0.4) !important;
            font-size: 11px !important;
            transition: color 0.15s !important;
        }
        .fi-link:hover { color: #ffffff !important; }

        .fi-checkbox input[type="checkbox"] {
            accent-color: #2997ff !important;
        }

        .fi-fo-field-wrp-error-message,
        .fi-fo-field-wrp [role="alert"] {
            color: #ff8080 !important;
            font-size: 10px !important;
        }

        /* ── Compact Footer ── */
        .monarchi-admin-footer {
            padding: 8px 16px;
            text-align: center;
            font-size: 9px;
            color: rgba(255,255,255,0.18);
            border-top: 1px solid rgba(255,255,255,0.05);
            letter-spacing: 0.04em;
        }

        /* ── Hide Filament's auto-injected logo & heading ── */
        .fi-simple-header,
        .fi-logo,
        .fi-simple-page > h1,
        .fi-simple-page > [class*="heading"],
        .fi-brand-name {
            display: none !important;
        }
    </style>

    {{-- Brand header --}}
    <div class="monarchi-admin-header">
        <div class="monarchi-admin-wordmark">M O N A R C H I</div>
        <div class="monarchi-admin-badge">Administrator Portal</div>
    </div>

    {{-- Form body --}}
    <div class="monarchi-admin-body">
        <p class="admin-sign-in-label">Sign in</p>
        <p class="admin-sign-in-sub">Access restricted to authorised personnel.</p>

        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::AUTH_LOGIN_FORM_BEFORE, scopes: $this->getRenderHookScopes()) }}

        <x-filament-panels::form id="form" wire:submit="authenticate">
            {{ $this->form }}

            <x-filament-panels::form.actions
                :actions="$this->getCachedFormActions()"
                :full-width="$this->hasFullWidthFormActions()"
            />
        </x-filament-panels::form>

        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::AUTH_LOGIN_FORM_AFTER, scopes: $this->getRenderHookScopes()) }}
    </div>

    {{-- Footer --}}
    <div class="monarchi-admin-footer">
        © {{ date('Y') }} Monarchi HQ &middot; Secure Admin Access
    </div>
</x-filament-panels::page.simple>
