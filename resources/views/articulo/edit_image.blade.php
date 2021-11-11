<h3 class="mb-5 text-center">Editar Imagen Artículo No. {{$articulo->id}}</h3>
<div class="row justify-content-center">
    <output id="list"></output>
    <div class="col-12">
        @if ($articulo->imagen==null)
        <div id="imagen_actual"><img src="{{asset('img/noimage.png')}}" width="200" height="200"
                class="rounded mx-auto d-block mb-3 border"></div>
        @else
        <div id="imagen_actual"><img src="{{asset($articulo->imagen)}}" width="200" height="200"
                class="rounded mx-auto d-block mb-3 border"></div>
        @endif
    </div>
</div>
<form action="{{route('articulo.change_image',$articulo->id)}}" method="post" enctype="multipart/form-data"
    id="form_actualizar_articulo_imagen">
    @csrf
    @method('put')
    <div class="row justify-content-center">
        <div class="col-12">
            <input id="file" type="file" name="file" accept="image/*"
                class="form-control-file @error ('file') is-invalid @enderror" value="{{old('file')}}">
            @error('file')
            <span class="invalid-feedback" role="alert">
                <strong> {{$message}}</strong>
            </span>
            @enderror
        </div>
    </div>
    <div class="row justify-content-center mt-3">
        <div class="col-4">
            <button id="actualizar" class="btn btn-primary">Actualizar</button>
        </div>
    </div>
</form>
<script src="/js/articulo/articulo.js"></script>
