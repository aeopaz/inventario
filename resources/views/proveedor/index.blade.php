@extends('adminlte::page')

@section('title', 'Proveedores')

@section('content_header')
    <h1>Proveedores</h1>
@stop
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Lista de proveedores</div>
        <div class="card-body">
            <div class="row mb-4">
                <a href="{{route('proveedor.create')}}" class="ver-modal btn btn-primary">Nuevo proveedor</a>
            </div>
            <table id="tabla_proveedores" class="table table-hover">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Dirección</th>
                        <th>Celular</th>
                        <th>Email</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($proveedores as $proveedor )
                    <tr>
                        <td>{{$proveedor->nombre}}</td>
                        <td>{{$proveedor->direccion}}</td>
                        <td>{{$proveedor->celular}}</td>
                        <td>{{$proveedor->email}}</td>
                        <td>
                            <a href="{{route('proveedor.edit',$proveedor->id)}}" class="ver-modal btn btn-primary">Editar</a>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-delete-{{$proveedor->id}}">Eliminar</button>
                        </td>
                    </tr>
                    @include('proveedor.delete')
                    @endforeach
                </tbody>

            </table>

        </div>
    </div>
</div>
@include('proveedor.modal')
@stop

@section('css')

@stop

@section('js')
<script src="/js/generales/vermodal.js"></script>
<script src="/js/proveedor/proveedor.js"></script>
<script>
    //script para utilizar el plugin DataTable y darle más formato a la tabla
   var table= $('#tabla_proveedores').DataTable({
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
    $('#tabla_proveedores thead tr').clone(true).appendTo( '#tabla_proveedores thead' );
    $('#tabla_proveedores thead tr:eq(1) th').each( function (i) {
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

