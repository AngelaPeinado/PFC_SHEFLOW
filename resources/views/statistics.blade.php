<style>
    /* Estilos para el contenedor principal */
    #chartdivanimo {
        width: 100%;
        height: 500px;
    }
    body {
        background-color: #A0404B;
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
        font-family: Arial, sans-serif; /* Establece una fuente de respaldo */
        margin: 0; /* Elimina el margen predeterminado del cuerpo */
        padding: 0; /* Elimina el relleno predeterminado del cuerpo */
    }


    .chart-container {
        width: 45%;
        margin: 20px 10px ; /* Ajusta el margen derecho para reducir el espacio entre las gráficas */
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background-color: #CDB8BD;
        padding: 20px;
        border-radius: 10px;
        box-shadow: #A0404B;
    }

    .chart-container-1 {
        width: 80%;
        margin: 20px auto; /* "auto" para que el margen izquierdo y derecho sean iguales, centrando el contenedor */
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background-color: #CDB8BD;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); /* Corregido el valor de box-shadow */
    }


    /* Estilos para las gráficas */
    .chart {
        width: 80%; /* Ancho de la gráfica */
        height: 500px; /* Altura de la gráfica */
        margin-bottom: 5px; /* Espacio entre las gráficas */
    }

    /* Estilos para los títulos */
    .chart-title {
        text-align: center; /* Alinear el texto al centro */
        margin-bottom: 20px; /* Espacio entre el título y la gráfica */
    }

    .info-box {
        text-align: center;
        margin-top: 40px; /* Aumentar el espacio superior */
        padding: 20px; /* Agregar espacio interno */
        background-color: #CDB8BD; /* Color de fondo translúcido */
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); /* Sombra translúcida */
    }

    .info-box h3 {
        margin-top: 0;
        color: #A0404B;
        font-size: 24px; /* Tamaño de la fuente aumentado */
        font-weight: bold; /* Hacer el texto en negrita */
    }

    .info-box p {
        margin-bottom: 10px;
        color: #A0404B;
        font-size: 18px; /* Tamaño de la fuente aumentado */
    }

    .chart-container-wrapper {
        display: flex;
        justify-content: space-between; /* Distribuye las gráficas de manera uniforme */
        margin-bottom: 20px;
    }

    .chart-container-wrapper-1 {
        justify-content: space-between; /* Distribuye las gráficas de manera uniforme */
        margin-bottom: 20px;
    }
</style>

<!-- Resources -->
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/percent.js"></script>


