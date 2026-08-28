<x-main-layout :showFooter="false">

<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

    /* ── Dashboard shell ── */
    .db-shell {
        height: 100vh;
        padding-top: 48px; /* height of the fixed nav */
        background: var(--bg-primary);
        font-family: 'Inter', sans-serif;
        box-sizing: border-box;
        overflow: hidden;
    }

    .db-inner {
        width: 100%;
        display: flex;
        gap: 0;
        height: 100%;
    }

    /* ── Sidebar ── */
    .db-sidebar {
        width: 260px;
        flex-shrink: 0;
        border-right: 1px solid var(--border-subtle);
        padding: 2rem 0;
        position: relative;
        height: 100%;
        overflow-y: auto;
        scrollbar-width: none;
        -ms-overflow-style: none;
        background: var(--bg-secondary);
        display: flex;
        flex-direction: column;
    }
    .db-sidebar::-webkit-scrollbar { display: none; }

    .db-user-pill {
        padding: 0 1.25rem 1.5rem;
        border-bottom: 1px solid var(--border-subtle);
        margin-bottom: 1rem;
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .db-avatar {
        width: 52px;
        height: 52px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 0.75rem;
    }

    .db-user-name {
        font-weight: 700;
        font-size: 0.95rem;
        color: var(--text-primary);
        display: block;
    }

    .db-user-email {
        font-size: 0.72rem;
        color: var(--text-muted);
        display: block;
        margin-top: 2px;
        word-break: break-all;
    }

    /* Nav items */
    .db-nav {
        flex: 1;
        padding: 0 0.75rem;
    }

    .db-nav-group-label {
        font-size: 0.65rem;
        font-weight: 600;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: var(--text-muted);
        padding: 0.75rem 0.5rem 0.35rem;
    }

    .db-nav-item {
        display: flex;
        align-items: center;
        gap: 0.65rem;
        padding: 0.65rem 0.75rem;
        border-radius: 0.6rem;
        cursor: pointer;
        font-size: 0.84rem;
        font-weight: 500;
        color: var(--text-secondary);
        transition: all 0.18s ease;
        width: 100%;
        text-align: left;
        background: none;
        border: none;
        margin-bottom: 2px;
    }

    .db-nav-item:hover {
        background: var(--card-bg);
        color: var(--text-primary);
    }

    .db-nav-item.active {
        background: rgba(56,189,248, 0.12);
        color: #38bdf8;
        font-weight: 600;
    }

    html.light-theme .db-nav-item.active {
        background: rgba(56,189,248, 0.08);
    }

    .db-nav-item svg {
        width: 16px;
        height: 16px;
        flex-shrink: 0;
        opacity: 0.7;
    }

    .db-nav-item.active svg { opacity: 1; }

    .db-logout-btn {
        margin: 0 0.75rem 1rem;
        display: flex;
        align-items: center;
        gap: 0.65rem;
        padding: 0.65rem 0.75rem;
        border-radius: 0.6rem;
        font-size: 0.84rem;
        font-weight: 500;
        color: #ef4444;
        background: rgba(239, 68, 68, 0.08);
        border: none;
        cursor: pointer;
        width: calc(100% - 1.5rem);
        transition: all 0.18s ease;
    }

    .db-logout-btn:hover {
        background: rgba(239, 68, 68, 0.18);
    }

    .db-logout-btn svg { width: 16px; height: 16px; flex-shrink: 0; }

    /* ── Main content ── */
    .db-content {
        flex: 1;
        min-width: 0;
        padding: 2.5rem 3rem;
        overflow-y: auto;
        height: 100%;
    }

    .db-section {
        display: none;
        max-width: 1100px;
    }
    .db-section.active { display: block; }

    /* Section heading */
    .db-section-heading {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 0.4rem;
    }

    .db-section-sub {
        font-size: 0.82rem;
        color: var(--text-muted);
        margin-bottom: 2rem;
    }

    /* ── Stat cards (Overview) ── */
    .db-stat-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .db-stat-card {
        background: var(--bg-card);
        border: 1px solid var(--border-subtle);
        border-radius: 1rem;
        padding: 1.25rem 1.25rem 1rem;
        transition: box-shadow 0.2s;
    }

    .db-stat-card:hover {
        box-shadow: 0 4px 20px rgba(0,0,0,0.15);
    }

    .db-stat-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 0.85rem;
    }

    .db-stat-value {
        font-size: 1.6rem;
        font-weight: 800;
        color: var(--text-primary);
        line-height: 1;
    }

    .db-stat-label {
        font-size: 0.72rem;
        font-weight: 500;
        color: var(--text-muted);
        margin-top: 0.3rem;
        text-transform: uppercase;
        letter-spacing: 0.06em;
    }

    /* ── Order cards ── */
    .db-order-card {
        background: var(--bg-card);
        border: 1px solid var(--border-subtle);
        border-radius: 1rem;
        padding: 1.25rem 1.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 0.85rem;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .db-order-card:hover {
        border-color: rgba(56,189,248, 0.3);
        box-shadow: 0 2px 16px rgba(0,0,0,0.1);
    }

    .db-order-thumb {
        width: 56px;
        height: 56px;
        border-radius: 0.6rem;
        object-fit: cover;
        background: var(--card-bg);
        flex-shrink: 0;
    }

    .db-order-thumb-placeholder {
        width: 56px;
        height: 56px;
        border-radius: 0.6rem;
        background: rgba(56,189,248, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .db-order-info { flex: 1; }

    .db-order-title {
        font-size: 0.88rem;
        font-weight: 600;
        color: var(--text-primary);
    }

    .db-order-meta {
        font-size: 0.72rem;
        color: var(--text-muted);
        margin-top: 2px;
    }

    .db-badge {
        display: inline-block;
        padding: 0.25rem 0.65rem;
        border-radius: 999px;
        font-size: 0.68rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .db-badge-green  { background: rgba(16,185,129,0.12); color: #10b981; }
    .db-badge-yellow { background: rgba(245,158,11,0.12); color: #f59e0b; }
    .db-badge-red    { background: rgba(239,68,68,0.12);  color: #ef4444; }
    .db-badge-blue   { background: rgba(59,130,246,0.12); color: #3b82f6; }

    /* ── Account / Settings Form ── */
    .db-form-card {
        background: var(--bg-card);
        border: 1px solid var(--border-subtle);
        border-radius: 1rem;
        padding: 1.75rem 2rem;
        margin-bottom: 1.25rem;
    }

    .db-form-card-title {
        font-size: 0.92rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 1.25rem;
        padding-bottom: 0.85rem;
        border-bottom: 1px solid var(--border-subtle);
    }

    .db-field-group {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
        margin-bottom: 1rem;
    }

    @media (max-width: 640px) {
        .db-field-group { grid-template-columns: 1fr; }
    }

    .db-field { display: flex; flex-direction: column; gap: 0.35rem; }

    .db-label {
        font-size: 0.72rem;
        font-weight: 600;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.06em;
    }

    .db-input {
        padding: 0.65rem 0.85rem;
        border-radius: 0.55rem;
        border: 1px solid var(--border-color);
        background: var(--bg-primary);
        color: var(--text-primary);
        font-size: 0.85rem;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
        font-family: 'Inter', sans-serif;
    }

    .db-input:focus {
        border-color: rgba(56,189,248, 0.5);
        box-shadow: 0 0 0 3px rgba(56,189,248, 0.1);
    }

    .db-btn-primary {
        background: linear-gradient(135deg, #38bdf8 0%, #0284c7 100%);
        color: white;
        border: none;
        padding: 0.65rem 1.5rem;
        border-radius: 0.55rem;
        font-size: 0.84rem;
        font-weight: 600;
        cursor: pointer;
        transition: transform 0.18s, box-shadow 0.18s;
        box-shadow: 0 4px 14px rgba(56,189,248, 0.3);
    }

    .db-btn-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 18px rgba(56,189,248, 0.4);
    }

    .db-btn-danger {
        background: transparent;
        color: #ef4444;
        border: 1px solid rgba(239, 68, 68, 0.4);
        padding: 0.65rem 1.5rem;
        border-radius: 0.55rem;
        font-size: 0.84rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.18s;
    }

    .db-btn-danger:hover {
        background: rgba(239, 68, 68, 0.08);
        border-color: #ef4444;
    }

    /* ── Danger Zone ── */
    .db-danger-zone {
        background: rgba(239, 68, 68, 0.04);
        border: 1px solid rgba(239, 68, 68, 0.2);
        border-radius: 1rem;
        padding: 1.75rem 2rem;
        margin-bottom: 1.25rem;
    }

    .db-danger-zone-title {
        font-size: 0.92rem;
        font-weight: 700;
        color: #ef4444;
        margin-bottom: 0.5rem;
    }

    .db-danger-zone p {
        font-size: 0.8rem;
        color: var(--text-muted);
        margin-bottom: 1.25rem;
        line-height: 1.6;
    }

    /* Recent activity timeline */
    .db-timeline-item {
        display: flex;
        gap: 1rem;
        padding-bottom: 1.25rem;
        position: relative;
    }

    .db-timeline-item:not(:last-child)::before {
        content: '';
        position: absolute;
        left: 15px;
        top: 32px;
        bottom: 0;
        width: 1px;
        background: var(--border-subtle);
    }

    .db-timeline-dot {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .db-timeline-content { flex: 1; }

    .db-timeline-title {
        font-size: 0.83rem;
        font-weight: 600;
        color: var(--text-primary);
    }

    .db-timeline-time {
        font-size: 0.71rem;
        color: var(--text-muted);
        margin-top: 2px;
    }

    /* Mobile sidebar toggle */
    .db-mobile-tab-bar {
        display: none;
    }

    @media (max-width: 768px) {
        .db-shell {
            height: auto;
            min-height: 100vh;
            overflow: visible;
        }
        .db-inner {
            flex-direction: column;
            height: auto;
        }
        .db-sidebar {
            width: 100%;
            height: auto;
            position: relative;
            top: 0;
            flex-direction: row;
            overflow-x: auto;
            border-right: none;
            border-bottom: 1px solid var(--border-subtle);
            padding: 0.5rem;
        }
        .db-user-pill { display: none; }
        .db-nav { display: flex; flex-direction: row; padding: 0; gap: 4px; flex: 1; }
        .db-nav-group-label { display: none; }
        .db-nav-item { padding: 0.5rem 0.75rem; font-size: 0.75rem; white-space: nowrap; }
        .db-logout-btn { margin: 0; white-space: nowrap; padding: 0.5rem 0.75rem; width: auto; font-size: 0.75rem; }
        .db-content { padding: 1.25rem 1rem; height: auto; overflow-y: visible; }
        .db-field-group { grid-template-columns: 1fr; }
    }

    /* delete modal */
    .db-modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.65);
        backdrop-filter: blur(4px);
        z-index: 1000;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.22s;
    }

    .db-modal-overlay.open {
        opacity: 1;
        pointer-events: all;
    }

    .db-modal {
        background: var(--bg-card);
        border: 1px solid var(--border-subtle);
        border-radius: 1.25rem;
        padding: 2rem;
        max-width: 420px;
        width: 90%;
        box-shadow: 0 20px 60px rgba(0,0,0,0.4);
        transform: scale(0.94);
        transition: transform 0.22s cubic-bezier(0.16,1,0.3,1);
    }

    .db-modal-overlay.open .db-modal {
        transform: scale(1);
    }

    .db-modal h3 { font-size: 1.1rem; font-weight: 700; color: var(--text-primary); margin-bottom: 0.6rem; }
    .db-modal p  { font-size: 0.82rem; color: var(--text-muted); margin-bottom: 1.5rem; line-height: 1.6; }

    .db-modal-actions { display: flex; gap: 0.75rem; justify-content: flex-end; }
</style>

<div class="db-shell">
  <div class="db-inner">

    {{-- ─── SIDEBAR ─── --}}
    <aside class="db-sidebar">
      <div class="db-user-pill">
        <img
          src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&color=ffffff&background=0ea5e9&bold=true&size=128"
          alt="{{ auth()->user()->name }}"
          class="db-avatar"
        />
        <span class="db-user-name">{{ auth()->user()->name }}</span>
        <span class="db-user-email">{{ auth()->user()->email }}</span>

        @if(auth()->user()->hasManagerAccess())
        <div style="margin-top:8px;display:flex;flex-direction:column;gap:6px;width:100%;align-items:center">
          <span style="font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;padding:2px 8px;border-radius:99px;background:rgba(41,151,255,0.12);color:#2997ff;border:1px solid rgba(41,151,255,0.3)">
            {{ auth()->user()->roleLabel() }}
          </span>
          <a href="{{ route('manager') }}" style="font-size:11px;font-weight:600;color:#2997ff;text-decoration:none;display:inline-flex;align-items:center;gap:4px">
            ✦ Open Manager Portal &rarr;
          </a>
        </div>
        @endif
      </div>

      @php
        $activeTab = 'overview';
        if (session('status') === 'display-updated' || session('status') === 'address-updated' || $errors->hasAny(['address_street','address_city','address_region','phone','language','currency'])) {
            $activeTab = 'settings';
        } elseif (session('status') === 'notifications-updated') {
            $activeTab = 'notifications';
        } elseif (session('status') === 'profile-updated' || $errors->hasAny(['name','email'])) {
            $activeTab = 'account';
        }
      @endphp

      <nav class="db-nav">
        <div class="db-nav-group-label">Account</div>

        <button class="db-nav-item {{ $activeTab === 'overview' ? 'active' : '' }}" onclick="switchTab('overview', this)">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
          Overview
        </button>

        <button class="db-nav-item {{ $activeTab === 'orders' ? 'active' : '' }}" onclick="switchTab('orders', this)">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
          Order History
        </button>

        <button class="db-nav-item {{ $activeTab === 'account' ? 'active' : '' }}" onclick="switchTab('account', this)">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
          Account Details
        </button>

        <button class="db-nav-item {{ $activeTab === 'security' ? 'active' : '' }}" onclick="switchTab('security', this)">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
          Security
        </button>

        <div class="db-nav-group-label" style="margin-top: 0.5rem;">Preferences</div>

        <button class="db-nav-item {{ $activeTab === 'notifications' ? 'active' : '' }}" onclick="switchTab('notifications', this)">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
          Notifications
        </button>

        <button class="db-nav-item {{ $activeTab === 'settings' ? 'active' : '' }}" onclick="switchTab('settings', this)">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><circle cx="12" cy="12" r="3"/></svg>
          Settings
        </button>
      </nav>

      {{-- Logout --}}
      <form method="POST" action="{{ route('logout') }}" style="padding: 0 0.75rem 0;">
        @csrf
        <button type="submit" class="db-logout-btn">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
          Sign Out
        </button>
      </form>
    </aside>

    {{-- ─── MAIN CONTENT ─── --}}
    <main class="db-content">

      {{-- ═══════════════════════════════════════ --}}
      {{-- TAB: OVERVIEW                           --}}
      {{-- ═══════════════════════════════════════ --}}
      <section id="tab-overview" class="db-section {{ $activeTab === 'overview' ? 'active' : '' }}">
        <h1 class="db-section-heading">Good {{ now()->hour < 12 ? 'Morning' : (now()->hour < 17 ? 'Afternoon' : 'Evening') }}, {{ explode(' ', auth()->user()->name)[0] }} 👋</h1>
        <p class="db-section-sub">Here's a summary of your Monarchi account activity.</p>

        <div class="db-stat-grid">
          <div class="db-stat-card">
            <div class="db-stat-icon" style="background: rgba(56,189,248,0.12);">
              <svg width="18" height="18" fill="none" stroke="#38bdf8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/></svg>
            </div>
            <div class="db-stat-value">{{ $totalOrders ?? 0 }}</div>
            <div class="db-stat-label">Total Orders</div>
          </div>
          <div class="db-stat-card">
            <div class="db-stat-icon" style="background: rgba(16,185,129,0.12);">
              <svg width="18" height="18" fill="none" stroke="#10b981" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            </div>
            <div class="db-stat-value">{{ $completedOrders ?? 0 }}</div>
            <div class="db-stat-label">Completed</div>
          </div>
          <div class="db-stat-card">
            <div class="db-stat-icon" style="background: rgba(245,158,11,0.12);">
              <svg width="18" height="18" fill="none" stroke="#f59e0b" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div class="db-stat-value">{{ $pendingOrders ?? 0 }}</div>
            <div class="db-stat-label">In Progress</div>
          </div>
          <div class="db-stat-card">
            <div class="db-stat-icon" style="background: rgba(59,130,246,0.12);">
              <svg width="18" height="18" fill="none" stroke="#3b82f6" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
            </div>
            <div class="db-stat-value">₵{{ number_format($totalSpent ?? 0, 2) }}</div>
            <div class="db-stat-label">Total Spent</div>
          </div>
        </div>

        {{-- Recent Activity --}}
        <div class="db-form-card">
          <div class="db-form-card-title">Recent Activity</div>
          <div class="space-y-4">
            @if(isset($orders) && $orders->isNotEmpty())
              @foreach($orders->take(3) as $recentOrder)
              <div class="db-timeline-item">
                <div class="db-timeline-dot" style="background: {{ $recentOrder->isPaid() ? 'rgba(16,185,129,0.12)' : 'rgba(56,189,248,0.12)' }};">
                  @if($recentOrder->isPaid())
                    <svg width="14" height="14" fill="none" stroke="#10b981" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                  @else
                    <svg width="14" height="14" fill="none" stroke="#38bdf8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                  @endif
                </div>
                <div class="db-timeline-content">
                  <div class="db-timeline-title flex items-center justify-between">
                    <span>Order #MHQ-{{ str_pad($recentOrder->id, 5, '0', STR_PAD_LEFT) }} (₵{{ number_format($recentOrder->total, 2) }})</span>
                    @if($recentOrder->isPaid())
                      <span class="db-badge db-badge-green">Paid ({{ ucfirst(str_replace('_', ' ', $recentOrder->payment_channel ?? 'Paystack')) }})</span>
                    @else
                      <span class="db-badge db-badge-yellow">Payment Pending</span>
                    @endif
                  </div>
                  <div class="db-timeline-time">{{ $recentOrder->created_at->diffForHumans() }} &middot; {{ $recentOrder->items->count() }} {{ Str::plural('item', $recentOrder->items->count()) }}</div>
                </div>
              </div>
              @endforeach
            @endif

            <div class="db-timeline-item">
              <div class="db-timeline-dot" style="background: rgba(56,189,248,0.12);">
                <svg width="14" height="14" fill="none" stroke="#38bdf8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
              </div>
              <div class="db-timeline-content">
                <div class="db-timeline-title">Account Created</div>
                <div class="db-timeline-time">{{ auth()->user()->created_at->diffForHumans() }} &middot; Welcome to Monarchi!</div>
              </div>
            </div>
          </div>
        </div>
      </section>

      {{-- ═══════════════════════════════════════ --}}
      {{-- TAB: ORDER HISTORY                      --}}
      {{-- ═══════════════════════════════════════ --}}
      <section id="tab-orders" class="db-section {{ $activeTab === 'orders' ? 'active' : '' }}">
        <div class="flex items-center justify-between mb-4">
          <div>
            <h1 class="db-section-heading">Order History</h1>
            <p class="db-section-sub mb-0">Track and manage all your past orders and payment receipts.</p>
          </div>
          <a href="{{ route('store.index') }}" class="db-btn-primary text-xs" style="text-decoration:none;">
            + New Order
          </a>
        </div>

        @if(!isset($orders) || $orders->isEmpty())
          {{-- Empty state --}}
          <div style="text-align:center; padding: 4rem 2rem; background: var(--bg-card); border: 1px solid var(--border-subtle); border-radius: 1rem;">
            <div style="width:72px;height:72px;background:rgba(56,189,248,0.08);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 1.25rem;">
              <svg width="30" height="30" fill="none" stroke="#38bdf8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            </div>
            <div style="font-size:1rem;font-weight:700;color:var(--text-primary);margin-bottom:0.4rem;">No orders yet</div>
            <div style="font-size:0.8rem;color:var(--text-muted);max-width:280px;margin:0 auto 1.5rem;line-height:1.6;">Once you place an order, it will appear here for easy tracking and management.</div>
            <a href="{{ route('store.index') }}" class="db-btn-primary" style="display:inline-block; text-decoration:none; padding:0.65rem 1.75rem;">
              Browse the Store
            </a>
          </div>
        @else
          {{-- Orders List --}}
          <div class="space-y-4">
            @foreach($orders as $order)
            <div class="db-form-card" style="padding: 1.5rem;">
              {{-- Header --}}
              <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-3.5 mb-3.5 border-b gap-2" style="border-color: var(--border-subtle);">
                <div class="flex items-center gap-3">
                  <div class="w-10 h-10 rounded-xl flex items-center justify-center font-bold text-sm bg-[#38bdf8]/10 text-[#38bdf8]">
                    #{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}
                  </div>
                  <div>
                    <h3 class="font-bold text-sm" style="color: var(--text-primary);">Order #MHQ-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</h3>
                    <p class="text-xs" style="color: var(--text-muted);">Placed on {{ $order->created_at->format('M d, Y \a\t H:i') }}</p>
                  </div>
                </div>

                {{-- Status Badges --}}
                <div class="flex flex-wrap items-center gap-2">
                  @if($order->isPaid())
                    <span class="db-badge db-badge-green">
                      ✓ Paid ({{ ucfirst(str_replace('_', ' ', $order->payment_channel ?? 'Paystack')) }})
                    </span>
                  @elseif($order->payment_status === 'failed')
                    <span class="db-badge db-badge-red">Payment Failed</span>
                  @else
                    <span class="db-badge db-badge-yellow">Payment Pending</span>
                  @endif

                  <span class="db-badge {{ $order->status === 'delivered' ? 'db-badge-green' : ($order->status === 'cancelled' ? 'db-badge-red' : 'db-badge-blue') }}">
                    {{ ucfirst($order->status) }}
                  </span>
                </div>
              </div>

              {{-- Order Items --}}
              <div class="space-y-2.5 my-3">
                @foreach($order->items as $item)
                <div class="flex items-center justify-between p-2.5 rounded-xl border" style="background: var(--bg-primary); border-color: var(--border-subtle);">
                  <div class="flex items-center gap-3 min-w-0">
                    <div class="w-10 h-10 rounded-lg overflow-hidden shrink-0 border flex items-center justify-center" style="background: var(--bg-card); border-color: var(--border-subtle);">
                      @if($item->product && $item->product->image_path)
                        <img src="{{ asset('storage/'.$item->product->image_path) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                      @else
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                      @endif
                    </div>
                    <div class="min-w-0">
                      <p class="text-xs font-bold truncate" style="color: var(--text-primary);">
                        {{ $item->product?->name ?? 'Product' }}
                      </p>
                      <p class="text-[11px]" style="color: var(--text-muted);">
                        Qty: {{ $item->quantity }} &times; ₵{{ number_format($item->unit_price, 2) }}
                      </p>
                    </div>
                  </div>

                  <span class="text-xs font-extrabold shrink-0 ml-4" style="color: var(--text-primary);">
                    ₵{{ number_format($item->subtotal, 2) }}
                  </span>
                </div>
                @endforeach
              </div>

              {{-- Footer Details & Actions --}}
              <div class="flex flex-col sm:flex-row sm:items-center justify-between pt-3 border-t gap-3" style="border-color: var(--border-subtle);">
                <div>
                  <span class="text-[11px]" style="color: var(--text-muted);">Delivery to:</span>
                  <span class="text-xs font-semibold ml-1" style="color: var(--text-primary);">{{ $order->shipping_address ?? 'Not specified' }}</span>
                  @if($order->payment_reference)
                    <span class="text-[11px] font-mono ml-2 block sm:inline" style="color: var(--text-muted);">Ref: {{ $order->payment_reference }}</span>
                  @endif
                </div>

                <div class="flex items-center gap-3 justify-between sm:justify-end">
                  <div class="text-right mr-2">
                    <span class="text-[10px] uppercase font-bold tracking-wider block text-gray-400">Total</span>
                    <span class="text-base font-extrabold text-[#38bdf8]">₵{{ number_format($order->total, 2) }}</span>
                  </div>

                  @if(!$order->isPaid())
                    <a href="{{ route('paystack.retry', $order->id) }}"
                       class="px-4 py-2 bg-green-600 text-white rounded-lg text-xs font-bold hover:bg-green-700 transition flex items-center gap-1.5 shadow-sm">
                      <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                      Pay on Paystack
                    </a>
                  @endif

                  <a href="{{ route('bag.success', $order->id) }}"
                     class="px-4 py-2 rounded-lg text-xs font-semibold border hover:border-[#38bdf8] transition flex items-center gap-1"
                     style="border-color: var(--border-subtle); color: var(--text-primary); background: var(--bg-primary);">
                    Receipt
                  </a>
                </div>
              </div>

            </div>
            @endforeach
          </div>
        @endif
      </section>

      {{-- ═══════════════════════════════════════ --}}
      {{-- TAB: ACCOUNT DETAILS                    --}}
      {{-- ═══════════════════════════════════════ --}}
      <section id="tab-account" class="db-section {{ $activeTab === 'account' ? 'active' : '' }}">
        <h1 class="db-section-heading">Account Details</h1>
        <p class="db-section-sub">Update your personal information.</p>

        <div class="db-form-card">
          <div class="db-form-card-title">Personal Information</div>
          <form method="POST" action="{{ route('profile.update') }}" class="db-async-form">
            @csrf
            @method('PATCH')

            <div class="db-field-group">
              <div class="db-field">
                <label class="db-label">Full Name</label>
                <input type="text" name="name" class="db-input" value="{{ old('name', auth()->user()->name) }}" required />
              </div>
              <div class="db-field">
                <label class="db-label">Email Address</label>
                <input type="email" name="email" class="db-input" value="{{ old('email', auth()->user()->email) }}" required />
              </div>
            </div>

            @if (session('status') === 'profile-updated')
              <p class="db-alert-msg" style="color: #10b981; font-size:0.78rem; margin-bottom:0.75rem;">✓ Profile updated successfully.</p>
            @endif

            @if ($errors->has('name') || $errors->has('email'))
              <div style="color:#ef4444;font-size:0.78rem;margin-bottom:0.75rem;">
                @foreach ($errors->all() as $error) <p>{{ $error }}</p> @endforeach
              </div>
            @endif

            <div style="display:flex; justify-content:flex-end; margin-top: 0.5rem;">
              <button type="submit" class="db-btn-primary">Save Changes</button>
            </div>
          </form>
        </div>

        <div class="db-form-card">
          <div class="db-form-card-title">Connected Social Account</div>
          @if(auth()->user()->provider)
            <div style="display:flex;align-items:center;gap:0.85rem;padding:0.75rem 0;">
              <div style="width:40px;height:40px;border-radius:50%;background:var(--card-bg);display:flex;align-items:center;justify-content:center;border:1px solid var(--border-subtle);">
                @if(auth()->user()->provider === 'google')
                  <svg width="18" height="18" viewBox="0 0 24 24"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
                @elseif(auth()->user()->provider === 'microsoft')
                  <svg width="18" height="18" viewBox="0 0 21 21"><path fill="#f25022" d="M1 1h9v9H1z"/><path fill="#00a4ef" d="M1 11h9v9H1z"/><path fill="#7fba00" d="M11 1h9v9h-9z"/><path fill="#ffb900" d="M11 11h9v9h-9z"/></svg>
                @endif
              </div>
              <div>
                <div style="font-size:0.84rem;font-weight:600;color:var(--text-primary);">{{ ucfirst(auth()->user()->provider) }} Account</div>
                <div style="font-size:0.72rem;color:var(--text-muted);">Connected &middot; {{ auth()->user()->email }}</div>
              </div>
              <div style="margin-left:auto;"><span class="db-badge db-badge-green">Active</span></div>
            </div>
          @else
            <p style="font-size:0.82rem;color:var(--text-muted);">No social account connected.</p>
          @endif
        </div>
      </section>

      {{-- ═══════════════════════════════════════ --}}
      {{-- TAB: SECURITY                           --}}
      {{-- ═══════════════════════════════════════ --}}
      <section id="tab-security" class="db-section {{ $activeTab === 'security' ? 'active' : '' }}">
        <h1 class="db-section-heading">Security</h1>
        <p class="db-section-sub">Manage your account security settings.</p>

        <div class="db-form-card">
          <div class="db-form-card-title">Login Sessions</div>
          <div style="display:flex;align-items:center;gap:1rem;padding:0.75rem 0;">
            <div style="width:42px;height:42px;border-radius:10px;background:rgba(16,185,129,0.1);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
              <svg width="18" height="18" fill="none" stroke="#10b981" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17H3a2 2 0 01-2-2V5a2 2 0 012-2h16a2 2 0 012 2v10a2 2 0 01-2 2h-2"/></svg>
            </div>
            <div style="flex:1;">
              <div style="font-size:0.84rem;font-weight:600;color:var(--text-primary);">Current Device</div>
              <div style="font-size:0.72rem;color:var(--text-muted);">{{ request()->header('User-Agent') ? substr(request()->header('User-Agent'), 0, 60).'...' : 'Unknown' }}</div>
              <div style="font-size:0.72rem;color:var(--text-muted);">IP: {{ request()->ip() }}</div>
            </div>
            <span class="db-badge db-badge-green">Active Now</span>
          </div>
        </div>

        <div class="db-form-card">
          <div class="db-form-card-title">Authentication Method</div>
          <div style="display:flex;align-items:center;gap:0.75rem;padding:0.5rem 0;">
            <span class="db-badge db-badge-blue" style="font-size:0.75rem;">{{ auth()->user()->provider ? ucfirst(auth()->user()->provider).' OAuth' : 'Email & Password' }}</span>
            <span style="font-size:0.8rem;color:var(--text-muted);">Your account is secured with social authentication.</span>
          </div>
        </div>

        <div class="db-danger-zone">
          <div class="db-danger-zone-title">⚠ Danger Zone</div>
          <p>Deleting your account is permanent and cannot be undone. All your data, orders, and preferences will be removed immediately.</p>
          <button class="db-btn-danger" onclick="document.getElementById('delete-modal').classList.add('open')">
            Delete My Account
          </button>
        </div>
      </section>

      {{-- ═══════════════════════════════════════ --}}
      {{-- TAB: NOTIFICATIONS                      --}}
      {{-- ═══════════════════════════════════════ --}}
      <section id="tab-notifications" class="db-section {{ $activeTab === 'notifications' ? 'active' : '' }}">
        <h1 class="db-section-heading">Notifications</h1>
        <p class="db-section-sub">Control how you receive updates from Monarchi.</p>

        <div class="db-form-card">
          <div class="db-form-card-title">Email Preferences</div>

          @if (session('status') === 'notifications-updated')
            <p class="db-alert-msg" style="color:#38bdf8;font-size:0.78rem;margin-bottom:1rem;">✓ Notification preferences saved.</p>
          @endif

          <form method="POST" action="{{ route('settings.notifications') }}" class="db-async-form">
            @csrf
            @php
              $u = auth()->user();
              $prefs = [
                ['key'=>'notif_orders',   'label'=>'Order Updates',       'desc'=>'Shipping, delivery and order status changes'],
                ['key'=>'notif_promos',   'label'=>'Promotions & Offers',  'desc'=>'Exclusive deals and seasonal campaigns'],
                ['key'=>'notif_blog',     'label'=>'Blog & News',          'desc'=>'New articles and trending tech posts'],
                ['key'=>'notif_security', 'label'=>'Security Alerts',      'desc'=>'Login from new devices and account changes'],
              ];
            @endphp

            @foreach($prefs as $pref)
            <div style="display:flex;align-items:center;justify-content:space-between;padding:0.85rem 0;border-bottom:1px solid var(--border-subtle);">
              <div>
                <div style="font-size:0.85rem;font-weight:600;color:var(--text-primary);">{{ $pref['label'] }}</div>
                <div style="font-size:0.72rem;color:var(--text-muted);">{{ $pref['desc'] }}</div>
              </div>
              {{-- Toggle switch backed by a real hidden checkbox --}}
              <label style="position:relative;display:inline-block;width:42px;height:24px;flex-shrink:0;cursor:pointer;">
                <input
                  type="checkbox"
                  name="{{ $pref['key'] }}"
                  id="toggle_{{ $pref['key'] }}"
                  value="1"
                  {{ $u->{$pref['key']} ? 'checked' : '' }}
                  style="opacity:0;position:absolute;width:0;height:0;"
                  onchange="updateToggle(this)"
                >
                <span id="track_{{ $pref['key'] }}"
                  style="position:absolute;cursor:pointer;inset:0;background:{{ $u->{$pref['key']} ? '#38bdf8' : 'rgba(255,255,255,0.15)' }};border-radius:999px;transition:background 0.2s;"
                  onclick="document.getElementById('toggle_{{ $pref['key'] }}').click()">
                  <span id="thumb_{{ $pref['key'] }}"
                    style="position:absolute;height:18px;width:18px;left:3px;bottom:3px;background:#fff;border-radius:50%;transition:transform 0.2s;transform:{{ $u->{$pref['key']} ? 'translateX(18px)' : 'translateX(0)' }}">
                  </span>
                </span>
              </label>
            </div>
            @endforeach

            <div style="display:flex;justify-content:flex-end;margin-top:1.25rem;">
              <button type="submit" class="db-btn-primary">Save Preferences</button>
            </div>
          </form>
        </div>
      </section>

      {{-- ═══════════════════════════════════════ --}}
      {{-- TAB: SETTINGS                           --}}
      {{-- ═══════════════════════════════════════ --}}
      <section id="tab-settings" class="db-section {{ $activeTab === 'settings' ? 'active' : '' }}">
        <h1 class="db-section-heading">Settings</h1>
        <p class="db-section-sub">Manage your display and regional preferences.</p>

        <div class="db-form-card">
          <div class="db-form-card-title">Display & Language</div>

          @if (session('status') === 'display-updated')
            <p class="db-alert-msg" style="color:#38bdf8;font-size:0.78rem;margin-bottom:1rem;">✓ Display preferences saved.</p>
          @endif

          <form method="POST" action="{{ route('settings.display') }}" class="db-async-form">
            @csrf
            <div class="db-field-group">
              <div class="db-field">
                <label class="db-label">Language</label>
                <select name="language" class="db-input">
                  @foreach(['English (Default)','French','Twi'] as $lang)
                    <option {{ auth()->user()->language === $lang ? 'selected' : '' }}>{{ $lang }}</option>
                  @endforeach
                </select>
              </div>
              <div class="db-field">
                <label class="db-label">Currency</label>
                <select name="currency" class="db-input">
                  @foreach(['GHS — Ghanaian Cedi','USD — US Dollar','GBP — British Pound'] as $cur)
                    <option {{ auth()->user()->currency === $cur ? 'selected' : '' }}>{{ $cur }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div style="display:flex;justify-content:flex-end;margin-top:0.5rem;">
              <button type="submit" class="db-btn-primary">Save Settings</button>
            </div>
          </form>
        </div>

        <div class="db-form-card">
          <div class="db-form-card-title">Shipping Address</div>

          @if (session('status') === 'address-updated')
            <p class="db-alert-msg" style="color:#38bdf8;font-size:0.78rem;margin-bottom:1rem;">✓ Shipping address saved.</p>
          @endif

          <form method="POST" action="{{ route('settings.address') }}" class="db-async-form">
            @csrf
            <div class="db-field-group">
              <div class="db-field">
                <label class="db-label">Street / Area</label>
                <input type="text" name="address_street" class="db-input"
                  value="{{ old('address_street', auth()->user()->address_street) }}"
                  placeholder="e.g. 15 Liberation Road" />
              </div>
              <div class="db-field">
                <label class="db-label">City</label>
                <input type="text" name="address_city" class="db-input"
                  value="{{ old('address_city', auth()->user()->address_city) }}"
                  placeholder="e.g. Accra" />
              </div>
              <div class="db-field">
                <label class="db-label">Region</label>
                <select name="address_region" class="db-input">
                  <option value="">Select region</option>
                  @foreach(['Greater Accra','Ashanti','Western','Central','Eastern','Volta','Northern'] as $region)
                    <option {{ auth()->user()->address_region === $region ? 'selected' : '' }}>{{ $region }}</option>
                  @endforeach
                </select>
              </div>
              <div class="db-field">
                <label class="db-label">Phone Number</label>
                <input type="tel" name="phone" class="db-input"
                  value="{{ old('phone', auth()->user()->phone) }}"
                  placeholder="e.g. +233 24 000 0000" />
              </div>
            </div>
            <div style="display:flex;justify-content:flex-end;margin-top:0.5rem;">
              <button type="submit" class="db-btn-primary">Save Address</button>
            </div>
          </form>
        </div>
      </section>

    </main>
  </div>
</div>

{{-- ─── DELETE ACCOUNT MODAL ─── --}}
<div id="delete-modal" class="db-modal-overlay">
  <div class="db-modal">
    <h3>Delete Your Account?</h3>
    <p>This action is <strong>permanent</strong> and cannot be undone. Your profile, orders, and all associated data will be erased immediately.</p>
    <div style="margin-bottom:1.25rem;">
      <label class="db-label" style="display:block;margin-bottom:0.4rem;">Type <strong>DELETE</strong> to confirm</label>
      <input type="text" id="delete-confirm-input" class="db-input" placeholder="DELETE" style="width:100%;" />
    </div>
    <div class="db-modal-actions">
      <button class="db-btn-primary" onclick="document.getElementById('delete-modal').classList.remove('open')" style="background:transparent;color:var(--text-secondary);box-shadow:none;border:1px solid var(--border-subtle);">Cancel</button>
      <form method="POST" action="{{ route('profile.destroy') }}" id="delete-account-form">
        @csrf
        @method('DELETE')
        <button type="button" class="db-btn-danger" onclick="confirmDelete()">Delete Account</button>
      </form>
    </div>
  </div>
</div>

<script>
  function switchTab(tab, btn) {
    document.querySelectorAll('.db-section').forEach(s => s.classList.remove('active'));
    document.querySelectorAll('.db-nav-item').forEach(b => b.classList.remove('active'));
    const targetSection = document.getElementById('tab-' + tab);
    if (targetSection) {
      targetSection.classList.add('active');
    }
    if (btn) {
      btn.classList.add('active');
    } else {
      const matchingBtn = document.querySelector(`.db-nav-item[onclick*="'${tab}'"]`);
      if (matchingBtn) matchingBtn.classList.add('active');
    }
    // Update browser URL hash without jump
    if (history.replaceState) {
      history.replaceState(null, null, '#' + tab);
    }
  }

  function applyTabFromHash() {
    const hash = window.location.hash.replace('#', '');
    if (hash && document.getElementById('tab-' + hash)) {
      const targetBtn = document.querySelector(`.db-nav-item[onclick*="'${hash}'"]`);
      switchTab(hash, targetBtn);
    }
  }

  // Check URL hash on page load and hash changes
  window.addEventListener('DOMContentLoaded', () => {
    applyTabFromHash();
    // If no hash in URL but an activeTab was rendered from server flash
    const currentHash = window.location.hash.replace('#', '');
    if (!currentHash) {
      const activeSection = document.querySelector('.db-section.active');
      if (activeSection && activeSection.id) {
        const tabName = activeSection.id.replace('tab-', '');
        if (tabName !== 'overview' && history.replaceState) {
          history.replaceState(null, null, '#' + tabName);
        }
      }
    }
  });

  window.addEventListener('hashchange', applyTabFromHash);

  // Modern toast notification system
  function showToast(message, type = 'success') {
    let toastContainer = document.getElementById('db-toast-container');
    if (!toastContainer) {
      toastContainer = document.createElement('div');
      toastContainer.id = 'db-toast-container';
      toastContainer.style.cssText = 'position:fixed;bottom:24px;right:24px;z-index:9999;display:flex;flex-direction:column;gap:10px;pointer-events:none;';
      document.body.appendChild(toastContainer);
    }

    const toast = document.createElement('div');
    toast.style.cssText = `
      min-width: 260px;
      max-width: 380px;
      background: ${type === 'error' ? 'rgba(239, 68, 68, 0.95)' : 'rgba(15, 23, 42, 0.95)'};
      color: #fff;
      border: 1px solid ${type === 'error' ? 'rgba(239, 68, 68, 0.4)' : 'rgba(56, 189, 248, 0.4)'};
      backdrop-filter: blur(8px);
      padding: 0.85rem 1.25rem;
      border-radius: 0.85rem;
      font-size: 0.82rem;
      font-weight: 500;
      box-shadow: 0 10px 30px rgba(0,0,0,0.35);
      display: flex;
      align-items: center;
      gap: 0.6rem;
      opacity: 0;
      transform: translateY(12px) scale(0.96);
      transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
      pointer-events: all;
    `;

    const icon = type === 'error'
      ? `<svg width="18" height="18" fill="none" stroke="#fff" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9" stroke-width="2"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01"/></svg>`
      : `<svg width="18" height="18" fill="none" stroke="#38bdf8" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9" stroke-width="2"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4"/></svg>`;

    toast.innerHTML = `<span>${icon}</span><span style="flex:1;">${message}</span>`;
    toastContainer.appendChild(toast);

    requestAnimationFrame(() => {
      toast.style.opacity = '1';
      toast.style.transform = 'translateY(0) scale(1)';
    });

    setTimeout(() => {
      toast.style.opacity = '0';
      toast.style.transform = 'translateY(12px) scale(0.96)';
      setTimeout(() => toast.remove(), 300);
    }, 3500);
  }

  // Handle asynchronous AJAX form submissions for settings
  document.querySelectorAll('.db-async-form').forEach(form => {
    form.addEventListener('submit', async function(e) {
      e.preventDefault();
      const btn = form.querySelector('button[type="submit"]');
      const origText = btn ? btn.innerHTML : '';
      if (btn) {
        btn.disabled = true;
        btn.innerHTML = `<span style="display:inline-flex;align-items:center;gap:0.4rem;"><svg class="animate-spin" style="width:14px;height:14px;animation:spin 1s linear infinite;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" style="opacity:0.25;"></circle><path class="opacity-75" fill="currentColor" style="opacity:0.75;" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Saving...</span>`;
      }

      // Clear existing inline alert messages in this form card
      const existingMsg = form.parentElement.querySelector('.db-alert-msg');
      if (existingMsg) existingMsg.remove();

      try {
        const formData = new FormData(form);
        const res = await fetch(form.action, {
          method: form.method || 'POST',
          headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
          },
          body: formData
        });

        const data = await res.json().catch(() => ({}));
        if (res.ok) {
          const successMsg = data.message || 'Preferences saved successfully.';
          showToast(successMsg, 'success');
          const alertEl = document.createElement('p');
          alertEl.className = 'db-alert-msg';
          alertEl.style.cssText = 'color:#38bdf8;font-size:0.78rem;margin-bottom:1rem;transition:all 0.3s;';
          alertEl.innerHTML = `✓ ${successMsg}`;
          form.parentElement.insertBefore(alertEl, form);
        } else {
          let errorMsg = data.message || 'An error occurred while saving.';
          if (data.errors) {
            errorMsg = Object.values(data.errors).flat().join('<br>');
          }
          showToast(errorMsg, 'error');
          const alertEl = document.createElement('p');
          alertEl.className = 'db-alert-msg';
          alertEl.style.cssText = 'color:#ef4444;font-size:0.78rem;margin-bottom:1rem;';
          alertEl.innerHTML = `⚠ ${errorMsg}`;
          form.parentElement.insertBefore(alertEl, form);
        }
      } catch (err) {
        console.error(err);
        form.submit();
      } finally {
        if (btn) {
          btn.disabled = false;
          btn.innerHTML = origText;
        }
      }
    });
  });

  function updateToggle(checkbox) {
    const key = checkbox.name;
    const track = document.getElementById('track_' + key);
    const thumb = document.getElementById('thumb_' + key);
    if (checkbox.checked) {
      track.style.background = '#38bdf8';
      thumb.style.transform = 'translateX(18px)';
    } else {
      track.style.background = 'rgba(255,255,255,0.15)';
      thumb.style.transform = 'translateX(0)';
    }
  }

  function confirmDelete() {
    const val = document.getElementById('delete-confirm-input').value;
    if (val === 'DELETE') {
      document.getElementById('delete-account-form').submit();
    } else {
      document.getElementById('delete-confirm-input').style.borderColor = '#ef4444';
      document.getElementById('delete-confirm-input').style.boxShadow = '0 0 0 3px rgba(239,68,68,0.15)';
      document.getElementById('delete-confirm-input').placeholder = 'Please type DELETE exactly';
    }
  }

  // Close modal on backdrop click
  document.getElementById('delete-modal').addEventListener('click', function(e) {
    if (e.target === this) this.classList.remove('open');
  });
</script>

</x-main-layout>
