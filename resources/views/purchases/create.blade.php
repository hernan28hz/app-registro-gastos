<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-900">Nueva compra</h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            @if ($categories->isEmpty())
                <div class="rounded-lg border border-yellow-200 bg-yellow-50 p-4 text-sm text-yellow-900">
                    Primero crea una categoria para registrar compras.
                    <a href="{{ route('categories.create') }}" class="font-semibold underline">Crear categoria</a>
                </div>
            @else
                <form method="POST" action="{{ route('purchases.store') }}" class="space-y-6 rounded-lg border border-gray-200 bg-white p-5">
                    @include('purchases._form')
                </form>
            @endif
        </div>
    </div>
</x-app-layout>
