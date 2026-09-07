<x-filament-panels::page>
    <div class="mai-root-wrapper" id="maiApp">

        {{-- ── Background Aurora FX ────────────────────────────────────────── --}}
        <div class="mai-ambient-glow mai-glow-1"></div>
        <div class="mai-ambient-glow mai-glow-2"></div>
        <div class="mai-ambient-glow mai-glow-3"></div>

        {{-- ── TOP NAVIGATION / CONTROL BAR ───────────────────────────────── --}}
        <header class="mai-topbar">
            {{-- Left: Async Navigation Tabs --}}
            <div class="mai-topbar-left">
                <nav class="mai-nav-tabs" role="tablist" aria-label="MAI Navigation">
                    <button type="button"
                            class="mai-tab-btn active"
                            id="maiTabChatBtn"
                            onclick="maiSwitchTab('chat')"
                            role="tab"
                            aria-selected="true"
                            title="Active Chat">
                        <svg class="w-3.5 h-3.5 text-cyan-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                        <span>Chat</span>
                    </button>

                    <button type="button"
                            class="mai-tab-btn"
                            id="maiTabHistoryBtn"
                            onclick="maiSwitchTab('history')"
                            role="tab"
                            aria-selected="false"
                            title="Past Conversations">
                        <svg class="w-3.5 h-3.5 text-indigo-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>History</span>
                        <span class="liquid-counter-badge" id="maiHistoryBadge">0</span>
                    </button>

                    <button type="button"
                            class="mai-tab-btn"
                            id="maiTabSchemaBtn"
                            onclick="maiSwitchTab('schema')"
                            role="tab"
                            aria-selected="false"
                            title="Database Schema">
                        <svg class="w-3.5 h-3.5 text-purple-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 7v10c0 2 1.5 3 3.5 3h9c2 0 3.5-1 3.5-3V7M4 7c0-2 1.5-3 3.5-3h9c2 0 3.5 1 3.5 3M4 7h16m-8 4v6m-4-3h8" />
                        </svg>
                        <span class="hidden sm:inline">DB Schema</span>
                    </button>
                </nav>
            </div>

            {{-- Center: Company Logo + Centered Text Content --}}
            <div class="mai-topbar-center">
                <div class="mai-center-brand">
                    <img src="{{ asset('images/logo-white.png') }}" alt="MonarchI Logo" class="mai-header-logo" />
                    <div class="flex items-center gap-2">
                        <h1 class="mai-title">MAI</h1>
                        <span class="mai-model-chip">
                            <span class="mai-live-dot"></span>
                            <span class="font-medium">{{ $geminiModel ?? 'gemini-3.6-flash' }}</span>
                        </span>
                    </div>
                </div>
                <p class="mai-subtitle">Zero-Shot PostgreSQL Engine &amp; Enterprise Intelligence</p>
            </div>

            {{-- Right: Actions --}}
            <div class="mai-topbar-actions">
                <button type="button" class="liquid-btn liquid-btn-primary" onclick="maiNewChat()" title="Start New AI Session">
                    <svg class="w-3.5 h-3.5 shrink-0 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    <span class="hidden sm:inline">New Chat</span>
                </button>

                <button type="button" class="liquid-btn liquid-btn-glass" onclick="maiClearCurrentChat()" title="Clear Active View">
                    <svg class="w-3.5 h-3.5 text-rose-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    <span class="hidden md:inline">Clear</span>
                </button>
            </div>
        </header>

        {{-- ── MAIN WORKSPACE: SIDEBAR DRAWER + CHAT CANVAS ───────────────── --}}
        <div class="mai-workspace-layout">

            {{-- ── COLLAPSIBLE HISTORY DRAWER (Liquid Glass) ──────────────── --}}
            <aside class="mai-history-drawer" id="maiHistoryDrawer">
                <div class="mai-history-header">
                    <div class="flex items-center justify-between w-full">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <h2 class="text-xs font-bold uppercase tracking-wider text-gray-200">Past Conversations</h2>
                        </div>
                        <button type="button" class="mai-close-drawer-btn" onclick="maiToggleHistory()" title="Close Drawer">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>

                    {{-- Search bar for conversations --}}
                    <div class="mai-history-search-wrap">
                        <svg class="w-3.5 h-3.5 text-gray-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M16.65 11a5.65 5.65 0 11-11.3 0 5.65 5.65 0 0111.3 0z"/>
                        </svg>
                        <input type="text"
                               id="maiHistorySearch"
                               placeholder="Search past inquiries…"
                               oninput="maiFilterHistory(this.value)"
                               class="mai-history-search-input">
                    </div>
                </div>

                <div class="mai-history-scroll" id="maiHistoryList">
                    {{-- Dynamically injected --}}
                    <div class="mai-history-loading">
                        <div class="mai-shimmer-bar"></div>
                        <div class="mai-shimmer-bar" style="width: 75%;"></div>
                        <div class="mai-shimmer-bar" style="width: 60%;"></div>
                    </div>
                </div>
            </aside>

            {{-- ── CENTRAL CHAT CANVAS ────────────────────────────────────── --}}
            <main class="mai-chat-canvas">

                {{-- Scrollable Message Stream --}}
                <div class="mai-messages-container" id="maiMessagesFeed">

                    {{-- ── ZERO-STATE HERO (Compact, No Overflow) ────── --}}
                    <div class="mai-hero-view" id="maiHeroView">
                        <div class="mai-hero-spark-wrap">
                            <div class="mai-hero-spark-glow"></div>
                            <div class="mai-hero-spark">
                                <img src="{{ asset('images/logo-white.png') }}" alt="MonarchI Crest" class="w-5 h-5 object-contain" />
                            </div>
                        </div>

                        <h2 class="mai-hero-greeting">
                            Good day, <span class="mai-hero-name">{{ $adminFirstName ?? 'Admin' }}</span>
                        </h2>
                        <p class="mai-hero-tagline">
                            How can MonarchI intelligence assist you today?
                        </p>

                        {{-- Compact Suggestion Pills --}}
                        <div class="mai-suggestions-pills">
                            <button type="button" class="mai-suggestion-pill" onclick="maiQuickPrompt('How many active products do we have in total, and which ones are currently featured?')">
                                <span class="mai-pill-dot" style="background:#38bdf8;"></span>
                                <span>Active &amp; Featured Products</span>
                            </button>

                            <button type="button" class="mai-suggestion-pill" onclick="maiQuickPrompt('List all products with stock quantity less than or equal to their minimum stock threshold.')">
                                <span class="mai-pill-dot" style="background:#f59e0b;"></span>
                                <span>Low Stock Alerts</span>
                            </button>

                            <button type="button" class="mai-suggestion-pill" onclick="maiQuickPrompt('Summarize total revenue and order volume by payment status and payment channel.')">
                                <span class="mai-pill-dot" style="background:#10b981;"></span>
                                <span>Revenue &amp; Orders</span>
                            </button>

                            <button type="button" class="mai-suggestion-pill" onclick="maiQuickPrompt('Show me the latest contact messages and inquiries received from the website.')">
                                <span class="mai-pill-dot" style="background:#c084fc;"></span>
                                <span>Client Inquiries</span>
                            </button>
                        </div>
                    </div>

                    {{-- Dynamic Chat Messages are appended here --}}
                    <div id="maiChatStream" class="mai-chat-stream"></div>

                </div>

                {{-- ── FLOATING INPUT CAPSULE (Google Gemini / Grok Dock) ────── --}}
                <div class="mai-dock-wrapper">
                    <div class="mai-dock-capsule">
                        <div class="mai-dock-top-row">
                            <span class="mai-dock-status">
                                <svg class="w-3 h-3 text-cyan-400 animate-spin" style="animation-duration: 6s;" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707" />
                                </svg>
                                <span>Zero-Shot PostgreSQL Engine</span>
                            </span>
                            <span id="maiCharCount" class="mai-dock-counter">0 / 2000</span>
                        </div>

                        <div class="mai-input-row">
                            <textarea id="maiUserInput"
                                      rows="1"
                                      placeholder="Ask MAI anything about products, metrics, SQL or business operations…"
                                      oninput="maiHandleInputResize(this)"
                                      onkeydown="maiHandleKeyDown(event)"></textarea>

                            <button type="button"
                                    id="maiSendBtn"
                                    class="liquid-btn-send"
                                    onclick="maiSendMessage()"
                                    title="Send prompt to Gemini">
                                <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M12 5l7 7-7 7"/>
                                </svg>
                            </button>
                        </div>

                        <div class="mai-dock-footer">
                            <span>Powered by Google Gemini <strong>{{ $geminiModel ?? 'gemini-3.6-flash' }}</strong></span>
                            <span>•</span>
                            <span>Press <kbd class="mai-kbd">Enter</kbd> to send, <kbd class="mai-kbd">Shift + Enter</kbd> for line break</span>
                        </div>
                    </div>
                </div>

            </main>
        </div>

        {{-- ── DATABASE SCHEMA MODAL ─────────────────────────────────────── --}}
        <div class="mai-modal-backdrop" id="maiSchemaModal" onclick="maiToggleSchemaModal(event)">
            <div class="mai-modal-content" onclick="event.stopPropagation()">
                <div class="mai-modal-header">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-xl bg-purple-500/20 border border-purple-500/30 flex items-center justify-center text-purple-400">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 7v10c0 2 1.5 3 3.5 3h9c2 0 3.5-1 3.5-3V7M4 7c0-2 1.5-3 3.5-3h9c2 0 3.5 1 3.5 3M4 7h16m-8 4v6m-4-3h8"/></svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-white">Monarchi PostgreSQL Schema Knowledge</h3>
                            <p class="text-xs text-gray-400">Available tables for zero-shot SELECT queries</p>
                        </div>
                    </div>
                    <button type="button" class="mai-close-drawer-btn" onclick="maiToggleSchemaModal()">✕</button>
                </div>

                <div class="mai-modal-body">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <div class="mai-schema-card">
                            <div class="mai-schema-title">products</div>
                            <p class="mai-schema-desc">id, category_id, name, slug, sku, price, sale_price, stock_quantity, min_stock_threshold, is_featured, is_active, badge_text, created_at</p>
                        </div>
                        <div class="mai-schema-card">
                            <div class="mai-schema-title">categories</div>
                            <p class="mai-schema-desc">id, name, slug, is_active, created_at</p>
                        </div>
                        <div class="mai-schema-card">
                            <div class="mai-schema-title">orders</div>
                            <p class="mai-schema-desc">id, user_id, status, payment_status, payment_channel, total, subtotal, shipping, currency, customer_name, customer_email, created_at</p>
                        </div>
                        <div class="mai-schema-card">
                            <div class="mai-schema-title">order_items</div>
                            <p class="mai-schema-desc">id, order_id, product_id, quantity, price (unit price)</p>
                        </div>
                        <div class="mai-schema-card">
                            <div class="mai-schema-title">users</div>
                            <p class="mai-schema-desc">id, name, email, role (super_admin, content_manager, store_manager, hr_manager, member), is_super_admin, created_at</p>
                        </div>
                        <div class="mai-schema-card">
                            <div class="mai-schema-title">contact_messages</div>
                            <p class="mai-schema-desc">id, name, email, subject, message, status (new, in_progress, replied, closed), hr_notes, replied_at, created_at</p>
                        </div>
                    </div>
                </div>

                <div class="mai-modal-footer">
                    <button type="button" class="liquid-btn liquid-btn-glass w-full justify-center" onclick="maiToggleSchemaModal()">
                        Close Schema Overview
                    </button>
                </div>
            </div>
        </div>

        {{-- ── STYLES: GEMINI & GROK COSMIC DARK THEME + LIQUID GLASS BUTTONS ── --}}
        <style>
            /* ── Scoped Filament Layout Overrides: Zero outer scrolling, exact fit below topbar ── */
            html:has(.mai-root-wrapper),
            body:has(.mai-root-wrapper) {
                overflow: hidden !important;
                height: 100vh !important;
                max-height: 100vh !important;
            }
            .fi-main-ctn:has(.mai-root-wrapper) {
                overflow: hidden !important;
                height: 100vh !important;
            }
            .fi-main:has(.mai-root-wrapper) {
                padding: 0.5rem 1rem 0.75rem !important;
                overflow: hidden !important;
                display: flex !important;
                flex-direction: column !important;
                flex: 1 !important;
                height: calc(100vh - var(--fi-topbar-height, 4rem)) !important;
                max-height: calc(100vh - var(--fi-topbar-height, 4rem)) !important;
                min-height: 0 !important;
            }
            .fi-page:has(.mai-root-wrapper) {
                gap: 0 !important;
                padding: 0 !important;
                flex: 1 !important;
                display: flex !important;
                flex-direction: column !important;
                height: 100% !important;
                min-height: 0 !important;
                overflow: hidden !important;
            }
            .fi-page:has(.mai-root-wrapper) > header.fi-header {
                display: none !important;
            }

            /* Root Container */
            .mai-root-wrapper {
                position: relative;
                width: 100%;
                height: 100% !important;
                max-height: 100% !important;
                min-height: 0 !important;
                display: flex;
                flex-direction: column;
                background: #090a10;
                border-radius: 16px;
                border: 1px solid rgba(255, 255, 255, 0.08);
                box-shadow: 0 16px 48px -10px rgba(0, 0, 0, 0.7), inset 0 1px 0 rgba(255, 255, 255, 0.1);
                overflow: hidden;
                color: #f1f5f9;
                font-family: inherit;
                flex: 1;
            }

            /* Aurora Ambient FX */
            .mai-ambient-glow {
                position: absolute;
                border-radius: 9999px;
                filter: blur(120px);
                pointer-events: none;
                z-index: 0;
                opacity: 0.28;
                transition: opacity 0.8s ease;
            }
            .mai-glow-1 {
                top: -100px;
                right: 15%;
                width: 480px;
                height: 380px;
                background: radial-gradient(circle, #9c051d 0%, #4f46e5 50%, transparent 70%);
            }
            .mai-glow-2 {
                bottom: -60px;
                left: 20%;
                width: 540px;
                height: 420px;
                background: radial-gradient(circle, #7c3aed 0%, #9333ea 50%, transparent 70%);
                opacity: 0.18;
            }
            .mai-glow-3 {
                top: 40%;
                left: -80px;
                width: 320px;
                height: 320px;
                background: radial-gradient(circle, #0284c7 0%, transparent 70%);
                opacity: 0.12;
            }

            /* Topbar (Balanced 3-column Layout with Centered Branding) */
            .mai-topbar {
                position: relative;
                z-index: 20;
                display: grid;
                grid-template-columns: 1fr auto 1fr;
                align-items: center;
                gap: 16px;
                padding: 10px 20px;
                background: rgba(14, 16, 26, 0.85);
                backdrop-filter: blur(24px);
                -webkit-backdrop-filter: blur(24px);
                border-bottom: 1px solid rgba(255, 255, 255, 0.07);
                flex-shrink: 0;
            }
            .mai-topbar-left {
                display: flex;
                align-items: center;
                justify-content: flex-start;
            }
            .mai-topbar-center {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                text-align: center;
            }
            .mai-center-brand {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 10px;
            }
            .mai-header-logo {
                height: 24px;
                width: auto;
                max-width: 32px;
                object-fit: contain;
                filter: drop-shadow(0 2px 8px rgba(156, 5, 29, 0.4));
            }
            .mai-title {
                font-size: 16px;
                font-weight: 800;
                letter-spacing: -0.02em;
                background: linear-gradient(135deg, #ffffff 30%, #e8788a 75%, #e8788a 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }
            .mai-model-chip {
                display: inline-flex;
                align-items: center;
                gap: 6px;
                padding: 2px 8px;
                border-radius: 99px;
                font-size: 10px;
                font-weight: 700;
                background: rgba(56, 189, 248, 0.1);
                color: #9c051d;
                border: 1px solid rgba(56, 189, 248, 0.25);
            }
            .mai-live-dot {
                width: 6px;
                height: 6px;
                border-radius: 99px;
                background: #10b981;
                box-shadow: 0 0 8px #10b981;
                animation: maiPulseDot 2s ease-in-out infinite;
            }
            @keyframes maiPulseDot {
                0%, 100% { opacity: 1; transform: scale(1); }
                50% { opacity: 0.4; transform: scale(0.85); }
            }
            .mai-subtitle {
                font-size: 11px;
                color: #94a3b8;
                margin-top: 1px;
            }
            .mai-topbar-actions {
                display: flex;
                align-items: center;
                justify-content: flex-end;
                gap: 8px;
            }

            /* Async Navigation Tabs (Liquid Segmented Buttons) */
            .mai-nav-tabs {
                display: inline-flex;
                align-items: center;
                gap: 4px;
                padding: 3px;
                border-radius: 12px;
                background: rgba(255, 255, 255, 0.04);
                border: 1px solid rgba(255, 255, 255, 0.08);
            }
            .mai-tab-btn {
                position: relative;
                display: inline-flex;
                align-items: center;
                gap: 6px;
                padding: 6px 12px;
                border-radius: 9px;
                font-size: 11.5px;
                font-weight: 600;
                color: #94a3b8;
                background: transparent;
                border: 1px solid transparent;
                cursor: pointer;
                user-select: none;
                transition: all 0.18s ease;
                text-decoration: none;
            }
            .mai-tab-btn:hover {
                color: #ffffff;
                background: rgba(255, 255, 255, 0.06);
            }
            .mai-tab-btn.active {
                color: #ffffff;
                background: linear-gradient(135deg, rgba(156, 5, 29, 0.35) 0%, rgba(99, 102, 241, 0.25) 100%);
                border-color: rgba(156, 5, 29, 0.4);
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3), inset 0 1px 0 rgba(255, 255, 255, 0.2);
            }
            @media (max-width: 820px) {
                .mai-topbar {
                    display: flex;
                    flex-wrap: wrap;
                    justify-content: space-between;
                    padding: 8px 14px;
                    gap: 8px;
                }
                .mai-topbar-center {
                    order: -1;
                    width: 100%;
                    margin-bottom: 2px;
                }
                .mai-subtitle {
                    display: none;
                }
            }

            /* LIQUID GLASS BUTTONS */
            .liquid-btn {
                position: relative;
                display: inline-flex;
                align-items: center;
                gap: 8px;
                padding: 8px 15px;
                border-radius: 12px;
                font-size: 12px;
                font-weight: 600;
                color: #f1f5f9;
                cursor: pointer;
                text-decoration: none;
                user-select: none;
                border: 1px solid rgba(255, 255, 255, 0.12);
                border-top: 1px solid rgba(255, 255, 255, 0.35);
                background: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0.02) 50%, rgba(56, 189, 248, 0.08) 100%);
                backdrop-filter: blur(20px);
                -webkit-backdrop-filter: blur(20px);
                box-shadow: inset 0 1px 1px 0 rgba(255, 255, 255, 0.3), 0 4px 14px -2px rgba(0, 0, 0, 0.35);
                transition: all 0.22s cubic-bezier(0.16, 1, 0.3, 1);
                overflow: hidden;
            }
            .liquid-btn::before {
                content: '';
                position: absolute;
                top: 0;
                left: -120%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.22), transparent);
                transform: skewX(-22deg);
                transition: left 0.6s ease;
            }
            .liquid-btn:hover {
                transform: translateY(-1.5px);
                border-color: rgba(255, 255, 255, 0.25);
                border-top-color: rgba(255, 255, 255, 0.55);
                box-shadow: inset 0 1px 2px 0 rgba(255, 255, 255, 0.4), 0 8px 24px -4px rgba(56, 189, 248, 0.25);
                color: #ffffff;
            }
            .liquid-btn:hover::before {
                left: 140%;
            }
            .liquid-btn:active {
                transform: translateY(1px) scale(0.98);
                box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.3);
            }

            .liquid-btn-primary {
                background: linear-gradient(135deg, rgba(56, 189, 248, 0.28) 0%, rgba(129, 140, 248, 0.2) 50%, rgba(192, 132, 252, 0.25) 100%);
                border-color: rgba(56, 189, 248, 0.3);
                border-top: 1px solid rgba(255, 255, 255, 0.5);
                box-shadow: inset 0 1px 1px 0 rgba(255, 255, 255, 0.4), 0 6px 20px -3px rgba(56, 189, 248, 0.35);
            }
            .liquid-btn-primary:hover {
                background: linear-gradient(135deg, rgba(56, 189, 248, 0.4) 0%, rgba(129, 140, 248, 0.3) 50%, rgba(192, 132, 252, 0.38) 100%);
                box-shadow: inset 0 1px 2px 0 rgba(255, 255, 255, 0.6), 0 10px 28px -4px rgba(129, 140, 248, 0.5);
            }

            .liquid-btn-history {
                background: linear-gradient(135deg, rgba(14, 165, 233, 0.15) 0%, rgba(255, 255, 255, 0.03) 100%);
            }
            .liquid-btn-history.active {
                background: linear-gradient(135deg, rgba(14, 165, 233, 0.3) 0%, rgba(99, 102, 241, 0.2) 100%);
                border-color: rgba(56, 189, 248, 0.4);
                box-shadow: inset 0 1px 2px rgba(255, 255, 255, 0.4), 0 0 16px rgba(14, 165, 233, 0.4);
            }

            .liquid-btn-glass {
                background: rgba(255, 255, 255, 0.04);
                border: 1px solid rgba(255, 255, 255, 0.09);
                border-top: 1px solid rgba(255, 255, 255, 0.25);
            }
            .liquid-btn-glass:hover {
                background: rgba(255, 255, 255, 0.08);
                border-color: rgba(255, 255, 255, 0.2);
            }

            .liquid-counter-badge {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                min-width: 18px;
                height: 18px;
                padding: 0 5px;
                border-radius: 99px;
                font-size: 10px;
                font-weight: 800;
                background: rgba(56, 189, 248, 0.25);
                color: #e0f2fe;
                border: 1px solid rgba(56, 189, 248, 0.4);
            }

            /* Workspace Layout */
            .mai-workspace-layout {
                position: relative;
                z-index: 10;
                display: flex;
                flex: 1;
                min-height: 0;
                overflow: hidden;
            }

            /* History Drawer */
            .mai-history-drawer {
                position: absolute;
                top: 0;
                left: 0;
                bottom: 0;
                width: 320px;
                max-width: 85vw;
                background: rgba(12, 14, 22, 0.88);
                backdrop-filter: blur(28px);
                -webkit-backdrop-filter: blur(28px);
                border-right: 1px solid rgba(255, 255, 255, 0.09);
                box-shadow: 12px 0 36px -8px rgba(0, 0, 0, 0.6);
                display: flex;
                flex-direction: column;
                transform: translateX(-105%);
                transition: transform 0.32s cubic-bezier(0.16, 1, 0.3, 1);
                z-index: 30;
            }
            .mai-history-drawer.open {
                transform: translateX(0);
            }

            .mai-history-header {
                padding: 16px 18px;
                border-bottom: 1px solid rgba(255, 255, 255, 0.07);
                display: flex;
                flex-direction: column;
                gap: 12px;
            }
            .mai-close-drawer-btn {
                width: 28px;
                height: 28px;
                border-radius: 8px;
                background: rgba(255, 255, 255, 0.05);
                border: 1px solid rgba(255, 255, 255, 0.1);
                color: #94a3b8;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                transition: all 0.18s ease;
            }
            .mai-close-drawer-btn:hover {
                background: rgba(255, 255, 255, 0.12);
                color: #ffffff;
            }
            .mai-history-search-wrap {
                position: relative;
                display: flex;
                align-items: center;
                gap: 8px;
                padding: 7px 12px;
                border-radius: 10px;
                background: rgba(255, 255, 255, 0.03);
                border: 1px solid rgba(255, 255, 255, 0.08);
            }
            .mai-history-search-input {
                width: 100%;
                background: transparent;
                border: none;
                outline: none;
                font-size: 12px;
                color: #f1f5f9;
            }
            .mai-history-search-input::placeholder {
                color: #64748b;
            }

            .mai-history-scroll {
                flex: 1;
                overflow-y: auto;
                padding: 12px 14px;
                display: flex;
                flex-direction: column;
                gap: 6px;
            }
            .mai-history-item {
                position: relative;
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 10px;
                padding: 10px 12px;
                border-radius: 12px;
                background: rgba(255, 255, 255, 0.025);
                border: 1px solid rgba(255, 255, 255, 0.05);
                cursor: pointer;
                transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
                text-align: left;
                user-select: none;
            }
            .mai-history-item:hover {
                background: rgba(56, 189, 248, 0.08);
                border-color: rgba(56, 189, 248, 0.25);
                transform: translateX(2px);
            }
            .mai-history-item.active {
                background: linear-gradient(135deg, rgba(56, 189, 248, 0.18), rgba(129, 140, 248, 0.1));
                border-color: rgba(56, 189, 248, 0.4);
                box-shadow: inset 0 1px 1px rgba(255, 255, 255, 0.2), 0 4px 12px -2px rgba(56, 189, 248, 0.25);
            }
            .mai-history-info {
                flex: 1;
                min-width: 0;
            }
            .mai-history-title {
                font-size: 12px;
                font-weight: 600;
                color: #e2e8f0;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }
            .mai-history-date {
                font-size: 10px;
                color: #64748b;
                margin-top: 2px;
            }
            .mai-history-del-btn {
                opacity: 0;
                padding: 4px;
                border-radius: 6px;
                background: rgba(244, 63, 94, 0.12);
                color: #f43f5e;
                border: 1px solid rgba(244, 63, 94, 0.25);
                cursor: pointer;
                transition: all 0.15s ease;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .mai-history-item:hover .mai-history-del-btn {
                opacity: 1;
            }
            .mai-history-del-btn:hover {
                background: #f43f5e;
                color: #ffffff;
            }

            /* Central Chat Canvas */
            .mai-chat-canvas {
                position: relative;
                flex: 1;
                display: flex;
                flex-direction: column;
                min-width: 0;
                height: 100%;
                overflow: hidden;
            }

            .mai-messages-container {
                flex: 1;
                overflow-y: auto;
                padding: 16px 20px 105px;
                display: flex;
                flex-direction: column;
                gap: 16px;
                scroll-behavior: smooth;
            }

            /* Zero-State Hero View (Compact, Zero-Overflow) */
            .mai-hero-view {
                max-width: 680px;
                margin: auto auto;
                text-align: center;
                display: flex;
                flex-direction: column;
                align-items: center;
                padding: 14px 12px;
            }
            .mai-hero-spark-wrap {
                position: relative;
                margin-bottom: 8px;
            }
            .mai-hero-spark-glow {
                position: absolute;
                inset: -4px;
                border-radius: 12px;
                background: linear-gradient(135deg, #9c051d, #c4203a);
                filter: blur(12px);
                opacity: 0.45;
            }
            .mai-hero-spark {
                position: relative;
                width: 42px;
                height: 42px;
                border-radius: 12px;
                background: linear-gradient(135deg, #181b2a, #0d0f1a);
                border: 1px solid rgba(255, 255, 255, 0.22);
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: 0 4px 16px rgba(0, 0, 0, 0.5);
            }
            .mai-hero-greeting {
                font-size: 20px;
                font-weight: 800;
                letter-spacing: -0.02em;
                color: #ffffff;
                margin-bottom: 4px;
            }
            .mai-hero-name {
                background: linear-gradient(135deg, #9c051d 0%, #c4203a 50%, #e8788a 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }
            .mai-hero-tagline {
                font-size: 12px;
                color: #94a3b8;
                max-width: 440px;
                margin-bottom: 14px;
                line-height: 1.4;
            }

            /* Compact Suggestions Pills */
            .mai-suggestions-pills {
                display: flex;
                flex-wrap: wrap;
                align-items: center;
                justify-content: center;
                gap: 8px;
                max-width: 620px;
                margin: 0 auto;
            }
            .mai-suggestion-pill {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                padding: 7px 13px;
                border-radius: 99px;
                font-size: 11.5px;
                font-weight: 500;
                color: #e2e8f0;
                background: rgba(255, 255, 255, 0.035);
                border: 1px solid rgba(255, 255, 255, 0.09);
                border-top: 1px solid rgba(255, 255, 255, 0.2);
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
                cursor: pointer;
                transition: all 0.18s cubic-bezier(0.16, 1, 0.3, 1);
                user-select: none;
                text-align: left;
            }
            .mai-suggestion-pill:hover {
                background: rgba(255, 255, 255, 0.08);
                border-color: rgba(156, 5, 29, 0.35);
                border-top-color: rgba(255, 255, 255, 0.4);
                color: #ffffff;
                transform: translateY(-1px);
                box-shadow: 0 4px 14px rgba(0, 0, 0, 0.4);
            }
            .mai-suggestion-pill:active {
                transform: translateY(0);
            }
            .mai-pill-dot {
                width: 6px;
                height: 6px;
                border-radius: 99px;
                flex-shrink: 0;
            }

            /* Message Bubbles */
            .mai-chat-stream {
                display: flex;
                flex-direction: column;
                gap: 22px;
                width: 100%;
                max-width: 860px;
                margin: 0 auto;
            }

            .mai-msg-row {
                display: flex;
                gap: 12px;
                width: 100%;
                animation: maiMsgSlideUp 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            }
            @keyframes maiMsgSlideUp {
                from { opacity: 0; transform: translateY(12px); }
                to { opacity: 1; transform: translateY(0); }
            }

            .mai-msg-row.user {
                justify-content: flex-end;
            }
            .mai-msg-row.user .mai-msg-bubble {
                max-width: 78%;
                background: linear-gradient(135deg, #5a0414 0%, #1e293b 100%);
                border: 1px solid rgba(56, 189, 248, 0.25);
                border-top: 1px solid rgba(255, 255, 255, 0.35);
                color: #f8fafc;
                padding: 13px 18px;
                border-radius: 20px;
                border-top-right-radius: 4px;
                font-size: 13.5px;
                line-height: 1.6;
                box-shadow: 0 6px 20px -3px rgba(0, 0, 0, 0.4);
                word-break: break-word;
            }

            .mai-msg-row.assistant {
                justify-content: flex-start;
            }
            .mai-avatar-spark {
                width: 34px;
                height: 34px;
                border-radius: 12px;
                background: linear-gradient(135deg, rgba(56, 189, 248, 0.2), rgba(192, 132, 252, 0.25));
                border: 1px solid rgba(255, 255, 255, 0.2);
                display: flex;
                align-items: center;
                justify-content: center;
                flex-shrink: 0;
                color: #9c051d;
                font-size: 14px;
                font-weight: 800;
                box-shadow: 0 4px 14px -2px rgba(56, 189, 248, 0.3);
                margin-top: 2px;
            }
            .mai-msg-row.assistant .mai-msg-content {
                flex: 1;
                min-width: 0;
                display: flex;
                flex-direction: column;
                gap: 8px;
            }
            .mai-msg-row.assistant .mai-msg-bubble {
                background: rgba(255, 255, 255, 0.035);
                border: 1px solid rgba(255, 255, 255, 0.08);
                border-top: 1px solid rgba(255, 255, 255, 0.2);
                backdrop-filter: blur(16px);
                -webkit-backdrop-filter: blur(16px);
                border-radius: 20px;
                border-top-left-radius: 4px;
                padding: 16px 20px;
                color: #e2e8f0;
                font-size: 13.5px;
                line-height: 1.65;
                box-shadow: 0 8px 30px -4px rgba(0, 0, 0, 0.35);
            }

            /* Markdown Typography */
            .mai-answer-markdown p { margin-bottom: 12px; }
            .mai-answer-markdown p:last-child { margin-bottom: 0; }
            .mai-answer-markdown h1, .mai-answer-markdown h2, .mai-answer-markdown h3 {
                color: #ffffff;
                font-weight: 700;
                margin: 16px 0 8px;
                letter-spacing: -0.01em;
            }
            .mai-answer-markdown h1 { font-size: 18px; }
            .mai-answer-markdown h2 { font-size: 16px; }
            .mai-answer-markdown h3 { font-size: 14px; }
            .mai-answer-markdown strong { color: #f8fafc; font-weight: 700; }
            .mai-answer-markdown em { color: #e8788a; font-style: italic; }
            .mai-answer-markdown ul, .mai-answer-markdown ol {
                margin: 10px 0 14px 20px;
                padding: 0;
            }
            .mai-answer-markdown ul { list-style-type: disc; }
            .mai-answer-markdown ol { list-style-type: decimal; }
            .mai-answer-markdown li { margin-bottom: 6px; }
            .mai-answer-markdown code:not(pre code) {
                background: rgba(56, 189, 248, 0.12);
                color: #9c051d;
                padding: 2px 6px;
                border-radius: 6px;
                font-size: 12px;
                font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
                border: 1px solid rgba(56, 189, 248, 0.2);
            }
            .mai-answer-markdown pre {
                position: relative;
                background: #090b12;
                border: 1px solid rgba(255, 255, 255, 0.1);
                border-radius: 12px;
                padding: 14px;
                margin: 14px 0;
                overflow-x: auto;
                font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
                font-size: 12px;
                color: #7dd3fc;
                line-height: 1.5;
            }
            .mai-copy-code-btn {
                position: absolute;
                top: 8px;
                right: 8px;
                padding: 4px 8px;
                border-radius: 6px;
                background: rgba(255, 255, 255, 0.08);
                border: 1px solid rgba(255, 255, 255, 0.15);
                color: #94a3b8;
                font-size: 11px;
                cursor: pointer;
                transition: all 0.15s ease;
            }
            .mai-copy-code-btn:hover {
                background: rgba(255, 255, 255, 0.18);
                color: #ffffff;
            }

            .mai-answer-markdown table {
                width: 100%;
                border-collapse: separate;
                border-spacing: 0;
                margin: 14px 0;
                border-radius: 12px;
                overflow: hidden;
                border: 1px solid rgba(255, 255, 255, 0.1);
                font-size: 12px;
            }
            .mai-answer-markdown th {
                background: rgba(255, 255, 255, 0.06);
                padding: 9px 12px;
                font-weight: 700;
                color: #e2e8f0;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
                text-align: left;
            }
            .mai-answer-markdown td {
                padding: 8px 12px;
                border-bottom: 1px solid rgba(255, 255, 255, 0.04);
                color: #cbd5e1;
            }
            .mai-answer-markdown tr:last-child td {
                border-bottom: none;
            }
            .mai-answer-markdown tr:nth-child(even) {
                background: rgba(255, 255, 255, 0.015);
            }

            /* Thought & SQL Inspector */
            .mai-inspector-accordion {
                margin-top: 10px;
                border-radius: 14px;
                border: 1px solid rgba(255, 255, 255, 0.08);
                background: rgba(10, 12, 20, 0.6);
                overflow: hidden;
            }
            .mai-inspector-trigger {
                width: 100%;
                padding: 9px 14px;
                display: flex;
                align-items: center;
                justify-content: space-between;
                background: rgba(255, 255, 255, 0.025);
                border: none;
                color: #94a3b8;
                font-size: 11.5px;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.2s ease;
            }
            .mai-inspector-trigger:hover {
                background: rgba(56, 189, 248, 0.06);
                color: #e2e8f0;
            }
            .mai-inspector-chevron {
                font-size: 10px;
                transition: transform 0.2s ease;
            }
            .mai-inspector-trigger.open .mai-inspector-chevron {
                transform: rotate(180deg);
            }
            .mai-inspector-content {
                display: none;
                padding: 12px 14px;
                border-top: 1px solid rgba(255, 255, 255, 0.06);
                font-size: 12px;
                line-height: 1.5;
                color: #cbd5e1;
                background: rgba(0, 0, 0, 0.25);
            }
            .mai-inspector-content.open {
                display: block;
            }
            .mai-inspector-section {
                margin-bottom: 10px;
            }
            .mai-inspector-section:last-child {
                margin-bottom: 0;
            }
            .mai-inspector-label {
                font-size: 10.5px;
                text-transform: uppercase;
                letter-spacing: 0.06em;
                color: #9c051d;
                font-weight: 700;
                margin-bottom: 4px;
            }
            .mai-sql-block {
                background: #06070a;
                border: 1px solid rgba(56, 189, 248, 0.2);
                border-radius: 8px;
                padding: 8px 12px;
                font-family: ui-monospace, SFMono-Regular, monospace;
                font-size: 11.5px;
                color: #7dd3fc;
                overflow-x: auto;
                white-space: pre-wrap;
            }

            .mai-msg-meta {
                display: flex;
                align-items: center;
                justify-content: space-between;
                font-size: 10.5px;
                color: #64748b;
                padding: 2px 4px;
            }
            .mai-msg-tools {
                display: flex;
                align-items: center;
                gap: 8px;
            }
            .mai-tool-btn {
                background: transparent;
                border: none;
                color: #64748b;
                cursor: pointer;
                padding: 2px 4px;
                border-radius: 4px;
                font-size: 11px;
                transition: color 0.15s ease;
            }
            .mai-tool-btn:hover {
                color: #e2e8f0;
            }

            /* Pulsating Thinking Indicator */
            .mai-thinking-row {
                display: flex;
                align-items: center;
                gap: 12px;
                padding: 8px 14px;
                border-radius: 14px;
                background: rgba(255, 255, 255, 0.03);
                border: 1px solid rgba(56, 189, 248, 0.2);
                width: fit-content;
                animation: maiMsgSlideUp 0.25s ease;
            }
            .mai-thinking-dots {
                display: flex;
                gap: 4px;
            }
            .mai-thinking-dots span {
                width: 6px;
                height: 6px;
                border-radius: 99px;
                background: #9c051d;
                animation: maiDotPulse 1.4s infinite ease-in-out both;
            }
            .mai-thinking-dots span:nth-child(1) { animation-delay: -0.32s; }
            .mai-thinking-dots span:nth-child(2) { animation-delay: -0.16s; }
            @keyframes maiDotPulse {
                0%, 80%, 100% { transform: scale(0); opacity: 0.3; }
                40% { transform: scale(1); opacity: 1; }
            }
            .mai-thinking-text {
                font-size: 12px;
                color: #94a3b8;
                font-weight: 500;
            }

            /* Floating Input Capsule */
            .mai-dock-wrapper {
                position: absolute;
                left: 0;
                right: 0;
                bottom: 12px;
                z-index: 25;
                padding: 0 16px;
                pointer-events: none;
                display: flex;
                justify-content: center;
            }
            .mai-dock-capsule {
                pointer-events: auto;
                width: 100%;
                max-width: 820px;
                background: rgba(14, 17, 27, 0.82);
                backdrop-filter: blur(28px);
                -webkit-backdrop-filter: blur(28px);
                border: 1px solid rgba(255, 255, 255, 0.12);
                border-top: 1px solid rgba(255, 255, 255, 0.35);
                border-radius: 22px;
                padding: 10px 14px 8px;
                box-shadow: 0 16px 48px -8px rgba(0, 0, 0, 0.7), inset 0 1px 1px 0 rgba(255, 255, 255, 0.25);
                transition: all 0.22s ease;
            }
            .mai-dock-capsule:focus-within {
                border-color: rgba(56, 189, 248, 0.45);
                border-top-color: rgba(255, 255, 255, 0.6);
                box-shadow: 0 20px 54px -6px rgba(56, 189, 248, 0.25), inset 0 1px 2px 0 rgba(255, 255, 255, 0.4);
            }
            .mai-dock-top-row {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 0 4px 6px;
                font-size: 10px;
                color: #64748b;
            }
            .mai-dock-status {
                display: flex;
                align-items: center;
                gap: 5px;
                color: #94a3b8;
                font-weight: 500;
            }
            .mai-dock-counter {
                font-variant-numeric: tabular-nums;
            }

            .mai-input-row {
                display: flex;
                align-items: flex-end;
                gap: 10px;
            }
            #maiUserInput {
                flex: 1;
                background: transparent;
                border: none;
                outline: none;
                resize: none;
                color: #f1f5f9;
                font-size: 13.5px;
                line-height: 1.5;
                padding: 4px 6px;
                max-height: 160px;
                font-family: inherit;
            }
            #maiUserInput::placeholder {
                color: #64748b;
            }

            .liquid-btn-send {
                position: relative;
                width: 38px;
                height: 38px;
                border-radius: 14px;
                background: linear-gradient(135deg, #9c051d 0%, #6366f1 60%, #a855f7 100%);
                border: 1px solid rgba(255, 255, 255, 0.4);
                color: #ffffff;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                box-shadow: inset 0 1px 1px rgba(255, 255, 255, 0.6), 0 4px 16px rgba(56, 189, 248, 0.4);
                transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
                flex-shrink: 0;
                margin-bottom: 2px;
            }
            .liquid-btn-send:hover:not(:disabled) {
                transform: scale(1.06) translateY(-1px);
                box-shadow: inset 0 1px 2px rgba(255, 255, 255, 0.8), 0 8px 24px rgba(99, 102, 241, 0.6);
            }
            .liquid-btn-send:active:not(:disabled) {
                transform: scale(0.96);
            }
            .liquid-btn-send:disabled {
                opacity: 0.4;
                cursor: not-allowed;
                filter: grayscale(0.6);
            }

            .mai-dock-footer {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
                padding: 6px 4px 2px;
                font-size: 10px;
                color: #64748b;
            }
            .mai-kbd {
                background: rgba(255, 255, 255, 0.08);
                border: 1px solid rgba(255, 255, 255, 0.12);
                border-radius: 4px;
                padding: 1px 4px;
                font-size: 9px;
                color: #cbd5e1;
            }

            /* Modal Backdrop & Card */
            .mai-modal-backdrop {
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, 0.7);
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
                z-index: 100;
                display: none;
                align-items: center;
                justify-content: center;
                padding: 20px;
            }
            .mai-modal-backdrop.open {
                display: flex;
                animation: maiModalFade 0.22s ease;
            }
            @keyframes maiModalFade {
                from { opacity: 0; }
                to { opacity: 1; }
            }
            .mai-modal-content {
                width: 100%;
                max-width: 640px;
                background: #0d101a;
                border: 1px solid rgba(255, 255, 255, 0.12);
                border-top: 1px solid rgba(255, 255, 255, 0.3);
                border-radius: 20px;
                box-shadow: 0 24px 64px rgba(0, 0, 0, 0.7);
                overflow: hidden;
                display: flex;
                flex-direction: column;
            }
            .mai-modal-header {
                padding: 16px 20px;
                border-bottom: 1px solid rgba(255, 255, 255, 0.08);
                display: flex;
                align-items: center;
                justify-content: space-between;
            }
            .mai-modal-body {
                padding: 20px;
                max-height: 60vh;
                overflow-y: auto;
            }
            .mai-modal-footer {
                padding: 14px 20px;
                border-top: 1px solid rgba(255, 255, 255, 0.08);
                background: rgba(0, 0, 0, 0.2);
            }
            .mai-schema-card {
                background: rgba(255, 255, 255, 0.03);
                border: 1px solid rgba(255, 255, 255, 0.06);
                border-radius: 12px;
                padding: 10px 14px;
            }
            .mai-schema-title {
                font-family: ui-monospace, SFMono-Regular, monospace;
                font-size: 12px;
                font-weight: 700;
                color: #9c051d;
                margin-bottom: 3px;
            }
            .mai-schema-desc {
                font-size: 11px;
                color: #94a3b8;
                line-height: 1.4;
            }

            .mai-shimmer-bar {
                height: 38px;
                border-radius: 10px;
                background: linear-gradient(90deg, rgba(255,255,255,0.03) 25%, rgba(255,255,255,0.07) 50%, rgba(255,255,255,0.03) 75%);
                background-size: 200% 100%;
                animation: maiShimmer 1.8s infinite;
                margin-bottom: 8px;
            }
            @keyframes maiShimmer {
                0% { background-position: 200% 0; }
                100% { background-position: -200% 0; }
            }
        </style>

        {{-- ── JAVASCRIPT: REAL GEMINI CHAT ENGINE & CONVERSATION CONTROLLER ── --}}
        <script>
        (function () {
            'use strict';

            const CHAT_URL         = '{{ route("monarch.mai.chat") }}';
            const CONVS_URL        = '{{ route("monarch.mai.conversations") }}';
            const CONV_BASE        = '{{ url("/monarch/mai/api/conversations") }}';
            const CSRF_TOKEN       = '{{ csrf_token() }}';
            const USER_INITIALS    = '{{ $adminInitials ?? "AD" }}';

            let activeConvId       = null;
            let chatHistory        = [];
            let conversationList   = [];
            let isWaitingResponse  = false;
            let isDrawerOpen       = false;

            const drawer           = document.getElementById('maiHistoryDrawer');
            const historyListEl    = document.getElementById('maiHistoryList');
            const historyBadge     = document.getElementById('maiHistoryBadge');
            const heroView         = document.getElementById('maiHeroView');
            const chatStream       = document.getElementById('maiChatStream');
            const messagesFeed     = document.getElementById('maiMessagesFeed');
            const userInput        = document.getElementById('maiUserInput');
            const sendBtn          = document.getElementById('maiSendBtn');
            const charCount        = document.getElementById('maiCharCount');
            const schemaModal      = document.getElementById('maiSchemaModal');
            const historyToggleBtn = document.getElementById('maiToggleHistoryBtn');

            function initChat() {
                maiFetchConversations();
                if (userInput) userInput.focus();
            }

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initChat);
            } else {
                initChat();
            }

            window.maiHandleInputResize = function (el) {
                el.style.height = 'auto';
                el.style.height = Math.min(el.scrollHeight, 160) + 'px';
                if (charCount) {
                    charCount.textContent = `${el.value.length} / 2000`;
                }
            };

            window.maiHandleKeyDown = function (e) {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    maiSendMessage();
                }
            };

            window.maiQuickPrompt = function (text) {
                if (userInput) {
                    userInput.value = text;
                    maiHandleInputResize(userInput);
                    userInput.focus();
                    maiSendMessage();
                }
            };

            window.maiSwitchTab = function (tab) {
                // Update tab buttons
                ['chat', 'history', 'schema'].forEach(function (t) {
                    const btn = document.getElementById('maiTab' + t.charAt(0).toUpperCase() + t.slice(1) + 'Btn');
                    if (btn) {
                        const isActive = (t === tab);
                        btn.classList.toggle('active', isActive);
                        btn.setAttribute('aria-selected', isActive ? 'true' : 'false');
                    }
                });

                if (tab === 'chat') {
                    if (drawer) drawer.classList.remove('open');
                    if (schemaModal) schemaModal.classList.remove('open');
                    isDrawerOpen = false;
                    if (userInput) userInput.focus();
                } else if (tab === 'history') {
                    if (schemaModal) schemaModal.classList.remove('open');
                    if (drawer) {
                        drawer.classList.add('open');
                        isDrawerOpen = true;
                    }
                    maiFetchConversations();
                } else if (tab === 'schema') {
                    if (drawer) drawer.classList.remove('open');
                    isDrawerOpen = false;
                    if (schemaModal) schemaModal.classList.add('open');
                }
            };

            window.maiToggleHistory = function () {
                isDrawerOpen = !isDrawerOpen;
                if (drawer) {
                    drawer.classList.toggle('open', isDrawerOpen);
                }
                const histBtn = document.getElementById('maiTabHistoryBtn');
                const chatBtn = document.getElementById('maiTabChatBtn');
                if (histBtn) histBtn.classList.toggle('active', isDrawerOpen);
                if (chatBtn) chatBtn.classList.toggle('active', !isDrawerOpen);
                if (historyToggleBtn) {
                    historyToggleBtn.classList.toggle('active', isDrawerOpen);
                }
            };

            window.maiToggleSchemaModal = function (e) {
                if (e && e.target !== schemaModal) return;
                const isOpen = schemaModal ? schemaModal.classList.toggle('open') : false;
                const schemaBtn = document.getElementById('maiTabSchemaBtn');
                const chatBtn = document.getElementById('maiTabChatBtn');
                if (schemaBtn) schemaBtn.classList.toggle('active', isOpen);
                if (chatBtn) chatBtn.classList.toggle('active', !isOpen);
            };

            function maiFetchConversations() {
                fetch(CONVS_URL, {
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': CSRF_TOKEN
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.ok && Array.isArray(data.conversations)) {
                        conversationList = data.conversations;
                        if (historyBadge) historyBadge.textContent = conversationList.length;
                        maiRenderHistory(conversationList);
                    }
                })
                .catch(err => console.error('MAI: Error loading history list', err));
            }

            function maiRenderHistory(items) {
                if (!historyListEl) return;
                if (!items || items.length === 0) {
                    historyListEl.innerHTML = `
                        <div style="text-align:center;padding:36px 16px;color:#64748b;font-size:12px;">
                            <svg class="w-8 h-8 mx-auto mb-2 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                            No past inquiries yet.<br>Ask your first question!
                        </div>
                    `;
                    return;
                }

                let html = '';
                items.forEach(c => {
                    const isActive = (c.id === activeConvId);
                    html += `
                        <div class="mai-history-item ${isActive ? 'active' : ''}" data-id="${c.id}" onclick="maiLoadPastChat(${c.id})">
                            <div class="mai-history-info">
                                <p class="mai-history-title" title="${escapeHtml(c.title)}">${escapeHtml(c.title)}</p>
                                <p class="mai-history-date">${escapeHtml(c.updated_at || c.created_at)}</p>
                            </div>
                            <button type="button" class="mai-history-del-btn" onclick="maiDeleteChat(event, ${c.id})" title="Delete conversation">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </div>
                    `;
                });
                historyListEl.innerHTML = html;
            }

            window.maiFilterHistory = function (query) {
                const q = query.toLowerCase().trim();
                if (!q) {
                    maiRenderHistory(conversationList);
                    return;
                }
                const filtered = conversationList.filter(c => c.title.toLowerCase().includes(q));
                maiRenderHistory(filtered);
            };

            window.maiNewChat = function () {
                activeConvId = null;
                chatHistory = [];
                if (chatStream) chatStream.innerHTML = '';
                if (heroView) heroView.style.display = 'flex';
                if (userInput) {
                    userInput.value = '';
                    maiHandleInputResize(userInput);
                    userInput.focus();
                }
                if (historyListEl) {
                    historyListEl.querySelectorAll('.mai-history-item').forEach(el => el.classList.remove('active'));
                }
                maiSwitchTab('chat');
            };

            window.maiClearCurrentChat = function () {
                maiNewChat();
            };

            window.maiLoadPastChat = function (id) {
                activeConvId = id;
                maiSwitchTab('chat');

                if (historyListEl) {
                    historyListEl.querySelectorAll('.mai-history-item').forEach(el => {
                        const elId = parseInt(el.getAttribute('data-id'), 10);
                        el.classList.toggle('active', elId === id);
                    });
                }

                if (heroView) heroView.style.display = 'none';
                if (chatStream) {
                    chatStream.innerHTML = `
                        <div style="text-align:center;padding:40px;color:#94a3b8;font-size:13px;">
                            <div class="mai-thinking-dots" style="justify-content:center;margin-bottom:8px;">
                                <span></span><span></span><span></span>
                            </div>
                            Loading past conversation…
                        </div>
                    `;
                }

                fetch(`${CONV_BASE}/${id}`, {
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': CSRF_TOKEN
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (!data.ok || !data.messages) {
                        if (chatStream) chatStream.innerHTML = '<div style="color:#f43f5e;text-align:center;padding:20px;">Could not load messages.</div>';
                        return;
                    }

                    if (chatStream) chatStream.innerHTML = '';
                    chatHistory = [];

                    data.messages.forEach(m => {
                        chatHistory.push({ role: m.role, content: m.content });
                        if (m.role === 'user') {
                            renderUserBubble(m.content, m.created_at);
                        } else {
                            renderAssistantBubble({
                                answer: m.content,
                                reasoning: m.reasoning,
                                sql: m.sql,
                                results_count: m.results_count,
                                results_preview: m.results_preview
                            }, m.created_at);
                        }
                    });

                    scrollToBottom();
                })
                .catch(err => {
                    console.error('MAI: Error loading chat messages', err);
                    if (chatStream) chatStream.innerHTML = '<div style="color:#f43f5e;text-align:center;padding:20px;">Failed to load chat history.</div>';
                });
            };

            window.maiDeleteChat = function (e, id) {
                e.stopPropagation();
                if (!confirm('Are you sure you want to delete this conversation from history?')) return;

                fetch(`${CONV_BASE}/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': CSRF_TOKEN
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.ok) {
                        conversationList = conversationList.filter(c => c.id !== id);
                        if (historyBadge) historyBadge.textContent = conversationList.length;
                        maiRenderHistory(conversationList);
                        if (activeConvId === id) {
                            maiNewChat();
                        }
                    }
                })
                .catch(err => console.error('MAI: Delete conversation failed', err));
            };

            window.maiSendMessage = function () {
                if (!userInput || isWaitingResponse) return;
                const text = userInput.value.trim();
                if (!text) return;

                if (heroView) heroView.style.display = 'none';

                renderUserBubble(text);
                chatHistory.push({ role: 'user', content: text });

                userInput.value = '';
                maiHandleInputResize(userInput);

                const thinkingId = 'thinking-' + Date.now();
                renderThinkingIndicator(thinkingId);
                scrollToBottom();

                setBusy(true);

                fetch(CHAT_URL, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': CSRF_TOKEN
                    },
                    body: JSON.stringify({
                        message: text,
                        conversation_id: activeConvId,
                        history: chatHistory.slice(0, -1)
                    })
                })
                .then(res => res.json().then(data => ({ status: res.status, data })))
                .then(result => {
                    removeThinkingIndicator(thinkingId);
                    setBusy(false);

                    if (result.status !== 200 || !result.data.ok) {
                        const errMsg = (result.data && (result.data.error || result.data.message))
                            ? (result.data.error || result.data.message)
                            : `Gemini inference error (${result.status}). Please verify GEMINI_API_KEY in .env.`;
                        renderErrorBubble(errMsg);
                        scrollToBottom();
                        return;
                    }

                    const d = result.data;
                    if (d.conversation_id) {
                        activeConvId = d.conversation_id;
                        maiFetchConversations();
                    }

                    renderAssistantBubble(d);
                    chatHistory.push({ role: 'assistant', content: d.answer });
                    scrollToBottom();
                })
                .catch(err => {
                    removeThinkingIndicator(thinkingId);
                    setBusy(false);
                    renderErrorBubble('Network connection error: ' + err.message);
                    scrollToBottom();
                });
            };

            function renderUserBubble(text, time) {
                const row = document.createElement('div');
                row.className = 'mai-msg-row user';
                row.innerHTML = `
                    <div class="mai-msg-bubble">
                        ${escapeHtml(text)}
                        ${time ? `<div class="mai-msg-meta" style="justify-content:flex-end;margin-top:4px;"><span>${escapeHtml(time)}</span></div>` : ''}
                    </div>
                `;
                chatStream.appendChild(row);
            }

            function renderAssistantBubble(data, time) {
                const row = document.createElement('div');
                row.className = 'mai-msg-row assistant';

                let inspectorHtml = '';
                if (data.reasoning || data.sql) {
                    const uniqueId = 'insp-' + Math.random().toString(36).substr(2, 9);
                    let sqlRowsPreview = '';

                    if (data.results_preview && data.results_preview.length > 0) {
                        const cols = Object.keys(data.results_preview[0]);
                        const header = cols.map(c => `<th>${escapeHtml(c)}</th>`).join('');
                        const rows = data.results_preview.slice(0, 10).map(r => {
                            const tds = cols.map(c => {
                                const val = r[c] !== null && r[c] !== undefined ? String(r[c]) : 'NULL';
                                return `<td title="${escapeHtml(val)}">${escapeHtml(val.length > 35 ? val.slice(0, 35) + '…' : val)}</td>`;
                            }).join('');
                            return `<tr>${tds}</tr>`;
                        }).join('');

                        sqlRowsPreview = `
                            <div class="mai-inspector-section">
                                <div class="mai-inspector-label">Query Results Preview (${data.results_count ?? data.results_preview.length} rows)</div>
                                <div style="overflow-x:auto;">
                                    <table>
                                        <thead><tr>${header}</tr></thead>
                                        <tbody>${rows}</tbody>
                                    </table>
                                </div>
                            </div>
                        `;
                    }

                    inspectorHtml = `
                        <div class="mai-inspector-accordion">
                            <button type="button" class="mai-inspector-trigger" onclick="maiToggleInspector('${uniqueId}', this)">
                                <span class="flex items-center gap-1.5">
                                    <span>🧠 Intent Reasoning & Executed SQL</span>
                                    ${data.results_count !== null && data.results_count !== undefined ? `<span class="px-1.5 py-0.5 rounded bg-cyan-500/20 text-cyan-400 text-[10px]">${data.results_count} rows</span>` : ''}
                                </span>
                                <span class="mai-inspector-chevron">▼</span>
                            </button>
                            <div class="mai-inspector-content" id="${uniqueId}">
                                ${data.reasoning ? `
                                    <div class="mai-inspector-section">
                                        <div class="mai-inspector-label">Internal AI Intent Reasoning</div>
                                        <p style="white-space:pre-wrap;font-size:11.5px;color:#94a3b8;">${escapeHtml(data.reasoning)}</p>
                                    </div>
                                ` : ''}
                                ${data.sql ? `
                                    <div class="mai-inspector-section">
                                        <div class="mai-inspector-label">PostgreSQL Query (Safe SELECT only)</div>
                                        <div class="mai-sql-block">${escapeHtml(data.sql)}</div>
                                    </div>
                                ` : ''}
                                ${sqlRowsPreview}
                            </div>
                        </div>
                    `;
                }

                const formattedMarkdown = renderMarkdown(data.answer || '');

                row.innerHTML = `
                    <div class="mai-avatar-spark">✦</div>
                    <div class="mai-msg-content">
                        <div class="mai-msg-bubble">
                            <div class="mai-answer-markdown">${formattedMarkdown}</div>
                            ${inspectorHtml}
                        </div>
                        <div class="mai-msg-meta">
                            <div class="mai-msg-tools">
                                <button type="button" class="mai-tool-btn" onclick="maiCopyAnswer(this)" title="Copy markdown answer">
                                    Copy text
                                </button>
                                <span>•</span>
                                <span>Gemini Verified</span>
                            </div>
                            ${time ? `<span>${escapeHtml(time)}</span>` : ''}
                        </div>
                    </div>
                `;
                chatStream.appendChild(row);
            }

            function renderErrorBubble(text) {
                const row = document.createElement('div');
                row.className = 'mai-msg-row assistant';
                row.innerHTML = `
                    <div class="mai-avatar-spark" style="color:#f43f5e;border-color:rgba(244,63,94,0.3);background:rgba(244,63,94,0.15);">⚠</div>
                    <div class="mai-msg-content">
                        <div class="mai-msg-bubble" style="border-color:rgba(244,63,94,0.3);background:rgba(244,63,94,0.06);">
                            <p style="color:#fda4af;font-weight:600;margin-bottom:4px;">MAI Operations Notice</p>
                            <p style="color:#fecdd3;font-size:13px;">${escapeHtml(text)}</p>
                        </div>
                    </div>
                `;
                chatStream.appendChild(row);
            }

            function renderThinkingIndicator(id) {
                const el = document.createElement('div');
                el.id = id;
                el.className = 'mai-msg-row assistant';
                el.innerHTML = `
                    <div class="mai-avatar-spark">✦</div>
                    <div class="mai-thinking-row">
                        <div class="mai-thinking-dots">
                            <span></span><span></span><span></span>
                        </div>
                        <span class="mai-thinking-text">MAI is querying PostgreSQL & synthesising answer…</span>
                    </div>
                `;
                chatStream.appendChild(el);
            }

            function removeThinkingIndicator(id) {
                const el = document.getElementById(id);
                if (el) el.remove();
            }

            window.maiToggleInspector = function (id, btn) {
                const content = document.getElementById(id);
                if (!content) return;
                const isOpen = content.classList.toggle('open');
                btn.classList.toggle('open', isOpen);
            };

            window.maiCopyAnswer = function (btn) {
                const bubble = btn.closest('.mai-msg-content')?.querySelector('.mai-answer-markdown');
                if (!bubble) return;
                navigator.clipboard.writeText(bubble.innerText.trim()).then(() => {
                    const orig = btn.textContent;
                    btn.textContent = '✓ Copied!';
                    setTimeout(() => { btn.textContent = orig; }, 1800);
                });
            };

            window.maiCopyCode = function (btn) {
                const pre = btn.closest('pre');
                if (!pre) return;
                const code = pre.querySelector('code')?.innerText || pre.innerText.replace('Copy', '');
                navigator.clipboard.writeText(code.trim()).then(() => {
                    const orig = btn.textContent;
                    btn.textContent = 'Copied!';
                    setTimeout(() => { btn.textContent = orig; }, 1800);
                });
            };

            function renderMarkdown(md) {
                if (!md) return '';
                let html = md;

                html = html.replace(/```(\w*)\n?([\s\S]*?)```/g, function (_, lang, code) {
                    return '<pre><button type="button" class="mai-copy-code-btn" onclick="maiCopyCode(this)">Copy<' + '/button><code>' + escapeHtml(code.trim()) + '<' + '/code><' + '/pre>';
                });

                html = html.replace(/`([^`]+)`/g, '<code>$1<' + '/code>');

                html = html.replace(/^### (.+)$/gm, '<h3>$1<' + '/h3>');
                html = html.replace(/^## (.+)$/gm, '<h2>$1<' + '/h2>');
                html = html.replace(/^# (.+)$/gm, '<h1>$1<' + '/h1>');

                html = html.replace(/\*\*(.+?)\*\*/g, '<strong>$1<' + '/strong>');
                html = html.replace(/\*(.+?)\*/g, '<em>$1<' + '/em>');

                html = html.replace(/((?:\|.+\|\n?)+)/g, function (table) {
                    const lines = table.trim().split('\n');
                    let res = '<table>';
                    let isHead = true;
                    lines.forEach(line => {
                        if (/^\|[-|\s]+\|$/.test(line.trim())) { isHead = false; return; }
                        const cells = line.trim().replace(/^\||\|$/g, '').split('|');
                        const tag = isHead ? 'th' : 'td';
                        res += '<tr>' + cells.map(c => '<' + tag + '>' + c.trim() + '<' + '/' + tag + '>').join('') + '<' + '/tr>';
                        if (isHead) isHead = false;
                    });
                    return res + '<' + '/table>';
                });

                html = html.replace(/((?:^[-*] .+\n?)+)/gm, function (list) {
                    const items = list.trim().split('\n').map(l => '<li>' + l.replace(/^[-*] /, '') + '<' + '/li>').join('');
                    return '<ul>' + items + '<' + '/ul>';
                });
                html = html.replace(/((?:^\d+\. .+\n?)+)/gm, function (list) {
                    const items = list.trim().split('\n').map(l => '<li>' + l.replace(/^\d+\. /, '') + '<' + '/li>').join('');
                    return '<ol>' + items + '<' + '/ol>';
                });

                html = html.replace(/\n\n+/g, '<' + '/p><p>');
                html = html.replace(/\n/g, '<br>');
                html = '<p>' + html + '<' + '/p>';

                return html;
            }

            function setBusy(busy) {
                isWaitingResponse = busy;
                if (sendBtn) sendBtn.disabled = busy;
                if (userInput) userInput.disabled = busy;
            }

            function scrollToBottom() {
                setTimeout(() => {
                    if (messagesFeed) messagesFeed.scrollTop = messagesFeed.scrollHeight;
                }, 50);
            }

            function escapeHtml(str) {
                const map = { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;' };
                return String(str ?? '').replace(/[&<>"']/g, function(m) { return map[m]; });
            }
        })();
        </script>

    </div>
</x-filament-panels::page>
