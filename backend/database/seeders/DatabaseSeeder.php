<?php

namespace Database\Seeders;


use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         //\App\Models\User::factory(20)->create();
         //\App\Models\Clientes::factory(20)->create();
        //\App\Models\Profissional::factory(8)->create();
        \App\Models\Agendamento::factory(20)->create();

       $this->call([
        ServicoSeeder::class,
       ]);
    }
}
