@extends('adminlte::page')

@section('title', 'Registrar Entrada')

@section('content_header')
<h1>Registrar Entrada</h1>
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Registrar Entrada</div>
                <div class="card-body">
                    <form action="{{route('entrada.store')}}" method="post" id="form_crear_entrada">
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
                        <div class="form-group row">
                            <b class="col-md-4 col-form-label text-md-right">Artículo</b>
                            <div class="col-md-6">
                                <select
                                    class="js-example-basic-single form-control @error ('articulo') is-invalid @enderror"
                                    name="articulo" value="{{old('articulo')}}">
                                    <option value="">Seleccione...</option>
                                    @foreach ($articulos as $articulo)
                                    <option value="{{old('articulo') ?? $articulo->id ?? ""}}">{{$articulo->nombre}}</option>
                                    @endforeach
                                </select>
                                @error('articulo')
                                <span class="invalid-feedback" role="alert">
                                    <strong> {{$message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                                <b class="col-md-4 col-form-label text-md-right">Proveedor</b>
                            <div class="col-md-6">
                                <select
                                    class="js-example-basic-single form-control @error ('proveedor') is-invalid @enderror"
                                    name="proveedor">
                                    <option value="">Seleccione...</option>
                                    @foreach ($proveedores as $proveedor)
                                    <option value="{{old('proveedor') ?? $proveedor->id ?? ""}}">{{$proveedor->nombre}}</option>
                                    @endforeach
                                </select>
                                @error('proveedor')
                                <span class="invalid-feedback" role="alert">
                                    <strong> {{$message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">

                                <b class="col-md-4 col-form-label text-md-right">Cantidad</b>
                            <div class="col-md-6">
                                <input id="cantidad" name="cantidad"
                                    class="form-control @error ('cantidad') is-invalid @enderror" type="number" value="{{old('cantidad')}}">
                                @error('cantidad')
                                <span class="invalid-feedback" role="alert">
                                    <strong> {{$message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">

                                <b class="col-md-4 col-form-label text-md-right">Costo Empaque</b>

                            <div class="col-md-6">
                                <input id="costo_empaque" name="costo_empaque"
                                    class="form-control @error ('costo_empaque') is-invalid @enderror" type="number" value="{{old('costo_empaque')}}">
                                @error('costo_empaque')
                                <span class="invalid-feedback" role="alert">
                                    <strong> {{$message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">

                                <b class="col-md-4 col-form-label text-md-right">Costo Transporte</b>

                            <div class="col-md-6">
                                <input id="costo_transporte" name="costo_transporte"
                                    class="form-control @error ('costo_transporte') is-invalid @enderror" type="number" value="{{old('costo_transporte')}}">
                                @error('costo_transporte')
                                <span class="invalid-feedback" role="alert">
                                    <strong> {{$message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">

                                <b class="col-md-4 col-form-label text-md-right">Costo Envío</b>

                            <div class="col-md-6">
                                <input id="costo_envio" name="costo_envio"
                                    class="form-control @error ('costo_envio') is-invalid @enderror" type="number" value="{{old('costo_envio')}}">
                                @error('costo_envio')
                                <span class="invalid-feedback" role="alert">
                                    <strong> {{$message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">

                                <b class="col-md-4 col-form-label text-md-right">Costo Operativo</b>

                            <div class="col-md-6">
                                <input id="costo_operativo" name="costo_operativo"
                                    class="form-control @error ('costo_operativo') is-invalid @enderror" type="number" value="{{old('costo_operativo')}}">
                                @error('costo_operativo')
                                <span class="invalid-feedback" role="alert">
                                    <strong> {{$message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">

                                <b class="col-md-4 col-form-label text-md-right">Valor Compra</b>

                            <div class="col-md-6">
                                <input id="valor_compra" name="valor_compra"
                                    class="form-control @error ('valor_compra') is-invalid @enderror" type="number" value="{{old('valor_compra')}}">
                                @error('valor_compra')
                                <span class="invalid-feedback" role="alert">
                                    <strong> {{$message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                                <b class="col-md-4 col-form-label text-md-right">Forma de Pago</b>
                            <div class="col-md-6">
                                <select
                                    class="js-example-basic-single form-control @error ('forma_pago') is-invalid @enderror"
                                    name="forma_pago">
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
                        <div class="form-group row">
                            <b class="col-md-4 col-form-label text-md-right">Notas</b>
                        <div class="col-md-6">
                            <textarea id="notas" name="notas"
                                class="form-control @error ('notas') is-invalid @enderror" rows="3" cols="30"> {{old('valor_compra')}}</textarea>
                            @error('notas')
                            <span class="invalid-feedback" role="alert">
                                <strong> {{$message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                        <div class="form-group row mb-0">
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

@stop
