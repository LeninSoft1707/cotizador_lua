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
                <input type="hidden" id="usu_id" name="usu_id">
                <div class="modal-body">
                        <div class="mb-3">
                            <label for="usu_correo" class="form-label">Correo:</label>
                            <input type="text" class="form-control" id="usu_correo" name="usu_correo" placeholder="Ingrese su Correo" required>
                        </div>
                        <div class="mb-3">
                            <label for="usu_nom" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" id="usu_nom" name="usu_nom" placeholder="Ingrese su Nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="usu_pass" class="form-label">Contraseña:</label>
                            <input type="text" class="form-control" id="usu_pass" name="usu_pass" placeholder="Ingrese su Contraseña" required>
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