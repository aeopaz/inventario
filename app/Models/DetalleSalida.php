<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleSalida extends Model
{
    use HasFactory;

    protected $fillable=[
'id_salida',
'id_articulo',
'cantidad',
'precio_unitario',
'descuento',
    ];
}
