<template>
    <div class="row">
        <div class="col-md-8">
            <div class="p-3 bg-white rounded shadow mb-5 my-sm-2">
                <!-- Rounded tabs -->
                <ul
                    id="myTab"
                    role="tablist"
                    class="nav nav-tabs nav-pills flex-column flex-sm-row text-center bg-light border-0 rounded-nav"
                >
                    <li class="nav-item flex-sm-fill">
                        <a
                            id="home-tab"
                            data-toggle="tab"
                            href="#productos"
                            role="tab"
                            aria-controls="home"
                            aria-selected="true"
                            class="nav-link border-0 font-weight-bold active"
                            ><i
                                class="fa fa-shopping-cart fa-lg"
                                aria-hidden="true"
                            >
                                Productos</i
                            ></a
                        >
                    </li>
                    <li class="nav-item flex-sm-fill">
                        <a
                            id="profile-tab"
                            data-toggle="tab"
                            href="#mesas"
                            role="tab"
                            aria-controls="profile"
                            aria-selected="false"
                            class="nav-link border-0 font-weight-bold"
                            ><i class="fa fa-th-list fa-lg" aria-hidden="true">
                                Mesas</i
                            ></a
                        >
                    </li>
                    <li class="nav-item flex-sm-fill">
                        <a
                            id="profile-tab"
                            data-toggle="tab"
                            href="#pedidos"
                            role="tab"
                            aria-controls="profile"
                            aria-selected="false"
                            class="nav-link border-0 font-weight-bold"
                            ><i class="fa fa-th-list fa-lg" aria-hidden="true">
                                Pedidos</i
                            ></a
                        >
                    </li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div
                        id="productos"
                        role="tabpanel"
                        aria-labelledby="home-tab"
                        class="tab-pane fade px-4 py-5 show active"
                    >
                        <div class="row">
                            <h4>
                                Tiempo de Busqueda en segundos: {{ tiempo }}
                            </h4>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="row">
                                    <div
                                        class="col-md-6 caja"
                                        @click="tipo('platos')"
                                    >
                                        <i
                                            class="fa fa-align-center"
                                            aria-hidden="true"
                                        ></i>
                                        Platos
                                    </div>
                                    <div
                                        class="col-md-6 caja"
                                        @click="tipo('bebidas')"
                                    >
                                        <i
                                            class="fa fa-glass"
                                            aria-hidden="true"
                                        ></i>
                                        Bebidas
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="input-group mb-3">
                                    <!-- <input
                                        type="text"
                                        name="buscar"
                                        id="buscar"
                                        v-model="buscar"
                                        placeholder="Buscar Producto"
                                        class="form-control form-control-sm"
                                    /> -->
                                    <div class="input-group mb-3">
                                        <input
                                            type="text"
                                            name="buscarProducto"
                                            id="buscarProducto"
                                            placeholder="Buscar Producto"
                                            class="form-control form-control-md"
                                        />
                                        <div class="input-group-append">
                                            <button
                                                class="btn btn-outline-success"
                                                type="button"
                                                @click="busqueda()"
                                            >
                                                Buscar
                                            </button>
                                        </div>
                                    </div>
                                    <!-- <input
                                        type="text"
                                        name="buscar"
                                        id="buscar"
                                        placeholder="Buscar Producto"
                                        class="form-control form-control-sm"
                                    />
                                    <div class="input-group-append">
                                        <span
                                            class="input-group-text"
                                            id="basic-addon2"
                                            ><i
                                                class="fa fa-search"
                                                aria-hidden="true"
                                            ></i
                                        ></span>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="row">
                                    <div
                                        class="col-md-12 caja"
                                        v-for="item in tipos"
                                        :key="item.id"
                                        @click="datosTipos(item)"
                                    >
                                        <i
                                            class="fa fa-cutlery"
                                            aria-hidden="true"
                                        ></i>
                                        {{ item.tipo }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="row">
                                    <div
                                        class="col-md-4"
                                        v-for="fila in productosb"
                                        :key="fila.id"
                                    >
                                        <div class="ibox">
                                            <div
                                                class="ibox-content product-box"
                                                style="padding-bottom:5px"
                                            >
                                                <div style="height:180px;">
                                                    <img
                                                        style="height:100%;width:100%;"
                                                        :src="
                                                            iniciourl +
                                                                '/' +
                                                                fila.url_imagen.replace(
                                                                    'public',
                                                                    'storage'
                                                                )
                                                        "
                                                    />
                                                </div>
                                                <div class="product-desc">
                                                    <span class="product-price">
                                                        S/{{ fila.precio }}
                                                    </span>
                                                    <a
                                                        href="#"
                                                        class="product-name"
                                                        >{{ fila.nombre }}</a
                                                    >
                                                </div>
                                                <div style="margin-left:10px;">
                                                    <div class="form-row">
                                                        <div
                                                            class="form-group col-md-5"
                                                        >
                                                            <input
                                                                type="number"
                                                                min="0"
                                                                v-model="
                                                                    fila.cantidad
                                                                "
                                                                class="form-control form-control-sm"
                                                            />
                                                        </div>

                                                        <div
                                                            class="form-group col-md-5"
                                                        >
                                                            <a
                                                                href="#"
                                                                class="btn btn-sm btn-primary"
                                                                @click="
                                                                    agregar(
                                                                        fila
                                                                    )
                                                                "
                                                                >Agregar<i
                                                                    class="fa fa-add"
                                                                ></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        id="mesas"
                        role="tabpanel"
                        aria-labelledby="home-tab"
                        class="tab-pane fade px-4 py-5 show"
                    >
                        <div class="input-group mb-3">
                            <input
                                type="text"
                                name="buscarmesa"
                                id="buscarmesa"
                                v-model="buscarmesa"
                                placeholder="Buscar Mesa"
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
                        <div class="row">
                            <div
                                class="col-md-4"
                                v-for="(fila, index) in mesasb"
                                :key="fila.id"
                            >
                                <div class="ibox">
                                    <div
                                        class="ibox-content product-box"
                                        style="padding-bottom:5px"
                                    >
                                        <div style="height:180px;">
                                            <img
                                                style="height:100%;width:100%;"
                                                :src="
                                                    iniciourl +
                                                        '/' +
                                                        fila.url_imagen.replace(
                                                            'public',
                                                            'storage'
                                                        )
                                                "
                                            />
                                        </div>
                                        <div class="product-desc">
                                            <span
                                                v-bind:class="[
                                                    fila.disponibilidad ==
                                                    'DISPONIBLE'
                                                        ? 'product-price'
                                                        : 'product-price bg-danger'
                                                ]"
                                            >
                                                {{ fila.disponibilidad }}
                                            </span>
                                            <a href="#" class="product-name">{{
                                                " Mesa" + fila.numero
                                            }}</a>
                                        </div>
                                        <div style="margin-left:10px;">
                                            <div class="form-row">
                                                <div
                                                    class="form-group col-md-5"
                                                    v-if="
                                                        fila.disponibilidad ==
                                                            'DISPONIBLE'
                                                    "
                                                >
                                                    <a
                                                        href="#"
                                                        class="btn btn-sm btn-primary"
                                                        @click="
                                                            seleccionar(index)
                                                        "
                                                        >Seleccionar<i
                                                            class="fa fa-add"
                                                        ></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        id="pedidos"
                        role="tabpanel"
                        aria-labelledby="home-tab"
                        class="tab-pane fade px-4 py-5 show"
                    >
                        <div class="dd" id="nestable2">
                            <ol class="dd-list">
                                <li
                                    class="dd-item"
                                    v-for="item in pedidos"
                                    :key="item.id"
                                >
                                    <div class="dd-handle">
                                        <span class="float-right">
                                            {{
                                                "Total-Pedido: S/." +
                                                    item.pedidoMesa.pedido.total
                                            }}
                                        </span>
                                        <span class="label label-success"
                                            ><i class="fa fa-users"></i
                                        ></span>
                                        {{ "Mesa " + item.mesa.numero }}
                                    </div>
                                    <ol class="dd-list">
                                        <li
                                            class="dd-item"
                                            v-for="fila in item.detalles"
                                            :key="fila.id"
                                        >
                                            <div class="dd-nodrag">
                                                <span class="float-right">
                                                    {{
                                                        "Total-item: S/." +
                                                            fila.cantidad *
                                                                fila.producto
                                                                    .precio
                                                    }}
                                                </span>
                                                <span
                                                    v-bind:class="[
                                                        fila.estado_pedido ==
                                                        'PENDIENTE'
                                                            ? 'label label-danger'
                                                            : 'label label-success'
                                                    ]"
                                                    style="cursor: pointer;"
                                                    @click="estadoPedido(fila)"
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
                    </div>
                </div>
                <!-- End rounded tabs -->
            </div>
        </div>
        <div class="col-md-4" style="margin-top:10px;">
            <div class="list-product">
                <div class="ibox">
                    <div class="ibox-title">
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
                    <div class="ibox-content" v-if="nproduct > 0">
                        <div class="feed-activity-list">
                            <div
                                class="feed-element"
                                v-for="(fila, index) in productitemsb"
                                :key="fila.id"
                            >
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <strong>{{ fila.nombre }}</strong>
                                            <div>
                                                {{ "S/." + fila.precio }}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="row">
                                                <div
                                                    class="col-md-12 d-flex justify-content-center"
                                                >
                                                    <a
                                                        href="#"
                                                        class="btn btn-sm btn-danger"
                                                        @click="eliminar(index)"
                                                        ><i
                                                            class="fa fa-trash"
                                                        ></i>
                                                    </a>
                                                </div>
                                            </div>

                                            <div
                                                class="row"
                                                style="margin-top:10px;"
                                            >
                                                <div class="col-md-12">
                                                    <i
                                                        class="fa fa-minus-circle fa-2x"
                                                        @click="
                                                            disminuir(index)
                                                        "
                                                        aria-hidden="true"
                                                    ></i>
                                                    <span
                                                        style="font-size:15px;margin:0px 5px 0px 5px;"
                                                        >{{
                                                            fila.cantidad
                                                        }}</span
                                                    >
                                                    <i
                                                        class="fa fa-plus-circle fa-2x"
                                                        @click="aumentar(index)"
                                                        aria-hidden="true"
                                                    ></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ibox-footer text-right" v-if="nproduct > 0">
                        <div class="text-left">
                            <span class="h6">Lista de Mesas </span>
                        </div>
                        <div class="row">
                            <div
                                class="col-md-12 text-left"
                                v-for="(itemMesa, index) in mesasElegidas"
                                :key="itemMesa.id"
                            >
                                <span class="float-right">
                                    <a
                                        href="#"
                                        class="btn btn-sm btn-danger"
                                        @click="eliminarMesa(index)"
                                        ><i class="fa fa-trash"></i>
                                    </a>
                                </span>
                                <h3>
                                    {{ "Mesa:" + itemMesa.numero }}
                                </h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 text-left"></div>
                            <div class="col-md-6">
                                <h3>{{ "Total: S/. " + total }}</h3>
                            </div>
                            <br />
                            <div class="col-md-12">
                                <button
                                    type="button"
                                    class="btn btn-primary btn-block btn-lg text-uppercase"
                                    @click="registrarPedido"
                                >
                                    <i
                                        class="fa fa-shopping-cart fa-2x"
                                        aria-hidden="true"
                                    ></i>
                                    <span class="h6">Guardar Pedido</span>
                                </button>
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
    props: ["usuario", "tiempoinicial"],
    data() {
        return {
            buscar: "",
            buscarmesa: "",
            buscaritem: "",
            productos: [],
            productosb: [],
            iniciourl: "",
            productitems: [],
            productitemsb: [],
            mesas: [],
            mesasb: [],
            nproduct: 0,
            total: 0,
            mesasElegidas: [],
            pedidos: [],
            tipos: [],
            tipoalimento: "",
            tiposPlatos: [],
            tiposBebidas: [],
            tiempoI: null,
            tiempoF: null,
            tiempo: 0,
            pagina: true
        };
    },
    watch: {
        buscar: function(val) {
            var $this = this;
            $this.productosb = $this.productos.filter((value, index, array) => {
                return value.nombre.toLowerCase().includes(val.toLowerCase());
            });
        }
    },
    created: function() {

        var $this = this;
        $this.iniciourl = window.location.origin;
        axios
            .get(route("Consulta.getMesas"))
            .then(response => {
                $this.mesas = response.data;
                $this.mesasb = $this.mesas;
            })
            .catch(value => {
                console.log(value);
            });
        //---------------------------
        $this.pedidoMesas();
        //----------------------------
        axios
            .get(route("TipoPlato.getTable"))
            .then(value => {
                //$this.pedidos = value.data;
                $this.tiposPlatos = value.data.data;
            })
            .catch(value => {});
        //----------------------------
        axios
            .get(route("TipoBebida.getTable"))
            .then(value => {
                //$this.pedidos = value.data;
                $this.tiposBebidas = value.data.data;
            })
            .catch(value => {});
    },
    mounted: function() {
        this.tiempoI = new Date(this.tiempoinicial);
    },
    methods: {
        busqueda: function() {
            console.log("fadsas")
            let $this = this;
            console.log(this.tiempoI)
            if (this.pagina) {
                this.tiempo =
                    (new Date().getTime() - this.tiempoI.getTime()) / 1000;
                this.pagina = false;
            }
            $this.productosb = $this.productos.filter((value, index, array) => {
                return value.nombre.toLowerCase().includes($("#buscarProducto").val().toLowerCase());
            });
        },
        pedidoMesas: function() {
            var $this = this;
            axios
                .get(route("Consulta.getPedidosMesas", "PENDIENTE"))
                .then(value => {
                    $this.pedidos = value.data;
                })
                .catch(value => {});
        },
        totalPedido: function() {
            var total = 0;
            this.productitems.forEach(element => {
                total = total + element.cantidad * element.precio;
            });
            this.total = total;
        },
        agregar: function(fila) {
            var $this = this;
            if (
                this.productitems.filter((value, index, array) => {
                    return value.id === fila.id;
                }).length == 0
            ) {
                if (fila.cantidad > 0) {
                    this.productitems.push(fila);
                    this.productitemsb = this.productitems;
                    this.nproduct = this.productitems.length;
                    this.totalPedido();
                } else {
                    toastr.error(
                        "El valor de la cantidad no es aceptado",
                        "Error"
                    );
                }
            } else {
                toastr.error("El producto ya esta agregado", "Error");
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
        eliminar: function(index) {
            this.productitems.splice(index, 1);
            this.productitemsb = this.productitems;
            this.nproduct = this.productitems.length;
            this.totalPedido();
        },
        eliminarMesa: function(index) {
            this.mesasElegidas.splice(index, 1);
        },
        disminuir: function(index) {
            if (this.productitems[index].cantidad != 1) {
                this.productitems[index].cantidad =
                    parseInt(this.productitems[index].cantidad) - 1;
                this.productitemsb = this.productitems;
                this.totalPedido();
            }
        },
        aumentar: function(index) {
            this.productitems[index].cantidad =
                parseInt(this.productitems[index].cantidad) + 1;
            this.productitemsb = this.productitems;
            this.totalPedido();
        },
        seleccionar: function(index) {
            this.mesasElegidas.push(this.mesasb[index]);
        },
        registrarPedido: function() {
            var $this = this;
            if (this.mesasElegidas.length == 0) {
                toastr.error("No se ha seleccionado ninguna mesa", "Error");
            } else if (this.usuario.id == 1) {
                toastr.error(
                    "No se puede registrar con el usuario administrador",
                    "Error"
                );
            } else {
                axios
                    .post(route("Pedido.Mesa.registar"), {
                        pedidos: $this.productitems,
                        mesas: $this.mesasElegidas
                    })
                    .then(value => {
                        $this.productitems = [];
                        $this.productitemsb = [];
                        $this.nproduct = $this.productitems.length;
                        $this.mesasElegidas = [];
                        axios
                            .get(route("Consulta.getMesas"))
                            .then(response => {
                                $this.mesas = response.data;
                                $this.mesasb = $this.mesas;
                                $this.pedidoMesas();
                            })
                            .catch(value => {
                                console.log(value);
                            });
                    })
                    .catch(value => {});
            }
        },
        tipo: function(tipo_p) {
            if (tipo_p == "platos") {
                this.tipos = this.tiposPlatos;
                this.tipoalimento = "platos";
            } else {
                this.tipos = this.tiposBebidas;
                this.tipoalimento = "bebidas";
            }
        },
        datosTipos: function(tiposeleccionado) {
            var $this = this;
            axios
                .get(route("Pedido.Mesa.tipoAlimento"), {
                    params: {
                        id: tiposeleccionado.id,
                        tipo: $this.tipoalimento
                    }
                })
                .then(response => {
                    $this.productos = [];
                    response.data.forEach((value, index, array) => {
                        let fila = value.producto;
                        fila.cantidad = 0;
                        $this.productos.push(fila);
                    });
                    $this.productosb = $this.productos;
                })
                .catch(value => {});
        }
    }
};
</script>
<style>
.list-product {
    width: 100%;
    height: 500px;
    overflow: auto;
}
.caja {
    border: solid 0.5px rgb(224, 224, 224);
    height: 30px;
    font-size: 11px;
    font-weight: bold;
    padding: 5px 0px 0px 1px;
    text-transform: uppercase;
    text-align: center;
}
.caja:hover {
    background-color: #1ab394;
    color: white;
    cursor: pointer;
}
</style>
