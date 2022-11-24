$(".select2_form").select2({
    placeholder: "SELECCIONAR",
    allowClear: true,
    width: "100%"
});
$("#igv").on("click", function(e) {
    if ($(this).is(":checked")) {
        $("#cantidad_igv").val("18");
        $("#cantidad_igv").removeAttr("readonly");
    } else {
        $("#cantidad_igv").val("");
        $("#cantidad_igv").attr("readonly", true);
    }
    igv();
});
var table = $(".dataTables-orden-detalle").DataTable({
    bPaginate: true,
    bLengthChange: true,
    bFilter: true,
    bInfo: true,
    bAutoWidth: false,
    processing: true,
    language: {
        url: window.location.origin + "/Spanish.json"
    },
    columnDefs: [
        {
            targets: [0],
            visible: false,
            searchable: false
        },
        {
            targets: [1],
            className: "text-center",
            render: function(data) {
                return (
                    "<div class='btn-group'>" +
                    "<a class='btn btn-warning btn-sm' id='editar_articulo' style='color:white;' title='Modificar'><i class='fa fa-edit'></i></a>" +
                    "<a class='btn btn-danger btn-sm' id='borrar_articulo' style='color:white;' title='Eliminar'><i class='fa fa-trash'></i></a>" +
                    "</div>"
                );
            }
        }
    ],
    order: []
});
$("#insumo").change(function(e) {
    e.preventDefault();
    var precio = $(this)
        .find(":selected")
        .data("precio");
    $("#precio").val(parseFloat(precio));
});
$(".btn-agregar").click(function(e) {
    e.preventDefault();
    var precio = $("#precio").val();
    var cantidad = $("#cantidad").val();
    var id = $("#insumo")
        .find(":selected")
        .data("id");
    var nombre = $("#insumo")
        .find(":selected")
        .data("nombre");
    if (precio.length == 0 || cantidad.length == 0) {
        toastr.error("Falta Ingresar dato");
    } else {
        if (!verificarExistencia(id)) {
            table.row
                .add([id, "", nombre, precio, cantidad, precio * cantidad])
                .draw(false);
            agregarDatos();
        } else {
            toastr.error("Ya esta registrado", "Error");
        }
    }
});

function verificarExistencia(id) {
    var datos = table.rows().data();
    var encontrado = false;
    $.each(datos, function(index, value) {
        if (value[0] == id) {
            encontrado = true;
        }
    });
    return encontrado;
}

$(document).on("click", "#editar_articulo", function(event) {
    var data = table.row($(this).parents("tr")).data();
    $("#indice_modal").val(table.row($(this).parents("tr")).index());
    $("#id_modal").val(data[0]);
    $("#insumo_modal").val(data[2]);
    $("#precio_modal").val(data[3]);
    $("#cantidad_modal").val(data[4]);
    $("#modal_edit_insumo").modal("show");
});
$("#modal_edit_insumo #guardar_modal").click(function(e) {
    var i = $("#indice_modal").val();
    table
        .row(i)
        .remove()
        .draw();
    table.row
        .add([
            $("#id_modal").val(),
            "",
            $("#insumo_modal").val(),
            $("#precio_modal").val(),
            $("#cantidad_modal").val(),
            $("#precio_modal").val() * $("#cantidad_modal").val()
        ])
        .draw(false);
    agregarDatos();
    $("#modal_edit_insumo").modal("hide");
});
function agregarDatos() {
    var insumo = [];
    var datos = table.rows().data();
    $.each(datos, function(index, value) {
        let fila = {
            id: value[0],
            precio: value[3],
            cantidad: value[4]
        };
        insumo.push(fila);
    });
    $("#arreglo_insumo").val(JSON.stringify(insumo));
    subtotal();
}

$("#cantidad_igv").keyup(function(e) {
    igv();
});
function subtotal() {
    var datos = table.rows().data();
    var subtotal = 0;
    $.each(datos, function(index, value) {
        subtotal = subtotal + value[5];
    });
    $("#subtotal").html(subtotal);
    igv();
}
function igv() {
    if ($("#cantidad_igv").val() != "") {
        $("#igv_int").html($("#cantidad_igv").val() / 100 + "%");
        obtenerigv($("#cantidad_igv").val() / 100);
    } else {
        $("#igv_int").html("0.0 %");
        obtenerigv(0);
    }
}
function obtenerigv(igv) {
    var datos = table.rows().data();
    var subtotal = 0;
    $.each(datos, function(index, value) {
        subtotal = subtotal + value[5];
    });
    var igv_monto = subtotal * igv;
    $("#igv_monto").html(igv_monto == 0 ? "0.0" : igv_monto);
    total();
}
function total() {
    $("#total").html(
        parseFloat($("#igv_monto").html()) + parseFloat($("#subtotal").html())
    );
}
$("#guardar_store").click(function(e) {
    e.preventDefault();
    var proveedor = $("#Proveedor").val();
    var deposito = $("#Deposito").val();
    var fecha_emision = $("#fecha_emision").val();
    var fecha_entrega = $("#fecha_entrega").val();
    var arreglo = $("#arreglo_insumo").val();
    if (
        proveedor.length== 0 ||
        deposito.length == 0 ||
        fecha_emision.length == 0 ||
        fecha_entrega.length == 0 ||
        arreglo.length == 0 ||
        arreglo == "[]"
    ) {
        toastr.error("Fatal Ingresar Datos", "Error");
    } else {
        $("#frm_store").submit();
    }
});
$(".logo").on('click', function () {
    $("#modal_img").modal("show")
    $("#img_modal").attr("src", $(this).attr("src"))
});
function limpiar() {
    $('.logo').attr("src", window.location.origin+"/Images/docCompradefault.jpg")
    var fileName = "Seleccionar"
    $('.custom-file-label').addClass("selected").html(fileName);
    $('#logo').val('')
}
function seleccionarimagen()
{
    var fileInput = document.getElementById('logo');
    var filePath = fileInput.value;
    var allowedExtensions = /(.jpg|.jpeg|.png)$/i;
    $imagenPrevisualizacion = document.querySelector(".logo");
    if (allowedExtensions.exec(filePath)) {
        var userFile = document.getElementById('logo');
        userFile.src = URL.createObjectURL(event.target.files[0]);
        var data = userFile.src;
        $imagenPrevisualizacion.src = data
        let fileName =$('#logo').val().split('\\').pop();
        $('#logo').next('.custom-file-label').addClass("selected").html(fileName);
    } else {
        toastr.error('Extensión inválida, formatos admitidos (.jpg . jpeg . png)', 'Error');
        $('.logo').attr("src",window.location.origin+"/Images/docCompradefault.jpg")
    }
}
