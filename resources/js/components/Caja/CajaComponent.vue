<template>
    <div class="card">
        <div class="card-header">
            Apertura de Caja
        </div>
        <div class="card-body">
            <div v-if="aperturacaja != ''">
                <div
                    v-bind:class="[
                        aperturacaja == 'Sin Aperturar'
                            ? 'alert alert-danger'
                            : 'alert alert-success'
                    ]"
                    role="alert"
                >
                    {{ aperturacaja }}
                </div>
                <div class="card shadow" v-if="aperturacaja == 'Sin Aperturar'">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="row">
                                    <div class="col-md-5">
                                        <label for="">Caja</label>
                                        <v-select
                                            :options="cajas"
                                            v-model="caja"
                                        ></v-select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Cantidad</label>
                                        <input
                                            type="text"
                                            name="cantidad"
                                            id="cantidad"
                                            style="height:30px;"
                                            v-model="cantidadApertura"
                                            readonly
                                            class="form-control"
                                        />
                                    </div>
                                    <div class="col-md-3 marginbutton">
                                        <button
                                            class="btn btn-primary btn-lg"
                                            @click="agregar"
                                        >
                                            <i
                                                class="fa fa-external-link"
                                                aria-hidden="true"
                                            ></i>
                                            Aperturar Caja
                                        </button>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-8">
                                        <div class="card shadow">
                                            <div class="card-body">
                                                <div
                                                    class="text-center"
                                                    v-if="items.length == 0"
                                                >
                                                    <span>Sin Datos</span>
                                                </div>
                                                <div v-if="items.length != 0">
                                                    <span
                                                        class="float-right font-weight-bold text-uppercase"
                                                    >
                                                        Cantidad
                                                    </span>
                                                    <span
                                                        class="font-weight-bold text-uppercase"
                                                    >
                                                        Dinero
                                                    </span>
                                                    <div
                                                        v-for="item in items"
                                                        :key="item.dinero"
                                                    >
                                                        <span
                                                            class="float-right font-weight-bold text-uppercase mr-3"
                                                        >
                                                            {{ item.cantidad }}
                                                        </span>
                                                        <span
                                                            class="font-weight-bold text-uppercase ml-2"
                                                        >
                                                            {{
                                                                item.abreviatura
                                                            }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <calculator-dinero
                                    ref="registradora"
                                    v-on:evento="registrar"
                                ></calculator-dinero>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" v-if="aperturacaja != 'Sin Aperturar'">
                    <div class="col-md-8 pr-1 pl-0">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="float-right">
                                            <button
                                                class="btn btn-primary"
                                                @click="cerrar"
                                            >
                                                <i
                                                    class="fa fa-chain-broken"
                                                    aria-hidden="true"
                                                ></i>
                                                Cerrar Caja
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5 pr-1 pl-0 pt-2">
                                        <div class="card h-100">
                                            <div class="card-body">
                                                <span
                                                    class="text-uppercase font-weight-bold"
                                                    >Entradas</span
                                                >
                                                <br />
                                                <div>
                                                    <span class="float-right">{{
                                                        ventaEfectivo
                                                    }}</span>
                                                    <span class="ml-2"
                                                        >Ventas Efectivos</span
                                                    >
                                                </div>
                                                <div>
                                                    <span class="float-right">{{
                                                        ventaTarjeta
                                                    }}</span>
                                                    <span class="ml-2"
                                                        >Ventas Tarjetas</span
                                                    >
                                                </div>
                                                <div>
                                                    <span class="float-right">{{
                                                        saldoApertura
                                                    }}</span>
                                                    <span class="ml-2"
                                                        >Saldo Apertura</span
                                                    >
                                                </div>
                                                <div>
                                                    <span class="float-right">{{
                                                        totalEntradas
                                                    }}</span>
                                                    <span
                                                        class="text-uppercase font-weight-bold"
                                                        >total</span
                                                    >
                                                </div>
                                                <label
                                                    for=""
                                                    class="font-weight-bold"
                                                    >Cantidad Cierre</label
                                                >
                                                <input
                                                    type="text"
                                                    name="cantidad"
                                                    id="cantidad"
                                                    style="height:30px;"
                                                    v-model="cantidadCierre"
                                                    class="form-control"
                                                />
                                                <div class="mt-2">
                                                    <span
                                                        v-bind:class="[
                                                            descuadre >= 0
                                                                ? 'float-right verde font-weight-bold'
                                                                : 'float-right rojo font-weight-bold'
                                                        ]"
                                                    >
                                                        Descuadre:
                                                        {{ descuadre }}
                                                    </span>
                                                </div>
                                                <div v-if="descuadre != 0">
                                                    <label for=""
                                                        >Descripcion</label
                                                    >
                                                    <textarea
                                                        v-model="
                                                            descripcionDescuadre
                                                        "
                                                        cols="5"
                                                        rows="2"
                                                        class="form-control"
                                                    ></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 pr-1 pl-0 pt-2">
                                        <div class="card h-100">
                                            <div class="card-body">
                                                <div class="text-center">
                                                    <span
                                                        class="font-weight-bold"
                                                    >
                                                        TARJETAS
                                                    </span>
                                                </div>
                                                <div>
                                                    <span class="float-right"
                                                        >Cantidad</span
                                                    >
                                                    <span
                                                        class="text-uppercase font-weight-bold"
                                                        >total</span
                                                    >
                                                </div>
                                                <div
                                                    v-for="tarjeta in tarjetas"
                                                    :key="tarjeta.id"
                                                >
                                                    <span class="float-right">{{
                                                        tarjeta.cantidad
                                                    }}</span>
                                                    <span class="ml-2">{{
                                                        tarjeta.tarjeta
                                                    }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 pr-1 pl-0 pt-2">
                                        <div class="card h-100">
                                            <div class="card-body">
                                                <div
                                                    class="text-center"
                                                    v-if="
                                                        itemsCierre.length == 0
                                                    "
                                                >
                                                    <span>Sin Datos</span>
                                                </div>
                                                <div
                                                    v-if="
                                                        itemsCierre.length != 0
                                                    "
                                                >
                                                    <span
                                                        class="float-right font-weight-bold text-uppercase"
                                                    >
                                                        Cantidad
                                                    </span>
                                                    <span
                                                        class="font-weight-bold text-uppercase"
                                                    >
                                                        Dinero
                                                    </span>
                                                    <div
                                                        v-for="item in itemsCierre"
                                                        :key="item.dinero"
                                                    >
                                                        <span
                                                            class="float-right font-weight-bold text-uppercase mr-3"
                                                        >
                                                            {{ item.cantidad }}
                                                        </span>
                                                        <span
                                                            class="font-weight-bold text-uppercase ml-2"
                                                        >
                                                            {{
                                                                item.abreviatura
                                                            }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 pr-0 pl-0">
                        <div class="card shadow ">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <calculator-dinero
                                            ref="registradoraCierre"
                                            v-on:evento="registrarCierre"
                                        ></calculator-dinero>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- <div class="row" v-if="aperturacaja == 'Sin Aperturar'">
                    <div class="col-md-3">
                        <label for="">Caja</label>
                        <v-select :options="cajas" v-model="caja"></v-select>
                    </div>
                    <div class="col-md-3">
                        <label for="">Cantidad</label>
                        <input
                            type="text"
                            name="cantidad"
                            id="cantidad"
                            style="height:30px;"
                            v-model="cantidadApertura"
                            class="form-control"
                        />
                    </div>
                    <div class="col-md-3 marginbutton">
                        <button
                            class="btn btn-primary btn-lg"
                            @click="abrirModal"
                        >
                            <i
                                class="fa fa-external-link"
                                aria-hidden="true"
                            ></i>
                            Aperturar Caja
                        </button>
                    </div>
                </div>
                <div class="row" v-if="aperturacaja != 'Sin Aperturar'">
                    <div class="col-md-3">
                        <label for="">Cantidad Cierre</label>
                        <input
                            type="text"
                            name="cantidad"
                            id="cantidad"
                            style="height:30px;"
                            v-model="cantidadCierre"
                            class="form-control"
                        />
                    </div>
                    <div class="col-md-3 marginbutton">
                        <button class="btn btn-primary" @click="cerrar">
                            Cerrar
                        </button>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            aperturacaja: "",
            verapertura: false,
            cajas: [],
            caja: "",
            cantidadApertura: "",
            cantidadCierre: 0,
            items: [],
            ventaEfectivo: "0.00",
            ventaTarjeta: "0.00",
            totalEntradas: "0.00",
            saldoApertura: "0.00",
            tarjetas: [],
            itemsCierre: [],
            descuadre: 0,
            descripcionDescuadre: ""
        };
    },
    created() {
        this.datos();
    },
    methods: {
        agregar: function() {
            var $this = this;
            if ($this.caja == "" || $this.cantidadApertura == "") {
                toastr.error("Falta Ingresar Datos", "Error");
            } else {
                axios
                    .post(route("Caja.aperturaCaja.registrar"), {
                        caja: $this.caja.code,
                        monto: $this.cantidadApertura,
                        dinero: $this.items
                    })
                    .then(value => {
                        $this.datos();
                    })
                    .catch(value => {});
            }
        },
        cerrar: function() {
            var $this = this;
            if ($this.cantidadCierre == 0) {
                toastr.error("Falta Ingresar Datos", "Error");
            } else {
                axios
                    .post(route("Caja.cierreCaja.registrar"), {
                        monto: $this.cantidadCierre,
                        dinero: $this.itemsCierre,
                        descuadre: $this.descuadre,
                        descripcion: $this.descripcionDescuadre
                    })
                    .then(value => {
                          $this.datos();
                    })
                    .catch(value => {});
            }
        },
        datos: function() {
            var $this = this;
            axios
                .get(route("Consulta.verificarCaja"))
                .then(value => {
                    var datos = value.data;
                    $this.aperturacaja = datos.mensaje;
                    var arreglo = [];
                    if (datos.mensaje == "Sin Aperturar") {
                        datos.datos.forEach((value, index, array) => {
                            let fila = {
                                label: value.nombre,
                                code: value.id
                            };
                            arreglo.push(fila);
                        });
                        $this.cajas = arreglo;
                    } else {
                        $this.caja = {
                            code: datos.datos.id,
                            label: datos.datos.nombre
                        };
                        $this.datosAperturardos();
                    }
                })
                .catch(value => {});
        },
        datosAperturardos: function() {
            var $this = this;

            axios
                .get(route("Consulta.getTarjetasConsumo"))
                .then(value => {
                    var totaltarjeta = 0;
                    $this.tarjetas = value.data;
                    $this.tarjetas.forEach((value, index, array) => {
                        totaltarjeta = totaltarjeta + value.cantidad;
                    });
                    $this.ventaTarjeta = totaltarjeta;
                })
                .catch(value => {});
            axios
                .get(route("Consulta.getVentas"))
                .then(value => {
                    $this.saldoApertura = value.data.saldoApertura;
                    $this.ventaEfectivo = value.data.ventaEfectivo;
                    $this.totalEntradas =
                        parseFloat($this.saldoApertura) +
                        parseFloat($this.ventaEfectivo);
                    $this.descuadre =
                        $this.cantidadCierre - $this.totalEntradas;
                })
                .catch(value => {});
        },
        registrar: function() {
            var $this = this;
            var elemento = $this.$refs.registradora.actual;
            if (this.items.length > 0) {
                var posicion = -1;
                this.items.forEach((value, index, array) => {
                    if (value.dinero == elemento.dinero) {
                        posicion = index;
                    }
                });
                if (posicion == -1) {
                    $this.items.push({
                        id: elemento.id,
                        abreviatura: elemento.abreviatura,
                        dinero: elemento.dinero,
                        cantidad: elemento.cantidad,
                        tipo: elemento.tipo
                    });
                } else {
                    $this.items[posicion].cantidad = elemento.cantidad;
                }
            } else {
                $this.items.push({
                    id: elemento.id,
                    abreviatura: elemento.abreviatura,
                    dinero: elemento.dinero,
                    cantidad: elemento.cantidad,
                    tipo: elemento.tipo
                });
            }
            this.total();

            // this.items.push(this.$refs.registradora.actual);
        },
        total: function() {
            var total = 0;
            this.items.forEach((value, index, array) => {
                total =
                    total +
                    parseFloat(value.dinero) * parseFloat(value.cantidad);
            });
            this.cantidadApertura = total;
        },
        registrarCierre: function() {
            var $this = this;
            var elemento = $this.$refs.registradoraCierre.actual;
            if (this.itemsCierre.length > 0) {
                var posicion = -1;
                this.itemsCierre.forEach((value, index, array) => {
                    if (value.dinero == elemento.dinero) {
                        posicion = index;
                    }
                });
                if (posicion == -1) {
                    $this.itemsCierre.push({
                        id: elemento.id,
                        abreviatura: elemento.abreviatura,
                        dinero: elemento.dinero,
                        cantidad: elemento.cantidad,
                        tipo: elemento.tipo
                    });
                } else {
                    $this.itemsCierre[posicion].cantidad = elemento.cantidad;
                }
            } else {
                $this.itemsCierre.push({
                    id: elemento.id,
                    abreviatura: elemento.abreviatura,
                    dinero: elemento.dinero,
                    cantidad: elemento.cantidad,
                    tipo: elemento.tipo
                });
            }

            this.totalCierre();

            // this.items.push(this.$refs.registradora.actual);
        },
        totalCierre: function() {
            var total = 0;
            var $this = this;
            this.itemsCierre.forEach((value, index, array) => {
                total =
                    total +
                    parseFloat(value.dinero) * parseFloat(value.cantidad);
            });
            this.cantidadCierre = total;
            $this.descuadre = $this.cantidadCierre - $this.totalEntradas;
        }
    }
};
</script>

<style>
.marginbutton {
    margin-top: 32px;
}
.rojo {
    color: rgb(207, 45, 45);
}
.verde {
    color: rgb(43, 184, 43);
}
</style>
