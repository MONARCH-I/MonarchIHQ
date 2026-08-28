<div class="px-3 py-3 border-t border-gray-200 dark:border-white/10 mt-auto" id="monarch-sidebar-footer">

    {{-- User Row --}}
    <div class="flex items-center gap-2.5 mb-3 px-1">
        {{-- Avatar with gradient ring --}}
        <div class="relative shrink-0">
            <div class="w-8 h-8 rounded-full p-[2px]" style="background: linear-gradient(135deg, #2997ff, #7c3aed);">
                <img
                    src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'Admin') }}&color=ffffff&background=1a3a5c&bold=true&size=64"
                    alt="{{ auth()->user()->name ?? 'Admin' }}"
                    class="w-full h-full rounded-full object-cover border border-gray-100 dark:border-gray-900"
                />
            </div>
            <span class="absolute bottom-0 right-0 w-2 h-2 rounded-full bg-emerald-500 border border-white dark:border-gray-900 monarch-pulse-dot"></span>
        </div>
        <p class="text-xs font-bold text-gray-900 dark:text-white truncate flex-1">
            {{ auth()->user()->name ?? 'Administrator' }}
        </p>
    </div>

    {{-- Sign Out only --}}
    <form action="{{ route('filament.monarch.auth.logout') }}" method="POST">
        @csrf
        <button type="submit"
                class="w-full text-center py-2 mt-2 px-3 rounded-xl text-xs font-bold flex items-center justify-center gap-2 transition-all duration-200
                       bg-red-500/8 text-red-600 dark:text-red-400 hover:bg-red-500 hover:text-white
                       border border-red-500/20 hover:border-red-500
                       shadow-sm hover:shadow-md hover:shadow-red-500/25"
                id="monarch-signout-btn">
            <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
            </svg>
            <span>Sign Out</span>
        </button>
    </form>

</div>

<style>
    @keyframes monarch-pulse-green {
        0%, 100% { box-shadow: 0 0 0 0 rgba(16,185,129,0.5); }
        50% { box-shadow: 0 0 0 4px rgba(16,185,129,0); }
    }
    .monarch-pulse-dot { animation: monarch-pulse-green 2.2s ease-in-out infinite; }
</style>

<script>
(function() {
    function animateSidebarFooter() {
        if (typeof gsap === 'undefined') { setTimeout(animateSidebarFooter, 150); return; }
        const footer = document.getElementById('monarch-sidebar-footer');
        if (!footer) return;
        gsap.fromTo(footer,
            { opacity: 0, y: 16 },
            { opacity: 1, y: 0, duration: 0.5, ease: 'power3.out', delay: 0.3 }
        );
        const btn = document.getElementById('monarch-signout-btn');
        if (btn) {
            btn.addEventListener('mouseenter', () => {
                gsap.to(btn.querySelector('svg'), { rotate: 15, duration: 0.25, ease: 'power2.out' });
            });
            btn.addEventListener('mouseleave', () => {
                gsap.to(btn.querySelector('svg'), { rotate: 0, duration: 0.25, ease: 'power2.out' });
            });
        }
    }
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', animateSidebarFooter);
    } else {
        animateSidebarFooter();
    }
})();
</script>
