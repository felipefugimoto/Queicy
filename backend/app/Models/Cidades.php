<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cidades extends Model
{
    use HasFactory;
    protected $fillable = ['cidade', 'slug', 'estado_id'];

    public function estados()
    {
        return $this->belongsTo(Estados::class);
    }
}
