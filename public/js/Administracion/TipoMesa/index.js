const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
        confirmButton: "btn btn-success",
        cancelButton: "btn btn-danger",
    },
    buttonsStyling: false,
});
$(".dataTables-tipoMesa").DataTable({
    bPaginate: true,
    bLengthChange: true,
    bFilter: true,
    bInfo: true,
    bAutoWidth: false,
    processing: true,
    ajax: route("TipoMesa.getTable"),
    columns: [
        {
            data: "id",
            className: "text-center",
        },
        {
            data: "tipo",
            className: "text-center",
        },
        {
            data: "npersonas",
            className: "text-center",
        },
        {
            data: null,
            className: "text-center",
            render: function (data) {
                return (
                    "<div class='btn-group' ><button data-toggle='dropdown' class='btn btn-primary btn-sm  dropdown-toggle'><i class='fa fa-bars'></i></button><ul class='dropdown-menu'>" +
                    "<li><a class='dropdown-item' data-id='"+data.id+"' data-tipo='"+data.tipo+"' data-npersonas='"+data.npersonas+"' onclick='editar(this)' title='Modificar' ><b><i class='fa fa-edit'></i>Editar</a></b></li>" +
                    "<li><a class='dropdown-item' data-id='"+data.id+"' onclick='mesas(this)' title='Modificar' ><b><i class='fa fa-align-justify'></i>Mesas</a></b></li>" +
                    "<li><a class='dropdown-item' onclick='eliminar(" +
                    data.id +
                    ")' " +
                    " title='Modificar' ><b><i class='fa fa-trash'></i>Eliminar</a></b></li>" +
                    "</ul></div>"
                );
            },
        },
    ],
    language: {
        url: window.location.origin + "/Spanish.json",
    },
    order: [],
});
function mesas(e)
{
    window.location.href=route('TipoMesa.mesas',$(e).data('id'))
}
function editar(e)
{
   $("#modal_edit #tipo").val($(e).data('tipo'))
   $("#modal_edit #npersonas").val($(e).data('npersonas'))
   $("#modal_edit #frm_editar_tipoMesa").attr('action',route('TipoMesa.editar',$(e).data('id')))
    $("#modal_edit").modal("show")
}
function eliminar(id) {
    Swal.fire({
        title: "Opción Eliminar dime",
        text: "¿Seguro que desea guardar cambios?",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#1ab394",
        confirmButtonText: "Si, Confirmar",
        cancelButtonText: "No, Cancelar",
    }).then((result) => {
        if (result.isConfirmed) {
         $(location).attr("href",  route("TipoMesa.eliminar", id));
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire(
                "Cancelado",
                "La Solicitud se ha cancelado.",
                "error"
            );
        }
    });
}
$("#btn_añadir_tipoMesa").on("click", function (e) {
    // window.location.href = route("Clientes.crear");
    $("#modal_create").modal("show")
});
$("#modal_create #guardar").on('click',function (e) {
    var tipo=$("#modal_create #tipo").val();
    var npersonas=$("#modal_create #npersonas").val();
    if(tipo.length==0||npersonas.length==0)
    {
         toastr.error("Complete los datos","Error")
    }
    else{
        $("#frm_registrar_tipoMesa").submit()
    }

})
$("#modal_edit #editar").on('click',function (e) {
    var tipo=$("#modal_edit #tipo").val();
    if(tipo.length==0)
    {
         toastr.error("Complete los datos","Error")
    }
    else{
        $("#frm_editar_tipoMesa").submit()
    }

})
