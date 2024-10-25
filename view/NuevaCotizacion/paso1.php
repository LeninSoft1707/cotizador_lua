<div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center">
                        <h6 class="text-white text-capitalize ps-3">Paso 1</h6>
                        <button class="btn btn-light btn-sm me-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFieldset1" aria-expanded="false" aria-controls="collapseFieldset1">
                            <i class="fas fa-chevron-down"></i>
                        </button>
                    </div>
                </div>
                <div class="collapse show" id="collapseFieldset1">
                    <fieldset>
                        <div class="mb-3 mx-3">
                            <label for="cli_id" class="form-label">Cliente:</label>
                            <select class="form-control" id="cli_id" name="cli_id">
                            </select>
                        </div>
                        <div class="mb-3 mx-3">
                            <label for="con_id" class="form-label">Contacto:</label>
                            <select class="form-control" id="con_id" name="con_id">
                            </select>
                        </div>
                        <div class="mb-3 mx-3">
                            <label for="cli_ruc" class="form-label">DNI/RUC:</label>
                            <input type="text" class="form-control" id="cli_ruc" name="cli_ruc" placeholder="Ingrese su Dni o Ruc" required>
                        </div>
                        <div class="mb-3 mx-3">
                            <label for="con_telf" class="form-label">Telefono Contacto:</label>
                            <input type="tel" class="form-control" id="con_telf" name="con_telf" placeholder="Ingrese su Telefono" required>
                        </div>
                        <div class="mb-3 mx-3">
                            <label for="con_email" class="form-label">Correo Contacto:</label>
                            <input type="text" class="form-control" id="con_email" name="con_email" placeholder="Ingrese su Correo" required>
                        </div>
                        <div class="mb-3 mx-3">
                            <label for="cot_descrip" class="form-label">Descripción:</label>
                            <textarea class="form-control" id="cot_descrip" name="cot_descrip" rows="3" placeholder="Ingrese Descripción" required></textarea>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</div>

 