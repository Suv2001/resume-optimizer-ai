<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-bl from-pink-100 via-blue-100 to-purple-100 py-12 px-4 sm:px-6 lg:px-8 animate-gradient-x">
        <div class="max-w-md w-full">
            <!-- Card Container with Glass Effect -->
            <div class="backdrop-blur-lg bg-white/80 rounded-3xl shadow-2xl p-8 space-y-8 transform hover:scale-[1.01] transition-all duration-300">
                <!-- Header -->
                <div class="text-center space-y-6">
                    <div class="relative mx-auto h-20 w-20">
                        <div class="absolute inset-0 bg-gradient-to-r from-pink-500 to-purple-600 rounded-2xl transform rotate-6 transition-transform group-hover:rotate-12"></div>
                        <div class="absolute inset-0 bg-gradient-to-r from-pink-600 to-purple-500 rounded-2xl transform -rotate-3 transition-transform group-hover:-rotate-6"></div>
                        <div class="relative bg-white rounded-2xl h-full w-full flex items-center justify-center shadow-lg">
                            <svg class="h-10 w-10 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h2 class="text-3xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-pink-600 to-purple-600">Reset Password</h2>
                        <p class="mt-3 text-gray-500 max-w-sm mx-auto">Enter your email address and we'll send you a link to reset your password.</p>
                    </div>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                    @csrf

                    <!-- Email Address -->
                    <div class="group">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2 group-focus-within:text-pink-600 transition-colors">
                            Email Address
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400 group-focus-within:text-pink-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                   class="block w-full pl-10 pr-3 py-3.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-all duration-200 bg-white/50 backdrop-blur-sm hover:bg-white/80"
                                   placeholder="Enter your email address">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4">
                        <button type="submit" 
                                class="group relative w-full flex justify-center py-3.5 px-4 border border-transparent text-sm font-medium rounded-xl text-white bg-gradient-to-r from-pink-600 to-purple-600 hover:from-pink-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500 transform transition-all duration-200 ease-in-out hover:scale-[1.02] active:scale-[0.98] shadow-lg hover:shadow-xl">
                            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                <svg class="h-5 w-5 text-pink-300 group-hover:text-pink-200 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </span>
                            Send Reset Link
                        </button>
                    </div>

                    <!-- Back to Login -->
                    <div class="text-center mt-6">
                        <a href="{{ route('login') }}" class="text-sm font-medium text-pink-600 hover:text-pink-700 transition-colors">
                            ← Back to Login
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
