<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kazoku Pet Store - Premium Pet Care</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @livewireStyles
    <style>
        body { font-family: 'Outfit', sans-serif; }
        .font-serif { font-family: 'Playfair Display', serif; }
        .nav-glass { background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); border-bottom: 1px solid rgba(0, 0, 0, 0.05); }
        .nav-transparent { background: transparent; border-bottom: 1px solid transparent; }
        .nav-link { position: relative; transition: all 0.3s; }
        .nav-link::after { content: ''; position: absolute; bottom: -4px; left: 0; width: 0; height: 2px; background: #78350f; transition: width 0.3s; }
        .nav-link:hover::after { width: 100%; }
        .hero-gradient { background: linear-gradient(180deg, rgba(15, 23, 42, 0.6) 0%, rgba(15, 23, 42, 0) 25%); }
    </style>
</head>
<body class="antialiased bg-slate-50 text-slate-900 overflow-x-hidden flex flex-col min-h-screen">
    <!-- Navbar -->
    <nav id="main-nav" class="fixed top-0 w-full z-50 py-4 transition-all duration-300 nav-glass shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <a href="/" class="flex items-center gap-3 group relative z-50">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="transition-transform duration-300 group-hover:scale-110" style="width: 48px; height: 48px; object-fit: contain;">
                <div class="flex flex-col">
                    <span class="text-2xl font-black tracking-tighter text-slate-900 logo-text transition-colors duration-300">KAZOKU</span>
                    <span class="text-[10px] font-bold tracking-[0.4em] text-slate-500 logo-sub transition-colors duration-300 uppercase -mt-1">Pet Store</span>
                </div>
            </a>
            
            <div class="flex justify-around items-center text-sm font-bold uppercase tracking-widest text-slate-600 nav-links transition-colors duration-300" style="gap: 3rem;">
                <a href="{{ route('home') }}" class="nav-link text-[#78350f]">Home</a>
                <a href="{{ route('products.index') }}" class="nav-link hover:text-[#78350f] transition-colors">Products</a>
                <a href="{{ route('contact.index') }}" class="nav-link hover:text-[#78350f] transition-colors">Contact Us</a>
            </div>

            <div class="flex items-center relative z-50" style="gap: 24px;">
                <a href="{{ route('cart.index') }}" class="flex items-center gap-2 group">
                    <div class="w-12 h-12 rounded-2xl flex items-center justify-center border-2 border-slate-200 group-hover:border-black transition-all">
                        <svg class="w-6 h-6" style="color: #000000;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    </div>
                    <span id="cart-count" class="text-sm font-black text-black">{{ count(session('cart', [])) }}</span>
                </a>
                @auth
                    @if(Auth::user()->usertype === 'admin')
                        <a href="{{ route('admin.products.index') }}" class="rounded-full bg-slate-100 text-slate-900 text-xs font-bold uppercase tracking-widest hover:bg-[#78350f] hover:text-white transition-all auth-btn border-2 border-slate-900" style="padding: 12px 28px;">Admin Panel</a>
                    @else
                        <div class="flex items-center gap-4">
                            <!-- Dropdown UI using Alpine.js -->
                            <div class="relative" x-data="{ accountOpen: false }">
                                <button @click="accountOpen = !accountOpen" @click.away="accountOpen = false" class="rounded-full bg-slate-100 text-slate-900 text-xs font-bold uppercase tracking-widest hover:bg-[#78350f] hover:text-white transition-all border-2 border-slate-900 flex items-center gap-2" style="padding: 12px 28px;">
                                    <span>Account</span>
                                    <svg class="w-4 h-4 transition-transform duration-300" :class="{'rotate-180': accountOpen}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                                </button>
                                <!-- Dropdown Content -->
                                <div x-show="accountOpen" 
                                     x-transition:enter="transition ease-out duration-200"
                                     x-transition:enter-start="opacity-0 scale-95"
                                     x-transition:enter-end="opacity-100 scale-100"
                                     x-transition:leave="transition ease-in duration-75"
                                     x-transition:leave-start="opacity-100 scale-100"
                                     x-transition:leave-end="opacity-0 scale-95"
                                     class="absolute right-0 mt-2 w-48 bg-white border border-slate-200 rounded-2xl shadow-xl z-[100] transform origin-top-right"
                                     style="display: none;">
                                    <div class="p-2">
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
                    @endif
                @else
                    <a href="{{ route('login') }}" class="rounded-full bg-white text-xs font-bold uppercase tracking-widest transition-all auth-link" style="padding: 12px 28px; border: 2px solid #78350f; color: #78350f;" onmouseover="this.style.backgroundColor='#78350f'; this.style.color='white'; this.style.borderColor='#78350f';" onmouseout="this.style.backgroundColor='white'; this.style.color='#78350f'; this.style.borderColor='#78350f';">LOG IN</a>
                    <a href="{{ route('register') }}" class="rounded-full text-white hover:opacity-90 transition-all text-xs font-bold uppercase tracking-widest shadow-2xl shadow-black/30 register-btn" style="background-color: #78350f; padding: 14px 32px;">JOIN NOW</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="flex-grow">
    <!-- Hero Section -->
    <section class="relative flex items-center overflow-hidden" style="background: linear-gradient(135deg, #faf8f5 0%, #ffffff 50%, #f5f1e8 100%); height: 85vh; min-height: 750px;">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/pet_store_hero.png') }}" alt="Hero Image" class="w-full h-full object-cover">
            <div class="absolute inset-0" style="background-color: rgba(0, 0, 0, 0.5);"></div>
        </div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full" style="padding-top: 180px; padding-bottom: 60px;">
            <div style="max-width: 600px; background: rgba(0, 0, 0, 0.4); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); padding: 48px; border-radius: 40px; border: 1px solid rgba(255, 255, 255, 0.2);" data-aos="fade-right" data-aos-duration="1200">
                <h1 class="font-serif leading-tight" style="font-weight: 900; color: white; font-size: 3.5rem; margin-bottom: 24px; line-height: 1.1;">
                    Where Every Pet <br>is <span class="italic" style="color: #d4a574;">Family</span>
                </h1>
                <p class="leading-relaxed" style="margin-bottom: 32px; color: rgba(255, 255, 255, 0.9); font-size: 1.1rem; line-height: 1.7;">
                    Discover a curated collection of premium supplies and heartfelt care for your furry companions. Everything your pet needs to thrive.
                </p>
                <div style="display: flex; gap: 16px; flex-wrap: wrap;">
                    <a href="{{ route('products.index') }}" class="font-bold text-center transition-all shadow-xl shadow-[#78350f]/20 hover:scale-105 active:scale-95" style="background-color: #78350f; color: white; padding: 16px 36px; border-radius: 16px; text-decoration: none; display: inline-block; font-size: 16px;">Shop Collection</a>
                </div>
            </div>
        </div>
        </div>
    </section>
    
    <!-- Quick Search Bar -->
    <div class="relative z-20 -mt-8 max-w-xl mx-auto px-4" data-aos="fade-up" data-aos-delay="400">
        <livewire:⚡product-search />
    </div>

    <!-- Featured Products -->
    <section class="bg-white" style="padding-top: 100px; padding-bottom: 60px;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center" style="margin-bottom: 60px;" data-aos="fade-up">
            <h2 class="text-sm font-bold tracking-widest uppercase" style="color: #78350f; margin-bottom: 16px;">Handpicked for you</h2>
            <h3 class="text-4xl md:text-5xl font-serif font-bold text-slate-900">Featured Essentials</h3>
        </div>


        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap justify-start" style="gap: 24px;">
                @forelse($products as $product)
                <div class="group relative bg-white border border-slate-100 rounded-2xl overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1 flex-shrink-0" style="width: 260px;" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                    <div class="relative w-full aspect-square overflow-hidden bg-[#faf8f5] p-6 flex items-center justify-center">
                        <img src="{{ Str::startsWith($product->image_url, 'data:') ? $product->image_url : asset('images/' . $product->image_url) }}" alt="{{ $product->name }}" class="max-w-full max-h-full object-contain transition-transform duration-500 group-hover:scale-110" style="width: 180px; height: 180px;">
                    </div>
                    <div class="flex flex-col gap-2" style="padding: 20px 20px 24px 20px;">
                        <span class="text-[10px] font-bold tracking-widest text-[#d4a574] uppercase">{{ $product->category->name ?? 'Essentials' }}</span>
                        <h4 class="text-lg font-bold text-slate-900 line-clamp-1 leading-tight hover:text-[#78350f] transition-colors">{{ $product->name }}</h4>
                        <div class="flex justify-between items-center mt-2">
                            <span class="text-xl font-black" style="color: #78350f;">${{ $product->price }}</span>
                            <a href="{{ route('products.show', $product->id) }}" class="w-10 h-10 flex items-center justify-center rounded-full text-white transition-all shadow-md hover:scale-110 active:scale-95 flex-shrink-0" style="background-color: #78350f; box-shadow: 0 4px 12px rgba(120, 53, 15, 0.3);">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="w-full flex flex-col items-center justify-center text-center py-20 px-4 bg-[#faf8f5]/50 rounded-[2.5rem] border-2 border-dashed border-[#78350f]/10 mb-12">
                    <h4 class="text-3xl font-black text-slate-900 mb-4">Fetching something special...</h4>
                    <p class="text-slate-500 font-semibold max-w-lg mx-auto text-lg leading-relaxed">
                        Our featured essentials are currently being handpicked. <br>Our premium collection will be arriving at your doorstep very soon! 🐾
                    </p>
                </div>
                @endforelse
            </div>

            <div class="text-center" style="margin-top: 64px;">
                <a href="{{ route('products.index') }}" class="font-bold text-center transition-all shadow-2xl shadow-[#78350f]/25 hover:scale-105 active:scale-95" style="background-color: #78350f; color: white; padding: 18px 56px; border-radius: 20px; text-decoration: none; display: inline-block; font-size: 16px;">View all products</a>
            </div>
        </div>
    </section>

    <!-- Value Proposition -->
    <section class="overflow-hidden relative" style="padding-top: 20px; padding-bottom: 160px; background: linear-gradient(to bottom, #ffffff, #faf8f5);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Section Header -->
            <div class="text-center" style="margin-bottom: 60px;" data-aos="fade-up">
                <h2 class="text-sm font-bold tracking-widest uppercase" style="color: #78350f; margin-bottom: 12px;">Why Choose Us</h2>
                <h3 class="text-4xl md:text-5xl font-serif font-bold text-slate-900" style="margin-bottom: 16px;">Dedicated to Your Pet's Happiness</h3>
                <p class="text-lg text-slate-600 max-w-3xl mx-auto leading-relaxed">At Kazoku Pet Store, we believe every pet deserves the best. From premium nutrition to expert care advice, we're committed to providing everything your furry family member needs to thrive.</p>
            </div>

            <!-- Cards Grid - 3 Cards Side by Side -->
            <div class="why-choose-grid" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem;">
                <style>
                    @media (max-width: 768px) {
                        .why-choose-grid {
                            grid-template-columns: 1fr !important;
                        }
                    }
                </style>
                <!-- Card 1: Premium Quality -->
                <div class="relative group" style="background-color: white; padding: 40px 32px; border-radius: 24px; box-shadow: 0 10px 30px rgba(120, 53, 15, 0.08); border: 2px solid #78350f; transition: all 0.3s;">
                    <div style="width: 64px; height: 64px; background: linear-gradient(135deg, #78350f 0%, #92400e 100%); border-radius: 16px; display: flex; align-items: center; justify-content: center; margin-bottom: 24px; box-shadow: 0 4px 12px rgba(120, 53, 15, 0.3);">
                        <svg style="width: 32px; height: 32px; color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h4 class="font-bold" style="font-size: 24px; color: #0f172a; margin-bottom: 16px;">Premium Quality</h4>
                    <p class="leading-relaxed" style="color: #64748b; font-size: 16px; line-height: 1.7; margin-bottom: 20px;">We source only the finest organic foods and durable accessories, rigorously tested for safety, comfort, and nutritional value.</p>
                    <ul class="space-y-3">
                        <li class="flex items-start" style="color: #64748b; font-size: 15px;">
                            <svg class="w-5 h-5 mr-2 flex-shrink-0" style="color: #78350f; margin-top: 2px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>100% organic ingredients</span>
                        </li>
                        <li class="flex items-start" style="color: #64748b; font-size: 15px;">
                            <svg class="w-5 h-5 mr-2 flex-shrink-0" style="color: #78350f; margin-top: 2px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>Veterinarian approved</span>
                        </li>
                        <li class="flex items-start" style="color: #64748b; font-size: 15px;">
                            <svg class="w-5 h-5 mr-2 flex-shrink-0" style="color: #78350f; margin-top: 2px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>Safety certified products</span>
                        </li>
                    </ul>
                </div>

                <!-- Card 2: Fast Delivery -->
                <div class="relative group" style="background-color: white; padding: 40px 32px; border-radius: 24px; box-shadow: 0 10px 30px rgba(120, 53, 15, 0.08); border: 2px solid #78350f; transition: all 0.3s;">
                    <div style="width: 64px; height: 64px; background: linear-gradient(135deg, #78350f 0%, #92400e 100%); border-radius: 16px; display: flex; align-items: center; justify-content: center; margin-bottom: 24px; box-shadow: 0 4px 12px rgba(120, 53, 15, 0.3);">
                        <svg style="width: 32px; height: 32px; color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h4 class="font-bold" style="font-size: 24px; color: #0f172a; margin-bottom: 16px;">Fast Delivery</h4>
                    <p class="leading-relaxed" style="color: #64748b; font-size: 16px; line-height: 1.7; margin-bottom: 20px;">Your pets won't have to wait. We offer lightning-fast shipping with real-time tracking so you always know when to expect your order.</p>
                    <ul class="space-y-3">
                        <li class="flex items-start" style="color: #64748b; font-size: 15px;">
                            <svg class="w-5 h-5 mr-2 flex-shrink-0" style="color: #78350f; margin-top: 2px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>Same-day dispatch available</span>
                        </li>
                        <li class="flex items-start" style="color: #64748b; font-size: 15px;">
                            <svg class="w-5 h-5 mr-2 flex-shrink-0" style="color: #78350f; margin-top: 2px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>Real-time order tracking</span>
                        </li>
                        <li class="flex items-start" style="color: #64748b; font-size: 15px;">
                            <svg class="w-5 h-5 mr-2 flex-shrink-0" style="color: #78350f; margin-top: 2px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>Free shipping over $50</span>
                        </li>
                    </ul>
                </div>

                <!-- Card 3: Pet Experts -->
                <div class="relative group" style="background-color: white; padding: 40px 32px; border-radius: 24px; box-shadow: 0 10px 30px rgba(120, 53, 15, 0.08); border: 2px solid #78350f; transition: all 0.3s;">
                    <div style="width: 64px; height: 64px; background: linear-gradient(135deg, #78350f 0%, #92400e 100%); border-radius: 16px; display: flex; align-items: center; justify-content: center; margin-bottom: 24px; box-shadow: 0 4px 12px rgba(120, 53, 15, 0.3);">
                        <svg style="width: 32px; height: 32px; color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h4 class="font-bold" style="font-size: 24px; color: #0f172a; margin-bottom: 16px;">Pet Experts</h4>
                    <p class="leading-relaxed" style="color: #64748b; font-size: 16px; line-height: 1.7; margin-bottom: 20px;">Our team of certified nutritionists, trainers, and behavioral experts are always here to provide personalized guidance for your pet's unique needs.</p>
                    <ul class="space-y-3">
                        <li class="flex items-start" style="color: #64748b; font-size: 15px;">
                            <svg class="w-5 h-5 mr-2 flex-shrink-0" style="color: #78350f; margin-top: 2px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>24/7 expert support</span>
                        </li>
                        <li class="flex items-start" style="color: #64748b; font-size: 15px;">
                            <svg class="w-5 h-5 mr-2 flex-shrink-0" style="color: #78350f; margin-top: 2px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>Personalized care plans</span>
                        </li>
                        <li class="flex items-start" style="color: #64748b; font-size: 15px;">
                            <svg class="w-5 h-5 mr-2 flex-shrink-0" style="color: #78350f; margin-top: 2px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>Free nutrition consultations</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    
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
            duration: 1000,
            once: true,
            offset: 100
        });
    </script>
    @livewireScripts
</body>
</html>
