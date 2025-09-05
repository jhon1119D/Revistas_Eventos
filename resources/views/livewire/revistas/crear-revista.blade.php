<div class="bg-sky-900 text-black rounded-xl shadow-md p-6 border-4 border-black">
    <h2 class="text-xl font-bold mb-4 text-center text-white">Añadir Revista</h2>

    {{-- Alerta de que se guardo la revista --}}
    <x-alert />

    <form wire:submit.prevent="guardar" class="space-y-4" enctype="multipart/form-data">
        <div>
            <label for="nombre" class="block font-semibold text-white mb-1">Nombre:</label>
            <input type="text" wire:model.defer="nombre" id="nombre" class="w-full p-2 border rounded bg-white">
            @error('nombre')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="categoria_id" class="block font-semibold text-white mb-1">Categoría:</label>
            <select wire:model.defer="categoria_id" id="categoria_id" class="w-full p-2 border rounded bg-white">
                <option value="">Seleccione una categoría</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                @endforeach
            </select>
            @error('categoria_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="enlace" class="block font-semibold text-white mb-1">Enlace:</label>
            <input type="text" wire:model.defer="enlace" id="enlace" class="w-full p-2 border rounded bg-white">
            @error('enlace')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="accesibilidad" class="block font-semibold text-white mb-1">Open Access:</label>
            <select wire:model.defer="accesibilidad" id="accesibilidad"
                class="w-full p-2 border rounded bg-white text-gray-800">
                <option value="">-- Selecionar accesibilidad --</option>
                <option value="si">si</option>
                <option value="no">no</option>
            </select>
            @error('accesibilidad')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>


        <div>
            <label for="pais" class="block font-semibold mb-1 text-white">País</label>
            <select wire:model.defer="pais" id="pais" class="w-full p-2 border rounded bg-white text-gray-800">
                <option value="">-- Selecciona país --</option>
                @foreach ($paises as $pais)
                    <option value="{{ $pais }}">{{ $pais }}</option>
                @endforeach
            </select>
            @error('pais')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="clasificacion" class="block font-semibold text-white mb-1">Clasificación:</label>
            <select wire:model.defer="clasificacion" id="clasificacion" class="w-full p-2 border rounded bg-white">
                <option value="">-- Selecciona cuartil SJR --</option>
                <option value="Q1">Q1 - Muy alto impacto</option>
                <option value="Q2">Q2 - Alto impacto</option>
                <option value="Q3">Q3 - Impacto medio</option>
                <option value="Q4">Q4 - Bajo impacto</option>
                <option value="No clasificado">No clasificado</option>
            </select>
            @error('clasificacion')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>


        <div>
            <label for="documento" class="block font-semibold text-white mb-1">Documento:</label>
            <input type="file" wire:model.lazy="archivo" id="documento" class="w-full p-2 border rounded bg-white" />
            @error('archivo')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>


        <!-- Contenedor relativo -->
        <div class="relative w-full mt-5">
            <!-- Botón -->
            <button type="submit" wire:loading.attr="disabled" wire:target="archivo"
                class="w-full bg-amber-400 text-sky-900 py-2 rounded hover:text-white hover:bg-amber-300 font-bold transition">
                Añadir revista
            </button>

            <!-- Mensaje de carga -->
            <div wire:loading wire:target="archivo"
                class="absolute left-0 right-0 text-center text-sm text-gray-500 mt-11">
                Subiendo archivo, por favor espera...
            </div>
        </div>


    </form>

</div>
