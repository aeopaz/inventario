<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cartera extends Model
{
    use HasFactory;

    protected $fillable=[
        'id_cliente',
        'id_salida',
        'numero_cuotas',

    ];
}
