const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
        confirmButton: "btn btn-success",
        cancelButton: "btn btn-danger",
    },
    buttonsStyling: false,
});
$(".dataTables-Deposito").DataTable({
    bPaginate: true,
    bLengthChange: true,
    bFilter: true,
    bInfo: true,
    bAutoWidth: false,
    processing: true,
    ajax: route("Deposito.getTable"),
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
            data: null,
            className: "text-center",
            render: function (data) {
                return (
                    "<div class='btn-group' ><button data-toggle='dropdown' class='btn btn-primary btn-sm  dropdown-toggle'><i class='fa fa-bars'></i></button><ul class='dropdown-menu'>" +
                    "<li><a class='dropdown-item' data-id='"+data.id+"' data-nombre='"+data.nombre+"' data-descripcion='"+data.descripcion+"'  onclick='editar(this)' title='Modificar' ><b><i class='fa fa-edit'></i>Editar</a></b></li>" +
                    "<li><a class='dropdown-item' onclick='eliminar("+data.id +")' title='Modificar' ><b><i class='fa fa-trash'></i>Eliminar</a></b></li>" +
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
function platos(e)
{
    window.location.href=route('Deposito.platos',$(e).data('id'))
}
function editar(e)
{
   $("#modal_edit #nombre").val($(e).data('nombre'))
   $("#modal_edit #descripcion").html($(e).data('descripcion'))
   $("#modal_edit #frm_editar_Deposito").attr('action',route('Deposito.editar',$(e).data('id')))
    $("#modal_edit").modal("show")
}
function eliminar(id) {
    Swal.fire({
        title: "Opción Eliminar",
        text: "¿Seguro que desea guardar cambios?",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#1ab394",
        confirmButtonText: "Si, Confirmar",
        cancelButtonText: "No, Cancelar",
    }).then((result) => {
        if (result.isConfirmed) {
         $(location).attr("href",  route("Deposito.eliminar", id));
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire(
                "Cancelado",
                "La Solicitud se ha cancelado.",
                "error"
            );
        }
    });
}
$("#btn_añadir_Deposito").on("click", function (e) {
    // window.location.href = route("Clientes.crear");
    $("#modal_create").modal("show")
});
$("#modal_create #guardar").on('click',function (e) {
    var nombre=$("#modal_create #nombre").val();
    var descripcion=$("#modal_create #descripcion").val();
    if(nombre.length==0||descripcion.length==0)
    {
         toastr.error("Complete los datos","Error")
    }
    else{
        $("#frm_registrar_Deposito").submit()
    }

})
$("#modal_edit #editar").on('click',function (e) {
    var nombre=$("#modal_edit #nombre").val();
    var descripcion=$("#modal_edit #descripcion").val();
    if(nombre.length==0 || descripcion.length==0)
    {
         toastr.error("Complete los datos","Error")
    }
    else{
        $("#frm_editar_Deposito").submit()
    }

})
