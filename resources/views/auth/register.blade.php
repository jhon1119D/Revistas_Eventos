@extends('layouts.app')


@section('titulo')
    Crear cuenta
@endsection


@section('contenido')
    <div class="md:flex justify-center">
        <div class="md:w-1/2 ">
            <img src="{{ asset('img/registro.webp') }}" alt="Imagen de registro">
        </div>


        <div class=" bg-gray-200 shadow-lg p-11 md:w-1/3">
            <h2 class="text-2xl font-bold text-sky-900 mb-6 text-center">Crear cuenta</h2>

            <form class="space-y-5" method="POST" action="{{ route('registro.store') }}">
                @csrf
                <!-- Nombre -->
                <div>
                    <label for="name" class="block text-sm font-medium text-black">Nombre completo:</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                        class="mt-1 w-full border rounded-md px-4 py-2 focus:border-3" placeholder="Tu nombre">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-black">Correo electrónico:</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                        class="mt-1 w-full border rounded-md px-4 py-2 focus:border-3" placeholder="ejemplo@correo.com"
                        autocomplete="new-email">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Télefono -->
                <div>
                    <label for="phone" class="block text-sm font-medium text-black">Teléfono:</label>
                    <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                        class="mt-1 w-full border rounded-md px-4 py-2 focus:border-3" placeholder="Télefono">
                    @error('phone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Contraseña -->
                <div>
                    <label for="password" class="block text-sm font-medium text-black">Contraseña:</label>
                    <input type="password" id="password" name="password"
                        class="mt-1 w-full border rounded-md px-4 py-2 focus:border-3" placeholder="Contraseña"
                        autocomplete="new-password">
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirmación -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-black">Confirmar
                        contraseña:</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        class="mt-1 w-full border rounded-md px-4 py-2 focus:border-3" placeholder="Confirmar contraseña"
                        autocomplete="new-password">
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Código de registro --}}
                <div>
                    <label for="codigo" class="block text-sm font-medium text-black">Código de registro</label>
                    <input type="text" name="codigo" id="codigo" value="{{ old('codigo') }}"
                        class="mt-1 w-full border rounded-md px-4 py-2 focus:border-3" placeholder="Código de registro">

                    @error('codigo')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
              
                <!-- Botón -->
                <button type="submit"
                    class="w-full bg-amber-400 text-sky-900 py-2 rounded hover:text-white hover:bg-amber-300 mt-5 font-bold transition">
                    Registrarse
                </button>
            </form>

        </div>

    </div>
@endsection
