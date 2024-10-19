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
                <input type="hidden" id="con_id" name="con_id">
                <div class="modal-body">
                    <fieldset>
                        <div class="mb-3">
                            <label for="cli_id" class="form-label">Cliente:</label>
                            <select class="form-control" id="cli_id" name="cli_id">
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="car_id" class="form-label">Cargo:</label>
                            <select class="form-control" id="car_id" name="car_id">
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="con_nom" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" id="con_nom" name="con_nom" placeholder="Ingrese su Nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="con_email" class="form-label">Correo:</label>
                            <input type="text" class="form-control" id="con_email" name="con_email" placeholder="Ingrese su Correo" required>
                        </div>
                        <div class="mb-3">
                            <label for="con_telf" class="form-label">Telefono:</label>
                            <input type="tel" class="form-control" id="con_telf" name="con_telf" placeholder="Ingrese su Telefono" required>
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