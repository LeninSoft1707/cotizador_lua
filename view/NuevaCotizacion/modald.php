<!-- Modal -->
<div class="modal fade" id="modald" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Profit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
            </div>
            <!-- Formulario dentro del modal -->
            <form id="mnt_form" method="POST">
                <input type="hidden" id="cotd_id" name="cotd_id">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="cat_nom" class="form-label">Categoria:</label>
                        <input type="text" class="form-control" id="cat_nom" name="cat_nom" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="prod_nom" class="form-label">Producto:</label>
                        <input type="text" class="form-control" id="prod_nom" name="prod_nom" readonly>
                    </div>
    
                    <div class="mb-3">
                        <label for="cotd_precio_md" class="form-label">Precio:</label>
                        <input type="number" class="form-control" id="cotd_precio_md" name="cotd_precio_md" readonly>
                    </div>
    
                    <div class="mb-3">
                        <label for="cotd_cant_md" class="form-label">Cantidad:</label>
                        <input type="number" class="form-control" id="cotd_cant_md" name="cotd_cant_md">
                    </div>
                    <div class="mb-3">
                        <label for="cotd_profit_md" class="form-label">Profit:</label>
                        <input type="number" class="form-control" id="cotd_profit_md" name="cotd_profit_md">
                    </div>
                    <div class="mb-3">
                        <label for="cotd_total_md" class="form-label">Total:</label>
                        <input type="number" class="form-control" id="cotd_total_md" name="cotd_total_md" readonly>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" id="btnagregarmd" name="action" value="add" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>