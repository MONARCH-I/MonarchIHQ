<div class="fi-wi rounded-3xl bg-gradient-to-br from-[#0c0e18] via-[#090a10] to-[#121526] border border-white/10 p-6 shadow-2xl relative overflow-hidden">
    {{-- Ambient light --}}
    <div class="absolute -right-16 -bottom-16 w-64 h-64 bg-cyan-500/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -left-16 -top-16 w-64 h-64 bg-purple-500/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="flex items-center justify-between gap-4 mb-5 relative z-10">
        <div class="flex items-center gap-3.5">
            <div class="w-11 h-11 rounded-2xl bg-gradient-to-tr from-cyan-500/20 via-indigo-500/20 to-purple-500/30 border border-white/20 flex items-center justify-center shadow-lg shadow-cyan-500/10">
                <svg class="w-6 h-6 text-cyan-400" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2L14.4 9.6L22 12L14.4 14.4L12 22L9.6 14.4L2 12L9.6 9.6L12 2Z" fill="currentColor"/>
                </svg>
            </div>
            <div>
                <div class="flex items-center gap-2">
                    <h3 class="text-white font-bold text-base tracking-tight">MAI — Monarchi AI Engine</h3>
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-emerald-500/15 text-emerald-400 border border-emerald-500/30">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                        Live Online
                    </span>
                </div>
                <p class="text-gray-400 text-xs mt-0.5">Powered by Google Gemini ({{ config('services.gemini.model', 'gemini-3.6-flash') }}) with Zero-Shot PostgreSQL</p>
            </div>
        </div>

        <a href="{{ url('/monarch/mai') }}"
           class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-xs font-bold text-white transition-all
                  bg-gradient-to-r from-cyan-500/25 via-indigo-500/25 to-purple-500/25
                  hover:from-cyan-500/40 hover:via-indigo-500/40 hover:to-purple-500/40
                  border border-white/20 hover:border-white/40
                  shadow-lg shadow-cyan-500/15 hover:scale-[1.02] active:scale-[0.98]">
            <span>Open MAI Chat</span>
            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
            </svg>
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-3 relative z-10">
        <div class="p-3.5 rounded-2xl bg-white/[0.03] border border-white/5 flex items-start gap-3">
            <span class="text-lg">📊</span>
            <div>
                <p class="text-xs font-semibold text-white">Metrics & Financials</p>
                <p class="text-[11px] text-gray-400 mt-0.5">Real-time revenue, order volume & payment breakdown</p>
            </div>
        </div>
        <div class="p-3.5 rounded-2xl bg-white/[0.03] border border-white/5 flex items-start gap-3">
            <span class="text-lg">📦</span>
            <div>
                <p class="text-xs font-semibold text-white">Inventory Intelligence</p>
                <p class="text-[11px] text-gray-400 mt-0.5">Instant low stock audits and supplier PO drafts</p>
            </div>
        </div>
        <div class="p-3.5 rounded-2xl bg-white/[0.03] border border-white/5 flex items-start gap-3">
            <span class="text-lg">⚡</span>
            <div>
                <p class="text-xs font-semibold text-white">Direct PostgreSQL Access</p>
                <p class="text-[11px] text-gray-400 mt-0.5">Safe SELECT queries with full reasoning & preview</p>
            </div>
        </div>
    </div>
</div>
