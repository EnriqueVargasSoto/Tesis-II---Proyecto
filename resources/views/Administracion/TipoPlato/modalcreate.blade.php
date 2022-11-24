<div class="modal fade" id="modal_create" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Crear Tipo Plato</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('TipoPlato.store') }}" id="frm_registrar_tipoPlato" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="" class="required">Tipo Plato:</label>
                    <input type="text" name="tipo" id="tipo" class="form-control" placeholder="Tipo" required>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label id="logo_label">Logo:</label>
                                    <div class="custom-file">
                                        <input id="logo_create" type="file" name="logo_create" class="custom-file-input" accept="image/*" required />
                                        <label for="logo" id="logo_txt_create" name="logo_txt_create"
                                            class="custom-file-label selected">Seleccionar</label>
                                    </div>
                                </div>
                            </div>
                            <br />
                            <br />
                            <div class="row">
                                <div class="col-lg-2"></div>
                                <div class="col-lg-7">
                                    <div class="row  justify-content-end">
                                        <a href="javascript:void(0);" id="limpiar_logo_create">
                                            <span class="badge badge-danger">x</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col-lg-2"></div>
                                <div class="col-lg-7">
                                    <p>
                                        <img class="rounded img-fluid" alt="" id="logo_img_create" />
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="guardar">Guardar</button>
            </div>
        </div>
    </div>
</div>
