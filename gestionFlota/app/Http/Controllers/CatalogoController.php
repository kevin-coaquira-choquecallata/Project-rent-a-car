<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use Illuminate\Http\Request;

class CatalogoController extends Controller
{
    public function index(){
        $vehiculos = Vehiculo::all();
        return view('catalogo.index',compact('vehiculos'));
    }
}
