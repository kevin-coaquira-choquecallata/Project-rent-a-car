<?php

namespace Database\Seeders;

use App\Models\Vehiculo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehiculoSeeder extends Seeder
{
    private array $matriculasGeneradas = [];
    public function run(): void
    {
        Vehiculo::truncate();
        $vehiculos = [
            ['marca' => 'Ford', 'modelo' => 'Fiesta', 'matricula'=>'1234NBB', 'combustible' =>'Gasolina', 'imagen' => 'vehiculos/ford-fiesta.jpg'],
            ['marca' => 'Ford', 'modelo' => 'Fiesta', 'matricula'=>'4321MNB', 'combustible' =>'Diesel','imagen'=> 'vehiculos/ford-fiesta.jpg'],

            ['marca' => 'Volkswagen', 'modelo' => 'Golf', 'matricula' =>'0987MNN', 'combustible'=>'Gasolina', 'imagen'=>'vehiculos/volkswagen-golf.jpg'],
            ['marca' => 'Volkswagen', 'modelo' => 'Golf', 'matricula'=> '1358NPC', 'combustible'=>'Gasolina','imagen' => 'vehiculos/volkswagen-golf.jpg'],

            ['marca'=>'Toyota','modelo'=>'Corolla','matricula' => '9395MZZ', 'combustible'=> 'Hibrido/Gasolina', 'imagen' => 'vehiculos/toyota.jpg'],
            ['marca' => 'Toyota', 'modelo' => 'Corolla', 'matricula'=>'5790MPC', 'combustible'=> 'Hibrido/Gasolina','imagen' => 'vehiculos/toyota.jpg'],

            ['marca' => 'Seat', 'modelo' => 'Ibiza','matricula'=>'0001NBB','combustible'=>'gasolina', 'imagen'=> 'vehiculos/ibiza.avif'],
            ['marca' => 'Seat', 'modelo' => 'Ibiza', 'matricula'=>'0108MJK','combustible'=>'gasolina','imagen'=> 'vehiculos/ibiza.avif'],

            ['marca' => 'Tesla', 'modelo'=> 'Model S', 'matricula'=>'5625NDF', 'combustible'=> 'Electrico','imagen'=>'vehiculos/tesla.jpg'],
            ['marca' => 'Tesla', 'modelo'=> 'Model S', 'matricula'=>'2947MZM','combustible'=>'Electrico','imagen'=>'vehiculos/tesla.jpg'],

            ['marca' => 'Fiat' ,'modelo'=> '500','matricula'=>'9593MPW', 'combustible'=>'gasolina', 'imagen'=>'vehiculos/fiat.avif'],
            ['marca' => 'Fiat' ,'modelo'=> '500', 'matricula'=>'5159MTZ','combustible'=>'gasolina','imagen'=>'vehiculos/fiat.avif'],
        ];

        foreach($vehiculos as $vehiculo){
            Vehiculo::create(array_merge($vehiculo,[
                'estado'=>'devuelto',
                'sucio'=>false,
                'sin_gasolina'=>false,
                'en_taller'=>false,
                'created_at'=>now(),
                'updated_at'=>now(),
            ]));
        }
    }
}
