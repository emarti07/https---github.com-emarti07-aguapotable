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
  <title>CONTRIBUYENTES</title>

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
			<a class="btn btn-success" href="nuevoContri.php">Nuevo Contribuyente 
      <i class="fa fa-plus"></i> </a>

		</div>
		<br>
    <h2>COBRAR MESES DE CONTRIBUYENTES</h2>
   <div class="row mt-3">
    <div class="col-lg-12">
      <div class="card">
        
        <main>
        <div class="table-responsive">
          
    <table class="table table-sm table-bordered table-striped table-hover">
      
    <div class="container py-4 text-center">
    

    <div class="row g-4">
        <div class="col-auto">
            <label for="num_registros" class="col-form-label">Mostrar: </label>
        </div>
        <div class="col-auto">
            <select name="num_registros" id="num_registros" class="form-select">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>
        <div class="col-auto">
            <label for="num_registros" class="col-form-label">registros</label>
        </div>
        <div class="col-5"></div>
        <div class="col-auto">
            <label for="campo" class="col-form-label">Buscar: </label>
            
        </div>
        <div class="col-auto">
        <input type="text" name="campo" id="campo" class="form-control" style="border: 2px solid #FCFCFC;">
        </div>
    </div>
    
    <div class="row py-4">
        <div class="col">
        <table class="table table-sm table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th class="sort asc" style="color: white; background-color: #212121;">DNI</th>
            <th class="sort asc" style="color: black; background-color: #CCCCCC;">Nombre</th>
            <th class="sort asc" style="color: black; background-color: #CCCCCC;">Apellido</th>
            <th class="sort asc" style="color: black; background-color: #b1b1b1;">Editar o Baja</th>
            <th class="sort asc" style="color: black; background-color: #b1b1b1;">Crear_Contrato</th>



        </tr>
    </thead>
    <tbody id="content"></tbody>
    </table>

        </div>
    </div>
    
    <div class="row">
        <div class="col-6">
            <label id="lbl-total"></label>
        </div>
        <div class="col-6" id="nav-paginacion"></div>
        <input type="hidden" id="pagina" value="1">
        <input type="hidden" id="orderCol" value="0">
        <input type="hidden" id="orderType" value="asc">
    </div>
    </div>
    </table>
    </div>
    </main>
    <footer class="footer">
      <div class="container">
        <div class="text-center">
          Dzonot Carretero 
        </div>
      </div>
    </footer>
    <script>
        /* Llamando a la función getData() */
        getData()

        /* Escuchar un evento keyup en el campo de entrada y luego llamar a la función getData. */
        document.getElementById("campo").addEventListener("keyup", function() {
            getData()
        }, false)
        document.getElementById("num_registros").addEventListener("change", function() {
            getData()
        }, false)


        /* Peticion AJAX */
        function getData() {
            let input = document.getElementById("campo").value
            let num_registros = document.getElementById("num_registros").value
            let content = document.getElementById("content")
            let pagina = document.getElementById("pagina").value
            let orderCol = document.getElementById("orderCol").value
            let orderType = document.getElementById("orderType").value

            if (pagina == null) {
                pagina = 1
            }

            let url = "load.php"
            let formaData = new FormData()
            formaData.append('campo', input)
            formaData.append('registros', num_registros)
            formaData.append('pagina', pagina)
            formaData.append('orderCol', orderCol)
            formaData.append('orderType', orderType)

            fetch(url, {
                    method: "POST",
                    body: formaData
                }).then(response => response.json())
                .then(data => {
                    content.innerHTML = data.data
                    document.getElementById("lbl-total").innerHTML = 'Mostrando ' + data.totalFiltro +
                        ' de ' + data.totalRegistros + ' registros'
                    document.getElementById("nav-paginacion").innerHTML = data.paginacion
                }).catch(err => console.log(err))
        }

        function nextPage(pagina){
            document.getElementById('pagina').value = pagina
            getData()
        }

        let columns = document.getElementsByClassName("sort")
        let tamanio = columns.length
        for(let i = 0; i < tamanio; i++){
            columns[i].addEventListener("click", ordenar)
        }

        function ordenar(e){
            let elemento = e.target

            document.getElementById('orderCol').value = elemento.cellIndex

            if(elemento.classList.contains("asc")){
                document.getElementById("orderType").value = "asc"
                elemento.classList.remove("asc")
                elemento.classList.add("desc")
            } else {
                document.getElementById("orderType").value = "desc"
                elemento.classList.remove("desc")
                elemento.classList.add("asc")
            }

            getData()
        }

    </script>

    <!-- Bootstrap core JS -->

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
  <!-- Modal for viewing data -->
 
  <div class="modal fade" id="vermodalTomas" tabindex="-1" aria-labelledby="modalTomasLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTomasLabel">Tomas del contribuyente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <table class="table table-striped">
          <thead>
            <tr>
              <th>Dirección</th>
              <th>id_domicilio</th>
              <th>id_Servicio</th>
              <th>Fecha_contrato</th>
              <th>Servicio</th>
              <th>Precio</th>
              <th>Estatus</th>
              <th>Descripción</th>
              <th>Tomas</th>
            </tr>
          </thead>
          <tbody id="tomasData">
            <!-- Contenido de la tabla -->
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!--MODAL DAR DE BAJA-->


