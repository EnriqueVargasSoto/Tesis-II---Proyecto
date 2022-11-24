<template>
    <div>
        <!--<div class="wrapper wrapper-content animated fadeIn">
            <div class="card mb-2">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="widget style1 navy-bg">
                                <div class="row">
                                    <div class="col-4">
                                        <i
                                            class="fa fa-cart-arrow-down fa-5x"
                                        ></i>
                                    </div>
                                    <div class="col-8 text-right">
                                        <span> Ordenes</span>
                                        <h2 class="font-bold">
                                            {{ cantOrdenes }}
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="widget style1 yellow-bg">
                                <div class="row">
                                    <div class="col-4">
                                        <i class="fa fa-cloud fa-5x"></i>
                                    </div>
                                    <div class="col-8 text-right">
                                        <span> Clientes </span>
                                        <h2 class="font-bold">
                                            {{ cantClientes }}
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="widget style1 lazur-bg">
                                <div class="row">
                                    <div class="col-4">
                                        <i class="fa fa-users fa-5x"></i>
                                    </div>
                                    <div class="col-8 text-right">
                                        <span> Empleados</span>
                                        <h2 class="font-bold">
                                            {{ cantEmpleados }}
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <apexchart
                                type="area"
                                :height="400"
                                :options="optionsArea"
                                :series="seriesArea"
                            ></apexchart>
                        </div>
                        <div class="col-md-12">
                            <apexchart
                                type="line"
                                :height="400"
                                :options="optionsProductoLine"
                                :series="seriesProductoLine"
                            ></apexchart>
                        </div>
                        <div class="col-md-12">
                            <apexchart
                                type="line"
                                :height="400"
                                :options="optionsBebidaLine"
                                :series="seriesBebidaLine"
                            ></apexchart>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <apexchart
                                type="pie"
                                :height="400"
                                :options="optionsPie"
                                :series="seriesPie"
                            ></apexchart>
                        </div>
                        <div class="col-md-7">
                            <apexchart
                                type="bar"
                                :height="400"
                                :options="optionsBarEmpleado"
                                :series="seriesBarEmpleado"
                            ></apexchart>
                        </div>
                    </div>
                </div>
            </div>
        </div>-->
    </div>
</template>