<!-- Chart code -->
<script>
    am5.ready(function () {

        // Create root element
        var root = am5.Root.new("chartdiv");

        // Set themes
        root.setThemes([am5themes_Animated.new(root)]);

        // Create chart
        var chart = root.container.children.push(am5xy.XYChart.new(root, {
            panX: true,
            panY: true,
            wheelX: "panX",
            wheelY: "zoomX",
            pinchZoomX: true,
            paddingLeft: 0,
            layout: root.verticalLayout
        }));

        // Set colors
        chart.set("colors", am5.ColorSet.new(root, {
            colors: [
                am5.color(0xF6CBD1),
                am5.color(0xF9A5AC),
                am5.color(0xF692AE),
                am5.color(0xF68698),
                am5.color(0xF57C82),
                am5.color(0xF36B7E),
                am5.color(0xF05C7E)
            ]
        }));

        // Create axes
        var xRenderer = am5xy.AxisRendererX.new(root, {
            minGridDistance: 50,
            minorGridEnabled: true
        });

        xRenderer.grid.template.setAll({
            location: 1
        });

        var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
            maxDeviation: 0.3,
            categoryField: "Mes",
            renderer: xRenderer,
            tooltip: am5.Tooltip.new(root, {})
        }));

        var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
            maxDeviation: 0.3,
            min: 0,
            renderer: am5xy.AxisRendererY.new(root, {
                strokeOpacity: 0.1
            })
        }));

        // Create series
        var series = chart.series.push(am5xy.ColumnSeries.new(root, {
            name: "Series 1",
            xAxis: xAxis,
            yAxis: yAxis,
            valueYField: "duracion",
            categoryXField: "Mes",
            tooltip: am5.Tooltip.new(root, {
                labelText: "{valueY}"
            }),
        }));

        series.columns.template.setAll({
            tooltipY: 0,
            tooltipText: "{categoryX}: {valueY}",
            shadowOpacity: 0.1,
            shadowOffsetX: 2,
            shadowOffsetY: 2,
            shadowBlur: 1,
            strokeWidth: 2,
            stroke: am5.color(0xffffff),
            shadowColor: am5.color(0x000000),
            cornerRadiusTL: 50,
            cornerRadiusTR: 50,
            fillGradient: am5.LinearGradient.new(root, {
                stops: [
                    {}, // will use original column color
                    {color: am5.color(0x000000)}
                ]
            }),
            fillPattern: am5.GrainPattern.new(root, {
                maxOpacity: 0.15,
                density: 0.5,
                colors: [am5.color(0x000000), am5.color(0x000000), am5.color(0xffffff)]
            })
        });

        series.columns.template.states.create("hover", {
            shadowOpacity: 1,
            shadowBlur: 10,
            cornerRadiusTL: 10,
            cornerRadiusTR: 10
        });

        series.columns.template.adapters.add("fill", function (fill, target) {
            return chart.get("colors").getIndex(series.columns.indexOf(target));
        });

        // Set data
        var newData = {!! json_encode($datosCiclo) !!}; // Obtener los datos del controlador

        xAxis.data.setAll(newData);
        series.data.setAll(newData);

        // Make stuff animate on load
        series.appear(1000);
        chart.appear(1000, 100);
    });
</script>
<!-- Chart code para la segunda gráfica -->
<script>
    am5.ready(function () {

        // Create root element
        var root2 = am5.Root.new("chartdiv2");

        // Set themes
        root2.setThemes([am5themes_Animated.new(root2)]);

        // Create chart
        var chart2 = root2.container.children.push(am5xy.XYChart.new(root2, {
            panX: true,
            panY: true,
            wheelX: "panX",
            wheelY: "zoomX",
            pinchZoomX: true,
            paddingLeft: 0,
            layout: root2.verticalLayout
        }));

        // Set colors
        chart2.set("colors", am5.ColorSet.new(root2, {
            colors: [
                am5.color(0xF6CBD1),
                am5.color(0xF9A5AC),
                am5.color(0xF692AE),
                am5.color(0xF68698),
                am5.color(0xF57C82),
                am5.color(0xF36B7E),
                am5.color(0xF05C7E)
            ]
        }));

        // Create axes
        var xRenderer2 = am5xy.AxisRendererX.new(root2, {
            minGridDistance: 50,
            minorGridEnabled: true
        });

        xRenderer2.grid.template.setAll({
            location: 1
        });

        var xAxis2 = chart2.xAxes.push(am5xy.CategoryAxis.new(root2, {
            maxDeviation: 0.3,
            categoryField: "mes_inicio_actual",
            renderer: xRenderer2,
            tooltip: am5.Tooltip.new(root2, {})
        }));

        var yAxis2 = chart2.yAxes.push(am5xy.ValueAxis.new(root2, {
            maxDeviation: 0.3,
            min: 0,
            renderer: am5xy.AxisRendererY.new(root2, {
                strokeOpacity: 0.1
            })
        }));

        // Create series
        var series2 = chart2.series.push(am5xy.ColumnSeries.new(root2, {
            name: "Series 1",
            xAxis: xAxis2,
            yAxis: yAxis2,
            valueYField: "duracion",
            categoryXField: "mes_inicio_actual",
            tooltip: am5.Tooltip.new(root2, {
                labelText: "{valueY}"
            }),
        }));

        series2.columns.template.setAll({
            tooltipY: 0,
            tooltipText: "{categoryX}: {valueY}",
            shadowOpacity: 0.1,
            shadowOffsetX: 2,
            shadowOffsetY: 2,
            shadowBlur: 1,
            strokeWidth: 2,
            stroke: am5.color(0xffffff),
            shadowColor: am5.color(0x000000),
            cornerRadiusTL: 50,
            cornerRadiusTR: 50,
            fillGradient: am5.LinearGradient.new(root2, {
                stops: [
                    {}, // will use original column color
                    {color: am5.color(0x000000)}
                ]
            }),
            fillPattern: am5.GrainPattern.new(root2, {
                maxOpacity: 0.15,
                density: 0.5,
                colors: [am5.color(0x000000), am5.color(0x000000), am5.color(0xffffff)]
            })
        });

        series2.columns.template.states.create("hover", {
            shadowOpacity: 1,
            shadowBlur: 10,
            cornerRadiusTL: 10,
            cornerRadiusTR: 10
        });

        series2.columns.template.adapters.add("fill", function (fill, target) {
            return chart2.get("colors").getIndex(series2.columns.indexOf(target));
        });

        // Set data
        var newData2 = {!! json_encode($duracionCiclos) !!}; // Obtener los datos del controlador

        xAxis2.data.setAll(newData2);
        series2.data.setAll(newData2);

        // Make stuff animate on load
        series2.appear(1000);
        chart2.appear(1000, 100);
    });
