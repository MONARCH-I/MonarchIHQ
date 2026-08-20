<x-filament-panels::page.simple>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

        /* ── Full-page dark background ── */
        body, .fi-simple-layout {
            background: transparent !important;
        }

        .fi-simple-main {
            background: linear-gradient(135deg, #0f0c1a 0%, #1a0810 40%, #0d1117 100%) !important;
            min-height: 100vh !important;
            position: relative !important;
            overflow: hidden !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            padding: 1.5rem !important;
            font-family: 'Inter', sans-serif !important;
        }

        /* Animated background orbs */
        .fi-simple-main::before {
            content: '';
            position: fixed;
            top: -20%;
            left: -10%;
            width: 55vw;
            height: 55vw;
            background: radial-gradient(circle, rgba(163,29,34,0.18) 0%, transparent 70%);
            border-radius: 50%;
            animation: floatOrb 8s ease-in-out infinite alternate;
            pointer-events: none;
        }

        .fi-simple-main::after {
            content: '';
            position: fixed;
            bottom: -15%;
            right: -10%;
            width: 45vw;
            height: 45vw;
            background: radial-gradient(circle, rgba(163,29,34,0.12) 0%, transparent 70%);
            border-radius: 50%;
            animation: floatOrb 10s ease-in-out infinite alternate-reverse;
            pointer-events: none;
        }

        @keyframes floatOrb {
            0%   { transform: translate(0, 0) scale(1); }
            100% { transform: translate(3%, 4%) scale(1.08); }
        }

        /* ── Glassmorphic card ── */
        .fi-simple-page {
            background: rgba(255, 255, 255, 0.05) !important;
            backdrop-filter: blur(24px) saturate(160%) !important;
            -webkit-backdrop-filter: blur(24px) saturate(160%) !important;
            border: 1px solid rgba(255,255,255,0.1) !important;
            border-radius: 1.75rem !important;
            box-shadow:
                0 32px 64px rgba(0,0,0,0.5),
                inset 0 1px 0 rgba(255,255,255,0.12) !important;
            max-width: 28rem !important;
            width: 100% !important;
            padding: 0 !important;
            overflow: hidden !important;
            animation: slideUp 0.5s cubic-bezier(0.16, 1, 0.3, 1) both;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(28px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ── Brand header strip ── */
        .monarchi-glass-header {
            background: linear-gradient(135deg, #eee8e9ff 0%, #0e0c0cff 100%);
            padding: 2.25rem 2rem 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .monarchi-glass-header::before {
            content: '';
            position: absolute;
            top: -40%;
            left: -20%;
            width: 140%;
            height: 180%;
            background: radial-gradient(ellipse at 30% 40%, rgba(255,255,255,0.12) 0%, transparent 60%);
            pointer-events: none;
        }

        .monarchi-logo-text {
            font-size: 2.25rem;
            font-weight: 800;
            letter-spacing: 0.08em;
            color: #ffffff;
            position: relative;
        }

        .monarchi-logo-text span {
            color: rgba(255,255,255,0.55);
        }

        .monarchi-tagline {
            font-size: 0.7rem;
            font-weight: 500;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.55);
            margin-top: 0.35rem;
            position: relative;
        }

        /* ── Form body ── */
        .monarchi-glass-body {
            padding: 2rem 2rem 2.25rem;
        }

        .monarchi-glass-body h2 {
            font-size: 1.15rem;
            font-weight: 700;
            color: #f1f5f9;
            margin-bottom: 0.3rem;
        }

        .monarchi-glass-body p {
            font-size: 0.8rem;
            color: rgba(255,255,255,0.38);
            margin-bottom: 1.75rem;
        }

        /* ── Input overrides ── */
        .fi-fo-field-wrp label,
        .fi-label-text {
            color: rgba(255,255,255,0.65) !important;
            font-size: 0.78rem !important;
            font-weight: 500 !important;
            letter-spacing: 0.03em !important;
        }

        .fi-input-wrapper, .fi-input {
            background: rgba(255,255,255,0.07) !important;
            border: 1px solid rgba(255,255,255,0.12) !important;
            border-radius: 0.65rem !important;
            color: #f1f5f9 !important;
            transition: all 0.2s ease !important;
        }

        .fi-input::placeholder { color: rgba(255,255,255,0.25) !important; }

        .fi-input-wrapper:focus-within {
            background: rgba(255,255,255,0.11) !important;
            border-color: rgba(163,29,34,0.7) !important;
            box-shadow: 0 0 0 3px rgba(163,29,34,0.22) !important;
        }

        /* ── Sign-in button ── */
        .fi-btn-primary, .fi-btn[wire\:click="authenticate"] {
            background: linear-gradient(135deg, #0425feff 0%, #1508f0ff 100%) !important;
            border: none !important;
            border-radius: 0.65rem !important;
            color: #fff !important;
            font-weight: 600 !important;
            font-size: 0.9rem !important;
            letter-spacing: 0.025em !important;
            padding: 0.75rem 1.5rem !important;
            width: 100% !important;
            box-shadow: 0 4px 20px rgb(48, 67, 246,0.38) !important;
            transition: transform 0.18s ease, box-shadow 0.18s ease !important;
            margin-top: 0.5rem !important;
        }
        .fi-btn-primary:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 8px 28px rgba(58, 87, 237, 0.5) !important;
        }

        /* ── Forgot password link ── */
        .fi-link {
            color: rgba(163,29,34,0.85) !important;
            font-size: 0.75rem !important;
        }
        .fi-link:hover { color: #a31d22 !important; }

        /* ── Checkbox ── */
        .fi-checkbox input[type="checkbox"] {
            accent-color: #a31d22 !important;
        }

        /* ── Error messages ── */
        .fi-fo-field-wrp-error-message,
        .fi-fo-field-wrp [role="alert"] {
            color: #fca5a5 !important;
            font-size: 0.73rem !important;
        }

        /* ── Footer text ── */
        .monarchi-footer-note {
            padding: 1rem 2rem;
            text-align: center;
            font-size: 0.68rem;
            color: rgba(255,255,255,0.2);
            border-top: 1px solid rgba(255,255,255,0.07);
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
    <div class="monarchi-glass-header">
        <div class="monarchi-logo-text">MONARCHI<span>HQ</span></div>
        <div class="monarchi-tagline">Administrator Portal &middot; We are Innovation</div>
    </div>

    {{-- Form body --}}
    <div class="monarchi-glass-body">
        <h2>Sign In</h2>
        <p>Enter your credentials to access the admin panel.</p>

        <x-filament-panels::form wire:submit="authenticate">
            {{ $this->form }}
            <x-filament-panels::form.actions
                :actions="$this->getCachedFormActions()"
                :full-width="true"
            />
        </x-filament-panels::form>
    </div>

    {{-- Footer --}}
    <div class="monarchi-footer-note">
        &copy; {{ date('Y') }} Monarchi HQ &middot; Secure Admin Access
    </div>
</x-filament-panels::page.simple>
