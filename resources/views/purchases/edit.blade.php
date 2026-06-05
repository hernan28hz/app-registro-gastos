<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-900">Editar compra</h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('purchases.update', $purchase) }}" class="space-y-6 rounded-lg border border-gray-200 bg-white p-5">
                @method('PUT')
                @include('purchases._form')
            </form>
        </div>
    </div>
</x-app-layout>
