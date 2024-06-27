<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model
{
    use HasFactory;

    protected $fillable =[
        'cliente_id',
        'servico_id',
        'profissional_id',
        'data',
        'hora',
        'status',
        'pagamento',
        'preco',
        'data_pagamento'
    ];

    public function cliente(){return $this->belongsTo(Clientes::class);}

    public function servico(){return $this->belongsTo(Servico::class);}

    public function profissional(){return $this->belongsTo(Profissional::class);}
}
