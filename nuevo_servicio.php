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
  <title>Nuevo Servicio</title>
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
  <!-- En el encabezado de tu HTML -->
<link rel="stylesheet" href="ruta_local/sweetalert2.min.css">

  <!-- Agrega la referencia a jQuery y SweetAlert -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

  
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
    <div class="container mt-5">
    <h2>Nuevo Servicio</h2>
    <form action="nuevo_servicio.php" method="post">
        <div class="form-group">
            <label for="nombre">Nombre del servicio:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción del servicio:</label>
            <input type="text" class="form-control" id="descripcion" name="descripcion" required>
        </div>
        <div class="form-group">
            <label for="precio">Precio del servicio:</label>
            <input type="number" step="0.01" class="form-control" id="precio" name="precio" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar Servicio</button>
    </form>
</div>

        </div>
    </div>
    <?php
// Verifica si se enviaron datos por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Incluye el archivo de configuración
  include 'config.php';

  // Recupera los datos del formulario
  $nombre = $_POST["nombre"];
  $descripcion = $_POST["descripcion"];
  $precio = $_POST["precio"];

  // Prepara la consulta SQL
  $sql = "INSERT INTO tipos_de_servicio (nombre, descripcion, precio) VALUES ('$nombre', '$descripcion', $precio)";

  // Ejecuta la consulta
  if ($conn->query($sql) === TRUE) {
    echo "<script>
            Swal.fire({
              icon: 'success',
              title: '¡Servicio creado exitosamente!',
              text: 'El nuevo tipo de servicio ha sido registrado.',
              showConfirmButton: false,
              timer: 2000
            }).then((result) => {
              window.location.href = 'servicios.php';
            });
          </script>";
  } else {
    echo "<script>
            Swal.fire({
              icon: 'error',
              title: '¡Error al crear el servicio!',
              text: 'Ocurrió un error al registrar el nuevo tipo de servicio. Por favor, inténtelo de nuevo.',
              showConfirmButton: true
            });
          </script>";
  }

  // Cierra la conexión
  $conn->close();
}
?>

    
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
  <!-- Modal for viewing data -->
  <!-- Modal for viewing data -->
<div class="modal fade custom-modal" id="verModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">
                    Cobrar Meses
                </h4>
              
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Section: Información de Contribuyente -->
                    <div class="col-lg-6" style="border-right: 1px solid #ccc;">
                        <div id="informacionContribuyente">
                            <h4>Información de Contribuyente</h4>
                            <!-- Fields to display contributor information -->
                            <style>
                                /* Add this style block to your HTML file or in your CSS file */
                                .form-text {
                                    font-size: 14px; /* Adjust the font size as needed */
                                    display: inline-block;
                                    margin-left: 10px; /* Add space between the label and the information */
                                }
                            </style>
                            <div>
                                <label for="id_contribuyente_span">DNI:</label>
                                <span id="id_contribuyente_span" class="form-text"></span>
                            </div>
                          
                            <div>
                                <label for="tipo_servicio">Tipo de Servicio:</label>
                                <span id="tipo_servicio" class="form-text"></span>
                            </div>

                            <div>
                                <label for="precio_servicio">Precio del Servicio:</label>
                                <span id="precio_servicio" class="form-text"></span>
                            </div>
                            
                            <div>
                                <label for="nombre">Nombre:</label>
                                <span id="nombre" class="form-text"></span>
                            </div>

                            <div>
                                <label for="apellido">Apellidos:</label>
                                <span id="apellido" class="form-text"></span>
                            </div>

                            <div>
                                <label for="tomas_por_domicilio">Tomas:</label>
                                <span id="tomas_por_domicilio" class="form-text"></span>
                            </div>
                            <!-- Add more fields as needed -->
                            <div>
                                <h4>Meses pagados</h4>
                                <span id="meses_pagados" class="form-text"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Section: Meses Pagados -->
                    <div class="col-lg-6">
    <div id="cobrarMeses">
        <h4>Cobrar Meses</h4>
        <label for="mes_pago">Seleccionar Mes:</label>
        <input type="month" id="mes_pago" class="form-control mb-2">
        <button id="agregarMes" class="btn btn-primary mb-2">Agregar Mes</button>
        <!-- Elemento para mostrar mensajes de error -->
        <div id="mensajeError" class="alert alert-danger mt-2" style="display: none;"></div>



        <!-- Display selected months and their amounts -->
        <div id="meses_seleccionados"></div>

        <!-- Total global a pagar de los meses -->
        

        <!-- "Cobrar" button to save the information -->
        <button id="cobrarButton" class="btn btn-success mt-3">Cobrar</button>
    </div>
</div>
                </div>

                <!-- Horizontal line -->
                <hr class="my-3">

                <!-- Buttons aligned to the right -->
                <div class="form-group mt-3 d-flex justify-content-end">
<!-- Botón Cancelar -->
<!-- Botón Cancelar -->
<button id="cancelarButton" class="btn btn-danger mt-3" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

