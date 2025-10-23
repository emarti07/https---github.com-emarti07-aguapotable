<?php
session_start();
if (empty($_SESSION["id"])){
  header("location: login.php");
}
?>
<!DOCTYPE html>
<html lang="es">
  
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content="Sistema de control de cobros de agua potable"/>
  <meta name="author" content=""/>
  <title>AquaDzonot | Alcaldía de Telpaneca</title>
  
  <!-- SweetAlert -->
  <script src="http://localhost/sweetalert2-11.10.5/sweetalert2.min.js"></script>
  <link rel="stylesheet" href="http://localhost/sweetalert2-11.10.5/sweetalert2.css">
  
  <!-- Fuente Bahnschrift -->
  <link href="https://fonts.googleapis.com/css2?family=Bahnschrift:wght@400;500;600;700&display=swap" rel="stylesheet">
  
  <!-- loader-->
  <link href="assets/css/pace.min.css" rel="stylesheet"/>
  <script src="assets/js/pace.min.js"></script>
  
  <!--favicon-->
  <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
  
  <!-- Bootstrap core CSS-->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet"/>
  
  <!-- Icons CSS-->
  <link href="assets/css/icons.css" rel="stylesheet" type="text/css"/>
  
  <!-- Sidebar CSS-->
  <link href="assets/css/sidebar-menu.css" rel="stylesheet"/>
  
  <!-- Custom Style-->
  <link href="assets/css/app-style.css" rel="stylesheet"/>
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  
  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
  <style>
    :root {
      --color-azul: #306BA9;
      --color-naranja: #E16D2B;
      --color-verde: #4CAF50;
      --color-gris-claro: #f8f9fa;
      --color-gris-oscuro: #343a40;
      --color-blanco: #ffffff;
    }
    
    body {
      font-family: 'Bahnschrift', Arial, sans-serif;
      background-color: #f5f7fa;
    }
    
    /* Barra superior */
    .topbar-nav {
      background: var(--color-blanco) !important;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    .welcome-message {
      color: var(--color-azul);
      font-weight: 600;
      margin-left: 15px;
    }
    
    /* Encabezado principal */
    .main-header {
      text-align: center;
      margin: 20px 0 30px;
    }
    
    .logo-container {
      margin-bottom: 20px;
    }
    
    .highlight-lines {
      display: block;
      margin: 0 auto;
      filter: drop-shadow(0 0 20px rgba(255, 255, 255, 0.5));
      animation: glowAnimation 2s infinite alternate;
      max-width: 100%;
      height: auto;
    }
    
    @keyframes glowAnimation {
      from { filter: drop-shadow(0 0 20px rgba(255, 255, 255, 0.5)); }
      to { filter: drop-shadow(0 0 20px rgba(255, 255, 255, 1)); }
    }
    
    h1, h2 {
      color: var(--color-azul);
      font-weight: 700;
    }
    
    hr.header-line {
      border: 2px solid var(--color-naranja);
      width: 100px;
      margin: 15px auto;
    }
    
    /* Tarjetas de estadísticas */
    .stats-card {
      border-radius: 10px;
      margin-bottom: 20px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
      transition: all 0.3s ease;
      border: none;
    }
    
    .stats-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
    
    .stats-card .card-body {
      padding: 20px;
    }
    
    .stats-card h5 {
      font-weight: 600;
      margin-bottom: 10px;
    }
    
    .stats-card .progress {
      height: 6px;
      border-radius: 3px;
      background-color: rgba(255,255,255,0.2);
    }
    
    /* Gráficos */
    .chart-container {
      position: relative;
      height: 300px;
      margin-bottom: 20px;
    }
    
    .chart-card {
      border-radius: 10px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
      margin-bottom: 30px;
      border: none;
    }
    
    .chart-card .card-header {
      background-color: var(--color-blanco);
      border-bottom: 1px solid rgba(0,0,0,0.05);
      font-weight: 600;
      color: var(--color-azul);
      padding: 15px 20px;
      border-radius: 10px 10px 0 0 !important;
    }
    
    /* Tablas */
    .table-responsive {
      border-radius: 10px;
      overflow: hidden;
    }
    
    .table {
      margin-bottom: 0;
    }
    
    .table thead th {
      background-color: var(--color-azul);
      color: var(--color-blanco);
      font-weight: 600;
      padding: 12px 15px;
      border: none;
    }
    
    .table tbody td {
      padding: 12px 15px;
      vertical-align: middle;
      border-top: 1px solid rgba(0,0,0,0.03);
    }
    
    .table tbody tr:hover {
      background-color: rgba(48, 107, 169, 0.03);
    }
    
    /* Formularios */
    .filter-form {
      background: var(--color-blanco);
      padding: 15px;
      border-radius: 10px;
      margin-bottom: 20px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }
    
    .filter-form label {
      font-weight: 600;
      color: var(--color-azul);
      margin-right: 10px;
    }
    
    /* Botones */
    .btn-outline-danger {
      color: var(--color-naranja);
      border-color: var(--color-naranja);
    }
    
    .btn-outline-danger:hover {
      background-color: var(--color-naranja);
      color: white;
    }
    
    .btn-dark {
      background-color: var(--color-gris-oscuro);
      border-color: var(--color-gris-oscuro);
    }
    
    /* Responsive */
    @media (max-width: 768px) {
      .main-header h1 {
        font-size: 1.5rem;
      }
      
      .main-header h2 {
        font-size: 1.2rem;
      }
      
      .highlight-lines {
        width: 80%;
      }
    }
  </style>
</head>

<body class="bg-theme bg-theme1">

<!-- start loader -->
<div id="pageloader-overlay" class="visible incoming"><div class="loader-wrapper-outer"><div class="loader-wrapper-inner"><div class="loader"></div></div></div></div>
<!-- end loader -->

<!-- Start wrapper-->
<div id="wrapper">

  <!--Start sidebar-wrapper-->
  <div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
    <?php include('navegacion.php'); ?>
  </div>
  <!--End sidebar-wrapper-->

  <!--Start topbar header-->
  <header class="topbar-nav">
    <nav class="navbar navbar-expand fixed-top">
      <ul class="navbar-nav mr-auto align-items-center">
        <li class="nav-item">
          <a class="nav-link toggle-menu" href="javascript:void();">
            <i class="icon-menu menu-icon" style="color: var(--color-azul);"></i>
          </a>
        </li>
        <li class="nav-item">
          <h4 class="welcome-message">Bienvenido <?php echo $_SESSION["nombre"]." ".$_SESSION["apellido"]; ?></h4>
        </li>
      </ul>

      <ul class="navbar-nav align-items-center right-nav-link">
        <a class="btn btn-outline-danger" href="controlador/controlador_cerrar_sesion.php">
          <i class="fa fa-power-off" aria-hidden="true"></i> Salir
        </a>
        
        <li class="nav-item">
          <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
            <span class="user-profile"><img src="assets/images/user-avatar.png" class="img-circle" alt="user avatar"></span>
          </a>
          <ul class="dropdown-menu dropdown-menu-right">
            <li class="dropdown-item user-details">
              <a href="javaScript:void();">
                <div class="media">
                  <div class="avatar"><img class="align-self-start mr-3" src="assets/images/user-avatar.png" alt="user avatar"></div>
                  <div class="media-body">
                    <h6 class="mt-2 user-title"><?php echo $_SESSION["nombre"]." ".$_SESSION["apellido"]; ?></h6>
                    <p class="user-subtitle"><?php echo $_SESSION["email"]; ?></p>
                  </div>
                </div>
              </a>
            </li>
            <li class="dropdown-divider"></li>
            <li class="dropdown-item"><i class="icon-settings mr-2"></i> Configuración</li>
            <li class="dropdown-divider"></li>
            <li class="dropdown-item"><i class="icon-power mr-2"></i> Cerrar sesión</li>
          </ul>
        </li>
      </ul>
    </nav>
  </header>
  <!--End topbar header-->

  <div class="clearfix"></div>

  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Encabezado principal -->
      <div class="main-header">
        <div class="logo-container">
          <img src="assets/images/logon.png" alt="Logo Alcaldía" class="highlight-lines">
        </div>
        <h2>ALCALDÍA DE TELPANECA</h2>
        <h1>Sistema de control de cobros de agua potable</h1>
        <hr class="header-line">
      </div>

      <!-- Tarjetas de estadísticas -->
      <div class="row">
        <div class="col-12 col-lg-6 col-xl-3">
          <div class="card stats-card bg-primary">
            <div class="card-body">
              <?php
              include 'config.php';
              $sql = "SELECT COUNT(*) AS total_contribuyentes FROM contribuyentes";
              $resultado = $conn->query($sql);
              if ($resultado) {
                  $fila = $resultado->fetch_assoc();
                  $total_contribuyentes = $fila['total_contribuyentes'];
                  $porcentaje = ($total_contribuyentes / 1000) * 100;
                  echo '<h5 class="text-white mb-0">'.$total_contribuyentes.' <span class="float-right"><i class="fas fa-users"></i></span></h5>';
                  echo '<div class="progress my-3" style="height:6px;">
                          <div class="progress-bar bg-white" style="width:'.$porcentaje.'%"></div>
                      </div>';
                  echo '<p class="mb-0 text-white small-font">Contribuyentes <span class="float-right">+'.number_format($porcentaje,2).'% <i class="fas fa-arrow-up"></i></span></p>';
              }
              $conn->close();
              ?>
            </div>
          </div>
        </div>

        <div class="col-12 col-lg-6 col-xl-3">
          <div class="card stats-card bg-success">
            <div class="card-body">
              <?php
              include 'config.php';
              $sql = "SELECT COUNT(*) AS total_tipos_servicios FROM tipos_de_servicio";
              $resultado = $conn->query($sql);
              if ($resultado) {
                  $fila = $resultado->fetch_assoc();
                  $totalTiposServicios = $fila['total_tipos_servicios'];
                  $porcentaje = ($totalTiposServicios / 100) * 100;
                  echo '<h5 class="text-white mb-0">'.$totalTiposServicios.' <span class="float-right"><i class="fas fa-list"></i></span></h5>';
                  echo '<div class="progress my-3" style="height:6px;">
                          <div class="progress-bar bg-white" style="width:'.$porcentaje.'%"></div>
                      </div>';
                  echo '<p class="mb-0 text-white small-font">Categorías de servicio <span class="float-right">+'.number_format($porcentaje,2).'% <i class="fas fa-arrow-up"></i></span></p>';
              }
              $conn->close();
              ?>
            </div>
          </div>
        </div>

        <div class="col-12 col-lg-6 col-xl-3">
          <div class="card stats-card bg-info">
            <div class="card-body">
              <?php
              include 'config.php';
              $sql = "SELECT COUNT(*) AS total_domicilios_activos FROM domicilios WHERE estatus = 'Activo'";
              $resultado = $conn->query($sql);
              if ($resultado) {
                  $fila = $resultado->fetch_assoc();
                  $totalDomiciliosActivos = $fila['total_domicilios_activos'];
                  $sqlTotal = "SELECT COUNT(*) AS total FROM domicilios";
                  $resultTotal = $conn->query($sqlTotal);
                  $total = $resultTotal->fetch_assoc()['total'];
                  $porcentaje = ($totalDomiciliosActivos / $total) * 100;
                  echo '<h5 class="text-white mb-0">'.$totalDomiciliosActivos.' <span class="float-right"><i class="fas fa-eye"></i></span></h5>';
                  echo '<div class="progress my-3" style="height:6px;">
                          <div class="progress-bar bg-white" style="width:'.$porcentaje.'%"></div>
                      </div>';
                  echo '<p class="mb-0 text-white small-font">Tomas Activas <span class="float-right">+'.number_format($porcentaje,2).'% <i class="fas fa-arrow-up"></i></span></p>';
              }
              $conn->close();
              ?>
            </div>
          </div>
        </div>

        <div class="col-12 col-lg-6 col-xl-3">
          <div class="card stats-card bg-warning">
            <div class="card-body">
              <?php
              include 'config.php';
              $sql = "SELECT COUNT(*) AS total_domicilios_baja FROM domicilios WHERE estatus = 'Baja'";
              $resultado = $conn->query($sql);
              if ($resultado) {
                  $fila = $resultado->fetch_assoc();
                  $totalDomiciliosBaja = $fila['total_domicilios_baja'];
                  $sqlTotal = "SELECT COUNT(*) AS total FROM domicilios";
                  $resultTotal = $conn->query($sqlTotal);
                  $total = $resultTotal->fetch_assoc()['total'];
                  $porcentaje = ($totalDomiciliosBaja / $total) * 100;
                  echo '<h5 class="text-white mb-0">'.$totalDomiciliosBaja.' <span class="float-right"><i class="fas fa-exclamation-triangle"></i></span></h5>';
                  echo '<div class="progress my-3" style="height:6px;">
                          <div class="progress-bar bg-white" style="width:'.$porcentaje.'%"></div>
                      </div>';
                  echo '<p class="mb-0 text-white small-font">Tomas Inactivas <span class="float-right">+'.number_format($porcentaje,2).'% <i class="fas fa-arrow-up"></i></span></p>';
              }
              $conn->close();
              ?>
            </div>
          </div>
        </div>

        <div class="col-12">
          <div class="card stats-card bg-danger">
            <div class="card-body">
              <?php
              include 'config.php';
              $sql = "SELECT SUM(monto_del_pago) AS total_pagos FROM pagos";
              $resultado = $conn->query($sql);
              if ($resultado) {
                  $fila = $resultado->fetch_assoc();
                  $total_pagos = $fila['total_pagos'];
                  $valor_maximo = 1281600;
                  $porcentaje = ($total_pagos / $valor_maximo) * 100;
                  echo '<h5 class="text-white mb-0">$'.number_format($total_pagos,2).' <span class="float-right"><i class="fas fa-dollar-sign"></i></span></h5>';
                  echo '<div class="progress my-3" style="height:10px;">
                          <div class="progress-bar bg-white" style="width:'.$porcentaje.'%"></div>
                      </div>';
                  echo '<p class="mb-0 text-white small-font">Total Recaudado <span class="float-right">+'.number_format($porcentaje,2).'% <i class="fas fa-arrow-up"></i></span></p>';
              }
              $conn->close();
              ?>
            </div>
          </div>
        </div>
      </div>

      <!-- Gráfico de pagos por mes -->
      <div class="card chart-card">
        <div class="card-header">Pagos por Mes</div>
        <div class="card-body">
          <?php
          include 'config.php';
          $yearsQuery = "SELECT DISTINCT YEAR(fecha_de_emision) AS anio FROM reportes ORDER BY anio";
          $yearsResult = $conn->query($yearsQuery);
          $availableYears = [];
          while ($yearRow = $yearsResult->fetch_assoc()) {
              $availableYears[] = $yearRow['anio'];
          }
          $selectedYear = isset($_POST['year']) ? $_POST['year'] : (count($availableYears) > 0 ? $availableYears[0] : null);
          $query = "SELECT YEAR(fecha_de_emision) AS anio, MONTH(fecha_de_emision) AS mes, SUM(monto_del_pago) AS total_pago 
                    FROM reportes 
                    WHERE YEAR(fecha_de_emision) = $selectedYear
                    GROUP BY anio, mes 
                    ORDER BY anio, mes";
          $result = $conn->query($query);
          $labels = [];
          $data = [];
          $totalPago = 0;
          while ($row = $result->fetch_assoc()) {
              $mes = date('F', mktime(0, 0, 0, $row['mes'], 1));
              $mes_spanish = traducirMes($mes);
              $labels[] = $mes_spanish . ' ' . $row['anio'];
              $data[] = $row['total_pago'];
              $totalPago += $row['total_pago'];
          }
          function traducirMes($mes) {
              $meses = [
                  'January' => 'Enero', 'February' => 'Febrero', 'March' => 'Marzo',
                  'April' => 'Abril', 'May' => 'Mayo', 'June' => 'Junio',
                  'July' => 'Julio', 'August' => 'Agosto', 'September' => 'Septiembre',
                  'October' => 'Octubre', 'November' => 'Noviembre', 'December' => 'Diciembre'
              ];
              return $meses[$mes];
          }
          ?>
          <div class="filter-form">
            <form method="post">
              <label for="year">Seleccione un año:</label>
              <select name="year" id="year" class="form-control" style="width: auto; display: inline-block;">
                  <?php foreach ($availableYears as $year) : ?>
                      <option value="<?php echo $year; ?>" <?php echo ($year == $selectedYear) ? 'selected' : ''; ?>><?php echo $year; ?></option>
                  <?php endforeach; ?>
              </select>
              <button type="submit" class="btn btn-dark">Filtrar</button>
            </form>
          </div>
          <div>
            <h5 class="text-center">TOTAL RECAUDADO: $<?php echo number_format($totalPago, 2); ?></h5>
          </div>
          <div class="chart-container">
            <canvas id="barChart"></canvas>
          </div>
          <script>
            var ctx = document.getElementById('barChart').getContext('2d');
            var barChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode($labels); ?>,
                    datasets: [{
                        label: 'Total Pagado',
                        data: <?php echo json_encode($data); ?>,
                        backgroundColor: 'rgba(48, 107, 169, 0.7)',
                        borderColor: 'rgba(48, 107, 169, 1)',
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return '$' + value.toLocaleString();
                                }
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    var label = context.dataset.label || '';
                                    if (label) label += ': ';
                                    label += '$' + context.raw.toLocaleString();
                                    return label;
                                }
                            }
                        }
                    }
                }
            });
          </script>
        </div>
      </div>

      <!-- Gráfico de pagos por día -->
      <div class="card chart-card">
        <div class="card-header">Pagos por Día</div>
        <div class="card-body">
          <?php
          include 'config.php';
          $conn->query("SET lc_time_names = 'es_MX'");
          $yearsQuery = "SELECT DISTINCT YEAR(fecha_de_emision) AS anio FROM reportes ORDER BY anio";
          $yearsResult = $conn->query($yearsQuery);
          $availableYears = [];
          while ($yearRow = $yearsResult->fetch_assoc()) {
              $availableYears[] = $yearRow['anio'];
          }
          $currentYear = date('Y');
          $currentMonth = date('n');
          $selectedYear = isset($_POST['selectedYear']) ? $_POST['selectedYear'] : $currentYear;
          $selectedMonth = isset($_POST['selectedMonth']) ? $_POST['selectedMonth'] : $currentMonth;
          $query = "SELECT DATE_FORMAT(fecha_de_emision, '%d de %M de %Y') AS formattedDate, SUM(monto_del_pago) AS totalPago 
                    FROM reportes 
                    WHERE YEAR(fecha_de_emision) = $selectedYear
                    AND MONTH(fecha_de_emision) = $selectedMonth
                    GROUP BY formattedDate 
                    ORDER BY formattedDate";
          $result = $conn->query($query);
          $labels = [];
          $data = [];
          $totalPago = 0;
          while ($row = $result->fetch_assoc()) {
          $labels[] = mb_convert_encoding($row['formattedDate'], 'UTF-8', 'ISO-8859-1');
          $data[] = $row['totalPago'];
        $totalPago += $row['totalPago'];
          }
          $totalGlobalQuery = "SELECT SUM(monto_del_pago) AS totalGlobal 
                               FROM reportes 
                               WHERE YEAR(fecha_de_emision) = $selectedYear
                               AND MONTH(fecha_de_emision) = $selectedMonth";
          $totalGlobalResult = $conn->query($totalGlobalQuery);
          $totalGlobalRow = $totalGlobalResult->fetch_assoc();
          $totalGlobal = $totalGlobalRow['totalGlobal'];
          ?>
          <div class="filter-form">
            <form method="post">
              <label for="selectedYear">Año:</label>
              <select name="selectedYear" id="selectedYear" class="form-control" style="width: auto; display: inline-block;">
                  <?php foreach ($availableYears as $year) : ?>
                      <option value="<?php echo $year; ?>" <?php echo ($year == $selectedYear) ? 'selected' : ''; ?>><?php echo $year; ?></option>
                  <?php endforeach; ?>
              </select>
              
              <label for="selectedMonth">Mes:</label>
              <select name="selectedMonth" id="selectedMonth" class="form-control" style="width: auto; display: inline-block;">
                  <?php for ($i = 1; $i <= 12; $i++) : ?>
                      <option value="<?php echo $i; ?>" <?php echo ($i == $selectedMonth) ? 'selected' : ''; ?>><?php echo traducirMes(date('F', mktime(0, 0, 0, $i, 1))); ?></option>
                  <?php endfor; ?>
              </select>
              
              <button type="submit" class="btn btn-dark">Filtrar</button>
            </form>
          </div>
          <div>
            <h5 class="text-center">TOTAL DEL MES: $<?php echo number_format($totalGlobal ?? 0, 2); ?></h5>
          </div>
          <div class="chart-container">
            <canvas id="barChartDay"></canvas>
          </div>
          <script>
            var ctx = document.getElementById('barChartDay').getContext('2d');
            var barColors = Array(<?php echo count($labels); ?>).fill('rgba(48, 107, 169, 0.7)');
            
            var barChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode(array_merge($labels, ['Total Mes'])); ?>,
                    datasets: [{
                        label: 'Total Pagado',
                        data: <?php echo json_encode(array_merge($data, [$totalGlobal])); ?>,
                        backgroundColor: barColors.concat(['rgba(231, 109, 43, 0.7)']),
                        borderColor: barColors.concat(['rgba(231, 109, 43, 1)']),
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return '$' + value.toLocaleString();
                                }
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    var label = context.dataset.label || '';
                                    if (label) label += ': ';
                                    label += '$' + context.raw.toLocaleString();
                                    return label;
                                }
                            }
                        }
                    }
                }
            });
          </script>
        </div>
      </div>

      <!-- Tabla de pagos por fecha -->
      <div class="card chart-card">
        <div class="card-header">Detalle de Pagos</div>
        <div class="card-body">
          <?php
          include 'config.php';
          if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['fechaFiltro'])) {
              $fechaFiltro = $_POST['fechaFiltro'];
              echo "<h5>Lista de pagos para el $fechaFiltro</h5>";
              $query = "SELECT * FROM reportes WHERE DATE(fecha_de_emision) = '$fechaFiltro'";
              $result = mysqli_query($conn, $query);
          } else {
              $fechaFiltro = date('Y-m-d');
          }
          ?>
          <div class="filter-form">
            <form method="post" action="">
              <label for="fechaFiltro">Filtrar por fecha:</label>
              <input type="date" id="fechaFiltro" name="fechaFiltro" value="<?php echo $fechaFiltro; ?>" class="form-control" style="width: auto; display: inline-block;">
              <button type="submit" class="btn btn-dark">Filtrar</button>
            </form>
          </div>
          
          <?php
          if (isset($result) && mysqli_num_rows($result) > 0) {
              echo '<div class="table-responsive">';
              echo '<table class="table">';
              echo '<thead><tr>
                      <th>ID Reporte</th>
                      <th>ID Pago</th>
                      <th>ID Domicilio</th>
                      <th>Fecha</th>
                      <th>Meses</th>
                      <th>Monto</th>
                    </tr></thead>';
              echo '<tbody>';
              
              $totalMonto = 0;
              while ($row = mysqli_fetch_assoc($result)) {
                  echo '<tr>
                          <td>'.$row['id_reporte'].'</td>
                          <td>'.$row['id_pago'].'</td>
                          <td>'.$row['id_domicilio'].'</td>
                          <td>'.$row['fecha_de_emision'].'</td>
                          <td>'.$row['meses_pagados'].'</td>
                          <td>$'.number_format($row['monto_del_pago'],2).'</td>
                        </tr>';
                  $totalMonto += $row['monto_del_pago'];
              }
              
              echo '<tr class="table-active">
                      <td colspan="5"><strong>Total</strong></td>
                      <td><strong>$'.number_format($totalMonto,2).'</strong></td>
                    </tr>';
              echo '</tbody></table></div>';
          } else {
              echo '<p class="text-center">No hay pagos registrados en la fecha seleccionada.</p>';
          }
          mysqli_close($conn);
          ?>
        </div>
      </div>
      
    </div>
    <!-- End container-fluid-->
  </div>
  <!--End content-wrapper-->

  <!--Start Back To Top Button-->
  <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i></a>
  <!--End Back To Top Button-->

  <!-- Bootstrap core JavaScript-->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  
  <!-- simplebar js -->
  <script src="assets/plugins/simplebar/js/simplebar.js"></script>
  <!-- sidebar-menu js -->
  <script src="assets/js/sidebar-menu.js"></script>
  <!-- Custom scripts -->
  <script src="assets/js/app-script.js"></script>
  
</body>
</html>