</script>
<script>
    am5.ready(function () {
        var rootPasos = am5.Root.new("chartPasosDiarios");

        var chartPasos = rootPasos.container.children.push(am5xy.XYChart.new(rootPasos, {
            panX: true,
            panY: true,
            wheelX: "panX",
            wheelY: "zoomX",
            pinchZoomX: true,
            paddingLeft: 0,
            layout: rootPasos.verticalLayout
        }));

        // Set colors
        chartPasos.set("colors", am5.ColorSet.new(rootPasos, {
            colors: [
                am5.color(0xF6CBD1),
                am5.color(0xF9A5AC),
                am5.color(0xF692AE),
                am5.color(0xF68698),
                am5.color(0xF57C82),
                am5.color(0xF36B7E),
                am5.color(0xF05C7E)
            ]
        }));

        // Create axes
        var xRendererPasos = am5xy.AxisRendererX.new(rootPasos, {
            minGridDistance: 50,
            minorGridEnabled: true
        });

        xRendererPasos.grid.template.setAll({
            location: 1
        });

        var xAxisPasos = chartPasos.xAxes.push(am5xy.CategoryAxis.new(rootPasos, {
            maxDeviation: 0.3,
            categoryField: "fecha",
            renderer: xRendererPasos,
            tooltip: am5.Tooltip.new(rootPasos, {})
        }));

        var yAxisPasos = chartPasos.yAxes.push(am5xy.ValueAxis.new(rootPasos, {
            maxDeviation: 0.3,
            min: 0,
            renderer: am5xy.AxisRendererY.new(rootPasos, {
                strokeOpacity: 0.1
            })
        }));

        // Create series
        var seriesPasos = chartPasos.series.push(am5xy.ColumnSeries.new(rootPasos, {
            name: "Pasos",
            xAxis: xAxisPasos,
            yAxis: yAxisPasos,
            valueYField: "pasos",
            categoryXField: "fecha",
            tooltip: am5.Tooltip.new(rootPasos, {
                labelText: "{valueY}"
            }),
        }));

        seriesPasos.columns.template.setAll({
            tooltipY: 0,
            tooltipText: "{categoryX}: {valueY}",
            shadowOpacity: 0.1,
            shadowOffsetX: 2,
            shadowOffsetY: 2,
            shadowBlur: 1,
            strokeWidth: 2,
            stroke: am5.color(0xffffff),
            shadowColor: am5.color(0x000000),
            cornerRadiusTL: 50,
            cornerRadiusTR: 50,
            fillGradient: am5.LinearGradient.new(rootPasos, {
                stops: [
                    {}, // will use original column color
                    { color: am5.color(0x000000) }
                ]
            }),
            fillPattern: am5.GrainPattern.new(rootPasos, {
                maxOpacity: 0.15,
                density: 0.5,
                colors: [am5.color(0x000000), am5.color(0x000000), am5.color(0xffffff)]
            })
        });

        seriesPasos.columns.template.states.create("hover", {
            shadowOpacity: 1,
            shadowBlur: 10,
            cornerRadiusTL: 10,
            cornerRadiusTR: 10
        });

        seriesPasos.columns.template.adapters.add("fill", function (fill, target) {
            return chartPasos.get("colors").getIndex(seriesPasos.columns.indexOf(target));
        });

        // Set data
        var pasosData = {!! json_encode($pasosDiarios) !!}; // Obtener los datos del controlador

        xAxisPasos.data.setAll(pasosData);
        seriesPasos.data.setAll(pasosData);

        // Make stuff animate on load
        seriesPasos.appear(1000);
        chartPasos.appear(1000, 100);
    });
