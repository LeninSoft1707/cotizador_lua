<div class="container-fluid py-3">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center">
                                <h6 class="text-white text-capitalize ps-3">Paso 3</h6>
                                <button class="btn btn-light btn-sm me-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFieldset3" aria-expanded="false" aria-controls="collapseFieldset">
                                    <i class="fas fa-chevron-down"></i>
                                </button>
                            </div>
                        </div>
                        <div class="collapse show" id="collapseFieldset3">
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="cat_id_a" class="form-label">Categoria:</label>
                                        <select class="form-control" id="cat_id_a" name="cat_id_a">
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="prod_id_a" class="form-label">Producto:</label>
                                        <select class="form-control" id="prod_id_a" name="prod_id_a">
                                        </select>
                                    </div>
                
                                    <div class="col-md-3 mb-3">
                                        <label for="cotd_precio_a" class="form-label">Precio:</label>
                                        <input type="number" class="form-control" id="cotd_precio_a" name="cotd_precio_a" placeholder="0.00" required readonly>
                                    </div>
                
                                    <div class="col-md-3 mb-3">
                                        <label for="cotd_cant_a" class="form-label">Cantidad:</label>
                                        <input type="number" class="form-control" id="cotd_cant_a" name="cotd_cant_a" placeholder="0" required>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="cotd_total_a" class="form-label">Total:</label>
                                        <input type="number" class="form-control" id="cotd_total_a" name="cotd_total_a" placeholder="0.00" required readonly>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="cotd_total_a" class="form-label">&nbsp;</label>
                                        <button type="button" id="btnagregardetalle_a" class="btn bg-gradient-success w-100 mb-0 toast-btn" data-toggle="modal" data-target="successToast">
                                            Agregar
                                        </button>
                                    </div>
                                    <div class="card-body pb-3 pt-3">
                                        <div class="table-responsive p-0">
                                            <table id="detalle_data_a" class="table align-items-center mb-0">
                                                <thead>
                                                    <tr>
                                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Categoria</th>
                                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Producto</th>
                                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Precio</th>
                                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Cantidad</th>
                                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Profit</th>
                                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Total</th>
                                                        <th width="1%"></th>
                                                        <th width="1%"></th>
                                                    </tr>   
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div> 
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
        </div>