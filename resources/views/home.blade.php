<x-main-layout>

    {{-- =============================================
         HERO SECTION — Always dark, no theme changes
    ============================================= --}}
    <section class="hero-section relative h-screen w-full overflow-hidden flex flex-col pt-12">

        <img src="{{ asset('images/world-tech.png') }}" alt="Hero"
            class="absolute inset-0 w-full h-full object-cover z-0" />

        <div
            class="absolute inset-0 bg-black/2 bg-[radial-gradient(circle_at_center,transparent_0%,rgba(0,0,0,0.85)_100%)] z-0">
        </div>

        <div class="absolute top-20 left-1/2 -translate-x-1/2 z-20 flex justify-center w-full px-4">

            <div
                class="bg-white/10 backdrop-blur-md border border-white/10 rounded-full px-5 py-2 flex items-center gap-3 shadow-[0_0_30px_rgba(0,0,0,0.5)]">

                <img src="{{ asset('images/ai-mind.png') }}" alt="AI"
                    class="h-4 w-4 object-contain invert opacity-70" />

                <p class="text-[11px] md:text-xs font-light tracking-wide text-gray-200">Tech that works hard — <span
                        class="text-white font-medium">So you don&apos;t have to.</span></p>

            </div>

        </div>

        <div
            class="absolute top-[30%] md:top-[38%] left-1/2 -translate-x-1/2 -translate-y-1/2 z-20 w-[95%] md:w-[80%] max-w-5xl pointer-events-none drop-shadow-2xl">

            <svg viewBox="0 0 1000 300" class="w-full h-auto overflow-visible">

                <defs>

                    <path id="text-arc" d="M 50,220 Q 500,-20 950,220" />

                    <linearGradient id="glass-grad" x1="0%" y1="0%" x2="0%" y2="100%">

                        <stop offset="0%"   stop-color="#ffffff" stop-opacity="1" />

                        <stop offset="45%"  stop-color="#ffffff" stop-opacity="0.85" />

                        <stop offset="100%" stop-color="#ffffff" stop-opacity="0.05" />

                    </linearGradient>

                    <filter id="globe-glow">

                        <feDropShadow dx="0" dy="15" stdDeviation="15" flood-color="#ea580c" flood-opacity="0.6" />

                        <feDropShadow dx="0" dy="30" stdDeviation="25" flood-color="#f59e0b" flood-opacity="0.3" />

                    </filter>

                </defs>

                <text fill="url(#glass-grad)" filter="url(#globe-glow)"
                    font-family="system-ui, -apple-system, sans-serif" font-weight="900" font-size="48"
                    letter-spacing="6">

                    <textPath href="#text-arc" startOffset="50%" text-anchor="middle">

                        TECHNOLOGY IS EVOLVING

                    </textPath>

                </text>

                <text fill="url(#glass-grad)" filter="url(#globe-glow)"
                    font-family="system-ui, -apple-system, sans-serif" font-weight="300" font-size="24"
                    letter-spacing="12" transform="translate(0, 40)">

                    <textPath href="#text-arc" startOffset="50%" text-anchor="middle">

                        SO SHOULD YOUR BUSINESS

                    </textPath>

                </text>

            </svg>

        </div>

        <div
            class="absolute top-[38%] md:top-[48%] left-1/2 -translate-x-1/2 z-30 flex flex-row items-center gap-3 md:gap-6 w-full justify-center px-4">

            <a href="/contact"
                class="group relative px-6 md:px-8 py-3 rounded-full bg-white/95 backdrop-blur-md text-black font-semibold text-[7px] md:text-xs uppercase tracking-[0.15em] transition-all duration-300 hover:scale-105 hover:bg-white hover:shadow-[0_0_30px_rgba(255,255,255,0.4)] flex items-center gap-2 md:gap-3 ">

                Start a Project

                <svg class="w-3.5 h-3.5 md:w-4 md:h-4 transition-transform duration-300 group-hover:translate-x-1"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3">
                    </path>
                </svg>

            </a>

            <a href="/store"
                class="group px-6 md:px-8 py-3 rounded-full liquid-btn text-white font-medium text-[7px] md:text-xs uppercase tracking-[0.15em] transition-all duration-300 hover:scale-105 hover:bg-white/10 hover:border-white/40 flex items-center gap-2 md:gap-3">

                Visit Store

                <svg class="w-3.5 h-3.5 md:w-4 md:h-4 text-gray-300 transition-transform duration-300 group-hover:translate-x-1 group-hover:text-white"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>

            </a>

        </div>

        <div class="absolute right-4 md:right-12 bottom-4 md:bottom-[55px] z-20 w-[calc(100%-2rem)] md:w-auto max-w-[calc(100%-2rem)] md:max-w-[calc(100%-4rem)]">

            <div class="flex flex-col md:flex-row md:items-end justify-end gap-2 md:gap-4 w-full">

                <div class="liquid-card p-4 md:p-6 w-full md:w-7/12 lg:w-[50rem] lg:h-full lg:p-10 flex flex-col justify-between group min-w-0">

                    <div>

                        <h4 class="text-sm md:text-base font-medium text-white mb-1">Evolution of Intelligence : AI
                            Adoption in Africa</h4>

                        <p class="text-[11px] md:text-sm text-gray-400">The evolution of AI has opened new possibilities
                            for economic growth and technological advancement worldwide. In Africa, AI is gaining
                            momentum across industries, offering innovative solutions to long-standing social and
                            economic challenges.</p>
                    </div>

                    <a href="/blog" target="_blank" rel="noopener noreferrer"
                        class="text-[10px] md:text-xs text-gray-300 mt-3 md:mt-6 flex items-center gap-1 group-hover:text-white transition-colors uppercase tracking-wider w-max">

                        &rarr; Learn more...

                    </a>

                </div>

                <div class="grid grid-cols-2 gap-2 md:gap-4 w-full md:w-auto h-fit shrink-0">

                    <div
                        class="liquid-card drop-shadow-[0_10px_20px_rgba(0,0,0,0.8)] py-2 px-2 md:py-4 md:px-4 w-full md:w-36 lg:w-40 h-fit flex flex-col justify-center items-center text-center">

                        <h4 class="text-xl md:text-2xl lg:text-3xl font-light text-white"><span class="stat-counter"
                                data-target="22">0</span>+</h4>

                        <span
                            class="text-[8px] md:text-[9px] text-gray-400 uppercase tracking-widest leading-tight mt-1 md:mt-2">Satisfied<br>Clients</span>

                    </div>

                    <div
                        class="liquid-card drop-shadow-[0_10px_20px_rgba(0,0,0,0.8)] py-2 px-2 md:py-4 md:px-4 w-full md:w-36 lg:w-40 h-fit flex flex-col justify-center items-center text-center">

                        <h4 class="text-xl md:text-2xl lg:text-3xl font-light text-white"><span class="stat-counter"
                                data-target="28">0</span>+</h4>

                        <span
                            class="text-[8px] md:text-[9px] text-gray-400 uppercase tracking-widest leading-tight mt-1 md:mt-2">Completed<br>Projects</span>

                    </div>

                    <div
                        class="liquid-card drop-shadow-[0_10px_20px_rgba(0,0,0,0.8)] py-2 px-2 md:py-4 md:px-4 w-full md:w-36 lg:w-40 h-fit flex flex-col justify-center items-center text-center">

                        <h4 class="text-xl md:text-2xl lg:text-3xl font-light text-white"><span class="stat-counter"
                                data-target="4">0</span>+</h4>

                        <span
                            class="text-[8px] md:text-[9px] text-gray-400 uppercase tracking-widest leading-tight mt-1 md:mt-2">Star<br>Rating</span>
                    </div>

                    <div
                        class="liquid-card drop-shadow-[0_10px_20px_rgba(0,0,0,0.8)] py-2 px-2 md:py-4 md:px-4 w-full md:w-36 lg:w-40 h-fit flex flex-col justify-center items-center text-center">

                        <h4 class="text-xl md:text-2xl lg:text-3xl font-light text-white"><span class="stat-counter"
                                data-target="97">0</span>%</h4>

                        <span
                            class="text-[8px] md:text-[9px] text-gray-400 uppercase tracking-widest leading-tight mt-1 md:mt-2">System<br>Uptime</span>
                    </div>

                </div>

            </div>

        </div>
    </section>

    {{-- =============================================
         SERVICES SECTION
    ============================================= --}}
    <section class="services-section py-24 px-4 sm:px-6 lg:px-8 z-10 border-t border-b relative" style="border-color: var(--border-color); background: var(--bg-primary);">
        <div class="max-w-[1240px] mx-auto">

            {{-- Section Header --}}
            <div class="mb-16 md:mb-20 reveal">
                <p class="text-xs font-semibold tracking-[0.2em] text-[#2997ff] uppercase mb-4">Our Services</p>
                <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6">
                    <h2 class="text-4xl md:text-5xl lg:text-6xl font-semibold tracking-tight leading-[1.1]" style="color: var(--text-primary);">
                        What we offer<br><span style="color: var(--text-muted);">to your business.</span>
                    </h2>
                    <p class="text-base md:text-lg max-w-md leading-relaxed" style="color: var(--text-secondary);">
                        Enterprise-grade systems and AI-powered services that automate workflows and surface predictive insights.
                    </p>
                </div>
            </div>

            {{-- Services Bento Grid: 2x2 on large screens, 1x1 on mobile --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">

                {{-- Card 1: SaaS --}}
                <div class="group relative rounded-[28px] md:rounded-[32px] overflow-hidden min-h-[460px] md:min-h-[500px] flex flex-col items-center justify-start pt-10 md:pt-12 px-6 md:px-10 pb-8 text-center border border-white/10 shadow-xl transition-all duration-500 hover:border-white/30 hover:shadow-2xl reveal delay-100">
                    {{-- Background Image --}}
                    <img src="https://i.postimg.cc/fLcZwcFd/Gemini-Generated-Image-vegmr1vegmr1vegm(1).jpg"
                         alt="SaaS Platforms"
                         class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105 z-0">

                    {{-- Top Centered Content & Buttons --}}
                    <div class="relative z-10 flex flex-col items-center text-center gap-2 max-w-lg">
                        <h3 class="text-2xl md:text-3xl lg:text-4xl font-semibold tracking-tight text-white drop-shadow-md">SaaS Platforms</h3>
                        <p class="text-sm md:text-base text-gray-200 drop-shadow font-normal leading-relaxed">Software. Built for Scale.</p>
                        <div class="flex items-center justify-center gap-3 pt-3 flex-wrap">
                            <a href="/services" class="inline-flex items-center justify-center px-6 py-2.5 rounded-full bg-[#0071e3] hover:bg-[#0077ed] text-white text-xs md:text-sm font-medium transition-all duration-200 shadow-lg hover:shadow-xl hover:scale-105 active:scale-95">
                                Learn More
                            </a>
                            <a href="/store" class="inline-flex items-center justify-center px-6 py-2.5 rounded-full bg-white/10 hover:bg-white/20 text-white backdrop-blur-md border border-white/20 text-xs md:text-sm font-medium transition-all duration-200 shadow-md hover:scale-105 active:scale-95">
                                Explore
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Card 2: Workflow Automation --}}
                <div class="group relative rounded-[28px] md:rounded-[32px] overflow-hidden min-h-[460px] md:min-h-[500px] flex flex-col items-center justify-start pt-10 md:pt-12 px-6 md:px-10 pb-8 text-center border border-white/10 shadow-xl transition-all duration-500 hover:border-white/30 hover:shadow-2xl reveal delay-200">
                    {{-- Background Image --}}
                    <img src="https://i.postimg.cc/SNdYxk4G/Gemini-Generated-Image-czxebtczxebtczxe(1).jpg"
                         alt="Workflow Automation"
                         class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105 z-0">

                    {{-- Top Centered Content & Buttons --}}
                    <div class="relative z-10 flex flex-col items-center text-center gap-2 max-w-lg">
                        <h3 class="text-2xl md:text-3xl lg:text-4xl font-semibold tracking-tight text-black drop-shadow-md">Workflow Automation</h3>
                        <p class="text-sm md:text-base text-black drop-shadow font-normal leading-relaxed">Automate. Optimize. Intelligent.</p>
                        <div class="flex items-center justify-center gap-3 pt-3 flex-wrap">
                            <a href="/services" class="inline-flex items-center justify-center px-6 py-2.5 rounded-full bg-[#0071e3] hover:bg-[#0077ed] text-white text-xs md:text-sm font-medium transition-all duration-200 shadow-lg hover:shadow-xl hover:scale-105 active:scale-95">
                                Learn More
                            </a>
                            <a href="/contact" class="inline-flex items-center justify-center px-6 py-2.5 rounded-full bg-white/10 hover:bg-white/20 text-white backdrop-blur-md border border-white/20 text-xs md:text-sm font-medium transition-all duration-200 shadow-md hover:scale-105 active:scale-95">
                                Explore
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Card 3: Software Development --}}
                <div class="group relative rounded-[28px] md:rounded-[32px] overflow-hidden min-h-[460px] md:min-h-[500px] flex flex-col items-center justify-end pb-10 md:pb-12 px-6 md:px-10 pt-8 text-center border border-white/10 shadow-xl transition-all duration-500 hover:border-white/30 hover:shadow-2xl reveal delay-100">
                    {{-- Background Image --}}
                    <img src="https://i.postimg.cc/rFH0rgdp/Gemini-Generated-Image-wag4hpwag4hpwag4(1).jpg"
                         alt="Software Development"
                         class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105 z-0">

                    {{-- Bottom Centered Content & Buttons --}}
                    <div class="relative z-10 flex flex-col items-center text-center gap-2 max-w-lg mt-auto">
                        <h3 class="text-2xl md:text-3xl lg:text-4xl font-bold tracking-tight text-gray-300 drop-shadow-md">Software Development</h3>
                        <p class="text-sm md:text-base text-black drop-shadow font-semibold leading-relaxed">Build. Deploy. Scale.</p>
                        <div class="flex items-center justify-center gap-3 pt-3 flex-wrap">
                            <a href="/services" class="inline-flex items-center justify-center px-6 py-2.5 rounded-full bg-[#0071e3] hover:bg-[#0077ed] text-white text-xs md:text-sm font-medium transition-all duration-200 shadow-lg hover:shadow-xl hover:scale-105 active:scale-95">
                                Learn More
                            </a>
                            <a href="/store" class="inline-flex items-center justify-center px-6 py-2.5 rounded-full bg-white/10 hover:bg-white/20 text-black backdrop-blur-md border border-white/20 text-xs md:text-sm font-medium transition-all duration-200 shadow-md hover:scale-105 active:scale-95">
                                Explore
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Card 4: Web Development --}}
                <div class="group relative rounded-[28px] md:rounded-[32px] overflow-hidden min-h-[460px] md:min-h-[500px] flex flex-col items-center justify-end pb-10 md:pb-12 px-6 md:px-10 pt-8 text-center border border-white/10 shadow-xl transition-all duration-500 hover:border-white/30 hover:shadow-2xl reveal delay-200">
                    {{-- Background Image --}}
                    <img src="https://i.postimg.cc/JnTJd8hx/Gemini-Generated-Image-ey2szaey2szaey2s(1).jpg"
                         alt="Web Development"
                         class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105 z-0">

                    {{-- Bottom Centered Content & Buttons --}}
                    <div class="relative z-10 flex flex-col items-center text-center gap-2 max-w-lg mt-auto">
                        <h3 class="text-2xl md:text-3xl lg:text-4xl font-semibold tracking-tight text-gray-300 drop-shadow-md">Web Development</h3>
                        <p class="text-sm md:text-base text-white drop-shadow font-normal leading-relaxed">Identity. Performance. Yours.</p>
                        <div class="flex items-center justify-center gap-3 pt-3 flex-wrap">
                            <a href="/services" class="inline-flex items-center justify-center px-6 py-2.5 rounded-full bg-[#0071e3] hover:bg-[#0077ed] text-white text-xs md:text-sm font-medium transition-all duration-200 shadow-lg hover:shadow-xl hover:scale-105 active:scale-95">
                                Learn More
                            </a>
                            <a href="/store" class="inline-flex items-center justify-center px-6 py-2.5 rounded-full bg-white/10 hover:bg-white/20 text-white backdrop-blur-md border border-white/20 text-xs md:text-sm font-medium transition-all duration-200 shadow-md hover:scale-105 active:scale-95">
                                Explore
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Card 5: Integrated Systems --}}
                <div class="group relative rounded-[28px] md:rounded-[32px] overflow-hidden min-h-[460px] md:min-h-[500px] flex flex-col items-center justify-start pt-10 md:pt-12 px-6 md:px-10 pb-8 text-center border border-white/10 shadow-xl transition-all duration-500 hover:border-white/30 hover:shadow-2xl reveal delay-100">
                    {{-- Background Image --}}
                    <img src="https://i.postimg.cc/wT9c29QV/Gemini-Generated-Image-r0ei34r0ei34r0ei(1).jpg"
                         alt="Integrated Systems"
                         class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105 z-0">

                    {{-- Top Centered Content & Buttons --}}
                    <div class="relative z-10 flex flex-col items-center text-center gap-2 max-w-lg">
                        <h3 class="text-2xl md:text-3xl lg:text-4xl font-semibold tracking-tight text-white drop-shadow-md">Integrated Systems</h3>
                        <p class="text-sm md:text-base text-gray-200 drop-shadow font-normal leading-relaxed">Engineered as one. Built for the world.</p>
                        <div class="flex items-center justify-center gap-3 pt-3 flex-wrap">
                            <a href="/services" class="inline-flex items-center justify-center px-6 py-2.5 rounded-full bg-[#0071e3] hover:bg-[#0077ed] text-white text-xs md:text-sm font-medium transition-all duration-200 shadow-lg hover:shadow-xl hover:scale-105 active:scale-95">
                                Learn More
                            </a>
                            <a href="/store" class="inline-flex items-center justify-center px-6 py-2.5 rounded-full bg-white/10 hover:bg-white/20 text-white backdrop-blur-md border border-white/20 text-xs md:text-sm font-medium transition-all duration-200 shadow-md hover:scale-105 active:scale-95">
                                Explore
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Card 6: Security Systems --}}
                <div class="group relative rounded-[28px] md:rounded-[32px] overflow-hidden min-h-[460px] md:min-h-[500px] flex flex-col items-center justify-start pt-10 md:pt-12 px-6 md:px-10 pb-8 text-center border border-white/10 shadow-xl transition-all duration-500 hover:border-white/30 hover:shadow-2xl reveal delay-200">
                    {{-- Background Image --}}
                    <img src="https://i.postimg.cc/Xv5QhQGy/Gemini-Generated-Image-nfrsy9nfrsy9nfrs(1).jpg"
                         alt="Security Systems"
                         class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105 z-0">

                    {{-- Top Centered Content & Buttons --}}
                    <div class="relative z-10 flex flex-col items-center text-center gap-2 max-w-lg">
                        <h3 class="text-2xl md:text-3xl lg:text-4xl font-semibold tracking-tight text-white drop-shadow-md">Security Systems</h3>
                        <p class="text-sm md:text-base text-gray-200 drop-shadow font-normal leading-relaxed">Intelligent. Connected. Secure.</p>
                        <div class="flex items-center justify-center gap-3 pt-3 flex-wrap">
                            <a href="/services" class="inline-flex items-center justify-center px-6 py-2.5 rounded-full bg-[#0071e3] hover:bg-[#0077ed] text-white text-xs md:text-sm font-medium transition-all duration-200 shadow-lg hover:shadow-xl hover:scale-105 active:scale-95">
                                Learn More
                            </a>
                            <a href="/store" class="inline-flex items-center justify-center px-6 py-2.5 rounded-full bg-white/10 hover:bg-white/20 text-white backdrop-blur-md border border-white/20 text-xs md:text-sm font-medium transition-all duration-200 shadow-md hover:scale-105 active:scale-95">
                                Explore
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- =============================================
         MAI AI SECTION
    ============================================= --}}
    <section class="mai-section relative overflow-hidden z-10 my-8" style="background: #050510;">
        <img src="https://images.unsplash.com/photo-1639322537228-f710d846310a?q=80&w=2000&auto=format&fit=crop"
            class="absolute inset-0 w-full h-full object-cover opacity-20 filter blur-sm">
        <div class="absolute inset-0 bg-black/80"></div>

        <div class="relative px-6 flex flex-col md:flex-row items-center gap-16 max-w-[1200px] mx-auto py-24">

            <div class="md:w-1/2 reveal-left pl-6">
                <h2 class="text-xs font-bold tracking-[0.2em] text-[#2997ff] uppercase mb-3">Monarch AI - MAI</h2>
                <h3 class="text-3xl md:text-5xl font-semibold tracking-tight text-white mb-6">
                    Monarch Intelligence <br> AI that knows you.
                </h3>
                <p class="text-gray-400 font-normal leading-relaxed mb-8">
                    An intelligent engine that understands your entire workflow. This isn't just a chatbot—it's your COMPANION, capable of understanding complex queries, summarizing business data, and executing tasks
                    with efficiency and speed.
                </p>
                <ul class="space-y-4 text-sm text-gray-300 font-light">
                    <li class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-[#2997ff]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Get analysis from your business's data in real-time.
                    </li>
                    <li class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-[#2997ff]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Generate tailored email for clients and stakeholders.
                    </li>
                    <li class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-[#2997ff]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Get intelligent advice tailored to you.
                    </li>
                    <li class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-[#2997ff]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Automate repetitive business tasks effortlessly.
                    </li>
                    <li class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-[#2997ff]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Provide Financial Forecasts with backed business data.
                    </li>
                </ul>
            </div>

            <div class="md:w-1/2 w-full reveal-right pr-6 delay-200">
                <div class="glass p-2 rounded-2xl border border-gray-800 shadow-2xl relative bg-black/50">
                    <div class="flex items-center gap-2 px-4 py-3 border-b border-white/5">
                        <div class="w-3 h-3 rounded-full bg-red-500/80"></div>
                        <div class="w-3 h-3 rounded-full bg-yellow-500/80"></div>
                        <div class="w-3 h-3 rounded-full bg-green-500/80"></div>
                        <div class="ml-4 text-[10px] text-gray-500 font-mono">Mai ~</div>
                    </div>
                    <div class="p-6 space-y-6 text-sm">
                        <div class="flex items-start gap-4">
                            <div class="w-8 h-8 rounded-full bg-[#2997ff]/20 flex items-center justify-center shrink-0">
                                You</div>
                            <div class="glass px-4 py-2 rounded-lg rounded-tl-none text-gray-200 border-none">Compare this quarters revenue to last years and make a forecast based on current market conditions.</div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-8 h-8 rounded-full bg-white flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <div
                                class="bg-gray-900 border border-white/10 px-4 py-3 rounded-lg rounded-tl-none text-gray-300 font-light w-full">
                                <p class="mb-2">Per the data, the company has made a total of $87,899 compared to last years quarter revenue of $65,345 which signifies a percentage increase of ...</p>
                                <span class="text-[10px] text-[#2997ff] font-mono">✔ Generated in 1.2s</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- =============================================
         CTA SECTION — Always dark
    ============================================= --}}
    <section class="cta-section relative py-24 px-6 overflow-hidden border-t z-0"
             style="background: #020208; border-color: rgba(255,255,255,0.05);">

        <div id="random-cards-container" class="absolute inset-0 overflow-hidden pointer-events-none z-0">
            @for ($i = 0; $i < 20; $i++) <div
                class="glass-card absolute rounded-2xl transition-all duration-1000 ease-out z-0">
        </div>
        @endfor
        </div>

        <div class="relative max-w-7xl mx-auto text-center z-10 reveal">
            <h2 class="text-xs font-bold tracking-[0.2em] text-[#2997ff] uppercase mb-3">Start Today</h2>
            <h3 class="text-4xl md:text-6xl font-extrabold tracking-tight text-white mb-8">Bring enterprise AI<br>
                into your workflow.</h3>
            <p class="text-lg text-gray-400 font-light leading-relaxed max-w-3xl mx-auto mb-12">
                Scale smarter with MonarchI. Automate business processes, surface predictive insights, and unlock
                actionable intelligence across your operations with AI built for your growth.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('login') }}"
                    class="inline-block bg-[#2997ff] hover:bg-[#1a7de3] text-white font-bold py-4 px-10 rounded-full transition transform hover:scale-105 text-lg">
                    Get Started
                </a>
                <a href="#demo"
                    class="inline-block glass px-10 py-4 rounded-full text-white font-medium hover:bg-white/10 transition text-lg">
                    Contact Us
                </a>
            </div>
        </div>
    </section>

    {{-- =============================================}}
         CASE STUDIES SECTION
    {{-- =============================================
         UNIFIED DUAL-TRACK CAROUSEL
         Case Studies + Past Projects scroll in sync.
         Single centered controls at the bottom (Apple-style).
    ============================================= --}}
    <section class="unified-carousel-section py-16" id="unified-carousel" style="background: var(--bg-primary); overflow: hidden;">
        <div class="max-w-[1200px] mx-auto px-6 mb-10 reveal">
            {{-- Two labels side by side --}}
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-1 md:gap-0">
                <div>
                    <p class="text-xs font-semibold tracking-[0.2em] text-[#2997ff] uppercase mb-1">Case Studies &amp; Projects</p>
                    <h2 class="text-3xl md:text-4xl font-semibold tracking-tight leading-tight" style="color: var(--text-primary);">
                        Research, Insights &amp;<br class="hidden md:block"> Work We're Proud Of.
                    </h2>
                </div>
                <p class="text-sm max-w-xs leading-relaxed mt-3 md:mt-0" style="color: var(--text-secondary);">
                    Swipe or use the arrows to explore. Both tracks move together.
                </p>
            </div>
        </div>

        {{-- ── Track 1: Case Studies ── --}}
        <div class="flex gap-6 overflow-x-auto hide-scroll snap-x snap-mandatory px-6 w-full pb-3" id="cs-track">

            {{-- Case Study 1: BoG --}}
            <div class="snap-item shrink-0 w-[85vw] md:w-[50vw] h-[280px] md:h-[300px] relative rounded-3xl overflow-hidden group">
                <img src="{{asset('images/BoG.webp')}}"
                    class="absolute inset-0 w-full h-3/4 object-cover opacity-60 transition duration-1000 group-hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-black via-black/20 to-transparent"></div>
                <div class="absolute bottom-6 left-6 z-10 max-w-lg">
                    <span class="text-xs font-bold tracking-[0.2em] text-[#2997ff] uppercase mb-2 block">FinTech Sector - Ghana</span>
                    <h3 class="text-xl md:text-2xl font-semibold text-white mb-2">National Payment Systems Strategy</h3>
                    <p class="text-gray-300 mb-4 font-light text-sm leading-relaxed">The Bank of Ghana's strategy mandates telecoms and fintechs to upgrade security infrastructure and institute automated monitoring systems.</p>
                    <a class="bg-white text-black px-5 py-1.5 rounded-full font-medium hover:bg-gray-200 transition text-sm"
                       href="https://www.bog.gov.gh/wp-content/uploads/2026/02/NATIONAL-PAYMENT-SYSTEMS-STRATEGY-2025-2029.pdf">Read Case Study</a>
                </div>
            </div>

            {{-- Case Study 2: AI Health --}}
            <div class="snap-item shrink-0 w-[85vw] md:w-[50vw] h-[280px] md:h-[300px] relative rounded-3xl overflow-hidden group">
                <img src="{{asset('images/37Hospital.jpg')}}"
                    class="absolute inset-0 w-full h-full object-cover opacity-60 transition duration-1000 group-hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-black via-black/20 to-transparent"></div>
                <div class="absolute bottom-6 left-6 z-10 max-w-lg">
                    <span class="text-xs font-bold tracking-[0.2em] text-[#2997ff] uppercase mb-2 block">HealthTech - Ghana</span>
                    <h3 class="text-xl md:text-2xl font-semibold text-white mb-2">AI-Driven Health Programme</h3>
                    <p class="text-gray-300 mb-4 font-light text-sm leading-relaxed">Ghana launched an AI-driven health programme with WHO and UNDP, deploying early warning systems for climate-sensitive diseases.</p>
                    <a class="bg-white text-black px-5 py-1.5 rounded-full font-medium hover:bg-gray-200 transition text-sm"
                       href="https://www.afro.who.int/countries/ghana/news/ghana-launches-artificial-intelligence-driven-health-programme-strengthen-systems-and-safeguard">Read Case Study</a>
                </div>
            </div>

            {{-- Case Study 3: Africa Fintech AI Credit Scoring --}}
            <div class="snap-item shrink-0 w-[85vw] md:w-[50vw] h-[280px] md:h-[300px] relative rounded-3xl overflow-hidden group">
                <img src="https://images.unsplash.com/photo-1563013544-824ae1b704d3?auto=format&fit=crop&w=1200&q=80"
                    alt="Africa Fintech AI"
                    class="absolute inset-0 w-full h-full object-cover opacity-60 transition duration-1000 group-hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-black via-black/20 to-transparent"></div>
                <div class="absolute bottom-6 left-6 z-10 max-w-lg">
                    <span class="text-xs font-bold tracking-[0.2em] text-[#2997ff] uppercase mb-2 block">FinTech - West Africa</span>
                    <h3 class="text-xl md:text-2xl font-semibold text-white mb-2">AI Credit Scoring for Unbanked SMEs</h3>
                    <p class="text-gray-300 mb-4 font-light text-sm leading-relaxed">AI engines analysing mobile-money patterns issue instant micro-loans to SMEs — reducing approval time from weeks to minutes.</p>
                    <a class="bg-white text-black px-5 py-1.5 rounded-full font-medium hover:bg-gray-200 transition text-sm"
                       href="https://getcarbon.co" target="_blank" rel="noopener noreferrer">Read Case Study</a>
                </div>
            </div>

            {{-- Case Study 4: GhanaPostGPS --}}
            <div class="snap-item shrink-0 w-[85vw] md:w-[50vw] h-[280px] md:h-[300px] relative rounded-3xl overflow-hidden group">
                <img src="https://images.unsplash.com/photo-1524661135-423995f22d0b?auto=format&fit=crop&w=1200&q=80"
                    alt="Ghana Smart City"
                    class="absolute inset-0 w-full h-full object-cover opacity-55 transition duration-1000 group-hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-black via-black/30 to-transparent"></div>
                <div class="absolute bottom-6 left-6 z-10 max-w-lg">
                    <span class="text-xs font-bold tracking-[0.2em] text-[#2997ff] uppercase mb-2 block">Smart Cities - Ghana</span>
                    <h3 class="text-xl md:text-2xl font-semibold text-white mb-2">GhanaPostGPS &amp; Digital Addressing</h3>
                    <p class="text-gray-300 mb-4 font-light text-sm leading-relaxed">A unique code for every 5m&times;5m grid across Ghana — enabling emergency response and logistics for millions without postal addresses.</p>
                    <a class="bg-white text-black px-5 py-1.5 rounded-full font-medium hover:bg-gray-200 transition text-sm"
                       href="https://ghanapostgps.com" target="_blank" rel="noopener noreferrer">Read Case Study</a>
                </div>
            </div>

            {{-- Case Study 5: Nuru AgriTech --}}
            <div class="snap-item shrink-0 w-[85vw] md:w-[50vw] h-[280px] md:h-[300px] relative rounded-3xl overflow-hidden group">
                <img src="https://images.unsplash.com/photo-1500937386664-56d1dfef3854?auto=format&fit=crop&w=1200&q=80"
                    alt="Africa AgriTech AI"
                    class="absolute inset-0 w-full h-full object-cover opacity-55 transition duration-1000 group-hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-black via-black/30 to-transparent"></div>
                <div class="absolute bottom-6 left-6 z-10 max-w-lg">
                    <span class="text-xs font-bold tracking-[0.2em] text-[#2997ff] uppercase mb-2 block">AgriTech - East Africa</span>
                    <h3 class="text-xl md:text-2xl font-semibold text-white mb-2">Nuru: Offline AI Crop Disease Diagnosis</h3>
                    <p class="text-gray-300 mb-4 font-light text-sm leading-relaxed">Nuru uses on-device vision to diagnose crop diseases offline, reaching millions of smallholder farmers via the UN ENSURE programme.</p>
                    <a class="bg-white text-black px-5 py-1.5 rounded-full font-medium hover:bg-gray-200 transition text-sm"
                       href="https://plantvillage.psu.edu" target="_blank" rel="noopener noreferrer">Read Case Study</a>
                </div>
            </div>

        </div>

        {{-- ── Track 2: Past Projects ── --}}
        <div class="flex gap-6 overflow-x-auto hide-scroll snap-x snap-mandatory px-6 w-full pb-4 mt-4" id="proj-track">

            {{-- Project 1 --}}
            <div class="group snap-item shrink-0 w-[80vw] md:w-[50vw] h-[200px] md:h-[210px] relative rounded-2xl overflow-hidden cursor-pointer shadow-lg" data-touch-card>
                <img src="https://images.unsplash.com/photo-1550751827-4bd374c3f58b?auto=format&fit=crop&w=800&q=80"
                    alt="Edge Intelligence Project"
                    class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 ease-in-out group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-50 group-hover:opacity-0 transition-opacity duration-300"></div>
                <div class="absolute inset-0 bg-black/85 backdrop-blur-sm opacity-0 group-hover:opacity-100 transition-all duration-300 flex flex-col justify-center p-8">
                    <div class="flex gap-2 mb-2 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                        <span class="text-xs font-medium px-2 py-1 bg-[#2997ff]/20 text-[#2997ff] rounded-md">Edge Computing</span>
                        <span class="text-xs font-medium px-2 bg-white/10 text-white rounded-md">Logistics</span>
                    </div>
                    <h3 class="text-2xl text-white font-semibold mb-1 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">Project Zero Latency</h3>
                    <p class="text-gray-300 font-light leading-relaxed text-sm transform translate-y-4 group-hover:translate-y-0 transition-transform duration-700">
                        Deployed Monarch's Edge Intelligence to remote hardware — offline processing without latency in critical logistical environments.
                    </p>
                    <a href="#" class="mt-2 text-white text-sm font-medium flex items-center gap-2 hover:text-[#2997ff] transition w-max transform translate-y-4 group-hover:translate-y-0 duration-700 delay-75">
                        Visit Store
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </div>

            {{-- Project 2 --}}
            <div class="group snap-item shrink-0 w-[80vw] md:w-[50vw] h-[200px] md:h-[210px] relative rounded-2xl overflow-hidden cursor-pointer shadow-lg" data-touch-card>
                <img src="https://images.unsplash.com/photo-1563986768609-322da13575f3?auto=format&fit=crop&w=800&q=80"
                    alt="SaaS Platform"
                    class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 ease-in-out group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-50 group-hover:opacity-0 transition-opacity duration-300"></div>
                <div class="absolute inset-0 bg-black/85 backdrop-blur-sm opacity-0 group-hover:opacity-100 transition-all duration-300 flex flex-col justify-center p-8">
                    <div class="flex gap-2 mb-2 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                        <span class="text-xs font-medium px-2 py-1 bg-[#2997ff]/20 text-[#2997ff] rounded-md">SaaS</span>
                        <span class="text-xs font-medium px-2 bg-white/10 text-white rounded-md">Finance</span>
                    </div>
                    <h3 class="text-2xl text-white font-semibold mb-1 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">invenStore Platform</h3>
                    <p class="text-gray-300 font-light leading-relaxed text-sm transform translate-y-4 group-hover:translate-y-0 transition-transform duration-700">
                        Full-stack inventory management SaaS for SMEs across Ghana with real-time stock tracking and automated reorder alerts.
                    </p>
                    <a href="#" class="mt-2 text-white text-sm font-medium flex items-center gap-2 hover:text-[#2997ff] transition w-max transform translate-y-4 group-hover:translate-y-0 duration-700 delay-75">
                        Learn More
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </div>

            {{-- Project 3 --}}
            <div class="group snap-item shrink-0 w-[80vw] md:w-[50vw] h-[200px] md:h-[210px] relative rounded-2xl overflow-hidden cursor-pointer shadow-lg" data-touch-card>
                <img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=800&q=80"
                    alt="Health Tech Project"
                    class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 ease-in-out group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-50 group-hover:opacity-0 transition-opacity duration-300"></div>
                <div class="absolute inset-0 bg-black/85 backdrop-blur-sm opacity-0 group-hover:opacity-100 transition-all duration-300 flex flex-col justify-center p-8">
                    <div class="flex gap-2 mb-2 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                        <span class="text-xs font-medium px-2 py-1 bg-[#2997ff]/20 text-[#2997ff] rounded-md">HealthTech</span>
                        <span class="text-xs font-medium px-2 bg-white/10 text-white rounded-md">AI</span>
                    </div>
                    <h3 class="text-2xl text-white font-semibold mb-1 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">MAI Health Dashboard</h3>
                    <p class="text-gray-300 font-light leading-relaxed text-sm transform translate-y-4 group-hover:translate-y-0 transition-transform duration-700">
                        AI-powered health monitoring dashboard for clinic staff, surfacing patient trends and flagging anomalies with zero manual input.
                    </p>
                    <a href="#" class="mt-2 text-white text-sm font-medium flex items-center gap-2 hover:text-[#2997ff] transition w-max transform translate-y-4 group-hover:translate-y-0 duration-700 delay-75">
                        Learn More
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </div>

            {{-- Project 4 --}}
            <div class="group snap-item shrink-0 w-[80vw] md:w-[50vw] h-[200px] md:h-[210px] relative rounded-2xl overflow-hidden cursor-pointer shadow-lg" data-touch-card>
                <img src="https://images.unsplash.com/photo-1558494949-ef010cbdcc31?auto=format&fit=crop&w=800&q=80"
                    alt="KYC Compliance AI"
                    class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 ease-in-out group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-50 group-hover:opacity-0 transition-opacity duration-300"></div>
                <div class="absolute inset-0 bg-black/85 backdrop-blur-sm opacity-0 group-hover:opacity-100 transition-all duration-300 flex flex-col justify-center p-8">
                    <div class="flex gap-2 mb-2 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                        <span class="text-xs font-medium px-2 py-1 bg-[#2997ff]/20 text-[#2997ff] rounded-md">Compliance</span>
                        <span class="text-xs font-medium px-2 bg-white/10 text-white rounded-md">FinTech</span>
                    </div>
                    <h3 class="text-2xl text-white font-semibold mb-1 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">KYC Automation Suite</h3>
                    <p class="text-gray-300 font-light leading-relaxed text-sm transform translate-y-4 group-hover:translate-y-0 transition-transform duration-700">
                        AI-driven KYC pipeline for a Ghanaian fintech — cutting onboarding time by 78% with full Bank of Ghana regulatory compliance.
                    </p>
                    <a href="#" class="mt-2 text-white text-sm font-medium flex items-center gap-2 hover:text-[#2997ff] transition w-max transform translate-y-4 group-hover:translate-y-0 duration-700 delay-75">
                        Learn More
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </div>

            {{-- Project 5 --}}
            <div class="group snap-item shrink-0 w-[80vw] md:w-[50vw] h-[200px] md:h-[210px] relative rounded-2xl overflow-hidden cursor-pointer shadow-lg" data-touch-card>
                <img src="https://images.unsplash.com/photo-1530836369250-ef72a3f5cda8?auto=format&fit=crop&w=800&q=80"
                    alt="MAI AgriAdvisor"
                    class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 ease-in-out group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-50 group-hover:opacity-0 transition-opacity duration-300"></div>
                <div class="absolute inset-0 bg-black/85 backdrop-blur-sm opacity-0 group-hover:opacity-100 transition-all duration-300 flex flex-col justify-center p-8">
                    <div class="flex gap-2 mb-2 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                        <span class="text-xs font-medium px-2 py-1 bg-[#2997ff]/20 text-[#2997ff] rounded-md">AgriTech</span>
                        <span class="text-xs font-medium px-2 bg-white/10 text-white rounded-md">AI / MAI</span>
                    </div>
                    <h3 class="text-2xl text-white font-semibold mb-1 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">MAI AgriAdvisor</h3>
                    <p class="text-gray-300 font-light leading-relaxed text-sm transform translate-y-4 group-hover:translate-y-0 transition-transform duration-700">
                        Offline-capable crop advisory engine for smallholder farmers in Northern Ghana — real-time pest alerts, yield forecasts, and market prices via SMS.
                    </p>
                    <a href="#" class="mt-2 text-white text-sm font-medium flex items-center gap-2 hover:text-[#2997ff] transition w-max transform translate-y-4 group-hover:translate-y-0 duration-700 delay-75">
                        Learn More
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </div>

        </div>

        {{-- ── Shared centered controls ── --}}
        <div class="unified-carousel-controls">
            <button class="carousel-arrow" id="unified-prev" aria-label="Previous">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </button>
            <div class="carousel-dots" id="unified-dots"></div>
            <button class="carousel-arrow" id="unified-next" aria-label="Next">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </button>
        </div>

    </section>

</x-main-layout>