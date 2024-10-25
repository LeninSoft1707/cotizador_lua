<div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center">
                        <h6 class="text-white text-capitalize ps-3">Paso 2</h6>
                        <button class="btn btn-light btn-sm me-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFieldset2" aria-expanded="false" aria-controls="collapseFieldset">
                            <i class="fas fa-chevron-down"></i>
                        </button>
                    </div>
                </div>
                <div class="collapse show" id="collapseFieldset2">
                    <fieldset>
                        <div class="row mx-3">
                            <div class="col-md-6 mb-3">
                                <label for="cat_id" class="form-label">Categoria:</label>
                                <select class="form-control" id="cat_id" name="cat_id">
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="prod_id" class="form-label">Producto:</label>
                                <select class="form-control" id="prod_id" name="prod_id">
                                </select>
                            </div>
        
                            <div class="col-md-3 mb-3">
                                <label for="cotd_precio" class="form-label">Precio:</label>
                                <input type="number" class="form-control" id="cotd_precio" name="cotd_precio" placeholder="0.00" required readonly>
                            </div>
        
                            <div class="col-md-3 mb-3">
                                <label for="cotd_cant" class="form-label">Cantidad:</label>
                                <input type="number" class="form-control" id="cotd_cant" name="cotd_cant" placeholder="0" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="cotd_total" class="form-label">Total:</label>
                                <input type="number" class="form-control" id="cotd_total" name="cotd_total" placeholder="0.00" required readonly>
                            </div>
                            <div class="col-md-3 mb-3 d-flex flex-column justify-content-end" style="height: 100%;">
                                <label for="cotd_total" class="form-label">&nbsp;</label>
                                <button type="button" id="btnagregardetalle" class="btn bg-gradient-success w-100 mb-0 toast-btn" style="padding: 6px 0px 6px 0px !important;" data-toggle="modal" data-target="successToast">
                                    Agregar
                                </button>
                            </div>
                            <div class="card-body p-2">
                                <div class="table-responsive p-0">
                                    <table id="detalle_data" class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Categoria</th>
                                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Producto</th>
                                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Precio</th>
                                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Cantidad</th>
                                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Profit</th>
                                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Sub Total</th>
                                                <th width="1%"></th>
                                                <th width="1%"></th>
                                            </tr>   
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="invoice pb-2">
                                    <div class="invoice-content">
                                        <div class="invoice-price">
                                            <div class="invoice-price-left">
                                                <div class="invoice-price-row">
                                                    <div class="sub-price">
                                                        <span class="text-label">Sub Total</span>
                                                        <span class="text-inverse" id="cot_subtotal">S/. 0.00</span>
                                                    </div>
                                                    <div class="sub-price">
                                                        <i class="fa fa-plus text-muted"></i>
                                                    </div>
                                                    <div class="sub-price">
                                                        <span class="text-label">Profit (20%)</span>
                                                        <span class="text-inverse" id="cot_profit">S/. 0.00</span>
                                                    </div>
                                                </div>      
                                            </div>
                                            <div class="invoice-price-right me-3">
                                                <small>TOTAL</small>
                                                <span class="f-w-600" id="cot_total"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</div>