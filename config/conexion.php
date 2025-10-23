<?php
$host = "localhost";
$user = "Dzonot";
$clave = "1234";
$bd = "aguadzonot";

$conexion = mysqli_connect($host, $user, $clave, $bd);

if (mysqli_connect_errno()) {
    echo "Error de conexión: " . mysqli_connect_error();
    exit();
}

mysqli_set_charset($conexion, "utf8");

// Prueba de consulta
$resultado = mysqli_query($conexion, "SHOW TABLES");

echo "<h3>Tablas en la base de datos:</h3><ul>";
while ($fila = mysqli_fetch_array($resultado)) {
    echo "<li>" . $fila[0] . "</li>";
}
echo "</ul>";

mysqli_close($conexion);
?>
