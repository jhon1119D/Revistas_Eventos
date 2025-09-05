<?php

namespace App\Livewire;

use Livewire\Component;

class Buscador extends Component
{
    public string $search = '';
    public bool $modoBusquedaActiva = false;

    public function buscar(): void
    {
        if ($this->modoBusquedaActiva) {
            $this->search = '';
            $this->modoBusquedaActiva = false;
        } else {
            $this->modoBusquedaActiva = true;
            $this->search = trim($this->search);
        }

        $this->dispatch('busquedaActualizada', [
            'search' => $this->search,
            'modoBusquedaActiva' => $this->modoBusquedaActiva,
        ]);
    }

    public function render()
    {
        return view('livewire.buscador');
    }
}
