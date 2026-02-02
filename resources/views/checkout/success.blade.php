<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Order Confirmed - Kazoku Pet Store</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Outfit', sans-serif; }
        .font-serif { font-family: 'Playfair Display', serif; }
        .glass { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2); }
    </style>
</head>
<body class="antialiased bg-slate-50 text-slate-900 flex flex-col min-h-screen">
    <!-- Navbar -->
    <nav class="fixed w-full z-50 glass py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <a href="/" class="flex items-center gap-3 group relative z-50">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="transition-transform duration-300 group-hover:scale-110" style="width: 48px; height: 48px; object-fit: contain;">
                <div class="flex flex-col">
                    <span class="text-2xl font-black tracking-tighter text-slate-900">KAZOKU</span>
                    <span class="text-[10px] font-bold tracking-[0.4em] text-slate-500 uppercase -mt-1">Pet Store</span>
                </div>
            </a>
            <div class="flex items-center space-x-6">
                <a href="/" class="text-slate-600 hover:text-[#78350f] text-sm font-bold">Home</a>
                <a href="{{ route('products.index') }}" class="text-slate-600 hover:text-[#78350f] text-sm font-bold">Shop</a>
            </div>
        </div>
    </nav>

    <main class="flex-grow flex items-center">
        <div class="pt-48 pb-24 w-full px-4 sm:px-6 lg:px-8 text-center">
        <div class="max-w-2xl mx-auto bg-white rounded-[3rem] p-12 shadow-2xl shadow-slate-200 border border-slate-100" data-aos="zoom-in" data-aos-duration="1000">
            <div class="w-20 h-20 bg-emerald-50 text-emerald-500 rounded-full flex items-center justify-center mx-auto mb-8">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            </div>
            <h1 class="text-4xl font-serif font-bold text-slate-900 mb-4">Order Confirmed!</h1>
            <p class="text-slate-500 mb-8 leading-relaxed">Thank you for your purchase. We've received your order and are getting it ready for shipment. Your furry friend will be happy soon!</p>
            
            <div class="space-y-4 mb-10">
                @foreach($items as $item)
                <div class="bg-slate-50 rounded-2xl p-4 flex items-center gap-4 text-left border border-slate-100">
                    <div class="w-16 h-16 bg-white rounded-xl overflow-hidden p-1 flex-shrink-0">
                        <img src="{{ Str::startsWith($item['image'], 'data:') ? $item['image'] : asset('images/' . $item['image']) }}" alt="{{ $item['name'] }}" class="w-full h-full object-contain">
                    </div>
                    <div class="flex-grow">
                        <h4 class="font-bold text-slate-900">{{ $item['name'] }}</h4>
                        <p class="text-slate-400 text-sm">Quantity: {{ $item['quantity'] }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-[#78350f] font-black">${{ number_format($item['price'] * $item['quantity'], 2) }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="pt-6 border-t border-slate-100 mb-10 flex justify-between items-center text-slate-900">
                <span class="text-xl font-bold">Total Paid</span>
                <span class="text-3xl font-black text-[#78350f]">${{ number_format($totalAmount, 2) }}</span>
            </div>

            <div class="flex flex-col space-y-4">
                <a href="{{ route('products.index') }}" class="w-full py-4 bg-[#78350f] text-white font-bold rounded-2xl hover:scale-[1.02] active:scale-[0.98] transition-all shadow-xl shadow-[#78350f]/20">Continue Shopping</a>
                <a href="{{ url('/dashboard') }}" class="w-full py-4 bg-white border border-slate-200 text-slate-600 font-bold rounded-2xl hover:bg-slate-50 transition-all">Go to My Dashboard</a>
            </div>
        </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="py-20 bg-white border-t border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-slate-400 text-sm">
            &copy; {{ date('Y') }} Kazoku Pet Store. All rights reserved.
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
