@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-[#0A4D2E] text-sm font-medium leading-5 text-[#0A4D2E] focus:outline-none focus:border-[#0F623D] transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-600 hover:text-[#0A4D2E] hover:border-[#6BBF8B] focus:outline-none focus:text-[#0A4D2E] focus:border-[#6BBF8B] transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
