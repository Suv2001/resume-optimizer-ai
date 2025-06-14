<x-guest-layout>
    <div class="min-h-screen flex flex-col md:flex-row">
        <!-- Left Panel - Decorative Section -->
        <div class="hidden md:flex md:w-1/2 bg-gradient-to-br from-indigo-600 via-blue-700 to-purple-800 p-12 relative overflow-hidden">
            <div class="absolute inset-0 bg-pattern opacity-10"></div>
            <div class="relative z-10 flex flex-col justify-center h-full text-white space-y-8">
                <div class="animate-float">
                    <svg class="w-24 h-24 text-white/90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h1 class="text-5xl font-bold tracking-tight">Resume Optimizer AI</h1>
                <p class="text-xl text-white/80 max-w-md">Elevate your career with AI-powered resume optimization designed for modern job markets.</p>
                
                <!-- Decorative Elements -->
                <div class="mt-12 space-y-4">
                    <div class="flex items-center space-x-3">
                        <span class="flex items-center justify-center w-8 h-8 rounded-full bg-white/20">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </span>
                        <span class="text-lg text-white/90">Professionally optimized content</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <span class="flex items-center justify-center w-8 h-8 rounded-full bg-white/20">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </span>
                        <span class="text-lg text-white/90">ATS-friendly formatting</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <span class="flex items-center justify-center w-8 h-8 rounded-full bg-white/20">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </span>
                        <span class="text-lg text-white/90">Industry-specific tailoring</span>
                    </div>
                </div>
            </div>
            
            <!-- Abstract Shapes -->
            <div class="absolute bottom-0 right-0 transform translate-y-1/4 translate-x-1/3">
                <div class="w-64 h-64 rounded-full bg-gradient-to-tr from-blue-400 to-indigo-300 opacity-20 blur-2xl"></div>
            </div>
            <div class="absolute top-32 -right-16">
                <div class="w-48 h-48 rounded-full bg-gradient-to-br from-purple-500 to-pink-400 opacity-20 blur-xl"></div>
            </div>
        </div>
        
        <!-- Right Panel - Login Form -->
        <div class="w-full md:w-1/2 flex items-center justify-center px-6 py-12 md:px-16 lg:px-24 bg-white dark:bg-gray-900">
            <div class="w-full max-w-md space-y-8">
                <!-- Logo for Mobile -->
                <div class="md:hidden flex flex-col items-center space-y-4 mb-8">
                    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 p-3 rounded-xl shadow-lg">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Resume Optimizer AI</h2>
                </div>
                
                <!-- Header -->
                <div class="space-y-2">
                    <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white">Welcome back</h2>
                    <p class="text-gray-600 dark:text-gray-400">Sign in to your account to continue</p>
                </div>

                <!-- Login Form -->
                <div class="mt-8">
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}" class="space-y-6">
                        @csrf

                        <!-- Email Address -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Email address
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                    </svg>
                                </div>
                                <input id="email" 
                                       type="email" 
                                       name="email" 
                                       value="{{ old('email') }}"
                                       required 
                                       autofocus 
                                       autocomplete="username"
                                       class="block w-full pl-12 py-3.5 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 dark:text-white transition duration-150 ease-in-out shadow-sm"
                                       placeholder="yourname@example.com">
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="pt-2">
                            <div class="flex items-center justify-between mb-1">
                                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Password
                                </label>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" 
                                       class="text-sm text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 transition-colors">
                                        Forgot password?
                                    </a>
                                @endif
                            </div>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                </div>
                                <input id="password" 
                                       type="password" 
                                       name="password" 
                                       required 
                                       autocomplete="current-password"
                                       class="block w-full pl-12 py-3.5 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 dark:text-white transition duration-150 ease-in-out shadow-sm"
                                       placeholder="••••••••">
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Remember Me -->
                        <div class="flex items-center mt-6">
                            <input id="remember_me" 
                                   type="checkbox" 
                                   name="remember"
                                   class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded transition-colors">
                            <label for="remember_me" class="ml-2 block text-sm text-gray-600 dark:text-gray-400">
                                Remember me for 30 days
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-8">
                            <button type="submit" 
                                    class="relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-150 shadow-md hover:shadow-lg">
                                <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                    <svg class="h-5 w-5 text-indigo-400 group-hover:text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                    </svg>
                                </span>
                                Sign in to your account
                            </button>
                        </div>

                        <!-- Social Login (Placeholder) -->
                        <div class="mt-6">
                            <div class="relative">
                                <div class="absolute inset-0 flex items-center">
                                    <div class="w-full border-t border-gray-300 dark:border-gray-700"></div>
                                </div>
                                <div class="relative flex justify-center text-sm">
                                    <span class="px-2 bg-white dark:bg-gray-900 text-gray-500 dark:text-gray-400">
                                        Or continue with
                                    </span>
                                </div>
                            </div>

                            <div class="mt-6 grid grid-cols-2 gap-3">
                                <div>
                                    <a href="#" class="w-full inline-flex justify-center py-3 px-4 border border-gray-300 dark:border-gray-700 rounded-lg shadow-sm bg-white dark:bg-gray-800 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12.545 10.239v3.821h5.445c-.712 2.315-2.647 3.972-5.445 3.972a6.033 6.033 0 110-12.064c1.498 0 2.866.549 3.921 1.453l2.814-2.814A9.969 9.969 0 0012.545 2C7.021 2 2.543 6.477 2.543 12s4.478 10 10.002 10c8.396 0 10.249-7.85 9.426-11.748l-9.426-.013z"></path>
                                        </svg>
                                    </a>
                                </div>
                                <div>
                                    <a href="#" class="w-full inline-flex justify-center py-3 px-4 border border-gray-300 dark:border-gray-700 rounded-lg shadow-sm bg-white dark:bg-gray-800 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 0C4.477 0 0 4.477 0 10c0 4.42 2.865 8.166 6.839 9.489.5.092.682-.217.682-.482 0-.237-.008-.866-.013-1.7-2.782.603-3.369-1.342-3.369-1.342-.454-1.155-1.11-1.462-1.11-1.462-.908-.62.069-.608.069-.608 1.003.07 1.531 1.03 1.531 1.03.892 1.529 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.11-4.555-4.943 0-1.091.39-1.984 1.029-2.683-.103-.253-.446-1.27.098-2.647 0 0 .84-.268 2.75 1.026A9.564 9.564 0 0110 4.836c.85.004 1.705.114 2.504.336 1.909-1.294 2.747-1.026 2.747-1.026.546 1.377.203 2.394.1 2.647.64.699 1.028 1.592 1.028 2.683 0 3.842-2.339 4.687-4.566 4.935.359.309.678.919.678 1.852 0 1.336-.012 2.415-.012 2.741 0 .267.18.578.688.48C17.137 18.163 20 14.418 20 10c0-5.523-4.477-10-10-10z" clip-rule="evenodd"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Register Link -->
                        <div class="text-center mt-8">
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                Don't have an account?
                                <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 transition-colors ml-1">
                                    Create your account
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Add CSS for the styling elements -->
    <style>
        .bg-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.2'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
    </style>
</x-guest-layout>
