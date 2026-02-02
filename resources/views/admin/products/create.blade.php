<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Product') }}
        </h2>
    </x-slot>

    <div class="py-12" style="background-color: #faf8f5; min-height: 100vh;">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-[#f5f1e8]">
                <div style="padding: 2rem 3rem;">
                    <div class="border-b border-slate-100 flex items-center justify-between" style="margin-bottom: 2rem; padding-bottom: 1.5rem;">
                        <div>
                            <h3 class="text-3xl font-bold text-slate-900">Add Product</h3>
                        </div>
                        <a href="{{ route('admin.products.index') }}" class="text-sm font-bold text-[#78350f] hover:underline flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-[#78350f]/5 transition-colors">
                             ← Back to Products
                        </a>
                    </div>

                    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 2rem;">
                        @csrf

                        <!-- Section 1: Basic Info -->
                        <div class="space-y-6">
                            <h4 class="text-lg font-bold text-slate-900" style="border-left: 4px solid #78350f; padding-left: 0.75rem;">Basic Information</h4>
                            <div class="grid grid-cols-1" style="display: grid; gap: 1.5rem;">
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Product Name</label>
                                    <input type="text" name="name" value="{{ old('name') }}" required class="w-full rounded-xl border border-slate-200 focus:bg-white focus:border-[#78350f] focus:ring-2 focus:ring-[#78350f]/10 transition-all font-medium" style="padding: 0.75rem 1rem;" placeholder="E.g. Premium Fish Flakes">
                                    @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2" style="display: grid; gap: 1.5rem;">
                                    <div>
                                        <label class="block text-sm font-bold text-slate-700 mb-2">Category</label>
                                        <select name="category_id" required class="w-full rounded-xl border border-slate-200 focus:bg-white focus:border-[#78350f] focus:ring-2 focus:ring-[#78350f]/10 transition-all font-medium bg-slate-50/50" style="padding: 0.75rem 1rem;">
                                            <option value="">Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Description</label>
                                    <textarea name="description" rows="5" required class="w-full rounded-xl border border-slate-200 focus:bg-white focus:border-[#78350f] focus:ring-2 focus:ring-[#78350f]/10 transition-all font-medium" style="padding: 0.75rem 1rem;" placeholder="Describe your product detail...">{{ old('description') }}</textarea>
                                    @error('description')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                                </div>
                            </div>
                        </div>

                        <!-- Section 2: Pricing & Inventory -->
                        <div class="space-y-6">
                            <h4 class="text-lg font-bold text-slate-900" style="border-left: 4px solid #78350f; padding-left: 0.75rem;">Pricing & Inventory</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2" style="display: grid; gap: 1.5rem;">
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Price</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <span class="text-slate-400 font-bold">$</span>
                                        </div>
                                        <input type="number" step="0.01" name="price" value="{{ old('price') }}" required class="w-full pl-10 rounded-xl border border-slate-200 focus:bg-white focus:border-[#78350f] focus:ring-2 focus:ring-[#78350f]/10 transition-all font-medium" style="padding-top: 0.75rem; padding-bottom: 0.75rem; padding-right: 1rem;" placeholder="0.00">
                                    </div>
                                    @error('price')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Stock Quantity</label>
                                    <input type="number" name="stock" value="{{ old('stock', 0) }}" required class="w-full rounded-xl border border-slate-200 focus:bg-white focus:border-[#78350f] focus:ring-2 focus:ring-[#78350f]/10 transition-all font-medium" style="padding: 0.75rem 1rem;" placeholder="0">
                                    @error('stock')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                                </div>
                            </div>
                        </div>

                        <!-- Section 3: Media -->
                        <div class="space-y-6">
                            <h4 class="text-lg font-bold text-slate-900" style="border-left: 4px solid #78350f; padding-left: 0.75rem;">Product Media</h4>
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">Product Image</label>
                                <div class="mt-2 flex justify-center px-6 pt-10 pb-10 border-2 border-slate-200 border-dashed rounded-2xl hover:border-[#78350f] hover:bg-[#78350f]/5 transition-all group cursor-pointer bg-slate-50/50">
                                    <div class="space-y-2 text-center">
                                        <div class="mx-auto w-16 h-16 rounded-full bg-slate-100 flex items-center justify-center group-hover:bg-white group-hover:shadow-md transition-all">
                                            <svg style="width: 32px; height: 32px;" class="text-slate-400 group-hover:text-[#78350f]" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v10m-12 12l.01.01" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </div>
                                        <div class="flex text-sm text-slate-600 justify-center">
                                            <label class="relative font-bold shadow-md hover:scale-[1.02] transition-transform" style="background-color: #78350f; color: white; padding: 0.75rem 2rem; border-radius: 9999px; display: inline-block; cursor: pointer; margin-bottom: 0.5rem;">
                                                <span>Click to upload</span>
                                                <input name="image" type="file" required class="sr-only">
                                            </label>
                                        </div>
                                        <p class="text-center text-xs text-slate-500" style="text-align: center;">PNG, JPG, GIF up to 2MB</p>
                                    </div>
                                </div>
                                @error('image')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <div class="pt-8 border-t border-slate-100 flex justify-end">
                            <button type="submit" class="rounded-full text-white font-bold text-lg shadow-xl shadow-[#78350f]/20 hover:scale-[1.02] active:scale-[0.98] transition-all" style="background-color: #78350f; padding: 1rem 3rem; margin-top: 1rem; margin-bottom: 0;">
                                Save Product
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
