@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 focus:border-[#78350f] focus:ring-[#78350f] rounded-md shadow-sm']) }}>
