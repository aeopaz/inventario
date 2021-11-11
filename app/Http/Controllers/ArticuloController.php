<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;




class ArticuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articulos=Articulo::all();
        return view('articulo.index',compact('articulos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articulo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->merge(['precio_venta'=>preg_replace('/[^0-9]+/','',$request->precio_venta)]);
        $request->validate([
            'nombre_articulo'=>'required|max:45',
            'descripcion'=>'required|max:200',
            'precio_venta'=>'required|numeric|max:999999',
            'file'=>'image|max:2048',
        ]);

        $articulo=new Articulo();
        $articulo->nombre=$request->nombre_articulo;
        $articulo->descripcion=$request->descripcion;
        $articulo->precio_venta=$request->precio_venta;
        //php artisan storage:link. Se debe ejecutar este comando para generar el acceso directo de storage en la carpeta public
        if($request->hasFile("file")){
            $imagen=$request->file("file")->store("public/imagenes/articulos");
            $url=Storage::url($imagen);//Cambia el nombre de la palabara public por storage para poder acceder correctamente a la imagen
            $articulo->imagen=$url;
            /*$imagen=$request->file("file");
            $nombre_imagen=Str::slug($request->nombre_articulo).".".$imagen->guessExtension();
            $ruta=asset("img/articulos/");
            copy($imagen->getRealPath(),$ruta.$nombre_imagen);
            $articulo->imagen=$ruta.$nombre_imagen;*/
        }
        $exitoso= $articulo->save();

        if($exitoso){
            return back()->with('success','El artículo ha sido creado');
        }else{
            return back()->with('fail','Ha ocurrido un error');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $articulo=Articulo::find($id);
        return view('articulo.show',compact('articulo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $articulo=Articulo::find($id);
        return view('articulo.edit',compact('articulo'));
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
        $request->merge(['precio_venta'=>preg_replace('/[^0-9]+/','',$request->precio_venta)]);
        $request->validate([
            'nombre_articulo'=>'required|max:45',
            'descripcion'=>'required|max:200',
            'precio_venta'=>'required|numeric|max:999999',
            'file'=>'image|max:2048',
        ]);

        $articulo=Articulo::find($id);
        $articulo->nombre=$request->nombre_articulo;
        $articulo->descripcion=$request->descripcion;
        $articulo->precio_venta=$request->precio_venta;
        //php artisan storage:link. Se debe ejecutar este comando para generar el acceso directo de storage en la carpeta public
        if($request->hasFile("file")){
            $imagen=$request->file("file")->store("public/imagenes/articulos");
            $url=Storage::url($imagen);//Cambia el nombre de la palabara public por storage para poder acceder correctamente a la imagen
            $articulo->imagen=$url;
            /*$imagen=$request->file("file");
            $nombre_imagen=Str::slug($request->nombre_articulo).".".$imagen->guessExtension();
            $ruta=asset("img/articulos/");
            copy($imagen->getRealPath(),$ruta.$nombre_imagen);
            $articulo->imagen=$ruta.$nombre_imagen;*/
        }
        $articulo->save();
    }

    public function edit_image ($id){
        $articulo=Articulo::find($id);
        return view('articulo.edit_image',compact('articulo'));
    }

    public function change_image(Request $request,$id){
        $request->merge(['precio_venta'=>preg_replace('/[^0-9]+/','',$request->precio_venta)]);
        $request->validate([
            'file'=>'image|max:2048',
        ]);

        $articulo=Articulo::find($id);
        //php artisan storage:link. Se debe ejecutar este comando para generar el acceso directo de storage en la carpeta public
        if($request->hasFile("file")){
            $imagen=$request->file("file")->store("public/imagenes/articulos");
            $url=Storage::url($imagen);//Cambia el nombre de la palabara public por storage para poder acceder correctamente a la imagen
            $articulo->imagen=$url;
            /*$imagen=$request->file("file");
            $nombre_imagen=Str::slug($request->nombre_articulo).".".$imagen->guessExtension();
            $ruta=asset("img/articulos/");
            copy($imagen->getRealPath(),$ruta.$nombre_imagen);
            $articulo->imagen=$ruta.$nombre_imagen;*/
        }
        $articulo->save();

        return back()->with('success','Se ha actualizado la imagen');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $articulo=Articulo::find($id);
        $articulo->delete();
        return back()->with('success','Al artículo ha sido eliminado');
    }
}
