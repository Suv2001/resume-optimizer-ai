<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Resume Optimizer AI') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Additional styles for animations -->
    <style>
        .bg-animate {
            background: linear-gradient(to right, #0f172a, #1e293b);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
        }
        
        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }
        
        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        
        @keyframes floating {
            0% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-20px);
            }
            100% {
                transform: translateY(0px);
            }
        }
        
        .pulse {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(99, 102, 241, 0.7);
            }
            70% {
                box-shadow: 0 0 0 15px rgba(99, 102, 241, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(99, 102, 241, 0);
            }
        }
        
        .particle {
            position: absolute;
            border-radius: 50%;
        }

        @keyframes particleAnimation {
            0% {
                opacity: 0;
                transform: translateY(0) rotate(0deg);
            }
            50% {
                opacity: 0.8;
            }
            100% {
                opacity: 0;
                transform: translateY(-100px) rotate(360deg);
            }
        }
    </style>
</head>
<body class="antialiased text-gray-200">
    <div class="relative min-h-screen bg-animate overflow-hidden">
        <!-- Animated Background Particles -->
        <div id="particles-container" class="absolute inset-0 z-0"></div>
        
        <!-- Navbar -->
        <nav class="relative z-10 bg-gray-900/80 backdrop-blur-md border-b border-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 flex items-center">
                            <svg class="h-8 w-8 text-indigo-500" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 12L11 14L15 10M20.618 5.984C17.4565 2.825 12.5435 2.825 9.382 5.984C6.22053 9.1431 6.22053 14.0559 9.382 17.215C12.5435 20.3741 17.4565 20.3741 20.618 17.215C23.7795 14.0559 23.7795 9.14311 20.618 5.984Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span class="ml-2 text-xl font-bold">Resume Optimizer AI</span>
                        </div>
                    </div>
                    <div class="flex items-center">
                        @if (Route::has('login'))
                            <div class="hidden space-x-8 sm:flex">
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="font-medium text-gray-300 hover:text-indigo-400 transition-colors">Dashboard</a>
                                @else
                                    <a href="{{ route('login') }}" class="font-medium text-gray-300 hover:text-indigo-400 transition-colors">Log in</a>

                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="font-medium text-indigo-500 hover:text-indigo-400 transition-colors">Register</a>
                                    @endif
                                @endauth
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="relative z-10 py-10 sm:py-16 lg:py-24 overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="lg:grid lg:grid-cols-12 lg:gap-8">
                    <div class="lg:col-span-6">
                        <div class="text-center lg:text-left md:max-w-2xl md:mx-auto">
                            <h1 class="mt-4 text-4xl font-extrabold tracking-tight text-white sm:mt-5 sm:text-5xl lg:mt-6 xl:text-6xl">
                                <span class="block">Unlock Your Career</span>
                                <span class="block text-indigo-500">With AI-Powered Resume Optimization</span>
                            </h1>
                            <p class="mt-3 text-base text-gray-400 sm:mt-5 sm:text-xl">
                                Get more interviews and land your dream job with our advanced AI resume optimization technology. Tailored to match job descriptions and beat ATS systems with precision.
                            </p>
                            <div class="mt-8 sm:flex sm:justify-center lg:justify-start space-y-4 sm:space-y-0 sm:space-x-4">
                                <div>
                                    <a href="{{ Route::has('register') ? route('register') : '#' }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 md:py-4 md:text-lg md:px-10 shadow-lg hover:shadow-indigo-500/30 transition-all duration-300 pulse">
                                        Get Started Free
                                    </a>
                                </div>
                                <div>
                                    <a href="#features" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 md:py-4 md:text-lg md:px-10 transition-colors duration-300">
                                        Learn More
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-12 lg:mt-0 lg:col-span-6 flex justify-center">
                        <div class="relative w-full max-w-lg floating">
                            <div class="absolute top-0 -left-4 w-72 h-72 bg-indigo-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob"></div>
                            <div class="absolute top-0 -right-4 w-72 h-72 bg-purple-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-2000"></div>
                            <div class="absolute -bottom-8 left-20 w-72 h-72 bg-pink-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-4000"></div>
                            <div class="relative">
                                <img class="relative rounded-lg shadow-2xl" src="https://images.unsplash.com/photo-1586281380349-632531db7ed4?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80" alt="Resume Optimization">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <section id="features" class="relative z-10 py-16 bg-gray-900/50 backdrop-blur-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h2 class="text-base font-semibold text-indigo-500 uppercase tracking-wide">Features</h2>
                    <p class="mt-1 text-3xl font-extrabold text-white sm:text-4xl sm:tracking-tight">Everything you need to optimize your resume</p>
                    <p class="max-w-xl mt-5 mx-auto text-xl text-gray-400">Land more interviews with our comprehensive suite of resume optimization tools.</p>
                </div>

                <div class="mt-12">
                    <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                        <!-- Feature 1 -->
                        <div class="bg-gray-800/60 backdrop-blur-sm rounded-xl px-6 py-8 border border-gray-700/50 hover:border-indigo-500/50 transition-all duration-300 hover:shadow-lg hover:shadow-indigo-500/10">
                            <div class="text-indigo-500 mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-white">ATS Optimization</h3>
                            <p class="mt-2 text-gray-400">Get past Applicant Tracking Systems with AI-powered keyword matching and formatting optimization.</p>
                        </div>

                        <!-- Feature 2 -->
                        <div class="bg-gray-800/60 backdrop-blur-sm rounded-xl px-6 py-8 border border-gray-700/50 hover:border-indigo-500/50 transition-all duration-300 hover:shadow-lg hover:shadow-indigo-500/10">
                            <div class="text-indigo-500 mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-white">Job-Specific Tailoring</h3>
                            <p class="mt-2 text-gray-400">Automatically tailor your resume to specific job descriptions to maximize relevance and match rate.</p>
                        </div>

                        <!-- Feature 3 -->
                        <div class="bg-gray-800/60 backdrop-blur-sm rounded-xl px-6 py-8 border border-gray-700/50 hover:border-indigo-500/50 transition-all duration-300 hover:shadow-lg hover:shadow-indigo-500/10">
                            <div class="text-indigo-500 mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-white">Achievement Enhancer</h3>
                            <p class="mt-2 text-gray-400">Transform your job duties into powerful achievement statements with our AI writing assistant.</p>
                        </div>

                        <!-- Feature 4 -->
                        <div class="bg-gray-800/60 backdrop-blur-sm rounded-xl px-6 py-8 border border-gray-700/50 hover:border-indigo-500/50 transition-all duration-300 hover:shadow-lg hover:shadow-indigo-500/10">
                            <div class="text-indigo-500 mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-white">Design Templates</h3>
                            <p class="mt-2 text-gray-400">Choose from dozens of professionally designed templates optimized for your industry and career level.</p>
                        </div>

                        <!-- Feature 5 -->
                        <div class="bg-gray-800/60 backdrop-blur-sm rounded-xl px-6 py-8 border border-gray-700/50 hover:border-indigo-500/50 transition-all duration-300 hover:shadow-lg hover:shadow-indigo-500/10">
                            <div class="text-indigo-500 mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-white">Skills Analysis</h3>
                            <p class="mt-2 text-gray-400">Get personalized recommendations for skills to add or highlight based on your target role.</p>
                        </div>

                        <!-- Feature 6 -->
                        <div class="bg-gray-800/60 backdrop-blur-sm rounded-xl px-6 py-8 border border-gray-700/50 hover:border-indigo-500/50 transition-all duration-300 hover:shadow-lg hover:shadow-indigo-500/10">
                            <div class="text-indigo-500 mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-white">Interview Preparation</h3>
                            <p class="mt-2 text-gray-400">Prepare for interviews with AI-generated practice questions based on your resume and target job.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Social Proof -->
        <section class="relative z-10 py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">Trusted by job seekers worldwide</h2>
                    <p class="mt-3 max-w-2xl mx-auto text-xl text-gray-400 sm:mt-4">Join thousands of professionals who have successfully landed their dream jobs with our AI-powered resume optimization.</p>
                </div>
                
                <div class="mt-12 grid grid-cols-2 gap-8 md:grid-cols-4">
                    <div class="col-span-1 flex justify-center items-center">
                        <img class="h-12 filter grayscale opacity-60 hover:grayscale-0 hover:opacity-100 transition-all" src="https://tailwindui.com/img/logos/tuple-logo-gray-400.svg" alt="Tuple">
                    </div>
                    <div class="col-span-1 flex justify-center items-center">
                        <img class="h-12 filter grayscale opacity-60 hover:grayscale-0 hover:opacity-100 transition-all" src="https://tailwindui.com/img/logos/mirage-logo-gray-400.svg" alt="Mirage">
                    </div>
                    <div class="col-span-1 flex justify-center items-center">
                        <img class="h-12 filter grayscale opacity-60 hover:grayscale-0 hover:opacity-100 transition-all" src="https://tailwindui.com/img/logos/statickit-logo-gray-400.svg" alt="StaticKit">
                    </div>
                    <div class="col-span-1 flex justify-center items-center">
                        <img class="h-12 filter grayscale opacity-60 hover:grayscale-0 hover:opacity-100 transition-all" src="https://tailwindui.com/img/logos/transistor-logo-gray-400.svg" alt="Transistor">
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="relative z-10">
            <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 lg:flex lg:items-center lg:justify-between">
                <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">
                    <span class="block">Ready to boost your career?</span>
                    <span class="block text-indigo-500">Start optimizing your resume today.</span>
                </h2>
                <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
                    <div class="inline-flex rounded-md shadow">
                        <a href="{{ Route::has('register') ? route('register') : '#' }}" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                            Get started
                        </a>
                    </div>
                    <div class="ml-3 inline-flex rounded-md shadow">
                        <a href="#" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-indigo-600 bg-white hover:bg-gray-50">
                            Learn more
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="relative z-10 bg-gray-900 border-t border-gray-800">
            <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8">
                <div class="grid grid-cols-2 gap-8 md:grid-cols-4">
                    <div>
                        <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">Solutions</h3>
                        <ul class="mt-4 space-y-4">
                            <li><a href="#" class="text-base text-gray-500 hover:text-gray-300">Resume Optimization</a></li>
                            <li><a href="#" class="text-base text-gray-500 hover:text-gray-300">Cover Letter Generator</a></li>
                            <li><a href="#" class="text-base text-gray-500 hover:text-gray-300">LinkedIn Profile</a></li>
                            <li><a href="#" class="text-base text-gray-500 hover:text-gray-300">Interview Prep</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">Support</h3>
                        <ul class="mt-4 space-y-4">
                            <li><a href="#" class="text-base text-gray-500 hover:text-gray-300">Pricing</a></li>
                            <li><a href="#" class="text-base text-gray-500 hover:text-gray-300">Documentation</a></li>
                            <li><a href="#" class="text-base text-gray-500 hover:text-gray-300">Guides</a></li>
                            <li><a href="#" class="text-base text-gray-500 hover:text-gray-300">API Status</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">Company</h3>
                        <ul class="mt-4 space-y-4">
                            <li><a href="#" class="text-base text-gray-500 hover:text-gray-300">About</a></li>
                            <li><a href="#" class="text-base text-gray-500 hover:text-gray-300">Blog</a></li>
                            <li><a href="#" class="text-base text-gray-500 hover:text-gray-300">Jobs</a></li>
                            <li><a href="#" class="text-base text-gray-500 hover:text-gray-300">Partners</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">Legal</h3>
                        <ul class="mt-4 space-y-4">
                            <li><a href="#" class="text-base text-gray-500 hover:text-gray-300">Privacy</a></li>
                            <li><a href="#" class="text-base text-gray-500 hover:text-gray-300">Terms</a></li>
                            <li><a href="#" class="text-base text-gray-500 hover:text-gray-300">Cookie Policy</a></li>
                            <li><a href="#" class="text-base text-gray-500 hover:text-gray-300">Trademark Policy</a></li>
                        </ul>
                    </div>
                </div>
                <div class="mt-12 border-t border-gray-800 pt-8">
                    <p class="text-base text-gray-500 text-center">&copy; {{ date('Y') }} Resume Optimizer AI. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>

    <!-- Animation Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const container = document.getElementById('particles-container');
            const particleCount = 50;
            
            for (let i = 0; i < particleCount; i++) {
                createParticle(container);
            }
            
            // Create new particles periodically
            setInterval(() => {
                if (document.querySelector('.particle')) {
                    const oldParticle = document.querySelector('.particle');
                    if (oldParticle) {
                        oldParticle.remove();
                        createParticle(container);
                    }
                }
            }, 500);
        });
        
        function createParticle(container) {
            const particle = document.createElement('div');
            particle.classList.add('particle');
            
            // Random size between 2-6px
            const size = Math.random() * 4 + 2;
            particle.style.width = `${size}px`;
            particle.style.height = `${size}px`;
            
            // Random position within the container
            const posX = Math.random() * 100;
            const posY = Math.random() * 100;
            particle.style.left = `${posX}%`;
            particle.style.top = `${posY}%`;
            
            // Random color (indigo, purple, blue shades)
            const colors = ['#6366F1', '#8B5CF6', '#3B82F6', '#EC4899', '#06B6D4'];
            const color = colors[Math.floor(Math.random() * colors.length)];
            particle.style.backgroundColor = color;
            
            // Animation properties
            const duration = (Math.random() * 20) + 10;
            particle.style.animation = `particleAnimation ${duration}s linear infinite`;
            
            container.appendChild(particle);
        }
    </script>
</body>
</html>