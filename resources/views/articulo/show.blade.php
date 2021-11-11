<h3 class="text-center">Detalle Artículo No. {{$articulo->id}}</h3>
<div class="row">
    <div class="col-12">
        @if ($articulo->imagen==null)
        <img src="{{asset('img/noimage.png')}}" width="150" height="150" class="rounded mx-auto d-block mb-2">
        @else
        <img src="{{asset($articulo->imagen)}}" width="150" height="150" class="rounded mx-auto d-block mb-2">
        @endif
    </div>
</div>
<div class="row">
    <div class="col-3">
        <b>Nombre</b>
    </div>
    <div class="col-9">
        <p id="nombre_articulo" name="nombre_articulo" class="form-control">{{$articulo->nombre}}</p>
    </div>
</div>
<div class="row">
    <div class="col-3">
        <b>Descripción</b>
    </div>
    <div class="col-9">
        <textarea id="descripcion" name="descripcion" class="form-control"
            rows="3">{{$articulo->descripcion}}</textarea>
    </div>
</div>
<div class="row">
    <div class="col-3">
        <b>Precio venta</b>
    </div>
    <div class="col-9">
        <p id="precio_venta" name="precio_venta" class="form-control">{{$articulo->precio_venta}}</p>
    </div>
</div>

<script>
    var elementExists=document.getElementById("precio_venta");
        var x = elementExists.innerHTML.replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ".");
        elementExists.innerHTML = x
</script>
