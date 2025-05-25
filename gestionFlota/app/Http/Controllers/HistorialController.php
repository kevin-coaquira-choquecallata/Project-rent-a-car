<?php

namespace App\Http\Controllers;

use App\Models\HistorialMovimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistorialController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if(!$user || !$user->role || !in_array($user->role->nombre,['admin','oficina'])){
            abort(403, 'Acceso no autorizado');
        }

        $historial = HistorialMovimiento::with(['vehiculo','usuario'])
            ->orderBy('fecha','desc')
            ->get();

        return view('historial.index',compact('historial'));
    }
}
