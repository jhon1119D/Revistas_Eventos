<div class="container mx-auto px-4 py-6">

    {{-- Filtro de revistas y eventos --}}
    <livewire:buscador />


    {{-- Botones para cambiar vista --}}
    <div class="flex flex-wrap gap-4 mb-6">
        <button wire:click="cambiarVista('revistas')"
            class="flex items-center gap-2 px-5 py-2 rounded-lg transition-all duration-200
                   {{ $vistaActual === 'revistas' ? 'bg-sky-900 text-white shadow-md hover:bg-blue-700' : 'bg-white text-sky-900 border hover:bg-sky-100' }}">
            Ver Revistas
        </button>

        <button wire:click="cambiarVista('eventos')"
            class="flex items-center gap-2 px-5 py-2 rounded-lg transition-all duration-200
            {{ $vistaActual === 'eventos' ? 'bg-sky-900 text-white shadow-md hover:bg-blue-700' : 'bg-white text-sky-900 border hover:bg-sky-100' }}">
            Ver Eventos
        </button>
    </div>

    {{-- Vista de revistas --}}
    @if ($vistaActual === 'revistas' && $revistas && $revistas->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($revistas as $revista)
                <div
                    class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 p-6 border border-gray-100 relative">
                    <h2 class="text-xl font-semibold text-sky-900 mb-2">{{ $revista->nombre }}</h2>

                    <div class="absolute top-1 right-1">
                        @if ($revista->accesibilidad === 'no')
                            <span class="text-amber-500 text-xl" title="Acceso restringido"><svg
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                                </svg>
                            </span>
                        @else
                            <span class="text-amber-500 text-xl" title="Acceso abierto"><svg
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M13.5 10.5V6.75a4.5 4.5 0 1 1 9 0v3.75M3.75 21.75h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H3.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                                </svg>
                            </span>
                        @endif
                    </div>

                    <div class="text-sm text-gray-600 space-y-1">
                        <p><span class="font-medium">País:</span> {{ $revista->pais }}</p>
                        <p><span class="font-medium">Categoría:</span> {{ $revista->categoria->nombre }}</p>
                        <p><span class="font-medium">Clasificación:</span> {{ $revista->clasificacion }}</p>
                    </div>

                    <div class="mt-4 flex flex-wrap gap-2">
                        <a href="{{ $revista->enlace }}" target="_blank"
                            class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-sky-600 border border-sky-600 rounded hover:bg-sky-100 transition">
                            Ver revista
                        </a>

                        @if ($revista->documento_url)
                            <a href="{{ asset('storage/' . $revista->documento_url) }}" download
                                class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-sky-600 border border-sky-600 rounded hover:bg-sky-100 transition">
                                Descargar
                            </a>
                        @else
                            <span
                                class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-red-600 border border-red-500 rounded bg-red-100 transition">No
                                disponible</span>
                        @endif
                    </div>

                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $revistas->links() }}
        </div>
    @elseif ($vistaActual === 'revistas')
        <p class="text-center text-gray-500">No se encontraron revistas.</p>
    @endif

    {{-- 🎓 Vista de eventos --}}
    @if ($vistaActual === 'eventos' && $eventos && $eventos->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($eventos as $evento)
                <div
                    class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 p-6 border border-gray-100">
                    <h2 class="text-xl font-semibold text-green-700 mb-2">{{ $evento->titulo }}</h2>

                    <p class="text-sm text-gray-600 mb-2">
                        <span class="font-medium block">Fecha:</span> {{ $evento->fecha ?? 'Próximamente' }}
                        <span class="font-medium block">Fecha aceptación:</span>
                        {{ $evento->fecha_aceptacion ?? 'Próximamente' }}
                        <span class="font-medium block">Fecha registro:</span>
                        {{ $evento->fecha_registro ?? 'Próximamente' }}
                    </p>

                    <button wire:click="verEvento({{ $evento->id }})"
                        class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-green-600 border border-green-600 rounded hover:bg-green-50 transition">
                        Ver evento
                    </button>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $eventos->links() }}
        </div>
    @elseif ($vistaActual === 'eventos')
        <p class="text-center text-gray-500">No se encontraron eventos.</p>
    @endif


    {{-- 🧾 Detalle del evento seleccionado --}}
    @if ($eventoSeleccionado)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-xl">
                <h3 class="text-2xl font-bold mb-4">{{ $eventoSeleccionado->titulo }}</h3>
                <p><strong>Fecha:</strong> {{ $eventoSeleccionado->fecha ?? 'Próximamente' }}</p>
                <p><strong>Fecha aceptación:</strong> {{ $eventoSeleccionado->fecha_aceptacion ?? 'Próximamente' }}</p>
                <p><strong>Fecha registro:</strong> {{ $eventoSeleccionado->fecha_registro ?? 'Próximamente' }}</p>

                @if ($eventoSeleccionado->documento_url)
                    <a href="{{ asset('storage/' . $eventoSeleccionado->documento_url) }}" target="_blank">
                        <button
                            class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-green-600 border border-green-600 rounded hover:bg-green-50 transition">
                            Ver documento
                        </button>
                    </a>
                @else
                    <button
                    class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-red-600 border border-red-500 rounded bg-red-100 transition"
                        disabled>
                        Sin documento
                    </button>
                @endif


                <div class="mt-4 text-right">
                    <button wire:click="cerrarEvento" class="btn btn-sm btn-outline">Cerrar</button>
                </div>
            </div>
        </div>
    @endif

</div>
