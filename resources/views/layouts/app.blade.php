<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
   
    @livewireStyles

    <title>
        @hasSection('titulo')
            @yield('titulo')
        @else
            {{ $titulo ?? 'UTPL' }}
        @endif
    </title>
</head>

<body class="bg-gray-50">

    <header class="p-5 bg-white shadow">
        <div class="container mx-auto flex justify-between items-center">
            <a href="/">
                <img src="{{ asset('img/Logo-utpl.svg') }}" alt="Logo utpl" class="h-16 w-auto">
            </a>

            <div class="flex items-center space-x-4">
                @auth
                    {{-- inicio --}}
                    <a href="{{ route('dashboard.index', ['id' => auth()->id()]) }}"
                        class="px-4 py-2 bg-gray-100 hover:bg-gray-300 rounded transition font-semibold">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>

                    </a>
                    {{-- Configuración --}}
                    <a href="{{ route('config', ['id' => auth()->id()]) }}"
                        class="px-4 py-2 bg-gray-100 hover:bg-gray-300 rounded transition font-semibold">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>

                    </a>
                    <a href="{{ route('revistas', ['id' => auth()->id()]) }}"
                        class="px-4 py-2 bg-gray-100 hover:bg-gray-300 rounded transition font-semibold">
                        Mis Revistas
                    </a>
                    <a href="{{ route('eventos', ['id' => auth()->id()]) }}"
                        class="px-4 py-2 bg-gray-100 hover:bg-gray-300 rounded transition font-semibold">
                        Mis Eventos
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded transition font-semibold">
                            Cerrar sesión
                        </button>
                    </form>
                @endauth

                @guest
                    <a href="{{ route('login') }}"
                        class="px-4 py-2 bg-sky-900 hover:bg-sky-700 text-white rounded transition font-semibold">
                        Login
                    </a>
                    <a href="{{ route('registro.index') }}"
                        class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded transition font-semibold">
                        Registrarse
                    </a>
                @endguest
            </div>
        </div>
    </header>

    <main>
        <h2 class="text-4xl font-bold text-black mt-10 mb-10 text-center">
            @hasSection('titulo')
                @yield('titulo')
            @else
                {{ $titulo ?? '' }}
            @endif
        </h2>

        @hasSection('contenido')
            @yield('contenido')
        @else
            {{ $slot ?? '' }}
        @endif
    </main>

    <footer class="text-center p-5 text-gray-500 font-bold uppercase mt-10">
        <p> UTPL - Todos los derechos reservados {{ now()->year }}</p>
    </footer>

    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</body>

</html>
