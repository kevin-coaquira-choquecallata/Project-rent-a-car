<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehiculo;
use Illuminate\Support\Facades\Auth;

class OficinaController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if(!$user || !$user->role || !in_array($user->role->nombre,['oficina','admin'])){
            abort(403, 'Acceso no autorizado');
        }
        $vehiculos = Vehiculo::where('estado','devuelto')->get();
        return view('oficina.index',compact('vehiculos'));
    }
    public function actualizar(Request $request,$id)
    {
        $vehiculo = Vehiculo::findOrFail($id);
        $vehiculo->estado=$request->estado;
        $vehiculo->sucio=$request->has('sucio');
        $vehiculo->sin_gasolina=$request->has('sin_gasolina');
        $vehiculo->en_taller=$request->has('en_taller');

        $vehiculo->save();

        return redirect()->route('oficina.index')->with('Hecho','Vehiculo actualizado');
    }
}
