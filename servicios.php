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
  <title>SISCATEL - Servicios</title>
  
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
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  
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
  
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <div class="clearfix"></div>

  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="card">
        <div class="card-body">
          <div class="card-title">
            <div class="d-flex justify-content-between align-items-center">
              <h2 class="text-uppercase">Lista de Categorías de Servicios</h2>
              <a class="btn btn-success" href="./nuevo_servicio.php">
                <i class="fas fa-plus-circle"></i> Nuevo servicio
              </a>
            </div>
          </div>
          <hr>
      <div class="row">
        <div class="col-lg-12">
              <div class="table-responsive">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nombre</th>
                      <th>Descripción</th>
                      <th>Precio</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    require 'config.php';

                    $sql = "SELECT `id_tipo_de_servicio`, `nombre`, `descripcion`, `precio` FROM `tipos_de_servicio`";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                      while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row["id_tipo_de_servicio"] . '</td>';
                        echo '<td>' . $row["nombre"] . '</td>';
                        echo '<td>' . $row["descripcion"] . '</td>';
                        echo '<td>$' . number_format($row["precio"], 2) . '</td>';
                        echo '<td>';
                        echo '<button class="btn btn-info btn-action" onclick="openEditModal(' . $row["id_tipo_de_servicio"] . ')">';
                        echo '<i class="fas fa-edit"></i> Editar';
                        echo '</button>';
                        echo '</td>';
                        echo '</tr>';
                      }
                    } else {
                      echo '<tr><td colspan="5" class="text-center py-4">No se encontraron servicios registrados</td></tr>';
                    }

                    $conn->close();
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--start overlay-->
  <div class="overlay toggle-menu"></div>
  <!--end overlay-->
  
  </div>
  <!-- End container-fluid-->
  
  </div><!--End content-wrapper-->
  
  <!--Start Back To Top Button-->
  <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
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

  <!-- Modal for Editing Services -->
  <div class="modal fade" id="editServiceModal" tabindex="-1" role="dialog" aria-labelledby="editServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Editar Servicio</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="cerrarModal()">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Form for Editing Service -->
          <form id="editServiceForm">
            <div class="form-group">
              <label for="editServiceName">Nombre:</label>
              <input type="text" class="form-control" id="editServiceName" name="editServiceName" required>
            </div>
            <div class="form-group">
              <label for="editServiceDescription">Descripción:</label>
              <textarea class="form-control" id="editServiceDescription" name="editServiceDescription" rows="3" required></textarea>
            </div>
            <div class="form-group">
              <label for="editServicePrice">Precio:</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">$</span>
                </div>
                <input type="number" step="0.01" class="form-control" id="editServicePrice" name="editServicePrice" required>
              </div>
            </div>
            <input type="hidden" id="editServiceId" name="editServiceId">
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" onclick="cerrarModal()">Cancelar</button>
          <button type="button" class="btn btn-primary" onclick="saveEditedService()">Guardar Cambios</button>
        </div>
      </div>
    </div>
  </div>
  
  <script>
    function cerrarModal() {
      $('#editServiceModal').modal('hide');
    }

    function openEditModal(serviceId) {
      $.ajax({
        url: 'get_service_details.php',
        method: 'GET',
        data: { serviceId: serviceId },
        success: function(response) {
          var service = JSON.parse(response);
          $('#editServiceId').val(service.id_tipo_de_servicio);
          $('#editServiceName').val(service.nombre);
          $('#editServiceDescription').val(service.descripcion);
          $('#editServicePrice').val(service.precio);
          $('#editServiceModal').modal('show');
        }
      });
    }

    function saveEditedService() {
      Swal.fire({
        title: '¿Guardar cambios?',
        text: "¿Estás seguro de que deseas guardar los cambios en este servicio?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#007bff',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Sí, guardar',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
          saveChangesAndShowSuccess();
        }
      });
    }

    function saveChangesAndShowSuccess() {
      $.ajax({
        url: 'save_edited_service.php',
        method: 'POST',
        data: $('#editServiceForm').serialize(),
        success: function(response) {
          if (response === 'success') {
            Swal.fire({
              icon: 'success',
              title: '¡Cambios guardados!',
              text: 'Los cambios en el servicio se han guardado correctamente.',
              confirmButtonColor: '#007bff',
            }).then(() => {
              $('#editServiceModal').modal('hide');
              location.reload();
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'Ocurrió un error al guardar los cambios.',
              confirmButtonColor: '#007bff',
            });
          }
        }
      });
    }
  </script>
</body>
</html>