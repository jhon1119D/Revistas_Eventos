<div class="md:flex justify-center">
    <div class="md:w-1/2  shadow-2xl">
        <img src="{{ asset('img/login.webp') }}" alt="Imagen de login">
    </div>

    <div class="bg-gray-200 p-11 md:w-1/3 shadow-2xl ">
        <h2 class="text-2xl font-bold text-sky-900 mb-6 text-center">Inicio de sesión</h2>

        <x-alert />

        <form wire:submit.prevent="login" class="space-y-5">

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-black">
                    Correo electrónico:
                </label>
                <input type="email" id="email" name="email" wire:model.defer="email"
                    class="mt-1 w-full border rounded-md px-4 py-2 focus:border-3" placeholder="ejemplo@correo.com">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Contraseña -->
            <div>
                <label for="password" class="block text-sm font-medium text-black">
                    Contraseña:
                </label>
                <input type="password" id="password" name="password" wire:model.defer="password"
                    class="mt-1 w-full border rounded-md px-4 py-2 focus:border-3" placeholder="Contraseña">
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Recordarme -->
            <label class="inline-flex items-center cursor-pointer">
                <input type="checkbox" name="remember" wire:model.defer="remember" class="form-checkbox text-blue-600">
                <span class="ml-2 text-gray-700 select-none">Recordarme</span>
            </label>

            <!-- Botón -->
            <button type="submit"
                class="w-full bg-amber-400 text-sky-900 py-2 rounded hover:text-white hover:bg-amber-300 mt-5 font-bold transition">
                Iniciar sesión

            </button>
        </form>

        <a href="#" class="mt-2 inline-block text-sky-900 hover:underline">
            ¿Olvidaste tu contraseña?
        </a>
    </div>
</div>
