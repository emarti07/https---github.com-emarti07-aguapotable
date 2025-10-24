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
  <title>SISCATEL - Cobrar</title>
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
          <h2 class="text-uppercase">Cobrar Meses de Contribuyentes</h2>
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

  <div class="modal fade" id="modalTomas" tabindex="-1" aria-labelledby="modalTomasLabel" aria-hidden="true">
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
              <th>id_Servicio</th>
              <th>Fecha_contrato</th>
              <th>Servicio</th>
              <th>Precio</th>
              <th>Estatus</th>
              <th>Descripción</th>
              <th>Tomas</th>
              <th>cobrar</th>
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
<script>
$(document).ready(function() {
  $('#modalTomas').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var idContribuyente = button.data('id');
    
    $.ajax({
      url: 'get_tomas.php',
      type: 'POST',
      data: { id_contribuyente: idContribuyente },
      success: function(data) {
        $('#tomasData').html(data);
      }
    });
  });
});
</script>
</body>
</html>