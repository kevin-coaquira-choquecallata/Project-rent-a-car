<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Parking;

class ParkingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Parking::truncate();
        for($i=1;$i<=10;$i++){
            Parking::create([
                'numero_plaza'=>$i,
                'vehiculo_id'=>null,
            ]);
        }
    }
}
