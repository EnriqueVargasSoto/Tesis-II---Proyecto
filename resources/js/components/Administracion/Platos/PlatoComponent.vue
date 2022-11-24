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
    </div>
</template>

<script>
export default {
    props: ["item"],
    data() {
        return {};
    },
    created() {
        this.iniciourl = window.location.origin;
    },
    methods: {
        abrir: function() {
            var $this = this;
            $("#dataTables-insumo_editar").css("width", "100%");
            $("#nombre_editar").val($this.item.nombre);
            $("#precio_editar").val($this.item.precio);
            $("#id_editar").val($this.item.id);
            $("#logo_editar")
                .next(".custom-file-label")
                .addClass("selected")
                .html($this.item.nombre_imagen);
            $(".logo_editar").attr(
                "src",
                $this.iniciourl +
                    "/" +
                    $this.item.url_imagen.replace("public", "storage")
            );
            axios
                .get(route("Plato.detalle"), {
                    params: {
                        id: $this.item.id
                    }
                })
                .then(result => {
                    var table = $("#dataTables-insumo_editar").DataTable();
                    table.clear().draw();
                    result.data.forEach((value, index, array) => {
                        table.row
                            .add([
                                value.id,
                                value.nombre,
                                value.cantidad,
                                value.unidad,
                            ])
                            .draw(false);
                    });
                })
                .catch(value => {});
            $this.$emit("reset");
            $("#modalEditar").modal("show");
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
                        .get(route("Plato.eliminar"), {
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
        }
    }
};
</script>

<style></style>
