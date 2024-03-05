<x-app-layout>
    <div class="relative overflow-x-auto w-3/4 mx-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6">
                        Título del videojuego
                    </th>
                    <th scope="col" class="px-6">
                        Año del videojuego
                    </th>
                    <th scope="col" class="px-6">
                        Desarrolladora
                    </th>
                    <th scope="col" class="px-6">
                        Distribuidora
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Acción
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Borrar
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($videojuegos as $videojuego)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $videojuego->videojuego->titulo }}
                        </th>
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $videojuego->videojuego->anyo }}
                        </th>
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $videojuego->videojuego->desarrolladora->nombre }}
                        </th>
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $videojuego->videojuego->desarrolladora->distribuidora->nombre }}
                        </th>
                        <td class="px-6 py-4">
                            <a href="{{ route('videojuegos.edit', ['videojuego' => $videojuego->videojuego->id]) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                <x-primary-button>
                                    Editar
                                </x-primary-button>
                            </a>
                        </td>
                        <td class="px-6 py-4">
                            <form action="{{ route('videojuegos.destroy', ['videojuego' => $videojuego->videojuego]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <x-primary-button class="bg-red-500">
                                    Borrar
                                </x-primary-button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="relative overflow-x-auto w-3/4 mx-auto shadow-md sm:rounded-lg">
        <form action="{{ route('videojuegos.create') }}" class="flex justify-center mt-4 mb-4">
            <x-primary-button class="bg-green-500">Insertar un nuevo videojuego</x-primary-button>
        </form>
    </div>
</x-app-layout>
