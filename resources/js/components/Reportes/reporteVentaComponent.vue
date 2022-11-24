<template>
    <div>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10 col-md-10">
                <h2 style="text-transform:uppercase"><b>Reporte Ventas</b></h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a>Inicio</a>
                    </li>
                    <li class="breadcrumb-item active">
                        <strong>Reporte Ventas</strong>
                    </li>
                </ol>
            </div>
        </div>

        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-content">
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label for="">Fecha Inicio</label>
                                    <input
                                        type="date"
                                        class="form-control form-control-sm"
                                        v-model="fechaInicio"
                                    />
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="">Fecha Final</label>
                                    <input
                                        type="date"
                                        class="form-control form-control-sm"
                                        v-model="fechaFinal"
                                    />
                                </div>
                                <div class="form-group col-md-3">
                                    <br /><br />
                                    <button
                                        class="btn btn-primary"
                                        @click="buscar"
                                    >
                                        <i class="fa fa-search"></i>Buscar
                                    </button>
                                </div>
                            </div>
                            <div class="container">
                                <apexchart
                                    type="area"
                                    :height="400"
                                    :options="optionsArea"
                                    :series="seriesArea"
                                ></apexchart>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["tipopedidos"],
    data() {
        return {
            fechaInicio: null,
            fechaFinal: null,
            seriesArea: [],
            optionsArea: {}
        };
    },
    mounted() {
    },
    methods: {
        buscar: async function() {
            var $this = this;
            var datos = await axios.get(route("Reporte.ventaget"), {
                params: {
                    fechaInicio: $this.fechaInicio,
                    fechaFinal: $this.fechaFinal
                }
            });
            var datasets = [];
            this.optionsArea = {
            title: {
                text: "Ingresos",
                align: "center"
            },
            xaxis: {
                stroke: {
                    curve: "smoth"
                },

                categories:  datos.data.fechas
            }
        };
            // this.optionsArea.xaxis.categories = datos.data.fechas;
            datasets.push({
                name: "Ingreso",
                data: datos.data.data
            });

            this.seriesArea = datasets;
        }
    }
};
</script>

<style></style>
