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
  <title>SISCATEL - Contribuyentes</title>
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
              <div class="d-flex justify-content-between align-items-center">
                  <h2 class="text-uppercase">Contribuyentes</h2>
                  <a href="nuevoContri.php" class="btn btn-success">
                      <i class="fa fa-plus"></i> Nuevo Contribuyente
                  </a>
              </div>
          </div>
          <hr>
    <div class="row mt-3">
    <div class="col-lg-12">
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
            <th class="sort asc">DNI</th>
            <th class="sort asc">Nombre</th>
            <th class="sort asc">Apellido</th>
            <th class="sort asc">Acciones</th>
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
          SISCATEL - Sistema de Agua Potable
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
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        <form id="editForm">
          <div class="form-group">
            <label for="idDomicilio">ID Domicilio:</label>
            <input type="text" class="form-control" id="idDomicilio" name="idDomicilio" readonly>
          </div>

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

    $('#editForm').submit(function(e) {
      e.preventDefault();

      Swal.fire({
        title: '¿Deseas continuar con la edición?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Sí, continuar',
        cancelButtonText: 'Cancelar',
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
          var formData = $('#editForm').serialize();

          $.ajax({
            url: 'editar_domicilio.php',
            type: 'POST',
            data: formData,
            success: function(response) {
              if (response.includes('No se puede realizar el cambio de servicio')) {
                Swal.fire({
                  title: 'Error en la edición',
                  text: response,
                  icon: 'error',
                });
              } else {
                Swal.fire({
                  title: 'Resultado de la edición',
                  text: response,
                  icon: 'success',
                });

                $('#editModal').modal('hide');
              }
            },
            error: function(xhr, status, error) {
              Swal.fire({
                title: 'Error en la edición',
                text: 'Hubo un error al intentar editar el domicilio.',
                icon: 'error',
              });
            }
          });
        }
      });
    });
  });
</script>

<script>
$(document).ready(function() {
  $('#vermodalTomas').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var idContribuyente = button.data('id');
    
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
            <input type="month" class="form-control" id="fecha_contrato" name="fecha_contrato" required title="Su primer pago será en la fecha proporcionada del día 1 del contrato">
          </div>
          <input type="hidden" id="id_contribuyente_modal" name="id_contribuyente_modal">

          <button type="submit" class="btn btn-primary">Guardar Domicilio</button>
        </form>
      </div>
    </div>
  </div>
</div>

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
        <form id="estatusForm">
          <div class="form-group">
            <label for="idDomicilioEstatus">ID Domicilio:</label>
            <input type="text" class="form-control" id="idDomicilioEstatus" name="idDomicilioEstatus" readonly>
          </div>

          <div class="form-group">
            <label for="estatus">Estatus:</label>
            <select class="form-control" id="estatus" name="estatus">
              <option value="Baja">Baja</option>
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
  $(document).ready(function () {
    $('#estatusModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var idDomicilioEstatus = button.data('id-domicilio');

      $('#idDomicilioEstatus').val(idDomicilioEstatus);

      $('#estatusForm').submit(function (e) {
        e.preventDefault();

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
            var formDataEstatus = $('#estatusForm').serialize();

            $.ajax({
              url: 'baja_domicilio.php',
              type: 'POST',
              data: formDataEstatus,
              dataType: 'json',
              success: function (response) {
                if (response.success) {
                  Swal.fire({
                    title: "Actualización exitosa",
                    text: response.message,
                    icon: "success"
                  });
                } else {
                  Swal.fire({
                    title: "Error",
                    text: response.message,
                    icon: "error"
                  });
                }

                $('#estatusModal').modal('hide');
              },
              error: function (xhr, status, error) {
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
    });
  });
</script>

<script>
$(document).ready(function () {
  $('#agregarDomicilioModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var idContribuyente = button.data('id');

    $('#id_contribuyente_modal').val(idContribuyente);
  });

  $('#formAgregarDomicilio').submit(function (e) {
    e.preventDefault();

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
        var formData = $(this).serialize();

        $.ajax({
          type: 'POST',
          url: 'agregar_domicilio.php',
          data: formData,
          success: function (response) {
            if (response.type === 'success') {
              Swal.fire({
                title: 'Éxito',
                text: response.message,
                icon: 'success'
              });
            } else {
              Swal.fire({
                title: 'Error',
                text: response.message,
                icon: 'error'
              });
            }
          },
          error: function (error) {
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

</body>
</html>