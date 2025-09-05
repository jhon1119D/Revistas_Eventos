<?php

use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Auth\Login;
use App\Livewire\Dashboard;
use App\Livewire\Inicio;
use App\Livewire\Config;
use App\Livewire\Eventos\EditarEvento;
use App\Livewire\Revistas\EditarRevista;

Route::get('/', Inicio::class)->name('inicio');
//Registro de usuarios
Route::get('/register', [RegisterController::class, 'index'])->name('registro.index');
Route::post('/register', [RegisterController::class, 'store'])->name('registro.store');
//Iniciar sesión
Route::get('/login', Login::class)->middleware('guest')->name('login');
//Cerrar sesión
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');
// Página para crear revistas, eventos y metricas
Route::middleware('auth')->get('/administrador/{id}', Dashboard::class)->name('dashboard.index');
//Revistas Eventos
Route::middleware('auth')->get('/administrador/{id}/revistas', EditarRevista::class)->name('revistas');
Route::middleware('auth')->get('/administrador/{id}/eventos', EditarEvento::class)->name('eventos');
//Configuración
Route::middleware('auth')->get('/administrador/{id}/configuracion', Config::class)->name('config');



