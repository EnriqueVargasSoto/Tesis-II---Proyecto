<template>
    <div class="col-lg-3">
        <div class="ibox">
            <div class="ibox-content product-box" style="padding-bottom:5px">
                <div style="height:180px;">
                    <img
                        style="height:100%;width:100%;"
                        :src="
                            iniciourl +
                                '/' +
                                item.url_imagen.replace('public', 'storage')
                        "
                    />
                </div>
                <div class="product-desc">
                    <span class="product-price"> S/{{ item.precio }} </span>
                    <a href="#" class="product-name">{{ item.nombre }}</a>
                </div>
                <div style="margin-left:10px;">
                    <a
                        href="#"
                        class="btn btn-xs  btn-primary"
                        v-on:click="abrir"
                        >Editar<i class="fa fa-pencil"></i>
                    </a>
                    <a
                        href="#"
                        class="btn btn-xs  btn-danger"
                        v-on:click="eliminar"
                        >Eliminar<i class="fa fa-trash"></i>
                    </a>
                </div>
            </div>
        </div>
        <div
            class="modal fade"
            :id="'modalEditar' + item.id"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel">
                            Editar Bebida
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
                                    <label for="">
                                        Nombre del Bebida
                                    </label>
                                    <input
                                        type="text"
                                        name="nombre"
                                        id="nombre"
                                        v-model="itemBebida.nombre"
                                        class="form-control"
                                    />
                                    <label for="">
                                        Precio del Bebida
                                    </label>
                                    <input
                                        type="number"
                                        name="precio"
                                        id="precio"
                                        v-model="itemBebida.precio"
                                        class="form-control"
                                    />
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label id="logo_label">Logo:</label>
                                            <div class="custom-file">
                                                <input
                                                    :id="'logo' + item.id"
                                                    type="file"
                                                    v-on:change="
                                                        seleccionarimage
                                                    "
                                                    class="custom-file-input"
                                                    accept="image/*"
                                                />
                                                <label
                                                    :id="'logo_txt' + item.id"
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
                                                    :id="'logoEditar' + item.id"
                                                    class="logo rounded img-fluid"
                                                    alt=""
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
    props: ["item"],
    data() {
        return {
            itemBebida: {},
            imagen: "Imagen"
        };
    },
    created() {
        this.iniciourl = window.location.origin;
        this.itemBebida = {
            nombre: this.item.nombre,
            precio: this.item.precio,
            file: null
        };
    },
    mounted() {
        var $this = this;
        $("#logoEditar" + this.item.id).attr(
            "src",
            $this.iniciourl +
                "/" +
                $this.item.url_imagen.replace("public", "storage")
        );
        $("#logo_txt" + $this.item.id).html($this.item.nombre_imagen);
    },
    methods: {
        abrir: function() {
            var $this = this;
            $("#modalEditar" + $this.item.id).modal("show");
        },
        editar: function(e) {
            e.preventDefault();
            var $this = this;
            if (
                this.itemBebida.nombre.length == 0 ||
                this.itemBebida.precio.length == 0
            ) {
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
                    data.append("id", this.item.id);
                    data.append("nombre", this.itemBebida.nombre);
                    data.append("precio", this.itemBebida.precio);
                    data.append("file", this.itemBebida.file);

                    axios
                        .post(
                            route("Bebida.editar"),
                            data,
                            config
                        )
                        .then(function(res) {
                            $this.$emit("cambio");
                            $("#modalEditar" + $this.item.id).modal("hide");
                        })
                        .catch(function(err) {
                            console.log(err);
                        });
                }
            }
        },
        eliminar: function() {
            var $this = this;
            Swal.fire({
                title: "Opción Eliminar",
                text: "¿Seguro que desea guardar cambios?",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#1ab394",
                confirmButtonText: "Si, Confirmar",
                cancelButtonText: "No, Cancelar"
            }).then(result => {
                if (result.isConfirmed) {
                    axios
                        .get(route("Bebida.eliminar"), {
                            params: {
                                id: $this.item.id
                            }
                        })
                        .then(result => {
                            $this.$emit("cambio");
                        })
                        .catch(value => {});
                }
            });
        },
        seleccionarimage: function(e) {
            var $this = this;
            $this.itemBebida.file = e.target.files[0];
            var filePath = $(
                "#modalEditar" + $this.item.id + " #logo" + $this.item.id
            ).val();
            var allowedExtensions = /(.jpg|.jpeg|.png)$/i;
            if (allowedExtensions.exec(filePath)) {
                $this.imagen = "Imagen";

                var userFile = $(
                    "#modalEditar" + $this.item.id + " #logo" + $this.item.id
                );
                userFile.attr(
                    "src",
                    URL.createObjectURL(event.target.files[0])
                );
                var data = userFile.attr("src");
                $("#logoEditar" + this.item.id).attr("src", data);

                let fileName = $(
                    "#modalEditar" + $this.item.id + " #logo" + $this.item.id
                )
                    .val()
                    .split("\\")
                    .pop();
                $("#logo_txt" + $this.item.id).html(fileName);
            } else {
                $this.imagen = "Imagen";
                toastr.error(
                    "Extensión inválida, formatos admitidos (.jpg . jpeg . png)",
                    "Error"
                );
                $("#logoEditar" + this.item.id).attr(
                    "src",
                    $this.iniciourl +
                        "/" +
                        $this.item.url_imagen.replace("public", "storage")
                );
            }
        },
        limpiar: function() {
            var $this = this;
            $this.imagen = "sin imagen";
            $("#logoEditar" + this.item.id).attr(
                "src",
                window.location.origin + "/images/bebidadefault.png"
            );
            var fileName = "Seleccionar";
            $("#logo_txt" + $this.item.id).html(fileName);
            $("#logoEditar" + this.item.id).val("");
        }
    }
};
</script>

<style></style>
