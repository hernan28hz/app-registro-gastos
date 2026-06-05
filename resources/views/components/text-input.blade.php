@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 focus:border-[#0A4D2E] focus:ring-[#6BBF8B] rounded-md shadow-sm']) }}>
