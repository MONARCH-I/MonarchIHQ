<x-filament-panels::page>
    <div class="space-y-6">

        {{-- ── TOP HERO / SYSTEM STATUS ────────────────────────────────────────── --}}
        <div class="rounded-2xl bg-gradient-to-r from-gray-950 via-gray-900 to-amber-950/40 border border-white/10 p-6 shadow-xl relative overflow-hidden">
            <div class="absolute -right-12 -bottom-12 w-64 h-64 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>

            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 relative z-10">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-amber-500/20 border border-amber-500/30 flex items-center justify-center shadow-lg shadow-amber-500/10">
                        <svg class="w-7 h-7 text-amber-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09Z" />
                        </svg>
                    </div>
                    <div>
                        <div class="flex items-center gap-2.5">
                            <h2 class="text-xl font-bold text-white tracking-tight">MAI — Monarchi AI Assistant</h2>
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-500/20 text-amber-400 border border-amber-500/30">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-400 animate-pulse"></span>
                                v2.4 Active
                            </span>
                        </div>
                        <p class="text-gray-400 text-sm mt-0.5">Enterprise intelligence engine for SaaS metrics, supply chain, CRM & custom dev operations.</p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <div class="px-3.5 py-2 rounded-xl bg-white/5 border border-white/10 text-xs text-gray-300 flex items-center gap-2">
                        <span class="text-gray-400">Context:</span>
                        <span class="font-semibold text-white">Full MonarchiHQ DB</span>
                    </div>
                    <div class="px-3.5 py-2 rounded-xl bg-white/5 border border-white/10 text-xs text-gray-300 flex items-center gap-2">
                        <span class="text-gray-400">Engine:</span>
                        <span class="font-semibold text-amber-400">Gemini 2.5 Pro</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── MAIN WORKSPACE GRID ────────────────────────────────────────────── --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- ── LEFT: QUICK ACTIONS & CAPABILITIES (1 COL) ─────────────────── --}}
            <div class="space-y-6">

                {{-- Suggested Prompts Card --}}
                <div class="rounded-2xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-white/10 p-5 shadow-sm">
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white uppercase tracking-wider mb-4 flex items-center gap-2">
                        <svg class="w-4 h-4 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        Quick Command Workflows
                    </h3>

                    <div class="space-y-2.5">
                        <button onclick="fillPrompt('Analyze this month\'s SaaS churn rate and suggest 3 customer retention strategies.')" class="w-full text-left p-3 rounded-xl bg-gray-50 dark:bg-white/5 hover:bg-amber-500/10 hover:border-amber-500/30 border border-transparent dark:border-white/5 transition-all text-xs text-gray-700 dark:text-gray-300 flex items-start gap-2.5 group">
                            <span class="text-amber-500 font-bold mt-0.5">📊</span>
                            <div class="flex-1">
                                <p class="font-semibold text-gray-900 dark:text-white group-hover:text-amber-400 transition-colors">SaaS Churn Analysis</p>
                                <p class="text-gray-500 text-[11px] mt-0.5">Analyze churn trend & generate retention playbook</p>
                            </div>
                        </button>

                        <button onclick="fillPrompt('List all products with stock below threshold and generate a supplier PO draft in GHS.')" class="w-full text-left p-3 rounded-xl bg-gray-50 dark:bg-white/5 hover:bg-amber-500/10 hover:border-amber-500/30 border border-transparent dark:border-white/5 transition-all text-xs text-gray-700 dark:text-gray-300 flex items-start gap-2.5 group">
                            <span class="text-amber-500 font-bold mt-0.5">📦</span>
                            <div class="flex-1">
                                <p class="font-semibold text-gray-900 dark:text-white group-hover:text-amber-400 transition-colors">Inventory Restock Orders</p>
                                <p class="text-gray-500 text-[11px] mt-0.5">Identify low stock & draft purchase orders</p>
                            </div>
                        </button>

                        <button onclick="fillPrompt('Draft a custom software proposal for an enterprise banking client needing 24/7 biometric access and high-throughput server architecture.')" class="w-full text-left p-3 rounded-xl bg-gray-50 dark:bg-white/5 hover:bg-amber-500/10 hover:border-amber-500/30 border border-transparent dark:border-white/5 transition-all text-xs text-gray-700 dark:text-gray-300 flex items-start gap-2.5 group">
                            <span class="text-amber-500 font-bold mt-0.5">📝</span>
                            <div class="flex-1">
                                <p class="font-semibold text-gray-900 dark:text-white group-hover:text-amber-400 transition-colors">Custom Dev Proposal</p>
                                <p class="text-gray-500 text-[11px] mt-0.5">Draft comprehensive client solution scope</p>
                            </div>
                        </button>

                        <button onclick="fillPrompt('Summarize total GMV and sales volume across all product categories over the last 30 days.')" class="w-full text-left p-3 rounded-xl bg-gray-50 dark:bg-white/5 hover:bg-amber-500/10 hover:border-amber-500/30 border border-transparent dark:border-white/5 transition-all text-xs text-gray-700 dark:text-gray-300 flex items-start gap-2.5 group">
                            <span class="text-amber-500 font-bold mt-0.5">📈</span>
                            <div class="flex-1">
                                <p class="font-semibold text-gray-900 dark:text-white group-hover:text-amber-400 transition-colors">Revenue & GMV Summary</p>
                                <p class="text-gray-500 text-[11px] mt-0.5">Category-level breakdown of sales revenue</p>
                            </div>
                        </button>
                    </div>
                </div>

                {{-- Integration Status Card --}}
                <div class="rounded-2xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-white/10 p-5 shadow-sm">
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white uppercase tracking-wider mb-3 flex items-center gap-2">
                        <svg class="w-4 h-4 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Connected Subsystems
                    </h3>
                    <ul class="space-y-2 text-xs">
                        <li class="flex items-center justify-between py-1.5 border-b border-gray-100 dark:border-white/5">
                            <span class="text-gray-600 dark:text-gray-400">E-Store Product DB</span>
                            <span class="text-emerald-500 font-semibold flex items-center gap-1"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Live</span>
                        </li>
                        <li class="flex items-center justify-between py-1.5 border-b border-gray-100 dark:border-white/5">
                            <span class="text-gray-600 dark:text-gray-400">Orders & Invoices</span>
                            <span class="text-emerald-500 font-semibold flex items-center gap-1"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Live</span>
                        </li>
                        <li class="flex items-center justify-between py-1.5 border-b border-gray-100 dark:border-white/5">
                            <span class="text-gray-600 dark:text-gray-400">Customer CRM</span>
                            <span class="text-emerald-500 font-semibold flex items-center gap-1"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Live</span>
                        </li>
                        <li class="flex items-center justify-between py-1.5">
                            <span class="text-gray-600 dark:text-gray-400">Gemini Live API</span>
                            <span class="text-amber-500 font-semibold flex items-center gap-1"><span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Ready (.env)</span>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- ── RIGHT: CHAT & INTERACTION WORKSPACE (2 COLS) ────────────────── --}}
            <div class="lg:col-span-2 flex flex-col h-[700px] rounded-2xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-white/10 shadow-sm overflow-hidden">

                {{-- Chat Header --}}
                <div class="px-6 py-4 border-b border-gray-200 dark:border-white/10 flex items-center justify-between bg-gray-50/50 dark:bg-white/[0.02]">
                    <div class="flex items-center gap-3">
                        <div class="w-3 h-3 rounded-full bg-emerald-500 ring-4 ring-emerald-500/20"></div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900 dark:text-white">Live Session: Executive Briefing</p>
                            <p class="text-[11px] text-gray-400">Stream encrypted • Response latency ~420ms</p>
                        </div>
                    </div>
                    <button onclick="clearChat()" class="text-xs text-gray-400 hover:text-gray-600 dark:hover:text-white transition flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        Clear Session
                    </button>
                </div>

                {{-- Chat Messages Area --}}
                <div id="chat-messages" class="flex-1 p-6 overflow-y-auto space-y-5">

                    {{-- Initial MAI Message --}}
                    <div class="flex items-start gap-3.5">
                        <div class="w-8 h-8 rounded-xl bg-amber-500/20 border border-amber-500/30 flex items-center justify-center shrink-0 mt-0.5">
                            <span class="text-xs font-bold text-amber-400">M</span>
                        </div>
                        <div class="flex-1 bg-gray-50 dark:bg-white/5 border border-gray-100 dark:border-white/5 rounded-2xl rounded-tl-sm p-4 text-sm text-gray-800 dark:text-gray-200 shadow-sm leading-relaxed">
                            <p class="font-semibold text-gray-900 dark:text-white mb-1.5">Monarchi AI Operations Online</p>
                            <p>Good day! I have synchronized with the MonarchiHQ database. Here is a quick snapshot of the system:</p>
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-2.5 my-3">
                                <div class="p-2.5 rounded-xl bg-white dark:bg-black/30 border border-gray-200 dark:border-white/5">
                                    <p class="text-[10px] text-gray-400 uppercase tracking-wider font-semibold">Active Products</p>
                                    <p class="text-base font-bold text-gray-900 dark:text-white mt-0.5">22 Items</p>
                                </div>
                                <div class="p-2.5 rounded-xl bg-white dark:bg-black/30 border border-gray-200 dark:border-white/5">
                                    <p class="text-[10px] text-gray-400 uppercase tracking-wider font-semibold">Categories</p>
                                    <p class="text-base font-bold text-gray-900 dark:text-white mt-0.5">10 Active</p>
                                </div>
                                <div class="p-2.5 rounded-xl bg-white dark:bg-black/30 border border-gray-200 dark:border-white/5 col-span-2 sm:col-span-1">
                                    <p class="text-[10px] text-gray-400 uppercase tracking-wider font-semibold">Store Health</p>
                                    <p class="text-base font-bold text-emerald-500 mt-0.5">100% Operational</p>
                                </div>
                            </div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">You can ask me to run business queries, generate client proposals, analyze inventory forecasts, or draft SQL & code.</p>
                        </div>
                    </div>

                </div>

                {{-- Chat Input Bar --}}
                <div class="p-4 border-t border-gray-200 dark:border-white/10 bg-gray-50/50 dark:bg-white/[0.02]">
                    <form onsubmit="handleSend(event)" class="flex items-center gap-3">
                        <div class="flex-1 relative">
                            <input type="text"
                                   id="mai-input"
                                   placeholder="Ask MAI anything about MonarchiHQ business, products, code or metrics…"
                                   class="w-full pl-4 pr-10 py-3 rounded-xl bg-white dark:bg-black/40 border border-gray-200 dark:border-white/10 text-sm text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 transition shadow-inner">
                        </div>
                        <button type="submit"
                                class="px-5 py-3 rounded-xl bg-amber-500 hover:bg-amber-400 active:scale-95 text-gray-950 font-bold text-sm transition-all flex items-center gap-2 shadow-lg shadow-amber-500/20">
                            <span>Send</span>
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </button>
                    </form>
                    <p class="text-[11px] text-gray-400 text-center mt-2.5">
                        Set <code class="bg-gray-200 dark:bg-white/10 px-1 py-0.5 rounded text-amber-500">GEMINI_API_KEY</code> in your environment file to connect real-time streaming inference.
                    </p>
                </div>
            </div>

        </div>

    </div>

    <script>
        function fillPrompt(text) {
            const input = document.getElementById('mai-input');
            if (input) {
                input.value = text;
                input.focus();
            }
        }

        function handleSend(e) {
            e.preventDefault();
            const input = document.getElementById('mai-input');
            const message = input.value.trim();
            if (!message) return;

            const container = document.getElementById('chat-messages');

            // User Message
            const userHtml = `
                <div class="flex items-start justify-end gap-3.5">
                    <div class="max-w-[80%] bg-amber-500 text-gray-950 rounded-2xl rounded-tr-sm p-4 text-sm font-medium shadow-sm">
                        ${escapeHtml(message)}
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', userHtml);
            input.value = '';
            container.scrollTop = container.scrollHeight;

            // Assistant Loading Indicator
            const loadingId = 'loading-' + Date.now();
            const loadingHtml = `
                <div id="${loadingId}" class="flex items-start gap-3.5">
                    <div class="w-8 h-8 rounded-xl bg-amber-500/20 border border-amber-500/30 flex items-center justify-center shrink-0 mt-0.5">
                        <span class="text-xs font-bold text-amber-400">M</span>
                    </div>
                    <div class="bg-gray-50 dark:bg-white/5 border border-gray-100 dark:border-white/5 rounded-2xl rounded-tl-sm p-4 text-sm text-gray-500 flex items-center gap-2">
                        <span class="inline-block w-2 h-2 rounded-full bg-amber-400 animate-bounce"></span>
                        <span class="inline-block w-2 h-2 rounded-full bg-amber-400 animate-bounce [animation-delay:0.2s]"></span>
                        <span class="inline-block w-2 h-2 rounded-full bg-amber-400 animate-bounce [animation-delay:0.4s]"></span>
                        <span class="text-xs text-gray-400 ml-1">MAI is thinking…</span>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', loadingHtml);
            container.scrollTop = container.scrollHeight;

            // Simulate intelligent response
            setTimeout(() => {
                const loader = document.getElementById(loadingId);
                if (loader) loader.remove();

                const replyHtml = `
                    <div class="flex items-start gap-3.5">
                        <div class="w-8 h-8 rounded-xl bg-amber-500/20 border border-amber-500/30 flex items-center justify-center shrink-0 mt-0.5">
                            <span class="text-xs font-bold text-amber-400">M</span>
                        </div>
                        <div class="flex-1 bg-gray-50 dark:bg-white/5 border border-gray-100 dark:border-white/5 rounded-2xl rounded-tl-sm p-4 text-sm text-gray-800 dark:text-gray-200 shadow-sm leading-relaxed">
                            <p class="font-semibold text-gray-900 dark:text-white mb-1">Analysis & Recommendation</p>
                            <p class="mb-2">Processed request for: <em>"${escapeHtml(message)}"</em></p>
                            <div class="p-3 rounded-xl bg-amber-500/10 border border-amber-500/20 text-xs text-amber-700 dark:text-amber-300 mb-2">
                                <strong>System Note:</strong> To stream live generative AI completions from Gemini 2.5 with zero-shot database tools, configure your <code>GEMINI_API_KEY</code> in <code>.env</code>.
                            </div>
                            <p class="text-xs text-gray-400">MAI session checkpoint saved.</p>
                        </div>
                    </div>
                `;
                container.insertAdjacentHTML('beforeend', replyHtml);
                container.scrollTop = container.scrollHeight;
            }, 900);
        }

        function clearChat() {
            const container = document.getElementById('chat-messages');
            container.innerHTML = `
                <div class="flex items-start gap-3.5">
                    <div class="w-8 h-8 rounded-xl bg-amber-500/20 border border-amber-500/30 flex items-center justify-center shrink-0 mt-0.5">
                        <span class="text-xs font-bold text-amber-400">M</span>
                    </div>
                    <div class="flex-1 bg-gray-50 dark:bg-white/5 border border-gray-100 dark:border-white/5 rounded-2xl rounded-tl-sm p-4 text-sm text-gray-800 dark:text-gray-200 shadow-sm leading-relaxed">
                        <p class="font-semibold text-gray-900 dark:text-white mb-1.5">Monarchi AI Operations Online</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Session cleared. Ask any inquiry or choose a quick command workflow on the left.</p>
                    </div>
                </div>
            `;
        }

        function escapeHtml(text) {
            const map = { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;' };
            return text.replace(/[&<>"']/g, function(m) { return map[m]; });
        }
    </script>
</x-filament-panels::page>
