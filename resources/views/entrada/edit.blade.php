@foreach ($entrada as $entrada )
<div class="row justify-content-center">
    <h4>Editar Entrada</h4>
</div>
<form action="{{route('entrada.update',$entrada->id_entrada)}}" method="post" id="form_actualizar_entrada">
    @csrf
    @method("put")
    <div class="row">
        <b class="col-md-4 col-form-label text-md-right">Artículo</b>
        <div class="col-md-6">
            <select class="form-control"
                name="articulo" value="{{old('articulo')}}">
                <option value="">Seleccione...</option>
                <option value="{{$entrada->id_articulo}}" selected>{{$entrada->nombre_articulo}}</option>
                @foreach ($articulos as $articulo)
                <option value="{{$articulo->id}}">{{$articulo->nombre}}</option>
                @endforeach
            </select>
            <span class="invalid-feedback" role="alert" id="articuloError">
                <strong></strong>
            </span>

        </div>
    </div>
    <div class="row">
        <b class="col-md-4 col-form-label text-md-right">Proveedor</b>
        <div class="col-md-6">
            <select class="form-control"
                name="proveedor">
                <option value="">Seleccione...</option>
                <option value="{{$entrada->id_proveedor}}" selected>{{$entrada->nombre_proveedor}}</option>
                @foreach ($proveedores as $proveedor)
                <option value="{{$proveedor->id}}">{{$proveedor->nombre}}</option>
                @endforeach
            </select>
            <span class="invalid-feedback" role="alert" id="proveedorError">
                <strong></strong>
            </span>
        </div>
    </div>
    <div class="row">

        <b class="col-md-4 col-form-label text-md-right">Cantidad</b>
        <div class="col-md-6">
            <input id="cantidad" name="cantidad" class="form-control"
                type="number" value="{{old('cantidad') ?? $entrada->cantidad ?? ""}}">
            <span class="invalid-feedback" role="alert" id="cantidadError">
                <strong></strong>
            </span>

        </div>
    </div>
    <div class="row">
        <b class="col-md-4 col-form-label text-md-right">Costo Empaque</b>
        <div class="col-md-6">
            <input id="costo_empaque" name="costo_empaque"
                class="form-control" type="number"
                value="{{old('costo_empaque') ?? $entrada->costo_empaque ?? ""}}">

            <span class="invalid-feedback" role="alert" id="costo_empaqueError">
                <strong></strong>
            </span>

        </div>
    </div>
    <div class="row">
        <b class="col-md-4 col-form-label text-md-right">Costo Transporte</b>
        <div class="col-md-6">
            <input id="costo_transporte" name="costo_transporte"
                class="form-control" type="number"
                value="{{old('costo_transporte') ?? $entrada->costo_transporte ?? ""}}">
            <span class="invalid-feedback" role="alert" id="costo_transporteError">
                <strong></strong>
            </span>
        </div>
    </div>
    <div class="row">
        <b class="col-md-4 col-form-label text-md-right">Costo Envío</b>
        <div class="col-md-6">
            <input id="costo_envio" name="costo_envio" class="form-control"
                type="number" value="{{old('costo_envio') ?? $entrada->costo_envio ?? ""}}">
            <span class="invalid-feedback" role="alert" id="costo_envioError">
                <strong></strong>
            </span>
        </div>
    </div>
    <div class="row">
        <b class="col-md-4 col-form-label text-md-right">Costo Operativo</b>
        <div class="col-md-6">
            <input id="costo_operativo" name="costo_operativo"
                class="form-control" type="number"
                value="{{old('costo_operativo') ?? $entrada->costo_operativo ?? ""}}">
            <span class="invalid-feedback" role="alert" id="costo_operativoError">
                <strong></strong>
            </span>
        </div>
    </div>
    <div class="row">
        <b class="col-md-4 col-form-label text-md-right">Valor Compra</b>
        <div class="col-md-6">
            <input id="valor_compra" name="valor_compra"
                class="form-control" type="number"
                value="{{old('valor_compra') ?? $entrada->valor_compra_articulo ?? ""}}">
            <span class="invalid-feedback" role="alert" id="valor_compraError">
                <strong></strong>
            </span>

        </div>
    </div>
    <div class="row">
        <b class="col-md-4 col-form-label text-md-right">Forma de Pago</b>
        <div class="col-md-6">
            <select class="js-example-basic-single form-control"
                name="forma_pago">
                <option value="">Seleccione...</option>
                <option value="{{$entrada->id_forma_pago}}" selected>@if ($entrada->id_forma_pago==1) Contado @else Crédito @endif</option>
                <option value="1">Contado</option>
                <option value="2">Crédito</option>
            </select>
            <span class="invalid-feedback" role="alert" id="forma_pagoError">
                <strong></strong>
            </span>
        </div>
    </div>
    <div class="row">
        <b class="col-md-4 col-form-label text-md-right">Notas</b>
        <div class="col-md-6">
            <textarea id="notas" name="notas" class="form-control" rows="3"
                cols="30"> {{old('notas') ?? $entrada->notas ?? ""}}</textarea>
            <span class="invalid-feedback" role="alert" id="notasError">
                <strong></strong>
            </span>
        </div>
    </div>
    <div class="row mb-0">
        <div class="col-md-6 offset-md-4">
            <button  class="btn btn-primary mt-1">Actualizar</button>
        </div>
    </div>
</form>
@endforeach
<script src="/js/entrada/entrada.js"></script>
