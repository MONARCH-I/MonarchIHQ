<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MonarchI|Search</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-color: #000;
            color: white;
            overflow-x: hidden;
            height: 200vh;
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
        .reveal.active, .reveal-left.active, .reveal-right.active {
            opacity: 1;
            transform: translate(0, 0);
        }
        /* Staggered delays for grids */
        .delay-100 { transition-delay: 100ms; }
        .delay-200 { transition-delay: 200ms; }
        .delay-300 { transition-delay: 300ms; }

                /* Define a gentle floating animation */
        @keyframes float {
            0%, 100% { 
                transform: translateY(0) rotate(var(--base-rotation)); 
            }
            50% { 
                transform: translateY(-20px) rotate(calc(var(--base-rotation) + 5deg)); 
            }
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.08); /* Increased visibility */
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.281); /* More defined border */
            animation: float 10s ease-in-out infinite; /* Infinite floating */
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

            <div id="menu" class="fixed top-12 left-0 w-full bg-black/20 hidden z-40">
                <div class="max-w-[1024px] mx-auto px-4 md:px-0">
                    <ul class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-8 text-center md:justify-center text-[12px] font-light text-gray-100 uppercase tracking-wider py-4">
                        <a href="/services"><li class="nav-link">Services</li></a>
                        <a href="/projects"><li class="nav-link">Projects</li></a>
                        <a href="/store"><li class="nav-link">Store</li></a>
                        <a href="/contact"><li class="nav-link">Contact Us</li></a>
                        <a href="/about"><li class="nav-link">About</li></a>
                        <a href="/blog"><li class="nav-link">Trending</li></a>
                        <a href="/careers"><li class="nav-link">Careers</li></a>
                    </ul>
                </div>
            </div>

            <a href="/"><div class="logo font-bold tracking-[0.2em] text-sm nav-link">
                M O N A R C H I
            </div>
            </a>

            <div class="right-section flex items-center space-x-6">
                <a href="/search">                
                    <svg class="w-4 h-4 text-gray-300 nav-link" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </a>

                <a href="/cart">
                    <svg class="w-4 h-4 text-gray-300 nav-link" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </a>


                @auth
                <a href="{{ url('/dashboard') }}">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&color=7F9CF5&background=EBF4FF" class="w-5 h-5 rounded-full nav-link" alt="account">
                </a>
                @else
                <a href="{{ route('login') }}">
                    <svg class="w-4 h-4 text-gray-300 nav-link" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </a>
                @endauth
            </div>
        </div>
    </header>
    <main>
        
    </main>
</body>

</html>