<!-- SweetAlert CDN -->
<script src="http://localhost/sweetalert2-11.10.5/sweetalert2.min.js"></script>
  <link rel="stylesheet" href="http://localhost/sweetalert2-11.10.5/sweetalert2.css">

<!-- Segunda ventana modal para editar -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="border-color: #AEF6FE;">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Editar Tipo de Servicio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Formulario para editar el campo -->
        <form id="editForm">
          <!-- Mostrar el id_domicilio como un campo de solo lectura -->
          <div class="form-group">
            <label for="idDomicilio">ID Domicilio:</label>
            <input type="text" class="form-control" id="idDomicilio" name="idDomicilio" readonly>
          </div>

          <div class="form-group">
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
          </div>

          <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('#editModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var idDomicilio = button.data('id-domicilio');
      var idTipoServicio = button.data('id-tipo-servicio');

      $('#idDomicilio').val(idDomicilio);
      $('#tipoServicio').val(idTipoServicio);
    });

    // Mostrar SweetAlert antes de enviar el formulario
    $('#editForm').submit(function(e) {
      e.preventDefault();

      // Utilizar SweetAlert para confirmar la edición
      Swal.fire({
        title: '¿Deseas continuar con la edición?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Sí, continuar',
        cancelButtonText: 'Cancelar',
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
          // Proceder con la edición
          var formData = $('#editForm').serialize();

          $.ajax({
            url: 'editar_domicilio.php',
            type: 'POST',
            data: formData,
            success: function(response) {
              // Verificar si hay meses debidos
              if (response.includes('No se puede realizar el cambio de servicio')) {
                // Mostrar SweetAlert con la X en caso de meses debidos
                Swal.fire({
                  title: 'Error en la edición',
                  text: response,
                  icon: 'error',
                  showCancelButton: false,
                  confirmButtonText: 'Aceptar',
                  reverseButtons: false
                });
              } else {
                // Mostrar SweetAlert con la palomita verde en caso de éxito
                Swal.fire({
                  title: 'Resultado de la edición',
                  text: response,
                  icon: 'success',
                  showCancelButton: false,
                  confirmButtonText: 'Aceptar',
                  reverseButtons: false
                });

                // Cerrar la ventana modal de edición
                $('#editModal').modal('hide');
              }
            },
            error: function(xhr, status, error) {
              // Mostrar SweetAlert con la X en caso de error
              Swal.fire({
                title: 'Error en la edición',
                text: 'Hubo un error al intentar editar el domicilio. Por favor, inténtalo nuevamente.',
                icon: 'error',
                showCancelButton: false,
                confirmButtonText: 'Aceptar',
                reverseButtons: false
              });
            }
          });
        }
      });
    });
  });
</script>



</body>


<script>
$(document).ready(function() {
  $('#vermodalTomas').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Botón que activó el modal
    var idContribuyente = button.data('id'); // ID del contribuyente
    
    $.ajax({
      url: 'ver_tomas.php',
      type: 'POST',
      data: { id_contribuyente: idContribuyente },
      success: function(data) {
        $('#tomasData').html(data);
      }
    });
  });
});


</script>
<!-- Agregar a tu HTML -->
<div class="modal fade" id="agregarDomicilioModal" tabindex="-1" aria-labelledby="agregarDomicilioModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="agregarDomicilioModalLabel">Agregar Domicilio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formAgregarDomicilio">
          <div class="form-group">
            <label for="direccion">Dirección:</label>
            <input type="text" class="form-control" id="direccion" name="direccion" required>
          </div>
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
              <!-- Agrega más opciones según tus necesidades -->
            </select>
          </div>
          <div class="form-group">
            <label for="fecha_contrato">Fecha de Contrato:</label>
            <input type="month" class="form-control" id="fecha_contrato" name="fecha_contrato" required title="Su primer pago será en la fecha proporcionada del día 1 del contrato">
          </div>
          <input type="hidden" id="id_contribuyente_modal" name="id_contribuyente_modal">

          <button type="submit" class="btn btn-primary">Guardar Domicilio</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Dar de baja -->
