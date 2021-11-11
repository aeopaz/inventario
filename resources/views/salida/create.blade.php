@extends('adminlte::page')

@section('title', 'Registrar Salida')
@section('plugins.Salidas',true)

@section('content_header')
<h1>Registrar Salida</h1>
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Registrar Salida</div>
                <div class="card-body">
                    <form action="{{route('salida.store')}}" method="post" id="form_crear_salida">
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
                        <div class="row">
                            <b class="col-md-4 col-form-label text-md-right">Artículo</b>
                            <div class="col-md-6">
                                <select class="form-control @error ('articulo') is-invalid @enderror" id="articulo"
                                    name="articulo" value="{{old('articulo')}}">
                                    <option value="">Seleccione...</option>
                                    @foreach ($articulos as $articulo)
                                    <option value="{{$articulo->id}}">{{$articulo->nombre}}</option>
                                    @endforeach
                                </select>
                                @error('articulo')
                                <span class="invalid-feedback" role="alert">
                                    <strong> {{$message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <b class="col-md-4 col-form-label text-md-right">Stock</b>
                            <div class="col-md-6">
                                <input readonly id="stock" name="stock"
                                    class="form-control @error ('stock') is-invalid @enderror" type="number"
                                    value="{{old('stock')}}">
                                @error('stock')
                                <span class="invalid-feedback" role="alert">
                                    <strong> {{$message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <b class="col-md-4 col-form-label text-md-right">Precio Unitario</b>
                            <div class="col-md-6">
                                <input readonly id="precio_unitario" name="precio_unitario"
                                    class="form-control @error ('precio_unitario') is-invalid @enderror"
                                    value="{{old('precio_unitario')}}">
                                @error('precio_unitario')
                                <span class="invalid-feedback" role="alert">
                                    <strong> {{$message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <b class="col-md-4 col-form-label text-md-right">Cliente</b>
                            <div class="col-md-6">
                                <select
                                    class="js-example-basic-single form-control @error ('cliente') is-invalid @enderror"
                                    name="cliente">
                                    <option value="">Seleccione...</option>
                                    @foreach ($clientes as $cliente)
                                    <option value="{{old('cliente') ?? $cliente->id ?? ""}}">{{$cliente->nombre}}
                                    </option>
                                    @endforeach
                                </select>
                                @error('cliente')
                                <span class="invalid-feedback" role="alert">
                                    <strong> {{$message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <b class="col-md-4 col-form-label text-md-right">Cantidad</b>
                            <div class="col-md-6">
                                <input id="cantidad" name="cantidad"
                                    class="form-control @error ('cantidad') is-invalid @enderror" type="number"
                                    value="{{old('cantidad')}}">
                                @error('cantidad')
                                <span class="invalid-feedback" role="alert">
                                    <strong> {{$message }}</strong>
                                </span>
                                @enderror
                                <span class="invalid-feedback" role="alert">
                                    <strong id="cantidadError"></strong>
                                </span>
                            </div>
                        </div>

                        <div class="row">
                            <b class="col-md-4 col-form-label text-md-right">Precio Total</b>
                            <div class="col-md-6">
                                <input readonly id="precio_total" name="precio_total"
                                    class="form-control @error ('precio_total') is-invalid @enderror"
                                    value="{{old('precio_total')}}">
                                @error('precio_total')
                                <span class="invalid-feedback" role="alert">
                                    <strong> {{$message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <b class="col-md-4 col-form-label text-md-right">Descuento</b>
                            <div class="col-md-6">
                                <select name="descuento" id="descuento" class="form-control">
                                    <option value="">Seleccione...</option>
                                    @for ($i=0;$i<=100;$i++) <option value="{{$i}}">{{$i.'%'}}</option>
                                        @endfor
                                </select>
                                @error('descuento')
                                <span class="invalid-feedback" role="alert">
                                    <strong> {{$message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <b class="col-md-4 col-form-label text-md-right">Precio Venta</b>
                            <div class="col-md-6">
                                <input readonly id="precio_venta" name="precio_venta"
                                    class="form-control @error ('precio_venta') is-invalid @enderror"
                                    value="{{old('precio_venta')}}">
                                @error('precio_venta')
                                <span class="invalid-feedback" role="alert">
                                    <strong> {{$message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <b class="col-md-4 col-form-label text-md-right">Forma de Pago</b>
                            <div class="col-md-6">
                                <select class="form-control @error ('forma_pago') is-invalid @enderror"
                                    name="forma_pago" id="forma_pago">
                                    <option value="">Seleccione...</option>
                                    <option value="1">Contado</option>
                                    <option value="2">Crédito</option>
                                </select>
                                @error('forma_pago')
                                <span class="invalid-feedback" role="alert">
                                    <strong> {{$message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row" id="seccion_cuotas" hidden>
                            <b class="col-md-4 col-form-label text-md-right">Número de Cuotas</b>
                            <div class="col-md-6">
                                <select class="form-control @error ('numero_cuotas') is-invalid @enderror"
                                    name="numero_cuotas">
                                    <option value="">Seleccione...</option>
                                    @for ( $i=1 ; $i<= 12; $i++) <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                </select>
                                @error('numero_cuotas')
                                <span class="invalid-feedback" role="alert">
                                    <strong> {{$message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <b class="col-md-4 col-form-label text-md-right">Notas</b>
                            <div class="col-md-6">
                                <textarea id="notas" name="notas"
                                    class="form-control @error ('notas') is-invalid @enderror" rows="3"
                                    cols="30"> {{old('valor_compra')}}</textarea>
                                @error('notas')
                                <span class="invalid-feedback" role="alert">
                                    <strong> {{$message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary mt-5">Grabar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@stop

@section('css')


@stop

@section('js')
<script src="{{asset('js/salida/salida.js')}}">
    @stop
