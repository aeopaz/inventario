@extends('adminlte::page')

@section('title', 'Salida')

@section('content_header')
    <h1>Salidas</h1>
@stop
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">Lista de Salida de Artículos</div>
        <div class="card-body">
            <div class="row mb-4">
                <a href="{{route('salida.create')}}" class="btn btn-primary">Nueva Salida</a>
            </div>
            <table id="tabla_salidas" class="table table-hover table-responsive">
                <thead>
                    <tr>
                        <th>ID Artículo</th>
                        <th>Nombre Artículo</th>
                        <th>Nombre Cliente</th>
                        <th>Cantidad</th>
                        <th>Valor venta</th>
                        <th>Ver</th>
                        {{--<th>Editar</th>
                        <th>Eliminar</th>--}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($salidas as $salida )
                    <tr>
                        <td>{{$salida->id_articulo}}</td>
                        <td>{{$salida->nombre_articulo}}</td>
                        <td>{{$salida->nombre_cliente}}</td>
                        <td>{{$salida->cantidad}}</td>
                        <td>{{number_format($salida->precio_venta,0,",",".")}}</td>
                        <td><a href="{{route('salida.show',$salida->id)}}" class="ver-modal btn btn-success">Ver</a></td>
                        {{--<td><a href="{{route('salida.edit',$salida->id)}}" class="ver-modal btn btn-primary">Editar</a></td>
                        <td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-delete-{{$salida->id}}">Eliminar</button></td>--}}
                    </tr>
                    @include('salida.delete')
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('salida.modal')

@stop
@section('css')

@stop

@section('js')
<script src="/js/generales/vermodal.js"></script>
<script src="/js/entrada/entrada.js"></script>
<script>
    //script para utilizar el plugin DataTable y darle más formato a la tabla
   var table= $('#tabla_salidas').DataTable({
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
    $('#tabla_salidas thead tr').clone(true).appendTo( '#tabla_salidas thead' );
    $('#tabla_salidas thead tr:eq(1) th').each( function (i) {
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

