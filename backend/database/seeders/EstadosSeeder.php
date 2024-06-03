<?php

namespace Database\Seeders;

use App\Models\Estados;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        Estados::insert([
            ['estado' => 'Acre', 'slug' => 'AC'],
            ['estado' => 'Alagoas', 'slug' => 'AL'],
            ['estado' => 'Amapá', 'slug' => 'AP'],
            ['estado' => 'Amazonas', 'slug' => 'AM'],
            ['estado' => 'Bahia', 'slug' => 'BA'],
            ['estado' => 'Ceará', 'slug' => 'CE'],
            ['estado' => 'Distrito Federal', 'slug' => 'DF'],
            ['estado' => 'Espírito Santo', 'slug' => 'ES'],
            ['estado' => 'Goiás', 'slug' => 'GO'],
            ['estado' => 'Maranhão', 'slug' => 'MA'],
            ['estado' => 'Mato Grosso', 'slug' => 'MT'],
            ['estado' => 'Mato Grosso do Sul', 'slug' => 'MS'],
            ['estado' => 'Minas Gerais', 'slug' => 'MG'],
            ['estado' => 'Pará', 'slug' => 'PA'],
            ['estado' => 'Paraíba', 'slug' => 'PB'],
            ['estado' => 'Paraná', 'slug' => 'PR'],
            ['estado' => 'Pernambuco', 'slug' => 'PE'],
            ['estado' => 'Piauí', 'slug' => 'PI'],
            ['estado' => 'Rio de Janeiro', 'slug' => 'RJ'],
            ['estado' => 'Rio Grande do Norte', 'slug' => 'RN'],
            ['estado' => 'Rio Grande do Sul', 'slug' => 'RS'],
            ['estado' => 'Rondônia', 'slug' => 'RO'],
            ['estado' => 'Roraima', 'slug' => 'RR'],
            ['estado' => 'Santa Catarina', 'slug' => 'SC'],
            ['estado' => 'São Paulo', 'slug' => 'SP'],
            ['estado' => 'Sergipe', 'slug' => 'SE'],
            ['estado' => 'Tocantins', 'slug' => 'TO'],
        ]);

      
    }
}
