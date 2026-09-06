<x-main-layout
    title="Careers at MonarchI HQ — Build Next-Generation AI & Systems"
    description="Join the engineering team at MonarchI HQ. Explore open positions in software development, machine learning, systems architecture, and product design."
    keywords="MonarchI Careers, Software Engineering Jobs Ghana, AI Engineering Careers Africa, Tech Jobs Accra, Systems Architect Jobs">

    <div x-data="monarchiCareersApp()" x-init="init()" class="relative min-h-screen" style="background: var(--bg-primary);">

        {{-- =============================================
             CAREERS HERO
        ============================================= --}}
        <section class="relative pt-32 pb-20 px-6 min-h-[55vh] flex items-center justify-center overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0 pointer-events-none">
                <div class="absolute top-[-20%] right-[-10%] w-[60%] h-[80%] rounded-full opacity-20 blur-[120px]" style="background: radial-gradient(circle, #2997ff, transparent 70%);"></div>
                <div class="absolute bottom-[-20%] left-[-10%] w-[50%] h-[60%] rounded-full opacity-10 blur-[100px]" style="background: radial-gradient(circle, #2997ff, transparent 70%);"></div>
            </div>

            <div class="max-w-[1000px] mx-auto text-center relative z-10 reveal">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full border border-[#2997ff]/30 bg-[#2997ff]/10 text-[#2997ff] text-xs font-semibold tracking-wider uppercase mb-6 backdrop-blur-md">
                    <span class="w-2 h-2 rounded-full bg-[#2997ff] animate-pulse"></span>
                    Join Our Engineering Vanguard
                </div>
                <h2 class="text-5xl md:text-7xl font-bold tracking-tight mb-8 leading-tight" style="color: var(--text-primary);">
                    Build the Next Frontier of <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#2997ff] via-[#60a5fa] to-[#93c5fd]">Global Technology.</span>
                </h2>
                <p class="text-xl md:text-2xl max-w-2xl mx-auto font-light leading-relaxed" style="color: var(--text-secondary);">
                    We are a team of systems architects, AI engineers, and product designers solving high-complexity problems with craft and obsession.
                </p>
            </div>
        </section>

        {{-- =============================================
             CULTURE & VALUES
        ============================================= --}}
        <section class="py-20 px-6 z-10 relative border-t" style="border-color: var(--border-color); background: var(--bg-section);">
            <div class="max-w-[1200px] mx-auto">
                <div class="text-center max-w-2xl mx-auto mb-16">
                    <h3 class="text-xs font-bold uppercase tracking-widest text-[#2997ff] mb-2">Our Engineering Ethos</h3>
                    <h2 class="text-3xl md:text-4xl font-bold" style="color: var(--text-primary);">Why Builders Thrive at MonarchI</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="p-8 rounded-3xl border transition-all duration-300 hover:border-[#2997ff]/50 hover:shadow-xl" style="background: var(--bg-card); border-color: var(--border-color);">
                        <div class="w-12 h-12 rounded-2xl bg-blue-500/10 text-[#2997ff] flex items-center justify-center font-bold text-xl mb-6">⚡</div>
                        <h4 class="text-xl font-bold mb-3" style="color: var(--text-primary);">Extreme Craftsmanship</h4>
                        <p class="text-sm leading-relaxed" style="color: var(--text-secondary);">We care deeply about clean code, zero-latency micro-interactions, robust database design, and architectural integrity. No cutting corners.</p>
                    </div>

                    <div class="p-8 rounded-3xl border transition-all duration-300 hover:border-[#2997ff]/50 hover:shadow-xl" style="background: var(--bg-card); border-color: var(--border-color);">
                        <div class="w-12 h-12 rounded-2xl bg-blue-500/10 text-[#2997ff] flex items-center justify-center font-bold text-xl mb-6">🌐</div>
                        <h4 class="text-xl font-bold mb-3" style="color: var(--text-primary);">African Roots, Global Scale</h4>
                        <p class="text-sm leading-relaxed" style="color: var(--text-secondary);">Headquartered in Accra with global deployment standards. We build software and hardware that solves real infrastructural challenges across markets.</p>
                    </div>

                    <div class="p-8 rounded-3xl border transition-all duration-300 hover:border-[#2997ff]/50 hover:shadow-xl" style="background: var(--bg-card); border-color: var(--border-color);">
                        <div class="w-12 h-12 rounded-2xl bg-blue-500/10 text-[#2997ff] flex items-center justify-center font-bold text-xl mb-6">🚀</div>
                        <h4 class="text-xl font-bold mb-3" style="color: var(--text-primary);">Autonomous Ownership</h4>
                        <p class="text-sm leading-relaxed" style="color: var(--text-secondary);">Engineers lead projects end-to-end. We value high agency, clear technical writing, rapid prototyping, and shipping production-grade systems.</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- =============================================
             OPEN POSITIONS (Dynamic)
        ============================================= --}}
        <section id="positions" class="py-20 px-6 z-10 relative border-t" style="border-color: var(--border-color); background: var(--bg-primary);">
            <div class="max-w-[1050px] mx-auto">
                <div class="text-center max-w-2xl mx-auto mb-16">
                    <h3 class="text-xs font-bold uppercase tracking-widest text-[#2997ff] mb-2">Open Positions</h3>
                    <h2 class="text-3xl md:text-4xl font-bold" style="color: var(--text-primary);">Find Your Next Chapter at MonarchI</h2>
                    <p class="text-xs text-gray-400 mt-2">Click any role to view comprehensive requirements and submit your application.</p>
                </div>

                @if($jobs->isEmpty())
                {{-- No open positions --}}
                <div class="p-12 rounded-3xl border text-center" style="background: var(--bg-card); border-color: var(--border-color);">
                    <div class="text-4xl mb-4">🔭</div>
                    <h4 class="text-xl font-bold mb-2" style="color: var(--text-primary);">No active openings right now</h4>
                    <p class="text-sm max-w-md mx-auto mb-6" style="color: var(--text-secondary);">We are always seeking exceptional engineers, mathematicians, and builders. Drop us your portfolio or GitHub profile.</p>
                    <a href="mailto:careers@monarchi.com.gh?subject=General%20Engineering%20Inquiry" class="text-xs font-bold text-[#2997ff] hover:underline">
                        Send General Application &rarr;
                    </a>
                </div>

                @else
                <div class="space-y-4">
                    @foreach($jobs as $job)
                    <div role="button" tabindex="0"
                         @click="openModal({{ $job->id }})"
                         @keydown.enter="openModal({{ $job->id }})"
                         class="p-6 sm:p-8 rounded-2xl border transition-all duration-300 hover:border-[#2997ff] hover:shadow-2xl hover:shadow-blue-500/10 flex flex-col sm:flex-row sm:items-center justify-between gap-6 group cursor-pointer select-none"
                         style="background: var(--bg-card); border-color: var(--border-color);">
                        <div>
                            <div class="flex items-center gap-3 mb-2 flex-wrap">
                                <span class="text-xs font-bold uppercase tracking-wider text-[#2997ff] px-2.5 py-0.5 rounded-full bg-[#2997ff]/10">
                                    {{ $job->department }}
                                </span>
                                <span class="text-xs text-gray-400">&middot; {{ $job->employmentTypeLabel() }}</span>
                                <span class="text-xs text-gray-400">&middot; {{ $job->location }}</span>
                            </div>
                            <h4 class="text-xl font-bold group-hover:text-[#2997ff] transition-colors" style="color: var(--text-primary);">
                                {{ $job->title }}
                            </h4>
                            @if($job->skills_required)
                            <div class="flex flex-wrap gap-1.5 mt-3">
                                @foreach(array_slice(array_map('trim', explode(',', $job->skills_required)), 0, 4) as $skill)
                                <span class="text-[11px] px-2 py-0.5 rounded-md bg-white/5 border border-white/10 text-gray-300">
                                    {{ $skill }}
                                </span>
                                @endforeach
                            </div>
                            @endif
                        </div>

                        <div class="flex items-center gap-3 shrink-0">
                            <button type="button"
                                    class="px-5 py-2.5 bg-gradient-to-r from-[#2997ff] to-blue-600 text-white rounded-xl text-xs font-bold hover:brightness-110 transition shadow-lg shadow-blue-500/25 flex items-center gap-1.5">
                                <span>View Details &amp; Apply</span>
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- General Application Note --}}
                <div class="mt-12 p-8 rounded-3xl border text-center" style="background: var(--bg-card); border-color: var(--border-color);">
                    <h4 class="text-lg font-bold mb-2" style="color: var(--text-primary);">Don't see your exact role?</h4>
                    <p class="text-xs max-w-md mx-auto mb-6" style="color: var(--text-secondary);">
                        We are continuously scouting for high-agency systems builders, researchers, and hardware specialists. Let us know how you can contribute.
                    </p>
                    <a href="mailto:careers@monarchi.com.gh?subject=General%20Engineering%20Inquiry" class="text-xs font-bold text-[#2997ff] hover:underline">
                        Send General Inquiry &rarr;
                    </a>
                </div>
                @endif

            </div>
        </section>


        {{-- =========================================================================
             JOB DETAILS & APPLICATION MODAL (Alpine.js)
        ========================================================================= --}}
        <div x-show="isOpen"
             x-cloak
             @keydown.escape.window="closeModal()"
             class="fixed inset-0 z-[100] flex items-center justify-center p-3 sm:p-5 md:p-8"
             style="display: none;">

            {{-- Frosted Glass Backdrop --}}
            <div x-show="isOpen"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 @click="closeModal()"
                 class="fixed inset-0 bg-[#05060a]/80 backdrop-blur-xl transition-opacity"></div>

            {{-- Modal Container --}}
            <div x-show="isOpen"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                 x-transition:leave-end="opacity-0 scale-95 translate-y-4"
                 class="relative w-full max-w-3xl max-h-[92vh] flex flex-col rounded-3xl shadow-2xl overflow-hidden border border-white/10 z-10"
                 style="background: #0d0f17; box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.8), 0 0 50px rgba(41, 151, 255, 0.18);">

                {{-- Ambient Header Glow --}}
                <div class="absolute top-0 left-1/2 -translate-x-1/2 w-4/5 h-28 bg-gradient-to-b from-[#2997ff]/20 to-transparent blur-3xl pointer-events-none"></div>

                {{-- Sticky Modal Header --}}
                <header class="relative px-6 py-4 border-b border-white/10 flex items-center justify-between gap-4 shrink-0 bg-[#0d0f17]/90 backdrop-blur-md z-20">
                    <div class="flex items-center gap-2 overflow-hidden">
                        <span class="text-xs font-bold uppercase tracking-wider text-[#2997ff] px-2.5 py-0.5 rounded-full bg-[#2997ff]/10 shrink-0"
                              x-text="currentJob?.department"></span>
                        <span class="text-xs text-gray-400 hidden sm:inline" x-text="'· ' + (currentJob?.employment_type_label || '')"></span>
                        <span class="text-xs text-gray-400 hidden sm:inline" x-text="'· ' + (currentJob?.location || '')"></span>
                    </div>

                    <div class="flex items-center gap-3">
                        {{-- Tab Switcher --}}
                        <div class="flex items-center p-1 rounded-xl bg-white/5 border border-white/10 text-xs">
                            <button type="button"
                                    @click="activeTab = 'details'"
                                    :class="activeTab === 'details' ? 'bg-[#2997ff] text-white shadow-md' : 'text-gray-400 hover:text-white'"
                                    class="px-3 py-1 rounded-lg font-medium transition">
                                Job Details
                            </button>
                            <button type="button"
                                    @click="activeTab = 'apply'"
                                    :class="activeTab === 'apply' ? 'bg-[#2997ff] text-white shadow-md' : 'text-gray-400 hover:text-white'"
                                    class="px-3 py-1 rounded-lg font-medium transition flex items-center gap-1">
                                <span>Apply</span>
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                            </button>
                        </div>

                        {{-- Close Button --}}
                        <button type="button"
                                @click="closeModal()"
                                class="w-8 h-8 rounded-full border border-white/10 bg-white/5 hover:bg-white/15 text-gray-300 hover:text-white transition flex items-center justify-center text-sm font-bold"
                                title="Close modal (Esc)">
                            ✕
                        </button>
                    </div>
                </header>

                {{-- Modal Body Area --}}
                <div class="relative overflow-y-auto px-6 sm:px-10 py-6 space-y-6 custom-scrollbar flex-1">

                    {{-- ── TAB 1: JOB DETAILS ── --}}
                    <div x-show="activeTab === 'details'" class="space-y-6">
                        <div>
                            <h2 class="text-2xl sm:text-4xl font-extrabold text-white tracking-tight leading-tight"
                                x-text="currentJob?.title"></h2>
                            <div class="flex items-center gap-3 mt-2 text-xs text-gray-400 flex-wrap">
                                <span>Department: <strong class="text-white" x-text="currentJob?.department"></strong></span>
                                <span>&middot;</span>
                                <span>Type: <strong class="text-white" x-text="currentJob?.employment_type_label"></strong></span>
                                <span>&middot;</span>
                                <span>Location: <strong class="text-white" x-text="currentJob?.location"></strong></span>
                            </div>
                        </div>

                        {{-- Skills Required --}}
                        <div class="p-4 rounded-2xl border border-white/10 bg-white/5">
                            <h4 class="text-xs font-bold uppercase tracking-wider text-[#2997ff] mb-2.5">Key Skills &amp; Stack</h4>
                            <div class="flex flex-wrap gap-2">
                                <template x-for="skill in skillsArray" :key="skill">
                                    <span class="text-xs px-2.5 py-1 rounded-lg bg-blue-500/10 border border-blue-400/20 text-blue-200"
                                          x-text="skill"></span>
                                </template>
                            </div>
                        </div>

                        {{-- Full Description / Content --}}
                        <div class="space-y-4 text-sm sm:text-base leading-relaxed text-gray-300">
                            <h4 class="text-xs font-bold uppercase tracking-wider text-gray-400">About the Role</h4>
                            <div class="space-y-3" x-html="jobDescriptionHtml"></div>
                        </div>

                        {{-- Perks / Benefits --}}
                        <div class="pt-4 border-t border-white/10">
                            <h4 class="text-xs font-bold uppercase tracking-wider text-[#2997ff] mb-3">What We Provide</h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs text-gray-300">
                                <div class="p-3 rounded-xl border border-white/5 bg-white/5 flex items-center gap-2.5">
                                    <span class="text-base">💻</span>
                                    <span>Top-tier hardware (MacBook Pro M3 Max or Custom Rig)</span>
                                </div>
                                <div class="p-3 rounded-xl border border-white/5 bg-white/5 flex items-center gap-2.5">
                                    <span class="text-base">🏥</span>
                                    <span>Comprehensive premium health &amp; wellness coverage</span>
                                </div>
                                <div class="p-3 rounded-xl border border-white/5 bg-white/5 flex items-center gap-2.5">
                                    <span class="text-base">📚</span>
                                    <span>$2,000 annual learning &amp; conference budget</span>
                                </div>
                                <div class="p-3 rounded-xl border border-white/5 bg-white/5 flex items-center gap-2.5">
                                    <span class="text-base">✈️</span>
                                    <span>Flexible hybrid / remote arrangement with generous PTO</span>
                                </div>
                            </div>
                        </div>

                        {{-- CTA Button to Switch to Apply Tab --}}
                        <div class="pt-4 flex items-center justify-between gap-4">
                            <span class="text-xs text-gray-400">Ready to take on this challenge?</span>
                            <button type="button"
                                    @click="activeTab = 'apply'"
                                    class="px-6 py-3 bg-gradient-to-r from-[#2997ff] to-blue-600 text-white font-bold text-xs rounded-xl hover:brightness-110 transition shadow-lg shadow-blue-500/20 flex items-center gap-2">
                                <span>Apply for this Position</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                            </button>
                        </div>
                    </div>


                    {{-- ── TAB 2: APPLICATION FORM ── --}}
                    <div x-show="activeTab === 'apply'" class="space-y-6">

                        {{-- Success State --}}
                        <div x-show="isSubmitted" class="py-12 text-center space-y-4">
                            <div class="w-16 h-16 rounded-full bg-emerald-500/20 border border-emerald-500/40 text-emerald-400 flex items-center justify-center text-3xl mx-auto animate-bounce">
                                ✓
                            </div>
                            <h3 class="text-2xl font-bold text-white">Application Received!</h3>
                            <p class="text-sm text-gray-300 max-w-md mx-auto leading-relaxed" x-text="successMessage"></p>
                            <div class="pt-6">
                                <button type="button"
                                        @click="closeModal()"
                                        class="px-6 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 text-white text-xs font-semibold transition">
                                    Close Window
                                </button>
                            </div>
                        </div>

                        {{-- Form Content --}}
                        <div x-show="!isSubmitted">
                            <div class="mb-5 pb-4 border-b border-white/10">
                                <h3 class="text-xl font-bold text-white">Submit Candidate Profile</h3>
                                <p class="text-xs text-gray-400 mt-1">Applying for <span class="text-[#2997ff] font-semibold" x-text="currentJob?.title"></span> (<span x-text="currentJob?.department"></span>)</p>
                            </div>

                            {{-- Error Banner --}}
                            <div x-show="errorMessage" class="p-4 rounded-xl border border-rose-500/30 bg-rose-500/10 text-rose-200 text-xs mb-4" x-text="errorMessage"></div>

                            <form @submit.prevent="submitApplication" class="space-y-4">
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-300 mb-1.5">Full Name *</label>
                                        <input type="text"
                                               x-model="formData.name"
                                               required
                                               placeholder="e.g. Kwame Mensah"
                                               class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-500 text-xs focus:outline-none focus:border-[#2997ff] focus:ring-1 focus:ring-[#2997ff] transition">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-300 mb-1.5">Email Address *</label>
                                        <input type="email"
                                               x-model="formData.email"
                                               required
                                               placeholder="kwame@example.com"
                                               class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-500 text-xs focus:outline-none focus:border-[#2997ff] focus:ring-1 focus:ring-[#2997ff] transition">
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-300 mb-1.5">Phone Number *</label>
                                        <input type="tel"
                                               x-model="formData.phone"
                                               required
                                               placeholder="+233 24 000 0000"
                                               class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-500 text-xs focus:outline-none focus:border-[#2997ff] focus:ring-1 focus:ring-[#2997ff] transition">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-300 mb-1.5">Portfolio / GitHub / LinkedIn (Optional)</label>
                                        <input type="url"
                                               x-model="formData.portfolio_url"
                                               placeholder="https://github.com/username"
                                               class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-500 text-xs focus:outline-none focus:border-[#2997ff] focus:ring-1 focus:ring-[#2997ff] transition">
                                    </div>
                                </div>

                                {{-- CV / Resume Upload Dropzone --}}
                                <div>
                                    <label class="block text-xs font-semibold text-gray-300 mb-1.5">Upload CV / Resume * (PDF, DOC, DOCX — Max 10MB)</label>
                                    <div class="relative border-2 border-dashed rounded-2xl p-6 text-center transition-all cursor-pointer"
                                         :class="selectedFile ? 'border-emerald-500/50 bg-emerald-500/5' : 'border-white/15 bg-white/5 hover:border-[#2997ff]/50'"
                                         @click="$refs.cvInput.click()"
                                         @dragover.prevent="$event.dataTransfer.dropEffect = 'copy'"
                                         @drop.prevent="handleDrop($event)">

                                        <input type="file"
                                               x-ref="cvInput"
                                               @change="handleFileSelect($event)"
                                               accept=".pdf,.doc,.docx,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                                               class="hidden">

                                        <template x-if="!selectedFile">
                                            <div class="space-y-2 pointer-events-none">
                                                <div class="w-10 h-10 rounded-xl bg-[#2997ff]/10 text-[#2997ff] flex items-center justify-center mx-auto text-lg">📄</div>
                                                <div class="text-xs text-gray-300 font-medium">Click to upload or drag and drop your CV</div>
                                                <div class="text-[10px] text-gray-500">PDF, Word docs up to 10MB accepted</div>
                                            </div>
                                        </template>

                                        <template x-if="selectedFile">
                                            <div class="flex items-center justify-between gap-3 text-left">
                                                <div class="flex items-center gap-3 overflow-hidden">
                                                    <div class="w-10 h-10 rounded-xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center font-bold text-sm shrink-0">CV</div>
                                                    <div class="truncate">
                                                        <div class="text-xs font-bold text-white truncate" x-text="selectedFile.name"></div>
                                                        <div class="text-[10px] text-gray-400" x-text="formatFileSize(selectedFile.size)"></div>
                                                    </div>
                                                </div>
                                                <button type="button"
                                                        @click.stop="clearFile()"
                                                        class="px-2.5 py-1 rounded-lg bg-white/10 hover:bg-rose-500/20 text-xs text-gray-300 hover:text-rose-300 transition shrink-0">
                                                    Change
                                                </button>
                                            </div>
                                        </template>
                                    </div>
                                </div>

                                {{-- Cover Letter / Statement --}}
                                <div>
                                    <label class="block text-xs font-semibold text-gray-300 mb-1.5">Cover Letter / Note to the Hiring Team (Optional)</label>
                                    <textarea x-model="formData.cover_letter"
                                              rows="4"
                                              placeholder="Share notable projects you've shipped, problems you love solving, or why you want to join MonarchI..."
                                              class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-500 text-xs focus:outline-none focus:border-[#2997ff] focus:ring-1 focus:ring-[#2997ff] transition resize-none"></textarea>
                                </div>

                                {{-- Submit Button --}}
                                <div class="pt-2 flex items-center justify-end gap-3">
                                    <button type="button"
                                            @click="activeTab = 'details'"
                                            class="px-4 py-2.5 text-xs text-gray-400 hover:text-white transition">
                                        Back to Details
                                    </button>
                                    <button type="submit"
                                            :disabled="isSubmitting || !selectedFile"
                                            class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-[#2997ff] to-blue-600 text-white font-bold text-xs hover:brightness-110 disabled:opacity-50 disabled:cursor-not-allowed transition flex items-center gap-2 shadow-lg shadow-blue-500/20">
                                        <template x-if="isSubmitting">
                                            <svg class="animate-spin w-3.5 h-3.5 text-white" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                                            </svg>
                                        </template>
                                        <span x-text="isSubmitting ? 'Submitting Application...' : 'Send Application &rarr;'"></span>
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- Job Listings Data for Alpine --}}
    @php
        $jobsMap = [];
        foreach($jobs as $j) {
            $jobsMap[$j->id] = [
                'id' => $j->id,
                'title' => $j->title,
                'department' => $j->department,
                'employment_type' => $j->employment_type,
                'employment_type_label' => $j->employmentTypeLabel(),
                'location' => $j->location,
                'skills_required' => $j->skills_required,
                'description' => $j->description,
                'apply_email' => $j->apply_email,
            ];
        }
    @endphp

    <script>
        window.__monarchiJobs = @json($jobsMap);

        function monarchiCareersApp() {
            return {
                isOpen: false,
                activeTab: 'details', // 'details' | 'apply'
                currentJob: null,
                selectedFile: null,
                isSubmitting: false,
                isSubmitted: false,
                successMessage: '',
                errorMessage: '',
                formData: {
                    name: '',
                    email: '',
                    phone: '',
                    portfolio_url: '',
                    cover_letter: '',
                },

                init() {
                    // Check URL hash if candidate links to #job-1
                    const hash = window.location.hash;
                    if (hash && hash.startsWith('#job-')) {
                        const jobId = parseInt(hash.replace('#job-', ''), 10);
                        if (window.__monarchiJobs[jobId]) {
                            this.openModal(jobId);
                        }
                    }
                },

                openModal(jobId, tab = 'details') {
                    const job = window.__monarchiJobs[jobId];
                    if (!job) return;

                    this.currentJob = job;
                    this.activeTab = tab;
                    this.isOpen = true;
                    this.isSubmitted = false;
                    this.errorMessage = '';
                    this.selectedFile = null;
                    document.body.style.overflow = 'hidden';

                    if (history.replaceState) {
                        history.replaceState(null, '', '#job-' + job.id);
                    }
                },

                closeModal() {
                    this.isOpen = false;
                    this.currentJob = null;
                    this.errorMessage = '';
                    document.body.style.overflow = '';

                    if (history.replaceState) {
                        history.replaceState(null, '', window.location.pathname + window.location.search);
                    }
                },

                get skillsArray() {
                    if (!this.currentJob || !this.currentJob.skills_required) return [];
                    return this.currentJob.skills_required.split(',').map(s => s.trim()).filter(Boolean);
                },

                get jobDescriptionHtml() {
                    if (!this.currentJob) return '';

                    if (this.currentJob.description && this.currentJob.description.trim().length > 30) {
                        return this.currentJob.description.split(/\n\s*\n/).map(p => {
                            return '<p class="text-gray-300 leading-relaxed mb-3">' + this.escapeHtml(p.trim()) + '</p>';
                        }).join('');
                    }

                    // Rich contextual fallback based on department / title
                    return '<p class="text-gray-300 leading-relaxed mb-3">' +
                        'As a <strong>' + this.escapeHtml(this.currentJob.title) + '</strong> in our ' +
                        this.escapeHtml(this.currentJob.department) + ' team, you will design, build, and deploy production-grade software and distributed systems at scale.' +
                        '</p>' +
                        '<h5 class="text-xs font-bold uppercase tracking-wider text-white mt-4 mb-2">Core Responsibilities</h5>' +
                        '<ul class="list-disc pl-5 space-y-1.5 text-gray-300 mb-4">' +
                        '<li>Architect and implement resilient, low-latency applications with clean architectural separation.</li>' +
                        '<li>Write robust, tested code meeting our zero-compromise engineering benchmarks.</li>' +
                        '<li>Collaborate with cross-functional engineers and product designers in rapid execution sprints.</li>' +
                        '<li>Participate in technical design reviews, database query optimization, and infrastructure hardening.</li>' +
                        '</ul>' +
                        '<h5 class="text-xs font-bold uppercase tracking-wider text-white mt-4 mb-2">What We Look For</h5>' +
                        '<ul class="list-disc pl-5 space-y-1.5 text-gray-300">' +
                        '<li>Demonstrated history of building and maintaining production software.</li>' +
                        '<li>Deep understanding of system design, performance bottlenecks, and asynchronous patterns.</li>' +
                        '<li>High agency, exceptional clarity in written communication, and pride in craft.</li>' +
                        '</ul>';
                },

                escapeHtml(str) {
                    if (!str) return '';
                    return str.replace(/[&<>"']/g, function(m) {
                        return {
                            '&': '&amp;',
                            '<': '&lt;',
                            '>': '&gt;',
                            '"': '&quot;',
                            "'": '&#039;'
                        }[m];
                    });
                },

                handleFileSelect(event) {
                    const file = event.target.files[0];
                    if (file) {
                        this.validateAndSetFile(file);
                    }
                },

                handleDrop(event) {
                    const file = event.dataTransfer.files[0];
                    if (file) {
                        this.validateAndSetFile(file);
                    }
                },

                validateAndSetFile(file) {
                    this.errorMessage = '';
                    const allowedExts = ['pdf', 'doc', 'docx'];
                    const ext = file.name.split('.').pop().toLowerCase();

                    if (!allowedExts.includes(ext)) {
                        this.errorMessage = 'Please upload a valid CV format (.pdf, .doc, .docx).';
                        return;
                    }

                    if (file.size > 10 * 1024 * 1024) {
                        this.errorMessage = 'File size exceeds 10MB limit. Please upload a smaller file.';
                        return;
                    }

                    this.selectedFile = file;
                },

                clearFile() {
                    this.selectedFile = null;
                    if (this.$refs.cvInput) {
                        this.$refs.cvInput.value = '';
                    }
                },

                formatFileSize(bytes) {
                    if (!bytes) return '0 B';
                    const k = 1024;
                    const sizes = ['B', 'KB', 'MB'];
                    const i = Math.floor(Math.log(bytes) / Math.log(k));
                    return parseFloat((bytes / Math.pow(k, i)).toFixed(1)) + ' ' + sizes[i];
                },

                async submitApplication() {
                    if (!this.currentJob) return;
                    if (!this.selectedFile) {
                        this.errorMessage = 'Please attach your CV / Resume file before submitting.';
                        return;
                    }

                    this.isSubmitting = true;
                    this.errorMessage = '';

                    const data = new FormData();
                    data.append('name', this.formData.name);
                    data.append('email', this.formData.email);
                    data.append('phone', this.formData.phone);
                    if (this.formData.portfolio_url) data.append('portfolio_url', this.formData.portfolio_url);
                    if (this.formData.cover_letter) data.append('cover_letter', this.formData.cover_letter);
                    data.append('resume', this.selectedFile);

                    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

                    try {
                        const response = await fetch('/careers/' + this.currentJob.id + '/apply', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            body: data
                        });

                        const result = await response.json();

                        if (!response.ok) {
                            if (result.errors) {
                                const firstError = Object.values(result.errors)[0];
                                this.errorMessage = Array.isArray(firstError) ? firstError[0] : firstError;
                            } else {
                                this.errorMessage = result.message || 'There was an error submitting your application. Please check your inputs.';
                            }
                            this.isSubmitting = false;
                            return;
                        }

                        this.isSubmitted = true;
                        this.successMessage = result.message || 'Your application has been received successfully!';
                        this.formData = { name: '', email: '', phone: '', portfolio_url: '', cover_letter: '' };
                        this.clearFile();
                    } catch (error) {
                        this.errorMessage = 'A network error occurred. Please check your connection and try again.';
                    } finally {
                        this.isSubmitting = false;
                    }
                }
            };
        }
    </script>

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 8px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.02);
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 9999px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: rgba(41, 151, 255, 0.4);
        }
    </style>

</x-main-layout>