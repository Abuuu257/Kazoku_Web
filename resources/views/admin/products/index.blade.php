<x-app-layout>
    <div class="min-h-screen bg-[#faf8f5] py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Page Header -->
            <div class="md:flex md:items-center md:justify-between mb-16">
                <div class="flex-1 min-w-0">
                    <h2 class="text-3xl font-serif font-bold text-slate-900 tracking-tight">
                        Product Management
                    </h2>
                    <p class="mt-2 text-sm text-slate-500">
                        Manage your catalog, prices, and inventory from one place.
                    </p>
                </div>

                <div class="mt-4 flex md:mt-0 md:ml-4">
                    <a href="{{ route('admin.products.create') }}" class="inline-flex items-center px-10 py-4 border-2 border-[#78350f] rounded-full shadow-sm text-sm font-bold text-[#78350f] bg-white hover:bg-[#78350f] hover:text-white focus:outline-none transition-all transform hover:-translate-y-0.5 shadow-lg shadow-[#78350f]/20">
                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Add New Product
                    </a>
                </div>
            </div>

            <!-- Content Card -->
            <div class="bg-white rounded-[2rem] shadow-xl shadow-slate-200/60 border border-slate-100 overflow-hidden">
                
                <!-- Toolbar -->
                <div class="p-6 border-b border-slate-50 bg-white flex flex-col sm:flex-row gap-4 justify-between items-start sm:items-center">
                    <div class="flex flex-col sm:flex-row gap-4 w-full sm:w-auto">
                        <div class="relative w-full sm:w-96">
                            <input type="text" placeholder="Search products..." class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl leading-5 bg-slate-50 text-slate-900 placeholder-slate-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-[#78350f]/20 focus:border-[#78350f] sm:text-sm transition-colors">
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-xs font-bold uppercase tracking-wider text-slate-400 whitespace-nowrap">Sort by:</span>
                            <select class="form-select block w-full pl-3 pr-8 py-2 text-sm font-medium border-slate-200 focus:outline-none focus:ring-[#78350f] focus:border-[#78350f] sm:text-sm rounded-xl bg-slate-50">
                                <option>Newest First</option>
                                <option>Price: Low to High</option>
                                <option>Price: High to Low</option>
                            </select>
                        </div>
                    </div>

                </div>

                <!-- Notifications -->
                @if(session('success'))
                    <div class="p-4 mx-6 mt-6 rounded-xl bg-emerald-50 border border-emerald-100 flex items-center gap-3">
                        <div class="flex-shrink-0 w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <p class="text-emerald-800 text-sm font-medium">{{ session('success') }}</p>
                    </div>
                @endif

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-100">
                        <thead class="bg-slate-50/50">
                            <tr>
                                <th scope="col" class="px-6 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-widest w-[120px]">Image</th>
                                <th scope="col" class="px-6 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-widest">Name</th>
                                <th scope="col" class="px-6 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-widest w-1/4">Description</th>
                                <th scope="col" class="px-6 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-widest">Stock</th>
                                <th scope="col" class="px-6 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-widest">Category</th>
                                <th scope="col" class="px-6 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-widest">Price</th>
                                <th scope="col" class="relative px-6 py-5">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-50">
                            @forelse($products as $product)
                            <tr class="group hover:bg-[#78350f]/[0.02] transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap align-middle">
                                    <div class="flex-shrink-0 bg-slate-100 rounded-xl overflow-hidden border border-slate-100 shadow-sm" style="width: 100px; height: 100px;">
                                        <img class="w-full h-full object-cover" src="{{ asset('images/' . $product->image_url) }}" alt="{{ $product->name }}">
                                    </div>
                                </td>
                                <td class="px-6 py-4 align-middle">
                                    <div class="text-base font-bold text-slate-900 group-hover:text-[#78350f] transition-colors">{{ $product->name }}</div>
                                </td>
                                <td class="px-6 py-4 align-middle">
                                    <div class="text-xs text-slate-400 leading-relaxed line-clamp-2 max-w-xs" title="{{ $product->description }}">{{ $product->description }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap align-middle">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold {{ $product->stock > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $product->stock }} in stock
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap align-middle">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-600 border border-slate-200">
                                        {{ $product->category->name }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap align-middle">
                                    <div class="text-base font-black text-slate-900">${{ number_format($product->price, 2) }}</div>
                                </td>
                                <td class="pl-6 pr-2 whitespace-nowrap text-right text-sm font-medium align-middle">
                                    <div class="flex items-center justify-end gap-2 opacity-100 sm:opacity-0 sm:group-hover:opacity-100 transition-opacity">
                                        <a href="{{ route('admin.products.edit', $product->id) }}" class="text-slate-400 hover:text-[#78350f] p-2 hover:bg-[#78350f]/5 rounded-lg transition-all" title="Edit">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                        </a>
                                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-slate-400 hover:text-red-600 p-2 hover:bg-red-50 rounded-lg transition-all" title="Delete">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-24 text-center">
                                    <div class="mx-auto h-24 w-24 rounded-full bg-slate-50 flex items-center justify-center mb-4">
                                        <svg class="h-10 w-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 00-2 2H6a2 2 0 00-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                    </div>
                                    <h3 class="text-lg font-medium text-slate-900">No products found</h3>
                                    <p class="mt-1 text-sm text-slate-500">Get started by adding a new product to your inventory.</p>
                                    <div class="mt-6">
                                        <a href="{{ route('admin.products.create') }}" class="inline-flex items-center px-6 py-3 border-2 border-[#78350f] shadow-sm text-sm font-bold rounded-xl text-[#78350f] bg-white hover:bg-[#78350f] hover:text-white transition-all transform hover:-translate-y-0.5">
                                            <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                            </svg>
                                            Add New Product
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                @if($products->hasPages())
                <div class="bg-white px-4 py-3 border-t border-slate-100 sm:px-6">
                    {{ $products->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
