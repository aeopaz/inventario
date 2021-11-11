<?php

namespace App\Http\Controllers;

use App\Models\Cartera;
use App\Models\DetalleCartera;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class CarteraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cartera=$this->consulta_cartera('%');
        $detalle_cartera = DB::select('select id_cartera, sum(valor_abono) as abono from detalle_carteras group by id_cartera');

        return view('cartera.index',compact('cartera','detalle_cartera'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cartera=$this->consulta_cartera($id);
        $detalle_cartera = DetalleCartera::where('id_cartera',$id)->get();
        return view('cartera.show',compact('cartera','detalle_cartera'));
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

    public function update_detalle_cartera(Request $request, $id,$id_cartera){

        $cartera=$this->consulta_cartera($id_cartera);//Consulta el precio de venta
        $valor_abonado = DB::table('detalle_carteras')->where('id', '=', $id)->sum('valor_abono');
        $valor_pendiente=$cartera[0]->precio_venta-$valor_abonado;//Calcula el valor que tiene el cliente pendiente por abonar
        $request->validate([
            'valor_abono'=>'required|numeric|min:1|max:'.$valor_pendiente,
            'fecha_abono'=>'required|date',

        ]);
        $detalle_cartera=DetalleCartera::find($id);
        $detalle_cartera->valor_abono=$request->valor_abono;
        $detalle_cartera->fecha_abono=$request->fecha_abono;
        $detalle_cartera->save();

        return back()->with('success','El abono se ha registrado correctamente');

    }

    public function consulta_cartera($id){
        $cartera=Cartera::select(
            'carteras.id',
            'carteras.created_at AS fecha_cartera',
            'carteras.numero_cuotas',
            'personas.nombre AS nombre_cliente',
            'salidas.precio_venta',
            'salidas.id as id_salida',
            'articulos.id AS id_articulo',
            'articulos.nombre AS nombre_articulo',

        )
        ->from('carteras')
        ->join('personas','personas.id','=','carteras.id_cliente')
        ->join('salidas','salidas.id','=','carteras.id_salida')
        ->join('articulos','articulos.id','=','salidas.id_articulo')
        ->where('carteras.id','LIKE',$id.'%')
        ->where('salidas.id_forma_pago','=',2)
        ->get();

        return $cartera;

    }


}
