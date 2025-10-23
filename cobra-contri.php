


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
    
  </ul>
     
  <ul class="navbar-nav align-items-center right-nav-link">
  <a class="btn btn-warning" href="./includes/_sesion/cerrarSesion.php">Log Out
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
			<a class="btn btn-success" href="../index.php">Nuevo Contribuyente 
      <i class="fa fa-plus"></i> </a>
      

       <a class="btn btn-primary" href="./includes/excel.php">Excel
       <i class="fa fa-table" aria-hidden="true"></i>
       </a>

		</div>
		<br>
    <h2>LISTA CONTRIBUYENTES</h2>
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
            <input type="text" name="campo" id="campo" class="form-control">
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
            <th class="sort asc" style="color: black; background-color: #CCCCCC;">Estatus</th>
            <th class="sort asc" style="color: black; background-color: #CCCCCC;">Domicilio</th>
            <th class="sort asc" style="color: black; background-color: #CCCCCC;">Tomas</th>
            <th class="sort asc" style="color: black; background-color: #CCCCCC;">Tipo</th>
            
            <th></th>
            <th></th>
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

            let url = "load2.php"
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
<!-- Modal para editar datos -->
<div class="modal fade custom-modal" id="editarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header ">
            
                <h5 class="modal-title" id="exampleModalLabel"><i class="icon-note" style="color: blue; font-size: 28px;"></i>
EDITAR CONTRIBUYENTE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formEditarContribuyente" >
                    <input type="hidden" name="id_contribuyente" id="id_contribuyente">
                    <!-- Agrega un campo para seleccionar el tipo de servicio -->
                    <div class="form-group">
    <label for="id_contribuyente_span">DNI</label>
    <input type="text" class="form-control" id="id_contribuyente_span" name="id_contribuyente_span" readonly>
</div>

                 
                        <div class="form-row">
                          
                          <div class="col">
                          <label for="nombre">Nombre</label>
                                              <input type="text" class="form-control custom-input" id="nombre" name="nombre" oninput="this.value = this.value.toUpperCase()">
                          </div>
                          <div class="col">
                          <label for="apellido">Apellido</label>
                                              <input type="text" class="form-control custom-input" id="apellido" name="apellido" oninput="this.value = this.value.toUpperCase()">
                          </div>
                        </div>
                     

                    <div class="form-group">
                        <label for="id_tipo_de_servicio">Tipo de Servicio</label>
                        <select class="form-control" id="id_tipo_de_servicio" name="id_tipo_de_servicio" required>
                            <!-- Puedes llenar las opciones dinámicamente con datos de la tabla tipos_de_servicio -->
                        </select>
                    </div>

              

                    <div class="form-group">
                        <label for="estatus_actual">Estatus /</label>
                        <!-- Aplica estilo en línea para darle color azul al texto -->
                        <span id="estatus_actual" style="color: #0fc8f7; font-weight: bold;"></span>

                        <label for="estatus"></label>
                        <select class="form-control" id="estatus" name="estatus" required>
                            <option value="" disabled selected>Selecciona un estatus</option>
                            <option value="activo">Activo</option>
                            <option value="baja">Baja</option>
                            <option value="corte">Corte</option>
                        </select>
                    </div>
                    <div class="form-group">
                      <label for="tomas_por_domicilio" class="form-label">Número de Tomas</label>
                      <input type="number" class="form-control" id="tomas_por_domicilio" name="tomas_por_domicilio" required>
                   </div>

                    <div class="form-group">
                        <label for="direccion">Domicilio</label>
                        <input type="text" class="form-control" id="direccion" name="direccion">
                    </div>
                    <button type="submit" class="btn btn-outline-info">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal de eliminación -->
<div class="modal fade" id="eliminarModal" tabindex="-1" role="dialog" aria-labelledby="eliminarModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="eliminarModalLabel">Confirmar Eliminación</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>¿Esta seguro de que deseas eliminar este registro?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" id="confirmarEliminar">Eliminar</button>
      </div>
    </div>
  </div>
</div>


</body>

