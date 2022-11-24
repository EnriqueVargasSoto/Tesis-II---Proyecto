<div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Editar Tipo Mesa</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frm_editar_tipoMesa" method="POST">
                    @method('PUT')
                    @csrf
                    <label for="" class="required">Tipo Mesa:</label>
                    <input type="text" name="tipo" id="tipo" class="form-control" placeholder="Tipo">
                    <label for="" class="required">N personas</label>
                    <input type="number" name="npersonas" id="npersonas" class="form-control" placeholder="0">
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="editar">Editar</button>
            </div>
        </div>
    </div>
</div>
