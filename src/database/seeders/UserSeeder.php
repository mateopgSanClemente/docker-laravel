<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crea un usuario de prueba con el role 'cliente'
        User::create([
            'name' => 'Cliente',
            'email' => 'cliente@example.com',
            'role' => 'cliente',
            'password' => bcrypt('password'),
        ]);

        // Crea un usuario de prueba con el role 'taller'
        User::create([
            'name' => 'Taller',
            'email' => 'taller@example.com',
            'role' => 'taller',
            'password' => bcrypt('password'),
        ]);
    }
}