<div class="modal fade" id="estatusModal" tabindex="-1" aria-labelledby="estatusModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="border-color: #AEF6FE;">
      <div class="modal-header">
        <h5 class="modal-title" id="estatusModalLabel">Editar Estatus</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Formulario para editar el estatus -->
        <form id="estatusForm">
          <!-- Mostrar el id_domicilio como un campo de solo lectura -->
          <div class="form-group">
            <label for="idDomicilioEstatus">ID Domicilio:</label>
            <input type="text" class="form-control" id="idDomicilioEstatus" name="idDomicilioEstatus" readonly>
          </div>

          <div class="form-group">
            <label for="estatus">Estatus:</label>
            <select class="form-control" id="estatus" name="estatus">
              <option value="Baja">Baja</option>
              <!-- Agrega más opciones según tus necesidades -->
            </select>
          </div>

          <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal para dar de baja -->
<!-- Modal para dar de baja -->
<script>
  $(document).ready(function () {
    // ... Código existente

    // Manejar la apertura de la ventana modal de estatus
    $('#estatusModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var idDomicilioEstatus = button.data('id-domicilio');

      // Establecer el ID de domicilio en el formulario
      $('#idDomicilioEstatus').val(idDomicilioEstatus);

      // Manejar el envío del formulario de estatus
      $('#estatusForm').submit(function (e) {
        e.preventDefault();

        // Mostrar el mensaje de confirmación con SweetAlert2
        Swal.fire({
          title: "¿Estás seguro?",
          text: "Una vez dado de baja el contrato NO podrás revertir esto ",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Sí, continuar"
        }).then((result) => {
          if (result.isConfirmed) {
            // Proceder con la edición de estatus
            var formDataEstatus = $('#estatusForm').serialize();

            $.ajax({
              url: 'baja_domicilio.php',
              type: 'POST',
              data: formDataEstatus,
              dataType: 'json', // Specify that you expect a JSON response
              success: function (response) {
                if (response.success) {
                  // La actualización fue exitosa
                  Swal.fire({
                    title: "Actualización exitosa",
                    text: response.message,
                    icon: "success"
                  });
                } else {
                  // Error en la actualización
                  Swal.fire({
                    title: "Error",
                    text: response.message,
                    icon: "error"
                  });
                }

                // Cerrar la ventana modal independientemente del éxito o error
                $('#estatusModal').modal('hide');
              },
              error: function (xhr, status, error) {
                // Manejar el error de Ajax si es necesario
                Swal.fire({
                  title: "Error",
                  text: "Error en la solicitud Ajax: " + error,
                  icon: "error"
                });
              }
            });
          }
        });
      });

      // ... Código existente
    });
  });
</script>



<!-- FIN Dar de baja -->


<script>
$(document).ready(function () {
  // Event listener for modal show event
  $('#agregarDomicilioModal').on('show.bs.modal', function (event) {
    // Extract the data-id attribute from the button that triggered the modal
    var button = $(event.relatedTarget);
    var idContribuyente = button.data('id');

    // Update the hidden input field with the id_contribuyente value
    $('#id_contribuyente_modal').val(idContribuyente);
  });

  // Submit form using Ajax
  $('#formAgregarDomicilio').submit(function (e) {
    e.preventDefault();

    // Show SweetAlert2 confirmation dialog
    Swal.fire({
      title: '¿Está seguro de agregar la toma?',
      text: 'Se agregará la toma con el domicilio al contribuyente',
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Agregar'
    }).then((result) => {
      if (result.isConfirmed) {
        // If the user confirms, proceed with form submission
        // Get form data
        var formData = $(this).serialize();

        // Ajax request
        $.ajax({
          type: 'POST',
          url: 'agregar_domicilio.php', // Specify your PHP file
          data: formData,
          success: function (response) {
            // Handle success (response is the JSON object from the server)
            console.log(response);

            // Check if the server response indicates success
            if (response.type === 'success') {
              // Show success message
              Swal.fire({
                title: 'Éxito',
                text: response.message,
                icon: 'success'
              });
            } else {
              // Show error message
              Swal.fire({
                title: 'Error',
                text: response.message,
                icon: 'error'
              });
            }

            // You can add further actions here if needed
          },
          error: function (error) {
            // Handle errors
            console.log(error);

            // Show error message
            Swal.fire({
              title: 'Error',
              text: 'Hubo un error en la solicitud. Por favor, inténtelo de nuevo.',
              icon: 'error'
            });
          }
        });
      }
    });
  });
});


</script>

</html>