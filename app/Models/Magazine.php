<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Magazine extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nombre',
        'categoria_id',
        'enlace',
        'accesibilidad',
        'pais',
        'clasificacion',
        'documento_url',
        'autor_nombre',
    ];


    // RELACIÓN: este magazine pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categoria()
{
    return $this->belongsTo(Categoria::class);
}

}
