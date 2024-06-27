<?php

namespace Database\Factories;

use App\Models\Clientes;
use App\Models\Profissional;
use App\Models\Servico;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Agendamento>
 */
class AgendamentoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {   $status = $this->faker->boolean();
        return [
            'cliente_id' => Clientes::all()->random()->id,
            'servico_id' => Servico::all()->random()->id,
            'profissional_id'=> Profissional::all()->random()->id,
            'data'=> $this-> faker->date(),
            'hora' =>$this->faker->dateTimeBetween('08:00', '18:00')->format('H:i'),
            'status'=>$status,
            'pagamento'=> $this->faker->randomElement(['C','D','P','Di']),
            'preco'=> $this->faker->numberBetween(1, 1000),
            'data_pagamento'=> $status ? $this->faker->dateTimeThisMonth() : null,

        ];
    }
}
