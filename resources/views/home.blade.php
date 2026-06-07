<x-main-layout>

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

                        <stop offset="0%" stop-color="#ffffff" stop-opacity="1" />

                        <stop offset="45%" stop-color="#ffffff" stop-opacity="0.85" />

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



        <div class="absolute right-4 md:right-12 bottom-4 md:bottom-[55px] z-20 w-[calc(100%-2rem)] md:w-auto">

            <div class="flex flex-col md:flex-row md:items-end justify-end gap-2 md:gap-4 w-full">



                <div class="liquid-card p-4 md:p-6 w-full md:w-7/12 lg:w-[50rem] lg:h-full lg:p-10 flex flex-col justify-between group">

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



                <div class="grid grid-cols-2 gap-2 md:gap-4 w-full md:w-auto h-fit">

                    <div
                        class="liquid-card drop-shadow-[0_10px_20px_rgba(0,0,0,0.8)] py-2 px-2 md:py-4 md:px-4 w-full md:w-36 lg:w-40 h-fit flex flex-col justify-center items-center text-center">

                        <h4 class="text-xl md:text-2xl lg:text-3xl font-light text-white"><span class="stat-counter"
                                data-target="55">0</span>+</h4>

                        <span
                            class="text-[8px] md:text-[9px] text-gray-400 uppercase tracking-widest leading-tight mt-1 md:mt-2">Satisfied<br>Clients</span>

                    </div>

                    <div
                        class="liquid-card drop-shadow-[0_10px_20px_rgba(0,0,0,0.8)] py-2 px-2 md:py-4 md:px-4 w-full md:w-36 lg:w-40 h-fit flex flex-col justify-center items-center text-center">

                        <h4 class="text-xl md:text-2xl lg:text-3xl font-light text-white"><span class="stat-counter"
                                data-target="80">0</span>+</h4>

                        <span
                            class="text-[8px] md:text-[9px] text-gray-400 uppercase tracking-widest leading-tight mt-1 md:mt-2">Completed<br>Projects</span>

                    </div>

                    <div
                        class="liquid-card drop-shadow-[0_10px_20px_rgba(0,0,0,0.8)] py-2 px-2 md:py-4 md:px-4 w-full md:w-36 lg:w-40 h-fit flex flex-col justify-center items-center text-center">

                        <h4 class="text-xl md:text-2xl lg:text-3xl font-light text-white"><span class="stat-counter"
                                data-target="15">0</span>+</h4>

                        <span
                            class="text-[8px] md:text-[9px] text-gray-400 uppercase tracking-widest leading-tight mt-1 md:mt-2">Awards<br>Won</span>

                    </div>

                    <div
                        class="liquid-card drop-shadow-[0_10px_20px_rgba(0,0,0,0.8)] py-2 px-2 md:py-4 md:px-4 w-full md:w-36 lg:w-40 h-fit flex flex-col justify-center items-center text-center">

                        <h4 class="text-xl md:text-2xl lg:text-3xl font-light text-white"><span class="stat-counter"
                                data-target="99">0</span>%</h4>

                        <span
                            class="text-[8px] md:text-[9px] text-gray-400 uppercase tracking-widest leading-tight mt-1 md:mt-2">System<br>Uptime</span>

                    </div>

                </div>

            </div>

        </div>
    </section>

    <section class="relative max-w-[1200px] mx-auto px-4 py-8 z-10 border-t border-white/10 border-b">
        <div class="text-center mb-16 reveal">
            <h2 class="text-xs font-bold tracking-[0.2em] text-[#2997ff] uppercase mb-3">Our Services</h2>
            <h3 class="text-4xl md:text-5xl font-semibold tracking-tight text-white mb-6">
                Intelligent Systems, <br> <span class="text-gray-500">Intelligent Data.</span>
            </h3>
            <p class="text-xl text-gray-400 mt-4 font-medium">MonarchI provides enterprise-grade systems and Services that automates workflows and unlock predictive insights.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div class="relative h-[500px] md:h-[650px] rounded-3xl overflow-hidden group reveal delay-100 bg-[#111]">
                <img src="https://images.unsplash.com/photo-1550751827-4bd374c3f58b?q=80&w=1000&auto=format&fit=crop"
                    class="absolute inset-0 w-full h-full object-cover opacity-50 group-hover:scale-105 transition duration-1000">
                <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-black/40"></div>
                <div class="absolute top-10 w-full text-left px-6 z-10">
                    <h4 class="text-3xl font-semibold text-white mb-2">SaaS</h4>
                    <p class="text-lg text-gray-300 font-normal">Proprietary software solutions for business workflow automation powered by MAI.</p>
                    <a href="#" class="inline-block mt-3 text-[#edf0f1] hover:bg-blue-400 text-sm rounded-full border border-none bg-blue-500 p-2 font-medium">Learn more ></a>
                </div>
            </div>

            <div class="relative h-[500px] md:h-[650px] rounded-3xl overflow-hidden group reveal delay-200 bg-[#111]">
                <img src="https://images.unsplash.com/photo-1677442136019-21780ecad995?q=80&w=1000&auto=format&fit=crop"
                    class="absolute inset-0 w-full h-full object-cover opacity-50 group-hover:scale-105 transition duration-1000">
                <div class="absolute inset-0 bg-gradient-to-b from-black via-transparent to-black/60"></div>
                <div class="absolute bottom-10 w-full text-left px-6 z-10">
                    <h4 class="text-3xl font-semibold text-white mb-2">Workflow Automation</h4>
                    <p class="text-lg text-gray-300 font-normal">Automation of business processes with our in-house AI model - MAI.</p>
                    <a href="#" class="inline-block mt-3 text-[#edf0f1] hover:bg-blue-400 text-sm rounded-full border border-none bg-blue-500 p-2 font-medium">Learn more ></a>
                </div>
            </div>

            <div class="relative h-[500px] md:h-[650px] rounded-3xl overflow-hidden group reveal delay-100 bg-[#111]">
                <img src="https://images.unsplash.com/photo-1451187580459-43490279c0fa?q=80&w=1000&auto=format&fit=crop"
                    class="absolute inset-0 w-full h-full object-cover opacity-50 group-hover:scale-105 transition duration-1000">
                <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-black/40"></div>
                <div class="absolute top-10 w-full text-left px-6 z-10">
                    <h4 class="text-3xl font-semibold text-white mb-2">Software Development</h4>
                    <p class="text-lg text-gray-300 font-normal">We build and deploy custom software for mobile and desktop per business needs.</p>
                    <a href="#" class="inline-block mt-3 text-[#edf0f1] hover:bg-blue-400 text-sm rounded-full border border-none bg-blue-500 p-2 font-medium">Learn more ></a>
                </div>
            </div>

            <div class="relative h-[500px] md:h-[650px] rounded-3xl overflow-hidden group reveal delay-200 bg-[#111]">
                <img src="https://images.unsplash.com/photo-1518770660439-4636190af475?q=80&w=1000&auto=format&fit=crop"
                    class="absolute inset-0 w-full h-full object-cover opacity-40 group-hover:scale-105 transition duration-1000 filter grayscale">
                <div class="absolute inset-0 bg-gradient-to-b from-black via-transparent to-black/60"></div>
                <div class="absolute bottom-10 w-full text-left px-6 z-10">
                    <h4 class="text-3xl font-semibold text-white mb-2">Edge Intelligence</h4>
                    <p class="text-lg text-gray-300 font-normal">Zero-latency, offline decision making.</p>
                    <a href="#" class="inline-block mt-3 text-[#edf0f1] hover:bg-blue-400 text-sm rounded-full border border-none bg-blue-500 p-2 font-medium">Learn more ></a>
                </div>
            </div>
        </div>
    </section>

    <section class="relative max-w-[1200px] mx-auto  overflow-hidden  z-10 my-8">
        <img src="https://images.unsplash.com/photo-1639322537228-f710d846310a?q=80&w=2000&auto=format&fit=crop"
            class="absolute inset-0 w-full h-full object-cover opacity-20 filter blur-sm">
        <div class="absolute inset-0 bg-black/80"></div>

        <div class="relative px-6 flex flex-col md:flex-row items-center gap-16">

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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        Get analysis from your business's data in real-time.
                    </li>
                    <li class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-[#2997ff]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        Generate tailored email for clients and stakeholders.
                    </li>
                    <li class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-[#2997ff]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        Get intelligent advice tailored to you.
                    </li>
                    <li class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-[#2997ff]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        Automate repetitive business tasks effortlessly.
                    </li>
                    <li class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-[#2997ff]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
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
                            <div class="glass px-4 py-2 rounded-lg rounded-tl-none text-gray-200 border-none">Compare this quarters revenue to last years revenue and make a forecast based on current market conditions.</div>
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
                                <span class="text-[10px] text-[#2997ff] font-mono">✔ Draft generated in 1.2s</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="relative bg-black py-24 px-6 overflow-hidden border-t border-white/5 z-0">

        <div id="random-cards-container" class="absolute inset-0 overflow-hidden pointer-events-none z-0">
            @for ($i = 0; $i < 20; $i++) <div
                class="glass-card absolute rounded-2xl transition-all duration-1000 ease-out z-0">
        </div>
        @endfor
        </div>

        <div class="relative max-w-7xl mx-auto text-center z-10 reveal">
            <h2 class="text-xs font-bold tracking-[0.2em] text-[#2997ff] uppercase mb-3">Start Today</h2>
            <h3 class="text-4xl md:text-6xl font-extrabold tracking-tight text-white mb-8">Ready to unleash <br>
                intelligent efficiency?</h3>
            <p class="text-lg text-gray-400 font-light leading-relaxed max-w-3xl mx-auto mb-12">
                Connect your existing workflow and experience the Monarch Intelligence advantage. Automate processes,
                unlock predictive insights, and stay ahead with enterprise-grade AI designed for your success.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('register') }}"
                    class="inline-block bg-[#2997ff] hover:bg-[#1a7de3] text-white font-bold py-4 px-10 rounded-full transition transform hover:scale-105 text-lg">
                    Get Started
                </a>
                <a href="#demo"
                    class="inline-block glass px-10 py-4 rounded-full text-white font-medium hover:bg-white/10 transition text-lg">
                    Watch Demo
                </a>
            </div>
        </div>
    </section>

    <section class="overflow-hidden bg-black mt-12">
        <div class="flex gap-6 overflow-x-auto hide-scroll snap-inline px-6  w-full">
            <div
                class="snap-item shrink-0 w-[85vw] md:w-[65vw] h-[500px] md:h-[600px] relative rounded-3xl overflow-hidden group">
                <img src="https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?q=80&w=1500&auto=format&fit=crop"
                    class="absolute inset-0 w-full h-full object-cover opacity-60 transition duration-1000 group-hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-black via-black/20 to-transparent"></div>
                <div class="absolute bottom-10 left-10 z-10 max-w-lg">
                    <span class="text-xs font-bold tracking-[0.2em] text-[#2997ff] uppercase mb-2 block">FinTech
                        Sector</span>
                    <h3 class="text-3xl md:text-4xl font-semibold text-white mb-4">Project Nexus</h3>
                    <p class="text-gray-300 mb-6 font-light">Automated fraud detection system scaling to 10M+ daily
                        transactions.</p>
                    <button
                        class="bg-white text-black px-6 py-2 rounded-full font-medium hover:bg-gray-200 transition">Read
                        Case Study</button>
                </div>
            </div>

            <div
                class="snap-item shrink-0 w-[85vw] md:w-[65vw] h-[500px] md:h-[600px] relative rounded-3xl overflow-hidden group">
                <img src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?q=80&w=1500&auto=format&fit=crop"
                    class="absolute inset-0 w-full h-full object-cover opacity-60 transition duration-1000 group-hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-black via-black/20 to-transparent"></div>
                <div class="absolute bottom-10 left-10 z-10 max-w-lg">
                    <span
                        class="text-xs font-bold tracking-[0.2em] text-[#2997ff] uppercase mb-2 block">Healthcare</span>
                    <h3 class="text-3xl md:text-4xl font-semibold text-white mb-4">Lumina Health</h3>
                    <p class="text-gray-300 mb-6 font-light">Predictive patient diagnostics utilizing advanced computer
                        vision models.</p>
                    <button
                        class="bg-white text-black px-6 py-2 rounded-full font-medium hover:bg-gray-200 transition">Read
                        Case Study</button>
                </div>
            </div>
        </div>
    </section>
    <div class="flex gap-6 overflow-x-auto hide-scroll snap-inline px-6 pb-12 w-full">
        <div class="snap-item shrink-0 w-[85vw] md:w-[400px] liquid-card p-8 relative flex flex-col justify-between">
            <div>
                <div class="flex text-[#2997ff] mb-4">★★★★★</div>
                <p class="text-lg text-white font-light leading-relaxed">"Monarch completely overhauled our data
                    pipeline. The predictive models are eerie in their accuracy."</p>
            </div>
            <div class="mt-8 flex items-center gap-4">
                <img src="https://ui-avatars.com/api/?name=Sarah+L&background=fff&color=000"
                    class="w-10 h-10 rounded-full">
                <div>
                    <h5 class="text-white font-medium text-sm">Sarah L.</h5>
                    <span class="text-gray-400 text-xs">CTO, Nexus Corp</span>
                </div>
            </div>
        </div>

        <div class="snap-item shrink-0 w-[85vw] md:w-[400px] liquid-card p-8 relative flex flex-col justify-between">
            <div>
                <div class="flex text-[#2997ff] mb-4">★★★★★</div>
                <p class="text-lg text-white font-light leading-relaxed">"The integration was seamless. The MAI
                    assistant has cut our customer response times by 40%."</p>
            </div>
            <div class="mt-8 flex items-center gap-4">
                <img src="https://ui-avatars.com/api/?name=James+W&background=fff&color=000"
                    class="w-10 h-10 rounded-full">
                <div>
                    <h5 class="text-white font-medium text-sm">James W.</h5>
                    <span class="text-gray-400 text-xs">Director of Operations</span>
                </div>
            </div>
        </div>

        <div class="snap-item shrink-0 w-[85vw] md:w-[400px] liquid-card p-8 relative flex flex-col justify-between">
            <div>
                <div class="flex text-[#2997ff] mb-4">★★★★★</div>
                <p class="text-lg text-white font-light leading-relaxed">"Unmatched processing speed. Monarch's Edge
                    Intelligence allowed us to deploy offline without latency."</p>
            </div>
            <div class="mt-8 flex items-center gap-4">
                <img src="https://ui-avatars.com/api/?name=Elena+R&background=fff&color=000"
                    class="w-10 h-10 rounded-full">
                <div>
                    <h5 class="text-white font-medium text-sm">Elena R.</h5>
                    <span class="text-gray-400 text-xs">Lead Data Scientist</span>
                </div>
            </div>
        </div>
    </div>
    </section>

</x-main-layout>