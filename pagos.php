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
  <title>SISCATEL - Pagos</title>
  <!-- loader-->
  <link href="assets/css/pace.min.css" rel="stylesheet"/>
  <script src="assets/js/pace.min.js"></script>
  <!--favicon-->
  <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
  <!-- simplebar CSS-->
  <link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet"/>
  <!-- Bootstrap core CSS-->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet"/>
  <!-- animate CSS-->
  <link href="assets/css/animate.css" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="assets/css/icons.css" rel="stylesheet" type="text/css"/>
  <!-- Sidebar CSS-->
  <link href="assets/css/sidebar-menu.css" rel="stylesheet"/>
  <!-- Custom Style-->
  <link href="assets/css/app-style.css" rel="stylesheet"/>
  
</head>

<body class="bg-theme bg-theme1">

<!-- start loader -->
   <div id="pageloader-overlay" class="visible incoming"><div class="loader-wrapper-outer"><div class="loader-wrapper-inner" ><div class="loader"></div></div></div></div>
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
       <i class="icon-menu menu-icon"></i>
     </a>
    </li>
    <li class="nav-item">
      <h4 class="welcome-message">Bienvenido <?php echo $_SESSION["nombre"]." ".$_SESSION["apellido"]; ?></h4>
    </li>
  </ul>
</nav>
</header>
<!--End topbar header-->

