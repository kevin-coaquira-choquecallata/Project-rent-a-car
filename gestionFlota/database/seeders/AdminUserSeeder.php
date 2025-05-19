<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::firstOrCreate(['nombre' => 'admin']);

        $admin = User::updateOrCreate(
            ['email' => 'kevin.choquecallata@gmail.com'], 
            [
                'name' => 'Kevin',
                'password' => Hash::make('1234Abcdcd*'), 
                'email_verified_at' => now(),
                'role_id' => $adminRole->id
            ]
        );

        $this->command->info('Se creo el usuario admin para kevin');
    }
}
