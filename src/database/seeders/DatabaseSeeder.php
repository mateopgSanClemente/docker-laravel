<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Creamos un usuario con el role 'taller'
        User::factory()->create([
            'name' => 'Taller',
            'email' => 'taller@example.com',
            'password' => bcrypt('password'),
            'role' => 'taller'
        ]);

        // Creamos un usuario con el role 'cliente'
        User::factory()->create([
            'name' => 'Cliente',
            'email' => 'cliente@example.com',
            'password' => bcrypt('password'),
            'role' => 'cliente'
        ]);
    }
}
