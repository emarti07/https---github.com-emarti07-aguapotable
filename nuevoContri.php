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
  <title>SISCATEL - Nuevo Contrato</title>
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
      <h4 class="welcome-message">Bienvenido <?php echo $_SESSION["nombre"]." ".$_SESSION["apellido"]; ?></h4>
    </li>
  </ul>
</nav>
</header>
<body>
  
<div class="clearfix"></div>
	
  <div class="content-wrapper">
    <div class="container-fluid">

   <div class="row mt-3">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <div class="card-title">
            <h2 class="text-uppercase text-center">Nuevo Contrato</h2>
          </div>
          <hr>

<form id="contratoForm" action="procesar_contrato.php" method="POST" class="mt-4">
    <h3>Datos del Contribuyente</h3>
    <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input type="text" class="form-control" id="nombre" name="nombre" required oninput="this.value = this.value.toUpperCase()">
    </div>
    <div class="form-group">
        <label for="apellido">Apellido:</label>
        <input type="text" class="form-control" id="apellido" name="apellido" required oninput="this.value = this.value.toUpperCase()">
    </div>
    <div class="form-group">
        <label for="tipo_persona">Tipo de Persona:</label>
        <select class="form-control" id="tipo_persona" name="tipo_persona" required>
            <option value="Natural">Natural</option>
            <option value="Parroquia">Parroquia o Congregación</option>
        </select>
    </div>
    <hr>
    <h3>Datos del Domicilio</h3>
    <div class="form-group">
        <label for="tipoServicio">Tipo de Servicio:</label>
        <select class="form-control" id="tipoServicio" name="tipoServicio">
            <?php
            require 'config.php';
            $sqlTiposServicio = "SELECT id_tipo_de_servicio, descripcion FROM tipos_de_servicio";
            $resultTiposServicio = $conn->query($sqlTiposServicio);
            if ($resultTiposServicio->num_rows > 0) {
                while ($rowTipoServicio = $resultTiposServicio->fetch_assoc()) {
                    echo '<option value="' . $rowTipoServicio['id_tipo_de_servicio'] . '">' . $rowTipoServicio['descripcion'] . '</option>';
                }
            } else {
                echo '<option value="" disabled>No hay tipos de servicio disponibles</option>';
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="direccion">Dirección:</label>
        <input type="text" class="form-control" id="direccion" name="direccion" required>
    </div>
    <div class="form-group">
        <label for="total_tomas">Total Tomas:</label>
        <input type="number" class="form-control" id="total_tomas" name="total_tomas" value="1" readonly>
    </div>
    <div class="form-group">
        <label for="descripcion_domicilio">Descripción del Domicilio:</label>
        <textarea class="form-control" id="descripcion_domicilio" name="descripcion_domicilio" required></textarea>
    </div>
    <div class="form-group">
        <label for="estatus">Estatus:</label>
        <select class="form-control" id="estatus" name="estatus" required>
            <option value="Activo">Activo</option>
        </select>
    </div>
    <div class="form-group">
        <label for="fecha_contrato">Fecha de Contrato:</label>
        <input type="month" class="form-control" id="fecha_contrato" name="fecha_contrato" required>
    </div>

    <button type="submit" class="btn btn-primary mt-3">Guardar Datos</button>
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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  document.getElementById('contratoForm').addEventListener('submit', function(e) {
    e.preventDefault();

    let form = this;
    let formData = new FormData(form);

    fetch('procesar_contrato.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.type === 'error') {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: data.message,
            });
        } else {
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: data.message_contribuyente + '\\n' + data.message_domicilio,
            }).then(() => {
                form.reset();
            });
        }
    })
    .catch(error => {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Hubo un error al procesar el formulario.',
        });
    });
});
</script>
</body>
</html>
