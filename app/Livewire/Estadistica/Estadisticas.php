<?php

namespace App\Livewire\Estadistica;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Magazine;
use App\Models\Evento;
use Livewire\Attributes\On;

class Estadisticas extends Component
{
    public $usuario;
    public $totalRevistas;
    public $totalEventos;

    public function mount()
    {
        $this->cargarDatos();
    }

    #[On('revistaCreada')]
    #[On('eventoCreado')]
    public function actualizarDatos(): void
    {
        $this->cargarDatos();
        $this->enviarDatosGrafico();
    }

    private function cargarDatos(): void
    {
        $this->usuario = Auth::user()->loadCount(['magazines', 'eventos']);
        $this->totalRevistas = Magazine::count();
        $this->totalEventos  = Evento::count();
    }

    private function enviarDatosGrafico(): void
    {
        $misRevistas = $this->usuario->magazines_count;
        $totalRevistas = $this->totalRevistas;
        $misEventos = $this->usuario->eventos_count;
        $totalEventos = $this->totalEventos;

        $this->js(<<<JS
        window.dispatchEvent(new CustomEvent('actualizarGrafico', {
            detail: {
                misRevistas: $misRevistas,
                totalRevistas: $totalRevistas,
                misEventos: $misEventos,
                totalEventos: $totalEventos
            }
        }));
    JS);
    }




    public function render()
    {
        return view('livewire.estadistica.estadisticas');
    }
}
