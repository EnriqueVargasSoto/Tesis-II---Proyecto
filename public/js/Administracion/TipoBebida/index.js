const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
        confirmButton: "btn btn-success",
        cancelButton: "btn btn-danger",
    },
    buttonsStyling: false,
});
var imagen = false;
$(".dataTables-tipoBebida").DataTable({
    bPaginate: true,
    bLengthChange: true,
    bFilter: true,
    bInfo: true,
    bAutoWidth: false,
    processing: true,
    ajax: route("TipoBebida.getTable"),
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
            data: null,
            className: "text-center",
            render: function (data) {
                return (
                    "<div class='btn-group' ><button data-toggle='dropdown' class='btn btn-primary btn-sm  dropdown-toggle'><i class='fa fa-bars'></i></button><ul class='dropdown-menu'>" +
                    "<li><a class='dropdown-item editar_link' data-id='" + data.id + "' data-tipo='" + data.tipo + "'  title='Modificar' ><b><i class='fa fa-edit'></i>Editar</a></b></li>" +
                    "<li><a class='dropdown-item' data-id='" + data.id + "' onclick='bebidas(this)' title='Modificar' ><b><i class='fa fa-align-justify'></i>Bebidas</a></b></li>" +
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
function bebidas(e) {
    window.location.href = route('TipoBebida.bebidas', $(e).data('id'))
}
$(document).on('click', '.editar_link', function (e) {
    var table = $(".dataTables-tipoBebida").DataTable();
    var d = table.row($(this).closest('tr')).data();
    $("#modal_edit #tipo").val(d.tipo);
    $("#modal_edit #frm_editar_tipoBebida").attr(
        "action",
        route("TipoBebida.editar", d.id)
    );
    imagen = true;
    $("#modal_edit").modal("show");
    $("#logo_img_editar").attr('src', window.location.origin + "/" + d.url_imagen.replace("public", "storage"))
    $("#logo_txt_editar").html(d.nombre_imagen)
})
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
            $(location).attr("href", route("TipoBebida.eliminar", id));
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire(
                "Cancelado",
                "La Solicitud se ha cancelado.",
                "error"
            );
        }
    });
}
$("#btn_añadir_tipoBebida").on("click", function (e) {
    // window.location.href = route("Clientes.crear");
    imagen = false;
    $("#modal_create").modal("show")
});
$("#modal_create #guardar").on('click', function (e) {
    var tipo = $("#modal_create #tipo").val();
    if (tipo.length == 0) {
        toastr.error("Complete los datos", "Error")
    }
    else {
        $("#frm_registrar_tipoBebida").submit()
    }

})
$("#modal_edit #editar").on('click', function (e) {
    var tipo = $("#modal_edit #tipo").val();
    if (tipo.length == 0) {
        toastr.error("Complete los datos", "Error")
    }
    else {
        $("#frm_editar_tipoBebida").submit()
    }

})
$("#modal_edit #logo_editar").on("change", function (e) {
    var filePath = $("#modal_edit #logo_editar").val();
    var allowedExtensions = /(.jpg|.jpeg|.png)$/i;
    if (allowedExtensions.exec(filePath)) {
        imagen = true;
        var userFile = $("#modal_edit #logo_editar");
        userFile.attr(
            "src",
            URL.createObjectURL(event.target.files[0])
        );
        var data = userFile.attr("src");
        $("#modal_edit #logo_img_editar").attr("src", data);

        let fileName = $("#logo_editar")
            .val()
            .split("\\")
            .pop();
        $("#logo_txt_editar")
            .html(fileName);
    } else {
        imagen = false;
        toastr.error(
            "Extensión inválida, formatos admitidos (.jpg . jpeg . png)",
            "Error"
        );
        $("#logo_img_editar").attr(
            "src",
            window.location.origin + "/images/mesadefault.jpg"
        );
    }
})
$("#modal_create #logo_create").on("change", function (e) {
    var filePath = $("#modal_create #logo_create").val();
    var allowedExtensions = /(.jpg|.jpeg|.png)$/i;
    if (allowedExtensions.exec(filePath)) {
        imagen = true;
        var userFile = $("#modal_create #logo_create");
        userFile.attr(
            "src",
            URL.createObjectURL(event.target.files[0])
        );
        var data = userFile.attr("src");
        $("#modal_create #logo_img_create").attr("src", data);

        let fileName = $("#logo_create")
            .val()
            .split("\\")
            .pop();
        $("#logo_txt_create")
            .html(fileName);
    } else {
        imagen = false;
        toastr.error(
            "Extensión inválida, formatos admitidos (.jpg . jpeg . png)",
            "Error"
        );
        $("#logo_img_create").attr(
            "src",
            window.location.origin + "/images/mesadefault.jpg"
        );
    }
})
