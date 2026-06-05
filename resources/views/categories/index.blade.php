<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="text-xl font-semibold text-gray-900">Categorias</h2>
            <a href="{{ route('categories.create') }}" class="inline-flex justify-center rounded-md bg-[#0A4D2E] px-4 py-2 text-sm font-medium text-white hover:bg-[#0F623D]">Nueva categoria</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-4xl space-y-5 px-4 sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="rounded-md border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">{{ session('status') }}</div>
            @endif

            @if ($errors->any())
                <div class="rounded-md border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">{{ $errors->first() }}</div>
            @endif

            <div class="overflow-hidden rounded-lg border border-gray-200 bg-white">
                <div class="divide-y divide-gray-100">
                    @forelse ($categories as $category)
                        <div class="flex flex-col gap-3 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">
                            <div>
                                <p class="font-medium text-gray-900">{{ $category->name }}</p>
                                <p class="text-sm text-gray-500">{{ $category->purchases_count }} compras</p>
                            </div>
                            <div class="flex items-center gap-3">
                                <a href="{{ route('categories.edit', $category) }}" class="text-sm font-medium text-[#0A4D2E] hover:text-[#0F623D]">Editar</a>
                                <form method="POST" action="{{ route('categories.destroy', $category) }}" onsubmit="return confirm('Eliminar esta categoria?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-sm font-medium text-red-700 hover:text-red-900">Eliminar</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="px-5 py-8 text-sm text-gray-500">No hay categorias registradas.</div>
                    @endforelse
                </div>
            </div>

            {{ $categories->links() }}
        </div>
    </div>
</x-app-layout>
