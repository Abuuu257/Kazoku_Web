<x-guest-layout>
    <div style="margin-bottom: 32px;">
        <a href="/" class="inline-flex items-center space-x-2 text-sm font-bold transition-all hover:bg-slate-100 px-5 py-2.5 rounded-xl border border-slate-100" style="color: #64748b; text-decoration: none;" onmouseover="this.style.color='#78350f';" onmouseout="this.style.color='#64748b';">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            <span>Back to Home</span>
        </a>
    </div>

    <div style="text-align: center; margin-bottom: 24px;">
        <h2 style="font-size: 24px; font-weight: 700; color: #0f172a; margin: 0 0 6px 0;">Create Account</h2>
        <p style="font-size: 14px; color: #64748b; margin: 0;">Join our family of pet lovers today</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div style="margin-bottom: 28px;">
            <x-input-label for="name" :value="__('Full Name')" class="text-slate-700 font-bold text-sm mb-3 ms-1" />
            <x-text-input id="name" 
                class="block mt-1 w-full px-4 py-2.5 rounded-2xl border-slate-200 bg-slate-50/50 focus:bg-white focus:border-[#78350f] focus:ring-4 focus:ring-[#78350f]/5 transition-all outline-none" 
                type="text" 
                name="name" 
                :value="old('name')" 
                required 
                autofocus 
                placeholder="John Doe" />
            <x-input-error :messages="$errors->get('name')" class="mt-1 ms-1 text-xs" />
        </div>

        <!-- Username -->
        <div style="margin-bottom: 28px;">
            <x-input-label for="username" :value="__('Username')" class="text-slate-700 font-bold text-sm mb-3 ms-1" />
            <x-text-input id="username" 
                class="block mt-1 w-full px-4 py-2.5 rounded-2xl border-slate-200 bg-slate-50/50 focus:bg-white focus:border-[#78350f] focus:ring-4 focus:ring-[#78350f]/5 transition-all outline-none" 
                type="text" 
                name="username" 
                :value="old('username')" 
                required 
                placeholder="Choose a username" />
            <x-input-error :messages="$errors->get('username')" class="mt-1 ms-1 text-xs" />
        </div>

        <!-- Email Address -->
        <div style="margin-bottom: 28px;">
            <x-input-label for="email" :value="__('Email Address')" class="text-slate-700 font-bold text-sm mb-3 ms-1" />
            <x-text-input id="email" 
                class="block mt-1 w-full px-4 py-2.5 rounded-2xl border-slate-200 bg-slate-50/50 focus:bg-white focus:border-[#78350f] focus:ring-4 focus:ring-[#78350f]/5 transition-all outline-none" 
                type="email" 
                name="email" 
                :value="old('email')" 
                required 
                autocomplete="username"
                placeholder="you@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-1 ms-1 text-xs" />
        </div>

        <!-- Password -->
        <div style="margin-bottom: 28px;">
            <x-input-label for="password" :value="__('Password')" class="text-slate-700 font-bold text-sm mb-3 ms-1" />
            <x-text-input id="password" 
                class="block mt-1 w-full px-4 py-2.5 rounded-2xl border-slate-200 bg-slate-50/50 focus:bg-white focus:border-[#78350f] focus:ring-4 focus:ring-[#78350f]/5 transition-all outline-none"
                type="password"
                name="password"
                required 
                autocomplete="new-password"
                placeholder="Min. 8 characters" />
            <x-input-error :messages="$errors->get('password')" class="mt-1 ms-1 text-xs" />
        </div>

        <!-- Confirm Password -->
        <div style="margin-bottom: 32px;">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-slate-700 font-bold text-sm mb-3 ms-1" />
            <x-text-input id="password_confirmation" 
                class="block mt-1 w-full px-4 py-2.5 rounded-2xl border-slate-200 bg-slate-50/50 focus:bg-white focus:border-[#78350f] focus:ring-4 focus:ring-[#78350f]/5 transition-all outline-none"
                type="password"
                name="password_confirmation" 
                required 
                autocomplete="new-password"
                placeholder="Repeat password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 ms-1 text-xs" />
        </div>

        <!-- Submit Button -->
        <div class="pt-2">
            <div style="margin-bottom: 24px;">
                <x-primary-button class="w-full justify-center py-3 text-sm rounded-2xl shadow-xl shadow-slate-200/50 hover:shadow-2xl transition-all" style="background-color: #78350f; color: white;">
                    {{ __('Create Account') }}
                </x-primary-button>
            </div>

            <p class="text-center text-xs text-slate-500">
                Already have an account? 
                <a href="{{ route('login') }}" class="font-bold transition-colors" style="color: #78350f; text-decoration: none;" onmouseover="this.style.color='#d4a574';" onmouseout="this.style.color='#78350f';">
                    Sign in
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
