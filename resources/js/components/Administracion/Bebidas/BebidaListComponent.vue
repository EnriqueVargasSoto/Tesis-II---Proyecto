<template>
    <div>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10 col-md-10">
                <h2 style="text-transform:uppercase">
                    <b>Listado de Bebidas</b>
                </h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a>Inicio</a>
                    </li>
                    <li class="breadcrumb-item active">
                        <strong>Bebidas</strong>
                    </li>
                </ol>
            </div>
            <div class="col-lg-2 col-md-2">
                <button
                    v-on:click="nuevo"
                    class="btn btn-block btn-w-m btn-primary m-t-md"
                >
                    <i class="fa fa-plus-square"></i> Añadir nuevo
                </button>
            </div>
        </div>
        <br />
        <div class="container">
            <div class="row">
                <bebida-component
                    v-for="item in items"
                    :key="item.id"
                    :item="item"
                    @cambio="datosBebidas()"
                    @reset="reset()"
                ></bebida-component>
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
                            Registra Nuevo Bebida
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
                                        Nombre del Bebida
                                    </label>
                                    <input
                                        type="text"
                                        name="nombre"
                                        id="nombre"
                                        v-model="nombre"
                                        class="form-control"
                                    />
                                    <label for="">
                                        Precio del Bebida
                                    </label>
                                    <input
                                        type="number"
                                        name="precio"
                                        id="precio"
                                        v-model="precio"
                                        class="form-control"
                                    />
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
            tipobebida_id: "",
            nombre: "",
            precio: "",
            imagen: "sin imagen",
            file: "",
            items: []
        };
    },
    created() {
        this.tipobebida_id = $("#tipobebida_id").val();
        this.datosBebidas();
    },
    mounted() {
        $("#modalCreate .logo").attr(
            "src",
            window.location.origin + "/images/bebidadefault.png"
        );
    },
    methods: {
        datosBebidas: function(e) {
            var $this = this;
            axios
                .get(route("Bebida.getTable"), {
                    params: {
                        id: $this.tipobebida_id
                    }
                })
                .then(function(response) {
                    var datos_a = response.data;
                    var arreglo = [];
                    datos_a.forEach((value, index, array) => {
                        var bebida = value.producto;
                        bebida.id = value.id;
                        arreglo.push(bebida);
                    });
                    $this.items = arreglo;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        nuevo: function() {
            $("#modalCreate").modal("show");
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
                    window.location.origin + "/images/bebidadefault.png"
                );
            }
        },
        limpiar: function() {
            var $this = this;
            $this.imagen = "sin imagen";
            $("#modalCreate .logo").attr(
                "src",
                window.location.origin + "/images/bebidadefault.png"
            );
            var fileName = "Seleccionar";
            $("#modalCreate  .custom-file-label")
                .addClass("selected")
                .html(fileName);
            $("#modalCreate  #logo").val("");
        },
        guardar: function(e) {
            e.preventDefault();
            var $this = this;
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
                    data.append("tipobebida_id", this.tipobebida_id);
                    data.append("nombre", this.nombre);
                    data.append("precio", this.precio);
                    data.append("file", this.file);

                    axios
                        .post(route("Bebida.store"), data, config)
                        .then(function(res) {
                            $this.limpiar();
                            $("#modalCreate").modal("hide");
                            $this.datosBebidas();
                        })
                        .catch(function(err) {
                            console.log(err);
                        });
                }
            }
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