</script>
<script>
    am5.ready(function () {
        var rootAgua = am5.Root.new("chartCantidadAguaDiaria");

        var chartAgua = rootAgua.container.children.push(am5xy.XYChart.new(rootAgua, {
            panX: true,
            panY: true,
            wheelX: "panX",
            wheelY: "zoomX",
            pinchZoomX: true,
            paddingLeft: 0,
            layout: rootAgua.verticalLayout
        }));

        // Set colors
        chartAgua.set("colors", am5.ColorSet.new(rootAgua, {
            colors: [
                am5.color(0xF6CBD1),
                am5.color(0xF9A5AC),
                am5.color(0xF692AE),
                am5.color(0xF68698),
                am5.color(0xF57C82),
                am5.color(0xF36B7E),
                am5.color(0xF05C7E)
            ]
        }));

        // Create axes
        var xRendererAgua = am5xy.AxisRendererX.new(rootAgua, {
            minGridDistance: 50,
            minorGridEnabled: true
        });

        xRendererAgua.grid.template.setAll({
            location: 1
        });

        var xAxisAgua = chartAgua.xAxes.push(am5xy.CategoryAxis.new(rootAgua, {
            maxDeviation: 0.3,
            categoryField: "fecha",
            renderer: xRendererAgua,
            tooltip: am5.Tooltip.new(rootAgua, {})
        }));

        var yAxisAgua = chartAgua.yAxes.push(am5xy.ValueAxis.new(rootAgua, {
            maxDeviation: 0.3,
            min: 0,
            renderer: am5xy.AxisRendererY.new(rootAgua, {
                strokeOpacity: 0.1
            })
        }));

        // Create series
        var seriesAgua = chartAgua.series.push(am5xy.ColumnSeries.new(rootAgua, {
            name: "Agua",
            xAxis: xAxisAgua,
            yAxis: yAxisAgua,
            valueYField: "agua",
            categoryXField: "fecha",
            tooltip: am5.Tooltip.new(rootAgua, {
                labelText: "{valueY}"
            }),
        }));

        seriesAgua.columns.template.setAll({
            tooltipY: 0,
            tooltipText: "{categoryX}: {valueY}",
            shadowOpacity: 0.1,
            shadowOffsetX: 2,
            shadowOffsetY: 2,
            shadowBlur: 1,
            strokeWidth: 2,
            stroke: am5.color(0xffffff),
            shadowColor: am5.color(0x000000),
            cornerRadiusTL: 50,
            cornerRadiusTR: 50,
            fillGradient: am5.LinearGradient.new(rootAgua, {
                stops: [
                    {}, // will use original column color
                    { color: am5.color(0x000000) }
                ]
            }),
            fillPattern: am5.GrainPattern.new(rootAgua, {
                maxOpacity: 0.15,
                density: 0.5,
                colors: [am5.color(0x000000), am5.color(0x000000), am5.color(0xffffff)]
            })
        });

        seriesAgua.columns.template.states.create("hover", {
            shadowOpacity: 1,
            shadowBlur: 10,
            cornerRadiusTL: 10,
            cornerRadiusTR: 10
        });

        seriesAgua.columns.template.adapters.add("fill", function (fill, target) {
            return chartAgua.get("colors").getIndex(seriesAgua.columns.indexOf(target));
        });

        // Set data
        var aguaData = {!! json_encode($cantidadAguaDiaria) !!}; // Obtener los datos del controlador

        xAxisAgua.data.setAll(aguaData);
        seriesAgua.data.setAll(aguaData);

        // Make stuff animate on load
        seriesAgua.appear(1000);
        chartAgua.appear(1000, 100);
    });
