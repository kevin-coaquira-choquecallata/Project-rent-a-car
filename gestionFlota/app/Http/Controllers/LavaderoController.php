<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehiculo;
use Illuminate\Support\Facades\Auth;
use App\Models\Parking;
use App\Models\HistorialMovimiento;

class LavaderoController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        if (!$user || !$user->role || !in_array($user->role->nombre, ['lavadero', 'admin'])) {
            abort(403, 'Acceso no autorizado');
        }

        $query = Vehiculo::where(function ($q) {
            $q->where(function ($inner){
                $inner->whereIn('estado', ['devuelto', 'reparado'])
                ->where(function ($c) {
                    $c->where('sucio', true)
                        ->orWhere('sin_gasolina', true)
                        ->orWhere('estado', 'reparado');
                });
            })
            ->orWhere(function ($inner) {
                $inner->where('listo_entrega', true)
                        ->whereDoesntHave('parking');
            });
        });
        if ($request->filled('busqueda')) {
            $busqueda = $request->input('busqueda');
            $query->where(function ($q) use ($busqueda) {
                $q->where('matricula', 'like', "%$busqueda%")
                    ->orWhere('modelo', 'like', "%$busqueda%")
                    ->orWhere('marca', 'like', "%$busqueda%");
            });
        }
        $vehiculos = $query->get();

        $plazasLibres = Parking::whereNull('vehiculo_id')->get();

        return view('lavadero.index', compact('vehiculos', 'plazasLibres'));
    }

    public function actualizar(Request $request, $id)
    {
        $vehiculo = Vehiculo::findOrFail($id);
        $observaciones = '';
        $acciones = [];

        $huboCambios = false;

        if($request->has('sucio') && $vehiculo->sucio){
            $vehiculo->sucio = false;
            $acciones[] = "Vehiculo limpiado";
            $observaciones .= 'El vehiculo fue limpiado.<br>';
            $huboCambios = true;
        }
        if($request->has('sin_gasolina') && $vehiculo->sin_gasolina){
            $vehiculo->sin_gasolina = false;
            $acciones[] = 'Vehiculo repostado';
            $observaciones .= 'Se lleno el deposito.<br>';
            $huboCambios = true;
        };
        if(!$vehiculo->sucio && !$vehiculo->sin_gasolina){
            $vehiculo->listo_entrega = true;
            $observaciones .= 'Vehiculo listo para entregar<br>';

            if($request->has('plaza_id') && $request->plaza_id){
                if($vehiculo->estado === 'reparado'){
                    $vehiculo->estado = 'devuelto';
                }
            } else{
                if($vehiculo->estado === 'devuelto'){
                    $vehiculo->estado = 'reparado';
                }
                $observaciones .= 'Sin plaza asignada<br>';
            }
            $huboCambios = true;
        }
        //$vehiculo->save();

        if($request->has('plaza_id') && $request->plaza_id){
            $plaza = Parking::find($request->plaza_id);
            if($plaza && !$plaza->vehiculo_id){
                $plaza->vehiculo_id = $vehiculo->id;
                $plaza->save();

                //$acciones[] = 'Aparcado en plaza';
                $observaciones .= 'Coche aparcado en la plaza #'. $plaza->id . '<br>';
                $huboCambios = true;
            }
        }

        if($huboCambios){
            $vehiculo->save();

            HistorialMovimiento::create([
                'vehiculo_id' => $vehiculo->id,
                'usuario_id' => Auth::id(),
                'accion' => 'Actualizado desde Lavadero',
                'observaciones' => $observaciones,
            ]);
            return redirect()->route('lavadero.index')->with('Hecho','Vehiculo actualizado');
        }else{
            return redirect()->back()->with('Error','No se realizo ninguna accion');
        }
    }
}
