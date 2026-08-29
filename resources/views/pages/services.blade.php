<x-main-layout
    title="Enterprise AI & Technology Services — MonarchI HQ"
    description="Explore MonarchI HQ services: Custom SaaS Platforms, Intelligent Workflow Automation, Software & Web Engineering, and Integrated IoT Systems."
    keywords="MonarchI Services, Enterprise SaaS, Workflow Automation, Custom Software Development, Web Development, IoT Integration, Cyber Security, Tech Solutions Africa">

    {{-- =============================================
         SERVICES HERO
    ============================================= --}}
    <section class="relative pt-32 pb-20 px-6 min-h-[60vh] flex items-center justify-center overflow-hidden" style="background: var(--bg-primary);">
        <!-- Background accents -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0 pointer-events-none">
            <div class="absolute top-[-20%] right-[-10%] w-[60%] h-[80%] rounded-full opacity-20 blur-[120px]" style="background: radial-gradient(circle, #2997ff, transparent 70%);"></div>
            <div class="absolute bottom-[-20%] left-[-10%] w-[50%] h-[60%] rounded-full opacity-10 blur-[100px]" style="background: radial-gradient(circle, #2997ff, transparent 70%);"></div>
        </div>

        <div class="max-w-[1000px] mx-auto text-center relative z-10 reveal">
            <h1 class="text-xs font-bold tracking-[0.25em] text-[#2997ff] uppercase mb-6">Our Expertise</h1>
            <h2 class="text-5xl md:text-7xl font-bold tracking-tight mb-8 leading-tight" style="color: var(--text-primary);">
                Engineering the <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#2997ff] to-[#8ebcf2]">Future of Business.</span>
            </h2>
            <p class="text-xl md:text-2xl max-w-2xl mx-auto font-light leading-relaxed" style="color: var(--text-secondary);">
                From zero-latency edge intelligence to enterprise SaaS, we design systems that automate workflows and unlock predictive insights.
            </p>
        </div>
    </section>

    {{-- =============================================
         DETAILED SERVICES - Alternating Rows
    ============================================= --}}
    <section class="py-24 px-6 z-10 relative border-t" style="border-color: var(--border-color); background: var(--bg-section);">
        <div class="max-w-[1200px] mx-auto flex flex-col gap-32">

            {{-- Service 1: SaaS --}}
            <div class="flex flex-col md:flex-row items-center gap-12 lg:gap-24 reveal">
                <div class="w-full md:w-1/2 order-2 md:order-1">
                    <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-[#2997ff]/10 text-[#2997ff] mb-6">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </div>
                    <h3 class="text-3xl md:text-4xl font-semibold mb-4" style="color: var(--text-primary);">SaaS Platforms</h3>
                    <p class="text-lg leading-relaxed mb-6" style="color: var(--text-secondary);">
                        We build proprietary software solutions tailored for business workflow automation. Powered by MAI, our SaaS platforms are designed to scale instantly, providing robust, cloud-native architectures that eliminate operational bottlenecks.
                    </p>
                    <ul class="space-y-3 mb-8" style="color: var(--text-secondary);">
                        <li class="flex items-center gap-3"><svg class="w-5 h-5 text-[#2997ff]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Multi-tenant cloud architectures</li>
                        <li class="flex items-center gap-3"><svg class="w-5 h-5 text-[#2997ff]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Real-time data synchronization</li>
                        <li class="flex items-center gap-3"><svg class="w-5 h-5 text-[#2997ff]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Secure API integrations</li>
                    </ul>
                </div>
                <div class="w-full md:w-1/2 order-1 md:order-2">
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl group h-[400px]">
                        <img src="{{ asset('images/service-saas.jpg') }}" loading="lazy" decoding="async" class="absolute inset-0 w-full h-full object-cover transition duration-1000 group-hover:scale-105" alt="SaaS Platforms">
                        <div class="absolute inset-0 bg-black/20 group-hover:bg-transparent transition duration-500"></div>
                    </div>
                </div>
            </div>

            {{-- Service 2: Edge Intelligence --}}
            <div class="flex flex-col md:flex-row items-center gap-12 lg:gap-24 reveal delay-100">
                <div class="w-full md:w-1/2">
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl group h-[400px]">
                        <img src="{{ asset('images/ai.png') }}" loading="lazy" decoding="async" class="absolute inset-0 w-full h-full object-cover transition duration-1000 group-hover:scale-105" alt="Edge Intelligence">
                        <div class="absolute inset-0 bg-black/20 group-hover:bg-transparent transition duration-500"></div>
                    </div>
                </div>
                <div class="w-full md:w-1/2">
                    <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-[#2997ff]/10 text-[#2997ff] mb-6">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <h3 class="text-3xl md:text-4xl font-semibold mb-4" style="color: var(--text-primary);">Edge Intelligence</h3>
                    <p class="text-lg leading-relaxed mb-6" style="color: var(--text-secondary);">
                        Deploy artificial intelligence directly onto hardware units without relying on cloud infrastructure. MAI processes real-time video, environmental sensors, and behavioral patterns at zero latency.
                    </p>
                    <ul class="space-y-3 mb-8" style="color: var(--text-secondary);">
                        <li class="flex items-center gap-3"><svg class="w-5 h-5 text-[#2997ff]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Offline machine learning inference</li>
                        <li class="flex items-center gap-3"><svg class="w-5 h-5 text-[#2997ff]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Computer vision at the edge</li>
                        <li class="flex items-center gap-3"><svg class="w-5 h-5 text-[#2997ff]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Ultra-low power consumption</li>
                    </ul>
                </div>
            </div>

            {{-- Service 3: Workflow Automation --}}
            <div class="flex flex-col md:flex-row items-center gap-12 lg:gap-24 reveal delay-100">
                <div class="w-full md:w-1/2 order-2 md:order-1">
                    <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-[#2997ff]/10 text-[#2997ff] mb-6">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                    </div>
                    <h3 class="text-3xl md:text-4xl font-semibold mb-4" style="color: var(--text-primary);">Workflow Automation</h3>
                    <p class="text-lg leading-relaxed mb-6" style="color: var(--text-secondary);">
                        Eliminate manual data entry and repetitive operations. We build customized robotic process automation (RPA) workflows that connect fragmented systems, ensuring your team focuses purely on high-leverage growth.
                    </p>
                    <ul class="space-y-3 mb-8" style="color: var(--text-secondary);">
                        <li class="flex items-center gap-3"><svg class="w-5 h-5 text-[#2997ff]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> AI-driven process mapping</li>
                        <li class="flex items-center gap-3"><svg class="w-5 h-5 text-[#2997ff]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Automated data extraction &amp; routing</li>
                        <li class="flex items-center gap-3"><svg class="w-5 h-5 text-[#2997ff]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Legacy system integration</li>
                    </ul>
                </div>
                <div class="w-full md:w-1/2 order-1 md:order-2">
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl group h-[400px]">
                        <img src="{{ asset('images/service-workflow.jpg') }}" loading="lazy" decoding="async" class="absolute inset-0 w-full h-full object-cover transition duration-1000 group-hover:scale-105" alt="Workflow Automation">
                        <div class="absolute inset-0 bg-black/20 group-hover:bg-transparent transition duration-500"></div>
                    </div>
                </div>
            </div>

            {{-- Service 4: Integrated Systems --}}
            <div class="flex flex-col md:flex-row items-center gap-12 lg:gap-24 reveal delay-100">
                <div class="w-full md:w-1/2">
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl group h-[400px]">
                        <img src="{{ asset('images/service-integrated-systems.jpg') }}" loading="lazy" decoding="async" class="absolute inset-0 w-full h-full object-cover transition duration-1000 group-hover:scale-105" alt="Integrated Systems">
                        <div class="absolute inset-0 bg-black/20 group-hover:bg-transparent transition duration-500"></div>
                    </div>
                </div>
                <div class="w-full md:w-1/2">
                    <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-[#2997ff]/10 text-[#2997ff] mb-6">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18"/></svg>
                    </div>
                    <h3 class="text-3xl md:text-4xl font-semibold mb-4" style="color: var(--text-primary);">Integrated Systems</h3>
                    <p class="text-lg leading-relaxed mb-6" style="color: var(--text-secondary);">
                        Custom embedded hardware and software systems built to global industry standards. We architect robust IoT ecosystems that communicate seamlessly, from factory floors to smart city infrastructure.
                    </p>
                    <ul class="space-y-3 mb-8" style="color: var(--text-secondary);">
                        <li class="flex items-center gap-3"><svg class="w-5 h-5 text-[#2997ff]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> IoT sensor networks</li>
                        <li class="flex items-center gap-3"><svg class="w-5 h-5 text-[#2997ff]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Embedded firmware development</li>
                        <li class="flex items-center gap-3"><svg class="w-5 h-5 text-[#2997ff]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Real-time telemetry dashboards</li>
                    </ul>
                </div>
            </div>

            {{-- Service 5: Custom Software & Web --}}
            <div class="flex flex-col md:flex-row items-center gap-12 lg:gap-24 reveal delay-100">
                <div class="w-full md:w-1/2 order-2 md:order-1">
                    <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-[#2997ff]/10 text-[#2997ff] mb-6">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                    </div>
                    <h3 class="text-3xl md:text-4xl font-semibold mb-4" style="color: var(--text-primary);">Software &amp; Web Development</h3>
                    <p class="text-lg leading-relaxed mb-6" style="color: var(--text-secondary);">
                        Premium, high-performance applications designed to reflect your brand and solve complex operational challenges. We build intuitive desktop, mobile, and web experiences focused on speed, security, and aesthetics.
                    </p>
                    <ul class="space-y-3 mb-8" style="color: var(--text-secondary);">
                        <li class="flex items-center gap-3"><svg class="w-5 h-5 text-[#2997ff]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Native mobile applications</li>
                        <li class="flex items-center gap-3"><svg class="w-5 h-5 text-[#2997ff]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> High-performance web apps (SPA/PWA)</li>
                        <li class="flex items-center gap-3"><svg class="w-5 h-5 text-[#2997ff]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Enterprise desktop software</li>
                    </ul>
                </div>
                <div class="w-full md:w-1/2 order-1 md:order-2">
                    <div class="grid grid-cols-2 gap-4 h-[400px]">
                        <div class="relative rounded-3xl overflow-hidden shadow-2xl group col-span-1 row-span-2">
                            <img src="{{ asset('images/service-softwaredev.jpg') }}" loading="lazy" decoding="async" class="absolute inset-0 w-full h-full object-cover transition duration-1000 group-hover:scale-105" alt="Software Development">
                        </div>
                        <div class="relative rounded-3xl overflow-hidden shadow-2xl group col-span-1 row-span-2">
                            <img src="{{ asset('images/service-webdev.jpg') }}" loading="lazy" decoding="async" class="absolute inset-0 w-full h-full object-cover transition duration-1000 group-hover:scale-105" alt="Web Development">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    {{-- =============================================
         OUR PROCESS / METHODOLOGY (Bento Box style)
    ============================================= --}}
    <section class="py-24 px-6 z-10 border-t" style="border-color: var(--border-color); background: var(--bg-primary);">
        <div class="max-w-[1200px] mx-auto reveal">
            <div class="text-center mb-16">
                <h2 class="text-xs font-bold tracking-[0.2em] text-[#2997ff] uppercase mb-3">Our Methodology</h2>
                <h3 class="text-4xl md:text-5xl font-semibold tracking-tight" style="color: var(--text-primary);">
                    How we deliver excellence.
                </h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Step 1 -->
                <div class="p-8 rounded-3xl relative overflow-hidden group" style="background: var(--bg-card); border: 1px solid var(--border-color);">
                    <div class="text-5xl font-bold text-[#2997ff]/20 mb-4 transition-transform group-hover:scale-110 group-hover:-translate-y-2 group-hover:text-[#2997ff]/30 duration-500">01</div>
                    <h4 class="text-xl font-semibold mb-3" style="color: var(--text-primary);">Discovery &amp; Architecture</h4>
                    <p class="text-sm leading-relaxed" style="color: var(--text-secondary);">We deeply analyze your business bottlenecks and architect a scalable, future-proof solution tailored to your exact needs.</p>
                </div>
                
                <!-- Step 2 -->
                <div class="p-8 rounded-3xl relative overflow-hidden group" style="background: var(--bg-card); border: 1px solid var(--border-color);">
                    <div class="text-5xl font-bold text-[#2997ff]/20 mb-4 transition-transform group-hover:scale-110 group-hover:-translate-y-2 group-hover:text-[#2997ff]/30 duration-500">02</div>
                    <h4 class="text-xl font-semibold mb-3" style="color: var(--text-primary);">Prototyping &amp; Design</h4>
                    <p class="text-sm leading-relaxed" style="color: var(--text-secondary);">We construct rapid prototypes and wireframes, ensuring the user experience is intuitive and perfectly aligned with your brand.</p>
                </div>

                <!-- Step 3 -->
                <div class="p-8 rounded-3xl relative overflow-hidden group" style="background: var(--bg-card); border: 1px solid var(--border-color);">
                    <div class="text-5xl font-bold text-[#2997ff]/20 mb-4 transition-transform group-hover:scale-110 group-hover:-translate-y-2 group-hover:text-[#2997ff]/30 duration-500">03</div>
                    <h4 class="text-xl font-semibold mb-3" style="color: var(--text-primary);">Development &amp; AI Integration</h4>
                    <p class="text-sm leading-relaxed" style="color: var(--text-secondary);">Our engineering team builds the core infrastructure, securely integrating our MAI models for advanced predictive capabilities.</p>
                </div>

                <!-- Step 4 -->
                <div class="p-8 rounded-3xl relative overflow-hidden group" style="background: var(--bg-card); border: 1px solid var(--border-color);">
                    <div class="text-5xl font-bold text-[#2997ff]/20 mb-4 transition-transform group-hover:scale-110 group-hover:-translate-y-2 group-hover:text-[#2997ff]/30 duration-500">04</div>
                    <h4 class="text-xl font-semibold mb-3" style="color: var(--text-primary);">Deployment &amp; Optimization</h4>
                    <p class="text-sm leading-relaxed" style="color: var(--text-secondary);">We deploy to production with zero downtime, continuously monitoring and optimizing performance to ensure flawless operation.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- =============================================
         CTA SECTION
    ============================================= --}}
    <section class="py-24 px-6 border-t relative overflow-hidden" style="border-color: var(--border-color); background: var(--bg-section);">
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] rounded-full opacity-10 blur-[120px]" style="background: radial-gradient(circle, #2997ff, transparent 60%);"></div>
        </div>
        
        <div class="max-w-[800px] mx-auto text-center relative z-10 reveal">
            <h2 class="text-4xl md:text-6xl font-bold tracking-tight mb-6" style="color: var(--text-primary);">Ready to transform your operations?</h2>
            <p class="text-xl mb-10 font-light" style="color: var(--text-secondary);">Let's discuss how MonarchI can build intelligent systems that drive growth and efficiency for your business.</p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="/contact" class="px-8 py-4 rounded-full bg-[#2997ff] text-white font-medium hover:bg-blue-600 transition shadow-lg shadow-blue-500/30">Start a Project</a>
                <a href="/projects" class="px-8 py-4 rounded-full border border-gray-600 font-medium hover:bg-white/5 transition" style="color: var(--text-primary);">View Past Work</a>
            </div>
        </div>
    </section>

</x-main-layout>