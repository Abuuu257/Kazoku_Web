<?php

use Livewire\Volt\Component;
use App\Models\Product;

new class extends Component
{
    public $search = '';

    public function with()
    {
        return [
            'results' => $this->search 
                ? Product::where('name', 'like', '%' . $this->search . '%')->limit(5)->get()
                : []
        ];
    }
};
?>

<div class="relative">
    <input 
        wire:model.live.debounce.300ms="search"
        type="text" 
        placeholder="Quick search products..." 
        class="w-full px-6 py-3 rounded-xl border-slate-100 bg-slate-50 focus:bg-white focus:border-[#78350f] focus:ring-0 transition-all text-sm"
    >
    
    @if(count($results) > 0)
        <div class="absolute z-50 w-full mt-2 bg-white rounded-xl shadow-2xl border border-slate-100 overflow-hidden">
            @foreach($results as $result)
                <a href="{{ route('products.show', $result->id) }}" class="flex items-center gap-3 p-3 hover:bg-slate-50 transition-colors">
                    <img src="{{ Str::startsWith($result->image_url, 'data:') ? $result->image_url : asset('images/' . $result->image_url) }}" class="w-10 h-10 object-contain bg-slate-100 rounded-lg">
                    <div>
                        <div class="font-bold text-slate-900 text-sm">{{ $result->name }}</div>
                        <div class="text-xs text-[#78350f]">${{ $result->price }}</div>
                    </div>
                </a>
            @endforeach
        </div>
    @elseif($search && count($results) == 0)
        <div class="absolute z-50 w-full mt-2 bg-white rounded-xl shadow-2xl border border-slate-100 p-4 text-center text-sm text-slate-500">
            No products found for "{{ $search }}"
        </div>
    @endif
</div>