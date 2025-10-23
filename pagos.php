
<?php
session_start();
if (empty($_SESSION["id"])){
  header("location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>Dashtreme Admin - Free Dashboard for Bootstrap 4 by Codervent</title>
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
    

  <h4>Bienvenido <?php

echo $_SESSION["nombre"]." ".$_SESSION["apellido"];

?></h4>
  </ul>

  <ul class="navbar-nav align-items-center right-nav-link">
  <a class="btn btn-outline-danger" href="controlador/controlador_cerrar_sesion.php">Salir
      <i class="fa fa-power-off" aria-hidden="true"></i>
       </a>
    <li class="nav-item dropdown-lg">
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="javascript:void();">
      <i class="fa fa-envelope-open-o"></i></a>
    </li>
    <li class="nav-item dropdown-lg">
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="javascript:void();">
      <i class="fa fa-bell-o"></i></a>
    </li>
    <li class="nav-item language">
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="javascript:void();"><i class="fa fa-flag"></i></a>
      <ul class="dropdown-menu dropdown-menu-right">
          <li class="dropdown-item"> <i class="flag-icon flag-icon-gb mr-2"></i> English</li>
          <li class="dropdown-item"> <i class="flag-icon flag-icon-fr mr-2"></i> French</li>
          <li class="dropdown-item"> <i class="flag-icon flag-icon-cn mr-2"></i> Chinese</li>
          <li class="dropdown-item"> <i class="flag-icon flag-icon-de mr-2"></i> German</li>
        </ul>
    </li>
    <li class="nav-item">
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
        <span class="user-profile"><img src="https://via.placeholder.com/110x110" class="img-circle" alt="user avatar"></span>
      </a>
      <ul class="dropdown-menu dropdown-menu-right">
       <li class="dropdown-item user-details">
        <a href="javaScript:void();">
           <div class="media">
             <div class="avatar"><img class="align-self-start mr-3" src="https://via.placeholder.com/110x110" alt="user avatar"></div>
            <div class="media-body">
            <h6 class="mt-2 user-title">Sarajhon Mccoy</h6>
            <p class="user-subtitle">mccoy@example.com</p>
            </div>
           </div>
          </a>
        </li>
        <li class="dropdown-divider"></li>
        <li class="dropdown-item"><i class="icon-envelope mr-2"></i> Inbox</li>
        <li class="dropdown-divider"></li>
        <li class="dropdown-item"><i class="icon-wallet mr-2"></i> Account</li>
        <li class="dropdown-divider"></li>
        <li class="dropdown-item"><i class="icon-settings mr-2"></i> Setting</li>
        <li class="dropdown-divider"></li>
        <li class="dropdown-item"><i class="icon-power mr-2"></i> Logout</li>
      </ul>
    </li>
  </ul>
</nav>
</header>
<!--End topbar header-->


<div class="clearfix"></div>

<div class="content-wrapper">
  <div class="container-fluid">
    <br>
    <br>
    <div>


		</div>
    <br>
    
    <h2>MESES PAGADOS Y REPORTES</h2>
<hr>
  <label for="search">Buscar:</label>

    <div class="row mt-3">
      <div class="col-lg-12">
        <div class="card">
        <input type="text" id="searchInput" onkeyup="handleSearch()" placeholder="Escriba nombre o apellido" class="form-control" style="border: 2px solid #FCFCFC;">
<br>
          <main>
            <div class="table-responsive">
              <table id="contribuyentesTable" class="table table-sm table-bordered table-striped table-hover">
              <?php
require 'config.php';

// Definir el año y la cantidad de meses por defecto
$selected_year = date("Y");
$selected_month_count = 12; // Mostrar todos los meses por defecto

// Verificar si se ha enviado el formulario y se han proporcionado el año y la cantidad de meses
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["selected_year"]) && isset($_POST["selected_month_count"])) {
    $selected_year = $_POST["selected_year"];
    $selected_month_count = $_POST["selected_month_count"];
}

