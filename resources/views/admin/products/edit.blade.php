<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Product') }}
        </h2>
    </x-slot>

    <div class="py-12" style="background-color: #faf8f5; min-height: 100vh;">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-[#f5f1e8]">
                <div class="p-8">
                    <div class="mb-8">
                        <a href="{{ route('admin.products.index') }}" class="text-sm font-bold text-[#78350f] hover:underline flex items-center gap-2">
                             ← Back to Products
                        </a>
                        <h3 class="text-2xl font-bold text-slate-900 mt-4">Edit Product: {{ $product->name }}</h3>
                        <p class="text-slate-500 text-sm mt-1">Update the product information and click save.</p>
                    </div>

                    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">Product Name</label>
                                <input type="text" name="name" value="{{ old('name', $product->name) }}" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:bg-white focus:border-[#78350f] focus:ring-2 focus:ring-[#78350f]/10 transition-all">
                                @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">Category</label>
                                <select name="category_id" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:bg-white focus:border-[#78350f] focus:ring-2 focus:ring-[#78350f]/10 transition-all">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Price ($)</label>
                            <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:bg-white focus:border-[#78350f] focus:ring-2 focus:ring-[#78350f]/10 transition-all">
                            @error('price')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Quantity in Stock</label>
                            <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:bg-white focus:border-[#78350f] focus:ring-2 focus:ring-[#78350f]/10 transition-all">
                            @error('stock')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Description</label>
                            <textarea name="description" rows="4" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:bg-white focus:border-[#78350f] focus:ring-2 focus:ring-[#78350f]/10 transition-all">{{ old('description', $product->description) }}</textarea>
                            @error('description')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Product Image (Leave empty to keep current)</label>
                            <div class="flex items-center gap-6 p-4 rounded-xl bg-slate-50 border border-slate-100">
                                <div class="w-20 h-20 rounded-lg overflow-hidden flex-shrink-0">
                                    <img src="{{ asset('images/' . $product->image_url) }}" alt="Current Image" class="w-full h-full object-cover">
                                </div>
                                <div class="flex-grow">
                                    <input name="image" type="file" class="text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#78350f] file:text-white hover:file:bg-[#78350f]/90">
                                </div>
                            </div>
                            @error('image')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="flex justify-end mt-8">
                            <button type="submit" class="px-10 py-4 rounded-xl text-white font-bold shadow-xl shadow-[#78350f]/20 hover:scale-105 active:scale-95 transition-all" style="background-color: #78350f;">
                                Update Product
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
