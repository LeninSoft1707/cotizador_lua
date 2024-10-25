<?php
   require_once("../../config/conexion.php");
   if(isset($_SESSION["usu_id"])){ 
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>Admin</title>
    <?php require_once("../Html/Head.php") ?>
</head>

<body class="g-sidenav-show  bg-gray-200">
    <?php require_once("../Html/Sidebar.php") ?>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <!-- Navbar --> 
        <!-- End Navbar -->
        <?php require_once("../Html/Header.php") ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                                <div class="d-flex justify-content-between align-items-center ps-3">
                                    <h6 class="text-white text-capitalize">Dashboard</h6>
                                    <small class="text-xs alert alert-primary text-white text-uppercase me-3" style="padding: 8px 8px !important;">Total Cotizaciones: <span  id="lbltotalcotizaciones"></span></small>
                                </div>
                            </div>
                        </div>

                        <div class="container-fluid py-4">
                            <div class="row">
                                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                                    <div class="card">
                                        <div class="card-header p-3 pt-2">
                                            <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                                                <i class="material-icons opacity-10">done_outline</i>
                                            </div>
                                            <div class="text-end pt-1">
                                                <p class="text-sm mb-0 text-capitalize">Total Aceptados</p>
                                                <h4 class="mb-0" id="lblaceptados">40</h4>
                                            </div>
                                        </div>
                                        <hr class="dark horizontal my-0">
                                        <div class="card-footer p-3">
                                            <p class="mb-0"><span class="text-success text-sm font-weight-bolder" id="porcentajeAceptadas"></span> Cantidad de Cotizaciones Aceptadas</p>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                                    <div class="card">
                                        <div class="card-header p-3 pt-2">
                                            <div class="icon icon-lg icon-shape bg-gradient-danger shadow-danger text-center border-radius-xl mt-n4 position-absolute">
                                                <i class="material-icons opacity-10">close</i>
                                            </div>
                                            <div class="text-end pt-1">
                                                <p class="text-sm mb-0 text-capitalize">Total Rechazados</p>
                                                <h4 class="mb-0" id="lblrechazados"></h4>
                                            </div>
                                        </div>
                                        <hr class="dark horizontal my-0">
                                        <div class="card-footer p-3">
                                            <p class="mb-0"><span class="text-danger text-sm font-weight-bolder" id="porcentajeRechazadas"></span> Cantidad de Cotizaciones Rechazadas</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                                    <div class="card">
                                        <div class="card-header p-3 pt-2">
                                            <div class="icon icon-lg icon-shape bg-gradient-warning shadow-warning text-center border-radius-xl mt-n4 position-absolute">
                                                <i class="material-icons opacity-10">visibility</i>
                                            </div>
                                            <div class="text-end pt-1">
                                                <p class="text-sm mb-0 text-capitalize">Total Vistos</p>
                                                <h4 class="mb-0" id="lblvistos"></h4>
                                            </div>
                                        </div>
                                        <hr class="dark horizontal my-0">
                                        <div class="card-footer p-3">
                                            <p class="mb-0"><span class="text-warning text-sm font-weight-bolder" id="porcentajeVistas"></span> Cantidad de Cotizaciones Vistas</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-sm-6">
                                    <div class="card">
                                        <div class="card-header p-3 pt-2">
                                            <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                                                <i class="material-icons opacity-10">mark_email_read</i>
                                            </div>
                                            <div class="text-end pt-1">
                                                <p class="text-sm mb-0 text-capitalize">Total Enviados</p>
                                                <h4 class="mb-0" id="lblenviados"></h4>
                                            </div>
                                        </div>
                                        <hr class="dark horizontal my-0">
                                        <div class="card-footer p-3">
                                            <p class="mb-0"><span class="text-dark text-sm font-weight-bolder" id="porcentajeEnviadas"></span> Cantidad de Cotizaciones Enviadas</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-xl-3 col-md-6 mt-4 mb-4">
                                    <div class="card z-index-2 ">
                                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                                            <div class="bg-gradient-success shadow-success border-radius-lg py-3 pe-1">
                                                <div class="chart">
                                                    <canvas id="graficoAceptados" width="400" height="200" class="chart-canvas"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                        <h6 class="mb-0 ">Aceptados</h6>
                                            <p class="text-sm ">Aceptados por Usuario</p>
                                            <hr class="dark horizontal">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6 mt-4 mb-4">
                                    <div class="card z-index-2">
                                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                                            <div class="bg-gradient-danger shadow-danger border-radius-lg py-3 pe-1">
                                                <div class="chart">
                                                    <canvas id="graficoRechazados" width="400" height="200" class="chart-canvas"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <h6 class="mb-0 "> Rechazados </h6>
                                            <p class="text-sm ">Rechazados por Usuario</p>
                                            <hr class="dark horizontal">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6 mt-4 mb-4">
                                    <div class="card z-index-2">
                                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                                            <div class="bg-gradient-warning shadow-warning border-radius-lg py-3 pe-1">
                                                <div class="chart">
                                                    <canvas id="graficoVistos" width="400" height="200" class="chart-canvas"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <h6 class="mb-0 ">Vistos</h6>
                                            <p class="text-sm ">Vistos por Usuario</p>
                                            <hr class="dark horizontal">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6 mt-4 mb-4">
                                    <div class="card z-index-2 ">
                                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                                            <div class="bg-gradient-dark shadow-dark border-radius-lg py-3 pe-1">
                                                <div class="chart">
                                                    <canvas id="graficoEnviados" width="400" height="200" class="chart-canvas"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <h6 class="mb-0 ">Enviados</h6>
                                            <p class="text-sm ">Enviados por Usuario</p>
                                            <hr class="dark horizontal">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once("../Html/Footer.php") ?>
    </main>

  <!--   Core JS Files   -->
    <?php require_once("../Html/js.php") ?>

    <script type="text/javascript" src="home.js"></script>
    
</body>

</html>
<?php
    }else{
        header("Location:".Conectar::ruta()."../index.php");
    }
   
?>