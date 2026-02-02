<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-slate-900 leading-tight">
                Welcome back, {{ auth()->user()->name }}! 👋
            </h2>
            <div class="text-sm text-slate-500">
                {{ now()->format('l, F j, Y') }}
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-8">
                <!-- Orders -->
                <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200 border border-slate-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-slate-50 to-white border-b border-slate-100" style="padding: 48px;">
                        <h4 class="text-2xl font-serif font-bold flex items-center space-x-4">
                            <div class="w-14 h-14 bg-[#78350f]/10 rounded-2xl flex items-center justify-center">
                                <svg class="w-7 h-7 text-[#78350f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                            </div>
                            <span class="text-slate-900">Your Orders</span>
                        </h4>
                    </div>
                    <div style="padding: 48px;">
                        @forelse($orders as $order)
                            <div class="bg-slate-50 rounded-3xl p-6 mb-6 border border-slate-100 hover:shadow-lg hover:shadow-slate-200 transition-all group">
                                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                                    <div>
                                        <div class="flex items-center gap-3 mb-2">
                                            <span class="px-3 py-1 bg-emerald-50 text-emerald-700 rounded-full text-xs font-bold uppercase tracking-wider">Completed</span>
                                            <span class="text-slate-400 text-sm font-medium">{{ $order->created_at->format('M d, Y') }}</span>
                                        </div>
                                        <p class="font-bold text-slate-900 text-xl group-hover:text-[#78350f] transition-colors">Order #{{ $order->id }}</p>
                                    </div>
                                    <div class="flex items-center gap-6">
                                        <span class="text-3xl font-black text-[#78350f]">${{ number_format($order->total_amount, 2) }}</span>
                                        <a href="#" class="w-12 h-12 rounded-full bg-white border border-slate-200 flex items-center justify-center text-slate-400 hover:text-[#78350f] hover:border-[#78350f] transition-all shadow-sm">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-20">
                                <div class="w-24 h-24 bg-[#78350f]/5 rounded-[2rem] mx-auto mb-6 flex items-center justify-center">
                                    <svg class="w-10 h-10 text-[#78350f]/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                </div>
                                <h3 class="text-2xl font-bold text-slate-900 mb-2">No orders yet</h3>
                                <p class="text-slate-500 mb-8 max-w-sm mx-auto">Looks like you haven't made any purchases yet. Discover our premium collection!</p>
                                <a href="{{ route('products.index') }}" 
                                   class="inline-flex items-center justify-center rounded-full font-bold transition-all shadow-xl shadow-[#78350f]/20 hover:scale-105" 
                                   style="background-color: #78350f; color: white; border: 2px solid #78350f; padding: 16px 48px; margin-top: 32px;"
                                   onmouseover="this.style.backgroundColor='white'; this.style.color='#78350f';"
                                   onmouseout="this.style.backgroundColor='#78350f'; this.style.color='white';">
                                    Start Shopping
                                </a>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Promo Banner -->
                @if($orders->count() > 0)

                <div class="bg-white rounded-[2.5rem] relative overflow-hidden shadow-xl shadow-slate-200 border border-slate-100 text-center" style="padding: 48px;">
                    <div class="absolute top-0 right-0 -mt-8 -mr-8 w-64 h-64 bg-[#78350f]/5 rounded-full blur-3xl"></div>
                    <div class="absolute bottom-0 left-0 -mb-8 -ml-8 w-64 h-64 bg-[#78350f]/5 rounded-full blur-3xl"></div>
                    
                    <div class="relative z-10 max-w-2xl mx-auto">
                        <h4 class="text-3xl font-serif font-bold mb-4 text-[#78350f]">Ready for something new?</h4>
                        <p class="text-slate-600 text-lg mb-8 leading-relaxed font-medium">
                            Explore our latest arrivals and treat your furry friend to something special today.
                        </p>
                        <a href="{{ route('products.index') }}" 
                           class="inline-flex items-center justify-center gap-3 rounded-full font-bold transition-all shadow-lg transform hover:-translate-y-1" 
                           style="background-color: #78350f; color: white; border: 2px solid #78350f; padding: 16px 64px; margin-top: 32px;"
                           onmouseover="this.style.backgroundColor='white'; this.style.color='#78350f';"
                           onmouseout="this.style.backgroundColor='#78350f'; this.style.color='white';">
                            <span>Browse Shop</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
