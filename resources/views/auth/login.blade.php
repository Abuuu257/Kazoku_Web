<x-guest-layout>
    <div style="margin-bottom: 32px;">
        <a href="/" class="inline-flex items-center space-x-2 text-sm font-bold transition-all hover:bg-slate-100 px-5 py-2.5 rounded-xl border border-slate-100" style="color: #64748b; text-decoration: none;" onmouseover="this.style.color='#78350f';" onmouseout="this.style.color='#64748b';">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            <span>Back to Home</span>
        </a>
    </div>

    <div style="text-align: center; margin-bottom: 24px;">
        <h2 style="font-size: 24px; font-weight: 700; color: #0f172a; margin: 0 0 6px 0;">Welcome Back</h2>
        <p style="font-size: 14px; color: #64748b; margin: 0;">Sign in to continue your pet care journey</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Username -->
        <div style="margin-bottom: 28px;">
            <x-input-label for="username" :value="__('Username')" class="text-slate-700 font-bold text-sm mb-3 ms-1" />
            <x-text-input id="username" 
                class="block mt-1 w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-[#78350f] focus:ring-2 focus:ring-[#78350f]/10 transition-all input-glow" 
                type="text" 
                name="username" 
                :value="old('username')" 
                required 
                autofocus 
                placeholder="Enter your username" />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <!-- Password -->
        <div style="margin-bottom: 24px;" x-data="{ show: false }">
            <x-input-label for="password" :value="__('Password')" class="text-slate-700 font-bold text-sm mb-3 ms-1" />
            <div class="relative">
                <x-text-input id="password" 
                    class="block mt-1 w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-[#78350f] focus:ring-2 focus:ring-[#78350f]/10 transition-all input-glow pr-12"
                    :type="show ? 'text' : 'password'"
                    name="password"
                    required 
                    autocomplete="current-password"
                    placeholder="Enter your password" />
                <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 top-1 flex items-center pr-3 text-slate-400 hover:text-slate-600 focus:outline-none">
                    <svg x-show="!show" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <svg x-show="show" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between" style="margin-bottom: 32px;">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded border-slate-300 shadow-sm focus:ring-[#78350f] focus:ring-2 focus:ring-offset-0 transition-all" style="color: #78350f;" name="remember">
                <span class="ms-2 text-sm text-slate-600 font-medium">Remember me</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm font-semibold transition-colors" style="color: #78350f; text-decoration: none;" onmouseover="this.style.color='#d4a574';" onmouseout="this.style.color='#78350f';" href="{{ route('password.request') }}">
                    Forgot password?
                </a>
            @endif
        </div>

        <!-- Submit Button -->
        <div style="margin-bottom: 24px;">
            <x-primary-button class="w-full justify-center py-3.5 text-sm rounded-xl shadow-lg hover:shadow-xl transition-all" style="background-color: #78350f; color: white;">
                {{ __('Sign In') }}
            </x-primary-button>
        </div>

            <p class="text-center text-sm text-slate-600">
                Don't have an account? 
                <a href="{{ route('register') }}" class="font-bold transition-colors" style="color: #78350f; text-decoration: none;" onmouseover="this.style.color='#d4a574';" onmouseout="this.style.color='#78350f';">
                    Join now
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
