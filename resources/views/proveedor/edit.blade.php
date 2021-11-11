<div class="row justify-content-center mt-2">
    <h3>Editar proveedor</h3>
</div>
<form action="{{route('proveedor.update',$proveedor->id)}}" method="post" enctype="multipart/form-data"
    id="form_actualizar_proveedor">
    @csrf
    @method('put')
    <div class="row justify-content-center">
        <div class="col-4">
            <b for="nombre">Proveedor</b>
        </div>
        <div class="col-8">
            <input id="nombre" name="nombre" class="form-control" value="{{old('nombre') ?? $proveedor->nombre ?? 'dd'}}">
            <span class="invalid-feedback" role="alert" id="nombreError">
                <strong></strong>
            </span>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-4">
            <b for="direccion">Dirección</b>
        </div>
        <div class="col-8">
            <input id="direccion" name="direccion" class="form-control"
                value="{{old('direccion') ?? $proveedor->direccion ?? ''}}">
            <span class="invalid-feedback" role="alert" id="direccionError">
                <strong></strong>
            </span>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-4">
            <b for="celular">Celular</b>
        </div>
        <div class="col-8">
            <input id="celular" name="celular" class="form-control"
                value="{{old('celular') ?? $proveedor->celular ?? ''}}" type="text" maxlength="10">
            <span class="invalid-feedback" role="alert" id="celularError">
                <strong></strong>
            </span>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-4">
            <b for="Email">Email</b>
        </div>
        <div class="col-8">
            <input id="email" type="email" name="email" class="form-control"
                value="{{old('email') ?? $proveedor->email ?? ''}}">
            <span class="invalid-feedback" role="alert" id="emailError">
                <strong></strong>
            </span>
        </div>
    </div>
    <div class="row justify-content-center mt-2">
        <button  class="btn btn-primary">Actualizar</button>
    </div>
</form>
<script src="/js/proveedor/proveedor.js"></script>
