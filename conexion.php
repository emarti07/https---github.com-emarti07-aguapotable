<?php
// Datos de conexión a la base de datos
$host = "localhost";         // Servidor local
$usuario = "root";           // Usuario administrador de phpMyAdmin
$contrasena = "";            // Contraseña vacía por defecto en Wamp (ajustar si la cambiaste)
$basededatos = "aguadzonot"; // Nombre de la base de datos

// Crear una conexión a la base de datos
$conexion = new mysqli($host, $usuario, $contrasena, $basededatos);

// Verificar si la conexión tiene errores
if ($conexion->connect_error) {
    die("❌ Error de conexión: " . $conexion->connect_error);
}

// ✅ La conexión fue exitosa y está lista para ejecutar consultas

// ... Tu código PHP aquí ...

// Cerrar la conexión cuando hayas terminado
// $conexion->close(); // Opcional si querés cerrarla manualmente

?>
