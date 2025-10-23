<?php
ob_start();
session_start();
include "config.php";

$alerta = ""; // Variable para mostrar mensajes SweetAlert

if (!empty($_POST["btningresar"])) {
    if (!empty($_POST["usuario"]) && !empty($_POST["password"])) {
        $usuario = trim($_POST["usuario"]);
        $password = $_POST["password"];

        // Usar prepared statements para mayor seguridad
        $stmt = $conn->prepare("SELECT * FROM usuario WHERE usuario = ?");
        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $conn->error);
        }
        
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $datos = $result->fetch_object();
            
            // Verificar si la contraseña está hasheada
            if (password_verify($password, $datos->clave)) {
                $_SESSION["id"] = $datos->id;
                $_SESSION["usuario"] = $datos->usuario;
                $_SESSION["nombre"] = $datos->nombre;
                $_SESSION["apellido"] = $datos->apellido;
                $_SESSION["rol"] = $datos->rol ?? "operador";
                $_SESSION["bienvenida"] = true;

                // Registrar acceso
                if ($conn->query("SHOW TABLES LIKE 'log_usuarios'")->num_rows > 0) {
                    $stmt_log = $conn->prepare("INSERT INTO log_usuarios (id_usuario, accion) VALUES (?, 'Inicio de sesión')");
                    $stmt_log->bind_param("i", $datos->id);
                    $stmt_log->execute();
                }

                $alerta = "<script>
                    Swal.fire({
                      icon: 'success',
                      title: '¡Bienvenido!',
                      text: 'Acceso exitoso',
                      showConfirmButton: false,
                      timer: 1500
                    }).then(() => {
                      window.location.href = 'index.php';
                    });
                </script>";
            } else {
                $alerta = "<script>
                    Swal.fire({
                      icon: 'error',
                      title: 'Acceso denegado',
                      text: '❌ Usuario o contraseña incorrectos'
                    });
                </script>";
            }
        } else {
            $alerta = "<script>
                Swal.fire({
                  icon: 'error',
                  title: 'Usuario no válido',
                  text: '❌ No se encontró el usuario'
                });
            </script>";
        }
        $stmt->close();
    } else {
        $alerta = "<script>
            Swal.fire({
              icon: 'warning',
              title: 'Campos incompletos',
              text: '⚠️ Por favor completá todos los campos'
            });
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8"/>
  <title>Login - Sistema de Agua Potable</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

  <link rel="stylesheet" href="assets/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="assets/css/icons.css"/>
  <link rel="stylesheet" href="assets/css/app-style.css"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css"/>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

  <style>
    @font-face {
      font-family: 'Bahnschrift';
      src: local('Bahnschrift'), url('assets/fonts/Bahnschrift.woff2') format('woff2');
      font-weight: 600;
    }
    body {
      font-family: 'Bahnschrift', 'Poppins', sans-serif;
      background: linear-gradient(135deg, #306BA9, #E16D2B);
      margin: 0;
      color: #333;
    }
    .card-authentication1 {
      border-radius: 15px;
      box-shadow: 0 0 18px rgba(0,0,0,0.15);
      background-color: #ffffff;
    }
    .card-title { font-size: 1.6rem; font-weight: 600; color: #306BA9; }
    .input-shadow { border: 1px solid #ccc; border-radius: 8px; padding: 12px; }
    .btn-block {
      background-color: #E16D2B;
      color: white;
      font-weight: 600;
      border-radius: 8px;
      transition: background-color 0.3s ease;
    }
    .btn-block:hover { background-color: #C15821; }
    .card-footer h6 { color: #2F7E50; font-size: 0.9rem; }
    .form-control-position i { color: #306BA9; }
  </style>
</head>

<body>
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-5">
        <div class="card card-authentication1">
          <div class="card-body">
            <div class="text-center mb-3">
              <img src="assets/images/logon.png" alt="Logo" width="160">
              <h5 class="card-title mt-2">BIENVENIDO</h5>
            </div>

            <form method="post" action="">
              <div class="form-group">
                <div class="position-relative has-icon-right">
                  <input type="text" name="usuario" class="form-control input-shadow" placeholder="Nombre de usuario" required>
                  <div class="form-control-position">
                    <i class="icon-user"></i>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="position-relative has-icon-right">
                  <input type="password" id="input" name="password" class="form-control input-shadow" placeholder="Contraseña" required>
                  <div class="form-control-position" style="right: 0; cursor: pointer;" onclick="togglePasswordVisibility()">
                    <i class="icon-eye" id="togglePasswordIcon"></i>
                  </div>
                </div>
              </div>

              <script>
                function togglePasswordVisibility() {
                  var input = document.getElementById("input");
                  input.type = input.type === "password" ? "text" : "password";
                }
              </script>

              <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="remember" checked>
                <label class="form-check-label" for="remember">Recuérdame</label>
              </div>

              <input name="btningresar" type="submit" class="btn btn-block" value="INICIAR SESIÓN">
            </form>
          </div>

          <div class="card-footer text-center">
            <h6>Sistema de control de agua potable de Alcaldía de Telpaneca</h6>
            <p style="font-size: 0.75rem;">Software desarrollado por Eddy Ernesto Martinez A</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php echo $alerta; ?>
</body>
</html>