<x-main-layout>

    {{-- =============================================
         CONTACT HERO
    ============================================= --}}
    <section class="relative pt-32 pb-16 px-6 min-h-[40vh] flex items-center justify-center overflow-hidden" style="background: var(--bg-primary);">
        <div class="absolute top-0 right-0 w-full h-full overflow-hidden z-0 pointer-events-none">
            <div class="absolute top-[-30%] right-[-10%] w-[50%] h-[70%] rounded-full opacity-20 blur-[120px]" style="background: radial-gradient(circle, #2997ff, transparent 70%);"></div>
        </div>

        <div class="max-w-[800px] mx-auto text-center relative z-10 reveal">
            <h1 class="text-xs font-bold tracking-[0.25em] text-[#2997ff] uppercase mb-6">Contact Us</h1>
            <h2 class="text-5xl md:text-7xl font-bold tracking-tight mb-6 leading-tight" style="color: var(--text-primary);">
                Let's start a <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#2997ff] to-[#8ebcf2]">conversation.</span>
            </h2>
            <p class="text-xl md:text-2xl max-w-2xl mx-auto font-light leading-relaxed" style="color: var(--text-secondary);">
                Whether you have a question about our enterprise systems, need a technical consultation, or want to explore a partnership, our team is ready to help.
            </p>
        </div>
    </section>

    {{-- =============================================
         CONTACT SECTION (Form & Details)
    ============================================= --}}
    <section class="py-20 px-6 z-10 relative" style="background: var(--bg-section);">
        <div class="max-w-[1200px] mx-auto flex flex-col lg:flex-row gap-16 reveal delay-100">
            
            {{-- Left Side: Contact Information --}}
            <div class="w-full lg:w-5/12">
                <h3 class="text-3xl font-semibold mb-8" style="color: var(--text-primary);">Get in Touch</h3>
                
                <div class="space-y-8">
                    <!-- Headquarters -->
                    <div class="flex items-start gap-4 group">
                        <div class="w-12 h-12 rounded-2xl bg-[#2997ff]/10 text-[#2997ff] flex flex-shrink-0 items-center justify-center transition-transform group-hover:scale-110">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <div>
                            <h4 class="text-lg font-medium mb-1" style="color: var(--text-primary);">Headquarters</h4>
                            <p class="text-sm leading-relaxed" style="color: var(--text-secondary);">MonarchI HQ<br>Accra, Ghana<br>West Africa</p>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="flex items-start gap-4 group">
                        <div class="w-12 h-12 rounded-2xl bg-[#2997ff]/10 text-[#2997ff] flex flex-shrink-0 items-center justify-center transition-transform group-hover:scale-110">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <div>
                            <h4 class="text-lg font-medium mb-1" style="color: var(--text-primary);">Email Us</h4>
                            <p class="text-sm leading-relaxed" style="color: var(--text-secondary);">
                                General: hello@monarchi.com<br>
                                Support: support@monarchi.com
                            </p>
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="flex items-start gap-4 group">
                        <div class="w-12 h-12 rounded-2xl bg-[#2997ff]/10 text-[#2997ff] flex flex-shrink-0 items-center justify-center transition-transform group-hover:scale-110">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        </div>
                        <div>
                            <h4 class="text-lg font-medium mb-1" style="color: var(--text-primary);">Call Us</h4>
                            <p class="text-sm leading-relaxed" style="color: var(--text-secondary);">
                                +233 (0) 55 123 4567<br>
                                Mon-Fri, 9am - 6pm (GMT)
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Google Map Location -->
                <div class="mt-12 rounded-3xl overflow-hidden h-[240px] relative border shadow-sm group" style="border-color: var(--border-color); background: var(--bg-card);">
                    <iframe
                        src="https://maps.google.com/maps?q=Accra%2C%20Ghana&t=&z=13&ie=UTF8&iwloc=&output=embed"
                        class="w-full h-full border-0"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        title="MonarchI HQ Location Map"
                    ></iframe>
                    <a
                        href="https://maps.google.com/?q=Accra,+Ghana"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="absolute bottom-3 right-3 px-3 py-1.5 rounded-xl text-xs font-semibold backdrop-blur-md bg-black/75 text-white border border-white/15 hover:bg-[#2997ff] hover:border-[#2997ff] transition-all flex items-center gap-1.5 shadow-md"
                    >
                        <span>Open in Maps</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                    </a>
                </div>
            </div>

            {{-- Right Side: Form --}}
            <div class="w-full lg:w-7/12">
                <div class="p-8 md:p-12 rounded-3xl" style="background: var(--bg-card); border: 1px solid var(--border-color); box-shadow: 0 20px 40px rgba(0,0,0,0.1);">
                    <h3 class="text-2xl font-semibold mb-6" style="color: var(--text-primary);">Send a Message</h3>

                    {{-- Success flash --}}
                    @if(session('success'))
                    <div class="mb-6 px-5 py-4 rounded-xl text-sm font-medium" style="background: rgba(34,197,94,0.1); border: 1px solid rgba(34,197,94,0.25); color: #4ade80;">
                        ✓ {{ session('success') }}
                    </div>
                    @endif

                    @if($errors->any())
                    <div class="mb-6 px-5 py-4 rounded-xl text-sm" style="background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.25); color: #f87171;">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="contact_name" class="block text-sm font-medium mb-2" style="color: var(--text-secondary);">Full Name</label>
                                <input type="text" id="contact_name" name="name" value="{{ old('name') }}" class="w-full px-4 py-3 rounded-xl border focus:ring-2 focus:ring-[#2997ff] outline-none transition" style="background: var(--bg-primary); border-color: var(--border-color); color: var(--text-primary);" placeholder="Jane Doe" required>
                            </div>
                            <div>
                                <label for="contact_email" class="block text-sm font-medium mb-2" style="color: var(--text-secondary);">Work Email</label>
                                <input type="email" id="contact_email" name="email" value="{{ old('email') }}" class="w-full px-4 py-3 rounded-xl border focus:ring-2 focus:ring-[#2997ff] outline-none transition" style="background: var(--bg-primary); border-color: var(--border-color); color: var(--text-primary);" placeholder="jane@company.com" required>
                            </div>
                        </div>

                        <div>
                            <label for="contact_subject" class="block text-sm font-medium mb-2" style="color: var(--text-secondary);">Subject</label>
                            <select id="contact_subject" name="subject" class="w-full px-4 py-3 rounded-xl border focus:ring-2 focus:ring-[#2997ff] outline-none transition appearance-none" style="background: var(--bg-primary); border-color: var(--border-color); color: var(--text-primary);">
                                <option value="" {{ old('subject') ? '' : 'selected' }} disabled>Select an inquiry type</option>
                                <option value="Enterprise Systems &amp; SaaS" {{ old('subject')==='Enterprise Systems &amp; SaaS'?'selected':'' }}>Enterprise Systems &amp; SaaS</option>
                                <option value="AI &amp; Edge Intelligence" {{ old('subject')==='AI &amp; Edge Intelligence'?'selected':'' }}>AI &amp; Edge Intelligence</option>
                                <option value="Technical Support" {{ old('subject')==='Technical Support'?'selected':'' }}>Technical Support</option>
                                <option value="Partnership Opportunity" {{ old('subject')==='Partnership Opportunity'?'selected':'' }}>Partnership Opportunity</option>
                                <option value="Other" {{ old('subject')==='Other'?'selected':'' }}>Other</option>
                            </select>
                        </div>

                        <div>
                            <label for="contact_message" class="block text-sm font-medium mb-2" style="color: var(--text-secondary);">Message</label>
                            <textarea id="contact_message" name="message" rows="5" class="w-full px-4 py-3 rounded-xl border focus:ring-2 focus:ring-[#2997ff] outline-none transition resize-none" style="background: var(--bg-primary); border-color: var(--border-color); color: var(--text-primary);" placeholder="Tell us about your project..." required>{{ old('message') }}</textarea>
                        </div>

                        <button type="submit" class="w-full py-4 rounded-xl bg-[#2997ff] text-white font-medium hover:bg-blue-600 transition shadow-lg shadow-blue-500/30 flex items-center justify-center gap-2">
                            Send Message
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    {{-- =============================================
         FAQ SECTION
    ============================================= --}}
    <section class="py-24 px-6 border-t" style="border-color: var(--border-color); background: var(--bg-primary);">
        <div class="max-w-[800px] mx-auto reveal">
            <div class="text-center mb-16">
                <h2 class="text-xs font-bold tracking-[0.2em] text-[#2997ff] uppercase mb-3">FAQ</h2>
                <h3 class="text-3xl md:text-4xl font-semibold tracking-tight" style="color: var(--text-primary);">
                    Frequently Asked Questions
                </h3>
            </div>

            <div class="space-y-4">
                <!-- FAQ Item 1 -->
                <div class="p-6 rounded-2xl" style="background: var(--bg-card); border: 1px solid var(--border-color);">
                    <h4 class="text-lg font-semibold mb-2" style="color: var(--text-primary);">Where are your services available?</h4>
                    <p class="text-sm leading-relaxed" style="color: var(--text-secondary);">While we are headquartered in Accra, Ghana, our enterprise SaaS and software solutions are deployed globally. We serve clients across West and East Africa, and our integrated systems meet global industry standards.</p>
                </div>

                <!-- FAQ Item 2 -->
                <div class="p-6 rounded-2xl" style="background: var(--bg-card); border: 1px solid var(--border-color);">
                    <h4 class="text-lg font-semibold mb-2" style="color: var(--text-primary);">Do you offer technical support for deployed systems?</h4>
                    <p class="text-sm leading-relaxed" style="color: var(--text-secondary);">Yes, we provide ongoing maintenance, telemetry monitoring, and technical support for all our custom software and integrated hardware deployments.</p>
                </div>

                <!-- FAQ Item 3 -->
                <div class="p-6 rounded-2xl" style="background: var(--bg-card); border: 1px solid var(--border-color);">
                    <h4 class="text-lg font-semibold mb-2" style="color: var(--text-primary);">How long does it take to deploy an AI workflow?</h4>
                    <p class="text-sm leading-relaxed" style="color: var(--text-secondary);">Project timelines vary based on complexity. However, by utilizing our in-house MAI model, we significantly reduce development cycles, often deploying intelligent workflow automations within 6 to 12 weeks.</p>
                </div>
            </div>
        </div>
    </section>

</x-main-layout>