<div class="modal fade" id="modal_create" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Crear Unidades</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('Unidad.store') }}" id="frm_registrar_Unidad" method="POST">
                    @csrf
                    <label for="" class="required">Unidad:</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Kilogramo">
                    <label for="" class="required">Simbolo:</label>
                    <input type="text" name="simbolo" id="simbolo" class="form-control" placeholder="Kg">
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="guardar">Guardar</button>
            </div>
        </div>
    </div>
</div>
