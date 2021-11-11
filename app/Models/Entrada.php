<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_articulo',
        'id_proveedor',
        'cantidad',
        'costo_transporte',
        'costo_empaque',
        'costo_envio',
        'costo_operativo',
        'valor_compra_articulo',
        'id_forma_pago',
        'notas',

    ];

    public function articulos(){
        return $this->hasMany(Articulo::class,'articulo_id');
    }
}
