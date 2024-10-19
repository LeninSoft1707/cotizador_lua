<?php
   require_once("../../config/conexion.php");
   if(isset($_SESSION["usu_id"])){ 
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>Cotizacion</title>
    <?php require_once("../Html/Head.php") ?>
    <style>
        .icon-text {
            display: flex;
            align-items: center;
            margin-right: 1rem; /* Espacio entre iconos */
        }

        .icon-text i {
            font-size: 1.2rem; /* Tamaño de icono */
        }
    </style>
    <style>
        .step-btn {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 1rem;
            font-size: 14px;
        }

        .badge {
            width: 30px;
            height: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 15px;
            transition: background-color 0.3s, color 0.3s;
        }

        /* Cambia el fondo del badge al pasar el cursor */
        .step-btn:hover .badge {
            background-color: #ffc107;
            color: #0578fc;
        }

        .description {
            font-size: 12px;
            margin-top: 5px;
        }

        .step-content {
            display: none;
        }

        .step-content.active {
            display: block;
        }
    </style>
</head>

<body class="g-sidenav-show  bg-gray-200">
    <?php require_once("../Html/Sidebar.php") ?>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Inicio</a></li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Cotizacion</li>
                    </ol>
                    <h6 class="font-weight-bolder mb-0">Nueva Cotizacion<p><small>Creación y Registro de Información</small></p></h6>
                </nav>
                
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                        <div class="input-group input-group-outline justify-content-center">
                            <div class="navbar-nav justify-content-center">
                                <ul class="navbar-nav justify-content-center">
                                <li class="nav-item d-flex align-items-center">
                                    <a class="nav-link px-2 d-flex align-items-center active" aria-current="page" href="../Home/index.php">
                                    <i class="fa fa-chart-pie opacity-6 text-dark me-1" aria-hidden="true"></i>
                                    Inicio
                                    </a>
                                </li>
                                <li class="nav-item d-flex align-items-center">
                                    <a class="nav-link px-2" href="../pages/profile.html">
                                    <i class="fa fa-user opacity-6 text-dark me-1" aria-hidden="true"></i>
                                    Perfil
                                    </a>
                                </li>
                                <li class="nav-item d-flex align-items-center">
                                    <a class="nav-link px-2 d-flex align-items-center" href="../pages/sign-up.html">
                                    <i class="fas fa-user-circle opacity-6 text-dark me-1" aria-hidden="true"></i>
                                    Calendario
                                    </a>
                                </li>
                                <li class="nav-item d-flex align-items-center">
                                    <a class="nav-link px-2" href="../Logout/logout.php">
                                    <i class="fas fa-key opacity-6 text-dark me-1" aria-hidden="true"></i>
                                    Cerrar Sesión
                                    </a>
                                </li>
                                </ul>
                            </div>
                            <ul class="navbar-nav  justify-content-center">             
                                <li class="nav-item px-2 d-flex align-items-center">
                                    <div class="col-auto">
                                        <div class="avatar avatar-xl position-relative">
                                        <img src="../../assets/img/bruce-mars.jpg" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                                        </div> 
                                    </div>
                                </li>
                                <li class="nav-item px-2 d-flex align-items-center">
                                    <div class="col-auto my-auto">
                                        <div class="h-100">
                                            <h6 class="mb-1">
                                                <?php echo $_SESSION["usu_nom"]?>
                                            </h6>
                                            <p class="mb-0 font-weight-normal text-sm">
                                                <?php echo $_SESSION["usu_correo"]?>
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                <li class="nav-item d-xl-none ps-0 d-flex align-items-center">
                                    <a href="javascript:;" class="nav-link p-0 text-body" id="iconNavbarSidenav">
                                        <div class="sidenav-toggler-inner">
                                            <i class="sidenav-toggler-line"></i>
                                            <i class="sidenav-toggler-line"></i>
                                            <i class="sidenav-toggler-line"></i>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>  
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="container mt-4">
            <!-- Toolbar con los pasos -->
            <div class="d-flex justify-content-center">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-primary step-btn" data-step="1">
                        <span class="badge bg-dark rounded-circle">1</span>
                        <div class="description">Datos Generales</div>
                    </button>
                    <button type="button" class="btn btn-primary step-btn" data-step="2">
                        <span class="badge bg-dark rounded-circle">2</span>
                        <div class="description">Detalle de la Cotización</div>
                    </button>
                    <button type="button" class="btn btn-primary step-btn" data-step="3">
                        <span class="badge bg-dark rounded-circle">3</span>
                        <div class="description">Costos Adicionales</div>
                    </button>
                    <button type="button" class="btn btn-primary step-btn" data-step="4">
                        <span class="badge bg-dark rounded-circle">4</span>
                        <div class="description">Vista previa</div>
                    </button>
                </div>
            </div>

            <input type="hidden" id="cot_id" name="cot_id">
            
            <div class="step-content active" id="step-1">
                <?php require_once("paso1.php") ?>
            </div>
            <div class="step-content active" id="step-2">
                <?php require_once("paso2.php") ?>
            </div> 
            <div class="step-content active" id="step-3">
                <?php require_once("paso3.php") ?>
            </div> 
            <div class="step-content active" id="step-4">
                <?php require_once("paso4.php") ?>
            </div> 
            <!-- Botones de navegación -->
            <div class="d-flex justify-content-evenly p-2">
                <button id="prevBtn" class="btn btn-primary">Anterior</button>
                <button id="nextBtn" class="btn btn-primary">Siguiente</button>
            </div> 
        </div>
        
    </main>

    <?php require_once("../Html/Header.php") ?>
    
    <?php require_once("../Html/Footer.php") ?>
    <?php require_once("modald.php") ?>
    
  <!--   Core JS Files   -->
    <?php require_once("../Html/js.php") ?>
    <script type="text/javascript" src="nuevacotizacion.js"></script>
    <!--   Script para Cotizacion   -->

    
</body>

</html>
<?php
    }else{
        header("Location:".Conectar::ruta()."../index.php");
    }
   
?>