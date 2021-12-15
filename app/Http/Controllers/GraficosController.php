<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use App\Models\DetalleCartera;
use App\Models\Entrada;
use App\Models\Salida;
use Illuminate\Http\Request;

class GraficosController extends Controller
{
    public function index()
    {
        $cantidad_entradas = Entrada::sum('cantidad');
        $cantidad_salidas = Salida::sum('cantidad');
        $cantidad_articulos=Articulo::sum('cantidad');
        $valor_ventas = Salida::sum('precio_venta');
        $valor_abonado = DetalleCartera::sum('valor_abono');
        $valor_por_cobrar = $valor_ventas - $valor_abonado;
        $articulos = Articulo::all();
        $puntos_articulos = [];

        //Obtiene la cantidad por artículo
        foreach ($articulos as $articulo) {
            $puntos_articulos[] = ['name' => $articulo->nombre, 'y' => $articulo->cantidad];
        }

        //Almacenar en un array la cantidad de artículos que han entrado y salido
        $puntos_entradas_salidas[0] = ['name' => 'Entradas', 'y' => intval($cantidad_entradas)]; //intval para convertir cadena a un número
        $puntos_entradas_salidas[1] = ['name' => 'Salidas', 'y' => intval($cantidad_salidas)];

        return $puntos_articulos;

        //Almacenar en un array para hacer un comparativo entre entadas, salidas y stock
        $inventario[0] = ['name' => 'Entradas', 'y' => intval($cantidad_entradas)]; //intval para convertir cadena a un número
        $inventario[1] = ['name' => 'Salidas', 'y' => intval($cantidad_salidas)];
        $inventario[2] = ['name' => 'Stock', 'y' => intval($cantidad_articulos)];

        //Almacenar en un array informe de ventas
        $informe_ventas[0] = ['name' => 'Ventas', 'y' => intval($valor_ventas)]; //intval para convertir cadena a un número
        $informe_ventas[1] = ['name' => 'Pagado', 'y' => intval($valor_abonado)];
        $informe_ventas[2] = ['name' => 'Por Cobrar', 'y' => intval($valor_por_cobrar)];

        //Convierto los datos en formato json
        $articulosJS = json_encode($puntos_articulos);
        $entradas_salidasJS = json_encode($puntos_entradas_salidas);
        $informe_ventasJS=json_encode($informe_ventas);
        $inventarioJS=json_encode($inventario);






        return view('graficos.index', compact('articulosJS', 'entradas_salidasJS','informe_ventasJS','inventarioJS'));
    }
}
