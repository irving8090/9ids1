<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Membresias; 



class Cliente extends Model
{
    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'curp',
        'fecha_nacimiento',
        'genero',
        'rol',
        'activo',
    ];
   
public function membresia() {
    return $this->hasOne(Membresias::class, 'id_usuario');
}
public function clases()
{
    return $this->belongsToMany(Clases::class, 'clase_cliente', 'cliente_id', 'clase_id');
}




}
