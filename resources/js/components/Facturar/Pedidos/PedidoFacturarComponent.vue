<template>
    <div class="wrapper wrapper-content animated fadeInRight mb-1">
        <div class="row">
            <div class="col-md-8">
                <div class="p-3 bg-white rounded shadow my-sm-2">
                    <ul
                        id="myTab"
                        role="tablist"
                        class="nav nav-tabs nav-pills flex-column flex-sm-row text-center bg-light border-0 rounded-nav"
                    >
                        <li class="nav-item flex-sm-fill">
                            <a
                                id="home-tab"
                                data-toggle="tab"
                                href="#pedidoMesa"
                                role="tab"
                                aria-controls="Pedidos"
                                aria-selected="true"
                                class="nav-link border-0 font-weight-bold active"
                                ><i
                                    class="fa fa-shopping-cart fa-lg"
                                    aria-hidden="true"
                                >
                                    Pedidos-Mesas</i
                                ></a
                            >
                        </li>
                        <li class="nav-item flex-sm-fill">
                            <a
                                id="profile-tab"
                                data-toggle="tab"
                                href="#pedidoDelivery"
                                role="tab"
                                aria-controls="profile"
                                aria-selected="false"
                                class="nav-link border-0 font-weight-bold"
                                ><i
                                    class="fa fa-th-list fa-lg"
                                    aria-hidden="true"
                                >
                                    Pedidos-Delivery</i
                                ></a
                            >
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div
                            id="pedidoMesa"
                            role="tabpanel"
                            aria-labelledby="home-tab"
                            class="tab-pane fade px-4 py-5 show active"
                        >
                            <div class="row">
                                <div
                                    v-bind:class="[
                                        fila.id != id_seleccionado
                                            ? 'col-md-12 col-12 rowcardPedido'
                                            : 'col-md-12 col-12 rowcardPedido active-row'
                                    ]"
                                    v-for="fila in pedidosMesasb"
                                    :key="fila.id"
                                    @click="seleccionar(fila)"
                                >
                                    <span
                                        class="float-right h6 mt-2 mr-1 font-weight-bold"
                                    >
                                        {{
                                            "Total: S/." +
                                                fila.pedidoMesa.pedido.total
                                        }}
                                    </span>
                                    <i
                                        class="fa fa-users mt-1 ml-1 fa-2x"
                                        style="color:#1ab394;"
                                    ></i>
                                    <span class="h6 font-weight-normal">
                                        {{ "Mesa-" + fila.mesa.numero }}</span
                                    >
                                    <span class="h6 font-weight-bold">
                                        {{
                                            "(" +
                                                fila.pedidoMesa.pedido
                                                    .estado_pedido +
                                                ")"
                                        }}</span
                                    >
                                </div>
                            </div>
                        </div>
                        <div
                            id="pedidoDelivery"
                            role="tabpanel"
                            aria-labelledby="home-tab"
                            class="tab-pane fade px-4 py-5 show"
                        >
                            <div class="dd" id="nestable2">
                                <ol class="dd-list">
                                    <li
                                        class="dd-item"
                                        v-for="(item,
                                        index) in pedidosDeliveryb"
                                        :key="item.id"
                                        @click="seleccionarDelivery(item)"
                                    >
                                        <div
                                            v-bind:class="[
                                                id_seleccionado_delivery !=
                                                item.id
                                                    ? 'dd-handle'
                                                    : 'dd-handle active-row'
                                            ]"
                                        >
                                            <span class="float-right">
                                                {{
                                                    "Total-Pedido: S/." +
                                                        item.total
                                                }}
                                            </span>
                                            <span class="label label-success"
                                                ><i class="fa fa-users"></i
                                            ></span>
                                            {{ "Pedido-" + (index + 1) }}
                                        </div>
                                        <ol class="dd-list">
                                            <li
                                                class="dd-item"
                                                v-for="fila in item.detalle"
                                                :key="fila.id"
                                            >
                                                <div class="dd-nodrag">
                                                    <span class="float-right">
                                                        {{
                                                            "Total-item: S/." +
                                                                fila.producto
                                                                    .precio *
                                                                    fila.cantidad
                                                        }}
                                                    </span>
                                                    <span
                                                        v-bind:class="[
                                                            fila.estado_pedido ==
                                                            'PENDIENTE'
                                                                ? 'label label-danger'
                                                                : 'label label-success'
                                                        ]"
                                                        @click="
                                                            estadoPedido(fila)
                                                        "
                                                        style="cursor: pointer;"
                                                        ><i
                                                            class="fa fa-shopping-cart"
                                                        ></i
                                                    ></span>
                                                    {{
                                                        "Cantidad:" +
                                                            fila.cantidad +
                                                            " - " +
                                                            fila.producto.nombre
                                                    }}
                                                    <span
                                                        style="color:black;font-weight:600"
                                                        >({{
                                                            fila.estado_pedido
                                                        }})</span
                                                    >
                                                </div>
                                            </li>
                                        </ol>
                                    </li>
                                </ol>
                            </div>
                            <!-- <div class="row">
                                <div
                                    v-bind:class="[
                                        id_seleccionado_delivery != fila.id
                                            ? 'col-md-12 col-12 rowcardPedido'
                                            : 'col-md-12 col-12 rowcardPedido active-row'
                                    ]"
                                    v-for="(fila, index) in pedidosDeliveryb"
                                    :key="fila.id"
                                    @click="seleccionarDelivery(fila)"
                                >
                                    <span
                                        class="float-right h6 mt-2 mr-1 font-weight-bold"
                                    >
                                        {{ "Total: S/." + fila.total }}
                                    </span>
                                    <i
                                        class="fa fa-users mt-1 ml-1 fa-2x"
                                        style="color:#1ab394;"
                                    ></i>
                                    <span class="h6 font-weight-normal">
                                        {{ "Pedido-" + (index + 1) }}</span
                                    >
                                    <span class="h6 font-weight-bold">
                                        {{
                                            "(" + fila.estado_pedido + ")"
                                        }}</span
                                    >
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center mt-2 shadowCard">
                    <div class="card-header" style="background-color:white;">
                        <div class="input-group">
                            <input
                                type="text"
                                name="buscar"
                                id="buscar"
                                v-model="buscaritem"
                                placeholder="Buscar"
                                class="form-control form-control-sm"
                            />
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2"
                                    ><i
                                        class="fa fa-search"
                                        aria-hidden="true"
                                    ></i
                                ></span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" v-if="nitemlength != 0">
                        <div class="feed-activity-list">
                            <div
                                class="feed-element"
                                v-for="fila in itemsb"
                                :key="fila.id"
                            >
                                <div class="container-fluid">
                                    <div class="row">
                                        <div
                                            class="col-md-12"
                                            style="text-align:left;"
                                        >
                                            <span class="font-weight-bold"
                                                ><i
                                                    class="fa fa-cutlery"
                                                    aria-hidden="true"
                                                ></i>
                                                {{ fila.producto.nombre }}
                                                <br />
                                                <i
                                                    class="fa fa-shopping-cart"
                                                    aria-hidden="true"
                                                ></i>
                                                Cantidad: {{ fila.cantidad }}
                                                <br />
                                                <i
                                                    aria-hidden="true"
                                                    v-bind:class="[
                                                        fila.estado_pedido ==
                                                        'PENDIENTE'
                                                            ? 'fa fa-times-circle rojo_estado'
                                                            : 'fa fa-check verde_estado'
                                                    ]"
                                                ></i>
                                                Estado :
                                                {{ fila.estado_pedido }}
                                            </span>
                                            <span class="float-right h6">
                                                <i
                                                    class="fa fa-money"
                                                    aria-hidden="true"
                                                ></i>
                                                {{
                                                    "S/." + fila.producto.precio
                                                }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="card-footer text-muted"
                        v-if="nitemlength != 0"
                        style="background-color:white"
                    >
                        <button
                            type="button"
                            class="btn btn-primary btn-block btn-lg text-uppercase"
                            @click="cobrar"
                        >
                            <i
                                class="fa fa-shopping-cart fa-2x"
                                aria-hidden="true"
                            ></i>
                            <span class="h6">Cobrar Pedido</span>
                        </button>
                    </div>
                </div>
            </div>
            <div
                class="modal fade"
                id="modalCobrar"
                tabindex="-1"
                aria-labelledby="exampleModalLabel"
                aria-hidden="true"
            >
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">Tarjeta de Credito</label>
                                    <v-select
                                        :options="tipoTarjetas"
                                        v-model="tipotarjeta"
                                        @input="getTarjetas"
                                    ></v-select>
                                    <label for="">Tarjetas</label>
                                    <v-select
                                        :options="tarjetas"
                                        v-model="tarjeta"
                                    >
                                    </v-select>
                                    <label for="">Nro:Cuenta</label>
                                    <div class="input-group m-b">
                                        <div class="input-group-prepend">
                                            <span class="input-group-addon"
                                                ><i
                                                    class="fa fa-money"
                                                    v-bind:class="[
                                                        tipotarjeta == null
                                                            ? 'fa fa-money'
                                                            : tipotarjeta.label ==
                                                              'visa'
                                                            ? 'fa fa-cc-visa'
                                                            : 'fa-cc-mastercard'
                                                    ]"
                                                    aria-hidden="true"
                                                ></i
                                            ></span>
                                        </div>
                                        <input
                                            type="text"
                                            name="cuenta"
                                            id="cuenta"
                                            v-model="cuenta"
                                            class="form-control form-control-sm"
                                        />
                                    </div>
                                    <label for="">Cantidad-Tarjeta</label>
                                    <input
                                        type="text"
                                        class="form-control form-control-sm"
                                        v-model="cantidaTarjeta"
                                    />
                                    <button
                                        type="button"
                                        class="btn btn-primary float-right mt-2"
                                        @click="agregarTarjeta"
                                    >
                                        <i
                                            class="fa fa-plus"
                                            aria-hidden="true"
                                        ></i>
                                        Agregar
                                    </button>
                                    <br />
                                    <label for="">Cantidad-Efectivo</label>
                                    <input
                                        type="text"
                                        class="form-control form-control-sm"
                                        v-model="cantidaEfectivo"
                                    />
                                    <button
                                        type="button"
                                        class="btn btn-primary float-right mt-2"
                                        @click="agregarEfectivo"
                                    >
                                        <i
                                            class="fa fa-plus"
                                            aria-hidden="true"
                                        ></i>
                                        Agregar
                                    </button>
                                </div>
                                <div class="col-md-4 mt-2">
                                    <span class="h6 font-weight-bold"
                                        >Tarjetas de Credito</span
                                    >
                                    <br />
                                    <div
                                        class="card shadow-sm mt-3 mb-3"
                                        v-if="!tarjetaItem.length"
                                    >
                                        <div class="card-body text-center">
                                            Sin Datos
                                        </div>
                                    </div>
                                    <div
                                        v-if="tarjetaItem.length"
                                        class="card shadow-sm mt-3 mb-3"
                                    >
                                        <div class="card-body p-0">
                                            <div class="row mb-1">
                                                <div class="col-md-7">
                                                    <span
                                                        class="ml-3 font-weight-bold"
                                                    >
                                                        Nro:Cuenta
                                                    </span>
                                                </div>
                                                <div
                                                    class="col-md-5 text-right"
                                                >
                                                    <span
                                                        class="mr-2 font-weight-bold"
                                                    >
                                                        Cantidad
                                                    </span>
                                                </div>
                                            </div>
                                            <div
                                                v-for="t in tarjetaItem"
                                                :key="t.numero"
                                            >
                                                <div class="row">
                                                    <div class="col-md-7">
                                                        <span class="ml-3">{{
                                                            t.numero
                                                        }}</span>
                                                    </div>
                                                    <div
                                                        class="col-md-5 text-right"
                                                    >
                                                        <span class="mr-4">
                                                            {{ t.cantidad }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="row">
                                                <div
                                                    class="col-md-7 text-center"
                                                >
                                                    <span class="ml-3"
                                                        >TOTAL</span
                                                    >
                                                </div>
                                                <div
                                                    class="col-md-5 text-right"
                                                >
                                                    <span class="mr-2">
                                                        {{ totalTarjeta }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="h6 font-weight-bold"
                                        >Efectivo</span
                                    >
                                    <div
                                        class="card shadow-sm mt-3 mb-3"
                                        v-if="efectivo == 0"
                                    >
                                        <div class="card-body text-center">
                                            Sin Datos
                                        </div>
                                    </div>
                                    <div v-if="efectivo != 0">
                                        <div class="card shadow-sm mt-3 mb-3">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div
                                                        class="col-md-7 font-weight-bold text-uppercase"
                                                    >
                                                        <span class="ml-3"
                                                            >C.Efectivo</span
                                                        >
                                                    </div>
                                                    <div
                                                        class="col-md-5 text-right"
                                                    >
                                                        <span class="mr-2">
                                                            {{ efectivo }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 pl-4 pb-4 pr-4">
                                    <div class="total text-center">
                                        <span>
                                            {{ "TOTAL s/." + total }}
                                        </span>
                                    </div>
                                    <label
                                        for=""
                                        class="text-uppercase h4 font-weight-bold"
                                        >Dinero-Recibido</label
                                    >
                                    <calculator-component
                                        ref="calculadora"
                                        v-on:evento="cambioValor"
                                    ></calculator-component>
                                    <div class="vuelto mt-3">
                                        <span class="float-right mr-2">{{
                                            "S/." + vuelto
                                        }}</span>
                                        <span class="ml-2">
                                            Vuelto:
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button
                                type="button"
                                class="btn btn-secondary"
                                data-dismiss="modal"
                            >
                                cerrar
                            </button>
                            <button
                                type="button"
                                @click="guardar"
                                class="btn btn-primary"
                            >
                                Guardar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div
                id="modalDelivery"
                class="modal fade"
                tabindex="-1"
                role="dialog"
                aria-labelledby="my-modal-title"
                aria-hidden="true"
            >
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="my-modal-title">
                                Modal Delivery
                            </h5>
                            <button
                                class="close"
                                data-dismiss="modal"
                                aria-label="Close"
                            >
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body"></div>
                        <div class="modal-footer">
                            <button
                                type="button"
                                class="btn btn-secondary"
                                data-dismiss="modal"
                            >
                                cerrar
                            </button>
                            <button
                                type="button"
                                @click="guardar"
                                class="btn btn-primary"
                            >
                                Guardar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import CalculatorComponent from "../../Plugins/CalculatorComponent.vue";
export default {
    props: ["tiempoinicial"],
    components: { CalculatorComponent },
    data() {
        return {
            pedido_id: null,
            pedidosMesas: [],
            pedidosMesasb: [],
            pedidosDeliveryb: [],
            pedidosDelivery: [],
            tipoTarjetas: [],
            tipotarjeta: null,
            tarjetas: [],
            tarjeta: null,
            cantidaEfectivo: "",
            tarjetaItem: [],
            cantidaTarjeta: "",
            items: [],
            itemsb: [],
            buscaritem: "",
            nitemlength: 0,
            cuenta: null,
            efectivo: 0,
            totalTarjeta: 0,
            totalPago: 0,
            total: 0,
            vuelto: 0,
            estadoCaja: "",
            id_seleccionado: 0,
            id_seleccionado_delivery: 0,
            tiempI: 0,
            tiempo: 0,
            ver: true
        };
    },
    created() {
        this.datos();
    },
    mounted() {
        this.tiempoI = new Date(this.tiempoinicial);
    },
    methods: {
        datos: function() {
            var $this = this;
            axios
                .get(route("Consulta.getPedidosMesas", "PENDIENTE"))
                .then(value => {
                    $this.pedidosMesas = value.data;
                    $this.pedidosMesasb = value.data;
                })
                .catch(value => {});
            axios
                .get(route("Consulta.getpedidosDelivery", "PENDIENTE"))
                .then(value => {
                    $this.pedidosDelivery = value.data;
                    $this.pedidosDeliveryb = value.data;
                    console.log(value.data);
                })
                .catch(value => {});
            axios
                .get(route("Consulta.getTipoTarjeta"))
                .then(value => {
                    var datos = value.data;
                    var arreglo = [];
                    datos.forEach((value, index, array) => {
                        arreglo.push({ label: value.tipo, code: value.id });
                    });
                    $this.tipoTarjetas = arreglo;
                })
                .catch(value => {});
            axios
                .get(route("Consulta.verificarCaja"))
                .then(value => {
                    this.estadoCaja = value.data.mensaje;
                })
                .catch(value => {});
        },
        seleccionarDelivery: function(fila) {
            this.id_seleccionado_delivery = fila.id;
            this.id_seleccionado = 0;
            this.items = fila.detalle;
            this.nitemlength = this.items.length;
            this.itemsb = this.items;
            //this.total = fila.total_estado;
            this.pedido_id = fila.id;
            this.limpiarModal();
        },
        seleccionar: function(fila) {
            this.id_seleccionado = fila.id;
            this.id_seleccionado_delivery = 0;
            this.items = fila.detalles;
            this.nitemlength = this.items.length;
            this.itemsb = this.items;
            //this.total = fila.total_estado;
            this.pedido_id = fila.pedidoMesa.pedido_id;
            this.limpiarModal();
        },
        cobrar: function() {
            var $this = this;
            if (this.estadoCaja != "Aperturada") {
                toastr.error("No se a abierto Caja", "Error");
            } else {
                axios
                    .get(route("Consulta.getTotalEstadoPedido", this.pedido_id))
                    .then(value => {
                        $this.total = value.data;
                        if ($this.total == 0) {
                            toastr.error(
                                "No se puede Cobrar el total de 0",
                                "Error"
                            );
                        } else {
                            $("#modalCobrar").modal("show");
                            this.total_Pago();
                        }
                    });
            }
        },
        getTarjetas: function() {
            var $this = this;
            $this.tarjetas = [];
            if ($this.tipotarjeta != null) {
                axios
                    .get(route("Consulta.getTarjetas", $this.tipotarjeta.code))
                    .then(value => {
                        var datos = value.data;
                        var arreglo = [];
                        datos.forEach((value, index, array) => {
                            arreglo.push({
                                label: value.tarjeta,
                                code: value.id
                            });
                        });
                        $this.tarjetas = arreglo;
                    })
                    .catch(value => {});
            }
        },
        agregarTarjeta: function() {
            var $this = this;
            if (
                this.tarjetaItem.filter((value, index, array) => {
                    return value.numero == $this.cuenta;
                }).length == 0
            ) {
                this.tarjetaItem.push({
                    tipo: $this.tipotarjeta,
                    tarjeta: $this.tarjeta.code,
                    numero: $this.cuenta,
                    cantidad: $this.cantidaTarjeta
                });
                $this.total_Pago();
            } else {
                toastr.error("La tarjeta ya esta agregada");
            }
        },
        cambioValor: function() {
            this.tarjetaItem = [];
            this.efectivo = this.$refs.calculadora.current;
            this.total_Pago();
        },
        agregarEfectivo: function() {
            var $this = this;
            if ($this.efectivo == 0) {
                $this.efectivo = $this.cantidaEfectivo;
                this.total_Pago();
            } else {
                toastr.error("La cantidad Efectivo ya ha sido registrada");
            }
        },
        estadoPedido: function(fila) {
            var $this = this;
            axios
                .post(route("Pedido.Mesa.estadoPedido"), {
                    detalle: fila
                })
                .then(value => {
                    var estado =
                        fila.estado_pedido == "ENTREGADO"
                            ? "PENDIENTE"
                            : "ENTREGADO";
                    fila.estado_pedido = estado;
                })
                .catch(value => {});
        },
        total_Pago: function() {
            var $this = this;
            var totalTarjeta = 0;
            this.tarjetaItem.forEach((value, index, array) => {
                totalTarjeta = totalTarjeta + parseFloat(value.cantidad);
            });
            this.totalTarjeta = totalTarjeta;
            var t = parseFloat(totalTarjeta) + parseFloat(this.efectivo);
            this.vuelto = t - this.total;
        },
        guardar: function() {
            var $this = this;
            if (parseFloat($this.vuelto) < 0) {
                toastr.error("Falta Ingresar Datos", "Error");
            } else {
                axios
                    .post(route("Facturar.pago"), {
                        pedido_id: $this.pedido_id,
                        pago_efectivo: $this.efectivo,
                        tarjetas: $this.tarjetaItem,
                        vuelto: $this.vuelto
                    })
                    .then(value => {
                        $("#modalCobrar").modal("hide");
                        this.nitemlength = 0;
                        $this.limpiarModal();
                        $this.datos();
                        if ($this.ver) {
                            let tiempo =
                                (new Date().getTime() -
                                    $this.tiempoI.getTime()) /
                                1000;
                            tiempo = tiempo.toFixed(2);
                            swal.fire({
                                icon: "success",
                                title: "El tiempo del Proceso",
                                text: "Tiempo en segundos es: " + tiempo
                            });
                            $this.ver = false;
                        }
                    })
                    .catch(value => {});
            }
        },
        limpiarModal: function() {
            this.tipotarjeta = null;
            this.tarjeta = null;
            this.cuenta = null;
            this.cantidaTarjeta = "";
            this.cantidaEfectivo = "";
            this.tarjetaItem = [];
            this.efectivo = 0;
            this.vuelto = 0;
        }
    }
};
</script>
<style>
.rowcardPedido {
    border: solid 0.5px rgb(196, 196, 196);
    border-radius: 2px;
    margin-bottom: 4px;
    padding: 0 !important;
    height: 40px;
}
.active-row {
    border: solid 0.5px rgb(3, 109, 86) !important;
    background-color: rgb(31, 148, 123) !important;
    color: white !important;
}
.rowcardPedido:hover {
    background-color: rgb(235, 235, 235);
    cursor: pointer;
}
.h7 {
    font-size: 0.8em;
}
.shadowCard {
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
}
.total {
    background-color: #333;
    border-radius: 5px;

    font-size: 25px;
    color: white;
}
.vuelto {
    background-color: #333;
    border-radius: 5px;

    font-size: 22px;
    color: white;
}
.rojo_estado {
    color: red;
}
.verde_estado {
    color: #1ab394;
}
@media (min-width: 768px) {
    .modal-xl {
        width: 90%;
        max-width: 1000px;
    }
}
@media (max-width: 792px) {
    .rowcardPedido {
        height: 60px;
    }
}
</style>
