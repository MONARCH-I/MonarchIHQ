<div class="fi-wi rounded-2xl bg-gradient-to-br from-gray-900 to-black border border-white/10 p-6 shadow-xl">
    <div class="flex items-center gap-3 mb-5">
        <div class="w-10 h-10 rounded-xl bg-amber-500/20 flex items-center justify-center">
            <svg class="w-5 h-5 text-amber-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09Z" />
            </svg>
        </div>
        <div>
            <h3 class="text-white font-semibold text-lg">MAI — Monarchi AI Assistant</h3>
            <p class="text-gray-400 text-xs">Your internal AI for business intelligence & ops</p>
        </div>
        <div class="ml-auto flex items-center gap-1.5">
            <span class="inline-block w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
            <span class="text-xs text-gray-400">Integration Pending</span>
        </div>
    </div>

    <div class="bg-white/5 rounded-xl p-4 mb-4 border border-white/5">
        <div class="flex gap-3">
            <div class="w-7 h-7 rounded-full bg-amber-500/30 flex items-center justify-center shrink-0">
                <span class="text-xs font-bold text-amber-400">M</span>
            </div>
            <div class="flex-1">
                <p class="text-white/80 text-sm leading-relaxed">
                    Hello! I'm MAI, your Monarchi AI assistant. Once connected, I can help you:
                </p>
                <ul class="mt-2 space-y-1 text-xs text-gray-400">
                    <li class="flex items-center gap-2"><span class="text-amber-400">→</span> Summarise business performance & generate reports</li>
                    <li class="flex items-center gap-2"><span class="text-amber-400">→</span> Answer questions about inventory, orders & customers</li>
                    <li class="flex items-center gap-2"><span class="text-amber-400">→</span> Draft proposals, emails & client communications</li>
                    <li class="flex items-center gap-2"><span class="text-amber-400">→</span> Identify trends and surface anomalies in your data</li>
                    <li class="flex items-center gap-2"><span class="text-amber-400">→</span> Generate custom code, SQL queries & API integrations</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="flex items-center gap-3">
        <div class="flex-1 bg-white/5 border border-white/10 rounded-xl px-4 py-3 flex items-center gap-2">
            <svg class="w-4 h-4 text-gray-500 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
            <span class="text-gray-500 text-sm">Ask MAI anything about your business…</span>
        </div>
        <button disabled class="px-5 py-3 bg-amber-500/30 text-amber-400 rounded-xl text-sm font-semibold cursor-not-allowed border border-amber-500/20">
            Connect API
        </button>
    </div>

    <p class="text-gray-600 text-xs mt-3 text-center">
        MAI requires a Gemini API key. Set <code class="bg-white/5 px-1 rounded">GEMINI_API_KEY</code> in your <code class="bg-white/5 px-1 rounded">.env</code> to activate.
    </p>
</div>
