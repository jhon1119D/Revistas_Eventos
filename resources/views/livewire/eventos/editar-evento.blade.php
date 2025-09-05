<div class="max-w-full mx-auto p-4">
            {{-- Buscar revistas --}}
            <livewire:buscador />
    <div class="overflow-x-auto">

        {{-- Alerta --}}
        <x-alert />


        <table class="min-w-full border border-gray-300 rounded-lg overflow-hidden shadow-sm">
            <thead class="bg-sky-900 text-white">
                <tr>
                    <th class="py-3 px-4 text-left">Título</th>
                    <th class="py-3 px-4 text-left">Acrónimo</th>
                    <th class="py-3 px-4 text-left">Ranking</th>
                    <th class="py-3 px-4 text-left">Enlace</th>
                    <th class="py-3 px-4 text-left">Fecha</th>
                    <th class="py-3 px-4 text-left">Fecha de Aceptación</th>
                    <th class="py-3 px-4 text-left">Fecha de Registro</th>
                    <th class="py-3 px-4 text-left">Archivo</th>
                    <th class="py-3 px-4 text-left">Acciones</th>
                </tr>
            </thead>

            <tbody class="bg-white">
                @foreach ($eventos as $evento)
                    <tr class="hover:bg-gray-100 transition-colors duration-300">
                        {{-- Título --}}
                        <td class="border-b border-gray-200 px-4 py-2">
                            @if ($editId === $evento->id)
                                <input type="text" wire:model.defer="formulario.titulo"
                                    class="w-full border rounded px-2 py-1 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                                @error('formulario.titulo')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            @else
                                {{ $evento->titulo }}
                            @endif
                        </td>

                        {{-- Acrónimo --}}
                        <td class="border-b border-gray-200 px-4 py-2">
                            @if ($editId === $evento->id)
                                <input type="text" wire:model.defer="formulario.acronimo"
                                    class="w-full border rounded px-2 py-1 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                                @error('formulario.acronimo')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            @else
                                {{ $evento->acronimo }}
                            @endif
                        </td>

                        {{-- Ranking --}}
                        <td class="border-b border-gray-200 px-4 py-2">
                            @if ($editId === $evento->id)
                                <select wire:model.defer="formulario.ranking"
                                    class="w-full border rounded px-2 py-1 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                    <option value="">--Elegir ranking--</option>
                                    <option value="A*">A*</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="Unranked">Unranked</option>
                                </select>
                                @error('formulario.ranking')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            @else
                                {{ $evento->ranking }}
                            @endif
                        </td>


                        {{-- Enlace --}}
                        <td class="border-b border-gray-200 px-4 py-2 break-all">
                            @if ($editId === $evento->id)
                                <input type="url" wire:model.defer="formulario.enlace"
                                    class="w-full border rounded px-2 py-1 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                                @error('formulario.enlace')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            @else
                                <a href="{{ $evento->enlace }}" target="_blank"
                                    class="text-green-500 hover:underline"><svg xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                        class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244" />
                                    </svg>
                                </a>
                            @endif
                        </td>

                        {{-- Fecha --}}
                        <td class="border-b border-gray-200 px-4 py-2">
                            @if ($editId === $evento->id)
                                <input type="date" wire:model.defer="formulario.fecha"
                                    class="w-full border rounded px-2 py-1 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                                @error('formulario.fecha')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            @else
                                {{ $evento->fecha }}
                            @endif
                        </td>

                        {{-- Fecha de Aceptación --}}
                        <td class="border-b border-gray-200 px-4 py-2">
                            @if ($editId === $evento->id)
                                <input type="date" wire:model.defer="formulario.fecha_aceptacion"
                                    class="w-full border rounded px-2 py-1 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                                @error('formulario.fecha_aceptacion')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            @else
                                {{ $evento->fecha_aceptacion ?? '—' }}
                            @endif
                        </td>

                        {{-- Fecha de Registro --}}
                        <td class="border-b border-gray-200 px-4 py-2">
                            @if ($editId === $evento->id)
                                <input type="date" wire:model.defer="formulario.fecha_registro"
                                    class="w-full border rounded px-2 py-1 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                                @error('formulario.fecha_registro')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            @else
                                {{ $evento->fecha_registro ?? '—' }}
                            @endif
                        </td>

                        {{-- Archivo --}}
                        <td class="border-b border-gray-200 px-4 py-2 text-center">
                            @if ($editId === $evento->id)
                                <input type="file" wire:model="archivoNuevo"
                                    class="w-full border rounded px-2 py-1 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                                @error('archivoNuevo')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            @else
                                @if (!empty($evento->documento_url))
                                    <div class="flex flex-col items-center">
                                        <a href="{{ asset('storage/' . $evento->documento_url) }}" target="_blank"
                                            class="text-blue-600 hover:underline">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 inline-block"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5m0 0l5-5m-5 5V4" />
                                            </svg>
                                        </a>
                                        <span class="text-xs text-gray-500 mt-1 truncate max-w-[100px]">
                                            {{ basename($evento->documento_url) }}
                                        </span>
                                    </div>
                                @else
                                    <span class="text-gray-500 italic">Sin archivo</span>
                                @endif
                            @endif
                        </td>

                        {{-- Acciones --}}
                        <td class="border-b border-gray-200 px-4 py-2 whitespace-nowrap">
                            @if ($editId === $evento->id)
                                <button wire:click="update"
                                    class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded mr-2 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                </button>
                                <button wire:click="cancelEdit"
                                    class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                </button>
                            @else
                                <button wire:click="edit({{ $evento->id }})"
                                    class="bg-yellow-600 hover:bg-yellow-700 text-white px-3 py-1 rounded mr-2 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </button>
                                <button wire:click="delete({{ $evento->id }})"
                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Paginación --}}
        <div class="mt-4">
            {{ $eventos->links() }}
        </div>
    </div>
</div>
