<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use App\Models\Entrada;
use App\Models\Inventario;
use App\Models\Persona;
use Illuminate\Http\Request;

class EntradasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entradas = Entrada::select('entradas.id AS id_entrada', 'entradas.id_articulo', 'articulos.nombre AS nombre_articulo', 'personas.nombre AS nombre_proveedor', 'entradas.cantidad')
            ->from('entradas')
            ->join('articulos', 'articulos.id', '=', 'entradas.id_articulo')
            ->join('personas', 'personas.id', '=', 'entradas.id_proveedor')->get();


        return view('entrada.index', compact('entradas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $articulos = Articulo::all();
        $proveedores = Persona::where('id_tipo_persona', '2')->get();
        return view('entrada.create', compact('articulos', 'proveedores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'articulo' => 'required',
            'proveedor' => 'required',
            'cantidad' => 'required|numeric',
            'costo_transporte' => 'required|numeric',
            'costo_empaque' => 'required|numeric',
            'costo_envio' => 'required|numeric',
            'costo_operativo' => 'required|numeric',
            'valor_compra' => 'required|numeric',
            'forma_pago' => 'required',
            'notas' => 'required|max:200',
        ]);

        $entrada = new Entrada();
        $entrada->id_articulo = $request->articulo;
        $entrada->id_proveedor = $request->proveedor;
        $entrada->cantidad = $request->cantidad;
        $entrada->costo_empaque = $request->costo_empaque;
        $entrada->costo_envio = $request->costo_envio;
        $entrada->costo_operativo = $request->costo_operativo;
        $entrada->costo_transporte = $request->costo_transporte;
        $entrada->valor_compra_articulo = $request->valor_compra;
        $entrada->id_forma_pago = $request->forma_pago;
        $entrada->notas = $request->notas;
        $entrada->save();

        //Se aumenta la cantidad en la tabla artículos
        $articulo= Articulo::find($request->articulo);
        $articulo->cantidad=$articulo->cantidad+$request->cantidad;
        $articulo->save();

        return back()->with('success', 'La entrada ha sido registrada');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $entrada = Entrada::select(
            'entradas.id AS id_entrada',
            'entradas.id_articulo',
            'articulos.nombre AS nombre_articulo',
            'personas.nombre AS nombre_proveedor',
            'entradas.costo_transporte',
            'entradas.costo_empaque',
            'entradas.costo_envio',
            'entradas.costo_operativo',
            'entradas.valor_compra_articulo',
            'entradas.id_forma_pago',
            'entradas.notas',
            'entradas.cantidad'
        )
            ->from('entradas')
            ->join('articulos', 'articulos.id', '=', 'entradas.id_articulo')
            ->join('personas', 'personas.id', '=', 'entradas.id_proveedor')
            ->where('entradas.id', $id)->get();
        return view('entrada.show', compact('entrada'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $entrada = Entrada::select(
            'entradas.id AS id_entrada',
            'entradas.id_articulo',
            'entradas.id_proveedor',
            'articulos.nombre AS nombre_articulo',
            'personas.nombre AS nombre_proveedor',
            'entradas.costo_transporte',
            'entradas.costo_empaque',
            'entradas.costo_envio',
            'entradas.costo_operativo',
            'entradas.valor_compra_articulo',
            'entradas.id_forma_pago',
            'entradas.notas',
            'entradas.cantidad'
        )
            ->from('entradas')
            ->join('articulos', 'articulos.id', '=', 'entradas.id_articulo')
            ->join('personas', 'personas.id', '=', 'entradas.id_proveedor')
            ->where('entradas.id', $id)->get();

            $articulos = Articulo::all();
            $proveedores = Persona::where('id_tipo_persona', '2')->get();

        return view('entrada.edit', compact('entrada','articulos','proveedores'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        $request->validate([
            'articulo' => 'required',
            'proveedor' => 'required',
            'cantidad' => 'required|numeric',
            'costo_transporte' => 'required|numeric',
            'costo_empaque' => 'required|numeric',
            'costo_envio' => 'required|numeric',
            'costo_operativo' => 'required|numeric',
            'valor_compra' => 'required|numeric',
            'forma_pago' => 'required',
            'notas' => 'required|max:200',
        ]);

        $entrada = Entrada::find($id);
        $entrada->id_articulo = $request->articulo;
        $entrada->id_proveedor = $request->proveedor;
        $entrada->cantidad = $request->cantidad;
        $entrada->costo_empaque = $request->costo_empaque;
        $entrada->costo_envio = $request->costo_envio;
        $entrada->costo_operativo = $request->costo_operativo;
        $entrada->costo_transporte = $request->costo_transporte;
        $entrada->valor_compra_articulo = $request->valor_compra;
        $entrada->id_forma_pago = $request->forma_pago;
        $entrada->notas = $request->notas;
        $entrada->save();

        return back()->with('success', 'La entrada ha sido actualizada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $entrada=Entrada::find($id);
        $entrada->delete();
        return back()->with('success','El registro ha sido eliminado');

    }
}
