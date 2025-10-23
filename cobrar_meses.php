  <!-- pagina pagos.copy.php-->
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
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>COBRAR</title>
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


 <body>
<div class="clearfix"></div>
	
  <div class="content-wrapper">
    <div class="container-fluid">
      
      <br>
      <h2 style="color: #108019;">COBRAR MESES DE CONTRIBUYENTE</h2>

    <br>


    <?php
require 'config.php';

// Recupera el id_domicilio de la URL
$id_domicilio = $_GET['id_domicilio'];

// Consulta para obtener la información del contribuyente, domicilio y tipo de servicio
$sql = "SELECT c.*, d.*, t.descripcion, t.precio
FROM contribuyentes c
JOIN domicilios d ON c.id_contribuyente = d.id_contribuyente
LEFT JOIN tipos_de_servicio t ON d.id_tipo_de_servicio = t.id_tipo_de_servicio
WHERE d.id_domicilio = $id_domicilio
";

$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
    $row = $resultado->fetch_assoc();

    echo '<div class="card-deck">';

    // Card 1: Información del Contribuyente
    echo '<div class="card">
      <div class="card-body">
        <h5 class="card-title">Información del Contribuyente</h5>
        <p class="card-text">DNI: ' . $row['id_contribuyente'] . '</p>
        <p class="card-text">Nombre: ' . $row['nombre'] . '</p>
        <p class="card-text">Apellidos: ' . $row['apellido'] . '</p>
      </div>
    </div>';
    
    // Card 2: Información del Domicilio
    echo '<div class="card">
      <div class="card-body">
        <h5 class="card-title">Información del Domicilio</h5>
        <p class="card-text">Dirección: ' . $row['direccion'] . '</p>
        <p class="card-text">Fecha de Contrato: ' . $row['fecha_contrato'] . '</p>
        <p class="card-text">Descripción del Domicilio: ' . $row['descripcion_domicilio'] . '</p>
        <p class="card-text">Estatus: ' . $row['estatus'] . '</p>
        <p class="card-text">Total de Tomas: ' . $row['total_tomas'] . '</p>
      </div>
    </div>';
    
    // Card 3: Tipo de Servicio
    echo '<div class="card">
      <div class="card-body">
        <h5 class="card-title">Tipo de Servicio</h5>
        <p class="card-text">' . ($row['descripcion'] ? $row['descripcion'] : 'No hay información de servicio para este domicilio') . '</p>
        <p class="card-text">Precio: ' . $row['precio'] . '</p>
      </div>
    </div>';
    
    echo '</div>';
    





    $numeroTomas = $row['total_tomas'];
    $fecha_contrato = $row['fecha_contrato'];


    echo '<script>';
    echo 'var precioServicio = "' . number_format(floatval($row['precio']), 2, '.', '') . '";';
    echo '</script>';

    $variable_ejemplo = '';

    // Verificar si hay pagos para el id_domicilio
    $sqlPagos = "SELECT mes_fin FROM pagos WHERE id_domicilio = $id_domicilio ORDER BY mes_fin DESC LIMIT 1";
    $resultadoPagos = $conn->query($sqlPagos);

    if ($resultadoPagos->num_rows > 0) {
          // Si hay pagos, obtener el último mes_fin
    $rowPagos = $resultadoPagos->fetch_assoc();
    $ultimoMesFin = $rowPagos['mes_fin'];

    // Obtener el primer día del próximo mes
    $fecha = new DateTime($ultimoMesFin);
    $fecha->modify('first day of next month');

    $variable_ejemplo = $fecha->format('Y-m-d');
    } else {
        // Si no hay pagos, obtener la fecha de contrato
        $variable_ejemplo = $row['fecha_contrato'];
    }



} else {
    echo '<p>No se encontró información para este domicilio.</p>';
}

?>
<h3>Historial de pagos</h3>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
$(document).ready(function () {
    // Función para cargar el historial de pagos
    function cargarHistorialPagos() {
        var id_domicilio = <?php echo $id_domicilio; ?>;

        // Realizar una solicitud AJAX para obtener el historial de pagos
        $.ajax({
            type: 'GET',
            url: 'hist_pagos.php?id_domicilio=' + id_domicilio,
            success: function (data) {
                // Actualizar el contenido de la tabla de historial de pagos
                $('#tablaHistorialPagos').html(data);
            },
            error: function () {
                console.error('Error al cargar el historial de pagos.');
            }
        });
    }

    // Llamar a la función al cargar la página
    cargarHistorialPagos();

    // Configurar la actualización automática cada 5 segundos (puedes ajustar el intervalo según tus necesidades)
    setInterval(cargarHistorialPagos, 5000);
});
</script>
<div id="tablaHistorialPagos"></div>



<br>
<hr>

