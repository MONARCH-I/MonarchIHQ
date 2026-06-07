<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MonarchI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Hide scrollbars on html elements and page */
        html {
            scrollbar-width: none; /* Firefox */
            -ms-overflow-style: none; /* IE and Edge */
        }

        html::-webkit-scrollbar {
            display: none; /* Chrome, Safari, Opera */
        }

        body {
            background-color: #000;
            color: white;
            overflow-x: hidden;
            height: 200vh;
        }

        /* Hide scrollbars on elements with hide-scroll class */
        .hide-scroll {
            scrollbar-width: none; /* Firefox */
            -ms-overflow-style: none; /* IE and Edge */
        }

        .hide-scroll::-webkit-scrollbar {
            display: none; /* Chrome, Safari, Opera */
        }

        .glass {
            background: rgba(20, 20, 20, 0.2);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Ultra-Premium Liquid Glass Effect for Cards */
        .liquid-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0.01) 100%);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-top: 1px solid rgba(255, 255, 255, 0.3);
            border-left: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.5), inset 0 0 15px rgba(255, 255, 255, 0.05);
            border-radius: 1.25rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .liquid-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.6), inset 0 0 20px rgba(255, 255, 255, 0.1);
        }

        /* Liquid Glass specifically for the secondary button */
        .liquid-btn {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: inset 0 0 10px rgba(255, 255, 255, 0.05);
        }

        .nav-link {
            transition: opacity 0.3s ease;
            cursor: pointer;
        }

        .nav-link:hover {
            opacity: 0.7;
        }

        /* Scroll Animation Classes */
        .reveal {
            opacity: 0;
            transform: translateY(40px);
            transition: all 0.8s cubic-bezier(0.5, 0, 0, 1);
        }

        .reveal-left {
            opacity: 0;
            transform: translateX(-40px);
            transition: all 0.8s cubic-bezier(0.5, 0, 0, 1);
        }

        .reveal-right {
            opacity: 0;
            transform: translateX(40px);
            transition: all 0.8s cubic-bezier(0.5, 0, 0, 1);
        }

        .reveal.active,
        .reveal-left.active,
        .reveal-right.active {
            opacity: 1;
            transform: translate(0, 0);
        }

        /* Staggered delays for grids */
        .delay-100 {
            transition-delay: 100ms;
        }

        .delay-200 {
            transition-delay: 200ms;
        }

        .delay-300 {
            transition-delay: 300ms;
        }

        /* Define a gentle floating animation */
        @keyframes float {

            0%,
            100% {
                transform: translateY(0) rotate(var(--base-rotation));
            }

            50% {
                transform: translateY(-20px) rotate(calc(var(--base-rotation) + 5deg));
            }
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.08);
            /* Increased visibility */
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.281);
            /* More defined border */
            animation: float 10s ease-in-out infinite;
            /* Infinite floating */
            /* We use a CSS variable for rotation so the animation doesn't reset it */
            --base-rotation: 0deg;
        }
    </style>
</head>

