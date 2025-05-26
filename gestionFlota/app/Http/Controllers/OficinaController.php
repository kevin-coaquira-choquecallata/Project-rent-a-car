<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehiculo;
use App\Models\Parking;
use Illuminate\Support\Facades\Auth;
use App\Models\HistorialMovimiento;

class OficinaController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        if (!$user || !$user->role || !in_array($user->role->nombre, ['oficina', 'admin'])) {
            abort(403, 'Acceso no autorizado');
        }
        $query = Vehiculo::where('estado', 'devuelto')
            ->where('sucio', false)
            ->where('sin_gasolina', false)
            ->whereDoesntHave('parking');
        //->whereNotNull('listo_entrega');
        //->whereHas('parking');
        //->where(function ($q){
        //$q->where('sucio',false)
        //->orWhere('sin_gasolina',false);
        //});
        //->where('sucio', false)
        //->where('sin_gasolina', false);
        //->where('listo_entrega',true);
        //->whereHas('parking');
        //->where('estado','!=','esperando piezas')
        //->get();
        if ($request->filled('busqueda')) {
            $busqueda = $request->input('busqueda');
            $query->where(function ($q) use ($busqueda) {
                $q->where('matricula', 'like', "%$busqueda%")
                    ->orWhere('modelo', 'like', "%$busqueda%")
                    ->orWhere('marca', 'like', "%$busqueda%");
            });
        }
        $vehiculos = $query->get();
        $plazas = Parking::with('vehiculo')->get();
        $vehiculosListosSinPlaza = Vehiculo::where('listo_entrega', true)
            ->whereDoesntHave('parking')
            ->get();
        return view('oficina.index', compact('vehiculos', 'plazas', 'vehiculosListosSinPlaza'));
    }
    public function actualizar(Request $request, $id)
    {
        $vehiculo = Vehiculo::findOrFail($id);

        $estadoAnterior = $vehiculo->estado;
        $sucioAntes = $vehiculo->sucio;
        $gasolinaAntes = $vehiculo->sin_gasolina;

        $vehiculo->estado = $request->estado;
        $vehiculo->sucio = $request->has('sucio');
        $vehiculo->sin_gasolina = $request->has('sin_gasolina');
        $vehiculo->observaciones = $request->input('observaciones');

        $vehiculo->save();

        $accion = 'actualizado desde Oficina';
        $observaciones = "";
        if ($vehiculo->sucio) {
            $observaciones .= "Marcado como sucio<br>";
        }
        if ($vehiculo->sin_gasolina) {
            $observaciones .= "Marcado sin gasolina <br>";
        }
        if ($vehiculo->observaciones) {
            $observaciones .= "Notas: " . e($vehiculo->observaciones) . '<br>';
        }

        HistorialMovimiento::create([
            'vehiculo_id' => $vehiculo->id,
            'usuario_id' => Auth::id(),
            'accion' => $accion,
            'observaciones' => $observaciones,
        ]);

        return redirect()->route('oficina.index')->with('Hecho', 'Vehiculo actualizado');
    }
    public function verMecanico()
    {
        $user = Auth::user();
        if (!$user || !$user->role || !in_array($user->role->nombre, ['oficina', 'admin'])) {
            abort(403, 'Acceso no autorizado');
        }

        $vehiculosMecanico = Vehiculo::whereIn('estado', ['taller', 'esperando piezas'])->get();

        return view('oficina.mecanico', compact('vehiculosMecanico'));
    }
    public function verPendientes(Request $request)
    {
        $user = Auth::user();
        if (!$user || !$user->role || !in_array($user->role->nombre, ['oficina', 'admin'])) {
            abort(403, 'Acceso no autorizado');
        }
        $busqueda = $request->input('busqueda');

        $query = Vehiculo::where(function ($q) {
            $q->where('sucio', true)
                ->orWhere('sin_gasolina', true)
                ->orWhereIn('estado', ['taller', 'esperando piezas']);
        });

        if ($busqueda) {
            $query->where(function ($q) use ($busqueda) {
                $q->where('matricula', 'like', "%$busqueda%")
                    ->orWhere('modelo', 'like', "%$busqueda%")
                    ->orWhere('marca', 'like', "%$busqueda%");
            });
        }

        $vehiculos = $query->get();

        $plazasLibres = Parking::whereNull('vehiculo_id')->get();

        return view('oficina.pendientes', compact('vehiculos', 'plazasLibres', 'busqueda'));
    }
    public function verListosSinPlaza(Request $request)
    {
        $user = Auth::user();

        if (!$user || !$user->role || !in_array($user->role->nombre, ['oficina', 'admin'])) {
            abort(403, 'Acceso no autorizad');
        }
        $busqueda = $request->input('busqueda');

        $query = Vehiculo::where('listo_entrega', true)
            ->whereDoesntHave('parking');

        if ($busqueda) {
            $query->where(function ($q) use ($busqueda) {
                $q->where('matricula', 'like', "%$busqueda%")
                    ->orWhere('modelo', 'like', "%$busqueda%")
                    ->orWhere('marca', 'like', "%$busqueda%");
            });
        }
        $vehiculosListosSinPlaza = $query->get();

        return view('oficina.sinplaza', compact('vehiculosListosSinPlaza', 'busqueda'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'matricula' => 'required|unique:vehiculos',
            'marca' => 'required',
            'modelo' => 'required',
            'combustible' => 'required|in:Gasolina,Diesel,Hibrido,Electrico',
        ]);
        $vehiculo = new Vehiculo();
        $vehiculo->matricula = $request->matricula;
        $vehiculo->marca = $request->marca;
        $vehiculo->modelo = $request->modelo;
        $vehiculo->combustible = $request->combustible;
        $vehiculo->estado = 'devuelto';
        $vehiculo->sucio = false;
        $vehiculo->sin_gasolina = false;

        $vehiculo->save();

        return redirect()->route('oficina.index')->with('Hecho', 'Vehículo añadido correctamente.');
    }
}
