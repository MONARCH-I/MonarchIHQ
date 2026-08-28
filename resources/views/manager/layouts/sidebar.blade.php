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
    </style>
</head>
<body>

{{-- ════════════════════════════════════════════════════════════════
     SIDEBAR
═════════════════════════════════════════════════════════════════ --}}
<aside class="sidebar">

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
        <div>
            <div class="topbar-title">{{ $pageTitle ?? 'Manager Portal' }}</div>
            <div class="topbar-breadcrumb">{{ $breadcrumb ?? 'MonarchI HQ' }}</div>
        </div>
        <div style="display:flex;align-items:center;gap:12px">
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

</body>
</html>
