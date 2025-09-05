<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{
    //Muestra la pagina del formulario
    public function index()
    {
        return view('auth.register');
    }


    public function store(Request $request)
    {
        //Validar formulario de registro
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'required|string|max:20|min:9',
            'password' => 'required|string|min:8|confirmed',
            'codigo'=> 'required|string|exists:codigos_registro,codigo'
            
        ]);

        //crear un usuario
        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'password' => Hash::make($request['password']),
        ]);

        return redirect()->route('login')->with('success', '¡Registro completado!');


    }
}