<script>
    $(document).ready(function () {
        // Cuando se haga clic en el botón "Editar", se llenarán los campos del modal con los datos del contribuyente.
        $('#editarModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');

            // Realizar una solicitud AJAX para obtener los datos del contribuyente por su ID.
            $.ajax({
                url: 'obtener_contribuyente.php', // Crea este archivo PHP para obtener los datos del contribuyente.
                type: 'POST',
                data: { id: id },
                success: function (data) {
                    var contribuyente = JSON.parse(data);
                    $('#id_contribuyente').val(contribuyente.id_contribuyente);
                    $('#id_contribuyente_span').val(contribuyente.id_contribuyente);
                    $('#nombre').val(contribuyente.nombre);
                    $('#apellido').val(contribuyente.apellido);
                    $('#estatus').val(contribuyente.estatus);
                    $('#direccion').val(contribuyente.direccion);
                    // Rellena más campos según tu estructura de datos.
                    $('#estatus_actual').text(contribuyente.estatus);
                    // Actualiza la asignación de valores en la función success de la solicitud AJAX
                    $('#tomas_por_domicilio').val(contribuyente.tomas_por_domicilio);



                    // Llenar dinámicamente el campo de tipo de servicio al cargar el modal de edición
                    $.ajax({
                        url: 'obtener_tipos_de_servicio.php', // Crea este archivo PHP para obtener los tipos de servicio.
                        type: 'GET',
                        success: function (data) {
                            var tiposDeServicio = JSON.parse(data);

                            // Llenar las opciones del select con los tipos de servicio
                            var selectTipoServicio = $('#id_tipo_de_servicio');
                            selectTipoServicio.empty();

                            $.each(tiposDeServicio, function (index, tipoServicio) {
                                selectTipoServicio.append('<option value="' + tipoServicio.id_tipo_de_servicio + '">' + tipoServicio.nombre + '</option>');
                            });

                            // Seleccionar el tipo de servicio actual del contribuyente
                            selectTipoServicio.val(contribuyente.id_tipo_de_servicio);
                        }
                    });
                    $('#numero_tomas').val(contribuyente.numero_tomas);

                }
            });
        });

        // Cuando se envía el formulario de edición, realiza una solicitud AJAX para actualizar los datos.
        $('#formEditarContribuyente').on('submit', function (e) {
            e.preventDefault();
var formData = $(this).serializeArray();
        formData.push({ name: 'numero_tomas', value: $('#numero_tomas').val() });
            var formData = $(this).serialize();

            $.ajax({
                url: 'editar_contribuyente.php', // Crea este archivo PHP para actualizar los datos del contribuyente.
                type: 'POST',
                data: formData,
                success: function (response) {
                    if (response.includes('success')) {
                        alert('Los datos se han actualizado correctamente.');
                        $('#editarModal').modal('hide');
                        location.reload(); // Recarga la página actual
                        // Actualiza la tabla de contribuyentes con los nuevos datos si es necesario.
                    } else {
                        alert('Error al actualizar los datos. Inténtalo de nuevo.');
                    }
                }
            });
        });
  });
</script>

<script>
$(document).ready(function () {
  var idToDelete;

  // Captura el ID del registro a eliminar al abrir la modal
  $('#eliminarModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    idToDelete = button.data('id');
  });

  // Al hacer clic en el botón "Eliminar" en la modal
  $('#confirmarEliminar').click(function () {
    // Realiza una solicitud AJAX para eliminar el registro
    $.ajax({
      url: 'eliminar_contri.php', // Crea este archivo PHP para eliminar el registro.
      type: 'POST',
      data: { id_contribuyente: idToDelete },
      success: function (response) {
        if (response === 'success') {
          window.alert('El registro se ha eliminado correctamente.');
          $('#eliminarModal').modal('hide');
          location.reload(); // Recarga la página actual
          // Actualiza la tabla de contribuyentes con los nuevos datos si es necesario.
        } else {
          alert('Error al eliminar el registro. Inténtalo de nuevo.');
        }
      }
    });
  });
});

</script>
<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="modalFormLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalFormLabel">Formulario de Cobro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <!-- Sección: Información de Contribuyente -->
          <div class="col-lg-6" style="border-right: 1px solid #ccc;">
            <div id="informacionContribuyente">
              <h4>Información de Contribuyente</h4>
              <!-- Aquí puedes colocar campos para mostrar información del contribuyente -->
          
              <!-- Agrega más campos según sea necesario -->
            </div>
          </div>

          <!-- Sección: Cobrar Meses -->
          <div class="col-lg-6">
            <div id="cobrarMeses">
              <h4>Cobrar Meses</h4>
              <!-- Aquí colocas los campos relacionados con el cobro de meses -->
              <form action="procesar_formulario.php" method="post">
                <!-- Campos del formulario -->
                <input type="hidden" name="id_contribuyente" id="id_contribuyente_input">
                <!-- Otros campos del formulario -->
              </form>
            </div>
          </div>
        </div>

        <!-- Línea horizontal -->
        <hr class="my-3">

        <!-- Botones alineados a la derecha -->
        <div class="form-group mt-3 d-flex justify-content-end">
          <button type="submit" class="btn btn-primary">Enviar</button>
          <button type="button" class="btn btn-secondary ml-2" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>
</div>



</html>