// Consulta SQL para obtener la lista de servicios con información de contribuyentes
$sql = "SELECT d.`id_domicilio`, d.`id_contribuyente`, c.`nombre`, c.`apellido`, d.`estatus` FROM `domicilios` d
        LEFT JOIN `contribuyentes` c ON d.`id_contribuyente` = c.`id_contribuyente`";
$result = $conn->query($sql);

// Verificar si la consulta fue exitosa
if ($result->num_rows > 0) {
    // Mostrar el formulario para introducir manualmente el año y la cantidad de meses
    
    echo '<form method="post" action="">';
    echo '<label for="selected_year">Ingrese el año:</label>';
    echo '<input type="number" name="selected_year" value="' . $selected_year . '" min="2024" max="2050" required>';

    echo '<label for="selected_month_count">Cantidad de meses:</label>';
    echo '<select name="selected_month_count" required>';
    for ($i = 1; $i <= 12; $i++) {
        echo '<option value="' . $i . '" ' . ($i == $selected_month_count ? 'selected' : '') . '>' . $i . '</option>';
    }
    echo '</select>';
    echo '<button type="submit" name="filter">Filtrar</button>';
    echo '</form>';
    echo '<br>';
    echo '<br>';

    // Botón para descargar el archivo Excel
    echo '<form method="post" action="./includes/excel.php">';
    echo '<input type="hidden" name="selected_year" value="' . $selected_year . '">';
    echo '<button class="btn btn-success" type="submit" name="download_excel">Descargar Excel <i class="fa fa-table" aria-hidden="true"></i></button>';
    echo '</form>';

    echo '<br>';
    echo '<br>';

    echo '<table id="contribuyentesTable" class="table table-sm table-bordered table-striped table-hover">';
    echo '<thead>';
    echo '<tr>';
    echo '<th class="sort asc" style="color: white; background-color: #212121;">id_dom</th>';
    echo '<th class="sort asc" style="color: white; background-color: #212121;">Nombres</th>';

    // Imprimir las cabeceras de las columnas de meses
    for ($mes = 1; $mes <= $selected_month_count; $mes++) {
        echo '<th class="sort asc" style="color: black; background-color: #CCCCCC;">' . obtenerNombreMes($mes) . '</th>';
    }

    // Nueva cabecera para el total de meses pagados
    echo '<th class="sort asc" style="color: black; background-color: #CCCCCC;">Pagados</th>';
    echo '<th class="sort asc" style="color: black; background-color: #CCCCCC;">Estado</th>'; // Nueva cabecera para el estado del domicilio
    echo '<th class="sort asc" style="color: black; background-color: #CCCCCC;">Genere_Reporte</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    while ($row = $result->fetch_assoc()) {
        $id_domicilio = $row["id_domicilio"];
        $id_contribuyente = $row["id_contribuyente"];
        $nombre = $row["nombre"];
        $apellido = $row["apellido"];
        $estatus = $row["estatus"];

        // Consulta SQL para obtener las fechas de todos los pagos para el id_domicilio
        $pagos_sql = "SELECT `mes_inicio`, `mes_fin` FROM `pagos` WHERE `id_domicilio` = $id_domicilio";
        $pagos_result = $conn->query($pagos_sql);

        $meses_pagados = [];

        // Verificar si hay pagos para el id_domicilio
        if ($pagos_result->num_rows > 0) {
            while ($pago = $pagos_result->fetch_assoc()) {
                $mes_inicio_pago = new DateTime($pago["mes_inicio"]);
                $mes_fin_pago = new DateTime($pago["mes_fin"]);

                // Verificar si el rango de fechas del pago intersecta con el año seleccionado
                if ($mes_inicio_pago->format('Y') <= $selected_year && $mes_fin_pago->format('Y') >= $selected_year) {
                    // Obtener los meses pagados en el rango de fechas del pago para el año seleccionado
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

        // Verificar si el estatus es "Baja" para aplicar el estilo rojo a toda la fila
        $row_style = ($estatus == "Baja") ? 'style="background-color: red;"' : '';

        echo '<tr class="searchable-row" ' . $row_style . '>';
        echo '<td>' . $id_domicilio . '</td>';
        echo '<td>' . $nombre . ' ' . $apellido . '</td>';

        // Imprimir las columnas con palomita para los meses pagados
        for ($mes = 1; $mes <= $selected_month_count; $mes++) {
            $mes_actual = sprintf('%04d-%02d', $selected_year, $mes);
            echo '<td>' . (in_array($mes_actual, $meses_pagados) ? '<img src="assets/images/com.png" alt="Pagado">' : '') . '</td>';
        }

        // Imprimir la celda con el total de meses pagados y cambiar el color de fondo según la cantidad de meses pagados
        $pagados_count = count($meses_pagados);
        $bg_color = 'white'; // color de fondo predeterminado

        if ($pagados_count > 6) {
          $bg_color = '#2C9104'; // verde si hay más de 6 meses pagados
      } elseif ($pagados_count >= 3 && $pagados_count <= 6) {
          $bg_color = '#B8D82C'; // amarillo si hay entre 3 y 6 meses pagados
      } elseif ($pagados_count <= 3) {
          $bg_color = '#A41400'; // rojo si hay 3 o menos meses pagados
      }
        echo '<td style="background-color: ' . $bg_color . ';">' . $pagados_count . '</td>';
        // Imprimir la celda con el estado del domicilio
        echo '<td>' . $estatus . '</td>';

        // Agregar condición para descargar el PDF solo si el estado no es "Baja"
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

// Cerrar la conexión
$conn->close();

// Función para obtener el nombre del mes según su número
function obtenerNombreMes($numeroMes) {
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



    <!-- Bootstrap core JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

      </div>
    </div>
    </div><!--End Row-->

   <!--start overlay-->
		  <div class="overlay toggle-menu"></div>
		<!--end overlay-->
  
    </div>
    <!-- End container-fluid-->
    
    </div><!--End content-wrapper-->
   <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
	
	  <!--Start footer-->
	
    
	<!--End footer-->
	
	<!--start color switcher-->
   <div class="right-sidebar">
    <div class="switcher-icon">
      <i class="zmdi zmdi-settings zmdi-hc-spin"></i>
    </div>
    <div class="right-sidebar-content">

      <p class="mb-0">Gaussion Texture</p>
      <hr>
      
      <ul class="switcher">
        <li id="theme1"></li>
        <li id="theme2"></li>
        <li id="theme3"></li>
        <li id="theme4"></li>
        <li id="theme5"></li>
        <li id="theme6"></li>
      </ul>

      <p class="mb-0">Gradient Background</p>
      <hr>
      
      <ul class="switcher">
        <li id="theme7"></li>
        <li id="theme8"></li>
        <li id="theme9"></li>
        <li id="theme10"></li>
        <li id="theme11"></li>
        <li id="theme12"></li>
		<li id="theme13"></li>
        <li id="theme14"></li>
        <li id="theme15"></li>
      </ul>
      
     </div>
   </div>
  <!--end color switcher-->
   
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

      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
  $(document).ready(function() {
    $('#searchInput').keyup(function() {
      var searchText = $(this).val().toLowerCase();

      // Oculta todas las filas
      $('.searchable-row').hide();

      // Filtra las filas que coinciden con la búsqueda
      $('.searchable-row').filter(function() {
        return $(this).text().toLowerCase().indexOf(searchText) > -1;
      }).show();
    });
  });
</script>

<!-- Agrega este script al final del cuerpo de tu página HTML -->
<script>
  function realizarBusqueda() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("search");
    filter = input.value.toUpperCase();
    table = document.getElementById("contribuyentesTable");
    tr = table.getElementsByTagName("tr");

    // Iterar sobre cada fila de la tabla y ocultar/mostrar según la búsqueda
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[1]; // La columna de nombres y apellidos es la segunda columna (índice 1)
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }
    }
  }
</script>


<style>
  /* Estilo para la fila de botones y nombres de columnas */
  .fixed-header {
    position: sticky;
    top: 0;
    z-index: 1;
    background-color: #FFFFFF; /* Ajusta el color de fondo según tus preferencias */
  }

  /* Estilo para la tabla con desplazamiento vertical */
  .table-container {
    max-height: 500px; /* Ajusta la altura máxima según tus preferencias */
    overflow-y: auto;
  }
</style>

</body>
</html>