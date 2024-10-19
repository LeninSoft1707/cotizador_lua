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
                <input type="hidden" id="emp_id" name="emp_id">
                <div class="modal-body">
                        <div class="mb-3">
                            <label for="emp_nom" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" id="emp_nom" name="emp_nom" placeholder="Ingrese Nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="emp_porcen" class="form-label">Porcentaje:</label>
                            <input type="number" class="form-control" id="emp_porcen" name="emp_porcen" placeholder="Ingrese Porcentaje" required>
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