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
                <input type="hidden" id="cli_id" name="cli_id">
                <div class="modal-body">

                        <div class="mb-3">
                            <label for="cli_nom" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" id="cli_nom" name="cli_nom" placeholder="Ingrese su Nombre" required>
                        </div>
                    
                        <div class="mb-3">
                            <label for="cli_ruc" class="form-label">Dni o Ruc:</label>
                            <input type="text" maxlength="11" pattern="^\d{8}$|^\d{11}$" title="Debe ingresar 8 dígitos para DNI o 11 dígitos para RUC"  class="form-control" id="cli_ruc" name="cli_ruc" placeholder="Ingrese su Dni o Ruc" required>
                        </div>
                        <div class="mb-3">
                            <label for="cli_telf" class="form-label">Telefono:</label>
                            <input type="tel" maxlength="9" pattern="[0-9]{9}" class="form-control" id="cli_telf" name="cli_telf" placeholder="Ingrese su Telefono" required>
                        </div>
                        <div class="mb-3">
                            <label for="cli_email" class="form-label">Correo:</label>
                            <input type="text" class="form-control" id="cli_email" name="cli_email" placeholder="Ingrese su Correo" required>
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