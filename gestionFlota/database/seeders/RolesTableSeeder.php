<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('roles')->insertOrIgnore([
            ['nombre'=>'admin'],
            ['nombre'=>'lavadero'],
            ['nombre'=>'mecanico'],
            ['nombre'=>'oficina']
        ]);
    }
}
