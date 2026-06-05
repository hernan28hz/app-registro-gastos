<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-[#0A4D2E] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#0F623D] focus:bg-[#0F623D] active:bg-[#073D25] focus:outline-none focus:ring-2 focus:ring-[#6BBF8B] focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
