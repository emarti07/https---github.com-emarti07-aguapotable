<!-- Sidebar -->
<div id="sidebar-wrapper" data-simplebar data-simplebar-auto-hide="true" style="background-color: #007bff;">
  <div class="brand-logo text-center py-3">
    <a href="index.php" style="text-decoration: none;">
      <img src="assets/images/logo-siscatel.png" alt="Logo SISCATEL" width="50" style="filter: drop-shadow(0 0 6px #fd7e14);">
      <h5 class="logo-text text-white" style="font-family: 'Bahnschrift', sans-serif; font-weight: 600;">SISCATEL</h5>
    </a>
  </div>

  <ul class="sidebar-menu do-nicescrol px-2" style="font-family: 'Bahnschrift', sans-serif;">
    <li class="sidebar-header text-white">NAVEGACIÓN PRINCIPAL</li>

    <li><a href="index.php"><i class="zmdi zmdi-view-dashboard text-white"></i> <span class="text-white">Inicio</span></a></li>
    <li><a href="contribuyentes.php"><i class="zmdi zmdi-face" style="color: #28a745;"></i> <span class="text-white">Contribuyentes</span></a></li>
    <li><a href="cobrar.php"><i class="zmdi zmdi-invert-colors" style="color: #fd7e14;"></i> <span class="text-white">Cobro</span></a></li>
    <li><a href="pagos.php"><i class="fa fa-usd text-white"></i> <span class="text-white">Pagados</span></a></li>
    <li><a href="servicios.php"><i class="zmdi zmdi-accounts-add text-white"></i> <span class="text-white">Servicios</span></a></li>
    <li><a href="usuarios.php"><i class="icon-user" style="color: #dc3545;"></i> <span class="text-white">Gestión de Usuarios</span></a></li>
    <li><a href="respaldo.php"><i class="fa fa-database text-white"></i> <span class="text-white">Respaldo</span></a></li>

    <li class="sidebar-header text-white mt-3">ETIQUETAS</li>
    <li><a href="javascript:void();"><i class="zmdi zmdi-coffee" style="color: #fd7e14;"></i> <span class="text-white">Importante</span></a></li>
    <li><a href="javascript:void();"><i class="zmdi zmdi-chart-donut text-warning"></i> <span class="text-white">Alerta</span></a></li>
    <li><a href="javascript:void();"><i class="zmdi zmdi-share text-info"></i> <span class="text-white">Información</span></a></li>
  </ul>

  <div class="text-center mt-4 mb-3">
    <img src="assets/images/aguapotable-400x356 (1).png" alt="SISCATEL" width="180"
         style="filter: drop-shadow(0 0 12px #00BDFF); border-radius: 10px;">
  </div>
</div>

<!-- Topbar -->
<header class="topbar-nav" style="background-color: #007bff; font-family: 'Bahnschrift', sans-serif;">
  <nav class="navbar navbar-expand fixed-top">
    <ul class="navbar-nav mr-auto align-items-center">
      <li class="nav-item">
        <a class="nav-link toggle-menu text-white" href="javascript:void();">
          <i class="icon-menu menu-icon"></i>
        </a>
      </li>
      <li class="nav-item">
        <form class="search-bar">
          <input type="text" class="form-control" placeholder="Buscar..." style="font-weight:500;">
          <a href="javascript:void();"><i class="icon-magnifier text-white"></i></a>
        </form>
      </li>
    </ul>

    <ul class="navbar-nav align-items-center right-nav-link">
      <li class="nav-item language">
        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="#">
          <i class="fa fa-flag text-white"></i>
        </a>
        <ul class="dropdown-menu dropdown-menu-right">
          <li class="dropdown-item"> <i class="flag-icon flag-icon-gb mr-2"></i> English</li>
          <li class="dropdown-item"> <i class="flag-icon flag-icon-es mr-2"></i> Español</li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret text-white" data-toggle="dropdown" href="#">
          <span class="user-profile">
            <img src="https://via.placeholder.com/110x110" class="img-circle" alt="avatar" width="32">
          </span>
        </a>
        <ul class="dropdown-menu dropdown-menu-right">
          <li class="dropdown-item user-details">
            <a href="javascript:void();">
              <div class="media">
                <div class="avatar">
                  <img class="align-self-start mr-3" src="https://via.placeholder.com/110x110" alt="avatar">
                </div>
                <div class="media-body">
                  <h6 class="mt-2 user-title"><?php echo $_SESSION["nombre"] . " " . $_SESSION["apellido"]; ?></h6>
                  <p class="user-subtitle"><?php echo $_SESSION["rol"]; ?></p>
                </div>
              </div>
            </a>
          </li>
          <li class="dropdown-divider"></li>
          <li class="dropdown-item">
            <a href="controlador/controlador_cerrar_sesion.php">
              <i class="icon-power mr-2"></i> Cerrar sesión
            </a>
          </li>
        </ul>
      </li>
    </ul>
  </nav>
</header>
