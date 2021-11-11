@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Informes</h1>
@stop

@section('content')
<div class="container border mb-5">
    <div class="row">
        <div class="col-6 border">
            <div id="informe_ventas"></div>
        </div>
        <div class="col-6 border">
            <div id="inventario"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-6 border">
            <div id="grafico_articulos"></div>
        </div>
        <div class="col-6 border">
            <div id="grafico_entrada_salidas"></div>
        </div>
    </div>
</div>


@stop

@section('css')

@stop

@section('js')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<script>
    {{--Gráfico de artículos--}}
   Highcharts.chart('grafico_articulos', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Inventario de Artículos'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                }
            }
        },
        series: [{
            name: 'Artículo',
            colorByPoint: true,
            data:<?=$articulosJS ?>
        }]
    });


    {{--Gráfico de entradas y salidas--}}
    Highcharts.chart('grafico_entrada_salidas', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Entradas y Salidas'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                }
            }
        },
        series: [{
            name: 'Artículo',
            colorByPoint: true,
            data:<?=$entradas_salidasJS ?>
        }]
    });

    {{--Gráfico Informe Ventas--}}
    Highcharts.chart('informe_ventas', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Informe de Ventas'
        },
        subtitle: {
            text: 'Ventas, abonado y cuentas por cobrar'
        },
        accessibility: {
            announceNewData: {
                enabled: true
            }
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            title: {
                text: 'Valores en Pesos'
            }

        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:,.0f}'//point.y:,.0f: formato de separación de miles
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:,.0f}</b> of total<br/>'//point.y:,.0f: formato de separación de miles
        },

        series: [
            {
                name: "Ventas",
                colorByPoint: true,
                data: <?=$informe_ventasJS ?>
            }
        ],

    });

    {{--Gráfico Inventario--}}
    Highcharts.chart('inventario', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Stock'
        },
        subtitle: {
            text: 'Comparativo Entradas, Salidas y Stock'
        },
        accessibility: {
            announceNewData: {
                enabled: true
            }
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            title: {
                text: 'Valores en Pesos'
            }

        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:,.0f}'//point.y:,.0f: formato de separación de miles
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f}</b> of total<br/>'//point.y:,.0f: formato de separación de miles
        },

        series: [
            {
                name: "Inventario",
                colorByPoint: true,
                data: <?=$inventarioJS ?>
            }
        ],

    });



</script>
@stop
