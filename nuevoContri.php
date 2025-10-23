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
  <title>Contrato</title>
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
<?php
require "navegacion.php";
?>
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
      <form class="search-bar">
      </form>
    </li>
    <h4>Bienvenido <?php

echo $_SESSION["nombre"]." ".$_SESSION["apellido"];

?></h4>
  </ul>
     
  <ul class="navbar-nav align-items-center right-nav-link">
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
<body>
  
<!--nuevoContri.php-->
<div class="clearfix"></div>
	
  <div class="content-wrapper">
    <div class="container-fluid">

   <div class="row mt-3">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">


  <style>
    label {
      display: block;
      margin-bottom: 5px;
    }

    input, select, textarea {
      margin-bottom: 10px;
    }
  </style>

  <hr>
  <style>
  .highlight-lines {
    display: block;
    margin-left: auto;
    margin-right: auto;
  }
</style>

  <img src="assets/images/logon.png" alt="" width="480" height="210" class="highlight-lines">

<h2 style="margin-top: 1px; text-align: center;">NUEVO CONTRATO</h2>

  <hr>

<!-- Formulario para ingresar datos del contribuyente y del domicilio -->
<form action="procesar_contrato.php" method="POST" class="mt-4">
<h6>Ingresar Nuevo Contribuyente y Datos del Domicilio</h6>

  <!-- Sección para datos del contribuyente -->
  <h3>Datos del Contribuyente</h3>

  <label for="nombre">Nombre:</label>
<input type="text" class="form-control" id="nombre" name="nombre" required oninput="convertirAMayusculas(this)">

<label for="apellido">Apellido:</label>
<input type="text" class="form-control" id="apellido" name="apellido" required oninput="convertirAMayusculas(this)">

<script>
  function convertirAMayusculas(input) {
    input.value = input.value.toUpperCase();
  }
</script>

  <label for="tipo_persona">Tipo de Persona:</label>
  <select class="form-control" id="tipo_persona" name="tipo_persona" required>
    <option value="Natural">Natural</option>
    <option value="Parroquia">Parroquia o Congregación</option>
    <!-- Agrega más opciones según tus necesidades -->
  </select>
  <hr>

  <!-- Sección para datos del domicilio -->
  <h3 class="mt-3">Datos del Domicilio</h3>
<label for="tipoServicio">Tipo de Servicio:</label>
            <select class="form-control" id="tipoServicio" name="tipoServicio">
              <?php
                // Tu script principal
                require 'config.php';

                // Consulta para obtener los tipos de servicio desde la base de datos
                $sqlTiposServicio = "SELECT id_tipo_de_servicio, descripcion FROM tipos_de_servicio";
                $resultTiposServicio = $conn->query($sqlTiposServicio);

                // Verificar si hay resultados
                if ($resultTiposServicio->num_rows > 0) {
                    // Generar las opciones del select
                    while ($rowTipoServicio = $resultTiposServicio->fetch_assoc()) {
                        echo '<option value="' . $rowTipoServicio['id_tipo_de_servicio'] . '">' . $rowTipoServicio['descripcion'] . '</option>';
                    }
                } else {
                    // Manejar caso en el que no hay tipos de servicio
                    echo '<option value="" disabled>No hay tipos de servicio disponibles</option>';
                }
              ?>
            </select>
  <label for="direccion">Dirección:</label>
  <input type="text" class="form-control" id="direccion" name="direccion" required>

  <label for="total_tomas">Total Tomas:</label>
<input type="number" class="form-control" id="total_tomas" name="total_tomas" value="1" readonly>

  <label for="descripcion_domicilio">Descripción del Domicilio:</label>
  <textarea class="form-control" id="descripcion_domicilio" name="descripcion_domicilio" required></textarea>

  <label for="estatus">Estatus:</label>
  <select class="form-control" id="estatus" name="estatus" required>
    <option value="Activo">Activo</option>
    <!-- Agrega más opciones según tus necesidades -->
  </select>
  <label for="fecha_contrato">Fecha de Contrato:</label>
<div>
  <input type="month" class="form-control" id="fecha_contrato" name="fecha_contrato" required title="Su primer pago será en la fecha proporcionada del día 1 del contrato">
</div>




  <!-- Botón de guardar -->
  <input type="submit" value="Guardar Datos" class="btn btn-primary mt-3">
</form>


                 
        </div>
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
	<footer class="footer">
      <div class="container">
        <div class="text-center">
          Dzonot Carretero 2021-2024
        </div>
      </div>
    </footer>
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
	<!-- Asegúrate de tener incluido jQuery y SweetAlert2 en tu archivo -->
  <script src="http://localhost/sweetalert2-11.10.5/sweetalert2.min.js"></script>
  <link rel="stylesheet" href="http://localhost/sweetalert2-11.10.5/sweetalert2.css">
<script>
  $(document).ready(function() {
    $('form').submit(function(e) {
      e.preventDefault();

      // Enviar el formulario mediante AJAX
      $.ajax({
        url: 'procesar_contrato.php',
        type: 'POST',
        data: $(this).serialize(),
        success: function(response) {
          // Mostrar SweetAlert2 según el tipo de mensaje
          if (response.type === 'error') {
            Swal.fire({
              title: 'Error',
              text: response.message,
              icon: 'error',
              confirmButtonText: 'Aceptar'
            });
          } else {
            Swal.fire({
              title: 'Éxito',
              text: response.message_contribuyente + '\n' + response.message_domicilio,
              icon: 'success',
              confirmButtonText: 'Aceptar'
            });

            // Limpiar el formulario después del éxito
            $('form')[0].reset();
          }
        },
        error: function(xhr, status, error) {
          // Mostrar SweetAlert2 en caso de error en la petición AJAX
          Swal.fire({
            title: 'Error',
            text: 'Hubo un error al procesar el formulario. Por favor, inténtalo nuevamente.',
            icon: 'error',
            confirmButtonText: 'Aceptar'
          });
        }
      });
    });
  });
</script>
<script>
    Swal.fire({
    html: `
      <div class="custom-swal-content">
        <img src="assets/images/logoti.png" alt="Logo de la empresa" class="swal-logo">
        <h4 style="color: #1F7000;">AVISO</h4>

        <p>Para crear un contrato de manera efectiva, es esencial contar con información precisa y detallada. Se necesitan datos fundamentales como el nombre del contratante y la dirección exacta donde se ubica la toma de agua. Además, es imperativo presentar el recibo de electricidad como parte del proceso.</p>
      </div>`,
    customClass: {
      popup: 'small-font', // Añade una clase CSS para personalizar el tamaño de fuente
    }
  });
</script>
<style>
  /* Define la clase CSS para reducir el tamaño de la fuente */
  .small-font {
    font-size: 14px; /* Puedes ajustar el tamaño según tus preferencias */
  }
</style>
</script>
</body>
</html>
