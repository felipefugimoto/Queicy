<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Servico>
 */
class ServicoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tipo'=>$this->faker->randomElement(['Coloração e Mechas','Corte de Cabelo','Alisamento e Relaxamento','Penteados e Estilização']),
            'descricao' =>$this->faker->text,
            'duracao'=>$this->faker->time(),
        ];
    }
}