</script>
<script>
    am5.ready(function () {
        var rootTemperatura = am5.Root.new("chartTemperaturaDiaria");

        var chartTemperatura = rootTemperatura.container.children.push(am5xy.XYChart.new(rootTemperatura, {
            panX: true,
            panY: true,
            wheelX: "panX",
            wheelY: "zoomX",
            pinchZoomX: true,
            paddingLeft: 0,
            layout: rootTemperatura.verticalLayout
        }));

        // Set colors
        chartTemperatura.set("colors", am5.ColorSet.new(rootTemperatura, {
            colors: [
                am5.color(0xF6CBD1),
                am5.color(0xF9A5AC),
                am5.color(0xF692AE),
                am5.color(0xF68698),
                am5.color(0xF57C82),
                am5.color(0xF36B7E),
                am5.color(0xF05C7E)
            ]
        }));

        // Create axes
        var xRendererTemperatura = am5xy.AxisRendererX.new(rootTemperatura, {
            minGridDistance: 50,
            minorGridEnabled: true
        });

        xRendererTemperatura.grid.template.setAll({
            location: 1
        });

        var xAxisTemperatura = chartTemperatura.xAxes.push(am5xy.CategoryAxis.new(rootTemperatura, {
            maxDeviation: 0.3,
            categoryField: "fecha",
            renderer: xRendererTemperatura,
            tooltip: am5.Tooltip.new(rootTemperatura, {})
        }));

        var yAxisTemperatura = chartTemperatura.yAxes.push(am5xy.ValueAxis.new(rootTemperatura, {
            maxDeviation: 0.3,
            min: 0,
            renderer: am5xy.AxisRendererY.new(rootTemperatura, {
                strokeOpacity: 0.1
            })
        }));

        // Create series
        var seriesTemperatura = chartTemperatura.series.push(am5xy.ColumnSeries.new(rootTemperatura, {
            name: "Temperatura",
            xAxis: xAxisTemperatura,
            yAxis: yAxisTemperatura,
            valueYField: "temperatura",
            categoryXField: "fecha",
            tooltip: am5.Tooltip.new(rootTemperatura, {
                labelText: "{valueY}"
            }),
        }));

        seriesTemperatura.columns.template.setAll({
            tooltipY: 0,
            tooltipText: "{categoryX}: {valueY}",
            shadowOpacity: 0.1,
            shadowOffsetX: 2,
            shadowOffsetY: 2,
            shadowBlur: 1,
            strokeWidth: 2,
            stroke: am5.color(0xffffff),
            shadowColor: am5.color(0x000000),
            cornerRadiusTL: 50,
            cornerRadiusTR: 50,
            fillGradient: am5.LinearGradient.new(rootTemperatura, {
                stops: [
                    {}, // will use original column color
                    { color: am5.color(0x000000) }
                ]
            }),
            fillPattern: am5.GrainPattern.new(rootTemperatura, {
                maxOpacity: 0.15,
                density: 0.5,
                colors: [am5.color(0x000000), am5.color(0x000000), am5.color(0xffffff)]
            })
        });

        seriesTemperatura.columns.template.states.create("hover", {
            shadowOpacity: 1,
            shadowBlur: 10,
            cornerRadiusTL: 10,
            cornerRadiusTR: 10
        });

        seriesTemperatura.columns.template.adapters.add("fill", function (fill, target) {
            return chartTemperatura.get("colors").getIndex(seriesTemperatura.columns.indexOf(target));
        });

        // Set data
        var temperaturaData = {!! json_encode($temperaturaDiaria) !!}; // Obtener los datos del controlador

        xAxisTemperatura.data.setAll(temperaturaData);
        seriesTemperatura.data.setAll(temperaturaData);

        // Make stuff animate on load
        seriesTemperatura.appear(1000);
        chartTemperatura.appear(1000, 100);
    });
