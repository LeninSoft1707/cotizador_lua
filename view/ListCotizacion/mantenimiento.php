<!-- Modal -->
<div class="modal fade" id="mdlmnt" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detalle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
            </div>
            <!-- Formulario dentro del modal -->
            <form id="mnt_form" method="POST">  
                <div class="modal-body">
                    <div class="card border-0 bg-info text-black text-start">
                        <div class="card-body p-2">
                            <blockquote class="blockquote mb-0" style="border:none">
                                <p id="l_fech_crea_hms"></p>
                                <!-- <p><strong>Fecha de Creación: </strong>lorem ipsum</p> -->
                            </blockquote>
                        </div>
                    </div>
                    <br>
                    <div class="card border-0 bg-warning text-black text-start">
                        <div class="card-body p-2">
                            <blockquote class="blockquote mb-0" style="border:none">
                            <p id="l_fech_envio_format"></p>
                            </blockquote>
                        </div>
                    </div>
                    <br>
                    <div class="card border-0 bg-dark text-white text-start">
                        <div class="card-body p-2">
                            <blockquote class="blockquote mb-0" style="border:none">
                                <p id="l_fech_visto_format"></p>
                            </blockquote>
                        </div>
                    </div>
                    <br>
                    <div id="l_fech_respuesta">

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>