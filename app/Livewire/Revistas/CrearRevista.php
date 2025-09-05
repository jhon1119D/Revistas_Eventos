<?php

namespace App\Livewire\Revistas;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Magazine;
use Illuminate\Support\Facades\Auth;
use PragmaRX\Countries\Package\Countries;
use App\Models\Categoria;
use App\Services\FileManager;

class CrearRevista extends Component
{
    use WithFileUploads;

    public $categorias = [];
    public $paises = [];

    public $nombre;
    public $categoria_id;
    public $enlace;
    public $accesibilidad;
    public $pais;
    public $clasificacion;
    public $documento_url;
    public $archivo;

    public function mount()
    {
        $this->paises = (new Countries())->all()->pluck('name.common')->toArray();
        $this->categorias = Categoria::all();
    }

    public function guardar()
    {
        $this->validate([
            'nombre' => 'required|string|max:250',
            'enlace' => 'required|string|max:250',
            'accesibilidad' => 'required|string|max:20',
            'pais' => 'required|string|max:50',
            'clasificacion' => 'required|string|max:50',
            'archivo' => 'nullable|file|max:5120',
            'categoria_id' => 'required|integer|max:100'
        ]);

        $rutaArchivo = null;

        if ($this->archivo) {
            $fileManager = app(FileManager::class);
            $rutaArchivo = $fileManager->upload($this->archivo, 'revistas');
        }

        Magazine::create([
            'user_id' => Auth::id(),
            'autor_nombre' => Auth::user()->name,
            'nombre' => $this->nombre,
            'categoria_id' => $this->categoria_id,
            'enlace' => $this->enlace,
            'accesibilidad' => $this->accesibilidad,
            'pais' => $this->pais,
            'clasificacion' => $this->clasificacion,
            'documento_url' => $rutaArchivo,


        ]);

        $this->js(<<<'JS'
            window.dispatchEvent(new CustomEvent('show-alert', {
                detail: {
                    message: 'Revista guardada',
                    type: 'success'
                }
            }));
        JS);

        $this->dispatch('revistaCreada'); // Dispara la actualización


        $this->reset(['nombre', 'enlace', 'accesibilidad', 'pais', 'clasificacion', 'documento_url', 'categoria_id']);
        $this->archivo = null;
    }

    public function render()
    {
        return view('livewire.revistas.crear-revista');
    }
}
