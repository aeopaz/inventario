@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1>Usuarios</h1>
@stop

@section('content')


<div class="container">
    <div class="card">
        <div class="card-header">Lista de Usuarios</div>
        <div class="card-body">
            <div class="row">
                <a href="{{route('register')}}" class="btn btn-primary">Nuevo usuario</a>
            </div>
            <br>
            <table id="tabla_usuarios" class="table table-hover table-responsive">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($usuarios as $usuario)
                    <tr>
                        <td>{{$usuario->name}}</td>
                        <td>{{$usuario->email}}</td>
                        <td><a href="{{route('usuarios.edit',$usuario->id)}}" class="btn btn-primary">Editar</a></td>
                        <td><a href="#" class="btn btn-danger">Eliminar</a> </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>

</div>
@stop

@section('css')

@stop

@section('js')
<script>
    //script para utilizar el plugin DataTable y darle más formato a la tabla
   var table= $('#tabla_usuarios').DataTable({
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
    $('#tabla_usuarios thead tr').clone(true).appendTo( '#tabla_usuarios thead' );
    $('#tabla_usuarios thead tr:eq(1) th').each( function (i) {
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
