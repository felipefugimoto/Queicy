<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estados extends Model
{
    use HasFactory;
    protected $table = 'estados'; // Certifique-se de que o nome da tabela está correto

    protected $fillable = ['estado', 'slug'];
}
