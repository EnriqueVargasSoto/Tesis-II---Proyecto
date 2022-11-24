<div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Crear Tipo Empleado</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frm_editar_tipoEmpleado" method="POST">
                    @method('PUT')
                    @csrf
                    <label for="" class="required">Tipo Empleado:</label>
                    <input type="text" name="tipo" id="tipo" class="form-control" placeholder="Tipo">
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="editar">Editar</button>
            </div>
        </div>
    </div>
</div>
