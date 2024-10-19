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
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Página</a></li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Admin</li>
                    </ol>
                    <h6 class="font-weight-bolder mb-0">Administrador</h6>
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
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">Authors table</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php require_once("../Html/Header.php") ?>
    
    <?php require_once("../Html/Footer.php") ?>
    
  <!--   Core JS Files   -->
    <?php require_once("../Html/js.php") ?>
</body>

</html>
<?php
    }else{
        header("Location:".Conectar::ruta()."../index.php");
    }
   
?>