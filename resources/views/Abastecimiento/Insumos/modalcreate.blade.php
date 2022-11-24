<div class="modal fade" id="modal_create" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Crear Insumos</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('Insumo.store') }}" id="frm_registrar_Insumo" method="POST">
                    @csrf
                    <label for="" class="required">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" class="form-control">
                    <label for="" class="required">Precio:</label>
                    <input type="text" name="precio" id="precio" class="form-control">
                    <label for="" class="required">Stock:</label>
                    <input type="text" name="stock" id="stock" class="form-control" value="0" readonly>
                    <label for="">Unidad:</label>
                    <select name="unidad" id="unidad" class="form-control">
                        @foreach ($unidades as $unidad)
                            <option value="{{ $unidad->id }}">
                                {{ $unidad->simbolo }}
                            </option>
                        @endforeach
                    </select>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="guardar">Guardar</button>
            </div>
        </div>
    </div>
</div>
