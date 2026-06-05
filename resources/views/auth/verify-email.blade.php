<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        Gracias por registrarte. Antes de continuar, verifica tu correo con el enlace que te enviamos. Si no lo recibiste, podemos enviarte uno nuevo.
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            Enviamos un nuevo enlace de verificacion a tu correo.
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    Reenviar correo
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 hover:text-[#0A4D2E] rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#6BBF8B]">
                Cerrar sesion
            </button>
        </form>
    </div>
</x-guest-layout>
