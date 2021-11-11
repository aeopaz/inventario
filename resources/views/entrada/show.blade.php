@foreach ($entrada as $entrada )
<div class="row justify-content-center">
    <h4>Ver Detalle Entrada</h4>
</div>
<div class="row">
    <b class="col-md-4 col-form-label text-md-right">Artículo</b>
    <div class="col-md-6">
        <div class="form-control">{{$entrada->nombre_articulo}}</div>
    </div>
</div>
<div class="row">
    <b class="col-md-4 col-form-label text-md-right">Proveedor</b>
    <div class="col-md-6">
        <div class="form-control">{{$entrada->nombre_proveedor}}</div>
    </div>
</div>
<div class="row">
    <b class="col-md-4 col-form-label text-md-right">Cantidad</b>
    <div class="col-md-6">
        <div class="form-control">{{$entrada->cantidad}}</div>
    </div>
</div>
<div class="row">
    <b class="col-md-4 col-form-label text-md-right">Costo Empaque</b>
    <div class="col-md-6">
        <div class="form-control">{{$entrada->costo_empaque}}</div>
    </div>
</div>
<div class="row">
    <b class="col-md-4 col-form-label text-md-right">Costo Transporte</b>
    <div class="col-md-6">
        <div class="form-control">{{$entrada->costo_transporte}}</div>
    </div>
</div>
<div class="row">

    <b class="col-md-4 col-form-label text-md-right">Costo Envío</b>

    <div class="col-md-6">
        <div class="form-control">{{$entrada->costo_envio}}</div>
    </div>
</div>
<div class="row">

    <b class="col-md-4 col-form-label text-md-right">Costo Operativo</b>

    <div class="col-md-6">
        <div class="form-control">{{$entrada->costo_operativo}}</div>
    </div>
</div>
<div class="row">
    <b class="col-md-4 col-form-label text-md-right">Valor Compra</b>
    <div class="col-md-6">
        <div class="form-control">{{$entrada->valor_compra_articulo}}</div>
    </div>
</div>
<div class="row">
    <b class="col-md-4 col-form-label text-md-right">Forma de divago</b>
    <div class="col-md-6">
        @if ($entrada->id_forma_divago==1)
        <div class="form-control">Contado</div>
        @else
        <div class="form-control">Crédito</div>
        @endif
    </div>
</div>
<div class="row">
    <b class="col-md-4 col-form-label text-md-right">Notas</b>
    <div class="col-md-6">
        <div class="form-control">{{$entrada->notas}}</div>
    </div>
</div>
@endforeach