<body>
    <header class="glass fixed top-0 w-full z-50">
        <div class="max-w-[1024px] mx-auto h-12 flex items-center justify-between px-4 md:px-0">
            <button id="menu-toggle" class="flex flex-col space-y-1 p-2">
                <span class="block w-4 h-0.5 bg-gray-200"></span>
                <span class="block w-4 h-0.5 bg-gray-200"></span>
                <span class="block w-4 h-0.5 bg-gray-200"></span>
            </button>

            <div id="menu" class="fixed top-12 left-0 w-full bg-black/100 hidden z-40">
                <div class="max-w-[1024px] mx-auto px-4 md:px-0">
                    <ul
                        class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-8 text-center md:justify-center text-[12px] font-light text-gray-100 uppercase tracking-wider py-4">
                        <a href="/services">
                            <li class="nav-link">Services</li>
                        </a>
                        <a href="/projects">
                            <li class="nav-link">Projects</li>
                        </a>
                        <a href="/store">
                            <li class="nav-link">Store</li>
                        </a>
                        <a href="/contact">
                            <li class="nav-link">Contact Us</li>
                        </a>
                        <a href="/about">
                            <li class="nav-link">About</li>
                        </a>
                        <a href="/blog">
                            <li class="nav-link">Trending</li>
                        </a>
                        <a href="/careers">
                            <li class="nav-link">Careers</li>
                        </a>
                    </ul>
                </div>
            </div>

            <a href="/">
                <div class="logo font-bold tracking-[0.2em] text-sm nav-link">
                    M O N A R C H I
                </div>
            </a>

            <div class="right-section flex items-center space-x-6">
                <a href="/search">
                    <svg class="w-4 h-4 text-gray-300 nav-link" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </a>

                <a href="/cart">
                    <svg class="w-4 h-4 text-gray-300 nav-link" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </a>


                @auth
                <a href="{{ url('/dashboard') }}">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&color=7F9CF5&background=EBF4FF"
                        class="w-5 h-5 rounded-full nav-link" alt="account">
                </a>
                @else
                <a href="{{ route('login') }}">
                    <svg class="w-4 h-4 text-gray-300 nav-link" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </a>
                @endauth
            </div>
        </div>
    </header>
    <main>
        {{ $slot }}
    </main>
    <footer class="bg-black border-t border-white/10 pt-20 pb-10 px-6 z-10 relative">
        <div class="max-w-[1200px] mx-auto">
            <div class="md:col-span-2 flex flex-col items-center md:items-center mb-8">
                    <div class="logo font-bold tracking-[0.2em] text-sm mb-6 text-white">
                        M O N A R C H I
                    </div>
                    <p class="text-sm text-gray-400 font-light leading-relaxed max-w-xs mb-6">
                        Enterprise-grade AI models and bespoke machine learning solutions engineered for absolute scale.
                    </p>
                    <div class="flex space-x-5">
                        <a href="#" class="text-gray-500 hover:text-[#2997ff] transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path
                                    d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 22.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.008 5.925H5.022z" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-[#2997ff] transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-[#2997ff] transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>
            <div class="grid grid-cols-3 md:grid-cols-5 gap-10 mb-16 text-center md:text-center">
                
                {{-- COMPANY QUICKLINKS --}}
                <div>
                    <h4 class="text-white font-medium mb-4 text-sm">Company</h4>
                    <ul class="space-y-3 text-sm text-gray-400 font-light">
                        <li><a href="/about" class="hover:text-[#2997ff] transition-colors">About Us</a></li>
                        <li><a href="/blog" class="hover:text-[#2997ff] transition-colors">Blog</a></li>
                        <li><a href="/careers" class="hover:text-[#2997ff] transition-colors">Careers</a></li>
                        <li><a href="/contact" class="hover:text-[#2997ff] transition-colors">Contact</a></li>
                        <li><a href="#" class="hover:text-[#2997ff] transition-colors">Partners</a></li>
                    </ul>
                </div> 

                {{-- DIVISIONS QUICKLINKS --}}
                <div>
                    <h4 class="text-white font-medium mb-4 text-sm">Divisions</h4>
                    <ul class="space-y-3 text-sm text-gray-400 font-light">
                        <li><a href="#" class="hover:text-[#2997ff] transition-colors">Monarch I/O</a></li>
                        <li><a href="#" class="hover:text-[#2997ff] transition-colors">Monarch Inventions</a></li>
                        <li><a href="#" class="hover:text-[#2997ff] transition-colors">Monarch Innovations</a></li>
                        <li><a href="#" class="hover:text-[#2997ff] transition-colors">Monarch IoT</a></li>
                        <li><a href="#" class="hover:text-[#2997ff] transition-colors">Monarch IS</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-white font-medium mb-4 text-sm">Products</h4>
                    <ul class="space-y-3 text-sm text-gray-400 font-light">
                        <li><a href="#" class="hover:text-[#2997ff] transition-colors">MAI</a></li>
                        <li><a href="#" class="hover:text-[#2997ff] transition-colors">iLyft</a></li>
                        <li><a href="#" class="hover:text-[#2997ff] transition-colors">invenStore</a></li>
                        {{-- <li><a href="#" class="hover:text-[#2997ff] transition-colors">examMode</a></li> --}}
                        <li><a href="#" class="hover:text-[#2997ff] transition-colors">OnuaFoodHub</a></li>
                        {{-- <li><a href="#" class="hover:text-[#2997ff] transition-colors">ticketMaester</a></li> --}}
                    </ul>
                </div>  

                {{-- LEGAL QUICKLINKS --}}
                <div>
                    <h4 class="text-white font-medium mb-4 text-sm">Community</h4>
                    <ul class="space-y-3 text-sm text-gray-400 font-light">
                        <li><a href="#" class="hover:text-[#2997ff] transition-colors">Open Source</a></li>
                        <li><a href="#" class="hover:text-[#2997ff] transition-colors">Social Impact</a></li>
                        <li><a href="#" class="hover:text-[#2997ff] transition-colors">Community Events</a></li>
                        <li><a href="#" class="hover:text-[#2997ff] transition-colors">Blog</a></li>
                    </ul>
                </div> 

                <div>
                    <h4 class="text-white font-medium mb-4 text-sm">Legal</h4>
                    <ul class="space-y-3 text-sm text-gray-400 font-light">
                        <li><a href="#" class="hover:text-[#2997ff] transition-colors">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-[#2997ff] transition-colors">Terms of Service</a></li>
                        <li><a href="#" class="hover:text-[#2997ff] transition-colors">Cookie Policy</a></li>
                        <li><a href="#" class="hover:text-[#2997ff] transition-colors">License & Authorization</a></li>
                        <li><a href="#" class="hover:text-[#2997ff] transition-colors">Security</a></li>
                    </ul>
                </div>
            </div>

            <div class="pt-8 border-t border-white/10 flex flex-col md:flex-row justify-center items-center gap-4 text-center md:text-center">
                <p class="text-xs text-gray-500 font-light w-full md:w-auto">
                    &copy; {{ date('Y') }} MonarchI. All rights reserved.
                </p>
                <div class="flex justify-center md:justify-center space-x-6 text-xs text-gray-500 font-light w-full md:w-auto">
                    <span>Tema, Greater Accra Region, Ghana</span>
                </div>
            </div>
        </div>
    </footer>
    {{-- SCRIPTS --}}
    <script>
        document.getElementById('menu-toggle').addEventListener('click', function() {
            document.getElementById('menu').classList.toggle('hidden');
        });

        document.addEventListener('DOMContentLoaded', () => {
            const counters = document.querySelectorAll('.stat-counter');
            const duration = 2000; 
            
            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-target'), 10);
                const increment = target / (duration / 16); 
                let current = 0;

                const updateCounter = () => {
                    current += increment;
                    if (current < target) {
                        counter.innerText = Math.ceil(current);
                        requestAnimationFrame(updateCounter);
                    } else {
                        counter.innerText = target;
                    }
                };

                updateCounter();
            });
        });

        document.addEventListener('DOMContentLoaded', () => {
            const observerOptions = {
                root: null,
                rootMargin: '0px',
                threshold: 0.15 
            };

            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('active');
                        observer.unobserve(entry.target); 
                    }
                });
            }, observerOptions);

            const revealElements = document.querySelectorAll('.reveal, .reveal-left, .reveal-right');
            revealElements.forEach(el => observer.observe(el));
        });

        document.addEventListener('DOMContentLoaded', () => {
            const container = document.getElementById('random-cards-container');
            const cards = container.querySelectorAll('.glass-card');
            
            function positionCards() {
                const containerWidth = container.offsetWidth;
                const containerHeight = container.offsetHeight;

                cards.forEach(card => {
                    const randomTop = Math.random() * (containerHeight - 150); 
                    const randomLeft = Math.random() * (containerWidth - 150);
                    const randomSize = 80 + Math.random() * 80; 
                    const randomRotation = -20 + Math.random() * 40; 
                    
                    const randomOpacity = 0.15 + Math.random() * 0.15; 

                    card.style.top = `${randomTop}px`;
                    card.style.left = `${randomLeft}px`;
                    card.style.width = `${randomSize}px`;
                    card.style.height = `${randomSize}px`;
                    card.style.opacity = randomOpacity;
                    
                    card.style.setProperty('--base-rotation', `${randomRotation}deg`);
                    
                    const animDuration = 5 + Math.random() * 5; 
                    const animDelay = Math.random() * 3; 
                    card.style.animationDuration = `${animDuration}s`;
                    card.style.animationDelay = `${animDelay}s`;
                });
            }

            positionCards();
            window.addEventListener('resize', positionCards);
        });
    </script>
</body>

</html>