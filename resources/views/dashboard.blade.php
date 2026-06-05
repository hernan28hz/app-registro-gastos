<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="text-xl font-semibold text-[#1A1D20]">Panel</h2>
            <a href="{{ route('purchases.create') }}" class="inline-flex items-center justify-center rounded-md bg-[#0A4D2E] px-4 py-2 text-sm font-medium text-white hover:bg-[#0F623D]">
                Nueva compra
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="rounded-md border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">{{ session('status') }}</div>
            @endif

            <div class="grid gap-4 sm:grid-cols-2">
                <div class="rounded-lg border border-[#DDE7E1] bg-gradient-to-br from-[#0F623D] to-[#3E9B66] p-5 text-white">
                    <p class="text-sm text-white/80">Total gastado</p>
                    <p class="mt-2 text-3xl font-semibold text-white">$ {{ number_format($totalSpent, 0, ',', '.') }}</p>
                </div>
                <div class="rounded-lg border border-[#DDE7E1] bg-white p-5">
                    <p class="text-sm text-gray-500">Numero de compras</p>
                    <p class="mt-2 text-3xl font-semibold text-gray-900">{{ $purchaseCount }}</p>
                </div>
            </div>

            <div class="rounded-lg border border-gray-200 bg-white">
                <div class="flex items-center justify-between border-b border-gray-200 px-5 py-4">
                    <h3 class="font-semibold text-gray-900">Ultimas compras</h3>
                    <a href="{{ route('purchases.index') }}" class="text-sm font-medium text-[#0A4D2E] hover:text-[#0F623D]">Ver todas</a>
                </div>

                <div class="divide-y divide-gray-100">
                    @forelse ($latestPurchases as $purchase)
                        <a href="{{ route('purchases.show', $purchase) }}" class="block px-5 py-4 hover:bg-gray-50">
                            <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">
                                <div>
                                    <p class="font-medium text-gray-900">{{ $purchase->title }}</p>
                                    <p class="text-sm text-gray-500">{{ $purchase->category->name }} - {{ $purchase->purchase_date->format('Y-m-d') }}</p>
                                </div>
                                <p class="font-semibold text-gray-900">$ {{ number_format($purchase->amount, 0, ',', '.') }}</p>
                            </div>
                        </a>
                    @empty
                        <div class="px-5 py-8 text-sm text-gray-500">Aun no tienes compras registradas.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
