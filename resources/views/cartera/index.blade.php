@extends('adminlte::page')

@section('title', 'Cartera')

@section('content_header')
    <h1>Cartera</h1>
@stop
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">Listado de Préstamos</div>
        <div class="card-body">
            <table id="tabla_cartera" class="table table-hover table-responsive">
                <thead>
                    <tr>
                        <th>ID Préstamo</th>
                        <th>Nombre Cliente</th>
                        <th>Articulo</th>
                        <th>Fecha</th>
                        <th>Valor venta</th>
                        <th>Cuotas</th>
                        <th>Saldo</th>
                        <th>Ver</th>
                        {{--<th>Editar</th>
                        <th>Eliminar</th>--}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cartera as $cartera )
                    <tr>
                        <td>{{$cartera->id}}</td>
                        <td>{{$cartera->nombre_cliente}}</td>
                        <td>{{$cartera->nombre_articulo}}</td>
                        <td>{{substr($cartera->fecha_cartera,0,10)}}</td>
                        <td>{{number_format($cartera->precio_venta,0,",",".")}}</td>
                        <td>{{$cartera->numero_cuotas}}</td>
                        <td>
                            @for ($i = 0; $i < count($detalle_cartera); $i++)
                            @if ($detalle_cartera[$i]->id_cartera==$cartera->id)
                            {{number_format($cartera->precio_venta-$detalle_cartera[$i]->abono,0,",",".")}}{{--Calcula el saldo --}}
                            @endif
                            @endfor
                        </td>

                        <td><a href="{{route('cartera.show',$cartera->id)}}" class="btn btn-success">Ver</a></td>
                        {{--<td><a href="{{route('salida.edit',$salida->id)}}" class="ver-modal btn btn-primary">Editar</a></td>
                        <td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-delete-{{$salida->id}}">Eliminar</button></td>--}}
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('cartera.modal')

@stop
@section('css')

@stop

@section('js')
<script src="/js/generales/vermodal.js"></script>
<script src="/js/entrada/entrada.js"></script>
<script>
    //script para utilizar el plugin DataTable y darle más formato a la tabla
   var table= $('#tabla_cartera').DataTable({
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
    $('#tabla_cartera thead tr').clone(true).appendTo( '#tabla_cartera thead' );
    $('#tabla_cartera thead tr:eq(1) th').each( function (i) {
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

