<div class="rounded-lg shadow-md p-6 space-y-4">
    {{-- Alerta de que se guardó el evento --}}
    <x-alert />

    <div class="max-w-full mx-auto p-6 bg-sky-100 rounded-lg shadow-md mb-12">
        <h2 class="text-xl font-bold text-gray-900 mb-4 text-center">Categorías</h2>

        {{-- Formulario para nueva categoría --}}
        <div class="mb-12">
            <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">Nueva categoría</label>
            <div class="flex items-center gap-3">
                <input type="text" wire:model="nombre" id="nombre" placeholder="Ej. Tecnología, Cultura..."
                    class="flex-1 px-4 py-2 border border-black rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200" />
                <button wire:click="guardar"
                    class="inline-flex items-center px-4 py-2 bg-blue-700 text-white font-semibold rounded-md hover:bg-blue-600 transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Añadir
                </button>
            </div>

            @error('nombre')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        {{-- Lista de categorías existentes --}}
        <div>
            <h3 class="text-lg font-semibold text-gray-800 mb-3">Categorías existentes</h3>

            <ul class="divide-y divide-black">
                @forelse ($categorias as $cat)
                    <li class="flex items-center justify-between py-2">
                        <span class="text-gray-700 font-medium">{{ $cat->nombre }}</span>
                        <button wire:click="eliminar({{ $cat->id }})"
                            class="text-red-600 hover:text-red-800 transition duration-150">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                        </button>
                    </li>
                @empty
                    <li class="py-2 text-gray-500 italic">No hay categorías registradas.</li>
                @endforelse
            </ul>
        </div>
    </div>


    {{-- ------------------------------------------------------------------------- --}}
    <div class="max-w-full mx-auto p-6 bg-yellow-100 rounded-lg shadow-md mb-12">
        <h2 class="text-xl font-bold text-gray-900 mb-4 text-center">Usuarios administradores</h2>

        <ul class="divide-y divide-black">
            @forelse ($usuarios as $usuario)
                <li class="flex items-center justify-between py-4 px-3 bg-white rounded shadow-sm">

                    <div class=" flex justify-between w-full">
                        <span class="text-gray-800 font-medium">{{ $usuario->name }}</span>
                        <span class="text-gray-800 font-medium">{{ $usuario->email }}</span>
                    </div>
                    
                    
                   

                    <div class="flex items-center gap-3 ml-20">
                        {{-- Habilitar / Deshabilitar --}}
                        <button wire:click="toggleUserEstado({{ $usuario->id }})" @class([
                            'transition rounded flex items-center gap-2 px-3 py-2 text-sm font-semibold',
                            'bg-yellow-500 text-white hover:bg-yellow-600' => $usuario->activo,
                            'bg-green-500 text-white hover:bg-green-600' => !$usuario->activo,
                        ])>
                            @if ($usuario->activo)
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                                </svg>
                                Deshabilitar
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M22 10.5h-6m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM4 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 10.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                                </svg>
                                Habilitar
                            @endif
                        </button>

                        {{-- Eliminar usuario --}}
                        <button wire:click="eliminarUser({{ $usuario->id }})"
                            class="text-red-600 hover:text-red-800 transition duration-150">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                        </button>
                    </div>
                </li>
            @empty
                <li class="py-4 text-gray-500 italic text-center">No hay usuarios registrados.</li>
            @endforelse
        </ul>
    </div>

    {{-- ------------------------------------------------------------------------- --}}
    <div class="max-w-full mx-auto p-6 bg-indigo-100 rounded-lg shadow-md mb-12">
        <h2 class="text-xl font-bold text-gray-900 mb-4 text-center">Código de registro</h2>

        <div class="flex items-center gap-3">
            <input type="text" wire:model="codigoRegistro"
                class="flex-1 px-4 py-2 border border-black rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-200"
                placeholder="Ej. MI-CODIGO-SECRETO" />

            <button wire:click="actualizarCodigo"
                class="inline-flex items-center px-4 py-2 bg-indigo-700 text-white font-semibold rounded-md hover:bg-indigo-600 transition duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                Guardar
            </button>
        </div>

        @error('codigoRegistro')
            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
        @enderror
    </div>
</div>
