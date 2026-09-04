@props([
    'showFooter' => true,
    'title' => 'MonarchI HQ — Enterprise AI, Intelligent Systems & Software Engineering',
    'description' => 'MonarchI HQ engineers enterprise-grade AI systems, intelligent workflow automations, bespoke software, and cutting-edge digital infrastructure for leading global organizations.',
    'keywords' => 'MonarchI, MonarchI HQ, Enterprise AI, Workflow Automation, Software Development, SaaS Platforms, Cloud Architecture, Web Development, Intelligent Systems, Cyber Security, Tech Africa, Digital Transformation, MAI AI',
    'ogImage' => null,
    'ogType' => 'website',
    'canonical' => null,
    'jsonLd' => null,
])
<!DOCTYPE html>
<html lang="en" id="html-root" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Primary SEO Meta Tags -->
    <title>{{ $title }}</title>
    <meta name="title" content="{{ $title }}">
    <meta name="description" content="{{ $description }}">
    <meta name="keywords" content="{{ $keywords }}">
    <meta name="author" content="MonarchI HQ">
    <meta name="publisher" content="MonarchI HQ">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="googlebot" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="bingbot" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ $canonical ?? url()->current() }}">

    <!-- Open Graph / Facebook / LinkedIn / WhatsApp -->
    <meta property="og:type" content="{{ $ogType }}">
    <meta property="og:url" content="{{ $canonical ?? url()->current() }}">
    <meta property="og:site_name" content="MonarchI HQ">
    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description" content="{{ $description }}">
    <meta property="og:image" content="{{ $ogImage ?? asset('images/world-tech.png') }}">
    <meta property="og:image:secure_url" content="{{ $ogImage ?? asset('images/world-tech.png') }}">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="MonarchI HQ — Enterprise AI & Technology Solutions">
    <meta property="og:locale" content="en_US">

    <!-- Twitter Cards -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ $canonical ?? url()->current() }}">
    <meta name="twitter:site" content="@monarchihq">
    <meta name="twitter:creator" content="@monarchihq">
    <meta name="twitter:title" content="{{ $title }}">
    <meta name="twitter:description" content="{{ $description }}">
    <meta name="twitter:image" content="{{ $ogImage ?? asset('images/world-tech.png') }}">
    <meta name="twitter:image:alt" content="MonarchI HQ — Enterprise AI & Technology Solutions">

    <!-- Mobile & PWA Theme -->
    <meta name="theme-color" content="#000000">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="MonarchI">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">

    <!-- Schema.org JSON-LD Structured Data for Search Engine Knowledge Graph -->
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@graph' => [
            [
                '@type' => 'Organization',
                '@id' => url('/') . '/#organization',
                'name' => 'MonarchI HQ',
                'alternateName' => 'MonarchI',
                'url' => url('/'),
                'logo' => [
                    '@type' => 'ImageObject',
                    '@id' => url('/') . '/#logo',
                    'url' => asset('images/logo-white.png'),
                    'caption' => 'MonarchI HQ Logo'
                ],
                'image' => asset('images/world-tech.png'),
                'description' => 'MonarchI HQ engineers enterprise-grade AI systems, intelligent workflow automations, bespoke software, and cutting-edge digital infrastructure.',
                'address' => [
                    '@type' => 'PostalAddress',
                    'addressLocality' => 'Accra',
                    'addressCountry' => 'GH'
                ],
                'contactPoint' => [
                    '@type' => 'ContactPoint',
                    'contactType' => 'Customer Support & Inquiries',
                    'url' => url('/contact')
                ],
                'sameAs' => [
                    'https://x.com/monarchihq',
                    'https://linkedin.com/company/monarchihq',
                    'https://www.snapchat.com/add/monarchihq',
                    'https://wa.me/233505504793'
                ]
            ],
            [
                '@type' => 'WebSite',
                '@id' => url('/') . '/#website',
                'url' => url('/'),
                'name' => 'MonarchI HQ',
                'publisher' => [
                    '@id' => url('/') . '/#organization'
                ],
                'potentialAction' => [
                    '@type' => 'SearchAction',
                    'target' => [
                        '@type' => 'EntryPoint',
                        'urlTemplate' => url('/store') . '?q={search_term_string}'
                    ],
                    'query-input' => 'required name=search_term_string'
                ]
            ],
            [
                '@type' => 'WebPage',
                '@id' => url()->current() . '/#webpage',
                'url' => url()->current(),
                'name' => $title,
                'isPartOf' => [
                    '@id' => url('/') . '/#website'
                ],
                'about' => [
                    '@id' => url('/') . '/#organization'
                ],
                'description' => $description
            ]
        ]
    ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>

    @if(!empty($jsonLd))
        <script type="application/ld+json">
        {!! is_array($jsonLd) ? json_encode($jsonLd, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) : $jsonLd !!}
        </script>
    @endif

    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* =============================================
           TIME-BASED THEME SYSTEM
           Dark: 7pm (19:00) - 6am (06:00)
           Light: 6am (06:00) - 7pm (19:00)
           Hero section is ALWAYS dark.
        ============================================= */

        /* --- DARK THEME (default) --- */
        :root {
            --bg-primary:       #000000;
            --bg-secondary:     #0a0a0a;
            --bg-card:          #111111;
            --bg-section:       #050505;
            --text-primary:     #ffffff;
            --text-secondary:   rgba(255,255,255,0.7);
            --text-muted:       #6b7280;
            --border-color:     rgba(255,255,255,0.08);
            --border-subtle:    rgba(255,255,255,0.05);
            --card-bg:          rgba(255,255,255,0.05);
            --card-bg-alt:      #111111;
            --glass-bg:         rgba(20, 20, 20, 0.5);
            --glass-border:     rgba(255,255,255,0.1);
            --footer-bg:        #000000;
            --nav-menu-bg:      rgba(0,0,0,0.97);
            --service-card-bg:  #111111;
            --cta-section-bg:   #000000;
            --scroll-track:     transparent;
        }

        /* --- LIGHT THEME --- */
        html.light-theme {
            --bg-primary:       #f8f9fa;
            --bg-secondary:     #ffffff;
            --bg-card:          #ffffff;
            --bg-section:       #f0f2f5;
            --text-primary:     #0a0a0a;
            --text-secondary:   rgba(0,0,0,0.65);
            --text-muted:       #434040ff;
            --border-color:     rgba(255, 255, 255, 0.08);
            --border-subtle:    rgba(0,0,0,0.06);
            --card-bg:          rgba(255,255,255,0.9);
            --card-bg-alt:      #ffffff;
            --glass-bg:         rgba(255,255,255,0.75);
            --glass-border:     rgba(0,0,0,0.1);
            --footer-bg:        #0a0a0a;
            --nav-menu-bg:      rgba(255,255,255,0.98);
            --service-card-bg:  #ffffff;
            --cta-section-bg:   #0a0a0a;
            --scroll-track:     transparent;
        }

        /* Global smooth theme transition */
        *, *::before, *::after {
            transition:
                background-color 0.6s ease,
                color 0.6s ease,
                border-color 0.6s ease,
                box-shadow 0.6s ease;
        }

        /* Override transition for animated elements to avoid conflict */
        .reveal, .reveal-left, .reveal-right {
            transition:
                opacity 0.8s cubic-bezier(0.5, 0, 0, 1),
                transform 0.8s cubic-bezier(0.5, 0, 0, 1),
                background-color 0.6s ease !important;
        }

        /* Hide scrollbars */
        html {
            scrollbar-width: none;
            -ms-overflow-style: none;
        }
        html::-webkit-scrollbar { display: none; }

        body {
            background-color: var(--bg-primary);
            color: var(--text-primary);
            overflow-x: hidden;
            min-height: 100vh;
        }

        .hide-scroll {
            scrollbar-width: none;
            -ms-overflow-style: none;
        }
        .hide-scroll::-webkit-scrollbar { display: none; }

        /* --- GLASS NAV (always adapts) --- */
        .glass {
            background: var(--glass-bg);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border-bottom: 1px solid var(--glass-border);
        }

        /* Nav logo & links adapt to theme */
        .logo, .nav-link {
            color: var(--text-primary);
        }
        html.light-theme .logo,
        html.light-theme .nav-link { color: #0a0a0a; }

        html.light-theme header svg.text-gray-300 { color: #4b5563; }

        /* Mobile nav menu bg */
        #menu {
            background: var(--nav-menu-bg) !important;
        }
        html.light-theme #menu a li { color: #0a0a0a; }

        /* --- LIQUID CARD --- */
        .liquid-card {
            background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.01) 100%);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(255,255,255,0.1);
            border-top: 1px solid rgba(255,255,255,0.3);
            border-left: 1px solid rgba(255,255,255,0.2);
            box-shadow: 0 15px 35px rgba(0,0,0,0.5), inset 0 0 15px rgba(255,255,255,0.05);
            border-radius: 1.25rem;
        }
        .liquid-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.6), inset 0 0 20px rgba(255,255,255,0.1);
        }

        .liquid-btn {
            background: rgba(255,255,255,0.05);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255,255,255,0.2);
            box-shadow: inset 0 0 10px rgba(255,255,255,0.05);
        }

        .nav-link {
            transition: opacity 0.3s ease;
            cursor: pointer;
        }
        .nav-link:hover { opacity: 0.7; }

        /* --- SCROLL ANIMATIONS --- */
        .reveal {
            opacity: 0;
            transform: translateY(40px);
        }
        .reveal-left {
            opacity: 0;
            transform: translateX(-40px);
        }
        .reveal-right {
            opacity: 0;
            transform: translateX(40px);
        }
        .reveal.active,
        .reveal-left.active,
        .reveal-right.active {
            opacity: 1;
            transform: translate(0,0);
        }

        .delay-100 { transition-delay: 100ms; }
        .delay-200 { transition-delay: 200ms; }
        .delay-300 { transition-delay: 300ms; }

        /* --- FLOATING CARDS BG ANIMATION --- */
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(var(--base-rotation)); }
            50%       { transform: translateY(-20px) rotate(calc(var(--base-rotation) + 5deg)); }
        }

        .glass-card {
            background: rgba(255,255,255,0.08);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255,255,255,0.28);
            animation: float 10s ease-in-out infinite;
            --base-rotation: 0deg;
        }

        /* Horizontal scroll snap items */
        .snap-item {
            scroll-snap-align: start;
        }

        /* Hero section always stays dark, regardless of theme */
        .hero-section {
            background: #000 !important;
            color: #fff !important;
        }
        .hero-section * {
            /* Don't inherit theme color overrides inside hero */
        }

        /* =============================================
           SERVICE CARDS — Clean & Minimal
        ============================================= */
        .svc-card {
            padding: 0;
            display: flex;
            flex-direction: column;
            position: relative;
            transition: background 0.25s ease;
            overflow: hidden;
        }
        .svc-card-content {
            padding: 32px;
            display: flex;
            flex-direction: column;
            gap: 12px;
            flex-grow: 1;
        }
        .svc-card:hover {
            background: var(--bg-secondary) !important;
        }

        .svc-icon-wrap {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: rgba(41, 151, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 4px;
            transition: background 0.25s ease;
        }
        .svc-card:hover .svc-icon-wrap {
            background: rgba(41, 151, 255, 0.18);
        }

        .svc-icon {
            width: 20px;
            height: 20px;
            color: #2997ff;
            flex-shrink: 0;
        }

        .svc-title {
            font-size: 16px;
            font-weight: 600;
            letter-spacing: -0.01em;
            line-height: 1.3;
        }

        .svc-desc {
            font-size: 13.5px;
            font-weight: 400;
            line-height: 1.65;
            flex: 1;
        }

        .svc-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            font-weight: 500;
            letter-spacing: 0.02em;
            color: #2997ff;
            text-decoration: none;
            margin-top: 8px;
            transition: gap 0.2s ease, opacity 0.2s ease;
        }
        .svc-link:hover {
            gap: 10px;
            opacity: 0.8;
        }

        .svc-link-arrow {
            width: 14px;
            height: 14px;
            flex-shrink: 0;
            transition: transform 0.2s ease;
        }
        .svc-link:hover .svc-link-arrow {
            transform: translateX(3px);
        }

        /* =============================================
           LIGHT THEME — section-specific overrides
        ============================================= */

        /* Services section */
        html.light-theme .services-section {
            background: #f0f2f5;
            border-color: rgba(0,0,0,0.08);
        }
        html.light-theme .services-section h2 { color: #2997ff; }
        html.light-theme .services-section h3 { color: #0a0a0a; }
        html.light-theme .services-section h3 span { color: #6b7280; }
        html.light-theme .services-section p.text-xl { color: #4b5563; }
        html.light-theme .service-card {
            background: #ffffff;
            box-shadow: 0 4px 24px rgba(0,0,0,0.08);
        }

        /* MAI section */
        html.light-theme .mai-section {
            background: #1a1a2e;
        }

        /* CTA section always dark */
        html.light-theme .cta-section {
            background: #050510;
        }

        /* Case studies section */
        html.light-theme .case-studies-section {
            background: #f0f2f5;
        }

        /* Past projects section */
        html.light-theme .projects-section {
            background: #f8f9fa;
        }
        html.light-theme .projects-section .project-card-inner {
            background: #ffffff;
            border: 1px solid rgba(0,0,0,0.08);
            box-shadow: 0 2px 16px rgba(0,0,0,0.06);
        }

        /* Section headings in light mode */
        html.light-theme section h2.text-\[\#2997ff\] { color: #1a7de3; }

        /* Footer always dark in both themes */
        footer {
            background-color: var(--footer-bg) !important;
        }

        /* Theme badge indicator */
        .theme-badge {
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding: 6px 14px;
            border-radius: 999px;
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            z-index: 9999;
            opacity: 0;
            animation: fadeBadge 4s ease forwards;
            pointer-events: none;
        }
        .theme-badge.dark  { background: rgba(255,255,255,0.1); color: rgba(255,255,255,0.6); border: 1px solid rgba(255,255,255,0.15); }
        .theme-badge.light { background: rgba(0,0,0,0.08); color: rgba(0,0,0,0.5); border: 1px solid rgba(0,0,0,0.1); }
        @keyframes fadeBadge {
            0%   { opacity: 0; transform: translateY(10px); }
            15%  { opacity: 1; transform: translateY(0); }
            75%  { opacity: 1; transform: translateY(0); }
            100% { opacity: 0; transform: translateY(10px); }
        }

        /* =============================================
           APPLE-STYLE SEARCH OVERLAY
        ============================================= */

        /* Search icon button in nav */
        .nav-search-btn {
            background: none;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* The full-width search panel */
        .search-overlay {
            position: fixed;
            top: 48px; /* sits exactly below the 48px header */
            left: 0;
            width: 100%;
            z-index: 49;
            /* Frosted glass — adapts to theme */
            background: rgba(0, 0, 0, 0.82);
            backdrop-filter: blur(28px) saturate(200%);
            -webkit-backdrop-filter: blur(28px) saturate(200%);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            /* Slide-down animation */
            transform: translateY(-100%);
            opacity: 0;
            pointer-events: none;
            transition: transform 0.38s cubic-bezier(0.4, 0, 0.2, 1),
                        opacity 0.28s ease;
        }
        html.light-theme .search-overlay {
            background: rgba(245, 245, 247, 0.9);
            border-bottom: 1px solid rgba(0, 0, 0, 0.08);
        }

        .search-overlay.search-open {
            transform: translateY(0);
            opacity: 1;
            pointer-events: all;
        }

        .search-overlay-inner {
            max-width: 860px;
            margin: 0 auto;
            padding: 20px 24px 28px;
        }

        /* Search form row */
        .search-form {
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding-bottom: 16px;
            margin-bottom: 20px;
        }
        html.light-theme .search-form {
            border-bottom-color: rgba(0, 0, 0, 0.1);
        }

        .search-form-icon {
            width: 20px;
            height: 20px;
            flex-shrink: 0;
            color: rgba(255, 255, 255, 0.4);
        }
        html.light-theme .search-form-icon { color: rgba(0, 0, 0, 0.35); }

        .search-input {
            flex: 1;
            background: transparent;
            border: none;
            outline: none;
            font-size: 18px;
            font-weight: 300;
            letter-spacing: 0.01em;
            color: #ffffff;
            caret-color: #2997ff;
        }
        .search-input::placeholder { color: rgba(255, 255, 255, 0.3); }
        html.light-theme .search-input { color: #0a0a0a; }
        html.light-theme .search-input::placeholder { color: rgba(0, 0, 0, 0.3); }

        .search-close-btn {
            background: none;
            border: none;
            cursor: pointer;
            flex-shrink: 0;
            padding: 4px 0 4px 8px;
        }
        .search-close-label {
            font-size: 14px;
            font-weight: 400;
            color: #2997ff;
            transition: opacity 0.2s;
        }
        .search-close-btn:hover .search-close-label { opacity: 0.7; }

        /* Quick links section */
        .search-quick-links {
            animation: searchFadeIn 0.3s ease forwards;
            opacity: 0;
        }
        .search-overlay.search-open .search-quick-links {
            animation: searchFadeIn 0.4s 0.12s ease forwards;
        }
        @keyframes searchFadeIn {
            from { opacity: 0; transform: translateY(8px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .search-ql-label {
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.35);
            margin-bottom: 12px;
        }
        html.light-theme .search-ql-label { color: rgba(0, 0, 0, 0.35); }

        .search-ql-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .search-ql-chip {
            display: flex;
            align-items: center;
            gap: 7px;
            padding: 8px 16px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.07);
            border: 1px solid rgba(255, 255, 255, 0.1);
            font-size: 13px;
            font-weight: 400;
            color: rgba(255, 255, 255, 0.75);
            text-decoration: none;
            transition: background 0.2s, color 0.2s, border-color 0.2s;
        }
        .search-ql-chip:hover {
            background: rgba(41, 151, 255, 0.15);
            border-color: rgba(41, 151, 255, 0.4);
            color: #2997ff;
        }
        html.light-theme .search-ql-chip {
            background: rgba(0, 0, 0, 0.04);
            border-color: rgba(0, 0, 0, 0.08);
            color: rgba(0, 0, 0, 0.65);
        }
        html.light-theme .search-ql-chip:hover {
            background: rgba(41, 151, 255, 0.1);
            border-color: rgba(41, 151, 255, 0.3);
            color: #2997ff;
        }

        .search-ql-icon {
            width: 14px;
            height: 14px;
            flex-shrink: 0;
        }

        /* Dim backdrop behind search */
        .search-backdrop {
            position: fixed;
            inset: 0;
            top: 48px;
            background: rgba(0, 0, 0, 0);
            z-index: 48;
            pointer-events: none;
            transition: background 0.35s ease;
        }
        .search-backdrop.search-open {
            background: rgba(0, 0, 0, 0.35);
            pointer-events: all;
        }
        html.light-theme .search-backdrop.search-open {
            background: rgba(0, 0, 0, 0.18);
        }


        /* =============================================
           UNIFIED CAROUSEL — centered controls
        ============================================= */
        .unified-carousel-section {
            position: relative;
        }

        /* Both tracks: no scrollbar, touch-friendly */
        #cs-track, #proj-track {
            scroll-behavior: smooth;
            -webkit-overflow-scrolling: touch;
            pointer-events: auto;
        }

        /* Gap label between tracks */
        #proj-track {
            position: relative;
        }

        /* The shared controls row — centered*/
        .unified-carousel-controls {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
            padding: 24px 0 8px;
        }

        /* Override old per-section dots so they don't show */
        #cs-dots, #proj-dots,
        #cs-arrows, #proj-arrows {
            display: none !important;
        }

        /* =============================================
           CAROUSEL — Arrows, Dots, Touch-Active
        ============================================= */

        /* Scroll track: always smooth-scroll */
        #cs-track, #proj-track {
            scroll-behavior: smooth;
            -webkit-overflow-scrolling: touch;
        }

        /* Arrow buttons */
        .carousel-arrow {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: 1px solid var(--border-color, rgba(255,255,255,0.15));
            background: var(--bg-card, rgba(255,255,255,0.04));
            color: var(--text-primary, #fff);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background 0.2s, border-color 0.2s, transform 0.15s;
            flex-shrink: 0;
        }
        .carousel-arrow:hover {
            background: rgba(41,151,255,0.12);
            border-color: rgba(41,151,255,0.4);
            transform: scale(1.08);
        }
        .carousel-arrow:disabled {
            opacity: 0.3;
            pointer-events: none;
        }
        html.light-theme .carousel-arrow {
            border-color: rgba(0,0,0,0.12);
            background: rgba(0,0,0,0.04);
            color: #0a0a0a;
        }

        /* Pagination dots */
        .carousel-dots {
            display: flex;
            gap: 6px;
            align-items: center;
        }
        .carousel-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: rgba(255,255,255,0.2);
            transition: background 0.25s, width 0.25s;
            cursor: pointer;
            flex-shrink: 0;
        }
        .carousel-dot.active {
            background: #2997ff;
            width: 18px;
            border-radius: 3px;
        }
        html.light-theme .carousel-dot {
            background: rgba(0,0,0,0.15);
        }
        html.light-theme .carousel-dot.active {
            background: #2997ff;
        }

        /* Touch-active: project cards — reveal overlay on tap (touch devices) */
        [data-touch-card].touch-active .absolute.bg-black\/85 {
            opacity: 1 !important;
        }
        [data-touch-card].touch-active img {
            transform: scale(1.1);
        }
        [data-touch-card].touch-active .translate-y-4 {
            transform: translateY(0) !important;
        }
        /* Hide the default gradient overlay when touch-active */
        [data-touch-card].touch-active .bg-gradient-to-t.opacity-50 {
            opacity: 0;
        }

        /* Swipe hint — fades in then out on first load, mobile only */
        @media (max-width: 767px) {
            .carousel-swipe-hint {
                font-size: 11px;
                color: rgba(255,255,255,0.35);
                display: flex;
                align-items: center;
                gap: 4px;
                margin-top: 6px;
                animation: hintFade 3s 1s ease forwards;
            }
            @keyframes hintFade {
                0%   { opacity: 0; }
                20%  { opacity: 1; }
                80%  { opacity: 1; }
                100% { opacity: 0; }
            }
        }
        @media (min-width: 768px) {
            .carousel-swipe-hint { display: none; }
        }
    </style>
</head>

<body>
    <!-- Time-based theme badge -->
    <div class="theme-badge" id="theme-badge"></div>

    <header class="glass fixed top-0 w-full z-50" id="header">
        <div class="max-w-[1024px] mx-auto h-12 flex items-center justify-between px-4 md:px-0">
            <a href="/">
                <img src="{{asset('images/logo-white.png')}}" alt="Monarchi Logo" class="w-7 h-5" id="nav-logo">
            </a>

            <div id="menu" class="fixed top-12 left-0 w-full bg-black/100 hidden z-40">
                <div class="max-w-[1024px] mx-auto px-4 md:px-0">
                    <ul
                        class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-8 text-center md:justify-center text-[12px] font-normal text-white uppercase tracking-wider py-4">
                        <a href="/services">
                            <li class="nav-link">Services</li>
                        </a>
                        <a href="/projects">
                            <li class="nav-link">Projects</li>
                        </a>
                        <a href="/store">
                            <li class="nav-link">Store</li>
                        </a>
                        <a href="/contact">
                            <li class="nav-link">Contact Us</li>
                        </a>
                        <a href="/about">
                            <li class="nav-link">About</li>
                        </a>
                        <a href="/blog">
                            <li class="nav-link">Trending</li>
                        </a>
                        <a href="/careers">
                            <li class="nav-link">Careers</li>
                        </a>
                    </ul>
                </div>
            </div>

            <a href="/">
                <div class="logo font-bold tracking-[0.2em] text-sm nav-link">
                    M O N A R C H I
                </div>
            </a>

            <div class="right-section flex items-center space-x-6">

                {{-- Search Icon Button --}}
                <button id="search-btn" aria-label="Search" class="nav-search-btn p-1 transition-opacity duration-200 hover:opacity-70">
                    <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.65 16.65 7.5 7.5 0 0016.65 16.65z"></path>
                    </svg>
                </button>

                @php
                    $headerCartCount = array_sum(session('cart', []));
                @endphp
                <a href="{{ route('bag.index') }}" class="relative inline-flex items-center justify-center p-1" aria-label="Shopping Bag">
                    <svg class="w-4 h-4 text-gray-300 nav-link" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    <span id="cart-count-badge"
                          class="{{ $headerCartCount > 0 ? '' : 'hidden' }} absolute -top-1.5 -right-2.5 bg-[#e3000f] text-white text-[9px] font-bold rounded-full h-4 min-w-[16px] px-1 flex items-center justify-center shadow-md pointer-events-none transition-all duration-300 transform scale-100 leading-none">
                        {{ $headerCartCount > 99 ? '99+' : $headerCartCount }}
                    </span>
                </a>


                @auth
                <a href="{{ url('/dashboard') }}">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&color=7F9CF5&background=EBF4FF"
                        class="w-5 h-5 rounded-full nav-link" alt="account">
                </a>
                @else
                <a href="{{ route('login') }}">
                    <svg class="w-4 h-4 text-gray-300 nav-link" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </a>
                @endauth
            </div>
        </div>
    </header>

    {{-- =============================================
         SEARCH OVERLAY
         Slides down below the fixed header.
    ============================================= --}}
    <div id="search-overlay" class="search-overlay" aria-hidden="true" role="dialog" aria-label="Search MonarchI">
        <div class="search-overlay-inner">
            <form id="search-form" class="search-form" onsubmit="return false;">
                <svg class="search-form-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                        d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.65 16.65 7.5 7.5 0 0016.65 16.65z"></path>
                </svg>
                <input
                    id="search-input"
                    type="text"
                    placeholder="Search MonarchI..."
                    class="search-input"
                    autocomplete="off"
                    spellcheck="false"
                />
                <button type="button" id="search-close" class="search-close-btn" aria-label="Close search">
                    <span class="search-close-label">Cancel</span>
                </button>
            </form>

            <div class="search-quick-links" id="search-suggestions">
                <p class="search-ql-label">Quick Links</p>
                <div class="search-ql-grid">
                    <a href="/services" class="search-ql-chip">
                        <svg class="search-ql-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        Services
                    </a>
                    <a href="/projects" class="search-ql-chip">
                        <svg class="search-ql-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        Projects
                    </a>
                    <a href="/store" class="search-ql-chip">
                        <svg class="search-ql-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        Store
                    </a>
                    <a href="/about" class="search-ql-chip">
                        <svg class="search-ql-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        About
                    </a>
                    <a href="/blog" class="search-ql-chip">
                        <svg class="search-ql-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                        Trending
                    </a>
                    <a href="/contact" class="search-ql-chip">
                        <svg class="search-ql-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        Contact
                    </a>
                </div>
            </div>
        </div>
    </div>
    {{-- Backdrop: dims page behind search overlay --}}
    <div id="search-backdrop" class="search-backdrop" aria-hidden="true"></div>
    <main>
        {{ $slot }}
    </main>
    @if($showFooter)
    <footer class="bg-black border-t border-white/10 pt-20 pb-10 px-6 z-10 relative">
        <div class="max-w-[1200px] mx-auto">
            <div class="md:col-span-2 flex flex-col items-center md:items-center mb-8">
                    <div class="logo font-bold tracking-[0.2em] text-sm mb-6 text-white">
                        M O N A R C H I
                    </div>
                    <p class="text-sm text-gray-400 font-light leading-relaxed max-w-xs mb-6">
                        Enterprise-grade Systems and bespoke Machine Learning solutions engineered for absolute scale.
                    </p>
                    <div class="flex space-x-5">
                        <a href="https://x.com/monarchihq" class="text-gray-500 hover:text-[#2997ff] transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path
                                    d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 22.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.008 5.925H5.022z" />
                            </svg>
                        </a>
                        <a href="https://linkedin.com/company/monarchihq" target="_blank" class="text-gray-500 hover:text-[#2997ff] transition-colors" aria-label="LinkedIn">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="https://www.snapchat.com/add/monarchihq" target="_blank" rel="noopener noreferrer" class="text-gray-500 hover:text-[#FFFC00] transition-colors" aria-label="Snapchat">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M12 2.75c-3.73 0-6.25 2.76-6.25 5.92 0 .84.27 1.83.74 2.6-.09.07-.2.12-.31.18-.54.29-.86.6-.86 1.02 0 .45.34.84.84.99.19.06.42.1.66.11.04.24.11.48.22.71.17.37.46.72.84 1.02-.39.35-1.01.69-1.83 1-.36.13-.67.27-.92.42-.48.29-.68.6-.68.96 0 .54.45.98 1.26 1.32.78.33 1.91.53 3.25.53.43 0 .89-.02 1.37-.07.42.46.99.72 1.48.72s1.06-.26 1.48-.72c.48.05.94.07 1.37.07 1.34 0 2.47-.2 3.25-.53.81-.34 1.26-.78 1.26-1.32 0-.36-.2-.67-.68-.96-.25-.15-.56-.29-.92-.42-.82-.31-1.44-.65-1.83-1 .38-.3.67-.65.84-1.02.11-.23.18-.47.22-.71.24-.01.47-.05.66-.11.5-.15.84-.54.84-.99 0-.42-.32-.73-.86-1.02-.11-.06-.22-.11-.31-.18.47-.77.74-1.76.74-2.6 0-3.16-2.52-5.92-6.25-5.92z"/>
                            </svg>
                        </a>
                        <a href="https://wa.me/233505504793" target="_blank" rel="noopener noreferrer" class="text-gray-500 hover:text-[#25D366] transition-colors" aria-label="WhatsApp">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.771-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.274.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.045.072.045.419-.099.824zm-3.423-14.416c-6.627 0-12 5.373-12 12 0 2.175.58 4.212 1.587 5.972l-1.687 6.168 6.347-1.664c1.704.938 3.659 1.524 5.753 1.524 6.627 0 12-5.373 12-12s-5.373-12-12-12z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            <div class="grid grid-cols-3 md:grid-cols-5 gap-10 mb-16 text-center md:text-center">
                
                {{-- COMPANY QUICKLINKS --}}
                <div>
                    <h4 class="text-white font-medium mb-4 text-sm">Company</h4>
                    <ul class="space-y-3 text-sm text-gray-400 font-light">
                        <li><a href="/about" class="hover:text-[#2997ff] transition-colors">About Us</a></li>
                        <li><a href="/blog" class="hover:text-[#2997ff] transition-colors">Blog</a></li>
                        <li><a href="/careers" class="hover:text-[#2997ff] transition-colors">Careers</a></li>
                        <li><a href="/contact" class="hover:text-[#2997ff] transition-colors">Contact</a></li>
                        <li><a href="/partners" class="hover:text-[#2997ff] transition-colors">Partners</a></li>
                    </ul>
                </div> 
                {{-- DIVISIONS QUICKLINKS --}}
                <div>
                    <h4 class="text-white font-medium mb-4 text-sm">Divisions</h4>
                    <ul class="space-y-3 text-sm text-gray-400 font-light">
                        <li><a href="/divisions#io" class="hover:text-[#2997ff] transition-colors">Monarch I/O</a></li>
                        <li><a href="/divisions#inventions" class="hover:text-[#2997ff] transition-colors">Monarch Inventions</a></li>
                        <li><a href="/divisions#innovations" class="hover:text-[#2997ff] transition-colors">Monarch Innovations</a></li>
                        <li><a href="/divisions#iot" class="hover:text-[#2997ff] transition-colors">Monarch IoT</a></li>
                        <li><a href="/divisions#is" class="hover:text-[#2997ff] transition-colors">Monarch IS</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-white font-medium mb-4 text-sm">Products</h4>
                    <ul class="space-y-3 text-sm text-gray-400 font-light">
                        <li><a href="/services" class="hover:text-[#2997ff] transition-colors">MAI</a></li>
                        <li><a href="/divisions#innovations" class="hover:text-[#2997ff] transition-colors">iLyft</a></li>
                        <li><a href="/store" class="hover:text-[#2997ff] transition-colors">invenStore</a></li>
                        <li><a href="/divisions#innovations" class="hover:text-[#2997ff] transition-colors">OnuaFoodHub</a></li>
                    </ul>
                </div>  

                {{-- COMMUNITY QUICKLINKS --}}
                <div>
                    <h4 class="text-white font-medium mb-4 text-sm">Community</h4>
                    <ul class="space-y-3 text-sm text-gray-400 font-light">
                        <li><a href="/community" class="hover:text-[#2997ff] transition-colors">Open Source</a></li>
                        <li><a href="/community" class="hover:text-[#2997ff] transition-colors">Social Impact</a></li>
                        <li><a href="/community" class="hover:text-[#2997ff] transition-colors">Community Events</a></li>
                        <li><a href="/blog" class="hover:text-[#2997ff] transition-colors">Blog</a></li>
                    </ul>
                </div> 

                <div>
                    <h4 class="text-white font-medium mb-4 text-sm">Legal</h4>
                    <ul class="space-y-3 text-sm text-gray-400 font-light">
                        <li><a href="/privacy" class="hover:text-[#2997ff] transition-colors">Privacy Policy</a></li>
                        <li><a href="/terms" class="hover:text-[#2997ff] transition-colors">Terms of Service</a></li>
                        <li><a href="/cookies" class="hover:text-[#2997ff] transition-colors">Cookie Policy</a></li>
                        <li><a href="/licenses" class="hover:text-[#2997ff] transition-colors">License & Authorization</a></li>
                        <li><a href="/security" class="hover:text-[#2997ff] transition-colors">Security</a></li>
                    </ul>
                </div>
            </div>

            <div class="pt-8 border-t border-white/10 flex flex-col md:flex-row justify-center items-center gap-4 text-center md:text-center">
                <p class="text-xs text-gray-500 font-light w-full md:w-auto">
                    &copy; {{ date('Y') }} MonarchI. All rights reserved.
                </p>
                <div class="flex justify-center md:justify-center space-x-6 text-xs text-gray-500 font-light w-full md:w-auto">
                    <span>Tema, Greater Accra Region, Ghana</span>
                </div>
            </div>
        </div>
    </footer>
    @endif
    {{-- SCRIPTS --}}
    <script>
        /* =============================================
           TIME-BASED AUTO THEME
           Day  (06:00 – 19:00): light-theme class
           Night (19:00 – 06:00): dark (default, no class)
        ============================================= */
        (function() {
            const hour = new Date().getHours();
            const isDay = hour >= 6 && hour < 19;
            const html  = document.getElementById('html-root');
            const badge = document.getElementById('theme-badge');
            const navLogo = document.getElementById('nav-logo');

            if (isDay) {
                html.classList.add('light-theme');
                if (badge) {
                    badge.textContent = 'Day Mode';
                    badge.classList.add('light');
                }
                if (navLogo) {
                    navLogo.src = "{{asset('images/logo.png')}}";
                }
            } else {
                if (badge) {
                    badge.textContent = 'Night Mode';
                    badge.classList.add('dark');
                }
                if (navLogo) {
                    navLogo.src = "{{asset('images/logo-white.png')}}";
                }
            }
        })();

        /* =============================================
           GLOBAL CART BADGE & NOTIFICATION HELPERS
        ============================================= */
        window.updateCartBadge = function(count) {
            const badge = document.getElementById('cart-count-badge');
            if (!badge) return;
            const num = parseInt(count, 10) || 0;
            badge.textContent = num > 99 ? '99+' : num;
            if (num > 0) {
                badge.classList.remove('hidden');
                badge.style.display = 'flex';
                badge.animate([
                    { transform: 'scale(0.5)' },
                    { transform: 'scale(1.4)' },
                    { transform: 'scale(1)' }
                ], { duration: 320, easing: 'cubic-bezier(0.34, 1.56, 0.64, 1)' });
            } else {
                badge.classList.add('hidden');
                badge.style.display = 'none';
            }
        };

        window.showStoreToast = function(message, isSuccess = true) {
            const existingToast = document.getElementById('store-live-toast');
            if (existingToast) existingToast.remove();

            const toast = document.createElement('div');
            toast.id = 'store-live-toast';
            toast.className = 'fixed bottom-6 right-6 z-50 px-5 py-3.5 rounded-2xl shadow-2xl text-sm font-medium flex items-center gap-3 transition-all duration-300 transform translate-y-4 opacity-0';
            toast.style.background = isSuccess ? '#111111' : '#e3000f';
            toast.style.color = '#ffffff';
            toast.style.border = '1px solid rgba(255,255,255,0.15)';
            toast.style.boxShadow = '0 20px 40px rgba(0,0,0,0.4)';

            const iconHtml = isSuccess
                ? `<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-green-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>`
                : `<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>`;

            toast.innerHTML = `${iconHtml}<span>${message}</span>`;
            document.body.appendChild(toast);

            requestAnimationFrame(() => {
                toast.style.transform = 'translateY(0)';
                toast.style.opacity = '1';
            });

            setTimeout(() => {
                toast.style.transform = 'translateY(8px)';
                toast.style.opacity = '0';
                setTimeout(() => toast.remove(), 350);
            }, 3000);
        };

        document.addEventListener('DOMContentLoaded', () => {
            const header = document.getElementById('header');
            const menu = document.getElementById('menu');
            if (!header || !menu) return;

            let isMenuOpen = false;
            let closeTimeout = null;

            const isTouchDevice = () => ('ontouchstart' in window) || (navigator.maxTouchPoints > 0);

            const showMenu = () => {
                if (closeTimeout) { clearTimeout(closeTimeout); closeTimeout = null; }
                menu.classList.remove('hidden');
                isMenuOpen = true;
            };

            const hideMenu = () => {
                if (closeTimeout) { clearTimeout(closeTimeout); closeTimeout = null; }
                menu.classList.add('hidden');
                isMenuOpen = false;
            };

            const toggleMenu = () => {
                if (isMenuOpen) {
                    hideMenu();
                } else {
                    showMenu();
                }
            };

            // Desktop hover interactions (only for pointer/mouse devices)
            header.addEventListener('mouseenter', () => {
                if (!isTouchDevice()) showMenu();
            });
            header.addEventListener('mouseleave', () => {
                if (!isTouchDevice()) {
                    closeTimeout = setTimeout(() => {
                        if (!menu.matches(':hover') && !header.matches(':hover')) hideMenu();
                    }, 80);
                }
            });

            menu.addEventListener('mouseenter', () => {
                if (!isTouchDevice()) showMenu();
            });
            menu.addEventListener('mouseleave', () => {
                if (!isTouchDevice()) {
                    closeTimeout = setTimeout(() => {
                        if (!menu.matches(':hover') && !header.matches(':hover')) hideMenu();
                    }, 80);
                }
            });

            // Tap/click header behavior
            header.addEventListener('click', (e) => {
                // If user clicked search button, bag, account or inside active search overlay, let those handlers run
                if (e.target.closest('#search-btn') || e.target.closest('#search-overlay') || e.target.closest('a[aria-label="Shopping Bag"]') || e.target.closest('a[href*="dashboard"]') || e.target.closest('a[href*="login"]')) {
                    hideMenu();
                    return;
                }

                // If user clicked inside the menu itself
                if (e.target.closest('#menu')) {
                    if (e.target.closest('a')) {
                        hideMenu();
                    }
                    return;
                }

                // Otherwise toggle menu on header tap/click
                toggleMenu();
            });

            // Auto-hide when tapping anywhere else on the page
            document.addEventListener('click', (e) => {
                if (isMenuOpen && !header.contains(e.target) && !menu.contains(e.target)) {
                    hideMenu();
                }
            });

            // Auto-hide on mobile/desktop scroll
            let isScrolling = false;
            const handleScroll = () => {
                if (isMenuOpen && !isScrolling) {
                    isScrolling = true;
                    hideMenu();
                    setTimeout(() => { isScrolling = false; }, 80);
                }
            };

            window.addEventListener('scroll', handleScroll, { passive: true });
            window.addEventListener('touchmove', handleScroll, { passive: true });
        });

        document.addEventListener('DOMContentLoaded', () => {
            const counters = document.querySelectorAll('.stat-counter');
            const duration = 2000; 
            
            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-target'), 10);
                const increment = target / (duration / 16); 
                let current = 0;

                const updateCounter = () => {
                    current += increment;
                    if (current < target) {
                        counter.innerText = Math.ceil(current);
                        requestAnimationFrame(updateCounter);
                    } else {
                        counter.innerText = target;
                    }
                };

                updateCounter();
            });
        });

        document.addEventListener('DOMContentLoaded', () => {
            const observerOptions = {
                root: null,
                rootMargin: '0px',
                threshold: 0.15 
            };

            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('active');
                        observer.unobserve(entry.target); 
                    }
                });
            }, observerOptions);

            const revealElements = document.querySelectorAll('.reveal, .reveal-left, .reveal-right');
            revealElements.forEach(el => observer.observe(el));
        });

        document.addEventListener('DOMContentLoaded', () => {
            const container = document.getElementById('random-cards-container');
            if (!container) return;
            const cards = container.querySelectorAll('.glass-card');
            
            function positionCards() {
                const containerWidth = container.offsetWidth;
                const containerHeight = container.offsetHeight;

                cards.forEach(card => {
                    const randomTop = Math.random() * (containerHeight - 150); 
                    const randomLeft = Math.random() * (containerWidth - 150);
                    const randomSize = 80 + Math.random() * 80; 
                    const randomRotation = -20 + Math.random() * 40; 
                    
                    const randomOpacity = 0.15 + Math.random() * 0.15; 

                    card.style.top = `${randomTop}px`;
                    card.style.left = `${randomLeft}px`;
                    card.style.width = `${randomSize}px`;
                    card.style.height = `${randomSize}px`;
                    card.style.opacity = randomOpacity;
                    
                    card.style.setProperty('--base-rotation', `${randomRotation}deg`);
                    
                    const animDuration = 5 + Math.random() * 5; 
                    const animDelay = Math.random() * 3; 
                    card.style.animationDuration = `${animDuration}s`;
                    card.style.animationDelay = `${animDelay}s`;
                });
            }

            positionCards();
            window.addEventListener('resize', positionCards);
        });

        /* =============================================
           SEARCH OVERLAY — Open / Close logic
        ============================================= */
        (function() {
            const btn      = document.getElementById('search-btn');
            const overlay  = document.getElementById('search-overlay');
            const backdrop = document.getElementById('search-backdrop');
            const input    = document.getElementById('search-input');
            const closeBtn = document.getElementById('search-close');

            function openSearch() {
                overlay.classList.add('search-open');
                backdrop.classList.add('search-open');
                overlay.setAttribute('aria-hidden', 'false');
                document.body.style.overflow = 'hidden';
                // Small delay so the panel finishes sliding before focus
                setTimeout(() => input && input.focus(), 80);
            }

            function closeSearch() {
                overlay.classList.remove('search-open');
                backdrop.classList.remove('search-open');
                overlay.setAttribute('aria-hidden', 'true');
                document.body.style.overflow = '';
                if (input) input.value = '';
            }

            if (btn)      btn.addEventListener('click', openSearch);
            if (closeBtn) closeBtn.addEventListener('click', closeSearch);
            if (backdrop) backdrop.addEventListener('click', closeSearch);

            // Keyboard shortcuts
            document.addEventListener('keydown', (e) => {
                // ⌘K or Ctrl+K opens search
                if ((e.metaKey || e.ctrlKey) && e.key === 'k') {
                    e.preventDefault();
                    overlay.classList.contains('search-open') ? closeSearch() : openSearch();
                }
                // Escape closes search
                if (e.key === 'Escape' && overlay.classList.contains('search-open')) {
                    closeSearch();
                }
            });
        })();

        /* =============================================
           UNIFIED DUAL-TRACK CAROUSEL
           Both tracks (cs-track, proj-track) scroll
           in lockstep from one set of controls.
        ============================================= */
        (function() {
            const csTrack   = document.getElementById('cs-track');
            const projTrack = document.getElementById('proj-track');
            const prevBtn   = document.getElementById('unified-prev');
            const nextBtn   = document.getElementById('unified-next');
            const dotsEl    = document.getElementById('unified-dots');

            if (!csTrack || !projTrack) return;

            // Use case study items as the index source (5 items)
            const items = Array.from(csTrack.querySelectorAll('.snap-item'));
            const count = items.length;
            let currentIndex = 0;
            let isSyncing = false; // prevent scroll-event loops

            // ── Build centered pagination dots ──
            items.forEach((_, i) => {
                const dot = document.createElement('button');
                dot.className = 'carousel-dot' + (i === 0 ? ' active' : '');
                dot.setAttribute('aria-label', 'Go to item ' + (i + 1));
                dot.addEventListener('click', () => goTo(i));
                if (dotsEl) dotsEl.appendChild(dot);
            });

            function updateDots(idx) {
                if (dotsEl) {
                    dotsEl.querySelectorAll('.carousel-dot').forEach((d, i) => {
                        d.classList.toggle('active', i === idx);
                    });
                }
                if (prevBtn) prevBtn.disabled = idx <= 0;
                if (nextBtn) nextBtn.disabled = idx >= count - 1;
                currentIndex = idx;
            }

            function getScrollTarget(track, idx) {
                const trackItems = Array.from(track.querySelectorAll('.snap-item'));
                if (!trackItems[idx]) return 0;
                return trackItems[idx].offsetLeft - track.offsetLeft;
            }

            function goTo(idx) {
                idx = Math.max(0, Math.min(idx, count - 1));
                isSyncing = true;

                csTrack.scrollTo({ left: getScrollTarget(csTrack, idx), behavior: 'smooth' });
                projTrack.scrollTo({ left: getScrollTarget(projTrack, idx), behavior: 'smooth' });

                updateDots(idx);
                setTimeout(() => { isSyncing = false; }, 600);
            }

            // Arrow buttons
            if (prevBtn) prevBtn.addEventListener('click', () => goTo(currentIndex - 1));
            if (nextBtn) nextBtn.addEventListener('click', () => goTo(currentIndex + 1));

            // Sync: when user manually swipes cs-track, mirror to proj-track
            function onCsScroll() {
                if (isSyncing) return;
                const itemW = items[0] ? items[0].offsetWidth + 24 : 1;
                const idx   = Math.round(csTrack.scrollLeft / itemW);
                isSyncing = true;
                projTrack.scrollTo({ left: getScrollTarget(projTrack, idx), behavior: 'smooth' });
                updateDots(idx);
                setTimeout(() => { isSyncing = false; }, 600);
            }

            // Sync: when user manually swipes proj-track, mirror to cs-track
            function onProjScroll() {
                if (isSyncing) return;
                const projItems = Array.from(projTrack.querySelectorAll('.snap-item'));
                const itemW = projItems[0] ? projItems[0].offsetWidth + 24 : 1;
                const idx   = Math.round(projTrack.scrollLeft / itemW);
                isSyncing = true;
                csTrack.scrollTo({ left: getScrollTarget(csTrack, idx), behavior: 'smooth' });
                updateDots(idx);
                setTimeout(() => { isSyncing = false; }, 600);
            }

            let csTimer, projTimer;
            csTrack.addEventListener('scroll',   () => { clearTimeout(csTimer);   csTimer   = setTimeout(onCsScroll,   80); }, { passive: true });
            projTrack.addEventListener('scroll', () => { clearTimeout(projTimer); projTimer = setTimeout(onProjScroll, 80); }, { passive: true });

            updateDots(0);

            /* ── Touch tap-to-reveal for project cards ── */
            document.querySelectorAll('[data-touch-card]').forEach(card => {
                card.addEventListener('click', function(e) {
                    const isTouch = window.matchMedia('(hover: none)').matches;
                    if (!isTouch) return;
                    const isActive = this.classList.contains('touch-active');
                    document.querySelectorAll('[data-touch-card].touch-active').forEach(c => {
                        if (c !== this) c.classList.remove('touch-active');
                    });
                    this.classList.toggle('touch-active', !isActive);
                    if (e.target.tagName === 'A' || e.target.closest('a')) return;
                    e.preventDefault();
                });
            });
        })();

        /* =============================================
           SEARCH OVERLAY — Open / Close logic
        ============================================= */
        (function() {
            const btn      = document.getElementById('search-btn');
            const overlay  = document.getElementById('search-overlay');
            const backdrop = document.getElementById('search-backdrop');
            const input    = document.getElementById('search-input');
            const closeBtn = document.getElementById('search-close');

            function openSearch() {
                overlay.classList.add('search-open');
                backdrop.classList.add('search-open');
                overlay.setAttribute('aria-hidden', 'false');
                document.body.style.overflow = 'hidden';
                // Small delay so the panel finishes sliding before focus
                setTimeout(() => input && input.focus(), 80);
            }

            function closeSearch() {
                overlay.classList.remove('search-open');
                backdrop.classList.remove('search-open');
                overlay.setAttribute('aria-hidden', 'true');
                document.body.style.overflow = '';
                if (input) input.value = '';
            }

            if (btn)      btn.addEventListener('click', openSearch);
            if (closeBtn) closeBtn.addEventListener('click', closeSearch);
            if (backdrop) backdrop.addEventListener('click', closeSearch);

            // Keyboard shortcuts
            document.addEventListener('keydown', (e) => {
                // ⌘K or Ctrl+K opens search
                if ((e.metaKey || e.ctrlKey) && e.key === 'k') {
                    e.preventDefault();
                    overlay.classList.contains('search-open') ? closeSearch() : openSearch();
                }
                // Escape closes search
                if (e.key === 'Escape' && overlay.classList.contains('search-open')) {
                    closeSearch();
                }
            });
        })();

        /* =============================================
           CAROUSEL — Interactive arrows, dots & touch
        ============================================= */
        (function() {
            function initCarousel(trackId, prevId, nextId, dotsId) {
                const track   = document.getElementById(trackId);
                const prev    = document.getElementById(prevId);
                const next    = document.getElementById(nextId);
                const dotsEl  = document.getElementById(dotsId);
                if (!track) return;

                const items = Array.from(track.querySelectorAll('.snap-item'));
                if (!items.length) return;

                // Build pagination dots
                items.forEach((_, i) => {
                    const dot = document.createElement('button');
                    dot.className = 'carousel-dot' + (i === 0 ? ' active' : '');
                    dot.setAttribute('aria-label', 'Go to item ' + (i + 1));
                    dot.addEventListener('click', () => scrollToIndex(i));
                    if (dotsEl) dotsEl.appendChild(dot);
                });

                function getIndex() {
                    const w = track.clientWidth;
                    return Math.round(track.scrollLeft / (items[0].offsetWidth + 24)); // 24 = gap-6
                }

                function updateDots(idx) {
                    if (!dotsEl) return;
                    dotsEl.querySelectorAll('.carousel-dot').forEach((d, i) => {
                        d.classList.toggle('active', i === idx);
                    });
                    if (prev) prev.disabled = idx <= 0;
                    if (next) next.disabled = idx >= items.length - 1;
                }

                function scrollToIndex(idx) {
                    idx = Math.max(0, Math.min(idx, items.length - 1));
                    items[idx].scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'start' });
                    setTimeout(() => updateDots(idx), 350);
                }

                if (prev) prev.addEventListener('click', () => scrollToIndex(getIndex() - 1));
                if (next) next.addEventListener('click', () => scrollToIndex(getIndex() + 1));

                // Update dots on scroll (debounced)
                let scrollTimer;
                track.addEventListener('scroll', () => {
                    clearTimeout(scrollTimer);
                    scrollTimer = setTimeout(() => updateDots(getIndex()), 80);
                }, { passive: true });

                updateDots(0);
            }

            initCarousel('cs-track',   'cs-prev',   'cs-next',   'cs-dots');
            initCarousel('proj-track', 'proj-prev', 'proj-next', 'proj-dots');

            /* ---- Touch tap-to-reveal for project cards ---- */
            document.querySelectorAll('[data-touch-card]').forEach(card => {
                card.addEventListener('click', function(e) {
                    // Only act on touch/pointer-fine devices — skip pure mouse
                    const isTouch = window.matchMedia('(hover: none)').matches;
                    if (!isTouch) return;

                    const isActive = this.classList.contains('touch-active');
                    // Deactivate all others
                    document.querySelectorAll('[data-touch-card].touch-active').forEach(c => {
                        if (c !== this) c.classList.remove('touch-active');
                    });
                    this.classList.toggle('touch-active', !isActive);

                    // If a link inside was clicked, let it navigate
                    if (e.target.tagName === 'A' || e.target.closest('a')) return;
                    e.preventDefault();
                });
            });
        })();

    </script>
</body>

</html>