</script>
<script>
    am5.ready(function() {

        var rootAnimo = am5.Root.new("chartdivanimo");
        var chartAnimo = rootAnimo.container.children.push(
            am5percent.PieChart.new(rootAnimo, {})
        );
        var seriesAnimo = chartAnimo.series.push(
            am5percent.PieSeries.new(rootAnimo, {
                categoryField: "opcion",
                valueField: "recuento"
            })
        );

        // Set data from PHP
        var dataAnimo = {!! json_encode($estadosAnimoMesActual) !!};
        seriesAnimo.data.setAll(dataAnimo);

        // Configuración de la leyenda
        var legendAnimo = chartAnimo.children.push(am5.Legend.new(rootAnimo, {
            align: "left",
            valign: "top",
            layout: rootAnimo.verticalLayout,
            marginTop: 20,
            marginBottom: 20,
            marginLeft: 20,
        }));

        legendAnimo.data.setAll(seriesAnimo.dataItems);

    });
</script>
<script>
    am5.ready(function () {
        var rootSintomas = am5.Root.new("chartdivsintomas");
        var chartSintomas = rootSintomas.container.children.push(
            am5percent.PieChart.new(rootSintomas, {})
        );
        var seriesSintomas = chartSintomas.series.push(
            am5percent.PieSeries.new(rootSintomas, {
                categoryField: "opcion",
                valueField: "recuento"
            })
        );

        // Set data from PHP
        var dataSintomas = {!! json_encode($sintomasMesActual) !!};
        seriesSintomas.data.setAll(dataSintomas);

        // Configuración de la leyenda
        var legendSintomas = chartSintomas.children.push(am5.Legend.new(rootSintomas, {
            align: "left",
            valign: "top",
            layout: rootSintomas.verticalLayout,
            marginTop: 20,
            marginBottom: 20,
            marginLeft: 20,
        }));

        legendSintomas.data.setAll(seriesSintomas.dataItems);
    });
</script>
<div class="info-box">
    <h3>ESTADÍSTICAS: CICLOS Y PERIODOS</h3>
    <p><strong>Duración media del ciclo:</strong> {{ $duracionMediaCiclo }} días</p>
    <p><strong>Duración media del periodo:</strong> {{ $duracionMediaPeriodo }} días</p>
</div>
<div class="chart-container-wrapper">
    <div class="chart-container">
        <!-- Título de la primera gráfica -->
        <h2 class="chart-title">Duración de periodos</h2>
        <!-- Contenedor de la primera gráfica -->
        <div id="chartdiv" class="chart"></div>
    </div>

    <div class="chart-container">
        <!-- Título de la segunda gráfica -->
        <h2 class="chart-title">Duración de ciclos</h2>
        <!-- Contenedor de la segunda gráfica -->
        <div id="chartdiv2" class="chart"></div>
    </div>
</div>
<div class="info-box">
    <h3>ESTADÍSTICAS: PASOS, CANTIDAD DE AGUA Y TEMPERATURA</h3>
    <p><strong>Media semanal de pasos:</strong> {{ $mediaPasosSemanal }} pasos</p>
    <p><strong>Media semanal de agua:</strong> {{ $mediaAguaSemanal }} litros</p>
    <p><strong>Media semanal de temperatura:</strong> {{ $mediaTemperaturaSemanal }} ºC</p>
</div>
<div class="chart-container-wrapper-1">
    <div class="chart-container-1">
        <!-- Título de la gráfica de pasos diarios -->
        <h2 class="chart-title">Pasos Diarios</h2>
        <!-- Contenedor de la gráfica de pasos diarios -->
        <div id="chartPasosDiarios" class="chart"></div>
    </div>

    <div class="chart-container-1">
        <h2 class="chart-title">Cantidad de Agua Diaria</h2>
        <div id="chartCantidadAguaDiaria" class="chart"></div>
    </div>

    <div class="chart-container-1">
        <h2 class="chart-title">Temperatura Diaria</h2>
        <div id="chartTemperaturaDiaria" class="chart"></div>
    </div>
