<template>
    <div>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10 col-md-10">
                <h2 style="text-transform:uppercase">
                    <b>Documento de Ventas</b>
                </h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a>Inicio</a>
                    </li>
                    <li class="breadcrumb-item active">
                        <strong>Documento de Ventas</strong>
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
                                <div class="col-md-12">
                                    <table
                                        id="tableDocumentoVenta"
                                        class="table table-striped table-bordered table-hover"
                                        style="width: 100%"
                                    >
                                        <thead>
                                            <tr>
                                                <th>Fecha</th>
                                                <th>Cliente</th>
                                                <th>Tarj/Efec</th>
                                                <th>Serie</th>
                                                <th>Mesa</th>
                                                <th>Total</th>
                                                <th>Sunat</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div
            class="modal fade"
            id="modalBoleta"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Nuevo Cliente - Documento Boleta
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="">Clientes</label>
                                <select
                                    name="cliente"
                                    id="cliente"
                                    class="form-control"
                                    v-model="cliente"
                                    @change="cambioCliente($event)"
                                >
                                    <option
                                        v-for="item in clientes"
                                        :key="item.id"
                                        :value="item"
                                    >
                                        {{ item.nombre }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="">Nombre</label>
                                <input
                                    type="text"
                                    name="nombre"
                                    id="nombre"
                                    class="form-control"
                                    v-model="boleta.cliente.nombre"
                                />
                            </div>
                            <div class="form-group col-md-12">
                                <label for="">Documento</label>
                                <input
                                    type="text"
                                    name="documento"
                                    id="documento"
                                    maxlength="8"
                                    class="form-control"
                                    v-model="boleta.cliente.documento"
                                />
                            </div>
                            <div class="form-group col-md-12">
                                <label for="">Direccion</label>
                                <input
                                    type="text"
                                    name="direccion"
                                    id="direccion"
                                    class="form-control"
                                    v-model="boleta.cliente.direccion"
                                />
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
                        <button
                            type="button"
                            @click="boletaStore"
                            class="btn btn-primary"
                        >
                            Guardar
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div
            class="modal fade"
            id="modalFactura"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Nuevo Cliente - Documento Factura
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="">Clientes</label>
                                <select
                                    name="cliente"
                                    id="cliente"
                                    class="form-control"
                                    v-model="clienteruc"
                                    @change="cambioClienteRuc($event)"
                                >
                                    <option
                                        v-for="item in clientesruc"
                                        :key="item.id"
                                        :value="item"
                                    >
                                        {{ item.nombre }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="">Nombre</label>
                                <input
                                    type="text"
                                    name="nombre"
                                    id="nombre"
                                    class="form-control"
                                    v-model="factura.cliente.nombre"
                                />
                            </div>
                            <div class="form-group col-md-12">
                                <label for="">Documento</label>
                                <input
                                    type="text"
                                    name="documento"
                                    id="documento"
                                    maxlength="11"
                                    class="form-control"
                                    v-model="factura.cliente.documento"
                                />
                            </div>
                            <div class="form-group col-md-12">
                                <label for="">Direccion</label>
                                <input
                                    type="text"
                                    name="direccion"
                                    id="direccion"
                                    class="form-control"
                                    v-model="factura.cliente.direccion"
                                />
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
                        <button
                            type="button"
                            @click="facturaStore"
                            class="btn btn-primary"
                        >
                            Guardar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import "sweetalert2/dist/sweetalert2.min.css";
import "datatables.net-bs4";
import "datatables.net-buttons-bs4";
export default {
    props: ["error", "clientes", "csrf", "clientesruc"],
    data() {
        return {
            table: null,
            cliente: null,
            clienteruc: null,
            boleta: {
                cliente: {
                    nombre: "",
                    documento: "",
                    direccion: ""
                }
            },
            factura: {
                cliente: {
                    nombre: "",
                    documento: "",
                    direccion: ""
                }
            },
            documento_id: null
        };
    },
    mounted() {
        let $this = this;
        this.inicializacion();
        if (this.error != null) {
            this.$swal.fire({
                icon: "error",
                title: "Oops...",
                text: this.error
            });
        }
        $(document).on("click", ".btn-sunat", function(e) {
            let data = $this.table.row($(this).closest("tr")).data();
            $this.$swal
                .fire({
                    title: "¡Enviar a Sunat!",
                    type: "info",
                    showCancelButton: true,
                    confirmButtonText: "Aceptar",
                    showLoaderOnConfirm: true,
                    preConfirm: login => {
                        return fetch(route("documentoVenta.sunat", data.id), {
                            headers: {
                                Accept: "application/json",
                                "Content-Type": "application/json"
                            },
                            method: "POST",
                            body: JSON.stringify({
                                _token: $this.csrf
                            })
                        })
                            .then(response => {
                                return response.json();
                            })
                            .catch(error => {
                                Swal.showValidationMessage(
                                    `Request failed: ${error}`
                                );
                            });
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                })
                .then(result => {
                    if (result.value.success) {
                        Swal.fire({
                            icon: "success",
                            title: "Registro con Exito",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $this.table.ajax.reload();
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Ocurrio un error"
                        });
                    }
                });
        });
        $(document).on("click", ".btn-factura", function(e) {
            let data = $this.table.row($(this).closest("tr")).data();
            $this.documento_id = data.id;
            $this.factura.cliente.nombre = "";
            $this.factura.cliente.documento = "";
            $this.factura.cliente.direccion = "";
            $this.clienteruc = null;
            $("#modalFactura").modal("show");
        });
        $(document).on("click", ".btn-boleta", function(e) {
            let data = $this.table.row($(this).closest("tr")).data();
            $this.documento_id = data.id;
            $this.$swal
                .fire({
                    title: "Crear Nueva Boleta",
                    text: "Tu deseas utilizar la opcion de varios clientes?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Si, utilizar varios clientes",
                    cancelButtonText: "No, Registrar nuevo Cliente"
                })
                .then(result => {
                    if (result.isConfirmed) {
                        // window.location.href = route(
                        //     "documentoVenta.destroy",
                        //     $this.table.row($(this).closest("tr")).data().id
                        // );
                    } else {
                        $this.boleta.cliente.nombre = "";
                        $this.boleta.cliente.documento = "";
                        $this.boleta.cliente.direccion = "";
                        $this.cliente = null;
                        $("#modalBoleta").modal("show");
                        $this.$swal.close();
                    }
                });
        });
    },
    methods: {
        inicializacion: function() {
            this.table = $("#tableDocumentoVenta").DataTable({
                bPaginate: true,
                bLengthChange: true,
                bFilter: true,
                bInfo: true,
                bAutoWidth: false,
                processing: true,
                ajax: route("documentoVenta.getTable"),
                language: {
                    url: window.location.origin + "/Spanish.json"
                    // '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
                },
                columns: [
                    {
                        data: null,
                        className: "text-center",
                        render: function(data) {
                            let fecha = new Date(data.created_at);
                            return (
                                fecha.getFullYear() +
                                "-" +
                                (fecha.getMonth() + 1) +
                                "-" +
                                fecha.getDate() +
                                " " +
                                fecha.getHours() +
                                ":" +
                                fecha.getMinutes()
                            );
                        }
                    },
                    {
                        data: null,
                        className: "text-center",
                        render: function(data) {
                            return data.cliente.nombre;
                        }
                    },
                    {
                        data: null,
                        className: "text-center",
                        render: function(data) {
                            return data.tarjeta + " / " + data.efectivo;
                        }
                    },
                    {
                        data: null,
                        className: "text-center",
                        render: function(data) {
                            return data.serie;
                        }
                    },
                    {
                        data: null,
                        className: "text-center",
                        render: function(data) {
                            return data.mesas;
                        }
                    },
                    {
                        data: null,
                        className: "text-center",
                        render: function(data) {
                            return data.total;
                        }
                    },
                    {
                        data: null,
                        className: "text-center",
                        render: function(data) {
                            if (data.estado_documento == "PENDIENTE") {
                                return (
                                    '<span class="badge badge-warning" d-block="">' +
                                    data.estado_documento +
                                    "</span>"
                                );
                            } else if (data.estado_documento == "ERROR") {
                                return (
                                    '<span class="badge badge-danger" d-block="">' +
                                    data.estado_documento +
                                    "</span>"
                                );
                            } else {
                                return (
                                    '<span class="badge badge-success" style="background-color: rgb(43, 170, 43)" d-block="">' +
                                    data.estado_documento +
                                    "</span>"
                                );
                            }
                        }
                    },
                    {
                        data: null,
                        className: "text-center",
                        width: "20%",
                        render: function(data) {
                            let opciones = "";
                            opciones +=
                                "<li><a class='dropdown-item btn-edit' href='" +
                                route("documentoVenta.ticket", data.id) +
                                "' title='Editar Documento'><b><i class='fa fa-file-pdf-o'></i> Ticket</a></b></li>";
                            if (data.estado_documento == "PENDIENTE") {
                                opciones +=
                                    "<li><a class='dropdown-item btn-factura' href='#' title='Registrar Factura'><b><i class='fa fa-list'></i>Factura</a></b></li>";
                                opciones +=
                                    "<li><a class='dropdown-item btn-boleta' href='#' title='Registrar Boleta'><b><i class='fa fa-list'></i>Boleta</a></b></li>";
                            } else if (
                                data.estado_documento == "ERROR" ||
                                data.estado_documento == "REGISTRADO"
                            ) {
                                opciones +=
                                    "<li><a class='dropdown-item btn-sunat' href='#' title='Enviar Sunat'><b><i class='fa fa-send'></i>Sunat</a></b></li>";
                            }

                            // opciones +=
                            //     "<li><a class='dropdown-item btn-delete'  title='Eliminar Documento'><b><i class='fa fa-trash'></i>Eliminar</i></a></b></li>";
                            return (
                                "<div class='btn-group' style='text-transform:capitalize;'><button data-toggle='dropdown' class='btn btn-primary  btn-sm  dropdown-toggle'><i class='fa fa-bars'></i></button><ul class='dropdown-menu'>" +
                                opciones +
                                "</ul></div>"
                            );
                        }
                    }
                ]
            });
        },
        cambioCliente: function(event) {
            this.boleta.cliente.nombre = this.cliente.nombre;
            this.boleta.cliente.documento = this.cliente.documento;
            this.boleta.cliente.direccion = this.cliente.direccion;
        },
        cambioClienteRuc: function(event) {
            this.factura.cliente.nombre = this.clienteruc.nombre;
            this.factura.cliente.documento = this.clienteruc.documento;
            this.factura.cliente.direccion = this.clienteruc.direccion;
        },
        boletaStore: function() {
            let $this = this;
            if (
                this.boleta.cliente.nombre == 0 ||
                this.boleta.cliente.documento.length == 0 ||
                this.boleta.cliente.direccion.length == 0
            ) {
                toastr.error("Falta Ingresar datos", "Error");
                return;
            }
            if (this.boleta.cliente.documento.length != 8) {
                toastr.error("Numero de Documento Incorrecto");
                return;
            }
            $("#modalBoleta").modal("hide");
            $this.$swal
                .fire({
                    title: "¡Registrar Documento!",
                    type: "info",
                    showCancelButton: true,
                    confirmButtonText: "Aceptar",
                    showLoaderOnConfirm: true,
                    preConfirm: login => {
                        return fetch(route("documentoVenta.boletaStore"), {
                            headers: {
                                Accept: "application/json",
                                "Content-Type": "application/json"
                            },
                            method: "POST",
                            body: JSON.stringify({
                                documento_id: $this.documento_id,
                                nombre: $this.boleta.cliente.nombre,
                                documento: $this.boleta.cliente.documento,
                                direccion: $this.boleta.cliente.direccion,
                                _token: $this.csrf
                            })
                        })
                            .then(response => {
                                return response.json();
                            })
                            .catch(error => {
                                Swal.showValidationMessage(
                                    `Request failed: ${error}`
                                );
                            });
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                })
                .then(result => {
                    if (result.value.success) {
                        Swal.fire({
                            icon: "success",
                            title: "Registro con Exito",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $this.table.ajax.reload();
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Ocurrio un error"
                        });
                    }
                });
        },
        facturaStore: function() {
            let $this = this;
            if (
                this.factura.cliente.nombre.length == 0 ||
                this.factura.cliente.documento.length == 0 ||
                this.factura.cliente.direccion.length == 0
            ) {
                toastr.error("Falta Ingresar datos", "Error");
                return;
            }
            if (this.factura.cliente.documento.length != 11) {
                toastr.error("Numero de Documento Incorrecto");
                return;
            }
            $("#modalFactura").modal("hide");
            $this.$swal
                .fire({
                    title: "¡Registrar Documento!",
                    type: "info",
                    showCancelButton: true,
                    confirmButtonText: "Aceptar",
                    showLoaderOnConfirm: true,
                    preConfirm: login => {
                        return fetch(route("documentoVenta.facturaStore"), {
                            headers: {
                                Accept: "application/json",
                                "Content-Type": "application/json"
                            },
                            method: "POST",
                            body: JSON.stringify({
                                documento_id: $this.documento_id,
                                nombre: $this.factura.cliente.nombre,
                                documento: $this.factura.cliente.documento,
                                direccion: $this.factura.cliente.direccion,
                                _token: $this.csrf
                            })
                        })
                            .then(response => {
                                return response.json();
                            })
                            .catch(error => {
                                Swal.showValidationMessage(
                                    `Request failed: ${error}`
                                );
                            });
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                })
                .then(result => {
                    if (result.value.success) {
                        Swal.fire({
                            icon: "success",
                            title: "Registro con Exito",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $this.table.ajax.reload();
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Ocurrio un error"
                        });
                    }
                });
        }
    }
};
</script>

<style></style>
