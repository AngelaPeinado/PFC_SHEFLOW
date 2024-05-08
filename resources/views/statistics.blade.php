<style>
    /* Estilos para el contenedor principal */
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
        width: 90%; /* Ancho del contenedor principal */
        margin: 20px auto; /* Centrar el contenedor en la página y agregar un espacio en la parte superior e inferior */
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background-color: #CDB8BD; /* Color de fondo translúcido */
        padding: 20px;
        border-radius: 10px;
        box-shadow: #A0404B; /* Sombra translúcida */
    }

    /* Estilos para las gráficas */
    .chart {
        width: 50%; /* Ancho de la gráfica */
        height: 500px; /* Altura de la gráfica */
        margin-bottom: 40px; /* Espacio entre las gráficas */
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

</style>

<!-- Resources -->
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

<!-- Chart code -->
<script>
    am5.ready(function() {

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
                    { color: am5.color(0x000000) }
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
    am5.ready(function() {

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
                    { color: am5.color(0x000000) }
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

<div class="info-box">
    <h3>Mis estadísticas</h3>
    <p><strong>Duración media del ciclo:</strong> {{ $duracionMediaCiclo }} días</p>
    <p><strong>Duración media del periodo:</strong> {{ $duracionMediaPeriodo }} días</p>
</div>
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
