<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">

      <input type="hidden" id="xusu_id" name="xusu_id" value="<?php echo $_SESSION["usu_id"]?>">
      
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <div class="navbar-brand m-0" target="_blank">
        <img src="../../assets/img/bruce-mars.jpg" alt="profile_image" class="objet-fit-cover">
        <span class="ms-1 font-weight-bold text-white" style="font-size: 1.1em"><?php echo $_SESSION["usu_nom"]?></span>
        <p class="mb-0 font-weight-normal text-white" style="font-size: 1.1em">
          <?php echo $_SESSION["usu_correo"]?>
        </p>
      </div>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <!-- Dashboard -->
        <li class="nav-item">
          <a href="../Home/index.php" class="nav-link text-white active bg-gradient-primary">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">dashboard</i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
  
        <!-- Mantenimiento -->
        <li class="nav-item">
          <a href="javascript:;" class="nav-link text-white" data-bs-toggle="collapse" data-bs-target="#mantenimientoMenu" aria-expanded="false" aria-controls="mantenimientoMenu">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">construction</i>
            </div>
            <span class="nav-link-text ms-1">Mantenimiento
            </span>
          </a>
          <!-- Submenú -->
          <div class="collapse" id="mantenimientoMenu">
            <ul class="navbar-nav ps-4">
                <li class="nav-item">
                    <a class="nav-link text-white" href="../MntCliente/index.php">
                        <i class="material-icons opacity-10">arrow_forward</i>
                        <span class="nav-link-text ms-1">Cliente</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="../MntContacto/index.php">
                        <i class="material-icons opacity-10">arrow_forward</i>
                        <span class="nav-link-text ms-1">Contacto</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="../MntEmpresa/index.php">
                        <i class="material-icons opacity-10">arrow_forward</i>
                        <span class="nav-link-text ms-1">Empresa</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="../MntCategoria/index.php">
                        <i class="material-icons opacity-10">arrow_forward</i>
                        <span class="nav-link-text ms-1">Categoria</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="../MntProducto/index.php">
                        <i class="material-icons opacity-10">arrow_forward</i>
                        <span class="nav-link-text ms-1">Producto</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="../MntUsuario/index.php">
                        <i class="material-icons opacity-10">arrow_forward</i>
                        <span class="nav-link-text ms-1">Usuario</span>
                    </a>
                </li>
                <!-- Agrega más elementos de menú según sea necesario -->
            </ul>
          </div>
        </li>
  
        <!-- Cotización -->
        <li class="nav-item">
          <a href="javascript:;" class="nav-link text-white" data-bs-toggle="collapse" data-bs-target="#cotizacionMenu" aria-expanded="false" aria-controls="cotizacionMenu">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="material-icons opacity-10">table_view</i>
              </div>
              <span class="nav-link-text ms-1">Cotización
              </span>
          </a>
              <!-- Submenú -->
              <div class="collapse" id="cotizacionMenu">
                <ul class="navbar-nav ps-4">
                  <li class="nav-item">
                    <a class="nav-link text-white" href="../NuevaCotizacion/index.php">
                      <i class="material-icons opacity-10">arrow_forward</i>
                      <span class="nav-link-text ms-1">Nueva Cotización</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-white" href="../pages/billing.html">
                      <i class="material-icons opacity-10">arrow_forward</i>
                      <span class="nav-link-text ms-1">Listado Cotización</span>
                    </a>
                  </li>
                    <!-- Agrega más elementos de menú según sea necesario -->
                </ul>
            </div>
        </li>
      </ul>
  </div>


    <div class="sidenav-footer position-absolute w-100 bottom-0 ">
      <div class="mx-3">
        <a class="btn btn-outline-primary mt-4 w-100" href="https://www.creative-tim.com/learning-lab/bootstrap/overview/material-dashboard?ref=sidebarfree" type="button">Documentation</a>
        <a class="btn bg-gradient-primary w-100" href="https://www.creative-tim.com/product/material-dashboard-pro?ref=sidebarfree" type="button">Upgrade to pro</a>
      </div>
    </div>
</aside>