<script>
  
    $(document).ready(function () {
      var totalAmount = 0;

        // When the "Ver" button is clicked
        $('#verModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');

            // Realize an AJAX request to obtener_contribuyente.php to get the contributor's data
            $.ajax({
                url: 'obtener_contribuyente.php',
                type: 'POST',
                data: { id: id },
                success: function (data) {
                    var contribuyente = JSON.parse(data);

                    // Update the modal content with contributor data
                    $('#id_contribuyente_span').text(contribuyente.id_contribuyente);
                    $('#nombre').text(contribuyente.nombre);
                    $('#apellido').text(contribuyente.apellido);
                    $('#tomas_por_domicilio').text(contribuyente.tomas_por_domicilio);

                    // Update other fields based on your data structure
                    $.ajax({
                        url: 'obtener_tipo_servicio.php', // Replace with the actual URL
                        type: 'POST',
                        data: { id_tipo_de_servicio: contribuyente.id_tipo_de_servicio },
                        success: function (tipoServicio) {
                            var tipoServicioObj = JSON.parse(tipoServicio);
                            $('#tipo_servicio').text(tipoServicioObj.nombre);

                            // Convert precio to a numeric value
                            var precioNumeric = parseFloat(tipoServicioObj.precio);

                            // Check if the conversion was successful
                            if (!isNaN(precioNumeric)) {
                                // Use toFixed on the numeric value
                                $('#precio_servicio').text('$' + precioNumeric.toFixed(2));
                            } else {
                                // Handle the case where the conversion failed
                                console.error('Failed to convert precio to a numeric value');
                            }
                        }
                    });
                    function crearMesHTML(mes) {
    var precioServicio = parseFloat($('#precio_servicio').text().replace('$', ''));

    if (isNaN(precioServicio)) {
        console.error('Error: No se pudo obtener el precio del servicio.');
        return '';
    }

    // Calculate and update total amount
    totalAmount += precioServicio;

    return '<tr>' +
        '<td>' + mes + '</td>' +
        '<td>$' + precioServicio.toFixed(2) + '</td>' +
        '<td><button class="btn btn-outline-danger btn-sm eliminar-mes" data-mes="' + mes + '">x</button></td>' +
        '</tr>';
}


  // Función para actualizar la visualización de los meses seleccionados
  function actualizarMesesSeleccionados() {
    // Reset totalAmount to zero before calculating the total
    totalAmount = 0;

    var mesesHTML = '<table class="table table-bordered">' +
        '<thead>' +
        '<tr>' +
        '<th>Mes</th>' +
        '<th>Precio</th>' +
        '<th>Eliminar</th>' +
        '</tr>' +
        '</thead>' +
        '<tbody>';

    mesesHTML += mesesSeleccionados.map(crearMesHTML).join('');

    mesesHTML += '</tbody></table>';

    // Multiply totalAmount by the number of tomas
    var numeroDeTomas = parseInt($('#tomas_por_domicilio').text());

    if (!isNaN(numeroDeTomas)) {
        totalAmount *= numeroDeTomas;
    } else {
        console.error('Error: No se pudo obtener el número de tomas.');
    }

    // Display total amount
    mesesHTML += '<div>Total: $' + totalAmount.toFixed(2) + '</div>';

    $('#meses_seleccionados').html(mesesHTML);

    // Asociar evento de clic al botón de eliminación
    $('.eliminar-mes').on('click', function () {
        var mesAEliminar = $(this).data('mes');
        eliminarMes(mesAEliminar);
    });
}


    // Cuando el botón "Cancelar" es clicado
    $('#cancelarButton').on('click', function () {
        // Clear the selected months and their amounts
        mesesSeleccionados = [];
        actualizarMesesSeleccionados();

        // Close the modal or perform other actions as needed
        $('#verModal').modal('hide');
    });
  // Función para eliminar un mes de la selección
  function eliminarMes(mesAEliminar) {
      mesesSeleccionados = mesesSeleccionados.filter(function (mes) {
          return mes !== mesAEliminar;
      });
      actualizarMesesSeleccionados();
  }

  // Función para verificar si un mes ya ha sido seleccionado
 var mesesSeleccionados = [];

function mesYaSeleccionado(mesSeleccionado) {
return mesesSeleccionados.some(function (mes) {
  return mes === mesSeleccionado;
});
}

  // Cuando el botón "Agregar Mes" es clicado
$('#agregarMes').on('click', function () {
  var mesSeleccionado = $('#mes_pago').val();

  if (mesSeleccionado && !mesYaSeleccionado(mesSeleccionado)) {
      mesesSeleccionados.push(mesSeleccionado);
      actualizarMesesSeleccionados();

      // Puedes agregar lógica adicional aquí si es necesario
  } else {
      // Muestra un mensaje de error toast si el mes no está seleccionado
      mostrarToastError('Por favor, selecciona un mes u otro diferente.');
  }
});

// Función para mostrar un mensaje de error toast
function mostrarToastError(mensaje) {
  $('#mensajeError').html(mensaje).show();

  // Utiliza Bootstrap Toast para mostrar el mensaje
  $('.toast').toast('show');
}
                    // AJAX request to obtain months paid data
                    $.ajax({
                        url: 'obtener_meses_pagados.php', // Replace with the actual URL
                        type: 'POST',
                        data: { id_contribuyente: contribuyente.id_contribuyente },
                        success: function (mesesPagados) {
                            $('#meses_pagados').text(mesesPagados);
                        }
                    });

                    // You can add more code here to update additional fields
                }
            });
        });

        // When the "Ver" modal is hidden (closed)
        $('#verModal').on('hidden.bs.modal', function (event) {
            // Clear the modal content when the modal is closed
            $(this).find('input, select').val('');
        });
    });
</script>

</html>