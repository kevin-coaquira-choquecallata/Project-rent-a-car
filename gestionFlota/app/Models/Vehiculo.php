<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    protected $fillable = ['marca','modelo','combustible','estado','listo_entrega','imagen'];

    public function parking()
    {
        return $this->hasOne(Parking::class,'vehiculo_id');
    }
}
