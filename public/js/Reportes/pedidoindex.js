var table = $(".dataTables-ReportePedido").DataTable({
    // "ajax": "{{ asset('api/datatables.json') }}",
    dom:
        "<'row dtcustom'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp",
    lengthMenu: [
        [10, 25, 50, -1],
        [10, 25, 50, "All"]
    ],
    buttons: [
        {
            extend: "copy",
            className: "btn-sm"
        },
        {
            extend: "csv",
            title: "ExampleFile",
            className: "btn-sm"
        },
        {
            extend: "pdf",
            title: "ExampleFile",
            className: "btn-sm"
        },
        {
            extend: "print",
            className: "btn-sm"
        }
    ],
    columnDefs: [
        {
            targets: 0,
            className: "text-center"
        },
        {
            targets: 1,
            className: "text-center"
        },
        {
            targets: 2,
            className: "text-center"
        },
        {
            targets: 3,
            className: "text-center"
        },
        {
            targets: 4,
            className: "text-center"
        },
        {
            targets: 5,
            className: "text-center",
            render: function(data, type, row, meta) {
                var id = row[0];
                return (
                    "<div class='btn-group'>" +
                    "<a href='javascript:void(0)' class='btn btn-danger btn-sm btn-pdf' style='color:white'><i class='fa fa-file-pdf-o'></i> Pdf</a>" +
                    "</div>"
                );
            }
        }
    ],
    language: {
        url: window.location.origin + "/Spanish.json"
    }
});
$(document).on("click", ".btn-pdf", function() {
    let datos = table.row($(this).closest("tr")).data();
    var win = window.open(route("Reporte.pedidoget.pdf", datos[0]), "_blank");
    win.focus();
    if (ver) {
        let tiempo = (new Date().getTime() - tiempoInicial.getTime()) / 1000;
        swal.fire({
            icon: "success",
            title: "El tiempo del Proceso",
            text: "Tiempo en segundos es: " + tiempo
        });
        ver=false;
    }
});
