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
