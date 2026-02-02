<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $product->name }} - Kazoku Pet Store</title>
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
        
        /* Force Layout Override */
        @media (min-width: 768px) {
            .product-layout-container {
                display: flex !important;
                flex-direction: row !important;
                align-items: flex-start !important;
            }
            .product-image-column {
                width: 41.666667% !important; /* 5/12 */
            }
            .product-details-column {
                width: 58.333333% !important; /* 7/12 */
            }
        }
    </style>
</head>
<body class="antialiased bg-slate-50 text-slate-900 flex flex-col min-h-screen">
    <!-- Navbar -->
    <nav class="fixed top-0 w-full z-50 glass-dark py-4 transition-all duration-300">
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
                <a href="{{ route('products.index') }}" class="nav-link text-[#78350f]">Products</a>
                <a href="{{ route('contact.index') }}" class="nav-link hover:text-[#78350f]">Contact Us</a>
            </div>

            <div class="flex items-center" style="gap: 24px;">
                <a href="{{ route('cart.index') }}" class="flex items-center gap-2 group">
                    <div class="w-12 h-12 rounded-2xl flex items-center justify-center border-2 border-slate-100 group-hover:border-black transition-all">
                        <svg class="w-6 h-6" style="color: #000000;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    </div>
                    <span id="cart-count" class="text-sm font-black text-black">{{ count(session('cart', [])) }}</span>
                </a>
                @auth
                    @if(Auth::user()->usertype === 'admin')
                        <a href="{{ route('admin.products.index') }}" class="rounded-full bg-slate-100 text-slate-900 text-xs font-bold uppercase tracking-widest hover:bg-[#78350f] hover:text-white transition-all border-2 border-slate-900" style="padding: 10px 24px;">Admin Panel</a>
                    @else
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
                                     x-transition:leave="transition ease-in duration-75"
                                     x-transition:leave-start="opacity-100 scale-100"
                                     x-transition:leave-end="opacity-0 scale-95"
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
                    @endif
                @else
                    <a href="{{ route('login') }}" class="rounded-full bg-white text-xs font-bold uppercase tracking-widest transition-all" style="padding: 10px 24px; border: 2px solid #78350f; color: #78350f;" onmouseover="this.style.backgroundColor='#78350f'; this.style.color='white'; this.style.borderColor='#78350f';" onmouseout="this.style.backgroundColor='white'; this.style.color='#78350f'; this.style.borderColor='#78350f';">LOG IN</a>
                    <a href="{{ route('register') }}" class="rounded-full text-white hover:opacity-90 transition-all text-xs font-bold uppercase tracking-widest shadow-xl shadow-[#78350f]/20" style="background-color: #78350f; padding: 12px 28px;">JOIN NOW</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="flex-grow">
        <div class="pt-48 pb-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb Navigation -->
            <nav class="mb-8" data-aos="fade-down">
                <ol class="flex items-center space-x-2 text-sm">
                    <li>
                        <a href="{{ route('home') }}" class="text-slate-500 hover:text-[#78350f] transition-colors">Home</a>
                    </li>
                    <li class="text-slate-400">/</li>
                    <li>
                        <a href="{{ route('products.index') }}" class="text-slate-500 hover:text-[#78350f] transition-colors">Products</a>
                    </li>
                    <li class="text-slate-400">/</li>
                    <li class="text-slate-900 font-semibold">{{ $product->name }}</li>
                </ol>
            </nav>

            <!-- Main Product Detail Card -->
            <div class="bg-white rounded-[2.5rem] overflow-hidden shadow-2xl shadow-slate-200 border border-slate-100 mb-24" data-aos="fade-up">
                <div class="flex flex-col md:flex-row gap-8 lg:gap-20 p-10 lg:p-16 items-start product-layout-container">
                    
                    <!-- LEFT COLUMN: Image (Width 5/12 on Desktop) -->
                    <div class="w-full md:w-5/12 flex-shrink-0 flex flex-col product-image-column">
                        <div class="flex items-center justify-center bg-slate-50 rounded-2xl p-6 border border-slate-100 relative overflow-hidden h-[400px] lg:h-[500px]">
                            <img 
                                src="{{ asset('images/' . $product->image_url) }}" 
                                alt="{{ $product->name }}" 
                                class="w-full h-full object-contain drop-shadow-xl z-10 relative"
                            >
                            <!-- Decorative background element -->
                            <div class="absolute inset-0 bg-gradient-to-tr from-slate-100/50 to-white/0 z-0"></div>
                        </div>
                    </div>

                    <!-- RIGHT COLUMN: Details & Actions (Width 7/12 on Desktop) -->
                    <div class="w-full md:w-7/12 flex flex-col gap-8 product-details-column">
                        <!-- Header Info -->
                        <div style="padding-left: 20px; padding-top: 24px;">
                            <div class="flex items-center gap-3 mb-4">
                                <span class="px-4 py-1.5 bg-indigo-50 text-indigo-700 rounded-full text-xs font-bold uppercase tracking-wider border border-indigo-100">
                                    {{ $product->category->name }}
                                </span>
                                @if($product->stock > 0)
                                    <span class="px-4 py-1.5 bg-emerald-50 text-emerald-700 rounded-full text-xs font-bold uppercase tracking-wider border border-emerald-100">
                                        In Stock
                                    </span>
                                @else
                                    <span class="px-4 py-1.5 bg-rose-50 text-rose-700 rounded-full text-xs font-bold uppercase tracking-wider border border-rose-100">
                                        Out of Stock
                                    </span>
                                @endif
                            </div>

                            <h1 class="text-4xl lg:text-5xl font-serif font-bold text-slate-900 leading-tight mb-2">
                                {{ $product->name }}
                            </h1>
                            
                            <!-- Rating Mockup -->
                            <div class="flex items-center gap-2 mb-4">
                                <div class="flex text-amber-400">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                </div>
                                <span class="text-sm text-slate-400 font-medium">(4 Verified Reviews)</span>
                            </div>

                            <div class="text-sm font-medium text-slate-500">
                                SKU: <span class="text-slate-900">KAZ-{{ str_pad($product->id, 5, '0', STR_PAD_LEFT) }}</span>
                            </div>
                        </div>

                        <!-- Price -->
                        <div class="py-6 border-t border-b border-slate-100 flex items-center justify-between" style="padding-left: 20px;">
                            <div class="flex items-baseline space-x-1">
                                <span class="text-5xl font-black text-[#78350f]">${{ number_format($product->price, 2) }}</span>
                                <span class="text-lg text-slate-400 font-medium">USD</span>
                            </div>
                        </div>

                        <!-- Quantity & Buttons -->
                        @if($product->stock > 0)
                        <div class="space-y-8 pt-8" style="padding-top: 32px; padding-bottom: 24px; padding-left: 20px;">
                            <!-- Quantity -->
                            <div class="flex items-center gap-12" style="margin-bottom: 32px;">
                                <span class="text-sm font-bold text-slate-700 uppercase tracking-wider">Quantity</span>
                                <div class="flex items-center bg-white border-2 border-slate-100 rounded-xl p-1 shadow-sm" style="margin-left: 20px;">
                                    <button type="button" onclick="decreaseQuantity()" class="w-10 h-10 rounded-lg hover:bg-slate-100 text-slate-600 hover:text-[#78350f] font-bold flex items-center justify-center transition-all" style="margin-right: 20px;">−</button>
                                    <input type="number" id="quantity" value="1" min="1" max="{{ $product->stock }}" class="w-14 text-center font-bold text-lg bg-transparent border-0 focus:ring-0 p-0 text-slate-900 mx-2" readonly>
                                    <button type="button" onclick="increaseQuantity({{ $product->stock }})" class="w-10 h-10 rounded-lg hover:bg-slate-100 text-slate-600 hover:text-[#78350f] font-bold flex items-center justify-center transition-all" style="margin-left: 20px;">+</button>
                                </div>
                            </div>

                            <!-- Buttons -->
                            <div class="flex flex-col gap-4" style="display: flex; flex-direction: column; gap: 16px;">
                                
                                <!-- Auth Error Message removed, replaced with Modal -->

                                <form action="{{ route('checkout.process') }}" method="POST" class="w-full" onsubmit="return handleBuyNow(event)">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" id="buyNowQuantity" value="1">
                                    <button 
                                        type="submit" 
                                        class="w-full rounded-xl shadow-lg transition-all text-base uppercase tracking-wide flex items-center justify-center gap-2"
                                        style="background-color: #78350f !important; color: white !important; font-weight: bold; width: 100%; max-width: 350px; padding: 12px 24px;"
                                    >
                                        <span>Buy Now</span>
                                    </button>
                                </form>
                                
                                <button type="button" onclick="handleAddToCart()" class="w-full rounded-xl transition-all text-base uppercase tracking-wide" style="background-color: white !important; color: #78350f !important; border: 2px solid #78350f !important; font-weight: bold; width: 100%; max-width: 350px; padding: 12px 24px;">
                                    Add to Cart
                                </button>
                            </div>

                            <script>
                                function handleBuyNow(e) {
                                    document.getElementById('buyNowQuantity').value = document.getElementById('quantity').value;
                                    @guest
                                        e.preventDefault();
                                        window.location.href = "{{ route('login') }}";
                                        return false;
                                    @endguest
                                    return true;
                                }

                                function handleAddToCart() {
                                    @guest
                                        window.location.href = "{{ route('login') }}";
                                    @else
                                        const productId = "{{ $product->id }}";
                                        const quantity = document.getElementById('quantity').value;
                                        
                                        fetch("{{ route('cart.add') }}", {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/json',
                                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                            },
                                            body: JSON.stringify({
                                                product_id: productId,
                                                quantity: quantity
                                            })
                                        })
                                        .then(response => response.json())
                                        .then(data => {
                                            if(data.success) {
                                                // Update cart count in navbar
                                                document.getElementById('cart-count').innerText = data.cart_count;
                                                alert('Item added to cart!');
                                            }
                                        })
                                        .catch(error => {
                                            console.error('Error:', error);
                                            alert('Failed to add item to cart.');
                                        });
                                    @endguest
                                }
                            </script>
                        </div>
                        @else
                            <div class="pt-4">
                                <button disabled class="w-full py-4 px-8 bg-slate-200 text-slate-400 font-bold rounded-xl cursor-not-allowed">
                                    Copiy Unavailable
                                </button>
                            </div>
                        @endif

                        <!-- Features -->
                        <div class="mt-4 bg-slate-50 p-6 rounded-2xl border border-slate-100">
                            <h4 class="font-bold text-slate-900 mb-4 pb-2 border-b border-slate-200">Why Buy From Us?</h4>
                            <div class="space-y-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600 flex-shrink-0">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-900 text-sm">100% Authentic Product</p>
                                        <p class="text-slate-500 text-xs">Quality guaranteed direct from source</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 flex-shrink-0">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-900 text-sm">Free Shipping</p>
                                        <p class="text-slate-500 text-xs">On all orders over $50</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-purple-100 flex items-center justify-center text-purple-600 flex-shrink-0">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-900 text-sm">30-Day Returns</p>
                                        <p class="text-slate-500 text-xs">Money back guarantee if not satisfied</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Full Width Description Section (moved from left col) -->
                <div class="border-t border-slate-100 bg-slate-50/50" style="padding-left: 100px; padding-right: 40px; padding-top: 40px; padding-bottom: 40px;">
                    <div class="max-w-4xl mx-auto">
                        <h3 class="text-2xl font-serif font-bold text-slate-900 mb-6 flex items-center gap-3">
                            <span class="w-1 h-8 bg-[#78350f] rounded-full"></span>
                            Product Description
                        </h3>
                        <div class="prose prose-slate max-w-none text-slate-600 leading-relaxed text-lg">
                            <p class="mb-6 font-medium text-slate-800">{{ $product->description }}</p>
                        </div>
                    </div>
                </div>
            </div>

            @if($relatedProducts->count() > 0)
            <!-- Related Products Section -->
            <div class="mb-24">
                <div class="text-center mb-12">
                    <h3 class="text-3xl lg:text-4xl font-serif font-bold text-slate-900 mb-3">You Might Also Like</h3>
                    <p class="text-slate-500">Explore more amazing products from our collection</p>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach($relatedProducts as $related)
                    <div class="group relative bg-white border border-slate-100 rounded-3xl overflow-hidden transition-all duration-500 hover:shadow-2xl hover:shadow-slate-200 hover:-translate-y-2">
                        <div class="relative h-56 overflow-hidden bg-gradient-to-br from-slate-50 to-slate-100 p-6">
                            <img 
                                src="{{ asset('images/' . $related->image_url) }}" 
                                alt="{{ $related->name }}" 
                                style="
                                    width: 100%;
                                    height: 100%;
                                    object-fit: contain;
                                    transition: transform 0.7s ease;
                                "
                                onmouseover="this.style.transform='scale(1.1)'"
                                onmouseout="this.style.transform='scale(1)'"
                            >
                        </div>
                        <div class="p-6">
                            <h4 class="text-lg font-bold text-slate-900 mb-2 line-clamp-2">{{ $related->name }}</h4>
                            <div class="flex justify-between items-center pt-4 border-t border-slate-50">
                                <span class="text-xl font-bold text-[#78350f]">${{ number_format($related->price, 2) }}</span>
                                <a 
                                    href="{{ route('products.show', $related->id) }}" 
                                    class="text-sm font-bold text-slate-400 hover:text-[#78350f] transition-colors uppercase tracking-wider"
                                >
                                    View →
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <script>
            function increaseQuantity(maxStock) {
                const quantityInput = document.getElementById('quantity');
                let currentValue = parseInt(quantityInput.value);
                if (currentValue < maxStock) {
                    quantityInput.value = currentValue + 1;
                }
            }

            function decreaseQuantity() {
                const quantityInput = document.getElementById('quantity');
                let currentValue = parseInt(quantityInput.value);
                if (currentValue > 1) {
                    quantityInput.value = currentValue - 1;
                }
            }
        </script>
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
