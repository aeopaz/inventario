<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;


class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proveedores=Persona::where('id_tipo_persona',2)->get();//Obtiene las personas que sean tipo 2, es decir, proveedores
        return view('proveedor.index',compact('proveedores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('proveedor.create');
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

        $proveedor=new Persona();
        $proveedor->nombre=$request->nombre;
        $proveedor->direccion=$request->direccion;
        $proveedor->celular=$request->celular;
        $proveedor->email=$request->email;
        $proveedor->id_tipo_persona=2;
        $proveedor->save();
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
        $proveedor=Persona::find($id);
        return view('proveedor.edit', compact('proveedor'));
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

        $proveedor=Persona::find($id);
        $proveedor->nombre=$request->nombre;
        $proveedor->direccion=$request->direccion;
        $proveedor->celular=$request->celular;
        $proveedor->email=$request->email;
        $proveedor->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $proveedor=Persona::find($id);
        $proveedor->delete();

        return back()->with('success','El registro ha sido eliminado');
    }

}
