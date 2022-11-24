<template>
    <div class="col-lg-3">
        <div class="contact-box center-version">
            <a href="profile.html">
                <img
                    alt="image"
                    class="rounded-circle"
                    :src="
                        iniciourl +
                            '/' +
                            item.url_imagen.replace('public', 'storage')
                    "
                />

                <h3 class="m-b-xs">
                    <strong>Numero de Mesa: {{ item.numero }}</strong>
                </h3>
                <address class="m-t-md">
                    {{ item.descripcion }}
                </address>
            </a>
            <div class="contact-box-footer">
                <div class="m-t-xs btn-group">
                    <a class="btn btn-xs btn-white" v-on:click="abrir"
                        ><i class="fa fa-pencil"></i> Editar</a
                    >
                    <a class="btn btn-xs btn-white" v-on:click="eliminar"
                        ><i class="fa fa-trash"></i>Eliminar</a
                    >
                </div>
            </div>
        </div>
        <div
            class="modal fade"
            :id="'modaleditar' + item.id"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3
                            class="modal-title"
                            :id="'exampleModalLabel' + item.id"
                        >
                            {{ "Editar Mesa numero:" + item.numero }}
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
                                        Numero de la Mesa *
                                    </label>
                                    <input
                                        type="text"
                                        :id="'numero' + item.id"
                                        v-model="nmesa"
                                        class="form-control"
                                    />
                                    <span class="invalid-feedback" role="alert">
                                        <strong
                                            >El Numero de mesa ya existe
                                        </strong>
                                    </span>

                                    <label for="">
                                        Ambiente
                                    </label>
                                    <select
                                        name="ambiente"
                                        id="ambiente"
                                        v-model="ambiente"
                                        class="form-control"
                                    >
                                        <option
                                            v-for="fila in ambientes"
                                            :key="fila.id"
                                            v-bind:value="fila.value"
                                        >
                                            {{ fila.text }}
                                        </option>
                                    </select>

                                    <label for="">Descripcion *</label>
                                    <textarea
                                        v-model="descripcion"
                                        :id="'descripcion' + item.id"
                                        cols="30"
                                        rows="5"
                                        class="form-control"
                                    ></textarea>
                                    <!-- <input
                                    type="text"
                                    name="descripcion"
                                    id="descripcion"
                                    class="form-control"
                                /> -->
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
                                                    for="logo"
                                                    :id="'logo_txt' + item.id"
                                                    class="custom-file-label selected"
                                                    >{{
                                                        item.nombre_imagen
                                                    }}</label
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
                                                    :id="
                                                        'limpiar_logo' + item.id
                                                    "
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
                                                    class="rounded img-fluid"
                                                    :id="
                                                        'img_logo_editar' +
                                                            item.id
                                                    "
                                                    :src="
                                                        iniciourl +
                                                            '/' +
                                                            item.url_imagen.replace(
                                                                'public',
                                                                'storage'
                                                            )
                                                    "
                                                    alt=""
                                                />
                                                <input
                                                    :id="'url_logo' + item.id"
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
    props: ["item"],
    data() {
        return {
            id: "",
            nmesa: "",
            ambiente: "",
            descripcion: "",
            ambientes: [],
            imagen: "Imagen",
            file: "",
            iniciourl: ""
        };
    },
    created() {
        this.datosAmbiente();
        this.iniciourl = window.location.origin;
        $(
            "#modaleditar" + this.item.id + " #numero" + this.item.id
        ).removeClass("is-invalid");
        this.nmesa = this.item.numero;
        this.descripcion = this.item.descripcion;
        this.id = this.item.id;
        this.ambiente = this.item.ambiente_id;
    },
    mounted() {},
    methods: {
        datosAmbiente: function() {
            var $this = this;
            axios
                .get(window.location.origin + "/Consulta/getAmbiente")
                .then(function(response) {
                    var arreglo = [];
                    var datos = response.data;
                    datos.forEach((value, index, array) => {
                        var fila = {
                            text: value.nombre,
                            id: value.id,
                            value: value.id
                        };
                        arreglo.push(fila);
                    });
                    $this.ambientes = arreglo;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        abrir: function() {
            var $this = this;
            $("#modaleditar" + $this.item.id).modal("show");
            $(
                "#modaleditar" + this.item.id + " #numero" + this.item.id
            ).removeClass("is-invalid");
            this.nmesa = this.item.numero;
            this.descripcion = this.item.descripcion;
            $("#modaleditar" + this.item.id + "  .custom-file-label")
                .addClass("selected")
                .html(this.item.nombre_imagen);
            $("#img_logo_editar" + this.item.id).attr(
                "src",
                $this.iniciourl +
                    "/" +
                    $this.item.url_imagen.replace("public", "storage")
            );
        },
        guardar: function(e) {
            e.preventDefault();
            var $this = this;
            if (this.nmesa.length == 0) {
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
                    data.append("numero", this.nmesa);
                    data.append("descripcion", this.descripcion);
                    data.append("file", this.file);
                    data.append("id", this.id);
                    data.append("ambiente_id", this.ambiente);
                    axios
                        .post(
                            window.location.origin + "/Mesa/editar",
                            data,
                            config
                        )
                        .then(function(res) {
                            console.log(res);
                            if (res.data != "") {
                                $(
                                    "#modaleditar" +
                                        $this.item.id +
                                        " #numero" +
                                        $this.item.id
                                ).addClass("is-invalid");
                                // var errores=value.data.error;
                                // inicio.eInvalid=true;
                                // $("#emailInvalid").html(errores.email[0]);
                            } else {
                                $("#modaleditar" + $this.item.id).modal("hide");
                                $this.$emit("cambio");
                            }
                        })
                        .catch(function(err) {
                            console.log(err);
                        });
                }
            }
        },
        seleccionarimage: function(e) {
            var $this = this;
            $this.file = e.target.files[0];
            var filePath = $(
                "#modaleditar" + $this.item.id + " #logo" + this.item.id
            ).val();
            var allowedExtensions = /(.jpg|.jpeg|.png)$/i;
            if (allowedExtensions.exec(filePath)) {
                $this.imagen = "Imagen";

                var userFile = $(
                    "#modaleditar" + $this.item.id + " #logo" + this.item.id
                );
                userFile.attr(
                    "src",
                    URL.createObjectURL(event.target.files[0])
                );
                var data = userFile.attr("src");
                $(
                    "#modaleditar" +
                        $this.item.id +
                        " #img_logo_editar" +
                        this.item.id
                ).attr("src", data);

                let fileName = $("#logo" + this.item.id)
                    .val()
                    .split("\\")
                    .pop();
                $("#logo" + this.item.id)
                    .next(".custom-file-label")
                    .addClass("selected")
                    .html(fileName);
            } else {
                $this.imagen = "Imagen";
                toastr.error(
                    "Extensión inválida, formatos admitidos (.jpg . jpeg . png)",
                    "Error"
                );
                $("#img_logo_editar" + this.item.id).attr(
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
            $(
                "#modaleditar" +
                    this.item.id +
                    " #img_logo_editar" +
                    this.item.id
            ).attr("src", window.location.origin + "/images/mesadefault.jpg");
            var fileName = "Seleccionar";
            $("#modaleditar" + this.item.id + "  .custom-file-label")
                .addClass("selected")
                .html(fileName);
            $("#modaleditar" + this.item.id + "  #logo" + this.item.id).val("");
        },
        eliminar: function() {
            var $this = this;
            Swal.fire({
                title: "Opción Eliminar dime",
                text: "¿Seguro que desea guardar cambios?",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#1ab394",
                confirmButtonText: "Si, Confirmar",
                cancelButtonText: "No, Cancelar"
            }).then(result => {
                if (result.isConfirmed) {
                    axios
                        .get(window.location.origin + "/Mesa/eliminar", {
                            params: {
                                id: $this.item.id
                            }
                        })
                        .then(result => {
                            $this.$emit("cambio");
                            console.log(result);
                        })
                        .catch(value => {});
                }
            });
        }
    }
};
</script>

<style></style>
