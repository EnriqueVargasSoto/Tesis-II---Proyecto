const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
        confirmButton: "btn btn-success",
        cancelButton: "btn btn-danger",
    },
    buttonsStyling: false,
});
$(".dataTables-Unidad").DataTable({
    bPaginate: true,
    bLengthChange: true,
    bFilter: true,
    bInfo: true,
    bAutoWidth: false,
    processing: true,
    ajax: route("Unidad.getTable"),
    columns: [
        {
            data: "id",
            className: "text-center",
        },
        {
            data: "nombre",
            className: "text-center",
        },
        {
            data: "simbolo",
            className: "text-center",
        },
        {
            data: null,
            className: "text-center",
            render: function (data) {
                return (
                    "<div class='btn-group' ><button data-toggle='dropdown' class='btn btn-primary btn-sm  dropdown-toggle'><i class='fa fa-bars'></i></button><ul class='dropdown-menu'>" +
                    "<li><a class='dropdown-item' data-id='"+data.id+"' data-nombre='"+data.nombre+"' data-simbolo='"+data.simbolo+"'  onclick='editar(this)' title='Modificar' ><b><i class='fa fa-edit'></i>Editar</a></b></li>" +

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
function editar(e)
{
   $("#modal_edit #nombre").val($(e).data('nombre'))
   $("#modal_edit #simbolo").val($(e).data('simbolo'))
   $("#modal_edit #frm_editar_Unidad").attr('action',route('Unidad.editar',$(e).data('id')))
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
         $(location).attr("href",  route("Unidad.eliminar", id));
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire(
                "Cancelado",
                "La Solicitud se ha cancelado.",
                "error"
            );
        }
    });
}
$("#btn_añadir_Unidad").on("click", function (e) {
    // window.location.href = route("Clientes.crear");
    $("#modal_create").modal("show")
});
$("#modal_create #guardar").on('click',function (e) {
    var nombre=$("#modal_create #nombre").val();
    var simbolo=$("#modal_create #simbolo").val();
    if(nombre.length==0 || simbolo.length==0)
    {
         toastr.error("Complete los datos","Error")
    }
    else{
        $("#frm_registrar_Unidad").submit()
    }

})
$("#modal_edit #editar").on('click',function (e) {
    var nombre=$("#modal_edit #nombre").val();
    var simbolo=$("#modal_edit #simbolo").val();
    if(nombre.length==0||simbolo.length==0)
    {
         toastr.error("Complete los datos","Error")
    }
    else{
        $("#frm_editar_Unidad").submit()
    }

})
