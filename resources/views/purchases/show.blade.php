<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="text-xl font-semibold text-gray-900">{{ $purchase->title }}</h2>
            <a href="{{ route('purchases.edit', $purchase) }}" class="inline-flex justify-center rounded-md bg-[#0A4D2E] px-4 py-2 text-sm font-medium text-white hover:bg-[#0F623D]">Editar</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-3xl space-y-5 px-4 sm:px-6 lg:px-8">
            <div class="rounded-lg border border-gray-200 bg-white p-5">
                <dl class="grid gap-5 sm:grid-cols-2">
                    <div>
                        <dt class="text-sm text-gray-500">Categoria</dt>
                        <dd class="mt-1 font-medium text-gray-900">{{ $purchase->category->name }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">Valor COP</dt>
                        <dd class="mt-1 font-medium text-gray-900">{{ $purchase->formatted_amount }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">Fecha</dt>
                        <dd class="mt-1 font-medium text-gray-900">{{ $purchase->purchase_date->format('Y-m-d') }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">Proveedor</dt>
                        <dd class="mt-1 font-medium text-gray-900">{{ $purchase->provider ?: '-' }}</dd>
                    </div>
                    <div class="sm:col-span-2">
                        <dt class="text-sm text-gray-500">Metodo de pago</dt>
                        <dd class="mt-1 font-medium text-gray-900">{{ $purchase->payment_method ?: '-' }}</dd>
                    </div>
                    <div class="sm:col-span-2">
                        <dt class="text-sm text-gray-500">Descripcion</dt>
                        <dd class="mt-1 whitespace-pre-line text-gray-900">{{ $purchase->description ?: '-' }}</dd>
                    </div>
                </dl>
            </div>

            <form method="POST" action="{{ route('purchases.destroy', $purchase) }}" onsubmit="return confirm('Eliminar esta compra?')">
                @csrf
                @method('DELETE')
                <button class="rounded-md border border-red-200 bg-white px-4 py-2 text-sm font-medium text-red-700 hover:bg-red-50">Eliminar compra</button>
            </form>
        </div>
    </div>
</x-app-layout>
