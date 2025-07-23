<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Clases;
use App\Models\Membresias;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    
    public function tiposMembresiaPopulares()
    {
        $tipos = Membresias::select(
                'tipo',
                DB::raw('count(*) as total')
            )
            ->groupBy('tipo')
            ->orderByDesc('total')
            ->get();

        return response()->json($tipos);
    }

    public function clasesPorProfesor()
    {
        $clases = Clases::join('users as u', 'clases.id_usuario', '=', 'u.id')
            ->select('u.name as profesor', DB::raw('count(clases.id) as total_clases'))
            ->groupBy('u.name')
            ->orderByDesc('total_clases')
            ->get();

        return response()->json($clases);
    }
}
