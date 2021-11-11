@extends('adminlte::page')

@section('title', 'Detalle Cartera')

@section('content_header')
<h1>Detalle Cartera</h1>
@stop
@foreach ($cartera as $cartera)


@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Detalle Cartera</div>
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
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <b>Fecha Venta:</b>
                    <div class="form-control">{{substr($cartera->fecha_cartera,0,10)}}</div>
                </div>
                <div class="col">
                    <b>No. Venta:</b>
                    <div class="form-control">{{$cartera->id_salida,0,10}}</div>
                </div>
                <div class="col-md-auto">
                    <b>Cliente:</b>
                    <div class="form-control">{{$cartera->nombre_cliente}}</div>
                </div>
                <div class="col">
                    <b>Artículo:</b>
                    <div class="form-control">{{$cartera->nombre_articulo}}</div>
                </div>
                <div class="col">
                    <b>Valor Venta</b>
                    <div class="form-control">{{$cartera->precio_venta}}</div>
                </div>
                <div class="col">
                    <b>No. Cuotas</b>
                    <div class="form-control">{{$cartera->numero_cuotas}}</div>
                </div>
            </div>
            <div class="row mt-3 ml-0">
                <b>Detalle de Cuotas</b>
                @if ($errors->any())
                <br>
                <div class="alert alert-danger">
                    <ul>
                    <li>El valor a abonar no debe ser menor que 0 o mayor al pendiente</li>
                    <li>Debe Ingresar la fecha del abono</li>
                    </ul>
                </div>
                @endif
            </div>
            <div class="container border">
                <table class="table table-hover border">
                    <thead>
                        <tr>
                            <th>No. Cuota</th>
                            <th>Fecha Abono</th>
                            <th>Valor Abono</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($detalle_cartera as $detalle_cartera )
                        <form action="{{route('cartera.update_detalle_cartera', array($detalle_cartera->id,$detalle_cartera->id_cartera))}}" method="post">
                            @csrf
                            @method('put')
                            <tr>
                                <td>{{$detalle_cartera->id}}</td>
                                <td>
                                    <input class="form-control @error ('fecha_abono{{$detalle_cartera->id}}') is-invalid @enderror" value="{{$detalle_cartera->fecha_abono}}" type="date" name="fecha_abono">
                                    @error('fecha_abono{{$detalle_cartera->id}}')
                                    <span class="" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </td>
                                <td>
                                    <input class="form-control" value="{{$detalle_cartera->valor_abono}}" type="number" name="valor_abono">
                                </td>
                                <td>
                                    <button class="btn btn-primary">Grabar</button>
                                </td>
                            </tr>
                        </form>
                            @endforeach
                    </tbody>

                </table>

            </div>

        </div>
    </div>
</div>
@stop
@endforeach

@section('css')

@stop

@section('js')

@stop
