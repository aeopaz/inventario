@extends('adminlte::page')

@section('title', 'Crear Artículo')

@section('content_header')
    <h1>Crear Artículo</h1>
@stop

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Crear Artículo</div>
        <div class="card-body">
            <form action="{{route('articulo.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="results">
                    @if(Session::get('success'))
                    <div class="alert alert-success">
                        {{Session::get('success')}}
                    </div>
                    @endif
                    @if(Session::get('fail'))
                    <div class="alert alert-danger">
                        {{Session::get('fail')}}
                    </div>
                    @endif
                </div>
                <div class="row justify-content-center">
                    <div class="col-2">
                        <label for="nombre_articulo">Nombre</label>
                    </div>
                    <div class="col-6">
                        <input id="nombre_articulo" name="nombre_articulo"
                            class="form-control @error ('nombre_articulo') is-invalid @enderror" value="{{old('nombre_articulo')}}">
                        @error('nombre_articulo')
                        <span class="invalid-feedback" role="alert">
                            <strong> {{$message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-2">
                        <label for="descripcion">Descripción</label>
                    </div>
                    <div class="col-6">
                        <textarea id="descripcion" name="descripcion"
                            class="form-control @error ('descripcion') is-invalid @enderror" rows="5" cols="22"
                            maxlength="200">{{old('descripcion')}}</textarea>
                        @error('descripcion')
                        <span class="invalid-feedback" role="alert">
                            <strong> {{$message}}</strong>
                        </span>
                        @enderror
                        <div id="contador" class="h6">200 Caracteres</div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-2">
                        <label for="valor_unitario">Valor Unitario</label>
                    </div>
                    <div class="col-6">
                        <input id="precio_venta" name="precio_venta"
                            class="form-control @error ('precio_venta') is-invalid @enderror" value="{{old('precio_venta')}}">
                        @error('precio_venta')
                        <span class="invalid-feedback" role="alert">
                            <strong> {{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-2">
                        <label for="file">Imagen</label>
                    </div>
                    <div class="col-6">
                        <input id="file" type="file" name="file" accept="image/*"
                            class="form-control-file @error ('file') is-invalid @enderror" value="{{old('file')}}">
                        @error('file')
                        <span class="invalid-feedback" role="alert">
                            <strong> {{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-2">
                        <button class="btn btn-primary" type="submit">Grabar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script src="/js/articulo/articulo.js"></script>
<script src="/js/generales/formatos.js"></script>
@stop
