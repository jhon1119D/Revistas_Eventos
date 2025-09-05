<?php

namespace App\Livewire\Eventos;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Evento;
use Illuminate\Support\Facades\Auth;
use App\Services\FileManager;

class CrearEvento extends Component
{
    use WithFileUploads;

    public $titulo;
    public $acronimo;
    public $ranking;
    public $enlace;
    public $fecha;
    public $fecha_aceptacion;
    public $fecha_registro;
    public $autor_nombre;
    public $documento_url;
    public $archivo;

    public function guardar()
    {
        $this->validate([
            'titulo' => 'required|string|max:255',
            'acronimo' => 'required|string|max:50',
            'ranking' => 'required|string|max:50',
            'enlace' => 'required|string|max:255',
            'fecha' => 'required|date',
            'fecha_aceptacion' => 'nullable|date',
            'fecha_registro' => 'nullable|date',
            'archivo' => 'nullable|file|max:5120',
        ]);

        $rutaArchivo = null;

        if ($this->archivo) {
            $fileManager = app(FileManager::class);
            $rutaArchivo = $fileManager->upload($this->archivo, 'eventos');
        }

        Evento::create([
            'user_id' => Auth::id(),
            'autor_nombre' => Auth::user()->name,
            'titulo' => $this->titulo,
            'acronimo' => $this->acronimo,
            'ranking' => $this->ranking,
            'enlace' => $this->enlace,
            'fecha' => $this->fecha,
            'fecha_aceptacion' => $this->fecha_aceptacion,
            'fecha_registro' => $this->fecha_registro,
            'documento_url' => $rutaArchivo,
        ]);

        $this->js(<<<'JS'
            window.dispatchEvent(new CustomEvent('show-alert', {
                detail: {
                    message: 'Evento guardado correctamente',
                    type: 'success'
                }
            }));
        JS);


        $this->dispatch('eventoCreado'); // Dispara la actualización

        $this->reset([
            'titulo',
            'acronimo',
            'ranking',
            'enlace',
            'fecha',
            'fecha_aceptacion',
            'fecha_registro',
            'documento_url'
        ]);

        $this->archivo = null;
    }

    public function render()
    {
        return view('livewire.eventos.crear-evento');
    }
}
