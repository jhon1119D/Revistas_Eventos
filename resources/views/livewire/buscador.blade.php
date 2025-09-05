<div class="flex gap-3 w-full mx-auto p-4">
    <input type="text" wire:model.defer="search" placeholder="Buscar revista por nombre..."
        class="flex-grow border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-bg-sky-900 transition"
        @if ($modoBusquedaActiva) disabled @endif />

    <button wire:click="buscar" type="button"
        class="{{ $modoBusquedaActiva ? 'bg-amber-400 hover:bg-amber-300' : 'bg-sky-900 hover:bg-sky-700' }} text-white px-5 py-2 rounded-md transition">
        {{ $modoBusquedaActiva ? 'Quitar filtro' : 'Buscar' }}
    </button>
</div>
