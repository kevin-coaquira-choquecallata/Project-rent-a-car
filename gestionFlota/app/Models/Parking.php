<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Parking extends Model
{
    use HasFactory;
    protected $fillable=['numero_plaza','vehiculo_id'];

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class);
    }
}
