<?php
   require_once("../../config/conexion.php");
   if(isset($_SESSION["usu_id"])){ 
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>Contacto</title>
    <?php require_once("../Html/Head.php") ?>
</head>

<body class="g-sidenav-show  bg-gray-200">
    <?php require_once("../Html/Sidebar.php") ?>
    
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Página</a></li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Producto</li>
                    </ol>
                    <h6 class="font-weight-bolder mb-0">Producto<p><small>Registro, Modificación y Eliminación de Registros</small></p></h6>
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
        <div class="container-fluid py-3 pb-1">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">Mantenimiento de Producto</h6>
                            </div>
                        </div>  
                        <div class="card-body px-3 py-2 col-sm-2">
                            <!-- Botón para abrir el modal -->
                            <button type="button" id="btnnuevo" class="btn bg-gradient-success w-100 mb-0 toast-btn" data-toggle="modal" data-target="successToast">
                                Nuevo Producto
                            </button>
                            <!-- <button class="btn bg-gradient-success w-100 mb-0 toast-btn" type="button" data-target="successToast">Nueva Categoria</button> -->
                        </div>
                        <div class="card-body pb-3 pt-3">
                            <div class="table-responsive p-0">
                                <table id="lista_data" class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Categoria</th>
                                            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Producto</th>
                                            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Descripcion</th>
                                            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Precio</th>
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
                </div>
            </div>
        </div>
    </main>
    <?php require_once("../Html/Footer.php") ?>

    <?php require_once("../Html/Header.php") ?>
    <!--   Para el Modal Nuevo Registro MntCategoria   -->
    <?php require_once("producto.php") ?>

    <?php require_once("../Html/modal.php") ?>
    <!--   Core JS Files   -->
    <?php require_once("../Html/js.php") ?>
    <script type="text/javascript" src="producto.js"></script>
</body>

</html>
<?php
    }else{
        header("Location:".Conectar::ruta()."../index.php");
    }
   
?>