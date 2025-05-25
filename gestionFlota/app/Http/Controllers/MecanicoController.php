<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehiculo;
use Illuminate\Support\Facades\Auth;
use App\Models\HistorialMovimiento;

class MecanicoController extends Controller
{
    public function index(Request $request){
        $user = Auth::user();

        if(!$user || !$user->role || !in_array($user->role->nombre,['mecanico','admin'])){
            abort(403,'Acceso no autorizado');
        }
        $query = Vehiculo::whereIn('estado',['taller','esperando piezas']);
        
        if($request->filled('busqueda')){
            $busqueda = $request->input('busqueda');
            $query->where(function ($q) use ($busqueda){
                $q->where('matricula','like',"%$busqueda%")
                    ->orWhere('modelo','like',"%$busqueda%")
                    ->orWhere('marca','like',"%$busqueda%");
            });

        }
        $vehiculosEnTaller = $query->get();
        return view('mecanico.index',compact('vehiculosEnTaller'));
    }

    public function actualizar(Request $request, Vehiculo $vehiculo)
    {
        $request->validate([
            'estado' => 'required|string',
            'observaciones' => 'nullable|string'
        ]);

        $estadoAnterior = $vehiculo->estado;

        $vehiculo->estado = $request->estado;
        $vehiculo->observaciones = $request->observaciones;
        $vehiculo->save();

        $accion = 'Actualizacion desde Mecánico';
        $observaciones = 'Estado cambio a: ' .ucfirst($vehiculo->estado) . '<br>';
        if($request->observaciones){
            $observaciones .='Notas: ' .e($request->observaciones) . '<br>';
        }

        HistorialMovimiento::create([
            'vehiculo_id' => $vehiculo->id,
            'usuario_id' => Auth::id(),
            'accion' => $accion,
            'observaciones' => $observaciones,
        ]);

        return redirect()->route('mecanico.index')->with('Hecho','Estado actualizado');
    }
}
