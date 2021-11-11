<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use App\Models\Cartera;
use App\Models\DetalleCartera;
use App\Models\Persona;
use App\Models\Salida;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalidasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       $salidas= $this->consulta_salida('%');

        return view('salida.index', compact('salidas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $articulos = Articulo::all();
        $clientes = Persona::where('id_tipo_persona', '1')->get();//Consulta las personas que sean clientes
        return view('salida.create', compact('articulos', 'clientes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->merge(['precio_unitario'=>preg_replace('/[^0-9]+/','',$request->precio_unitario)]);
        $articulo=Articulo::find($request->articulo);
        $request->validate([
            'articulo'=>'required',
            'cliente'=>'required',
            'cantidad'=>'required|numeric|min:1|max:'.$articulo->cantidad,
            'precio_unitario'=>'required|numeric',
            'descuento'=>'required|numeric',
            'forma_pago'=>'required',
            'notas'=>'required|max:200',
            'numero_cuotas'=>'required_if:forma_pago,2'
        ]);

        //Registra la salida
        $salida=new Salida();
        $salida->id_articulo=$request->articulo;
        $salida->id_cliente=$request->cliente;
        $salida->id_vendedor=Auth::user()->id;
        $salida->cantidad=$request->cantidad;
        $salida->precio_unitario=$request->precio_unitario;
        $salida->precio_total=$request->cantidad*$request->precio_unitario;
        $salida->descuento=$request->descuento/100;
        $salida->precio_venta=($request->cantidad*$request->precio_unitario)-($request->cantidad*$request->precio_unitario*$request->descuento/100);//Calcular el valor venta con descuento
        $salida->id_forma_pago=$request->forma_pago;
        $salida->tipo_salida='Venta';
        $salida->notas=$request->notas;
        $salida->save();

        //Afecta el invetario de artículos restando la cantidad de artículos
        $articulo=Articulo::find($request->articulo);
        $articulo->cantidad=$articulo->cantidad-$request->cantidad;
        $articulo->save();

        //Si la forma de pago es 2 (Crédito) Se registra en cartera
        if($request->forma_pago==2){
            $cartera=new Cartera();
            $cartera->id_cliente=$request->cliente;
            $cartera->id_salida=$salida->id;
            $cartera->numero_cuotas=$request->numero_cuotas;
            $cartera->save();

            for($i=1;$i<=$request->numero_cuotas;$i++){
                $detalle_cartera=new DetalleCartera();
                $detalle_cartera->id_cartera=$cartera->id;
                $detalle_cartera->valor_abono=0;
                $detalle_cartera->save();
            }



        }


        return back()->with('success','La salida ha sido registrada');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $salida =$this->consulta_salida($id);
        //return $salida;
        return view('salida.show',compact('salida'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function consultar_articulo(Request $request){//Consulta los datos de un artículo, petición fech

        $articulo=Articulo::where('id',$request->id_articulo)->get();
        return response()->json(
            [
                'lista' => $articulo,
                'success' => true
            ]
        );

    }
    public function consulta_salida($id){//Query para consultar salida artículo
        $salidas = Salida::select(
            'salidas.id',
            'salidas.id_cliente',
            'salidas.id_vendedor',
            'salidas.id_articulo',
            'salidas.cantidad',
            'salidas.precio_unitario',
            'salidas.precio_total',
            'salidas.descuento',
            'salidas.precio_venta',
            'salidas.id_forma_pago',
            'salidas.tipo_salida',
            'salidas.notas',
            'articulos.nombre AS nombre_articulo',
            'personas.nombre AS nombre_cliente',
            'users.name AS nombre_vendedor'
        )
            ->from('salidas')
            ->join('articulos', 'articulos.id', '=', 'salidas.id_articulo')
            ->join('users', 'users.id', '=', 'salidas.id_vendedor')
            ->join('personas', 'personas.id', '=', 'salidas.id_cliente')
            ->where('salidas.id','LIKE',$id.'%')->get();

            return $salidas;

    }
}
