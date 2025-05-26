<?php

namespace App\Http\Controllers;

use App\Models\HistorialMovimiento;
use Illuminate\Http\Request;
use App\Models\Vehiculo;
use Illuminate\Support\Facades\Auth;

class ParkingController extends Controller
{
    public function index(Request $request)
    {
        $busqueda = $request->input('busqueda');

        $plazas = \App\Models\Parking::with('vehiculo')
            ->when($busqueda, function ($query) use ($busqueda) {
                $query->whereHas('vehiculo', function ($q) use ($busqueda) {
                    $q->where('matricula', 'like', "%$busqueda%")
                        ->orWhere('modelo', 'like', "%$busqueda%")
                        ->orWhere('marca', 'like', "%$busqueda%");
                });
            })
            ->get();
        return view('parking.index', compact('plazas', 'busqueda'));
    }
    public function alquilar($id)
    {
        $vehiculo = Vehiculo::findOrFail($id);

        $vehiculo->estado = 'alquilado';
        $vehiculo->listo_entrega = false;

        $plaza = $vehiculo->parking;
        if ($plaza) {
            $plaza->vehiculo_id = null;
            $plaza->save();
        }

        $vehiculo->save();

        HistorialMovimiento::create([
            'vehiculo_id' => $vehiculo->id,
            'usuario_id' => Auth::id(),
            'accion' => 'Vehiculo alquilado',
            'observaciones' => 'Vehiculo alquilado y plaza liberada. ',
        ]);
        return redirect()->route('parking.index')->with('Hecho', 'Vehiculo alquilado correctamente');
    }
    public function devolucion($id)
    {
        $vehiculo = Vehiculo::findOrFail($id);

        $vehiculo->estado = 'devuelto';
        $vehiculo->sucio = false;
        $vehiculo->sin_gasolina = false;
        $vehiculo->listo_entrega = false;

        $vehiculo->save();

        HistorialMovimiento::create([
            'vehiculo_id' => $vehiculo->id,
            'usuario_id' => Auth::id(),
            'accion' => 'Vehiculo devuelto',
            'observaciones' => 'Vehiculo devuelto. Hacer check-in',
        ]);

        return redirect()->route('parking.alquilados')->with('Hecho', 'Vehiculo devuelto correctamente');
    }
    public function alquilados(Request $request)
    {
        $busqueda = $request->input('busqueda');

        $vehiculos = Vehiculo::where('estado', 'alquilado')
            ->when($busqueda, function ($query) use ($busqueda) {
                $query->where(function ($q) use ($busqueda) {
                    $q->where('matricula', 'like', "%$busqueda%")
                        ->orWhere('modelo', 'like', "%$busqueda%")
                        ->orWhere('marca', 'like', "%$busqueda%");
                });
            })->get();
        return view('parking.alquilados', compact('vehiculos', 'busqueda'));
    }
}
