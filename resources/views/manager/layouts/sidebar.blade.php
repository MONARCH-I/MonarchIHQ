<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Manager Portal' }} — MonarchI</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --sidebar-w: 260px;
            --header-h: 64px;
            --bg-dark: #0a0a0a;
            --bg-card: #111111;
            --bg-hover: #1a1a1a;
            --border: rgba(255,255,255,0.08);
            --accent: #2997ff;
            --accent-dim: rgba(41,151,255,0.12);
            --text-primary: #f5f5f7;
            --text-secondary: rgba(245,245,247,0.60);
            --text-muted: rgba(245,245,247,0.35);
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Inter', sans-serif; background: var(--bg-dark); color: var(--text-primary); display: flex; min-height: 100vh; }

        /* ── Sidebar ── */
        .sidebar {
            position: fixed; top: 0; left: 0; bottom: 0;
            width: var(--sidebar-w);
            background: var(--bg-card);
            border-right: 1px solid var(--border);
            display: flex; flex-direction: column;
            z-index: 50; overflow-y: auto;
            transition: transform 0.25s cubic-bezier(0.4,0,0.2,1);
        }
        .sidebar-logo {
            height: var(--header-h);
            padding: 0 20px;
            display: flex; align-items: center; gap: 12px;
            border-bottom: 1px solid var(--border);
            flex-shrink: 0;
        }
        .sidebar-logo .logo-icon {
            width: 34px; height: 34px; border-radius: 10px;
            background: var(--accent-dim); border: 1px solid rgba(41,151,255,0.3);
            display: flex; align-items: center; justify-content: center;
            font-weight: 800; font-size: 14px; color: var(--accent); flex-shrink: 0;
        }
        .sidebar-logo .logo-text { font-size: 15px; font-weight: 700; color: var(--text-primary); }
        .sidebar-logo .logo-sub  { font-size: 10px; color: var(--text-muted); margin-top: 1px; }

        /* ── Tabs (at top of sidebar below logo) ── */
        .sidebar-tabs {
            padding: 16px 12px 8px;
            border-bottom: 1px solid var(--border);
            flex-shrink: 0;
        }
        .sidebar-tabs-label {
            font-size: 9px; font-weight: 700; letter-spacing: 0.12em;
            text-transform: uppercase; color: var(--text-muted);
            padding: 0 8px; margin-bottom: 6px;
        }
        .sidebar-tab {
            display: flex; align-items: center; gap: 10px;
            padding: 9px 12px; border-radius: 10px;
            font-size: 13px; font-weight: 500;
            color: var(--text-secondary); text-decoration: none;
            transition: all 0.15s; margin-bottom: 2px;
            border: 1px solid transparent;
        }
        .sidebar-tab:hover { background: var(--bg-hover); color: var(--text-primary); }
        .sidebar-tab.active {
            background: var(--accent-dim); color: var(--accent);
            border-color: rgba(41,151,255,0.25);
        }
        .sidebar-tab .tab-icon {
            width: 32px; height: 32px; border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-size: 15px; flex-shrink: 0;
        }

        /* ── Sidebar Nav ── */
        .sidebar-nav { padding: 12px; flex: 1; }
        .sidebar-nav-label {
            font-size: 9px; font-weight: 700; letter-spacing: 0.12em;
            text-transform: uppercase; color: var(--text-muted);
            padding: 0 8px; margin: 12px 0 4px;
        }
        .sidebar-nav-link {
            display: flex; align-items: center; gap: 10px;
            padding: 8px 12px; border-radius: 8px;
            font-size: 13px; font-weight: 500;
            color: var(--text-secondary); text-decoration: none;
            transition: all 0.15s; margin-bottom: 1px;
        }
        .sidebar-nav-link:hover { background: var(--bg-hover); color: var(--text-primary); }
        .sidebar-nav-link.active { background: var(--accent-dim); color: var(--accent); }
        .sidebar-nav-link .badge {
            margin-left: auto; font-size: 10px; font-weight: 700;
            background: var(--accent); color: #fff;
            padding: 1px 6px; border-radius: 99px;
        }

        /* ── Sidebar Footer ── */
        .sidebar-footer {
            padding: 16px; border-top: 1px solid var(--border);
            flex-shrink: 0;
        }
        .user-card {
            display: flex; align-items: center; gap: 10px;
            padding: 10px 12px; border-radius: 10px;
            background: var(--bg-hover); border: 1px solid var(--border);
        }
        .user-avatar {
            width: 32px; height: 32px; border-radius: 8px;
            background: var(--accent-dim); color: var(--accent);
            display: flex; align-items: center; justify-content: center;
            font-size: 12px; font-weight: 700; flex-shrink: 0;
        }
        .user-name  { font-size: 12px; font-weight: 600; color: var(--text-primary); }
        .user-role  { font-size: 10px; color: var(--text-muted); }

        /* ── Main Content ── */
        .main-content {
            margin-left: var(--sidebar-w);
            flex: 1; display: flex; flex-direction: column; min-height: 100vh;
        }
        .topbar {
            height: var(--header-h);
            background: var(--bg-card);
            border-bottom: 1px solid var(--border);
            padding: 0 28px;
            display: flex; align-items: center; justify-content: space-between;
            position: sticky; top: 0; z-index: 40; flex-shrink: 0;
        }
        .topbar-title { font-size: 17px; font-weight: 700; color: var(--text-primary); }
        .topbar-breadcrumb { font-size: 12px; color: var(--text-muted); margin-top: 1px; }
        .page-body { padding: 28px; flex: 1; }

        /* ── Cards ── */
        .card {
            background: var(--bg-card); border: 1px solid var(--border);
            border-radius: 16px; padding: 20px;
        }
        .stat-card {
            background: var(--bg-card); border: 1px solid var(--border);
            border-radius: 16px; padding: 20px 24px;
            transition: border-color 0.2s;
        }
        .stat-card:hover { border-color: rgba(41,151,255,0.3); }
        .stat-label { font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.08em; color: var(--text-muted); }
        .stat-value { font-size: 30px; font-weight: 800; color: var(--text-primary); margin-top: 4px; }

        /* ── Buttons ── */
        .btn { display: inline-flex; align-items: center; gap: 6px; padding: 9px 18px; border-radius: 10px; font-size: 13px; font-weight: 600; cursor: pointer; border: none; text-decoration: none; transition: all 0.15s; }
        .btn-primary   { background: var(--accent); color: #fff; }
        .btn-primary:hover { background: #1a7de3; transform: translateY(-1px); }
        .btn-secondary { background: var(--bg-hover); color: var(--text-primary); border: 1px solid var(--border); }
        .btn-secondary:hover { border-color: rgba(255,255,255,0.2); }
        .btn-danger    { background: rgba(239,68,68,0.1); color: #f87171; border: 1px solid rgba(239,68,68,0.2); }
        .btn-danger:hover { background: rgba(239,68,68,0.2); }
        .btn-sm { padding: 6px 12px; font-size: 11px; border-radius: 8px; }

        /* ── Table ── */
        .data-table { width: 100%; border-collapse: collapse; }
        .data-table th {
            font-size: 10px; font-weight: 700; text-transform: uppercase;
            letter-spacing: 0.08em; color: var(--text-muted);
            padding: 10px 16px; border-bottom: 1px solid var(--border);
            text-align: left;
        }
        .data-table td {
            padding: 14px 16px; border-bottom: 1px solid var(--border);
            font-size: 13px; color: var(--text-secondary);
            vertical-align: middle;
        }
        .data-table tr:last-child td { border-bottom: none; }
        .data-table tr:hover td { background: var(--bg-hover); }

        /* ── Table scroll wrapper ── */
        .data-table-wrap { overflow-x: auto; -webkit-overflow-scrolling: touch; }

        /* ── Badge ── */
        .badge { display: inline-flex; align-items: center; gap: 4px; padding: 3px 10px; border-radius: 99px; font-size: 10px; font-weight: 700; border: 1px solid; }

        /* ── Form ── */
        .form-group { margin-bottom: 20px; }
        .form-label { display: block; font-size: 12px; font-weight: 600; color: var(--text-secondary); margin-bottom: 6px; }
        .form-input, .form-textarea, .form-select {
            width: 100%; background: var(--bg-dark); border: 1px solid var(--border);
            border-radius: 10px; padding: 10px 14px; font-size: 14px;
            color: var(--text-primary); outline: none;
            transition: border-color 0.2s;
        }
        .form-input:focus, .form-textarea:focus, .form-select:focus { border-color: var(--accent); }
        .form-textarea { min-height: 120px; resize: vertical; }
        .form-error { font-size: 11px; color: #f87171; margin-top: 4px; }

        /* ── Alert flash ── */
        .flash-success {
            padding: 12px 16px; border-radius: 10px; margin-bottom: 20px;
            background: rgba(34,197,94,0.1); border: 1px solid rgba(34,197,94,0.25);
            color: #4ade80; font-size: 13px; font-weight: 500;
        }
        .flash-error {
            padding: 12px 16px; border-radius: 10px; margin-bottom: 20px;
            background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.25);
            color: #f87171; font-size: 13px; font-weight: 500;
        }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: var(--border); border-radius: 99px; }

        /* Toggle switch */
        .toggle { position: relative; display: inline-block; width: 38px; height: 22px; }
        .toggle input { opacity: 0; width: 0; height: 0; }
        .toggle-slider {
            position: absolute; inset: 0; cursor: pointer;
            background: rgba(255,255,255,0.1); border-radius: 99px;
            transition: 0.2s;
        }
        .toggle-slider:before {
            content: ''; position: absolute;
            width: 16px; height: 16px; left: 3px; bottom: 3px;
            background: white; border-radius: 50%; transition: 0.2s;
        }
        input:checked + .toggle-slider { background: var(--accent); }
        input:checked + .toggle-slider:before { transform: translateX(16px); }

        /* Pagination styling in manager portal */
        nav[role="navigation"] {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            font-size: 13px;
        }
        nav[role="navigation"] svg {
            width: 14px !important;
            height: 14px !important;
            max-width: 14px !important;
            max-height: 14px !important;
            display: inline-block;
        }
        nav[role="navigation"] a, nav[role="navigation"] span[aria-disabled], nav[role="navigation"] span[aria-current] {
            border-radius: 8px !important;
        }

        /* ── Hamburger button (hidden on desktop) ── */
        .sidebar-toggle-btn {
            display: none;
            align-items: center; justify-content: center;
            width: 40px; height: 40px;
            border-radius: 10px;
            background: var(--bg-hover);
            border: 1px solid var(--border);
            cursor: pointer;
            flex-shrink: 0;
            transition: background 0.15s;
        }
        .sidebar-toggle-btn:hover { background: rgba(255,255,255,0.1); }
        .sidebar-toggle-btn svg { width: 18px; height: 18px; color: var(--text-primary); }

        /* ── Overlay backdrop ── */
        .sidebar-overlay {
            display: none;
            position: fixed; inset: 0;
            background: rgba(0,0,0,0.6);
            backdrop-filter: blur(2px);
            z-index: 45;
            opacity: 0;
            transition: opacity 0.25s;
        }
        .sidebar-overlay.active { opacity: 1; }

        /* ════════════════════════════════════════════════════════════
           RESPONSIVE – MOBILE (≤768px)
        ════════════════════════════════════════════════════════════ */
        @media (max-width: 768px) {

            /* Sidebar: hidden off-screen by default */
            .sidebar {
                transform: translateX(-100%);
                width: min(var(--sidebar-w), 85vw);
                box-shadow: none;
            }

            /* Sidebar open state */
            body.sidebar-open .sidebar {
                transform: translateX(0);
                box-shadow: 4px 0 32px rgba(0,0,0,0.5);
            }

            body.sidebar-open .sidebar-overlay {
                display: block;
                opacity: 1;
            }

            /* Main content takes full width */
            .main-content { margin-left: 0; width: 100%; }

            /* Topbar */
            .topbar { padding: 0 16px; gap: 12px; }
            .topbar-title { font-size: 15px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
            .topbar-breadcrumb { display: none; }
            .sidebar-toggle-btn { display: flex; }

            /* Reduce page padding */
            .page-body { padding: 16px; }

            /* Tables: horizontal scroll */
            .data-table-wrap {
                margin: 0 -20px;
                padding: 0 20px;
            }

            /* Two-column detail layouts → stack vertically */
            [style*="grid-template-columns:1fr 340px"],
            [style*="grid-template-columns: 1fr 340px"] {
                display: flex !important;
                flex-direction: column !important;
                gap: 16px !important;
            }

            /* Stat values */
            .stat-value { font-size: 24px; }

            /* Stat grid — 2 columns on mobile */
            [style*="grid-template-columns:repeat(auto-fit"] {
                grid-template-columns: repeat(2, 1fr) !important;
            }

            /* Footer buttons */
            .sidebar-footer [style*="display:flex;gap:8px"] {
                flex-direction: column;
            }
        }

        /* Extra-small phones */
        @media (max-width: 480px) {
            [style*="grid-template-columns:repeat(auto-fit"] {
                grid-template-columns: 1fr !important;
            }
            .stat-value { font-size: 22px; }
            .page-body { padding: 12px; }
        }

        /* ════════════════════════════════════════════════════════════
           MAI — Monarch AI Chat Panel
        ════════════════════════════════════════════════════════════ */
        .mai-panel {
            position: fixed; inset: 0;
            z-index: 200;
            display: flex;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s cubic-bezier(0.4,0,0.2,1);
        }
        .mai-panel.open { opacity: 1; pointer-events: all; }

        .mai-backdrop {
            position: absolute; inset: 0;
            background: rgba(0,0,0,0.75);
            backdrop-filter: blur(4px);
        }

        .mai-drawer {
            position: relative;
            margin-left: auto;
            width: 100%;
            max-width: 780px;
            height: 100%;
            background: #0d0d0d;
            border-left: 1px solid rgba(255,255,255,0.08);
            display: flex;
            flex-direction: column;
            transform: translateX(40px);
            transition: transform 0.3s cubic-bezier(0.16,1,0.3,1);
            box-shadow: -20px 0 60px rgba(0,0,0,0.5);
        }
        .mai-panel.open .mai-drawer { transform: translateX(0); }

        /* Header */
        .mai-header {
            padding: 18px 24px;
            border-bottom: 1px solid rgba(255,255,255,0.07);
            display: flex;
            align-items: center;
            gap: 12px;
            flex-shrink: 0;
            background: rgba(255,255,255,0.02);
        }
        .mai-logo {
            width: 36px; height: 36px;
            border-radius: 10px;
            background: linear-gradient(135deg, rgba(41,151,255,0.25), rgba(99,102,241,0.25));
            border: 1px solid rgba(41,151,255,0.35);
            display: flex; align-items: center; justify-content: center;
            font-size: 16px; flex-shrink: 0;
        }
        .mai-title { font-size: 15px; font-weight: 700; color: var(--text-primary); }
        .mai-subtitle { font-size: 10px; color: var(--text-muted); margin-top: 1px; letter-spacing: 0.04em; }
        .mai-status {
            margin-left: auto;
            display: flex; align-items: center; gap: 6px;
            font-size: 11px; color: var(--text-muted);
        }
        .mai-status-dot {
            width: 7px; height: 7px; border-radius: 50%;
            background: #4ade80;
            box-shadow: 0 0 6px rgba(74,222,128,0.6);
        }
        .mai-close-btn {
            width: 32px; height: 32px; border-radius: 8px;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.08);
            color: var(--text-muted);
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; transition: all 0.15s;
            font-size: 16px; flex-shrink: 0;
        }
        .mai-close-btn:hover { background: rgba(255,255,255,0.12); color: var(--text-primary); }

        /* Messages */
        .mai-messages {
            flex: 1;
            overflow-y: auto;
            padding: 24px;
            display: flex;
            flex-direction: column;
            gap: 20px;
            scrollbar-width: thin;
        }
        .mai-messages::-webkit-scrollbar { width: 4px; }
        .mai-messages::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 4px; }

        /* Welcome / empty state */
        .mai-welcome {
            text-align: center;
            padding: 40px 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 16px;
        }
        .mai-welcome-icon {
            width: 64px; height: 64px; border-radius: 20px;
            background: linear-gradient(135deg, rgba(41,151,255,0.2), rgba(99,102,241,0.2));
            border: 1px solid rgba(41,151,255,0.3);
            display: flex; align-items: center; justify-content: center;
            font-size: 28px;
        }
        .mai-welcome h3 {
            font-size: 18px; font-weight: 700;
            color: var(--text-primary); margin: 0;
        }
        .mai-welcome p {
            font-size: 13px; color: var(--text-muted);
            max-width: 380px; line-height: 1.6; margin: 0;
        }
        .mai-prompts {
            display: flex; flex-wrap: wrap; gap: 8px;
            justify-content: center; margin-top: 8px;
        }
        .mai-prompt-chip {
            padding: 7px 14px;
            border-radius: 20px;
            font-size: 12px; font-weight: 500;
            color: var(--text-secondary);
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            cursor: pointer;
            transition: all 0.15s;
            text-align: left;
        }
        .mai-prompt-chip:hover {
            background: var(--accent-dim);
            color: var(--accent);
            border-color: rgba(41,151,255,0.3);
        }

        /* Message bubbles */
        .mai-msg { display: flex; gap: 10px; align-items: flex-start; }
        .mai-msg.user { flex-direction: row-reverse; }

        .mai-msg-avatar {
            width: 30px; height: 30px; border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-size: 12px; font-weight: 700; flex-shrink: 0;
        }
        .mai-msg.user .mai-msg-avatar {
            background: rgba(41,151,255,0.15);
            color: var(--accent);
            border: 1px solid rgba(41,151,255,0.25);
        }
        .mai-msg.assistant .mai-msg-avatar {
            background: linear-gradient(135deg, rgba(41,151,255,0.2), rgba(99,102,241,0.2));
            border: 1px solid rgba(41,151,255,0.3);
            font-size: 14px;
        }

        .mai-msg-body { flex: 1; min-width: 0; max-width: 88%; }
        .mai-msg.user .mai-msg-body { max-width: 75%; }

        .mai-bubble {
            padding: 12px 16px;
            border-radius: 14px;
            font-size: 13.5px;
            line-height: 1.65;
        }
        .mai-msg.user .mai-bubble {
            background: rgba(41,151,255,0.15);
            border: 1px solid rgba(41,151,255,0.2);
            color: var(--text-primary);
            border-top-right-radius: 4px;
        }
        .mai-msg.assistant .mai-bubble {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            color: var(--text-secondary);
            border-top-left-radius: 4px;
        }

        /* Answer text markdown styles */
        .mai-answer h1, .mai-answer h2, .mai-answer h3 {
            color: var(--text-primary); margin: 12px 0 6px;
        }
        .mai-answer h1 { font-size: 16px; }
        .mai-answer h2 { font-size: 14px; }
        .mai-answer h3 { font-size: 13px; }
        .mai-answer p { margin: 6px 0; }
        .mai-answer ul, .mai-answer ol { padding-left: 20px; margin: 6px 0; }
        .mai-answer li { margin: 3px 0; }
        .mai-answer strong { color: var(--text-primary); }
        .mai-answer code {
            background: rgba(255,255,255,0.07);
            padding: 1px 5px; border-radius: 4px;
            font-family: monospace; font-size: 12px;
        }
        .mai-answer table {
            width: 100%; border-collapse: collapse;
            font-size: 12px; margin: 10px 0;
        }
        .mai-answer th {
            background: rgba(255,255,255,0.07);
            padding: 6px 10px; text-align: left;
            color: var(--text-muted); font-size: 10px;
            text-transform: uppercase; letter-spacing: 0.06em;
        }
        .mai-answer td {
            padding: 8px 10px; border-bottom: 1px solid rgba(255,255,255,0.06);
            color: var(--text-secondary);
        }

        /* Thinking panels (collapsible) */
        .mai-thinking-panels { margin-top: 10px; display: flex; flex-direction: column; gap: 6px; }

        .mai-panel-toggle {
            display: flex; align-items: center; gap: 6px;
            font-size: 11px; color: var(--text-muted);
            cursor: pointer; padding: 5px 8px;
            border-radius: 6px;
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.06);
            transition: all 0.15s;
            user-select: none;
            width: 100%;
        }
        .mai-panel-toggle:hover { background: rgba(255,255,255,0.07); color: var(--text-secondary); }
        .mai-panel-toggle .arrow { transition: transform 0.2s; font-size: 9px; }
        .mai-panel-toggle.open .arrow { transform: rotate(90deg); }

        .mai-panel-body {
            display: none;
            padding: 10px 12px;
            background: rgba(255,255,255,0.02);
            border: 1px solid rgba(255,255,255,0.06);
            border-radius: 8px;
            font-size: 12px;
            color: var(--text-muted);
            line-height: 1.6;
            margin-top: 2px;
            overflow-x: auto;
        }
        .mai-panel-body.open { display: block; }

        .mai-sql-code {
            font-family: 'Courier New', monospace;
            font-size: 11.5px;
            color: #7dd3fc;
            white-space: pre-wrap;
            word-break: break-all;
        }

        .mai-results-count {
            display: inline-flex; align-items: center; gap: 4px;
            background: rgba(74,222,128,0.1);
            color: #4ade80;
            border: 1px solid rgba(74,222,128,0.2);
            border-radius: 99px;
            padding: 1px 8px;
            font-size: 10px; font-weight: 700;
            margin-bottom: 8px;
        }

        .mai-results-table {
            width: 100%; border-collapse: collapse;
            font-size: 11px;
        }
        .mai-results-table th {
            font-size: 9px; text-transform: uppercase; letter-spacing: 0.06em;
            color: var(--text-muted); padding: 5px 8px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            text-align: left;
        }
        .mai-results-table td {
            padding: 5px 8px;
            border-bottom: 1px solid rgba(255,255,255,0.04);
            color: rgba(245,245,247,0.5);
            max-width: 160px;
            overflow: hidden; text-overflow: ellipsis; white-space: nowrap;
        }

        /* Typing indicator */
        .mai-typing {
            display: flex; gap: 4px; align-items: center;
            padding: 12px 16px;
        }
        .mai-typing span {
            width: 7px; height: 7px; border-radius: 50%;
            background: rgba(41,151,255,0.5);
            animation: maiTyping 1.4s infinite;
        }
        .mai-typing span:nth-child(2) { animation-delay: 0.2s; }
        .mai-typing span:nth-child(3) { animation-delay: 0.4s; }
        @keyframes maiTyping {
            0%, 80%, 100% { opacity: 0.3; transform: scale(0.85); }
            40% { opacity: 1; transform: scale(1); }
        }

        /* Input area */
        .mai-input-area {
            padding: 16px 20px;
            border-top: 1px solid rgba(255,255,255,0.07);
            flex-shrink: 0;
            background: rgba(255,255,255,0.01);
        }
        .mai-input-row {
            display: flex; gap: 10px; align-items: flex-end;
        }
        .mai-input {
            flex: 1;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 12px;
            padding: 10px 14px;
            font-size: 13.5px;
            color: var(--text-primary);
            resize: none;
            outline: none;
            min-height: 44px;
            max-height: 140px;
            font-family: 'Inter', sans-serif;
            transition: border-color 0.2s;
            line-height: 1.5;
        }
        .mai-input:focus { border-color: rgba(41,151,255,0.4); }
        .mai-input::placeholder { color: var(--text-muted); }

        .mai-send-btn {
            width: 44px; height: 44px; border-radius: 12px;
            background: var(--accent);
            border: none; cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
            transition: all 0.15s;
        }
        .mai-send-btn:hover { background: #1a7de3; transform: scale(1.04); }
        .mai-send-btn:disabled { background: rgba(41,151,255,0.3); cursor: not-allowed; transform: none; }
        .mai-send-btn svg { width: 18px; height: 18px; color: white; }

        .mai-input-hint {
            font-size: 10px; color: var(--text-muted);
            margin-top: 6px; text-align: center;
        }

        /* Sidebar MAI tab glow */
        .sidebar-tab.mai-tab {
            background: linear-gradient(135deg, rgba(41,151,255,0.08), rgba(99,102,241,0.08));
            border-color: rgba(41,151,255,0.2) !important;
        }
        .sidebar-tab.mai-tab:hover {
            background: linear-gradient(135deg, rgba(41,151,255,0.15), rgba(99,102,241,0.15));
            border-color: rgba(41,151,255,0.35) !important;
        }

        /* Error bubble */
        .mai-error-bubble {
            background: rgba(239,68,68,0.08);
            border: 1px solid rgba(239,68,68,0.2);
            color: #f87171;
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 12.5px;
        }

        /* Header actions */
        .mai-header-actions {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-left: auto;
        }
        .mai-hdr-btn {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 9px;
            border-radius: 8px;
            font-size: 11.5px;
            font-weight: 500;
            color: var(--text-secondary);
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.08);
            cursor: pointer;
            transition: all 0.15s;
        }
        .mai-hdr-btn:hover {
            background: rgba(255,255,255,0.1);
            color: var(--text-primary);
            border-color: rgba(255,255,255,0.15);
        }
        .mai-hdr-btn.active {
            background: var(--accent-dim);
            color: var(--accent);
            border-color: rgba(41,151,255,0.35);
        }
        .mai-history-count {
            padding: 1px 6px;
            border-radius: 99px;
            background: rgba(255,255,255,0.08);
            font-size: 10px;
            font-weight: 600;
            color: var(--text-muted);
        }
        .mai-hdr-btn.active .mai-history-count {
            background: rgba(41,151,255,0.2);
            color: var(--accent);
        }

        /* Views */
        .mai-view {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 0;
            height: 100%;
        }

        /* History view */
        .mai-history-view {
            padding: 20px 24px;
            overflow-y: auto;
            background: #0f0f11;
            scrollbar-width: thin;
        }
        .mai-history-view::-webkit-scrollbar { width: 4px; }
        .mai-history-view::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 4px; }
        .mai-history-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
            padding-bottom: 12px;
            border-bottom: 1px solid rgba(255,255,255,0.06);
        }
        .mai-history-title {
            font-size: 14px;
            font-weight: 700;
            color: var(--text-primary);
        }
        .mai-history-subtitle {
            font-size: 11px;
            color: var(--text-muted);
            margin-top: 2px;
        }
        .mai-btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 6px 12px;
            border-radius: 8px;
            background: linear-gradient(135deg, #2997ff, #0071e3);
            color: #fff;
            font-size: 11.5px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: opacity 0.15s;
        }
        .mai-btn-primary:hover { opacity: 0.9; }

        .mai-history-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        .mai-history-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 14px;
            border-radius: 10px;
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.06);
            cursor: pointer;
            transition: all 0.15s;
            text-align: left;
        }
        .mai-history-item:hover {
            background: rgba(255,255,255,0.06);
            border-color: rgba(41,151,255,0.25);
            transform: translateX(2px);
        }
        .mai-history-item.active {
            background: var(--accent-dim);
            border-color: rgba(41,151,255,0.35);
        }
        .mai-history-item-left {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 0;
            flex: 1;
        }
        .mai-history-item-icon {
            width: 30px;
            height: 30px;
            border-radius: 8px;
            background: rgba(41,151,255,0.1);
            border: 1px solid rgba(41,151,255,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            color: var(--accent);
            flex-shrink: 0;
        }
        .mai-history-item-title {
            font-size: 12.5px;
            font-weight: 500;
            color: var(--text-primary);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .mai-history-item-meta {
            font-size: 10.5px;
            color: var(--text-muted);
            margin-top: 2px;
        }
        .mai-history-delete-btn {
            background: transparent;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            padding: 6px;
            border-radius: 6px;
            transition: all 0.15s;
            opacity: 0.5;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .mai-history-item:hover .mai-history-delete-btn { opacity: 1; }
        .mai-history-delete-btn:hover {
            background: rgba(239,68,68,0.15);
            color: #f87171;
        }
        .mai-history-empty {
            text-align: center;
            padding: 50px 20px;
            color: var(--text-muted);
            font-size: 13px;
        }
        .mai-msg-time {
            font-size: 10px;
            color: var(--text-muted);
            margin-top: 4px;
        }

        @media (max-width: 768px) {
            .mai-drawer { max-width: 100%; border-left: none; }
            .mai-messages { padding: 16px; }
            .mai-input-area { padding: 12px 16px; }
        }
    </style>
</head>
<body>

{{-- ════════════════════════════════════════════════════════════════
     OVERLAY BACKDROP (mobile only)
═════════════════════════════════════════════════════════════════ --}}
<div class="sidebar-overlay" id="sidebarOverlay" aria-hidden="true"></div>

{{-- ════════════════════════════════════════════════════════════════
     SIDEBAR
═════════════════════════════════════════════════════════════════ --}}
<aside class="sidebar" id="managerSidebar">

    {{-- Logo --}}
    <div class="sidebar-logo">
        <a href="{{ route('manager') }}" style="display:flex;align-items:center;gap:12px;text-decoration:none;color:inherit;min-width:0;">
            <img src="{{ asset('images/logo-white.png') }}" alt="MonarchI Logo" style="height:32px;width:auto;max-width:38px;object-fit:contain;flex-shrink:0;" />
            <div style="min-width:0;">
                <div class="logo-text" style="line-height:1.2;">MonarchI</div>
            </div>
        </a>
    </div>

    {{-- ── Portal Tabs (top of sidebar) ── --}}
    <div class="sidebar-tabs">
        <div class="sidebar-tabs-label">Portals</div>

        @if(auth()->user()->isContentManager())
        <a href="{{ route('manager.content.index') }}"
           class="sidebar-tab {{ request()->is('manager/content*') ? 'active' : '' }}">
            <div class="tab-icon">✦</div>
            <span>Content</span>
        </a>
        @endif

        @if(auth()->user()->isStoreManager())
        <a href="{{ route('manager.store.index') }}"
           class="sidebar-tab {{ request()->is('manager/store*') ? 'active' : '' }}">
            <div class="tab-icon">🛒</div>
            <span>Store</span>
        </a>
        @endif

        @if(auth()->user()->isHrManager())
        <a href="{{ route('manager.hr.index') }}"
           class="sidebar-tab {{ request()->is('manager/hr*') ? 'active' : '' }}">
            <div class="tab-icon">👥</div>
            <span>HR</span>
            @php $newMsgs = \App\Models\ContactMessage::where('status','new')->count(); @endphp
            @if($newMsgs > 0)
            <span class="badge" style="background:#2997ff;color:#fff;border:none;padding:1px 6px;font-size:9px;margin-left:auto;">{{ $newMsgs }}</span>
            @endif
        </a>
        @endif

        @if(auth()->user()->canManageEmployees())
        <a href="{{ route('manager.employees.index') }}"
           class="sidebar-tab {{ request()->is('manager/employees*') ? 'active' : '' }}">
            <div class="tab-icon">🔐</div>
            <span>Employees</span>
        </a>
        @endif

        {{-- MAI — Monarch AI Assistant (super admin only) --}}
        @if(auth()->user()->isSuperAdmin())
        <button type="button" onclick="maiOpen()" class="sidebar-tab mai-tab" id="maiSidebarBtn" aria-label="Open MAI Chat">
            <div class="tab-icon" style="font-size:17px;">✦</div>
            <span style="background:linear-gradient(90deg,#2997ff,#818cf8);-webkit-background-clip:text;-webkit-text-fill-color:transparent;font-weight:700;">MAI</span>
            <span style="margin-left:auto;font-size:9px;padding:1px 6px;border-radius:99px;background:linear-gradient(135deg,rgba(41,151,255,0.2),rgba(99,102,241,0.2));color:#818cf8;border:1px solid rgba(99,102,241,0.3);-webkit-text-fill-color:#818cf8;">AI</span>
        </button>
        @endif
    </div>

    {{-- ── Context Nav (changes by active portal) ── --}}
    <nav class="sidebar-nav">
        {{ $sidebarNav ?? '' }}
    </nav>

    {{-- ── Footer: User Card + Links ── --}}
    <div class="sidebar-footer">
        <div class="user-card">
            <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</div>
            <div style="min-width:0">
                <div class="user-name" style="overflow:hidden;text-overflow:ellipsis;white-space:nowrap">{{ auth()->user()->name }}</div>
                <div class="user-role">{{ auth()->user()->roleLabel() }}</div>
            </div>
        </div>
        <div style="display:flex;gap:8px;margin-top:10px">
            <a href="{{ route('dashboard') }}" class="btn btn-secondary btn-sm" style="flex:1;justify-content:center">← Dashboard</a>
            <form method="POST" action="{{ route('manager.logout') }}" style="flex:1">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm" style="width:100%;justify-content:center">Logout</button>
            </form>
        </div>
    </div>
</aside>

{{-- ════════════════════════════════════════════════════════════════
     MAIN CONTENT
═════════════════════════════════════════════════════════════════ --}}
<div class="main-content">
    <header class="topbar">
        {{-- Hamburger (mobile only) --}}
        <button class="sidebar-toggle-btn" id="sidebarToggle" aria-label="Toggle navigation" aria-expanded="false" aria-controls="managerSidebar">
            <svg fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true">
                <line x1="3" y1="6"  x2="21" y2="6"/>
                <line x1="3" y1="12" x2="21" y2="12"/>
                <line x1="3" y1="18" x2="21" y2="18"/>
            </svg>
        </button>

        <div style="min-width:0;flex:1">
            <div class="topbar-title">{{ $pageTitle ?? 'Manager Portal' }}</div>
            <div class="topbar-breadcrumb">{{ $breadcrumb ?? 'MonarchI HQ' }}</div>
        </div>
        <div style="display:flex;align-items:center;gap:12px;flex-shrink:0">
            {{ $topbarActions ?? '' }}
            <a href="{{ url('/') }}" target="_blank"
               style="font-size:12px;color:var(--text-muted);text-decoration:none;display:flex;align-items:center;gap:4px">
                View Site ↗
            </a>
        </div>
    </header>

    <main class="page-body">
        @if(session('success'))
        <div class="flash-success">✓ {{ session('success') }}</div>
        @endif
        @if(session('error'))
        <div class="flash-error">⚠ {{ session('error') }}</div>
        @endif
        @if($errors->any())
        <div class="flash-error">
            <ul style="margin:0;padding-left:16px">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        {{ $slot }}
    </main>
</div>

<script>
(function () {
    var toggle  = document.getElementById('sidebarToggle');
    var sidebar = document.getElementById('managerSidebar');
    var overlay = document.getElementById('sidebarOverlay');
    var body    = document.body;
    var BP      = 768;

    function openSidebar() {
        body.classList.add('sidebar-open');
        overlay.classList.add('active');
        toggle.setAttribute('aria-expanded', 'true');
        body.style.overflow = 'hidden';
    }

    function closeSidebar() {
        body.classList.remove('sidebar-open');
        overlay.classList.remove('active');
        toggle.setAttribute('aria-expanded', 'false');
        body.style.overflow = '';
    }

    function isOpen() { return body.classList.contains('sidebar-open'); }

    toggle.addEventListener('click', function () {
        isOpen() ? closeSidebar() : openSidebar();
    });

    overlay.addEventListener('click', closeSidebar);

    sidebar.querySelectorAll('a').forEach(function (link) {
        link.addEventListener('click', function () {
            if (window.innerWidth <= BP) closeSidebar();
        });
    });

    window.addEventListener('resize', function () {
        if (window.innerWidth > BP && isOpen()) closeSidebar();
    });

    /* Wrap all data-tables in a scroll container on mobile */
    function wrapTables() {
        if (window.innerWidth > BP) return;
        document.querySelectorAll('.data-table').forEach(function (table) {
            if (table.parentElement.classList.contains('data-table-wrap')) return;
            var wrap = document.createElement('div');
            wrap.className = 'data-table-wrap';
            table.parentNode.insertBefore(wrap, table);
            wrap.appendChild(table);
        });
    }

    wrapTables();
    window.addEventListener('resize', wrapTables);
})();
</script>

@if(auth()->user()->isSuperAdmin())
{{-- ════════════════════════════════════════════════════════════════
     MAI — Monarch AI Chat Panel (Super Admin Only)
═════════════════════════════════════════════════════════════════ --}}
<div class="mai-panel" id="maiPanel" role="dialog" aria-modal="true" aria-label="MAI — Monarch AI">
    <div class="mai-backdrop" id="maiBackdrop"></div>
    <div class="mai-drawer" id="maiDrawer">

        {{-- Header --}}
        <div class="mai-header">
            <div class="mai-logo">✦</div>
            <div style="min-width:0;">
                <div class="mai-title">MAI &mdash; Monarch AI</div>
                <div class="mai-subtitle">SUPER ADMIN &bull; CONTEXT-AWARE</div>
            </div>

            <div class="mai-header-actions">
                <button type="button" class="mai-hdr-btn" onclick="maiNewChat()" id="maiNewChatBtn" title="Start a fresh conversation">
                    <span style="font-size:13px;font-weight:700;">+</span>
                    <span>New Chat</span>
                </button>
                <button type="button" class="mai-hdr-btn" onclick="maiToggleHistory()" id="maiHistoryBtn" title="View past chat history">
                    <svg style="width:12px;height:12px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span id="maiHistoryBtnLabel">History</span>
                    <span class="mai-history-count" id="maiConvCount">0</span>
                </button>
            </div>

            <button type="button" class="mai-close-btn" onclick="maiClose()" aria-label="Close MAI">✕</button>
        </div>

        {{-- ── Chat View ── --}}
        <div class="mai-view mai-chat-view" id="maiChatView">
            {{-- Messages feed --}}
            <div class="mai-messages" id="maiMessages">

                {{-- Welcome state (hidden once chat begins) --}}
                <div class="mai-welcome" id="maiWelcome">
                    <div class="mai-welcome-icon">✦</div>
                    <h3>Hi, {{ explode(' ', auth()->user()->name)[0] }}. I'm MAI.</h3>
                    <p>I can query the MonarchI database in real-time to answer your questions. Ask me anything about orders, products, staff, messages, or analytics.</p>
                    <div class="mai-prompts" id="maiPrompts">
                        <button class="mai-prompt-chip" onclick="maiUsePrompt(this)">How many pending orders do we have?</button>
                        <button class="mai-prompt-chip" onclick="maiUsePrompt(this)">Which products are low on stock?</button>
                        <button class="mai-prompt-chip" onclick="maiUsePrompt(this)">What's our total revenue this month?</button>
                        <button class="mai-prompt-chip" onclick="maiUsePrompt(this)">Show me the top 5 best-selling products</button>
                        <button class="mai-prompt-chip" onclick="maiUsePrompt(this)">How many new contact messages are unread?</button>
                        <button class="mai-prompt-chip" onclick="maiUsePrompt(this)">List all active job listings</button>
                        <button class="mai-prompt-chip" onclick="maiUsePrompt(this)">How many employees do we have?</button>
                        <button class="mai-prompt-chip" onclick="maiUsePrompt(this)">How many published articles do we have?</button>
                        <button class="mai-prompt-chip" onclick="maiUsePrompt(this)">List all live portfolio projects</button>
                        <button class="mai-prompt-chip" onclick="maiUsePrompt(this)">Give me a full business overview</button>
                    </div>
                </div>
            </div>

            {{-- Input area --}}
            <div class="mai-input-area">
                <div class="mai-input-row">
                    <textarea
                        id="maiInput"
                        class="mai-input"
                        placeholder="Ask MAI anything about the business…"
                        rows="1"
                        aria-label="Message MAI"
                    ></textarea>
                    <button class="mai-send-btn" id="maiSendBtn" onclick="maiSend()" aria-label="Send message">
                        <svg fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <line x1="22" y1="2" x2="11" y2="13"/>
                            <polygon points="22 2 15 22 11 13 2 9 22 2"/>
                        </svg>
                    </button>
                </div>
                <div class="mai-input-hint">Enter to send &bull; Shift+Enter for new line &bull; MAI only runs read-only queries</div>
            </div>
        </div>

        {{-- ── History View ── --}}
        <div class="mai-view mai-history-view" id="maiHistoryView" style="display:none;">
            <div class="mai-history-header">
                <div>
                    <div class="mai-history-title">Conversation History</div>
                    <div class="mai-history-subtitle">Review past queries, reasoning &amp; AI answers</div>
                </div>
                <button type="button" class="mai-btn-primary" onclick="maiNewChat()">
                    <span>+ New Chat</span>
                </button>
            </div>
            <div class="mai-history-list" id="maiHistoryList">
                {{-- Injected dynamically --}}
            </div>
        </div>

    </div>
</div>

<script>
// ══════════════════════════════════════════════════════════════════
//  MAI — Monarch AI Chat Engine (Super Admin Only)
// ══════════════════════════════════════════════════════════════════
(function () {
    'use strict';

    var MAI_CHAT_URL     = '{{ route("manager.mai.chat") }}';
    var MAI_CONVS_URL    = '{{ route("manager.mai.conversations") }}';
    var MAI_CONV_BASE    = '{{ url("/manager/mai/conversations") }}';
    var MAI_TOKEN        = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    var USER_INIT        = '{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}';

    var currentConvId    = null;
    var history          = [];
    var conversations    = [];
    var isLoading        = false;
    var activeView       = 'chat'; // 'chat' | 'history'

    // ── DOM refs ───────────────────────────────────────────────────
    var panel            = document.getElementById('maiPanel');
    var backdrop         = document.getElementById('maiBackdrop');
    var chatView         = document.getElementById('maiChatView');
    var historyView      = document.getElementById('maiHistoryView');
    var historyList      = document.getElementById('maiHistoryList');
    var messages         = document.getElementById('maiMessages');
    var welcome          = document.getElementById('maiWelcome');
    var input            = document.getElementById('maiInput');
    var sendBtn          = document.getElementById('maiSendBtn');
    var historyBtn       = document.getElementById('maiHistoryBtn');
    var historyCountEl   = document.getElementById('maiConvCount');

    // Store welcome HTML for resetting chat
    var welcomeHtml      = welcome ? welcome.outerHTML : '';

    // ── Open / Close ──────────────────────────────────────────────
    window.maiOpen = function () {
        panel.classList.add('open');
        document.body.style.overflow = 'hidden';
        maiShowView('chat');
        maiFetchConversations();
        input.focus();
    };

    window.maiClose = function () {
        panel.classList.remove('open');
        document.body.style.overflow = '';
    };

    // Close on backdrop click
    backdrop.addEventListener('click', window.maiClose);

    // Escape key
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && panel.classList.contains('open')) {
            window.maiClose();
        }
    });

    // ── View Switching ─────────────────────────────────────────────
    function maiShowView(view) {
        activeView = view;
        if (view === 'history') {
            chatView.style.display = 'none';
            historyView.style.display = 'block';
            historyBtn.classList.add('active');
        } else {
            historyView.style.display = 'none';
            chatView.style.display = 'flex';
            historyBtn.classList.remove('active');
            input.focus();
        }
    }

    window.maiToggleHistory = function () {
        if (activeView === 'history') {
            maiShowView('chat');
        } else {
            maiShowView('history');
            maiFetchConversations();
        }
    };

    // ── New Chat ──────────────────────────────────────────────────
    window.maiNewChat = function () {
        currentConvId = null;
        history       = [];
        messages.innerHTML = welcomeHtml;
        maiShowView('chat');
        input.value   = '';
        maiAutoResize();
        input.focus();
        maiHighlightActiveConv();
    };

    // ── Fetch Conversations List ──────────────────────────────────
    function maiFetchConversations() {
        fetch(MAI_CONVS_URL, {
            headers: {
                'X-CSRF-TOKEN': MAI_TOKEN,
                'Accept': 'application/json',
            }
        })
        .then(function (r) { return r.json(); })
        .then(function (res) {
            if (res.ok && res.conversations) {
                conversations = res.conversations;
                if (historyCountEl) historyCountEl.textContent = conversations.length;
                maiRenderHistoryList();
            }
        })
        .catch(function (err) {
            console.error('Failed to fetch MAI conversations:', err);
        });
    }

    function maiRenderHistoryList() {
        if (! historyList) return;

        if (conversations.length === 0) {
            historyList.innerHTML =
                '<div class="mai-history-empty">' +
                    '<div style="font-size:24px;margin-bottom:8px;">💬</div>' +
                    '<div style="font-weight:600;color:var(--text-secondary);margin-bottom:4px;">No Chat History Yet</div>' +
                    '<div>Start asking questions to build your AI history.</div>' +
                '</div>';
            return;
        }

        var html = '';
        conversations.forEach(function (c) {
            var isActive = (currentConvId === c.id);
            html +=
                '<div class="mai-history-item' + (isActive ? ' active' : '') + '" data-id="' + c.id + '" onclick="maiLoadConversation(' + c.id + ')">' +
                    '<div class="mai-history-item-left">' +
                        '<div class="mai-history-item-icon">✦</div>' +
                        '<div style="min-width:0;flex:1;">' +
                            '<div class="mai-history-item-title">' + escHtml(c.title || 'Untitled Chat') + '</div>' +
                            '<div class="mai-history-item-meta">' + escHtml(c.updated_at || c.created_at) + '</div>' +
                        '</div>' +
                    '</div>' +
                    '<button type="button" class="mai-history-delete-btn" onclick="maiDeleteConversation(event, ' + c.id + ')" title="Delete conversation" aria-label="Delete">' +
                        '<svg style="width:14px;height:14px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>' +
                    '</button>' +
                '</div>';
        });

        historyList.innerHTML = html;
    }

    function maiHighlightActiveConv() {
        if (! historyList) return;
        historyList.querySelectorAll('.mai-history-item').forEach(function (el) {
            var id = parseInt(el.getAttribute('data-id'), 10);
            el.classList.toggle('active', id === currentConvId);
        });
    }

    // ── Load Past Conversation ─────────────────────────────────────
    window.maiLoadConversation = function (id) {
        currentConvId = id;
        maiShowView('chat');
        maiHighlightActiveConv();

        // Show loading in messages
        messages.innerHTML =
            '<div style="text-align:center;padding:40px;color:var(--text-muted);font-size:13px;">' +
                '<div class="mai-typing" style="margin:0 auto 12px;display:inline-flex;"><span></span><span></span><span></span></div>' +
                '<div>Loading conversation...</div>' +
            '</div>';

        fetch(MAI_CONV_BASE + '/' + id, {
            headers: {
                'X-CSRF-TOKEN': MAI_TOKEN,
                'Accept': 'application/json',
            }
        })
        .then(function (r) { return r.json(); })
        .then(function (res) {
            if (! res.ok || ! res.messages) {
                messages.innerHTML = '';
                appendErrorMessage('Could not load conversation messages.');
                return;
            }

            messages.innerHTML = '';
            history = [];

            res.messages.forEach(function (m) {
                history.push({ role: m.role, content: m.content });
                if (m.role === 'user') {
                    appendUserMessage(m.content, m.created_at);
                } else {
                    appendAssistantMessage({
                        answer: m.content,
                        reasoning: m.reasoning,
                        sql: m.sql,
                        results_count: m.results_count,
                        results_preview: m.results_preview,
                    }, m.created_at);
                }
            });

            scrollBottom();
        })
        .catch(function (err) {
            console.error('Error loading conversation:', err);
            messages.innerHTML = '';
            appendErrorMessage('Failed to load conversation.');
        });
    };

    // ── Delete Conversation ────────────────────────────────────────
    window.maiDeleteConversation = function (e, id) {
        e.stopPropagation();
        if (! confirm('Delete this conversation from history?')) return;

        fetch(MAI_CONV_BASE + '/' + id, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': MAI_TOKEN,
                'Accept': 'application/json',
            }
        })
        .then(function (r) { return r.json(); })
        .then(function (res) {
            if (res.ok) {
                conversations = conversations.filter(function (c) { return c.id !== id; });
                if (historyCountEl) historyCountEl.textContent = conversations.length;
                maiRenderHistoryList();

                if (currentConvId === id) {
                    maiNewChat();
                }
            }
        })
        .catch(function (err) {
            console.error('Error deleting conversation:', err);
        });
    };

    // ── Prompt chips ──────────────────────────────────────────────
    window.maiUsePrompt = function (btn) {
        input.value = btn.textContent.trim();
        maiAutoResize();
        input.focus();
        maiSend();
    };

    // ── Send ──────────────────────────────────────────────────────
    window.maiSend = function () {
        var text = input.value.trim();
        if (! text || isLoading) return;

        // Remove welcome screen if visible
        var curWelcome = document.getElementById('maiWelcome');
        if (curWelcome) curWelcome.remove();

        // Append user bubble
        appendUserMessage(text);
        history.push({ role: 'user', content: text });

        // Clear input
        input.value = '';
        maiAutoResize();

        // Show typing indicator
        appendTyping();
        scrollBottom();
        setLoading(true);

        // Call backend
        fetch(MAI_CHAT_URL, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': MAI_TOKEN,
                'Accept': 'application/json',
            },
            body: JSON.stringify({
                message: text,
                conversation_id: currentConvId,
                history: history.slice(0, -1),
            }),
        })
        .then(function (res) {
            return res.json().then(function (data) {
                return { status: res.status, data: data };
            });
        })
        .then(function (result) {
            removeTyping();
            setLoading(false);

            if (result.status !== 200 || ! result.data.ok) {
                var err = (result.data && result.data.error)
                    ? result.data.error
                    : 'Server error (' + result.status + '). Please try again.';
                appendErrorMessage(err);
                return;
            }

            var d = result.data;
            if (d.conversation_id) {
                currentConvId = d.conversation_id;
                maiFetchConversations(); // refresh title & ordering in background
            }

            appendAssistantMessage(d);
            history.push({ role: 'assistant', content: d.answer });
            scrollBottom();
        })
        .catch(function (err) {
            removeTyping();
            setLoading(false);
            appendErrorMessage('Network error: ' + err.message);
        });
    };

    // ── Keyboard & Input ──────────────────────────────────────────
    input.addEventListener('keydown', function (e) {
        if (e.key === 'Enter' && ! e.shiftKey) {
            e.preventDefault();
            maiSend();
        }
    });

    input.addEventListener('input', maiAutoResize);

    function maiAutoResize() {
        input.style.height = 'auto';
        input.style.height = Math.min(input.scrollHeight, 140) + 'px';
    }

    // ── Message Renderers ──────────────────────────────────────────
    function appendUserMessage(text, time) {
        var msg = document.createElement('div');
        msg.className = 'mai-msg user';
        msg.innerHTML =
            '<div class="mai-msg-avatar">' + escHtml(USER_INIT) + '</div>' +
            '<div class="mai-msg-body">' +
                '<div class="mai-bubble">' + escHtml(text) + '</div>' +
                (time ? '<div class="mai-msg-time" style="text-align:right;">' + escHtml(time) + '</div>' : '') +
            '</div>';
        messages.appendChild(msg);
        scrollBottom();
    }

    function appendTyping() {
        var el = document.createElement('div');
        el.className = 'mai-msg assistant';
        el.id = 'maiTypingIndicator';
        el.innerHTML =
            '<div class="mai-msg-avatar">✦</div>' +
            '<div class="mai-msg-body">' +
                '<div class="mai-bubble"><div class="mai-typing"><span></span><span></span><span></span></div></div>' +
            '</div>';
        messages.appendChild(el);
    }

    function removeTyping() {
        var el = document.getElementById('maiTypingIndicator');
        if (el) el.remove();
    }

    function appendAssistantMessage(data, time) {
        var msg = document.createElement('div');
        msg.className = 'mai-msg assistant';

        var thinkingPanels = '';

        // Reasoning panel
        if (data.reasoning) {
            thinkingPanels += makePanelToggle(
                '🧠 Intent &amp; Reasoning',
                '<p style="white-space:pre-wrap;">' + escHtml(data.reasoning) + '</p>'
            );
        }

        // SQL panel
        if (data.sql) {
            thinkingPanels += makePanelToggle(
                '🗄️ SQL Query',
                '<div class="mai-sql-code">' + escHtml(data.sql) + '</div>'
            );
        }

        // Results panel
        if (data.results_preview && data.results_preview.length > 0) {
            var cols = Object.keys(data.results_preview[0]);
            var headerCells = cols.map(function (c) { return '<th>' + escHtml(c) + '</th>'; }).join('');
            var rows = data.results_preview.map(function (row) {
                var cells = cols.map(function (c) {
                    var val = row[c] !== null && row[c] !== undefined ? String(row[c]) : 'NULL';
                    return '<td title="' + escHtml(val) + '">' + escHtml(val.length > 30 ? val.slice(0, 30) + '…' : val) + '</td>';
                }).join('');
                return '<tr>' + cells + '</tr>';
            }).join('');

            var countBadge = '<div class="mai-results-count">✓ ' + data.results_count + ' row' + (data.results_count !== 1 ? 's' : '') + '</div>';
            thinkingPanels += makePanelToggle(
                '📊 Query Results',
                countBadge + '<div style="overflow-x:auto"><table class="mai-results-table"><thead><tr>' + headerCells + '</tr></thead><tbody>' + rows + '</tbody></table></div>'
            );
        } else if (data.sql && data.results_count === 0) {
            thinkingPanels += makePanelToggle('📊 Query Results', '<div class="mai-results-count">0 rows returned</div>');
        }

        msg.innerHTML =
            '<div class="mai-msg-avatar">✦</div>' +
            '<div class="mai-msg-body">' +
                '<div class="mai-bubble">' +
                    '<div class="mai-answer">' + renderMarkdown(data.answer) + '</div>' +
                    (thinkingPanels ? '<div class="mai-thinking-panels">' + thinkingPanels + '</div>' : '') +
                '</div>' +
                (time ? '<div class="mai-msg-time">' + escHtml(time) + '</div>' : '') +
            '</div>';

        messages.appendChild(msg);
        scrollBottom();
    }

    function appendErrorMessage(text) {
        var msg = document.createElement('div');
        msg.className = 'mai-msg assistant';
        msg.innerHTML =
            '<div class="mai-msg-avatar">✦</div>' +
            '<div class="mai-msg-body">' +
                '<div class="mai-error-bubble">⚠ ' + escHtml(text) + '</div>' +
            '</div>';
        messages.appendChild(msg);
        scrollBottom();
    }

    function makePanelToggle(label, bodyHtml) {
        var id = 'mai-panel-' + Math.random().toString(36).slice(2, 8);
        return '<button class="mai-panel-toggle" onclick="maiTogglePanel(\'' + id + '\', this)">' +
                    '<span class="arrow">▶</span>' +
                    '<span>' + label + '</span>' +
               '</button>' +
               '<div class="mai-panel-body" id="' + id + '">' + bodyHtml + '</div>';
    }

    window.maiTogglePanel = function (id, btn) {
        var body = document.getElementById(id);
        if (! body) return;
        var open = body.classList.toggle('open');
        btn.classList.toggle('open', open);
    };

    // ── Helpers ───────────────────────────────────────────────────
    function setLoading(loading) {
        isLoading = loading;
        sendBtn.disabled = loading;
        input.disabled = loading;
    }

    function scrollBottom() {
        setTimeout(function () {
            messages.scrollTop = messages.scrollHeight;
        }, 40);
    }

    function escHtml(str) {
        return String(str)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    /**
     * Minimal markdown → HTML renderer for MAI answers.
     * Handles: headers, bold, italic, code, tables, lists, line breaks.
     */
    function renderMarkdown(md) {
        if (! md) return '';
        var html = md;

        // Code blocks
        html = html.replace(/```[\w]*\n?([\s\S]*?)```/g, function (_, code) {
            return '<pre style="background:rgba(255,255,255,0.05);padding:10px;border-radius:8px;overflow-x:auto;font-size:11.5px;color:#7dd3fc;font-family:monospace;white-space:pre-wrap;">' + escHtml(code.trim()) + '</pre>';
        });

        // Inline code
        html = html.replace(/`([^`]+)`/g, '<code>$1</code>');

        // Headers
        html = html.replace(/^### (.+)$/gm, '<h3>$1</h3>');
        html = html.replace(/^## (.+)$/gm, '<h2>$1</h2>');
        html = html.replace(/^# (.+)$/gm, '<h1>$1</h1>');

        // Bold
        html = html.replace(/\*\*(.+?)\*\*/g, '<strong>$1</strong>');

        // Italic
        html = html.replace(/\*(.+?)\*/g, '<em>$1</em>');

        // Tables (simple: | col | col |)
        html = html.replace(/((?:\|.+\|\n?)+)/g, function (table) {
            var lines = table.trim().split('\n');
            var result = '<table>';
            var isHeader = true;
            lines.forEach(function (line) {
                if (/^\|[-|\s]+\|$/.test(line.trim())) { isHeader = false; return; }
                var cells = line.trim().replace(/^\||\|$/g, '').split('|');
                var tag = isHeader ? 'th' : 'td';
                result += '<tr>' + cells.map(function (c) { return '<' + tag + '>' + c.trim() + '</' + tag + '>'; }).join('') + '</tr>';
                if (isHeader) isHeader = false;
            });
            return result + '</table>';
        });

        // Unordered lists
        html = html.replace(/((?:^[-*] .+\n?)+)/gm, function (list) {
            var items = list.trim().split('\n').map(function (l) {
                return '<li>' + l.replace(/^[-*] /, '') + '</li>';
            }).join('');
            return '<ul>' + items + '</ul>';
        });

        // Ordered lists
        html = html.replace(/((?:^\d+\. .+\n?)+)/gm, function (list) {
            var items = list.trim().split('\n').map(function (l) {
                return '<li>' + l.replace(/^\d+\. /, '') + '</li>';
            }).join('');
            return '<ol>' + items + '</ol>';
        });

        // Paragraphs
        html = html.replace(/\n\n+/g, '</p><p>');
        html = html.replace(/\n/g, '<br>');
        html = '<p>' + html + '</p>';

        return html;
    }

})();
</script>
@endif

</body>
</html>
