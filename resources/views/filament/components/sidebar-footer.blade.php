<div class="px-4 py-3 border-t border-gray-200 dark:border-white/10 mt-auto bg-gray-50/50 dark:bg-white/[0.02]">
    <div class="flex items-center gap-3 mb-3">
        <img
            src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'Admin') }}&color=ffffff&background=2997ff&bold=true&size=64"
            alt="{{ auth()->user()->name ?? 'Admin' }}"
            class="w-9 h-9 rounded-full object-cover shrink-0 border border-gray-200 dark:border-white/10"
        />
        <div class="min-w-0 flex-1">
            <p class="text-xs font-bold text-gray-900 dark:text-white truncate">
                {{ auth()->user()->name ?? 'Administrator' }}
            </p>
            <p class="text-[11px] text-gray-500 dark:text-gray-400 truncate">
                {{ auth()->user()->email ?? '' }}
            </p>
        </div>
    </div>

    <div class="flex items-center gap-2">
        <a href="{{ url('/') }}" target="_blank"
           class="flex-1 text-center py-1.5 px-2 rounded-lg text-xs font-semibold bg-gray-100 dark:bg-white/5 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-white/10 transition border border-gray-200/60 dark:border-white/10"
           title="Open live customer store in new tab">
            🌐 Live Store
        </a>

        <form action="{{ route('filament.monarch.auth.logout') }}" method="POST" class="flex-1">
            @csrf
            <button type="submit"
                    class="w-full text-center py-1.5 px-2 rounded-lg text-xs font-bold bg-red-500/10 text-red-600 dark:text-red-400 hover:bg-red-500/20 transition border border-red-500/20 flex items-center justify-center gap-1.5">
                <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                <span>Sign Out</span>
            </button>
        </form>
    </div>
</div>
