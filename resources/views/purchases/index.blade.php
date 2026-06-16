<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="text-xl font-semibold text-gray-900">Compras</h2>
            <div class="flex flex-col gap-2 sm:flex-row">
                <a href="{{ route('purchases.export') }}" class="inline-flex justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Exportar Excel</a>
                <a href="{{ route('purchases.create') }}" class="inline-flex justify-center rounded-md bg-[#0A4D2E] px-4 py-2 text-sm font-medium text-white hover:bg-[#0F623D]">Nueva compra</a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl space-y-5 px-4 sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="rounded-md border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">{{ session('status') }}</div>
            @endif

            <form method="GET" class="grid gap-3 rounded-lg border border-gray-200 bg-white p-4 sm:grid-cols-[1fr_220px_auto]">
                <input name="search" value="{{ request('search') }}" placeholder="Buscar por titulo o proveedor" class="rounded-md border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900">
                <select name="category_id" class="rounded-md border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900">
                    <option value="">Todas las categorias</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected((int) request('category_id') === $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
                <button class="rounded-md bg-[#0A4D2E] px-4 py-2 text-sm font-medium text-white hover:bg-[#0F623D]">Filtrar</button>
            </form>

            <div class="overflow-hidden rounded-lg border border-gray-200 bg-white">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-500">Compra</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-500">Categoria</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-500">Fecha</th>
                                <th class="px-4 py-3 text-right text-xs font-semibold uppercase text-gray-500">Valor COP</th>
                                <th class="px-4 py-3 text-right text-xs font-semibold uppercase text-gray-500">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($purchases as $purchase)
                                <tr>
                                    <td class="px-4 py-3">
                                        <p class="font-medium text-gray-900">{{ $purchase->title }}</p>
                                        <p class="text-sm text-gray-500">{{ $purchase->provider ?: 'Sin proveedor' }}</p>
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-600">{{ $purchase->category->name }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-600">{{ $purchase->purchase_date->format('Y-m-d') }}</td>
                                    <td class="px-4 py-3 text-right font-medium text-gray-900">{{ $purchase->formatted_amount }}</td>
                                    <td class="px-4 py-3 text-right text-sm">
                                        <a href="{{ route('purchases.show', $purchase) }}" class="font-medium text-[#0A4D2E] hover:text-[#0F623D]">Ver</a>
                                        <a href="{{ route('purchases.edit', $purchase) }}" class="ms-3 font-medium text-[#0A4D2E] hover:text-[#0F623D]">Editar</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-8 text-center text-sm text-gray-500">No hay compras registradas.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{ $purchases->links() }}
        </div>
    </div>
</x-app-layout>
