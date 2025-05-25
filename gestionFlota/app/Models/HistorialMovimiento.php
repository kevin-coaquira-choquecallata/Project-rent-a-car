<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HistorialMovimiento extends Model
{
    use HasFactory;

    protected $table = 'historial_movimientos';


    protected $fillable = [
        'vehiculo_id',
        'usuario_id',
        'accion',
        'observaciones',
        'fecha',
    ];

    protected $casts = [
        'fecha' => 'datetime',
    ];

    public $timestamps = true;

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class);
    }
    public function usuario()
    {
        return $this->belongsTo(User::class);
    }
}
