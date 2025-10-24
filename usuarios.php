<?php
session_start();
include "config.php";

if (!isset($_SESSION["id"])) {
    header("location: login.php");
    exit();
}

$alerta = "";

if (isset($_POST["crear"])) {
    $nombre = $conn->real_escape_string($_POST["nombre"]);
    $apellido = $conn->real_escape_string($_POST["apellido"]);
    $usuario = $conn->real_escape_string($_POST["usuario"]);
    $rol = $_POST["rol"];
    $clave = password_hash($_POST["clave"], PASSWORD_DEFAULT);

    $verificar = $conn->query("SELECT * FROM usuario WHERE usuario='$usuario'");
    if ($verificar->num_rows > 0) {
        $alerta = "<div class='alert alert-warning text-center'>⚠️ El nombre de usuario ya existe.</div>";
    } else {
        $conn->query("INSERT INTO usuario (nombre, apellido, usuario, clave, rol) VALUES ('$nombre','$apellido','$usuario','$clave','$rol')");
        $id_creado = $conn->insert_id;
        $conn->query("INSERT INTO log_usuarios (id_usuario, accion) VALUES ($id_creado, 'Creación')");
        $alerta = "<div class='alert alert-success text-center'>✅ Usuario creado exitosamente.</div>";
    }
}

if (isset($_POST["actualizar"])) {
    $id = $_POST["id"];
    $nombre = $conn->real_escape_string($_POST["nombre"]);
    $apellido = $conn->real_escape_string($_POST["apellido"]);
    $usuario = $conn->real_escape_string($_POST["usuario"]);
    $rol = $_POST["rol"];

    $query = "UPDATE usuario SET nombre='$nombre', apellido='$apellido', usuario='$usuario', rol='$rol' WHERE id=$id";
    $conn->query($query);

    if (!empty($_POST["clave"])) {
        $clave = password_hash($_POST["clave"], PASSWORD_DEFAULT);
        $conn->query("UPDATE usuario SET clave='$clave' WHERE id=$id");
    }

    $conn->query("INSERT INTO log_usuarios (id_usuario, accion) VALUES ($id, 'Actualización')");
    $alerta = "<div class='alert alert-info text-center'>✏️ Usuario actualizado correctamente.</div>";
}

if (isset($_GET["eliminar"])) {
    $id = $_GET["eliminar"];
    $conn->query("DELETE FROM usuario WHERE id=$id");
    $conn->query("INSERT INTO log_usuarios (id_usuario, accion) VALUES ($id, 'Eliminación')");
    $alerta = "<div class='alert alert-danger text-center'>🗑️ Usuario eliminado correctamente.</div>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>SISCATEL - Gestión de Usuarios</title>
  <link href="assets/css/pace.min.css" rel="stylesheet"/>
  <script src="assets/js/pace.min.js"></script>
  <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
  <link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet"/>
  <link href="assets/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="assets/css/animate.css" rel="stylesheet" type="text/css"/>
  <link href="assets/css/icons.css" rel="stylesheet" type="text/css"/>
  <link href="assets/css/sidebar-menu.css" rel="stylesheet"/>
  <link href="assets/css/app-style.css" rel="stylesheet"/>
</head>
<body class="bg-theme bg-theme1">

<div id="pageloader-overlay" class="visible incoming"><div class="loader-wrapper-outer"><div class="loader-wrapper-inner" ><div class="loader"></div></div></div></div>

<div id="wrapper">

  <div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
    <?php include('navegacion.php'); ?>
  </div>

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

<div class="clearfix"></div>

<div class="content-wrapper">
<div class="container-fluid">
<div class="card">
<div class="card-body">
  <div class="card-title">
    <h2 class="text-uppercase text-center">Gestión de Usuarios</h2>
  </div>
  <hr>
  <?php echo $alerta; ?>

  <?php
  $modo = "crear";
  $nombre = $apellido = $usuario = $rol = "";
  $id = "";

  if (isset($_GET["editar"])) {
      $id = $_GET["editar"];
      $resultado = $conn->query("SELECT * FROM usuario WHERE id=$id");
      $fila = $resultado->fetch_assoc();
      $nombre = $fila["nombre"];
      $apellido = $fila["apellido"];
      $usuario = $fila["usuario"];
      $rol = $fila["rol"];
      $modo = "actualizar";
  }
  ?>

  <form method="post" class="form-inline mb-4 justify-content-center">
      <input type="hidden" name="id" value="<?php echo $id; ?>">
      <input type="text" name="nombre" class="form-control" placeholder="Nombre" required value="<?php echo $nombre; ?>">
      <input type="text" name="apellido" class="form-control" placeholder="Apellido" required value="<?php echo $apellido; ?>">
      <input type="text" name="usuario" class="form-control" placeholder="Usuario" required value="<?php echo $usuario; ?>">
      <input type="text" name="clave" class="form-control" placeholder="Contraseña" <?php if ($modo == "crear") echo "required"; ?>>
      <select name="rol" class="form-control" required>
        <option value="">Seleccione rol</option>
        <option value="administrador" <?php if($rol=="administrador") echo "selected"; ?>>Administrador</option>
        <option value="operador" <?php if($rol=="operador") echo "selected"; ?>>Operador</option>
        <option value="tecnico" <?php if($rol=="tecnico") echo "selected"; ?>>Técnico</option>
      </select>
      <button type="submit" name="<?php echo $modo; ?>" class="btn btn-primary">
        <?php echo ucfirst($modo); ?> Usuario
      </button>
  </form>

  <table class="table table-bordered table-hover">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Usuario</th>
        <th>Rol</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $query = $conn->query("SELECT * FROM usuario ORDER BY id DESC");
      while ($fila = $query->fetch_assoc()) {
        $badge = "<span class='badge badge-secondary'>{$fila['rol']}</span>";
        if ($fila['rol'] == "administrador") $badge = "<span class='badge badge-primary'>Administrador</span>";
        if ($fila['rol'] == "operador") $badge = "<span class='badge badge-warning'>Operador</span>";
        if ($fila['rol'] == "tecnico") $badge = "<span class='badge badge-success'>Técnico</span>";

        echo "<tr>
          <td>{$fila['id']}</td>
          <td>{$fila['nombre']}</td>
          <td>{$fila['apellido']}</td>
          <td>{$fila['usuario']}</td>
          <td>$badge</td>
          <td class='text-center'>
            <a href='usuarios.php?editar={$fila['id']}' class='btn btn-sm btn-info'>✏️ Editar</a>
            <a href='usuarios.php?eliminar={$fila['id']}' class='btn btn-sm btn-danger' onclick=\"return confirm('¿Eliminar este usuario?')\">🗑️ Eliminar</a>
          </td>
        </tr>";
      }
      ?>
    </tbody>
  </table>
</div>
</div>
</div>
</div>
</div>
</div>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/plugins/simplebar/js/simplebar.js"></script>
<script src="assets/js/sidebar-menu.js"></script>
<script src="assets/js/app-script.js"></script>
</body>
</html>