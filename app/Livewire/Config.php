<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Categoria;
use App\Models\User;
use App\Models\CodigoRegistro;

class Config extends Component
{
    public string $nombre = '';
    public $categorias = [];
    public string $usuario = '';
    public $usuarios = [];

    public string $codigoRegistro = '';

    public function mount()
    {
        $this->cargarCategorias();
        $this->cargarUsuarios();
        $this->cargarCodigo();
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

    // Guardar nueva categoría
    public function guardar()
    {
        $this->validate([
            'nombre' => 'required|string|unique:categorias,nombre',
        ]);

        Categoria::create(['nombre' => $this->nombre]);
        $this->reset('nombre');
        $this->cargarCategorias();
        $this->emitirAlerta('Categoría creada', 'success');
        $this->dispatch('categoriaCreada');
    }
    //Eliminar categoria
    public function eliminar($id)
    {
        Categoria::findOrFail($id)->delete();
        $this->cargarCategorias();
        $this->emitirAlerta('Categoría eliminada', 'warning');
    }
    //Cargar categoria
    public function cargarCategorias()
    {
        $this->categorias = Categoria::orderBy('nombre')->get();
    }
    //Cargar usuarios
    public function cargarUsuarios()
    {
        $this->usuarios = User::orderBy('name')->get();
    }
    //Eliminar usuarios
    public function eliminarUser($id)
    {
        User::findOrFail($id)->delete();
        $this->cargarUsuarios();
        $this->emitirAlerta('Usuario eliminado', 'warning');
    }
    //Habilitar o desabilitar usuarios
    public function toggleUserEstado($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->activo = !$usuario->activo;
        $usuario->save();
        $this->cargarUsuarios();
        $mensaje = $usuario->activo ? 'Usuario habilitado correctamente' : 'Usuario inhabilitado correctamente';
        $tipo = $usuario->activo ? 'success' : 'warning';
        $this->emitirAlerta($mensaje, $tipo);
    }

    // Código de registro
    public function cargarCodigo()
    {
        $registro = CodigoRegistro::first();

        if (!$registro) {
            $registro = CodigoRegistro::create(['codigo' => 'UTPL']);
        }

        $this->codigoRegistro = $registro->codigo;
    }

    public function actualizarCodigo()
    {
        $registro = CodigoRegistro::first();

        if ($registro) {
            $registro->update(['codigo' => $this->codigoRegistro]);
        } else {
            CodigoRegistro::create(['codigo' => $this->codigoRegistro]);
        }

        $this->emitirAlerta('Código actualizado correctamente', 'success');
    }

    public function render()
    {
        return view('livewire.config')->layout('layouts.app', ['titulo' => 'Configuración']);
    }
}
