<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehiculo;
use Illuminate\Support\Facades\Auth;

class LavaderoController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if(!$user || !$user->role || !in_array($user->role->nombre,['lavadero','admin'])){
            abort(403, 'Acceso no autorizado');
        }

        $vehiculos = Vehiculo::where('estado','devuelto')
        ->where(function($query){
            $query->where('sucio',true)
                ->orWhere('sin_gasolina',true);
        })->get();

        return view('lavadero.index',compact('vehiculos'));
    }

    public function actualizar(Request $request,$id)
    {
        $vehiculo = Vehiculo::findOrFail($id);

        $vehiculo->sucio =$request->has('sucio') ? false : $vehiculo->sucio;
        $vehiculo->sin_gasolina = $request->has('sin_gasolina') ? false : $vehiculo->sin_gasolina;

        $vehiculo->save();

        return redirect()->route('lavadero.index')->with('Hecho','Vehiculo actualizado');
    }
}
