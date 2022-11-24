<div class="modal inmodal" id="modal_edit_insumo" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Editar Insumo</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="indice_modal" id="indice_modal">
                <input type="hidden" name="id_modal" id="id_modal">
                <label for="">Insumo</label>
                <input type="text" name="insumo_modal" id="insumo_modal" class="form-control" placeholder="">
                <label for="">Precio</label>
                <input id="precio_modal" class="form-control" type="number" name="precio_modal">
                <label for="">Cantidad</label>
                <input id="cantidad_modal" class="form-control" type="number" name="cantidad_modal">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="guardar_modal">Editar</button>
            </div>
        </div>
    </div>
</div>
