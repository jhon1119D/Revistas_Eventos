<?php

namespace App\Livewire\Revistas;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\Magazine;
use Illuminate\Support\Facades\Auth;
use PragmaRX\Countries\Package\Countries;
use App\Services\FileManager;
use App\Models\Categoria;
use Livewire\Attributes\On;


class EditarRevista extends Component
{
    use WithFileUploads, WithPagination;

    public $categorias;
    public int|null $editId = null;
    public array $formulario = [];
    public array $paises = [];
    public $archivoNuevo;
    // Variables de BuscadorRevistas
    public string $search = '';
    public bool $modoBusquedaActiva = false;

    protected array $rules = [
        'formulario.nombre' => 'required|string|max:255',
        'formulario.categoria_id' => 'required|integer|max:100',
        'formulario.enlace' => 'nullable|url',
        'formulario.accesibilidad' => 'required|string',
        'formulario.pais' => 'required|string',
        'formulario.clasificacion' => 'nullable|string|max:50',
        'formulario.documento_url' => 'nullable|string',
        'archivoNuevo' => 'nullable|file|mimes:pdf|max:10240',
    ];

    //Montaje
    public function mount(): void
    {
        $this->paises = (new Countries())->all()->pluck('name.common')->toArray();
        $this->categorias = Categoria::all();
    }

    //Función para reutilizar alertas
    private function emitirAlerta(string $mensaje, string $tipo): void
    {
        $this->js(<<<JS
                    window.dispatchEvent(new CustomEvent('show-alert', {
                        detail: {
                            message: '$mensaje',
                            type: '$tipo'
                        }
                    }));
                JS);
    }

    public function edit(int $id): void
    {
        $mag = Magazine::where('user_id', Auth::id())->findOrFail($id);
        $this->editId = $id;
        $this->formulario = $mag->only([
            'nombre',
            'categoria_id',
            'enlace',
            'accesibilidad',
            'pais',
            'clasificacion',
            'documento_url',
        ]);
    }

    //Actualizar el dato de revista 
    public function update(): void
    {
        $this->validate();

        $mag = Magazine::where('user_id', Auth::id())->findOrFail($this->editId);

        $fileManager = app(FileManager::class);

        if ($this->archivoNuevo) {
            $fileManager->delete($mag->documento_url);
            $this->formulario['documento_url'] = $fileManager->upload($this->archivoNuevo, 'revistas');
        }

        $mag->update($this->formulario);

        $this->archivoNuevo = null;
        $this->reset(['editId', 'formulario']);
        $this->resetPage();
        $this->emitirAlerta('Revista editada', 'success');
    }


    //Eliminar archivo y referencia URL
    public function delete(int $id): void
    {
        $mag = Magazine::where('user_id', Auth::id())->findOrFail($id);

        $fileManager = app(FileManager::class);
        $fileManager->delete($mag->documento_url);
        $mag->delete();
        $this->resetPage();
        $this->emitirAlerta('Revista eliminada', 'danger');
    }

    //Cancelar edición 
    public function cancelEdit(): void
    {
        $this->reset(['editId', 'formulario', 'archivoNuevo']);
        $this->emitirAlerta('Edición cancelada', 'warning');
    }

    //Escuchar evento de busqueda de resultados
    #[On('busquedaActualizada')]
    public function busquedaActualizada(array $data): void
    {
        $this->search = $data['search'] ?? '';
        $this->modoBusquedaActiva = $data['modoBusquedaActiva'] ?? false;
        $this->resetPage();
    }

    public function render()
    {
        $magazines = Auth::user()->magazines()
            ->when($this->search, fn($q) => $q->where('nombre', 'like', '%' . $this->search . '%'))
            ->latest()
            ->paginate(20);

        return view('livewire.revistas.editar-revista', compact('magazines'))->layout('layouts.app', ['titulo' => 'Administración de revistas']);
    }
}
