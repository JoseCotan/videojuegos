<x-app-layout>
    <div class="w-1/2 mx-auto">
        <form method="POST"
            action="{{ route('videojuegos.update', ['videojuego' => $videojuego]) }}">
            @csrf
            @method('PUT')

            <div>
                <x-input-label for="titulo" :value="'Título del videojuego'" />
                <x-text-input id="titulo" class="block mt-1 w-full"
                    type="text" name="titulo" :value="old('titulo', $videojuego->titulo)" required
                    autofocus autocomplete="titulo" />
                <x-input-error :messages="$errors->get('titulo')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="anyo" :value="'Año del videojuego'" />
                <x-text-input id="anyo" class="block mt-1 w-full"
                    type="text" name="anyo" :value="old('anyo', $videojuego->anyo)" required
                    autofocus autocomplete="anyo" />
                <x-input-error :messages="$errors->get('anyo')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="desarrolladora_id" :value="'Desarrolladoras'" />
                <select id="desarrolladora_id"
                class="border-grai-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"
                name="desarrolladora_id" required>
                @foreach ($desarrolladoras as $desarrolladora)
                    <option value="{{ $desarrolladora->id }}" {{ old('desarrolladora_id') == $desarrolladora->id ? 'selected' : '' }}>
                        {{ $desarrolladora->nombre }}
                    </option>
                @endforeach
            </select>
            </div>
            <div>
                <x-input-label for="distribuidora_id" :value="'Distribuidoras (No es necesario para la actualización del videojuego,
                                                                está puesto para el ejercicio 5. )'" />
                <select id="distribuidora_id"
                class="border-grai-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"
                name="distribuidora_id" required>
                @foreach ($distribuidoras as $distribuidora)
                    <option value="{{ $distribuidora->id }}" {{ old('distribuidora_id') == $distribuidora->id ? 'selected' : '' }}>
                        {{ $distribuidora->nombre }}
                    </option>
                @endforeach
            </select>
            </div>

            <div class="flex items-center justify-end mt-4">
                <a href="{{ route('videojuegos.index') }}">
                    <x-secondary-button class="ms-4">
                        Volver
                        </x-primary-button>
                </a>
                <x-primary-button class="ms-4">
                    Editar
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
