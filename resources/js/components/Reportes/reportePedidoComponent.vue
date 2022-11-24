<template>
    <div>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10 col-md-10">
                <h2 style="text-transform:uppercase"><b>Reporte Pedidos</b></h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a>Inicio</a>
                    </li>
                    <li class="breadcrumb-item active">
                        <strong>Reporte Pedidos</strong>
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
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Tipo de Pedido</label>
                                        <v-select
                                            :options="tipopedidos"
                                            v-model="tipoPedido"
                                            v-on:input="verEmpleado"
                                        ></v-select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Fecha Inicio</label>
                                        <input
                                            type="date"
                                            class="form-control form-control-sm"
                                            v-model="fechaInicio"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Fecha Final</label>
                                        <input
                                            type="date"
                                            class="form-control form-control-sm"
                                            v-model="fechaFinal"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Empleados</label>
                                        <v-select
                                            :options="empleados"
                                            v-model="empleado"
                                            :disabled="disabledEmpleado"
                                        ></v-select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group mt-4"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div style="float:right;">
                                        <button
                                            class="btn btn-primary"
                                            @click="buscar"
                                        >
                                            <i class="fa fa-search"></i>Buscar
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table
                                    class="table dataTables-ReportePedido table-striped table-bordered table-hover"
                                >
                                    <thead>
                                        <tr>
                                            <th class="text-center">Id</th>
                                            <th class="text-center">
                                                Empleado
                                            </th>
                                            <th class="text-center">Fecha</th>
                                            <th class="text-center">
                                                TipoPedido
                                            </th>
                                            <th class="text-center">Total</th>
                                            <th class="text-center">
                                                Opciones
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
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
    props: ["empleados", "tipopedidos"],
    data() {
        return {
            empleado: null,
            fechaInicio: null,
            fechaFinal: null,
            tipoPedido: null,
            disabledEmpleado: false
        };
    },
    mounted() {},
    methods: {
        verEmpleado: function() {
            if (this.tipoPedido != null) {
                this.disabledEmpleado = this.tipoPedido.id == 2 ? true : false;
            } else {
                this.disabledEmpleado = false;
            }
        },
        buscar: async function() {
            var $this = this;
            var datos = await axios.get(route("Reporte.pedidoget"), {
                params: {
                    tipo_pedido:
                        $this.tipoPedido == null
                            ? $this.tipoPedido
                            : $this.tipoPedido.id,
                    fecha_inicio: $this.fechaInicio,
                    fecha_final: $this.fechaFinal,
                    empleado_id:
                        $this.empleado == null
                            ? $this.empleado
                            : $this.empleado.id
                }
            });
            var table = $(".dataTables-ReportePedido").DataTable();
            table.clear().draw();
            datos.data.forEach((value, index, array) => {
                table.row
                    .add([
                        value.id,
                        value.empleado,
                        value.fecha,
                        value.tipoPedido,
                        value.total,
                        ""
                    ])
                    .draw(false);
            });
        }
    }
};
</script>

<style></style>
