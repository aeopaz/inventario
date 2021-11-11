<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Faker\Provider\ar_JO\Person;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes=Persona::where('id_tipo_persona',1)->get();//Obtiene las personas que sean tipo 1, es decir, clientes
        return view('cliente.index',compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cliente.create');
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
            'nombre'=>'required|max:45',
            'direccion'=>'required|max:45',
            'celular'=>'required|numeric|min:1111111111|max:9999999999',
            'email'=>'required|email',
        ]);

        $cliente=new Persona();
        $cliente->nombre=$request->nombre;
        $cliente->direccion=$request->direccion;
        $cliente->celular=$request->celular;
        $cliente->email=$request->email;
        $cliente->id_tipo_persona=1;
        $cliente->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cliente=Persona::find($id);
        return view('cliente.edit', compact('cliente'));
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
            'nombre'=>'required|max:45',
            'direccion'=>'required|max:45',
            'celular'=>'required|numeric|min:1111111111|max:9999999999',
            'email'=>'required|email',
        ]);

        $cliente=Persona::find($id);
        $cliente->nombre=$request->nombre;
        $cliente->direccion=$request->direccion;
        $cliente->celular=$request->celular;
        $cliente->email=$request->email;
        $cliente->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cliente=Persona::find($id);
        $cliente->delete();

        return back()->with('success','El registro ha sido eliminado');
    }
}
