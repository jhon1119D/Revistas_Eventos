<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Evento;
use App\Models\Magazine;

class Inicio extends Component
{
    use WithPagination;

    public string $search = '';
    public bool $modoBusquedaActiva = false;
    public string $vistaActual = 'revistas'; // 'revistas' o 'eventos'
    public ?Evento $eventoSeleccionado = null;

    protected $listeners = ['busquedaActualizada'];


    public function busquedaActualizada(array $data): void
    {
        $this->search = $data['search'] ?? '';
        $this->modoBusquedaActiva = $data['modoBusquedaActiva'] ?? false;
        $this->resetPage();
    }
    // Aqui hacemos un cambio de vista para poder visualizar eventos o revistas
    public function cambiarVista(string $vista): void
    {
        $this->vistaActual = $vista;
        $this->eventoSeleccionado = null;
        $this->resetPage();
    }
    //quitar esto
    public function verEvento(int $id): void
    {
        $this->eventoSeleccionado = Evento::find($id);
    }
    //7quitar esto analizar
    public function cerrarEvento(): void
    {
        $this->eventoSeleccionado = null;
    }

    public function render()
    {
        $revistas = null;
        $eventos = null;

        if ($this->vistaActual === 'revistas') {
            $revistas = Magazine::query()
                ->when($this->search, fn($q) => $q->where('nombre', 'like', '%' . $this->search . '%'))
                ->latest()
                ->paginate(20);
        }

        if ($this->vistaActual === 'eventos') {
            $eventos = Evento::query()
                ->when($this->search, fn($q) => $q->where('titulo', 'like', '%' . $this->search . '%'))
                ->latest()
                ->paginate(20);
        }

        return view('livewire.inicio', compact('revistas', 'eventos'))->layout('layouts.app', ['titulo' => 'Catálogo de revistas y eventos']);
    }
}
