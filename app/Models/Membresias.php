<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cliente; 
class Membresias extends Model
{
    protected $table = 'membresias';

    protected $fillable = [
        'nombre',
        'tipo',
        'precio',
        'duracion_dias',
        'clases_incluidas',
        'descripcion',
        'id_usuario',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_usuario');
    }
}
