const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
        confirmButton: "btn btn-success",
        cancelButton: "btn btn-danger"
    },
    buttonsStyling: false
});
$(".dataTables-cliente").DataTable({
    bPaginate: true,
    bLengthChange: true,
    bFilter: true,
    bInfo: true,
    bAutoWidth: false,
    processing: true,
    ajax: route("Clientes.getTable"),
    columns: [
        {
            data: "nombre",
            className: "text-center"
        },
        {
            data: "tipo_documento",
            className: "text-left"
        },
        {
            data: "documento",
            className: "text-left"
        },
        {
            data: "email",
            className: "text-center"
        },
        {
            data: "telefono",
            className: "text-center"
        },
        {
            data: "direccion",
            className: "text-center"
        },
        {
            data: null,
            className: "text-center",
            render: function(data) {
                return (
                    "<div class='btn-group' ><button data-toggle='dropdown' class='btn btn-primary btn-sm  dropdown-toggle'><i class='fa fa-bars'></i></button><ul class='dropdown-menu'>" +
                    "<li><a class='dropdown-item' href='" +
                    route("Clientes.edit", data.id) +
                    "' title='Modificar' ><b><i class='fa fa-edit'></i>Editar</a></b></li>" +
                    "<li><a class='dropdown-item' onclick='eliminar(" +
                    data.id +
                    ")' " +
                    " title='Modificar' ><b><i class='fa fa-trash'></i>Eliminar</a></b></li>" +
                    "</ul></div>"
                );
            }
        }
    ],
    language: {
        url: window.location.origin + "/Spanish.json"
    },
    order: []
});

function eliminar(id) {
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
            $(location).attr("href", route("Clientes.eliminar", id));
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire(
                "Cancelado",
                "La Solicitud se ha cancelado.",
                "error"
            );
        }
    });
}
$("#btn_añadir_cliente").on("click", function(e) {
    window.location.href = route("Clientes.crear");
});
