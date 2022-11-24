<template>
    <div>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10 col-md-10">
                <h2 style="text-transform:uppercase">
                    <b>Datos Empresa</b>
                </h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a>Inicio</a>
                    </li>
                    <li class="breadcrumb-item active">
                        <strong>Empresa</strong>
                    </li>
                </ol>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6 mt-1">
                                        <label for="">Ruc:</label>
                                        <input
                                            type="text"
                                            name="ruc"
                                            id="ruc"
                                            v-model="empresa.ruc"
                                            class="form-control"
                                        />
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Telefono</label>
                                        <input
                                            type="text"
                                            name="telefono"
                                            id="telefono"
                                            v-model="empresa.telefono"
                                            class="form-control"
                                        />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mt-1">
                                        <label for="">Razon Social:</label>
                                        <input
                                            type="text"
                                            name="razon_social"
                                            id="razon_social"
                                            v-model="empresa.razon_social"
                                            class="form-control"
                                        />
                                    </div>
                                    <div class="col-md-12 mt-1">
                                        <label for="">Nombre Comercial:</label>
                                        <input
                                            type="text"
                                            name="nombre_comercial"
                                            id="nombre_comercial"
                                            v-model="empresa.nombre_comercial"
                                            class="form-control"
                                        />
                                    </div>
                                    <div class="col-md-12 mt-1">
                                        <label for="">Direccion:</label>
                                        <input
                                            type="text"
                                            name="dirrecion"
                                            id="direccion"
                                            v-model="empresa.direccion"
                                            class="form-control"
                                        />
                                    </div>
                                    <div class="col-md-12 mt-1">
                                        <label for="">Direccion Fiscal:</label>
                                        <input
                                            type="text"
                                            name="dirrecion_fiscal"
                                            id="dirrecion_fiscal"
                                            v-model="empresa.direccion_fiscal"
                                            class="form-control"
                                        />
                                    </div>
                                    <div class="col-md-12 mt-1">
                                        <label for="">Correo:</label>
                                        <input
                                            type="text"
                                            name="dirrecion_fiscal"
                                            id="dirrecion_fiscal"
                                            v-model="empresa.correo"
                                            class="form-control"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <label id="logo_label"
                                                    >Logo:</label
                                                >
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
                                        <div class="row mt-3">
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
                                        <label for="">Token Sunat</label>
                                        <textarea
                                            name="token_sunat"
                                            id="token_sunat"
                                            cols="30"
                                            rows="2"
                                            class="form-control"
                                            v-model="empresa.token_sunat"
                                        ></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <button
                                    class="float-right btn btn-primary"
                                    @click="registrar"
                                >
                                    <i
                                        class="fa fa-check"
                                        aria-hidden="true"
                                    ></i>
                                    ACEPTAR
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
    data() {
        return {
            empresa: {
                ruc: "",
                razon_social: "",
                nombre_comercial: "",
                direccion: "",
                direccion_fiscal: "",
                nombre_imagen: "",
                url_imagen: "",
                correo: "",
                telefono: "",
                file: "",
                token_sunat:""
            }
        };
    },
    mounted() {
        $(".logo").attr("src", window.location.origin + "/default.png");
        this.datos();
    },
    methods: {
        seleccionarimage: function(e) {
            var $this = this;
            $this.empresa.file = e.target.files[0];
            var filePath = $(".custom-file #logo").val();
            var allowedExtensions = /(.jpg|.jpeg|.png)$/i;
            if (allowedExtensions.exec(filePath)) {
                var userFile = $(".custom-file #logo");
                userFile.attr("src", URL.createObjectURL(e.target.files[0]));
                var data = userFile.attr("src");
                $(".logo").attr("src", data);

                let fileName = $(".custom-file #logo")
                    .val()
                    .split("\\")
                    .pop();
                $(".custom-file #logo")
                    .next(".custom-file-label")
                    .addClass("selected")
                    .html(fileName);
            } else {
                toastr.error(
                    "Extensión inválida, formatos admitidos (.jpg . jpeg . png)",
                    "Error"
                );
                $(".logo").attr("src", window.location.origin + "/default.png");
            }
        },
        limpiar: function() {},
        registrar: function() {
            var $this = this;
            const config = {
                headers: {
                    "content-type": "multipart/forma-data"
                }
            };
            var data = new FormData();
            data.append("ruc", $this.empresa.ruc);
            data.append("razon_social", $this.empresa.razon_social);
            data.append("nombre_comercial", $this.empresa.nombre_comercial);
            data.append("direccion", $this.empresa.direccion);
            data.append("direccion_fiscal", $this.empresa.direccion_fiscal);
            data.append("correo", $this.empresa.correo);
            data.append("telefono", $this.empresa.telefono);
            data.append("file", $this.empresa.file);
            data.append("token_sunat",$this.empresa.token_sunat)
            console.log(data);
            axios
                .post(route("EmpresaPersonal.store"), data, config)
                .then(value => {
                    toastr.success("Exito");
                })
                .catch(value => {});
        },
        datos: function() {
            var $this = this;
            axios
                .get(route("EmpresaPersonal.empresaPersonal"))
                .then(value => {
                    var datos = value.data;
                    if (typeof datos === "object") {
                        $this.empresa.ruc = datos.ruc == null ? "" : datos.ruc;
                        $this.empresa.razon_social =
                            datos.razon_social == null
                                ? ""
                                : datos.razon_social;
                        $this.empresa.nombre_comercial =
                            datos.nombre_comercial == null
                                ? ""
                                : datos.nombre_comercial;
                        $this.empresa.direccion =
                            datos.direccion == null ? "" : datos.direccion;
                        $this.empresa.direccion_fiscal =
                            datos.direccion_fiscal == null
                                ? ""
                                : datos.direccion_fiscal;
                        $this.empresa.nombre_imagen =
                            datos.nombre_imagen == null
                                ? ""
                                : datos.nombre_imagen;
                        $this.empresa.url_imagen =
                            datos.url_imagen == null ? "" : datos.url_imagen;
                        $this.empresa.telefono =
                            datos.telefono == null ? "" : datos.telefono;
                        $this.empresa.correo =
                            datos.correo == null ? "" : datos.correo;
                        $this.empresa.token_sunat=datos.token_sunat==null?"":datos.token_sunat;
                        //$this.empresa=datos;

                        if (datos.nombre_imagen != "") {
                            $("#logo_txt").html(datos.nombre_imagen);
                            $(".logo").attr(
                                "src",
                                window.location.origin +
                                    "/" +
                                    datos.url_imagen.replace(
                                        "public",
                                        "storage"
                                    )
                            );
                        }
                    }
                })
                .catch(value => {});
        }
    }
};
</script>

<style></style>
