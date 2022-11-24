<template>
    <div>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10 col-md-10">
                <h2 style="text-transform:uppercase">
                    <b>Listado de Platos</b>
                </h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a>Inicio</a>
                    </li>
                    <li class="breadcrumb-item active">
                        <strong>Platos</strong>
                    </li>
                </ol>
            </div>
            <div class="col-lg-2 col-md-2">
                <button
                    v-on:click="nuevo"
                    id="btn_añadir_tipoPlato"
                    class="btn btn-block btn-w-m btn-primary m-t-md"
                >
                    <i class="fa fa-plus-square"></i> Añadir nuevo
                </button>
            </div>
        </div>
        <br />
        <div class="container">
            <div class="row">
                <plato-component
                    v-for="item in items"
                    :key="item.id"
                    :item="item"
                    @cambio="datosPlatos()"
                    @reset="reset()"
                ></plato-component>
            </div>
        </div>
        <div
            class="modal fade"
            id="modalCreate"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel">
                            Registra Nuevo Plato
                        </h3>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit="guardar" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="">
                                        Nombre del Plato
                                    </label>
                                    <input
                                        type="text"
                                        name="nombre"
                                        id="nombre"
                                        v-model="nombre"
                                        class="form-control"
                                    />
                                    <span class="invalid-feedback" role="alert">
                                        <strong>El Plato ya existe </strong>
                                    </span>
                                    <label for="">
                                        Precio del Platos
                                    </label>
                                    <input
                                        type="number"
                                        name="precio"
                                        id="precio"
                                        v-model="precio"
                                        class="form-control"
                                    />

                                    <div class="row">
                                        <div class="col-md-9 form-group">
                                            <label for="">Insumos</label>
                                            <v-select
                                                :options="insumos"
                                                v-model="insumo"
                                                v-on:input="cambiarUnidad()"
                                            ></v-select>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for=""
                                                        >Cantidad</label
                                                    >
                                                    <input
                                                        type="number"
                                                        name="cantidad"
                                                        id="cantidad"
                                                        class="form-control"
                                                        v-model="cantidad"
                                                    />
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">Unidad</label>
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        disabled
                                                        v-model="unidad"
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 form-group mt-4">
                                            <button
                                                class="btn btn-primary"
                                                type="button"
                                                v-on:click="agregarInsumo"
                                            >
                                                Agregar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label id="logo_label">Logo:</label>
                                            <div class="custom-file">
                                                <input
                                                    id="logo"
                                                    type="file"
                                                    name="logo"
                                                    v-on:change="
                                                        seleccionarimage
                                                    "
                                                    class="custom-file-input"
                                                    accept="image/*"
                                                />
                                                <label
                                                    for="logo"
                                                    id="logo_txt"
                                                    name="logo_txt"
                                                    class="custom-file-label selected"
                                                    >Seleccionar</label
                                                >
                                            </div>
                                        </div>
                                    </div>
                                    <br />
                                    <br />
                                    <div class="row">
                                        <div class="col-lg-2"></div>
                                        <div class="col-lg-7">
                                            <div
                                                class="row  justify-content-end"
                                            >
                                                <a
                                                    href="javascript:void(0);"
                                                    id="limpiar_logo"
                                                    v-on:click="limpiar"
                                                >
                                                    <span
                                                        class="badge badge-danger"
                                                        >x</span
                                                    >
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <br />
                                    <div class="row">
                                        <div class="col-lg-2"></div>
                                        <div class="col-lg-7">
                                            <p>
                                                <img
                                                    class="logo rounded img-fluid"
                                                    alt=""
                                                />
                                                <input
                                                    id="url_logo"
                                                    name="url_logo"
                                                    type="hidden"
                                                    value=""
                                                />
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table
                                            class="table table-hover table-bordered "
                                            id="dataTables-insumo"
                                        >
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th class="text-center">
                                                        Insumo
                                                    </th>
                                                    <th class="text-center">
                                                        Cantidad
                                                    </th>
                                                    <th class="text-center">
                                                        Unidad
                                                    </th>
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
                        <div class="modal-footer">
                            <button
                                type="button"
                                class="btn btn-secondary"
                                data-dismiss="modal"
                            >
                                Cerrar
                            </button>
                            <button type="submit" class="btn btn-primary">
                                Guardar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div
            class="modal fade"
            id="modalEditar"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel">
                            Editar Plato
                        </h3>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit="editar" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <input
                                        type="hidden"
                                        name="id_editar"
                                        id="id_editar"
                                    />
                                    <label for="">
                                        Nombre del Plato
                                    </label>
                                    <input
                                        type="text"
                                        name="nombre"
                                        id="nombre_editar"
                                        class="form-control"
                                    />
                                    <span class="invalid-feedback" role="alert">
                                        <strong>El Plato ya existe </strong>
                                    </span>
                                    <label for="">
                                        Precio del Plato
                                    </label>
                                    <input
                                        type="number"
                                        name="precio"
                                        id="precio_editar"
                                        class="form-control"
                                    />

                                    <div class="row">
                                        <div class="col-md-9 form-group">
                                            <label for="">Insumos</label>
                                            <v-select
                                                :options="insumos"
                                                v-model="insumo_item"
                                                v-on:input="cambiarUnidadEditar"
                                            ></v-select>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for=""
                                                        >Cantidad</label
                                                    >
                                                    <input
                                                        type="number"
                                                        id="cantidad_editar"
                                                        class="form-control"
                                                    />
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">Unidad</label>
                                                    <input
                                                        disabled
                                                        type="text"
                                                        id="unidad_editar"
                                                        class="form-control"
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 form-group mt-4">
                                            <button
                                                class="btn btn-primary"
                                                type="button"
                                                v-on:click="
                                                    agregarInsumo_editar
                                                "
                                            >
                                                Agregar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label id="logo_label">Logo:</label>
                                            <div class="custom-file">
                                                <input
                                                    id="logo_editar"
                                                    type="file"
                                                    name="logo_editar"
                                                    v-on:change="
                                                        seleccionarimage_editar
                                                    "
                                                    class="custom-file-input"
                                                    accept="image/*"
                                                />
                                                <label
                                                    id="logo_txt_editar"
                                                    name="logo_txt_editar"
                                                    class="custom-file-label selected"
                                                    >Seleccionar</label
                                                >
                                            </div>
                                        </div>
                                    </div>
                                    <br />
                                    <br />
                                    <div class="row">
                                        <div class="col-lg-2"></div>
                                        <div class="col-lg-7">
                                            <div
                                                class="row  justify-content-end"
                                            >
                                                <a
                                                    href="javascript:void(0);"
                                                    id="limpiar_logo"
                                                    v-on:click="limpiar_editar"
                                                >
                                                    <span
                                                        class="badge badge-danger"
                                                        >x</span
                                                    >
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <br />
                                    <div class="row">
                                        <div class="col-lg-2"></div>
                                        <div class="col-lg-7">
                                            <p>
                                                <img
                                                    class="logo_editar rounded img-fluid"
                                                    alt=""
                                                />
                                                <input
                                                    id="url_logo_editar"
                                                    name="url_logo_editar"
                                                    type="hidden"
                                                    value=""
                                                />
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table
                                            class="table table-hover table-bordered "
                                            id="dataTables-insumo_editar"
                                        >
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th class="text-center">
                                                        Insumo
                                                    </th>
                                                    <th class="text-center">
                                                        Cantidad
                                                    </th>
                                                    <th class="text-center">
                                                        Unidad
                                                    </th>
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
                        <div class="modal-footer">
                            <button
                                type="button"
                                class="btn btn-secondary"
                                data-dismiss="modal"
                            >
                                Cerrar
                            </button>
                            <button type="submit" class="btn btn-primary">
                                Guardar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            tipoplato_id: "",
            nombre: "",
            precio: "",
            imagen: "sin imagen",
            imagen_editar: "Imagen",
            file_editar: "",
            file: "",
            items: [],
            insumos: [],
            insumo: "",
            insumo_item: "",
            cantidad: "",
            unidad: ""
        };
    },
    created() {
        this.tipopalto_id = $("#tipoplato_id").val();
        this.datos();
        this.datosPlatos();
    },
    mounted() {
        $("#modalCreate #nombre").removeClass("is-invalid");
        $("#modalCreate .logo").attr(
            "src",
            window.location.origin + "/images/platodefault.jpg"
        );
        Vue.nextTick().then(function() {
            $(document).on("click", ".btn-eliminar", function(e) {
                var table = $("#dataTables-insumo").DataTable();
                table
                    .row($(this).parents("tr"))
                    .remove()
                    .draw();
            });
            $(document).on("click", ".btn-eliminar-editar", function(e) {
                var table = $("#dataTables-insumo_editar").DataTable();
                table
                    .row($(this).parents("tr"))
                    .remove()
                    .draw();
            });
        });
    },
    methods: {
        datosPlatos: function(e) {
            var $this = this;
            axios
                .get(route("Plato.getTable"), {
                    params: {
                        id: $this.tipopalto_id
                    }
                })
                .then(function(response) {
                    var datos_a = response.data;
                    var arreglo = [];
                    datos_a.forEach((value, index, array) => {
                        var producto = value.producto;
                        producto.id = value.id;
                        arreglo.push(producto);
                    });
                    $this.items = arreglo;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        datos: function() {
            var $this = this;
            axios
                .get(route("Consulta.getInsumos"))
                .then(function(response) {
                    var arreglo = [];
                    var datos = response.data;

                    datos.forEach((value, index, array) => {
                        var fila = {
                            label: value.nombre,
                            code: value.id,
                            unidad: value.unidad.nombre
                        };
                        arreglo.push(fila);
                    });
                    $this.insumos = arreglo;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        nuevo: function() {
            this.unidad = "";
            this.insumo = null;
            $("#dataTables-insumo").css("width", "100%");
            $("#modalCreate #numero").removeClass("is-invalid");
            $("#modalCreate").modal("show");
        },
        seleccionarimage_editar: function(e) {
            var $this = this;
            $this.file_editar = e.target.files[0];
            var filePath = $("#modalEditar #logo_editar").val();
            var allowedExtensions = /(.jpg|.jpeg|.png)$/i;
            if (allowedExtensions.exec(filePath)) {
                $this.imagen = "Imagen";

                var userFile = $("#modalEditar #logo_editar");
                userFile.attr(
                    "src",
                    URL.createObjectURL(event.target.files[0])
                );
                var data = userFile.attr("src");
                $("#modalEditar .logo_editar").attr("src", data);

                let fileName = $("#logo_editar")
                    .val()
                    .split("\\")
                    .pop();
                $("#logo_editar")
                    .next(".custom-file-label")
                    .addClass("selected")
                    .html(fileName);
            } else {
                $this.imagen = "sin imagen";
                toastr.error(
                    "Extensión inválida, formatos admitidos (.jpg . jpeg . png)",
                    "Error"
                );
                $(".logo_editar").attr(
                    "src",
                    window.location.origin + "/images/mesadefault.jpg"
                );
            }
        },
        seleccionarimage: function(e) {
            var $this = this;
            $this.file = e.target.files[0];
            var filePath = $("#modalCreate #logo").val();
            var allowedExtensions = /(.jpg|.jpeg|.png)$/i;
            if (allowedExtensions.exec(filePath)) {
                $this.imagen = "Imagen";

                var userFile = $("#modalCreate #logo");
                userFile.attr(
                    "src",
                    URL.createObjectURL(event.target.files[0])
                );
                var data = userFile.attr("src");
                $("#modalCreate .logo").attr("src", data);

                let fileName = $("#logo")
                    .val()
                    .split("\\")
                    .pop();
                $("#logo")
                    .next(".custom-file-label")
                    .addClass("selected")
                    .html(fileName);
            } else {
                $this.imagen = "sin imagen";
                toastr.error(
                    "Extensión inválida, formatos admitidos (.jpg . jpeg . png)",
                    "Error"
                );
                $(".logo").attr(
                    "src",
                    window.location.origin + "/images/mesadefault.jpg"
                );
            }
        },
        limpiar: function() {
            var $this = this;
            $this.imagen = "sin imagen";
            $("#modalCreate .logo").attr(
                "src",
                window.location.origin + "/images/mesadefault.jpg"
            );
            var fileName = "Seleccionar";
            $("#modalCreate  .custom-file-label")
                .addClass("selected")
                .html(fileName);
            $("#modalCreate  #logo").val("");
        },
        limpiar_editar: function() {
            var $this = this;
            $this.imagen_editar = "sin imagen";
            $("#modalEditar .logo_editar").attr(
                "src",
                window.location.origin + "/images/mesadefault.jpg"
            );
            var fileName = "Seleccionar";
            $("#modalEditar  .custom-file-label")
                .addClass("selected")
                .html(fileName);
            $("#modalEditar  #logo_Editar").val("");
        },
        guardar: function(e) {
            e.preventDefault();
            var $this = this;
            var tabla = $("#dataTables-insumo").DataTable();
            if (this.nombre.length == 0 || this.precio.length == 0) {
                toastr.error("Falta Ingresar datos", "Error");
            } else {
                if (this.imagen == "sin imagen") {
                    toastr.error("Seleccione una Imagen", "Error");
                } else {
                    const config = {
                        headers: {
                            "content-type": "multipart/form-data"
                        }
                    };

                    let data = new FormData();
                    var datos = tabla.rows().data();
                    var detalle = [];
                    $.each(datos, function(index, value) {
                        let fila = {
                            id: value[0],
                            cantidad: value[2]
                        };
                        detalle.push(fila);
                    });
                    data.append("tipoplato_id", this.tipopalto_id);
                    data.append("nombre", this.nombre);
                    data.append("precio", this.precio);
                    data.append("detalle", JSON.stringify(detalle));
                    data.append("file", this.file);

                    axios
                        .post(route("Plato.store"), data, config)
                        .then(function(res) {
                            $this.limpiar();
                            $("#modalCreate").modal("hide");
                            $this.datosPlatos();
                        })
                        .catch(function(err) {
                            console.log(err);
                        });
                }
            }
        },
        agregarInsumo: function() {
            var $this = this;
            if (this.insumo == null || this.cantidad == "") {
                toastr.error(
                    "Error",
                    "Ingresé todo los datos para agregar un insumo"
                );
            } else {
                var $this = this;
                var table = $("#dataTables-insumo").DataTable();
                table.row
                    .add([
                        $this.insumo.code,
                        $this.insumo.label,
                        $this.cantidad,
                        $this.unidad,
                        ""
                    ])
                    .draw(false);
            }
        },
        agregarInsumo_editar: function() {
            var $this = this;
            if ($this.insumo_item == null || $("#cantidad_editar").val().length == 0) {
                toastr.error(
                    "Error",
                    "Ingresé todo los datos para agregar un insumo"
                );
            } else {
                var table = $("#dataTables-insumo_editar").DataTable();
                table.row
                    .add([
                        $this.insumo_item.code,
                        $this.insumo_item.label,
                        $("#cantidad_editar").val(),
                        $("#unidad_editar").val(),
                        ""
                    ])
                    .draw(false);
            }
        },
        editar: function(e) {
            e.preventDefault();
            var $this = this;
            var tabla = $("#dataTables-insumo_editar").DataTable();
            if (
                $("#nombre_editar").val().length == 0 ||
                $("#precio_editar").val().length == 0
            ) {
                toastr.error("Falta Ingresar datos", "Error");
            } else {
                if (this.imagen_editar == "sin imagen") {
                    toastr.error("Seleccione una Imagen", "Error");
                } else {
                    const config = {
                        headers: {
                            "content-type": "multipart/form-data"
                        }
                    };

                    let data = new FormData();
                    var datos = tabla.rows().data();
                    var detalle = [];
                    $.each(datos, function(index, value) {
                        let fila = {
                            id: value[0],
                            cantidad: value[2]
                        };
                        detalle.push(fila);
                    });
                    data.append("id", $("#id_editar").val());
                    data.append("nombre", $("#nombre_editar").val());
                    data.append("precio", $("#precio_editar").val());
                    data.append("detalle", JSON.stringify(detalle));
                    data.append("file", this.file_editar);

                    axios
                        .post(route("Plato.editar"), data, config)
                        .then(function(res) {
                            $("#modalEditar").modal("hide");
                            $this.datosPlatos();
                        })
                        .catch(function(err) {
                            console.log(err);
                        });
                }
            }
        },
        reset: function() {
            this.imagen_editar = "Imagen";
            this.file_editar = "";
        },
        cambiarUnidad: function() {
            this.unidad = this.insumo.unidad;
        },
        cambiarUnidadEditar: function() {
            // this.unidad=this.insumo_item.unidad
            $("#unidad_editar").val(this.insumo_item.unidad)
        }
    }
};
</script>
<style>
label {
    margin-top: 10px;
}
/** */
</style>
