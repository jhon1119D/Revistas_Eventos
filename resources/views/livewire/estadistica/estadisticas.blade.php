<div class="bg-sky-900 text-white rounded-xl shadow-md p-6 border-4 border-black">
    <h2 class="text-xl font-bold mb-6 text-center">Estadísticas administrador</h2>

    <div class="space-y-4">
        <div class="flex justify-between border-b border-white pb-2">
            <span class="font-semibold">Nombre:</span>
            <span>{{ $usuario->name }}</span>
        </div>

        <div class="flex justify-between border-b border-white pb-2">
            <span class="font-semibold">Email:</span>
            <span>{{ $usuario->email }}</span>
        </div>

        <div class="flex justify-between border-b border-white pb-2">
            <span class="font-semibold">Teléfono:</span>
            <span>{{ $usuario->phone }}</span>
        </div>

        <div class="flex justify-between border-b border-white pb-2">
            <span class="font-semibold">Revistas añadidas:</span>
            <span>{{ $usuario->magazines_count }}</span>
        </div>

        <div class="flex justify-between pb-2">
            <span class="font-semibold">Eventos añadidos:</span>
            <span>{{ $usuario->eventos_count }}</span>
        </div>
    </div>

    {{-- Carrusel de gráficos --}}
    <div class="mt-8 bg-white rounded-xl shadow-md p-6 border-4 border-black" wire:ignore>
        <h2 class="text-xl font-bold mb-4 text-center text-sky-900">Mis Estadísticas</h2>

        <div class="relative">
            <!-- Gráficos -->
            <canvas id="graficoComparativoCanvas" class="mx-auto w-72 h-72"></canvas>
            <canvas id="graficoBarrasCanvas" class="mx-auto w-72 h-72" style="display: none;"></canvas>

            <!-- Botones de navegación -->
            <div class="flex justify-center mt-4 space-x-4">
                <button id="prevGrafico" class="px-4 py-2 bg-sky-700 text-white rounded"><</button>
                <button id="nextGrafico" class="px-4 py-2 bg-sky-700 text-white rounded">></button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const canvases = [
        document.getElementById('graficoComparativoCanvas'),
        document.getElementById('graficoBarrasCanvas')
    ];
    let index = 0;
    let chartDoughnut = null;
    let chartBar = null;

    function mostrarGrafico() {
        // Ocultar todos los canvas
        canvases.forEach((c, i) => c.style.display = 'none');

        // Mostrar solo el actual
        canvases[index].style.display = 'block';

        // Crear gráfico solo si no existe
        if(index === 0 && !chartDoughnut) {
            chartDoughnut = new Chart(canvases[0].getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: ['Mis Revistas', 'Total Revistas', 'Mis Eventos', 'Total Eventos'],
                    datasets: [{
                        data: [
                            @json($usuario->magazines_count),
                            @json($totalRevistas),
                            @json($usuario->eventos_count),
                            @json($totalEventos)
                        ],
                        backgroundColor: ['#499b4a', '#572364', '#fbbf24', '#fca5a5'],
                        borderColor: '#000',
                        borderWidth: 2
                    }]
                },
                options: { responsive: true, plugins: { legend: { position: 'top' } } }
            });
        } else if(index === 1 && !chartBar) {
            chartBar = new Chart(canvases[1].getContext('2d'), {
                type: 'bar',
                data: {
                    labels: ['Revistas', 'Eventos'],
                    datasets: [
                        {
                            label: 'Mis aportes',
                            data: [@json($usuario->magazines_count), @json($usuario->eventos_count)],
                            backgroundColor: '#499b4a' // un color para todo el dataset
                        },
                        {
                            label: 'Totales',
                            data: [@json($totalRevistas), @json($totalEventos)],
                            backgroundColor: '#572364' // un color para todo el dataset
                        }
                    ]
                },
                options: { responsive: true, plugins: { legend: { position: 'top' } } }
            });
        }
    }

    // Inicializar el primer gráfico
    mostrarGrafico();

    // Navegación
    document.getElementById('prevGrafico').addEventListener('click', () => {
        index = (index - 1 + canvases.length) % canvases.length;
        mostrarGrafico();
    });

    document.getElementById('nextGrafico').addEventListener('click', () => {
        index = (index + 1) % canvases.length;
        mostrarGrafico();
    });

    // Actualización en tiempo real
    window.addEventListener('actualizarGrafico', (event) => {
        if(chartDoughnut) {
            chartDoughnut.data.datasets[0].data = [
                event.detail.misRevistas,
                event.detail.totalRevistas,
                event.detail.misEventos,
                event.detail.totalEventos
            ];
            chartDoughnut.update();
        }

        if(chartBar) {
            chartBar.data.datasets[0].data = [
                event.detail.misRevistas,
                event.detail.misEventos
            ];
            chartBar.data.datasets[1].data = [
                event.detail.totalRevistas,
                event.detail.totalEventos
            ];
            chartBar.update();
        }
    });
});
</script>





