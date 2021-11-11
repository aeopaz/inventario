@extends('adminlte::page')

@section('title', 'Entradas')

@section('content_header')
    <h1>Entradas</h1>
@stop
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">Lista de Entradas de Artículos</div>
        <div class="card-body">
            <div class="row mb-4">
                <a href="{{route('entrada.create')}}" class="btn btn-primary">Nueva Entrada</a>
            </div>
            <table id="tabla_entradas" class="table table-hover table-responsive">
                <thead>
                    <tr>
                        <th>ID Artículo</th>
                        <th>Nombre Artículo</th>
                        <th>Nombre Proveedor</th>
                        <th>Cantidad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($entradas as $entrada )
                    <tr>
                        <td>{{$entrada->id_articulo}}</td>
                        <td>{{$entrada->nombre_articulo}}</td>
                        <td>{{$entrada->nombre_proveedor}}</td>
                        <td>{{$entrada->cantidad}}</td>
                        <td>
                            <a href="{{route('entrada.show',$entrada->id_entrada)}}" class="ver-modal btn btn-success">Ver</a>
                           {{--<a href="{{route('entrada.edit',$entrada->id_entrada)}}" class="ver-modal btn btn-primary">Editar</a>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-delete-{{$entrada->id_entrada}}">Eliminar</button>--}}
                        </td>
                    </tr>
                    @include('entrada.delete')
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>
@include('entrada.modal')

@stop
@section('css')

@stop

@section('js')
<script src="/js/generales/vermodal.js"></script>
<script src="/js/entrada/entrada.js"></script>
<script>
    //script para utilizar el plugin DataTable y darle más formato a la tabla
   var table= $('#tabla_entradas').DataTable({
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
    $('#tabla_entradas thead tr').clone(true).appendTo( '#tabla_entradas thead' );
    $('#tabla_entradas thead tr:eq(1) th').each( function (i) {
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

