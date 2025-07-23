<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clases extends Model
{
    protected $fillable = [
        'nombre',
        'dia_semana',
        'hora_inicio',
        'hora_fin',
        'lugares_ocupados',
        'id_usuario',
        'lugares_disponibles',
    ];

    public function usuario()
    {
        return $this->belongsTo(Cliente::class, 'id_usuario');
    }
    public function clientes()
{
    return $this->belongsToMany(Cliente::class, 'clase_cliente', 'clase_id', 'cliente_id');
}
public function profesor()
{
    return $this->belongsTo(\App\Models\Cliente::class, 'id_usuario');
}


}

