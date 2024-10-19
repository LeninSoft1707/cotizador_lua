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
                <input type="hidden" id="prod_id" name="prod_id">
                <div class="modal-body">
                    <fieldset>
                        <div class="mb-3">
                            <label for="cat_id" class="form-label">Categoria:</label>
                            <select class="form-control" id="cat_id" name="cat_id">
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="prod_nom" class="form-label">Producto:</label>
                            <input type="text" class="form-control" id="prod_nom" name="prod_nom" placeholder="Ingrese nombre del Producto" required>
                        </div>
                        <div class="mb-3">
                            <label for="prod_descrip" class="form-label">Descripción:</label>
                            <input type="text" class="form-control" id="prod_descrip" name="prod_descrip" placeholder="Ingrese la descripcion" required>
                        </div>
                        <div class="mb-3">
                            <label for="prod_precio" class="form-label">Precio:</label>
                            <input type="number" step="0.01" min="0" class="form-control" id="prod_precio" name="prod_precio" placeholder="Ingrese el precio" required>
                        </div>
                    </fieldset> 
                        
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" name="action" value="add" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>