<script>
export default {
    data() {
        return {
            optionsArea: {},
            optionsPie: {},
            optionsProductoLine: {},
            optionsBebidaLine: {},
            optionsBarEmpleado: {},
            seriesArea: [],
            seriesPie: [],
            seriesProductoLine: [],
            seriesBebidaLine: [],
            seriesBarEmpleado: [],
            year: null,
            cantOrdenes: 0,
            cantClientes: 0,
            cantEmpleados: 0
        };
    },
    created() {
        var date = new Date();
        this.year = date.getFullYear();
    },
    mounted() {
        this.CantidadesPersonas();
        this.ReporteYears();
        this.ReporteTarjeta();
        this.ReporteProductos();
        this.ReporteBebidas();
        this.ReporteEmpleadosIngresos();
    },
    methods: {
        ReporteEmpleadosIngresos: async function() {
            var $this = this;
            var datos = await axios.get(
                route("Consulta.getReportesEmpleadoGraph")
            );
            console.log(datos)
            var series=[];
            datos.data.forEach((value, index, array) => {
                series.push(
                    {
                        name:value.Empleado,
                        data:value.Meses
                    }
                )
            })
            $this.optionsBarEmpleado = {
                title: {
                    text: "Ingresos Mensual de los Top 3 meseros",
                    align: "center"
                },
                xaxis: {
                    categories: [
                        "Enero",
                        "Febrero",
                        "Marzo",
                        "Abril",
                        "Mayo",
                        "Junio",
                        "Julio",
                        "Agosto",
                        "Septiembre",
                        "Octubre",
                        "Noviembre",
                        "Diciembre"
                    ]
                }
            };
            $this.seriesBarEmpleado=series;

        },
        ReporteProductos: async function() {
            var $this = this;
            var datos = await axios.get(
                route("Consulta.getReportesProductosGraph"),
                {
                    params: {
                        tipoproducto_id: 1
                    }
                }
            );
            var series = [];
            datos.data.forEach((value, index, array) => {
                series.push({
                    name: value.Producto,
                    data: value.Meses
                });
            });
            $this.seriesProductoLine = series;
            $this.optionsProductoLine = {
                chart: {
                    type: "line",
                    zoom: {
                        enabled: false
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: "straight"
                },
                title: {
                    text: "Cantidad de Productos por meses",
                    align: "center"
                },
                grid: {
                    row: {
                        colors: ["#f3f3f3", "transparent"], // takes an array which will be repeated on columns
                        opacity: 0.5
                    }
                },
                xaxis: {
                    categories: [
                        "Enero",
                        "Febrero",
                        "Marzo",
                        "Abril",
                        "Mayo",
                        "Junio",
                        "Julio",
                        "Agosto",
                        "Septiembre",
                        "Octubre",
                        "Noviembre",
                        "Diciembre"
                    ]
                }
            };
        },
        ReporteBebidas: async function() {
            var $this = this;
            var datos = await axios.get(
                route("Consulta.getReportesProductosGraph"),
                {
                    params: {
                        tipoproducto_id: 2
                    }
                }
            );
            var series = [];
            datos.data.forEach((value, index, array) => {
                series.push({
                    name: value.Producto,
                    data: value.Meses
                });
            });
            $this.seriesBebidaLine = series;
            $this.optionsBebidaLine = {
                chart: {
                    type: "line",
                    zoom: {
                        enabled: false
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: "straight"
                },
                title: {
                    text: "Cantidad de Bebidas por meses",
                    align: "center"
                },
                grid: {
                    row: {
                        colors: ["#f3f3f3", "transparent"], // takes an array which will be repeated on columns
                        opacity: 0.5
                    }
                },
                xaxis: {
                    categories: [
                        "Enero",
                        "Febrero",
                        "Marzo",
                        "Abril",
                        "Mayo",
                        "Junio",
                        "Julio",
                        "Agosto",
                        "Septiembre",
                        "Octubre",
                        "Noviembre",
                        "Diciembre"
                    ]
                }
            };
        },
        ReporteTarjeta: async function() {
            var $this = this;
            var datos = await axios.get(
                route("Consulta.getReportesTarjetasGraph"),
                {
                    params: {
                        year: $this.year
                    }
                }
            );
            var labels = [];
            var cantidades = [];
            datos.data.forEach((value, index, array) => {
                labels.push(value.tarjeta);
                cantidades.push(value.dinero);
            });
            this.optionsPie = {
                title: {
                    text: "Ingresos por Tarjetas",
                    align: "center"
                },
                labels: labels
            };
            this.seriesPie = cantidades;
        },
        ReporteYears: async function() {
            var $this = this;
            this.optionsArea = {
                title: {
                    text: "Ingresos por meses de los 3 ultimos Años",
                    align: "center"
                },
                xaxis: {
                    stroke: {
                        curve: "smoth"
                    },

                    categories: [
                        "Enero",
                        "Febrero",
                        "Marzo",
                        "Abril",
                        "Mayo",
                        "Junio",
                        "Julio",
                        "Agosto",
                        "Septiembre",
                        "Octubre",
                        "Noviembre",
                        "Diciembre"
                    ]
                }
            };
            var datasets = [];
            for (let index = $this.year; index >= $this.year - 2; index--) {
                var datos = await axios.get(
                    route("Consulta.getReportesVentasGraph"),
                    {
                        params: {
                            year: index
                        }
                    }
                );
                datasets.push({
                    name: index,
                    data: datos.data
                });
            }
            this.seriesArea = datasets;
        },
        CantidadesPersonas: function() {
            var $this = this;
            axios
                .get(route("Consulta.getReporteAdmin"))
                .then(value => {
                    $this.cantOrdenes = value.data.cantidadOrdenes;
                    $this.cantClientes = value.data.cantidadClientes;
                    $this.cantEmpleados = value.data.cantidadEmpleados;
                })
                .catch(value => {});
        }
    }
};
</script>

<style></style>
