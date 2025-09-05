<?php

namespace App\Livewire\Eventos;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\Evento;
use Illuminate\Support\Facades\Auth;
use App\Services\FileManager;
use Livewire\Attributes\On;

class EditarEvento extends Component
{
    use WithFileUploads, WithPagination;

    public int|null $editId = null;
    public array $formulario = [];
    public $archivoNuevo;
    // Variables de BuscadorEventos
    public string $search = '';
    public bool $modoBusquedaActiva = false;

    protected array $rules = [
        'formulario.titulo' => 'required|string|max:255',
        'formulario.acronimo' => 'required|string|max:50',
        'formulario.ranking' => 'required|string|max:50',
        'formulario.enlace' => 'required|url|max:255',
        'formulario.fecha' => 'required|date',
        'formulario.fecha_aceptacion' => 'nullable|date',
        'formulario.fecha_registro' => 'nullable|date',
        'formulario.autor_nombre' => 'required|string|max:255',
        'formulario.documento_url' => 'nullable|string',
        'archivoNuevo' => 'nullable|file|mimes:pdf|max:10240',
    ];

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
        $evento = Evento::where('user_id', Auth::id())->findOrFail($id);
        $this->editId = $id;
        $this->formulario = $evento->only([
            'titulo',
            'acronimo',
            'ranking',
            'enlace',
            'fecha',
            'fecha_aceptacion',
            'fecha_registro',
            'autor_nombre',
            'documento_url',
        ]);
    }

    public function update(): void
    {
        $this->validate();

        $evento = Evento::where('user_id', Auth::id())->findOrFail($this->editId);

        $fileManager = app(FileManager::class);

        if ($this->archivoNuevo) {
            $fileManager->delete($evento->documento_url);
            $this->formulario['documento_url'] = $fileManager->upload($this->archivoNuevo, 'eventos');
        }

        $evento->update($this->formulario);

        $this->archivoNuevo = null;
        $this->reset(['editId', 'formulario']);
        $this->resetPage();
        $this->emitirAlerta('Evento editado correctamente', 'success');
    }

    public function delete(int $id): void
    {
        $evento = Evento::where('user_id', Auth::id())->findOrFail($id);
        $fileManager = app(FileManager::class);
        $fileManager->delete($evento->documento_url);
        $evento->delete();
        $this->resetPage();
        $this->emitirAlerta('Evento eliminado', 'danger');
    }

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
        $eventos = Auth::user()->eventos()
            ->when($this->search, fn($q) => $q->where('titulo', 'like', '%' . $this->search . '%'))
            ->latest()
            ->paginate(20);

        return view('livewire.eventos.editar-evento', compact('eventos'))->layout('layouts.app', ['titulo' => 'Administración de eventos']);
    }
}
