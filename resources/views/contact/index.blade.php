<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact Us - Kazoku Pet Store</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body { font-family: 'Outfit', sans-serif; }
        .font-serif { font-family: 'Playfair Display', serif; }
        .glass-dark { background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); border-bottom: 1px solid rgba(0, 0, 0, 0.05); }
        .nav-link { position: relative; }
        .nav-link::after { content: ''; position: absolute; bottom: -4px; left: 0; width: 0; height: 2px; background: #78350f; transition: width 0.3s; }
        .nav-link:hover::after { width: 100%; }
    </style>
</head>
<body class="antialiased bg-slate-50 text-slate-900 flex flex-col min-h-screen">
    <!-- Navbar -->
    <nav class="fixed w-full z-50 glass-dark py-4 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <a href="/" class="flex items-center gap-3 group">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="transition-transform duration-300 group-hover:scale-110" style="width: 48px; height: 48px; object-fit: contain;">
                <div class="flex flex-col">
                    <span class="text-2xl font-black tracking-tighter text-slate-900">KAZOKU</span>
                    <span class="text-[10px] font-bold tracking-[0.4em] text-slate-500 uppercase -mt-1">Pet Store</span>
                </div>
            </a>
            
            <div class="flex justify-around items-center text-sm font-bold uppercase tracking-widest text-slate-600 transition-colors duration-300" style="gap: 3rem;">
                <a href="{{ route('home') }}" class="nav-link hover:text-[#78350f]">Home</a>
                <a href="{{ route('products.index') }}" class="nav-link hover:text-[#78350f]">Products</a>
                <a href="{{ route('contact.index') }}" class="nav-link text-[#78350f]">Contact Us</a>
            </div>

            <div class="flex items-center" style="gap: 24px;">
                <a href="{{ route('cart.index') }}" class="flex items-center gap-2 group">
                    <div class="w-12 h-12 rounded-2xl flex items-center justify-center border-2 border-slate-100 group-hover:border-black transition-all">
                        <svg class="w-6 h-6" style="color: #000000;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    </div>
                    <span class="text-sm font-black text-black">0</span>
                </a>
                @auth
                    <div class="flex items-center gap-4">
                        <div class="relative" x-data="{ accountOpen: false }">
                            <button type="button" @click="accountOpen = !accountOpen" @click.away="accountOpen = false" class="rounded-full bg-slate-100 text-slate-900 text-xs font-bold uppercase tracking-widest hover:bg-[#78350f] hover:text-white transition-all border-2 border-slate-900 flex items-center gap-2" style="padding: 10px 24px;">
                                <span>Account</span>
                                <svg class="w-4 h-4 transition-transform duration-300" :class="{'rotate-180': accountOpen}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="accountOpen"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 scale-95"
                                 x-transition:enter-end="opacity-100 scale-100"
                                 class="absolute right-0 mt-2 w-48 bg-white border border-slate-200 rounded-2xl shadow-xl z-[100] transform origin-top-right"
                                 style="display: none;">
                                <div class="p-2 text-left">
                                    <div class="px-4 py-2 border-b border-slate-100 mb-1">
                                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Signed in as</p>
                                        <p class="text-xs font-black text-slate-900 truncate">{{ Auth::user()->name }}</p>
                                    </div>
                                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-4 py-3 text-xs font-bold text-slate-600 hover:text-[#78350f] hover:bg-slate-50 rounded-xl transition-all" style="text-decoration: none;">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                        Profile Settings
                                    </a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="w-full flex items-center gap-2 px-4 py-3 text-xs font-bold text-red-500 hover:bg-red-50 rounded-xl transition-all">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                            Log Out
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="rounded-full bg-white text-xs font-bold uppercase tracking-widest transition-all" style="padding: 10px 24px; border: 2px solid #78350f; color: #78350f;" onmouseover="this.style.backgroundColor='#78350f'; this.style.color='white'; this.style.borderColor='#78350f';" onmouseout="this.style.backgroundColor='white'; this.style.color='#78350f'; this.style.borderColor='#78350f';">LOG IN</a>
                    <a href="{{ route('register') }}" class="rounded-full text-white hover:opacity-90 transition-all text-xs font-bold uppercase tracking-widest shadow-xl shadow-[#78350f]/20" style="background-color: #78350f; padding: 12px 28px;">JOIN NOW</a>
                @endauth
            </div>
        </div>
    </nav>
    </nav>

    <main class="flex-grow flex items-center">
    <div style="padding-top: 80px; padding-bottom: 60px; width: 100%; max-width: 1280px; margin: 0 auto; padding-left: 24px; padding-right: 24px;">
        <div class="grid grid-cols-1 lg:grid-cols-2" style="gap: 80px; align-items: start;">
            <div data-aos="fade-right" style="padding-top: 20px;">
                <h1 class="text-5xl font-serif font-bold text-slate-900 mb-6" style="margin-bottom: 24px; line-height: 1.1;">Get in Touch</h1>
                <p class="text-slate-500 text-lg leading-relaxed mb-12" style="margin-bottom: 48px; font-size: 1.125rem; line-height: 1.75;">Have a question about our products? We're here to help! Send us a message and our team will get back to you within 24 hours.</p>
                
                <div class="space-y-8" style="display: flex; flex-direction: column; gap: 32px;">
                    <div class="flex items-start space-x-6" style="gap: 24px;">
                        <div class="w-12 h-12 rounded-2xl shadow-lg flex items-center justify-center flex-shrink-0" style="width: 48px; height: 48px; background-color: #78350f; color: white;">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900" style="margin-bottom: 4px; font-size: 1.1rem;">Email Us</h4>
                            <p class="text-slate-500">hello@kazoku.pet</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-6" style="gap: 24px; margin-bottom: 40px;">
                        <div class="w-12 h-12 rounded-2xl shadow-lg flex items-center justify-center flex-shrink-0" style="width: 48px; height: 48px; background-color: #78350f; color: white;">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900" style="margin-bottom: 4px; font-size: 1.1rem;">Visit Us</h4>
                            <p class="text-slate-500">123 Pet Lane, Animal Valley, PC 5678</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-[3rem] border border-slate-100" style="padding: 64px; box-shadow: 0 20px 40px -8px rgba(0, 0, 0, 0.08);" data-aos="fade-left">
                @if(session('success'))
                    <div class="mb-8 p-4 bg-emerald-50 text-emerald-600 rounded-2xl font-bold flex items-center space-x-3" style="margin-bottom: 32px; padding: 16px;">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                <form action="{{ route('contact.store') }}" method="POST" style="display: flex; flex-direction: column; gap: 32px;">
                    @csrf
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wider" style="margin-bottom: 12px; display: block;">Full Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="John Doe" class="w-full rounded-2xl border-slate-100 bg-slate-50 focus:bg-white focus:border-indigo-600 focus:ring-0 transition-all @error('name') border-rose-500 @enderror" style="padding: 16px 24px; width: 100%;">
                        @error('name') <p class="text-rose-500 text-xs mt-2 font-bold">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wider" style="margin-bottom: 12px; display: block;">Email Address</label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="john@example.com" class="w-full rounded-2xl border-slate-100 bg-slate-50 focus:bg-white focus:border-indigo-600 focus:ring-0 transition-all @error('email') border-rose-500 @enderror" style="padding: 16px 24px; width: 100%;">
                        @error('email') <p class="text-rose-500 text-xs mt-2 font-bold">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wider" style="margin-bottom: 12px; display: block;">Subject</label>
                        <input type="text" name="subject" value="{{ old('subject') }}" placeholder="How can we help?" class="w-full rounded-2xl border-slate-100 bg-slate-50 focus:bg-white focus:border-indigo-600 focus:ring-0 transition-all @error('subject') border-rose-500 @enderror" style="padding: 16px 24px; width: 100%;">
                        @error('subject') <p class="text-rose-500 text-xs mt-2 font-bold">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wider" style="margin-bottom: 12px; display: block;">Message</label>
                        <textarea name="message" rows="5" placeholder="Tell us more..." class="w-full rounded-2xl border-slate-100 bg-slate-50 focus:bg-white focus:border-indigo-600 focus:ring-0 transition-all @error('message') border-rose-500 @enderror" style="padding: 16px 24px; width: 100%;">{{ old('message') }}</textarea>
                        @error('message') <p class="text-rose-500 text-xs mt-2 font-bold">{{ $message }}</p> @enderror
                    </div>
                    <button type="submit" class="w-full font-bold rounded-2xl hover:opacity-90 transition-all shadow-xl shadow-[#78350f]/20" style="background-color: #78350f; color: white; padding: 20px; font-size: 16px; margin-top: 8px;">Send Message</button>
                </form>
            </div>
        </div>
        </div>
    </div>
    </main>

    <!-- Footer -->
    <footer style="background: linear-gradient(to bottom, #faf8f5, #f5f1e8); padding-top: 60px; padding-bottom: 30px; border-top: 2px solid #e7e3dc;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Footer Main Content - 4 Rows -->
            <div style="margin-bottom: 40px;">
                <!-- Row 0: Brand -->
                <div style="margin-bottom: 32px;">
                    <div class="flex items-center gap-2" style="margin-bottom: 12px;">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" style="width: 32px; height: 32px; object-fit: contain;">
                        <span class="font-bold tracking-tighter" style="color: #78350f; font-size: 24px;">KAZOKU</span>
                        <span class="font-semibold tracking-widest uppercase" style="color: #64748b; font-size: 11px; margin-left: 8px;">Pet Store</span>
                    </div>
                    <p style="color: #64748b; font-size: 14px; line-height: 1.6; max-width: 600px;">
                        Your trusted partner in pet care. Premium products for your furry friends.
                    </p>
                </div>

                <!-- Row 1: Quick Links -->
                <div style="margin-bottom: 32px;">
                    <h4 class="font-bold uppercase tracking-wider" style="color: #0f172a; font-size: 13px; margin-bottom: 16px;">Quick Links</h4>
                    <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-wrap: wrap; gap: 24px;">
                        <li><a href="{{ route('home') }}" style="color: #64748b; text-decoration: none; font-size: 14px; transition: color 0.3s;" onmouseover="this.style.color='#78350f';" onmouseout="this.style.color='#64748b';">Home</a></li>
                        <li><a href="{{ route('products.index') }}" style="color: #64748b; text-decoration: none; font-size: 14px; transition: color 0.3s;" onmouseover="this.style.color='#78350f';" onmouseout="this.style.color='#64748b';">Products</a></li>
                        <li><a href="{{ route('contact.index') }}" style="color: #64748b; text-decoration: none; font-size: 14px; transition: color 0.3s;" onmouseover="this.style.color='#78350f';" onmouseout="this.style.color='#64748b';">Contact Us</a></li>
                    </ul>
                </div>

                <!-- Row 3: Social Media -->
                <div>
                    <h4 class="font-bold uppercase tracking-wider" style="color: #0f172a; font-size: 13px; margin-bottom: 16px;">Follow Us</h4>
                    <div style="display: flex; gap: 10px;">
                        <a href="#" style="width: 36px; height: 36px; background-color: white; border-radius: 8px; display: flex; align-items: center; justify-content: center; text-decoration: none; border: 1px solid #e7e3dc; transition: all 0.3s;" onmouseover="this.style.backgroundColor='#78350f'; this.style.borderColor='#78350f';" onmouseout="this.style.backgroundColor='white'; this.style.borderColor='#e7e3dc';">
                            <svg style="width: 16px; height: 16px; color: #78350f;" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                        <a href="#" style="width: 36px; height: 36px; background-color: white; border-radius: 8px; display: flex; align-items: center; justify-content: center; text-decoration: none; border: 1px solid #e7e3dc; transition: all 0.3s;" onmouseover="this.style.backgroundColor='#78350f'; this.style.borderColor='#78350f';" onmouseout="this.style.backgroundColor='white'; this.style.borderColor='#e7e3dc';">
                            <svg style="width: 16px; height: 16px; color: #78350f;" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="#" style="width: 36px; height: 36px; background-color: white; border-radius: 8px; display: flex; align-items: center; justify-content: center; text-decoration: none; border: 1px solid #e7e3dc; transition: all 0.3s;" onmouseover="this.style.backgroundColor='#78350f'; this.style.borderColor='#78350f';" onmouseout="this.style.backgroundColor='white'; this.style.borderColor='#e7e3dc';">
                            <svg style="width: 16px; height: 16px; color: #78350f;" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Footer Bottom -->
            <div style="padding-top: 24px; border-top: 1px solid #e7e3dc; text-align: center;">
                <p style="color: #94a3b8; font-size: 13px; margin: 0;">
                    &copy; {{ date('Y') }} Kazoku Pet Store. All rights reserved. Made with <span style="color: #78350f;">❤</span> for pets.
                </p>
            </div>
        </div>
    </footer>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
            offset: 50
        });
    </script>
</body>
</html>
