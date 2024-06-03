<?php

namespace Database\Seeders;

use App\Models\Cidades;
use App\Models\Estados;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Primeiro, obtenha o ID do estado de Santa Catarina
        $santaCatarina = Estados::where('slug', 'SC')->first();

        if ($santaCatarina) {
            Cidades::insert([
                ['cidade' => 'Centro', 'slug' => 'centro', 'estado_id' => $santaCatarina->id],
                ['cidade' => 'Meia Praia', 'slug' => 'meia-praia', 'estado_id' => $santaCatarina->id],
                ['cidade' => 'Canto da Praia', 'slug' => 'canto-da-praia', 'estado_id' => $santaCatarina->id],
                ['cidade' => 'Ilhota', 'slug' => 'ilhota', 'estado_id' => $santaCatarina->id],
                ['cidade' => 'Alto São Bento', 'slug' => 'alto-sao-bento', 'estado_id' => $santaCatarina->id],
            ]);
        } else {
            echo "Estado de Santa Catarina não encontrado!\n";
        }
    }
}
