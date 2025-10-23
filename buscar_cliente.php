<?php
include 'conexion.php';

// Obtén el valor de búsqueda desde la solicitud AJAX
$query = $_GET['query'];

// Realiza una consulta a la base de datos
$sql = "SELECT id_contribuyente, nombre, direccion, estatus FROM contribuyentes WHERE nombre LIKE '%$query%' OR id_contribuyente LIKE '%$query%'";
$resultado = $conexion->query($sql);

// Construye una tabla con los resultados de la búsqueda
if ($resultado->num_rows > 0) {
    echo "<table class='table table-hover'>";
    echo "<thead><tr><th scope='col'>#</th><th scope='col'>Nombre</th><th scope='col'>Direccion</th><th scope='col'>Estatus</th><th scope='col'>Editar</th><th scope='col'>Eliminar</th></tr></thead>";
    echo "<tbody>";

    while ($fila = $resultado->fetch_assoc()) {
        // Agrega el código HTML para mostrar cada fila de resultados
        // Puedes seguir el mismo formato que en el código anterior

    }

    echo "</tbody>";
    echo "</table>";
} else {
    echo "No se encontraron resultados.";
}

// Cierra la conexión a la base de datos
$conexion->close();
?>
