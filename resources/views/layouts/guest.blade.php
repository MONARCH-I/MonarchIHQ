<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'MonarchiHQ') }} — Account</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- GSAP -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js" defer></script>

    <style>
        *, *::before, *::after { box-sizing: border-box; }

        html, body {
            height: 100vh !important;
            max-height: 100vh !important;
            overflow: hidden !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #000000;
            color: #ffffff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        /* ── Animated background orbs ── */
        .auth-orb {
            position: fixed;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0;
            pointer-events: none;
            z-index: 0;
        }
        .auth-orb-1 { width: 380px; height: 380px; background: radial-gradient(circle, rgba(41,151,255,0.14) 0%, transparent 70%); top: -80px; left: -80px; }
        .auth-orb-2 { width: 300px; height: 300px; background: radial-gradient(circle, rgba(120,80,255,0.09) 0%, transparent 70%); bottom: -60px; right: -60px; }
        .auth-orb-3 { width: 220px; height: 220px; background: radial-gradient(circle, rgba(41,151,255,0.05) 0%, transparent 70%); bottom: 25%; left: 8%; }

        /* Subtle grid pattern */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,0.02) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.02) 1px, transparent 1px);
            background-size: 40px 40px;
            pointer-events: none;
            z-index: 0;
        }

        /* ── Liquid Glass Card ── */
        .auth-card {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 385px;
            margin: 0 auto;
            background: rgba(255,255,255,0.035);
            border: 1px solid rgba(255,255,255,0.09);
            border-radius: 30px;
            backdrop-filter: blur(28px) saturate(180%);
            -webkit-backdrop-filter: blur(28px) saturate(180%);
            box-shadow:
                0 0 0 1px rgba(255,255,255,0.03) inset,
                0 30px 52px rgba(0,0,0,0.6),
                0 2px 14px rgba(41,151,255,0.06);
            padding: 30px 28px 28px;
            opacity: 0;
            transform: translateY(16px);
        }

        /* ── Logo / brand ── */
        .auth-brand {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 16px;
            gap: 5px;
        }
        .auth-brand-wordmark {
            font-size: 11.5px;
            font-weight: 700;
            letter-spacing: 0.32em;
            color: #ffffff;
            text-transform: uppercase;
        }
        .auth-brand-divider {
            width: 26px;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.25), transparent);
        }

        /* ── Form inputs ── */
        .auth-input {
            width: 100%;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.09);
            border-radius: 10px;
            padding: 7px 12px;
            font-size: 13px;
            color: #ffffff;
            outline: none;
            transition: border-color 0.2s, background 0.2s, box-shadow 0.2s;
            font-family: 'Inter', sans-serif;
            height: 38px;
        }
        .auth-input::placeholder { color: rgba(255,255,255,0.25); font-size: 12px; }
        .auth-input:focus {
            border-color: rgba(41,151,255,0.45);
            background: rgba(41,151,255,0.05);
            box-shadow: 0 0 0 2.5px rgba(41,151,255,0.12);
        }
        .auth-input:-webkit-autofill,
        .auth-input:-webkit-autofill:focus {
            -webkit-box-shadow: 0 0 0 40px #111111 inset !important;
            -webkit-text-fill-color: #ffffff !important;
        }

        /* ── Labels ── */
        .auth-label {
            display: block;
            font-size: 10.5px;
            font-weight: 600;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.45);
            margin-bottom: 3px;
        }

        /* ── Primary button ── */
        .auth-btn-primary {
            width: 100%;
            height: 38px;
            padding: 0 16px;
            background: #ffffff;
            color: #000000;
            border: none;
            border-radius: 11px;
            font-size: 13px;
            font-weight: 700;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.16s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.2s, background 0.2s;
            box-shadow: 0 2px 12px rgba(0,0,0,0.35);
            letter-spacing: 0.01em;
        }
        .auth-btn-primary:hover {
            background: #e8e8e8;
            transform: translateY(-1px);
            box-shadow: 0 5px 16px rgba(0,0,0,0.45);
        }
        .auth-btn-primary:active { transform: scale(0.97); }

        /* ── SSO OAuth button ── */
        .auth-oauth-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            height: 38px;
            padding: 0 16px;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 11px;
            color: rgba(255,255,255,0.85);
            font-size: 12.5px;
            font-weight: 500;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.16s, border-color 0.16s, transform 0.16s;
        }
        .auth-oauth-btn:hover {
            background: rgba(255,255,255,0.08);
            border-color: rgba(255,255,255,0.2);
            transform: translateY(-1px);
        }
        .auth-oauth-btn:active { transform: scale(0.97); }

        /* Strictly enforce small SVG icons */
        .auth-oauth-btn svg {
            width: 15px !important;
            height: 15px !important;
            min-width: 15px !important;
            min-height: 15px !important;
            max-width: 15px !important;
            max-height: 15px !important;
            flex-shrink: 0 !important;
            display: block !important;
        }

        /* ── Error messages ── */
        .auth-error { color: #ff6b6b; font-size: 9.5px; margin-top: 2px; }

        /* ── Links ── */
        .auth-link {
            color: rgba(255,255,255,0.45);
            font-size: 10.5px;
            text-decoration: none;
            transition: color 0.15s;
        }
        .auth-link:hover { color: #ffffff; }
        .auth-link-blue { color: #2997ff; }
        .auth-link-blue:hover { color: #5bb0ff; }

        /* Error validation box */
        .auth-validation-errors {
            background: rgba(255,80,80,0.08);
            border: 1px solid rgba(255,80,80,0.2);
            border-radius: 8px;
            padding: 6px 10px;
            margin-bottom: 10px;
        }
        .auth-validation-errors li { color: #ff8080; font-size: 10.5px; line-height: 1.4; list-style: none; }

        /* Status message */
        .auth-status {
            background: rgba(41,151,255,0.1);
            border: 1px solid rgba(41,151,255,0.2);
            border-radius: 8px;
            padding: 6px 10px;
            color: #60aaff;
            font-size: 10.5px;
            margin-bottom: 10px;
        }

        @media (max-width: 480px) {
            .auth-card { padding: 16px 16px 12px; border-radius: 16px; max-width: 295px; }
        }
    </style>
</head>
<body>

    <!-- Animated background orbs -->
    <div class="auth-orb auth-orb-1" id="orb1"></div>
    <div class="auth-orb auth-orb-2" id="orb2"></div>
    <div class="auth-orb auth-orb-3" id="orb3"></div>

    <!-- Glass card -->
    <div class="auth-card" id="auth-card">

        <!-- Brand -->
        <div class="auth-brand" id="auth-brand">
            <a href="{{ url('/') }}" style="text-decoration:none;">
                <span class="auth-brand-wordmark">M O N A R C H I</span>
            </a>
            <div class="auth-brand-divider"></div>
        </div>

        {{ $slot }}

    </div>

    <!-- Bottom wordmark -->
    <p style="position:relative;z-index:10;margin-top:8px;margin-bottom:0;font-size:9px;color:rgba(255,255,255,0.18);letter-spacing:0.06em;">© {{ date('Y') }} MonarchiHQ</p>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (typeof gsap === 'undefined') return;

            gsap.to('#auth-card', {
                opacity: 1,
                y: 0,
                duration: 0.5,
                ease: 'power3.out',
                delay: 0.05
            });

            gsap.from('#auth-brand', {
                opacity: 0,
                y: -6,
                duration: 0.4,
                ease: 'power2.out',
                delay: 0.15
            });

            gsap.to(['#orb1', '#orb2', '#orb3'], {
                opacity: 1,
                duration: 1.2,
                ease: 'power2.out',
                stagger: 0.1
            });

            gsap.to('#orb1', {
                x: 30, y: 20,
                duration: 10,
                yoyo: true,
                repeat: -1,
                ease: 'sine.inOut'
            });
            gsap.to('#orb2', {
                x: -25, y: -20,
                duration: 12,
                yoyo: true,
                repeat: -1,
                ease: 'sine.inOut',
                delay: 2
            });
            gsap.to('#orb3', {
                x: 20, y: -25,
                duration: 9,
                yoyo: true,
                repeat: -1,
                ease: 'sine.inOut',
                delay: 1
            });

            gsap.from('.auth-field-group', {
                opacity: 0,
                y: 6,
                duration: 0.3,
                ease: 'power2.out',
                stagger: 0.05,
                delay: 0.2
            });
        });
    </script>
</body>
</html>
