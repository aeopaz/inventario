<h3 class="mb-5 text-center">Editar Artículo No. {{$articulo->id}}</h3>
<div id="id_articulo" hidden>{{$articulo->id}}</div>
<form action="{{route('articulo.update',$articulo->id)}}" method="post" enctype="multipart/form-data"
    id="form_actualizar_articulo">
    @csrf
    @method('put')
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
        <div class="col-4">
            <b for="nombre_articulo">Nombre</b>
        </div>
        <div class="col-8">
            <input id="nombre_articulo" name="nombre_articulo" class="form-control"
                value="{{old('nombre_articulo') ?? $articulo->nombre ?? 'default'}}">
            <span class="invalid-feedback" role="alert" id="nombre_articuloError">
                <strong></strong>
            </span>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-4">
            <b for="descripcion">Descripción</b>
        </div>
        <div class="col-8">
            <textarea id="descripcion" name="descripcion" class="form-control" rows="5" cols="22"
                maxlength="200">{{old('descripcion') ?? $articulo->descripcion ?? 'default'}}</textarea>
            <span class="invalid-feedback" role="alert" id="descripcionError">
                <strong></strong>
            </span>

            <div id="contador" class="h6">200 Caracteres</div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-4">
            <b for="valor_unitario">Valor Unitario</b>
        </div>
        <div class="col-8">
            <input id="precio_venta" name="precio_venta" class="form-control"
                value="{{old('precio_venta') ?? $articulo->precio_venta ?? 'default'}}">
            <span class="invalid-feedback" role="alert" id="precio_ventaError">
                <strong></strong>
            </span>
        </div>
    </div>
    {{-- <div class="row justify-content-center">
        <div class="col-4">
            <b for="file">Imagen</b>
        </div>
        <div class="col-8">
            <input id="file" type="file" name="file" accept="image/*"
                class="form-control-file @error ('file') is-invalid @enderror" value="{{old('file')}}">
            @error('file')
            <span class="invalid-feedback" role="alert">
                <strong> {{$message}}</strong>
            </span>
            @enderror
        </div>
    </div>--}}
    <div class="row justify-content-center mt-3">
        <div class="col-4">
            <button id="actualizar" class="btn btn-primary">Actualizar</button>
        </div>
    </div>
</form>


<script src="/js/articulo/articulo.js"></script>
<script src="/js/generales/formatos.js"></script>
