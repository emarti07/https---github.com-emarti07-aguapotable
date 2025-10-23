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
  <meta name="description" content="Gestión de servicios"/>
  <meta name="author" content=""/>
  <title>Servicios</title>
  
  <!-- Fuente Bahnschrift -->
  <link href="https://fonts.googleapis.com/css2?family=Bahnschrift:wght@400;500;600;700&display=swap" rel="stylesheet">
  
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
    
    .navbar-brand, .page-title, .card-title, .modal-title {
      font-family: 'Bahnschrift', Arial, sans-serif;
      font-weight: 600;
    }
    
    /* Encabezado mejorado */
    .page-header-wrapper {
      background: var(--color-blanco);
      border-radius: 10px;
      padding: 25px;
      margin-bottom: 30px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
      border-left: 5px solid var(--color-azul);
    }
    
    .page-header-content {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
    }
    
    .page-header-title {
      position: relative;
      margin: 0;
      color: var(--color-azul);
      font-size: 1.8rem;
      font-weight: 700;
      letter-spacing: 0.5px;
      text-transform: uppercase;
      padding-bottom: 10px;
    }
    
    .title-text {
      position: relative;
      z-index: 2;
    }
    
    .title-underline {
      position: absolute;
      bottom: 5px;
      left: 0;
      width: 70px;
      height: 4px;
      background: var(--color-naranja);
      border-radius: 2px;
      z-index: 1;
    }
    
    .btn-add-service {
      background: var(--color-verde);
      color: var(--color-blanco);
      border: none;
      border-radius: 6px;
      padding: 12px 25px;
      font-weight: 600;
      letter-spacing: 0.5px;
      transition: all 0.3s ease;
      box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
    }
    
    .btn-add-service:hover {
      background: #3d8b40;
      transform: translateY(-2px);
      box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
    }
    
    .btn-add-service i {
      margin-right: 8px;
    }
    
    /* Estilos para la tabla */
    .card {
      border: none;
      border-radius: 10px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    }
    
    .card-header {
      background-color: var(--color-blanco);
      border-bottom: 1px solid rgba(0,0,0,0.05);
      font-weight: 600;
      color: var(--color-azul);
      padding: 15px 25px;
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
    
    .btn-action {
      padding: 6px 12px;
      font-size: 0.85rem;
      border-radius: 4px;
      margin-right: 5px;
    }
    
    /* Estilos para el modal */
    .modal-header {
      background-color: var(--color-azul);
      color: var(--color-blanco);
      border-radius: 10px 10px 0 0;
    }
    
    .modal-title {
      font-weight: 600;
    }
    
    .modal-content {
      border: none;
      border-radius: 10px;
      box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
    }
    
    /* Estilos responsive */
    @media (max-width: 768px) {
      .page-header-content {
        flex-direction: column;
        align-items: flex-start;
      }
      
      .page-header-buttons {
        margin-top: 15px;
        width: 100%;
      }
      
      .btn-add-service {
        width: 100%;
      }
      
      .table-responsive {
        border: none;
      }
    }
  </style>
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
    <nav class="navbar navbar-expand fixed-top" style="background-color: white; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
      <ul class="navbar-nav mr-auto align-items-center">
        <li class="nav-item">
          <a class="nav-link toggle-menu" href="javascript:void();">
            <i class="icon-menu menu-icon" style="color: var(--color-azul);"></i>
          </a>
        </li>
        
        <h4 class="welcome-message">Bienvenido <?php echo $_SESSION["nombre"]." ".$_SESSION["apellido"]; ?></h4>
      </ul>

      <ul class="navbar-nav align-items-center right-nav-link">
        <a class="btn btn-outline-danger" href="controlador/controlador_cerrar_sesion.php">
          <i class="fa fa-power-off" aria-hidden="true"></i> Salir
        </a>
        
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
  
  <script src="http://localhost/sweetalert2-11.10.5/sweetalert2.min.js"></script>
  <link rel="stylesheet" href="http://localhost/sweetalert2-11.10.5/sweetalert2.css">

  <div class="clearfix"></div>

  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Encabezado mejorado -->
      <div class="row">
        <div class="col-12">
          <div class="page-header-wrapper">
            <div class="page-header-content">
              <h2 class="page-header-title">
                <span class="title-text">LISTA DE CATEGORÍAS DE SERVICIOS</span>
                <span class="title-underline"></span>
              </h2>
              <div class="page-header-buttons">
                <a class="btn btn-add-service" href="./nuevo_servicio.php">
                  <i class="fas fa-plus-circle"></i> Nuevo servicio
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
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
                    // Incluir el archivo de configuración
                    require 'config.php';

                    // Consulta SQL para obtener la lista de servicios
                    $sql = "SELECT `id_tipo_de_servicio`, `nombre`, `descripcion`, `precio` FROM `tipos_de_servicio`";
                    $result = $conn->query($sql);

                    // Verificar si la consulta fue exitosa
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

                    // Cerrar la conexión
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

  <!-- Bootstrap core JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

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
        confirmButtonColor: '#306BA9',
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
              confirmButtonColor: '#306BA9',
            }).then(() => {
              $('#editServiceModal').modal('hide');
              location.reload();
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'Ocurrió un error al guardar los cambios.',
              confirmButtonColor: '#306BA9',
            });
          }
        }
      });
    }
  </script>
</body>
</html>