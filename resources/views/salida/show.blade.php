@foreach ($salida as $salida )
<div class="row">
    <b class="col-md-4 col-form-label text-md-right">Artículo</b>
    <div class="col-md-6">
        <div class="form-control">{{$salida->nombre_articulo}}</div>
    </div>
</div>
<div class="row">
    <b class="col-md-4 col-form-label text-md-right">Precio Unitario</b>
    <div class="col-md-6">
        <div class="form-control">{{$salida->precio_unitario}}</div>
    </div>
</div>
<div class="row">
    <b class="col-md-4 col-form-label text-md-right">Cliente</b>
    <div class="col-md-6">
        <div class="form-control">{{$salida->nombre_cliente}}</div>
    </div>
</div>
<div class="row">
    <b class="col-md-4 col-form-label text-md-right">Cantidad</b>
    <div class="col-md-6">
        <div class="form-control">{{$salida->cantidad}}</div>
    </div>
</div>

<div class="row">
    <b class="col-md-4 col-form-label text-md-right">Precio Total</b>
    <div class="col-md-6">
        <div class="form-control">{{number_format($salida->precio_total,0,"",".")}}</div>
    </div>
</div>
<div class="row">
    <b class="col-md-4 col-form-label text-md-right">Descuento</b>
    <div class="col-md-6">
        <div class="form-control">{{($salida->descuento*100).'%'}}</div>
    </div>
</div>
<div class="row">
    <b class="col-md-4 col-form-label text-md-right">Precio Venta</b>
    <div class="col-md-6">
        <div class="form-control">{{number_format($salida->precio_venta,0,"",".")}}</div>
    </div>
</div>
<div class="row">
    <b class="col-md-4 col-form-label text-md-right">Forma de Pago</b>
    <div class="col-md-6">
        @if ($salida->id_forma_pago==1)
        <div class="form-control">Contado</div>
        @else
        <div class="form-control">Crédito</div>
        @endif
    </div>
</div>
<div class="row">
    <b class="col-md-4 col-form-label text-md-right">Notas</b>
    <div class="col-md-6">
        <div class="form-control">{{$salida->notas}}</div>
    </div>
</div>
@endforeach
