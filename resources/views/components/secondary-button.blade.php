<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-white border border-[#DDE7E1] rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-[#F4F6F5] focus:outline-none focus:ring-2 focus:ring-[#6BBF8B] focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
