<div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Editar Unidad</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frm_editar_Unidad" method="POST">
                    @method('PUT')
                    @csrf
                    <label for="" class="required">Unidad:</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Kilogramo">
                    <label for="" class="required">Simbolo:</label>
                    <input type="text" name="simbolo" id="simbolo" class="form-control" placeholder="Kg">
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="editar">Editar</button>
            </div>
        </div>
    </div>
</div>
