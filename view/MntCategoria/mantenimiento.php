<!-- Modal -->
<div class="modal fade" id="mdlmnt" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mdltitulo">Formulario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
            </div>
            <!-- Formulario dentro del modal -->
            <form id="mnt_form" method="POST">
                <input type="hidden" id="cat_id" name="cat_id">
                <div class="modal-body">
                        <div class="mb-3">
                            <label for="cat_nom" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" id="cat_nom" name="cat_nom" placeholder="Ingrese Nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="cat_nom" class="form-label">Descripción:</label>
                            <textarea class="form-control" id="cat_descrip" name="cat_descrip" rows="3" placeholder="Ingrese Descripción" required></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" name="action" value="add" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>