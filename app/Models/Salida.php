<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salida extends Model
{
    use HasFactory;

    protected $fillable=[
        'id_cliente',
        'id_vendedor',
        'id_articulo',
        'cantidad',
        'precio_unitario',
        'precio_total',
        'descuento',
        'id_forma_pago',
        'tipo_salida',
    ];
}
