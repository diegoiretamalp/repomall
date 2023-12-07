<script>
    $(document).ready(function() {
        // @if (!empty($datos_malls))
        //     let data_r1;
        //     let data_r2;
        //     let data_r3;
        //     @foreach ($datos_malls as $datos)
        //         data_r1 = {!! json_encode($datos['datos_segmentados_dia_r1']) !!};
        //         crearGraficoEntrada(data_r1, 'acceso_r1_' +
        //             {{ $datos['mall']->id }});
        //         @if ($datos['mall']->acceso_r2 == 1)
        //             data_r2 = {!! json_encode($datos['datos_segmentados_dia_r2']) !!};
        //             crearGraficoEntrada(data_r2, 'acceso_r2_' +
        //                 {{ $datos['mall']->id }});
        //         @endif
        //         @if ($datos['mall']->acceso_r3 == 1)
        //             data_r3 = {!! json_encode($datos['datos_segmentados_dia_r3']) !!};
        //             crearGraficoEntrada(data_r3, 'acceso_r3_' +
        //                 {{ $datos['mall']->id }});
        //         @endif
        //     @endforeach
        // @endif
    });

    function crearGraficoEntrada(data_grafico, graficoId) {
        Highcharts.chart(graficoId, {
            colors: ['#f7a311', '#346DA4', '#7CB5EC', '#a9cef2'],
            chart: {
                type: "spline",
                zoomType: "xy"
            },
            title: {
                text: "Entrada"
            },
            xAxis: {
                crosshair: true,
                title: {
                    text: "Year"
                },
                categories: data_grafico.map(item => item.segmento)
            },
            yAxis: {
                title: {
                    text: "Cantidad"
                }
            },
            legend: {
                enabled: true
            },
            credits: {
                enabled: false
            },
            series: [{
                name: "Entrada",
                data: data_grafico.map(data => data.Entrada)
            }]
        });
    }
    var graficoId = "EntradaHoy";
    // crearGraficoEntrada(doygrafico, graficoId);
</script>
