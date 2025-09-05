<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;


class Login extends Component
{

    public $email;
    public $password;

    public function login()
    {

        $this->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
        ];



        if (!Auth::attempt($credentials)) {
            $this->js(<<<JS
            window.dispatchEvent(new CustomEvent('show-alert', {
                detail: {
                    message: 'Credenciales incorrectas',
                    type: 'danger'
                }
            }));
        JS);
            // Limpiar campos
            $this->reset(['password', 'email']);
            return;
        }

        // Login exitoso: regenerar sesión y redirigir
        session()->regenerate();
        // Redirección al dashboard con el ID del usuario
        return redirect()->route('dashboard.index', Auth::id());
    }

    public function render()
    {

        return view('livewire.auth.login')->layout('layouts.app', ['titulo' => 'Inicio de sesión']);
    }
}