<h3>Seleccionar Rango de Meses</h3>

<br>
<form action="procesar_pago.php" method="post" onsubmit="return confirmSubmit()">
  <div class="calendar-container">
  <label for="mes_inicio" class="calendar-label">Del mes de:</label>
<?php 
setlocale(LC_TIME, 'es-MX');
echo "<span style='color: black; font-weight: bold;'>".strftime('%d-%B-%Y', strtotime($variable_ejemplo))."</span>";

?>




<input type="text" name="mes_inicio" id="mes_inicio" value="<?php echo $variable_ejemplo; ?>" readonly style="display: none;">

    <label for="mes_fin" class="calendar-label">a:</label>
<input type="date" name="mes_fin" id="mes_fin" required class="calendar-input">
<input type="hidden" name="id_domicilio" value="<?php echo $id_domicilio; ?>">
<input type="hidden" name="id_contribuyente" value="<?php echo $id_contribuyente; ?>">
<input type="hidden" name="totalFinal" id="totalFinalInput">
<br>
<button id="agregarMes" class="btn btn-success mt-3" type="button" onclick="agregarMeses()">Agregar Meses</button>

  <!-- ... (your existing form code) ... -->

  </div>
  <table class="table table-striped mt-2">
  <thead>
    <tr>
    <th style="background-color: #">#</th>
      <th style="background-color: #">Mes</th>
      <th style="background-color: #">Precio</th>
    </tr>
  </thead>
  <tbody id="tabla_meses"></tbody>
</table>



<button type="submit" class="btn btn-primary btn-lg btn-calendario">Procesar Pago</button>


</form>
<!-- Agrega este botón donde quieras en tu HTML -->
<div class="text-center mt-3">
    <!-- Add type="button" to prevent accidental form submission -->
    <button id="vaciarTabla" class="btn btn-danger" type="button" onclick="vaciarTabla()">Vaciar Tabla</button>
  </div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

</body>

<script>
function confirmSubmit() {
  // Display a confirmation dialog
  var confirmation = confirm("Esta seguro de realizar el cobro");

  // If the user confirms, return true to submit the form; otherwise, return false to cancel the submission
  return confirmation;
}

</script>
    <!-- Bootstrap core JS -->
    <script>
function agregarMeses() {
    // Obtener la fecha seleccionada
    var fechaSeleccionada = document.getElementById('mes_fin').value;

    // Validar si se ha seleccionado una fecha
    if (fechaSeleccionada === "") {
        alert("Por favor, selecciona una fecha antes de agregar meses.");
        return;
    }

    // Continuar con la lógica para agregar meses si la fecha está seleccionada
    // ...

    // Ejemplo: Enviar formulario o realizar otra acción
    // document.getElementById('tuFormulario').submit();
}
</script>
<!-- Asegúrate de incluir la biblioteca jQuery en tu página -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
  // Función para vaciar la tabla
  $(document).ready(function () {
    $('#agregarMes').click(function () {
      var fechaInicio = new Date($('#mes_inicio').val() + 'T00:00:00');
      var fechaFin = new Date($('#mes_fin').val() + 'T00:00:00');

      // Validar las fechas si es necesario

      $('#tabla_meses').empty();

      var datesAdded = new Set();
      var datesArray = [];

      var date = new Date(fechaInicio);
      var totalAmount = 0;

      // Counter for line number
      var lineNumber = 1;

      while (date <= fechaFin) {
        var month = date.toLocaleString('es-MX', { month: 'long' }) + "-" + date.getFullYear();

        if (!datesAdded.has(month)) {
          datesArray.push({ date: new Date(date), month: month });
          datesAdded.add(month);
        }

        date.setMonth(date.getMonth() + 1);
      }

      datesArray.sort((a, b) => a.date - b.date);

      datesArray.forEach(item => {
        var price = parseFloat(precioServicio);
        totalAmount += price;

        // Append the line number to the table
        $('#tabla_meses').append('<tr><td>' + lineNumber + '</td><td>' + item.month + '</td><td>' + price + '</td></tr>');

        lineNumber++;
      });

      $('#tabla_meses').append('<tr><td colspan="3"><strong>Total: ' + totalAmount.toFixed(2) + '</strong></td></tr>');
      var totalFinal = totalAmount * <?php echo $numeroTomas; ?>;
      $('#totalFinalInput').val(totalFinal.toFixed(2));

      $('#tabla_meses').append('<tr><td colspan="3"><h5 style="color: black;"><strong>Total Final: ' + totalFinal.toFixed(2) + '</strong></h1></td></tr>');
    });
  });

  function vaciarTabla() {
    $('#tabla_meses').empty();
    // También puedes restablecer el valor en el input #totalFinalInput si es necesario
    $('#totalFinalInput').val('');
  }
</script>





</html>