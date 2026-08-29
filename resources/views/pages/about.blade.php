<x-main-layout
    title="About MonarchI HQ — Engineering the Future of Enterprise Intelligence"
    description="Learn about MonarchI HQ, our vision, and our proprietary AI model MAI powering zero-latency edge intelligence, workflow automation, and enterprise digital transformation."
    keywords="About MonarchI, MonarchI HQ, Enterprise AI Africa, MAI Model, Edge Computing Ghana, Tech Innovation Accra, Enterprise Digital Transformation">

    {{-- =============================================
         ABOUT HERO
    ============================================= --}}
    <section class="relative pt-32 pb-20 px-6 min-h-[60vh] flex items-center justify-center overflow-hidden" style="background: var(--bg-primary);">
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0 pointer-events-none">
            <div class="absolute top-[-20%] left-[-10%] w-[60%] h-[80%] rounded-full opacity-20 blur-[120px]" style="background: radial-gradient(circle, #2997ff, transparent 70%);"></div>
            <div class="absolute bottom-[-20%] right-[-10%] w-[50%] h-[60%] rounded-full opacity-10 blur-[100px]" style="background: radial-gradient(circle, #2997ff, transparent 70%);"></div>
        </div>

        <div class="max-w-[1000px] mx-auto text-center relative z-10 reveal">
            <h1 class="text-xs font-bold tracking-[0.25em] text-[#2997ff] uppercase mb-6">About MonarchI</h1>
            <h2 class="text-5xl md:text-7xl font-bold tracking-tight mb-8 leading-tight" style="color: var(--text-primary);">
                Pioneering <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#2997ff] to-[#8ebcf2]">Intelligence</span> <br>
                for a Connected World.
            </h2>
            <p class="text-xl md:text-2xl max-w-2xl mx-auto font-light leading-relaxed" style="color: var(--text-secondary);">
                Based in Accra, Ghana, we are an elite engineering firm building the proprietary AI, edge hardware, and enterprise SaaS that powers the next generation of global industry.
            </p>
        </div>
    </section>

    {{-- =============================================
         OUR MISSION / STORY (Image + Text Split)
    ============================================= --}}
    <section class="py-24 px-6 z-10 relative border-t" style="border-color: var(--border-color); background: var(--bg-section);">
        <div class="max-w-[1200px] mx-auto flex flex-col lg:flex-row items-center gap-16 lg:gap-24 reveal">
            
            <div class="w-full lg:w-1/2">
                <div class="relative rounded-3xl overflow-hidden shadow-2xl group h-[500px]">
                    <img src="{{ asset('images/world-tech.png') }}" class="absolute inset-0 w-full h-full object-cover transition duration-1000 group-hover:scale-105" alt="Global Technology">
                    <div class="absolute inset-0 bg-black/20 group-hover:bg-transparent transition duration-500"></div>
                </div>
            </div>

            <div class="w-full lg:w-1/2">
                <h3 class="text-3xl md:text-4xl font-semibold mb-6" style="color: var(--text-primary);">Our Vision</h3>
                <p class="text-lg leading-relaxed mb-6" style="color: var(--text-secondary);">
                    MonarchI was founded with a singular focus: to engineer software and integrated systems that remove friction from complex business operations. 
                </p>
                <p class="text-lg leading-relaxed mb-8" style="color: var(--text-secondary);">
                    We recognized early that the future belongs to enterprises that can process data instantly and act autonomously. That’s why we developed <strong>MAI</strong>—our proprietary artificial intelligence model designed to automate workflows and drive offline edge analytics without latency.
                </p>
                
                <div class="grid grid-cols-2 gap-6 pt-6 border-t" style="border-color: var(--border-color);">
                    <div>
                        <h4 class="text-4xl font-bold text-[#2997ff] mb-2">10+</h4>
                        <p class="text-sm font-medium" style="color: var(--text-primary);">Enterprise Platforms Deployed</p>
                    </div>
                    <div>
                        <h4 class="text-4xl font-bold text-[#2997ff] mb-2">Zero</h4>
                        <p class="text-sm font-medium" style="color: var(--text-primary);">Latency Edge Inference</p>
                    </div>
                </div>
            </div>

        </div>
    </section>

    {{-- =============================================
         CORE VALUES (Grid)
    ============================================= --}}
    <section class="py-24 px-6 z-10 border-t" style="border-color: var(--border-color); background: var(--bg-primary);">
        <div class="max-w-[1200px] mx-auto reveal">
            <div class="text-center mb-16">
                <h2 class="text-xs font-bold tracking-[0.2em] text-[#2997ff] uppercase mb-3">Core Values</h2>
                <h3 class="text-4xl md:text-5xl font-semibold tracking-tight" style="color: var(--text-primary);">
                    What drives our engineering.
                </h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Value 1 -->
                <div class="p-10 rounded-3xl group transition duration-300 hover:-translate-y-2 shadow-lg" style="background: var(--bg-card); border: 1px solid var(--border-color);">
                    <div class="w-14 h-14 rounded-2xl bg-[#2997ff]/10 text-[#2997ff] flex items-center justify-center mb-6 transition-transform group-hover:scale-110">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <h4 class="text-xl font-semibold mb-3" style="color: var(--text-primary);">Uncompromising Performance</h4>
                    <p class="text-sm leading-relaxed" style="color: var(--text-secondary);">We write highly optimized code and design hardware architectures that prioritize speed, efficiency, and zero downtime under heavy enterprise loads.</p>
                </div>

                <!-- Value 2 -->
                <div class="p-10 rounded-3xl group transition duration-300 hover:-translate-y-2 shadow-lg" style="background: var(--bg-card); border: 1px solid var(--border-color);">
                    <div class="w-14 h-14 rounded-2xl bg-[#2997ff]/10 text-[#2997ff] flex items-center justify-center mb-6 transition-transform group-hover:scale-110">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <h4 class="text-xl font-semibold mb-3" style="color: var(--text-primary);">Fortified Security</h4>
                    <p class="text-sm leading-relaxed" style="color: var(--text-secondary);">Security is not an afterthought. We build bank-grade encryption and access controls directly into the foundation of every SaaS and IoT product we ship.</p>
                </div>

                <!-- Value 3 -->
                <div class="p-10 rounded-3xl group transition duration-300 hover:-translate-y-2 shadow-lg" style="background: var(--bg-card); border: 1px solid var(--border-color);">
                    <div class="w-14 h-14 rounded-2xl bg-[#2997ff]/10 text-[#2997ff] flex items-center justify-center mb-6 transition-transform group-hover:scale-110">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
                    </div>
                    <h4 class="text-xl font-semibold mb-3" style="color: var(--text-primary);">Global Standards, Local Impact</h4>
                    <p class="text-sm leading-relaxed" style="color: var(--text-secondary);">While our code meets elite global standards, our solutions are deeply attuned to the realities of local infrastructure, enabling offline capabilities in remote regions.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- =============================================
         THE MAI ENGINE (Special Feature)
    ============================================= --}}
    <section class="py-24 px-6 border-t relative overflow-hidden" style="border-color: var(--border-color); background: var(--bg-section);">
        <div class="max-w-[1200px] mx-auto reveal">
            <div class="flex flex-col md:flex-row items-center bg-black rounded-3xl overflow-hidden shadow-2xl">
                
                <div class="w-full md:w-1/2 p-10 md:p-16">
                    <h2 class="text-xs font-bold tracking-[0.2em] text-[#2997ff] uppercase mb-4">Proprietary Technology</h2>
                    <h3 class="text-4xl font-bold text-white mb-6">Meet MAI.</h3>
                    <p class="text-gray-300 text-lg leading-relaxed mb-8">
                        The MonarchI Artificial Intelligence (MAI) engine is the core of our predictive analytics and automation suite. Trained on diverse, real-world operational datasets, MAI is capable of ingesting massive telemetry streams, identifying anomalies in milliseconds, and executing automated workflows—often entirely on the edge without cloud dependency.
                    </p>
                    <a href="/services" class="inline-flex items-center gap-2 text-white font-medium hover:text-[#2997ff] transition">
                        Explore our AI capabilities
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>

                <div class="w-full md:w-1/2 h-[400px] md:h-auto relative">
                    <img src="{{ asset('images/ai.png') }}" class="absolute inset-0 w-full h-full object-cover mix-blend-screen opacity-60" alt="MAI Artificial Intelligence">
                    <div class="absolute inset-0 bg-gradient-to-r from-black via-transparent to-transparent"></div>
                </div>

            </div>
        </div>
    </section>

    {{-- =============================================
         CTA SECTION
    ============================================= --}}
    <section class="py-24 px-6 border-t relative overflow-hidden" style="border-color: var(--border-color); background: var(--bg-primary);">
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] rounded-full opacity-10 blur-[100px]" style="background: radial-gradient(circle, #2997ff, transparent 60%);"></div>
        </div>
        
        <div class="max-w-[800px] mx-auto text-center relative z-10 reveal">
            <h2 class="text-4xl md:text-5xl font-bold tracking-tight mb-6" style="color: var(--text-primary);">Want to join the revolution?</h2>
            <p class="text-xl mb-10 font-light" style="color: var(--text-secondary);">Whether you want to build with us or work for us, we are always looking for the next great partnership.</p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="/contact" class="px-8 py-4 rounded-full bg-[#2997ff] text-white font-medium hover:bg-blue-600 transition shadow-lg shadow-blue-500/30">Partner With Us</a>
                <a href="/careers" class="px-8 py-4 rounded-full border border-gray-600 font-medium hover:bg-white/5 transition" style="color: var(--text-primary);">View Careers</a>
            </div>
        </div>
    </section>

</x-main-layout>