</div>
<div class="info-box">
    <h3>ESTADÍSTICAS: ÁNIMO Y SÍNTOMAS</h3>

</div>
<div class="chart-container-1">
    <h2 class="chart-title">Estados de ánimo</h2>
    <div id="chartdivanimo"></div>
</div>
<div class="chart-container-1">
    <h2 class="chart-title">Síntomas</h2>
    <div id="chartdivsintomas"></div>
</div>
<div class="info-box">
    <h3>ENTRENAMIENTO: FATIGA, MOLESTIAS Y MOTIVACIÓN</h3>

</div>
<style>
    #chartdivejercicio {
        width: 100%;
        height: 500px;
    }
</style>

<!-- Resources -->
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

<<script>
    am5.ready(function () {

        // Create root element
        var root = am5.Root.new("chartdivejercicio");

        // Set themes
        root.setThemes([
            am5themes_Animated.new(root)
        ]);

        // Create chart
        var chart = root.container.children.push(am5xy.XYChart.new(root, {
            panX: false,
            panY: false,
            paddingLeft: 0,
            wheelX: "panX",
            wheelY: "zoomX",
            layout: root.verticalLayout
        }));

        // Add legend
        var legend = chart.children.push(
            am5.Legend.new(root, {
                centerX: am5.p50,
                x: am5.p50
            })
        );

        var dataEjercicio = {!! json_encode($datosDiariosMesActual) !!};
        console.log(dataEjercicio);
        // Create axes
        var xRenderer = am5xy.AxisRendererX.new(root, {
            cellStartLocation: 0.1,
            cellEndLocation: 0.9,
            minorGridEnabled: true
        });

        var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
            categoryField: "fecha",
            renderer: xRenderer,
            tooltip: am5.Tooltip.new(root, {})
        }));

        xRenderer.grid.template.setAll({
            location: 0
        });

        // Formatear las fechas
        var formattedDates = dataEjercicio.map(function(item) {
            return { fecha: item.fecha.split(' ')[0] }; // Obtener solo la fecha sin la hora
        });


        xAxis.data.setAll(formattedDates);

        var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
            renderer: am5xy.AxisRendererY.new(root, {
                strokeOpacity: 0.1
            })
        }));

        // Add series
        function makeSeries(name, fieldName, color) {
            var series = chart.series.push(am5xy.ColumnSeries.new(root, {
                name: name,
                xAxis: xAxis,
                yAxis: yAxis,
                valueYField: fieldName,
                categoryXField: "fecha",
                fill: am5.color(color),
            }));

            series.columns.template.setAll({
                tooltipText: "{name}, {categoryX}:{valueY}",
                width: am5.percent(90),
                tooltipY: 0,
                strokeOpacity: 0
            });

            series.data.setAll(dataEjercicio);

            // Make stuff animate on load
            series.appear();

            series.bullets.push(function () {
                return am5.Bullet.new(root, {
                    locationY: 0,
                    sprite: am5.Label.new(root, {
                        text: "{valueY}",
                        fill: root.interfaceColors.get("alternativeText"),
                        centerY: 0,
                        centerX: am5.p50,
                        populateText: true
                    })
                });
            });

            legend.data.push(series);
        }

        makeSeries("Motivación Ejercicio", "motivacion", "#f11f7c");
        makeSeries("Fatiga Ejercicio", "fatiga", "#ffae00");
        makeSeries("Molestias Ejercicio", "molestias", "#f5002c");

        // Make stuff animate on load
        chart.appear(1000, 100);

    }); // end am5.ready()
</script>
<div class="chart-container-1">
    <!-- HTML -->
    <div id="chartdivejercicio"></div>
</div>
