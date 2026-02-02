<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Your Cart - Kazoku Pet Store</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body { font-family: 'Outfit', sans-serif; }
        .font-serif { font-family: 'Playfair Display', serif; }
        .nav-glass { background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); border-bottom: 1px solid rgba(0, 0, 0, 0.05); }
        .nav-link { position: relative; transition: all 0.3s; }
        .nav-link::after { content: ''; position: absolute; bottom: -4px; left: 0; width: 0; height: 2px; background: #78350f; transition: width 0.3s; }
        .nav-link:hover::after { width: 100%; }
        
        .quantity-btn {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            background: white;
            border: 1px solid #e2e8f0;
            transition: all 0.2s;
        }
        .quantity-btn:hover {
            background: #78350f;
            color: white;
            border-color: #78350f;
        }
    </style>
</head>
<body class="antialiased bg-slate-50 text-slate-900 flex flex-col" style="min-height: 100vh;">
    <!-- Navbar -->
    <nav style="position: fixed; top: 0; left: 0; right: 0; width: 100%; height: 90px; background-color: white; z-index: 1000; border-bottom: 2px solid #e2e8f0; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center w-full">
            <a href="/" class="flex items-center gap-3 group relative z-50">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="transition-transform duration-300 group-hover:scale-110" style="width: 48px; height: 48px; object-fit: contain;">
                <div class="flex flex-col">
                    <span class="text-2xl font-black tracking-tighter text-slate-900 transition-colors duration-300">KAZOKU</span>
                    <span class="text-[10px] font-bold tracking-[0.4em] text-slate-500 transition-colors duration-300 uppercase -mt-1">Pet Store</span>
                </div>
            </a>
            
            <div class="flex justify-around items-center text-sm font-bold uppercase tracking-widest text-slate-600 transition-colors duration-300" style="gap: 3rem;">
                <a href="{{ route('home') }}" class="nav-link hover:text-[#78350f]">Home</a>
                <a href="{{ route('products.index') }}" class="nav-link hover:text-[#78350f]">Products</a>
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
                @endauth
            </div>
        </div>
    </nav>

    <!-- Section Spacer -->
    <div style="height: 110px; width: 100%; display: block;"></div>

    <main class="flex-grow flex flex-col" style="flex: 1 0 auto;">
        @php $total = 0; @endphp
        
        @if(session('cart') && count(session('cart')) > 0)
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full py-12">
            <h1 class="text-4xl font-serif font-bold text-slate-900 mb-20">Shopping Cart</h1>
            
            <div class="lg:grid lg:grid-cols-12 lg:gap-12">
                <div class="lg:col-span-8">
                    <div class="space-y-6">
                        @foreach(session('cart') as $id => $details)
                            @php $total += ($details['price'] ?? 0) * ($details['quantity'] ?? 0) @endphp
                            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm flex items-center" style="padding: 40px; gap: 40px;" data-id="{{ $id }}">
                                <div class="flex-shrink-0 bg-slate-50 rounded-[2rem] overflow-hidden" style="width: 140px; height: 140px; padding: 16px;">
                                    <img src="{{ asset('images/' . $details['image']) }}" alt="{{ $details['name'] }}" class="w-full h-full object-contain">
                                </div>
                                
                                <div class="flex-grow">
                                    <div class="flex justify-between items-start">
                                        <h4 class="font-bold text-slate-900 text-sm leading-tight">{{ $details['name'] }}</h4>
                                        <button onclick="removeFromCart('{{ $id }}')" class="text-slate-400 hover:text-rose-500 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </div>
                                    <p class="text-[#78350f] font-black text-sm mb-2">${{ number_format($details['price'], 2) }}</p>
                                    
                                    <div class="flex items-center gap-3">
                                        <div class="flex items-center bg-slate-50 rounded-lg p-0.5 border border-slate-100">
                                            <button onclick="updateCart('{{ $id }}', {{ $details['quantity'] - 1 }})" class="quantity-btn" style="width: 24px; height: 24px; font-size: 12px;" {{ $details['quantity'] <= 1 ? 'disabled' : '' }}>−</button>
                                            <span class="w-8 text-center font-bold text-xs">{{ $details['quantity'] }}</span>
                                            <button onclick="updateCart('{{ $id }}', {{ $details['quantity'] + 1 }})" class="quantity-btn" style="width: 24px; height: 24px; font-size: 12px;">+</button>
                                        </div>
                                        <span class="text-slate-400 font-medium text-[11px]">Total: <span class="text-slate-900 font-bold">${{ number_format($details['price'] * $details['quantity'], 2) }}</span></span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="lg:col-span-4 mt-12 lg:mt-0">
                    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl lg:sticky lg:top-32" style="padding: 32px 64px;">
                        <h3 class="text-2xl font-serif font-bold text-slate-900 mb-8 pb-4 border-b border-slate-100">Order Summary</h3>
                        
                        <div class="space-y-4 mb-8">
                            <div class="flex justify-between text-slate-500 font-medium text-lg">
                                <span>Subtotal</span>
                                <span class="text-slate-900 font-bold">${{ number_format($total, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-slate-500 font-medium text-lg">
                                <span>Shipping</span>
                                <span class="text-emerald-600 font-bold uppercase tracking-wider text-sm">Free</span>
                            </div>
                            <div class="pt-4 border-t border-slate-100 flex justify-between items-center text-slate-900">
                                <span class="text-xl font-bold">Total</span>
                                <span class="text-3xl font-black text-[#78350f]">${{ number_format($total, 2) }}</span>
                            </div>
                        </div>

                        <form action="{{ route('checkout.process') }}" method="POST">
                            @csrf
                            @foreach(session('cart') as $id => $details)
                                <input type="hidden" name="cart_items[{{$id}}][product_id]" value="{{$id}}">
                                <input type="hidden" name="cart_items[{{$id}}][quantity]" value="{{$details['quantity']}}">
                            @endforeach
                            <input type="hidden" name="source" value="cart">
                            <button type="submit" class="w-full py-5 px-8 rounded-2xl bg-[#78350f] text-white font-bold text-lg shadow-xl shadow-[#78350f]/20 hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center justify-center gap-3">
                                <span>Proceed to Checkout</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            </div>
        @else
            <div class="flex-grow flex flex-col items-center justify-center text-center px-4 w-full" style="min-height: 50vh;">
                <div class="bg-[#78350f]/5 rounded-full flex items-center justify-center mb-8" style="width: 48px; height: 48px;">
                    <svg style="width: 24px; height: 24px; color: rgba(120, 53, 15, 0.3);" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </div>
                <h1 class="text-4xl font-serif font-bold text-slate-900 mb-4">Your cart is empty</h1>
                <p class="text-slate-500 mb-10 max-w-md mx-auto font-medium text-lg">Looks like you haven't added any treats for your pet yet!</p>
                <a href="{{ route('products.index') }}" class="inline-block text-white font-bold transition-all shadow-2xl shadow-[#78350f]/30 hover:scale-105 active:scale-95" style="background-color: #78350f; margin-top: 32px; margin-bottom: 60px; padding: 20px 56px; border-radius: 100px;">
                    Start Shopping
                </a>
            </div>
        @endif
    </main>

    <!-- Footer -->
    <footer style="background: linear-gradient(to bottom, #faf8f5, #f5f1e8); padding-top: 60px; padding-bottom: 30px; border-top: 2px solid #e7e3dc;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div style="margin-bottom: 40px;">
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

                <div style="margin-bottom: 32px;">
                    <h4 class="font-bold uppercase tracking-wider" style="color: #0f172a; font-size: 13px; margin-bottom: 16px;">Quick Links</h4>
                    <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-wrap: wrap; gap: 24px;">
                        <li><a href="{{ route('home') }}" style="color: #64748b; text-decoration: none; font-size: 14px; transition: color 0.3s;" onmouseover="this.style.color='#78350f';" onmouseout="this.style.color='#64748b';">Home</a></li>
                        <li><a href="{{ route('products.index') }}" style="color: #64748b; text-decoration: none; font-size: 14px; transition: color 0.3s;" onmouseover="this.style.color='#78350f';" onmouseout="this.style.color='#64748b';">Products</a></li>
                        <li><a href="{{ route('contact.index') }}" style="color: #64748b; text-decoration: none; font-size: 14px; transition: color 0.3s;" onmouseover="this.style.color='#78350f';" onmouseout="this.style.color='#64748b';">Contact Us</a></li>
                    </ul>
                </div>
            </div>

            <div style="padding-top: 24px; border-top: 1px solid #e7e3dc; text-align: center;">
                <p style="color: #94a3b8; font-size: 13px; margin: 0;">
                    &copy; {{ date('Y') }} Kazoku Pet Store. All rights reserved.
                </p>
            </div>
        </div>
    </footer>

    <script>
        function updateCart(id, quantity) {
            fetch("{{ route('cart.update') }}", {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    id: id,
                    quantity: quantity
                })
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    location.reload();
                }
            });
        }

        function removeFromCart(id) {
            if(confirm('Remove this item from your cart?')) {
                fetch("{{ route('cart.remove') }}", {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        id: id
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if(data.success) {
                        location.reload();
                    }
                });
            }
        }
    </script>
</body>
</html>
