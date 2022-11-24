$("#form_editar_empleado").steps({
    bodyTag: "fieldset",
    transitionEffect: "fade",
    labels: {
        current: "actual paso:",
        pagination: "Paginación",
        finish: "Finalizar",
        next: "Siguiente",
        previous: "Anterior",
        loading: "Cargando ..."
    },
    onStepChanging: function(event, currentIndex, newIndex) {
        if (currentIndex > newIndex) {
            return true;
        }
        var form = $(this);
        if (currentIndex < newIndex) {

            $(".body:eq(" + newIndex + ") label.error", form).remove();
            $(".body:eq(" + newIndex + ") .error", form).removeClass("error");
        }
        return true;
    },
    onStepChanged: function(event, currentIndex, priorIndex) {

    },
    onFinishing: function(event, currentIndex) {
        var form = $(this);
        return true;
    },
    onFinished: function(event, currentIndex) {
        var form = $(this);
        form.submit();
    }
});