<div class="clearfix"></div>

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h2 class="text-uppercase">Meses Pagados y Reportes</h2>
                </div>
                <hr>
                <div class="form-group">
                    <label for="searchInput">Buscar:</label>
                    <input type="text" id="searchInput" onkeyup="handleSearch()" placeholder="Escriba nombre o apellido" class="form-control">
                </div>
                <div class="row mt-3">
                    <div class="col-lg-12">
                        <main>
                            <div class="table-responsive">
                                <table id="contribuyentesTable" class="table table-sm table-bordered table-striped table-hover">
                                    <?php
                                    require 'config.php';

                                    $selected_year = date("Y");
                                    $selected_month_count = 12;

                                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["selected_year"]) && isset($_POST["selected_month_count"])) {
                                        $selected_year = $_POST["selected_year"];
                                        $selected_month_count = $_POST["selected_month_count"];
                                    }

                                    $sql = "SELECT d.`id_domicilio`, d.`id_contribuyente`, c.`nombre`, c.`apellido`, d.`estatus` FROM `domicilios` d
                                            LEFT JOIN `contribuyentes` c ON d.`id_contribuyente` = c.`id_contribuyente`";
                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        echo '<form method="post" action="">';
                                        echo '<div class="form-row align-items-center">';
                                        echo '<div class="col-auto">';
                                        echo '<label for="selected_year">Año:</label>';
                                        echo '<input type="number" name="selected_year" class="form-control" value="' . $selected_year . '" min="2024" max="2050" required>';
                                        echo '</div>';
                                        echo '<div class="col-auto">';
                                        echo '<label for="selected_month_count">Meses:</label>';
                                        echo '<select name="selected_month_count" class="form-control" required>';
                                        for ($i = 1; $i <= 12; $i++) {
                                            echo '<option value="' . $i . '" ' . ($i == $selected_month_count ? 'selected' : '') . '>' . $i . '</option>';
                                        }
                                        echo '</select>';
                                        echo '</div>';
                                        echo '<div class="col-auto">';
                                        echo '<button type="submit" name="filter" class="btn btn-primary mt-4">Filtrar</button>';
                                        echo '</div>';
                                        echo '</div>';
                                        echo '</form>';
                                        echo '<br>';

                                        echo '<form method="post" action="./includes/excel.php">';
                                        echo '<input type="hidden" name="selected_year" value="' . $selected_year . '">';
                                        echo '<button class="btn btn-success" type="submit" name="download_excel">Descargar Excel <i class="fa fa-table" aria-hidden="true"></i></button>';
                                        echo '</form>';
                                        echo '<br>';

                                        echo '<table id="contribuyentesTable" class="table table-sm table-bordered table-striped table-hover">';
                                        echo '<thead>';
                                        echo '<tr>';
                                        echo '<th>ID Domicilio</th>';
                                        echo '<th>Nombres</th>';

                                        for ($mes = 1; $mes <= $selected_month_count; $mes++) {
                                            echo '<th>' . obtenerNombreMes($mes) . '</th>';
                                        }

                                        echo '<th>Pagados</th>';
                                        echo '<th>Estado</th>';
                                        echo '<th>Generar Reporte</th>';
                                        echo '</tr>';
                                        echo '</thead>';
                                        echo '<tbody>';

                                        while ($row = $result->fetch_assoc()) {
                                            $id_domicilio = $row["id_domicilio"];
                                            $nombre = $row["nombre"];
                                            $apellido = $row["apellido"];
                                            $estatus = $row["estatus"];

                                            $pagos_sql = "SELECT `mes_inicio`, `mes_fin` FROM `pagos` WHERE `id_domicilio` = $id_domicilio";
                                            $pagos_result = $conn->query($pagos_sql);

                                            $meses_pagados = [];

                                            if ($pagos_result->num_rows > 0) {
                                                while ($pago = $pagos_result->fetch_assoc()) {
                                                    $mes_inicio_pago = new DateTime($pago["mes_inicio"]);
                                                    $mes_fin_pago = new DateTime($pago["mes_fin"]);

                                                    if ($mes_inicio_pago->format('Y') <= $selected_year && $mes_fin_pago->format('Y') >= $selected_year) {
                                                        $mes_actual = clone $mes_inicio_pago;
                                                        while ($mes_actual <= $mes_fin_pago) {
                                                            if ($mes_actual->format('Y') == $selected_year && count($meses_pagados) < $selected_month_count) {
                                                                $meses_pagados[] = $mes_actual->format('Y-m');
                                                            }
                                                            $mes_actual->add(new DateInterval('P1M'));
                                                        }
                                                    }
                                                }
                                            }

                                            $row_style = ($estatus == "Baja") ? 'style="background-color: #dc3545;"' : '';

                                            echo '<tr class="searchable-row" ' . $row_style . '>';
                                            echo '<td>' . $id_domicilio . '</td>';
                                            echo '<td>' . $nombre . ' ' . $apellido . '</td>';

                                            for ($mes = 1; $mes <= $selected_month_count; $mes++) {
                                                $mes_actual = sprintf('%04d-%02d', $selected_year, $mes);
                                                echo '<td>' . (in_array($mes_actual, $meses_pagados) ? '<img src="assets/images/com.png" alt="Pagado">' : '') . '</td>';
                                            }

                                            $pagados_count = count($meses_pagados);
                                            $bg_color = 'white';

                                            if ($pagados_count > 6) {
                                                $bg_color = '#28a745';
                                            } elseif ($pagados_count >= 3 && $pagados_count <= 6) {
                                                $bg_color = '#fd7e14';
                                            } elseif ($pagados_count <= 3) {
                                                $bg_color = '#dc3545';
                                            }
                                            echo '<td style="background-color: ' . $bg_color . ';">' . $pagados_count . '</td>';
                                            echo '<td>' . $estatus . '</td>';

                                            if ($estatus != "Baja") {
                                                echo '<td><a href="generar_reporte.php?id=' . $id_domicilio . '&year=' . $selected_year . '" target="_blank"><img src="assets/images/pdf.png" alt="Generar Reporte PDF"></a></td>';
                                            } else {
                                                echo '<td>Estado: Baja - Sin reporte</td>';
                                            }

                                            echo '</tr>';
                                        }
                                        echo '</tbody>';
                                        echo '</table>';
                                    } else {
                                        echo "<tr><td colspan='14'>No se encontraron resultados</td></tr>";
                                    }

                                    $conn->close();

                                    function obtenerNombreMes($numeroMes)
                                    {
                                        $nombreMeses = [
                                            'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sept', 'Oct', 'Nov', 'Dic'
                                        ];

                                        return $nombreMeses[$numeroMes - 1];
                                    }
                                    ?>
                                </table>
                            </div>
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End content-wrapper-->
<!--Start Back To Top Button-->
<a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
<!--End Back To Top Button-->

</div><!--End wrapper-->


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
<script>
  function handleSearch() {
    var searchText = document.getElementById('searchInput').value.toLowerCase();
    var rows = document.querySelectorAll('.searchable-row');

    rows.forEach(function(row) {
      var text = row.textContent.toLowerCase();
      if (text.indexOf(searchText) > -1) {
        row.style.display = '';
      } else {
        row.style.display = 'none';
      }
    });
  }
</script>

</body>
</html>