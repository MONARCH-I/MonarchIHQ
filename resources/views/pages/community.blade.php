<x-main-layout
    title="Community, Open Source & Social Impact — MonarchI HQ"
    description="Discover MonarchI HQ's open source contributions, developer community events, hackathons, and social impact initiatives across the continent."
    keywords="MonarchI Community, Open Source AI, Developer Events Ghana, African Tech Hackathons, Tech Social Impact">

    <section class="relative pt-32 pb-16 px-6 overflow-hidden" style="background: var(--bg-primary);">
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0 pointer-events-none">
            <div class="absolute top-[-10%] left-[-10%] w-[50%] h-[70%] rounded-full opacity-15 blur-[120px]" style="background: radial-gradient(circle, #2997ff, transparent 70%);"></div>
        </div>
        <div class="max-w-[860px] mx-auto text-center relative z-10 reveal">
            <span class="text-xs font-bold tracking-[0.25em] text-[#2997ff] uppercase mb-4 inline-block">Ecosystem & People</span>
            <h1 class="text-4xl md:text-6xl font-bold tracking-tight mb-6" style="color: var(--text-primary);">Community & Impact</h1>
            <p class="text-base md:text-lg max-w-xl mx-auto font-light leading-relaxed" style="color: var(--text-secondary);">
                Empowering the next generation of engineers and founders through open source tools, technical workshops, and high-impact social initiatives.
            </p>
        </div>
    </section>

    <section class="py-16 px-6 z-10 relative border-t" style="border-color: var(--border-color); background: var(--bg-section);">
        <div class="max-w-[860px] mx-auto space-y-12 reveal">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Open Source -->
                <div class="p-8 rounded-3xl" style="background: var(--bg-card); border: 1px solid var(--border-color);">
                    <div class="w-12 h-12 rounded-2xl bg-[#2997ff]/10 text-[#2997ff] flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd"/></svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-3" style="color: var(--text-primary);">Open Source Development</h3>
                    <p class="text-sm leading-relaxed mb-6" style="color: var(--text-secondary);">
                        We maintain open-source developer SDKs, machine learning utilities, and IoT driver libraries to help developers build intelligent systems faster.
                    </p>
                    <a href="https://github.com/MONARCH-I" target="_blank" class="text-xs font-semibold text-[#2997ff] hover:underline flex items-center gap-1">
                        <span>Explore GitHub Repositories</span> &rarr;
                    </a>
                </div>

                <!-- Social Impact -->
                <div class="p-8 rounded-3xl" style="background: var(--bg-card); border: 1px solid var(--border-color);">
                    <div class="w-12 h-12 rounded-2xl bg-[#2997ff]/10 text-[#2997ff] flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-3" style="color: var(--text-primary);">Social Impact & Access</h3>
                    <p class="text-sm leading-relaxed mb-6" style="color: var(--text-secondary);">
                        Through our digital literacy campaigns and university mentorship programs, we bring cutting-edge software engineering skills to thousands of aspiring African technologists.
                    </p>
                    <a href="{{ route('contact.index') }}" class="text-xs font-semibold text-[#2997ff] hover:underline flex items-center gap-1">
                        <span>Get Involved</span> &rarr;
                    </a>
                </div>
            </div>

            <!-- Community Events -->
            <div class="p-8 md:p-10 rounded-3xl" style="background: var(--bg-card); border: 1px solid var(--border-color);">
                <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                    <div>
                        <h3 class="text-2xl font-semibold mb-2" style="color: var(--text-primary);">MonarchI Developer Sessions</h3>
                        <p class="text-sm leading-relaxed max-w-lg" style="color: var(--text-secondary);">
                            Join our monthly technical tech talks, deep dives into MAI architecture, and live coding demos with core MonarchI systems engineers.
                        </p>
                    </div>
                    <a href="{{ route('blog.index') }}" class="px-6 py-3 rounded-xl bg-white text-black font-semibold text-xs hover:bg-gray-200 transition-transform active:scale-95 shrink-0">
                        View Event Announcements
                    </a>
                </div>
            </div>

        </div>
    </section>

</x-main-layout>
