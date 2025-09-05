<div class="bg-sky-900 text-black rounded-xl shadow-md p-6 border-4 border-black">
    <h2 class="text-xl font-bold mb-4 text-center text-white">Añadir Evento</h2>

    {{-- Alerta de que se guardó el evento --}}
    <x-alert />

    <form wire:submit.prevent="guardar" class="space-y-4" enctype="multipart/form-data">

        <div>
            <label for="titulo" class="block font-semibold text-white mb-1">Título:</label>
            <input type="text" wire:model.defer="titulo" id="titulo" class="w-full p-2 border rounded bg-white">
            @error('titulo')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="acronimo" class="block font-semibold text-white mb-1">Acrónimo:</label>
            <input type="text" wire:model.defer="acronimo" id="acronimo" class="w-full p-2 border rounded bg-white">
            @error('acronimo')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="ranking" class="block font-semibold text-white mb-1">Ranking:</label>
            <select wire:model.defer="ranking" id="ranking" class="w-full p-2 border rounded bg-white">
                <option value="">--Elegir ranking--</option>
                <option value="A*">A*</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="Unranked">Unranked</option>
            </select>
            @error('ranking')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>


        <div>
            <label for="enlace" class="block font-semibold text-white mb-1">Enlace del evento:</label>
            <input type="text" wire:model.defer="enlace" id="enlace" class="w-full p-2 border rounded bg-white">
            @error('enlace')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <fieldset class="border border-gray-300 p-4 rounded-md shadow-sm mb-6">
            <legend class="text-lg font-semibold text-amber-400 px-2">Fechas Importantes</legend>
            <div>
                <label for="fecha" class="block font-semibold text-white mb-1">Fecha del evento:</label>
                <input type="date" wire:model.defer="fecha" id="fecha"
                    class="w-full p-2 border rounded bg-white">
                @error('fecha')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="fecha_aceptacion" class="block font-semibold text-white mb-1">Fecha de aceptación:</label>
                <input type="date" wire:model.defer="fecha_aceptacion" id="fecha_aceptacion"
                    class="w-full p-2 border rounded bg-white">
                @error('fecha_aceptacion')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="fecha_registro" class="block font-semibold text-white mb-1">Fecha de registro:</label>
                <input type="date" wire:model.defer="fecha_registro" id="fecha_registro"
                    class="w-full p-2 border rounded bg-white">
                @error('fecha_registro')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </fieldset>

        <div>
            <label for="documento" class="block font-semibold text-white mb-1">Documento relacionado:</label>
            <input type="file" wire:model.lazy="archivo" id="documento" class="w-full p-2 border rounded bg-white" />
            @error('archivo')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="relative w-full mt-5">
            <button type="submit" wire:loading.attr="disabled" wire:target="archivo"
                class="w-full bg-amber-400 text-sky-900 py-2 rounded hover:text-white hover:bg-amber-300 font-bold transition">
                Añadir evento
            </button>

            <div wire:loading wire:target="archivo"
                class="absolute left-0 right-0 text-center text-sm text-gray-500 mt-11">
                Subiendo archivo, por favor espera...
            </div>
        </div>

    </form>
</div>
