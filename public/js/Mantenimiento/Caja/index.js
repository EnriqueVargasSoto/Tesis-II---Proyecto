const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
        confirmButton: "btn btn-success",
        cancelButton: "btn btn-danger"
    },
    buttonsStyling: false
});
$(".dataTables-Caja").DataTable({
    bPaginate: true,
    bLengthChange: true,
    bFilter: true,
    bInfo: true,
    bAutoWidth: false,
    processing: true,
    ajax: route("Caja.getTable"),
    columns: [
        {
            data: "id",
            className: "text-center"
        },
        {
            data: "nombre",
            className: "text-center"
        },
        {
            data: null,
            className: "text-center",
            render: function(data) {
                return (
                    "<button class='btn btn-eliminar btn-danger btn-sm' data-id='" +
                    data.id +
                    "'><i class='fa fa-trash' aria-hidden='true'></i></button>"
                );
            }
        }
    ],
    language: {
        url: window.location.origin + "/Spanish.json"
    },
    order: []
});
$("#btn_generate_Caja").click(function(e) {
    e.preventDefault();
    window.location.href = route("Caja.generar");
});
$(document).on("click", ".btn-eliminar", function() {
    window.location.href = route("Caja.eliminar", $(this).data("id"));
});
