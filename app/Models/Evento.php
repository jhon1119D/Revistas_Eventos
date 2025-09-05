<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $fillable = [
        'user_id',
        'titulo',
        'acronimo',
        'ranking',
        'enlace',
        'documento_url',
        'autor_nombre',
        'fecha',
        'fecha_aceptacion',
        'fecha_registro',
    ];
    

        // RELACIÓN: este evento pertenece a un usuario
        public function user()
        {
            return $this->belongsTo(User::class);
        }
}
