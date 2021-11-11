@extends('adminlte::page')

@section('title', 'Articulo')

@section('content_header')
    <h1>Artículos</h1>
@stop

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Listado de Artículos</div>
        <div class="card-body">
            <div class="row">
                <a href="{{route('articulo.create')}}" class="btn btn-primary">Nuevo Artículo</a>
            </div>

            <br>
            <table id="tabla_articulos" class="table table-hover table-responsive">
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Precio de Venta</th>
                        <th>Cantidad</th>
                        <th>Ver</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($articulos as $articulo )
                    <tr>
                        <td><a href="{{route('articulo.edit_image',$articulo->id)}}" class="ver-modal">
                            @if($articulo->imagen==null)
                                <img src="{{asset('img/noimage.png')}}" class="img-thumbnail" alt="miniatura" height="100" width="100">
                            @else
                                <img src="{{asset($articulo->imagen)}}" class="img-thumbnail" alt="miniatura" height="100" width="100">
                            @endif</a></td>
                        <td>{{$articulo->id}}</td>
                        <td>{{$articulo->nombre}}</td>
                        <td>{{number_format($articulo->precio_venta,0, ",", ".")}}</td>
                        <td>{{$articulo->cantidad}}</td>
                        <td><a href="{{route('articulo.show',$articulo->id)}}" class="ver-modal btn btn-success">Ver</a></td>
                        <td><a href="{{route('articulo.edit',$articulo->id)}}" class="ver-modal btn btn-primary">Editar</a></td>
                        <td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-delete-{{$articulo->id}}">Eliminar</button></td>
                    </tr>
                    @include('articulo.delete')
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@include('articulo.modal')
@stop

@section('css')

@stop

@section('js')
    <script> console.log('Hi!'); </script>
<script src="/js/articulo/articulo.js"></script>
<script src="/js/generales/vermodal.js"></script>
<script>
    //script para utilizar el plugin DataTable y darle más formato a la tabla
   var table= $('#tabla_articulos').DataTable({
        orderCellsTop:true,
        fixedHeader:true,
        responsive:true,
        autoWidth:false,
        "language": {
            "lengthMenu": "Mostrar " +
                                    `<select class="custom-select custom-select-sm form-control form-control-sm">
                                        <option value='10'>10</option>
                                        <option value='25'>25</option>
                                        <option value='50'>50</option>
                                        <option value='100'>100</option>
                                        <option value='-1'>All</option>
                                    </select>`+
                                    "registros por página",
            "zeroRecords": "Nada encontrado - disculpa",
            "info": "Mostrando la _PAGE_ de _PAGES_",
            "infoEmpty": "No records available",
            "infoFiltered": "(filtrado de _MAX_ registros totales)",
            "search": "Buscar:",
            "paginate":{
                "next":"Siguiente",
                "previous":"Anterior"
            }
        }

    });
//Script que permite buscar en la tabla por medio de los encabazados
    $('#tabla_articulos thead tr').clone(true).appendTo( '#tabla_articulos thead' );
    $('#tabla_articulos thead tr:eq(1) th').each( function (i) {
		var title = $(this).text();
		$(this).html( '<input type="text" class="custom-select custom-select-sm form-control form-control-sm" placeholder="Buscar '+title+'" />' );
		$( 'input', this ).on( 'keyup change', function () {
			if ( table.column(i).search() !== this.value ) {
				table
					.column(i)
					.search( this.value )
					.draw();
			}
		} );
    } );

</script>
@stop
