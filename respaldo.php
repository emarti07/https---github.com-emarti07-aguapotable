<?php
session_start();
if (empty($_SESSION["id"])) {
    header("location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>SISCATEL - Respaldo de Base de Datos</title>
    <link href="assets/css/pace.min.css" rel="stylesheet"/>
    <script src="assets/js/pace.min.js"></script>
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
    <link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet"/>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="assets/css/animate.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/sidebar-menu.css" rel="stylesheet"/>
    <link href="assets/css/app-style.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-theme bg-theme1">

<div id="pageloader-overlay" class="visible incoming"><div class="loader-wrapper-outer"><div class="loader-wrapper-inner"><div class="loader"></div></div></div></div>

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
                    <h4 class="welcome-message">Bienvenido <?php echo $_SESSION["nombre"] . " " . $_SESSION["apellido"]; ?></h4>
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
                        <h2 class="text-uppercase text-center">Respaldo de Base de Datos</h2>
                    </div>
                    <hr>
                    <div class="text-center">
                        <p>Haga clic en el botón para descargar un respaldo completo de la base de datos en formato SQL.</p>
                        <form id="backupForm" method="post" action="respaldo.php">
                            <button type="submit" name="backup" class="btn btn-primary">
                                <i class="fa fa-database"></i> Generar y Descargar Respaldo
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_POST['backup'])) {
    include('config.php');

    $backup_file = 'siscatel_backup_' . date("Y-m-d-H-i-s") . '.sql';

    $command = "mysqldump --user={$conn->real_escape_string($db_user)} --password='{$conn->real_escape_string($db_pass)}' --host={$conn->real_escape_string($db_host)} " .
               "{$conn->real_escape_string($db_name)} > {$backup_file}";

    system($command, $return_var);

    if ($return_var === 0) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($backup_file) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($backup_file));
        readfile($backup_file);
        unlink($backup_file);
        exit;
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'No se pudo generar el respaldo.',
            });
        </script>";
    }
}
?>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/plugins/simplebar/js/simplebar.js"></script>
<script src="assets/js/sidebar-menu.js"></script>
<script src="assets/js/app-script.js"></script>

</body>
</html>
