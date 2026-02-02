@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-[#78350f] text-start text-base font-bold text-[#78350f] bg-[#78350f]/5 focus:outline-none focus:text-[#78350f] focus:bg-[#78350f]/10 focus:border-[#78350f] transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-bold text-slate-600 hover:text-[#78350f] hover:bg-slate-50 hover:border-[#78350f]/30 focus:outline-none focus:text-slate-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
