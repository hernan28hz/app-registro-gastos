@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-[#0A4D2E] text-start text-base font-medium text-[#0A4D2E] bg-[#EAF6EF] focus:outline-none focus:text-[#0F623D] focus:bg-[#DDF0E5] focus:border-[#0F623D] transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-600 hover:text-[#0A4D2E] hover:bg-[#EAF6EF] hover:border-[#6BBF8B] focus:outline-none focus:text-[#0A4D2E] focus:bg-[#EAF6EF] focus:border-[#6BBF8B] transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
