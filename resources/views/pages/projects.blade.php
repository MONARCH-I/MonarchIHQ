<x-main-layout>

    {{-- =============================================
         PROJECTS HERO
    ============================================= --}}
    <section class="relative pt-32 pb-20 px-6 min-h-[55vh] flex items-center justify-center overflow-hidden" style="background: var(--bg-primary);">
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0 pointer-events-none">
            <div class="absolute top-[-20%] left-[-10%] w-[60%] h-[80%] rounded-full opacity-20 blur-[120px]" style="background: radial-gradient(circle, #2997ff, transparent 70%);"></div>
            <div class="absolute bottom-[-20%] right-[-10%] w-[50%] h-[60%] rounded-full opacity-10 blur-[100px]" style="background: radial-gradient(circle, #2997ff, transparent 70%);"></div>
        </div>

        <div class="max-w-[1000px] mx-auto text-center relative z-10 reveal">
            <h1 class="text-xs font-bold tracking-[0.25em] text-[#2997ff] uppercase mb-6">Our Portfolio</h1>
            <h2 class="text-5xl md:text-7xl font-bold tracking-tight mb-8 leading-tight" style="color: var(--text-primary);">
                Selected <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#2997ff] to-[#8ebcf2]">Engineering</span> <br>
                &amp; Innovation Works.
            </h2>
            <p class="text-xl md:text-2xl max-w-2xl mx-auto font-light leading-relaxed" style="color: var(--text-secondary);">
                Explore our custom enterprise deployments, edge AI models, telemetry networks, and mission-critical cloud infrastructure.
            </p>
        </div>
    </section>

    {{-- =============================================
         PROJECTS SHOWCASE GRID
    ============================================= --}}
    <section class="py-20 px-6 z-10 relative border-t" style="border-color: var(--border-color); background: var(--bg-section);">
        <div class="max-w-[1200px] mx-auto">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-10">

                {{-- Project 1 --}}
                <div class="rounded-3xl p-8 border transition duration-300 hover:shadow-2xl flex flex-col justify-between group"
                     style="background: var(--bg-card); border-color: var(--border-color);">
                    <div>
                        <div class="flex items-center justify-between mb-6">
                            <span class="text-xs font-bold uppercase tracking-widest text-[#2997ff]">Enterprise AI &middot; Healthcare</span>
                            <span class="px-3 py-1 text-[11px] font-semibold rounded-full bg-blue-500/10 text-[#2997ff] border border-blue-500/20">Deployed</span>
                        </div>
                        <h3 class="text-2xl md:text-3xl font-bold mb-4 group-hover:text-[#2997ff] transition" style="color: var(--text-primary);">
                            MAI Health Intelligence Engine
                        </h3>
                        <p class="text-sm leading-relaxed mb-6" style="color: var(--text-secondary);">
                            AI-powered clinical telemetry and workflow automation designed for healthcare providers, surfacing patient trends, reducing paperwork latency by 78%, and flagging anomalies in real-time.
                        </p>
                        <div class="flex flex-wrap gap-2 mb-8">
                            <span class="text-xs font-mono px-2.5 py-1 rounded-lg border" style="background: var(--bg-primary); border-color: var(--border-color); color: var(--text-muted);">Neural Edge Models</span>
                            <span class="text-xs font-mono px-2.5 py-1 rounded-lg border" style="background: var(--bg-primary); border-color: var(--border-color); color: var(--text-muted);">Laravel 12</span>
                            <span class="text-xs font-mono px-2.5 py-1 rounded-lg border" style="background: var(--bg-primary); border-color: var(--border-color); color: var(--text-muted);">WebSockets</span>
                            <span class="text-xs font-mono px-2.5 py-1 rounded-lg border" style="background: var(--bg-primary); border-color: var(--border-color); color: var(--text-muted);">HL7/FHIR</span>
                        </div>
                    </div>
                    <div class="pt-4 border-t flex items-center justify-between" style="border-color: var(--border-color);">
                        <span class="text-xs font-medium" style="color: var(--text-muted);">Deployment: Multi-facility</span>
                        <a href="{{ url('/contact') }}" class="text-xs font-bold text-[#2997ff] hover:underline flex items-center gap-1">
                            Request Case Study &rarr;
                        </a>
                    </div>
                </div>

                {{-- Project 2 --}}
                <div class="rounded-3xl p-8 border transition duration-300 hover:shadow-2xl flex flex-col justify-between group"
                     style="background: var(--bg-card); border-color: var(--border-color);">
                    <div>
                        <div class="flex items-center justify-between mb-6">
                            <span class="text-xs font-bold uppercase tracking-widest text-[#2997ff]">Fintech &middot; Infrastructure</span>
                            <span class="px-3 py-1 text-[11px] font-semibold rounded-full bg-green-500/10 text-green-500 border border-green-500/20">High Availability</span>
                        </div>
                        <h3 class="text-2xl md:text-3xl font-bold mb-4 group-hover:text-[#2997ff] transition" style="color: var(--text-primary);">
                            National Payment Gateway Telemetry
                        </h3>
                        <p class="text-sm leading-relaxed mb-6" style="color: var(--text-secondary);">
                            High-throughput transaction auditing and latency observability platform processing millions in daily volume across mobile money networks and commercial banks with 99.999% uptime.
                        </p>
                        <div class="flex flex-wrap gap-2 mb-8">
                            <span class="text-xs font-mono px-2.5 py-1 rounded-lg border" style="background: var(--bg-primary); border-color: var(--border-color); color: var(--text-muted);">Paystack / Mobile Money</span>
                            <span class="text-xs font-mono px-2.5 py-1 rounded-lg border" style="background: var(--bg-primary); border-color: var(--border-color); color: var(--text-muted);">ISO 8583</span>
                            <span class="text-xs font-mono px-2.5 py-1 rounded-lg border" style="background: var(--bg-primary); border-color: var(--border-color); color: var(--text-muted);">Event-Driven Redis</span>
                        </div>
                    </div>
                    <div class="pt-4 border-t flex items-center justify-between" style="border-color: var(--border-color);">
                        <span class="text-xs font-medium" style="color: var(--text-muted);">Scale: 10M+ daily events</span>
                        <a href="{{ url('/contact') }}" class="text-xs font-bold text-[#2997ff] hover:underline flex items-center gap-1">
                            Request Case Study &rarr;
                        </a>
                    </div>
                </div>

                {{-- Project 3 --}}
                <div class="rounded-3xl p-8 border transition duration-300 hover:shadow-2xl flex flex-col justify-between group"
                     style="background: var(--bg-card); border-color: var(--border-color);">
                    <div>
                        <div class="flex items-center justify-between mb-6">
                            <span class="text-xs font-bold uppercase tracking-widest text-[#2997ff]">Hardware &middot; Edge IoT</span>
                            <span class="px-3 py-1 text-[11px] font-semibold rounded-full bg-amber-500/10 text-amber-500 border border-amber-500/20">Active IoT</span>
                        </div>
                        <h3 class="text-2xl md:text-3xl font-bold mb-4 group-hover:text-[#2997ff] transition" style="color: var(--text-primary);">
                            AgriSense Microclimate Telemetry
                        </h3>
                        <p class="text-sm leading-relaxed mb-6" style="color: var(--text-secondary);">
                            Custom-engineered solar-powered sensor nodes deployed in remote agricultural zones to monitor soil nitrogen, canopy humidity, and evapotranspiration with offline mesh connectivity.
                        </p>
                        <div class="flex flex-wrap gap-2 mb-8">
                            <span class="text-xs font-mono px-2.5 py-1 rounded-lg border" style="background: var(--bg-primary); border-color: var(--border-color); color: var(--text-muted);">LoRaWAN Mesh</span>
                            <span class="text-xs font-mono px-2.5 py-1 rounded-lg border" style="background: var(--bg-primary); border-color: var(--border-color); color: var(--text-muted);">C++ Firmware</span>
                            <span class="text-xs font-mono px-2.5 py-1 rounded-lg border" style="background: var(--bg-primary); border-color: var(--border-color); color: var(--text-muted);">Solar Harvest</span>
                        </div>
                    </div>
                    <div class="pt-4 border-t flex items-center justify-between" style="border-color: var(--border-color);">
                        <span class="text-xs font-medium" style="color: var(--text-muted);">Coverage: 400+ km²</span>
                        <a href="{{ url('/contact') }}" class="text-xs font-bold text-[#2997ff] hover:underline flex items-center gap-1">
                            Request Case Study &rarr;
                        </a>
                    </div>
                </div>

                {{-- Project 4 --}}
                <div class="rounded-3xl p-8 border transition duration-300 hover:shadow-2xl flex flex-col justify-between group"
                     style="background: var(--bg-card); border-color: var(--border-color);">
                    <div>
                        <div class="flex items-center justify-between mb-6">
                            <span class="text-xs font-bold uppercase tracking-widest text-[#2997ff]">SaaS &middot; Logistics</span>
                            <span class="px-3 py-1 text-[11px] font-semibold rounded-full bg-blue-500/10 text-[#2997ff] border border-blue-500/20">Production</span>
                        </div>
                        <h3 class="text-2xl md:text-3xl font-bold mb-4 group-hover:text-[#2997ff] transition" style="color: var(--text-primary);">
                            SwiftLog Autonomous Dispatch Engine
                        </h3>
                        <p class="text-sm leading-relaxed mb-6" style="color: var(--text-secondary);">
                            Enterprise logistics dispatch system with algorithmic route clustering, driver mobile telemetry, and dynamic multi-depot parcel distribution across West Africa.
                        </p>
                        <div class="flex flex-wrap gap-2 mb-8">
                            <span class="text-xs font-mono px-2.5 py-1 rounded-lg border" style="background: var(--bg-primary); border-color: var(--border-color); color: var(--text-muted);">Graph Routing Alg</span>
                            <span class="text-xs font-mono px-2.5 py-1 rounded-lg border" style="background: var(--bg-primary); border-color: var(--border-color); color: var(--text-muted);">Live Geo-fencing</span>
                            <span class="text-xs font-mono px-2.5 py-1 rounded-lg border" style="background: var(--bg-primary); border-color: var(--border-color); color: var(--text-muted);">API Gateway</span>
                        </div>
                    </div>
                    <div class="pt-4 border-t flex items-center justify-between" style="border-color: var(--border-color);">
                        <span class="text-xs font-medium" style="color: var(--text-muted);">Efficiency: +34% throughput</span>
                        <a href="{{ url('/contact') }}" class="text-xs font-bold text-[#2997ff] hover:underline flex items-center gap-1">
                            Request Case Study &rarr;
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </section>

    {{-- =============================================
         CTA
    ============================================= --}}
    <section class="py-24 px-6 text-center border-t relative overflow-hidden" style="background: var(--bg-primary); border-color: var(--border-color);">
        <div class="max-w-[700px] mx-auto relative z-10">
            <h2 class="text-3xl md:text-5xl font-bold mb-6" style="color: var(--text-primary);">
                Have a Mission-Critical Project?
            </h2>
            <p class="text-base md:text-lg mb-8 leading-relaxed" style="color: var(--text-secondary);">
                Partner with our engineering team to design, build, and deploy high-performance software and connected hardware.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ url('/contact') }}" class="w-full sm:w-auto px-8 py-4 bg-[#2997ff] text-white rounded-full text-sm font-bold hover:bg-[#1a7de3] transition shadow-lg hover:shadow-xl hover:-translate-y-0.5 transform">
                    Schedule Engineering Consult &rarr;
                </a>
                <a href="{{ route('store.index') }}" class="w-full sm:w-auto px-8 py-4 rounded-full text-sm font-bold border hover:bg-black/5 dark:hover:bg-white/5 transition" style="border-color: var(--border-color); color: var(--text-primary);">
                    Explore Our Store
                </a>
            </div>
        </div>
    </section>

</x-main-layout>